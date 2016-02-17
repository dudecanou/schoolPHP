<?php
session_start();
//1) --  Recuperation des donnees du loghin et du password
$login=$_POST['login_prof'];
$password=$_POST['password_prof'];

//2) -- Connexion avec ORACLE

$connect=oci_connect("usr_sgbdr","deftones","127.0.0.1/XE");


//3) -- Requete SQL oci_parse();

$selection=oci_parse($connect,"select * from AH_PROF where login_prof='$login' and password_prof='$password'");


//4) -- Executer requete SQL oci_exectute ();

oci_execute($selection);
//5) -- Annalyse et affiche les resultats SQL oci_num_rows() ou oci_fetch_all();

$nombre=oci_fetch_all($selection,$resultats);

if($nombre >0)
    {
      $_SESSION['no_prof']=$resultats['NO_PROF'][0];
      $_SESSION['nom_prof']=$resultats['NOM_PROF'][0];
      $_SESSION['tel_prof']=$resultats['TEL_PROF'][0];
      $_SESSION['password_prof']=$resultats['PASSWORD_PROF'][0];
      $_SESSION['login_prof']=$resultats['LOGIN_PROF'][0];

header('location:prof_index.php');

}
else
    {
      echo $_SESSION['login_prof'];
    echo "<h3 class='message'>LOGIN ou PASSWORD incorrecte!!!</h3>";
    include('index.php');
}
?>

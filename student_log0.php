<?php
session_start();
//1) --  Recuperation des donnees du loghin et du password
$login=$_POST['login_etud'];
$password=$_POST['password_etud'];

//2) -- Connexion avec ORACLE

$connect=oci_connect("usr_sgbdr","deftones","127.0.0.1/XE");


//3) -- Requete SQL oci_parse();

$selection=oci_parse($connect,"select * from AH_ETUDIANT where login_etud='$login' and password_etud='$password'");


//4) -- Executer requete SQL oci_exectute ();

oci_execute($selection);
//5) -- Annalyse et affiche les resultats SQL oci_num_rows() ou oci_fetch_all();

$nombre=oci_fetch_all($selection,$resultats);

if($nombre >0)
    {
      $_SESSION['codepermanent']=$resultats['CODEPERMANENT'][0];
      $_SESSION['nom_etud']=$resultats['NOM_ETUD'][0];
      $_SESSION['prenom_etud']=$resultats['PRENOM_ETUD'][0];
      $_SESSION['datedenaissance']=$resultats['DATEDENAISSANCE'][0];
      $_SESSION['tel_etud']=$resultats['TEL_ETUD'][0];
      $_SESSION['no_rue']=$resultats['NO_RUE'][0];
      $_SESSION['nom_rue']=$resultats['NOM_RUE'][0];
      $_SESSION['province']=$resultats['PROVINCE'][0];
      $_SESSION['ville']=$resultats['VILLE'][0];
      $_SESSION['password_etud']=$resultats['PASSWORD_ETUD'][0];
      $_SESSION['login_etud']=$resultats['LOGIN_ETUD'][0];

header('location:student_index.php');

}
else
    {
      echo $_SESSION['login_etud'];
    echo "<h3 class='message'>LOGIN ou PASSWORD incorrecte!!!</h3>";
    include('index.php');
}
?>

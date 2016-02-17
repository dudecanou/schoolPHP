<?php
session_start();
//1) --  Recuperation des donnees du loghin et du password
$login=$_POST['login_admin'];
$password=$_POST['password_admin'];

//2) -- Connexion avec ORACLE

$connect=oci_connect("usr_sgbdr","deftones","127.0.0.1/XE");


//3) -- Requete SQL oci_parse();

$selection=oci_parse($connect,"select * from AH_ADMIN where login='$login' and password='$password'");


//4) -- Executer requete SQL oci_exectute ();

oci_execute($selection);
//5) -- Annalyse et affiche les resultats SQL oci_num_rows() ou oci_fetch_all();

$nombre=oci_fetch_all($selection,$resultats);

if($nombre >0)
    {
      $_SESSION['login']=$resultats['LOGIN'][0];
      $_SESSION['password']=$resultats['PASSWORD'][0];

header('location:admin_index.php');

}
else
    {
    echo "<h3 class='message'>LOGIN ou PASSWORD incorrecte!!!</h3>";
    include('index.php');
}
?>

<?php
$nocd=$_REQUEST['nocd'];
$titre=$_REQUEST['titre'];
$auteur=$_REQUEST['auteur'];
$prix=$_REQUEST['prix'];


//2) Connexion a la base de donnees ( inscrire le nom User, le mot de passe User et l'adresse)
$conn=oci_connect("usrsql1","deftones","127.0.0.1/XE");
if(!$conn)
{  
    echo "Echec de Connexion";
} 

    if (!empty($nocd))
        {
//3) Requete d'insertion 
    $insertion=oci_parse($conn,"insert into cds (nocd,titre,auteur,prix) values ('$nocd','$titre','$auteur','$prix')");
    
//4) Execution de la Requete d'insertion  
    oci_execute($insertion);  
    oci_commit($conn); 
    
//5)Analyse ou affiche des resultats  
    $enreg=oci_num_rows($insertion);
    if ($enreg >0)  
    {   
        echo "<div class='alert alert-success'>";
        echo "<strong>Success!</strong> Ajout effectuee.</div>";
            header('location:index_admin.php');

    }  
    else  
    {   
        echo "<div class='alert alert-danger'>";
        echo "<strong>Erreur!</strong> Erreur mise a jour.</div>"; 
            header('location:index_admin.php');

    }
        }
    else
        {
        echo "Veuillez remplir le champs ID";
        }
        oci_close($conn); 

?>
<?php


$conn=oci_connect("usrsql1","deftones","127.0.0.1/XE");

    $nocd = $_REQUEST['nocd'];


    //3) Requete SQL
    $delete = oci_parse($conn,"delete from livres WHERE nocd='$nocd'");
    //4) Execution de la requete
    oci_execute($delete);
    $rows=oci_num_rows($delete);
    if ($rows >0)  
    {   
        echo  "Suppression de " .$nocd. " effectuee";
    }  
    else  
    {   
        echo "Echec suppression";  
    }
    oci_close($conn); 
?>
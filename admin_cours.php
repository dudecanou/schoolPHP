<div class="col-sm-1"></div>

<!-- ------------------------------------ AJOUT COURS ---------------------------------- -->


<div class="col-sm-5">
        <h3>Add Cours</h3>
    <form class="form-horizontal " role="form" method="post">
  <div class="form-group">
    <div class="col-sm-10">
      <input type="text" name="nom_cours" class="form-control" placeholder="Entrer nom du cours" required>
    </div>
  </div>
    <div class="form-group">
    <div class="col-sm-10">
      <input type="textarea" name="desc_cours" class="form-control" placeholder="Entrer description du cours" required>
    </div>
  </div>
<div class="form-group">
<div class="col-sm-10">
  <input type="text" name="prix_cours" class="form-control" placeholder="Entrer le prix" required>
</div>
</div>
  <div class="form-group">
    <div class="col-sm-offset-0 col-sm-5">
      <button type="submit" name="new_cours" class="btn btn-primary">Add</button>
    </div>
  </div>
</form>


    <?php
    if (isset($_POST['new_cours']))
{
  $nom_cours=$_POST['nom_cours'];
  $desc_cours=$_POST['desc_cours'];
  $prix_cours=$_POST['prix_cours'];

  $conn=oci_connect("usr_sgbdr","deftones","127.0.0.1/XE");


//3) Requete d'insertion
    $insertion=oci_parse($conn,"insert into AH_COURS(no_cours,nom_cours,desc_cours,prix_cours)
    values (substr('$nom_cours',0,3)||SEQ_EP.nextVal,'$nom_cours','$desc_cours',$prix_cours)");

//4) Execution de la Requete d'insertion
    oci_execute($insertion);
    oci_commit($conn);

//Analyse des resultats de la requete SQL
$enreg=oci_num_rows($insertion);
if ($enreg >0)
{
    echo "<div class='alert alert-success'>";
    echo "<strong>Success!</strong> Ajout effectuee.</div>";


}
else
{
    echo "<div class='alert alert-danger'>";
    echo "<strong>Erreur!</strong> Erreur Ajout.</div>";
}
}
?>
</div>


<div class="col-sm-1"></div>


<!-- ------------------------------------ UPDATE & DELETE COURS ---------------------------------- -->


<!-- ------------------------------------ SELECTION DU COURS ---------------------------------- -->


<div class="col-sm-4">
            <h3>Update & Delete</h3>
    <form method="post">
<select class='form-control' name="choix_cours">

  <?php
//1) Connexion a oracle
      $conn=oci_connect("usr_sgbdr","deftones","127.0.0.1/XE");

      $select=oci_parse($conn, "select no_cours, nom_cours from AH_COURS");

      oci_execute($select);

      $nbrows=oci_fetch_all($select, $resultats);

          for($i =0 ; $i < $nbrows ; $i++)
              {
                  $no_cours = $resultats['NO_COURS'] [$i];
                  $nom_cours = $resultats['NOM_COURS'] [$i];
                  echo "<option value = '$no_cours'>$no_cours - $nom_cours</option>";
              }

  ?>

</select>
              <br>
        <button type="submit" name="update" class="btn btn-info">Update</button>
        <button type="submit" name="delete" class="btn btn-danger">Delete</button>
    </form>



    <!-- ------------------------------------ UPDATE COURS ---------------------------------- -->


<?php
    // Si le choix "ok" a ete initialiser
    if (isset($_REQUEST['update']))
        {
        $choix = $_REQUEST['choix_cours'];
        //2) Connexion avec oracle
    $conn=oci_connect("usr_sgbdr","deftones","127.0.0.1/XE");
        //3) Requete SQL
        $update = oci_parse ($conn, "Select * from AH_COURS WHERE no_cours = '$choix'");
        //4) Execution de la requete
        oci_execute($update);
        //5) Analyse et affichage des resultats
        $nbrows = oci_fetch_all($update, $resultats);
        echo "<form method='post'>";
        for($i=0; $i < $nbrows; $i++)
            {

            $no_cours=$resultats['NO_COURS'] [$i];
            $nom_cours=$resultats['NOM_COURS'] [$i];
            $desc_cours=$resultats['DESC_COURS'] [$i];
            $prix_cours=$resultats['PRIX_COURS'] [$i];

            echo "<br>";
            echo "<div class='form-group'>";
            echo "<div class='col-sm-15'>";
            echo "<input type='HIDDEN' name='no_cours' class='form-control' placeholder='Enter noProf' value='$choix'>";
            echo "</div>";
            echo "</div>";
            echo "<div class='form-group'>";
            echo "<div class='col-sm-15'>";
            echo "<input type='text' name='nom_cours' class='form-control' placeholder='Enter titre' value='$nom_cours'>";
            echo "</div>";
            echo "</div>";
            echo "<div class='form-group'>";
            echo "<div class='col-sm-15'>";
            echo "<input type='textarea' name='desc_cours' class='form-control' placeholder='Enter auteur' value='$desc_cours'>";
            echo "</div>";
            echo "</div>";
            echo "<div class='form-group'>";
            echo "<div class='col-sm-15'>";
            echo "<input type='text' name='prix_cours' class='form-control' placeholder='Enter price' value='$prix_cours'>";
            echo "</div>";
            echo "</div>";
            echo "<div class='form-group'>";
            echo "<div class='col-sm-15'>";
            echo "<button type='submit' name='ok' class='btn btn-primary'>Ok</button>";
            echo "</div>";
            echo "</div>";
            echo "</form>";
            }
    }

        if (isset($_REQUEST['ok']))
        {
          $conn=oci_connect("usr_sgbdr","deftones","127.0.0.1/XE");

              //1) Recuperation
              $nom_cours=$_POST['nom_cours'];
              $desc_cours=$_POST['desc_cours'];
              $prix_cours=$_POST['prix_cours'];
              $no_cours=$_POST['no_cours'];

              // Requete SQL UPDATE
          $miseajour = oci_parse($conn,"UPDATE AH_COURS SET
          nom_cours='$nom_cours',desc_cours='$desc_cours',prix_cours='$prix_cours' WHERE no_cours='$no_cours'");

              // Execution de la requete update
              oci_execute($miseajour);
              oci_commit($conn);

          //5)Analyse ou affiche des resultats
              $rows=oci_num_rows($miseajour);
              if ($rows >0)
              {
                  echo "<br>";
                  echo "<div class='alert alert-success'>";
                  echo "<strong>Success!</strong> Mise a jour reussi.</div>";


              }
              else
              {
                 echo "<br>";
                  echo "<div class='alert alert-danger'>";
                  echo "<strong>Erreur!</strong> Echec mise a jour.</div>";

              }        }
        ?>


        <!-- ------------------------------------ DELETE COURS ---------------------------------- -->


        <?php
        if (isset($_REQUEST['delete']))
        {

         $choix = $_REQUEST['choix_cours'];

            $conn=oci_connect("usr_sgbdr","deftones","127.0.0.1/XE");

        //3) Requete SQL
        $delete = oci_parse($conn,"delete from AH_COURS WHERE no_cours='$choix'");
        //4) Execution de la requete
        oci_execute($delete);
        $rows=oci_num_rows($delete);
        if ($rows >0)
        {
            echo "<br>";
            echo "<div class='alert alert-success'>";
            echo "<strong>Success!</strong> Suppression du cours # '$choix' effectuee.</div>";
        }
        else
        {
            echo "<br>";
            echo "<div class='alert alert-danger'>";
            echo "<strong>Erreur!</strong> Erreur suppression du cours # '$choix'.</div>";    }
        oci_close($conn);
        }
        ?>
</div>
<div class="col-sm-2"></div>

<div class="col-sm-1"></div>

<!-- ------------------------------------ AJOUT INSCRIPTION ---------------------------------- -->


<div class="col-sm-5">
        <h3>Add inscription</h3>
    <form class="form-horizontal " role="form" method="post">

      <div class="form-group">
      <div class="col-sm-6">
      <select class='form-control' name="choix_CP">

        <?php
      //1) Connexion a oracle
            $conn=oci_connect("usr_sgbdr","deftones","127.0.0.1/XE");

            $select=oci_parse($conn, "select codepermanent from AH_ETUDIANT");

            oci_execute($select);

            $nbrows=oci_fetch_all($select, $resultats);

                for($i =0 ; $i < $nbrows ; $i++)
                    {
                        $codepermanent = $resultats['CODEPERMANENT'] [$i];
                        echo "<option value = '$codepermanent'>$codepermanent</option>";
                    }
        ?>
      </select>
    </div>
  </div>

  <div class="form-group">
  <div class="col-sm-6">
  <select class='form-control' name="choix_cours">

    <?php
  //1) Connexion a oracle
        $conn=oci_connect("usr_sgbdr","deftones","127.0.0.1/XE");

        $select=oci_parse($conn, "select no_cours from AH_COURS");

        oci_execute($select);

        $nbrows=oci_fetch_all($select, $resultats);

            for($i =0 ; $i < $nbrows ; $i++)
                {
                    $no_cours = $resultats['NO_COURS'] [$i];
                    echo "<option value = '$no_cours'>$no_cours</option>";
                }
    ?>
  </select>
</div>
</div>

<div class="form-group">
<div class="col-sm-6">
<select class='form-control' name="choix_prof">

  <?php
//1) Connexion a oracle
      $conn=oci_connect("usr_sgbdr","deftones","127.0.0.1/XE");

      $select=oci_parse($conn, "select no_prof from AH_PROF");

      oci_execute($select);

      $nbrows=oci_fetch_all($select, $resultats);

          for($i =0 ; $i < $nbrows ; $i++)
              {
                  $no_prof = $resultats['NO_PROF'] [$i];
                  echo "<option value = '$no_prof'>$no_prof</option>";
              }
  ?>
</select>
</div>
</div>

  <div class="form-group">
    <div class="col-sm-10">
      <input type="text" name="no_groupe" class="form-control" placeholder="Entrer le # du groupe" required>
    </div>
  </div>
    <div class="form-group">
    <div class="col-sm-10">
      <input type="date" name="date_debut" class="form-control" placeholder="Entrer date de debut" required>
    </div>
  </div>
<div class="form-group">
<div class="col-sm-10">
  <input type="date" name="date_fin" class="form-control" placeholder="Entrer date de fin" required>
</div>
</div>
<div class="form-group">
<div class="col-sm-10">
  <input type="text" name="lasession" class="form-control" placeholder="Entrer la session" required>
</div>
</div>
<div class="form-group">
<div class="col-sm-10">
  <input type="text" name="rabais" class="form-control" placeholder="Entrer le rabais" required>
</div>
</div>
<div class="form-group">
<div class="col-sm-10">
  <input type="text" name="note_etud" class="form-control" placeholder="Entrer la note etudiant" required>
</div>
</div>
  <div class="form-group">
    <div class="col-sm-offset-0 col-sm-5">
      <button type="submit" name="new_inscription" class="btn btn-primary">Add</button>
    </div>
  </div>
</form>


    <?php
    if (isset($_POST['new_inscription']))
{
  $codepermanent=$_POST['choix_CP'];
  $no_cours=$_POST['choix_cours'];
  $no_prof=$_POST['choix_prof'];
  $no_groupe=$_POST['no_groupe'];
  $date_debut=$_POST['date_debut'];
  $date_fin=$_POST['date_fin'];
  $lasession=$_POST['lasession'];
  $rabais=$_POST['rabais'];
  $note_etud=$_POST['note_etud'];

  $conn=oci_connect("usr_sgbdr","deftones","127.0.0.1/XE");


//3) Requete d'insertion
    $insertion=oci_parse($conn,"insert into AH_INSCRIPTION(no_inscription,codepermanent,no_cours,no_prof,no_groupe,
    date_debut,date_fin,lasession,rabais,note_etud)
    values (SEQ_INSC.nextVal,'$codepermanent','$no_cours','$no_prof','$no_groupe','$date_debut',
    '$date_fin','$lasession','$rabais','$note_etud')");

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


<!-- ------------------------------------ UPDATE & DELETE INSCRIPTION ---------------------------------- -->


<!-- ------------------------------------ SELECTION DU INSCRIPTION ---------------------------------- -->


<div class="col-sm-4">
            <h3>Update & Delete</h3>
    <form method="post">
<select class='form-control' name="choix_inscription">

  <?php
//1) Connexion a oracle
      $conn=oci_connect("usr_sgbdr","deftones","127.0.0.1/XE");

      $select=oci_parse($conn, "select no_inscription, codepermanent from AH_INSCRIPTION");

      oci_execute($select);

      $nbrows=oci_fetch_all($select, $resultats);

          for($i =0 ; $i < $nbrows ; $i++)
              {
                  $no_inscription = $resultats['NO_INSCRIPTION'] [$i];
                  $codepermanent = $resultats['CODEPERMANENT'] [$i];
                  echo "<option value = '$no_inscription'>$no_inscription - $codepermanent</option>";
              }

  ?>

</select>
              <br>
        <button type="submit" name="update" class="btn btn-info">Update</button>
        <button type="submit" name="delete" class="btn btn-danger">Delete</button>
    </form>



    <!-- ------------------------------------ UPDATE PROF ---------------------------------- -->


<?php
    // Si le choix "ok" a ete initialiser
    if (isset($_REQUEST['update']))
        {
        $choix_inscription = $_REQUEST['choix_inscription'];
        //2) Connexion avec oracle
    $conn=oci_connect("usr_sgbdr","deftones","127.0.0.1/XE");
        //3) Requete SQL
        $update = oci_parse ($conn, "Select * from AH_INSCRIPTION WHERE no_inscription = '$choix_inscription'");
        //4) Execution de la requete
        oci_execute($update);
        //5) Analyse et affichage des resultats
        $nbrows = oci_fetch_all($update, $resultats);
        echo "<form method='post'>";
        for($i=0; $i < $nbrows; $i++)
            {

            $no_inscription=$resultats['NO_INSCRIPTION'] [$i];
            $codepermanent=$resultats['CODEPERMANENT'] [$i];
            $no_cours=$resultats['NO_COURS'] [$i];
            $no_prof=$resultats['NO_PROF'] [$i];
            $no_groupe=$resultats['NO_GROUPE'] [$i];
            $date_debut=$resultats['DATE_DEBUT'] [$i];
            $date_fin=$resultats['DATE_FIN'] [$i];
            $lasession=$resultats['LASESSION'] [$i];
            $rabais=$resultats['RABAIS'] [$i];
            $note_etud=$resultats['NOTE_ETUD'] [$i];

            echo "<br>";
            echo "<div class='form-group'>";
            echo "<div class='col-sm-15'>";
            echo "<input type='HIDDEN' name='no_inscription' class='form-control' placeholder='Enter noProf' value='$choix_inscription'>";
            echo "</div>";
            echo "</div>";
            echo "<div class='form-group'>";
            echo "<div class='col-sm-15'>";
            echo "<input type='text' name='codepermanent' class='form-control' placeholder='Enter codepermanent' value='$codepermanent'>";
            echo "</div>";
            echo "</div>";
            echo "<div class='form-group'>";
            echo "<div class='col-sm-15'>";
            echo "<input type='text' name='no_cours' class='form-control' placeholder='Enter # du cours' value='$no_cours'>";
            echo "</div>";
            echo "</div>";
            echo "<div class='form-group'>";
            echo "<div class='col-sm-15'>";
            echo "<input type='text' name='no_prof' class='form-control' placeholder='Enter # du prof' value='$no_prof'>";
            echo "</div>";
            echo "</div>";
            echo "<div class='form-group'>";
            echo "<div class='col-sm-15'>";
            echo "<input type='text' name='no_groupe' class='form-control' placeholder='Enter # du groupe' value='$no_groupe'>";
            echo "</div>";
            echo "</div>";
            echo "<div class='form-group'>";
            echo "<div class='col-sm-15'>";
            echo "<input type='date' name='date_debut' class='form-control' placeholder='Enter date de debut' value='$date_debut'>";
            echo "</div>";
            echo "</div>";
            echo "<div class='form-group'>";
            echo "<div class='col-sm-15'>";
            echo "<input type='date' name='date_fin' class='form-control' placeholder='Enter date de fin' value='$date_fin'>";
            echo "</div>";
            echo "</div>";
            echo "<div class='form-group'>";
            echo "<div class='col-sm-15'>";
            echo "<input type='text' name='lasession' class='form-control' placeholder='Enter la session' value='$lasession'>";
            echo "</div>";
            echo "</div>";
            echo "<div class='form-group'>";
            echo "<div class='col-sm-15'>";
            echo "<input type='text' name='rabais' class='form-control' placeholder='Enter le rabais' value='$rabais'>";
            echo "</div>";
            echo "</div>";
            echo "<div class='form-group'>";
            echo "<div class='col-sm-15'>";
            echo "<input type='text' name='note_etud' class='form-control' placeholder='Enter la note de l'etudiant' value='$note_etud'>";
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
              $no_inscription=$_POST['no_inscription'];
              $codepermanent=$_POST['codepermanent'];
              $no_cours=$_POST['no_cours'];
              $no_prof=$_POST['no_prof'];
              $no_groupe=$_POST['no_groupe'];
              $date_debut=$_POST['date_debut'];
              $date_fin=$_POST['date_fin'];
              $lasession=$_POST['lasession'];
              $rabais=$_POST['rabais'];
              $note_etud=$_POST['note_etud'];
              $no_prof=$_POST['no_prof'];

              // Requete SQL UPDATE
          $miseajour = oci_parse($conn,"UPDATE AH_INSCRIPTION SET
          codepermanent='$codepermanent',no_cours='$no_cours',no_prof='$no_prof',no_groupe='$no_groupe',date_debut='$date_debut',
          date_fin='$date_fin',lasession='$lasession',rabais='$rabais',note_etud='$note_etud' WHERE no_inscription='$no_inscription'");

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


        <!-- ------------------------------------ DELETE PROFESSEUR ---------------------------------- -->


        <?php
        if (isset($_REQUEST['delete']))
        {

         $choix_inscription = $_REQUEST['choix_inscription'];

            $conn=oci_connect("usr_sgbdr","deftones","127.0.0.1/XE");

        //3) Requete SQL
        $delete = oci_parse($conn,"delete from AH_INSCRIPTION WHERE no_inscription='$choix_inscription'");
        //4) Execution de la requete
        oci_execute($delete);
        $rows=oci_num_rows($delete);
        if ($rows >0)
        {
            echo "<br>";
            echo "<div class='alert alert-success'>";
            echo "<strong>Success!</strong> Suppression de l'inscription # '$choix_inscription' effectuee.</div>";
        }
        else
        {
            echo "<br>";
            echo "<div class='alert alert-danger'>";
            echo "<strong>Erreur!</strong> Erreur suppression de l'inscription # '$choix_inscription'.</div>";    }
        oci_close($conn);
        }
        ?>
</div>
<div class="col-sm-2"></div>

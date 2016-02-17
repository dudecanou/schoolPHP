<div class="col-sm-1"></div>

<!-- ------------------------------------ AJOUT PROFESSEUR ---------------------------------- -->


<div class="col-sm-5">
        <h3>Add Professor</h3>
    <form class="form-horizontal " role="form" method="post">
  <div class="form-group">
    <div class="col-sm-10">
      <input type="text" name="nom_prof" class="form-control" placeholder="Entrer nom" required>
    </div>
  </div>
    <div class="form-group">
    <div class="col-sm-10">
      <input type="text" name="tel_prof" class="form-control" placeholder="Entrer numero telephone" required>
    </div>
  </div>
<div class="form-group">
<div class="col-sm-10">
  <input type="text" name="login_prof" class="form-control" placeholder="Entrer un login" required>
</div>
</div>
<div class="form-group">
<div class="col-sm-10">
  <input type="text" name="password_prof" class="form-control" placeholder="Entrer un password" required>
</div>
</div>
  <div class="form-group">
    <div class="col-sm-offset-0 col-sm-5">
      <button type="submit" name="new_prof" class="btn btn-primary">Add</button>
    </div>
  </div>
</form>


    <?php
    if (isset($_POST['new_prof']))
{
  $nom_prof=$_POST['nom_prof'];
  $tel_prof=$_POST['tel_prof'];
  $login_prof=$_POST['login_prof'];
  $password_prof=$_POST['password_prof'];
  //$no_prof=substr($nom_prof,0,3)||SEQ_EP.nextVal;

  $conn=oci_connect("usr_sgbdr","deftones","127.0.0.1/XE");


//3) Requete d'insertion
    $insertion=oci_parse($conn,"insert into  AH_PROF(no_prof,nom_prof,tel_prof,password_prof,login_prof)
    values (substr('$nom_prof',0,3)||SEQ_EP.nextVal,'$nom_prof','$tel_prof','$password_prof','$login_prof')");

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


<!-- ------------------------------------ UPDATE & DELETE PROF ---------------------------------- -->


<!-- ------------------------------------ SELECTION DU PROF ---------------------------------- -->


<div class="col-sm-4">
            <h3>Update & Delete</h3>
    <form method="post">
<select class='form-control' name="choix">

  <?php
//1) Connexion a oracle
      $conn=oci_connect("usr_sgbdr","deftones","127.0.0.1/XE");

      $select=oci_parse($conn, "select no_prof, nom_prof from AH_PROF");

      oci_execute($select);

      $nbrows=oci_fetch_all($select, $resultats);

          for($i =0 ; $i < $nbrows ; $i++)
              {
                  $no_prof = $resultats['NO_PROF'] [$i];
                  $nom_prof = $resultats['NOM_PROF'] [$i];
                  echo "<option value = '$no_prof'>$no_prof - $nom_prof</option>";
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
        $choix = $_REQUEST['choix'];
        //2) Connexion avec oracle
    $conn=oci_connect("usr_sgbdr","deftones","127.0.0.1/XE");
        //3) Requete SQL
        $update = oci_parse ($conn, "Select * from AH_PROF WHERE no_prof = '$choix'");
        //4) Execution de la requete
        oci_execute($update);
        //5) Analyse et affichage des resultats
        $nbrows = oci_fetch_all($update, $resultats);
        echo "<form method='post'>";
        for($i=0; $i < $nbrows; $i++)
            {

            $no_prof=$resultats['NO_PROF'] [$i];
            $nom_prof=$resultats['NOM_PROF'] [$i];
            $tel_prof=$resultats['TEL_PROF'] [$i];
            $login_prof=$resultats['LOGIN_PROF'] [$i];
            $password_prof=$resultats['PASSWORD_PROF'] [$i];

            echo "<br>";
            echo "<div class='form-group'>";
            echo "<div class='col-sm-15'>";
            echo "<input type='HIDDEN' name='no_prof' class='form-control' placeholder='Enter noProf' value='$choix'>";
            echo "</div>";
            echo "</div>";
            echo "<div class='form-group'>";
            echo "<div class='col-sm-15'>";
            echo "<input type='text' name='nom_prof' class='form-control' placeholder='Enter titre' value='$nom_prof'>";
            echo "</div>";
            echo "</div>";
            echo "<div class='form-group'>";
            echo "<div class='col-sm-15'>";
            echo "<input type='text' name='tel_prof' class='form-control' placeholder='Enter auteur' value='$tel_prof'>";
            echo "</div>";
            echo "</div>";
            echo "<div class='form-group'>";
            echo "<div class='col-sm-15'>";
            echo "<input type='date' name='login_prof' class='form-control' placeholder='Enter price' value='$login_prof'>";
            echo "</div>";
            echo "</div>";
            echo "<div class='form-group'>";
            echo "<div class='col-sm-15'>";
            echo "<input type='text' name='password_prof' class='form-control' placeholder='Enter price' value='$password_prof'>";
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
              $nom_prof=$_POST['nom_prof'];
              $tel_prof=$_POST['tel_prof'];
              $login_prof=$_POST['login_prof'];
              $password_prof=$_POST['password_prof'];
              $no_prof=$_POST['no_prof'];

              // Requete SQL UPDATE
          $miseajour = oci_parse($conn,"UPDATE AH_PROF SET
          nom_prof='$nom_prof',tel_prof='$tel_prof',password_prof='$password_prof',login_prof='$login_prof' WHERE no_prof='$no_prof'");

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

         $choix = $_REQUEST['choix'];

            $conn=oci_connect("usr_sgbdr","deftones","127.0.0.1/XE");

        //3) Requete SQL
        $delete = oci_parse($conn,"delete from AH_PROF WHERE no_prof='$choix'");
        //4) Execution de la requete
        oci_execute($delete);
        $rows=oci_num_rows($delete);
        if ($rows >0)
        {
            echo "<br>";
            echo "<div class='alert alert-success'>";
            echo "<strong>Success!</strong> Suppression du professeur # '$choix' effectuee.</div>";
        }
        else
        {
            echo "<br>";
            echo "<div class='alert alert-danger'>";
            echo "<strong>Erreur!</strong> Erreur suppression du professeur # '$choix'.</div>";    }
        oci_close($conn);
        }
        ?>
</div>
<div class="col-sm-2"></div>

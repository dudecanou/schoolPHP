<div class="col-sm-1"></div>

<!-- ------------------------------------ AJOUT ETUDIANT ---------------------------------- -->


<div class="col-sm-5">
        <h3>Add Student</h3>
    <form class="form-horizontal " role="form" method="post">
  <div class="form-group">
    <div class="col-sm-10">
      <input type="text" name="nom_etud" class="form-control" placeholder="Entrer nom" required>
    </div>
  </div>
    <div class="form-group">
    <div class="col-sm-10">
      <input type="text" name="prenom_etud" class="form-control" placeholder="Entrer prenom" required>
    </div>
  </div>
    <div class="form-group">
    <div class="col-sm-10">
      <input type="text" name="datedenaissance" class="form-control" placeholder="Entrer date de naissance (ddmmyyyy)" required>
    </div>
  </div>
    <div class="form-group">
    <div class="col-sm-10">
      <input type="text" name="tel_etud" class="form-control" placeholder="Entrer numero telephone (###)###-####" required>
    </div>
  </div>
  <div class="form-group">
  <div class="col-sm-3">
    <input type="text" name="no_rue" class="form-control" placeholder="No rue" required>
    </div>
    <div class="col-sm-7">
    <input type="text" name="nom_rue" class="form-control" placeholder="Entrer nom de la rue" required>
  </div>
</div>
<div class="form-group">
<div class="col-sm-10">
  <input type="text" name="province" class="form-control" placeholder="Entrer la province" required>
</div>
</div>
<div class="form-group">
<div class="col-sm-10">
  <input type="text" name="ville" class="form-control" placeholder="Entrer la ville" required>
</div>
</div>
<div class="form-group">
<div class="col-sm-10">
  <input type="text" name="login_etud" class="form-control" placeholder="Entrer un login" required>
</div>
</div>
<div class="form-group">
<div class="col-sm-10">
  <input type="text" name="password_etud" class="form-control" placeholder="Entrer un password" required>
</div>
</div>
  <div class="form-group">
    <div class="col-sm-offset-0 col-sm-5">
      <button type="submit" name="new_etud" class="btn btn-primary">Add</button>
    </div>
  </div>
</form>


    <?php
    if (isset($_POST['new_etud']))
{
  $nom_etud=$_POST['nom_etud'];
  $prenom_etud=$_POST['prenom_etud'];
  $datedenaissance=$_POST['datedenaissance'];
  $tel_etud=$_POST['tel_etud'];
  $no_rue=$_POST['no_rue'];
  $nom_rue=$_POST['nom_rue'];
  $province=$_POST['province'];
  $ville=$_POST['ville'];
  $login_etud=$_POST['login_etud'];
  $password_etud=$_POST['password_etud'];

  $conn=oci_connect("usr_sgbdr","deftones","127.0.0.1/XE");


//3) Requete d'insertion
    $insertion=oci_parse($conn,"insert into AH_ETUDIANT(codepermanent,nom_etud,prenom_etud,datedenaissance,tel_etud,no_rue,nom_rue,province,ville,login_etud,password_etud)
    values (substr('$nom_etud',0,3)||substr('$prenom_etud',0,1)||substr('$datedenaissance',0,8)||SEQ_EP.nextVal,'$nom_etud','$prenom_etud','$datedenaissance','$tel_etud','$no_rue','$nom_rue','$province','$ville','$login_etud','$password_etud')");


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


<!-- ------------------------------------ UPDATE & DELETE ETUDIANT ---------------------------------- -->


<!-- ------------------------------------ SELECTION DE L'ETUDIANT ---------------------------------- -->


<div class="col-sm-4">
            <h3>Update & Delete</h3>
    <form method="post">
<select class='form-control' name="choix">

  <?php
//1) Connexion a oracle
      $conn=oci_connect("usr_sgbdr","deftones","127.0.0.1/XE");

      $select=oci_parse($conn, "select codepermanent, nom_etud, prenom_etud from AH_ETUDIANT");

      oci_execute($select);

      $nbrows=oci_fetch_all($select, $resultats);

          for($i =0 ; $i < $nbrows ; $i++)
              {
                  $codepermanent = $resultats['CODEPERMANENT'] [$i];
                  $nom_etud = $resultats['NOM_ETUD'] [$i];
                  $prenom_etud = $resultats['PRENOM_ETUD'] [$i];
                  echo "<option value = '$codepermanent'>$codepermanent - $nom_etud - $prenom_etud</option>";
              }

  ?>

</select>
              <br>
        <button type="submit" name="update" class="btn btn-info">Update</button>
        <button type="submit" name="delete" class="btn btn-danger">Delete</button>
    </form>



    <!-- ------------------------------------ UPDATE ETUDIANT ---------------------------------- -->


<?php
    // Si le choix "ok" a ete initialiser
    if (isset($_REQUEST['update']))
        {
        $choix = $_REQUEST['choix'];
        //2) Connexion avec oracle
    $conn=oci_connect("usr_sgbdr","deftones","127.0.0.1/XE");
        //3) Requete SQL
        $update = oci_parse ($conn, "Select * from AH_ETUDIANT WHERE CODEPERMANENT = '$choix'");
        //4) Execution de la requete
        oci_execute($update);
        //5) Analyse et affichage des resultats
        $nbrows = oci_fetch_all($update, $resultats);
        echo "<form method='post'>";
        for($i=0; $i < $nbrows; $i++)
            {

            $codepermanent=$resultats['CODEPERMANENT'] [$i];
            $nom_etud=$resultats['NOM_ETUD'] [$i];
            $prenom_etud=$resultats['PRENOM_ETUD'] [$i];
            $datedenaissance=$resultats['DATEDENAISSANCE'] [$i];
            $tel_etud=$resultats['TEL_ETUD'] [$i];
            $no_rue=$resultats['NO_RUE'] [$i];
            $nom_rue=$resultats['NOM_RUE'] [$i];
            $province=$resultats['PROVINCE'] [$i];
            $ville=$resultats['VILLE'] [$i];
            $login_etud=$resultats['LOGIN_ETUD'] [$i];
            $password_etud=$resultats['PASSWORD_ETUD'] [$i];

            echo "<br>";
            echo "<div class='form-group'>";
            echo "<div class='col-sm-15'>";
            echo "<input type='HIDDEN' name='codepermanent' class='form-control'  value='$choix'>";
            echo "</div>";
            echo "</div>";
            echo "<div class='form-group'>";
            echo "<div class='col-sm-15'>";
            echo "<input type='text' name='nom_etud' class='form-control' placeholder='Entrer nom etudiant value='$nom_etud'>";
            echo "</div>";
            echo "</div>";
            echo "<div class='form-group'>";
            echo "<div class='col-sm-15'>";
            echo "<input type='text' name='prenom_etud' class='form-control' placeholder='Enter prenom etudiant' value='$prenom_etud'>";
            echo "</div>";
            echo "</div>";
            echo "<div class='form-group'>";
            echo "<div class='col-sm-15'>";
            echo "<input type='text' name='datedenaissance' class='form-control' placeholder='Enter date de naissance (ddmmyyyy)' value='$datedenaissance'>";
            echo "</div>";
            echo "</div>";
            echo "<div class='form-group'>";
            echo "<div class='col-sm-15'>";
            echo "<input type='text' name='tel_etud' class='form-control' placeholder='Enter # de telephone (###)###-####' value='$tel_etud'>";
            echo "</div>";
            echo "</div>";
            echo "<div class='form-group'>";
            echo "<div class='col-sm-15'>";
            echo "<input type='text' name='no_rue' class='form-control' placeholder='Enter # de rue' value='$no_rue'>";
            echo "</div>";
            echo "</div>";
            echo "<div class='form-group'>";
            echo "<div class='col-sm-15'>";
            echo "<input type='text' name='nom_rue' class='form-control' placeholder='Enter Nom de rue' value='$nom_rue'>";
            echo "</div>";
            echo "</div>";
            echo "<div class='form-group'>";
            echo "<div class='col-sm-15'>";
            echo "<input type='text' name='province' class='form-control' placeholder='Enter province' value='$province'>";
            echo "</div>";
            echo "</div>";
            echo "<div class='form-group'>";
            echo "<div class='col-sm-15'>";
            echo "<input type='text' name='ville' class='form-control' placeholder='Enter ville' value='$ville'>";
            echo "</div>";
            echo "</div>";
            echo "<div class='form-group'>";
            echo "<div class='col-sm-15'>";
            echo "<input type='text' name='login_etud' class='form-control' placeholder='Enter login' value='$login_etud'>";
            echo "</div>";
            echo "</div>";
            echo "<div class='form-group'>";
            echo "<div class='col-sm-15'>";
            echo "<input type='text' name='password_etud' class='form-control' placeholder='Enter password' value='$password_etud'>";
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
              $nom_etud=$_POST['nom_etud'];
              $prenom_etud=$_POST['prenom_etud'];
              $datedenaissance=$_POST['datedenaissance'];
              $tel_etud=$_POST['tel_etud'];
              $no_rue=$_POST['no_rue'];
              $nom_rue=$_POST['nom_rue'];
              $province=$_POST['province'];
              $ville=$_POST['ville'];
              $login_etud=$_POST['login_etud'];
              $password_etud=$_POST['password_etud'];
              $codepermanent=$_POST['codepermanent'];

              // Requete SQL UPDATE
          $miseajour = oci_parse($conn,"UPDATE AH_ETUDIANT SET
          nom_etud='$nom_etud',prenom_etud='$prenom_etud',datedenaissance='$datedenaissance',tel_etud='$tel_etud',no_rue='$no_rue',nom_rue='$nom_rue',
          province='$province',ville='$ville',login_etud='$login_etud',password_etud='$password_etud' WHERE codepermanent='$codepermanent'");

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


        <!-- ------------------------------------ DELETE ETUDIANT ---------------------------------- -->


        <?php
        if (isset($_REQUEST['delete']))
        {

         $choix = $_REQUEST['choix'];

            $conn=oci_connect("usr_sgbdr","deftones","127.0.0.1/XE");

        //3) Requete SQL
        $delete = oci_parse($conn,"delete from AH_ETUDIANT WHERE codepermanent='$choix'");
        //4) Execution de la requete
        oci_execute($delete);
        $rows=oci_num_rows($delete);
        if ($rows >0)
        {
            echo "<br>";
            echo "<div class='alert alert-success'>";
            echo "<strong>Success!</strong> Suppression de l'etudiant # '$choix' effectuee.</div>";
        }
        else
        {
            echo "<br>";
            echo "<div class='alert alert-danger'>";
            echo "<strong>Erreur!</strong> Erreur suppression de l'etudiant # '$choix'.</div>";    }
        oci_close($conn);
        }
        ?>
</div>
<div class="col-sm-2"></div>

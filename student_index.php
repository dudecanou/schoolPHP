<?php
session_start();
if (!isset($_SESSION['login_etud']))
{
    header('location:index.php');

}
?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Bare - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">


    <!-- Custom CSS -->
    <style>
    body {
        padding-top: 70px;
        background: url(image/library.jpg) no-repeat center center fixed;
        background-size: cover;
        /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
    }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="student_index.php"><img src="image/logoAL.png" width="55" height="55" style="margin-top:-15px"/></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a style="font-size:17px"><?php echo "Welcome " . $_SESSION['prenom_etud'];?></a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
            <li><a href="logout.php">Deconnexion</a></li>
          </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">


        <div class="row" style="margin-top:10px">

        <style>
        .jumbotron {
          text-align:center;
          background: rgba(1, 1, 1, 0.8);
        }

        h2,p,th,td {
          color:white;
          text-align: center;
        }
        </style>

<div class="col-md-12">
  <div class="jumbotron">
    <h2>Liste des cours</h2>
    <p>
      <?php
      $codepermanent=$_SESSION['codepermanent'];

      $connect=oci_connect("usr_sgbdr","deftones","127.0.0.1/XE");

      $query=oci_parse($connect,"select c.no_cours, c.nom_cours, c.desc_cours, p.nom_prof from AH_INSCRIPTION i, AH_COURS c, AH_PROF p where i.no_cours=c.no_cours and i.no_prof=p.no_prof and i.codepermanent = '$codepermanent'");

      oci_execute($query);

      echo "  <div class='table-responsive'>
              <table class='table'>
              <thead>
              <tr>
              <th>#Cours</th>
              <th>Nom-cours</th>
              <th>Description</th>
              <th>Nom_prof</th>
              </tr>
              </thead>";

          

      while($array = oci_fetch_array($query))
               {
                   echo "<tbody>";
                   echo "<tr>";
                   echo "<td>" . $array[0] . "</td>";
                   echo "<td>" . $array[1] . "</td>";
                   echo "<td>" . $array[2] . "</td>";
                   echo "<td>" . $array[3] . "</td>";
                   echo "</tr>";
                   echo "</tbody>";

               }
               echo "</table>";
               echo "</div>";

      oci_close($connect);
      ?>
    </p>
  </div>
</div>

<div class="col-md-6">
  <div class="jumbotron">
    <h2>Bulletin</h2>
    <?php
    $codepermanent=$_SESSION['codepermanent'];

    $connect=oci_connect("usr_sgbdr","deftones","127.0.0.1/XE");

    $query=oci_parse($connect,"select c.no_cours, c.nom_cours, i.note_etud, c.prix_cours from AH_INSCRIPTION i, AH_COURS c, AH_PROF p where i.no_cours=c.no_cours and i.no_prof=p.no_prof and i.codepermanent = '$codepermanent'");

    oci_execute($query);

    echo "  <div class='table-responsive'>
            <table class='table'>
            <thead>
            <tr>
            <th>#Cours</th>
            <th>Nom-cours</th>
            <th>notes</th>
            </tr>
            </thead>";

            /*
            c.no_cours = 0
            c.nom_cours = 1
            i.note_etud = 2
            */
            $subTotal=0;
    while($array = oci_fetch_array($query))
             {
               $rowTotal = $array[3];
               $subTotal+=$rowTotal;
                 echo "<tbody>";
                 echo "<tr>";
                 echo "<td>" . $array[0] . "</td>";
                 echo "<td>" . $array[1] . "</td>";
                 echo "<td>" . $array[2] . "</td>";
                 echo "</tr>";
                 echo "</tbody>";

             }
             echo "</table>";
             echo "</div>";

    ?>

  </div>
</div>

<div class="col-md-6">
  <div class="jumbotron">
    <h2>Facture</h2>
    <?php

    $query=oci_parse($connect,"select c.no_cours, c.nom_cours, i.note_etud, c.prix_cours from AH_INSCRIPTION i, AH_COURS c, AH_PROF p where i.no_cours=c.no_cours and i.no_prof=p.no_prof and i.codepermanent = '$codepermanent'");

    oci_execute($query);

    $tax1=$subTotal*0.05;
    $tax2=$subTotal*0.099;
    $total=$subTotal+$tax1+$tax2;

    echo "  <div class='table-responsive'>
            <table class='table'>
            <thead>
            <tr>
            <th>#Cours</th>
            <th>Nom-cours</th>
            <th>Tarif</th>
            </tr>
            </thead>";

            /*
            c.no_cours = 0
            c.nom_cours = 1
            i.note_etud = 2
            */
            $subTotal=0;
    while($array = oci_fetch_array($query))
             {
               $rowTotal = $array[3];
               $subTotal+=$rowTotal;
                 echo "<tbody>";
                 echo "<tr>";
                 echo "<td>" . $array[0] . "</td>";
                 echo "<td>" . $array[1] . "</td>";
                 echo "<td>" . $array[3] . " $</td>";
                 echo "</tr>";
                 echo "</tbody>";

             }


    echo "<tr>
            <th></th> <th></th> <th>SUB-TOTAL</th> <th>$subTotal $</th>
        </tr>";
    echo "<tr>
            <th></th> <th></th> <th>TPS</th> <th>$tax1 $</th>
        </tr>";
    echo "<tr>
            <th></th> <th></th>  <th>TVQ</th> <th>$tax2 $</th>
        </tr>";
    echo "<tr>
            <th></th> <th></th>  <th>TOTAL</th> <th>$total $</th>
        </tr>";

        echo "</table>";
        echo "</div>";

        ?>
  </div>
</div>


        </div>



        <!-- /.row -->

    <!-- /.container -->

    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>


</body>


</html>

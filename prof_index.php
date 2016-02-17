<?php
session_start();
if (!isset($_SESSION['login_prof']))
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
        background: url(image/classroom.jpg) no-repeat center center fixed;
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
                <a class="navbar-brand" href="prof_index.php"><img src="image/logoAL.png" width="55" height="55" style="margin-top:-15px"/></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a style="font-size:17px"><?php echo "Welcome " . $_SESSION['nom_prof'];?></a>
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

        h2,h4,p,th,td {
          color:white;
          text-align: center;
        }
        </style>

          <div class="col-md-12">
            <div class="jumbotron">
              <h2>Liste de vos cours</h2>
              <br>
              <p>
                <?php
                $no_prof=$_SESSION['no_prof'];

                $connect=oci_connect("usr_sgbdr","deftones","127.0.0.1/XE");

                $query=oci_parse($connect,"select distinct c.no_cours as no_cours,nom_cours,desc_cours
                FROM AH_INSCRIPTION i, AH_COURS c, AH_PROF p
                WHERE i.no_cours=c.no_cours
                AND i.no_prof=p.no_prof
                AND p.no_prof = '$no_prof'");

                oci_execute($query);

                $nbrows=oci_fetch_all($query, $resultats);

                for($i =0 ; $i < $nbrows ; $i++)
                    {
                            $no_cours = $resultats['NO_COURS'] [$i];
                            $nom_cours = $resultats['NOM_COURS'] [$i];
                            $desc_cours = $resultats['DESC_COURS'] [$i];
                            echo "  <h4>COURS : #".$no_cours."  -  ".$nom_cours."  -  (".$desc_cours.")</h4><br>";

                            $etudiant=oci_parse($connect,"select distinct e.codepermanent as codepermanent,nom_etud,prenom_etud,tel_etud
                            FROM AH_INSCRIPTION i, AH_ETUDIANT e
                            WHERE i.codepermanent=e.codepermanent
                            AND i.no_cours = '$no_cours'
                            AND i.no_prof = '$no_prof'");

                            oci_execute($etudiant);

                            $nbrows1=oci_fetch_all($etudiant, $resultats2);

                            echo "<table class='table'>";
                            echo "<tr><td><strong>CODE</strong></td><td><strong>PRENOM</strong></td><td><strong>NOM</strong></td><td><strong>TEL</strong></td> </tr>";

                            for($j =0 ; $j < $nbrows1 ; $j++)
                                {
                                      $codepermanent=$resultats2['CODEPERMANENT'] [$j];
                                      $nom_etud = $resultats2['NOM_ETUD'] [$j];
                                      $prenom_etud = $resultats2['PRENOM_ETUD'] [$j];
                                      $tel_etud = $resultats2['TEL_ETUD'] [$j];

                                      echo "<tr><td>".$codepermanent."</td><td>".$nom_etud."</td><td> ".$prenom_etud."</td><td>".$tel_etud."</td></tr>";
                                }

                            echo "</table>";
                            echo "<br>";
                  }

                oci_close($connect);
                ?>
              </p>
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

<?php
session_start();
if (!isset($_SESSION['login']))
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
        background: url(image/admin1.png) no-repeat center center fixed;
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
                <a class="navbar-brand" href="admin_index.php"><img src="image/logoAL.png" width="55" height="55" style="margin-top:-15px"/></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                   <li>
                      <a href="admin_index.php">Acceuil </a>
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


    <div class="container">
      <?php

      if(isset($_GET['choix']))
      {
        $choix=$_GET['choix'];

      switch($choix)
      {
      case "student":
      include("admin_student.php");
      break;
      case "prof":
      include("admin_prof.php");
      break;
      case "cours":
      include("admin_cours.php");
      break;
      case "inscription":
      include("admin_inscription.php");
      break;
      default:
      include("dashboard_admin.php");
      }
      }
      else
      {
        include("dashboard_admin.php");
      }
      ?>
    </div>




        <!-- /.row -->

    <!-- /.container -->

    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>


</body>

</html>

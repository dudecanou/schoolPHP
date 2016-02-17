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
        background: url(image/backG.jpg) no-repeat center center fixed;
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
                <a class="navbar-brand" href="index.php"><img src="image/logoAL.png" width="55" height="55" style="margin-top:-15px"/></a>

            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php?choix=etudiant" style="font-size:17px">Student</a>
                    </li>
                    <li>
                        <a href="index.php?choix=prof" style="font-size:17px">Professor</a>
                    </li>
                    <li>
                        <a href="index.php?choix=contact" style="font-size:17px">Contact</a>
                    </li>
                </ul>

            <!-- /.navbar-collapse -->
            <ul class="nav navbar-nav navbar-right">
        <li><a href="index.php?choix=admin">Admin</a></li>
      </ul>
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">


        <div class="row" style="margin-top:60px">

        <?php
        if(isset($_GET['choix']))
              {

          // ---- Recuperation du choix par GET
          $choix=$_GET['choix'];

          // ----- Traiter le choix soit Patient soit Medecin soit Admin
          switch($choix)
              {
                  case "etudiant":
                  include("student_log.php");
                  break;
                  case "prof":
                  include("prof_log.php");
                  break;
                  case "contact":
                  include("contact.php");
                  break;
                  case "admin":
                  include("admin_log.php");
                  break;


          }
        }



          ?>




    </div>
    <!-- /.container -->

    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>


</body>

</html>

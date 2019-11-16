<?php
session_start();





?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ARMShop/Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel="stylesheet" href="../bootstrap/bootstrap-3.3.6/dist/css/bootstrap.min.css">
    <script src="../bootstrap/bootstrap-3.3.6/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../style.css">
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="60">
    <style>
        #btn-sr:hover
        {
            transition: 1s;
            background-color:firebrick !important;

        }
        #btn-sr
        {
            transition: 1s;
        }
    </style>
        <!--BEGIN NAV-->
        <header>
            <nav  id="nav"  class="navbar navbar-default navbar-fixed-top">
                <div  class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mynavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        </button>
                        <div  class="collapse navbar-collapse" id="mynavbar">
                            <ul  class="nav navbar-nav">
                              <li class="logo"><h1><span id="blanc">ARM</span><span id="gris">Shop/Admin</span><img src="../images/logo.png" width="30" height="30"></h1></li>
                              <?php
                              if(isset($_SESSION['isLog']) and $_SESSION['isLog'] == true)
                              {
                                  echo "<li><a class='decort-menu' href='../DataTransport/deconnexionAdmin.php'>Déconnexion</a></li>";
                                  echo "<li><a class='decort-menu' href='../Vue_PHP/DashBoard.php'>DashBoard</a></li>";
                                  echo "<li><a class='decort-menu' href='../Vue_PHP/AnnoncePage.php'>Annonces</a></li>";
                                  echo "<li><a class='decort-menu' href='../Vue_PHP/Reception_Message.php'>Messages</a></li>";
                                  echo "<li><a class='decort-menu' href='../Vue_PHP/Message_Admin.php'>Rédiger une annonce</a></li>";
                              }
                              else
                              {
                                 
                                  echo "<li><a class='decort-menu' href='../Vue_PHP/LoginAdmin.php'>Login</a></li>";
                              }
                              ?>
                              
                              
            </nav>

            <!-- BEGIN BANNIERE Carousel-->
            
            <div class="container">
                    <div id="block">
                            <div style="background: url(../images/admin.jpg) ; height: 580px; max-width: 100% ">
                                <div class="overlay">
                                    <div class="container">
                                        <h2 class="logo">Bonjour , nous vous souhaitons la bienvenue sur<br> <span id="blanc">ARM</span><span id="gris">Shop/Admin</span><img src="../images/logo.png" width="30" height="30"><br>
                                        Le site d'administration de ARMSHOP<br></h2> <br>
                                    </div>
                                </div>
                            </div>
                   </div>  
            </div>
           
        </header>
        <div class="container">
            <div id="new">
              
            </div>
        </div>
        <footer style="height:150px;background-color:#333;margin-top:20px;">
            
            <h1 style="text-align:center;padding-top:10px;" class="logo"><span id="blanc">ARM</span><span id="gris">Shop</span><img src="../images/logo.png" width="30" height="30"></h1>
            <p style="text-align:center;color:white">Copyright Chiarelli Thomas®</p>
     
        </footer>
    </body>
</html>
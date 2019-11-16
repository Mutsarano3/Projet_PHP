<?php

session_start();

require("..\Object_PHP\Admin.php");
require("..\Object_PHP\database.php");
$a = new Admin(DataBase::connect());
if(isset($_POST['log-email']) and isset($_POST['log-mdp']))$a->AdminLogin($_POST['log-email'],$_POST['log-mdp']);
if($a->isLog())
{
    $_SESSION['mail'] = $a->RecupEmail($_POST['log-email']);
    $_SESSION['Ident'] = $a->RecupId($_POST['log-email']);
    $_SESSION['passwd'] = $a->RecupMdp($_POST['log-email']);
    $_SESSION['isLog'] = true;
    //sleep(5);
    header('location: ../Vue_PHP/AccueilAdmin.php');
}


?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login Admin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="..\bootstrap\bootstrap-3.3.6\dist\css\bootstrap.min.css">
        <script src="../Projet_PHP/bootstrap/bootstrap-3.3.6/dist/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../style.css">
    </head>
    <body style="background-color:blue;">
        <div  class="container">
           
            <form action="" method="post" role="form">
                <div class="row">
                    <a style="color:red;text-decoration:none" href="../Vue_PHP/AccueilAdmin.php">Retour à l'accueil</a>
                    <div style="width:800px;height:400px;background: white;margin: 0 auto; margin-top:30px;border-radius:10px">
                        <h2 style="text-align:center;">Login ARMShop</h2><br>
                        <div class="ligne-rouge"></div>
                        <label for="log-email" style="margin: 0 auto">Email:</label>
                        <input style="width:500px !important;" id="log-email" name="log-email" type="text" placeholder="Insérez votre email" class="form-control">
                        <label for="log-mdp" style="margin: 0 auto">Mot de passe:</label>
                        <input style="width:500px !important;" id="log-mdp" name="log-mdp" type="password" placeholder="Insérez votre mot de passe" class="form-control">
                        <button type="submit" class="btn btn-default" style="margin-top: 12px;">Enjoy !</button>
                        <p class="comments">Veuillez-remplir les champs avec vos identifiants</p><br>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>
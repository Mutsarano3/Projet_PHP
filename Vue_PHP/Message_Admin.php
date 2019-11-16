<?php
session_start();
if(isset($_SESSION['mail']))
{

}
else
{
    header('location: ../index.php');
}
require("..\Object_PHP\database.php");
require("..\Object_PHP\Admin.php");
$admin = new Admin(DataBase::connect());
if(isset($_POST['admin']))
{
    $admin->AnnoncesisValid($_POST['admin'],$_SESSION['Ident'][0]);
}
//var_dump($_SESSION);
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>ARMShop</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="../bootstrap/bootstrap-3.3.6/dist/css/bootstrap.min.css">
        <script src="../bootstrap/bootstrap-3.3.6/dist/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../style.css">
        <style>
            body
            {
                background-color:orange;
            }
            #form-admin
            {
                background-color:white;
                width:600px;
                height:300px;
                margin:0 auto;
                margin-top:20px;
            }

            #form-admin h2
            {
                text-align:center;

            }
        </style>
    </head>
    <body>
        <a style="color:white" href="../Vue_PHP/AccueilAdmin.php">Retour à l'accueil</a>
        <div class="container-fluid">
            <div style="border-radius:10px;" id="form-admin">
                <h2>Création d'annonce </h2>
                <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                <label>Insérez votre annonce</label><br>
                <textarea name="admin" cols="50" rows="6"></textarea><br>
                <input class="btn btn-default" type="submit" name="enjoy" value="Envoyer">
                <p style="display:<?php if($admin->annonceError) echo "block";else echo "none"?>" class="comments">Format d'annonce invalide</p>
                </form>
            </div>
        </div>
    </body>
</html>

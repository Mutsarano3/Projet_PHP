<?php


session_start();
if(isset($_SESSION['prenom']))
{

}
else
{
    header('location: ../index.php');
}

require("..\Object_PHP\database.php");
require("..\Object_PHP\Users.php");
$us = new User(DataBase::connect());
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $us->MessageisValid($_POST['message'],$_SESSION['email'][0]);
}




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
                background-color:yellow;
            }
            #form-message
            {
                background-color:white;
                height:400px;
                width:700px;
                margin: 0 auto;
                margin-top:30px;
                border-radius:10px;
            }
        </style>
    </head>
    <body>
        <a style="color:black" href="../Vue_PHP/Accueil.php">Retour à l'accueil</a>
        <h2 style="text-align:center">Message pour l'admin</h2>
        <div id="form-message">
            <h3 style="text-align:center">Veuillez insérer un message pertinent pour que les admins puissent vous aider</h3>
            <form action="<?php echo  $_SERVER['PHP_SELF']?>" method="post">
            <label>Insérez votre message ici :</label><br>
           <textarea name="message" cols="50" rows="10" require>
        </textarea><br>
            <input style="background-color:green;text-align:center ! important" class="btn btn-default" type="submit" name="submit" value="Envoyer">
            </form>
            <p class="comments" style="display:<?php if($us->messageError) echo "block"; else echo "none"?> ">Votre message est vide ou alors avec des caractères spéciaux</p>
        </div>

    </body>
</html>

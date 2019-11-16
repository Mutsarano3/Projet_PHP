<?php
session_start();
if(isset($_SESSION['prenom']))
{

}
else
{
    header('location: ../index.php');
}
require("..\Object_PHP\Users.php");
require("..\Object_PHP\database.php");
$us = new User(DataBase::connect());
//$tempo=array($us->RecupMdp($_SESSION['email'][0]));
if(isset($_SESSION['email'][0]) and isset($_POST['mdpold']) and isset($_POST['mdpnew']) and isset($_POST['mdpnewconfirm']))$us->VerifMdpChange($_SESSION['email'][0],$_POST['mdpold'],$_POST['mdpnew'],$_POST['mdpnewconfirm'],$_SESSION['mdp']);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Changement de mot de passe</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../bootstrap/bootstrap-3.3.6/dist/css/bootstrap.min.css">
    <script src="../bootstrap/bootstrap-3.3.6/dist/js/bootstrap.min.js"></script>
</head>
<body id="bg-chmdp">
    <div class="container">
        <a style="color:white" href="../Vue_PHP/Profil.php">Retourner à votre compte</a>
        <div id="msp-chmdp">
            <h1>Changement de mot de passe</h1>
            <p style="color:brown"> Les erreurs sont marquées par des champs rouge</p>
            <form role="form" method="POST" action=<?php echo $_SERVER['PHP_SELF']?>>
                <label for="mdpold">Ancien mot de passe :</label>
                <input class="form form-control" type="password" name="mdpold"  placeholder=" Insérez ancien mot de passe">
                
                <label for="mdpold">Nouveau mot de passe :</label>
                <input class="form form-control" type="password" name="mdpnew"  placeholder=" Insérez nouveau mot de passe ">
                <label for="mdpold">Confirmez nouveau mot de passe :</label>
                <input class="form form-control" type="password" name="mdpnewconfirm"  placeholder="Confirmez nouveau mot de passe">
                <p style="display:<?php if($us->mdpErreur) echo "block"; else echo "none"?>">Erreur : l'ancien  mot de passe  que vous aviez taper n'est pas valide alors le nouveau ne correspond pas avec la confirmation</p>
               <input type="submit" id="confirm" name="confirm" class="btn btn-default" value="Confirmer">
            </form>
        </div>
    </div>
</body>
</html>
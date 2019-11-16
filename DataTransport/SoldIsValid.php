<?php
session_start();
if(isset($_SESSION['prenom']))
{

}
else
{
    header('location: ../index.php');
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Paiement Succesful</title>
    <link href="../style.css" rel="stylesheet">
    <link rel="stylesheet" href="../bootstrap/bootstrap-3.3.6/dist/css/bootstrap.min.css">
    <script src="../bootstrap/bootstrap-3.3.6/dist/js/bootstrap.min.js"></script>
</head>
<body>
    <div id="message">
    <h2>Paiement validé <span class="glyphicon glyphicon-ok"> !</span></h2>
    <p>Votre paiement a été validé avec succès ! Votre argent est remis sur votre solde.</p><br>
    <a id="retour" href="../Vue_PHP/Profil.php">Cliquez-ici pour revenir à la page profil</a><br>
    </div>
    
</body>
</html>

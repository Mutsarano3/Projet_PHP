<?php

session_start();


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ARMShop</title>
    <link rel="stylesheet" href="../bootstrap/bootstrap-3.3.6/dist/css/bootstrap.min.css">
    <script src="../bootstrap/bootstrap-3.3.6/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../style.css">
    <style>
    body
    {
        background: green;
    }
    #form-paiement
    {
        background: white;
        width:650px;
        height:400px;
        margin: 0 auto;
        margin-top: 20px;
    }
    #produit
    {
        width:600px;
        height:250px;
        box-shadow: 8px 8px 8px #333;
    }
    p
    {
        display:inline-block;
    }
    </style>
</head>
<body>
    <div class="contain-fluid">
    <a style="color:white" href="../Vue_PHP/Accueil.php">Retour à l'accueil</a>
        <div id="form-paiement">
        <h2>Votre produit...</h2>
        <div id="produit">
        <img  src="<?php echo "../imagesAdmin/".$_SESSION['images_mat']?>" width="100" alt="Images de votre produit" height="100"><p> 1x <?php echo $_SESSION['nom_mat']." by".$_SESSION['marque_mat']."<br>Prix :" .$_SESSION['prix_mat']."€"?></p>
        
        
        </div>
        <?php
        if($_SESSION['solde'][0] < $_SESSION['prix_mat'])
        {
            echo "<a href='../Vue_PHP/Profil.php' style='color:red'>Veuillez recréditer votre solde avant d'acheter ce produit</a>";
        }
        else
        {
            echo "<a class='btn btn-default' style='background:red;color:white;margin-left:200px;margin-top:5px;' href='../DataTransport/StartPay.php'>Procédez au paiement</a>";
        }
        
        
        ?>
        </div>
        
        


    </div>
    
</body>
</html>
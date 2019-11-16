<?php
session_start();
require("..\Object_PHP\database.php");

$req = DataBase::connect()->prepare('SELECT Num_Commande,Date_commande,lieux_commande FROM commande WHERE ID_users=?');
$req->execute(array($_SESSION['id'][0]));
$sql = DataBase::connect()->prepare('SELECT Nom_Materiel,Marque,Prix,images FROM Materiel NATURAL JOIN commande WHERE commande.ID_users=?');
$sql->execute(array($_SESSION['id'][0]));
$categorie = DataBase::connect()->prepare('SELECT Nom_Categorie FROM categorie NATURAL JOIN materiel NATURAL JOIN commande WHERE commande.ID_users=?');
$categorie->execute(array($_SESSION['id'][0]));



?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../bootstrap/bootstrap-3.3.6/dist/css/bootstrap.min.css">
    <script src="../bootstrap/bootstrap-3.3.6/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../style.css">
    <title>ARMShop</title>
    <style>
        h2
        {
            text-align:center;
        }
        body
        {
            background:orange;
        }

        .form-commande
        {
            margin: 0 auto;
            margin-top: 20px;
            width:500px;
            height:300px;
            background:white;
            box-shadow: 8px 8px 8px #333;
        }
        h3
        {
            text-align:center;
        }
        p
        {
            display:inline-block;
        }
    </style>
</head>
<body>
    <a href="../Vue_PHP/Accueil.php">Retour à l'accueil</a>
    <h2>Voici vos dernières commandes, <?php echo $_SESSION['prenom'][0] ?></h2>
    <?php
    while($data = $req->fetch())

    {?>

    <?php
    $mat = $sql->fetch();
    $cat = $categorie->fetch();

    ?>
    <div class="form-commande">
        <h3>Commandé le <?php echo $data['Date_commande'] ?></h3>
        <div class="ligne-rouge"></div>
        <h3> Votre numéro de commande : <?php echo $data['Num_Commande'] ?></h3>
        <img height="100" width="100" src="../imagesAdmin/<?php echo $mat['images']?>"><p>1X <?php echo $mat['Nom_Materiel']?> By <?php echo $mat['Marque']?> <br>Catégorie: <?php echo $cat['Nom_Categorie']?><br>
    Adresse de facturation : <?php echo $data['lieux_commande']?>  </p>


    </div>
 <?php
    }?>
    
</body>
</html>
<?php
session_start();
require("..\Object_PHP\database.php");
require("..\Object_PHP\HardWare.php");
$suppr = DataBase::connect()->prepare('DELETE FROM panier WHERE ID_users=? AND ID_Materiel=?');
$id_panier = DataBase::connect()->prepare('SELECT ID_Materiel FROM panier WHERE ID_users=?');
$id_panier->execute(array($_SESSION['id'][0]));
$sql = DataBase::connect()->prepare('SELECT images,Nom_Materiel,Marque,Prix,Stock FROM materiel NATURAL JOIN panier WHERE ID_users = ?');
$sql->execute(array($_SESSION['id'][0]));
$req = DataBase::connect()->prepare('SELECT COUNT(*) FROM panier WHERE ID_users=?');
$req->execute(array($_SESSION['id'][0]));
$count = $req->fetch();
$hardware = new HardWare(DataBase::connect());

if(isset($_POST['achat']))
{
    if(isset($_POST['id_mat']) and isset($_POST['nom_mat']) and isset($_POST['prix_mat']) and isset($_POST['stock_mat']) and isset($_POST['images_mat']) and isset($_POST['marque_mat']))
    {
        $hardware->verifHardWare($_POST['id_mat'],$_POST['nom_mat'],$_POST['marque_mat'],$_POST['prix_mat'],$_POST['stock_mat'],$_POST['images_mat']);
        if($hardware->isValid)
        {
            $_SESSION['id_mat'] = $hardware->getId();
            $_SESSION['nom_mat'] = $hardware->getNom();
            $_SESSION['marque_mat'] = $hardware->getMarque();
            $_SESSION['prix_mat'] = $hardware->getPrix();
            $_SESSION['stock_mat'] = $hardware->getStock();
            $_SESSION['images_mat'] = $hardware->getImages();
            //sleep(2);
            header('location: ../Vue_PHP/PayHardWare.php');
        }
    }
    


}
if(isset($_POST['suppr_article']))
{
    if(isset($_POST['id_mat']) and isset($_POST['nom_mat']) and isset($_POST['prix_mat']) and isset($_POST['stock_mat']) and isset($_POST['images_mat']) and isset($_POST['marque_mat']))
    {
        $hardware->verifHardWare($_POST['id_mat'],$_POST['nom_mat'],$_POST['marque_mat'],$_POST['prix_mat'],$_POST['stock_mat'],$_POST['images_mat']);
        if($hardware->isValid)
        {
            $suppr->execute(array($_SESSION['id'][0],$hardware->getId()));
            //sleep(2);
            header('location: ../Vue_PHP/Panier.php');
        }
    }
   

}



?>


<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ARMShop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel="stylesheet" href="../bootstrap/bootstrap-3.3.6/dist/css/bootstrap.min.css">
    <script src="../bootstrap/bootstrap-3.3.6/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../style.css">
    <style>
        body
        {
            background:#008080;

        }

        .form-panier
        {
            width:400px;
            height:200px;
            display:inline-block;
            background:white;
            margin-left: 20px;
            margin-right:20px;
            margin-top:20px;
        }
        p
        {
            display:inline-block;
        }

    </style>
</head>
<body>
<a style="color:white" href="../Vue_PHP/Accueil.php">Retourner à l'accueil</a>
    <h2 style="text-align:center">Votre panier, <?php echo $_SESSION['prenom'][0]?></h2>
    <div class="ligne-rouge"></div>
    <h3>Élément(s) dans votre panier : <?php echo $count[0] ?></h3>
    <?php

    while($data = $sql->fetch())


{?>

<?php

    $data_id = $id_panier->fetch();

?>
    <div class="form-panier">
    <img width="100" height="100" src="../imagesAdmin/<?php echo $data['images'] ?>">
    <p> <?php echo $data['Nom_Materiel']." By ".$data['Marque']." Stock: ".$data['Stock']." Prix: ".$data['Prix']."€"?></p>
    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
        <input type='hidden' name='id_mat' value="<?php echo $data_id['ID_Materiel'] ?>">
        <input type='hidden' name='nom_mat' value="<?php echo $data['Nom_Materiel'] ?>">
        <input type='hidden' name='prix_mat' value="<?php echo $data['Prix'] ?>">
        <input type='hidden' name='stock_mat' value="<?php echo $data['Stock'] ?>">
        <input type='hidden' name='marque_mat' value="<?php echo $data['Marque'] ?>">
        <input type='hidden' name='images_mat' value="<?php echo $data['images']?>">
        <?php
            if($data['Stock'] != 0)
            {
                echo "<input type='submit' name='achat' value='Acheter cet article'><br>";
            }
            else
            {
                echo "<p style='color:red'>Vous ne pouvez pas acheter ce produit car il n'est plus de stock</p>";
            }
        ?>
        <input type="submit" name="suppr_article" value="Supprimer cet article">
    </form>
        
    </div>
    <?php

}?>
    
</body>
</html>
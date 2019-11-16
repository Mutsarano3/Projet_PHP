<?php


require("..\Object_PHP\HardWare.php");
require("..\Object_PHP\database.php");
session_start();
if(isset($_SESSION['mail']))
{

}
else
{
    header('location: ../index.php');
}
//var_dump($_SESSION);
$hardware = new HardWare(DataBase::connect());

/*if(isset($_POST['name']) and isset($_POST['marque']) and isset($_POST['num_cat']) and isset($_POST['prix']) and isset($_POST['stock']) and isset($_POST['images']))
{
    

}*/
if( isset($_SESSION['modify_hardware']) and $_SESSION['modify_hardware'] == true   and isset($_POST['name']) and isset($_POST['marque']) and isset($_POST['num_cat']) and isset($_POST['prix']) and isset($_POST['stock']) and isset($_POST['images']))
{
    $hardware->HardWareUpdate($_POST['name'],$_POST['marque'],$_POST['num_cat'],$_POST['prix'],$_POST['stock'],$_POST['images'],$_SESSION['id_materiel']);
}
else
{
    if(isset($_POST['name']) and isset($_POST['marque']) and isset($_POST['num_cat']) and isset($_POST['prix']) and isset($_POST['stock']) and isset($_POST['images']))
    {
        $hardware->HardWareValid($_POST['name'],$_POST['marque'],$_POST['num_cat'],$_POST['prix'],$_POST['stock'],$_POST['images']);

    }
   

}

//var_dump($hardware);
//var_dump($_POST);




?>

<!DOCTYPE html>
<html>
    <head>
        <script src="../Js/bootstrap.min.js"></script>
        <link href="../style.css" rel="stylesheet">
        <link href="../bootstrap/bootstrap-3.3.6/dist/css/bootstrap-theme.min.css" rel="stylesheet">
        <script src="../bootstrap/bootstrap-3.3.6/dist/js/bootstrap.min.js"></script>
        <style>
            body
            {
                background:yellow !important;
            }
            #form
            {
                width: 800px;
                height: 600px;
                background-color: white;
                margin: 0 auto !important;
            }
        </style>
        <meta charset="utf-8">
    </head>
    <body>
    <?php
    
    if(isset($_SESSION['modify_hardware'])and $_SESSION['modify_hardware'] == true)
    {
        echo "<a href='../DataTransport/EndModifyHardWare.php'>Quittez modif</a>";
    }
    else
    {
        echo "<a href='../Vue_PHP/DashBoard.php'>Retour DashBoard</a>";
    }
    
    ?>
        <div style="border-radius:10px;" id="form" class="container-fluid">
            <h2>Ajout de matériel</h2>
            <form action="" method="POST">
                <label for="name">Nom :</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="" value="<?php if(isset($_SESSION['modify_hardware']) and $_SESSION['modify_hardware'] == true)echo $hardware->RecupNom($_SESSION['id_materiel'])[0]?>"><br>
                <p class="comments" style="display:<?php if($hardware->nom_Error == true) echo "block"; else echo "none"?>" >Votre champ est vide ou invalide</p>
                <label for="marque">Marque :</label>
                <input type="text" name="marque" id="marque" value="<?php if(isset($_SESSION['modify_hardware']) and $_SESSION['modify_hardware'] == true)echo $hardware->RecupMarque($_SESSION['id_materiel'])[0]?>"><br>
                <p class="comments" style="display:<?php if($hardware->marque_Error == true) echo "block"; else echo "none"?>" >Votre champ est vide ou invalide</p>
                <label for="num_cat">Catégorie :</label>
                <select name="num_cat">
                    <option <?php if(isset($_SESSION['modify_hardware']) and $_SESSION['modify_hardware'] == true and $hardware->RecupNumCategorie($_SESSION['id_materiel'])[0] == 1) echo "selected" ?> value="1">Arduino</option>
                    <option <?php if(isset($_SESSION['modify_hardware']) and $_SESSION['modify_hardware'] == true and $hardware->RecupNumCategorie($_SESSION['id_materiel'])[0] == 2) echo "selected" ?>  value="2">RaspBerrys</option>
                    <option <?php if(isset($_SESSION['modify_hardware']) and $_SESSION['modify_hardware'] == true and $hardware->RecupNumCategorie($_SESSION['id_materiel'])[0] == 3) echo "selected" ?>  value="3">MContrôleur</option>
                    <option <?php if(isset($_SESSION['modify_hardware']) and $_SESSION['modify_hardware'] == true and $hardware->RecupNumCategorie($_SESSION['id_materiel'])[0] == 4) echo "selected" ?>  value="4">Capteurs</option>
                </select><br>
                <label for="prix">Prix:</label>
                <input type="number" name="prix" id="prix" value="<?php if(isset($_SESSION['modify_hardware']) and $_SESSION['modify_hardware'] == true)echo $hardware->RecupPrix($_SESSION['id_materiel'])[0]?>"><br>
                <p class="comments" style="display:<?php if($hardware->prix_Error == true) echo "block"; else echo "none"?>" >Votre champ est vide ou invalide</p>
                <label for="stock">Stock : </label>
                <input type="number" name="stock" id="stock" value="<?php if(isset($_SESSION['modify_hardware']) and $_SESSION['modify_hardware'] == true)echo $hardware->RecupStock($_SESSION['id_materiel'])[0]?>"><br>
                <p>Si vous voulez insérer une valeur '0' dans les champs 'Stock' ou 'Prix' vous devez rentrer 0.0</p><br>
                <p class="comments" style="display:<?php if($hardware->stock_Error == true) echo "block"; else echo "none"?>" >Votre champ est vide ou invalide</p>
                <label for="images">Images du matériel :</label>
                <input type="file" id="images" value="<?php if(isset($_SESSION['modify_hardware']) and $_SESSION['modify_hardware'] == true)echo $hardware->RecupImages($_SESSION['id_materiel'])[0]?>" name="images"><br><br>
                <p class="comments" style="display:<?php if($hardware->images_Error == true) echo "block"; else echo "none"?>" >Votre champ est vide ou invalide</p>
                <input type="submit" class="btn btn-default" value="Envoyer">
            </form>
        </div>
    </body>
</html>
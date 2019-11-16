<?php

session_start();

require("..\Object_PHP\database.php");
$req = DataBase::connect()->prepare('SELECT * FROM annonce');
$req->execute(array());
if(isset($_GET['supp']))
{
    $sql = DataBase::connect()->prepare('DELETE FROM annonce WHERE date_envoi < CURRENT_TIMESTAMP ');
    $sql->execute();
    unset($_GET['supp']);
    header('location: ../Vue_PHP/AnnoncePage.php');
    exit();

}
//var_dump($_GET);


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
            .form-annonce
            {
                display: block;
                width:500px;
                height:200px;
                background-color:white;
                margin: 0 auto;
                margin-top: 42px;
                border-radius:10px;
                

            }

            .form-annonce > *
            {
                padding-left:5px;
                padding-top:5px;
            }

        </style>
    </head>
    <body>
        <?php

        if(isset($_SESSION['id']))
        {
            echo "<a href='../Vue_PHP/Accueil.php'> Retourner à l'accueil user</a>";
        }
        else
        {
            echo "<a href='../Vue_PHP/AccueilAdmin.php'> Retourner  à l'accueil admin</a>";

        }
        

        
        ?>
        <?php
            if(isset($_SESSION['id']))
            {

            }
            else
            {
                $url = $_SERVER['PHP_SELF'];
                echo "<form action=".$url." method=GET>
                        <input type='submit' style='margin-top:25px;' class='btn btn-default' name='supp' value='Supprimer les annonces'>
                        </form>";
            }
        
        ?>
        
        <div class="container-fluid">
            <h2 style="text-align:center">Annonces des administrateurs</h2>
            <?php 
            while($data = $req->fetch())
            {?>
            <div class="form-annonce">
                <h4> De l'admin : <?php echo $data['id'] ?> </h4>
                <h4> Date du post : <?php echo $data['date_envoi'] ?></h4>
                <h4>Message :</h4>
                <p><?php echo $data['annonce'] ?></p>
                
            </div>
            <?php 
            }?>
        </div>
    </body>
</html>
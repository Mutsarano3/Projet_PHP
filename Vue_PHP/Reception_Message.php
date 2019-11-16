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
$req = DataBase::connect()->prepare('SELECT * FROM chat');
$req->execute();
if(isset($_POST['delete']))
{
    $sql = DataBase::connect()->prepare('DELETE FROM chat WHERE Date_Envoi < CURRENT_TIMESTAMP ');
    $sql->execute();
    unset($_POST['delete']);
    header('location: ../Vue_PHP/Reception_Message.php');
    exit();

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
                background-color:orange;
            }
            .form-message
            {
                margin: 0 auto;
                display:inline-block;
                margin-top: 30px;
                margin-bottom:30px;
                height:250px;
                width:500px;
                background-color:white;
                border-radius:5px;
                

            }

            .form-message > *
            {
                padding-left:5px;
                padding-top:5px;
            }
            .message
            {
               
                font-size:15px;

            }
            ul
            {
                font-size:12px;
                list-style:none;
                text-decoration:none;
                
            }
        </style>
    </head>
    <body>
        <div class="container-fluid">
            <a style="color:white" href="AccueilAdmin.php">Retour à l'accueil</a>
            
            <h2 style="text-align:center">Messages utilisateurs<h2>
                
                <div class="container-fluid">
                <ul>
                    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                        <li><input type="submit" name="delete" value="Supprimer les messages"></li>
                    </form>
                    
                <ul>
               

                </div>

                <?php
                while($data =  $req->fetch())
                {?>

                
                    <div class="form-message">
                        <h4 style="text-align:center"><?php echo "De : ". $data['email']?></h4>
                        <h4><?php echo "Date du message : ".$data['Date_Envoi']?></h4>
                        <h4>Message:</h4>
                        <div class="message">
                            <p><?php echo $data['Message']?></p>
                        <p></p>
                </div>
                </div>
                    <?php }
                    ?>
            
        </div>
    </body>
</html>
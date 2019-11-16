<?php
session_start();
if(isset($_SESSION['mail']))
{

}
else
{
    header('location: ../index.php');
}
require("..\Object_PHP\Admin.php");
require("..\Object_PHP\database.php");
$admin = new Admin(DataBase::connect());
$sql = DataBase::connect()->prepare('SELECT ID_users FROM users');
$sql->execute();
if(isset($_POST['id']))
{
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        while($row = $sql->fetch())
        {
            if($admin->VerifId($_POST['id'],$row['ID_users']) ==  $_POST['id'])
            {
                sleep(2);
                //$_SESSION['modify_admin'] = true;
                $id=$admin->IsSecure($_POST['id']);
                $query = DataBase::connect()->prepare('UPDATE users SET admin = 0 WHERE ID_users = ?');
                $query->execute(array($id));

                header('location: ../Vue_PHP/DashBoard.php');
            }
            else
            {
                echo "<p>Erreur l'ID du User n'existe pas</p>";

            }
        }

    }

    


}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="..\bootstrap\bootstrap-3.3.6\dist\css\bootstrap.min.css">
        <script src="../bootstrap/bootstrap-3.3.6/dist/js/bootstrap.min.js"></script>
        <style>
            #form-style
            {
                background: white;
                margin: 0 auto !important;
                width: 600px;
                height: 300px;
                

            }
            #button
            {
                margin: 0 auto !important;
                text-align:center !important;
            }

        </style>
    </head>
    <body style="background-color:#008080;">
    <a style="color:white" href="../Vue_PHP/DashBoard.php">Retour à DashBoard</a>
        <div class="container">
            
                <div id="form-style">
                    <h2>Veuillez rentrer un ID d'un user qui est dans la BDD</h2>
                    <form method="post" action="<?php $_SERVER['PHP_SELF']?>">
                        <label>Insérez l'id :</label><input type="number" name="id" value="" class="form-control" style="width:400px !important;">
                        <br>
                        <input type="submit" name="envoyer" id="button" class="btn btn-default">
                    </form>
                </div>
            
        </div>
    </body>
</html>
<?php
session_start();
if(isset($_SESSION['email']))
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


   
    
        while($row = $sql->fetch())
        {
            if($admin->VerifId($_SESSION['id'][0],$row['ID_users']) == $_SESSION['id'][0])
            {
                
                //$_SESSION['modify_admin'] = true;
                
                $query = DataBase::connect()->prepare('UPDATE users SET admin = 0 WHERE ID_users = ?');
                $query->execute(array($_SESSION['id'][0]));
                //sleep(2);
                session_destroy();
                header('location: ../index.php');
            }
            else
            {
                echo "<p>Erreur lors de la desinscription</p>";

            }
        }

    


?>
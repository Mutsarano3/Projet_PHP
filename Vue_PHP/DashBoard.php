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
$req = DataBase::connect()->prepare('SELECT * FROM users');
$req->execute();
$sql = DataBase::connect()->prepare('SELECT * FROM materiel');
$sql->execute();
$catagories = DataBase::connect()->prepare('SELECT * FROM categorie');
$catagories->execute();
$commande = DataBase::connect()->prepare('SELECT * FROM commande');
$commande->execute();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ARMShop</title>
    <link href="../style.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="../Js/jquery-3.3.1.min.js"></script>
    <script src="../Js/script.js"></script>
    <link rel="stylesheet" href="../bootstrap/bootstrap-3.3.6/dist/css/bootstrap.min.css">
    <script src="../Js/bootstrap.min.js"></script>
    <style>
    .vueDonne
    {
        background-color: white;
        width: 700px;
        height: 500px;
        display: inline-block;
        border-radius: 10px;
        margin-right: 100px;
        margin-top: 12px;
        float: right;
        max-width: 400px;
    }
     h2
    {
        text-align: center;
    }
    ul
    {
        list-style: none;
    }

     a
    {
        text-decoration: none;
        color: white;
        font-size: 15px;
        transition: 0.5s;

    }
     a:hover
    {
        text-decoration: none;
        color: brown;
        transition: 0.5s;
    }

table
{
    border-collapse: collapse; 
    margin: 0 auto;
    text-align: center;
    background: white;
}
td
{
    border: 1px solid black;
}
.banner
{
    text-align:center;
    font-size:20px;
    background-color:white;
    color:red;
    font-weight:bold;

}
    </style>
<?php
//var_dump($_SESSION);

?>
</head>
<body style="background-color: #008080;">
    <a href="AccueilAdmin.php">Retour accueil</a>
    <div class="container">
    <?php echo "<p class='banner'>Vous êtes l'admin"." ".$admin->RecupId($_SESSION['mail'][0])[0]."</p>"?>
        <div style="float:left;display:inline-block">
            <label style="margin-top:10px;">Matériel : </label>
           <ul>
               <li><a href="../Vue_PHP/AddMateriels.php">Ajouter</a></li>
               <li><a href="../DataTransport/StartSupprHardWare.php">Supprimer</a></li>
               <li><a href="../DataTransport/StartModifyHardWare.php">Modifier</a></li>
           </ul>
           <label>Utilisateur :</label>
           <ul>
                <li><a href="../Vue_PHP/InscriptionUserAdmin.php">Ajouter</a></li>
                <li><a href="../DataTransport/StartBanAdmin.php">Supprimer</a></li>
                <li><a href="../DataTransport/StartModifyAdmin.php">Modifier</a></li>
                <li><a href="../DataTransport/StartDebanAdmin.php">Débannir</a></li>
                <li><a href="../DataTransport/StartChangeMdpUser.php">Changer le mot de passe d'un user</a></li>
           </ul>
           <ul>
           <label>Opération(s) sur compte admin courant :</label>
            <li><a href="../Vue_PHP/ChangerMdpAdmin.php">Changer mot de passe</a></li>
           </ul>
        </div>
        </div>
        
            <h2>DataBase : Vue_Users</h2>
            <table>
            <tr>
                    <td>ID_Users</td>
                    <td>Nom</td>
                    <td>Prénom</td>
                    <td>Email</td>
                    <td>Mot de passe</td>
                    <td>Date de naissance</td>
                    <td>Sexe</td>
                    <td>Solde</td>
                    <td>Pays</td>
                    <td>Code postal</td>
                    <td>Rue</td>
                    <td>EtatAdmin</td>

                </tr>
                <?php
        while ($data = $req->fetch())
        {?>
        
            <tr>
                    <td><?php echo $data['ID_users']?></td>
                    <td><?php echo $data['Nom']?></td>
                    <td><?php echo $data['Prenom']?></td>
                    <td><?php echo $data['Email']?></td>
                    <td><?php echo $data['Mot_de_passe']?></td>
                    <td><?php echo $data['Date_Naissance']?></td>
                    <td><?php echo $data['Sexe']?></td>
                    <td><?php echo $data['Solde']."€"?></td>
                    <td><?php echo $data['Pays']?></td>
                    <td><?php echo $data['Localite']?></td>
                    <td><?php echo $data['Rue']?></td>
                    <td><?php echo $data['admin']?></td>

                </tr>

      <?php  }?>
            </table>
    </div>

  
            <h2>DataBase : Vue_Matériels</h2>
            <table>
                <tr>
                    <td>ID_matériel</td>
                    <td>Nom du matériel</td>
                    <td>Marque</td>
                    <td>Numéro de catégorie</td>
                    <td>Prix</td>
                    <td>Date d'insertion</td>
                    <td>Stock</td>
                    <td>Images</td>
                </tr>
                <?php
                while ($data = $sql->fetch())
        {?>
        
            <tr>
                    <td><?php echo $data['ID_Materiel']?></td>
                    <td><?php echo $data['Nom_Materiel']?></td>
                    <td><?php echo $data['Marque']?></td>
                    <td><?php echo $data['Num_categorie']?></td>
                    <td><?php echo $data['Prix']."€"?></td>
                    <td><?php echo $data['Date_Insert']?></td>
                    <td><?php echo $data['Stock']?></td>
                    <td><?php echo $data['images']?></td>

                </tr>

      <?php  }?>
            </table>
            <h2>Vue_Categorie</h2>
            <table>
                <tr>
                    <td>Num_Categorie</td>
                    <td>Nom_Categorie</td>
                </tr>
                <?php
            while($data = $catagories->fetch())
            {?>

                <tr>
                    <td><?php echo $data['Num_Categorie']?></td>
                    <td><?php echo $data['Nom_Categorie']?></td>
                </tr>
            <?php }?>
            </table>
            <h2>Vue_Commande</h2>
            <table>
            <tr>
                <td>ID_users</td>
                <td>ID_Materiel</td>
                <td>Date_commande</td>
                <td>Num_commande</td>
                <td>Lieux_commande</td>
                
            </tr>
            <?php 
            while($data = $commande->fetch())
            {?>
            <tr>
                <td><?php echo $data['ID_users'] ?></td>
                <td><?php echo $data['ID_Materiel'] ?></td>
                <td><?php echo $data['Date_commande'] ?></td>
                <td><?php echo $data['Num_Commande'] ?></td>
                <td><?php echo $data['lieux_commande'] ?></td>
            </tr>
        <?php


        }?>
            </table>
</body>
</html>
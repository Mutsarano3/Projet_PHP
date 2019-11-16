<?php 

session_start();
require("..\Object_PHP\Admin.php");
require("..\Object_PHP\database.php");
$admin = new Admin(DataBase::connect());
if(isset($_POST['passwd']) and isset($_POST['passwd-confirm']))$admin->ChangeMdpUsers($_POST['passwd'],$_POST['passwd-confirm'],$_SESSION['id_users']);





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
    <style>
        body
        {
            background:orange;
        }
        #form-mdp-users
        {
            background:white;
            margin-top: 150px;
            width : 500px;
            height:300px;
            border-radius:10px;
        }
        h2
        {
            text-align:center;
        }
        
    </style>
    <title>ARMShop</title>
</head>
<body>
<a style="color:white" href="../Vue_PHP/DashBoard.php">Retourner à l'accueil</a>
    <div id="form-mdp-users" class="container-fluid">
    <h2>Changer de mot de passe users</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
            <label>Mot de passe :</label>
            <input type="password" class="form-control" name="passwd" placeholder="Insérez un mot de passe : 4 caractères min, 1 majuscule min, 1 chiffre min">
            <label>Confirmer mot de passe :</label>
            <input type="password" class="form-control" name="passwd-confirm">
            <p class="comments" style="dispay:<?php if($admin->erreurmdp) echo "block"; else echo "none" ?>">Erreur de mot de passe : vos champs ne correspondent pas</p>
            <input style="margin-top:50px;margin-left: 40%" type="submit" class="btn btn-default" value="Envoyer" name="btn-submit">
            
        </form>
    </div>
   
</body>
</html>
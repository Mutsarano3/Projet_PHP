<?php
session_start();
if(isset($_SESSION['prenom']))
{

}
else
{
    header('location: ../index.php');
}
require("..\Object_PHP\Users.php");
require("..\Object_PHP\database.php");
$users = new User(DataBase::connect());
$sql = DataBase::connect()->prepare("UPDATE users SET Solde=? WHERE ID_users = ?");
if(isset($_POST['solde-list']))
{
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $users->RecrediteSolde($_POST['solde-list'],$_SESSION['solde'][0]);
        $_SESSION['solde'][0] =$users->getSolde();
        $sql->execute(array($_SESSION['solde'][0],$_SESSION['id'][0]));
        //sleep(2);
        header('location: ../DataTransport/SoldIsValid.php');
        exit();

    }
}
else
{
    

}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../style.css">
    <link href="../bootstrap/bootstrap-3.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="../bootstrap/bootstrap-3.3.6/dist/js/bootstrap.min.js"></script>
    <title>Votre Compte</title>
    <style>
        #form-solde
        {
            visibility: hidden;
        }
    </style>
</head>
<body id="bg-compte">
    <div>
        <a style="color:white" id="retour" href="../index.php">Retour à l'accueil</a><img src="../images/logo.png" width="20" height="20">
    </div>
        <div  class="container-fluid">
            <div class="row">
                    <div id="profil" style="height:550px;">
                        <div id="mise">
                            <h1>Bienvenue <?php echo $_SESSION['prenom'][0]?></h1>
                            <h4>Informations personnelles</h4>
                            <div class="ligne-grise"></div>
                            <p>
                                <strong>Nom : </strong><?php echo $_SESSION['nom'][0] ?><br>
                                <strong>Prénom : </strong><?php echo $_SESSION['prenom'][0]?><br>
                                <strong>Email: </strong><?php echo $_SESSION['email'][0]?><br>
                                <strong>Date de naissance :</strong><?php echo $_SESSION['date'][0]?><br>
                                <strong>Sexe : </strong><?php if($_SESSION['sexe'][0] == 'h') echo "Homme"; if($_SESSION['sexe'][0] == 'f') echo "Femme";?><br>
                                <strong>Pays : </strong><?php echo $_SESSION['pays'][0];?><br>
                                <strong>Code postal : </strong><?php echo $_SESSION['Localite'][0];?><br>
                                <strong>Rue : </strong><?php echo $_SESSION['rue'][0];?><br>
                                <strong>Votre solde: </strong><?php echo $_SESSION['solde'][0]."€";?><br>
                            </p>
                            <h4>Mot de passe</h4>
                            <div class="ligne-grise"></div>
                            <p>
                                <strong>Voulez-vous changez votre mot de passe ?</strong><br>
                                <a href="../Vue_PHP/ChangeMdp.php">Cliquez-ici pour le changement de mot de passe</a><img src="../images/logo.png" width="20" height="20"></li>
                            </p>
                            <h4>Changer les informations</h4>
                            <div class="ligne-grise"></div>
                            <a href="../DataTransport/StartModify.php">Cliquez-ici pour changer vos informations</a>
                            <h4>Me désinscrire:</h4>
                            <label> Je veux me désinscire</label>
                            <div class="ligne-grise"></div>
                            <a href="../Vue_PHP/Desinscription.php" style="color:red;">Cliquez-ici pour vous désinscrire</a>
                            <h4>Recréditer son solde</h4>
                            <div class="ligne-grise"></div>
                            <label>Je veux recréditer mon solde:</label>
                            <input type="checkbox" name="recre" id="recre" onclick="affiche_form(this)">
                            <form action="<?php $_SERVER['PHP_SELF']?>" method="post" id="form-solde">
                            <label>Votre solde à choisir:</label>
                           
                            <select name="solde-list">
                                <option value="5.00">5€</option>
                                <option value="10.00">10€</option>
                                <option value="20.00">20€</option>
                                <option value="50.00">50€</option>
                                <option value="100.00">100€</option>
                            </select><br>
                            <input type="submit" name="solde-enjoy">
                            </form>

                            
                        </div>
                    </div>
            </div>
        </div>
        <script>
            function affiche_form(x)
            {
                var elem = document.getElementById("form-solde");
                
                if(x.checked == true)
                {
                    
                    elem.style.visibility = "visible";

                }
                else
                {
                   
                    elem.style.visibility = "hidden";

                }

            }
        
        </script>
</body>
</html>
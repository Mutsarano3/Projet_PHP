<?php

    
    require("..\Object_PHP\Users.php");
    require("..\Object_PHP\database.php");
    session_start();
    if(isset($_SESSION['log']))
    {
        header('location: ../Vue_PHP/Acceuil.php');
    }
    $us = new User(DataBase::connect());
   
    if(isset($_POST['log-email']) and isset($_POST['log-mdp']))$us->UserLogin($_POST['log-email'],$_POST['log-mdp'],$us->RecupAdmin($_POST['log-email'])[0],$us->RecupDesinscri($_POST['log-email'])[0]);
    if($us->getIsLog() == true )
    {
        
        $_SESSION['prenom'] = $us->RecupPrenom($_POST['log-email']);
        $_SESSION['email'] = $us->RecupEmail($_POST['log-email']);
        $_SESSION['nom'] = $us->RecupNom($_POST['log-email']);
        $_SESSION['pays'] = $us->RecupPays($_POST['log-email']);
        $_SESSION['sexe'] = $us->RecupSexe($_POST['log-email']);
        $_SESSION['mdp'] =  $us->RecupMdp($_POST['log-email']);
        $_SESSION['id'] = $us->RecupId($_POST['log-email']);
        $_SESSION['Localite'] = $us->RecupLocalite($_POST['log-email']);
        $_SESSION['rue'] = $us->RecupRue($_POST['log-email']);
        $_SESSION['date'] = $us->RecupDate($_POST['log-email']);
        $_SESSION['log'] = $us->getIsLog();
        $_SESSION['solde'] = $us->RecupSolde($_POST['log-email']);
        $_SESSION['ismodify'] = false;
        //sleep(5);
        $error_log = false;
        header('location: ../index.php');
        
        

    }
    else
    {
        $error_log = true;
        

    }
    

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="..\bootstrap\bootstrap-3.3.6\dist\css\bootstrap.min.css">
        <script src="../Projet_PHP/bootstrap/bootstrap-3.3.6/dist/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../style.css">
    </head>
    <body style="background-color:#008080;">
        <div  class="container">
            <form action="<?php $_SERVER['PHP_SELF']?>" method="post" role="form">
                <div class="row">
                
                    <a href="../index.php" style="color:white">Retour</a>
                    
                    
                    
                
                    <div style="width:800px;height:400px;background: white;margin: 0 auto; margin-top:30px;border-radius:10px">
                        <h2 style="text-align:center;">Login ARMShop</h2><br>
                        <div class="ligne-rouge"></div>
                        <label for="log-email" style="margin: 0 auto">Email:</label>
                        <input style="width:500px !important;" id="log-email" name="log-email" type="text" placeholder="Insérez votre email" class="form-control">
                        <label for="log-mdp" style="margin: 0 auto">Mot de passe:</label>
                        <input style="width:500px !important;" id="log-mdp" name="log-mdp" type="password" placeholder="Insérez votre mot de passe" class="form-control">
                        <button type="submit" class="btn btn-default" style="margin-top: 12px;">Enjoy !</button>
                        <?php if($us->getIsLog() == false) echo "<p class='comments'>Si vous avez des problèmes lors de la connexion à votre compte, contactez l'administrateur : thomas.chiarelli@std.heh.be</p>" ?>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>
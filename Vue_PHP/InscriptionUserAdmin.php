<?php
session_start();
if(isset($_SESSION['mail']))
{

}
else
{
    header('location: ../index.php');
}
require("..\Object_PHP\Users.php");
require("..\Object_PHP\Admin.php");
require("..\Object_PHP\database.php");
$users = new User(DataBase::connect());
$admin = new Admin(DataBase::connect());
//var_dump($_SESSION);
if(isset($_SESSION['modify_admin']) and isset($_POST['firstname'])  and isset($_POST['name']) and isset($_POST['pays']) and isset($_POST['Localite']) and isset($_POST['rue']) and isset($_POST['date']) and isset($_POST['sexe']))
    {
        $users->UserUpdate($_POST['firstname'],$_POST['name'],$_POST['sexe'],$_POST['date'],$_POST['pays'],$_POST['Localite'],$_POST['rue']);
        $sql=DataBase::connect()->prepare('UPDATE users SET Nom = ?,Prenom=?,Date_naissance=?,Pays=?,Localite=?,Sexe=?,Rue=? WHERE ID_users=?');
        // UPDATE

    }
    else
    {
        if(isset($_POST['firstname'])  and isset($_POST['name']) and isset($_POST['pays']) and isset($_POST['Localite']) and isset($_POST['rue']) and isset($_POST['date']) and isset($_POST['sexe']) and isset($_POST['passwd'])and isset($_POST['passwd-confirm']) and isset($_POST['mail']))
        {
            $users->UserValid($_POST['mail'],$_POST['firstname'],$_POST['name'],$_POST['sexe'],$_POST['date'],$_POST['passwd'],$_POST['passwd-confirm'],$_POST['pays'],$_POST['Localite'],$_POST['rue']);  //INSERT
            $sql=DataBase::connect()->prepare('INSERT INTO users(Prenom,Nom,Email,Mot_de_passe,Date_Naissance,Sexe,Pays,Localite,Rue) VALUES(?,?,?,?,?,?,?,?,?)');

        }
       
    }

    if(isset($_SESSION['modify_admin']) and $_SESSION['modify_admin'])
    {
       
       
        if($users->isvalid)
        {
            //var_dump($_POST);
            $bon = true;
            $sql->execute(array($users->getNom(),$users->getPrenom(),$users->getDate(),$users->getPays(),$users->getLocalite(),$users->getSexe(),$users->getRue(),$_SESSION['id_users']));
            $users->isNewUser();
            //sleep(5);
            header('location: ../DataTransport/EndModifyAdmin.php');
            exit();
            
        }

    }
    else
    {
        if($users->isvalid == true)
        {
            
         $bon = true;
         $sql->execute(array($users->getPrenom(),$users->getNom(),$users->getEmail(),$users->getMdp(),$users->getDate(),$users->getSexe(),$users->getPays(),$users->getLocalite(),$users->getRue())); //BUG DE LA RUE
         DataBase::disconnect();
         $users->isNewUser();
         //sleep(5);
         header('location: ../Vue_PHP/DashBoard.php');
        exit();
        }

    }







?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php
    if(isset($_SESSION['modify_admin']) and $_SESSION['modify_admin'])
    {
        echo "<title>Modification</title>";
    }
    else
    {
        echo "<title>Inscription ARMShop</title>";

    }
    
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel="stylesheet" href="..\bootstrap\bootstrap-3.3.6\dist\css\bootstrap.min.css">
    <script src="../bootstrap/bootstrap-3.3.6/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../style.css">
</head>
<body style="background-color:#008080;">
    <div class="container">
        <?php

        if(isset($_SESSION['modify_admin']) and $_SESSION['modify_admin'])
        {
            echo "<a style='color:white' href='../DataTransport/EndModifyAdmin.php'>Retourner à la DashBoard</a><img src=..\images\logo.png width=30 height=30>";
        }
        else
        {
            echo "<a style='color:white' href='../Vue_PHP/DashBoard.php'>Retourner à la DashBoard</a><img src=..\images\logo.png width=30 height=30>";
            

        }

        
        
        ?>
        <div id="form" class="container">
            <form action=<?php echo $_SERVER['PHP_SELF'];?> method="post" role="form" id="contact-form">
            <div class="row" style="background-color:white;border-radius:10px;height:500px">
            <?php
            if(isset($_SESSION['modify_admin']) and $_SESSION['modify_admin'])
            {
                echo "<h2 id=titre-inscri>Modification</h2><img src=..\images\logo.png width=30 height=30>";
            }
            else
            {
                echo "<h2 id=titre-inscri>Inscription ARMShop</h2><img src=..\images\logo.png width=30 height=30>";

            }

            ?>
                            <div class="col-md-6">
                                <label for="firstname">Prénom :</label>
                                <input id="firstname" type="text" name="firstname" class="form-control" placeholder="Insérez  prénom en commençant par une maj" value="<?php if($users->prenomErreur == false ) echo $users->getPrenom(); else echo "";if(isset($_SESSION['modify_admin']) and $_SESSION['modify_admin'] == true and empty($_POST['firstname'])) echo $admin->RecupUserPrenom($_SESSION['id_users'])[0] ?>" >
                                <p class="comments" style="display:<?php if($users->prenomErreur == true) echo "block"; else echo "none"?>">Votre champ est vide ou invalide</p>
                            </div>
                            <div class="col-md-6">
                                    <label for="name">Nom :</label>
                                    <input id="name" type="text" name="name" class="form-control" placeholder="Insérez  nom en commençant par une maj" value="<?php if($users->nomErreur == false ) echo $users->getNom(); else echo "";if(isset($_SESSION['modify_admin']) and $_SESSION['modify_admin'] == true and empty($_POST['name'])) echo $admin->RecupUserNom($_SESSION['id_users'])[0]?>" >
                                    <p class="comments" style="display:<?php if($users->nomErreur == true) echo "block"; else echo "none"?>">Votre champ est vide ou invalide</p>
                            </div>

                            
                            <?php
                            if(isset($_SESSION['modify_admin']) and $_SESSION['modify_admin'])
                            {
                                
                               
                                   
                            }
                            else 
                            {
                                if($users->emailErreur)
                                {
                                    $blockem="block";
                                    $noneem="";

                                }
                                else
                                {
                                    $blockem="";
                                    $noneem="none";

                                }
                                if($users->mdpErreur)
                                {
                                    $block="block";
                                    $none="";

                                }
                                else
                                {
                                    $none="none";
                                    $block="";

                                }
                                echo "<div class=col-md-6>
                                <label for='mail'> Email :</label>
                                <input id='mail' type='email' name='mail' class='form-control' placeholder='Insérez un email'  value=''>";
                                echo "<p class='comments' style=display:".$blockem.$noneem.">Votre champ est vide ou invalide ou existe déjà dans la BDD</p><br>";
                                echo "</div>";
                                echo "<div class=col-md-6>
                                <label for='passwd'>Mot de passe :</label>
                                <input id='passwd' type='password' name='passwd' class='form-control' placeholder='Insérez un mot de passe il doit avoir min 4 caractères,1 majuscule,1 chiffre'  value=''>";
                                echo "<p class='comments' style=display:".$block.$none.">Votre champ est vide ou invalide</p><br>";
                                echo "</div>";
                                echo "<div class=col-md-6>
                                <label for='passwd-confirm'> Confirmer Mot de passe :</label>
                                <input id='passwd-confirm' type='password' name='passwd-confirm' class='form-control' placeholder='Confirmer mot de passe'  value=''>";
                                echo "<p class='comments' style=display:".$block.$none.">Votre champ est vide ou invalide ou ne correspond pas avec le mot de passe</p><br>";
                                echo "</div>";
                               
                                
                            }
                            ?>
                            
                            <div class="col-md-6">
                                <label for="sexe">Sexe :</label><br><p style="display:inline-block">Femme</p><input type="radio" name="sexe" value="f" <?php if($users->sexeE == false and $users->getSexe() == "f") echo "checked"; else echo "";if(isset($_SESSION['modify_admin']) and $_SESSION['modify_admin'] == true and $admin->RecupUserSexe($_SESSION['id_users'])[0] == 'f') echo "checked"?>><br>
                                <p style="display:inline-block">Homme</p><input type="radio" name="sexe" value="h" <?php if($users->sexeE == false and $users->getSexe() == "h") echo "checked"; else echo "";if(isset($_SESSION['modify_admin']) and $_SESSION['modify_admin'] == true and $admin->RecupUserSexe($_SESSION['id_users'])[0] == 'h') echo "checked"?>>
                                <p class="comments" style="display:<?php if($users->sexeE == true) echo "block"; else echo "none"?>">Votre champ est vide ou invalide</p>
                           </div>
                           <div class="col-md-6">
                                <label for="pays">Pays : </label>
                                <select name="pays">
                                        <option value="" ></option>
                                        <option <?php if(isset($_SESSION['modify_admin']) and $_SESSION['modify_admin'] == true  and $admin->RecupUserPays($_SESSION['id_users'])[0] == 'BE') echo "selected"?> value="BE" >Belgique</option>
                                        <option <?php if(isset($_SESSION['modify_admin']) and $_SESSION['modify_admin'] == true  and $admin->RecupUserPays($_SESSION['id_users'])[0] == 'FR') echo "selected"?> value="FR">France</option>
                                </select>
                                <p class="comments" style="display:<?php if($users->paysErreur == true) echo "block"; else echo "none"?>">Votre champ est vide ou invalide</p>
                           </div>
                           <div class="col-md-6">
                                <label for="Localite">Code postal : </label>
                                <input id="Localite" type="text" name="Localite" class="form-control" placeholder="Insérez  code postal" value="<?php if($users->localiteErreur == false ) echo $users->getLocalite(); else echo "";if(isset($_SESSION['modify_admin']) and $_SESSION['modify_admin'] == true and empty($_POST['Localite'])) echo $admin->RecupUserLocalite($_SESSION['id_users'])[0]?>" >
                                <p class="comments" style="display:<?php if($users->localiteErreur == true) echo "block"; else echo "none"?>">Votre champ est vide ou invalide</p>
                           </div>
                           <div class="col-md-6">
                                <label for="rue">Rue :</label>
                                <input id="rue" type="text" name="rue" class="form-control" placeholder="Insérez rue" value="<?php if($users->rueE == false ) echo $users->getRue(); else echo "";if(isset($_SESSION['modify_admin']) and $_SESSION['modify_admin'] == true and empty($_POST['name'])) echo $admin->RecupUserRue($_SESSION['id_users'])[0] ?>" >
                                <p class="comments" style="display:<?php if($users->rueE == true) echo "block"; else echo "none"?>">Votre champ est vide ou invalide</p>
                           </div>
                           <div class="col-md-6">
                                <label for="date"> saisir une date de naissance : <span><?php if($users->dateErreur == true) echo "Votre champ est vide ou invalide"; else echo " ";?></span></label><br>
                                <input type="date" id="date" name="date" value="<?php if($users->dateErreur == false ) echo $users->getDate(); else echo "";if(isset($_SESSION['modify_admin']) and $_SESSION['modify_admin'] == true and empty($_POST['date'])) echo $admin->RecupUserDate($_SESSION['id_users'])[0]?>">
                                <p class="comments" style="display:<?php if($users->dateErreur == true) echo "block"; else echo "none"?>">Votre champ est vide ou invalide</p>
                                
                           </div>
                              <p class="comments"></p>        
                
            </div>
            <?php 
    if($users->isvalid == false)
    {
        echo "<p class='comments'>Veuillez-remplir les champs vides</p>";
    }
    ?>
            
            <input  type="submit" name="submit" value="Enjoy !" class="btn btn-default" style="margin-top:10px;">
    </form>
   
    
        </div>
</body>
        
</html>


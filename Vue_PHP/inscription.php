
<?php
session_start();
$bon = false;
if(!$bon)
{
    
   
    require("..\Object_PHP\Users.php");
    require("..\Object_PHP\database.php");
    $users = new User(DataBase::connect());
    if(isset($_SESSION['ismodify']) and  isset($_POST['firstname']) and isset($_POST['name']) and isset($_POST['pays']) and isset($_POST['Localite']) and isset($_POST['rue']) and isset($_POST['date']) and isset($_POST['sexe']) and $_SESSION['ismodify'])
    {
        $users->UserUpdate($_POST['firstname'],$_POST['name'],$_POST['sexe'],$_POST['date'],$_POST['pays'],$_POST['Localite'],$_POST['rue']);
        $sql=DataBase::connect()->prepare('UPDATE users SET Nom = ?,Prenom=?,Date_naissance=?,Pays=?,Localite=?,Sexe=?,Rue=? WHERE ID_users=?');
        // UPDATE

    }
    else
    {
        if(isset($_POST['firstname'])   and isset($_POST['name']) and isset($_POST['pays']) and isset($_POST['Localite']) and isset($_POST['rue']) and isset($_POST['date']) and isset($_POST['sexe']) and isset($_POST['passwd']) and isset($_POST['passwd-confirm']) and isset($_POST['mail']))
        {
            $users->UserValid($_POST['mail'],$_POST['firstname'],$_POST['name'],$_POST['sexe'],$_POST['date'],$_POST['passwd'],$_POST['passwd-confirm'],$_POST['pays'],$_POST['Localite'],$_POST['rue']);
            var_dump($users);
             //INSERT
            $sql=DataBase::connect()->prepare('INSERT INTO users(Prenom,Nom,Email,Mot_de_passe,Date_Naissance,Sexe,Pays,Localite,Rue) VALUES(?,?,?,?,?,?,?,?,?)');

        }
        else
        {
            
        }
       
    }
?>
<?php
    if(isset($_SESSION['ismodify']) and $_SESSION['ismodify'])
    {
       
       
        if($users->isvalid)
        {
            var_dump($_POST);
            $bon = true;
            $_SESSION['prenom'][0] = $users->getPrenom();
            $_SESSION['nom'][0] = $users->getNom();
            $_SESSION['pays'][0] = $users->getPays();
            $_SESSION['sexe'][0] = $users->getSexe();
            $_SESSION['Localite'][0] = $users->getLocalite();
            $_SESSION['date'][0] = $users->getDate();
            $_SESSION['rue'][0] = $users->getRue();
            $sql->execute(array($users->getNom(),$users->getPrenom(),$users->getDate(),$users->getPays(),$users->getLocalite(),$users->getSexe(),$users->getRue(),$_SESSION['id'][0]));
            $users->isNewUser();
            
            header('location: ../Vue_PHP/Profil.php');
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
         header('location: ../index.php');
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
    if( isset($_SESSION['ismodify']) and $_SESSION['ismodify'])
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
    <script src="../Projet_PHP/bootstrap/bootstrap-3.3.6/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../style.css">
</head>
<body style="background-color:#008080;">
    <div class="container">
        <?php

        if(isset($_SESSION['ismodify']) and $_SESSION['ismodify'])
        {
            echo "<a style='color:white' href='../DataTransport/EndModify.php'>Retourner au profil</a><img src=..\images\logo.png width=30 height=30>";
        }
        else
        {
            echo "<a style='color:white' href='../index.php'>Retourner à l'accueil</a><img src=..\images\logo.png width=30 height=30>";
            

        }

        
        
        ?>
        <div id="form" class="container">
            <form action=<?php echo $_SERVER['PHP_SELF'];?> method="post" role="form" id="contact-form">
            <div class="row" style="background-color:white;border-radius:10px;height:500px">
            <?php
            if(isset($_SESSION['ismodify']) and $_SESSION['ismodify'])
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
                                <input id="firstname" type="text" name="firstname" class="form-control" placeholder="Insérez votre prénom en commençant par une maj" value="<?php if($users->prenomErreur == false ) echo $users->getPrenom(); else echo "";if(isset($_SESSION['ismodify']) and $_SESSION['ismodify'] == true and empty($_POST['firstname']) and isset($_SESSION['prenom'][0])) echo $_SESSION['prenom'][0] ?>" >
                                <p class="comments" style="display:<?php if($users->prenomErreur == true) echo "block"; else echo "none"?>">Votre champ est vide ou invalide</p>
                                
                            </div>
                            <div class="col-md-6">
                                    <label for="name">Nom :</label>
                                    <input id="name" type="text" name="name" class="form-control" placeholder="Insérez votre nom en commençant par une maj" value="<?php if($users->nomErreur == false ) echo $users->getNom(); else echo "";if(isset($_SESSION['ismodify']) and $_SESSION['ismodify'] == true and empty($_POST['name']) and isset($_SESSION['nom'][0])) echo $_SESSION['nom'][0]?>" >
                                    <p class="comments" style="display:<?php if($users->nomErreur == true) echo "block"; else echo "none"?>">Votre champ est vide ou invalide</p>
                            </div>

                            
                            <?php
                            if(isset($_SESSION['ismodify']) and $_SESSION['ismodify'])
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
                                <input id='mail' type='email' name='mail' class='form-control' placeholder='Insérez votre Email'  value=''>";
                                echo "<p class='comments' style=display:".$blockem.$noneem.">Votre champ est vide ou invalide ou il existe déjà/p><br>";
                                echo "</div>";
                                echo "<div class=col-md-6>
                                <label for='passwd'>Mot de passe :</label>
                                <input id='passwd' type='password' name='passwd' class='form-control' placeholder='Votre mot de passe > 4 caractères & 1Maj minimum & 1 Chiffre Mini'  value=''>";
                                echo "<p class='comments' style=display:".$block.$none.">Votre champ est vide ou invalide</p><br>";
                                echo "</div>";
                                echo "<div class=col-md-6>
                                <label for='passwd-confirm'> Confirmer mot de passe :</label>
                                <input id='passwd-confirm' type='password' name='passwd-confirm' class='form-control' placeholder='Confirmer votre mot de passe'  value=''>";
                                echo "<p class='comments' style=display:".$block.$none.">Votre champ est vide ou invalide ou alors ne correspond pas avec le mot de passe</p><br>";
                                echo "</div>";
                               
                                
                            }
                            ?>
                            
                            <div class="col-md-6">
                                <label for="sexe">Sexe :</label><br><p style="display:inline-block">Femme</p><input type="radio" name="sexe" value="f" <?php if($users->sexeE == false and $users->getSexe() == "f") echo "checked"; else echo "";if(isset($_SESSION['ismodify']) and $_SESSION['ismodify'] == true  and isset($_SESSION['sexe'][0]) and $_SESSION['sexe'][0] == 'f') echo "checked"?>><br>
                                <p style="display:inline-block">Homme</p><input type="radio" name="sexe" value="h" <?php if($users->sexeE == false and $users->getSexe() == "h") echo "checked"; else echo "";if(isset($_SESSION['ismodify']) and $_SESSION['ismodify'] == true  and isset($_SESSION['sexe'][0]) and $_SESSION['sexe'][0] == 'h') echo "checked"?>>
                                <p class="comments" style="display:<?php if($users->sexeE == true) echo "block"; else echo "none"?>">Votre champ est vide ou invalide</p>
                           </div>
                           
                           <div class="col-md-6">
                                <label for="pays">Pays : </label>
                                <select name="pays">
                                        <option value="" ></option>
                                        <option <?php if(isset($_SESSION['ismodify']) and $_SESSION['ismodify'] == true  and isset($_SESSION['pays'][0]) and $_SESSION['pays'][0] == 'BE') echo "selected"?> value="BE" >Belgique</option>
                                        <option <?php if(isset($_SESSION['ismodify']) and $_SESSION['ismodify'] == true  and isset($_SESSION['pays'][0]) and $_SESSION['pays'][0] == 'FR') echo "selected"?> value="FR">France</option>
                                </select>
                                <p class="comments" style="display:<?php if($users->paysErreur == true) echo "block"; else echo "none"?>">Votre champ est vide ou invalide</p>
                           </div>
                           <div class="col-md-6">
                                <label for="Localite">Code postal : </label>
                                <input id="Localite" type="text" name="Localite" class="form-control" placeholder="Insérez votre code postal" value="<?php if($users->localiteErreur == false ) echo $users->getLocalite(); else echo "";if(isset($_SESSION['ismodify']) and $_SESSION['ismodify'] == true and empty($_POST['Localite']) and isset($_SESSION['Localite'][0])) echo $_SESSION['Localite'][0]?>" >
                                <p class="comments" style="display:<?php if($users->localiteErreur == true) echo "block"; else echo "none"?>">Votre champ est vide ou invalide</p>
                           </div>
                           <div class="col-md-6">
                                <label for="rue">Rue :</label>
                                <input id="rue" type="text" name="rue" class="form-control" placeholder="Insérez votre rue,elle doit contenir une majuscule et votre numéro de maison" value="<?php if($users->rueE == false ) echo $users->getRue(); else echo "";if(isset($_SESSION['ismodify']) and $_SESSION['ismodify'] == true and empty($_POST['rue']) and isset($_SESSION['rue'][0])) echo $_SESSION['rue'][0]?>" >
                                <p class="comments" style="display:<?php if($users->rueE == true) echo "block"; else echo "none"?>">Votre champ est vide ou invalide</p>
                           </div>
                           <div class="col-md-6">
                                <label for="date">Veuillez saisir votre date de naissance : <span><?php if($users->dateErreur == true) echo "Votre champ est vide ou invalide"; else echo " ";?></span></label><br>
                                <input type="date" id="date" name="date" value="<?php if($users->dateErreur == false ) echo $users->getDate(); else echo "";if(isset($_SESSION['ismodify']) and $_SESSION['ismodify'] == true and empty($_POST['date']) and isset($_SESSION['date'][0])) echo $_SESSION['date'][0]?>">
                                <p class="comments" style="display:<?php if($users->dateErreur == true) echo "block"; else echo "none"?>">Erreur date</p>
                                
                           </div>
                             
                 
            </div>
            <input  type="submit" name="submit" value="Enjoy !" class="btn btn-default" style="margin-top:10px;">
            <p class="comments" style="display: <?php if($users->isvalid == false) echo "block"; else echo "none" ?>">Veuillez remplir les champs vides</p>
            <?php 

           
            ?>        

            
            
    </form>
    
        </div>
        <?php
        
        
}?>
</body>
        
</html>


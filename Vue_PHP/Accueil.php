<?php

session_start();
require("..\Object_PHP\database.php");
require("..\Object_PHP\Users.php");
require("..\Object_PHP\HardWare.php");
$user = new User(DataBase::connect());
$hardware = new HardWare(DataBase::connect());






if(isset($_GET['Arduino']))
{

    $req = DataBase::connect()->prepare('SELECT * FROM materiel WHERE Num_Categorie=?');
    $req->execute(array(1));
    $sql = DataBase::connect()->prepare('SELECT Nom_Categorie FROM categorie NATURAL JOIN materiel WHERE Num_Categorie = ?');
    
    
    

}
else if(isset($_GET['RaspBerrys']))
{
    $req = DataBase::connect()->prepare('SELECT * FROM materiel WHERE Num_Categorie=?');
    $req->execute(array(2));
    $sql = DataBase::connect()->prepare('SELECT Nom_Categorie FROM categorie NATURAL JOIN materiel WHERE Num_Categorie = ?');
   

}
else if(isset($_GET['MControleur']))
{
    $req = DataBase::connect()->prepare('SELECT * FROM materiel WHERE Num_Categorie=?');
    $req->execute(array(3));
    $sql = DataBase::connect()->prepare('SELECT Nom_Categorie FROM categorie NATURAL JOIN materiel WHERE Num_Categorie = ?');
    

}
else if(isset($_GET['Capteurs']))
{
    $req = DataBase::connect()->prepare('SELECT * FROM materiel WHERE Num_Categorie=?');
    $req->execute(array(4));
    $sql = DataBase::connect()->prepare('SELECT Nom_Categorie FROM categorie NATURAL JOIN materiel WHERE Num_Categorie = ?');
    

}

else if(isset($_GET['Tous']))
{
    $sql = DataBase::connect()->prepare('SELECT Nom_Categorie FROM categorie NATURAL JOIN materiel WHERE Num_Categorie = ?');
    $req = DataBase::connect()->prepare('SELECT * FROM materiel');
    $req->execute();
    

}
else
{
    $sql = DataBase::connect()->prepare('SELECT Nom_Categorie FROM categorie NATURAL JOIN materiel WHERE Num_Categorie = ?');
    $req = DataBase::connect()->prepare('SELECT * FROM materiel');
    $req->execute();
    //var_dump($_GET);
}

if(isset($_POST['achat']))
{
    if(isset($_POST['id_mat']) and isset($_POST['nom_mat']) and isset($_POST['prix_mat']) and isset($_POST['stock_mat']) and isset($_POST['images_mat']) and isset($_POST['marque_mat']))
    {
        $hardware->verifHardWare($_POST['id_mat'],$_POST['nom_mat'],$_POST['marque_mat'],$_POST['prix_mat'],$_POST['stock_mat'],$_POST['images_mat']);
        
        if($hardware->isValid)
        {
            
            $_SESSION['id_mat'] = $hardware->getId();
            $_SESSION['nom_mat'] = $hardware->getNom();
            $_SESSION['marque_mat'] = $hardware->getMarque();
            $_SESSION['prix_mat'] = $hardware->getPrix();
            $_SESSION['stock_mat'] = $hardware->getStock();
            $_SESSION['images_mat'] = $hardware->getImages();

            //sleep(2);
            header('location: ../Vue_PHP/PayHardWare.php');

        }
        else
        {
            echo "une erreur";
        }
        

      
        
    }
    
}
else if(isset($_POST['panier']))
{
    if(isset($_POST['id_mat']) and isset($_POST['nom_mat']) and isset($_POST['prix_mat']) and isset($_POST['stock_mat']) and isset($_POST['images_mat']) and isset($_POST['marque_mat']))
    {
        $hardware->verifHardWare($_POST['id_mat'],$_POST['nom_mat'],$_POST['marque_mat'],$_POST['prix_mat'],$_POST['stock_mat'],$_POST['images_mat']);
        if($hardware->isValid)
        {
            $_SESSION['id_mat'] = $hardware->getId();
            $_SESSION['nom_mat'] = $hardware->getNom();
            $_SESSION['marque_mat'] = $hardware->getMarque();
            $_SESSION['prix_mat'] = $hardware->getPrix();
            $_SESSION['stock_mat'] = $hardware->getStock();
            $_SESSION['images_mat'] = $hardware->getImages();
            $panier = DataBase::connect()->prepare('INSERT INTO panier(ID_Materiel,ID_users) VALUES(?,?) ');
            $panier->execute(array($_SESSION['id_mat'],$_SESSION['id'][0]));
            //sleep(2);
            header('location: ../Vue_PHP/Accueil.php');
        }
    }

}



$a = 0;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ARMShop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel="stylesheet" href="../bootstrap/bootstrap-3.3.6/dist/css/bootstrap.min.css">
    <script src="../bootstrap/bootstrap-3.3.6/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../style.css">
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="60">
    <style>
        #btn-sr:hover
        {
            transition: 1s;
            background-color:firebrick !important;

        }
        #btn-sr
        {
            transition: 1s;
        }

        .produit
        {
            width: 300px;
            height:400px;
            background-color:#008080;
            display: inline-block;
            text-align:center;
            margin-left:10px;
            margin-top: 5px;
            margin-bottom: 5px;
           
        }
        .produit a
        {
            margin-top:5px;
            margin-bottom:5px;
        }
        .produit img
        {
            margin-top:5px;
        }

        .achat
        {
            margin-bottom:5px;
        }
        
    </style>
        <!--BEGIN NAV-->
        <header>
            <nav  id="nav"  class="navbar navbar-default navbar-fixed-top">
                <div  class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mynavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        </button>
                        <div  class="collapse navbar-collapse" id="mynavbar">
                            <ul  class="nav navbar-nav">
                              <li class="logo"><h1><span id="blanc">ARM</span><span id="gris">Shop</span><img src="../images/logo.png" width="30" height="30"></h1></li>
                               <?php
                               if(isset($_SESSION['log']) and $_SESSION['log'] == true)
                               {
                                   echo "<li><a class=decort-menu href=Message_User.php>Contactez l'admin</a></li>
                                   <li><a href='../Vue_PHP/AnnoncePage.php'  class=decort-menu>Annonces</a></li>";

                               }
                               else
                               {
                                   echo "<li><a class=decort-menu href=inscription.php>Inscription</a></li>";
                               }
                               ?>
                                
                                <?php
                                 if(isset($_SESSION['log']) and $_SESSION['log'] == true)
                                 {
                                     echo "<li><a class=decort-menu href='..\DataTransport\deconnexion.php'>Déconnexion</a></li>";
                                    

                                 }
                                 else
                                 {
                                    echo "<li><a class=decort-menu href=login.php>Connexion</a></li>";
                                 }
                                ?>
                                <?php

                                    if(isset($_SESSION['log']) and $_SESSION['log'] == true)
                                    {
                                        echo "<li><a class=decort-menu href='Profil.php'>Votre compte</a></li>
                                        <li><a href='Commande.php' class='decort-menu'> Vos commandes</a></li>";
                                       
                                    

                                    }
                                    else
                                    {
                                    
                                    }
                                ?>
                                <div class="dropdown">
                                        <button  class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <span id="drow-menu">Catégories</span>
                                        <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                            <form acion="<?php $_SERVER['PHP_SELF']?>" method="GET">
                                                <li><input class="btn btn-default" type="submit" name="Tous" value="Tous les composants"></li>
                                                <li><input class="btn btn-default" type="submit" name="Arduino" value="Arduino"></li>
                                                <li><input class="btn btn-default" type="submit" name="RaspBerrys" value="RaspBerry"></li>
                                                <li><input class="btn btn-default" type="submit" name="MControleur" value="MicroControleurs"></li>
                                                <li><input class="btn btn-default" type="submit" name="Capteurs" value="Capteurs"></li>
                                            </form>
                                        </ul>
                                    </div>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php

                if(isset($_SESSION['log']) and $_SESSION['log'] == true)
                {
                    echo "<div id='panier-block'>
                            <a id='Panier' href='../Vue_PHP/Panier.php'><span id='icon'class='glyphicon glyphicon-shopping-cart'>Panier</span></a>
                         </div>";
                    echo "<p style='color:white'>Solde :".$_SESSION['solde'][0]."€ </p>";
                }
                else
                {

                }
                ?>
                
                <!--END NAV-->
            </nav>

            <!-- BEGIN BANNIERE Carousel-->
            
            <div class="container">
                    <div id="block">
                            <div style="background: url(../images/acceuil.jpg) ; height: 580px; max-width: 100% ">
                                <div class="overlay">
                                    <div class="container">
                                        <h2 class="logo">Bonjour, nous vous souhaitons la bienvenue sur<br> <span id="blanc">ARM</span><span id="gris">Shop</span><img src="../images/logo.png" width="30" height="30"><br>
                                        Le site de vente d'Arduino, Raspberry et  capteurs de qualités !<br>
                                    Rejoignez-nous ! </h2> <br>
                                            <div id="search" class="container">
                                                <label for="search-in"><span id="search-ine">Recherche :</span></label>
                                                <input name="search-in" id="search-in" type="text" value="" placeholder="Entrez votre recherche" style="width:200px !important" >
                                                <button id="btn-sr"  class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                                            </div>
                                    </div>
                                </div>
                            </div>
                   </div>  
            </div>
            <!-- END BANNIERE Carousel-->
        </header>

        <!-- BEGIN Barre Search-->
        
        <h2 style="text-align:center">Nos composants</h2>
        <!-- END Barre Search-->

        
        
       <?php

      
      
       $a =0;
        while ($data = $req->fetch())
       {
           $a++;   
        ?>


        <?php
        $sql->execute(array($data['Num_categorie']));
        $cat=$sql->fetch()

        ?>

      
            <div class="produit">
            <img src="../imagesAdmin/<?php echo $data['images']?>" alt="<?php echo $data['Nom_Materiel']?>" width="200" height="200" >
            <p><strong><?php echo $data['Nom_Materiel']?></strong><br>
            By <strong><?php echo  $data['Marque']?></strong><br>
            Prix : <strong><?php echo  $data['Prix']."€"?></strong><br>
            Stock : <strong><?php echo $data['Stock']?></strong><br>
            Catégorie : <strong><?php echo $cat['Nom_Categorie'] ?></strong><br>
            <?php
            
            if(isset($_SESSION['log']) and $_SESSION['log'] == true and $data['Stock']!=0)
            {
                
                echo "<form action='".$_SERVER['PHP_SELF']."' method='post'>
                      <input  type='submit' class='btn btn-default achat' value='Achetez-le !' name='achat'><br>
                      <input type='submit' class='btn btn-default' value='Ajouter au panier' name='panier'><br>
                      <input type='hidden' name='id_mat' value='".$data['ID_Materiel']."'>
                      <input type='hidden' name='nom_mat' value='".$data['Nom_Materiel']."'>
                      <input type='hidden' name='prix_mat' value='".$data['Prix']."'>
                      <input type='hidden' name='stock_mat' value='".$data['Stock']."'>
                      <input type='hidden' name='marque_mat' value='".$data['Marque']."'>
                      <input type='hidden' name='images_mat' value='".$data['images']."'>
                      </form>";
                     
            }
            
            else if(isset($_SESSION['log']) and $_SESSION['log'] == true and $data['Stock'] ==0)
            {
                echo "<p style ='color:red;'>Le produit ci-dessus n'est plus de stock ou a été retiré par l'administrateur<p>";

            }
            else
            {
                echo "<p style ='color:red;'>Veuillez avoir un compte et être connecté pour acheter ce produit<p>";
            }
           
            
            

            
            ?>
        </p>
            </div>
            
        <?php 
    }
    if($a == 0)echo "<h3 style='text-align:center'>Aucun composant :(</h3>";
    ?>
        <footer style="height:150px;background-color:#333;margin-top:20px;">
            
       <h1 style="text-align:center;padding-top:10px;" class="logo"><span id="blanc">ARM</span><span id="gris">Shop</span><img src="../images/logo.png" width="30" height="30"></h1>
       <p style="text-align:center;color:white">Copyright Chiarelli Thomas®</p>

        </footer>
    </body>
</html>
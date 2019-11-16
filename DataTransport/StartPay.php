<?php

session_start();
require("..\Object_PHP\database.php");
$req = DataBase::connect()->prepare('INSERT INTO commande(ID_users,ID_Materiel,lieux_commande) VALUES(?,?,?)');
$sql = DataBase::connect()->prepare('UPDATE materiel SET Stock=Stock-1 WHERE ID_Materiel=?');
$solde = DataBase::connect()->prepare('UPDATE users SET Solde=? WHERE ID_users=?');
$req->execute(array($_SESSION['id'][0],$_SESSION['id_mat'],$_SESSION['pays'][0].",".$_SESSION['Localite'][0].",".$_SESSION['rue'][0]));
$sql->execute(array($_SESSION['id_mat']));
$tempo = $_SESSION['solde'][0];
$_SESSION['solde'][0] = $tempo - $_SESSION['prix_mat'];
$solde->execute(array($_SESSION['solde'][0],$_SESSION['id'][0]));
//sleep(1);
header('location: ../DataTransport/EndPay.php');


?>
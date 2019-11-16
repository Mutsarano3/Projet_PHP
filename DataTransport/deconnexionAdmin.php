<?php

session_start();
/*unset($_SESSION['mail']);
unset($_SESSION['Ident']);
unset($_SESSION['passwd']);
unset($_SESSION['isLog']);
sleep(4);*/
session_destroy();
header('location: ../Vue_PHP/AccueilAdmin.php');


?>
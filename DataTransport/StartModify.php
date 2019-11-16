<?php
session_start();
$_SESSION['ismodify'] = true;
//sleep(2);
header('location: ../Vue_PHP/inscription.php');
?>
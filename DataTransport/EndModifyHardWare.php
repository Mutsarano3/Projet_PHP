<?php

session_start();
$_SESSION['modify_hardware'] = false;
//session_unset($_SESSION['modify_hardware']);
//session_unset($_SESSION['id_materiel']);
//sleep(2);
header('location: ../Vue_PHP/DashBoard.php');








?>
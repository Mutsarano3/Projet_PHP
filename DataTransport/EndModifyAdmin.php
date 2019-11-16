<?php
session_start();
$_SESSION['modify_admin'] = false;
//sleep(2);
header('location: ../Vue_PHP/DashBoard.php');

?>
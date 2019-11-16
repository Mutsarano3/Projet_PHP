

<?php


session_start();
$_SESSION['log'] = false;

session_destroy();
//sleep(4);
header('location: ../index.php');

?>
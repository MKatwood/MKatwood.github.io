<?php
$pagina = "logout.php";

session_start();

// Unset all of the session variables.
$_SESSION = array();

// Finally, destroy the session.
session_destroy();

setcookie ('PHPSESSID','0', time()+1);

/*
$_SESSION['usuario_id'] = null;
$_SESSION['usuario_nombre'] = null;
$_SESSION['usuario_tipo'] = null;
*/
header("location: index.php");

?>
<?php
session_set_cookie_params(3600*24*30); //Un mes de vida para la sesion
session_start();

$usuarioid = 0;
$usuarionombre = "";
$usuariotipo = "";

if (isset($_SESSION['usuario_id'])) $usuarioid = $_SESSION['usuario_id'];
if (isset($_SESSION['usuario_nombre'])) $usuarionombre = $_SESSION['usuario_nombre'];
if (isset($_SESSION['usuario_tipo'])) $usuariotipo = $_SESSION['usuario_tipo'];


if ($pagina != "login.php" && $usuarioid == 0) {
	header("location: index.php");
}

?>
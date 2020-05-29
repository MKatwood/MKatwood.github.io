<?php

/*********************************
* VerificarUsuario($link, $mail, $password)
*  -> $link : conexion a la base de datos
*  -> $mail : mail del usuario que se loguea
*  -> $password : password del usuario que se loguea
*  <- id del cliente
*  <- nombre del cliente
**********************************/
function VerificarUsuario($link, $mail, $password){
	$id = 0;
	$nombre = "";
	$tipo = "";
	$empresa = "";
	$mail = stripslashes($mail);
	$password = stripslashes($password);
	$mail = $link->real_escape_string($mail);
	$password = $link->real_escape_string($password);
	$sql = "SELECT u.* FROM usuarios u WHERE email = '" . $mail . "' AND clave = '" . $password . "';";
	//echo $sql;
	//die();
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	if($row = mysqli_fetch_array($rs)) {
		$id = $row["id_usuario"];
		$nombre = $row["nombre"];
		$tipo = $row["id_tipo_usuario"];
	}
	return array($id, $nombre, $tipo);
}

?>
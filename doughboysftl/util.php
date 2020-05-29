<?php
header("Content-Type: text/html;charset=utf-8");
include_once( "clases/class.inputfilter.php" );

/* TIPOS DE USUARIO */
define("ADMIN", 1);
define("SOCIO", 2);

define("INGRESO", 1);
define("VENTA", 2);
define("RETIRO", 3);
define("EXCEDENTE", 4);
define("PERDIDO", 5);
define("PAGO", 6);
define("DEVOLUCION", 7);

date_default_timezone_set("America/Argentina/Cordoba");

$ifilter = new InputFilter();
$_POST = $ifilter->process($_POST);
$_GET = $ifilter->process($_GET);

function Limpiar($link, $metodo, $parametro, $default = 0){
	if ($metodo == "GET") {
		$variable = isset($_GET[$parametro]) ? $_GET[$parametro] : $default;
	} else {
		$variable = isset($_POST[$parametro]) ? $_POST[$parametro] : $default;
	}
	$variable = htmlspecialchars($variable);
	/*
	$variable = htmlentities($variable);
	$variable = urldecode($variable);
	$variable = utf8_decode($variable);
	*/
	$variable = $link->real_escape_string($variable);
	return $variable;
}

function ConvertDate($d){
	if (!$d) return $d;
	$datetmp = explode(' ', $d);
	$datetmp = str_replace('-', '/', $datetmp);
	$datetmp = explode('/', $datetmp[0]);
	$n = $datetmp[2].'-'.$datetmp[1].'-'.$datetmp[0];
	return $n;
}

function DecodificarTexto($valor) {

	$valor = str_replace("___u___", "ü", $valor);
	$valor = str_replace("___U___", "Ü", $valor);
	$valor = str_replace("__a__", "á", $valor);
	$valor = str_replace("__e__", "é", $valor);
	$valor = str_replace("__i__", "í", $valor);
	$valor = str_replace("__o__", "ó", $valor);
	$valor = str_replace("__u__", "ú", $valor);
	$valor = str_replace("__n__", "ñ", $valor);
	$valor = str_replace("__A__", "Á", $valor);
	$valor = str_replace("__E__", "É", $valor);
	$valor = str_replace("__I__", "Í", $valor);
	$valor = str_replace("__O__", "Ó", $valor);
	$valor = str_replace("__U__", "Ú", $valor);
	$valor = str_replace("__N__", "Ñ", $valor);

	return $valor;

}

function EnviarMail($subject, $mailfrom, $mailto, $namefrom, $message) {
	/*
	Formato $mailto
	Usuario <usuario@example.com>, Otro usuario <otrousuario@example.com>
	*/
	$headers = "From: ".$namefrom." <".$mailfrom.">" . "\r\n" . "Reply-To: " . $mailfrom;
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
	if (strtolower($_SERVER['SERVER_NAME']) != "localhost") {
		mail($mailto, $subject, $message, $headers);
	}
}

function Paginado($pagina, $total_paginas, $href, $params){
		
		if ($pagina <= $total_paginas && $total_paginas > 1) { ?>
		<nav>
			<ul class="pagination">
				<li class="<?php if($pagina == 1) echo "disabled"; ?>">
					<a href="?p=<?php echo $pagina - 1; ?><?php echo $params; ?>" aria-label="Previous">
						<span aria-hidden="true">&laquo;</span>
					</a>
				</li>
				
				<?php if ($pagina > 4 && $pagina == $total_paginas) { ?>
				<li><a href="?p=<?php echo $pagina - 4; ?><?php echo $params; ?>"><?php echo $pagina - 4; ?></a></li>
				<li><a href="?p=<?php echo $pagina - 3; ?><?php echo $params; ?>"><?php echo $pagina - 3; ?></a></li>
				<?php } ?>
				<?php if ($pagina > 3 && $pagina == $total_paginas-1) { ?>
				<li><a href="?p=<?php echo $pagina - 3; ?><?php echo $params; ?>"><?php echo $pagina - 3; ?></a></li>
				<?php } ?>

				<?php if ($pagina > 2) { ?>
				<li><a href="?p=<?php echo $pagina - 2; ?><?php echo $params; ?>"><?php echo $pagina - 2; ?></a></li>
				<?php } ?>
				<?php if ($pagina > 1) { ?>
				<li><a href="?p=<?php echo $pagina - 1; ?><?php echo $params; ?>"><?php echo $pagina - 1; ?></a></li>
				<?php } ?>
				<li class="active"><a href="#"><?php echo $pagina; ?></a></li>
				<?php if ($pagina < $total_paginas) { ?>
				<li><a href="?p=<?php echo $pagina + 1; ?><?php echo $params; ?>"><?php echo $pagina + 1; ?></a></li>
				<?php } ?>
				<?php if ($pagina + 1 < $total_paginas) { ?>
				<li><a href="?p=<?php echo $pagina + 2; ?><?php echo $params; ?>"><?php echo $pagina + 2; ?></a></li>
				<?php } ?>
				
				<?php if ($pagina == 1 && $total_paginas > 4) { ?>
				<li><a href="?p=<?php echo $pagina + 3; ?><?php echo $params; ?>"><?php echo $pagina + 3; ?></a></li>
				<li><a href="?p=<?php echo $pagina + 4; ?><?php echo $params; ?>"><?php echo $pagina + 4; ?></a></li>
				<?php } ?>
				<?php if ($pagina == 2 && $total_paginas > 4) { ?>
				<li><a href="?p=<?php echo $pagina + 3; ?><?php echo $params; ?>"><?php echo $pagina + 3; ?></a></li>
				<?php } ?>
				
				<li class="<?php if($pagina == $total_paginas) echo "disabled"; ?>">
					<a href="?p=<?php echo $pagina + 1; ?><?php echo $params; ?>" aria-label="Next">
						<span aria-hidden="true">&raquo;</span>
					</a>
				</li>
			</ul>
		</nav>
		<?php }

}

// backup_tables('servidor','usuario','contrasena','bd');


/* backup the db OR just a table */
//En la variable $talbes puedes agregar las tablas especificas separadas por comas:
//profesor,estudiante,clase
//O déjalo con el asterisco '*' para que se respalde toda la base de datos

function BackupTables($link, $tables = '*') {
	// $link = mysql_connect($host,$user,$pass);
	// mysql_select_db($name,$link);
	$return = "";
	//get all of the tables
	if($tables == '*') {
		$tables = array();
		$result = $link->query('SHOW TABLES');
		while($row = mysqli_fetch_row($result)) {
			$tables[] = $row[0];
		}
	} else {
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}
	//cycle through
	foreach($tables as $table) {
		$result = $link->query('SELECT * FROM '.$table);
		$num_fields = mysqli_num_fields($result);

		$return .= 'DROP TABLE IF EXISTS '.$table.';';
		$row2 = mysqli_fetch_row($link->query('SHOW CREATE TABLE '.$table));
		$return .= "\n\n".$row2[1].";\n\n";
		
		for ($i = 0; $i < $num_fields; $i++) {
			while($row = mysqli_fetch_row($result)) {
				$return.= 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j<$num_fields; $j++) {
					$row[$j] = addslashes($row[$j]);
					$row[$j] = preg_replace("/\n/","\\n",$row[$j]);
					//$row[$j] = ereg_replace("\n","\\n",$row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					if ($j<($num_fields-1)) { $return.= ','; }
				}
				$return .= ");\n";
			}
		}
		$return .= "\n\n\n";
	}
	//save file
	$archivo = 'backup/backup-almacen-' . date('Y-m-d-h-i-s') . '.sql';
	$handle = fopen($archivo, 'w+');
	fwrite($handle, $return);
	fclose($handle);
	return $archivo;
}
?>
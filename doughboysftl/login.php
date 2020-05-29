<?php
$pagina = "login.php";

include "sesion.php";
include "conexion.php";
include "util.php";
include "util-usuarios.php";

$crearpass = false;
$debug = Limpiar($link, "GET", "debug", "");
//$admin = Limpiar($link, "GET", "admin", 0);

if ($debug != "") {
	$crearpass = true;
}

if ($_POST){
	if (empty($_POST['mail']) || empty($_POST['password'])) {
		$_SESSION['error'] = "Invalid data. [1]";
		//header("location: index.php");
		//echo "MAIL PASS VACIOS";
	} else {
		$mail = Limpiar($link, "POST", "mail", "");
		$password = Limpiar($link, "POST", "password", "");
		
		$usuarioid = 0;
		$usuarionombre = "";
		$tipo = 0;
		
		list ($usuarioid, $usuarionombre, $tipo) = VerificarUsuario($link, $mail, $password);
		
		if ($usuarioid > 0) {
			$_SESSION['usuario_id'] = $usuarioid;
			$_SESSION['usuario_nombre'] = $usuarionombre;
			$_SESSION['usuario_tipo'] = $tipo;
			$_SESSION["anio"] = date("Y");
			//Me voy
			header("location: categories.php");
		} else {
			$_SESSION['error'] = "Invalid data. [2]";
			// header("location: login.php");
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include "head.php"; ?>
</head>
<body>

	<?php include "encabezado.php"; ?>

	<div class="col-md-10 col-md-offset-1">
	
		<?php
		if ($usuarioid == 0) {

			/**************************************
			***** L O G I N     F O R M ***********
			***************************************/
			?>
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
					<form action="login.php" enctype="multipart/form-data" method="POST" onSubmit="return doCHAP() ">
						
						<?php if ($crearpass) { ?>
						<div class="form-group">
							<label for="mail">Verif:</label>
							<input type="text" class="form-control" id="prueba" name="prueba" placeholder="prueba">
						</div>
						<?php } ?>

						<?php
						/* ?>
						<div class="form-group">
							<label for="mail">Email:</label>
							<input type="email" class="form-control" id="mail" name="mail" placeholder="Email">
						</div>
						<?php */ ?>
						<div class="form-group">
							<label for="mail">Email:</label>
							<input type="email" class="form-control" id="mail" name="mail" placeholder="Email">
						</div>
						
						<div class="form-group">
							<label for="password">Password:</label>
							<input type="password" class="form-control" id="password" name="password" placeholder="Password">
						</div>
						<?php
						if (!isset($_SESSION['error'])) $_SESSION['error'] = "";
						if ($_SESSION["error"] != "") {
							?>
							<div class="alert alert-danger alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
								<strong>Error:</strong> <?php echo $_SESSION["error"]; ?>.
							</div>
							<?php
							$_SESSION["error"] = "";
						}
						?>

						<button type="submit" name="submit" class="btn btn-default">Ingresar</button>
					</form>
				</div>
			</div>
			<?php
			/************************************************
			***** F I N     L O G I N     F O R M ***********
			*************************************************/
		} else {
			header("location: categories.php");
			?>
			<h4>Bienvenido al sistema de almohadas</h4>

			<?php
			if ($usuariotipo == ADMIN) {
				//TraerStock($link);
			}
		}
		?>
	</div>
	<?php include "js.php"; ?>

	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">
	/*
		var config = {
			'.chosen-select'           : {},
			'.chosen-select-deselect'  : {allow_single_deselect:true},
			'.chosen-select-no-single' : {disable_search_threshold:10},
			'.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
			'.chosen-select-width'     : {width:"95%"}
		}
		for (var selector in config) {
			$(selector).chosen(config[selector]);
		}
		*/

	$(document).ready(function () {

		$("#btnnuevoparticular").on('click', function(evt, params) {
			$('#cliente option[value="25"]').attr('selected', 'selected');
			//$("#pedidoForm").submit();
		});
		
		$('#cliente').on('change', function(evt, params) {
			$("#btnnuevopedido").attr('disabled', false);
		});
		
		$('#productoForm').bootstrapValidator({
				// live: 'disabled',
				message: 'Este valor no es válido',
				feedbackIcons: {
					valid: 'glyphicon glyphicon-ok',
					invalid: 'glyphicon glyphicon-remove',
					validating: 'glyphicon glyphicon-refresh'
				},
				fields: {
					producto: {
						group: '.validador',
						validators: {
							notEmpty: {
								message: 'The country is required and can\'t be empty'
							}
						}
					},
					preciounitario: {
						group: '.validador',
						validators: {
							notEmpty: {
								message: 'El precio no puede estar vacío'
							},
							regexp: {
								regexp: /^[0-9\.]+$/,
								message: 'El precio contiene caracteres inválidos'
							},
							greaterThan: {
								value: 0,
								inclusive: false,
								message: 'El precio debe ser mayor a cero'
							}
						}
					},
					cantidad: {
						group: '.validador',
						validators: {
							notEmpty: {
								message: 'La cantidad no puede estar vacía'
							},
							greaterThan: {
								value: 0,
								inclusive: false,
								message: 'La cantidad debe ser mayor a cero'
							}
						}
					}
				}
		});

	});
	</script>
	<script type="text/javascript" src="js/encript.js"></script>
	<script>
	document.getElementById('mail').focus();
	function doCHAP(){
		<?php if ($crearpass) { ?>
		prueba.value = hex_md5(prueba.value);
		return false;
		<?php } ?>
		var mail = document.getElementById('mail');
		if (!mail) return;
		if (!mail.value){
			showError(mail, 'Ingrese su mail');
			return false;
		}
		var password = document.getElementById('password');
		if (!password) return;
		if (!password.value){
			showError(password, 'Ingrese su Clave');
			return false;
		}
		password.value = hex_md5(password.value);
		return true;
	}

	function showError(obj,message){
		alert(message);
		obj.focus();
	}
	</script>
</body>
</html>
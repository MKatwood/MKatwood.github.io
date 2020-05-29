<?php
$pagina = "categories";

include "sesion.php";
include "conexion.php";
include "util.php";
include "util-registros.php";

$mensaje = "";

if (isset($_POST["c"])){
	$idcategoria = Limpiar($link, "POST", "c", 1);
	$nombre = Limpiar($link, "POST", "nombre", "");
	$subtitulo = Limpiar($link, "POST", "subtitulo", "");
	$descripcion = Limpiar($link, "POST", "descripcion", "");
	$titulo1 = Limpiar($link, "POST", "titulo1", "");
	$titulo2 = Limpiar($link, "POST", "titulo2", "");
	$titulo3 = Limpiar($link, "POST", "titulo3", "");
	$titulo4 = Limpiar($link, "POST", "titulo4", "");
	
	$titulo1 = html_entity_decode($titulo1);
	$titulo2 = html_entity_decode($titulo2);
	$titulo3 = html_entity_decode($titulo3);
	$titulo4 = html_entity_decode($titulo4);
	
	ModificarCategoria($link, $idcategoria, $nombre, $subtitulo, $descripcion, $titulo1, $titulo2, $titulo3, $titulo4);
} else {
	$idcategoria = Limpiar($link, "GET", "c", 1);
}
$categoria = TraerCategoria($link, $idcategoria);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
		<?php include "head.php"; ?>
    
  </head>
  <body>
		
		<?php include "encabezado.php"; ?>
		<div class="col-md-10 col-md-offset-1">
			
			<div class="row">
				<ol class="breadcrumb">
					<li><a href="index.php">Home</a></li>
					<li class="active">Categories</li>
				</ol>
			</div>

			<div class="row divnuevoevento">
				
				<div class="col-md-5">
					<form id="eventoForm" method="post" class="form-horizontal" action="categories.php">

						<div class="form-group validador">
							<label for="p">Category</label>
							<select class="form-control" data-placeholder="Choose category" id="c" name="c">
								<option value=""></option>
								<?php
								$nombrecategoria = "";
								$categorias = ListaCategorias($link);
								while ($row = mysqli_fetch_array($categorias)) {
									if ($row["id_categoria"] == $idcategoria) $nombrecategoria = $row["nombre"];
									?><option value="<?php echo $row["id_categoria"]; ?>" <?php if ($row["id_categoria"] == $idcategoria) echo "selected"; ?>><?php echo $row["id_categoria"] . " - " . $row["nombre"]; ?></option><?php
								}
								?>
							</select>
						</div>
						<div class="form-group validador">
							<label for="nombre">Name</label>
							<input class="form-control" id="nombre" name="nombre" value="<?php echo $categoria["nombre"]; ?>" />
						</div>
						<div class="form-group validador">
							<label for="subtitulo">Subtitle</label>
							<input class="form-control" id="subtitulo" name="subtitulo" value="<?php echo $categoria["subtitulo"]; ?>" />
						</div>
						<div class="form-group validador">
							<label for="descripcion">Description</label>
							<textarea class="form-control" id="descripcion" name="descripcion" rows="6" ><?php echo $categoria["descripcion"]; ?></textarea>
						</div>
					</div>
					<div class="col-md-5 col-md-offset-1">
						<div class="form-group validador">
							<label for="titulo1">Title #1</label>
							<input class="form-control" id="titulo1" name="titulo1" value="<?php echo htmlentities($categoria["title_size_1"]); ?>" />
						</div>
						<div class="form-group validador">
							<label for="titulo2">Title #2</label>
							<input class="form-control" id="titulo2" name="titulo2" value="<?php echo $categoria["title_size_2"]; ?>" />
						</div>
						<div class="form-group validador">
							<label for="titulo3">Title #3</label>
							<input class="form-control" id="titulo3" name="titulo3" value="<?php echo $categoria["title_size_3"]; ?>" />
						</div>
						<div class="form-group validador">
							<label for="titulo4">Title #4</label>
							<input class="form-control" id="titulo4" name="titulo4" value="<?php echo $categoria["title_size_4"]; ?>" />
						</div>
						<div class="form-group validador">
							<input type="submit" id="s" name="s" class="btn btn-large btn-success" value="Send!" />
						</div>
						
					</form>
				</div>
			</div>
		</div>
		
		<?php include "js.php"; ?>

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
		
		$.fn.enterKey = function (fnc) {
			return this.each(function () {
				$(this).keypress(function (ev) {
					var keycode = (ev.keyCode ? ev.keyCode : ev.which);
					if (keycode == '13') {
						fnc.call(this, ev);
					}
				})
			})
		}
		
		$(document).ready(function () {
			
			$("#nombre").focus();
			$("#c").chosen();
			$("#i").chosen();
			$("#ip").chosen();
			$('#fecha').Zebra_DatePicker({
				format: 'd-m-Y'
			});
			$('#fechabaja').Zebra_DatePicker({
				format: 'd-m-Y'
			});
			
			$(".btnfiltrar").on('click', function(evt, params) {
				$("#frmfiltro").submit();
			});

			$("#c").on('change', function(evt, params) {
				var id = $(this).val();
				document.location.href = "categories.php?c=" + id;
			});
			
		});
</script>
</body>
</html>
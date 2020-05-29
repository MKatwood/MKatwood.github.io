<?php
$pagina = "products";

include "sesion.php";
include "conexion.php";
include "util.php";
include "util-products.php";

$esedicion = Limpiar($link, "GET", "e", "");
$eseliminacion = Limpiar($link, "GET", "d", "");
$esalta = Limpiar($link, "GET", "a", "");

//Veo si me mandan el id de pedido
$pagtabla = Limpiar($link, "GET", "p");
$consulta = Limpiar($link, "GET", "q", "");
$idcategoria = Limpiar($link, "GET", "c", 1);
$mensaje = "";

$grabado = false;

$idproducto = 0;
$nombre = "";
$descripcion = "";
$size1 = "";
$size2 = "";
$size3 = "";
$size4 = "";
$titsize1 = "";
$titsize2 = "";
$titsize3 = "";
$titsize4 = "";
$nuevo = 0;
$dinningroom = 0;
$dineintakeout = 0;
$smallbyrequest = 0;
$specialoffer = 0;
$orden = 0;
$cattitsize1 = "";
$cattitsize2 = "";
$cattitsize3 = "";
$cattitsize4 = "";

if ($_SESSION['usuario_tipo'] == 1) {
	if ($esedicion) {
		$idproduct = Limpiar($link, "GET", "id");
		$product = TraerProduct($link, $idproduct);
		if ($product){
			$idcategoria = $product["id_categoria"];
			$nombre = $product["nombre"];
			$descripcion = $product["descripcion"];
			$size1 = $product["size_1"];
			$size2 = $product["size_2"];
			$size3 = $product["size_3"];
			$size4 = $product["size_4"];
			$titsize1 = $product["tit_size_1"];
			$titsize2 = $product["tit_size_2"];
			$titsize3 = $product["tit_size_3"];
			$titsize4 = $product["tit_size_4"];
			
			$cattitsize1 = $product["cat_tit_size_1"];
			$cattitsize2 = $product["cat_tit_size_2"];
			$cattitsize3 = $product["cat_tit_size_3"];
			$cattitsize4 = $product["cat_tit_size_4"];
			$nuevo = $product["nuevo"];
			$dinningroom = $product["dinning_room"];
			$dineintakeout = $product["dine_in_take_out"];
			$smallbyrequest = $product["small_by_request"];
			$specialoffer = $product["special_offer"];
			$orden = $product["orden"];
		}
	} else if ($eseliminacion) {
		//Elimino el product
		$idproduct = Limpiar($link, "GET", "id");
		EliminarProduct($link, $idproduct);
		$mensaje = "Product deleted successfully";
		$grabado = true;
	} else if (isset($_POST["nuevoproduct"])) {
		//Entonces, es alta
		$idcategoria = Limpiar($link, "POST", "idcategoria", 0);
		$nombre = Limpiar($link, "POST", "nombre", "");
		$descripcion = Limpiar($link, "POST", "descripcion", "");
		
		$size1 = Limpiar($link, "POST", "size_1", "");
		$size2 = Limpiar($link, "POST", "size_2", "");
		$size3 = Limpiar($link, "POST", "size_3", "");
		$size4 = Limpiar($link, "POST", "size_4", "");
		$titsize1 = Limpiar($link, "POST", "tit_size_1", "");
		$titsize2 = Limpiar($link, "POST", "tit_size_2", "");
		$titsize3 = Limpiar($link, "POST", "tit_size_3", "");
		$titsize4 = Limpiar($link, "POST", "tit_size_4", "");
		
		$size1 = html_entity_decode($size1);
		$size2 = html_entity_decode($size2);
		$size3 = html_entity_decode($size3);
		$size4 = html_entity_decode($size4);
		
		$titsize1 = html_entity_decode($titsize1);
		$titsize2 = html_entity_decode($titsize2);
		$titsize3 = html_entity_decode($titsize3);
		$titsize4 = html_entity_decode($titsize4);

		$nuevo = Limpiar($link, "POST", "nuevo", 0);
		if ($nuevo == "on") $nuevo = 1;
		$dinningroom = Limpiar($link, "POST", "dinningroom", 0);
		if ($dinningroom == "on") $dinningroom = 1;
		$dineintakeout = Limpiar($link, "POST", "dineintakeout", 0);
		if ($dineintakeout == "on") $dineintakeout = 1;
		$smallbyrequest = Limpiar($link, "POST", "smallbyrequest", 0);
		if ($smallbyrequest == "on") $smallbyrequest = 1;
		$specialoffer = Limpiar($link, "POST", "specialoffer", 0);
		if ($specialoffer == "on") $specialoffer = 1;
		$orden = Limpiar($link, "POST", "orden", 0);
		
		$idproduct = InsertarProduct($link, $idcategoria, $nombre, $descripcion, $size1, $size2, $size3, $size4, $titsize1, $titsize2, $titsize3, $titsize4, $nuevo, $dinningroom, $dineintakeout, $smallbyrequest, $specialoffer, $orden);
		
		$mensaje = "Product created successfully";
		$grabado = true;

		$idproducto = 0;
		$nombre = "";
		$descripcion = "";
		$size1 = "";
		$size2 = "";
		$size3 = "";
		$size4 = "";
		$titsize1 = "";
		$titsize2 = "";
		$titsize3 = "";
		$titsize4 = "";
		$nuevo = 0;
		$dinningroom = 0;
		$dineintakeout = 0;
		$smallbyrequest = 0;
		$specialoffer = 0;
		$orden = 0;
	} else if (isset($_POST["id"])) {
		//Entonces, es modificacion
		$idproduct = Limpiar($link, "POST", "id", 0);
		$idcategoria = Limpiar($link, "POST", "idcategoria", 0);
		$nombre = Limpiar($link, "POST", "nombre", "");
		$descripcion = Limpiar($link, "POST", "descripcion", "");
		$size1 = Limpiar($link, "POST", "size_1", 0);
		$size2 = Limpiar($link, "POST", "size_2", 0);
		$size3 = Limpiar($link, "POST", "size_3", 0);
		$size4 = Limpiar($link, "POST", "size_4", 0);
		$titsize1 = Limpiar($link, "POST", "tit_size_1", "");
		$titsize2 = Limpiar($link, "POST", "tit_size_2", "");
		$titsize3 = Limpiar($link, "POST", "tit_size_3", "");
		$titsize4 = Limpiar($link, "POST", "tit_size_4", "");
		$nuevo = Limpiar($link, "POST", "nuevo", 0);
		if ($nuevo == "on") $nuevo = 1;
		$dinningroom = Limpiar($link, "POST", "dinningroom", 0);
		if ($dinningroom == "on") $dinningroom = 1;
		$dineintakeout = Limpiar($link, "POST", "dineintakeout", 0);
		if ($dineintakeout == "on") $dineintakeout = 1;
		$smallbyrequest = Limpiar($link, "POST", "smallbyrequest", 0);
		if ($smallbyrequest == "on") $smallbyrequest = 1;
		$specialoffer = Limpiar($link, "POST", "specialoffer", 0);
		if ($specialoffer == "on") $specialoffer = 1;
		$orden = Limpiar($link, "POST", "orden", 0);
		
		ModificarProduct($link, $idproduct, $idcategoria, $nombre, $descripcion, $size1, $size2, $size3, $size4, $titsize1, $titsize2, $titsize3, $titsize4, $nuevo, $dinningroom, $dineintakeout, $smallbyrequest, $specialoffer, $orden);

		$mensaje = "Product updated successfully";
		$idproducto = 0;
		$nombre = "";
		$descripcion = "";
		$size1 = "";
		$size2 = "";
		$size3 = "";
		$size4 = "";
		$titsize1 = "";
		$titsize2 = "";
		$titsize3 = "";
		$titsize4 = "";
		$nuevo = 0;
		$dinningroom = 0;
		$dineintakeout = 0;
		$smallbyrequest = 0;
		$specialoffer = 0;
		$orden = 0;
		
		$grabado = true;
	}
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
		<?php include "head.php"; ?>
    <link rel="stylesheet" href="css/bootstrap-switch.css"/>
		
  </head>
  <body>
		
		<?php include "encabezado.php"; ?>
		<div class="col-md-10 col-md-offset-1">
			
			<div class="row">
				<ol class="breadcrumb">
					<li><a href="index.php">Home</a></li>
					<li class="active">Products</li>
				</ol>
			</div>

			<?php if ($_SESSION['usuario_tipo'] == 1) { ?>
				<?php if ($esedicion || $esalta) { ?>
				<div class="row divnuevoevento">
					<?php if (!$esedicion) { ?>
					<h4>New Product</h4>
					<?php } ?>
					<div class="col-md-5">
						<form id="eventoForm" method="post" class="form-horizontal" action="products.php" enctype="multipart/form-data">

							<?php if (!$esedicion) { ?>
							<input type="hidden" id="nuevoproduct" name="nuevoproduct" value="0" />
							<?php } else { ?>
							<input type="hidden" id="id" name="id" value="<?php echo $idproduct; ?>" />
							<?php } ?>
							
							<div class="form-group validador">
								<label for="idcategoria">Category</label>
								<select class="form-control" data-placeholder="Choose a Category" id="idcategoria" name="idcategoria">
									<option value=""></option>
									<?php
									$nombrecat = "";
									$nomprecio1 = "";
									$nomprecio2 = "";
									$nomprecio3 = "";
									$nomprecio4 = "";
									$categorias = ListaCategorias($link);
									while ($row = mysqli_fetch_array($categorias)) {
										if ($row["id_categoria"] == $idcategoria) {
											$nombrecat = $row["nombre"];
											$nomprecio1 = $row["title_size_1"];
											$nomprecio2 = $row["title_size_2"];
											$nomprecio3 = $row["title_size_3"];
											$nomprecio4 = $row["title_size_4"];
										}
										?><option value="<?php echo $row["id_categoria"]; ?>" <?php if ($row["id_categoria"] == $idcategoria) echo "selected"; ?>><?php echo $row["nombre"]; ?></option><?php
									}
									?>
								</select>
							</div>
							
							<div class="form-group validador">
								<label for="nombre">Name</label>
								<input type="text" placeholder="Name" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre; ?>" />
							</div>
							
							<div class="form-group validador">
								<label for="descripcion">Description</label>
								<input type="text" placeholder="Description" class="form-control" id="descripcion" name="descripcion" value="<?php echo $descripcion; ?>" />
							</div>
							
							<!-- 
							<div class="form-group validador">
								<label for="orden">Order</label>
								<input type="number" placeholder="Order" class="form-control" id="orden" name="orden" value="<?php echo $orden; ?>" />
							</div>
							
							<div class="form-group validador">
								<label>Small By Request</label>
								<input type="checkbox" placeholder="Small By Request" class="form-controlf" data-on-text="Yes" data-off-text="No" tabindex="5" id="smallbyrequest" name="smallbyrequest" <?php if ($smallbyrequest) { echo "checked"; } ?> />
							</div>
							
							<div class="form-group validador">
								<label>Special Offer</label>
								<input type="checkbox" placeholder="Special Offer" class="form-controlf" data-on-text="Yes" data-off-text="No" tabindex="5" id="specialoffer" name="specialoffer" <?php if ($specialoffer) { echo "checked"; } ?> />
							</div>
							
							<div class="form-group validador">
								<label>Dine in / Take out</label>
								<input type="checkbox" placeholder="Dine in / Take out" class="form-controlf" data-on-text="Yes" data-off-text="No" tabindex="5" id="dineintakeout" name="dineintakeout" <?php if ($dineintakeout) { echo "checked"; } ?> />
							</div>
							-->
						</div>
						<div class="col-md-5 col-md-offset-1">
							
							
							<div class="form-group validador">
								<label for="size_1">Price #1 (<?php echo $nomprecio1; ?>)</label>
								<input type="text" placeholder="Price #1" class="form-control" id="size_1" name="size_1" value="<?php echo $size1; ?>" />
							</div>
							
							<div class="form-group validador">
								<label for="size_2">Price #2 (<?php echo $nomprecio2; ?>)</label>
								<input type="text" placeholder="Price #2" class="form-control" id="size_2" name="size_2" value="<?php echo $size2; ?>" />
							</div>
							
							<div class="form-group validador">
								<label for="size_3">Price #3 (<?php echo $nomprecio3; ?>)</label>
								<input type="text" placeholder="Price #3" class="form-control" id="size_3" name="size_3" value="<?php echo $size3; ?>" />
							</div>
							
							<div class="form-group validador">
								<label for="size_4">Price #4 (<?php echo $nomprecio4; ?>)</label>
								<input type="text" placeholder="Price #4" class="form-control" id="size_4" name="size_4" value="<?php echo $size4; ?>" />
							</div>
							
							<!--
							<div class="form-group validador">
								<label for="size_1">Size name #1 (Category size name: "<?php echo $cattitsize1; ?>")</label>
								<input type="text" placeholder="Size name #1" class="form-control" id="tit_size_1" name="tit_size_1" value="<?php echo $titsize1; ?>" />
							</div>
							
							<div class="form-group validador">
								<label for="size_2">Size name #2 (Category size name: "<?php echo $cattitsize2; ?>")</label>
								<input type="text" placeholder="Size name #2" class="form-control" id="tit_size_2" name="tit_size_2" value="<?php echo $titsize2; ?>" />
							</div>
							
							<div class="form-group validador">
								<label for="size_3">Size name #3 (Category size name: "<?php echo $cattitsize3; ?>")</label>
								<input type="text" placeholder="Size name #3" class="form-control" id="tit_size_3" name="tit_size_3" value="<?php echo $titsize3; ?>" />
							</div>
							
							<div class="form-group validador">
								<label for="size_4">Size name #4 (Category size name: "<?php echo $cattitsize4; ?>")</label>
								<input type="text" placeholder="Size name #4" class="form-control" id="tit_size_4" name="tit_size_4" value="<?php echo $titsize4; ?>" />
							</div>
							-->
							
							<!--
							<div class="form-group validador">
								<label>'New' Badge</label>
								<input type="checkbox" placeholder="'New' Badge" class="form-controlf" data-on-text="Yes" data-off-text="No" tabindex="5" id="nuevo" name="nuevo" <?php if ($nuevo) { echo "checked"; } ?> />
							</div>
							
							<div class="form-group validador">
								<label>Dinning Room</label>
								<input type="checkbox" placeholder="Dinning Room" class="form-controlf" data-on-text="Yes" data-off-text="No" tabindex="5" id="dinningroom" name="dinningroom" <?php if ($dinningroom) { echo "checked"; } ?> />
							</div>
							-->
							<div class="form-group mensaje" style="display:none;">
								<div class="alert alert-warning alert-dismissible tipocervezaactual" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<strong>¡Atención!</strong> <span id="texto"></span>
								</div>
							</div>
							
							<div class="form-group">
								<a href="products.php?c=<?php echo $idcategoria; ?>" class="btn btn-warning">Cancel</a>
								<button type="submit" class="btn btn-primary"><?php if (!$esedicion) { echo "Create"; } else { echo "Save"; } ?></button>
							</div>

						</form>
					</div>
				</div>
				<?php } ?>
			<?php } ?>
			
			<?php if ($mensaje != "") { ?>
			<div class="col-md-12 col-sm-12">
				<div class="alert alert-success alert-dismissible tipocervezaactual" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong>Great!</strong> <?php echo $mensaje; ?>
				</div>
			</div>
			<?php } ?>
			
			<hr>
		
		<form id="frmfiltro" method="get" class="form-inline" action="products.php">
			<div class="row">
				<div class="col-md-3 validador">
					<select class="form-control" data-placeholder="Choose a Category" id="c" name="c">
						<option value=""></option>
						<?php
						$categorias = ListaCategorias($link);
						while ($row = mysqli_fetch_array($categorias)) {
							?><option value="<?php echo $row["id_categoria"]; ?>" <?php if ($row["id_categoria"] == $idcategoria) echo "selected"; ?>><?php echo $row["nombre"]; ?></option><?php
						}
						?>
					</select>
				</div>
				<div class="col-md-2 form-group">
					<button class="btn btn-primary btnfiltrar">Filter</button>
				</div>

				<?php if ($_SESSION['usuario_tipo'] == 1) { ?>
				<div class="col-md-4 col-xs-6 text-right">
					<a href="products.php?a=1&c=<?php echo $idcategoria; ?>" class="btn btn-success">New Product</a>
				</div>
				<?php } ?>

			</div>
		</form>
		
		<hr />
		
		<div class="row">

		<?php
		
		//Limito la busqueda
		$cantidad = 100;

		//examino la página a mostrar y el inicio del registro a mostrar
		if (!$pagtabla) {
			$pagtabla = 1;
		}
		ListadoProducts($link, $consulta, $idcategoria, $pagtabla, $cantidad);
		?>
		</div>



<div id="modborrar" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete Product</h4>
      </div>
      <div class="modal-body">
        <p>Do you want to delete the product '<span id="descprod"></span>'?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" id="borrarpedido" data-dismiss="modal">Delete</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>

  </div>
</div>
		<?php include "js.php"; ?>
		
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
			
			
			var idborrar = 0;
			$(".btndelete").on('click', function(evt, params) {
				$("#modborrar").modal();
				idborrar = $(this).attr("pid");
				var desc = $(this).attr("desc");
				$("#descprod").text(desc);
				//$("#pedidoForm").submit();
			});
			
			$("#borrarpedido").on('click', function(evt, params) {
				window.location.href = "products.php?d=1&c=<?php echo $idcategoria; ?>&id=" + idborrar;
				return false;
			});
			
			$("#nombre").focus();
			$("#idcategoria").chosen();
			$("#c").chosen();
			//$("#nuevo").bootstrapSwitch();
			//$("#dinningroom").bootstrapSwitch();
			//$("#dineintakeout").bootstrapSwitch();
			//$("#smallbyrequest").bootstrapSwitch();
			//$("#specialoffer").bootstrapSwitch();
			
			$(".btnfiltrar").on('click', function(evt, params) {
				$("#frmfiltro").submit();
			});

			$(".ordertab").sortable({
				handle : '.handle',
				update : function () {
					var order = $('.ordertab').sortable('serialize');
				//	$("#info").load("ordenar.php?"+order);
					$.get( "ordenar.php?"+order, function( data ) {
						$( ".result" ).html( data );
					});
				}
			});
		});
</script>
  </body>
</html>
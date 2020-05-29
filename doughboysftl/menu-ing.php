<?php
$pagina = "menu";

include "conexion.php";
include "util.php";

$idcategoria = Limpiar($link, "GET", "c", 1);

function ConvertirNombre($valor){
	$valor = str_replace(" ", "", $valor);
	$valor = str_replace("&", "", $valor);
	$valor = strtolower($valor);
	return $valor;
}

function TraerCategoriasDeIngrediente($link, $idingrediente){
	$sql = "SELECT c.* FROM categorias c 
	INNER JOIN productos p ON p.id_categoria = c.id_categoria 
	INNER JOIN productos_ingredientes pi ON pi.id_producto = p.id_producto 
	WHERE pi.id_ingrediente = $idingrediente
	ORDER BY nombre ";
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	$clases = "";
	while($row = mysqli_fetch_array($rs)) {
		$clases .= " " . ConvertirNombre($row["nombre"]);
	}
	return $clases;
}

function TraerCategoriasDeProducto($link, $idproducto){
	$sql = "SELECT c.* FROM categorias c 
	INNER JOIN productos p ON p.id_categoria = c.id_categoria 
	WHERE p.id_producto = $idproducto
	ORDER BY nombre ";
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	$clases = "";
	while($row = mysqli_fetch_array($rs)) {
		$clases .= " " . ConvertirNombre($row["nombre"]);
	}
	return $clases;
}

function TraerIngredientesDeProducto($link, $idproducto){
	$sql = "SELECT i.* FROM ingredientes i 
	INNER JOIN productos_ingredientes pi ON pi.id_ingrediente = i.id_ingrediente 
	WHERE pi.id_producto = $idproducto
	ORDER BY nombre ";
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	$clases = "";
	while($row = mysqli_fetch_array($rs)) {
		$clases .= " " . ConvertirNombre($row["nombre"]);
	}
	return $clases;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="M_Adnan">
<title>Doughboys Pizzeria and Italian Restaurant</title>

<!-- SLIDER REVOLUTION 4.x CSS SETTINGS -->
<link rel="stylesheet" type="text/css" href="rs-plugin/css/settings.css" media="screen" />

<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="css/ionicons.min.css" rel="stylesheet">
<link href="css/main.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">
<link href="css/lightbox.css" rel="stylesheet">
<link href="css/chosen.css" rel="stylesheet" />

<!-- JavaScripts -->
<script src="js/modernizr.js"></script>

<!-- Online Fonts -->
<link href='https://fonts.googleapis.com/css?family=Alex+Brush' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Josefin+Sans:400,300,600,600italic,700italic,100' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,600,300,800' rel='stylesheet' type='text/css'>
<link href="https://fonts.googleapis.com/css?family=Miltonian+Tattoo" rel="stylesheet" type='text/css'>

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

</head>
<body>

<!-- Wrap -->
<div id="wrap"> 
 
<?php include "top.php"; ?>
<?php include "header.php"; ?>

	 <!--======= HOME MAIN SLIDER =========-->
  <section class="home-slider" id="home"> 
    <!-- Slider Loader -->
    <div id="loader" class="hom-slie">
      <div class="tp-loader spinner0"> <span class="dot1"></span> <span class="dot2"></span> <span class="bounce1"></span> <span class="bounce2"></span> <span class="bounce3"></span> </div>
    </div>
    
    <!-- SLIDE Start -->
    <div class="tp-banner-container">
      <div class="tp-banner">
        <ul>
				<?php
					$nomcat = "";
					$sql = "SELECT * FROM categorias c ORDER BY id_tipo_categoria, orden, nombre ";
					$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
					$total = mysqli_num_rows($rs);
					
					$isch = false;
					
					$ticat = 0;
					
					while($row = mysqli_fetch_array($rs)) {
						if ($idcategoria == $row["id_categoria"]) { $nomcat = $row["nombre"]; }
					}
					
					$imgcat = "17.jpg";
					if (file_exists("images/categories/" . $idcategoria . ".jpg")) {
						$imgcat = $idcategoria . ".jpg";
					}
					?>
					
          <!-- SLIDE  -->
          <li data-transition="random" data-slotamount="7" data-masterspeed="300"  data-saveperformance="off" > 
            <!-- MAIN IMAGE -->
						
            <img src="images/categories/<?php echo $imgcat; ?>" alt="<?php echo $nomcat; ?>" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat"> 
            <!-- LAYERS --> 
            
            <!-- LAYER NR. 1 -->
            <div class="tp-caption font-alex sft tp-resizeme" 
                data-x="center" data-hoffset="0" 
                data-y="center" data-voffset="-80" 
                data-speed="800" 
                data-start="800" 
                data-easing="Power3.easeInOut" 
                data-splitin="words" 
                data-splitout="none" 
                data-elementdelay="0.1" 
                data-endelementdelay="0.1" 
                data-endspeed="300" 
								style="z-index: 7; font-size:60px; color:#01826c; max-width: auto; max-height: auto; white-space: nowrap; text-shadow: 2px 2px 1px #fff;"
                >Our Menu</div>
            
            <!-- LAYER NR. 2 -->
            <div class="tp-caption sfb font-josefin font-bold tp-resizeme" 
                data-x="center" data-hoffset="0" 
                data-y="center" data-voffset="0" 
                data-speed="800" 
                data-start="1200" 
                data-easing="Power3.easeInOut" 
                data-splitin="words" 
                data-splitout="none" 
                data-elementdelay="0.07" 
                data-endelementdelay="0.1" 
                data-endspeed="300" 
								style="z-index: 6; font-size:80px; color:#fff; text-transform:uppercase; white-space: nowrap; text-shadow: 2px 2px 2px #000;"
                ><?php echo $nomcat; ?></div>
            
          </li>
          <?php 
					//echo "EXXXXX: " . "images/categories/" . $idcategoria . "a.jpg";
					if (file_exists("images/categories/" . $idcategoria . "a.jpg")) { ?>
					<li data-transition="random" data-slotamount="7" data-masterspeed="300" data-saveperformance="off" > 
            <!-- MAIN IMAGE -->
						
            <img src="images/categories/<?php echo $idcategoria . "a.jpg"; ?>" alt="<?php echo $nomcat; ?>" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat"> 
            <!-- LAYERS --> 
            
            <!-- LAYER NR. 1 -->
            <div class="tp-caption font-alex sft tp-resizeme" 
                data-x="center" data-hoffset="0" 
                data-y="center" data-voffset="-80" 
                data-speed="800" 
                data-start="800" 
                data-easing="Power3.easeInOut" 
                data-splitin="words" 
                data-splitout="none" 
                data-elementdelay="0.1" 
                data-endelementdelay="0.1" 
                data-endspeed="300" 
                style="z-index: 7; font-size:60px; color:#01826c; max-width: auto; max-height: auto; white-space: nowrap; text-shadow: 2px 2px 1px #fff;"
								>Our Menu</div>
            
            <!-- LAYER NR. 2 -->
            <div class="tp-caption sfb font-josefin font-bold tp-resizeme" 
                data-x="center" data-hoffset="0" 
                data-y="center" data-voffset="0" 
                data-speed="800" 
                data-start="1200" 
                data-easing="Power3.easeInOut" 
                data-splitin="words" 
                data-splitout="none" 
                data-elementdelay="0.07" 
                data-endelementdelay="0.1" 
                data-endspeed="300" 
                style="z-index: 6; font-size:80px; color:#fff; text-transform:uppercase; white-space: nowrap; text-shadow: 2px 2px 2px #000;"
								><?php echo $nomcat; ?></div>
            
          </li>
					<?php } ?>
        </ul>
      </div>
    </div>
  </section>

  <!-- Content -->
  <div id="content"> 
    
    <!-- Pizza Menu -->
    <section class="pizza-menu tri-white-top padding-top-100 padding-bottom-100" id="our-menu" style="background: #030303;">
      <div class="container"> 
        
        <!-- Heading Block 
        <div class="heading text-center"> <span>Pleasure of Choice</span>
          <h3>Our Menu</h3>
          <hr />
          <i class="fa fa-bookmark-o"></i>
				</div>
				-->

				<div class=" text-center filters" style="margin-bottom: 20px;">
					<select id="categorias">
						<?php
						$nomcat = "";
						$sql = "SELECT * FROM categorias c ORDER BY id_tipo_categoria, orden, nombre ";
						$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
						$total = mysqli_num_rows($rs);
						
						$isch = false;
						
						$ticat = 0;
						
						while($row = mysqli_fetch_array($rs)) {
							if ($ticat != $row["id_tipo_categoria"]){
								if ($ticat > 0){
								}
								$ticat = $row["id_tipo_categoria"];
							}
							$chked = "";
							if (!$isch){
								$chked = "is-checked";
								$isch = true;
								$idcat = $row["id_categoria"];
							}
							if ($idcategoria == $row["id_categoria"]) { $nomcat = $row["nombre"]; }
							?>
							<option value="menu-ing.php?c=<?php echo $row["id_categoria"]; ?>" <?php if ($idcategoria == $row["id_categoria"]) { echo "selected"; } ?>><?php echo $row["nombre"]; ?></option>
							<?php
						}
						?>
					</select>
					<!--
					<h3 style="font-family: 'Miltonian Tattoo', cursive; color: #c00;"><?php echo $nomcat; ?></h3>
					-->
				</div>
				<div class="heading text-center filters gridingred" style="margin-bottom: 20px;">
					<div class="button-group js-radio-button-group" data-filter-group="color">
						<button class="grid-item ingrediente button any" id="any" data-filter="any">any</button>
						<?php
						$sql = "SELECT i.* FROM ingredientes i ORDER BY i.nombre ";
						$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
						while($row = mysqli_fetch_array($rs)) {
							$clases = TraerCategoriasDeIngrediente($link, $row["id_ingrediente"]);
							?>
							<button class="grid-item ingrediente button <?php echo $clases; ?>" id="<?php echo ConvertirNombre($row["nombre"]); ?>" data-filter="<?php echo ConvertirNombre($row["nombre"]); ?>"><?php echo $row["nombre"]; ?></button>
							<?php
						}
						?>
					</div>
				</div>
				<!--
				-->
        <!-- Flavours -->
        <ul class="pizza-flavers grid" style="background-image: url('images/ybg.jpg');">
          <?php
					$sql = "SELECT p.*, p.nombre as prod, p.descripcion as catdesc, c.* 
					FROM productos p 
					INNER JOIN categorias c ON c.id_categoria = p.id_categoria 
					WHERE p.id_categoria = " . $idcategoria . " ORDER BY p.nombre ";
		
					$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
					while($row = mysqli_fetch_array($rs)) {
						$cats = TraerCategoriasDeProducto($link, $row["id_producto"]);
						$ings = TraerIngredientesDeProducto($link, $row["id_producto"]);
						//Check if image file exists
						$thumb = "images/products/0.jpg";
						$imagen = "images/products/big/0.jpg";
						if (file_exists("images/products/" . $row["id_producto"] . ".jpg")) {
							$thumb = "images/products/" . $row["id_producto"] . ".jpg";
							$imagen = "images/products/big/" . $row["id_producto"] . ".jpg";
						} else if (file_exists("images/categories/" . $row["id_categoria"] . ".jpg")) {
							$thumb = "images/categories/" . $row["id_categoria"] . ".jpg";
							$imagen = "images/categories/big/" . $row["id_categoria"] . ".jpg";
						}
						
						?>
						<!-- Pizza Flavours -->
						<li class="grid-item producto <?php echo $cats . " " . $ings; /* */ ?>">
							<!-- Pizza Image
							<div class="media-left">
								<div class="menu-img"> <a href="<?php // echo $imagen; ?>" data-lightbox="image-<?php // echo $row["id_producto"]; ?>" data-title="<?php // echo $row["prod"]; ?>"><img src="<?php // echo $thumb; ?>" alt="<?php // echo $row["prod"]; ?>"></a> </div>
							</div>
							-->
							<!-- Pizza Tittles -->
							<div class="media-body">
								<div class="menu-tittle col-md-6">
									<h5><?php echo $row["prod"]; ?></h5>
									<span><?php echo $row["catdesc"]; ?></span>
									<?php if ($row["nuevo"] > 0) { ?>
									<span style="color:red; background-color:yellow;padding: 0 2px 0 2px;white-space: nowrap;">new</span>
									<?php } ?>
									<?php if ($row["special_offer"] > 0) { ?>
									<span style="color:yellow; background-color:red;padding: 0 2px 0 2px;white-space: nowrap;">special offer</span>
									<?php } ?>
									<?php if ($row["can_serve_2"] > 0) { ?>
									<span style="color:white;background-color:red;padding: 0 2px 0 2px;white-space: nowrap;">can serve 2</span>
									<?php } ?>
									<?php if ($row["huge_portions"] > 0) { ?>
									<span style="color:white;background-color:green;padding: 0 2px 0 2px;white-space: nowrap;">huge portions</span>
									<?php } ?>
									<?php if ($row["dinning_room"] > 0) { ?>
									<span style="color:white;background-color:purple;padding: 0 2px 0 2px;white-space: nowrap;">dinning room</span>
									<?php } ?>
									<?php if ($row["dine_in_take_out"] > 0) { ?>
									<span style="color:white;background-color:black;padding: 0 2px 0 2px;white-space: nowrap;">dine in / take out</span>
									<?php } ?>
									<?php if ($row["small_by_request"] > 0) { ?>
									<span style="color:white;background-color:blue;padding: 0 2px 0 2px;white-space: nowrap;">small by request</span>
									<?php } ?>
								</div>
								<!-- Pizza Price -->
								<?php if ($row["size_4"] != "" && $row["size_4"] > 0) { ?>
								<div class="pizza-price" style="padding-left: 20px;">
									<div style="font-size: 12px; text-transform: uppercase;font-weight: bold; text-align: right;"><?php echo $row["title_size_4"]; ?></div>
									$<?php echo $row["size_4"]; ?>
								</div>
								<?php } ?>
								<?php if ($row["size_3"] != "" && $row["size_3"] > 0) { ?>
								<div class="pizza-price" style="padding-left: 20px;">
									<div style="font-size: 12px; text-transform: uppercase;font-weight: bold; text-align: right;"><?php echo $row["title_size_3"]; ?></div>
									$<?php echo $row["size_3"]; ?>
								</div>
								<?php } ?>
								<?php if ($row["size_2"] != "" && $row["size_2"] > 0) { ?>
								<div class="pizza-price" style="padding-left: 20px;">
									<div style="font-size: 12px; text-transform: uppercase;font-weight: bold; text-align: right;"><?php echo $row["title_size_2"]; ?></div>
									$<?php echo $row["size_2"]; ?>
								</div>
								<?php } ?>
								<?php if ($row["size_1"] != "" && $row["size_1"] > 0) { ?>
								<div class="pizza-price" style="padding-left: 20px;">
									<div style="font-size: 12px; text-transform: uppercase;font-weight: bold; text-align: right;"><?php echo $row["title_size_1"]; ?></div>
									$<?php echo $row["size_1"]; ?>
								</div>
								<?php } ?>
							</div>
						</li>
						<?php
					}
					?>
          <li class="grid-item cantfind">
						<!-- Pizza Image -->
						<!-- Pizza Tittles -->
						<div class="media-body">
							<div class="menu-tittle col-md-6">
								<h5 style="color: #de3b30;">We can't find any dishes for current category with selected ingredients</h5>
								<span></span>
						</div>
					</li>
					<?php 
					?>
        </ul>
      </div>
    </section>
        
		<?php include "contact.php"; ?>
		<?php include "map.php"; ?>
    
  </div>
	<?php include "footer.php"; ?>
	
</div>
<script src="js/jquery-1.11.3.min.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/own-menu.js"></script> 
<script src="js/owl.carousel.min.js"></script> 
<!-- SLIDER REVOLUTION 4.x SCRIPTS  --> 
<script type="text/javascript" src="rs-plugin/js/jquery.tp.t.min.js"></script> 
<script type="text/javascript" src="rs-plugin/js/jquery.tp.min.js"></script> 
<script src="js/main.js"></script> 
<script src="js/lightbox.js"></script> 

<!-- Begin Map Script
<sc ript src="https://maps.googleapis.com/maps/api/js?v=3.exp"></scri pt> 
<sc ript src="js/map.js"></scri pt>
--> 
</body>
</html>
<script type="text/javascript">
$(document).ready(function () {

	//$("#categorias").chosen({width: "600px"});

	var ultimacat = "<?php echo ConvertirNombre($nomcat); ?>";
	if (ultimacat == "") {
		ultimacat = "alfredocalzones";
	}
	var ultimoing = ["any"];
	
	var isIE = (navigator.appName == 'Microsoft Internet Explorer');
	$(document.body).on(isIE ? "click" : "change", "#categorias", function() { //click focus
		window.location.href = $(this).val();
		//alert( $(this).val() );
		//alert( $(this).find('option:selected').val() );
		//alert( this.valu );
	});
	
	function FiltrarIngredientes(categoria){
		//Busco los ingredientes de esa categoria
		$('.ingrediente').each( function( i, ing ) {
			var $ing = $( ing );
			if ($ing.attr("data-filter") == "any"){
				$ing.show();
				$ing.addClass('is-checked');
			} else {
				if ($ing.hasClass(categoria)){
					$ing.show();
					$ing.removeClass('is-checked');
				} else {
					$ing.hide();
					$ing.removeClass('is-checked');
				}
			}
		
		});
	}
	
	function CambiarCategoria(ultcat, nuecat){
		//Busco los ingredientes de esa categoria
		$('#'+ ultcat).removeClass('is-checked');
		$('#'+ nuecat).addClass('is-checked');
	}
	
	function ArrayExists(arr, it){
		for (i = 0; i < arr.length; i++) {
			if (it == arr[i]) return true;
		}
		return false;
	}
	
	function FiltrarProductos(categoria, ingredientes){
		//Busco los ingredientes de esa categoria
		//$('.producto').show();
		$(".cantfind").hide();
		$('.producto').each( function( i, prod ) {
			var $prod = $( prod );
			
			if ($prod.hasClass(categoria)){
				$prod.show("slow");
				if (ArrayExists(ingredientes, "any")){
					$prod.show("slow");
				} else {
					var iLen, i;
					iLen = ingredientes.length;
					for (i = 0; i < iLen; i++) {
						if ($prod.hasClass(ingredientes[i])){
							// $prod.show("slow");
						} else {
							$prod.hide();
						}
					}
				}
			} else {
				$prod.hide();
			}
		
		});
		if ($('.producto:visible').length == 0){
			$(".cantfind").show();
		}
	}
	
	//Click de categoria
	$('.categoria').on( 'click', function() {
		//Traigo el nombre de esta categoria
		var nuevacat = $(this).attr("data-filter");
		CambiarCategoria(ultimacat, nuevacat);

		ultimacat = nuevacat;
		ultimoing = ["any"];
		FiltrarIngredientes(ultimacat);
		FiltrarProductos(ultimacat, ultimoing);
	});
	
	//Click de ingrediente
	$('.ingrediente').on( 'click', function() {
		//Traigo el nombre de esta categoria
		var nuevoing = $(this).attr("data-filter");

		if (nuevoing == "any"){
			ultimoing = ["any"];
			$('.ingrediente').removeClass('is-checked');
			$("#any").addClass('is-checked');
		} else {
			if (ArrayExists(ultimoing, "any")){
				$("#"+nuevoing).addClass('is-checked');
				$("#any").removeClass('is-checked');
				ultimoing = [nuevoing];
			} else {
				if (ArrayExists(ultimoing, nuevoing)){
					//existe, lo saco
					$(this).removeClass('is-checked');
					var index = ultimoing.indexOf(nuevoing);
					if (index > -1) {
						ultimoing.splice(index, 1);
					}
					if (ultimoing.length == 0) {
						ultimoing = ["any"];
						$("#any").addClass('is-checked');
					}
				} else {
					$(this).addClass('is-checked');
					ultimoing.push(nuevoing);
				}
			}
		}
		FiltrarProductos(ultimacat, ultimoing);
	});
	
	FiltrarIngredientes(ultimacat);
	FiltrarProductos(ultimacat, ultimoing);
	
});
</script>
<style>

/* ---- button ---- */

#categorias{
	text-align: left;
	font-family: 'Miltonian Tattoo', cursive;
	font-size: 30px;
	background-color: #030303;
	color: #fff;
}

.chosen-container-single .chosen-single {
	border: 1px solid #030303;
	
	background-color: #030303;
  background: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(20%, #030303), color-stop(50%, #030303), color-stop(52%, #030303), color-stop(100%, #030303));
  background: -webkit-linear-gradient(top, #030303 20%, #030303 50%, #030303 52%, #030303 100%);
  background: -moz-linear-gradient(top, #030303 20%, #030303 50%, #030303 52%, #030303 100%);
  background: -o-linear-gradient(top, #030303 20%, #030303 50%, #030303 52%, #030303 100%);
  background: linear-gradient(top, #030303 20%, #030303 50%, #030303 52%, #030303 100%);
	box-shadow: 0 0 3px #030303 inset, 0 1px 1px rgba(3, 3, 3, 0.1);
}

.chosen-container-single .chosen-single span {
	background-color: #030303;
	color: #c00;
}
.chosen-single{
	background-color: #030303;
}
.chosen-container{
	font-family: "Miltonian Tattoo", cursive;
	font-size: 36px;
	background-color: #030303;
}

.button {
  display: inline-block;
  padding: 0.1em 1.0em;
  background: #EEE;
  border: none;
  border-radius: 7px;
  background-image: linear-gradient( to bottom, hsla(0, 0%, 0%, 0), hsla(0, 0%, 0%, 0.2) );
  color: #222;
  font-family: sans-serif;
  font-size: 16px;
  text-shadow: 0 1px white;
  cursor: pointer;
}

.button:hover {
  background-color: #0ccab3;
  text-shadow: 0 1px hsla(0, 0%, 100%, 0.5);
  color: #fff;
}

.button:active,
.button.is-checked {
  background-color: #017f70;
}

.button.is-checked {
  color: white;
  text-shadow: 0 -1px hsla(0, 0%, 0%, 0.8);
}

.button:active {
  box-shadow: inset 0 1px 10px hsla(0, 0%, 0%, 0.8);
}

/* ---- button-group ---- */

.button-group:after {
  content: '';
  display: block;
  clear: both;
}

.button-group .button {
  float: left;
  border-radius: 0.5em;
  margin-left: 0;
  margin-right: 1px;
}
/*
.button-group .button:first-child { border-radius: 0.5em 0 0 0.5em; }
.button-group .button:last-child { border-radius: 0 0.5em 0.5em 0; }
*/
/* ---- isotope ---- */

.grid {
 
}

/* clear fix */
.grid:after {
  content: '';
  display: block;
  clear: both;
}

/* ui group */

.ui-group {
  display: inline-block;
}

.ui-group h3 {
  display: inline-block;
  vertical-align: top;
  line-height: 32px;
  margin-right: 0.2em;
  font-size: 16px;
}

.ui-group .button-group {
  display: inline-block;
  margin-right: 20px;
}

/* color-shape */

.color-shape {
  width: 70px;
  height: 70px;
  margin: 5px;
  float: left;
}
 
.color-shape.round {
  border-radius: 35px;
}
 
.color-shape.big.round {
  border-radius: 75px;
}
 
.color-shape.red { background: red; }
.color-shape.blue { background: blue; }
.color-shape.yellow { background: yellow; }
 
.color-shape.wide, .color-shape.big { width: 150px; }
.color-shape.tall, .color-shape.big { height: 150px; }
</style>
<script src="js/isotope.pkgd.min.js"></script>
<script src="js/chosen.jquery.js" type="text/javascript"></script>
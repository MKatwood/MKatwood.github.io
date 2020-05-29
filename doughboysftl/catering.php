<?php
$pagina = "catering";

include "conexion.php";
include "util.php";

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
<link rel="shortcut icon" type="image/x-icon" href="images/icon.png" />
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

<!-- JavaScripts -->
<script src="js/modernizr.js"></script>

<!-- Online Fonts -->
<link href='https://fonts.googleapis.com/css?family=Alex+Brush' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Josefin+Sans:400,300,600,600italic,700italic,100' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,600,300,800' rel='stylesheet' type='text/css'>

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
    
  </section>
  
  <!-- Content -->
  <div id="content"> 
    
    <!-- About -->
    <section class="about tri-white-top padding-top-100 padding-bottom-100" id="about" style="background-color: #000;">
      <div class="container" style="background-image: url('images/ybg.jpg');background-repeat: no-repeat; background-size: 100% 100%;"> 
		
				<!-- Heading Block -->
				<div class="heading" style="margin-bottom: 40px; margin-top: 40px; text-align: center;">
					<span>Our trays</span>
					<h3>Catering</h3>
				</div>
	 
				<div class='list-group gallery'>
			
					<div class='col-sm-12'>
						<a class="thumbnail fancybox" rel="ligthbox" href="images/catering-side-1.jpg">
							<img class="img-responsive" alt="" src="images/catering-side-1.jpg" style="width: 100%;" />
							<div class='text-right'>
								<small class='text-muted'>Catering menu #1</small>
							</div> <!-- text-right / end    dough-boys-catering-Proof-2017 -->
						</a>
					</div> <!-- col-6 / end -->
					
					<div class='col-sm-12'>
						<a class="thumbnail fancybox" rel="ligthbox" href="images/catering-side-2.jpg">
							<img class="img-responsive" alt="" src="images/catering-side-2.jpg" style="width: 100%;" />
							<div class='text-right'>
								<small class='text-muted'>Catering menu #2</small>
							</div> <!-- text-right / end -->
						</a>
					</div> <!-- col-6 / end -->
					
        </div> <!-- list-group / end -->

      </div>
    </section>
    
    <?php include "promobox.php"; ?>
    
		<?php include "contact.php"; ?>
		<?php include "map.php"; ?>
  </div>
  <?php include "footer.php"; ?>
  
  <!-- RIGHTS -->
  <section class="rights tri-white-top">
    <div class="container">
      <p>Copyright 2017 © Doughboys Pizzeria and Italian Restaurant. All rights reserved. Powered by Mark V Press</p>
    </div>
  </section>
</div>

<script src="js/jquery-1.11.3.min.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/own-menu.js"></script> 
<script src="js/owl.carousel.min.js"></script> 
<!-- SLIDER REVOLUTION 4.x SCRIPTS  --> 
<script type="text/javascript" src="rs-plugin/js/jquery.tp.t.min.js"></script> 
<script type="text/javascript" src="rs-plugin/js/jquery.tp.min.js"></script> 
<script src="js/main.js"></script> 

<!-- Begin Map Script --> 
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script> 
<script src="js/map.js"></script>
</body>
</html>
<script type="text/javascript">
$(document).ready(function () {


    //FANCYBOX
    //https://github.com/fancyapps/fancyBox
    $(".fancybox").fancybox({
        openEffect: "none",
        closeEffect: "none"
    });

   
  

	var ultimacat = "alfredocalzones";
	var ultimoing = ["any"];
	
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
  background-color: #de3b30;
  text-shadow: 0 1px hsla(0, 0%, 100%, 0.5);
  color: #222;
}

.button:active,
.button.is-checked {
  background-color: #de3b30;
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

.gallery
{
    display: inline-block;
    margin-top: 20px;
}
</style>
<script src="js/isotope.pkgd.min.js"></script>
<!-- References: https://github.com/fancyapps/fancyBox -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
<script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>

<?php
$pagina = "index";

include "conexion.php";
include "util.php";

/*
Orden en productos
old world -> dice our world
cambio de texto
email + nombre -> cupon

*/
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
    
    <!-- SLIDE Start -->
    <div class="tp-banner-container">
      <div class="tp-home">
        <ul>
          <!-- SLIDE  -->
          <li data-transition="random" data-slotamount="7" data-masterspeed="300"  data-saveperformance="off" > 
            <!-- MAIN IMAGE --> 
            <img src="images/slide-bg-1.jpg"  alt="slider"  data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat"> 
            <!-- LAYERS --> 
            
            <!-- LAYER NR. 1  background-color: rgba(200, 200, 200,0.7);  -->
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
                style="z-index: 7; font-size:60px; color:#fff; background-color: rgba(191, 36, 36, 0.7); max-width: auto; max-height: auto; white-space: nowrap; text-shadow: 2px 2px 2px #000;">Doughboys Serving Ft Lauderdale Since 1984</div><!-- text-shadow: 2px 2px 1px #fff; color:#01826c;  -->
            
            <!-- LAYER NR. 2 -->
            <div class="tp-caption sfb font-josefin font-bold tp-resizeme" 
                data-x="center" data-hoffset="0" 
                data-y="center" data-voffset="20" 
                data-speed="800" 
                data-start="1200" 
                data-easing="Power3.easeInOut" 
                data-splitin="words" 
                data-splitout="none" 
                data-elementdelay="0.07" 
                data-endelementdelay="0.1" 
                data-endspeed="300" 
                style="z-index: 6; font-size:80px; top:213px; background-color: rgba(191, 36, 36, 0.7); color: #fff; text-shadow: 2px 2px 2px #000; text-transform:uppercase; white-space: nowrap; ">Italian Style </div>
            
            <!-- LAYER NR. 3 -->
            <div class="tp-caption lfb" 
                data-x="center" data-hoffset="0" 
                data-y="center" data-voffset="100" 
                data-speed="800" 
                data-start="1400" 
                data-easing="Power3.easeInOut" 
                data-elementdelay="0.1" 
                data-endelementdelay="0.1" 
                data-endspeed="300" 
                data-scrolloffset="0"
                style="z-index: 8;"><img src="images/bnr-bar.png" alt=""> </div>
            
            <!-- LAYER NR. 4 -->
            <div class="tp-caption lfb tp-resizeme" 
                data-x="center" data-hoffset="0" 
                data-y="center" data-voffset="160" 
                data-speed="800" 
                data-start="1600" 
                data-easing="Power3.easeInOut" 
                data-elementdelay="0.1" 
                data-endelementdelay="0.1" 
                data-endspeed="300" 
                data-scrolloffset="0"
                style="z-index: 8;"><a href="https://ordering.chownow.com/order/5203/locations?add_cn_ordering_class=true" target="_blank" class="btn btn-round" style="background: #fff; color: #ab4e52;">Order Now Online <i class="fa fa-long-arrow-right"></i></a> </div>
          </li>
          
          <!-- SLIDE  -->
          <li data-transition="random" data-slotamount="7" data-masterspeed="300"  data-saveperformance="off" > 
            <!-- MAIN IMAGE --> 
            <img src="images/slide-bg-2.jpg"  alt="slider"  data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat"> 
            <!-- LAYERS --> 
           
            <!-- LAYER NR. 3 -->
            <div class="tp-caption lfb" 
                data-x="center" data-hoffset="0" 
                data-y="center" data-voffset="80" 
                data-speed="800" 
                data-start="1400" 
                data-easing="Power3.easeInOut" 
                data-elementdelay="0.1" 
                data-endelementdelay="0.1" 
                data-endspeed="300" 
                data-scrolloffset="0"
                style="z-index: 8;"><img src="images/miami-herald.jpg" alt=""> </div>
            
          </li>
					
           <!-- SLIDE  -->
          <li data-transition="random" data-slotamount="7" data-masterspeed="300" data-saveperformance="off" > 
            <!-- MAIN IMAGE --> 
            <img src="images/slide-bg-3.jpg" alt="slider" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat"> 
            <!-- LAYERS --> 
            
            
            <!-- LAYER NR. 3 -->
            <div class="tp-caption lfb" 
                data-x="center" data-hoffset="0" 
                data-y="center" data-voffset="80" 
                data-speed="800" 
                data-start="1400" 
                data-easing="Power3.easeInOut" 
                data-elementdelay="0.1" 
                data-endelementdelay="0.1" 
                data-endspeed="300" 
                data-scrolloffset="0"
                style="z-index: 8;"><img src="images/new-times.jpg" alt=""> </div>
          </li>
					
           <!-- SLIDE  -->
          <li data-transition="random" data-slotamount="7" data-masterspeed="300" data-saveperformance="off" > 
            <!-- MAIN IMAGE --> 
            <img src="images/slide-bg-3.jpg" alt="slider" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat"> 
            <!-- LAYERS --> 
            
            <!-- LAYER NR. 3 -->
            <div class="tp-caption lfb" 
                data-x="center" data-hoffset="0" 
                data-y="center" data-voffset="80" 
                data-speed="800" 
                data-start="1400" 
                data-easing="Power3.easeInOut" 
                data-elementdelay="0.1" 
                data-endelementdelay="0.1" 
                data-endspeed="300" 
                data-scrolloffset="0"
                style="z-index: 8;"><img src="images/sentinel.jpg" alt=""> </div>
						
          </li>
          
           <!-- SLIDE  -->
          <li data-transition="random" data-slotamount="7" data-masterspeed="300" data-saveperformance="off" > 
            <!-- MAIN IMAGE --> 
            <img src="images/slide-bg-3.jpg" alt="slider" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat"> 
            <!-- LAYERS --> 
            
            <!-- LAYER NR. 1 -->
            <div class="tp-caption font-alex sft tp-resizeme" 
                data-x="center" data-hoffset="0" 
                data-y="center" data-voffset="-100" 
                data-speed="800" 
                data-start="800" 
                data-easing="Power3.easeInOut" 
                data-splitin="words" 
                data-splitout="none" 
                data-elementdelay="0.1" 
                data-endelementdelay="0.1" 
                data-endspeed="300" 
                style="z-index: 7; font-size:38px; background-color: rgba(0, 126, 100, 0.7); color: #fff; text-shadow: 2px 2px 2px #000; max-width: auto; max-height: auto; white-space: nowrap;">As featured on the nationally syndicated TV show</div>
            
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
                style="z-index: 6; font-size:60px; background-color: rgba(0, 126, 100, 0.7); color: #fff; text-shadow: 2px 2px 2px #000; text-transform:uppercase; white-space: nowrap;">"Best in Chow" </div>
            
            <!-- LAYER NR. 3 -->
            <div class="tp-caption lfb" 
                data-x="center" data-hoffset="0" 
                data-y="center" data-voffset="80" 
                data-speed="800" 
                data-start="1400" 
                data-easing="Power3.easeInOut" 
                data-elementdelay="0.1" 
                data-endelementdelay="0.1" 
                data-endspeed="300" 
                data-scrolloffset="0"
                style="z-index: 8;"><img src="images/bnr-bar.png" alt=""> </div>
            
            <!-- LAYER NR. 4 -->
            <div class="tp-caption lfb tp-resizeme" 
                data-x="center" data-hoffset="0" 
                data-y="center" data-voffset="160" 
                data-speed="800" 
                data-start="1600" 
                data-easing="Power3.easeInOut" 
                data-elementdelay="0.1" 
                data-endelementdelay="0.1" 
                data-endspeed="300" 
                data-scrolloffset="0"
                style="z-index: 8;"><a href="https://ordering.chownow.com/order/5203/locations?add_cn_ordering_class=true" target="_blank" class="btn btn-round" style="background: #fff; color: #ab4e52;">Order Now Online <i class="fa fa-long-arrow-right"></i></a> </div>
          </li>
          
					<?php if (false){ ?>
					
          <!-- SLIDE  -->
          <li data-transition="random" data-slotamount="7" data-masterspeed="300"  data-saveperformance="off" > 
            <!-- MAIN IMAGE --> 
            <img src="images/slide-bg-3.jpg"  alt="slider"  data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat"> 
            <!-- LAYERS --> 
            
            <!-- LAYER NR. 1 -->
            <div class="tp-caption font-josefin sfb" 
                data-x="center" data-hoffset="0" 
                data-y="center" data-voffset="-20" 
                data-speed="800" 
                data-start="800" 
                data-easing="Power3.easeInOut" 
                data-splitin="none" 
                data-splitout="none" 
                data-elementdelay="0.1" 
                data-endelementdelay="0.1" 
                data-endspeed="300">
              <div class="zip-code">
                <form>
                  <label>
                    <input type="search" placeholder="Enter your zip code">
                  </label>
                  <button type="submit"><i class="fa fa-angle-double-right"></i></button>
                </form>
              </div>
            </div>
            
            <!-- LAYER NR. 2 --> 
            
            <!-- LAYER NR. 3 -->
            <div class="tp-caption lfb" 
                data-x="center" data-hoffset="0" 
                data-y="center" data-voffset="80" 
                data-speed="800" 
                data-start="1400" 
                data-easing="Power3.easeInOut" 
                data-elementdelay="0.1" 
                data-endelementdelay="0.1" 
                data-endspeed="300" 
                data-scrolloffset="0"
                style="z-index: 8;"><img src="images/bnr-bar.png" alt=""> </div>
            
            <!-- LAYER NR. 4 -->
            <div class="tp-caption lfb tp-resizeme" 
                data-x="center" data-hoffset="0" 
                data-y="center" data-voffset="160" 
                data-speed="800" 
                data-start="1600" 
                data-easing="Power3.easeInOut" 
                data-elementdelay="0.1" 
                data-endelementdelay="0.1" 
                data-endspeed="300" 
                data-scrolloffset="0"
                style="z-index: 8;"><a href="https://ordering.chownow.com/order/5203/locations?add_cn_ordering_class=true" class="btn btn-round">Order Now Online <i class="fa fa-long-arrow-right"></i></a> </div>
          </li>
					<?php } ?>
				
        </ul>
      </div>
    </div>
  </section>
  
  <!-- Content -->
  <div id="content">
	
    <?php include "promobox.php"; ?>
    
    <!-- About -->
    <section class="about tri-white-top padding-top-100 padding-bottom-100" id="about">
      <div class="container"> 
        
        <!-- Heading Block -->
        <div class="heading text-center"> <span>Since 1984</span>
          <h3>The best pizza in Fort Lauderdale</h3>
          <hr>
          <i class="fa fa-bookmark-o"></i> </div>
        <div class="row"> 
          
          <!-- About Images -->
          <div class="col-md-6">
            <ul class="row">
              <li class="col-xs-4"> <img class="img-responsive" src="images/about-img-1.jpg" alt="" > </li>
              <li class="col-xs-4"> <img class="img-responsive" src="images/about-img-2.jpg" alt="" > </li>
              <li class="col-xs-4"> <img class="img-responsive" src="images/about-img-3.jpg" alt="" > </li>
            </ul>
          </div>
          
          <!-- About Text -->
          <div class="col-md-6">
            <div class="about-text text-center">
              <h1>About the<br> <span>Doughboys</span></h1>
              <p>We are the “Dough Boys”!</p>
							<p>Actually, we are identical twin brothers whose passion and family history in the restaurant business dates back generations.</p>
              <a href="world.php" class="btn btn-small btn-round btn-dark margin-top-30">Read More</a> </div>
          </div>
        </div>
      </div>
    </section>
    
    <!-- Quality Matters -->
    <section class="quaility-img tri-white-top padding-top-150 padding-bottom-150" id="restaurant">
      <div class="container"> 
        
        <!-- Heading Block -->
        <div class="heading text-center white margin-bottom-0"> <span style="color: #fff; text-shadow: 2px 2px 2px #000;">Quality Matters</span>
          <h3 style="color: #fff; text-shadow: 2px 2px 2px #000;">We use only The best ingredients</h3>
          <hr>
          <i class="fa fa-bookmark-o"></i> </div>
      </div>
    </section>
    
    <!-- Our Restaurant -->
    <section class="inside-resturant tri-white-top padding-top-150 padding-bottom-150">
      <div class="container"> 
        
        <!-- Heading Block -->
        <div class="heading text-center"> <span>We offer the yummiest food in town</span>
          <h3>
					Our Extended Hours are very convenient
					<br>Experience our food through:
					<br>Dine In - Delivery - Pick-up</h3>
          <hr>
          <i class="fa fa-bookmark-o"></i> </div>
        
        <!-- Resturant Img -->
        <div class="resturant-img margin-bottom-60"> <img class="img-responsive" src="images/35-years.jpg" alt="35 Years - Doughboys" style="width: 100%;" > </div>
        
        <!-- Intro Text -->
        <div class="col-md-7 center-block">
          <div class="about-text text-center">
            <h1><span>Our<br>catering</span></h1>
            <h3>Our catering packages are professionally prepared and beautifully presented using only the finest name brand ingredients from corporate parties the yachting excursions or party platters one present to let your guests know matter the budget</h3>
						<a href="catering.php" class="btn btn-small btn-round btn-dark margin-top-30">Read More</a>
          </div>
        </div>
      </div>
    </section>
    <?php if (false) { ?>
    <!-- Testimonial -->
    <section class="testimonial tri-white-top padding-top-100 padding-bottom-150" id="testimonials">
      <div class="container"> 
        
        <!-- Heading Block -->
        <div class="heading text-center white"> <span>Testimonials</span>
          <h3>What They Say About Us</h3>
          <hr>
          <i class="fa fa-bookmark-o"></i> </div>
        
        <!-- Testi Slide -->
        <div class="item-slide"> 
          
          <!-- Testi Slide -->
          <div class="item-inn"> <img src="images/avatar-1.jpg" alt="" >
            <h5>George Lee</h5>
            <i class="fa fa-star"></i>
            <p>We love Italy, we love italian food. Visit at Doughboys was nothing less than pleasure.</p>
          </div>
          
          <!-- Testi Slide -->
          <div class="item-inn"> <img src="images/avatar-2.jpg" alt="" >
            <h5>Emily Brown</h5>
            <i class="fa fa-star"></i>
            <p>We love Italy, we love italian food. Visit at Doughboys was nothing less than pleasure.</p>
          </div>
          
          <!-- Testi Slide -->
          <div class="item-inn"> <img src="images/avatar-3.jpg" alt="" >
            <h5>George Lee</h5>
            <i class="fa fa-star"></i>
            <p>We love Italy, we love italian food. Visit at Doughboys was nothing less than pleasure.</p>
          </div>
          
          <!-- Testi Slide -->
          <div class="item-inn"> <img src="images/avatar-4.jpg" alt="" >
            <h5>Emily Brown</h5>
            <i class="fa fa-star"></i>
            <p>We love Italy, we love italian food. Visit at Doughboys was nothing less than pleasure.</p>
          </div>
          
          <!-- Testi Slide -->
          <div class="item-inn"> <img src="images/avatar-2.jpg" alt="" >
            <h5>George Lee</h5>
            <i class="fa fa-star"></i>
            <p>We love Italy, we love italian food. Visit at Doughboys was nothing less than pleasure.</p>
          </div>
          
          <!-- Testi Slide -->
          <div class="item-inn"> <img src="images/avatar-3.jpg" alt="" >
            <h5>Emily Brown</h5>
            <i class="fa fa-star"></i>
            <p>We love Italy, we love italian food. Visit at Doughboys was nothing less than pleasure.</p>
          </div>
        </div>
      </div>
    </section>
	<?php } ?>

    <section class="pizza-mia tri-white-top padding-top-50 padding-bottom-50">
      <div class="container"> 
        
        <!-- Heading Block -->
        <div class="heading text-center white margin-bottom-20"> <span>Doughboys Pizzeria and Italian Restaurant</span>
          <h3>Order Now!</h3>
          <hr>
          <i class="fa fa-bookmark-o"></i> </div>
        <div class="text-center"> <a href="https://ordering.chownow.com/order/5203/locations?add_cn_ordering_class=true" target="_blank" class="btn btn-small margin-left-20 btn-round margin-top-30">Here</a> </div>
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

<!-- Begin Map Script --> 
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script> 
<script src="js/map.js"></script>
</body>
</html>
<script type="text/javascript">
$(document).ready(function () {

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
</style>
<script src="js/isotope.pkgd.min.js"></script>

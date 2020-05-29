<?php
function LimpiarURL($valor){
	$valor = str_replace("_", "-", $valor);
	$valor = str_replace(" ", "-", $valor);
	return $valor;
}
?>
  <!-- header -->
  <header>
    <div class="sticky">
      <div class="container"> 
        
        <!-- Logo  style="top: -10px;" -->
        <div class="logo"> <a href="index.php"><img class="img-responsive" src="images/logo.png" alt="" ></a> </div>
        <!-- Navigation -->
        <nav class="navbar" style="background-color: #000000;"> 
          <!-- NAV -->
          <ul class="nav ownmenu">
            <li class="scroll"> <a href="index.php" class="topmenu">Home </a></li>
            <!--
						<li class="scroll"> <a href="index.php#about">About Us </a> </li>
            -->
						<li class="scroll active"> <a href="#menu" class="topmenu">Appetizers </a>
							<ul class="dropdown">
								<li> <a href="menu-<?php echo LimpiarURL("Appetizers"); ?>_28">Appetizers</a> </li>
								<li> <a href="menu-<?php echo LimpiarURL("Soups"); ?>_29">Soups</a> </li>
								<li> <a href="menu-<?php echo LimpiarURL("Sides"); ?>_30">Sides</a> </li>
								<?php
								/*
								$sql = "SELECT * FROM categorias c WHERE id_tipo_categoria = 2 ORDER BY c.id_tipo_categoria, orden, nombre ";
								$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
								$i = 0;
								while($row = mysqli_fetch_array($rs)) {
									?><li> <a href="menu-<?php echo LimpiarURL($row["nombre"]); ?>_<?php echo $row["id_categoria"]; ?>"><?php echo $row["nombre"]; ?></a> </li><?php
								}
								*/
								?>
							</ul>
						</li>
            <li class="scroll active"> <a href="#menu" class="topmenu">Salads </a>
							<ul class="dropdown">
								<li> <a href="menu-<?php echo LimpiarURL("Sensasional Salads"); ?>_17">Sensasional Salads</a> </li>
								<li> <a href="menu-<?php echo LimpiarURL("Lunch Specials"); ?>_10">Lunch Specials</a>
									<ul class="dropdown">
										<li> <a href="menu-<?php echo LimpiarURL("Daily Specials"); ?>_9">Daily Specials</a> </li>
										<li> <a href="menu-<?php echo LimpiarURL("Hot Subs"); ?>_121">Hot Subs Lunch Special</a> </li>
										<li> <a href="menu-<?php echo LimpiarURL("Cold Subs"); ?>_122">Cold Subs Lunch Special</a> </li>
										<li> <a href="menu-<?php echo LimpiarURL("2 Slice Special"); ?>_9">2 Slice Special</a> </li>
									</ul>
								</li>
								<?php
								/*
								$sql = "SELECT * FROM categorias c WHERE id_tipo_categoria = 3 ORDER BY c.id_tipo_categoria, orden, nombre ";
								$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
								$i = 0;
								while($row = mysqli_fetch_array($rs)) {
									?><li> <a href="menu-<?php echo LimpiarURL($row["nombre"]); ?>_<?php echo $row["id_categoria"]; ?>"><?php echo $row["nombre"]; ?></a> </li><?php
								}
								*/
								?>
							</ul>
						</li>
						<li class="scroll active"> <a href="#menu" class="topmenu">Sandwiches </a>
							<ul class="dropdown">
								<li> <a href="menu-<?php echo LimpiarURL("Croissant Sandwiches"); ?>_19">Croissant Sandwiches</a> </li>
								<li> <a href="menu-<?php echo LimpiarURL("Pita Pockets"); ?>_18">Pita Pockets</a> </li>
								<li> <a href="menu-<?php echo LimpiarURL("Hot Subs"); ?>_121">Hot Subs</a> </li>
								<li> <a href="menu-<?php echo LimpiarURL("Cold Subs"); ?>_122">Cold Subs</a> </li>
								<li> <a href="menu-<?php echo LimpiarURL("Wraps"); ?>_16">Wraps</a> </li>
								<li> <a href="menu-<?php echo LimpiarURL("Soups"); ?>_29">Soups</a> </li>
								<li> <a href="menu-<?php echo LimpiarURL("Sides"); ?>_30">Sides</a> </li>
								<li> <a href="menu-<?php echo LimpiarURL("Lunch Specials"); ?>_10">Lunch Specials</a>
									<ul class="dropdown">
										<li> <a href="menu-<?php echo LimpiarURL("Daily Specials"); ?>_9">Daily Specials</a> </li>
										<li> <a href="menu-<?php echo LimpiarURL("Hot Subs"); ?>_121">Hot Subs Lunch Special</a> </li>
										<li> <a href="menu-<?php echo LimpiarURL("Cold Subs"); ?>_122">Cold Subs Lunch Special</a> </li>
										<li> <a href="menu-<?php echo LimpiarURL("2 Slice Special"); ?>_9">2 Slice Special</a> </li>
									</ul>
								</li>
								<?php
								/*
								$sql = "SELECT * FROM categorias c WHERE id_tipo_categoria = 3 ORDER BY c.id_tipo_categoria, orden, nombre ";
								$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
								$i = 0;
								while($row = mysqli_fetch_array($rs)) {
									?><li> <a href="menu-<?php echo LimpiarURL($row["nombre"]); ?>_<?php echo $row["id_categoria"]; ?>"><?php echo $row["nombre"]; ?></a> </li><?php
								}
								*/
								?>
							</ul>
						</li>
						<li class="scroll active"> <a href="#menu" class="topmenu">Pizza </a>
							<ul class="dropdown">
								<li> <a href="menu-<?php echo LimpiarURL("Traditional Pizza"); ?>_4">Traditional</a> </li>
								<li> <a href="menu-<?php echo LimpiarURL("Super Thick Sicilian"); ?>_5">Thick Sicilian</a> </li>
								<li> <a href="menu-<?php echo LimpiarURL("Specialty Pizza"); ?>_3">Specialty</a> </li>
								<li> <a href="menu-<?php echo LimpiarURL("Old World Style"); ?>_12">Old World Style</a> </li>
								<li> <a href="menu-<?php echo LimpiarURL("Stromboli"); ?>_1">Stromboli</a> </li>
								<li> <a href="menu-<?php echo LimpiarURL("Calzone"); ?>_1">Calzone</a> </li>
								<li> <a href="menu-<?php echo LimpiarURL("Alfredo Calzone"); ?>_2">Alfredo Calzone</a> </li>
								<li> <a href="menu-<?php echo LimpiarURL("By The Slice"); ?>_31">By The Slice</a> </li>
								<li> <a href="menu-<?php echo LimpiarURL("Soups"); ?>_29">Soups</a> </li>
								<li> <a href="menu-<?php echo LimpiarURL("Toppings"); ?>_6">Toppings</a> </li>
								<?php
								/*
								$sql = "SELECT * FROM categorias c WHERE id_tipo_categoria = 1 ORDER BY c.id_tipo_categoria, orden, nombre ";
								$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
								$i = 0;
								while($row = mysqli_fetch_array($rs)) {
									?><li> <a href="menu-<?php echo LimpiarURL($row["nombre"]); ?>_<?php echo $row["id_categoria"]; ?>"><?php echo $row["nombre"]; ?></a> </li><?php
								}
								*/
								?>
							</ul>
						</li>
						<li class="scroll active"> <a href="#menu" class="topmenu">Main Dishes </a>
							<ul class="dropdown">
								<li> <a href="menu-<?php echo LimpiarURL("Home Made Pasta"); ?>_23">Home Made Pasta</a> </li>
								<li> <a href="menu-<?php echo LimpiarURL("Italian Specialties"); ?>_25">Italian Specialties</a> </li>
								<li> <a href="menu-<?php echo LimpiarURL("Seafood"); ?>_26">Seafood</a> </li>
								<li> <a href="menu-<?php echo LimpiarURL("Appetizers"); ?>_28">Appetizers</a> </li>
								<li> <a href="menu-<?php echo LimpiarURL("Lunch Specials"); ?>_10">Lunch Specials</a>
									<ul class="dropdown">
										<li> <a href="menu-<?php echo LimpiarURL("Daily Specials"); ?>_9">Daily Specials</a> </li>
										<li> <a href="menu-<?php echo LimpiarURL("Hot Subs"); ?>_121">Hot Subs Lunch Special</a> </li>
										<li> <a href="menu-<?php echo LimpiarURL("Cold Subs"); ?>_122">Cold Subs Lunch Special</a> </li>
										<li> <a href="menu-<?php echo LimpiarURL("2 Slice Special"); ?>_9">2 Slice Special</a> </li>
									</ul>
								</li>
								<?php
								/*
								$sql = "SELECT * FROM categorias c WHERE id_tipo_categoria = 1 ORDER BY c.id_tipo_categoria, orden, nombre ";
								$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
								$i = 0;
								while($row = mysqli_fetch_array($rs)) {
									?><li> <a href="menu-<?php echo LimpiarURL($row["nombre"]); ?>_<?php echo $row["id_categoria"]; ?>"><?php echo $row["nombre"]; ?></a> </li><?php
								}
								*/
								?>
							</ul>
						</li>
						<li class="scroll active"> <a href="#menu" class="topmenu">Desserts &amp; Beverages </a>
							<ul class="dropdown">
								<li> <a href="menu-<?php echo LimpiarURL("Desserts"); ?>_13">Desserts</a> </li>
								<li> <a href="menu-<?php echo LimpiarURL("Beverages"); ?>_11">Beverages</a> </li>
								<?php
								/*
								$sql = "SELECT * FROM categorias c WHERE id_tipo_categoria = 4 ORDER BY c.id_tipo_categoria, orden, nombre ";
								$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
								$i = 0;
								while($row = mysqli_fetch_array($rs)) {
									?><li> <a href="menu-<?php echo LimpiarURL($row["nombre"]); ?>_<?php echo $row["id_categoria"]; ?>"><?php echo $row["nombre"]; ?></a> </li><?php
								}
								*/
								?>
							</ul>
						</li>
						<!--
            <li class="scroll"> <a href="index.php#restaurant">Restaurant </a> </li>
            <li class="scroll"> <a href="#testimonials">Testimonials </a> </li>
            <li class="scroll"> <a href="world.php" class="topmenu">DB's World </a> </li>
            <li class="scroll"> <a href="coupons.php" class="topmenu">Coupons </a> </li>
						
						<li> <a href="world.php" class="topmenu">DB's World </a>
              <ul class="dropdown right animated-3s fadeIn">
                <li> <a href="gallery.php">Gallery</a>
									<ul class="dropdown right animated-3s fadeIn">
										<li> <a href="catering.php">Inside</a> </li>
										<li> <a href="world.php">Again</a> </li>
									</ul>
								</li>
                <li> <a href="catering.php">Catering</a> </li>
                <li> <a href="world.php">About us</a> </li>
              </ul>
            </li>
						-->
						
						<!--
            <li class="scroll"> <a href="catering.php" class="topmenu">Catering </a> </li>

            <li class="scroll"> <a href="index.php#contact">Contact </a> </li>
            <li> <a href="index.php">Pages </a>
              <ul class="dropdown right animated-3s fadeIn">
                <li> <a href="02-Composer-Step1.html">Composer Step 1</a> </li>
                <li> <a href="03-Composer-Step2.html">Composer Step 2</a> </li>
                <li> <a href="04-Composer-Step3a.html">Composer Step 3a</a> </li>
                <li> <a href="05-Composer-Step3b.html">Composer Step 3b</a> </li>
                <li> <a href="06-Composer-Step3c.html">Composer Step 3c</a> </li>
                <li> <a href="Composer-SinglePage-MultiPizza.html">Composer Multi Pizza</a> </li>
                <li> <a href="Composer-SinglePage-SinglePizza.html">Composer Single Pizza</a> </li>
              </ul>
            </li>
						-->
          </ul>
          
          <div class="nav-right" style="padding: 5px 0px;">
						<div style="color:#fff;">
							<a href="https://www.facebook.com/DOUGHBOYSftl"><i class="fa fa-facebook"></i></a>
							<a href="https://twitter.com/DoughboysFtl"><i class="fa fa-twitter"></i></a>
							<a href="https://www.pinterest.com/doughboysftlaud/"><i class="fa fa-pinterest"></i></a>
							<a href="http://www.linkedin.com/in/randygreenfi"><i class="fa fa-linkedin-square"></i></a>
						</div>
					</div>
          <!-- Nav Right 
          <div class="nav-right"> <a href="02-Composer-Step1.html" class="compose">Compose Pizza <i class="fa fa-check-square-o"></i></a> </div>
					-->
        </nav>
      </div>
    </div>
  </header>
	<style>
	.topmenu{
	z-index: 6; font-size:80px; color:#fff; text-transform:uppercase; white-space: nowrap; text-shadow: 2px 2px 2px #000;
	}
	</style>
<?php
$pagina = "products";

include "sesion.php";
include "conexion.php";
include "util.php";
include "util-products.php";

foreach ($_GET['listItem'] as $orden => $idproducto) {
  $res = ModificarOrdenProducto( $link, $idproducto, ($orden+1) );
}

echo "OK";
//""
?>
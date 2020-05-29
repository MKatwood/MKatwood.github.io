<?php

/*
	
	
	$stmt = $dbConnection->prepare('SELECT * FROM employees WHERE name = ?');
	$stmt->bind_param('s', $name); // 's' specifies the variable type => 'string'

	$stmt->execute();

	$result = $stmt->get_result();
	while ($row = $result->fetch_assoc()) {
		// do something with $row
	}

	*/

	
/*********************************
* TraerProduct($link, $idproduct)
*  -> $link : conexion a la base de datos
*  -> $idcliente : id del cliente
*  <- row con producto
**********************************/
function TraerProduct($link, $idproduct){
	$idproduct = $link->real_escape_string($idproduct);
	$idproduct = intval($idproduct);

	$sql = "SELECT p.*, c.title_size_1 AS cat_tit_size_1, c.title_size_2 AS cat_tit_size_2, c.title_size_3 AS cat_tit_size_3, c.title_size_4 AS cat_tit_size_4 FROM productos p LEFT JOIN categorias c ON c.id_categoria = p.id_categoria WHERE id_producto = $idproduct ";
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	if ($row = mysqli_fetch_array($rs)) {
		return $row;
	}
	return null;
}


/*********************************
* ListadoProducts($link, $fechadesde = "", $fechahasta = "", $idsocio = -1, $idusuario = 0, $pagina = 1, $cantidad = 20)
*  -> $link : conexion a la base de datos
*  -> $fechadesde : fecha desde (DEFAULT: "" -> Sin limite desde)
*  -> $fechahasta : fecha hasta (DEFAULT: "" -> Sin limite hasta)
*  -> $idsocio : id del socio (DEFAULT: -1 -> Todos)
*  -> $idusuario : id del usuario (DEFAULT: 0 -> Todos)
*  -> $pagina : numero de pagina desde donde trae (DEFAULT: 0 -> el inicio)
*  -> $cantidad : cantidad de recibos que trae (DEFAULT: 5)
*  <- HTML con tabla de productos
**********************************/
function ListadoProducts($link, $consulta = "", $idcategoria = 0, $pagina = 1, $cantidad = 20){
	$consulta = $link->real_escape_string($consulta);
	$idcategoria = $link->real_escape_string($idcategoria);
	$pagina = $link->real_escape_string($pagina);
	$cantidad = $link->real_escape_string($cantidad);
	
	//examino la página a mostrar y el inicio del producto a mostrar
	$inicio = ($pagina - 1) * $cantidad;

	$sql = "SELECT c.* FROM categorias c WHERE c.id_categoria = $idcategoria ";
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	if ($row = mysqli_fetch_array($rs)) {
		$titsize1 = $row["title_size_1"];
		$titsize2 = $row["title_size_2"];
		$titsize3 = $row["title_size_3"];
		$titsize4 = $row["title_size_4"];
	}

	//miro a ver el número total de campos que hay en la tabla
	$sql = "SELECT * FROM productos p WHERE 1 = 1 ";
	if ($idcategoria > 0){
		$sql .= " AND p.id_categoria = $idcategoria ";
	}
	if ($consulta != ""){
		$searchTerms = explode(' ', $consulta);
		$searchTermBits = array();
		foreach ($searchTerms as $term) {
			$term = trim($term);
			if (!empty($term)) {
				$searchTermBits[] = "(p.nombre LIKE '%$term%' OR p.descripcion LIKE '%$term%')";
			}
		}
		$sql .= " AND " . implode(' AND ', $searchTermBits);
	}
	
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	$num_total_productos = mysqli_num_rows($rs);

	//calculo el total de páginas
	$total_paginas = ceil($num_total_productos / $cantidad);

	$sql = "SELECT p.*, c.nombre AS categoria
	FROM productos p INNER JOIN categorias c ON c.id_categoria = p.id_categoria
	WHERE 1 = 1 ";
	if ($idcategoria > 0){
		$sql .= " AND p.id_categoria = $idcategoria ";
	}
	if ($consulta != ""){
		$searchTerms = explode(' ', $consulta);
		$searchTermBits = array();
		foreach ($searchTerms as $term) {
			$term = trim($term);
			if (!empty($term)) {
				$searchTermBits[] = "(p.nombre LIKE '%$term%' OR p.descripcion LIKE '%$term%')";
			}
		}
		$sql .= " AND " . implode(' AND ', $searchTermBits);
	}
	$sql .= " ORDER BY orden, nombre LIMIT $inicio, $cantidad";
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	?>
	<div class="table-responsive">
		<table class="table table-condensed table-bordered">
			<tr>
				<th>name</th>
				<th>category</th>
				<th>price #1 (<?php echo $titsize1; ?>)</th>
				<th>price #2 (<?php echo $titsize2; ?>)</th>
				<th>price #3 (<?php echo $titsize3; ?>)</th>
				<th>price #4 (<?php echo $titsize4; ?>)</th>
				<th>order</th>
				<th></th>
			</tr>
			<tbody class="ordertab">
			<?php
			$cant = 0;
			while($row = mysqli_fetch_array($rs)) {
				$cant++;
				$orden = $row["orden"];
				if ($orden == "" || $orden == 0){
					$orden = $cant;
					//echo "OJO";
					ModificarOrdenProducto($link, $row['id_producto'], $orden);
					//
				}
				?>
				<tr id="listItem_<?php echo $row['id_producto']; ?>">
					<td><?php echo $row['nombre']; ?></td>
					<td><?php echo $row['categoria']; ?></td>
					<td><?php if ($row['tit_size_1'] != "") { echo $row['tit_size_1'] . ": " ; } echo $row['size_1']; ?></td>
					<td><?php if ($row['tit_size_2'] != "") { echo $row['tit_size_2'] . ": " ; } echo $row['size_2']; ?></td>
					<td><?php if ($row['tit_size_3'] != "") { echo $row['tit_size_3'] . ": " ; } echo $row['size_3']; ?></td>
					<td><?php if ($row['tit_size_4'] != "") { echo $row['tit_size_4'] . ": " ; } echo $row['size_4']; ?></td>
					<td class="handle" style="cursor: move;"><i class="fas fa-arrows-alt"></i></td>
					<td class="text-center">
						<a class="btn btn-success btn-xs" href="products.php?e=1&id=<?php echo $row['id_producto']; ?>">edit</a>&nbsp;
						<span class="btn btn-danger btn-xs btndelete" pid="<?php echo $row['id_producto']; ?>" desc="<?php echo $row['nombre']; ?>" >delete</span>
					</td>
				</tr>
				<?php
			}
			?>
			</tbody>
		</table>
		<?php Paginado($pagina, $total_paginas, "products", "&q=".$consulta); ?>
	</div>
	<?php
}

function ModificarOrdenProducto($link, $idproducto, $orden){
	$idproducto = $link->real_escape_string($idproducto);
	$orden = $link->real_escape_string($orden);
	
	$sql = "UPDATE productos SET orden = '$orden' WHERE id_producto = $idproducto ;";
	
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	return true;
	
}

function InsertarProduct($link, $idcategoria, $nombre, $descripcion, $size1, $size2, $size3, $size4, $titsize1, $titsize2, $titsize3, $titsize4, $nuevo, $dinningroom, $dineintakeout, $smallbyrequest, $specialoffer, $orden){
	$idcategoria = $link->real_escape_string($idcategoria);
	$nombre = $link->real_escape_string($nombre);
	$descripcion = $link->real_escape_string($descripcion);
	$size1 = $link->real_escape_string($size1);
	$size2 = $link->real_escape_string($size2);
	$size3 = $link->real_escape_string($size3);
	$size4 = $link->real_escape_string($size4);
	$titsize1 = $link->real_escape_string($titsize1);
	$titsize2 = $link->real_escape_string($titsize2);
	$titsize3 = $link->real_escape_string($titsize3);
	$titsize4 = $link->real_escape_string($titsize4);
	$nuevo = $link->real_escape_string($nuevo);
	$dinningroom = $link->real_escape_string($dinningroom);
	$dineintakeout = $link->real_escape_string($dineintakeout);
	$smallbyrequest = $link->real_escape_string($smallbyrequest);
	$specialoffer = $link->real_escape_string($specialoffer);
	$orden = $link->real_escape_string($orden);
	
	//Creo el producto
	$sql = "INSERT INTO productos SET id_categoria = '$idcategoria', nombre = '$nombre', descripcion = '$descripcion', size_1 = '$size1', size_2 = '$size2', size_3 = '$size3', size_4 = '$size4', tit_size_1 = '$titsize1', tit_size_2 = '$titsize2', tit_size_3 = '$titsize3', tit_size_4 = '$titsize4', nuevo = '$nuevo', dinning_room = '$dinningroom', dine_in_take_out = '$dineintakeout', small_by_request = '$smallbyrequest', special_offer = '$specialoffer' ";
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	$idproducto = mysqli_insert_id($link);
	return $idproducto;
}

function ModificarProduct($link, $idproducto, $idcategoria, $nombre, $descripcion, $size1, $size2, $size3, $size4, $titsize1, $titsize2, $titsize3, $titsize4, $nuevo, $dinningroom, $dineintakeout, $smallbyrequest, $specialoffer, $orden){
	$idproducto = $link->real_escape_string($idproducto);
	$idcategoria = $link->real_escape_string($idcategoria);
	$nombre = $link->real_escape_string($nombre);
	$descripcion = $link->real_escape_string($descripcion);
	$size1 = $link->real_escape_string($size1);
	$size2 = $link->real_escape_string($size2);
	$size3 = $link->real_escape_string($size3);
	$size4 = $link->real_escape_string($size4);
	$titsize1 = $link->real_escape_string($titsize1);
	$titsize2 = $link->real_escape_string($titsize2);
	$titsize3 = $link->real_escape_string($titsize3);
	$titsize4 = $link->real_escape_string($titsize4);
	$nuevo = $link->real_escape_string($nuevo);
	$dinningroom = $link->real_escape_string($dinningroom);
	$dineintakeout = $link->real_escape_string($dineintakeout);
	$smallbyrequest = $link->real_escape_string($smallbyrequest);
	$specialoffer = $link->real_escape_string($specialoffer);
	$orden = $link->real_escape_string($orden);
	
	$sql = "UPDATE productos SET id_categoria = '$idcategoria', nombre = '$nombre', descripcion = '$descripcion', size_1 = '$size1', size_2 = '$size2', size_3 = '$size3', size_4 = '$size4', tit_size_1 = '$titsize1', tit_size_2 = '$titsize2', tit_size_3 = '$titsize3', tit_size_4 = '$titsize4', nuevo = '$nuevo', dinning_room = '$dinningroom', dine_in_take_out = '$dineintakeout', small_by_request = '$smallbyrequest', special_offer = '$specialoffer' WHERE id_producto = $idproducto ;";
	
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	return true;
}

function ModificarFotoProduct($link, $idproduct, $foto){
	$idproduct = $link->real_escape_string($idproduct);
	$foto = $link->real_escape_string($foto);
	
	$sql = "UPDATE products SET foto = '$foto' WHERE id_producto = $idproduct ;";
	
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	return true;
}

function EliminarProduct($link, $idproduct){
	$idproduct = $link->real_escape_string($idproduct);
	$sql = "DELETE FROM productos WHERE id_producto = $idproduct;";
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	return true;
}

/*********************************
* TraerPrecios($link)
*  -> $link : conexion a la base de datos
*  -> $idcliente : id del cliente
*  <- row con producto
**********************************/
function ListaCategorias($link){

	$sql = "
	SELECT *
	FROM categorias c 
	ORDER BY nombre
	";
	$rows = array();
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	return $rs;
}

/*********************************
* TraerProgramas($link)
*  -> $link : conexion a la base de datos
*  -> $idcliente : id del cliente
*  <- row con producto
**********************************/
function TraerProgramas($link){

	$sql = "
	SELECT * FROM programas P
	ORDER BY nombre
	";
	$rows = array();
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	while ($row = mysqli_fetch_array($rs)) {
		$rows[] = $row;
	}
	return $rows;
}

function InsertarRango($link, $idprograma, $dia, $desde, $hasta){
	$idprograma = $link->real_escape_string($idprograma);
	$dia = $link->real_escape_string($dia);
	$desde = $link->real_escape_string($desde);
	$hasta = $link->real_escape_string($hasta);
	
	$sql = "INSERT INTO grilla SET dia = '$dia', hora_desde = '$desde', hora_hasta = '$hasta', id_programa = '$idprograma' ON DUPLICATE KEY UPDATE hora_hasta = '$hasta', id_programa = '$idprograma';";
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
}

/*********************************
* TraerProducto($link, $idproducto)
*  -> $link : conexion a la base de datos
*  -> $idproducto : id del producto
*  <- row con producto
**********************************/
function TraerProducto($link, $idproducto){
	$idproducto = $link->real_escape_string($idproducto);
	$sql = "SELECT p.* FROM productos p WHERE p.id_productoo = $idproducto";
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	if ($row = mysqli_fetch_array($rs)) {
		return $row;
	}
	return null;
}

/*********************************
* TraerProductoPorPagina($link, $pagina)
*  -> $link : conexion a la base de datos
*  -> $idproducto : id del producto
*  <- row con producto
**********************************/
function TraerProductoPorPagina($link, $pagina){
	$pagina = $link->real_escape_string($pagina);
	$sql = "SELECT p.* FROM productos p WHERE p.pagina = '$pagina'";
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	if ($row = mysqli_fetch_array($rs)) {
		return $row;
	}
	return null;
}

/*********************************
* TraerVenta($link, $idventa)
*  -> $link : conexion a la base de datos
*  -> $idventa : id del producto
*  <- row con producto
**********************************/
function TraerVenta($link, $idventa){
	$idventa = $link->real_escape_string($idventa);
	$sql = "SELECT v.* FROM ventas v WHERE v.id_venta = $idventa";
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	if ($row = mysqli_fetch_array($rs)) {
		return $row;
	}
	return null;
}

/*********************************
* TraerCliente($link, $idcliente)
*  -> $link : conexion a la base de datos
*  -> $idcliente : id del cliente
*  <- row con cliente
**********************************/
function TraerCliente($link, $idcliente){
	$idcliente = $link->real_escape_string($idcliente);
	$sql = "SELECT p.* FROM clientes p WHERE p.id_cliente = $idcliente";
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	if ($row = mysqli_fetch_array($rs)) {
		return $row;
	}
	return null;
}

/*********************************
* TraerProductos($link, $soloweb)
*  -> $link : conexion a la base de datos
*  -> $idproducto : id del producto
*  <- row con producto
**********************************/
function TraerProductos($link, $soloweb = 0){
	$sql = "SELECT * FROM productos WHERE activo = 1 ";
	if ($soloweb){
		$sql .= " AND mostrar_web = 1 ";
	}
	$sql .= " ORDER BY product";
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	return $rs;
}

/*********************************
* TraerImagenesProducto($link, $idproducto)
*  -> $link : conexion a la base de datos
*  -> $idproducto : id del producto
*  <- rows con imagenes
**********************************/
function TraerImagenesProducto($link, $idproducto){
	$sql = "SELECT * FROM productos_imagenes WHERE id_productoo = $idproducto ORDER BY product";
	$result = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	return $result;
}

/*********************************
* BuscarImagenes($link, $imagen)
*  -> $link : conexion a la base de datos
*  -> $imagen : nombre de la imagen
*  <- rows con imagenes
**********************************/
function BuscarImagenes($link, $imagen){
	$cantidad = 0;
	$sql = "SELECT COUNT(*) AS cant FROM productos_imagenes WHERE url = '$imagen'";
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	if ($row = mysqli_fetch_array($rs)) {
		$cantidad += $row["cant"];
	}
	$sql = "SELECT COUNT(*) AS cant FROM productos WHERE preview = '$imagen'";
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	if ($row = mysqli_fetch_array($rs)) {
		$cantidad += $row["cant"];
	}
	return $cantidad;
}

/*********************************
* CambiarImagenes($link, $anterior, $nueva)
*  -> $link : conexion a la base de datos
*  -> $imagen : nombre de la imagen
*  <- rows con imagenes
**********************************/
function CambiarImagenes($link, $anterior, $nueva){
	$sql = "UPDATE productos_imagenes SET url = '$nueva' WHERE url = '$anterior'";
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	$sql = "UPDATE productos SET preview = '$nueva' WHERE preview = '$anterior'";
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	return true;
}

/*********************************
* ListaProductsProductos($link, $idproducto)
*  -> $link : conexion a la base de datos
*  -> $idproducto : id del producto
*  <- rows con imagenes
**********************************/
function ListaProductsProductos($link, $idproducto){
	$sql = "SELECT c.*, p.id_productoo FROM categorias c LEFT JOIN productos_categorias p ON c.id_categoria = p.id_categoria AND id_productoo = $idproducto ORDER BY c.nombre";
	$result = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	return $result;
}

/*********************************
* ListaProductos($link)
*  -> $link : conexion a la base de datos
*  <- rows con imagenes
**********************************/
function ListaProductos($link){
	$sql = "SELECT p.* FROM productos p ORDER BY p.nombre";
	$result = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	return $result;
}

/*********************************
* ListaMonedas($link)
*  -> $link : conexion a la base de datos
*  <- rows con imagenes
**********************************/
function ListaMonedas($link){
	$sql = "SELECT m.* FROM monedas m ORDER BY m.nombre";
	$result = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	return $result;
}

/*********************************
* ListaClientes($link)
*  -> $link : conexion a la base de datos
*  <- rows con imagenes
**********************************/
function ListaClientes($link){
	$sql = "SELECT c.* FROM clientes c ORDER BY c.descripcion";
	$result = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	return $result;
}

/*********************************
* ListaVendedores($link)
*  -> $link : conexion a la base de datos
*  <- rows con imagenes
**********************************/
function ListaVendedores($link){
	$sql = "SELECT u.* FROM usuarios u WHERE u.id_tipo_usuario = 2 ORDER BY u.nombre";
	$result = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	return $result;
}

/*********************************
* ListadoCodigosProductosPloomaImprimir($link, $idproduct, $cantidad, $pagina, $idtipocerveza)
*  -> $link : conexion a la base de datos
*  -> $idproduct : product a la que pertenece el barril
*  -> $cantidad : cantidad de registros a devolver
*  -> $pagina : pagina a devolver
*  -> $idtipocerveza : id tipo de cerveza de los lotes a imprimir
*  <- HTML con tabla de pedidos
**********************************/
function ListadoCodigosProductosPloomaImprimir($link){
	$sql = "SELECT * FROM productos p WHERE p.activo = 1 AND codigo IN ('7100', '7160', '7150', '7120', '7140', '7110', '7120V', '7130V', '7150V', '7160V', '7100V', '7140V', '7130') ORDER BY nombre";
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	require_once( "barcode/BarcodeGeneratorPNG.php" );
	$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
	?>
	<div class="table-responsive">
		<table class="table table-condensed table-bordered">
			<tr>
			<?php
			$inicio = true;
			$final = false;
			$c = 0;
			$porfila = 3;
			
			while ($row = mysqli_fetch_array($rs)) {
				
				$c++;
				$inicio = ($c % $porfila == 1);
				$final = ($c % $porfila == 0);
				if ($inicio){
					echo "<tr>";
				}
				$codigo = str_replace("SZ", "PL", $row['codigo_barras']);
				?>
				<td style="text-align: center; padding-top: 20px;"><?php echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($codigo, $generator::TYPE_CODE_128, 2, 50, array(0, 0, 0))) . '"><div>' . $codigo . " - " . $row["nombre"] . '</div>'; ?></td>
				<?php
				if ($final){
					echo "</tr>";
				}
			}
			if (!$final){
				echo str_repeat("<td>&nbsp;</td>", $porfila - ($c % $porfila));
				echo "</tr>";
			}
			?>
		</table>
	</div>
	<?php
}

/*********************************
* ListadoCodigosProductosImprimir($link, $idproduct, $cantidad, $pagina, $idtipocerveza)
*  -> $link : conexion a la base de datos
*  -> $idproduct : product a la que pertenece el barril
*  -> $cantidad : cantidad de registros a devolver
*  -> $pagina : pagina a devolver
*  -> $idtipocerveza : id tipo de cerveza de los lotes a imprimir
*  <- HTML con tabla de pedidos
**********************************/
function ListadoCodigosProductosImprimir($link){
	$sql = "SELECT * FROM productos p WHERE p.activo = 1 ORDER BY nombre";
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	require_once( "barcode/BarcodeGeneratorPNG.php" );
	$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
	?>
	<div class="table-responsive">
		<table class="table table-condensed table-bordered">
			<tr>
			<?php
			$inicio = true;
			$final = false;
			$c = 0;
			$porfila = 3;
			while ($row = mysqli_fetch_array($rs)) {
				$c++;
				$inicio = ($c % $porfila == 1);
				$final = ($c % $porfila == 0);
				if ($inicio){
					echo "<tr>";
				}
				?>
				<td style="text-align: center; padding-top: 20px;"><?php echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($row['codigo_barras'], $generator::TYPE_CODE_128, 2, 50, array(0, 0, 0))) . '"><div>' . $row['codigo_barras'] . " - " . $row["nombre"] . '</div>'; ?></td>
				<?php
				if ($final){
					echo "</tr>";
				}
			}
			if (!$final){
				echo str_repeat("<td>&nbsp;</td>", $porfila - ($c % $porfila));
				echo "</tr>";
			}
			?>
		</table>
	</div>
	<?php
}


/*********************************
* ListadoProductosWeb($link, $fechadesde = "", $fechahasta = "", $idsocio = -1, $idusuario = 0, $pagina = 1, $cantidad = 20)
*  -> $link : conexion a la base de datos
*  -> $fechadesde : fecha desde (DEFAULT: "" -> Sin limite desde)
*  -> $fechahasta : fecha hasta (DEFAULT: "" -> Sin limite hasta)
*  -> $idsocio : id del socio (DEFAULT: -1 -> Todos)
*  -> $idusuario : id del usuario (DEFAULT: 0 -> Todos)
*  -> $pagina : numero de pagina desde donde trae (DEFAULT: 0 -> el inicio)
*  -> $cantidad : cantidad de recibos que trae (DEFAULT: 5)
*  <- HTML con tabla de productos
**********************************/
function ListadoProductosWeb($link, $consulta = "", $pagina = 1, $cantidad = 20){
	$consulta = $link->real_escape_string($consulta);
	$pagina = $link->real_escape_string($pagina);
	$cantidad = $link->real_escape_string($cantidad);
	
	//examino la página a mostrar y el inicio del producto a mostrar
	$inicio = ($pagina - 1) * $cantidad;

	//miro a ver el número total de campos que hay en la tabla
	$sql = "SELECT * FROM productos p WHERE 1=1 ";
	if ($consulta != ""){
		$searchTerms = explode(' ', $consulta);
		$searchTermBits = array();
		foreach ($searchTerms as $term) {
			$term = trim($term);
			if (!empty($term)) {
				$searchTermBits[] = "(p.nombre LIKE '%$term%' OR p.codigo LIKE '%$term%')";
			}
		}
		$sql .= " AND " . implode(' AND ', $searchTermBits);
	}
	
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	$num_total_productos = mysqli_num_rows($rs);

	//calculo el total de páginas
	$total_paginas = ceil($num_total_productos / $cantidad);

	$sql = "SELECT p.* FROM productos p WHERE 1=1 ";
	if ($consulta != ""){
		$searchTerms = explode(' ', $consulta);
		$searchTermBits = array();
		foreach ($searchTerms as $term) {
			$term = trim($term);
			if (!empty($term)) {
				$searchTermBits[] = "(p.nombre LIKE '%$term%' OR p.codigo LIKE '%$term%')";
			}
		}
		$sql .= " AND " . implode(' AND ', $searchTermBits);
	}
	$sql .= "ORDER BY product LIMIT $inicio, $cantidad";
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	?>
	<div class="table-responsive">
		<table class="table table-condensed table-bordered">
			<tr>
				<th>nombre</th>
				<th>descripcion</th>
				<th>imagenes</th>
				<th>preview</th>
				<th></th>
			</tr>
			<?php
			while($row = mysqli_fetch_array($rs)) {
				$imagenes = TraerImagenesProducto($link, $row["id_productoo"]);
				$categorias = ListaProductsProductos($link, $row["id_productoo"]);
				$inactivo = "";
				if (!$row['activo']) $inactivo = "background-color: #ccc; color: #888;";
				?>
				<tr style="<?php echo $inactivo; ?>">
					<td>
						<?php
						echo "<i style='font-size: 18px; color: red;'>" . $row['nombre'] . "</i><br />";
						echo "<strong>Código:</strong> " . $row['codigo'] . "<br />";
						echo "<strong>Código de Barras:</strong> " . $row['codigo_barras'] . "<br />";
						echo "<strong>ML:</strong> ";
						if ($row['mercado'] != ""){
							echo '<a href="' . $row['mercado'] . '" target="_blank">LINK</a><br />';
						} else {
							echo "No hay<br />";
						}
						echo "<strong>Precio:</strong> " . number_format($row['precio'], 2, '.', '') . "<br>";
						echo "<strong>Costo:</strong> " . number_format($row['costo'], 2, '.', '') . "<br>";
						echo "<strong>Mostrar Web:</strong> " . ($row['mostrar_web'] ? "SI" : "NO") . "<br>";
						echo "<strong>Stock Minimo:</strong> " . $row['stock_minimo'] . "<br>";
						?>
						<strong>categorias:</strong> 
						<?php
						while($categoria = mysqli_fetch_array($categorias)) {
							if($categoria["id_productoo"] == $row["id_productoo"]) {
								echo $categoria["nombre"] . "<br>";
							}
						}
						?>
					</td>
					<td class="col-md-6"><?php echo $row['descripcion']; ?></td>
					<td>
						<?php while($imagen = mysqli_fetch_array($imagenes)) { ?>
						<img src="assets/img/<?php echo $imagen['url']; ?>" width="200" alt="<?php echo $imagen['url']; ?>" title="<?php echo $imagen['url']; ?>" />
						<?php } ?>
					</td>
					<td>
						<?php if ($row['preview'] != "") { ?>
						<img src="assets/img/<?php echo $row['preview']; ?>" width="200" alt="<?php echo $row['preview']; ?>" title="<?php echo $row['preview']; ?>" />
						<?php } else { ?>
						No hay preview cargado 
						<?php } ?>
					</td>
					
					<td class="text-center">
						<p><a class="btn btn-success btn-xs verButton" href="admin-productos-web.php?e=1&id=<?php echo $row['id_productoo']; ?>">editar</a></p>
						<p><a class="btn btn-primary btn-xs verButton" href="admin-productos-descripcion.php?id=<?php echo $row['id_productoo']; ?>" target="_blank">descripcion</a></p>
						<p><a class="btn btn-warning btn-xs verButton" href="admin-productos-imagenes.php?id=<?php echo $row['id_productoo']; ?>">imagenes</a></p>
						<p><a class="btn btn-info btn-xs verButton" href="admin-productos-imagenes-product.php?id=<?php echo $row['id_productoo']; ?>">product img</a></p>
						<?php if ($row['activo']) { ?>
						<p><a class="btn btn-danger btn-xs verButton" href="admin-productos-web.php?d=1&id=<?php echo $row['id_productoo']; ?>">desactivar</a></p>
						<?php } else { ?>
						<p><a class="btn btn-danger btn-xs verButton" href="admin-productos-web.php?d=1&id=<?php echo $row['id_productoo']; ?>">activar</a></p>
						<?php } ?>
					</td>
					
				</tr>
				<?php
			}
			?>
		</table>
		<?php Paginado($pagina, $total_paginas, "admin-productos-web", "&q=".$consulta); ?>
	</div>
	<?php
}

function InsertarProducto($link, $codigo, $codigobarras, $nombre, $preview, $mercado, $idmoneda, $precio, $costo, $product, $stock, $stockminimo, $mostrarweb){
	$codigo = $link->real_escape_string($codigo);
	$codigobarras = $link->real_escape_string($codigobarras);
	$nombre = $link->real_escape_string($nombre);
	$preview = $link->real_escape_string($preview);
	$mercado = $link->real_escape_string($mercado);
	$idmoneda = $link->real_escape_string($idmoneda);
	$precio = $link->real_escape_string($precio);
	$costo = $link->real_escape_string($costo);
	$product = $link->real_escape_string($product);
	$stock = $link->real_escape_string($stock);
	$stockminimo = $link->real_escape_string($stockminimo);
	$mostrarweb = $link->real_escape_string($mostrarweb);
	
	//Creo el producto
	$sql = "INSERT INTO productos SET codigo = '$codigo', codigo_barras = '$codigobarras', nombre = '$nombre', preview = '$preview', mercado = '$mercado', id_moneda = '$idmoneda', precio = '$precio', costo = '$costo', product = $product, stock = '$stock', stock_minimo = $stockminimo, mostrar_web = $mostrarweb ";
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	$idproducto = mysqli_insert_id($link);
	return $idproducto;
}

function ModificarProducto($link, $idproducto, $codigo, $codigobarras, $nombre, $preview, $mercado, $idmoneda, $precio, $costo, $product, $stock, $stockminimo, $mostrarweb){
	$idproducto = $link->real_escape_string($idproducto);
	$codigo = $link->real_escape_string($codigo);
	$codigobarras = $link->real_escape_string($codigobarras);
	$nombre = $link->real_escape_string($nombre);
	$preview = $link->real_escape_string($preview);
	$mercado = $link->real_escape_string($mercado);
	$idmoneda = $link->real_escape_string($idmoneda);
	$precio = $link->real_escape_string($precio);
	$costo = $link->real_escape_string($costo);
	$product = $link->real_escape_string($product);
	$stock = $link->real_escape_string($stock);
	$stockminimo = $link->real_escape_string($stockminimo);
	$mostrarweb = $link->real_escape_string($mostrarweb);
	
	$sql = "UPDATE productos SET codigo = '$codigo', codigo_barras = '$codigobarras', nombre = '$nombre', preview = '$preview', mercado = '$mercado', id_moneda = '$idmoneda', precio = '$precio', costo = '$costo', product = '$product', stock = '$stock', stock_minimo = '$stockminimo', mostrar_web = '$mostrarweb' WHERE id_productoo = $idproducto ;";
	
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	return true;
}

function InsertarCargaStock($link, $idproducto, $fechacarga, $cantidad, $observaciones){
	$idproducto = $link->real_escape_string($idproducto);
	$fechacarga = $link->real_escape_string($fechacarga);
	$cantidad = $link->real_escape_string($cantidad);
	$observaciones = $link->real_escape_string($observaciones);
	
	//Creo el producto
	$sql = "INSERT INTO cargas_stock SET id_productoo = '$idproducto', fecha_carga = '$fechacarga', cantidad = '$cantidad', observaciones = '$observaciones' ";
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	$idstock = mysqli_insert_id($link);
	return $idstock;
}

function ModificarCargaStock($link, $idstock, $idproducto, $fechacarga, $cantidad, $observaciones){
	$idstock = $link->real_escape_string($idstock);
	$idproducto = $link->real_escape_string($idproducto);
	$fechacarga = $link->real_escape_string($fechacarga);
	$cantidad = $link->real_escape_string($cantidad);
	$observaciones = $link->real_escape_string($observaciones);
	
	$sql = "UPDATE cargas_stock SET id_productoo = '$idproducto', fecha_carga = '$fechacarga', cantidad = '$cantidad', observaciones = '$observaciones' WHERE id_stock = $idstock ;";
	
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	return true;
}

function EliminarCargaStock($link, $idstock){
	$idstock = $link->real_escape_string($idstock);
	$sql = "DELETE FROM cargas_stock WHERE id_stock = $idstock;";
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	return true;
}

function InsertarVenta($link, $idproducto, $idcliente, $idvendedor, $fechaventa, $cantidad, $observaciones){
	$idproducto = $link->real_escape_string($idproducto);
	$idcliente = $link->real_escape_string($idcliente);
	$idvendedor = $link->real_escape_string($idvendedor);
	$fechaventa = $link->real_escape_string($fechaventa);
	$cantidad = $link->real_escape_string($cantidad);
	$observaciones = $link->real_escape_string($observaciones);
	
	//Creo el producto
	$sql = "INSERT INTO ventas SET id_productoo = '$idproducto', id_cliente = '$idcliente', id_vendedor = '$idvendedor', fecha_venta = '$fechaventa', cantidad = '$cantidad', observaciones = '$observaciones' ";
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	$idventa = mysqli_insert_id($link);
	return $idventa;
}

function ModificarVenta($link, $idventa, $idproducto, $idcliente, $idvendedor, $fechaventa, $cantidad, $observaciones){
	$idventa = $link->real_escape_string($idventa);
	$idproducto = $link->real_escape_string($idproducto);
	$idcliente = $link->real_escape_string($idcliente);
	$idvendedor = $link->real_escape_string($idvendedor);
	$fechaventa = $link->real_escape_string($fechaventa);
	$cantidad = $link->real_escape_string($cantidad);
	$observaciones = $link->real_escape_string($observaciones);
	
	$sql = "UPDATE ventas SET id_productoo = '$idproducto', id_cliente = '$idcliente', id_vendedor = '$idvendedor', fecha_venta = '$fechaventa', cantidad = '$cantidad', observaciones = '$observaciones' WHERE id_venta = $idventa ;";
	
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	return true;
}

function EliminarVenta($link, $idventa){
	$idventa = $link->real_escape_string($idventa);
	$sql = "DELETE FROM ventas WHERE id_venta = $idventa;";
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	return true;
}

function ModificarDescripcionProducto($link, $idproducto, $descripcion){
	$idproducto = $link->real_escape_string($idproducto);
	$sql = "UPDATE productos SET descripcion = '$descripcion' WHERE id_productoo = $idproducto;";
	
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	return true;
}

function CambiarActivoProducto($link, $idproducto){
	$idproducto = $link->real_escape_string($idproducto);
	$sql = "UPDATE productos SET activo = NOT activo WHERE id_productoo = $idproducto;";
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	return true;
}

function InsertarProductProducto($link, $idproducto, $idcategoria){
	$idproducto = $link->real_escape_string($idproducto);
	$idcategoria = $link->real_escape_string($idcategoria);
	$sql = "INSERT INTO productos_categorias (id_productoo, id_categoria) VALUES ($idproducto, $idcategoria);";
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	return true;
}

function EliminarProductsProducto($link, $idproducto){
	$idproducto = $link->real_escape_string($idproducto);
	$sql = "DELETE FROM productos_categorias WHERE id_productoo = $idproducto;";
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	return true;
}

function InsertarImagenProducto($link, $idproducto, $imagen){
	$idproducto = $link->real_escape_string($idproducto);
	$imagen = $link->real_escape_string($imagen);
	$sql = "INSERT INTO productos_imagenes (id_productoo, url, product) VALUES ($idproducto, '$imagen', 1);";
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	return true;
}

function EliminarImagenesProducto($link, $idproducto){
	$idproducto = $link->real_escape_string($idproducto);
	$sql = "DELETE FROM productos_imagenes WHERE id_productoo = $idproducto;";
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	return true;
}

function ModificarProductProductoImagenes( $link, $idimagen, $product ){
	$idimagen = $link->real_escape_string($idimagen);
	$product = $link->real_escape_string($product);
	$sql = "UPDATE productos_imagenes SET product = $product WHERE id_imagen = $idimagen;";
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	return true;
}

function ModificarProductProductos( $link, $idproducto, $product ){
	$idproducto = $link->real_escape_string($idproducto);
	$product = $link->real_escape_string($product);
	$sql = "UPDATE productos SET product = $product WHERE id_productoo = $idproducto;";
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	return true;
}

function ModificarPrecioProducto( $link, $idproducto, $precio ){
	$idproducto = $link->real_escape_string($idproducto);
	$precio = $link->real_escape_string($precio);
	$sql = "UPDATE productos SET precio = $precio WHERE id_productoo = $idproducto;";
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	return true;
}

/*********************************
* ListadoCargasStock($link, $idproducto, $pagtabla, $cantidad)
*  -> $link : conexion a la base de datos
*  -> $idproducto : id del campeonato
*  -> $pagtabla : pagina a devolver
*  -> $cantidad : cantidad de registros a devolver
*  <- HTML con tabla de fechas
**********************************/
function ListadoCargasStock($link, $idproducto, $pagina, $cantidad){
	$idproducto = $link->real_escape_string($idproducto);
	$pagina = $link->real_escape_string($pagina);
	$cantidad = $link->real_escape_string($cantidad);
	
	//examino la página a mostrar y el inicio del registro a mostrar
	$inicio = ($pagina - 1) * $cantidad;
	
	//miro a ver el número total de campos que hay en la tabla con esa búsqueda 
	$sql = "SELECT s.* FROM cargas_stock s INNER JOIN productos p ON p.id_productoo = s.id_productoo ";
	if ($idproducto > 0){
		$sql .= " WHERE s.id_productoo = $idproducto ";
	}
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	$num_total_registros = mysqli_num_rows($rs);
	if ($num_total_registros == 0){
		echo "<div>No hay registros para los filtros seleccionados</div>";
		return;
	}
	//calculo el total de páginas
	$total_paginas = ceil($num_total_registros / $cantidad);
	$sql = "SELECT s.*, p.codigo AS codproducto, p.nombre AS producto FROM cargas_stock s INNER JOIN productos p ON p.id_productoo = s.id_productoo ";
	if ($idproducto > 0){
		$sql .= " WHERE s.id_productoo = $idproducto ";
	}
	$sql .= " ORDER BY fecha_carga DESC LIMIT $inicio, $cantidad";
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	?>
	<div class="table-responsive">
		<table class="table table-condensed table-bordered">
			<tr><th>fecha</th><th>producto</th><th>cantidad</th><th></th></tr>
			<?php
			while ($row = mysqli_fetch_array($rs)) {
				$fechacarga = "" . $row['fecha_carga'];
				if ($fechacarga != "") $fechacarga = date("d/m/Y", strtotime($fechacarga));
				?>
				<tr>
					<td><?php echo $fechacarga; ?></td>
					<td><a href="admin-productos.php?id=<?php echo $row["id_productoo"]; ?>"><?php echo $row["codproducto"]; ?> - <?php echo $row["producto"]; ?></a></td>
					<td class="text-center"><?php echo $row["cantidad"]; ?></td>
					<td class="text-center"></td>
				<?php
			}
			?>
		</table>
	</div>
	<?php
}

/*********************************
* ListadoStock($link, $idproducto, $pagtabla, $cantidad)
*  -> $link : conexion a la base de datos
*  -> $idproducto : id del campeonato
*  -> $pagtabla : pagina a devolver
*  -> $cantidad : cantidad de registros a devolver
*  <- HTML con tabla de fechas
**********************************/
function ListadoStock($link, $idproducto, $pagina, $cantidad){
	$idproducto = $link->real_escape_string($idproducto);
	$pagina = $link->real_escape_string($pagina);
	$cantidad = $link->real_escape_string($cantidad);
	
	//examino la página a mostrar y el inicio del registro a mostrar
	$inicio = ($pagina - 1) * $cantidad;
	
	//miro a ver el número total de campos que hay en la tabla con esa búsqueda 
	$sql = "SELECT p.* FROM productos p ";
	if ($idproducto > 0){
		$sql .= " WHERE p.id_productoo = $idproducto ";
	}
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	$num_total_registros = mysqli_num_rows($rs);
	if ($num_total_registros == 0){
		echo "<div>No hay registros para los filtros seleccionados</div>";
		return;
	}
	//calculo el total de páginas
	$total_paginas = ceil($num_total_registros / $cantidad);
	$sql = "
		SELECT p.*, 
		(SELECT COALESCE(SUM(x.cantidad),0) FROM cargas_stock x WHERE x.id_productoo = p.id_productoo) AS totcargas
		, (SELECT COALESCE(SUM(x.cantidad),0) FROM ventas x WHERE x.id_productoo = p.id_productoo) AS totventas
		FROM productos p
	";
	if ($idproducto > 0){
		$sql .= " WHERE p.id_productoo = $idproducto ";
	}
	$sql .= " ORDER BY nombre DESC LIMIT $inicio, $cantidad";
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	?>
	<div class="table-responsive">
		<table class="table table-condensed table-bordered">
			<tr><th>codigo</th><th>producto</th><th>stock minimo</th><th>stock actual</th><th></th></tr>
			<?php
			while ($row = mysqli_fetch_array($rs)) {
				$estilo = "";
				if (($row["totcargas"] - $row["totventas"]) <= $row["stock_minimo"] && $row["stock_minimo"] > 0){
					$estilo = "background-color: yellow;";
				}
				?>
				<tr>
					<td><a href="admin-productos.php?id=<?php echo $row["id_productoo"]; ?>"><?php echo $row["codigo"]; ?></a></td>
					<td><a href="admin-productos.php?id=<?php echo $row["id_productoo"]; ?>"><?php echo $row["nombre"]; ?></a></td>
					<td class="text-center"><?php echo $row["stock_minimo"]; ?></td>
					<td class="text-center" style="<?php echo $estilo; ?>"><?php echo ($row["totcargas"] - $row["totventas"]); ?></td>
					<td class="text-center"><a href="admin-cargas.php?a=1&x=<?php echo $row["id_productoo"]; ?>" class="btn btn-xs btn-success">cargar</a>&nbsp;<a href="admin-ventas.php?a=1&x=<?php echo $row["id_productoo"]; ?>" class="btn btn-xs btn-danger">venta</a></td>
				<?php
			}
			?>
		</table>
	</div>
	<?php
}

/*********************************
* ListadoVentas($link, $idproducto, $idvendedor, $pagtabla, $cantidad)
*  -> $link : conexion a la base de datos
*  -> $idproducto : id del campeonato
*  -> $pagtabla : pagina a devolver
*  -> $cantidad : cantidad de registros a devolver
*  <- HTML con tabla de fechas
**********************************/
function ListadoVentas($link, $idcliente, $idvendedor, $pagina, $cantidad){
	$idcliente = $link->real_escape_string($idcliente);
	$idvendedor = $link->real_escape_string($idvendedor);
	$pagina = $link->real_escape_string($pagina);
	$cantidad = $link->real_escape_string($cantidad);
	
	//examino la página a mostrar y el inicio del registro a mostrar
	$inicio = ($pagina - 1) * $cantidad;
	
	//miro a ver el número total de campos que hay en la tabla con esa búsqueda 
	$sql = "SELECT v.* FROM ventas v WHERE 1=1 ";
	if ($idcliente > 0){
		$sql .= " AND v.id_cliente = $idcliente ";
	}
	if ($idvendedor > 0){
		$sql .= " AND v.id_vendedor = $idvendedor ";
	}
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	$num_total_registros = mysqli_num_rows($rs);
	if ($num_total_registros == 0){
		echo "<div>No hay registros para los filtros seleccionados</div>";
		return;
	}
	//calculo el total de páginas
	$total_paginas = ceil($num_total_registros / $cantidad);
	$sql = "SELECT v.*, c.descripcion AS cliente, u.nombre AS vendedor FROM ventas v LEFT JOIN clientes c ON c.id_cliente = v.id_cliente LEFT JOIN usuarios u ON u.id_usuario = v.id_vendedor WHERE 1=1 ";
	if ($idcliente > 0){
		$sql .= " AND v.id_cliente = $idcliente ";
	}
	if ($idvendedor > 0){
		$sql .= " AND v.id_vendedor = $idvendedor ";
	}
	$sql .= " ORDER BY fecha_venta DESC LIMIT $inicio, $cantidad";
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	?>
	<div class="table-responsive">
		<table class="table table-condensed table-bordered">
			<tr><th>fecha</th><th>cliente</th><th>vendedor</th><th></th><th></th></tr>
			<?php
			while ($row = mysqli_fetch_array($rs)) {
				$fechaventa = "" . $row['fecha_venta'];
				if ($fechaventa != "") $fechaventa = date("d/m/Y", strtotime($fechaventa));
				?>
				<tr>
					<td><?php echo $fechaventa; ?></td>
					<td><a href="admin-clientes.php?id=<?php echo $row["id_cliente"]; ?>"><?php echo $row["cliente"]; ?></a></td>
					<td><?php echo $row["vendedor"]; ?></td>
					<td class="text-center"></td>
					<td class="text-center"><a href="admin-ventas.php?e=1&id=<?php echo $row["id_venta"]; ?>" class="btn btn-xs btn-primary">editar</a>&nbsp;<a href="admin-venta.php?id=<?php echo $row["id_venta"]; ?>" class="btn btn-xs btn-success">detalle</a></td>
				<?php
			}
			?>
		</table>
	</div>
	<?php
}

/*********************************
* ListadoClientes($link, $consulta, $pagtabla, $cantidad)
*  -> $link : conexion a la base de datos
*  -> $idproducto : id del campeonato
*  -> $pagtabla : pagina a devolver
*  -> $cantidad : cantidad de registros a devolver
*  <- HTML con tabla de fechas
**********************************/
function ListadoClientes($link, $consulta, $pagina, $cantidad){
	$consulta = $link->real_escape_string($consulta);
	$pagina = $link->real_escape_string($pagina);
	$cantidad = $link->real_escape_string($cantidad);
	
	//examino la página a mostrar y el inicio del registro a mostrar
	$inicio = ($pagina - 1) * $cantidad;
	
	//miro a ver el número total de campos que hay en la tabla con esa búsqueda 
	$sql = "SELECT c.* FROM clientes c WHERE 1=1 ";
	if ($consulta != ""){
		
		$searchTerms = explode(' ', $consulta);
		$searchTermBits = array();
		foreach ($searchTerms as $term) {
			$term = trim($term);
			if (!empty($term)) {
				$searchTermBits[] = "c.descripcion LIKE '%$term%'";
			}
		}

		$sql .= " AND " . implode(' AND ', $searchTermBits);
	
	}
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	$num_total_registros = mysqli_num_rows($rs);
	if ($num_total_registros == 0){
		echo "<div>No hay registros para los filtros seleccionados</div>";
		return;
	}
	//calculo el total de páginas
	$total_paginas = ceil($num_total_registros / $cantidad);
	$sql = "SELECT c.*, l.nombre AS localidad FROM clientes c LEFT JOIN localidades l ON l.id_localidad = c.id_localidad WHERE 1=1 ";
	if ($consulta != ""){
		
		$searchTerms = explode(' ', $consulta);
		$searchTermBits = array();
		foreach ($searchTerms as $term) {
			$term = trim($term);
			if (!empty($term)) {
				$searchTermBits[] = "c.descripcion LIKE '%$term%'";
			}
		}

		$sql .= " AND " . implode(' AND ', $searchTermBits);
	
	}
	$sql .= " ORDER BY c.descripcion DESC LIMIT $inicio, $cantidad";
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	?>
	<div class="table-responsive">
		<table class="table table-condensed table-bordered">
			<tr><th>descripcion</th><th>contacto</th><th>direccion</th><th>email</th><th>telefono</th><th>localidad</th><th></th></tr>
			<?php
			while ($row = mysqli_fetch_array($rs)) {
				?>
				<tr>
					<td><?php echo $row["descripcion"]; ?></td>
					<td><?php echo $row["contacto"]; ?></td>
					<td><?php echo $row["direccion"]; ?></td>
					<td><?php echo $row["email"]; ?></td>
					<td><?php echo $row["telefono"]; ?></td>
					<td><?php echo $row["localidad"]; ?></td>
					<td class="text-center"><a class="btn btn-success btn-xs" href="admin-clientes.php?e=1&id=<?php echo $row['id_cliente']; ?>">editar</a></td>
				<?php
			}
			?>
		</table>
	</div>
	<?php
}

?>
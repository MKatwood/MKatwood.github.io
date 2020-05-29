<?php

/*********************************
* TraerCategoria($link, $idcategoria)
*  -> $link : conexion a la base de datos
*  -> $idcategoria : id de la categoria
*  <- row con registro
**********************************/
function TraerCategoria($link, $idcategoria){
	$idcategoria = $link->real_escape_string($idcategoria);
	$sql = "SELECT c.* FROM categorias c WHERE c.id_categoria = $idcategoria";
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	if ($row = mysqli_fetch_array($rs)) {
		return $row;
	}
	return null;
}

/*********************************
* TraerProducto($link, $idproducto)
*  -> $link : conexion a la base de datos
*  -> $idproducto : id del producto
*  <- row con registro
**********************************/
function TraerProducto($link, $idproducto){
	$idproducto = $link->real_escape_string($idproducto);
	$sql = "SELECT p.* FROM productos p WHERE p.id_producto = $idproducto";
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	if ($row = mysqli_fetch_array($rs)) {
		return $row;
	}
	return null;
}

/*********************************
* ExisteIngrediente($link, $texto, $idproducto)
*  -> $link : conexion a la base de datos
*  -> $idproducto : id del producto
*  <- row con registro
**********************************/
function ExisteIngrediente($link, $texto, $idproducto = 0){
	$texto = $link->real_escape_string($texto);
	$sql = "SELECT * FROM ingredientes WHERE nombre = '$texto' ";
	if ($idproducto > 0){
		$sql .= " AND id_ingrediente NOT IN (SELECT id_ingrediente FROM productos_ingredientes WHERE id_producto = $idproducto)";
	}
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	if ($row = mysqli_fetch_array($rs)) {
		return $row["id_ingrediente"];
	}
	return 0;
}

/*********************************
* TraerProductoIngredientes($link, $idproducto)
*  -> $link : conexion a la base de datos
*  -> $idproducto : id del producto
*  <- row con registro
**********************************/
function TraerProductoIngredientes($link, $idproducto){
	$idproducto = $link->real_escape_string($idproducto);
	$sql = "SELECT p.*, i.nombre FROM productos_ingredientes p INNER JOIN ingredientes i ON i.id_ingrediente = p.id_ingrediente WHERE p.id_producto = $idproducto ORDER BY nombre";
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	return $rs;
}

/*********************************
* TraerIngredientes($link)
*  -> $link : conexion a la base de datos
*  -> $idproducto : id del producto
*  <- row con registro
**********************************/
function TraerIngredientes($link, $idproducto = 0){
	$sql = "SELECT i.* FROM ingredientes i ";
	if ($idproducto > 0)
	$sql .= " WHERE i.id_ingrediente NOT IN (SELECT id_ingrediente FROM productos_ingredientes WHERE id_producto = $idproducto) ORDER BY nombre ";
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	return $rs;
}

/*********************************
* ListaProductos($link)
*  -> $link : conexion a la base de datos
*  -> $idproducto : id del producto
*  <- row con registro
**********************************/
function ListaProductos($link){
	$sql = "SELECT * FROM productos";
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	return $rs;
}

/*********************************
* ListaCategorias($link)
*  -> $link : conexion a la base de datos
*  <- row con registros
**********************************/
function ListaCategorias($link){
	$sql = "SELECT * FROM categorias";
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	return $rs;
}

/*********************************
* ListadoVentas($link, $fechadesde = "", $fechahasta = "", $idproveedor = 0, $idarticulo = 0, $pagtabla = 1, $cantidad = 20)
*  -> $link : conexion a la base de datos
*  -> $fechadesde : fecha desde (DEFAULT: "" -> Sin limite desde)
*  -> $fechahasta : fecha hasta (DEFAULT: "" -> Sin limite hasta)
*  -> $idsocio : id del socio (DEFAULT: -1 -> Todos)
*  -> $idalmacenero : id del almacenero (DEFAULT: 0 -> Todos)
*  -> $idproducto : id del producto (DEFAULT: 0 -> Todos)
*  -> $idtiporegistro : id del tipo de registro (DEFAULT: 0 -> Todos)
*  -> $pagina : numero de pagina desde donde trae (DEFAULT: 0 -> el inicio)
*  -> $cantidad : cantidad de recibos que trae (DEFAULT: 5)
*  <- HTML con tabla de registros
**********************************/
function ListadoVentas($link, $fechadesde = "", $fechahasta = "", $idproveedor = 0, $idarticulo = 0, $pagtabla = 1, $cantidad = 20) {
	$fechadesde = $link->real_escape_string($fechadesde);
	$fechahasta = $link->real_escape_string($fechahasta);
	$idproveedor = $link->real_escape_string($idproveedor);
	$idarticulo = $link->real_escape_string($idarticulo);
	$pagtabla = $link->real_escape_string($pagtabla);
	$cantidad = $link->real_escape_string($cantidad);
	
	//examino la página a mostrar y el inicio del registro a mostrar
	$inicio = ($pagtabla - 1) * $cantidad;

	//miro a ver el número total de campos que hay en la tabla
	$sql = "SELECT * FROM ventas v 
	LEFT JOIN articulos a ON v.id_articulo = v.id_articulo 
	LEFT JOIN proveedores p ON p.id_proveedor = a.id_proveedor
	LEFT JOIN usuarios u ON u.id_usuario = v.id_vendedora
	WHERE 1 = 1 ";
	if ($fechadesde != ""){
		$sql .= " AND v.fecha_venta >= '" . $fechadesde . "' ";
	}
	if ($fechahasta != ""){
		$sql .= " AND v.fecha_venta <= '" . $fechahasta . "' ";
	}
	if ($idproveedor > 0){
		$sql .= " AND a.id_proveedor = " . $idproveedor;
	}
	if ($idarticulo > 0){
		$sql .= " AND v.id_articulo = $idarticulo ";
	}

	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	$num_total_registros = mysqli_num_rows($rs);

	//calculo el total de páginas
	$total_paginas = ceil($num_total_registros / $cantidad);

	$sql = "SELECT v.*, u.nombre as vendedora, p.nombre as proveedor, a.descripcion as articulo, a.id_proveedor
	FROM ventas v 
	LEFT JOIN articulos a ON a.id_articulo = v.id_articulo 
	LEFT JOIN proveedores p ON p.id_proveedor = a.id_proveedor
	LEFT JOIN usuarios u ON u.id_usuario = v.id_vendedora
	WHERE 1 = 1 ";
	if ($fechadesde != ""){
		$sql .= " AND v.fecha_venta >= '" . $fechadesde . "' ";
	}
	if ($fechahasta != ""){
		$sql .= " AND v.fecha_venta <= '" . $fechahasta . "' ";
	}
	if ($idproveedor > 0){
		$sql .= " AND a.id_proveedor = " . $idproveedor;
	}
	if ($idarticulo > 0){
		$sql .= " AND v.id_articulo = $idarticulo ";
	}

	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	?>
	<div class="table-responsive">
		<table class="table table-condensed table-bordered">
			<tr>
				<th>fecha</th>
				<th>vendedora</th>
				<th>proveedora</th>
				<th>articulo</th>
				<th>pcio venta</th>
				<th>observaciones</th>
			</tr>
			<?php
			while($row = mysqli_fetch_array($rs)) {
				?>
				<tr>
					<td><?php echo $row['fecha_venta']; ?></td>
					<td><?php echo $row['vendedora']; ?></td>
					<td><?php echo "[" . $row['id_proveedor'] . "] " . $row['proveedor']; ?></td>
					<td><?php echo $row['articulo']; ?></td>
					<td class="text-right"><?php echo number_format($row['precio'], 2, '.', ''); ?></td>
					<td><?php echo $row['observaciones']; ?></td>
					<!--
					<td class="text-center"><a class="btn btn-primary btn-xs verButton" href="registro.php?id=<?php echo $row['id_venta']; ?>">ver</a>&nbsp;<a class="btn btn-success btn-xs verButton" href="registros.php?e=1&id=<?php echo $row['id_venta']; ?>">editar</a></td>
					-->
				</tr>
				<?php
			}
			?>
		</table>
		<?php Paginado($pagtabla, $total_paginas, "registros", "&v=" . $idproveedor . "&fd=" . $fechadesde . "&fh=" . $fechahasta); ?>
	</div>
	<?php
}

/*********************************
* ListadoArticulos($link, $fechadesde = "", $fechahasta = "", $idproveedor = 0, $idarticulo = 0, $pagtabla = 1, $cantidad = 20)
*  -> $link : conexion a la base de datos
*  -> $fechadesde : fecha desde (DEFAULT: "" -> Sin limite desde)
*  -> $fechahasta : fecha hasta (DEFAULT: "" -> Sin limite hasta)
*  -> $idsocio : id del socio (DEFAULT: -1 -> Todos)
*  -> $idalmacenero : id del almacenero (DEFAULT: 0 -> Todos)
*  -> $idproducto : id del producto (DEFAULT: 0 -> Todos)
*  -> $idtiporegistro : id del tipo de registro (DEFAULT: 0 -> Todos)
*  -> $pagina : numero de pagina desde donde trae (DEFAULT: 0 -> el inicio)
*  -> $cantidad : cantidad de recibos que trae (DEFAULT: 5)
*  <- HTML con tabla de registros
**********************************/
function ListadoArticulos($link, $idproveedor = 0, $pagtabla = 1, $cantidad = 20) {
	$idproveedor = $link->real_escape_string($idproveedor);
	$pagtabla = $link->real_escape_string($pagtabla);
	$cantidad = $link->real_escape_string($cantidad);
	
	//examino la página a mostrar y el inicio del registro a mostrar
	$inicio = ($pagtabla - 1) * $cantidad;

	//miro a ver el número total de campos que hay en la tabla
	$sql = "SELECT a.*, p.nombre
	FROM articulos a INNER JOIN proveedores p ON p.id_proveedor = a.id_proveedor
	WHERE 1 = 1 ";
	if ($idproveedor > 0){
		$sql .= " AND a.id_proveedor = " . $idproveedor;
	}
	
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	$num_total_registros = mysqli_num_rows($rs);

	//calculo el total de páginas
	$total_paginas = ceil($num_total_registros / $cantidad);

	$sql = "SELECT a.*, p.nombre as proveedor
	FROM articulos a INNER JOIN proveedores p ON p.id_proveedor = a.id_proveedor
	WHERE 1 = 1 ";
	if ($idproveedor > 0){
		$sql .= " AND a.id_proveedor = " . $idproveedor;
	}
	$sql .= " ORDER BY id_articulo DESC";
	
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	?>
	<div class="table-responsive">
		<table class="table table-condensed table-bordered">
			<tr>
				<th>código</th>
				<?php
				if ($idproveedor == 0){
					?><th>proveedora</th><?php
				}
				?>
				<th>descripción</th>
				<th>precio</th>
				<th>costo</th>
				<th>fecha carga</th>
				<th></th>
			</tr>
			<?php
			while($row = mysqli_fetch_array($rs)) {
				?>
				<tr>
					<td><?php echo $row['id_articulo']; ?></td>
					<?php
					if ($idproveedor == 0){
						?>
						<td><?php echo $row['proveedor']; ?></td>
						<?php
					}
					?>
					<td><?php echo $row['descripcion']; ?></td>
					<td class="text-right"><?php echo number_format($row['precio'], 2, ',', ''); ?></td>
					<td class="text-right"><?php echo number_format($row['costo'], 2, ',', ''); ?></td>
					<td><?php echo $row['fecha_carga']; ?></td>
					<td class="text-center"><!--<a class="btn btn-primary btn-xs verButton" href="articulos.php?id=<?php echo $row['id_articulo']; ?>">ver</a>&nbsp;--><a class="btn btn-success btn-xs verButton" href="articulos.php?e=1&id=<?php echo $row['id_articulo']; ?>">editar</a></td>
				</tr>
				<?php
			}
			?>
		</table>
		<?php Paginado($pagtabla, $total_paginas, "registros", "&v=" . $idproveedor); ?>
	</div>
	<?php
}

/*********************************
* ListadoStock($link, $fechadesde = "", $fechahasta = "", $idproveedor = 0, $idarticulo = 0, $pagtabla = 1, $cantidad = 20)
*  -> $link : conexion a la base de datos
*  -> $fechadesde : fecha desde (DEFAULT: "" -> Sin limite desde)
*  -> $fechahasta : fecha hasta (DEFAULT: "" -> Sin limite hasta)
*  -> $idsocio : id del socio (DEFAULT: -1 -> Todos)
*  -> $idalmacenero : id del almacenero (DEFAULT: 0 -> Todos)
*  -> $idproducto : id del producto (DEFAULT: 0 -> Todos)
*  -> $idtiporegistro : id del tipo de registro (DEFAULT: 0 -> Todos)
*  -> $pagina : numero de pagina desde donde trae (DEFAULT: 0 -> el inicio)
*  -> $cantidad : cantidad de recibos que trae (DEFAULT: 5)
*  <- HTML con tabla de registros
**********************************/
function ListadoStock($link, $idproveedor = 0, $pagtabla = 1, $cantidad = 20) {
	$idproveedor = $link->real_escape_string($idproveedor);
	$pagtabla = $link->real_escape_string($pagtabla);
	$cantidad = $link->real_escape_string($cantidad);
	
	//examino la página a mostrar y el inicio del registro a mostrar
	$inicio = ($pagtabla - 1) * $cantidad;

	//miro a ver el número total de campos que hay en la tabla
		$sql = "SELECT a.*
	FROM articulos a
	LEFT JOIN ventas v ON a.id_articulo = v.id_articulo
	WHERE v.id_articulo IS NULL ";
	if ($idproveedor > 0){
		$sql .= " AND a.id_proveedor = " . $idproveedor;
	}
	
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	$num_total_registros = mysqli_num_rows($rs);

	//calculo el total de páginas
	$total_paginas = ceil($num_total_registros / $cantidad);

	$sql = "SELECT a.*
	FROM articulos a
	LEFT JOIN ventas v ON a.id_articulo = v.id_articulo
	WHERE v.id_articulo IS NULL ";
	if ($idproveedor > 0){
		$sql .= " AND a.id_proveedor = " . $idproveedor;
	}
	
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	?>
	<div class="table-responsive">
		<table class="table table-condensed table-bordered">
			<tr>
				<th>código</th>
				<th>descripción</th>
				<th>precio</th>
				<th>costo</th>
				<th>fecha carga</th>
			</tr>
			<?php
			while($row = mysqli_fetch_array($rs)) {
				?>
				<tr>
					<td><?php echo $row['id_articulo']; ?></td>
					<td><?php echo $row['descripcion']; ?></td>
					<td class="text-right"><?php echo number_format($row['precio'], 2, ',', ''); ?></td>
					<td class="text-right"><?php echo number_format($row['costo'], 2, ',', ''); ?></td>
					<td><?php echo $row['fecha_carga']; ?></td>
					<!--
					<td class="text-center"><a class="btn btn-primary btn-xs verButton" href="registro.php?id=<?php echo $row['id_venta']; ?>">ver</a>&nbsp;<a class="btn btn-success btn-xs verButton" href="registros.php?e=1&id=<?php echo $row['id_venta']; ?>">editar</a></td>
					-->
				</tr>
				<?php
			}
			?>
		</table>
		<?php Paginado($pagtabla, $total_paginas, "registros", "&v=" . $idproveedor); ?>
	</div>
	<?php
}

/*********************************
* ListadoPagos($link, $fechadesde = "", $fechahasta = "", $idproveedor = 0, $pagtabla = 1, $cantidad = 20)
*  -> $link : conexion a la base de datos
*  -> $fechadesde : fecha desde (DEFAULT: "" -> Sin limite desde)
*  -> $fechahasta : fecha hasta (DEFAULT: "" -> Sin limite hasta)
*  -> $idproveedor : id del almacenero (DEFAULT: 0 -> Todos)
*  -> $pagina : numero de pagina desde donde trae (DEFAULT: 0 -> el inicio)
*  -> $cantidad : cantidad de recibos que trae (DEFAULT: 5)
*  <- HTML con tabla de registros
**********************************/
function ListadoPagos($link, $fechadesde = "", $fechahasta = "", $idproveedor = 0, $pagtabla = 1, $cantidad = 20) {
	$fechadesde = $link->real_escape_string($fechadesde);
	$fechahasta = $link->real_escape_string($fechahasta);
	$idproveedor = $link->real_escape_string($idproveedor);
	$pagtabla = $link->real_escape_string($pagtabla);
	$cantidad = $link->real_escape_string($cantidad);
	
	//examino la página a mostrar y el inicio del registro a mostrar
	$inicio = ($pagtabla - 1) * $cantidad;

	//miro a ver el número total de campos que hay en la tabla
	$sql = "SELECT * FROM pagos p 
	LEFT JOIN proveedores v ON v.id_proveedor = p.id_proveedor
	LEFT JOIN usuarios u ON u.id_usuario = p.id_vendedora
	WHERE 1 = 1 ";
	if ($fechadesde != ""){
		$sql .= " AND p.fecha_pago >= '" . $fechadesde . "' ";
	}
	if ($fechahasta != ""){
		$sql .= " AND p.fecha_pago <= '" . $fechahasta . "' ";
	}
	if ($idproveedor > 0){
		$sql .= " AND p.id_proveedor = " . $idproveedor;
	}

	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	$num_total_registros = mysqli_num_rows($rs);

	//calculo el total de páginas
	$total_paginas = ceil($num_total_registros / $cantidad);

	$sql = "SELECT p.*, u.nombre as vendedora, v.nombre as proveedor
	FROM pagos p 
	LEFT JOIN proveedores v ON v.id_proveedor = p.id_proveedor
	LEFT JOIN usuarios u ON u.id_usuario = p.id_vendedora
	WHERE 1 = 1 ";
	if ($fechadesde != ""){
		$sql .= " AND p.fecha_pago >= '" . $fechadesde . "' ";
	}
	if ($fechahasta != ""){
		$sql .= " AND p.fecha_pago <= '" . $fechahasta . "' ";
	}
	if ($idproveedor > 0){
		$sql .= " AND p.id_proveedor = " . $idproveedor;
	}

	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	?>
	<div class="table-responsive">
		<table class="table table-condensed table-bordered">
			<tr>
				<th>fecha</th>
				<th>vendedora</th>
				<th>proveedora</th>
				<th>monto</th>
				<th>observaciones</th>
			</tr>
			<?php
			while($row = mysqli_fetch_array($rs)) {
				?>
				<tr>
					<td><?php echo $row['fecha_pago']; ?></td>
					<td><?php echo $row['vendedora']; ?></td>
					<td><?php echo "[" . $row['id_proveedor'] . "] " . $row['proveedor']; ?></td>
					<td class="text-right"><?php echo number_format($row['monto'], 2, '.', ''); ?></td>
					<td><?php echo $row['observaciones']; ?></td>
					<!--
					<td class="text-center"><a class="btn btn-primary btn-xs verButton" href="registro.php?id=<?php echo $row['id_venta']; ?>">ver</a>&nbsp;<a class="btn btn-success btn-xs verButton" href="registros.php?e=1&id=<?php echo $row['id_venta']; ?>">editar</a></td>
					-->
				</tr>
				<?php
			}
			?>
		</table>
		<?php Paginado($pagtabla, $total_paginas, "registros", "&v=" . $idproveedor . "&fd=" . $fechadesde . "&fh=" . $fechahasta); ?>
	</div>
	<?php
}

function InsertarIngrediente($link, $nombre){
	$nombre = $link->real_escape_string($nombre);
	//Creo el ingredientes
	$sql = "INSERT INTO ingredientes SET nombre = '$nombre';";
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	$idingrediente = mysqli_insert_id($link);
	return $idingrediente;
}

function AgregarProductoIngrediente($link, $idproducto, $idingrediente){
	$idproducto = $link->real_escape_string($idproducto);
	$idingrediente = $link->real_escape_string($idingrediente);
	//Creo el ingrediente
	$sql = "INSERT INTO productos_ingredientes SET id_producto = '$idproducto', id_ingrediente = '$idingrediente' ;";
	$link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	return true;
}

function EliminarProductoIngrediente($link, $idproducto, $idingrediente){
	$idproducto = $link->real_escape_string($idproducto);
	$idingrediente = $link->real_escape_string($idingrediente);
	//Creo el ingrediente
	$sql = "DELETE FROM productos_ingredientes WHERE id_producto = '$idproducto' AND id_ingrediente = '$idingrediente' ;";
	$link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	return true;
}

function InsertarPago($link, $idproveedor, $idvendedora, $fecha, $monto, $observaciones){
	$idproveedor = $link->real_escape_string($idproveedor);
	$idvendedora = $link->real_escape_string($idvendedora);
	$monto = $link->real_escape_string($monto);
	$fecha = $link->real_escape_string($fecha);
	$observaciones = $link->real_escape_string($observaciones);
	
	//Creo la familia
	$sql = "INSERT INTO pagos SET id_proveedor = '$idproveedor', id_vendedora = '$idvendedora', monto = '$monto', fecha_pago = '$fecha', observaciones = '$observaciones' ";
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	$idpago = mysqli_insert_id($link);
	return $idpago;
}

function InsertarArticulo($link, $idproveedor, $fechacarga, $fechadevolucion, $precio, $costo, $descripcion){
	$idproveedor = $link->real_escape_string($idproveedor);
	$fechacarga = $link->real_escape_string($fechacarga);
	$fechadevolucion = $link->real_escape_string($fechadevolucion);
	$precio = $link->real_escape_string($precio);
	$costo = $link->real_escape_string($costo);
	$descripcion = $link->real_escape_string($descripcion);
	
	//Creo el articulo
	$sql = "INSERT INTO articulos SET id_proveedor = '$idproveedor', precio = '$precio', costo = '$costo', descripcion = '$descripcion' ";
	if ($fechacarga){
		$sql .= ", fecha_carga = '$fechacarga' ";
	} else {
		$sql .= ", fecha_carga = null ";
	}
	if ($fechadevolucion){
		$sql .= ", fecha_devolucion = '$fechadevolucion' ";
	} else {
		$sql .= ", fecha_devolucion = null ";
	}
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	$idarticulo = mysqli_insert_id($link);
	return $idarticulo;
}

function ModificarProducto($link, $idproducto, $nombre, $descripcion, $precio1, $precio2, $precio3, $precio4){
	$idproducto = $link->real_escape_string($idproducto);
	$nombre = $link->real_escape_string($nombre);
	$descripcion = $link->real_escape_string($descripcion);
	$precio1 = $link->real_escape_string($precio1);
	$precio2 = $link->real_escape_string($precio2);
	$precio3 = $link->real_escape_string($precio3);
	$precio4 = $link->real_escape_string($precio4);
	
	//Modifico el articulo
	$sql = "UPDATE productos SET nombre = '$nombre', descripcion = '$descripcion', size_1 = '$precio1', size_2 = '$precio2', size_3 = '$precio3', size_4 = '$precio4' WHERE id_producto = $idproducto;";
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	return true;
}

function ModificarCategoria($link, $idcategoria, $nombre, $subtitulo, $descripcion, $titulo1, $titulo2, $titulo3, $titulo4){
	$idcategoria = $link->real_escape_string($idcategoria);
	$nombre = $link->real_escape_string($nombre);
	$subtitulo = $link->real_escape_string($subtitulo);
	$descripcion = $link->real_escape_string($descripcion);
	$titulo1 = $link->real_escape_string($titulo1);
	$titulo2 = $link->real_escape_string($titulo2);
	$titulo3 = $link->real_escape_string($titulo3);
	$titulo4 = $link->real_escape_string($titulo4);
	
	//Modifico el articulo
	$sql = "UPDATE categorias SET nombre = '$nombre', subtitulo = '$subtitulo', descripcion = '$descripcion', title_size_1 = '$titulo1', title_size_2 = '$titulo2', title_size_3 = '$titulo3', title_size_4 = '$titulo4' WHERE id_categoria = $idcategoria;";
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	return true;
}

function ListaVendedoras($link) {
	$sql = "SELECT * FROM usuarios WHERE id_tipo_usuario = 2 ORDER BY nombre";
	$result = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	return $result;
}

function TraerSaldo($link, $idproveedor) {
	$ventas = 0;
	//traigo lo que le dije a cada proveedor que le pagaba por su ropa
	$sql = "SELECT SUM(a.costo) as total FROM ventas v INNER JOIN articulos a ON a.id_articulo = v.id_articulo";
	if ($idproveedor > 1 ){
		$sql .= " WHERE a.id_proveedor = $idproveedor ";
	} else {
		$sql .= " WHERE a.id_proveedor > 1 ";
	}
	$result = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	if ($row = mysqli_fetch_array($result)) {
		$ventas += $row["total"];
	}
	$pagos = 0;
	$sql = "SELECT SUM(monto) AS pagos FROM pagos ";
	if ($idproveedor > 1 ){
		$sql .= " WHERE id_proveedor = $idproveedor ";
	} else {
		$sql .= " WHERE id_proveedor > 1 ";
	}
	$result = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	if ($row = mysqli_fetch_array($result)) {
		$pagos = $row["pagos"];
	}
	return $ventas - $pagos;
}

function ListaProveedores($link) {
	$sql = "SELECT * FROM proveedores ORDER BY nombre";
	$result = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	return $result;
}

function ListaAlmaceneros($link) {
	$sql = "SELECT * FROM almaceneros ORDER BY nombre";
	$result = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	return $result;
}

function TraerDescripcionTipoRegistro($link, $idtiporegistro) {
	$sql = "SELECT * FROM tipos_registros WHERE id_tipo_registro = $idtiporegistro ORDER BY id_tipo_registro";
	$result = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	if ($row = mysqli_fetch_array($result)) {
		return $row['nombre'];
	}
	return "";
}

function TraerProveedorPorIdArticulo($link, $idarticulo) {
	$sql = "
	SELECT p.nombre, a.precio, 'OK' as estado
	FROM articulos a 
	INNER JOIN proveedores p ON p.id_proveedor = a.id_proveedor 
	WHERE id_articulo = $idarticulo 
	AND (SELECT COUNT(*) FROM ventas v WHERE id_articulo = $idarticulo) = 0; ";
	$result = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	if ($row = mysqli_fetch_array($result)) {
		return $row;
	}
	$row = array('estado' => "ER", 'nombre' => "No hay producto", 'precio' => "0" );
	return $row;
}

/*********************************
* ListadoDeudas($link, $idsocio = -1)
*  -> $link : conexion a la base de datos
*  -> $idproveedor : id del socio (DEFAULT: -1 -> Todos)
*  <- HTML con tabla de registros
**********************************/
function ListadoDeudas($link, $idproveedor = -1){
	$idproveedor = $link->real_escape_string($idproveedor);

	$pagos = 0;
	$sql = "SELECT SUM(monto) AS pagos FROM pagos ";
	if ($idproveedor == -1 ){
		$sql .= "WHERE id_proveedor <> 1 ";
	} else {
		$sql .= "WHERE id_proveedor = $idproveedor ";
	}
	$result = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	if ($row = mysqli_fetch_array($result)) {
		$pagos = $row["pagos"];
	}
	
	$sql = "SELECT v.*, p.nombre as proveedor, a.costo, a.descripcion as articulo, u.nombre as vendedora, fecha_venta
	FROM ventas v 
	LEFT JOIN articulos a ON v.id_articulo = a.id_articulo
	LEFT JOIN proveedores p ON p.id_proveedor = a.id_proveedor 
	LEFT JOIN usuarios u ON u.id_usuario = v.id_vendedora
	WHERE 1 = 1 ";
	if ($idproveedor > -1){
		$sql .= " AND p.id_proveedor = $idproveedor ";
	}
	$sql .= " ORDER BY fecha_venta, p.id_proveedor, a.id_articulo;";
	//echo $sql;
	$rs = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	?>
	<div class="table-responsive">
		<table class="table table-condensed table-bordered">
			<tr>
				<th>fecha</th>
				<th>vendedora</th>
				<th>proveedor/a</th>
				<th>articulo</th>
				<th>pcio venta</th>
				<th>costo</th>
			</tr>
			<?php
			$resta = $pagos;
			while($row = mysqli_fetch_array($rs)) {
				$signo = 1;
				$clase = "";
				$monto = $row['costo'];
				$deuda = 0;
				$saldo = false;
				if ($monto <= $resta){
					$resta = $resta - $monto;
					continue;
				} else {
					$deuda = $monto - $resta;
					if ($resta > 0){
						$saldo = true;
						$resta = 0;
					}
				}
				?>
				<tr class="<?php echo $clase; ?>">

					<?php if ($saldo) { ?>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					<?php } else { ?>
						<td><?php echo $row['fecha_venta']; ?></td>
						<td><?php echo $row['vendedora']; ?></td>
					<?php } ?>

					<td><?php echo $row['proveedor']; ?></td>

					<?php if ($saldo) { ?>
						<td>Saldo</td>
					<?php } else { ?>
						<td><?php echo $row['articulo']; ?></td>
					<?php } ?>
					
					<?php if ($saldo) { ?>
						<td>&nbsp;</td>
					<?php } else { ?>
						<td class="text-right"><?php echo number_format($row['precio'], 2, '.', ''); ?></td>
					<?php } ?>
					
					<td class="text-right"><?php echo number_format($deuda, 2, '.', ''); ?></td>
				</tr>
				<?php
			}
			?>
		</table>
	</div>
	<?php
}

function ListadoDeudasImprimir($link, $tt){
	$sql = "SELECT * FROM socios ";
	if ($tt == "tt"){
		$sql .= " WHERE nombre LIKE '%TT%' ";
	}
	$sql .= " ORDER BY id_socio ";
	
	$result = $link->query($sql) or die("Error en la consulta.." . mysqli_error($link));
	while ($row = mysqli_fetch_array($result)) {
		$idsocio = $row["id_socio"];
		if ($idsocio == 10) continue;
		$nombresocio = $row["nombre"];
		$saldo = TraerSaldo($link, $idsocio);
		if ($saldo > 0){
			?>
			<div class="row">
				<label>Saldo a pagar a <label class="text-danger" style="font-size: 20px;"><?php echo "[" . $idsocio . "] " . $nombresocio; ?></label>: </label> <label class="text-success" style="font-size: 20px;"><?php echo number_format($saldo, 2, '.', ''); ?></label> Mitad: (<?php echo number_format($saldo/2, 2, '.', ''); ?>)
			</div>
			<?php
			ListadoDeudas($link, $row["id_socio"]);
		}
	}
}

?>
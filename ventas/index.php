<?php

session_start();

if(!isset($_SESSION['usuario']))
header('Location: ../inicio/login.php');

require_once('../funciones/conexion.php');
function limiteCantidad($id_p){
	/*conectar();
	
	$query = 'select cantidad from inventario where id_producto = "'.$id_p.'"';
	$resul = $conexion->query($query);
	
	if($resul->num_rows==1){
		echo $resul['cantidad'];
	}else
		echo 'null';*/
		echo $id_p;
}

?>
<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
<title>Nueva Venta</title>

<meta name="description" content="Your description">
<meta name="keywords" content="Your keywords">
<meta name="author" content="Your name">
<link rel="stylesheet" href="../css/style.css">
<script src="../js/jquery-1.7.1.min.js"></script>
<script src="funciones_compra.js"></script>
<script src="../js/superfish.js"></script>
<script src="../servicios/funciones.js"></script>
<!--[if lt IE 8]>
   <div style=' clear: both; text-align:center; position: relative;'>
     <a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode">
       <img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." />
    </a>
  </div>
<![endif]-->
<!--[if lt IE 9]>
	<script src="js/html5.js"></script>
	<link rel="stylesheet" href="css/ie.css"> 
<![endif]-->
</head>
<body onLoad="javascript:document.getElementById('codigo').focus();">
<!-- Header -->
<header>
	<?php
      require_once('../funciones/pagina.php');
	  headers($_SESSION['id']);
	  ?>
</header>
<!-- Content -->
<section id="content">
	
	<div class="container_24">
		<div class="a1">
			<h2>Nueva Venta:</h2>
		</div>
		<h4>Agregar Producto</h4>
		<div class="wrapper">
			<table style="width:50%;">
				<tr>
					<td>Código</td>
					<td><input type="button" style="width:10px;" onClick="restar(cantidad)" value="-"/>
						<input type="text" width="10" style="width:20px" value="1" id="cantidad"/>
						<input type="button" onClick="sumar(cantidad)" value="+"  style="width:10px;"/></td>
					<td><input type="text" style="width:100%;" id="codigo" onKeyPress="return pulsarCodigo(event,this.value)"  /></td>
					<td><button type="button" onClick="accion(2,codigo.value,cantidad.value)">Agregar</button></td>
					<td id="loading" width="23px"></td>
				</tr>
			</table>
			<div id="carrito">
			</div>
				<script>
	  accion(1,0,0);</script>
			<div id="servicios">
			</div>
			<div id="total_compra">
			</div>
			<div>
				<div>
					<table>
						<tr>
							<th>Tipo de Pago</th>
							<th>Forma de Pago</th>
							<th>Tipo de Cliente</th>
							<th>Pago</th>
							<th>Comprar</th>
						</tr>
						<tr>
							<td align="center"><input type="hidden" id="tipo_pago" value="Contado"/>
								<input type="radio"  name="tipo_pago" onChange="zonaAbono(false)" checked>
								Contado
								<input type="radio" name="tipo_pago" value="Credito" onChange="zonaAbono(true)">
								Credito
								<div id="zona_abono">
								</div></td>
							<td align="center"><input type="hidden" id="forma_pago" value="Efectivo"/>
								<input type="radio" name="forma_pago" onChange="javascript:document.getElementById('forma_pago').value='Efectivo';"  checked>
								Efectivo
								<input type="radio" name="forma_pago" onChange="javascript:document.getElementById('forma_pago').value='Tarjeta';"  >
								Tarjeta </td>
							<td align="center"><input type="hidden" name="id_cliente" id="id_cliente" value="0" />
								<input type="radio" name="tipo_cliente" value="0"  onChange="cargarCliente(false)" checked>
								Publico General
								<input type="radio" name="tipo_cliente" value="" onChange="cargarCliente(true,'')">
								Cliente</td>
								<td>$<input type="text" name="pago" id="pago"/></td>
							<td><button onClick="comprar(7)">Finalizar Venta</button></td>
						</tr>
					</table>
					<a onClick="comprar(8)">Cancelar Venta</a>
				</div>
			</div>
			<div id="clientes">
			</div>
			<div id="zona_compra" style="display:none;">
			</div>
		</div>
	</div>
</section>
<!-- Footer -->
<footer>
	<?php footer(); ?>
</footer>
</body>
</html>
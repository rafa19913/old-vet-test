<?php

session_start();

if(!isset($_SESSION['usuario']))
header('Location: ../inicio/login.php');

require_once('../funciones/conexion.php');

?>
<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
<title>Detalles de la Venta</title>

<meta name="description" content="Your description">
<meta name="keywords" content="Your keywords">
<meta name="author" content="Your name">
<link rel="stylesheet" href="../css/style.css">
<script src="../js/jquery-1.7.1.min.js"></script>
<script src="../js/superfish.js"></script>
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
      <h2>Detalles de la venta:</h2>
    </div>
    <div class="wrapper">
      <div id="carrito">
        <?php
	  
		$conexion = conectar();
	  $datos = $conexion->query('select v.*, c.nombre as nombre_c, u.nombre as usuario_c from venta v, cliente c, corte, usuario u where v.id_cliente = c.id_cliente and v.id_corte = corte.id_corte and corte.id_usuario = u.id_usuario and v.id_venta = ' . $_GET['id'])->fetch_assoc();
	  
	  ?>
      <table>
      <tr>
      <th>Venta Num</th>
      <th>Fecha</th>
      <th>Atendio</th>
      <th>Cliente</th>
      <th>Tipo de Pago</th>
      <th>Forma de Pago</th>
      </tr>
      <tr>
      <td><?php echo $datos['id_venta']; ?></td>
      <td><?php echo $datos['fecha']; ?></td>
      <td><?php echo $datos['usuario_c']; ?></td>
      <td><?php echo $datos['nombre_c'];?></td>
      <td><?php echo $datos['tipo_pago'];?></td>
      <td><?php echo $datos['forma_pago'];?></td>
      </tr>
      </table>
        <h3>Lista de Articulos</h3>
        <table>
          <tr>
            <th>Codigo</th>
            <th>Nombre</th>
            <th>Presentacion</th>
            <th>Proveedor</th>
            <th>Cantidad</th>
            <th>Precio Vendido</th>
          </tr>
          <?php

$query = 'select p.id_producto, p.nombre, p.unidad,p.proveedor, l.cantidad, l.precio_vendido
from inventario p, lista_productos l
where l.id_producto = p.id_producto and
l.id_venta = ' . $_GET['id'];

$resul = $conexion->query($query);

while($fila = $resul->fetch_assoc()){
?>
          <tr>
            <td><?php echo $fila['id_producto'];?></td>
            <td><?php echo $fila['nombre'];?></td>
            <td><?php echo $fila['unidad'];?></td>
            <td><?php echo $fila['proveedor'];?></td>
            <td><?php echo $fila['cantidad'];?></td>
            <td>$<?php echo $fila['precio_vendido'];?></td>
          </tr>
          <?php
}//fin while


$total = $conexion->query('select sum(precio_vendido) as total from lista_productos where id_venta = ' . $_GET['id'])->fetch_assoc();

?>
        </table>
        <table>
          <tr>
            <td align="left"><h4>Total de productos: $<?php echo $total['total'];?></h4></td>
          </tr>
        </table>
      </div>
      <div id="servicios">
        <h3>Lista de Servicios Realizados</h3>
        <table>
          
            <th>Mascota</th>
            <th>Servicio Realizado</th>
            <th>Fecha Realizado</th>
            <th>Detalles</th>
            <th>Total</th>
          </tr>
          <?php
	$conexion = conectar();
	
	$query = 'select m.nombre, s.nombre as servicio, s.id_servicio, a.fecha_realizado , a.id_agenda, ls.precio_vendido
	from mascota m, servicio s, agenda a , lista_servicios ls, venta v
	where a.id_agenda = ls.id_agenda and
	s.id_servicio = a.id_servicio and
	a.id_mascota = m.id_mascota and
	ls.id_venta = v.id_venta and
	v.id_venta = ' . $_GET['id'];
	//echo $query;
	$resul = $conexion->query($query);
	$totalServicios = 0;
	while($fila = $resul->fetch_assoc()){
	?>
          <tr>
            <td><?php echo $fila['nombre'];?></td>
            <td><?php echo $fila['servicio'];?></td>
            <td><?php echo $fila['fecha_realizado'];?></td>
            <td><a href="../agenda/detalles.php?id=<?php echo $fila['id_agenda'];?>" target="_blank" >Detalles</a></td>
            <td>$
              <?php
	 echo $fila['precio_vendido'];
	 $totalServicios = $totalServicios + $fila['precio_vendido'];
	 ?></td>
          </tr>
          <?php }//fin while ?>
        </table>
        <table>
          <tr>
            <td align="left"><h4>Total de Servicios: $<?php echo $totalServicios;?></h4>
              <input type="hidden" id="total_pagado" name="total_pagado" value="<?php echo $totalServicios;?>"/></td>
          </tr>
        </table>
      </div>
      <div id="total_compra">
        <table>
          <tr>
            <td align="center"><h2>Total de la venta: $<?php echo $totalServicios + $total['total'];?></h2></td>
          </tr>
        </table>
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
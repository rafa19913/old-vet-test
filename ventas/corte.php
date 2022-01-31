<?php
error_reporting(0);
session_start();

if(!isset($_SESSION['usuario']))
header('Location: ../inicio/login.php');

?>
<!DOCTYPE html>
<html lang="en">
	<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
	<title>Corte de Caja</title>
	
	<meta name="description" content="Your description">
	<meta name="keywords" content="Your keywords">
	<meta name="author" content="Your name">
	<link rel="stylesheet" href="../css/style.css">
	<script src="../js/jquery-1.7.1.min.js"></script>
	<script src="../js/superfish.js"></script>
	<script type="text/javascript">



	</script>
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
	<body>
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
          <h2>Corte de Caja: </h2>
        </div>
    <div class="wrapper">

<table>

<tr>
<th>Fecha de Inicio del corte</th>
<th>Ventas Realizadas</th>
<th>Ventas de Contado</th>
<th>Ventas a Credito</th>
<th>Abonos Realizados</th>
<th>Total Efectivo</th>
<th>Total Tarjeta</th>
</tr>


<tr>
<?php

require_once('../funciones/conexion.php');
$conexion = conectar();


$id_c = $conexion->query('select id_corte, fecha_inicio from corte where fecha_fin = "0000-00-00 00:00"')->fetch_assoc();
$query = 'select 
(select count(*) from venta where id_corte = '. $id_c['id_corte']. ') as total_ventas,
(select count(*) from venta where id_corte = '. $id_c['id_corte']. ' and tipo_pago = "Contado") as total_contado,
(select count(*) from venta where id_corte = '. $id_c['id_corte']. ' and tipo_pago = "Credito") as total_credito,
(select count(*) from abono where id_corte = '. $id_c['id_corte']. ') as total_abonos,
(select sum((select coalesce(sum(cantidad),0) from abono where id_corte = '. $id_c['id_corte']. ' and forma_pago = "Efectivo" )+(select coalesce(sum(total),0) from venta where id_corte = '. $id_c['id_corte']. ' and tipo_pago = "Contado" and forma_pago="Efectivo") ))as efectivo,
(select sum((select coalesce(sum(cantidad),0) from abono where id_corte = '. $id_c['id_corte']. ' and forma_pago = "Tarjeta" )+(select coalesce(sum(total),0) from venta where id_corte = '. $id_c['id_corte']. ' and tipo_pago = "Contado" and forma_pago="Tarjeta") ))as tarjeta
';
$corte = $conexion->query($query)->fetch_assoc();
/*
select sum((select coalesce(sum(cantidad),0) from abono where id_corte = '. $id_c['id_corte']. ' and forma_pago = "Efectivo" )+(select coalesce(sum(total),0) from venta where id_corte = '. $id_c['id_corte']. ' and tipo_pago = "Contado" and forma_pago="Efectivo") )

*/
?>

<td><?php echo $id_c['fecha_inicio'];?></td>
<td><?php echo $corte['total_ventas'];?></td>
<td><?php echo $corte['total_contado'];?></td>
<td><?php echo $corte['total_credito'];?></td>
<td><?php echo $corte['total_abonos'];?></td>
<td>$<?php echo $corte['efectivo'];?></td>
<td>$<?php echo $corte['tarjeta'];?></td>
</tr>
</table>

<form id="contact-form" action="cerrar.php" method="post">
<input type="hidden" name="id" value="<?php echo $id_c['id_corte'] ?>"/>
<strong>Cantidad actual:</strong>:<br>
<input type="text" name="cantidad" value="0"/><br><br>

<input type="submit" value="Cerrar Corte" class="submit"/>

</form><br>
<br><br>
<br>


<h3>Productos Vendidos</h3>

<table>
<tr>
<th>Código</th>
<th>Nombre</th>
<th>Cantidad</th>
<th>Total</th>
</tr>

<?php
$queryPro = '
select i.id_producto, i.nombre, sum(lp.cantidad) as cantidad, sum(lp.precio_vendido) as total
from inventario i, lista_productos lp, venta v where
v.id_corte = '.$id_c['id_corte'].' and
lp.id_venta = v.id_venta and
lp.id_producto = i.id_producto
group by lp.id_producto
';
$resultadoVentas = $conexion->query($queryPro);

while($pro = $resultadoVentas->fetch_assoc()){
	echo '
	<tr>
	<td>'.$pro['id_producto'].'</td>
	<td>'.$pro['nombre'].'</td>
	<td>'.$pro['cantidad'].'</td>
	<td>$'.$pro['total'].'</td>
	</tr>
	';
}

?>
</table>


        </div>
  </div>
    </section>
<!-- Footer -->

<footer>
  <?php footer(); ?>
</footer>
</body>
</html>
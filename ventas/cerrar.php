<?php
error_reporting(0);
session_start();

if(!isset($_SESSION['usuario']))
header('Location: ../inicio/login.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Corte de Caja</title>
<meta charset="utf-8">
<meta name="description" content="Your description">
<meta name="keywords" content="Your keywords">
<meta name="author" content="Your name">
<link rel="stylesheet" href="../css/style.css">
<script src="../js/jquery-1.7.1.min.js"></script>
<script src="../js/superfish.js"></script>
<script src="funciones_compra.js"></script>
<script>
function imprimirTicket(){
	zona = document.getElementById('ticket').innerHTML;
	
	imprimir(zona);
}
</script>

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
			<?php
require_once('../funciones/conexion.php');
$conexion = conectar();

if($conexion->query('update corte set fecha_fin = now(), dinero = '.$_POST['cantidad'].' where fecha_fin = "0000-00-00 00:00"')){
if($conexion->query('insert into corte (fecha_inicio,fecha_fin,dinero) values (now(),"0000-00-00 00:00:00",0)')){
echo 'Corte guardado correctamente';
}else
echo 'Existio un error al crear el nuevo corte.';
}else
echo 'Existió un problema al cerrar el corte, intenta de nuevo.'

?>
			<div id="ticket" style="display:none">
				<?php
$id_c = $_POST['id'];
	$datos = $conexion->query('select * from corte where id_corte = ' . $id_c)->fetch_assoc();
	
	?>
				<div  style="width:250px; ">
					-----------------------------------------
					<center>
						Veterinaria Santa Fé
					</center>
					13 César López de Lara #2646
					Col. Treviño Zapata Cd. Victoria Tamps<br>
					----------------------------------------- <br>
					Corte Num: <?php echo $datos['id_corte']; ?><br>
					Fecha Inicio: <?php echo $datos['fecha_inicio']; ?><br>
					Fecha Cierre: <?php echo $datos['fecha_fin']; ?><br>
					<br>
					<?php echo 'Nombre    |  Cant  | Precio<br>';
	
	$listaProd = $conexion->query('select i.id_producto, i.nombre, sum(lp.cantidad) as cantidad, sum(lp.precio_vendido) as total
from inventario i, lista_productos lp, venta v where
v.id_corte = '.$id_c.' and
lp.id_venta = v.id_venta and
lp.id_producto = i.id_producto
group by lp.id_producto');
	while($producto=$listaProd->fetch_assoc()){
	?> <?php echo $producto['nombre']. ' | ' .  $producto['cantidad']. ' | $' .$producto['total'].'<br> ' ;
	
	}//fin ciclo while
	
	
	?> <br>
					------------------------------------------
					Total del Corte: $ <?php echo $datos['dinero'];?><br>
					----------------------------------------- <br>
					<br>
				</div>
			</div>
			<script>
			imprimirTicket();
			</script>
		</div>
	</div>
</section>
<!-- Footer -->

<footer>
	<?php footer(); ?>
</footer>
</body>
</html>
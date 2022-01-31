<?php
error_reporting(0);
session_start();

if(!isset($_SESSION['usuario']))
header('Location: ../inicio/login.php');

?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<title>Guardar Producto</title>
	<meta charset="utf-8">
	<meta name="description" content="Your description">
	<meta name="keywords" content="Your keywords">
	<meta name="author" content="Your name">
	<link rel="stylesheet" href="../css/style.css">
	<script src="../js/jquery-1.7.1.min.js"></script>
	<script src="../js/superfish.js"></script>
	<script type="text/javascript">
		$(function(){
			function equalHeight(group) {
				var tallest = 0;
				group.each(function() {
					var thisHeight = $(this).height();
					if(thisHeight > tallest) {
						tallest = thisHeight;
					}
				});
				group.height(tallest);
			}	
			equalHeight($(".box-1 .inner"));
		})
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
      <div class="ic">More Website Templates @ TemplateMonster.com. July 23, 2012!</div>
      <div class="container_24">
    <div class="a1">
          <h2>Actualizar Producto: </h2>
        </div>
    <div class="wrapper">
	<?php
    require_once('../funciones/conexion.php');
	$conexion = conectar();
	
	$cantidad = $conexion->query('select cantidad from inventario where id_producto = "'.$_POST['codigo'].'"')->fetch_assoc();
	
	$cantidad = $cantidad['cantidad'] - $_POST['cantidad'];


	
	$query = 'update inventario set cantidad = '.$cantidad . ' where id_producto = "'.$_POST['codigo'].'"';
	$query2 = 'insert into salida (fecha, cantidad, motivo, id_producto) values (now(),"'.$_POST['cantidad'].'","'.$_POST['motivo'].'","'.$_POST['codigo'].'")';
	
if($conexion->query($query) && $conexion->query($query2)){
echo 'Salida de Producto guardado correctamente.<br> <a href="nueva_salidas.php">Salida de otro producto.</a> ';

?>
	<table>
		<tr>
			<th>Codigo</th>
			<th>Nombre</th>
			<th>Presentación</th>
			<th>Proveedor</th>
			<th>Precio Venta</th>
			<th>Cantidad</th>
		</tr>
		<tr>
			<?php 
				$id = $_POST['codigo'];
				$query = "select * from inventario where id_producto = '$id'";
				$row = $conexion->query($query)->fetch_assoc();
			?>
			<td><?php echo $row['id_producto']; ?></td>
			<td><?php echo $row['nombre']; ?></td>
			<td><?php echo $row['unidad']; ?></td>
			<td><?php echo $row['proveedor']; ?></td>
			<td><?php echo $row['precio_venta']; ?></td>
			<td><?php echo $row['cantidad']; ?></td>
		</tr>
	</table>
<?php
	
}
else
echo 'Existió un problema en la salida del producto, intenta nuevamente.
<a href="nueva_salidas.php">Intentar de nuevo.</a>';
	
	//echo $query;
	?>
    
    

        </div>
  </div>
    </section>
<!-- Footer -->
<footer>

		<?php footer(); ?>    </footer>
</body>
</html>
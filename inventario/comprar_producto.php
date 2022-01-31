<?php

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
	<script src="../funciones/validaciones.js"></script>
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
		<div class="ic">
		More Website Templates @ TemplateMonster.com. July 23, 2012!
	</div>
		<div class="container_24">
		<div class="a1">
				<h2>Modificar Producto: </h2>
			</div>
		<div class="wrapper">
				<?php
	require_once('../funciones/conexion.php');
	$conexion = conectar();
	
	$producto = $conexion->query('select * from inventario where id_producto = "'. $_POST['id'].'" ')->fetch_assoc();
	
	?>
				<form id="contact-form" action="guardar_compra.php" method="post" onSubmit="return validarCompraPruducto()">
				<input type="hidden" name="codigo" value="<?php echo $producto['id_producto']; ?>" />
				<div class="columnaIzquierda">
						Codigo de Barras:<br>
						<input type="text" disabled id="codigo" value="<?php echo $producto['id_producto']; ?>" />
						<br>
						<br>
						Nombre:<br>
						<input name="nombre" type="text" disabled value="<?php echo $producto['nombre']; ?>" id="nombre"/>
						<br>
						<br>
						Descripción:<br>
						<textarea name="descripcion" disabled class="comentarios"><?php echo $producto['descripcion']; ?></textarea>
						<br>
						<br>
						<br>
						<br>
						<br>
						<br>
						<br>
						Proveedor:<br>
						<input name="proveedor" disabled type="text" value="<?php echo $producto['proveedor']; ?>" width="150"/>
						<br>
						<br>
						Presentación:<br>
						<input name="unidad" type="text" disabled value="<?php echo $producto['unidad']; ?>" id="unidad"/>
						<br>
						<br>
						Imagen:<br>
						<input name="imagen" type="text" disabled value="<?php echo $producto['imagen']; ?>" />
					</div>
				<div class="columnaDerecha">
						Precio Venta:<br>
						<input name="precio_venta" type="text" id="precio" value="<?php echo $producto['precio_venta'] ?>"/>
						<br>
						<br>
						Cantidad comprada:<br>
						<input name="cantidad" type="text"  id="cantidad"/>
						<br>
						<br>
						<input type="submit" value="Guardar" width="200px"  class="submit"/>
						<br>
						<br>
						</p>
					</div>
			</form>
				<br>
			</div>
	</div>
	</section>
<!-- Footer -->
<footer>
		
		<?php footer(); ?>
	</footer>
</body>
</html>
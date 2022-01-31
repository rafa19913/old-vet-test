<?php

session_start();

if(!isset($_SESSION['usuario']))
header('Location: ../inicio/login.php');

?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<title>Salida Producto</title>
	<meta charset="utf-8">
	<meta name="description" content="Your description">
	<meta name="keywords" content="Your keywords">
	<meta name="author" content="Your name">
	<link rel="stylesheet" href="../css/style.css">
	<script src="../js/jquery-1.7.1.min.js"></script>
	<script src="../js/superfish.js"></script>
	<script src="../funciones/validaciones.js"></script>

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
		
	</div>
		<div class="container_24">
		<div class="a1">
				<h2>Salida de Producto: </h2>
			</div>
		<div class="wrapper">
				<?php
	require_once('../funciones/conexion.php');
	$conexion = conectar();
	
	$producto = $conexion->query('select * from inventario where id_producto = "'. $_POST['id'].'" ')->fetch_assoc();
	
	?>
				<form id="contact-form" action="guardar_salida.php" method="post" onSubmit="return validarSalida()">
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
						
						Cantidad:<br>
						<input name="cantidad" type="text"  id="cantidad"/>
						<br>
						<br>
						Motivo de la Salida:<br>
						<input name="motivo" type="text" id="motivo"/>
						<br>
						<br>
						<?php 
			              if($_SESSION['lugar']=="true")
			                $id_admin = 4;
			              else
			                $id_admin = 7;

			              $query_pass = "select password from usuario where id_usuario = $id_admin";
			              $pass = $conexion->query($query_pass)->fetch_assoc();
			              $pass = $pass['password'];
			              ?>
			              <input type="hidden" id="p_oculto" value="<?php echo $pass; ?>"/>
			              Contraseña:<br>
			              <input type="password" name="password" type="text" id="password"/>
			              <br>
			              <br>
						<input type="submit" class="submit" value="Guardar Salida"/>
						</p>
					</div>
			</form>
				<br>
			</div>
	</div>
	</section>
<!-- Footer -->
<footer>

		<?php footer(); ?>	</footer>
</body>
</html>
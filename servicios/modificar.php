<?php

session_start();

if(!isset($_SESSION['usuario']))
header('Location: ../inicio/login.php');

?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<title>Agregar Vacuna</title>
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
          <h2>Modificar Servicio: </h2>
        </div>
    <div class="wrapper"> 
          <script src="../funciones/validaciones.js"></script>
          <?php
    require_once('../funciones/conexion.php');
	$conexion = conectar();
	
	$vacuna = $conexion->query('select * from servicio where id_servicio = ' . $_POST['id'])->fetch_assoc();
	
	?>
          <form id="contact-form" action="actualizar.php" method="post" onSubmit="return validarServicio()">
        <input type="hidden" name="id" value="<?php echo $_POST['id'];?>"/>
        <br>
        Nombre:<br>
        <input type="text" name="nombre" id="nombre" value="<?php echo $vacuna['nombre'];?>"/>
        <br>
        <br>
        Descripción:<br>
        <input type="text" name="descripcion" id="descripcion"value="<?php echo $vacuna['descripcion'];?>"/>
        <br>
        <br>Precio:<br>
        <input type="text" name="precio" id="precio" value="<?php echo $vacuna['precio'];?>"/>
        <br>
        <br>
        <input type="submit" class="submit" value="Guardar"/>
      </form>
        </div>
  </div>
    </section>
<!-- Footer -->
<footer>
      <?php footer(); ?>
    </footer>
</body>
</html>
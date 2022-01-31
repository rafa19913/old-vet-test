<?php
error_reporting(0);
session_start();

if(!isset($_SESSION['usuario']))
header('Location: ../inicio/login.php');

?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<title>Actualizar Servicio</title>
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
          <h2>Actualizar Servicio: </h2>
        </div>
    <div class="wrapper"> 
    <?php
	
	require_once('../funciones/conexion.php');
	$conexion = conectar();
	
	if(isset($_POST['nombre']) &&isset($_POST['descripcion']))
	$query = 'update servicio set nombre = "'.$_POST['nombre'].'" , descripcion = "'.$_POST['descripcion'].'", precio = '.$_POST['precio'].' where id_servicio = '. $_POST['id'];
	
	
	
    if($conexion->query($query))
	echo 'Servicio actualizado correctamente.<br>
	<a href="agregar.php">Agregar otro servicio</a>';	
	else
	echo 'Existió un problema al actualizar el servicio, por favor intenta de nuevo.<br>
	<a href="agregar.php">Intentar de nuevo.</a>';	

	
	?>
    
    </div>
  </div>
    </section>
<!-- Footer -->
<footer>
      <?php footer(); ?>
    </footer>
</body>
</html>
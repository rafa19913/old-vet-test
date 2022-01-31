<?php

session_start();

if(!isset($_SESSION['usuario']))
header('Location: ../inicio/login.php');

?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<title>Nuevo Perfil</title>
	<meta charset="utf-8">
	<meta name="description" content="Your description">
	<meta name="keywords" content="Your keywords">
	<meta name="author" content="Your name">
	<link rel="stylesheet" href="../css/style.css">
	<script src="../js/jquery-1.7.1.min.js"></script>
	<script src="../js/superfish.js"></script>
	<script type="text/javascript">
	
	</script>
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
          <h2>Nuevo Perfil:</h2>
        </div>
    <div class="wrapper">
          <form action="agregar.php" method="post">
        <strong>Nombre:</strong><br>
        <input type="text" name="nombre" id="nombre" style="width: 350px;
	font-size: 12px;
	padding: 2px 5px 7px 5px !important;
	background: #fff;
	outline: none;
	font-family: Arial, Helvetica, sans-serif;
	display: block;
	color: #0000CC;
	margin: 0;
	box-shadow: none;
	border: none;
	border-left: 1px solid #d9d9d9;
	border-top: 1px solid #d9d9d9;
	float: left;
	border-radius: 5px;
	height: 20px;"/>
        <br>
        <br>
        <strong>Selecciona las opciones que tendrá acceso:</strong><br>
        
        <?php
		
		require_once('../funciones/conexion.php');		
		$conexion = conectar();
		
		$resul = $conexion->query('select * from opcion_menu');
		
		while($opcion = $resul->fetch_assoc()){
			echo '<input type="checkbox" name="opciones[]"  value="'.$opcion['id_opcion'].'"/>'.$opcion['nombre'].'<br>';			
		}
		?>
<br>

        
        <input type="submit" value="Agregar" style="width: 350px;
	font-size: 12px;
	padding: 2px 5px 7px 5px !important;
	background: #fff;
	outline: none;
	font-family: Arial, Helvetica, sans-serif;
	display: block;
	color: #0000CC;
	margin: 0;
	box-shadow: none;
	border: none;
	border-left: 1px solid #d9d9d9;
	border-top: 1px solid #d9d9d9;
	float: left;
	border-radius: 5px;
	height: 30px;"/>
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
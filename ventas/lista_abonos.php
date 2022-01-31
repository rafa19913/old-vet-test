<?php

session_start();

if(!isset($_SESSION['usuario']))
header('Location: ../inicio/login.php');

require_once('../funciones/conexion.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Lista de Abonos</title>
<meta charset="utf-8">
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
  <div class="ic">More Website Templates @ TemplateMonster.com. July 23, 2012!</div>
  <div class="container_24">
    <div class="a1">
      <h2>Lista de Abonos:</h2>
    </div>
    <div class="wrapper">
    <table>
    <tr>
    <th>Recibió</th>
    <th>Cantidad</th>
    <th>Forma de Pago</th>
    <th>Fecha</th>
    </tr>
    
    <?php
	$conexion = conectar();
	
	$query = 'select abono.*, u.nombre from abono,usuario u  where u.id_usuario = abono.id_usuario and id_credito = ' . $_GET['id'];
	$resu = $conexion->query($query);
	while($abono = $resu->fetch_assoc()){
	?>
    <tr>
    <td><?php echo $abono['nombre'];?></td>
    <td>$<?php echo $abono['cantidad'];?></td>
    <td><?php echo $abono['forma_pago'];?></td>
    <td><?php echo $abono['fecha'];?></td>
    </tr>
    <?php
	}//fin while
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
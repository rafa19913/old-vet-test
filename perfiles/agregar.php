<?php

session_start();

if(!isset($_SESSION['usuario']))
header('Location: ../inicio/login.php');

?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<title>Agregar Perfil</title>
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
          <h2>Agregar Perfil:</h2>
        </div>
    <div class="wrapper">
         
        <?php
		
		require_once('../funciones/conexion.php');		
		$conexion = conectar();
		
		$query = 'insert into perfil (nombre) values ("'.$_POST['nombre'].'")';
		if($conexion->query($query)){
			echo 'Perfil agregado correctamente<br>
			<a href="nuevo.php">Agregar otro perfil</a>';
			$opcion = $_POST['opciones'];
			
			for($i = 0; $i < count($opcion); $i++){
				$conexion->query('insert into menu values (last_insert_id(), '.$opcion[$i].')');
			}
		}
		else
		echo 'Existió un error al crear el perfil<br>
		<a href="nuevo.php">Intentar de nuevo.</a>';
		
		
		?>
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
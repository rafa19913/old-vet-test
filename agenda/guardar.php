<?php

session_start();

if(!isset($_SESSION['usuario']))
header('Location: ../inicio/login.php');

?>
<!DOCTYPE html>
<html lang="en">
	<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
	<title>Veterinaria Santa Fe</title>
	
	<meta name="description" content="Your description">
	<meta name="keywords" content="Your keywords">
	<meta name="author" content="Your name">
	<link rel="stylesheet" href="../css/style.css">
	<script src="../js/jquery-1.7.1.min.js"></script>
	<script src="../js/superfish.js"></script>
    
	<script language="javascript" src="../funciones/calendar/calendar.js"></script>
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
      
      <div class="container_24">
    <div class="a1">
          <h2>Agenda: </h2>
        </div>
    <div class="wrapper">
  <?php
  require_once('../funciones/conexion.php');
  $conexion = conectar();
  
  $id = ($conexion->query('select max(id_agenda) as id from agenda')->fetch_assoc());
  $id = $id['id'] + 1;
  
  $query = 'insert into agenda (id_agenda,fecha,comentarios,fecha_realizado,id_estado,id_servicio,id_mascota) values ('.$id.',"'.$_POST['fecha'].'","'.$_POST['comentarios'].'","0000-00-00",2,'.$_POST['servicio'].',"'.$_POST['mascota'].'")';
  $mascota = ($conexion->query('select nombre from mascota where id_mascota = "' . $_POST['mascota'] . '"')->fetch_assoc());
  
   // echo $query;
  if($conexion->query($query)){
  echo 'Nueva cita agregada correctamente.';
  echo '
  <form action="agregar.php" method="post">
  <input type="hidden" name="id" value="'.$_POST['mascota'].'"/>
  <input type="submit" value="Agregar otra cita a la mascota"/>
  </form>
  ';
  }
  else {
  echo 'Existió un problema para agregar la cita, intente nuevamente.';
  echo '
  <form action="agregar.php" method="post">
  <input type="hidden" name="id" value="'.$_POST['id_cliente'].'"/>
  <input type="submit" value="Intentar de nuevo"/>
  </form>
  ';
  }
  if(isset($_POST['id_vacuna'])){
	  $query = 'insert into historial_vacunas values ('.$id.','.$_POST['id_vacuna'].')';
	  //echo $query;
	  $conexion->query($query); 
  }
  if(isset($_POST['id_desparasitante'])){
	  $query = 'insert into historial_desparasitaciones values ('.$id.','.$_POST['id_desparasitante'].')';
	  //echo $query;
	  $conexion->query($query); 
  }
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
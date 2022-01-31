<?php
//error_reporting(0);
session_start();

if(!isset($_SESSION['usuario']))
header('Location: ../inicio/login.php');


  require_once('../funciones/conexion.php');
  $conexion = conectar();
  $query = 'update agenda set  comentarios ="'.$_POST['comentarios'].'",id_estado='.$_POST['estado'] . ', fecha = "'.$_POST['fechaCita'].'", id_servicio = '.$_POST['servicio'].' ';
  
	  
  if(isset($_POST['id_vacuna'])){//acciones para la vacuna
	  $conexion->query('delete from historial_vacunas where id_agenda = '.$_POST['id']);
	  $conexion->query('delete from historial_desparasitaciones where id_agenda = '.$_POST['id']);
	  $conexion->query('insert into historial_vacunas values ('.$_POST['id'].','.$_POST['id_vacuna'].')');
  }
  if(isset($_POST['id_desparasitante'])){//acciones para el depsarasitante
	  $conexion->query('delete from historial_vacunas where id_agenda = '.$_POST['id']);
	  $conexion->query('delete from historial_desparasitaciones where id_agenda = '.$_POST['id']);
	  $conexion->query('insert into historial_desparasitaciones values ('.$_POST['id'].','.$_POST['id_desparasitante'].')');
  }
  
  //voy armando toda la consulta de aucerdo a los nuevos valores
  if($_POST['estado']==1){
	  $query = $query . ', fecha_realizado = "' . $_POST['fecha'] . '"';
  }else if($_POST['estado']==3){
  		$query = 'delete from agenda ';
  }
  if($_POST['estado']==4 || $_POST['estado']==1 ){
$conexion->query('insert into cobrar_servicio values ('.$_POST['id'].')');
$queryCantidad = 'select ms.cantidad, ms.id_producto from material_servicio ms, servicio s, agenda a
	where a.id_servicio = s.id_servicio and s.id_servicio = ms.id_servicio and a.id_agenda = ' . $_POST['id'];
	
	$resultado = $conexion->query($queryCantidad);
	while($producto = $resultado->fetch_assoc()){
		$cantidad = $conexion->query('select cantidad from inventario where id_producto = "'.$producto['id_producto'].'"')->fetch_assoc();
		
		$cantidad = $cantidad['cantidad'] - $producto['cantidad'];
		
		$queryActualizar = 'update inventario set cantidad = '.$cantidad.' where id_producto = "'.$producto['id_producto'].'"';
		$conexion->query($queryActualizar);
	}
	}
  $query = $query . ' where id_agenda = ' . $_POST['id']; 
 // echo $query;
  $aux = false;//variable para saber si hay algun error
  if($conexion->query($query))
//  echo 'Datos de la cita actualizados correctamente';
	header('Location: detalles.php?id='.$_POST['id']);
  else
  $aux = true; // cambiamos la variable para el error
  ?>
  

<!DOCTYPE html>
<html lang="en">
	<head>
	<title>Veterinaria Santa Fe</title>
	<meta charset="utf-8">
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
      <div class="ic">More Website Templates @ TemplateMonster.com. July 23, 2012!</div>
      <div class="container_24">
    <div class="a1">
          <h2>Agenda: </h2>
        </div>
    <div class="wrapper">
      <p>
        <?php
		if($aux)
			echo 'Existió un problema al guardar la cita.<br><a href="detalles.php?id='.$_POST['id'].'"><strong>Intentar de Nuevo</strong></a>';
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
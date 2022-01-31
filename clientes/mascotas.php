<?php

session_start();

if(!isset($_SESSION['usuario']))
header('Location: ../inicio/login.php');

?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<title>Lista de Mascotas</title>
	<meta charset="utf-8">
	<meta name="description" content="Your description">
	<meta name="keywords" content="Your keywords">
	<meta name="author" content="Your name">
	<link rel="stylesheet" href="../css/style.css">
	<script src="../js/jquery-1.7.1.min.js"></script>
	<script src="../js/superfish.js"></script>
	<script language="javascript" src="../calendar/calendar.js"></script>
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
    
    <script>
	function cargarMascota(id){
		
		  xmlhttp = new XMLHttpRequest();
		  zona = document.getElementById('mascotas');
		  zona.innerHTML = 'Cargando datos...';
		  xmlhttp.onreadystatechange=function(){
			
			if(xmlhttp.readyState==4 && xmlhttp.status == 200){
				//alert('La cita de ' + mascota + ' fue actualizada correctamente.');	
				zona.innerHTML=xmlhttp.responseText;
			}
		  }
		  xmlhttp.open('GET','seleccionar_mascota.php?id=' +id,true);
		  xmlhttp.send();
		  
	}
	
	function agregarCita(id_mascota,fecha1, fecha2,id_vacuna_despa,id_servicio){
			xmlhttp2 = new XMLHttpRequest();
		  
		  xmlhttp2.onreadystatechange=function(){
			
			if(xmlhttp2.readyState==4 && xmlhttp2.status == 200){
				alert(xmlhttp2.responseText);
				//alert('Nueva Cita agregada correctamente');
				cargarMascota(document.getElementById('mascota').value);
			}
		  }
		  xmlhttp2.open('GET','../agenda/agregar_cita.php?fecha1='+fecha1+'&fecha2='+fecha2+'&id_vacuna_despa='+id_vacuna_despa+'&id_mascota='+id_mascota+'&id_servicio='+id_servicio,true);
		  xmlhttp2.send();
		  
		
	}
	
	
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
	  require_once('../funciones/conexion.php');
	$conexion = conectar();
	
	$cliente = $conexion->query('select nombre from cliente where id_cliente = ' . $_GET['id'])->fetch_assoc();
	  ?>
    </header>
<!-- Content -->
<section id="content">
      
      <div class="container_24">
    <div class="a1">
          <h3>Lista de Mascotas de: <?php echo $cliente['nombre'];?></h3>
        </div>
    <div class="wrapper">
    <strong>Seleccionar Mascota:</strong><br>
    <select name="mascota" id="mascota" onChange="cargarMascota(this.value)">


    <?php
	
	
	$resul = $conexion->query('select * from mascota where id_cliente= ' . $_GET['id']);
	
	while($mascota = $resul->fetch_assoc()){
		echo '
		<option value="'.$mascota['id_mascota'].'">'.$mascota['nombre'].'</option>
		';
	}
	?>
    </select>
    
    <div id="mascotas">
    
    </div>
    <script>
	cargarMascota(mascota.value);
	</script>
    </div>
        </div>
    </section>
<!-- Footer -->
<footer>

     <?php footer(); ?>
    </footer>
</body>
</html>
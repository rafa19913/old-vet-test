<?php

 //agrego las clases para el calendario

session_start();

if(!isset($_SESSION['usuario']))
header('Location: ../inicio/login.php');

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
	<script type="text/javascript">
	function seleccionar_servicio(id){
		var agregar = document.getElementById('vacuna_depsarasitante');
		if(id==1 || id ==2){
			agregar.innerHTML = "Cargando...</br>";
			xmlhttp = new XMLHttpRequest();
		  
		  xmlhttp.onreadystatechange=function(){
			
			if(xmlhttp.readyState==4 && xmlhttp.status == 200){
				agregar.innerHTML = xmlhttp.responseText;
			}
		  }
		  xmlhttp.open('GET','funciones_agenda.php?id='+id,true);
		  xmlhttp.send();
		  
		}else
		{
			agregar.innerHTML="";
		}
	}
	</script>
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
          <h2>Agregar Cita: </h2>
        </div>
    <div class="wrapper">
          <form action="guardar.php" method="post" id="contact-form">
        <?php
require_once('../funciones/conexion.php');
$conexion = conectar();
?>
        <br>
        <input type="hidden" name="mascota" value="<?php echo $_POST['id'];?>"/>
        <strong>Seleccionar Servicio:</strong><br>
        <select name="servicio" onChange="seleccionar_servicio(this.value)" >
              <?php
$query = 'select * from servicio order by nombre';

$result = $conexion->query($query);

while($servicio = $result->fetch_assoc()){
	echo '<option value="'.$servicio['id_servicio'].'">'.$servicio['nombre'].'</option>';
}
?>
            </select>
        <br>
        <br>
        <div id="vacuna_depsarasitante"> </div>
        <strong>Fecha:</strong><br>
		<?php $fecha = strftime( "%Y-%m-%d", time()); ?>

		<input type="date" name="fecha" min="" value="<?php echo $fecha;?>"><br>
        <br>
        <br>
        <strong>Comentarios:</strong><br>
        <textarea name="comentarios" class="comentarios"></textarea>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <input type="submit" class="submit" value="Agregar"/>
      </form>
          <br>
          <br>
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
<?php

session_start();

if(!isset($_SESSION['usuario']))
header('Location: ../inicio/login.php');

?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<title>Detalles de la cita</title>
	<meta charset="utf-8">
	<meta name="description" content="Your description">
	<meta name="keywords" content="Your keywords">
	<meta name="author" content="Your name">
	<link rel="stylesheet" href="../css/style.css">
	<script language="javascript" src="../calendar/calendar.js"></script>
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
	function hola(){
	alert('hola');	
	}
	function cambiarEstado(estado){
		
		document.getElementById('sel_fecha').innerHTML='Cargando...';
		if(estado==1){
			 
		  xmlhttp = new XMLHttpRequest();
		  
		  xmlhttp.onreadystatechange=function(){
			
			if(xmlhttp.readyState==4 && xmlhttp.status == 200){
				document.getElementById('sel_fecha').innerHTML = (xmlhttp.responseText);
			}
		  }
		  xmlhttp.open('GET','funciones_agenda.php?id=3',true);
		  xmlhttp.send();
		  
	
		}else
		document.getElementById('sel_fecha').innerHTML='';
		
	}
	
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
	
	function agregarCita(id_mascota,fecha1, fecha2,id_vacuna_despa,id_servicio){
			xmlhttp = new XMLHttpRequest();
		  
		  xmlhttp.onreadystatechange=function(){
			
			if(xmlhttp.readyState==4 && xmlhttp.status == 200){
				alert(xmlhttp.responseText);
				//alert('Nueva Cita agregada correctamente');
				location.reload(true);
			}
		  }
		  xmlhttp.open('GET','agregar_cita.php?fecha1='+fecha1+'&fecha2='+fecha2+'&id_vacuna_despa='+id_vacuna_despa+'&id_mascota='+id_mascota+'&id_servicio='+id_servicio,true);
		  xmlhttp.send();
		  
		
	}
	
	function enviarCorreo(id_a){
		xmlE = new XMLHttpRequest();
		xmlE.onreadystatechange=function(){
			if(xmlE.status==200 && xmlE.readyState==4)	{
				alert("El correo se ha enviado correctamente.");
			}
		}
		xmlE.open('GET','funciones_agenda.php?id=4&id_a='+id_a,true);
		xmlE.send();
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
	  ?>
    </header>
<!-- Content -->
<section id="content">
      <div class="container_24">
    <div class="a1">
          <h2>Detalles de la Cita: </h2>
        </div>
    <div class="wrapper">
          <div>
        <?php
		  
		function dateDiff($end, $out_in_array=false){
			if($end == "0000-00-00")
			return "";
        $intervalo = date_diff(date_create(), date_create($end));
        $out = $intervalo->format("%yaño %mm");
        if(!$out_in_array)
            return $out;
        array_walk(explode(',',$out),x($val,$key));
        return $a_out;

      }
	  
	  function x($val,$key){
		  
        $a_out = array();
            $v=explode(':',$val);
            $a_out[$v[0]] = $v[1];
        }
		  
	require_once('../funciones/conexion.php');
	$conexion = conectar();
	$query = 'select mascota.nombre as mascota,mascota.sexo, mascota.id_mascota,raza.nombre as raza,cliente.nombre as cliente, cliente.telefono, cliente.id_cliente as id_c, cliente.direccion, agenda.fecha, agenda.id_servicio, agenda.id_estado, agenda.comentarios, mascota.peso, mascota.fecha_nacimiento, mascota.color 
	 from agenda,mascota,cliente, raza
	 where mascota.id_raza = raza.id_raza and 
	 agenda.id_mascota = mascota.id_mascota and
	 mascota.id_cliente = cliente.id_cliente and
	 agenda.id_agenda = '.$_GET['id'];
//echo $query;
	$agenda = $conexion->query($query)->fetch_assoc();
	?>
        <div class="columnaIzquierda">
        <form action="../clientes/mascotas.php" method="get" target="_blank">
        <input type="hidden" name="id" value="<?php echo $agenda['id_c'] ?>"/>
        <input type="submit" value="Ver Mascotas del Cliente"/>
        </form><br>

        
              <h5>Información de la Mascota</h5>
              <strong>Número de Control:</strong> <br>
              <?php echo $agenda['id_mascota']; ?> <br>
              <br>
              <strong>Nombre:</strong> <br>
              <?php echo $agenda['mascota']; ?> <br>
              <br>
              <strong>Especie:</strong> <br>
              <?php echo $agenda['raza']. ' (' .$agenda['sexo'] . ')'; ?> <br>
              <br>
              <strong>Edad:</strong> <br>
              <?php echo dateDiff( $agenda['fecha_nacimiento']); ?> <br>
              <br>
              <strong>Peso:</strong> <br>
              <?php echo $agenda['peso']; ?>Kg <br>
              <br>
              <strong>Color:</strong> <br>
              <?php echo $agenda['color']; ?> <br>
              <br>
              <strong>Dueño:</strong> <br>
              <?php echo $agenda['cliente']; ?> <br>
              <br>
              <strong>Telefono: </strong><br>
              <?php echo $agenda['telefono']; ?> <br>
              <br>
              <strong>Direccion:</strong><br>
              <?php echo $agenda['direccion']; ?> <br>
              <br>
              <form action="../clientes/modificar.php" method="post" target="_blank">
            <input type="hidden" name="id" value="<?php echo $agenda['id_c']; ?> "/>
            <input type="submit" value="Modificar Datos del Cliente"/>
          </form>
          <form  action="../funciones/tcpdf/examples/cartilla.php" method="get" target="_blank">
          	<input type="hidden" name="mascota" value="<?php echo $agenda['id_mascota'];?>"/>
            <input type="submit" value="Imprimir Cartilla"/>
          </form>
              <br>
            </div>
        <div class="columnaDerecha">
              <form id="contact-form" action="guardar_cita.php" method="post">
            <input type="hidden" name="id" value="<?php echo $_GET['id']?>"/>
            <h5>Información del Servicio</h5>
            <strong>Fecha de la cita: </strong><br>
            <input type="date" name="fechaCita" value="<?php echo $agenda['fecha'];?>">
            <br>
            <br>
            <strong>Servicio: </strong><br>
            <select name="servicio" onChange="seleccionar_servicio(this.value)" >
                  <?php
$query = 'select * from servicio order by nombre';

$result = $conexion->query($query);

while($servicio = $result->fetch_assoc()){
	echo '<option value="'.$servicio['id_servicio'].'" ';
	if($agenda['id_servicio']==$servicio['id_servicio'])
	echo 'selected';
	echo '>'.$servicio['nombre'].'</option>';
}
?>
                </select>
            <div id="vacuna_depsarasitante"> </div>
            <?php
$query2 = 'select * from servicio where id_servicio = '.$agenda['id_servicio'];
$result = $conexion->query($query2);

$servicio = $result->fetch_assoc();
	//echo $servicio['nombre'];
	
	
	$query3 = 'select vacuna.nombre from vacuna, historial_vacunas,agenda where
	agenda.id_servicio = 1 and
	agenda.id_agenda = historial_vacunas.id_agenda and
	historial_vacunas.id_vacuna = vacuna.id_vacuna and
	agenda.id_agenda = '. $_GET['id'];
	
	$resul3 = $conexion->query($query3);
	while($vacuna = $resul3->fetch_assoc()){
		echo '<br>

		<strong>Vacuna: <a onClick="seleccionar_servicio(1)">(Cambiar vacuna)</a></strong><br>
		'. $vacuna['nombre'];
	}
	
	
	$query3 = 'select desparasitante.nombre from desparasitante, historial_desparasitaciones,agenda where
	agenda.id_servicio = 2 and
	agenda.id_agenda = historial_desparasitaciones.id_agenda and
	historial_desparasitaciones.id_desparasitante = desparasitante.id_desparasitante and
	agenda.id_agenda = '. $_GET['id'];
	
	$resul3 = $conexion->query($query3);
	while($vacuna = $resul3->fetch_assoc()){
		echo '
		<br><br>
		<strong>Desparasitante: <a onClick="seleccionar_servicio(2)">(Cambiar desparasitante)</a></strong><br>
		'. $vacuna['nombre'];
	}
	echo '<br>';
	

?>
            </select>
            <br>
            <div id="vacuna_depsarasitante"> </div>
            <strong>Estado: </strong><br>
            <select name="estado" onChange="cambiarEstado(this.value)">
                  <?php
		  
			 $estados = $conexion->query('select * from estado_agenda');
			  while($estado = $estados->fetch_assoc()){
			  echo'<option value="'.$estado['id_estado'].'" ';
			  if($estado['id_estado']== $agenda['id_estado'] )
			  echo 'selected'; 
			  echo '>'.$estado['nombre'].'</option>';
			  }
		  
		  ?>
                </select>
            <div id="sel_fecha"> </div>
            <?php 
			if($agenda['id_estado']==1)
			echo '<script>
				cambiarEstado(1);
			</script>';
            	
			$queryCorreo = 'select c.email from cliente c, mascota m, agenda a where 
			a.id_mascota = m.id_mascota and
			m.id_cliente = c.id_cliente and
			a.id_agenda = ' . $_GET['id'];
			//echo $queryCorreo;
			$resultCorreo = $conexion->query($queryCorreo)->fetch_assoc();
			if($resultCorreo['email']!= ""){
			?>
            <br>
            <button type="button" onClick="enviarCorreo('<?php echo $_GET['id'];?>');">Enviar Correo de Notificación de la cita</button>
            <br>
            <?php 
			}
			?>
            <br>
            <strong>Comentarios: </strong><br>
            <textarea class="comentarios" name="comentarios" ><?php echo $agenda['comentarios']; ?></textarea>
            <br>
            <br>
            <br>
            <input type="submit"  class="submit" value="Guardar"/>
          </form>
            </div>
      </div>
          <div style="float:left; width:100%; margin-top:50px;">
        <div class="columnaIzquierda">
              <h5>Historial de Vacunas</h5>
              <table>
            <tr>
                  <th> Fecha Cita </th>
                  <th> Fecha Aplicación </th>
                  <th> Vacuna </th>
                  <th>Detalles</th>
                </tr>
            <?php

	
	$query = 'select agenda.fecha,agenda.id_agenda , agenda.fecha_realizado , vacuna.nombre from
	agenda, vacuna, historial_vacunas where 
	agenda.id_agenda = historial_vacunas.id_agenda and
	historial_vacunas.id_vacuna = vacuna.id_vacuna and
	agenda.id_servicio = 1 and
	agenda.id_mascota = "' . $agenda['id_mascota'] .'" order by agenda.fecha';
	
	$resul = $conexion->query($query);
	//echo $query;
	while($vacuna = $resul->fetch_assoc()){
		echo '
		<tr>
		<td>'.$vacuna['fecha'].'</td>
		<td>';
		if($vacuna['fecha_realizado'] == "0000-00-00")
		echo 'No aplicada';
		else
		echo $vacuna['fecha_realizado'];
		echo '</td>
		<td>'.$vacuna['nombre'].'</td>
		<td><a href="detalles.php?id='.$vacuna['id_agenda'].'">Ver Más</a></td>
		</tr>
		';
	}
?>
            
          </table>
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>
            </div>
        <div class="columnaDerecha">
              <h5>Historial de Desparasitaciones</h5>
              <table>
            <tr>
                  <th> Fecha Cita </th>
                  <th> Fecha Aplicación </th>
                  <th> Desparasitante </th>
                  <th>Detalles</th>
                </tr>
            <?php

	
	$query = 'select agenda.fecha ,agenda.id_agenda, agenda.fecha_realizado , desparasitante.nombre from
	agenda, desparasitante, historial_desparasitaciones where 
	agenda.id_agenda = historial_desparasitaciones.id_agenda and
	historial_desparasitaciones.id_desparasitante = desparasitante.id_desparasitante and
	agenda.id_servicio = 2 and
	agenda.id_mascota = "' . $agenda['id_mascota'] .'" order by agenda.fecha';
	
	$resul = $conexion->query($query);
	//echo $query;
	while($vacuna = $resul->fetch_assoc()){
		echo '
		<tr>
		<td>'.$vacuna['fecha'].'</td>
		<td>';
		if($vacuna['fecha_realizado'] == "0000-00-00")
		echo 'No aplicada';
		else
		echo $vacuna['fecha_realizado'];
		echo '</td>
		<td>'.$vacuna['nombre'].'</td>
		<td><a href="detalles.php?id='.$vacuna['id_agenda'].'">Ver Más</a></td>
		</tr>
		';
	}

?>
           
          </table><br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

            </div>
      </div>
        </div>
  </div>
    </section>
<!-- Footer -->
<footer>
      <?php footer(); ?>
    </footer>
</body>
</html>
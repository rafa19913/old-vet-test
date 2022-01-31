<?php

session_start();

if(!isset($_SESSION['usuario']))
header('Location: ../inicio/login.php');

?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<title>Lista de Citas</title>
	<meta charset="utf-8">
	<meta name="description" content="Your description">
	<meta name="keywords" content="Your keywords">
	<meta name="author" content="Your name">
	<link rel="stylesheet" href="../css/style.css">
	<script src="../js/jquery-1.7.1.min.js"></script>
	<script src="../js/superfish.js"></script>
	<script language="javascript" src="../calendar/calendar.js"></script>
    <script>
	function cambiarEstado(mascota,id_agenda,id_estado){
	  
		  xmlhttp = new XMLHttpRequest();
		  
		  xmlhttp.onreadystatechange=function(){
			
			if(xmlhttp.readyState==4 && xmlhttp.status == 200){
				//alert('La cita de ' + mascota + ' fue actualizada correctamente.');	
				alert(xmlhttp.responseText);
			}
		  }
		  xmlhttp.open('GET','cambiar_estado.php?id_agenda=' +id_agenda+ '&id_estado='+id_estado,true);
		  xmlhttp.send();
		  
		  
	}
	</script>
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
          <h2>Mascotas que se encuentran en la Veterinaria actualmente: </h2>
        </div>
    <div class="wrapper">
    
    <table>
    <tr>
    <td align="left" width="277">
    <form id="search-form" method="post">
                  <input type="text" onblur="if(this.value==''){this.value='buscar'}" onfocus="if(this.value=='buscar'){this.value=''}" value="buscar" name="buscar">
                  <a class="search-form-submit" onclick="document.getElementById('search-form').submit()"></a>
       </form>         
    </td>
   
    </tr>
    </table>
    
   
   
      
          <table>
        <tr>
              <th>Mascota</th>
              <th>Dueño</th>
              <th>Telefono</th>
              <th>Fecha</th>
              <th>Servicio</th>
              <th>Estado</th>
              <th>Detalles</th>
            </tr>
        <?php
          require_once('../funciones/conexion.php');
		  conectar();
		  $query = 'select servicio.nombre as servicio, mascota.nombre as mascota, cliente.nombre as cliente_nombre,cliente.telefono, cliente.celular,  agenda.* from servicio,agenda,mascota,cliente where (mascota.id_cliente = cliente.id_cliente and agenda.id_mascota = mascota.id_mascota and servicio.id_servicio = agenda.id_servicio and
		  agenda.id_estado = 4 )';
		  
		  if(isset($_POST['buscar'])){
			  $aux = $_POST['buscar'];
			$query = $query . ' and (cliente.id_cliente like "' . $aux . '" or mascota.nombre like "%' . $aux . '%" or cliente.nombre like "%'.$aux.'%"' . ' or cliente.email like "%'.$aux.'%"' . ' or cliente.telefono like "%'.$aux.'%"' . ' or cliente.celular like "%'.$aux.'%")' ;
			
		  }
		  $query = $query . ' order by agenda.fecha';
		   //echo $query;
		  $resul = $conexion->query($query);
		  while($cita = $resul->fetch_assoc()){
			  echo '<tr>
			  <td>'.$cita['mascota'].'</td>
			  <td>'.$cita['cliente_nombre'].'</td>
			  <td>Tel.'.$cita['telefono'].', Cel. '.$cita['celular'].'</td>
			  <td>'.$cita['fecha'].'</td>
			  <td>'.$cita['servicio'].'</td>
			  <td>
			  <select name="estado" onChange="cambiarEstado('."'".$cita['mascota']."'".','.$cita['id_agenda'].',this.value);">';
			  
			 $estados = $conexion->query('select * from estado_agenda');
			  while($estado = $estados->fetch_assoc()){
			  echo'<option value="'.$estado['id_estado'].'" ';
			  if($estado['id_estado']== $cita['id_estado'] )
			  echo 'selected'; 
			  echo '>'.$estado['nombre'].'</option>';
			  }
			  echo'
			  </select>
			  </td>
			  <td>
			  <form action="detalles.php" method="get">
			  <input type="hidden" name="id" value="'.$cita['id_agenda'].'"/>
			  <input type="submit" value="Ver Más"/>
			  </form>
			  </td>
			  </tr>';
		  }
		  ?>
      </table>
          <br>
          <br>
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
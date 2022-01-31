<?php

session_start();

if(!isset($_SESSION['usuario']))
header('Location: ../inicio/login.php');

?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<title>Agregar Cliente</title>
	<meta charset="utf-8">
	<meta name="description" content="Your description">
	<meta name="keywords" content="Your keywords">
	<meta name="author" content="Your name">
	<link rel="stylesheet" href="../css/style.css">
	<script src="../funciones/validaciones.js"></script>
	<script src="../js/jquery-1.7.1.min.js"></script>
	<script language="javascript" src="../calendar/calendar.js"></script>
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
		
	function cargarRaza(id){
			
			xml = new XMLHttpRequest();
			zona = document.getElementById('id_raza');
			xml.onreadystatechange = function(){
				if(xml.readyState==4 && xml.status == 200){			 					zona.innerHTML = xml.responseText;
				}
			}
			xml.open('GET','../mascotas/funciones_mascotas.php?opcion='+1+'&id_especie='+id,true);
			xml.send();
		}
		
		function agregarRaza(id){
			zona = document.getElementById('id_agregar');
			document.getElementById('nueva_raza').value = id;		
			if(id)
	
				zona.innerHTML = 'Ingresa la Nueva Raza:<br><input type="text" name="raza2" id="raza2"/></br></br><a onClick="agregarRaza(false)">Cancelar</a><br><br>';
			else
				zona.innerHTML = '';
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
      <div class="ic">More Website Templates @ TemplateMonster.com. July 23, 2012!</div>
      <div class="container_24">
    <div class="a1">
          <h2>Nuevo Cliente: </h2>
        </div>
    <div class="wrapper">
          <h4>Datos del cliente</h4>
          <form id="contact-form" action="nuevo.php" method="post" onSubmit="return validarClienteMascota()">
        <div class="columnaIzquierda"> Nombres: (requerido)<br>
              <input type="text" id="nombre" name="nombres" width="150"/>
              <br>
              <br>
              Apellidos: (requerido)<br>
              <input type="text" id="apellido" name="apellidos" width="150"/>
              <br>
              <br>
              RFC:<br>
              <input type="text" name="rfc" id="rfc" width="150"/>
              <br>
              <br>
              Correo Electrónico: (requerido)<br>
              <input type="text" name="email" id="email" width="500"/>
              <br>
              <br>
              Teléfono: (requerido)<br>
              <input type="text" name="telefono" id="telefono" width="500"/>
              <br>
              <br>
              Celular:<br>
              <input type="text" id="celular" name="celular" width="500"/>
            </div>
        <div class="columnaDerecha"> Colonia: (requerido)<br>
              <input type="text" name="colonia" id="colonia" width="150"/>
              <br>
              <br>
              Calle: (requerido)<br>
              <input type="text" name="calle" id="calle" width="150"/>
              <br>
              <br>
              Número: (requerido)<br>
              <input type="text" name="numero" id="numero" width="150"/>
              <br>
              <br>
              Código Postal:<br>
              <input type="text" name="codigo_postal" id="codigo_postal" width="500"/>
              <br>
              <br>
              Ciudad:<br>
              <input type="text" id="ciudad" name="ciudad" width="500"/>
              <br>
              <br>
              <br>
              <br>
              </p>
            </div>
        <div> 
        <h4>Datos de la mascota</h4>
        Sufijo del ID:<br>
              <select name="tipo_id">
            <option value="CL">CL</option>
            <option value="SC">SC</option>
          </select>
              <br>
              <br>
              Nombre:<br>
              <input type="text" id="nombreMascota" name="nombre" width="150"/>
              <br>
              <br>
              Sexo:<br>
              <select name="sexo">
            <option value="Macho">Macho</option>
            <option value="Hembra">Hembra</option>
          </select>
              <br>
              <br>
              Especie:<br>
              <select name="especie" id="especie" onChange="cargarRaza(this.value)">
            <?php 
			  require_once('../funciones/conexion.php');
			  $conexion = conectar();
			  $query = $conexion->query('select * from especie');
			  while($especie = $query->fetch_assoc()){
				  echo '
				  <option value="'.$especie['id_especie'].'">'.$especie['nombre'].'</option>
				  ';
			  }
			  ?>
          </select>
              <br>
              <br>
              Raza:<br>
              <select name="raza" id="id_raza" >
          </select>
              <input type="hidden" id="nueva_raza" value="false"/>
              <a onClick="agregarRaza(true)">Agregar Raza</a> 
              <script>
			cargarRaza(especie.value);
			</script> 
              <br>
              <div id="id_agregar"> </div><br>


              Fecha Nacimiento:<br>

              <?php
                $fecha= strftime( "%Y-%m-%d", time());
              ?>
              
            <input type="date" name="fecha" min="" value="<?php echo $fecha; ?>"><br>
          
<br><br>

              Color:<br>
              <input type="text" name="color"/>
              <br><br>
<br>
              Peso (Kg):<br>
              <input type="text" id="peso" name="peso" width="150"/>
              <br>
          <br>


          <input type="submit" value="Agregar"  class="submit"/>
              <br>
              <br>
              </p>
            </div>
      </form>
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
<?php

session_start();

if(!isset($_SESSION['usuario']))
header('Location: ../inicio/login.php');

?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<title>Modificar Mascota</title>
	<meta charset="utf-8">
	<meta name="description" content="Your description">
	<meta name="keywords" content="Your keywords">
	<meta name="author" content="Your name">
	<link rel="stylesheet" href="../css/style.css">
	<script src="../funciones/validaciones.js"></script>
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
		
		function cargarRaza(id){
			
			xml = new XMLHttpRequest();
			zona = document.getElementById('id_raza');
			xml.onreadystatechange = function(){
				if(xml.readyState==4 && xml.status == 200){			 					zona.innerHTML = xml.responseText;
				}
			}
			xml.open('GET','funciones_mascotas.php?opcion='+1+'&id_especie='+id,true);
			xml.send();
		}
		
		function cargarRaza2(id,id2){
			
			xml = new XMLHttpRequest();
			zona = document.getElementById('id_raza');
			xml.onreadystatechange = function(){
				if(xml.readyState==4 && xml.status == 200){			 					zona.innerHTML = xml.responseText;
				}
			}
			xml.open('GET','funciones_mascotas.php?opcion='+2+'&id_especie='+id+'&id_raza='+id2,true);
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
		
	function eliminar(id){
		if(confirm('¿Desea eliminar a la mascota?')){
			xmld = new XMLHttpRequest();
			
			xmld.onreadystatechange= function(){
				if(xmld.status==200 && xmld.readyState==4){
					alert(xmld.responseText);
					window.location.assign("editar.php")
				}
			}
			
			xmld.open('GET','delete.php?id='+id,true);
			xmld.send();
		}
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
          <h2>Editar Mascotas: </h2>
        </div>
    <div class="wrapper">
          <form id="contact-form" action="guardar.php" method="post" onSubmit="return validarMascota()">
        <?php

			  require_once('../funciones/conexion.php');
			  $conexion = conectar();
			  
			  $mascota = $conexion->query('select mascota.*, raza.id_especie from mascota,raza where raza.id_raza = mascota.id_raza and id_mascota = "'.$_POST['id'].'"')->fetch_assoc();		
		?>
        <br>
        Nombre:<br>
        <input type="text" id="nombreMascota" name="nombre" value="<?php echo $mascota['nombre'];?>"/>
        <br>
        <br>
        Sexo:<br>
        <select name="sexo">
              <?php if ($mascota['sexo']=="Macho"){?>
              <option value="Hembra">Hembra</option>
              <option value="Macho" selected>Macho</option>
              <?php } else {?>
              <option value="Hembra" selected>Hembra</option>
              <option value="Macho" >Macho</option>
              <?php }?>
            </select>
        <br>
        <br>
        Especie:<br>
        <select name="especie" id="especie" onChange="cargarRaza(this.value)">
              <?php 
			  $query = $conexion->query('select * from especie');
			  while($especie = $query->fetch_assoc()){
				  echo '
				  <option value="'.$especie['id_especie'].'"';
				  if($especie['id_especie']==$mascota['id_especie'])
				  echo 'selected';
				  
				  echo '>'.$especie['nombre'].'</option>
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
				cargarRaza2(especie.value, <?php echo $mascota['id_raza'];?>);
			</script> 
        <br>
        <div id="id_agregar"> </div>
        <br>
        <br>
        Color:<br>
        <input type="text" name="color" value="<?php echo $mascota['color'];?>"/>
        <br>
        <br>
        Peso (Kg):<br>
        <input type="text" id="peso" name="peso"  value="<?php echo $mascota['peso'];?>"/>
        <br>
        <br>
        Fecha Nacimiento:<br>

		<input type="date" name="fecha" value="<? echo $mascota['fecha_nacimiento']; ?>" />
        <input type="hidden" name="id" value="<?php echo $_POST['id'];?>"/>
        <br>
        <br>
        <input type="submit" value="Guardar"  class="submit"/>
        <br>
        <br><br>

						<a href="#" onClick="eliminar('<?php echo $_POST['id']; ?>')"><h5>Eliminar</h5></a>
        </p>
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
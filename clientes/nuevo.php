<?php
error_reporting(0);
session_start();

if(!isset($_SESSION['usuario']))
header('Location: ../inicio/login.php');

?>
<!DOCTYPE html>
<html lang="en">
	<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
	<title>Agregar Cliente</title>
	
	<meta name="description" content="Your description">
	<meta name="keywords" content="Your keywords">
	<meta name="author" content="Your name">
	<link rel="stylesheet" href="../css/style.css">
	<script src="../js/jquery-1.7.1.min.js"></script>
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
          <h2>Clientes: </h2>
        </div>
    <div class="wrapper"> <br>
          <?php
	   require_once("../funciones/conexion.php");
	   
	   $conexion = conectar();
	   
	   $id = $conexion->query('select max(id_cliente) as id from cliente')->fetch_assoc();
	   $id = $id['id'] + 1;
	   $query = 'insert into cliente (id_cliente,nombre, rfc, direccion, email, telefono, celular, ciudad) values ('.$id.',"'.$_POST['nombres'].' '.$_POST['apellidos'].'","'.$_POST['rfc'].'","Calle.'.$_POST['calle'].' #'.$_POST['numero'].' Col.'.$_POST['colonia'].' CP:'.$_POST['codigo_postal'].'","'.$_POST['email'].'","'.$_POST['telefono'].'","'.$_POST['celular'].'","'.$_POST['ciudad'].'")';
	   
     //echo $query;
     if($conexion->query($query)){
		
			$max = $conexion->query('select max(ultimo_id) as id from mascota')->fetch_assoc();
			$idMax =  $max['id'] + 2;
			 $idMascota = $idMax . $_POST['tipo_id']; 
		   
		   if(isset($_POST['raza2']))
		   {
			   $query5 = 'insert into raza (nombre, id_especie) values ("'.$_POST['raza2'].'",'.$_POST['especie'].')';
			$conexion->query($query5);   
			//echo $query5;
			$max = $conexion->query('select max(id_raza) as mas from raza where id_especie = ' . $_POST['especie'])->fetch_assoc();
			$raza = $max['mas'];
		   }else
		   $raza = $_POST['raza'];
		   
		   
		   $query = 'insert into mascota values ("'.$idMascota.'",'.$idMax.',"","'.$_POST['nombre'].'","'.$_POST['sexo'].'",'.$raza.',"'.$_POST['fecha'].'",'.$_POST['peso'].',"'.$_POST['color'].'",'.$id.')';
		   
			
			// echo $query;
		 if($conexion->query($query)){
		 echo 'Mascota agregada correctamente.';
		 echo '<form action="../mascotas/agregar.php" method="post">
		   <input type="hidden" name="id" value="'.$id.'"/>
		   <input type="submit" value="Agregar otra mascota al cliente"/>
		   </form><br>

		   <form action="mascotas.php" target="_blank" method="get">
		   <input type="hidden" name="id" value="'.$id.'"/>
		   <input type="submit" value="Agregar Historial a la mascota"/>
		   </form>
		   ';
		 }
		 else{
		 echo 'La mascota no pudo ser agregada, intenta nuevamente.';
		 echo '<form action="../mascotas/agregar.php" method="post">
		   <input type="hidden" name="id" value="'.$id.'"/>
		   <input type="submit" value="Intentar de nuevo"/>
		   </form>';
		 }
			
			
	 }
	 else{
	 echo 'Existió un problema para agregar el cliente, por favor intenta nuevamente.';
	 echo '<form action="agregar.php" >
       <input type="submit" value="Intentar de nuevo"/>
       </form>';
	 }
	   ?>
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
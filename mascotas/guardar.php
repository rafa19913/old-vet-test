<?php
error_reporting(0);
session_start();

if(!isset($_SESSION['usuario']))
header('Location: ../inicio/login.php');

?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<title>Actualizar Mascota</title>
	<meta charset="utf-8">
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
          <h2>Mascotas:        </h2>
    </div>
    <div class="wrapper">
      
       
       <?php
	   require_once("../funciones/conexion.php");
	   
	   $conexion = conectar();
	   
	    if(isset($_POST['raza2']))
	   {
		   $query5 = 'insert into raza (nombre, id_especie) values ("'.$_POST['raza2'].'",'.$_POST['especie'].')';
		$conexion->query($query5);   
		//echo $query5;
		$max = $conexion->query('select max(id_raza) as mas from raza where id_especie = ' . $_POST['especie'])->fetch_assoc();
		$raza = $max['mas'];
	   }else
	   $raza = $_POST['raza'];
	   
	   
	   
	   $query = 'update mascota set nombre="'.$_POST['nombre'].'",sexo="'.$_POST['sexo'].'",id_raza='.$raza.',fecha_nacimiento="'.$_POST['fecha'].'",peso='.$_POST['peso'].',color="'.$_POST['color'].'" where id_mascota = "' . $_POST['id'] .'"';
	   
     // echo $query;
	if($conexion->query($query))
	echo 'Datos de la mascota actualizados correctamente';
	else
	echo 'Los datos no se pudieron actualizar, intente nuevemente';
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
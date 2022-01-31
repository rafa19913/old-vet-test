<?php
session_start();

  //guardo la informacion del administrador
	  require_once('../funciones/conexion.php');
	  $aux = false;
	  //condicion para saber si esta inicializada las variables del administrador o si ya abrio sesion
	  if(isset($_POST['correo']) && isset($_POST['pass'])){
		  $correo = $_POST['correo'];
	  		$psw = $_POST['pass'];
		 $conexion = conectar();
		 $query = 'select * from usuario where email = "' .$correo.'" and password = "'.$psw . '"';
		 
		 $resul = $conexion->query($query);
		 //echo $query;
		 if($resul->num_rows == 1)
		 {

			 $usuario = $resul->fetch_assoc();
			$_SESSION['usuario'] = $usuario['nombre'];
			$_SESSION['id'] = $usuario['id_usuario'];
			$_SESSION['lugar'] = $_POST['lugar'];
				//echo header('Location: index.php');//inicio la sesion
				//cambiar();
				//redirecciono al index.
			}else
			{
				$aux = true;
				//sino significa que los datos no coincidieron
			}
	
	  }

if(isset($_SESSION['usuario']))
header('Location: index.php');

?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<title>Veterinaria Santa Fe - Iniciar Sesión</title>
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
	  if(isset($_SESSION['id']))
	  headers($_SESSION['id']);
	  else 
	  headers(0);
	  ?>
	</header>
<!-- Content -->
<section id="content">
		
		<div class="container_24">
		<div class="a1">
				<h2>Iniciar Sesión en la Matriz: </h2>
			</div>
		<div class="wrapper">
				<?php 
	 if($aux){
	 	echo "<strong>Correo o contraseña incorrecta</strong>";
	 }
	  ?>
				<form action="login.php"  id="contact-form"  method="post">
				<div class="wrapper">
						<a href="index.php"> </a>
						<p>Correo:<br>
						<input type="text" id="correo" name="correo" title="Ingresa el correo del usuario." maxlength="50" class="form-poshytip"/>
						<br>
						<br>
						Contraseña:<br>
						<input type="password" id="pass" name="pass" title="Ingresa la contraseña del usuario." maxlength="20" class="form-poshytip"/>
						<br>
						<br>
						Lugar:<br>

						<select name="lugar">
						<option value="true">Matriz</option>
						<option value="false">Sucursal</option>
						</select>
						<br>
						<input type="submit" class="submit" value="Iniciar Sesión"/>
					</p>
						
						<!-- search --><!-- ENDS search -->
					</div>
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
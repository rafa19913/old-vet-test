<?php
error_reporting(0);
session_start();

if(!isset($_SESSION['usuario']))
header('Location: ../inicio/login.php');

?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<title>Modificar Empleado</title>
	<meta charset="utf-8">
	<meta name="description" content="Your description">
	<meta name="keywords" content="Your keywords">
	<meta name="author" content="Your name">
	<link rel="stylesheet" href="../css/style.css">
	<script src="../js/jquery-1.7.1.min.js"></script>
	<script src="../js/superfish.js"></script>
    <script src="../funciones/validaciones.js"></script>
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
          <h2>Modificar Empleado: </h2>
        </div>
    <div class="wrapper">
    <?php
	require_once('../funciones/conexion.php');
	$conexion = conectar();
	
	$query = 'select * from usuario where id_usuario = ' . $_POST['id'];
	$usuario = $conexion->query($query)->fetch_assoc();
	?>
    
    <form action="guardar.php" method="post" id="contact-form" onSubmit="return validarEmpleado()">
    <input type="hidden" name="id" value="<?php echo $_POST['id'];?>"/>
    <strong>Nombre:</strong><br>

    <input name="nombre" type="text" id="nombre" value="<?php echo $usuario['nombre']; ?>"/><br>
<br>
    <strong>Correo:</strong><br>

    <input name="email" type="text" id="email" value="<?php echo $usuario['email']; ?>"/><br>
<br>
    <strong>Contraseña:</strong><br>

    <input name="psw" type="password" id="psw" value="<?php echo $usuario['password']; ?>"/><br>
<br>
<strong>Confirmar Contraseña:</strong><br>

    <input name="psw2" type="password" id="psw2" value="<?php echo $usuario['password']; ?>"/><br>
<br>
    <strong>Perfil:</strong><br>
<select name="perfil">
<?php

$resu = $conexion->query('select * from perfil');

while($perfil = $resu->fetch_assoc()){
echo '
<option value="'.$perfil['id_perfil'].'" ';

if($usuario['id_perfil']==$perfil['id_perfil'])
echo 'selected';

echo '>'.$perfil['nombre'].'</option>
';

}

?>
</select>
    
    <br>
<br>
<input type="submit" class="submit" value="Guardar"/>
    </form>
    </div>
  </div>
    </section>
<!-- Footer -->

<footer>
  <?php footer(); ?>
</footer>
</body>
</html>
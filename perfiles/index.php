<?php

session_start();

if(!isset($_SESSION['usuario']))
header('Location: ../inicio/login.php');

?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<title>Lista de Perfiles</title>
	<meta charset="utf-8">
	<meta name="description" content="Your description">
	<meta name="keywords" content="Your keywords">
	<meta name="author" content="Your name">
	<link rel="stylesheet" href="../css/style.css">
	<script src="../js/jquery-1.7.1.min.js"></script>
	<script src="../js/superfish.js"></script>
	<script type="text/javascript">
	
	</script>
	<script src="../servicios/funciones.js"></script>
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
          <h2>Lista de Perfiles:</h2>
        </div>
        
        
    <div class="wrapper">
    
<table>
<tr>
<th>ID</th>
<th>Nombre</th>
<th>Opciones disponibles.</th>
<th>Editar</th>
</tr>

<?php 
//invoco la funcion para realizar la conexion
require_once('../funciones/conexion.php');
$conexion = conectar();
$resul = $conexion->query("select * from perfil");
while($perfil = $resul->fetch_assoc()){
echo '
<tr>
<td>'.$perfil['id_perfil'].'</td>
<td>'.$perfil['nombre'].'</td>
<td>';

$resul2 = $conexion->query('select opcion_menu.* from menu,opcion_menu where opcion_menu.id_opcion = menu.id_opcion and menu.id_perfil = ' . $perfil['id_perfil']);
while($opcion = $resul2->fetch_assoc()){
	echo $opcion['nombre'] . ", ";
}
echo'
</td>
<td>';
if($perfil['id_perfil']!= 1 )
echo '<form action="modificar.php" method="post">
<input type="hidden" name="id" value="'.$perfil['id_perfil'].'"/>
<input type="submit" value="Modificar"/>
</form>';

echo '
</td>
</tr>
';
	
}

?>

</table>
       
    
    </div>
  </div>
    </section>
<!-- Footer -->
<footer>
      <?php footer(); ?>
    </footer>
</body>
</html>
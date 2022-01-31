<?php

session_start();

if(!isset($_SESSION['usuario']))
header('Location: ../inicio/login.php');

?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<title>Guardar Producto</title>
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
          <h2>Agregar Nuevo Producto: </h2>
        </div>
    <div class="wrapper">
          <form id="contact-form" action="nuevo.php" method="post"  onSubmit="return validarProducto()">
        <div class="columnaIzquierda">
              Nombre:<br>
              <input id="nombre" name="nombre" type="text" width="150"/>
              <br>
              <br>
              Descripción:<br>
              <textarea name="descripcion" class="comentarios"></textarea>
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>
              Proveedor:<br>
              <input name="proveedor" type="text" width="150"/>
              <br>
              <br>
              Presentación:<br>
              <input id="unidad" name="unidad" type="text" width="500"/>
              <br>
              <br>
              Imagen:<br>
              <input name="imagen" type="text" width="500"/>
            </div>
        <div class="columnaDerecha">Precio Venta:<br>
              <input id="precio" name="precio_venta" type="text" width="150"/>
              <br>
              <br>
              Cantidad:<br>
              <input id="cantidad" name="cantidad" type="text" width="150"/>
              <br>
              <br>
               Codigo de Barras:<br>
              <input id="codigo" name="codigo" type="text" width="150"/>
              <br>
              <br>
              <input type="submit" value="Agregar" width="200px"  class="submit"/>
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
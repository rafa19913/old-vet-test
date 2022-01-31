<?php

session_start();
	  //destruyo la sesion 
unset($_SESSION['usuario']);
//destruyo la sesion
session_destroy();
		
//condicion para saber si esta iniciada la secion
if(!isset($_SESSION['usuario']))
//direcciona al login si no estas logueado
header('Location: index.php');
?>
<!DOCTYPE html>
<html lang="en">
	<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
	<title>Veterinaria Santa Fe - Iniciar Sesión</title>
	
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
      <div class="container_24">
    <div class="a1">
          <h2>Iniciar Sesión: </h2>
        </div>
    <div class="wrapper">
<?php 
	  
	  //redirecciono al index
				header('Location: index.php');
			echo "<strong>Ha cerrado sesión.</strong>";
				
	
	  
	  ?>

        </div>
  </div>
    </section>
<!-- Footer -->
<footer>
     <?php footer(); ?>
    </footer>
</body>
</html>
<?php
error_reporting(0);
session_start();

if(!isset($_SESSION['usuario']))
header('Location: ../inicio/login.php');

?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<title>Reporte de Ventas</title>
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
      <div class="container_24">
    <div class="a1">
          <h2>Lista de Reportes de Venta: </h2>
        </div>
    <div class="wrapper">
    <?php
	require_once('../funciones/conexion.php');
	$conexion = conectar();
	?>
    <table>
    <tr>
    <th>Reporte</th>
    <th>Número de Ventas</th>
    <th>Total Vendido</th>
    </tr>
    
    <tr>
    <?php 
	$query = 'select curdate() as hoy, 
	count(id_venta)as vendidos, 
	coalesce(sum(total),0)as total 
	from venta where
	WEEK(fecha)=WEEK(curdate())
	';
	
	$resultado = $conexion->query($query)->fetch_assoc();
	//echo $query;
	?>
    <td>Ventas de la semana en curso</td>
    <td><?php echo $resultado['vendidos']; ?></td>
    <td>$<?php echo $resultado['total']; ?></td>
    </tr>
        
    <tr>
    <?php 
	$query = 'select curdate() as hoy, 
	count(id_venta)as vendidos, 
	coalesce(sum(total),0)as total 
	from venta where
	WEEK(fecha)=WEEK(curdate())-1
	';
	
	$resultado = $conexion->query($query)->fetch_assoc();
	//echo $query;
	?>
    <td>Ventas de la semana pasada</td>
    <td><?php echo $resultado['vendidos']; ?></td>
    <td>$<?php echo $resultado['total']; ?></td>
    </tr>
        
    <tr>
    <?php 
	$query = 'select curdate() as hoy, 
	count(id_venta)as vendidos, 
	coalesce(sum(total),0)as total 
	from venta where
	WEEK(fecha)=WEEK(curdate())-2
	';
	
	$resultado = $conexion->query($query)->fetch_assoc();
	//echo $query;
	?>
    <td>Ventas de la semana antepasada</td>
    <td><?php echo $resultado['vendidos']; ?></td>
    <td>$<?php echo $resultado['total']; ?></td>
    </tr>
        
    <tr>
    <?php 
	$query = 'select curdate() as hoy, 
	count(id_venta)as vendidos, 
	coalesce(sum(total),0)as total 
	from venta where
	MONTH(fecha)=MONTH(curdate())
	';
	
	$resultado = $conexion->query($query)->fetch_assoc();
	//echo $query;
	?>
    <td>Ventas del mes en curso</td>
    <td><?php echo $resultado['vendidos']; ?></td>
    <td>$<?php echo $resultado['total']; ?></td>
    </tr>
        
    <tr>
    <?php 
	$query = 'select curdate() as hoy, 
	count(id_venta)as vendidos, 
	coalesce(sum(total),0)as total 
	from venta where
	MONTH(fecha)=MONTH(curdate())-1
	';
	
	$resultado = $conexion->query($query)->fetch_assoc();
	//echo $query;
	?>
    <td>Ventas del mes pasado</td>
    <td><?php echo $resultado['vendidos']; ?></td>
    <td>$<?php echo $resultado['total']; ?></td>
    </tr>
        
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
<?php
//error_reporting(0);
session_start();

if(!isset($_SESSION['usuario']))
header('Location: ../inicio/login.php');

?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<title>Lista de Creditos Activos</title>
	<meta charset="utf-8">
	<meta name="description" content="Your description">
	<meta name="keywords" content="Your keywords">
	<meta name="author" content="Your name">
	<link rel="stylesheet" href="../css/style.css">
	<script src="../js/jquery-1.7.1.min.js"></script>
	<script src="../js/superfish.js"></script>
	<script src="funciones_compra.js"></script>
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
          <h2>Lista de Creditos: </h2>
        </div>
    <div class="wrapper">
    <?php
	require_once('../funciones/conexion.php');
	$conexion = conectar();
	
	$corte = $conexion->query('select id_corte from corte where fecha_fin = "0000-00-00 00:00"')->fetch_assoc();

	
	$query = 'insert into abono (cantidad,fecha,id_usuario,id_credito,id_corte,forma_pago) values ('.$_POST['abono'] .',now(),'.$_SESSION['id'] .','.$_POST['credito'] .','.$corte['id_corte'].',"'.$_POST['forma'].'")';
	
	$rest = $conexion->query('select restante from credito where id_credito = ' .$_POST['credito'])->fetch_assoc();
	$rest = $rest['restante'] - $_POST['abono'];
	$query2 = 'update credito set restante = '.$rest.' where id_credito = '.$_POST['credito'];
	$conexion->query($query);
	if($conexion->query($query2))
{
	echo '
	<h5>Abono guardado correctamente</h5>
    <a href="lista_creditos.php">Agregar un nuevo abono</a>';
//	require_once('funciones.php');
	
		?>
    <div style="display:none;">
    <div id="ticket" style="width:250px; "> 
    -----------------------------------------
  <center>
    Veterinaria Santa Fé
  </center>
  13 César López de Lara #2646
  Col. Treviño Zapata Cd. Victoria Tamps<br>
  ----------------------------------------- 
  <?php 
	$datos = $conexion->query('
	select a.id_abono, a.fecha,a.forma_pago, u.nombre as usuario, c.nombre as cliente, a.cantidad, cr.restante, v.total
	from abono a, cliente c, usuario u, credito cr ,venta v where 
	a.id_credito = cr.id_credito and
	a.id_usuario = u.id_usuario and 
	cr.id_venta = v.id_venta and 
	v.id_cliente = c.id_cliente and
	a.id_abono = last_insert_id()' )->fetch_assoc();
	
	?>
    <br>
ABONO<br>
<br>

  Fecha: <?php echo $datos['fecha']; ?><br>
  Atendió: <?php echo $datos['usuario']; ?> <br>
  Cliente: <?php echo $datos['cliente'];?> <br><br>

  Deuda: $<?php echo $datos['total'];?> <br>
  Cantidad Abonada: $<?php echo $datos['cantidad'];?> <br>
  Forma de Pago: <?php echo $datos['forma_pago'];?> <br>
    
------------------------------------------
Restante: $ <?php echo $datos['restante'];?> <br>
----------------------------------------- <br>
    <?php

  ?>
  
 
<br>
</div></div>
	<script>
	imprimir(document.getElementById("ticket").innerHTML);</script>
    
    <?php
	
	
 }
else {
	echo '
	<h5>Existió un error al agregar el abono, intente nuevamente</h5>
    <a href="lista_creditos.php">Intentar de nuevo</a>';
	
	

 }

	
// echo $query.$query2;
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
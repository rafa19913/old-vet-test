<?php
error_reporting(0);
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
          <h2>Lista de Creditos Activos: </h2>
        </div>
    <div class="wrapper">
    <table>
            <tr>
              <td align="left"><form id="search-form" method="get">
                    <input type="text" onblur="if(this.value==''){this.value='buscar'}" onfocus="if(this.value=='buscar'){this.value=''}" value="buscar" name="buscar">
                    <a class="search-form-submit" onclick="document.getElementById('search-form').submit()"></a>
                </form></td>
            </tr>
          </table>
  <form action="nuevo_abono.php" method="post">
  <strong>Cantidad a abonar: </strong><input type="text" name="abono" style="width:200px;" value="0"/><br>
<strong>Forma de Pago:</strong>
<input type="radio" name="forma" value="Efectivo" checked/>Efectivo 
<input type="radio" name="forma" value="Tarjeta"/>Tarjeta
<br>
<input type="submit" value="Agregar"/><br>
<br>

    <table>
    <tr>
    <th>Cliente</th>
    <th>Cantidad del Crédito</th>
    <th>Deuda restante</th>
    <th>Lista de Abonos</th>
    <th>Detalles de la Compra</th>
    <th>Seleccionar</th>
    </tr>
    <?php 

		require_once('../funciones/conexion.php');
		//hago la conexion
		$conexion = conectar();


		$query = 'select c.nombre, v.total, cr.restante, cr.id_credito, cr.id_venta 
		from cliente c, venta v, credito cr where
		cr.id_venta = v.id_venta and
		c.id_cliente = v.id_cliente and 
		cr.restante > 0';
		
		if(isset($_GET['buscar'])){
			$aux = $_GET['buscar'];
			$query = $query . ' and c.nombre like "%'.$aux.'%" ';
		}
		
		//echo $query;
  	//ejecuto la consulta
		$resul = $conexion->query($query);
		
		while($credito = $resul->fetch_assoc()){
			echo '
			<tr>
			<td>'.$credito['nombre'].'</td>
			<td>$'.$credito['total'].'</td>
			<td>$'.$credito['restante'].'</td>
			<td><a href="lista_abonos.php?id='.$credito['id_credito'].'" target="_blank" >Detalles</a></td>
			<td><a href="detalles_compra.php?id='.$credito['id_venta'].'" target="_blank" >Detalles</a></td>
			<td>
			<input type="radio" name="credito" value="'.$credito['id_credito'].'"/>
			</td>
			</tr>
			';
		}

?>
    
    </table>
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
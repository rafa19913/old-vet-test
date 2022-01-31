<?php

session_start();

if(!isset($_SESSION['usuario']))
header('Location: ../inicio/login.php');

?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<title>Lista de Clientes</title>
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
          <h2>Lista de Servicios: </h2>
        </div>
    <div class="wrapper">
    <table>
            <tr>
              <td align="left"><form id="search-form" method="post">
                    <input type="text" onblur="if(this.value==''){this.value='buscar'}" onfocus="if(this.value=='buscar'){this.value=''}" value="buscar" name="buscar">
                    <a class="search-form-submit" onclick="document.getElementById('search-form').submit()"></a>
                </form></td>
            </tr>
          </table>
  

          <table>
        <tr>
              <th>Nombre</th>
              <th>Descripcion</th>
              <th>Material usado</th>
              <th>Precio</th>
            </tr>
        <?php
        require_once("../funciones/conexion.php");

        $conexion = conectar();
		$query = "select * from servicio";

		if(isset($_POST['buscar'])){
			$aux = $_POST['buscar'];
		$query = $query . ' where nombre like "' . $aux . '" or descripcion like "%'.$aux.'%"' ;
		}
		//echo $query;
        $consulta = $conexion->query($query);
		
		
        while($servicio = $consulta->fetch_assoc()){
    echo '<tr>
      <td>'.$servicio ['nombre'].'</td>
      <td>'.$servicio ['descripcion'].'</td><td>';
	  $result2 = $conexion->query('select m.cantidad, i.unidad , i.nombre  from material_servicio m, inventario i where i.id_producto = m.id_producto and m.id_servicio = ' . $servicio['id_servicio']);
	  while($material = $result2->fetch_assoc()){
		  echo $material['cantidad'] . ' X ' . $material['unidad'] . ' de ' . $material['nombre'] . '<br> ';
	   }
      echo '</td><td>$'.$servicio ['precio'].'</td>
        </tr>';
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
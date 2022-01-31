<?php 
//error_reporting(0);
?>
<?php

session_start();

if(!isset($_SESSION['usuario']))
header('Location: ../inicio/login.php');

?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<title>Lista de Mascotas</title>
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
          <h2>Lista de Mascotas: </h2>
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
              <th >ID</th>
              <th >Nombre</th>
              <th >Especie</th>
              <th >Raza</th>
              <th >Sexo</th>
              <th >Edad</th>
              <th >Peso</th>
              <th >Dueño</th>
              <th >Seleccionar</th>
            </tr>
        <?php
        require_once("../funciones/conexion.php");

       $conexion = conectar();
		
		function dateDiff($end, $out_in_array=false){
			if($end == "0000-00-00")
			return "";
        $intervalo = date_diff(date_create(), date_create($end));
        $out = $intervalo->format("%yaño %mm");
        if(!$out_in_array)
            return $out;
        array_walk(explode(',',$out),x($val,$key));
        return $a_out;

      }
	  
	  function x($val,$key){
		  
        $a_out = array();
            $v=explode(':',$val);
            $a_out[$v[0]] = $v[1];
        }
		
		$query = "select mascota.*, cliente.nombre as nombre2, especie.nombre as especie, raza.nombre as raza from mascota, cliente,especie,raza where (mascota.id_cliente = cliente.id_cliente and raza.id_especie = especie.id_especie and mascota.id_raza = raza.id_raza)";

		if(isset($_POST['buscar'])){
		$aux = $_POST['buscar'];	
		$query = $query . ' and (mascota.id_mascota like "' . $aux . '" or mascota.nombre like "%'.$aux.'%"' . ' or cliente.nombre like "%'.$aux.'%")';
		}
		
		//echo $query;
        $consulta = $conexion->query($query);
        while($cliente = $consulta->fetch_assoc()) {
    echo '<tr>
      <td>'.$cliente['id_mascota'].'</td>
      <td align="left">'.$cliente['nombre'].'</td>
      <td>'.$cliente['especie'].'</td>
      <td>'.$cliente['raza'].'</td>
      <td>'.$cliente['sexo'].'</td>
      <td>'.datediff($cliente['fecha_nacimiento']).'</td>
      <td>'.$cliente['peso'].'Kg</td>
      <td align="right">'.$cliente['nombre2'].'</td>
	  <td>
<form action="agregar.php" method="post">
	<input type="hidden" name="id" value="'.$cliente['id_mascota'].'"/>
	<input type="submit" value="Continuar"/>
	</form>	  </td>
	  
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
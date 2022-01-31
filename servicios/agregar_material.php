<?php
session_start();

if(!isset($_SESSION['usuario']))
header('Location: ../inicio/login.php');

if(!isset($_GET['id']))
header('Location: editar2.php');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<title>Agregar Materiales al Servicio</title>
	<meta charset="utf-8">
	<meta name="description" content="Your description">
	<meta name="keywords" content="Your keywords">
	<meta name="author" content="Your name">
	<link rel="stylesheet" href="../css/style.css">
	<script src="../js/jquery-1.7.1.min.js"></script>
	<script src="../js/superfish.js"></script>
	<script src="funciones.js"></script>
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
          <h2>Agregar Materiales al Servicio: </h2>
        </div>
    <div class="wrapper">
          <table>
        <tr>
              <td align="left"><form id="search-form" >
                  <input type="text" onblur="if(this.value==''){this.value='buscar'}" onfocus="if(this.value=='buscar'){this.value=''}" value="buscar" name="busca">
                  <a class="search-form-submit" onclick="document.getElementById('search-form').submit()"></a>
                  <input type="hidden" name="id" value="<?php echo $_GET['id']?>"/>
                </form></td>
            </tr>
      </table>
          <div id="agregar" class="columnaIzquierda">
        <h5>Lista de Material</h5>
        <script>
		buscar(<?php if(isset($_GET['busca'])) echo '"'.$_GET['busca'].'"'; else echo '""'; echo ','.$_GET['id'];?> );
		</script> 
      </div>
          <div id="lista" class="columnaDerecha">
        <h5>Material Agregado</h5>
        <script>
		lista(<?php echo $_GET['id']?>);
		</script> 
      </div>
        </div>
  </div>
    </section>
<!-- Footer -->
<footer>
      <?php footer(); ?>
    </footer>
</body>
</html>
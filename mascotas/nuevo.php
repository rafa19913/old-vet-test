<?php
error_reporting(1);
session_start();

if(!isset($_SESSION['usuario']))
header('Location: ../inicio/login.php');

?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<title>Agregar Mascota</title>
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
          <h2>Mascotas:</h2>
    </div>
    <div class="wrapper">
       
       
       <?php
	   require_once("../funciones/conexion.php");
	   
	   $conexion = conectar();
	   $max = $conexion->query('select max(ultimo_id) as id from mascota')->fetch_assoc();
	 	$idMax =  $max['id'] + 1;
		 $id = $idMax . $_POST['tipo_id']; 
	   
	   if(isset($_POST['raza2']))
	   {
		   $query5 = 'insert into raza (nombre, id_especie) values ("'.$_POST['raza2'].'",'.$_POST['especie'].')';
		$conexion->query($query5);   
		//echo $query5;
		$max = $conexion->query('select max(id_raza) as mas from raza where id_especie = ' . $_POST['especie'])->fetch_assoc();
		$raza = $max['mas'];
	   }else
	   $raza = $_POST['raza'];
	   
	   
	   $query = 'insert into mascota values ("'.$id.'",'.$idMax.',"","'.$_POST['nombre'].'","'.$_POST['sexo'].'",'.$raza.',"'.$_POST['fecha'].'",'.$_POST['peso'].',"'.$_POST['color'].'",'.$_POST['id'].')';
	   
     // echo $query;
     if($conexion->query($query)){
	 echo 'Mascota agregada correctamente.';
	 echo '<form action="agregar.php" method="post">
       <input type="hidden" name="id" value="'.$_POST['id'].'"/>
       <input type="submit" value="Agregar otra mascota al cliente"/>
       </form>';
	 }
	 else{
	 echo 'La mascota no pudo ser agregada, intenta nuevamente.';
	 echo '<form action="agregar.php" method="post">
       <input type="hidden" name="id" value="'.$_POST['id'].'"/>
       <input type="submit" value="Intentar de nuevo"/>
       </form>';
	 }
	 
	 
	   ?>
       <br>

       
<br>
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
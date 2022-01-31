
<?php
session_start();
$opcion = $_GET['id'];
require_once('../funciones/conexion.php');
$conexion = conectar();
function cargarVacunas(){
	$conexion = conectar();
	$resul = $conexion->query('select * from vacuna order by nombre');
	echo '
	Vacuna:<br>
	<select name="id_vacuna">';
	while($vacuna= $resul->fetch_assoc()){
		echo '
		<option value="'.$vacuna['id_vacuna'].'" ';

		if(isset($_GET['id2'])){
			
		}		
		echo 'selected';
		echo '>'.$vacuna['nombre'].'</option>
		';
	}
	echo '</select><br><br>

';
}

function cargarDesparasitantes(){
	$conexion = conectar();
	
	$resul = $conexion->query('select * from desparasitante order by nombre');
	echo '
	Desparasitante:<br>
	<select name="id_desparasitante">';
	while($desparasitante= $resul->fetch_assoc()){
		echo '
		<option value="'.$desparasitante['id_desparasitante'].'">'.$desparasitante['nombre'].'</option>
		';
	}
	echo '</select><br><br>

';
}

function cargarCalendario(){
	echo '<br> <strong>Seleccionar Fecha de Aplicación:</strong><br>';

	//calculo la fecha del dia siguiente
	$fecha= strftime( "%Y-%m-%d", time());
	echo '<input type="date" name="fecha" min="" value="';
	echo $fecha;
	echo '"><br>';

}

function enviarCorreo($id_agenda){
	$conexion = conectar();
	$query = 'select c.nombre as cliente, a.fecha, s.nombre as servicio, m.nombre as mascota, c.email  
	from cliente c, mascota m, agenda a, servicio s 
	where a.id_mascota = m.id_mascota and
	m.id_cliente = c.id_cliente and 
	a.id_servicio = s.id_servicio and
	a.id_agenda = '.$id_agenda;
	$datos = $conexion->query($query)->fetch_assoc();
	
	$mensaje = 'Buen día '.$datos['cliente'].', le recuerdo que su mascota '.$datos['mascota'].' tiene una cita el dia '.$datos['fecha'].' para realizarle el servicio de '.$datos['servicio'].', para que acuda con nosotros para realizarle el servicio en la fecha correspondiente. Si tiene alguna pregunta no dude en llamarnos al 31-6-94-97. Muchas Gracias por su atención y que pase un buen día.';
	$asunto = 'Veterinaria Santa Fé - Próximo Servicio (No responder a éste correo)';
	mail($datos['email'],$asunto,$mensaje);
}


if($opcion==1)
cargarVacunas();	
else if($opcion==2)
cargarDesparasitantes();
else if($opcion==3)
cargarCalendario();
else if($opcion==4)
enviarCorreo($_GET['id_a']);
?>
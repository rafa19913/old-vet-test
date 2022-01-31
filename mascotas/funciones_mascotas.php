<?php

require_once('../funciones/conexion.php');

$opcion = $_GET['opcion'];

function cargarRaza(){
	$conexion = conectar();
	$resul = $conexion->query('select * from raza where id_especie = ' . $_GET['id_especie'] . ' order by nombre');
	
	while($raza = $resul->fetch_assoc()){
		echo '
		<option value="'.$raza['id_raza'].'">'.$raza['nombre'].'</option>
		';
	}
}

function cargarRaza2(){
	$conexion = conectar();
	$resul = $conexion->query('select * from raza where id_especie = ' . $_GET['id_especie'] . ' order by nombre');
	
	while($raza = $resul->fetch_assoc()){
		echo '
		<option value="'.$raza['id_raza'].'" ';
		if($raza['id_raza']==$_GET['id_raza'])
		echo 'selected';
		
		echo '>'.$raza['nombre'].'</option>
		';
	}
}


if($opcion == 1)
	cargarRaza();
if($opcion == 2)
	cargarRaza2();

?>
<?php

//session_start();
//conectar a mi base de datos localhost
function conectar(){
		
	// header("Content-Type: text/html;charset=utf-8");
 	$BD =  ($_SESSION['lugar']=="true")? 'sydtcomm_veterin6_matriz':'sydtcomm_veterin6_sucursal';

	// $conexion = new mysqli('localhost', 'root', 'mysql', 'sydtcomm_veterin6_matriz'); // LOCAL
	$conexion = new mysqli('localhost', 'sydtcomm_root', 'cisco..123', $BD);	 // SERVER

	if($conexion->connect_errno){
		echo "Error al conectarse a la Base de Datos. \n";
		echo "Errno: " . $mysqli->connect_errno . "\n";
	    echo "Error: " . $mysqli->connect_error . "\n";
	    exit;
	}else{
		$conexion->set_charset("utf8");
		

	}
	return $conexion;
	// $conexion = mysql_connect("localhost", "root", "mysql") or die ("No se pudo conectar al servidor");
	// mysql_select_db("sydtcomm_veterinaria_matriz") or die ("No se pudo conectar a la base de datos local");
	// $conexion->query("SET NAMES 'utf8'");

}


// //conectar a mi base de datos localhost
// function conectar(){
	
// 	header("Content-Type: text/html;charset=utf-8");

// 	date_default_timezone_set('america/mexico_city');	

// 	$conexion = mysql_connect("localhost", "sydtcomm_root", "cisco..123")
// 	or die ("No se pudo conectar al servidor");
// 	session_start();
// 	$base =  ($_SESSION['lugar']=="true")? 'sydtcomm_veterin6_matriz':'sydtcomm_veterin6_sucursal';

// 	mysql_select_db($base)
// 	or die ("No se pudo conectar a la base de datos local");

// 	$conexion->query("SET NAMES 'utf8'");

// } 
?>
<?php
error_reporting(0);
session_start();
require_once('../funciones/conexion.php');
$conexion = conectar();

$query = 'update agenda set id_estado = ' . $_GET['id_estado'];

if($_GET['id_estado']==1)
$query = $query . ', fecha_realizado = curdate()';
else if($_GET['id_estado']==3)
$query = 'delete from agenda';

if($_GET['id_estado']==4 || $_GET['id_estado']==1){
	$conexion->query('insert into cobrar_servicio values ('.$_GET['id_agenda'].')');
	$queryCantidad = 'select ms.cantidad, ms.id_producto from material_servicio ms, servicio s, agenda a
	where a.id_servicio = s.id_servicio and s.id_servicio = ms.id_servicio and a.id_agenda = ' . $_GET['id_agenda'];
	
	$resultado = $conexion->query($queryCantidad);
	while($producto = $resultado->fetch_assoc()){
		$cantidad = $conexion->query('select cantidad from inventario where id_producto = "'.$producto['id_producto'].'"')->fetch_assoc();
		
		$cantidad = $cantidad['cantidad'] - $producto['cantidad'];
		
		$queryActualizar = 'update inventario set cantidad = '.$cantidad.' where id_producto = "'.$producto['id_producto'].'"';
		$conexion->query($queryActualizar);
	}
	
}
$query = $query . ' where id_agenda = ' . $_GET['id_agenda'];
//echo $query; 
if($conexion->query($query))
echo 'Cita actualizada correctamente';
else
echo 'Existió un problema al actualizar la cita, intente de nuevo.';

?>
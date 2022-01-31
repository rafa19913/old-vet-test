<?php
require('../funciones/conexion.php');

$conexion = conectar();

$query = 'delete from mascota where id_mascota = "' . $_GET['id'] . '"';
echo ($conexion->query($query))? 'Mascota eliminada correctamente':'Existió un problema al eliminar la mascota';
?>
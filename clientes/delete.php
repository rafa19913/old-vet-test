<?php
require('../funciones/conexion.php');

session_start();
$conexion = conectar();

$query = 'delete from cliente where id_cliente = ' . $_GET['id'];
echo ($conexion->query($query))? 'Cliente eliminado correctamente':'Existió un problema al eliminar el cliente';
?>
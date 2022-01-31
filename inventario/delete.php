<?php
require('../funciones/conexion.php');

conectar();

$query = 'delete from inventario where id_producto = "' . $_GET['id'] . '"';
echo ($conexion->query($query))? 'Producto eliminado correctamente':'Existió un problema al eliminar el producto';
?>
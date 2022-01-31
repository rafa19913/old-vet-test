<?php
error_reporting(0);
require_once('../funciones/conexion.php');
$conexion = conectar();
function buscar($bus,$id_s){
?>

<h5>Lista de Material</h5>
<table>
  <tr>
    <th>Producto</th>
    <th>Unidad </th>
    <th>Cantidad</th>
    <th>Agregar </th>
  </tr>
  <?php 
  $query = 'select * from inventario where id_producto like "%'.$bus.'%" or nombre like "%'.$bus.'%" or descripcion like "%'.$bus.'%" order by nombre';
  $resul = $conexion->query($query);
  while($producto = $resul->fetch_assoc()){

  ?>
  <tr>
    <td align="left"><?php echo $producto['nombre'];?></td>
    <td><?php echo $producto['unidad'];?></td>
    <td><input type="button" style="width:10px;" onClick="restar(cantidad_<?php echo $producto['id_producto'];?>)" value="-"/>
      <input type="text" width="10" style="width:20px" value="1" id="cantidad_<?php echo $producto['id_producto'];?>"/>
      <input type="button" onClick="sumar(cantidad_<?php echo $producto['id_producto'];?>)" value="+"  style="width:10px;"/></td>
    <td><a onClick="agregar(<?php echo $id_s;?>,<?php echo $producto['id_producto'];?>,cantidad_<?php echo $producto['id_producto'];?>.value)">Agregar</a></td>
  </tr>
  <?php
	} // cierre del while
  ?>
</table>
<?php 
} //cierre de la funcion


function lista($id_s){
?>

<h5>Material Agregado</h5>
<table>
  <tr>
    <th>Producto</th>
    <th>Unidad </th>
    <th>Cantidad</th>
    <th>Quitar</th>
  </tr>
  <?php 
  $query = 'select inventario.nombre,inventario.unidad,material_servicio.cantidad ,material_servicio.id_producto
  from material_servicio, inventario 
  where inventario.id_producto = material_servicio.id_producto and
  material_servicio.id_servicio = ' . $id_s;
  $resul = $conexion->query($query);
  while($producto = $resul->fetch_assoc()){

  ?>
  <tr>
    <td align="left"><?php echo $producto['nombre'];?></td>
    <td><?php echo $producto['unidad'];?></td>
    <td><?php echo $producto['cantidad'];?></td>
    <td><a onClick="quitar(<?php echo $id_s;?>,<?php echo $producto['id_producto'];?>)">Quitar</a></td>
  </tr>
  <?php
	} // cierre del while
  ?>
</table>
<a href="index.php"><h6>Guardar</h6></a>
<?php 
} //cierre de la funcion


function agregar($id_s, $id_p , $cantidad){
	$query = 'insert into material_servicio (id_servicio, id_producto, cantidad) values ('.$id_s.','.$id_p.','.$cantidad.')';	
	if($conexion->query($query))
		lista($id_s);
}

function quitar($id_s, $id_p){
	$query = 'delete from material_servicio where id_servicio = '.$id_s.' and id_producto = "'.$id_p . '" limit 1';	
	if($conexion->query($query))
		lista($id_s);
}


?>




<?php
$opcion = $_GET['opcion'];
if($opcion == 1)
	buscar($_GET['buscar'],$_GET['id_s']);
else if($opcion==2){
	agregar($_GET['id_s'],$_GET['id_p'],$_GET['cant']);
}else if($opcion == 3)
	lista($_GET['id_s']);
else if($opcion==4)
	quitar($_GET['id_s'],$_GET['id_p']);
?>
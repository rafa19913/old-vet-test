<?php
session_start();
require_once('../funciones/conexion.php');
function mostrarLista(){

?>

<h3>Lista de Articulos</h3>
<table>
	<tr>
		<th>Código</th>
		<th>Nombre</th>
		<th>Presentación</th>
		<th>Proveedor</th>
		<th>Cantidad</th>
		<th>Precio</th>
		<th>Quitar</th>
	</tr>
	<?php
$conexion = conectar();

$query = 'select p.id_producto, p.nombre, p.unidad,p.proveedor, l.cantidad, l.precio_vendido
from inventario p, lista_productos_tmp l
where l.id_producto = p.id_producto and
l.id_usuario = ' . $_SESSION['id'];

$resul = $conexion->query($query);

while($fila = $resul->fetch_assoc()){
?>
	<tr>
		<td><?php echo $fila['id_producto'];?></td>
		<td><?php echo $fila['nombre'];?></td>
		<td><?php echo $fila['unidad'];?></td>
		<td><?php echo $fila['proveedor'];?></td>
		<td><?php echo $fila['cantidad'];?></td>
		<td>$<?php echo $fila['precio_vendido'];?></td>
		<td><button type="button" onClick="accion(3,'<?php echo $fila['id_producto']. " ', " . $fila['cantidad'];?>)">Quitar</button></td>
	</tr>
	<?php
}//fin while


$total = $conexion->query('select sum(precio_vendido) as total from lista_productos_tmp where id_usuario = ' . $_SESSION['id'])->fetch_assoc();

?>
</table>
<table>
	<tr>
		<td align="left"><h4>Total de productos: $<?php echo $total['total'];?></h4>
			<input type="hidden" id="total_pagado" value="<?php echo $total['total'];?>"/></td>
	</tr>
</table>
<?php } // fin metodo mostrarLista

function mostrarTotal($id_c){ 
$conexion = conectar();
$query = 'select sum((select coalesce(sum(p.precio_venta * ms.cantidad),0) 
    from inventario p, material_servicio ms , agenda a , cobrar_servicio cs, mascota m, cliente c, servicio s
    where 
    a.id_agenda = cs.id_agenda and
    a.id_servicio = s.id_servicio and
    ms.id_servicio = s.id_servicio and
    ms.id_producto = p.id_producto and
    a.id_mascota = m.id_mascota and
    m.id_cliente = c.id_cliente and
    c.id_cliente = '.$id_c.') + (select coalesce(sum(s.precio),0) 
    from agenda a , cobrar_servicio cs, mascota m, cliente c, servicio s
    where 
    a.id_agenda = cs.id_agenda and
    a.id_servicio = s.id_servicio and
    a.id_mascota = m.id_mascota and
    m.id_cliente = c.id_cliente and
    c.id_cliente = '.$id_c.') + (select coalesce(sum(precio_vendido),0) from lista_productos_tmp 
    where id_usuario = '.$_SESSION['id'].')) as total ';
	//echo $query;
$total2 = $conexion->query($query)->fetch_assoc();

?>
<table>
	<tr>
		<td align="center"><h2>Total a pagar: $<?php echo $total2['total'];?></h2>
			<input type="hidden" id="total_pagado" value="<?php echo $total2['total'];?>"/></td>
	</tr>
</table>
<?php
}//fin metodo mostrarLista


function agregar($id_p, $cant){
	$conexion = conectar();
	
	$precio = $conexion->query('select precio_venta from inventario where id_producto = "'.$id_p.'"')->fetch_assoc();
	
	$precio = $precio['precio_venta'] * $cant;
	$query = 'insert into lista_productos_tmp values ('.$cant.','.$precio.',"'.$id_p.'",'.$_SESSION['id'] . ')';	
	$conexion->query($query);
	mostrarLista();
}


function quitar($id_p, $cant){
	$conexion = conectar();
	
	$query = 'delete from lista_productos_tmp where cantidad='.$cant.' and id_producto = "'.$id_p.'" and id_usuario='.$_SESSION['id'] . ' limit 1';	
	$conexion->query($query);
	mostrarLista();
}

function cargarCliente($txt){
	?>
<div id="search-form">
	<input type="text" onblur="if(this.value==''){this.value='buscar'}" onfocus="if(this.value=='buscar'){this.value=''}" value="buscar" id="bus" onKeyPress="return pulsarCliente(event,this.value)"  />
	<a class="search-form-submit"></a>
</div>
<table>
	<tr>
		<th >Nombre</th>
		<th >Dirección</th>
		<th >Ciudad</th>
		<th >Telefono</th>
		<th >Celular</th>
		<th >Seleccionar</th>
	</tr>
	<?php
        $conexion = conectar();
		$query = "select * from cliente";
	
		$aux = $txt;
		$query = $query . ' where id_cliente like "' . $aux . '" or nombre like "%'.$aux.'%"' . ' or email like "%'.$aux.'%"' . ' or telefono like "%'.$aux.'%"' . ' or celular like "%'.$aux.'%" order by nombre' ;
		
		//echo $query;
        $consulta = $conexion->query($query);
				
        while($cliente = $consulta->fetch_assoc()){
			echo '<tr>
		  <td align="left">'.$cliente['nombre'].'</td>
		  <td>'.$cliente['direccion'].'</td>
		  <td>'.$cliente['ciudad'].'</td>
		  <td>'.$cliente['telefono'].'</td>
		  <td>'.$cliente['celular'].'</td>
		  <td>
		  <input type="radio" name="id_cliente" value="'.$cliente['id_cliente'].'" onChange="cargarServicios(this.value)"/>
		  </td>
        </tr>';
        }

        ?>
</table>
<?php
}

function cargarServicios($id){
	
	?>
<h3>Lista de Servicios Realizados</h3>
<table>
	
		<th>Mascota</th>
		<th>Servicio Realizado</th>
		<th>Materiales</th>
		<th>Fecha Realizado</th>
		<th>Detalles</th>
		<th>Total</th>
	</tr>
	<?php
	$conexion = conectar();
	
	$query = 'select m.nombre, s.nombre as servicio, s.id_servicio, a.fecha_realizado , a.id_agenda
	from mascota m, servicio s, agenda a , cobrar_servicio cs, cliente cl
	where a.id_agenda = cs.id_agenda and
	s.id_servicio = a.id_servicio and
	a.id_mascota = m.id_mascota and
	m.id_cliente = cl.id_cliente and
	cl.id_cliente = ' . $id;
	//echo $query;
	$resul = $conexion->query($query);
	$totalServicios = 0;
	while($fila = $resul->fetch_assoc()){
	?>
	<tr>
		<td><?php echo $fila['nombre'];?></td>
		<td><?php echo $fila['servicio'];?></td>
		<td><?php 
	 $result2 = $conexion->query('select m.cantidad, i.unidad , i.nombre  from material_servicio m, inventario i where i.id_producto = m.id_producto and m.id_servicio = ' . $fila['id_servicio']);
	  while($material = $result2->fetch_assoc()){
		  echo $material['cantidad'] . ' X ' . $material['unidad'] . ' de ' . $material['nombre'] . '<br> ';
	   }
	
	?></td>
		<td><?php echo $fila['fecha_realizado'];?></td>
		<td><a href="../agenda/detalles.php?id=<?php echo $fila['id_agenda'];?>" target="_blank" >Detalles</a></td>
		<td>$
			<?php
	$querySuma = ' select sum((select coalesce(sum(p.precio_venta * ms.cantidad),0) 
    from inventario p, material_servicio ms , agenda a , cobrar_servicio cs,  servicio s
    where a.id_agenda = cs.id_agenda and
    a.id_servicio = s.id_servicio and
    ms.id_servicio = s.id_servicio and
    ms.id_producto = p.id_producto and
    a.id_agenda = '.$fila['id_agenda'].')+(select coalesce(sum(s.precio),0) 
    from agenda a , servicio s
    where 
    a.id_servicio = s.id_servicio and
    a.id_agenda = '.$fila['id_agenda'].')) as total ';
	$sumaMat = $conexion->query($querySuma)->fetch_assoc();
	 echo $sumaMat['total'];
	 $totalServicios = $totalServicios + $sumaMat['total'];
	 ?></td>
	</tr>
	<?php }//fin while ?>
</table>
<table>
	<tr>
		<td align="left"><h4>Total de Servicios: $<?php echo $totalServicios;?></h4>
			<input type="hidden" id="total_pagado" name="total_pagado" value="<?php echo $totalServicios;?>"/></td>
	</tr>
</table>
<?php
		
}// fin metodo


function comprar($id_c,$tipo, $forma,$total,$pago){
	$conexion = conectar();
	$corte = $conexion->query('select id_corte from corte where fecha_fin = "0000-00-00 00:00:00" ')->fetch_assoc();
	//echo $corte['id_corte'];
	
	//echo '<div id="resultado_compra">'.'Entro OK'.$corte['id_corte'].'</div>';
	
	
	$queryVenta = 'insert into venta (tipo_pago,forma_pago,fecha,id_cliente,id_corte,total,id_usuario) values ("'.$tipo.'","'.$forma.'",now(),'.$id_c.','.$corte['id_corte'].','.$total.','.$_SESSION['id'].')';
	//echo $queryVenta;
	 
	if($conexion->query($queryVenta)){
		
		$queryProductos = 'select * from lista_productos_tmp where id_usuario = '. $_SESSION['id'];
		$resul = $conexion->query($queryProductos);
		
		//while para agregar los productos 
		while($producto = $resul->fetch_assoc()){
			$querytmp = 'insert into lista_productos values ('.$producto['precio_vendido'].','.$producto['cantidad'].',last_insert_id(),'.$producto['id_producto'].')';
			
		$queryCantidad = 'select cantidad from inventario where id_producto = "'.$producto['id_producto'].'"';
		$cantidad = $conexion->query($queryCantidad)->fetch_assoc();
		$cantidad = $cantidad['cantidad'] - $producto['cantidad'];
		$queryActualizar = 'update inventario set cantidad = '.$cantidad.' where id_producto = "'.$producto['id_producto'].'"';
		$conexion->query($queryActualizar);
			$conexion->query($querytmp);
		}//fin while
		
		$query = 'select a.id_agenda 
		from mascota m, servicio s, agenda a , cobrar_servicio cs, cliente cl
		where a.id_agenda = cs.id_agenda and
		s.id_servicio = a.id_servicio and
		a.id_mascota = m.id_mascota and
		m.id_cliente = cl.id_cliente and
		cl.id_cliente = ' . $id_c;
		$resulServ = $conexion->query($query);
		
		//while para agregar los servicios 
		while($ser = $resulServ->fetch_assoc()){
			$querySuma = ' select sum((select coalesce(sum(p.precio_venta * ms.cantidad),0) 
			from inventario p, material_servicio ms , agenda a , cobrar_servicio cs,  servicio s
			where a.id_agenda = cs.id_agenda and
			a.id_servicio = s.id_servicio and
			ms.id_servicio = s.id_servicio and
			ms.id_producto = p.id_producto and
			a.id_agenda = '.$ser['id_agenda'].')+(select coalesce(sum(s.precio),0) 
			from agenda a , servicio s
			where 
			a.id_servicio = s.id_servicio and
			a.id_agenda = '.$ser['id_agenda'].')) as total ';
			$sumaMat = $conexion->query($querySuma)->fetch_assoc();
			
			$queryServ = 'insert into lista_servicios values ('.$sumaMat['total'].',last_insert_id(),'.$ser['id_agenda'].')';
			$conexion->query($queryServ);
			
			
			$conexion->query('delete from cobrar_servicio where id_agenda = '. $ser['id_agenda']);
		}
		
		//querys para vacias cobros y servicios tmps
		$conexion->query('delete from lista_productos_tmp where id_usuario=' . $_SESSION['id']);
		echo '<div id="resultado_compra">Venta realizada correctamente</div>';
		$id_v = $conexion->query('select last_insert_id() as id;')->fetch_assoc();

		$aux = 0; // variable para imprimir ticket con abono del credido
		
///////////////////////////


		if($tipo=="Credito"){
			$queryCred = 'insert into credito (id_venta,restante) values ('.$id_v['id'].', '.$total.')';
			$conexion->query($queryCred);
			if($pago > 0){
				
				$restante = $total - $pago;
				$queryRest = 'update credito set restante = '.$restante.' where id_credito = last_insert_id()';
				$queryAbo = 'insert into abono (cantidad,fecha,id_credito,id_usuario,id_corte,forma_pago) values ('.$pago.',now(),last_insert_id(),'.$_SESSION['id'].','.$corte['id_corte'].',"'.$forma.'")';
				
				$conexion->query($queryRest);
				$conexion->query($queryAbo);
				$id_a = $conexion->query('select last_insert_id() as id')->fetch_assoc();
				
				$aux = $id_a['id'];
			}
		}
		
/////////////////////////////

	
	imprimirTicket($id_v['id'],$aux);

	}//fin if	
	else 
		echo '<div id="resultado_compra">Existió un error al realizar la venta</div>';
		
		
}//fin funcion

function cancelar(){

	$conexion = conectar();
	if($conexion->query('delete from lista_productos_tmp where id_usuario=' . $_SESSION['id']))
	echo '<div id="resultado_compra">Se cancelo la venta correctamente</div>';
	else
	echo '<div id="resultado_compra">Existió un error al cancelar la venta</div>';
}


function imprimirTicket($id_v,$aux){
	$conexion = conectar();
	
	$datos = $conexion->query('select v.*, c.nombre as nombre_c, u.nombre as usuario_c from venta v, cliente c, usuario u where v.id_cliente = c.id_cliente and v.id_venta = ' . $id_v)->fetch_assoc();
?>
<div id="ticket" style="width:250px; ">
	-----------------------------------------
	<center>
		Veterinaria Santa Fé
	</center>
	13 César López de Lara #2646
	Col. Treviño Zapata Cd. Victoria Tamps<br>
	----------------------------------------- <br>
	Venta Num: <?php echo $datos['id_venta']; ?><br>
	Fecha: <?php echo $datos['fecha']; ?><br>
	Atendió: <?php echo $datos['usuario_c']; ?> <br>
	Cliente: <?php echo $datos['nombre_c'];?> <br>
	Tipo de Pago: <?php echo $datos['tipo_pago'];?><br>
	Forma de Pago: <?php echo $datos['forma_pago'];?><br>
	<br>
	<?php echo 'Nombre  |  Med.  |   Cant  | Precio';?><br>
	<?php 
	$listaProd = $conexion->query('select lp.*, p.nombre, p.unidad from lista_productos lp, inventario p where lp.id_producto = p.id_producto and lp.id_venta = ' . $id_v);
	$total = 0;
	while($producto=$listaProd->fetch_assoc()){
	?>
	<?php echo $producto['nombre']. ' | ' .  $producto['unidad'].' | ' . $producto['cantidad']. ' | $' .$producto['precio_vendido'].'<br> ' ; ?>
	<?php
	$total = $total + $producto['precio_vendido'];
	}//fin ciclo while
	
	
	?>
	<?php
  
  $queryServicios = 'select s.nombre, ls.precio_vendido, m.nombre as mascota, s.id_servicio from servicio s, lista_servicios ls, agenda a ,mascota m
  where a.id_servicio = s.id_servicio and
  a.id_mascota = m.id_mascota and
  ls.id_agenda = a.id_agenda and
  ls.id_venta = ' . $id_v;
  
  $resulServicios = $conexion->query($queryServicios);
  while($servicio = $resulServicios->fetch_assoc()){
	  echo '<br>
	  '.$servicio['nombre'].' a '.$servicio['mascota'].' $'.$servicio['precio_vendido'];
	  $total = $total + $servicio['precio_vendido'];
  ?>
	<br>
	<?php echo 'Nombre  |  Med.  |   Cant';?><br>
	<?php 
  $resulProdSer = $conexion->query('select ms.cantidad, p.nombre, p.unidad from material_servicio ms, inventario p where ms.id_producto = p.id_producto and ms.id_servicio = ' . $servicio['id_servicio']);
  while($producto = $resulProdSer->fetch_assoc()) {?>
	<?php echo $producto['nombre']. ' | '. $producto['unidad']. ' | ' . $producto['cantidad']; ?><br>
	<?php } //fin while produc
	} //fin while serv
  ?>
	<br>
	------------------------------------------
	Total: $ <?php echo $total;?><br>
	----------------------------------------- <br>
	<?php
if($aux>0)
imprimirAbono($aux);

?>
	<br>
</div>
<?php	
}//fin funcion


function imprimirAbono($id_a){
  
  $datos = $conexion->query('
	select a.id_abono, a.fecha,a.forma_pago, u.nombre as usuario, c.nombre as cliente, a.cantidad, cr.restante, v.total
	from abono a, cliente c, usuario u, credito cr ,venta v where 
	a.id_credito = cr.id_credito and
	a.id_usuario = u.id_usuario and 
	cr.id_venta = v.id_venta and 
	v.id_cliente = c.id_cliente and
	a.id_abono = ' . $id_a)->fetch_assoc();
	
	?>
<br>
ABONO <br>
<br>
Fecha: <?php echo $datos['fecha']; ?><br>
Atendió: <?php echo $datos['usuario']; ?> <br>
Cliente: <?php echo $datos['cliente'];?> <br>
<br>
Deuda: $<?php echo $datos['total'];?> <br>
Cantidad Abonada: $<?php echo $datos['cantidad'];?> <br>
Forma de Pago: <?php echo $datos['forma_pago'];?> <br>
------------------------------------------
Restante: $ <?php echo $datos['restante'];?> <br>
----------------------------------------- <br>
<?php
	
  
  ?>
<br>
<?php
	
} // termina imprimirAbono

$opcion = $_GET['opcion'];

switch($opcion){

case 1:
	mostrarLista();	
	break;

case 2:
	agregar($_GET['id_p'],$_GET['cantidad']);
	break;

case 3:
	quitar($_GET['id_p'],$_GET['cantidad']);
	break;

case 4:
	cargarCliente($_GET['txt']);	
	break;

case 5:
	cargarServicios($_GET['id_c']);	
	break;

case 6:
	mostrarTotal($_GET['id_c']);
	break;

case 7:
	comprar($_GET['id_c'],$_GET['tipo'],$_GET['forma'],$_GET['total'],$_GET['pago']);
	break;

case 8:
	cancelar();
	break;
	

}
?>
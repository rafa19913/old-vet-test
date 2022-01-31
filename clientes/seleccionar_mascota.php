          <div>
        <?php
		  session_start();
		  function dateDiff($end, $out_in_array=false){
			if($end == "0000-00-00")
			return "";
        $intervalo = date_diff(date_create(), date_create($end));
        $out = $intervalo->format("%yaño %mm");
        if(!$out_in_array)
            return $out;
        array_walk(explode(',',$out),x($val,$key));
        return $a_out;

      }
	  
	  function x($val,$key){
		  
        $a_out = array();
            $v=explode(':',$val);
            $a_out[$v[0]] = $v[1];
        }
		  
	require_once('../funciones/conexion.php');
	$conexion = conectar();
	$query = 'select mascota.*, raza.nombre as raza from mascota, raza where mascota.id_raza = raza.id_raza and mascota.id_mascota = "'.$_GET['id'] . '"';
// echo $query;
	$agenda = $conexion->query($query)->fetch_assoc();
	?>
        <div class="columnaIzquierda">
              <h5>Información de la Mascota</h5>
              <strong>Número de Control:</strong> <br>
              <?php echo $agenda['id_mascota']; ?> <br>
              <br>
              <strong>Nombre:</strong> <br>
              <?php echo $agenda['nombre']; ?> <br>
              <br>
              <strong>Especie:</strong> <br>
             <?php echo $agenda['raza']. ' (' .$agenda['sexo'] . ')'; ?>  <br>
              <br>
              <strong>Edad:</strong> <br>
              <?php echo dateDiff( $agenda['fecha_nacimiento']); ?>
              <br>
              <br>
              <strong>Peso:</strong> <br>
              <?php echo $agenda['peso']; ?>Kg <br>
              <br>
              <strong>Color:</strong> <br>
              <?php echo $agenda['color']; ?> <br>
              <br>
              <form action="../mascotas/modificar.php" target="_blank" method="post">
              <input type="hidden" name="id" value="<?php echo $agenda['id_mascota'];?>"/>
              <input type="submit" value="Modificar Datos de la Mascota"/>
              </form>
            </div>
        
      </div>
          <div style="float:left; width:100%; margin-top:50px;">
        <div class="columnaIzquierda">
              <h5>Historial de Vacunas</h5>
              <table>
            <tr>
                  <th> Fecha Cita </th>
                  <th> Fecha Aplicación </th>
                  <th> Vacuna </th>
                  <th>Detalles</th>
                </tr>
            <?php

	
	$query = 'select agenda.fecha,agenda.id_agenda , agenda.fecha_realizado , vacuna.nombre from
	agenda, vacuna, historial_vacunas where 
	agenda.id_agenda = historial_vacunas.id_agenda and
	historial_vacunas.id_vacuna = vacuna.id_vacuna and
	agenda.id_servicio = 1 and
	agenda.id_mascota = "' . $agenda['id_mascota'] .'"  order by agenda.fecha';
	
	$resul = $conexion->query($query);
	//echo $query;
	while($vacuna = $resul->fetch_assoc()){
		echo '
		<tr>
		<td>'.$vacuna['fecha'].'</td>
		<td>';
		if($vacuna['fecha_realizado'] == "0000-00-00")
		echo 'No aplicada';
		else
		echo $vacuna['fecha_realizado'];
		echo '</td>
		<td>'.$vacuna['nombre'].'</td>
		<td><a href="../agenda/detalles.php?id='.$vacuna['id_agenda'].'" target="_blank">Ver Más</a></td>
		</tr>
		';
	}
?>

<tr>
                  <form id="form">
        <td>

<?php
  //$fecha_futura = strftime( "%Y-%m-%d", time() - (10*12*31 * 24 * 60 * 60) );
  //calculo la fecha del dia siguiente
  $fecha= strftime( "%Y-%m-%d", time());
?>
  
<input type="date" name="fecha2" id="fecha2ID" value="<?php echo $fecha;?>">  
</td>
        <td>

<input type="date" name="fecha3" id="fecha3ID" value="<?php echo $fecha;?>">  
  
</td>
                <td><select id="vacuna">
                    <?php
$resul4 = $conexion->query('select * from vacuna order by nombre');

while($vacuna = $resul4->fetch_assoc()){
	echo '<option value="'.$vacuna['id_vacuna'].'">'.$vacuna['nombre'].'</option>';
}

?>
                  </select></td>
                <td><a onClick="agregarCita('<?php echo $agenda['id_mascota'];?>',fecha2ID.value, fecha3ID.value,vacuna.value,1);">Agregar</a></td>
              </form>
                </tr>

          </table><br>
<br>
<br>
<br>
<br>
<br><br>
<br>
<br>
<br>


            </div>
        <div class="columnaDerecha">
              <h5>Historial de Desparasitaciones</h5>
              <table>
            <tr>
                  <th> Fecha Cita </th>
                  <th> Fecha Aplicación </th>
                  <th> Desparasitante </th>
                  <th>Detalles</th>
                </tr>
            <?php

	
	$query = 'select agenda.fecha ,agenda.id_agenda, agenda.fecha_realizado , desparasitante.nombre from
	agenda, desparasitante, historial_desparasitaciones where 
	agenda.id_agenda = historial_desparasitaciones.id_agenda and
	historial_desparasitaciones.id_desparasitante = desparasitante.id_desparasitante and
	agenda.id_servicio = 2 and
	agenda.id_mascota = "' . $agenda['id_mascota'] .'" order by agenda.fecha';
	
	$resul = $conexion->query($query);
	//echo $query;
	while($vacuna = $resul->fetch_assoc()){
		echo '
		<tr>
		<td>'.$vacuna['fecha'].'</td>
		<td>';
		if($vacuna['fecha_realizado'] == "0000-00-00")
		echo 'No aplicada';
		else
		echo $vacuna['fecha_realizado'];
		echo '</td>
		<td>'.$vacuna['nombre'].'</td>
		<td><a href="../agenda/detalles.php?id='.$vacuna['id_agenda'].'" target="_blank">Ver Más</a></td>
		</tr>
		';
	}

?>
<tr>
<form id="form">
<td>

<input type="date" name="fecha4" id="fecha4ID" value="<?php echo $fecha;?>">  

</td>
<td>

<input type="date" name="fecha5" id="fecha5ID" value="<?php echo $fecha;?>">  

</td>
<td><select id="desparasitante">
                    <?php
$resul4 = $conexion->query('select * from desparasitante order by nombre');
while($vacuna = $resul4->fetch_assoc()){
	echo '<option value="'.$vacuna['id_desparasitante'].'">'.$vacuna['nombre'].'</option>';
}

?>
                  </select></td>
                <td><a onClick="agregarCita('<?php echo $agenda['id_mascota'];?>',fecha4ID.value, fecha5ID.value,desparasitante.value,2);">Agregar</a></td>
              </form>
                </tr>
          </table>
          <br>
<br>
<br>
<br>
<br><br>
<br>
<br>
<br>
<br>
<br>
            </div>
      </div>
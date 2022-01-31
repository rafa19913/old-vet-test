<?php
session_start();
require_once('../funciones/conexion.php');
  $conexion = conectar();

  $id = $conexion->query('select max(id_agenda) as id from agenda')->fetch_assoc();
  $id = $id['id'] + 1;
  
  if($_GET['fecha2']=="0000-00-00")
  $estado = 2;
  else
  $estado = 1;
   
  $query = 'insert into agenda (id_agenda,fecha,comentarios,fecha_realizado,id_estado,id_servicio,id_mascota) values ('.$id.',"'.$_GET['fecha1'].'","-","'.$_GET['fecha2'].'",'.$estado.','.$_GET['id_servicio'].',"'.$_GET['id_mascota'].'")';
  
  
  
   //echo $query;

  if($conexion->query($query))
  echo 'Nueva cita agregada correctamente.';
  else 
  echo 'Existió un problema para agregar la cita, intente nuevamente.';
    
  if($_GET['id_servicio']==1){
	  $query = 'insert into historial_vacunas values ('.$id.','.$_GET['id_vacuna_despa'].')';
	  //echo $query;
	  $conexion->query($query); 
  }else{
	  $query = 'insert into historial_desparasitaciones values ('.$id.','.$_GET['id_vacuna_despa'].')';
	  //echo $query;
	  $conexion->query($query); 
  }

?>
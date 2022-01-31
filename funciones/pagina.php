<?php

function headers($id){
	require_once('../funciones/conexion.php');
	 
    $query2 = 'select id_perfil from usuario where id_usuario = ' . $id;
    $conexion = conectar();

    $resul2 = $conexion->query($query2);
    $x = $resul2->fetch_assoc();
    if($resul2->num_rows > 0)
    $perfil = $x['id_perfil'];
    else 
    $perfil = 0;
    $query = 'select * from menu where id_perfil = ' . $perfil;


    //consulta para saber las opciones que tiene el perfil
    $resultado = $conexion->query($query);
    //recorro las opciones 

?>
<link rel="stylesheet" href="../css/style.css">
<div class="inner">
  <h1 class="logo"><a href="../inicio/index.php">Veterinaria Santa Fé</a></h1>
  <div class="fright">
    
    <nav>
      <ul class="sf-menu">
        <?php while($fila = $resultado->fetch_assoc()){
	  
	  	switch($fila['id_opcion']){
		 case 1:
		 ?>
        <li><img src="../images/iconos/agenda.png" style="margin-right:8px;"><a href="../agenda/">Agenda</a>
          <ul>
            <li><a href="../agenda/nuevo.php">Nueva cita</a> </li>
            <li><a href="../agenda/index.php">Lista de Citas</a> </li>
            <li><a href="../agenda/index2.php">Lista de Mascotas en la Veterinaria</a> </li>
          </ul>
        </li>
        <?php
		 break;
		 
		 case 2:
		 ?>
        <li><img src="../images/iconos/ventas.png" style="margin-right:3px;"><a href="../ventas">ventas</a>
        <ul>
        <li><a href="../ventas/index.php">Nueva Venta</a></li>
        <li><a href="../ventas/lista_creditos.php">Lista de Creditos Activos</a></li>
        </ul>
        </li>
        <?php
		 break;
		 
		 case 3:
		 ?>
        <li> <img src="../images/iconos/clientes.png" style="margin-right:8px;"><a href="../clientes">clientes</a>
          <ul>
            <li><a href="../clientes/index.php">Lista de clientes</a></li>
            <li><a href="../clientes/agregar.php">Agregar cliente</a></li>
            <li><a href="../clientes/editar.php">Editar Cliente</a></li>
            <li><a href="../mascotas/">mascotas</a>
              <ul>
                <li><a href="../mascotas/index.php">Lista de mascotas</a></li>
                <li><a href="../mascotas/seleccionar.php">Agregar mascota</a></li>
                <li><a href="../mascotas/editar.php">Editar mascota</a></li>
              </ul>
            </li>
          </ul>
        </li>
        <?php
		 break;
		 
		  case 7:
		 ?>
        <li> <img src="../images/iconos/empleado.png" style="margin-right:20px;"><a href="../empleados">Empleados</a>
          <ul>
            <li><a href="../empleados/index.php">Lista de Empleados</a></li>
            <li><a href="../empleados/nuevo.php">Agregar Empleado</a></li>
            <li><a href="../perfiles/">Perfiles</a>
              <ul>
                <li><a href="../perfiles/index.php">Lista de Perfiles</a></li>
                <li><a href="../perfiles/nuevo.php">Agregar Perfil</a></li>
              </ul>
            </li>
          </ul>
        </li>
        <?php
		 break;
		 
		case 5:
		 ?>
        <li><img src="../images/iconos/inventario.png" style="margin-right:20px;"><a href="../inventario/">inventario</a>
          <ul>
            <li><a href="../inventario/index.php">Productos</a>
              <ul>
                <li><a href="../inventario/index.php">Lista de productos</a></li>
                <li><a href="../inventario/agregar.php">Agregar producto</a></li>
                <li><a href="../inventario/editar.php">Editar producto</a></li>
                <li><a href="../inventario/comprar.php">Comprar más producto</a></li>
                <li><a href="../inventario/salidas.php">Salidas de producto</a></li>
              </ul>
            </li>
            <li><a href="../vacunas/">Vacunas</a>
              <ul>
                <li><a href="../vacunas/index.php">Lista de Vacunas</a></li>
                <li><a href="../vacunas/agregar.php">Agregar Vacuna</a></li>
                <li><a href="../vacunas/editar.php">Editar Vacuna</a></li>
              </ul>
            </li>
            <li><a href="../desparasitante/">Desparasitantes</a>
              <ul>
                <li><a href="../desparasitante/index.php">Lista de Desparasitante</a></li>
                <li><a href="../desparasitante/agregar.php">Agregar Desparasitante</a></li>
                <li><a href="../desparasitante/editar.php">Editar Desparasitante</a></li>
              </ul>
            </li>
          </ul>
        </li>
        <?php
		 break;
		 
		 case 6:
		 ?>
        <li><img src="../images/iconos/servicios.png" style="margin-right:12px;"><a href="../servicios/">servicios</a>
          <ul>
            <li><a href="../servicios/index.php">Lista de servicios</a></li>
            <li><a href="../servicios/agregar.php">Agregar servicio</a></li>
            <li><a href="../servicios/editar.php">Editar Servicio</a></li>
            <li><a href="../servicios/editar2.php">Editar Materiales del Servicio</a></li>
          </ul>
        </li>
        <?php
		 break;//fin condicion 6
		 
		 case 8:
		 ?>
        <li><img src="../images/iconos/reportes.png" style="margin-right:12px;"><a href="../servicios/">Reportes</a>
          <ul>
        <li><a href="../ventas/reporte.php">Reporte de Ventas</a></li>
        <li><a href="../ventas/corte.php">Hacer Corte de Caja</a></li>
          </ul>
        </li>
        <?php
		 break;//fin condicion 6
		 
		}//fin swith
		
		} //fin while
		?>
      </ul>
    </nav>
  </div>
  <div class="clear"></div>
</div>
<?php

}//fin metodo


function footer(){
	?>
<div><a href="../inicio">Veterinaria Santa Fe</a> -
  <?php if(isset($_SESSION['usuario'])){?>
  <a href="../inicio/logout.php">Cerrar Sesion</a>
  <?php } else {?>
  <a href="../inicio/login.php">Iniciar Sesion</a>
  <?php }?>
</div>
<ul class="social-list">
  <li><a href="#"><img src="../images/social-link-1.jpg" alt=""></a></li>
  <li><a href="#"><img src="../images/social-link-2.jpg" alt=""></a></li>
  <li><a href="#"><img src="../images/social-link-3.jpg" alt=""></a></li>
  <li><a href="#"><img src="../images/social-link-4.jpg" alt=""></a></li>
</ul>
<?php
	
}


?>

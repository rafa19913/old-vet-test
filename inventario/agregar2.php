<!DOCTYPE html>
<html lang="en">
	<head>
	<title>Guardar Producto</title>
	<meta charset="utf-8">
	<meta name="description" content="Your description">
	<meta name="keywords" content="Your keywords">
	<meta name="author" content="Your name">
	<link rel="stylesheet" href="../css/style.css">
	<script src="../js/jquery-1.7.1.min.js"></script>
	<script src="../js/superfish.js"></script>
    <script src="../funciones/validaciones.js"></script>
	
	</head>
	<body>
<!-- Header -->
<header>
      <link rel="stylesheet" href="../css/style.css">
<div class="inner">
  <h1 class="logo"><a href="../inicio/index.php">Veterinaria Santa Fé</a></h1>
  <div class="fright">
    
    <nav>
      <ul class="sf-menu">
                <li><img src="../images/iconos/agenda.png" style="margin-right:8px;"><a href="../agenda/">Agenda</a>
          <ul>
            <li><a href="../agenda/nuevo.php">Nueva cita</a> </li>
            <li><a href="../agenda/index.php">Lista de Citas</a> </li>
            <li><a href="../agenda/index2.php">Lista de Mascotas en la Veterinaria</a> </li>
          </ul>
        </li>
                <li><img src="../images/iconos/ventas.png" style="margin-right:3px;"><a href="../ventas">ventas</a>
        <ul>
        <li><a href="../ventas/index.php">Nueva Venta</a></li>
        <li><a href="../ventas/lista_creditos.php">Lista de Creditos Activos</a></li>
        </ul>
        </li>
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
                <li><img src="../images/iconos/servicios.png" style="margin-right:12px;"><a href="../servicios/">servicios</a>
          <ul>
            <li><a href="../servicios/index.php">Lista de servicios</a></li>
            <li><a href="../servicios/agregar.php">Agregar servicio</a></li>
            <li><a href="../servicios/editar.php">Editar Servicio</a></li>
            <li><a href="../servicios/editar2.php">Editar Materiales del Servicio</a></li>
          </ul>
        </li>
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
                <li><img src="../images/iconos/reportes.png" style="margin-right:12px;"><a href="../servicios/">Reportes</a>
          <ul>
        <li><a href="../ventas/reporte.php">Reporte de Ventas</a></li>
        <li><a href="../ventas/corte.php">Hacer Corte de Caja</a></li>
          </ul>
        </li>
              </ul>
    </nav>
  </div>
  <div class="clear"></div>
</div>
    </header>
<!-- Content -->
<section id="content">
      <div class="ic">More Website Templates @ TemplateMonster.com. July 23, 2012!</div>
      <div class="container_24">
    <div class="a1">
          <h2>Modificar Producto: </h2>
        </div>
    <div class="wrapper">
          <form id="contact-form" action="index.php" method="get" onSubmit="return validarProducto()">
        <div class="columnaIzquierda"> Codigo de Barras:<br>
              <input id="codigo" name="codigo" type="text" width="150"/>
              <br>
              <br>
              Nombre:<br>
              <input id="nombre" name="nombre" type="text" width="150"/>
              <br>
              <br>
              Descripción:<br>
              <textarea name="descripcion" class="comentarios"></textarea>
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>
              Proveedor:<br>
              <input name="proveedor" type="text" width="150"/>
              <br>
              <br>
              Presentación:<br>
              <input id="unidad" name="unidad" type="text" width="500"/>
              <br>
              <br>
              Imagen:<br>
              <input name="imagen" type="text" width="500"/>
            </div>
        <div class="columnaDerecha">Precio Venta:<br>
              <input id="precio" name="precio_venta" type="text" width="150"/>
              <br>
              <br>
              Cantidad:<br>
              <input id="cantidad" name="cantidad" type="text" width="150"/>
              <br>
              <br>
              <input type="submit" value="Agregar" width="200px"  class="submit"/>
              <br>
              <br>
              </p>
            </div>
      </form>
          <br>
        </div>
  </div>
    </section>
<!-- Footer -->
<footer>
  
    <?php footer(); ?>
    </footer>
</body>
</html>
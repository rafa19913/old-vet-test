<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
<style>
#Imprimes {
}
</style>
</head>
<script language="javascript">

  function imprSelec(nombre)
  {
  
  ////////
  var ficha = document.getElementById(nombre);
  var ventimp = window.open(' ', 'popimpr');

  ventimp.document.write( ficha.innerHTML );
  ventimp.document.close();

  ventimp.print( );
  ventimp.close();

  } 

</script>

<body id="cuerpo">
<div style="width:250px; display:none"> -----------------------------------------
  <center>
    Veterinaria Santa Fé
  </center>
  13 César López de Lara #2646
  Col. Treviño Zapata Cd. Victoria Tamps<br>
  ----------------------------------------- <br>
  Venta Num. <?php echo 123; ?><br>
  Fecha: <?php echo date("Y/m/d H:i:s");; ?><br>
  Atendio: <?php echo "Daniel"; ?> <br>
  Forma de Pago: Contado<br>
<br>

  <table width="250px"  cellspacing="5" bordercolor="#000000">
    <tr>
      <td>#</td>
      <td>Nombre</td>
      <td>Cantidad</td>
      <td>Precio</td>
    </tr>
    <tr>
      <td>123 </td>
      <td>COllar</td>
      <td>20</td>
      <td>$150</td>
    </tr>
  </table>
  Total: $152</div>
<p><a href="javascript:imprSelec('Imprimes')" >Imprimir</a></p>
</body>
</html>

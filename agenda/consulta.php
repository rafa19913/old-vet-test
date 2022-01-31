
<?php 

//creo la clase consulta
	class consulta{
			
	//creo la funcion reportePdf la cual regresara el codigo HTML de una tabla
	// ademas recibe de parametro el filtro por el cual se ejecutara la consulta
	function getHTML(){	
			// agreglo el archivo de conexion
			//include("../funciones/conexion.php");
			// me conecto
			//conectar();	
			
			//creo la variable para generar el codigo
			$html = '
<table id="hoja1" width="95%">
<tr>
<td id="pag1" width="50%">
<img src="../../../images/iconos/NOTA.png"/>
</td>
<td id="pag2" width="50%">
<img src="../../../images/iconos/portada.png"/></td>
</tr>
</table>';
//$html = 'hola';
			//condicion para determinar que tipo de consulta se hara
			
			
			//regreso el codigo html		
     		 return ($html);
		}//funcion reporte
		//-----------------------------------------------------------------------------------------------------------------------		
	}//clse consulta

?>

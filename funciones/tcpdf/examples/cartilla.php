<?php
ini_set('max_execution_time', 60);
// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Veterinaria Santa Fé');
$pdf->SetTitle('Cartilla de Vacunación y Desparasitación');
$pdf->SetSubject('www.veterinariasantafe.com.mx');
$pdf->SetKeywords('Veterinaria Santa Fé');
/*
// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
*/
// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, 10, PDF_MARGIN_RIGHT);
/*
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(50);
*/
// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('dejavusans', '', 10);

// add a page
$pdf->AddPage();

// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)




$pdf->Image(
		$file= '../../../images/iconos/NOTA.png',
		$x = '',
		$y = '',
		$w = 0,
		$h = 0,
		$type = 'PNG',
		$link = '',
		$align = '',
		$resize = false,
		$dpi = 150,
		$palign = '',
		$ismask = false,
		$imgmask = false,
		$border = 0,
		$fitbox = false,
		$hidden = false,
		$fitonpage = false,
		$alt = false );

$pdf->Image(
		$file= '../../../images/iconos/portada.png',
		$x = '170',
		$y = '',
		$w = 100,
		$h = 100,
		$type = 'PNG',
		$link = '',
		$align = '',
		$resize = false,
		$dpi = 150,
		$palign = '',
		$ismask = false,
		$imgmask = false,
		$border = 0,
		$fitbox = false,
		$hidden = false,
		$fitonpage = false,
		$alt = false);

// reset pointer to the last page
$pdf->lastPage();

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
		  

require_once('../../conexion.php');
$conexion = conectar();
/**/
$query = 'select curdate()as hoy, 
m.nombre as mascota,
e.nombre as especie,
r.nombre as raza,
m.sexo,
m.fecha_nacimiento,
m.peso,
c.nombre as cliente,
c.direccion,
c.telefono,
c.celular 

from
mascota m,
cliente c,
especie e,
raza r 
where 
c.id_cliente = m.id_cliente and
m.id_raza = r.id_raza and
r.id_especie = e.id_especie and
m.id_mascota = "' . $_GET['mascota'] . '"';

$dato = $conexion->query($query)->fetch_assoc();

$html = '
<style>
table{
	border:3px solid #00F;
}
td{
height:38px;
border:1px solid #00F;	
}
</style>
<table>
<tr>
<td width="50%"><strong>Inició:</strong><br>
'.$dato['hoy'].'</td>
<td width="50%"><strong>N:</strong><br>
'.$_GET['mascota'].'</td>
</tr>
<tr>
<td width="50%"><strong>Nombre:</strong><br>
'.$dato['mascota'].'</td>
<td width="50%"><strong>Especie:</strong><br>
'.$dato['especie'].'</td>
</tr>
<tr>
<td width="50%"><strong>Raza:</strong><br>
'.$dato['raza'].'</td>
<td width="50%"><strong>Sexo:</strong><br>
'.$dato['sexo'].'</td>
</tr>
<tr>
<td width="50%"><strong>Fecha de Nacimiento:</strong><br>
'.$dato['fecha_nacimiento'].'</td>
<td width="50%"><strong>Peso: </strong>'.$dato['peso'].' Kg.<br>
<strong>Edad: </strong>'.dateDiff($dato['fecha_nacimiento']).'</td>
</tr>
<tr>
<td colspan="2"><strong>Propietario:</strong><br>
'.$dato['cliente'].'</td>
</tr>
<tr>
<td colspan="2"><strong>Domicilio:</strong><br>
'.$dato['direccion'].'</td>
</tr>
<tr>
<td colspan="2"><strong>Telefonos:</strong><br>
'.$dato['telefono'].'  '.$dato['celular'].'</td>
</tr>
</table>
';

// output the HTML content
//$pdf->writeHTML($html, true, false, true, false, '');
$pdf->writeHTMLCell($w=120, $h=0, $x=160, $y=109,$html, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);

// add a page
$pdf->AddPage();
// - - -
// ---------------------------------------------------------


$pdf->Image(
		$file= '../../../images/iconos/huella.jpg',
		$x = '135',
		$y = '20',
		$w = 30,
		$h = 30,
		$type = 'JPEG',
		$link = '',
		$align = '',
		$resize = false,
		$dpi = 150,
		$palign = '',
		$ismask = false,
		$imgmask = false,
		$border = 0,
		$fitbox = false,
		$hidden = false,
		$fitonpage = false,
		$alt = false);

$pdf->Image(
		$file= '../../../images/iconos/huella2.jpg',
		$x = '135',
		$y = '60',
		$w = 30,
		$h = 30,
		$type = 'JPEG',
		$link = '',
		$align = '',
		$resize = false,
		$dpi = 150,
		$palign = '',
		$ismask = false,
		$imgmask = false,
		$border = 0,
		$fitbox = false,
		$hidden = false,
		$fitonpage = false,
		$alt = false);


$pdf->Image(
		$file= '../../../images/iconos/huella.jpg',
		$x = '135',
		$y = '110',
		$w = 30,
		$h = 30,
		$type = 'JPEG',
		$link = '',
		$align = '',
		$resize = false,
		$dpi = 150,
		$palign = '',
		$ismask = false,
		$imgmask = false,
		$border = 0,
		$fitbox = false,
		$hidden = false,
		$fitonpage = false,
		$alt = false);

$pdf->Image(
		$file= '../../../images/iconos/huella2.jpg',
		$x = '135',
		$y = '150',
		$w = 30,
		$h = 30,
		$type = 'JPEG',
		$link = '',
		$align = '',
		$resize = false,
		$dpi = 150,
		$palign = '',
		$ismask = false,
		$imgmask = false,
		$border = 0,
		$fitbox = false,
		$hidden = false,
		$fitonpage = false,
		$alt = false);


$vacunas  = '
<style>
table{
	border:3px solid #00F;
}
td{
height:39px;
border:2px solid #00F;	
}
</style>
<h2>Vacunaciones</h2>
<table >
<tr align="center">
<td><strong>Fecha</strong></td>
<td><strong>Vacuna</strong></td>
<td><strong># de Lote</strong></td>
<td><strong>Fecha Aplicada</strong></td>
</tr>

';

$query = 'select * from ( select a.fecha, v.nombre, a.fecha_realizado from agenda a, vacuna v, historial_vacunas hv
where 
a.id_agenda = hv.id_agenda and
hv.id_vacuna = v.id_vacuna and
a.id_mascota = "' . $_GET['mascota'] . '" order by a.fecha desc limit 5) as tabla order by fecha';

$resulVacunas = $conexion->query($query);

while($vacuna = $resulVacunas->fetch_assoc()){
	$fecha = $vacuna['fecha_realizado'];
	if($fecha == "0000-00-00")
		$fecha = "";
	
	$vacunas = $vacunas . '
	<tr align="center">
	<td>
'.$vacuna['fecha'].'<br>
</td>
	<td>'.$vacuna['nombre'].'</td>
	<td></td>
	<td>'.$fecha.'</td>	
	</tr>
	';
}


for($i = 0 ; $i < 14 - $resulVacunas->num_rows; $i++){

	$vacunas = $vacunas . '
	<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	
	</tr>
	';	
}
$vacunas = $vacunas . '
</table>
';



$desparasitantes  = '
<style>
table{
	border:3px solid #00F;
}
td{
height:39px;
border:2px solid #00F;	
}
</style>
<h2>Desparasitaciones</h2>
<table >
<tr align="center">
<td><strong>Fecha</strong></td>
<td><strong>Desparasitante</strong></td>
<td><strong>Fecha Aplicada</strong></td>
</tr>

';

$query = 'select * from ( select a.fecha, d.nombre, a.fecha_realizado from agenda a, desparasitante d, historial_desparasitaciones hd
where 
a.id_agenda = hd.id_agenda and
hd.id_desparasitante = d.id_desparasitante and
a.id_mascota = "' . $_GET['mascota'] . '" order by a.fecha desc limit 5) as tabla order by fecha';

$resulDes = $conexion->query($query);

while($des = $resulDes->fetch_assoc()){
	$fecha = $des['fecha_realizado'];
	if($fecha == "0000-00-00")
		$fecha = "";
	
	$desparasitantes = $desparasitantes . '
	<tr align="center">
	<td>
'.$des['fecha'].'<br>
</td>
	<td>'.$des['nombre'].'</td>
	<td>'.$fecha.'</td>	
	</tr>
	';
}


for($i = 0 ; $i < 14 - $resulDes->num_rows; $i++){

	$desparasitantes = $desparasitantes . '
	<tr>
	<td></td>
	<td></td>
	<td></td>
	
	</tr>
	';	
}
$desparasitantes = $desparasitantes . '
</table>
';

/**/



$pdf->writeHTMLCell($w=125, $h=0, $x=10, $y=10,$vacunas, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);

$pdf->writeHTMLCell($w=125, $h=0, $x=165, $y=10,$desparasitantes, $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);


//Close and output PDF document
$pdf->Output('example_006.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

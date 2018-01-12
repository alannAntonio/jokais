<?php
require_once('tcpdf_include.php');
$cNumeroBoleta = $_POST["cNumeroBoleta"];
$cRut = $_POST["cRut"];
$cNombre = $_POST["cNombre"];
$cDireccion = $_POST["cDireccion"];
$cMedidor = $_POST["cMedidor"];
$cLecAnterior = $_POST["cLecAnterior"];
$cLecActual = $_POST["cLecActual"];
$cValorKw = $_POST["cValorKw"];
$cConsumoKw = $_POST["cConsumoKw"];
$cUltimaFecha = $_POST["cUltimaFecha"];
$cEmision = $_POST["cEmision"];
$cVencimiento = $_POST["cVencimiento"];
$cCargoFijo = number_format(($_POST["cCargoFijo"]),0,",",".");
$cConsumoDinero = number_format(($_POST["cConsumoDinero"]),0,",",".");
$cSaldoAnterior = number_format(($_POST["cSaldoAnterior"]),0,",",".");
$cCorteRep = number_format(($_POST["cCorteRep"]),0,",",".");
$cIntereses = number_format(($_POST["cIntereses"]),0,",",".");
$cSaldoFavor = number_format(($_POST["cSaldoFavor"]),0,",",".");
$cTotal = number_format(($_POST["cTotal"]),0,",",".");


// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {
	//Page header
	public function Header() {
		// get the current page break margin
		$bMargin = $this->getBreakMargin();
		// get current auto-page-break mode
		$auto_page_break = $this->AutoPageBreak;
		// disable auto-page-break
		$this->SetAutoPageBreak(false, 0);
		// set bacground image
		$img_file = K_PATH_IMAGES.'back.png';
		$this->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
		// restore auto-page-break status
		$this->SetAutoPageBreak($auto_page_break, $bMargin);
		// set the starting point for the page content
		$this->setPageMark();
	}
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(0);
$pdf->SetFooterMargin(0);

// remove default footer
//$pdf->setPrintFooter(false);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/spa.php')) {
	require_once(dirname(__FILE__).'/lang/spa.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 15);

// add a page
$pdf->AddPage();
$pdf->SetLineWidth(0.8);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetDrawColor(8, 158, 147);
$pdf->Rect(110, 12, 88, 28, 'DF');
// Print a text


$pdf->SetTextColor(0,0,0);
$pdf->Text(132, 16, 'R.U.T 7624354-0');
$pdf->Text(131, 22, 'Boleta Electrónica');
$pdf->Text(124.5, 28.5, 'Boleta N° '.$cNumeroBoleta);

$pdf->Image('images/logo.png', 10, 12, 60, '', '', '', '', false, 300);
$pdf->SetFont('helvetica', '', 13);
$pdf->Text(11, 71, 'N° Cliente: '.$cRut);
$pdf->Text(11, 77, $cNombre);
$pdf->Text(11, 83, $cDireccion);
$pdf->Text(11, 89, 'Laguna Verde, Valparaíso');
//$pdf->SetTextColor(255,0,0);
$pdf->SetFont('helvetica', '', 10);
$pdf->SetDrawColor(255, 255, 255);
// ---------------------------------------------------------
$html = '
<style>
.titulos{
	background-color:#089E93;
	color:white;
	border:none;
	text-align:center;
}
.campos{
	color:#089E93;
	text-align:center;
	font-size:13;
}
</style>
<table border="0" cellspacing="4" cellpadding="5" >
<tr>
	<td class="titulos">N° Medidor</td>
	<td class="titulos">Lectura Anterior</td>
	<td class="titulos">Lectura Actual</td>
	<td class="titulos">Valor Kw($)</td>
	<td class="titulos">Consumo Kwh</td>
</tr>
<tr>
	<td class="campos">'.$cMedidor.'</td>
	<td class="campos">'.$cLecAnterior.'</td>
	<td class="campos">'.$cLecActual.'</td>
	<td class="campos">'.$cValorKw.'</td>
	<td class="campos">'.$cConsumoKw.'</td>
</tr>
</table>
';
$pdf->SetTextColor(255,255,255);
$pdf->writeHTML("-", true, false, true, false, '');
$pdf->writeHTML("-", true, false, true, false, '');
$pdf->writeHTML("-", true, false, true, false, '');
$pdf->SetTextColor(0,0,0);
$pdf->writeHTMLCell(150, 15, '', '', $html, 'LRTB', 200, 200, true, 'L', false);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetDrawColor(8, 158, 147);
$pdf->RoundedRect(12, 135, 80, 102, 2, '1111', 'DF');

$pdf->SetTextColor(0,0,0);
$pdf->SetFont('helvetica', '', 14);
$pdf->Text(15, 147, 'Último Pago: '.$cUltimaFecha);
$pdf->Text(15, 154, 'Fecha Emisión: '.$cEmision);
$pdf->Text(15, 161, 'Fecha Vencimiento: '.$cVencimiento);


$html = '
	<style>
	.tabla2{
		border:none;
		font-size:13;

	}
	.tituloInfo{
		font-weight:bold;
	}
	.textoInfo{
		text-align: justify;
	}
	.tabla3{
		border: none;
		left:100;
	}
	.campos{
		color:#089E93;
	}
	.total{
		background-color:#089E93;
		color:white;
		border:none;
	}
	</style>
	<table class="tabla2" cellspacing="10">
		<tr>
			<td class="tituloInfo">Información importante</td>			
		</tr>
		<tr class="textoInfo">
			<td>De acuerdo a la normativa vigente, la reposición del suministro se efectuará dentro de las 24 horas de haberse verificado el pago.
			</td>
		</tr>		
	</table>
';
$pdf->SetTextColor(255,255,255);
$pdf->writeHTML("-", true, false, true, false, '');
$pdf->writeHTML("-", true, false, true, false, '');
$pdf->SetTextColor(0,0,0);
$pdf->writeHTMLCell(72, 50, '', '', $html, 'LRTB', 200, 200, true, 'L', false);

$pdf->SetTextColor(8,158,147);
$pdf->Text(110, 150, 'Cargo Fijo');
$pdf->Text(110, 160, 'Consumo');
$pdf->Text(110, 170, 'Saldo Anterior');
$pdf->Text(110, 180, 'Corte/Reposición');
$pdf->Text(110, 190, 'Intereses');
$pdf->Text(110, 200, 'Saldo a favor');
$pdf->Text(110, 210, 'Gastos Operacionales');
$pdf->Text(170, 150, '$'.$cCargoFijo);
$pdf->Text(170, 160, '$'.$cConsumoDinero);
$pdf->Text(170, 170, '$'.$cSaldoAnterior);
$pdf->Text(170, 180, '$'.$cCorteRep);
$pdf->Text(170, 190, '$'.$cIntereses);
$pdf->Text(170, 200, '$'.$cSaldoFavor);
$pdf->Text(170, 210, '$0');

$pdf->SetFont('helvetica', '', 15);
$pdf->SetTextColor(255,255,255);
$pdf->SetDrawColor(8, 158, 147);
$pdf->SetFillColor(8, 158, 147);
$pdf->RoundedRect(110, 223, 54, 8, 2, '1111', 'DF');
$pdf->RoundedRect(170, 223, 30, 8, 2, '1111', 'DF');
$pdf->Text(113, 224, 'TOTAL');
$pdf->Text(172, 224, '$'.$cTotal);
//Close and output PDF document
//$pdf->Output('example_051.pdf', 'I');


//$pdf->writeHTML("-", true, false, true, false, '');
//$pdf->writeHTMLCell(72, 50, '', '', $html, 'LRTB', 200, 200, true, 'L', false);
// save file
//header('Location: ../../usuario.php');
$hoy = date("Y-m-d");
$hoy = explode("-",$hoy);
//$pdf->Output($_SERVER['DOCUMENT_ROOT'] . '/jokais/'.$cNumeroBoleta.'.pdf', 'F');
$pdf->Output($_SERVER['DOCUMENT_ROOT'] . '/archivo/'.$hoy[0].'/'.$hoy[1].'/'.$cNumeroBoleta.'.pdf', 'F');
//$pdf->Output('example_051.pdf', 'I');
//header('Location: ../../usuario.php');
//============================================================+
// END OF FILE
//============================================================+
?>
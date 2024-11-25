<?php
require('fpdf/fpdf.php');

date_default_timezone_set("America/Argentina/Buenos_Aires"); 

$pdf = new FPDF();
$pdf->AddPage('L');

$pdf->SetFont('Arial', 'B', 18);
$pdf->Cell(0, 30, utf8_decode('Porcentaje de personas por cada localidad'), 0, 1, 'C', 0);


$grafico1 = $_POST['imagen1'];
$img1 = explode(',', $grafico1, 2)[1];  
$pic1 = 'data://text/plain;base64,' . $img1;
$pdf->Image($pic1, 20, 50, 240, 0, 'PNG');


$pdf->Ln(90);
$pdf->AddPage('L');

$pdf->SetFont('Arial', 'B', 18);
$pdf->Cell(0, 30, utf8_decode('Número de publicaciones por profesión'), 0, 1, 'C', 0);

$grafico2 = $_POST['imagen2'];
$img2 = explode(',', $grafico2, 2)[1];  
$pic2 = 'data://text/plain;base64,' . $img2;
$pdf->Image($pic2, 20, 50, 240, 0, 'PNG');


$pdf->Output();
?>

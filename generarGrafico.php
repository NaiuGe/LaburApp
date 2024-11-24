<?php
require('fpdf/fpdf.php');

date_default_timezone_set("America/Argentina/Buenos_Aires"); 

$pdf = new FPDF();

$pdf->AddPage('L');

$pdf->SetFont('Arial', 'B', 18);
$pdf->Cell(0,30,utf8_decode('Porcentaje de personas por cada localidad'),0,1,'C',0);

$grafico = $_POST['imagen']; 

$img = explode(',', $grafico, 2)[1];  

$pic = 'data:text/plain;base64,'. $img;

    $pdf->image($pic,20,50,300,0,'png'); 

    $pdf->Output();
    ?>

<?php 
include("conexion.php");
require('fpdf181/fpdf.php');
session_start();
date_default_timezone_set("America/Mexico_City");
$fecha_actual = date('Y-m-d H:i:s');
$mesero = $_SESSION['u_usuario'];
$mesa= $_GET['mesa'];
$mesa = substr ($mesa,0, strlen($mesa) - 1);//para eliminar el ultimo caracteres agregado en indexM.php
$productos = array();
$query = $conexion->query("SELECT producto FROM ventasactivas WHERE usuario='".$mesero."' AND cuenta='".$mesa."' ");
$resultado = $query->fetch_all();
$total = 0;
//se Empieza a trabar con el pdf
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->Image("shot-bar-logo.png" , 10 ,8, 80 , 25 , "png" ,"http://localhost/BAR/indexM.php");
$pdf->SetFont('Arial','B',15);
$pdf->Cell(30);
$pdf->Ln(30);
$pdf->SetFont('Arial','',15);
$pdf->Cell(0,0,'Mesero: '.$mesero." ",0,0,'L');
$pdf->Ln(10);
$pdf->Cell(0,0,'Mesa: '.$mesa." ",0,0,'L');
$pdf->Ln(5);
$pdf->Cell(40,10,'Fecha y Hora de impresion: ',0,0,'L');
$pdf->Ln();
$pdf->Cell(40,10,''.$fecha_actual.'',0,0,'L');
$pdf->Ln();
$pdf->SetFillColor(132,0,0);
$pdf->SetTextColor(255);
$pdf->Cell(40,10,"Producto",1,0 ,"L" ,true);
$pdf->Cell(40,10,"Precio",1,0,"L" ,true);
$pdf->Ln();
$pdf->SetFillColor(224,235,255);
$pdf->SetTextColor(0);
//ciclo para crear un array con nombre de producto y precio de cada uno segun la mesa y mesero 
foreach($resultado as $name ) {
    $pdf->Cell(40,10,$name[0],1);
    $query2 = $conexion->query("SELECT precio FROM productos WHERE nombre ='$name[0]' ");
    $resultado2 = $query2->fetch_assoc();
    $pdf->Cell(40,10,'$'.$resultado2["precio"].'',1);
    $pdf->Ln();
    $total += (int)$resultado2["precio"];
}
$pdf->Cell(40,10,"Subtotal:",0,0,"R");
$pdf->Cell(40,10,'$'.$total."",1);
$pdf->Ln();
$pdf->Cell(40,10,"IVA(16%):",0,0,"R");
$pdf->Cell(40,10,'$'.($total*.16)."",1);
$pdf->Ln();
$pdf->Cell(40,10,"Total:",0,0,"R");
$pdf->Cell(40,10,'$'.($total+($total*.16))."",1);  
$sql = "UPDATE ventasactivas SET impresa='si' WHERE cuenta='$mesa' ";
$sql2 = "UPDATE mesas SET impresa='si' WHERE mesa='$mesa' ";
mysqli_query($conexion, $sql);
mysqli_query($conexion, $sql2);
echo '<script language="javascript">alert("imprimiendo..");window.location.href="indexM.php"</script>'; 
$pdf->Output("D","Mesa:".$mesa."_".$fecha_actual.".pdf",true);  


 ?>
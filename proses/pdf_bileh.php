<?php
session_start();
include "koneksi.php";
require "../tcpdf/tcpdf.php";


$pdf = new TCPDF("P","cm","A4");

$pdf->SetMargins(0.5,1,1);
$pdf->AddPage();
$pdf->SetFont('times','B',10);
$pdf->Cell(25.5,0.2,"LAPORAN PRODUKSI",0,10,'L');
$pdf->ln(0.3);
$pdf->SetFont('times','',10);
$pdf->Cell(2,0.7,"Tanggal Cetak : ".date('d-m-Y h:i:s')." || Dicetak Oleh : ".$_SESSION['username'],0,0,'L');


// $tampil_hasil = mysqli_query($conn, "SELECT * FROM data_training");

if(empty($_GET['inputmulai']) or empty($_GET['inputsampai'])){
    $select = mysqli_query($conn, "SELECT * FROM data_training WHERE kode_produk = 'B02'");
    $label = 'Seluruh Data';
} else{
    $start = $_GET['inputmulai'];
    $to = $_GET['inputsampai'];
    $select = mysqli_query($conn, "SELECT * FROM data_training WHERE periode  BETWEEN '$start 00:00:00' AND '$to 00:00:00' AND kode_produk = 'B02'");
    $label = 'Periode Tanggal '."$start".' s.d. '.$to;
}


$pdf->ln(1);
$pdf->SetFont('times','B',10);
$pdf->Cell(1, 0.7, 'No', 1, 0, 'C');
$pdf->Cell(3, 0.7, 'Kode Produk', 1, 0, 'C');
$pdf->Cell(3, 0.7, 'Nama Produk', 1, 0, 'C');
$pdf->Cell(3, 0.7, 'Periode', 1, 0, 'C');
$pdf->Cell(3, 0.7, 'Permintaan', 1, 0, 'C');
$pdf->Cell(3, 0.7, 'Persedian', 1, 0, 'C');
$pdf->Cell(3, 0.7, 'Produksi', 1, 1, 'C');
$pdf->SetFont('times','',8);
$no=1;	
while($r3=mysqli_fetch_array($select)){
	
	$pdf->Cell(1, 0.6, $no , 1, 0, 'C');
	$pdf->Cell(3, 0.6, $r3['kode_produk'], 1, 0,'C');
	$pdf->Cell(3, 0.6, $r3['nama_produk'], 1, 0,'C');
	$pdf->Cell(3, 0.6, $r3['periode'], 1, 0,'C');
	$pdf->Cell(3, 0.6, $r3['permintaan'], 1, 0,'C');
	$pdf->Cell(3, 0.6, $r3['persediaan'], 1, 0,'C');
	$pdf->Cell(3, 0.6, $r3['produksi'], 1, 1,'C');
	$no++;
}


$pdf->Output("Laporan_Prediksi.pdf","I");

?>


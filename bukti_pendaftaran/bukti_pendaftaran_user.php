<?php 
define('FPDF_FONTPATH', 'fpdf/font/');
require('fpdf/fpdf.php');

include "../config/koneksi.php";
include "../config/library.php";

$sql = mysql_query("SELECT * FROM pendaftaran,sekolah WHERE pendaftaran.asal_sekolah=sekolah.id_sekolah AND id_pendaftaran='$_GET[no_pendaftaran]'");

$i=0;
while($r=mysql_fetch_array($sql)){
$lahir   = tgl_indo($r['tgl_lahir']);

$pdf=new FPDF('P','mm','A5');
$pdf->AddPage();
$pdf->SetFont('Arial','',9);
//ambil Gambar Header
$pdf->Image("../images/sukses.jpg", 10, 3, '130', 'left');
//Judul Laporan PDF
$pdf->SetFont('Arial','B','11');
$pdf->Cell(130,80,'BUKTI PENDAFTARAN PPDB ONLINE',0,0,'C');

$pdf->Ln(50);
$pdf->SetFont('Arial','',7);
$pdf->Cell(50,10,'No Pendaftaran',1,0,'L');
$pdf->Cell(4,10,':',1,0,'L');
$pdf->Cell(70,10,'PPDB/',1,0,'L'); $pdf->text(78,66.3,$r['id_pendaftaran'],1,0,'L'); $pdf->text(84,66.3,'/2014',1,0,'L');
$pdf->Ln();
$pdf->Cell(50,10,'Nama',1,0,'L');
$pdf->Cell(4,10,':',1,0,'L');
$pdf->Cell(70,10,$r['nama'],1,0,'L');

$pdf->Ln();
$pdf->Cell(50,10,'Tempat Lahir',1,0,'L');
$pdf->Cell(4,10,':',1,0,'L');
$pdf->Cell(70,10,$r['tempat'],1,0,'L');

$pdf->Ln();
$pdf->Cell(50,10,'Tanggal Lahir',1,0,'L');
$pdf->Cell(4,10,':',1,0,'L');
$pdf->Cell(70,10,$lahir ,1,0,'L');

$pdf->Ln();
$pdf->Cell(50,10,'Jenis Kelamin',1,0,'L');
$pdf->Cell(4,10,':',1,0,'L');
$pdf->Cell(70,10,$r['jenis_kelamin'],1,0,'L');

$pdf->Ln();
$pdf->Cell(50,10,'Agama',1,0,'L');
$pdf->Cell(4,10,':',1,0,'L');
$pdf->Cell(70,10,$r['agama'],1,0,'L');

$pdf->Ln();
$pdf->Cell(50,10,'Asal Sekolah',1,0,'L');
$pdf->Cell(4,10,':',1,0,'L');
$pdf->Cell(70,10,$r['nama_sekolah'],1,0,'L');

$pdf->Ln();
$pdf->Cell(50,10,'Email',1,0,'L');
$pdf->Cell(4,10,':',1,0,'L');
$pdf->Cell(70,10,$r['email'],1,0,'L');

$pdf->Ln();
$pdf->Cell(50,10,'Alamat',1,0,'L');
$pdf->Cell(4,10,':',1,0,'L');
$pdf->Cell(70,10,$r['alamat'],1,0,'L');

$pdf->Ln();
$pdf->Cell(50,10,'Nama Wali',1,0,'L');
$pdf->Cell(4,10,':',1,0,'L');
$pdf->Cell(70,10,$r['wali'],1,0,'L');

$pdf->Ln();
$pdf->Cell(50,10,'No Telp',1,0,'L');
$pdf->Cell(4,10,':',1,0,'L');
$pdf->Cell(70,10,$r['telp'],1,0,'L');
$pdf->Ln(9);
$pdf->Text(10,200,'Dicetak pada tanggal: ' . date( 'd-m-Y, H:i:s'),1,0,'L');
}

$pdf->Output(); 
?>
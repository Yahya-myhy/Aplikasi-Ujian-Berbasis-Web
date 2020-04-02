<?php 
define('FPDF_FONTPATH', 'fpdf/font/');
require('fpdf/fpdf.php');

include "../config/koneksi.php";
include "../config/library.php";
$pdf=new FPDF('L','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
//ambil Gambar Header
$pdf->Image("../images/logo.jpg", 10, 3, '80', 'left');
//Judul Laporan PDF
$pdf->SetFont('Arial','B','18');
$pdf->Cell(280,20,'Daftar Calon Siswa Jalur PPDB Online',0,0,'C');

$pdf->Ln(20);

$pdf->SetFont('Arial','B','8');
$pdf->SetFillColor(192,192,192); // Warna sel tabel header
$pdf->Cell(25,8,'No Pendaftaran',1,0,'C', 1);
$pdf->Cell(50,8,'Nama',1,0,'C', 1);
$pdf->Cell(50,8,'Tempat & Tgl Lahir',1,0,'C', 1);
$pdf->Cell(70,8,'Alamat',1,0,'C', 1);
$pdf->Cell(40,8,'Asal Sekolah',1,0,'C', 1);
$pdf->Cell(35,8,'No Telp',1,0,'C', 1);



$sql = mysql_query("SELECT * FROM pendaftaran,sekolah WHERE pendaftaran.asal_sekolah=sekolah.id_sekolah ORDER BY id_pendaftaran");
$no = 1;
while($r=mysql_fetch_array($sql)){
  $lahir   = tgl_indo($r['tgl_lahir']);
  
  $cell[0]=$r['nama'];
  $cell[1]=$r['tempat'];
  $cell[2]=$r['tgl_lahir'];
  $cell[3]=$r['alamat'];
  $cell[4]=$r['wali'];
  $cell[5]=$r['telp'];
 	$no++;
  $pdf->Ln();
  $pdf->Cell(25,7,'PPDB/',1,0,'L'); $pdf->Cell(-25,7,$r['id_pendaftaran'],0,0,'C'); $pdf->Cell(38,7,'/2014',0,0,'C'); $pdf->Cell(-13,7,'',0,0,'C');
  $pdf->Cell(50,7,$r['nama'],1,0,'L');
  $pdf->Cell(50,7,$r['tempat'],1,0,'L'); $pdf->Cell(-30,7,$lahir,0,0,'C');$pdf->Cell(30,7,'',0,0,'C');
  $pdf->Cell(70,7,$r['alamat'],1,0,'L');
  $pdf->Cell(40,7,$r['nama_sekolah'],1,0,'L');
  $pdf->Cell(35,7,$r['telp'],1,0,'L');
}

$pdf->Output(); 
?>
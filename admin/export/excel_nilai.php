<?php 
include "../../config/koneksi.php";
include "../../config/library.php";
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
   header('location: index.php');
}
else{
$rujian = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM ujian WHERE id_ujian='$_GET[ujian]'"));
$rkelas = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM kelas WHERE id_kelas='$_GET[kelas]'"));

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Nilai-$rujian[nama_mapel]-$rkelas[nama_kelas].xls");
echo '<table border="all">
<tr>
<td> no</td>
<td> NIS</td>
<td>Nama</td>
	<td>Benar</td>
	<td>Salah</td>
	<td>Kosong</td>
	<td>NILAI</td>
	</tr>';
$tampil = mysqli_query($mysqli, "SELECT * FROM siswa WHERE id_kelas='$_GET[kelas]' ORDER BY nama_lengkap ASC");
    $no = 1;
    while($r=mysqli_fetch_array($tampil)){
   $nli = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM nilai WHERE id_ujian='$_GET[ujian]' AND nis ='$r[nis]'"));
echo ' <tr>
<td >'.$no.'</td>
                <td>'.$r['nis'].'</td>
				<td>'.$r['nama_lengkap'].'</td>
	            <td>'.$nli['jml_benar'].'</td>
				<td>'.$nli['jml_salah'].'</td>
				<td>'.$nli['jml_kosong'].'</td>
				<td>'.$nli['nilai'].'	</td>
				</tr>';
$no++;
}
echo '</table>';
    }
	
    ?>

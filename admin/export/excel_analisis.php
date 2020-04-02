
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
header("Content-Disposition: attachment; filename=Analisis-$rujian[nama_mapel]-$rkelas[nama_kelas].xls");

$sql  = mysqli_query($mysqli,  "SELECT * FROM soal WHERE id_ujian='$_GET[ujian]' ORDER BY id_soal ASC ");
$jmlsoal = mysqli_num_rows($sql);
echo '<table border="all">
<tr>
<td rowspan="2" width="64">No</td>
    <td rowspan="2" width="64">Nis</td>
    <td rowspan="2" width="64">Nama</td>
	 <td rowspan="2" width="64">Nilai</td>
    <td width="64">Soal</td>';
for($s=0; $s<$jmlsoal; $s++){
$si = $s + 1;
echo '
<td width="64">'.$si.'</td>';
}
echo '
</tr><tr><td>Kunci</td>';


while($r = mysqli_fetch_array($sql)){
$arr_huruf = array("0","A","B","C","D","E");
echo '
<td> '.$arr_huruf[$r['kunci']].'</td>';
}


echo '
</tr>';
$query = mysqli_query($mysqli,  "SELECT * FROM siswa WHERE id_kelas='$_GET[kelas]' ORDER BY nama_lengkap ASC");
$no = 1;
while($r = mysqli_fetch_array($query)){
	$n = mysqli_fetch_array(
mysqli_query($mysqli,  "SELECT * FROM nilai WHERE nis='$r[nis]' AND id_ujian='$_GET[ujian]'"));

echo '<tr>
<td> '.$no.'</td>
<td> '.$r['nis'].'</td>
<td> '.$r['nama_lengkap'].'</td>
<td> '.$n['nilai'].'</td><td>jawaban</td>';
$ana = mysqli_query($mysqli,  "SELECT * FROM analisis WHERE nis='$r[nis]' AND id_ujian='$_GET[ujian]' ORDER BY id_soal ASC");
while($an = mysqli_fetch_array($ana)){
$arr_huruf = array("Kosong","A","B","C","D","E");	
echo'<td>'.$arr_huruf[$an['jawaban']].'</td>';
}

echo'</tr>';
$no++;
}
echo '</table>';
    }
	
    ?>

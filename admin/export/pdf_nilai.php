<?php 
include "../../berangkas/koneksi/config.php";
include "../../berangkas/koneksi/library.php";
$rujian = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM ujian WHERE id_ujian='$_GET[ujian]'"));
$rkelas = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM kelas WHERE id_kelas='$_GET[kelas]'"));

echo '<table border="all">
<tr>
<td>No</td>
<td>NIK</td>
<td>Nama</td>
	<td>TWK</td>
	<td>TIU</td>
	<td>TKP</td>
	<td>Jumlah Nilai</td>
	</tr>';
$tampil = mysqli_query($mysqli, "SELECT * FROM users WHERE id_kelas='$_GET[kelas]' ORDER BY nama_lengkap ASC");
$no = 1;
while($r=mysqli_fetch_array($tampil)){
$nilai = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM nilai WHERE id_ujian ='$_GET[ujian]' AND nik ='$r[nik]'"));
echo ' <tr>
<td >'.$no.'</td>
                <td>'.$r['nik'].'</td>
				<td>'.$r['nama_lengkap'].'</td>
	            <td>'.$nilai['twk'].'</td>
				<td>'.$nilai['tiu'].'</td>
				<td>'.$nilai['tkp'].'</td>
				<td>'.$nilai['nilai'].'</td>
				</tr>';
$no++;
}
echo '</table>';
    
	
require_once('../../assets/html2pdf/html2pdf.class.php');
$content = ob_get_clean();
$html2pdf = new HTML2PDF('P','A4','en');
$html2pdf->WriteHTML($content);
$html2pdf->Output('NILAI.pdf');
    ?>

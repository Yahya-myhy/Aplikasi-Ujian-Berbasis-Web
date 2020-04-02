<?php
session_start();
ob_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
   header('location: index.php');
}
else{
	if($_SESSION['leveluser']=='admin user'){
?>
<html>
<head>
   <style type="text/css">
      .box{
         border: 1px solid #000;
      }
      .header td{
         border-bottom: 1px solid #000;
      }
      .box td{
         padding: 5px 10px;
      }
   </style>
</head>
<body>

<?php
include "../../config/koneksi.php";
$identitas = mysqli_query($mysqli,"SELECT * FROM identitas WHERE id_identitas='1'");
$data = mysqli_fetch_array($identitas);
	

if($_GET['lv']=='guru'){
$query = mysqli_query($mysqli, "select * from users where level='$_GET[lv]' AND sekolah='$_SESSION[sekolah]'");
$no = 1;
echo "<table width='100%' cellspacing='20'><tr>";
while($r = mysqli_fetch_array($query)){
   $password = substr(md5($r['nik']), 0, 5);
   echo"<td class='box' width='335'>

<table width='100%' style='width: 330px' cellspacing='0'>
   
<tr class='header'>
   <td width='60' align='center'>
     <img src='../../images/$data[gambar]' width='60' height='20'>
   </td>
   <td width='130' align='center' valign='middle' style='padding: 5px 30px;'>
   <b>KARTU Login Guru</b>
   </td>
</tr>
				
<tr><td>Nama</td><td>: $r[nama_lengkap]</td></tr>
<tr><td>Pengajar</td><td>: $r[pelajaran]</td></tr>
<tr><td>NIK</td><td>: <b>$r[nik]</b></td></tr>
<tr><td>Password</td><td>: <b>$r[paas]</b></td></tr>

</table>

</td>";

  if($no%2==0) echo "</tr><tr>";
  $no++;

}
echo "</tr></table>";
}

elseif ($_GET['lv']=='siswa') {
$query = mysqli_query($mysqli,"select * from siswa where level='$_GET[lv]' AND id_kelas='$_GET[kelas]' AND  sekolah='$_SESSION[sekolah]'");
$no = 1;
	echo "<table width='100%' cellspacing='20'><tr>";
while($r = mysqli_fetch_array($query)){
   $password = substr(md5($r['nis']), 0, 5);
   $siswa = mysqli_fetch_array(mysqli_query($mysqli, "select * from kelas where id_kelas='$r[id_kelas]'"));
		
   echo"<td class='box' width='335'>

<table width='100%' style='width: 330px' cellspacing='0'>
   
<tr class='header'>
   <td width='60' align='center'>
     <img src='../../images/$data[gambar]' width='60' height='20'>
   </td>
   <td width='130' align='center' valign='middle' style='padding: 5px 30px;'>
   <b>KARTU PESERTA UJIAN</b>
   </td>
</tr>
				
<tr><td>Nama</td><td>: $r[nama_lengkap]</td></tr>
<tr><td>kelas</td><td>: $siswa[nama_kelas]</td></tr>
<tr><td>NIS</td><td>: <b>$r[nis]</b></td></tr>
<tr><td>Password</td><td>: <b>$password</b></td></tr>

</table>

</td>";

  if($no%2==0) echo "</tr><tr>";
  $no++;

}
echo "</tr></table>";
	}
?>

</body>
</html>

<?php
require_once('../../assets/html2pdf/html2pdf.class.php');
$content = ob_get_clean();
$html2pdf = new HTML2PDF('P','A4','en');
$html2pdf->WriteHTML($content);
$html2pdf->Output('kartu.pdf');
}
 else {

	include 'hakakses.php';
   } 
    }
	
    ?>


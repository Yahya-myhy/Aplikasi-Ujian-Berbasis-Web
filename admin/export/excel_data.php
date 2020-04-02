<?php 
include "../../config/koneksi.php";
include "../../config/library.php";
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
   header('location: index.php');
}
else{

$users = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM users WHERE sekolah='$_SESSION[sekolah]'"));

if($_GET['lv']=='guru'){
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=DATAGURU.xls");
echo '<table border="all">
<tr>
<td> no</td>
<td> NIK</td>
<td>Nama</td>
<td>Password</td>
	<td>Pelajaran</td>
	<td>No HP</td>
	<td>alamat</td>
	<td>Lulusan</td>
	</tr>';
$tampil = mysqli_query($mysqli, "SELECT * FROM users WHERE level='$_GET[lv]' AND sekolah ='$_SESSION[sekolah]' ORDER BY nama_lengkap ASC");
    $no = 1;
    while($r=mysqli_fetch_array($tampil)){
echo ' <tr>
<td >'.$no.'</td>
                <td>'.$r['nik'].'</td>
                <td>'.$r['nama_lengkap'].'</td>
				<td>'.$r['paas'].'</td>
	            <td>'.$r['pelajaran'].'</td>
				<td>'.$r['hp'].'</td>
				<td>'.$r['alamat'].'</td>
				<td>'.$r['lulusan'].'
				</td>
				</tr>';
$no++;
}
echo '</table>';
    }

elseif($_GET['lv']=='siswa'){
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=DATASISWA.xls");
echo '<table border="all">
<tr>
<td> no</td>
<td> NIS</td>
<td> Password</td>
<td>Nama</td>
	<td>Alamat</td>
	<td>No HP</td>
	<td>Kelas</td>
	<td>Wali</td>
	</tr>';
$tampil = mysqli_query($mysqli, "SELECT * FROM siswa WHERE level='siswa' AND sekolah='$_SESSION[sekolah]' ORDER BY nama_lengkap ASC");
    $no = 1;
    while($r=mysqli_fetch_array($tampil)){
		$password = substr(md5($r['nis']), 0, 5);
   $kelas = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM kelas WHERE id_kelas='$r[id_kelas]'"));
echo ' <tr>
<td >'.$no.'</td>
                <td>'.$r['nis'].'</td>
				<td>'.$password.'</td>
                <td>'.$r['nama_lengkap'].'</td>
	            <td>'.$r['alamat'].'</td>
				<td>'.$r['hp'].'</td>
				<td>'.$kelas['nama_kelas'].'</td>
				<td>'.$r['wali'].'
				</td>
				</tr>';
$no++;
}
echo '</table>';
    }
	
	elseif($users['id_kelas']= $_GET['kelas']){

$rkelas = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM kelas WHERE id_kelas='$_GET[kelas]'"));
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=DATASISWA.xls");
echo '<table border="all">
<tr>
<td> no</td>
<td> NIS</td>
<td>Nama</td>
	<td>Alamat</td>
	<td>No HP</td>
	<td>Kelas</td>
	<td>Wali</td>
	</tr>';
$tampil = mysqli_query($mysqli, "SELECT * FROM siswa WHERE level='siswa' AND id_kelas='$_GET[kelas]' ORDER BY nama_lengkap ASC");
    $no = 1;
    while($r=mysqli_fetch_array($tampil)){

   $kelas = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM kelas WHERE id_kelas='$r[id_kelas]'"));
echo ' <tr>
<td >'.$no.'</td>
                <td>'.$r['nis'].'</td>
                <td>'.$r['nama_lengkap'].'</td>
	            <td>'.$r['alamat'].'</td>
				<td>'.$r['hp'].'</td>
				<td>'.$kelas['nama_kelas'].'</td>
				<td>'.$r['wali'].'
				</td>
				</tr>';
$no++;
}
echo '</table>';
    }
	
	}
    ?>

<?php
session_start();
include "../config/koneksi.php";

$email = $_POST['email'];
$nama = $_POST['nama'];
$hp = $_POST['hp'];
$sekolah = $_POST['sekolah'];

$cekuser = mysqli_query($mysqli,"SELECT * FROM users WHERE email='$email'");
$ceksekolah = mysqli_query($mysqli,"SELECT * FROM users WHERE sekolah='$sekolah'");
$jmluser = mysqli_num_rows($cekuser);
$jmlsekolah = mysqli_num_rows($ceksekolah);
$data = mysqli_fetch_array($cekuser);

if($jmluser < 1){
	if($jmlsekolah < 1){

	$id= md5($hp);
 $password = md5($_POST['password']);
    mysqli_query($mysqli,"INSERT INTO users(email, password, nama_lengkap, level, nik, id_session, sekolah, hp, tingkat,paas)
									VALUES('$email', '$password', '$_POST[nama]','admin user', '$_POST[nik]','$id', '$_POST[sekolah]', '$_POST[hp]', '$_POST[tingkat]','$_POST[password]')");
	
	 echo "ok";
	} else {
		
	echo "Nama Sekolah<b>$data[sekolah] sudah terdaftar</b>";	
		
	}
   
}else{
   echo "$data[email]  sudah terdaftar untuk Sekolah<b>$data[sekolah]</b>";
}
?>

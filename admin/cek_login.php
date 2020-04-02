<?php
session_start();
include "../config/koneksi.php";
include "../config/function_antiinjection.php";
$email = antiinjeksi($_POST['email']);
$password = antiinjeksi(md5($_POST['password']));

$cekuser = mysqli_query($mysqli,"SELECT * FROM users WHERE email='$email' AND password='$password' AND blokir='N'");
$jmluser = mysqli_num_rows($cekuser);
$data = mysqli_fetch_array($cekuser);
if($jmluser > 0){
    $_SESSION['namauser']      = $data['email'];
	$_SESSION['username']      = $data['email'];
	$_SESSION['id_user']      = $data['id_user'];
     $_SESSION['namalengkap']  = $data['nama_lengkap'];
     $_SESSION['passuser']     = $data['password'];
     $_SESSION['sessid']       = $data['id_session'];
     $_SESSION['kelas']        = $data['id_kelas'];
	 $_SESSION['leveluser']    = $data['level'];
	  $_SESSION['sekolah']    = $data['sekolah'];
	   $_SESSION['tingkat']    = $data['tingkat'];
	  $_SESSION['foto']        = $data['foto'];

     echo "ok";
   
}else{
   echo "<b>Username</b> atau <b>password</b> tidak terdaftar Atau Salah!";
}
?>
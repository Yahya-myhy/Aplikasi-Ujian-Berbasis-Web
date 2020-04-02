<?php
session_start();
include "../config/koneksi.php";
include "../library/function_antiinjection.php";

$username = $_POST['username'];
$password = md5($_POST['password']);

$cekuser = mysqli_query($mysqli, "SELECT * FROM siswa WHERE nis='$username' AND password='$password'");
$jmluser = mysqli_num_rows($cekuser);
$data = mysqli_fetch_array($cekuser);
if($jmluser > 0){
   if($data['status'] == "OFF"){
 
     $_SESSION['username']     = $data['nis'];
	 $_SESSION['foto']    		 = $data['foto'];
     $_SESSION['namalengkap']  = $data['nama_lengkap'];
     $_SESSION['password']     = $data['password'];
     $_SESSION['nis']          = $data['nis'];
     $_SESSION['kelas']        = $data['id_kelas'];
	 $_SESSION['tingkat']        = $data['tingkat'];
	 $_SESSION['sekolah']        = $data['sekolah'];

     mysqli_query($mysqli,"UPDATE siswa SET status='login' WHERE nis='$data[nis]'");
     echo "ok";
   }else{
      echo "Sebelumnya Anda Melakukan Kesalahan. Hubungi guru untuk mereset User Siswa!";
   }
}else{
   echo "<b>Username</b> atau <b>password</b> tidak terdaftar!";
}
?>
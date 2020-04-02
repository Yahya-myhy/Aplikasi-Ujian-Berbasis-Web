<?php
session_start();


if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../config/koneksi.php";
include "../../../config/library.php";
include "../../../config/fungsi_thumb.php";
include "../../../config/fungsi_seo.php";

$module=$_GET[module];
$act=$_GET[act];


// Input Guru
if ($module=='guru' AND $act=='input'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 

 $cekuser = mysqli_query($mysqli, "SELECT * FROM users WHERE nik='$_POST[nik]' OR email = '$_POST[email]'");
$jmluser = mysqli_num_rows($cekuser);
 
 $id= md5($_POST[nik]);
 $password = md5(substr(md5($_POST[nik]),0,5));
 $pann = substr(md5($_POST[nik]), 0, 5);
if ($jmluser<1){
	  if (empty($lokasi_file)){
		  mysqli_query($mysqli, "INSERT INTO users(email, password, nama_lengkap, level, blokir, nik, walikelas, id_kelas, id_session, sekolah,tingkat,paas,tentang, hp, pelajaran)
									VALUES('$_POST[email]', '$password', '$_POST[nama]', 'guru', 'N', '$_POST[nik]', '$_POST[wali]' ,'$_POST[kelas]', '$id', '$_SESSION[sekolah]','$_SESSION[tingkat]','$pann', '$_POST[tentang]', '$_POST[hp]', '$_POST[pelajaran]')");
 } else {
		  
	UploadUser($nama_file_unik);
   mysqli_query($mysqli, "INSERT INTO users(email, password, nama_lengkap, foto, level, blokir, nik, walikelas, id_kelas, id_session, sekolah,tingkat,paas,tentang, hp, pelajaran)
									VALUES('$_POST[email]', '$password', '$_POST[nama]', '$nama_file_unik', 'guru', 'N', '$_POST[nik]', '$_POST[wali]' ,'$_POST[kelas]', '$id', '$_SESSION[sekolah]','$_SESSION[tingkat]', '$pann','$_POST[tentang]', '$_POST[hp]', '$_POST[pelajaran]')");
 
									}
 
  header('location:../../media.php?module='.$module);
  }
  else {
	 header('location:../../media.php?module=guru&act=eror');
	  }
}
// Update Guru
elseif ($module=='guru' AND $act=='update'){
 $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 
	 // Apabila gambar tidak diganti
  if (empty($lokasi_file)){

   mysqli_query($mysqli, "UPDATE users SET 	email = '$_POST[email]', 
   									nama_lengkap = '$_POST[nama]',
									walikelas = '$_POST[wali]',
									id_kelas = '$_POST[kelas]',
									blokir = '$_POST[blokir]',
									tentang = '$_POST[tentang]',
 									hp = '$_POST[hp]', 
									pelajaran = '$_POST[pelajaran]'
									WHERE nik   = '$_POST[id]'");
 
  header('location:../../media.php?module='.$module);
  }
  else{
    $data_gambar = mysqli_query($mysqli, "SELECT foto FROM users WHERE nik='$_POST[id]'");
	$r    	= mysqli_fetch_array($data_gambar);
	@unlink('../../../foto_user/'.$r['foto']);
	@unlink('../../../foto_user/'.'small_'.$r['foto']);
	 UploadUser($nama_file_unik);
	
  
   mysqli_query($mysqli, "UPDATE users SET 	email = '$_POST[email]', 
   									nama_lengkap = '$_POST[nama]',
									walikelas = '$_POST[wali]',
									id_kelas = '$_POST[kelas]',
									blokir = '$_POST[blokir]',
									tentang = '$_POST[tentang]',
 									hp = '$_POST[hp]', 
									pelajaran = '$_POST[pelajaran]',
									foto     = '$nama_file_unik'
									WHERE nik   = '$_POST[id]'");
 
  header('location:../../media.php?module='.$module);
  }

}

// Input kelas 
elseif ($module=='siswa' AND $act=='kelasinput'){

 $cekuser = mysqli_query($mysqli, "SELECT * FROM kelas WHERE nama_kelas='$_POST[nama]' AND sekolah='$_SESSION[sekolah]'");
$jmluser = mysqli_num_rows($cekuser);
if ($jmluser<1){
   mysqli_query($mysqli, "INSERT INTO kelas(nama_kelas, sekolah, tingkat)
									VALUES('$_POST[nama]','$_SESSION[sekolah]','$_POST[tingkat]')");
  header('location:../../media.php?module='.$module);
  }
  else {
	 header('location:../../media.php?module=guru&act=eror');
	  }
}

// update kelas 
elseif ($module=='siswa' AND $act=='kelasedit'){

   mysqli_query($mysqli, "UPDATE kelas SET 	tingkat = '$_POST[tingkat]', 
   									nama_kelas = '$_POST[nama]'
									WHERE id_kelas   = '$_POST[id]'");

 header('location:../../media.php?module='.$module);
}

// Hapus kelas 
elseif ($module=='siswa' AND $act=='kelashapus'){

mysqli_query($mysqli, "DELETE FROM kelas WHERE id_kelas='$_GET[id]'");
mysqli_query($mysqli, "DELETE FROM siswa WHERE id_kelas='$_GET[id]'");
mysqli_query($mysqli, "DELETE FROM nilai WHERE kelas='$_GET[id]'");

 header('location:../../media.php?module='.$module);
}

// Input Siswa
if ($module=='siswa' AND $act=='siswainput'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 

 $cekuser = mysqli_query($mysqli, "SELECT * FROM siswa WHERE nis='$_POST[nis]' OR email = '$_POST[email]'");
$jmluser = mysqli_num_rows($cekuser);
 $id= md5($_POST[nis]);
 $password = md5(substr(md5($_POST[nis]),0,5));
if ($jmluser<1){
	if (empty($lokasi_file)){
	mysqli_query($mysqli, "INSERT INTO siswa(email, password, nama_lengkap, level, id_kelas, nis, id_session,status,sekolah,tingkat,alamat, tentang, hp, wali)
									VALUES('$_POST[email]', '$password', '$_POST[nama]', 'siswa', '$_POST[kelas]', '$_POST[nis]', '$id','OFF', '$_SESSION[sekolah]','$_SESSION[tingkat]','$_POST[alamat]','$_POST[tentang]','$_POST[hp]', '$_POST[wali]')");	
		
	}else {
	UploadUser($nama_file_unik);
   mysqli_query($mysqli, "INSERT INTO siswa(email, password, nama_lengkap, foto, level, id_kelas, nis, id_session,status,sekolah,tingkat,alamat, tentang, hp, wali)
									VALUES('$_POST[email]', '$password', '$_POST[nama]', '$nama_file_unik', 'siswa', '$_POST[kelas]', '$_POST[nis]', '$id','OFF', '$_SESSION[sekolah]','$_SESSION[tingkat]','$_POST[alamat]','$_POST[tentang]','$_POST[hp]', '$_POST[wali]')");
	
	}
	
  header('location:../../media.php?module='.$module.'&act=daftarsiswa&id='.$_POST[kelas]);
  }
  else {
	 header('location:../../media.php?module=guru&act=eror');
	  }
}

// Update Siswa
elseif ($module=='siswa' AND $act=='update'){
 $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 
	 // Apabila gambar tidak diganti
  if (empty($lokasi_file)){


 mysqli_query($mysqli, "UPDATE siswa SET 	email = '$_POST[email]', 
 								nama_lengkap = '$_POST[nama]',
								id_kelas = '$_POST[kelas]',
								tentang = '$_POST[tentang]',
 									alamat = '$_POST[alamat]',
									id_kelas = '$_POST[kelas]',
 									hp = '$_POST[hp]', 
									wali = '$_POST[wali]'
									WHERE nis = '$_POST[id]'");
 
  header('location:../../media.php?module='.$module);

  }
else{
    $data_gambar = mysqli_query($mysqli, "SELECT foto FROM users WHERE nik='$_POST[id]'");
	$r    	= mysqli_fetch_array($data_gambar);
	@unlink('../../../foto_user/'.$r['foto']);
	@unlink('../../../foto_user/'.'small_'.$r['foto']);
	 UploadUser($nama_file_unik);
	 
  
mysqli_query($mysqli, "UPDATE siswa SET 	email = '$_POST[email]', 
 								nama_lengkap = '$_POST[nama]',
								id_kelas = '$_POST[kelas]',
								tentang = '$_POST[tentang]',
 								alamat = '$_POST[alamat]',
								id_kelas = '$_POST[kelas]',
 								hp = '$_POST[hp]', 
								wali = '$_POST[wali]',
								foto = '$nama_file_unik'
									WHERE nis = '$_POST[id]'");
 
  header('location:../../media.php?module='.$module);
}

}
// Hapus Siswa
elseif ($module=='siswa' AND $act=='siswahapus'){

mysqli_query($mysqli, "DELETE FROM siswa WHERE id_session='$_GET[id]'");
mysqli_query($mysqli, "DELETE FROM nilai WHERE id_session='$_GET[id]'");
 
  header('location:../../media.php?module=siswa&act=daftarsiswa&id='.$_GET[kelas]);
}
}
?>

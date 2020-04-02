<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../config/koneksi.php";
include "../../../config/fungsi_thumb.php";

$module=$_GET[module];
$act=$_GET[act];

// Update identitas
if ($module=='identitas' AND $act=='update'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];

  // Apabila ada gambar yang diupload
  if (empty($lokasi_file)){
    
    mysqli_query($mysqli, "UPDATE identitas SET nama_website   = '$_POST[nama_website]'  
                                WHERE id_identitas   = '$_POST[id]'");
  }
  else{
  UploadFavicon($nama_file);
    mysqli_query($mysqli, "UPDATE identitas SET nama_website   = '$_POST[nama_website]',
	                                       gambar       = '$nama_file'   
                                WHERE id_identitas   = '$_POST[id]'");
  }
  header('location:../../media.php?module='.$module);
}
}
?>

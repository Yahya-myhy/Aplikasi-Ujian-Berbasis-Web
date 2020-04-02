<?php
session_start();
$image_path = "../../../images/kakyusuf.png";
$font_path = "kak.TTF";
$font_size = 12;       // in pixcels
//$water_mark_text_1 = "9";
$water_mark_text_2 = "kakyusuf.com";

function watermark_image($oldimage_name){
    global $image_path;
    list($owidth,$oheight) = getimagesize($oldimage_name);
    $width = $owidth;
	$height = $oheight;    
    $im = imagecreatetruecolor($width, $height);
    $img_src = imagecreatefromjpeg($oldimage_name);
    imagecopyresampled($im, $img_src, 0, 0, 0, 0, $width, $height, $owidth, $oheight);
    $watermark = imagecreatefrompng($image_path);
    list($w_width, $w_height) = getimagesize($image_path);        
     $pos_x = $width - $w_width -5; 
    $pos_y = $height - $w_height - 5;
    imagecopy($im, $watermark, $pos_x, $pos_y, 0, 0, $w_width, $w_height);
    imagejpeg($im, $oldimage_name, 20);
    imagedestroy($im);
	return true;
}

 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../config/koneksi.php";
include "../../../config/fungsi_seo.php";
include "../../../config/library.php";
include "../../../config/fungsi_thumb.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus kabar
if ($module=='profile' AND $act=='hapus'){
  $data=mysqli_fetch_array(mysqli_query($mysqli,"SELECT gambar FROM pengumuman WHERE id_pengumuman='$_GET[id]'"));
  if ($data['gambar']!=''){
  mysqli_query($mysqli,"DELETE FROM pengumuman WHERE id_pengumuman='$_GET[id]'");
     unlink("../../../foto_agenda/$_GET[namafile]");   
     unlink("../../../foto_agenda/small_$_GET[namafile]");   
  }
  else{
  mysqli_query($mysqli,"DELETE FROM pengumuman WHERE id_pengumuman='$_GET[id]'");  
  }
  header('location:../../media.php?module=profile&id_session='.$_GET[ssid]);
}

// Input pengumuman
elseif ($module=='profile' AND $act=='input'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $tipe_file   = $_FILES['fupload']['type'];
  $nama_file   = $_FILES['fupload']['name'];
  $acak           = rand(000000,999999);
  $nama_file_unik = $acak.$nama_file; 


  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?module=profile&act=tambahkabar]')</script>";
    }
    else{
    UploadAgenda($nama_file_unik);
    mysqli_query($mysqli,"INSERT INTO pengumuman(isi_pengumuman,                                  
                                  sekolah
								  ,tgl_posting,                                  
                                  gambar, 
                                  username) 
					              VALUES('$_POST[isi_pengumuman]',
                                 '$_SESSION[sekolah]',
								 '$tgl_sekarang',
                                 '$nama_file_unik',
                                 '$_SESSION[namauser]')");
  header('location:../../media.php?module=profile&id_session='.$_SESSION[sessid]);
  }
  }
  else{
    mysqli_query($mysqli,"INSERT INTO pengumuman(isi_pengumuman,
								sekolah,
                                  tgl_posting,
                                  username) 
				                VALUES('$_POST[isi_pengumuman]',
                                 '$_SESSION[sekolah]',
								 '$tgl_sekarang',
                                 '$_SESSION[namauser]')");
  header('location:../../media.php?module=profile&id_session='.$_SESSION[sessid]);
  }
}




// Update user
elseif ($module=='profile' AND $act=='update') {
	 // Apabila gambar tidak diganti
   mysqli_query($mysqli,"UPDATE users SET 	alamat = '$_POST[alamat]',
   									lulusan = '$_POST[lulusan]',
   									tentang = '$_POST[tentang]',
 									hp = '$_POST[hp]', 
									pelajaran = '$_POST[pelajaran]'
									WHERE nik   = '$_POST[id]'");
 
  header('location:../../media.php?module=profile&id_session='.$_SESSION[sessid]);
  
  

}





}
?>

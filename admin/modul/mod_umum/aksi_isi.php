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

  header('location: index.php');
  }
  
else{
include "../../../config/koneksi.php";
include "../../../config/library.php";
include "../../../config/fungsi_thumb.php";
include "../../../config/fungsi_seo.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus pengumuman
if ($module=='home' AND $act=='kabar'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $tipe_file   = $_FILES['fupload']['type'];
  $nama_file   = $_FILES['fupload']['name'];
  $acak           = rand(000000,999999);
  $nama_file_unik = $acak.$nama_file; 


  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?module=home')</script>";
    }
    else{
    UploadAgenda($nama_file_unik);
    mysqli_query($mysqli,"INSERT INTO pengumuman(isi_pengumuman,                                  
                                  sekolah,
								  tgl_posting,                                  
                                  gambar, 
                                  username) 
					              VALUES('$_POST[isi_pengumuman]',
                                 '$_SESSION[sekolah]',
								 '$tgl_sekarang',
                                 '$nama_file_unik',
                                 '$_SESSION[namauser]')");
  header('location:../../media.php?module='.$module);
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
  header('location:../../media.php?module='.$module);
  }
}
  

// Input komen
elseif ($module=='home' AND $act=='input'){
 $isi_komentar = $_POST['pesan'];
 if (strlen($_POST['pesan']) > 1000) {
  echo "KOMENTAR Anda kepanjangan, dikurangin atau dibagi jadi beberapa bagian.<br />
  	      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b>";
}
else{
function antiinjection($data){
  $filter_sql = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter_sql;
}

 $sql = mysqli_query($mysqli,"INSERT INTO komentar(nama_komentar,
												isi_komentar,
												id_berita,
												tgl,
												jam_komentar,												
												email
												) 
                        VALUES('$_SESSION[namalengkap]',
								'$_POST[pesan]',
								'$_POST[id]',
								'$tgl_sekarang',
								'$jam_sekarang',								
								'$_SESSION[namauser]')");
 $row=mysqli_fetch_array(mysqli_query($mysqli,"SELECT * FROM pengumuman WHERE id_pengumuman=$_POST[id]"));
  header('location:../../media.php?module=pengumuman&id_pengumuman='.$row[id_pengumuman].'');
 
 
}

 
 }


// Input komen
elseif ($module=='pengumuman' AND $act=='input'){
 $isi_komentar = $_POST['pesan'];
 if (strlen($_POST['pesan']) > 1000) {
  echo "KOMENTAR Anda kepanjangan, dikurangin atau dibagi jadi beberapa bagian.<br />
  	      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b>";
}
else{
function antiinjection($data){
  $filter_sql = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter_sql;
}

 $sql = mysqli_query($mysqli,"INSERT INTO komentar(nama_komentar,
												isi_komentar,
												id_berita,
												tgl,
												jam_komentar,												
												email
												) 
                        VALUES('$_SESSION[namalengkap]',
								'$_POST[pesan]',
								'$_POST[id]',
								'$tgl_sekarang',
								'$jam_sekarang',								
								'$_SESSION[namauser]')");
 
   $row=mysqli_fetch_array(mysqli_query($mysqli,"SELECT * FROM pengumuman WHERE id_pengumuman=$_POST[id]"));
  header('location:../../media.php?module=pengumuman&id_pengumuman='.$row[id_pengumuman].'');
 
}

 
 }
}
?>

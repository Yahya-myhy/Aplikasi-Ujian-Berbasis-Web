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

// Hapus ujian
if ($module=='ujian' AND $act=='hapus'){
     mysqli_query($mysqli, "DELETE FROM ujian WHERE id_ujian='$_GET[id]'");
     mysqli_query($mysqli, "UPDATE soal SET status = 'N' WHERE id_ujian='$_GET[id]'");
	mysqli_query($mysqli, "DELETE FROM nilai WHERE id_ujian='$_GET[id]'");
  mysqli_query($mysqli, "DELETE FROM analisis WHERE id_ujian='$_GET[id]'");
  
  header('location:../../media.php?module='.$module);
}
// Hapus Nilai
elseif ($module=='nilai' AND $act=='hapus'){
    mysqli_query($mysqli, "DELETE FROM nilai WHERE id_nilai='$_GET[nilai]'");
   mysqli_query($mysqli, "DELETE FROM analisis WHERE id_ujian='$_GET[ujian]' AND nis='$_GET[nis]'");
  
  
  header('location:../../media.php?module=nilai&act=kelas&id='.$_GET[ujian].'&kls='.$_GET[kls]);
}

// Hapus soal
elseif ($module=='soal' AND $act=='hapus'){
     mysqli_query($mysqli, "DELETE FROM soal WHERE id_soal='$_GET[id]'");
  
  
  header('location:../../media.php?module=soal&id='.$_GET[ujian]);}

// Input ujian
elseif ($module=='ujian' AND $act=='input'){
 mysqli_query($mysqli, "INSERT INTO ujian(judul, nama_mapel, tanggal, waktu, jml_soal, id_user, acak, sekolah)
									VALUES('$_POST[judul]',
'$_POST[mapel]', '$_POST[tanggal]', '$_POST[jam]:$_POST[menit]:00', '$_POST[jml]', '$_POST[pj]', '$_POST[acak]', '$_SESSION[sekolah]')");
  header('location:../../media.php?module='.$module);
  }
// Input soal
elseif ($module=='soal' AND $act=='input'){
   mysqli_query($mysqli, "INSERT INTO soal(id_ujian, soal, pilihan_1, pilihan_2, pilihan_3, pilihan_4, pilihan_5, kunci)
									VALUES('$_POST[id]', '$_POST[soal]', '$_POST[p1]', '$_POST[p2]', '$_POST[p3]', '$_POST[p4]', '$_POST[p5]', '$_POST[kunci]')");
  header('location:../../media.php?module=soal&id='.$_POST[id]);
  }

// edit soal
elseif ($module=='soal' AND $act=='update'){
   mysqli_query($mysqli, "UPDATE soal SET id_ujian='$_POST[ujian]', 
   								soal = '$_POST[soal]', 
								pilihan_1='$_POST[p1]', 
								pilihan_2='$_POST[p2]',
								pilihan_3='$_POST[p3]', 
								pilihan_4='$_POST[p4]', 
								pilihan_5='$_POST[p5]',
								kunci='$_POST[kunci]'
								WHERE id_soal   = '$_POST[id]'");
									
  header('location:../../media.php?module=soal&id='.$_POST[ujian]);
  }

// Update ujian
elseif ($module=='ujian' AND $act=='update'){
    mysqli_query($mysqli, "UPDATE ujian SET judul        = '$_POST[judul]',
                                        nama_mapel    = '$_POST[mapel]',
										tanggal  = '$_POST[tanggal]',
										waktu = '$_POST[waktu]',                    	
										acak  = '$_POST[acak]',                    
										jml_soal  = '$_POST[jml]'  
                                  WHERE id_ujian   = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
  
}
// Input kelas ujian
elseif ($module=='ujian' AND $act=='kelas'){
	mysqli_query($mysqli, "DELETE FROM kelas_ujian WHERE id_ujian='$_POST[id]'");
   $kls = $_POST['kelas'];
  $jumlahTerpilih	= count($kls);
		
foreach($kls as $kelas) {
mysqli_query($mysqli, "INSERT INTO kelas_ujian(id_ujian, id_kelas, aktif) VALUES('$_POST[id]', '$kelas', 'Y')");
		}
	header('location:../../media.php?module='.$module);
  }
  
  // Reset siswa
elseif ($module=='status' AND $act=='reset'){
	
mysqli_query($mysqli, "UPDATE siswa SET status        = 'OFF'  
                                  WHERE nis   = '$_GET[id]'");
	header('location:../../media.php?module='.$module);
  }




}
?>

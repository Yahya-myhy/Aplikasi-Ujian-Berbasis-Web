<?php
 session_start();
include "../config/koneksi.php";

if(empty($_SESSION['username']) or empty($_SESSION['password']) ){
   header('location: login.php');
}
     $rnilai = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM nilai WHERE id_ujian='$_GET[ujian]' AND nis='$_SESSION[nis]'"));
	
   $arr_soal = explode(",", $rnilai['acak_soal']);
   $jawaban = explode(",", $rnilai['jawaban']);
   $jbenar = 0;
   $jkosong = 0;
   $jsoal = count($arr_soal);
   for($i=0; $i<count($arr_soal); $i++){
      $rsoal = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM soal WHERE id_ujian='$_GET[ujian]' AND id_soal='$arr_soal[$i]'"));
      if($rsoal['kunci'] == $jawaban[$i]) $jbenar++;
  	 if($jawaban[$i] == 0) $jkosong++;
	$jsalah = $jsoal-$jbenar-$jkosong;
    }
   $nilai = ($jbenar/count($arr_soal))*100;
	
   mysqli_query($mysqli, "UPDATE nilai SET jml_benar='$jbenar', sisa_waktu='00:00:00', jml_kosong='$jkosong', jml_salah='$jsalah', nilai='$nilai' WHERE id_ujian='$_GET[ujian]' AND nis='$_SESSION[nis]'");
   
   mysqli_query($mysqli, "UPDATE siswa SET status='selesai' WHERE nis='$_SESSION[nis]'");
   header('location:index.php');

?>
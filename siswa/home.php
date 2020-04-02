<?php
session_start();
include "../config/koneksi.php";

if( empty($_SESSION['username']) or empty($_SESSION['password']) ){
   header('location: login.php');
}

echo '<div class="grup" style="width:95%; margin:0 auto; margin-top:25px">
<div class="kiri">
 <div class="list-group-item top-heading">
<h3 class="list-group-item-heading page-label">Daftar Ujian</h3></div>';

//Cek jumlah ujian pada tanggal sekarang
$tgl = date('Y-m-d');
$qujian = mysqli_query($mysqli, "SELECT * FROM ujian t1, kelas_ujian t2 WHERE t1.tanggal='$tgl' AND t1.id_ujian=t2.id_ujian AND t2.id_kelas='$_SESSION[kelas]' AND t2.aktif='Y'");
$tujian = mysqli_num_rows($qujian);
$rujian = mysqli_fetch_array($qujian);

//Jika tidak ada ujian aktif tampilkan pesan
if($tujian < 1){
   echo '
   <div class="alert alert-info">Belum ada ujian Pada Tanggal Sekarang Untuk Kelas Kamu. Jika ada kesalahan hubungi Operator! perbaiki tanggal ujian atau kelas ujian</div>';
}

//Jika ada dua atau lebih ujian aktif tampilkan pada tabel
else{
   echo '<div class="alert alert-info"><table class="table table-striped"><thead>
   <tr>
      <th>No</th>
	  <th>Judul</th>
      <th>Pelajaran</th>
      <th>Aksi</th>
   </tr></thead><tbody>';
	
	$qujian = mysqli_query($mysqli, "SELECT * FROM ujian t1, kelas_ujian t2 WHERE t1.tanggal='$tgl' AND t1.id_ujian=t2.id_ujian AND t2.id_kelas='$_SESSION[kelas]' AND t2.aktif='Y'");
   $no = 1;
   while($r = mysqli_fetch_array($qujian)){
      
      $kelas_ujian = array();
      $qkelas_ujian = mysqli_query($mysqli, "SELECT * FROM kelas t1, kelas_ujian t2 WHERE  t1.id_kelas=t2.id_kelas AND t2.id_ujian='$r[id_ujian]'");
      while($rku = mysqli_fetch_array($qkelas_ujian)){
         $kelas_ujian[] = $rku['nama_kelas'];
      }
		
      echo'<tr>
         <td><h2>'.$no.'</h2></td>
		 <td><h2>'.$r['judul'].'</h2></td>
         <td><h2>'.$r['nama_mapel'].'</h2></td>
        ';

//Jika nilai sudah ada tampilkan tombol Sudah Mengerjakan, jika belum ada tampilkan tombol Kerjakan
        $qnilai = mysqli_query($mysqli, "SELECT * FROM nilai WHERE id_ujian='$r[id_ujian]' AND nis='$_SESSION[nis]'");
        $tnilai = mysqli_num_rows($qnilai);
        $rnilai = mysqli_fetch_array($qnilai);
		

        if($tnilai>0 and $rnilai['nilai'] != "") echo '<td bgcolor= bordercolordark="#00FF33" ><a onclick="show_nilai('.$r['id_ujian'].')"  class="btn btn-block">Lihat Nilai</a>';
		elseif($tnilai>0 and $rnilai['sisa_waktu'] != "") echo '<td bgcolor="#FF3300"><a onclick="show_ujian('.$r['id_ujian'].')"  class="btn btn-block">Lanjutkan</a>';
        else echo '<td bgcolor="#FFFF00"><a onclick="show_detail('.$r['id_ujian'].')" class="btn btn-block"><i class="glyphicon glyphicon-log-in"></i> Kerjakan</a>';
        echo '</td>
     </tr>';
	 $no++;
  }

   echo '</tbody></table></div>';
}

   echo '</div> ';
   include "pengumuman.php";
   echo'</div>';
?>
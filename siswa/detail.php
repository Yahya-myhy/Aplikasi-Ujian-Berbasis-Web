<?php
session_start();
include "../config/koneksi.php";

if(empty($_SESSION['username']) or empty($_SESSION['password']) ){
   header('location: login.php');
}

$kelas = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM kelas WHERE id_kelas='$_SESSION[kelas]'"));
$ujian = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM ujian WHERE id_ujian='$_GET[ujian]'"));
?>
<div class="grup" style="width:95%; margin:0 auto; margin-top:25px">
<div class="kiri">
 <div class="list-group-item top-heading">
<h3 class="list-group-item-heading page-label">Data Ujian</h3></div>
<div class="list-group-item">
<table class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
                                  <th>Nomor</th>
                                  <th><b><?= $_SESSION['nis']; ?> </b></th>
                                 
                              </tr>
                              </thead>
                              <tbody>
                              <tr>
                                  <td>Nama</td>
                                  <td><b><?= $_SESSION['namalengkap']; ?> </b></td>
                                 </tr>
                              <tr>
                                  <td>Kelas</td>
                                  <td><b><?= $kelas['nama_kelas']; ?></b></td>
                                 </tr><tr>
                                  <td>Pelajaran</td>
                                  <td><b><?= $ujian['nama_mapel']; ?></b></td>
                                 </tr><tr>
                                  <td>Jml. Soal</td>
                                  <td><b><?= $ujian['jml_soal']; ?></b></td>
                                 </tr><tr>
                                  <td>Waktu</td>
                                  <td><b><?= $ujian['waktu']; ?> </b></td>
                                 </tr>
                              </tbody>
                          </table></div>
                           </div><div class="kanan">

	<div id="myerror" class="alert alert-warning" role="alert" style="font-size: 13px; font-style:normal; font-weight:normal">
    <i class="glyphicon glyphicon-warning-sign"></i>  
    <font size="3px">Jika Sudah Faham KLIK Tombol MULAI</font>
    </div>


<?php	
//Jika nilai sudah ada tampilkan tombol Sudah Mengerjakan, jika belum ada tampilkan tombol Masuk Ujian
$qnilai = mysqli_query($mysqli, "SELECT * FROM nilai WHERE id_ujian='$_GET[ujian]' AND nis='$_SESSION[nis]'");
$tnilai = mysqli_num_rows($qnilai);
$rnilai = mysqli_fetch_array($qnilai);

if($tnilai>0 and $rnilai['nilai'] != "")  echo '<a class=""btn btn-danger btn-block doblockui"> Lihat Nilai </a>';
else echo '<a type=button" onclick="show_ujian('.$_GET['ujian'].')">
<button type="submit" class="btn btn-danger btn-block doblockui"><i class="glyphicon glyphicon-edit"></i> Kerjakan Soal</button></a>';
?>
	
</div></div>
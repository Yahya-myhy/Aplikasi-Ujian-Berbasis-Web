<?php
session_start();
include "../config/koneksi.php";

if(empty($_SESSION['username']) or empty($_SESSION['password']) ){
   header('location: login.php');
}
$kelas = mysqli_fetch_array(mysqli_query($mysqli,"SELECT * FROM kelas WHERE id_kelas='$_SESSION[kelas]'"));
$mapel = mysqli_fetch_array(mysqli_query($mysqli,"SELECT * FROM ujian WHERE id_ujian='$_GET[ujian]'"));
$soal = mysqli_fetch_array(mysqli_query($mysqli,"SELECT * FROM soal WHERE id_ujian='$_GET[ujian]'"));
$nilai = mysqli_fetch_array(mysqli_query($mysqli,"SELECT * FROM nilai WHERE id_ujian='$_GET[ujian]' AND nis='$_SESSION[nis]'"));

?>
<div class="grup" style="width:95%; margin:0 auto; margin-top:25px">
<div class="kiri">
 <div class="list-group-item top-heading">
<h3 class="list-group-item-heading page-label">Nilai Kamu</h3></div>';



<div class="alert alert-info"><table class="table table-striped"><thead>
                             
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
                                  <td><b><?= $mapel['nama_mapel']; ?></b></td>
                                 </tr><tr>
                                  <td>Jml. Soal</td>
                                  <td><b><?= $mapel['jml_soal']; ?></b></td>
                                 </tr><tr>
                                  <td>Jawaban Benar</td>
                                  <td><b><?= $nilai['jml_benar']; ?> </b></td>
                                 </tr>
                                 <tr>
                                  <td>Jawaban  Salah</td>
                                  <td><b><?= $nilai['jml_salah']; ?> </b></td>
                                 </tr>
                                 <tr>
                                  <td>Jawaban Kosong</td>
                                  <td><b><?= $nilai['jml_kosong']; ?> </b></td>
                                 </tr>
                                 
                              </tbody>
                          </table>
<Center><p> Nilai :</p>
	 <font size="50px" color="#FF0000"><?= $nilai['nilai']; ?> </font>
     <a href="index.php"><button class="btn btn-info btn-block doblockui">kembali</button></a>
 </Center>   
    </div>
  </div> 
   <?php include "pengumuman.php"; ?>
 </div>
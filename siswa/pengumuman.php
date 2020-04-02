<div class="kanan">
	<div id="myerror" class="alert alert-info" role="alert" style="font-size: 13px; font-style:normal; font-weight:normal">
<i class="glyphicon glyphicon-warning-sign"></i> 
<font size="3px">Info </font>
	</div>
<?php

include "../config/koneksi.php";
$pengumuman = mysqli_query($mysqli, "SELECT * FROM pengumuman WHERE sekolah='$_SESSION[sekolah]' ORDER BY id_pengumuman DESC LIMIT 3");
       $no = 1;
	   while($t= mysqli_fetch_array($pengumuman)){ 
$guru = mysqli_fetch_array(mysqli_query($mysqli,"SELECT * FROM users WHERE email  = '$t[username]'"));

echo'<div id="myerror" class="alert alert-info" role="alert" style="font-size: 13px; font-style:normal; font-weight:normal">
';
if ($t['gambar']!=''){
  echo '<img width="100%" src="../foto_agenda/'.$t['gambar'].'">';
  }
   echo'<font size="4px">
   <p><b>'.$guru['nama_lengkap'].'</b></p></font>
  '.$t['isi_pengumuman'].'
	</div>
   ';
   $no ++;
   }
?> 


<div id="myerror" class="alert alert-info" role="alert" style="font-size: 13px; font-style:normal; font-weight:normal">

<font size="3px">Info Aplikasi</font>
	</div>
<a href="http://inforeceh.com"><button class="btn btn-danger btn-block doblockui">+62 895609830688</button></a>

</div>
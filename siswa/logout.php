<?php
  session_start();
  include "../config/koneksi.php";
  mysqli_query($mysqli,"UPDATE siswa SET status='OFF' WHERE nis='$_SESSION[nis]'");
  
  session_destroy();
  echo "<script>
   alert('Anda keluar dari ujian!'); 
   window.location = 'login.php';
   </script>";
?>

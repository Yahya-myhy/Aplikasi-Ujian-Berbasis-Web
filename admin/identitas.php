<?php
include "../config/koneksi.php";
$identitas = mysqli_query($mysqli,"SELECT * FROM identitas WHERE id_identitas='1'");
$data = mysqli_fetch_array($identitas);
  
?>


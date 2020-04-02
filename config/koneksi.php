<?php

// panggil fungsi validasi xss dan injection
require_once('fungsi_validasi.php');

$host	= "localhost";
$user	= "root";
$pass	= "";
$db	= "sbmptn";

//Menggunakan objek mysqli untuk membuat koneksi dan menyimpanya dalam variabel $mysqli	
$mysqli = new mysqli($host, $user, $pass, $db);

// buat variabel untuk validasi dari file fungsi_validasi.php
$val = new validasi;

//Membuat variabel yang menyimpan url website dan folder website
$url_website = "http://localhost/unbk";
$folder_website = "/unbk";

//Menentukan timezone 
date_default_timezone_set('Asia/Jakarta'); 

?>

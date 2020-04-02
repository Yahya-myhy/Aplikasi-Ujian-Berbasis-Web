<?php
session_start();
ob_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
   header('location: index.php');
}
else{
	
?>

<html>
<head>
<title>Cetak Soal</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

</head>
<body >

<?php
include "../../config/koneksi.php";
include "../../config/library.php";
$tampil_ujian = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM ujian WHERE id_ujian='$_GET[id]'"));
$tampil = mysqli_query($mysqli, "SELECT * FROM soal WHERE id_ujian='$_GET[id]' ORDER BY id_soal DESC");

header("Content-Type: application/vnd.ms-word");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-disposition: attachment; filename=soal_$tampil_ujian[nama_mapel].doc");

  echo "<h1>DATA SOAL $tampil_ujian[judul]</h1>";
    $no = 1;
    while($r=mysqli_fetch_array($tampil)){
      $soal = str_replace("../media", "../../media", $r['soal']);

	  echo "<b>$no.</b>  ";
	  echo "$soal<br><br>";
	  echo "A. $r[pilihan_1]<br> ";	
	   echo "B. $r[pilihan_2]<br> ";	
	    echo "C. $r[pilihan_3]<br> ";	
		 echo "D. $r[pilihan_4]<br> ";	
		  echo "E. $r[pilihan_5] <br>";		
      
	  echo "<br>";
	  $no ++;
    }
?>


</body>
</html>

<?php


    }
	
    ?>

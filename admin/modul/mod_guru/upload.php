<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../config/koneksi.php";
include "../../../config/fungsi_seo.php";

 include "../../../assets/excel_reader/excel_reader.php";
   $filename = strtolower($_FILES['file']['name']);
   $extensi  = substr($filename,-4);
		

   if($extensi != ".xls"){
      echo "File yang di-upload tidak berformat .xls!'";
   }else{
      $path = "../../upload";			
      move_uploaded_file($_FILES['file']['tmp_name'], "$path/$filename");
			
      $file = "../../upload/$filename";			
      $data = new Spreadsheet_Excel_Reader();
      $data->read($file);
      $jdata = $data->rowcount($sheet_index=0);
			
     for($i=3; $i<=$jdata; $i++){		
       $soal = htmlspecialchars(addslashes($data->val($i,2)));
       $pil_1 = htmlspecialchars(addslashes($data->val($i,3)));
       $pil_2 = htmlspecialchars(addslashes($data->val($i,4)));
       $pil_3 = htmlspecialchars(addslashes($data->val($i,5)));
       $pil_4 = htmlspecialchars(addslashes($data->val($i,6)));
       $pil_5 = htmlspecialchars(addslashes($data->val($i,7)));
       $kunci = addslashes($data->val($i,8));
	         
			 mysqli_query($mysqli, "INSERT INTO soal(id_ujian, soal, pilihan_1, pilihan_2, pilihan_3, pilihan_4, pilihan_5, kunci) VALUES('$_POST[ujian]', '$soal', '$pil_1','$pil_2','$pil_3','$pil_4','$pil_5','$kunci')");
	 
	     }
      }	
      
      unlink($file);
	     echo "ok";

}


?>

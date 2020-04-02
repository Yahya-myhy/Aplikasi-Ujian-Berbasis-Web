<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../config/koneksi.php";

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
			
     for($i=3 ; $i<=$jdata; $i++){		
       $nis = addslashes($data->val($i,2));
       $nama = addslashes($data->val($i,3));
       $email = htmlspecialchars(addslashes($data->val($i,4)));
       $hp = addslashes($data->val($i,5));
       $wali = addslashes($data->val($i,6));
	   $alamat = addslashes($data->val($i,7));
       
        $cek = mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM siswa WHERE nis='$nis'"));
         if($cek > 0){
           
   mysqli_query($mysqli, "UPDATE siswa SET 	email = '$email', 
   									nama_lengkap = '$nama',
									hp = '$hp',
									wali = '$wali', 
									alamat = '$alamat'
									WHERE nis   = '$nis'");
         }else{
		$id= md5($nis);
 		$password = md5(substr(md5($nis),0,5));
		$kelas = $_POST['kls'];
           mysqli_query($mysqli, "INSERT INTO siswa(email, password, nama_lengkap, level, id_kelas, nis, id_session, sekolah, hp, wali, alamat, status, tingkat)
									VALUES('$email', '$password', '$nama', 'siswa', '$kelas', '$nis', '$id', '$_SESSION[sekolah]','$hp', '$wali', '$alamat', 'OFF', '$_SESSION[tingkat]')");
 		
		 }    
	 
	     }
      }	
      
      unlink($file);
	     echo "ok";

}


?>

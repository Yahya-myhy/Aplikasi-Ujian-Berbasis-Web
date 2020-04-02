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
			
     for($i=3; $i<=$jdata; $i++){		
       $nik = addslashes($data->val($i,2));
       $nama = addslashes($data->val($i,3));
       $email = htmlspecialchars(addslashes($data->val($i,4)));
       $hp = addslashes($data->val($i,5));
       $pelajaran = addslashes($data->val($i,6));
       $tentang = htmlspecialchars(addslashes($data->val($i,7)));
	   $alamat = htmlspecialchars(addslashes($data->val($i,8)));
	    
        $cek = mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM users WHERE nik='$nik'"));
         if($cek > 0){
           
   mysqli_query($mysqli, "UPDATE users SET 	email = '$email', 
   									nama_lengkap = '$nama',
									tentang = '$tentang',
 									hp = '$hp', 
									alamat= '$alamat',
									pelajaran = '$pelajaran'
									WHERE nik   = '$nik'");
 
         }else{
		$id= md5($nik);
 		$password = md5(substr(md5($nik),0,5));
		$pann = substr(md5($nik), 0, 5);
           mysqli_query($mysqli, "INSERT INTO users(email, password, nama_lengkap, level, walikelas, nik, id_session, sekolah,tingkat,paas,tentang, hp, alamat, pelajaran)
									VALUES('$email', '$password', '$nama', 'guru', 'N', '$nik', '$id', '$_SESSION[sekolah]', '$_SESSION[tingkat]','$pann','$tentang', '$hp', '$alamat', '$pelajaran')");
 		}    
	 
	     }
      }	
      
      unlink($file);
	     echo "ok";

}


?>

<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  header('location: index.php');
}
else{
	if($_SESSION[leveluser]=='admin user'){
   $aksi="modul/mod_identitas/aksi_identitas.php";
  switch($_GET[act]){
  // Tampil identitas
  default:
    $sql  = mysqli_query($mysqli, "SELECT * FROM identitas LIMIT 1");
    $r    = mysqli_fetch_array($sql);

  
   echo "<!-- Content Wrapper. Contains page content -->
  <div class='content-wrapper'>
    <!-- Content Header (Page header) -->
    <section class='content-header'>
      <h1>
        Identitas 
        <small>Web</small>
      </h1>
      <ol class='breadcrumb'>
        <li><a href='?module=home'><i class='fa fa-dashboard'></i> Home</a></li>
        <li><a href='?module=identitas'>Identitas Web</a></li>
       
      </ol>
    </section>

    <!-- Main content -->
    <section class='content'>
      <div class='row'>
        <div class='col-xs-12'><!-- /.box -->

          <div class='box'>
       
          
                     <form id='form1' class='stdform' method=POST enctype='multipart/form-data' action=$aksi?module=identitas&act=update>
					 <input type=hidden name=id value=$r[id_identitas]>
          <div class='box-body'>
            
<div class='form-group'>
 <label >Nama Website</label>
                                 <input type='text' name='nama_website' class='form-control' value='$r[nama_website]'>
              </div>
              <br>
		  <div class='form-group'>";
									if ($r[gambar]!=''){
    				echo "
                               		<img src=../images/$r[gambar] width=270>"; 
						}
						echo"</div>
									
							<div class='form-group'>
                  <label >Ganti Gambar LOGO</label>
                               		
									<input type='file' name='fupload' />
									<p class='help-block'>Tipe gambar harus JPG/JPEG dan ukuran lebar maks: 400 px.</p></div><p class='stdformbutton'>
                                <button class='btn btn-info'>Simpan</button> | 
								<input type=button value=Batal onclick=self.history.back() class='btn btn-warning'>
                            </p>
                    </form>
                ";					
            
        echo " </div>
          <!-- /.box -->
      </div></div>
          <!-- /.box -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->";

}
} else {

	include 'hakakses.php';
   } 
    }
	
    ?>


 
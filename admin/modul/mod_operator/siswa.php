<script>
function confirmdelete(delUrl) {
   if (confirm("Anda yakin ingin menghapus?")) {
      document.location = delUrl;
   }
}
function import_data(){
   var formdata = new FormData();      
   var file = $('#file')[0].files[0];
   formdata.append('file', file);
   $.each($('#modal_upload form').serializeArray(), function(a, b){
      formdata.append(b.name, b.value);
   });
   $.ajax({
      url: 'modul/mod_operator/upload_siswa.php',
      data: formdata,
      processData: false,
      contentType: false,
      type: 'POST',
      success: function(data) {
         if(data=="ok"){
           $('#modal_upload').modal('hide');
           document.location = "media.php?module=siswa";
         }else{
            alert(data);
         }
      },
      error: function(data){
         alert('Tidak dapat mengimport data!');
      }
   });
   return false;
}

</script>

<style>
    .example-modal .modal {
      position: relative;
      top: auto;
      bottom: auto;
      right: auto;
      left: auto;
      display: block;
      z-index: 1;
    }

    .example-modal .modal {
      background: transparent !important;
    }
  </style>

<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
   header('location: index.php');
}
else{
	if($_SESSION[leveluser]=='admin user'){

$aksi="modul/mod_operator/aksi_member.php";
switch($_GET[act]){
  // Tampil soal
  default:
  echo"
  <!-- Content Wrapper. Contains page content -->
  <div class='content-wrapper'>
    <!-- Content Header (Page header) -->
    <section class='content-header'>
      <h1><i class='fa fa-user'></i>
Data Kelas Siswa       </h1>
      <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-dashboard'></i> Home</a></li>
        <li><a href='#'>member</a></li>
        <li><a href='#'>kelas</a></li>
        
      </ol>
    </section>

    <!-- Main content -->
    <section class='content'>
      <div class='row'>
        <div class='col-xs-12'><!-- /.box -->

          <div class='box'>
            <div class='box-header'>
              <h3 class='box-title'><a href='?module=siswa&act=tambahkelas'><button type='button' class='btn btn-block btn-primary'><i class='fa fa-user-plus'></i>  Buat Kelas Baru</button></a></h3>
<a href='export/excel_data.php?lv=siswa'>                         <button type='button' class='btn btn-primary pull-right'>
               <i class='fa fa-file-excel-o'></i> Download data semua siswa
              </button> </a> 
			</div>
            <!-- /.box-header -->
            <div class='box-body'>
              <table id='example1' class='table table-bordered table-striped'>
                <thead>
                <tr>
	<th>No</th>	
	<th>Kelas</th>
	<th>Siswa</th>
	<th>Aksi</th>
	          </tr>
                </thead>
                <tbody>";
  $tampil = mysqli_query($mysqli, "SELECT * FROM kelas WHERE sekolah = '$_SESSION[sekolah]' ORDER BY tingkat ASC");
  $no = 1;
    while($r=mysqli_fetch_array($tampil)){
      $siswa = mysqli_query($mysqli, "SELECT * FROM siswa WHERE level='siswa' AND id_kelas='$r[id_kelas]'");
 $jmlsiswa = mysqli_num_rows($siswa);

      echo "<tr><td width='20'>$no</td>";
	  
echo "				<td><p style='font-weight: bold'>$r[nama_kelas]</p>
</td>

	            <td width='100'> <a href=?module=siswa&act=daftarsiswa&id=$r[id_kelas] class='btn btn-success'><i class='fa fa-user-secret'></i> Jumlah Siswa $jmlsiswa anak</a>   
   </td><td width='100'> <a href=?module=siswa&act=editkelas&id=$r[id_kelas] class='btn btn-primary'><i class='fa fa-pencil'></i></a>   
<a href=javascript:confirmdelete('$aksi?module=siswa&act=kelashapus&id=$r[id_kelas]') class='btn btn-danger'><i class='fa fa-trash'></i></a></td>                </tr>";
				$no ++;
    }
    echo "</tbody>
                <tfoot>
                <tr>
    <th>No</th>	
	<th>Kelas</th>
	<th>Siswa</th>
	<th>Aksi</th>
	</tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  <!-- Modal upload xls -->
<div class='modal modal-info fade' id='modal_upload'>
          <div class='modal-dialog'>
            <div class='modal-content'>
              <div class='modal-header'>
                
                  
                <h4 class='modal-title'>Upload EXCEL</h4>
              </div>
			  <form enctype='multipart/form-data'  onsubmit='return import_data()'>
   <input type=hidden name=kelas value=$_GET[id]>
              <div class='modal-body'>
            <div class='form-group has-feedback'>
		
			 <input type='file' class='file' id='file' name='file' required>
      </div>
              </div>
              <div class='modal-footer'>
				 <a href='../download/guru.xls'><button class='btn btn-outline pull-left'>contoh excel</button></a>
                 <button type='submit' class='btn btn-primary btn-save'>Upload</button>
              

              </div>
            </form>
			</div>
			
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->";
  
    break;
	
case "eror":

echo "<!-- Content Wrapper. Contains page content -->
  <div class='content-wrapper'>
    <!-- Content Header (Page header) -->
    <section class='content-header'>
      <h1>
        Maaf <small>EROR</small>
      </h1>
      <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-dashboard'></i> Home</a></li>
         <li class='active'>Blank page</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class='content'>

      <!-- Default box -->
      <div class='box'>
        <div class='box-header with-border'>
          <h3 class='box-title'>Data Sudah Terdaftar Buat yang lain</h3>
		  </div> <button onclick=self.history.back(-2) class='btn btn-warning'><i class='fa fa-backward'></i>Kembali</button>
       
        <!-- /.box-body --><!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->";
    break;




  case "tambahkelas":

	echo" <!-- Content Wrapper. Contains page content -->
  <div class='content-wrapper'>
    <!-- Content Header (Page header) -->
    <section class='content-header'>
      <h1>
        Tambah 
        <small>Kelas</small>
      </h1>
      <ol class='breadcrumb'>
        <li><a href='?module=home'><i class='fa fa-dashboard'></i> Home</a></li>
        <li><a href='?module=guru'>Kelas</a></li>
        <li class='active'>Tambah</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class='content'>
      <div class='row'>
        <div class='col-xs-12'><!-- /.box -->

          <div class='box'>
       
          
          <!-- Input addon -->
		  <form class='stdform stdform2' method=POST action='$aksi?module=siswa&act=kelasinput' enctype='multipart/form-data'>
          <div class='box-body'>
            <div class='form-group'>
			<label>Kelas</label>
                       <select name='tingkat' class='form-control'>
           <option value=1>1</option>
		   <option value=2>2</option>
		   <option value=3>3</option>
		   </select>
		   </div>
              <br>
			
			<div class='form-group'>
			<label>Nama Kelas</label>
               <input type='text' name='nama' class='form-control' placeholder='Nama Kelas contoh :12 IPA 1' required>
              </div>
              <br>
			  			
                            
							<p class='stdformbutton'>
                                <button class='btn btn-info'>Simpan</button> | 
								<input type=button value=Batal onclick=self.history.back() class='btn btn-warning'>
                            </p>
                    </form>
               </div>
          <!-- /.box -->
      </div></div>
          <!-- /.box -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->";
     break;
	 	 
  case "editkelas":
$edit = mysqli_query($mysqli, "SELECT * FROM kelas WHERE id_kelas ='$_GET[id]'");
    $r    = mysqli_fetch_array($edit);

	echo" <!-- Content Wrapper. Contains page content -->
  <div class='content-wrapper'>
    <!-- Content Header (Page header) -->
    <section class='content-header'>
      <h1>
        Edit 
        <small>Kelas</small>
      </h1>
      <ol class='breadcrumb'>
        <li><a href='?module=home'><i class='fa fa-dashboard'></i> Home</a></li>
        <li><a href='?module=guru'>Kelas</a></li>
        <li class='active'>Edit</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class='content'>
      <div class='row'>
        <div class='col-xs-12'><!-- /.box -->

          <div class='box'>
       
          
          <!-- Input addon -->
		  <form class='stdform stdform2' method=POST action='$aksi?module=siswa&act=kelasedit' enctype='multipart/form-data'>
          <input type='hidden' name='id' value='$r[id_kelas]'>
              
		  <div class='box-body'>
            <div class='form-group'>
			<label>Kelas</label>
			
                       <select name='tingkat' class='form-control'>";
          for ($d=1 ;$d<4 ; $d++){
		   if ($r[tingkat]==$d){
   echo "<option value=$d selected>$d</option>";
				  } else {
					     echo "<option value=$d >$d</option>";
				  }}
echo"   </select>
		   </div>
              <br>
			
			<div class='form-group'>
			<label>Nama Kelas</label>
               <input type='text' name='nama' value='$r[nama_kelas]' class='form-control' placeholder='Nama Kelas contoh :12 IPA 1' required>
              </div>
              <br>
			  			
                            
							<p class='stdformbutton'>
                                <button class='btn btn-info'>Simpan</button> | 
								<input type=button value=Batal onclick=self.history.back() class='btn btn-warning'>
                            </p>
                    </form>
               </div>
          <!-- /.box -->
      </div></div>
          <!-- /.box -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->";
     break;


case "daftarsiswa":
$siswa = mysqli_query($mysqli, "SELECT * FROM siswa WHERE level='siswa' AND id_kelas ='$_GET[id]' AND sekolah = '$_SESSION[sekolah]' ");
    
$kelas=mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM kelas WHERE id_kelas ='$_GET[id]'"));
echo "
  <!-- Content Wrapper. Contains page content -->
  <div class='content-wrapper'>
    <!-- Content Header (Page header) -->
    <section class='content-header'>
      <h1><i class='fa fa-user'></i>
Data Siswa Kelas<small>$kelas[nama_kelas]</small>
      </h1>
      <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-dashboard'></i> Home</a></li>
        <li><a href='#'>member</a></li>
        <li><a href='#'>siswa</a></li>
        
      </ol>
    </section>

    <!-- Main content -->
    <section class='content'>
	<div class='box box-default color-palette-box'>
        
        <div class='box-body'>
          <div class='row'>
            <div class='col-sm-4 col-md-2'>
              <h4 class='text-center'>Tambah</h4>
<a href='?module=siswa&act=tambahsiswa&kelas=$_GET[id]'><button type='button' class='btn btn-block btn-primary'><i class='fa fa-user-plus'></i></button></a>
            </div>
            <!-- /.col -->
            <div class='col-sm-4 col-md-2'>
              <h4 class='text-center'>Cetak Kartu</h4>
<a href='export/pdf_kartu.php?lv=siswa&kelas=$_GET[id]' target='_new'><button type='button' class='btn btn-block btn-primary'><i class='fa fa-print'></i></button></a>
            </div>
            <!-- /.col -->
            <div class='col-sm-4 col-md-2'>
              <h4 class='text-center'>Export Excel</h4>
<a href='export/excel_data.php?kelas=$_GET[id]&lv=anakkelas'><button type='button' class='btn btn-block btn-primary'><i class='fa fa-file-excel-o'></i></button></a>
              
            </div>
            <!-- /.col -->
            <div class='col-sm-4 col-md-2'>
              <h4 class='text-center'>Upload Excel</h4>
             <button type='button' class='btn btn-block btn-primary' data-toggle='modal' data-target='#modal_upload'>
               <i class='fa fa-upload'></i></button>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row --><!-- /.row -->
        </div>
        <!-- /.box-body -->
      </div>
      <div class='row'>
        <div class='col-xs-12'><!-- /.box -->

          <div class='box'>
            <!-- /.box-header -->
            <div class='box-body'>
              <table id='example1' class='table table-bordered table-striped'>
                <thead>
                <tr>
	<th>No</th>	
	<th>Foto</th>
	<th>Nis</th>
	<th>Nama</th>
	<th>Aksi</th>
	          </tr>
                </thead>
                <tbody>";
  $no = 1;
    while($si= mysqli_fetch_array($siswa)){
     

      echo "<tr><td width='20'>$no</td>
	  		<td>";
			if($si['foto']=='kosong.jpg'){
				
			echo "<img src='../foto_user/small_avatar.png' >";
			}else {
				
				echo "<img src='../foto_user/$si[foto]' width='60' height='60' >";
			 
			}
			echo "</td><td><p style='font-weight: bold'>$si[nis]</p></td>
			<td>$si[nama_lengkap]</td>
			<td width='100'> <a href=?module=siswa&act=editsiswa&id=$si[id_session] class='btn btn-primary'><i class='fa fa-pencil'></i></a>   
<a href=javascript:confirmdelete('$aksi?module=siswa&act=siswahapus&id=$si[id_session]&kelas=$_GET[id]') class='btn btn-danger'><i class='fa fa-trash'></i></a></td>                </tr>";
				$no ++;
    }
    echo "</tbody>
                <tfoot>
                <tr>
    <th>No</th>	
	<th>Foto</th>
	<th>NIS</th>
	<th>Siswa</th>
	<th>Aksi</th>
	</tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  <!-- Modal upload xls -->
<div class='modal modal-info fade' id='modal_upload'>
          <div class='modal-dialog'>
            <div class='modal-content'>
              <div class='modal-header'>
                
                  
                <h4 class='modal-title'>Upload EXCEL</h4>
              </div>
			  <form enctype='multipart/form-data'  onsubmit='return import_data()'>
  <input type=hidden name=kls value=$_GET[id]>
              <div class='modal-body'>
            <div class='form-group has-feedback'>
		
			 <input type='file' class='file' id='file' name='file' required>
      </div>
              </div>
              <div class='modal-footer'>
				 <a href='../download/siswa.xls' class='btn btn-outline pull-left'>contoh excel</a>
                 <button type='submit' class='btn btn-primary btn-save'>Upload</button>
              

              </div>
            </form>
			</div>
			
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->";
     break;
	 


case "tambahsiswa":

	
	echo" <!-- Content Wrapper. Contains page content -->
  <div class='content-wrapper'>
    <!-- Content Header (Page header) -->
    <section class='content-header'>
      <h1>
        Tambah 
        <small>Siswa</small>
      </h1>
      <ol class='breadcrumb'>
        <li><a href='?module=home'><i class='fa fa-dashboard'></i> Home</a></li>
        <li><a href='#'>Siswa</a></li>
        <li class='active'>Tambah</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class='content'>
      <div class='row'>
        <div class='col-xs-12'><!-- /.box -->

          <div class='box'>
       
          
          <!-- Input addon -->
		  <form class='stdform stdform2' method=POST action='$aksi?module=siswa&act=siswainput' enctype='multipart/form-data'>
          <input type='hidden' name='kelas' value='$_GET[kelas]'> 
		  <div class='box-body'>
            <div class='form-group'>
			<label>Nama Lengkap</label>
               <input type='text' name='nama' class='form-control' placeholder='Nama Lengkap' required>
              </div>
              <br>
			  
            <div class='form-group'>
			<label>Email</label>
               <input type='email' name='email' class='form-control' placeholder='Email Aktif' required>
              </div>
              <br>
			   <div class='form-group'>
			<label>No Hp</label>
               <input type='text' name='hp' class='form-control' placeholder='No Hp' required>
              </div>
              <br>
			  
			   <div class='form-group'>
			<label>NIS</label>
               <input type='text' name='nis' class='form-control' placeholder='NIS' required>
              </div>
              <br>
			  
			   <div class='form-group'>
			<label>Wali</label>
               <input type='text' name='wali' class='form-control' placeholder='Wali Siswa' required>
              </div>
              <br>
			  
			 <div class='form-group'>
			<label>Alamat</label>
              
			   
              
                <textarea name='alamat' placeholder='Tulis Alamat'
                          style='width: 100%; height: 50px;'></textarea>
              
           
			</div><br>

			   <div class='form-group'>
			<label>Ceritakan Tentang</label>
              
			   <div class='box-body pad'>
              
                <textarea class='textarea' name='tentang' placeholder='Tulis keterangan disini'
                          style='width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;'></textarea>
              
            </div>
			</div><br>

				<div class='form-group'>
                  <label for='exampleInputFile'>Upload Foto</label>
                  <input type=file name='fupload' size=40>

                  <p class='help-block'>Tipe gambar harus JPG/JPEG dan ukuran lebar maks: 400 px.</p></div>
								
                            
							<p class='stdformbutton'>
                                <button class='btn btn-info'>Simpan</button> | 
								<input type=button value=Batal onclick=self.history.back() class='btn btn-warning'>
                            </p>
                    </form>
               </div>
          <!-- /.box -->
      </div></div>
          <!-- /.box -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->";
  	  break;
	  
	  
case "editsiswa":
    $edit = mysqli_query($mysqli, "SELECT * FROM siswa WHERE id_session ='$_GET[id]'");
    $r    = mysqli_fetch_array($edit);
	
	
	echo" <!-- Content Wrapper. Contains page content -->
  <div class='content-wrapper'>
    <!-- Content Header (Page header) -->
    <section class='content-header'>
      <h1>
 Edit       <small>Siswa</small>
      </h1>
      <ol class='breadcrumb'>
        <li><a href='?module=home'><i class='fa fa-dashboard'></i> Home</a></li>
        <li><a href='#'>Siswa</a></li>
        <li class='active'>Edit</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class='content'>
      <div class='row'>
        <div class='col-xs-12'><!-- /.box -->

          <div class='box'>
       
          
          <!-- Input addon -->
		  <form class='stdform stdform2' method=POST action='$aksi?module=siswa&act=update' enctype='multipart/form-data'>
    <input type=hidden name=id value=$r[nis]>
	      <div class='box-body'>
		  
            <div class='form-group'>
			<label>Nama Lengkap</label>
               <input type='text' name=nama value='$r[nama_lengkap]' class='form-control' placeholder='Nama Lengkap' required>
              </div>
              <br>
			  
            <div class='form-group'>
			<label>Email</label>
               <input type='email' name=email class='form-control' value=$r[email] placeholder='Email Aktif' required>
              </div>
              <br>
			   <div class='form-group'>
			<label>No Hp</label>
               <input type='text' value=$r[hp] name=hp class='form-control' placeholder='No Hp' required>
              </div>
              <br>
			  
			   <div class='form-group'>
			<label>Wali</label>
               <input type='text' name=wali value=$r[wali] class='form-control' placeholder='Wali Siswa' required>
              </div>
              <br><div class='form-group'>
                <label>Pindah kelas</label>  
                  <select name=kelas class='form-control'>";
			  $tampil=mysqli_query($mysqli, "SELECT * FROM kelas  WHERE sekolah='$_SESSION[sekolah]' ORDER BY tingkat ASC");
   								while($ro=mysqli_fetch_array($tampil)){
				if($r['id_kelas']==$ro['id_kelas']){
				
								echo "<option value=$ro[id_kelas] selected>$ro[nama_kelas]</option>"; }
				
				else {
								echo "
								<option value=$ro[id_kelas]>$ro[nama_kelas]</option>"; }
								}
			   echo "</select></div>
			  
			 <div class='form-group'>
			<label>Alamat</label>
              
			   <div class='box-body pad'>
              
                <textarea class='textarea' name=alamat placeholder='Tulis Alamat'
                          style='width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;'>$r[alamat]</textarea>
              
            </div>
			</div><br>

			   <div class='form-group'>
			<label>Ceritakan Tentang</label>
              
			   <div class='box-body pad'>
              
                <textarea class='textarea' name=tentang placeholder='Tulis keterangan disini'
                          style='width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;'>$r[tentang]</textarea>
              
            </div>
			</div><br>";
if ($r[foto]!=''){
  							 echo "<img src='../foto_user/$r[foto]' alt='$r[foto]'>";} 
				 echo "</div>
				
				<div class='form-group'>
                  <label for='exampleInputFile'>Ganti Gambar</label>
                  <input type=file name='fupload' size=40> 

                  <p class='help-block'>Tipe gambar harus JPG/JPEG dan ukuran lebar maks: 400 px.</p></div>                            
							<p class='stdformbutton'>
                                <button class='btn btn-info'>Simpan</button> | 
								<input type=button value=Batal onclick=self.history.back() class='btn btn-warning'>
                            </p>
                    </form>
               </div>
          <!-- /.box -->
      </div></div>
          <!-- /.box -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->";
  	  break; 
}
} else {

	include 'hakakses.php';
   } 
    }
	
    ?>

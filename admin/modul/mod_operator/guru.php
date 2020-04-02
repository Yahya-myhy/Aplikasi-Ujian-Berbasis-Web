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
      url: 'modul/mod_operator/upload_guru.php',
      data: formdata,
      processData: false,
      contentType: false,
      type: 'POST',
      success: function(data) {
         if(data=="ok"){
           $('#modal_upload').modal('hide');
           document.location = "media.php?module=guru";
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
Data Guru         </h1>
      <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-dashboard'></i> Home</a></li>
        <li><a href='#'>member</a></li>
        <li><a href='#'>guru</a></li>
        
      </ol>
    </section>

    <!-- Main content -->
    <section class='content'>
	<div class='box box-default color-palette-box'>
        
        <div class='box-body'>
          <div class='row'>
            <div class='col-sm-4 col-md-2'>
              <h4 class='text-center'>Tambah</h4>
<a href='?module=guru&act=tambahguru'><button type='button' class='btn btn-block btn-primary'><i class='fa fa-user-plus'></i></button></a>
            </div>
            <!-- /.col -->
            <div class='col-sm-4 col-md-2'>
              <h4 class='text-center'>Cetak Kartu</h4>
<a href='export/pdf_kartu.php?lv=guru' target='_new'><button type='button' class='btn btn-block btn-primary'><i class='fa fa-print'></i></button></a>
            </div>
            <!-- /.col -->
            <div class='col-sm-4 col-md-2'>
              <h4 class='text-center'>Download</h4>
<a href='export/excel_data.php?lv=guru'><button type='button' class='btn btn-block btn-primary'><i class='fa fa-file-excel-o'></i></button></a>
              
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
	<th>Nama</th>
	<th>Pelajaran</th>
	<th>walikelas</th>
	<th>Aksi</th>
	          </tr>
                </thead>
                <tbody>";
  $tampil = mysqli_query($mysqli, "SELECT * FROM users WHERE level='guru' AND sekolah = '$_SESSION[sekolah]' ORDER BY nama_lengkap ASC");
  $no = 1;
    while($r=mysqli_fetch_array($tampil)){
     $kelas=mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM kelas WHERE id_kelas='$r[id_kelas]'"));
	  $tgl=tgl_indo($r[tanggal]);

      echo "<tr><td width='20'>$no</td><td>";
	  
           
			if($r['foto']=='kosong.jpg'){
				
			echo "<img src='../foto_user/small_avatar.png' >";
			}else {
				
				echo "<img src='../foto_user/small_$r[foto]' >";
			 
			}
			
			 
echo "	</td>			<td><p style='font-weight: bold'>$r[nama_lengkap]</p>
</td>
                <td>$r[pelajaran]</td>";
     if($r['walikelas']=='Y'){
	 echo"<td>$kelas[nama_kelas]</td>";}
	 else {
	 echo"<td>Kosong</td>";
	 }
	            echo "<td width='100'> <a href=?module=guru&act=editguru&id=$r[id_session] class='btn btn-info'><i class='fa fa-pencil'></i></a>   
   </td>
                </tr>";
				$no ++;
    }
    echo "</tbody>
                <tfoot>
                <tr>
                 
    <th>No</th>	
	<th>Foto</th>
	<th>Nama</th>
	<th>Pelajaran</th>
	<th>Walikelas</th>
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

              <div class='modal-body'>
            <div class='form-group has-feedback'>
		
			 <input type='file' class='file' id='file' name='file' required>
      </div>
              </div>
              <div class='modal-footer'>
				 <a href='../download/guru.xls' class='btn btn-outline pull-left'>contoh excel</a>
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
          <h3 class='box-title'>Email atau NIK Sudah Terdaftar</h3>
		  </div> <button onclick=self.history.back(-2) class='btn btn-warning'><i class='fa fa-backward'></i>Kembali</button>
       
        <!-- /.box-body --><!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->";
    break;

  case "tambahguru":

	echo" <!-- Content Wrapper. Contains page content -->
  <div class='content-wrapper'>
    <!-- Content Header (Page header) -->
    <section class='content-header'>
      <h1>
        Tambah 
        <small>Guru</small>
      </h1>
      <ol class='breadcrumb'>
        <li><a href='?module=home'><i class='fa fa-dashboard'></i> Home</a></li>
        <li><a href='?module=guru'>Guru</a></li>
        <li class='active'>Tambah</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class='content'>
      <div class='row'>
        <div class='col-xs-12'><!-- /.box -->

          <div class='box'>
       
          
          <!-- Input addon -->
		  <form class='stdform stdform2' method=POST action='$aksi?module=guru&act=input' enctype='multipart/form-data'>
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
			<label>NIK</label>
               <input type='text' name='nik' class='form-control' placeholder='NIK' required>
              </div>
              <br>
			  
			   <div class='form-group'>
			<label>Pelajaran</label>
               <input type='text' name='pelajaran' class='form-control' placeholder='Mengajar Pelajaran' required>
              </div>
              <br>
			  <div class='form-group'>
                <label>Walikelas :</label>
				  <label>
                  <input type='radio' name='wali' value='Y' class='flat-red'></label>
				  <label>
                Ya
                </label>
				<label>
                  <input type='radio' name='wali' value='N' class='flat-red'></label><label>
                 Tidak
                </label>
              </div>
			  <div class='form-group'>
                <label>Wali kelas</label>  
                  <select name='kelas' class='form-control'>
			  ";
			   $tampil=mysqli_query($mysqli, "SELECT * FROM kelas WHERE sekolah = '$_SESSION[sekolah]' ORDER BY tingkat ASC");
   								while($r=mysqli_fetch_array($tampil)){
		   						echo "<option value=$r[id_kelas]>$r[nama_kelas]</option>"; }
                
			   echo "</select>

                  <p class='help-block'>Kosongkan Jika Bukan Wali kelas.</p>
                </div>
			 <br>
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
    
  case "editguru":
    $edit = mysqli_query($mysqli, "SELECT * FROM users WHERE id_session ='$_GET[id]'");
    $r    = mysqli_fetch_array($edit);

   echo"<!-- Content Wrapper. Contains page content -->
  <div class='content-wrapper'>
    <!-- Content Header (Page header) -->
    <section class='content-header'>
      <h1>
       Edit
        <small>Guru $r[nama_lengkap]</small>
      </h1>
      <ol class='breadcrumb'>
        <li><a href='?module=home'><i class='fa fa-dashboard'></i> Home</a></li>
        <li><a href='?module=soal'>guru</a></li>
        <li class='active'>Tambah</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class='content'>
      <div class='row'>
        <div class='col-xs-12'><!-- /.box -->

          <div class='box'>
       
          
          <!-- Input addon -->
		      <form class='stdform stdform2' method=POST enctype='multipart/form-data' action=$aksi?module=guru&act=update>
          <input type=hidden name=id value=$r[nik]>
        <div class='box-body'>
            <div class='form-group'>
			<label>Nama Lengkap</label>
               <input type='text' name='nama' class='form-control' placeholder='Nama Lengkap' value='$r[nama_lengkap]' required>
              </div>
              <br>
			  
            <div class='form-group'>
			<label>Email</label>
               <input type='email' name='email' class='form-control' placeholder='Email Aktif' value='$r[email]' required>
              </div>
              <br>
			   <div class='form-group'>
			<label>No Hp</label>
               <input type='text' name='hp' class='form-control' placeholder='No Hp' value='$r[hp]' required>
              </div>
              <br>
			  
			   <div class='form-group'>
			<label>NIK</label>
               <input type='text' name='nik' class='form-control' placeholder='NIK' value='$r[nik]' disabled>
              </div>
              <br>
			  
			   <div class='form-group'>
			<label>Pelajaran</label>
               <input type='text' name='pelajaran' class='form-control' placeholder='Mengajar Pelajaran' value='$r[pelajaran]' required>
              </div>
                           <br>";
						    if ($r[walikelas]=='Y'){
   echo "
   <div class='form-group'>
                <label>Walikelas :</label>
				  <label>
                  <input type='radio' name='wali' value='Y' class='flat-red' checked></label>
				  <label>
                Ya
                </label>
				<label>
                  <input type='radio' name='wali' value='N' class='flat-red'></label><label>
                 Tidak
                </label>
              </div>
   ";}
   
   else{
   echo "
    <div class='form-group'>
	 <label>Walikelas :</label>
                <label>
                  <input type='radio' name='wali' value='Y' class='flat-red'></label><label>
                 Ya
                </label>
				<label>
                  <input type='radio' name='wali' value='N' class='flat-red' checked></label><label>
                 Tidak
                </label>
              </div>";}
echo "<div class='form-group'>
                <label>Wali kelas</label>  
                  <select name='kelas' class='form-control'>";
			  $tampil=mysqli_query($mysqli, "SELECT * FROM kelas WHERE sekolah='$_SESSION[sekolah]' ORDER BY tingkat ASC");
   								while($ro=mysqli_fetch_array($tampil)){
				if($r['id_kelas']==$ro['id_kelas']){
				
								echo "<option value=$ro[id_kelas] selected>$ro[nama_kelas]</option>"; }
				
				else {
								echo "
								<option value=$ro[id_kelas]>$ro[nama_kelas]</option>"; }
								}
			   echo "</select></div><div class='form-group'>
			<label>Ceritakan Tentang</label>
              
			   <div class='box-body pad'>
              
                <textarea class='textarea' name='tentang' placeholder='Tulis keterangan disini'
                          style='width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;'>$r[tentang]</textarea>
              
            </div>
			</div><br>
";
if ($r[foto]!=''){
  							 echo "<img src='../foto_user/$r[foto]' alt='$r[foto]'>";} 
				 echo "</div>
				
				<div class='form-group'>
                  <label for='exampleInputFile'>Ganti Gambar</label>
                  <input type=file name='fupload' size=40> 

                  <p class='help-block'>Tipe gambar harus JPG/JPEG dan ukuran lebar maks: 400 px.</p></div>";
				  
				  	 if ($r[blokir]=='Y'){
   echo "
   <div class='form-group'>
                <label>Blokir :</label>
				  <label>
                  <input type='radio' name='blokir' value='Y' class='flat-red' checked></label>
				  <label>
                Ya
                </label>
				<label>
                  <input type='radio' name='blokir' value='N' class='flat-red'></label><label>
                 Tidak
                </label>
              </div>
   ";}
   
   else{
   echo "
    <div class='form-group'>
	 <label>Blokir :</label>
                <label>
                  <input type='radio' name='blokir' value='Y' class='flat-red'></label><label>
                 Ya
                </label>
				<label>
                  <input type='radio' name='blokir' value='N' class='flat-red' checked></label><label>
                 Tidak
                </label>
              </div>";}
echo "
								
                            
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

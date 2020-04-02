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
      url: 'modul/mod_guru/upload.php',
      data: formdata,
      processData: false,
      contentType: false,
      type: 'POST',
      success: function(data) {
         if(data=="ok"){
           $('#modal_upload').modal('hide');
           document.location = "media.php?module=ujian";
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
if(empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
   header('location: index.php');
}
else{
	if($_SESSION[leveluser]=='guru' OR $_SESSION[leveluser]=='admin user'){


$aksi="modul/mod_guru/aksi_unbk.php";
switch($_GET[act]){
  // Tampil soal
  default:
  echo"
  <!-- Content Wrapper. Contains page content -->
  <div class='content-wrapper'>
    <!-- Content Header (Page header) -->
    <section class='content-header'>
      <h1>
Data Bank Soal           </h1>
      <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-dashboard'></i> Home</a></li>
        <li><a href='#'>Ujian</a></li>
        <li><a href='#'>Soal</a></li>
        
      </ol>
    </section>

    <!-- Main content -->
    <section class='content'>
      <div class='row'>
        <div class='col-xs-12'><!-- /.box -->

          <div class='box'>
            <div class='box-header'>
              <h3 class='box-title'><a href='?module=soal&act=tambahsoal&id=$_GET[id]'><button type='button' class='btn btn-block btn-primary'><i class='glyphicon glyphicon-pencil'></i>  Tambah Soal</button></a></h3>
                         <button type='button' class='btn btn-info pull-right' data-toggle='modal' data-target='#modal_upload'>
               <i class='fa fa-file-excel-o'></i> upload dari excel
              </button>

			</div>
            <!-- /.box-header -->
            <div class='box-body'>
              <table id='example1' class='table table-bordered table-striped'>
                <thead>
                <tr>
		  
    <th>No</th>	
	<th>Soal</th>
	<th>Pilganda</th>
	<th>Aksi</th>
	          </tr>
                </thead>
                <tbody>";

    $tampil = mysqli_query($mysqli, "SELECT * FROM soal WHERE id_ujian='$_GET[id]' ORDER BY id_soal DESC");
  
    $no = 1;
    while($r=mysqli_fetch_array($tampil)){
      $tgl=tgl_indo($r[tanggal]);

      echo "<tr><td width='20'>$no</td>
                <td><p style='font-weight: bold'>$r[soal]</p>
</td>
                <td><ol type='A'>
  ";		
      for($i=1; $i<=5; $i++){	
         $kolom = "pilihan_$i";
         if($r['kunci']==$i){
			 echo "<li style='font-weight: bold'>$r[$kolom]</li>";
		 }else
		 { echo "<li>$r[$kolom]</li>";
		 }
		 }
	  
	  echo"</ol></td>
                <td width='80'> <a href=?module=soal&act=editsoal&id=$r[id_soal] class='btn btn-info'><i class='fa fa-pencil'></i></a>   
   <a href=javascript:confirmdelete('$aksi?module=soal&act=hapus&ujian=$_GET[id]&id=$r[id_soal]') 
   class='btn btn-danger'><i class='fa fa-trash'></i></a></td>
                </tr>";
				$no ++;
    }
    echo "</tbody>
                <tfoot>
                <tr>
                 
		  
    <th>No</th>	
	<th>Soal</th>
	<th>Pilganda</th>
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
  
  <!-- Modal uploa xls -->
<div class='modal modal-info fade' id='modal_upload'>
          <div class='modal-dialog'>
            <div class='modal-content'>
              <div class='modal-header'>
                
                  
                <h4 class='modal-title'>Upload EXCEL</h4>
              </div>
			  <form enctype='multipart/form-data'  onsubmit='return import_data()'>
  <input type=hidden name=ujian value=$_GET[id]>
              <div class='modal-body'>
            <div class='form-group has-feedback'>
		
			 <input type='file' class='file' id='file' name='file' required>
      </div>
              </div>
              <div class='modal-footer'>
				 <a href='../download/soal.xls' class='btn btn-outline pull-left'>contoh excel</a>
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

  case "tambahsoal":
     $soal = mysqli_query($mysqli, "SELECT * FROM ujian WHERE id_ujian='$_GET[id]'");
    $so    = mysqli_fetch_array($soal);
	echo" <!-- Content Wrapper. Contains page content -->
  <div class='content-wrapper'>
    <!-- Content Header (Page header) -->
    <section class='content-header'>
      <h1>
        Tambah 
        <small>soal $so[judul]</small>
      </h1>
      <ol class='breadcrumb'>
        <li><a href='?module=home'><i class='fa fa-dashboard'></i> Home</a></li>
        <li><a href='?module=soal'>soal</a></li>
        <li class='active'>Tambah</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class='content'>
      <div class='row'>
        <div class='col-xs-12'><!-- /.box -->

          <div class='box'>
       
          
          <!-- Input addon -->
		  <form class='stdform stdform2' method=POST action='$aksi?module=soal&act=input' enctype='multipart/form-data'>
          <input type=hidden name=id value=$so[id_ujian]>
		 <div class='box-body'>
		 	<label> Soal </label>
<div class='form-group'>
                  <textarea class='form-control richtext' name='soal' rows='3' placeholder='Isi soal ...' ></textarea>
                </div>	<br>
					<label> Pilihan A </label>
<div class='form-group'>
                  <textarea class='form-control richtextsimple' name='p1' rows='3' placeholder='pilihan A' ></textarea>
                </div>	<br>
			
			
				<label> Pilihan B </label>
				<div class='form-group'>
			
                  <textarea class='form-control richtextsimple' name='p2' rows='3' placeholder='pilihan B' ></textarea>
                </div>	<br>	
					<label> Pilihan C </label>	  
				<div class='form-group'>
                  <textarea class='form-control richtextsimple' name='p3' rows='3' placeholder='pilihan C' ></textarea>
                </div>	<br>	<label> Pilihan D </label>
				<div class='form-group'>
                  <textarea class='form-control richtextsimple' name='p4' rows='3' placeholder='pilihan D' ></textarea>
                </div>	<br>
					<label> Pilihan E </label>
				<div class='form-group'>
                  <textarea class='form-control richtextsimple' name='p5' rows='3' placeholder='pilihan E' ></textarea>
                </div>	<br>
					<label> Kunci </label>
				<div class='form-group'>
                  
                  <select name='kunci' class='form-control'>
				  <option value=1 >A</option>
				  <option value=2 >B</option>
				  <option value=3 >C</option>
				  <option value=4 >D</option>
				  <option value=5 >E</option>
				  </select>
				  </div>
        <p class='stdformbutton'>
                                <button class='btn btn-primary'>Simpan</button>
								<input type=button value=Batal onclick=self.history.back() class='btn btn-warning btn-rounded'>
                                
                            </p></form> </div>
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
    
  case "editsoal":
    $edit = mysqli_query($mysqli, "SELECT * FROM soal WHERE id_soal='$_GET[id]'");
    $r    = mysqli_fetch_array($edit);

   echo"<!-- Content Wrapper. Contains page content -->
  <div class='content-wrapper'>
    <!-- Content Header (Page header) -->
    <section class='content-header'>
      <h1>
        Tambah 
        <small>soal $so[judul]</small>
      </h1>
      <ol class='breadcrumb'>
        <li><a href='?module=home'><i class='fa fa-dashboard'></i> Home</a></li>
        <li><a href='?module=soal'>soal</a></li>
        <li class='active'>Tambah</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class='content'>
      <div class='row'>
        <div class='col-xs-12'><!-- /.box -->

          <div class='box'>
       
          
          <!-- Input addon -->
		      <form class='stdform stdform2' method=POST enctype='multipart/form-data' action=$aksi?module=soal&act=update>
          <input type=hidden name=id value=$r[id_soal]>
         <input type=hidden name=ujian value=$r[id_ujian]>
		 <div class='box-body'>
		 	<label> Soal </label>
<div class='form-group'>
                  <textarea class='form-control richtext'  name='soal' rows='3' placeholder='Isi soal ...' >$r[soal]</textarea>
                </div>	<br>
					<label> Pilihan 1 </label>
<div class='form-group'>
                  <textarea class='form-control richtextsimple' name='p1' rows='3' placeholder='pilihan A' >$r[pilihan_1]</textarea>
                </div>	<br>
			
			
				<label> Pilihan 2 </label>
				<div class='form-group'>
			
                  <textarea class='form-control richtextsimple' name='p2' rows='3' placeholder='pilihan B' >$r[pilihan_2]</textarea>
                </div>	<br>	
					<label> Pilihan 3 </label>	  
				<div class='form-group'>
                  <textarea class='form-control richtextsimple' name='p3' rows='3' placeholder='pilihan C' >$r[pilihan_3]</textarea>
                </div>	<br>	<label> Pilihan 4 </label>
				<div class='form-group'>
                  <textarea class='form-control richtextsimple' name='p4' rows='3' placeholder='pilihan D' >$r[pilihan_4]</textarea>
                </div>	<br>
					<label> Pilihan 5 </label>
				<div class='form-group'>
                  <textarea class='form-control richtextsimple' name='p5' rows='3' placeholder='pilihan E' >$r[pilihan_5]</textarea>
                </div>	<br>
					<label> Kunci </label>
				<div class='form-group'>
                  
                  <select name='kunci' class='form-control'>";
	for ($d=1 ;$d<6 ; $d++){			  
				  if ($r[kunci]==$d){
   echo "<option value=$d selected>$d</option>";
				  } else {
					     echo "<option value=$d>$d</option>";
				  }}
echo"				  </select>
				  </div>
        <p class='stdformbutton'>
                                <button class='btn btn-primary'>Simpan</button>
								<input type=button value=Batal onclick=self.history.back() class='btn btn-warning btn-rounded'>
                                
                            </p></form> </div>
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

<script>
function confirmdelete(delUrl) {
   if (confirm("Anda yakin ingin menghapus?")) {
      document.location = delUrl;
   }
}

</script>

<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
   header('location: index.php');
}
else{
	if($_SESSION[leveluser]=='admin'){

$aksi="modul/mod_operator/aksi_unbk.php";
switch($_GET[act]){
  // Tampil Ujian
  default:
  echo"<!-- Content Wrapper. Contains page content -->
  <div class='content-wrapper'>
    <!-- Content Header (Page header) -->
    <section class='content-header'>
      <h1><i class='fa fa-user'></i>
Data Kelas Siswa       </h1>
      <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-dashboard'></i> Home</a></li>
        <li><a href='#'>Ujian</a></li>
        
      </ol>
    </section>

    <!-- Main content -->
    <section class='content'>
      <div class='row'>
        <div class='col-xs-12'><!-- /.box -->

          <div class='box'>
            <div class='box-header'>
              <h3 class='box-title'><a href='?module=ujianop&act=tambahujian'><button type='button' class='btn btn-block btn-primary'><i class='glyphicon glyphicon-pencil'></i>  Tambah Ujian</button></a></h3>

			</div>
            <!-- /.box-header -->
            <div class='box-body'>
              <table id='example1' class='table table-bordered table-striped'>
                <thead>
                <tr>
	<th>No</th>	
	<th>Judul</th>
	<th>Acak Soal</th>
	<th>Tanggal Ujian</th>
	<th>Bank Soal</th>
	<th>Kelas Ujian</th>
	<th>Aksi</th>
	          </tr>
                </thead>
                <tbody>";
 
$tampil = mysqli_query($mysqli, "SELECT * FROM ujian WHERE sekolah='$_SESSION[sekolah]' ORDER BY id_ujian DESC");
  
    $no = 1;
    while($r=mysqli_fetch_array($tampil)){
      

      echo "<tr><td width='20' >$no</td>
                <td >$r[judul]</td>
                <td>$r[acak]</td>
                <td>$r[tanggal]</td>";


$soal = mysqli_query($mysqli, "SELECT * FROM soal WHERE id_ujian = '$r[id_ujian]'");
$jmlsoal = mysqli_num_rows($soal);
echo "<td><a href=?module=soalop&id=$r[id_ujian] class='btn btn-info'><i class='fa  fa-server'></i> Jumlah Soal $jmlsoal</a> ";

echo"   </td><td> <center>  
<a href=?module=ujianop&act=kelasujian&id=$r[id_ujian] class='btn btn-warning'>Pilih kelas</a> </center>
</td><td>   
   
   <a href=?module=ujianop&act=editujian&id=$r[id_ujian] class='btn btn-info'><i class='fa fa-pencil'></i></a>   
   <a href=javascript:confirmdelete('$aksi?module=ujianop&act=hapus&id=$r[id_ujian]') 
   class='btn btn-danger'><i class='fa fa-trash'></i></a></td>
                </tr>";
				$no ++;
    }
 
 
 
 
 
 
 
 
 
 
 
    echo "</tbody>
                <tfoot>
                <tr>
    <th>No</th>	
	<th>Judul</th>
	<th>Acak Soal</th>
	<th>Tanggal Ujian</th>
	<th>Bank Soal</th>
	<th>Kelas Ujian</th>
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
  ";
  
    break;

  case "tambahujian":
    echo" <!-- Content Wrapper. Contains page content -->
  <div class='content-wrapper'>
    <!-- Content Header (Page header) -->
    <section class='content-header'>
      <h1>
        Tambah 
        <small>ujian</small>
      </h1>
      <ol class='breadcrumb'>
        <li><a href='?module=home'><i class='fa fa-dashboard'></i> Home</a></li>
        <li><a href='?module=ujianop'>ujian</a></li>
        <li class='active'>Tambah</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class='content'>
      <div class='row'>
        <div class='col-xs-12'><!-- /.box -->

          <div class='box'>
       
          
          <!-- Input addon -->
		  <form class='stdform stdform2' method=POST action='$aksi?module=ujianop&act=input' enctype='multipart/form-data'>
         
		 <div class='box-body'>
              <div class='input-group'>
                <span class='input-group-addon'><i class='fa fa-text-height'></i></span>
                <input type='text' name='judul' class='form-control' placeholder='Judul Ujian' required>
              </div>
              <br>
              <div class='input-group'>
                <span class='input-group-addon'><i class='fa fa-bookmark-o'></i></span>
                <input type='text' name='mapel' class='form-control' placeholder='Mata Pelajaran' required>
              </div>
              <br>
			
            
                <div class='input-group date'>
                  <div class='input-group-addon'>
                    <i class='fa fa-calendar'></i>
                  </div>
                  <input type='text' name='tanggal'  class='form-control pull-right' id='datepicker' placeholder='Tanggal Ujian' required>
                </div>
                <br>
            

<div class='input-group'>
                <span class='input-group-addon'><i class='fa fa-clock-o'></i></span>
                 <input type='text' name='jam' class='form-control' placeholder='Lama Ujian Jam diisi 2 digit (01)' maxlength='2' required>
				  <input type='text' name='menit' class='form-control' placeholder='Lama Ujian  Menit diisi 2 digit (00)' maxlength='2' required>
              </div>
			  
			  
			  
              <br>
			  <div class='input-group'>
                <span class='input-group-addon'><i class='fa fa-book'></i></span>
                <input type='number' name='jml' class='form-control' placeholder='Jumlah Soal' required>
              </div><br>
             <div class='form-group'>
                  
                  <select name='acak' class='form-control' required>
				  <option value='acak' > Acak Soal</option>
				  <option value='tidak' > Tidak di Acak Soal</option>
				  
				  </select>
				  </div> 
			  
			  
			  <label>PJ</label>
			  <div class='form-group'>
                  
                  <select name='pj' class='form-control'>";
				 $guru = mysqli_query($mysqli, "SELECT * FROM users ORDER BY id_user ASC");
  
  
    while($g=mysqli_fetch_array($guru)){
				  echo"<option value='$g[id_user]' >$g[nama_lengkap]</option>";
	}
echo "				  </select>
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
    
  case "editujian":
    $edit = mysqli_query($mysqli, "SELECT * FROM ujian WHERE id_ujian='$_GET[id]'");
    $r    = mysqli_fetch_array($edit);

   echo"<!-- Content Wrapper. Contains page content -->
  <div class='content-wrapper'>
    <!-- Content Header (Page header) -->
    <section class='content-header'>
      <h1>
        Edit
        <small>ujian </small>
      </h1>
      <ol class='breadcrumb'>
        <li><a href='?module=home'><i class='fa fa-dashboard'></i> Home</a></li>
        <li><a href='?module=ujianop'>ujian</a></li>
        <li class='active'>Edit</li>
      </ol>
    </section>

     <!-- Main content -->
    <section class='content'>
      <div class='row'>
        <div class='col-xs-12'><!-- /.box -->

          <div class='box'>
       
       
          
          <!-- Input addon -->
		    <form class='stdform stdform2' method=POST enctype='multipart/form-data' action=$aksi?module=ujianop&act=update>
          <input type=hidden name=id value=$r[id_ujian]>
         
		 <div class='box-body'>
              <div class='input-group'>
                <span class='input-group-addon'><i class='fa fa-text-height'></i></span>
                <input type='text' name='judul' class='form-control' value='$r[judul]' placeholder='Judul Ujian'>
              </div>
              <br>
              <div class='input-group'>
                <span class='input-group-addon'><i class='fa fa-bookmark-o'></i></span>
                <input type='text' value='$r[nama_mapel]' name='mapel' class='form-control' placeholder='Mata Pelajaran'>
              </div>
              <br>
			
            
                <div class='input-group date'>
                  <div class='input-group-addon'>
                    <i class='fa fa-calendar'></i>
                  </div>
                  <input type='text' name='tanggal' value='$r[tanggal]'  class='form-control pull-right' id='datepicker' placeholder='Tanggal Ujian'>
                </div>
                <br>
            

<div class='input-group'>
                <span class='input-group-addon'><i class='fa fa-clock-o'></i></span>
				   <input type='text' name='waktu'  value='$r[waktu]' class='form-control' width='10px' placeholder='Waktu Ujian format 00:00:00' required>
              </div>
              <br>
			  <div class='input-group'>
                <span class='input-group-addon'><i class='fa fa-book'></i></span>
                <input type='number' name='jml' value='$r[jml_soal]' class='form-control' placeholder='Jumlah Soal'>
              </div>
              <br>
             <div class='form-group'>
                  
                  <select name='acak' class='form-control' required>";
				  if($r['acak']=='acak'){
				  echo "<option value='acak' selected> Acak Soal</option>
				  <option value='tidak' > Tidak di Acak Soal</option>";
				  } else {
			echo "<option value='acak' > Acak Soal</option>
			<option value='tidak' selected> Tidak di Acak Soal</option>";		  
				  }
			echo "</select>
				  </div> 
			  
			  <div class='form-group'><select name='pj' class='form-control'>
			  ";
				 $guru = mysqli_query($mysqli, "SELECT * FROM users ORDER BY id_user ASC");

  
    while($g=mysqli_fetch_array($guru)){
		
		if($g['id_user']==$r['id_user']){
			 echo"<option value='$g[id_user]' selected>$g[nama_lengkap]</option>";
		}else {
				  echo"<option value='$g[id_user]' >$g[nama_lengkap]</option>";}
	}
echo "			</select>  </div> 
			  
			  
			   		<p class='stdformbutton'>
                                <button class='btn btn-primary'>Update</button>
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

  case "kelasujian":
    $edit = mysqli_query($mysqli, "SELECT * FROM ujian WHERE id_ujian='$_GET[id]'");
    $r    = mysqli_fetch_array($edit);

   echo"<!-- Content Wrapper. Contains page content -->
  <div class='content-wrapper'>
    <!-- Content Header (Page header) -->
    <section class='content-header'>
      <h1>
        Kelas Yang ikut
        <small>ujian </small>
      </h1>
      <ol class='breadcrumb'>
        <li><a href='?module=home'><i class='fa fa-dashboard'></i> Home</a></li>
        <li><a href='?module=ujianop'>ujian</a></li>
        <li class='active'>Kelas</li>
      </ol>
    </section>

     <!-- Main content -->
    <section class='content'>
      <div class='row'>
        <div class='col-xs-12'><!-- /.box -->

          <div class='box'>
       
       
          
          <!-- Input addon -->
		    <form  method=POST enctype='multipart/form-data' action=$aksi?module=ujianop&act=kelas>
          <input type=hidden name=id value=$r[id_ujian]>
         
		 <div class='box-body'>
		 
		 
		 <table id='example1' class='table table-bordered table-striped'>
                <thead>
                <tr>
		  
    <th>Tingkat</th>	
	<th>Nama Kelas</th>
	          </tr>
                </thead>
                <tbody> ";


for($j=1; $j<4; $j++){
	echo "<tr>
<td width='20'>Kelas $j </td><td>";
	
$kelas = mysqli_query($mysqli, "SELECT * FROM kelas WHERE sekolah='$_SESSION[sekolah]' AND  tingkat=$j");
   while($t = mysqli_fetch_array($kelas)){
$jml  = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM kelas_ujian WHERE id_ujian=$_GET[id] AND id_kelas= $t[id_kelas]"));
	    
if ($t['id_kelas'] == $jml['id_kelas'] ) {
echo"                
<label> <input type='checkbox' class='flat-red' value=$t[id_kelas] name=kelas[] checked> </label> 
<label> $t[nama_kelas] </label>
	";			}
	else {
		echo"                  
<label> <input type='checkbox' class='flat-red' value=$t[id_kelas] name=kelas[] > </label> 
<label> $t[nama_kelas] </label>
	";			}
   }
   
   echo "</td></tr>";}

	echo"</tbody>
              </table></div>
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

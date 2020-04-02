<script>
function confirmdelete(delUrl) {
   if (confirm("Anda yakin ingin menghapus Semua Nilai?")) {
      document.location = delUrl;
   }
}

</script>

<?php
session_start();
if(empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
   header('location: index.php');
}
else{
	if($_SESSION[leveluser]=='guru' OR $_SESSION[leveluser]=='admin user'){


$aksi="modul/mod_guru/aksi_unbk.php";
switch($_GET[act]){
  // Tampil Ujian
  default:
  echo"
  <!-- Content Wrapper. Contains page content -->
  <div class='content-wrapper'>
    <!-- Content Header (Page header) -->
    <section class='content-header'>
      <h1>
        Data Ujian
            </h1>
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
            
            <!-- /.box-header -->
            <div class='box-body'>
              <table id='example1' class='table table-bordered table-striped'>
                <thead>
                <tr>
		  
    <th>No</th>	
	<th>Judul</th>
	<th>Mapel</th>
	<th>Tanggal Ujian</th>
	<th>NILAI</th>
	
	          </tr>
                </thead>
                <tbody>";

    if($_SESSION[leveluser]=='admin user'){	 
    $tampil = mysqli_query($mysqli, "SELECT * FROM ujian ORDER BY id_ujian DESC");
}else {$tampil = mysqli_query($mysqli, "SELECT * FROM ujian WHERE id_user='$_SESSION[id_user]' ORDER BY id_ujian DESC");
} 
    $no = 1;
    while($r=mysqli_fetch_array($tampil)){
      $tgl=tgl_indo($r[tanggal]);

      echo "<tr><td width='20' >$no</td>
                <td >$r[judul]</td>
                <td>$r[nama_mapel]</td>
                <td>$tgl</td><td>";

$nilai = mysqli_query($mysqli, "SELECT * FROM kelas t1, kelas_ujian t2 WHERE t1.id_kelas=t2.id_kelas AND t2.id_ujian='$r[id_ujian]'");


 while($l=mysqli_fetch_array($nilai)){
 $siswa = mysqli_query($mysqli, "SELECT * FROM siswa WHERE level='siswa' AND id_kelas='$l[id_kelas]'");
 $jmlsiswa = mysqli_num_rows($siswa);
echo " <a href=?module=nilai&act=kelas&id=$r[id_ujian]&kls=$l[id_kelas] class='btn btn-info'><i class='fa  fa-server'></i> $l[nama_kelas]  ($jmlsiswa)</a>";
 }
echo"  </td></tr>";
 

				$no ++;
    }
    echo "</tbody>
                <tfoot>
                <tr>
                 
		  
    <th>No</th>	
	<th>Judul</th>
	<th>Mapel</th>
	<th>Tanggal Ujian</th>
	<th>Nilai</th>
	
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
  <!-- /.content-wrapper -->";
  
    break;

  case "kelas":
   $uji = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM ujian WHERE id_ujian='$_GET[id]' ORDER BY id_ujian DESC"));
    echo" 
  <!-- Content Wrapper. Contains page content -->
  <div class='content-wrapper'>
    <!-- Content Header (Page header) -->
    <section class='content-header'>
      <h1>
        Data Nilai
            
        <small> $uji[judul]</small></h1>
      <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-dashboard'></i> Home</a></li>
        <li><a href='#'>Nilai</a></li>
		    <li><a href='#'>$uji[nama_mapel]</a></li>
        
      </ol>
    </section>

    <!-- Main content -->
    <section class='content'>
      <div class='row'>
        <div class='col-xs-12'><!-- /.box -->

          <div class='box'>
            <div class='box-header'>
              <h3 class='box-title'><a href='export/excel_analisis.php?ujian=$_GET[id]&kelas=$_GET[kls]'><button type='button' class='btn btn-block btn-primary'><i class='fa fa-check-square'></i>  Analisis Soal</button></a></h3>
<a href='export/excel_nilai.php?ujian=$_GET[id]&kelas=$_GET[kls]'>			  <button type='button' class='btn btn-info pull-right' >
               <i class='fa fa-download'></i> Download Ke excel
              </button></a>
            </div>
            <!-- /.box-header -->
            <div class='box-body'>
              <table id='example1' class='table table-bordered table-striped'>
                <thead>
                <tr>
	<th>No</th>	
	<th>Nama</th>
	<th>Status</th>
	<th>Benar</th>
	<th>Salah</th>
	<th>Kosong</th>
	<th>NILAI</th>
	<th>aksi</th>
	          </tr>
                </thead>
                <tbody>";

    $tampil = mysqli_query($mysqli, "SELECT * FROM siswa WHERE id_kelas='$_GET[kls]' ORDER BY nama_lengkap ASC");
    $no = 1;
    while($r=mysqli_fetch_array($tampil)){
   $nli = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM nilai WHERE id_ujian='$_GET[id]' AND nis ='$r[nis]'"));

      echo "<tr><td width='20' >$no</td>
                <td>$r[nama_lengkap]</td>
                <td>$nli[status]</td>
	            <td>$nli[jml_benar]</td>
				<td>$nli[jml_salah]</td>
				<td>$nli[jml_kosong]</td>
				<td>$nli[nilai]</td>
				<td><a href=javascript:confirmdelete('$aksi?module=nilai&act=hapus&ujian=$_GET[id]&kls=$_GET[kls]&nilai=$nli[id_nilai]&nis=$r[nis]')><button type='button' class='btn btn-danger'><i class='fa fa-trash'></i>  Hapus</button></a></td>
				</tr>";


				$no ++;
    }
    echo "</tbody>
                <tfoot>
                <tr>
    <th>No</th>	
	<th>Nama</th>
	<th>Status</th>
	<th>Benar</th>
	<th>Salah</th>
	<th>Kosong</th>
	<th>NILAI</th>
	<th>aksi</th>
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
  <!-- /.content-wrapper -->";
   
     break;
}
} else {

	include 'hakakses.php';
   } 
    }
	
    ?>

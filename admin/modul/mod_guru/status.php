<script>
function confirmdelete(delUrl) {
   if (confirm("Anda yakin ingin menghapus?")) {
      document.location = delUrl;
   }
}

//Ketika tombol Refresh diklik
function refresh_data(){
   document.location = "media.php?module=status";
}

//Ketika tombol Reset Login diklik
function reset_login(id){
   if(confirm("Apakah yakin akan mereset login siswa")){
      $.ajax({
         url : "modul/mod_guru/aksi_unbk.php?module=status&act=reset&id="+id,
         type : "GET",
         success : function(data){
             document.location = "media.php?module=status";
         },
         error : function(){
            alert("Tidak dapat mereset login!");
         }
      });
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

$aksi="modul/mod_unbk/aksi_unbk.php";
switch($_GET[act]){
  // Tampil soal
  default:
  echo"
  <!-- Content Wrapper. Contains page content -->
  <div class='content-wrapper'>
    <!-- Content Header (Page header) -->
    <section class='content-header'>
      <h1>DATA SISWA</h1>
      <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-dashboard'></i> Home</a></li>
        <li><a href='#'>Siswa</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class='content'>
      <div class='row'>
        <div class='col-xs-12'><!-- /.box -->

          <div class='box'>
            <div class='box-header'>
           <button type='button' onclick='refresh_data()' class='btn btn-info pull-right' data-toggle='modal' data-target='#modal_upload'>
               <i class='fa fa-refresh'></i> Refresh
              </button>

			</div>
            <!-- /.box-header -->
            <div class='box-body'>
              <table id='example1' class='table table-bordered table-striped'>
                <thead>
                <tr>
		  
    <th>No</th>	
	<th>Nama</th>
	<th>Nis</th>
	<th>Password</th>
	<th>Kelas</th>
	<th>Status</th>
	<th>Aksi</th>
	          </tr>
                </thead>
                <tbody>";

    $tampil = mysqli_query($mysqli, "SELECT * FROM siswa WHERE sekolah='$_SESSION[sekolah]'");
    $no = 1;
    while($r=mysqli_fetch_array($tampil)){
		$password = substr(md5($r['nis']), 0, 5);
      $tgl=tgl_indo($r[tanggal]);
$kl =mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM kelas WHERE id_kelas=$r[id_kelas]"));
echo "<tr><td width='20'>$no</td>
                <td><p style='font-weight: bold'>$r[nama_lengkap]</p></td>
<td>$r[nis]</td>
                <td>$password</td>
				<td>$kl[nama_kelas]</td>";
				if($r['status']=='OFF'){
				echo "<td><center>Belum Login</center></td>";
				} else {
				echo "<td ><center>$r[status]</center></td>";
				}
				echo "<td width='80'> <a onclick='reset_login($r[nis])' class='btn btn-primary'><i class='fa fa-history'></i> RESET</a>   
  </td>
                </tr>";
		$no ++;	
    }	
    echo "</tbody>
                <tfoot>
                <tr>
                 
    <th>No</th>	
	<th>Nama</th>
	<th>Nis</th>
	<th>Password</th>
	<th>Kelas</th>
	<th>Status</th>
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
  <!-- /.content-wrapper -->";
  
    break;

}
} else {

	include 'hakakses.php';
   } 
    }
	
    ?>

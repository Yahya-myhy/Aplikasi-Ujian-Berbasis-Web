<script>
function confirmdelete(delUrl) {
   if (confirm("Anda yakin ingin menghapus?")) {
      document.location = delUrl;
   }
}
</script>
<?php
$aksi="modul/mod_umum/aksi_profile.php";
switch($_GET[act]){
  // Tampil Berita
  default:
  
  $edit = mysqli_query($mysqli,"SELECT * FROM users WHERE id_session='$_GET[id_session]'");
    $r    = mysqli_fetch_array($edit);
if ($_GET['id_session'] == $_SESSION['sessid']){
	
echo "	<div class='content-wrapper'>
    <!-- Content Header (Page header) -->
    <section class='content-header'>
      <h1>
        Profile Saya
      </h1>
      <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-dashboard'></i> Home</a></li>
        <li class='active'profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class='content'>

      <div class='row'>
        <div class='col-md-3'>
  
          <!-- Profile Image -->
          <div class='box box-primary'>
            <div class='box-body box-profile'>";
              
			  
			if($r['foto']=='kosong.jpg'){
				
			echo "<img class='profile-user-img img-responsive img-circle' src='../foto_user/avatar.png' >";
			}else {
				
				echo "<img class='profile-user-img img-responsive img-circle' src='../foto_user/$r[foto]' >";
			 
			}

             echo " <h3 class='profile-username text-center'>$r[nama_lengkap]</h3>

              <p class='text-muted text-center'>$r[level]</p>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class='box-body box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'>Data Diri</h3>
            </div>
            <!-- /.box-header -->
            <div class='box-body'>
              <strong><i class='fa fa-book margin-r-5'></i> Sekolah</strong>

              <p class='text-muted'>
                $r[sekolah]
              </p>

              <hr>

              <strong><i class='fa fa-map-marker margin-r-5'></i> Alamat</strong>

              <p class='text-muted'>$r[alamat]</p>

              <hr>

              

              <strong><i class='fa fa-file-text-o margin-r-5'></i> Notes</strong>

              <p>$r[tentang].</p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class='col-md-9'>
          <div class='nav-tabs-custom'>
            <ul class='nav nav-tabs'>
              <li class='active'><a href='#activity' data-toggle='tab'>Beranda</a></li>
            </ul>
            <div class='tab-content'>
              <div class='active tab-pane' id='activity'>
			  <div class='box box-widget'>
		  <!-- Input addon -->
		 <form method=POST action='$aksi?module=profile&act=input' enctype='multipart/form-data'>
     <div class='box-body'>
            
			 <div class='form-group'>
                  <textarea class='form-control textarea' name='isi_pengumuman' rows='3' placeholder='Isi Pengumuman ...' ></textarea>
                </div>
				<div class='form-group'>
                  <label for='exampleInputFile'>Gambar</label>
                  <input type='file' name='fupload' size=40>

                  <p class='help-block'>Tipe gambar harus JPG/JPEG dan ukuran lebar maks: 400 px.</p>
				  </div>
				  	<p class='stdformbutton'>
                                <button class='btn btn-info'>Simpan</button> | 
								
                            </p>
                    </form>
    </div>
          <!-- /.box -->
      </div>";
 $tampil=mysqli_query($mysqli,"SELECT * FROM pengumuman 
                           WHERE username='$_SESSION[namauser]' ORDER BY id_pengumuman DESC");

   							 while($po=mysqli_fetch_array($tampil)){
     					 $tgl_posting=tgl_indo($po[tgl_posting]);
echo "                <!-- Post -->
                <div class='post'>
                  <div class='user-block'>
";
              
			  
			if($r['foto']=='kosong.jpg'){
				
			echo "<img class='img-circle img-bordered-sm' src='../foto_user/small_avatar.png' >";
			}else {
				
				echo "<img class='img-circle img-bordered-sm' src='../foto_user/small_$r[foto]' >";
			 
			}

             echo "                    
                        <span class='username'>
                          $r[nama_lengkap]
						  <a href=javascript:confirmdelete('$aksi?module=profile&act=hapus&id=$po[id_pengumuman]&namafile=$r[gambar]&ssid=$_SESSION[sessid]') class='pull-right btn-box-tool'><i class='fa fa-times'></i></a>
                        </span>
                    <span class='description'>$tgl_posting</span>
                
				  </div>
                  <!-- /.user-block -->
				  
                  ";
 if ($po['gambar']!=''){
  echo "<a href='../foto_agenda/$po[gambar]'><img class='img-responsive pad' src='../foto_agenda/$po[gambar]' alt='Photo' width='100%'></a>";
  }
  $komentar = mysqli_query($mysqli,"select count(komentar.id_komentar) as jml from komentar WHERE id_berita='$po[id_pengumuman]' AND aktif='Y'");
  $k = mysqli_fetch_array($komentar); 
echo "       <p>$po[isi_pengumuman]</p>
                  <ul class='list-inline'>
                    <li><a href='#' class='link-black text-sm'><i class='fa fa-share margin-r-5'></i> Share</a></li>
                    <li><a href='#' class='link-black text-sm'><i class='fa fa-thumbs-o-up margin-r-5'></i> Like</a>
                    </li>
                    <li class='pull-right'>
                      <a href='media.php?module=pengumuman&id_pengumuman=$po[id_pengumuman]' class='link-black text-sm'><i class='fa fa-comments-o margin-r-5'></i> Comments
                        ($k[jml])</a></li>
                  </ul>

                 
                </div>
                <!-- /.post -->";
				}

             
              echo"</div>
              <!-- /. akhir tab-pane -->
              

          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->";
	
	
	
	
	
	
	
	
	
	
	
	
	
	
} else {
echo "<div class='content-wrapper'>
    <!-- Content Header (Page header) -->
    <section class='content-header'>
      <h1>
        Profile 
      </h1>
      <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-dashboard'></i> Home</a></li>
        <li class='active'profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class='content'>

      <div class='row'>
        <div class='col-md-3'>
  
          <!-- Profile Image -->
          <div class='box box-primary'>
            <div class='box-body box-profile'>";
              
			  
			if($r['foto']=='kosong.jpg'){
				
			echo "<img class='profile-user-img img-responsive img-circle' src='../foto_user/small_avatar.png' >";
			}else {
				
				echo "<img class='profile-user-img img-responsive img-circle' src='../foto_user/small_$r[foto]' >";
			 
			}

             echo " <h3 class='profile-username text-center'>$r[nama_lengkap]</h3>

              <p class='text-muted text-center'>$r[level]</p>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class='box-body box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'>Data Diri</h3>
            </div>
            <!-- /.box-header -->
            <div class='box-body'>
              <strong><i class='fa fa-book margin-r-5'></i> Education</strong>

              <p class='text-muted'>
                $r[sekolah]
              </p>

              <hr>

              <strong><i class='fa fa-map-marker margin-r-5'></i> Alamat</strong>

              <p class='text-muted'>$r[alamat]</p>

              <hr>

              

              <strong><i class='fa fa-file-text-o margin-r-5'></i> Notes</strong>

              <p>$r[about_me].</p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class='col-md-9'>
          <div class='nav-tabs-custom'>
            <ul class='nav nav-tabs'>
              <li class='active'><a href='#activity' data-toggle='tab'>Beranda</a></li>
            </ul>
            <div class='tab-content'>
              <div class='active tab-pane' id='activity'>";
 $tampil=mysqli_query($mysqli,"SELECT * FROM pengumuman 
                           WHERE username='$r[email]' ORDER BY id_pengumuman DESC");

   							 while($po=mysqli_fetch_array($tampil)){
     					 $tgl_posting=tgl_indo($po[tgl_posting]);
              
echo "                <!-- Post -->
                <div class='post'>
                  <div class='user-block'>
";
              
			  
			if($r['foto']=='kosong.jpg'){
				
			echo "<img class='img-circle img-bordered-sm' src='../foto_user/small_avatar.png' >";
			}else {
				
				echo "<img class='img-circle img-bordered-sm' src='../foto_user/small_$r[foto]' >";
			 
			}

             echo "                    
                        <span class='username'>
                          $r[nama_lengkap]
                        </span>
                    <span class='description'>$tgl_posting</span>
                  </div>
                  <!-- /.user-block -->
                  ";
 if ($po['gambar']!=''){
  echo "<img class='img-responsive pad' src='../foto_agenda/$po[gambar]' alt='Photo'>";
  }
  $komentar = mysqli_query($mysqli,"select count(komentar.id_komentar) as jml from komentar WHERE id_berita='$po[id_pengumuman]' AND aktif='Y'");
  $k = mysqli_fetch_array($komentar); 
echo "       <p>$po[isi_pengumuman]</p>
                  <ul class='list-inline'>
                    <li><a href='#' class='link-black text-sm'><i class='fa fa-share margin-r-5'></i> Share</a></li>
                    <li><a href='#' class='link-black text-sm'><i class='fa fa-thumbs-o-up margin-r-5'></i> Like</a>
                    </li>
                    <li class='pull-right'>
                      <a href='media.php?module=pengumuman&id_pengumuman=$po[id_pengumuman]' class='link-black text-sm'><i class='fa fa-comments-o margin-r-5'></i> Comments
                        ($k[jml])</a></li>
                  </ul>

                 
                </div>
                <!-- /.post -->";
				}

             
              echo"</div>
              <!-- /. akhir tab-pane -->
              

          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->";
  }
	
	 break;  
	
	case "editprofile":
 $ubah = mysqli_query($mysqli, "SELECT * FROM users WHERE id_session='$_SESSION[sessid]'");
    $rk    = mysqli_fetch_array($ubah);


    echo"<!-- Content Wrapper. Contains page content -->
  <div class='content-wrapper'>
    <!-- Content Header (Page header) -->
    <section class='content-header'>
      <h1>
        Edit
        <small>Profile</small>
      </h1>
      <ol class='breadcrumb'>
        <li><a href='?module=home'><i class='fa fa-dashboard'></i> Home</a></li>
        
		<li class='active'>Edit</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class='content'>
      <div class='row'>
        <div class='col-xs-12'><!-- /.box -->

          <div class='box'>
       
          
          <!-- Input addon -->
		  <form action='$aksi?module=profile&act=update' method=POST>

         <input type=hidden name=id value=$rk[nik]>
        <div class='box-body'>
            <div class='form-group'>
			<label>No Hp</label>
               <input type='text' name='hp' class='form-control' placeholder='No Hp' value='$rk[hp]' required>
              </div>
              <br>
			<div class='form-group'>
			<label>Asal Universitas</label>
               <input type='text' name='lulusan' class='form-control' placeholder='Asal Universitas' value='$rk[lulusan]' required>
              </div>
              <br>
			<div class='form-group'>
			<label>Bidang Studi</label>
               <input type='text' name='pelajaran' class='form-control' placeholder='Bidang Studi' value='$rk[pelajaran]' required>
              </div>
              <br>
			  
			<div class='form-group'>
			<label>Alamat</label>
               <input type='text' name='alamat' class='form-control' placeholder='alamat' value='$rk[alamat]' required>
              </div>
              <br>
			<div class='form-group'>
			<label>Ceritakan Tentang</label>
              
			   <div class='box-body pad'>
              
                <textarea class='textarea' name='tentang' placeholder='Tulis keterangan disini'
                          style='width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;'>$rk[tentang]</textarea>
              
            </div>
			</div><br>
				<p class='stdformbutton'>
                                <button class='btn btn-info'>Simpan</button> | 
								<input type=button value=Batal onclick=self.history.back() class='btn btn-warning'>
                            </p>
                    </form>
 </div>
          <!-- /.box -->
      </div>
              <br>
          <!-- /.box -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->";
	  
    break;  
}
?>

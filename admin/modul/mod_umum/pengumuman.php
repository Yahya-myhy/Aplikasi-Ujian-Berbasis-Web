<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
   header('location: index.php');
}
else{
	$aksi="modul/mod_umum/aksi_isi.php";
	
        $tampil=mysqli_query($mysqli,"SELECT * FROM pengumuman,users 
                           WHERE pengumuman.username=users.email AND pengumuman.id_pengumuman='$_GET[id_pengumuman]'");

   							 while($r=mysqli_fetch_array($tampil)){
								 
								 $g=mysqli_fetch_array(mysqli_query($mysqli,"SELECT * FROM users WHERE nik='$r[nik]'"));
     					 $tgl_posting=tgl_indo($r[tgl_posting]);
echo" <!-- Content Wrapper. Contains page content -->
  <div class='content-wrapper'>
    <!-- Content Header (Page header) -->
    <section class='content-header'>
      <h1>
        Profile
      </h1>
      <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-dashboard'></i> Home</a></li>
        <li class='active'>User profile</li>
      </ol>
    </section>
<!-- Main content -->
    <section class='content'>
    <!-- Main content -->
    <section class='content'>

      <div class='row'>
        <div class='col-md-3'>

          <!-- Profile Image -->
          <div class='box box-primary'>
            <div class='box-body box-profile'>";
              
			  
			if($g['foto']='kosong.jpg'){
				
			echo "<img class='profile-user-img img-responsive img-circle' src='../foto_user/small_avatar.png' alt='User profile picture'>";
			}else {
				
				echo "<img class='profile-user-img img-responsive img-circle' src='../foto_user/$g[foto]' alt='User profile picture'>";
			 
			}

             echo "

              <h3 class='profile-username text-center'>$g[nama_lengkap]</h3>

                </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class='box box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'>Tentang saya</h3>
            </div>
            <!-- /.box-header -->
            <div class='box-body'>
              <strong><i class='fa fa-book margin-r-5'></i> Education</strong>

              <p class='text-muted'>
                $g[lulusan]
              </p>

              <hr>

              <strong><i class='fa fa-map-marker margin-r-5'></i> Location</strong>

              <p class='text-muted'>$g[alamat]</p>

              <hr>

             

              <strong><i class='fa fa-file-text-o margin-r-5'></i> Notes</strong>

              <p>$r[about_me]</p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class='col-md-9'><div class='box box-success'>
            <div class='box-header'>
              <i class='fa fa-bell'></i>

              <h3 class='box-title'>kabar $r[nama_lengkap] </h3>
 </div>
         </div>
<div class='box box-widget'>
            <div class='box-header with-border'>
              <div class='user-block'>";
              
			  
			if($r['foto']=='kosong.jpg'){
				
			echo "<img class='img-circle' src='../foto_user/small_avatar.png' >";
			}else {
				
				echo "<img class='img-circle' src='../foto_user/small_$r[foto]' >";
			 
			}

             echo "<span class='username'><a href='media.php?module=profile&id_session=$r[id_session]'>$r[nama_lengkap].</a></span>
                <span class='description'>$tgl_posting</span>
              </div>
              <!-- /.user-block -->
              
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class='box-body'>";
 if ($r['gambar']!=''){
  echo "<img class='img-responsive pad' width='100%' src='../foto_agenda/$r[gambar]' alt='Photo'>";
  }
echo "              <!-- post text -->
              <h4>$r[isi_pengumuman]</h4>
             ";

$komentar = mysqli_query($mysqli,"select count(komentar.id_komentar) as jml from komentar WHERE id_berita='$r[id_pengumuman]' AND aktif='Y'");
  $k = mysqli_fetch_array($komentar); 
  
			 echo"<span class='pull-right text-muted'> <button type='button' class='btn btn-block btn-info'> <i class='fa fa-comments-o'></i> $k[jml] comments</button></span>
            </div>
            <!-- /.box-body -->
            <div class='box-footer box-comments'>";
			
			$sql = mysqli_query($mysqli,"SELECT * FROM komentar,users WHERE komentar.id_berita='$r[id_pengumuman]' AND komentar.email=users.email ORDER BY id_komentar ASC");
  $jml = mysqli_num_rows($sql);
 
 
  while ($s = mysqli_fetch_array($sql)){
  $tanggal = tgl_indo($s['tgl']);
			
			
              echo "<div class='box-comment'>
                <!-- User image -->
                ";
              
			  
			if($s['foto']=='kosong.jpg'){
				
			echo "<img class='img-circle' src='../foto_user/small_avatar.png' >";
			}else {
				
				echo "<img class='img-circle' src='../foto_user/small_$s[foto]' >";
			 
			}

             echo " <div class='comment-text'>
                      <span class='username'>
                         <a href='media.php?module=profile&id_session=$s[id_session]'>$s[nama_komentar]</a>
                        <span class='text-muted pull-right'>$tanggal, $s[jam_komentar]</span>
                      </span><!-- /.username -->
                   $s[isi_komentar]
                </div>
                <!-- /.comment-text -->
              </div>
              <!-- /.box-comment -->";

  }
           
              echo "<form action='$aksi?module=home&act=input' method='POST' id='writecomment'>
			  <input type=hidden name=id value=$r[id_pengumuman]>
                ";
              
			  
			if($_SESSION['foto']=='kosong.jpg'){
				
			echo "<img class='img-responsive img-circle img-sm' src='../foto_user/small_avatar.png' alt='foto_saya'>";
			}else {
				
				echo "<img class='img-responsive img-circle img-sm' src='../foto_user/$_SESSION[foto]' alt='foto_saya'>";
			 
			}

             echo "
                <!-- .img-push is used to add margin to elements next to floating images -->
                <div class='img-push'>
                  <input type='text' name='pesan' class='form-control input-sm' placeholder='Masukan komentar kamu disini'>
                </div>
              </form>
            </div>
            <!-- /.box-footer -->
          </div>";
		  
		  }
		echo "</div>
      <!-- /.row --> </div>

    </section>
    <!-- /.content -->
  </div>";
	}
?>
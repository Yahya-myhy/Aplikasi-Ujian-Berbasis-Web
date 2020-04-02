<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
   header('location: index.php');
}
else{
	$aksi="modul/mod_umum/aksi_isi.php";
	echo 
	"<div class='content-wrapper'>
    <!-- Content Header (Page header) -->
    <section class='content-header'>
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-dashboard'></i> Home</a></li>
        <li class='active'>Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class='content'>

      <!-- /.row -->
      <!-- Main row -->
      <div class='row'>
        <!-- Left col -->
        <section class='col-lg-7 connectedSortable'>
         
          

          <!-- Chat box -->
          <div class='box box-success'>
            <div class='box-header'>
              <i class='fa fa-bell'></i>

              <h3 class='box-title'>Kabar Berita Umum</h3>
 </div>
         </div> 
		 
		 
		   <div class='box box-widget'>
		  <!-- Input addon -->
		 <form method=POST action='$aksi?module=home&act=kabar' enctype='multipart/form-data'>
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
                                <button class='btn btn-info'>Kirim</button> | 
							
                            </p>
                    </form>
    </div>
          <!-- /.box -->
      </div>
		 
		 
		 ";
          
$tampil=mysqli_query($mysqli,"SELECT * FROM pengumuman,users 
                           WHERE pengumuman.username=users.email ORDER BY pengumuman.id_pengumuman DESC");
$no = 1;
   							 while($r=mysqli_fetch_array($tampil)){
     					 $tgl_posting=tgl_indo($r[tgl_posting]);
echo"
<div class='box box-widget'>
            <div class='box-header with-border'>
              <div class='user-block'>
                ";
              
			  
			if($r['foto']=='kosong.jpg'){
				
			echo "<img class='img-circle' src='../foto_user/small_avatar.png' >";
			}else {
				
				echo "<img class='img-circle' src='../foto_user/small_$r[foto]' >";
			 
			}

             echo "<span class='username'><a href='media.php?module=profile&id_session=$r[id_session]'>$r[nama_lengkap].</a></span>
                <span class='description'>$tgl_posting</span>
              </div>
              <!-- /.user-block -->
              <div class='box-tools'>
               
                <button type='button' class='btn btn-box-tool' data-widget='remove'><i class='fa fa-times'></i></button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class='box-body'>";
 if ($r['gambar']!=''){
  echo "<img class='img-responsive pad' width='100%' src='../foto_agenda/$r[gambar]' alt='Photo'>";
  }
echo "              <!-- post text -->
              <h4>$r[isi_pengumuman]</h4>
             <a data-toggle='collapse' data-parent='#accordion' href='#collapse$no'>";

$komentar = mysqli_query($mysqli,"select count(komentar.id_komentar) as jml from komentar WHERE id_berita='$r[id_pengumuman]' AND aktif='Y'");
  $k = mysqli_fetch_array($komentar); 
  
			 echo"<span class='pull-right text-muted'> <button type='button' class='btn btn-block btn-info'> <i class='fa fa-comments-o'></i> $k[jml] comments</button></span></a>
            </div>
            <!-- /.box-body -->
            <div id='collapse$no' class='box-footer box-comments collapse'>";
			
			$sql = mysqli_query($mysqli,"SELECT * FROM komentar,users WHERE komentar.id_berita='$r[id_pengumuman]' AND komentar.email=users.email ORDER BY id_komentar ASC");
  $jml = mysqli_num_rows($sql);
 
 
  while ($s = mysqli_fetch_array($sql)){
  $tanggal = tgl_indo($s['tgl']);
			
			
              echo "<div class='box-comment'>";
              
			  
			if($s['foto']=='kosong.jpg'){
				
			echo "<img class='img-circle' src='../foto_user/small_avatar.png' >";
			}else {
				
				echo "<img class='img-circle' src='../foto_user/small_$s[foto]' >";
			 
			}

             echo "

                <div class='comment-text'>
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
			  <input type=hidden name=id value=$r[id_pengumuman]>";
              
			  
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
		  $no ++;
		  }
          

echo"     </section>
       
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class='col-lg-5 connectedSortable'>

          
          <!-- Calendar -->
          <div class='box box-solid bg-blue-gradient'>
            <div class='box-header'>
              <i class='fa fa-calendar'></i>

              <h3 class='box-title'>Calendar</h3>
              <!-- tools box -->
            
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class='box-body no-padding'>
              <!--The calendar -->
              <div id='calendar' style='width: 100%'></div>
            </div>
            <!-- /.box-body -->
         
          </div>
          <!-- /.box -->
<div class='box box-solid '>
         
		 <img src='../images/iklan/png' height='100%' />
        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->
 
		 </div>
    </section>
    <!-- /.content -->
  </div>";
}
?>
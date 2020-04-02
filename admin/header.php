<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
   header('location: index.php');
}
else{  
include "../config/koneksi.php";
	$id = mysqli_query($mysqli,"SELECT * FROM identitas WHERE id_identitas = '1'");
	$idn    = mysqli_fetch_array($id);

    ?>
	 <header class="main-header">
    <!-- Logo -->
    <a href="?module=home" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b> <?php echo''.$idn['nama_website'].'';?></b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b><?php echo''.$idn['nama_website'].'';?></b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
           <!-- Notifications: style can be found in dropdown.less -->
          
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              	<?php		  
			if($_SESSION[foto]=='kosong.jpg'){
				
			echo "<img class='img-circle' src='../foto_user/small_avatar.png' height='20px'>";
			}else {
				
				echo "<img class='img-circle' src='../foto_user/small_$_SESSION[foto]' height='20px' >";
			 
			}

            ?>

              <span class="hidden-xs">  <?php  echo"$_SESSION[namalengkap]";?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
             	<?php		  
			if($_SESSION[foto]=='kosong.jpg'){
				
			echo "<img class='img-circle' src='../foto_user/small_avatar.png' >";
			}else {
				
				echo "<img class='img-circle' src='../foto_user/small_$_SESSION[foto]' >";
			 
			}

            ?>

                <p>
                  <?php  echo"$_SESSION[namalengkap]";?>
                  
                </p>
              </li>
              <!-- Menu Body -->
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                <a href="media.php?module=profile&id_session=<?php  echo"$_SESSION[sessid]";?>" class="btn btn-primary btn-flat">Lihat Profile</a>
                </div>
                <div class="pull-right">
                    <a href="media.php?module=profile&act=editprofile&id_session=<?php  echo"$_SESSION[sessid]";?>" class="btn btn-danger btn-flat">Edit Profile</a>
                </div>
              </li>
            </ul>
          </li>
            
          
          </li>
          <!-- Control Sidebar Toggle Button -->
          
        </ul>
      </div>
    </nav>
  </header>
  
 <?php
    }
	
    ?>
<?php
if($_SESSION[leveluser]=='guru'){
?>
 <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
	<?php		  
			if($_SESSION[foto]=='kosong.jpg'){
				
			echo "<img class='img-circle' src='../foto_user/small_avatar.png' >";
			}else {
				
				echo "<img class='img-circle' src='../foto_user/small_$_SESSION[foto]' >";
			 
			}

            ?>
        </div>
        <div class="pull-left info">
          <p> <?php 
		  echo"$_SESSION[namalengkap]";?></p>
          <i class="fa fa-circle text-success"></i> <?php 
		  echo"$_SESSION[leveluser]";?>
        </div>
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU</li>
       
       
         <?php
				 //Menu Home
				if ($_GET['module']=='home'){
				echo"<li class='active'>
          <a href='media.php?module=home'>
             <i class='fa fa-dashboard'></i> <span>Dashboard</span>
          </a>
        </li>";
				}else{	
				echo"<li>
          <a href='media.php?module=home'>
             <i class='fa fa-dashboard'></i> <span>Dashboard</span>
          </a>
        </li>";
				}			
       	    //Menu Ujian
				if ($_GET['module']=='ujian'){
				echo"<li class='active'>
          <a href='media.php?module=ujian'>
             <i class='fa fa-edit'></i>  <span> Ujian </span>
          </a>
        </li>";
				}else{	
				echo"<li>
           <a href='media.php?module=ujian'>
             <i class='fa fa-edit'></i>  <span> Ujian </span>
          </a>
        </li>";
				}
			
			 //Menu Status
				if ($_GET['module']=='status'){
				echo"<li class='active'>
          <a href='media.php?module=status'>
             <i class='fa fa-legal'></i>  <span> Status Ujian </span>
          </a>
        </li>";
				}else{	
				echo"<li>
           <a href='media.php?module=status'>
             <i class='fa fa-legal'></i>  <span> Status Ujian </span>
          </a>
        </li>";
				}
				 //Menu Nilai
				if ($_GET['module']=='nilai'){
				echo"<li class='active'>
          <a href='media.php?module=nilai'>
             <i class='fa fa-file-text'></i>  <span> Nilai </span>
          </a>
        </li>";
				}else{	
				echo"<li>
           <a href='media.php?module=nilai'>
             <i class='fa fa-file-text'></i>  <span> Nilai </span>
          </a>
        </li>";
				}
			
			
           echo "<li>
          <a href='logout.php'>
             <i class='fa  fa-sign-out'></i> <span>Logout</span>
          </a>
        </li>"; 
       
     ?>  
      
 </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

       <?php
}else if($_SESSION[leveluser]=='admin user'){
?>
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
	<?php		  
			if($_SESSION[foto]=='kosong.jpg'){
				
			echo "<img class='img-circle' src='../foto_user/small_avatar.png' >";
			}else {
				
				echo "<img class='img-circle' src='../foto_user/small_$_SESSION[foto]' >";
			 
			}

            ?>
        </div>
        <div class="pull-left info">
          <p> <?php 
		  echo"$_SESSION[namalengkap]";?></p>
          <i class="fa fa-circle text-success"></i> <?php 
		  echo"$_SESSION[leveluser]";?>
        </div>
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU</li>
       
        <?php
				 //Menu Home
				if ($_GET['module']=='home'){
				echo"<li class='active'>
          <a href='media.php?module=home'>
             <i class='fa fa-dashboard'></i> <span>Dashboard</span>
          </a>
        </li>";
				}else{	
				echo"<li>
          <a href='media.php?module=home'>
             <i class='fa fa-dashboard'></i> <span>Dashboard</span>
          </a>
        </li>";
				}			
       		//Menu Siswa
				if ($_GET['module']=='siswa'){
				echo"<li class='active'>
          <a href='media.php?module=siswa'>
            <i class='fa fa-users'></i> <span>Kelas/Siswa</span>
          </a>
        </li>";
				}else{	
				echo"<li>
          <a href='media.php?module=siswa'>
            <i class='fa fa-users'></i> <span>Kelas/Siswa</span>
          </a>
        </li>";
				}	
				 //Menu Guru
				if ($_GET['module']=='guru'){
				echo"<li class='active'>
          <a href='media.php?module=guru'>
            <i class='fa fa-user'></i> <span>Guru</span>
          </a>
        </li>";
				}else{	
				echo"<li>
          <a href='media.php?module=guru'>
            <i class='fa fa-user'></i> <span>Guru</span>
          </a>
        </li>";
				}
				//Menu Ujian
				if ($_GET['module']=='ujian'){
				echo"<li class='active'>
          <a href='media.php?module=ujian'>
             <i class='fa fa-edit'></i>  <span> Ujian </span>
          </a>
        </li>";
				}else{	
				echo"<li>
           <a href='media.php?module=ujian'>
             <i class='fa fa-edit'></i>  <span> Ujian </span>
          </a>
        </li>";
				}
			
			 //Menu Status
				if ($_GET['module']=='status'){
				echo"<li class='active'>
          <a href='media.php?module=status'>
             <i class='fa fa-legal'></i>  <span> Status Ujian </span>
          </a>
        </li>";
				}else{	
				echo"<li>
           <a href='media.php?module=status'>
             <i class='fa fa-legal'></i>  <span> Status Ujian </span>
          </a>
        </li>";
				}
				 //Menu Nilai
				if ($_GET['module']=='nilai'){
				echo"<li class='active'>
          <a href='media.php?module=nilai'>
             <i class='fa fa-file-text'></i>  <span> Nilai </span>
          </a>
        </li>";
				}else{	
				echo"<li>
           <a href='media.php?module=nilai'>
             <i class='fa fa-file-text'></i>  <span> Nilai </span>
          </a>
        </li>";
				}
			 //Menu Identitas
				if ($_GET['module']=='identitas'){
				echo"<li class='active'>
          <a href='media.php?module=identitas'>
            <i class='fa fa-user'></i> <span>Identitas</span>
          </a>
        </li>";
				}else{	
				echo"<li>
          <a href='media.php?module=identitas'>
            <i class='fa fa-user'></i> <span>Identitas</span>
          </a>
        </li>";
				}			
       
			
           echo "<li>
          <a href='logout.php'>
             <i class='fa  fa-sign-out'></i> <span>Logout</span>
          </a>
        </li>"; 
       
     ?>  
      
 </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
       
     
       






       
          <?php
}else
{

?>
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../foto_user/<?php  echo"$_SESSION[foto]";?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p> <?php 
		  echo"$_SESSION[namalengkap]";?></p>
          <i class="fa fa-circle text-success"></i> <?php 
		  echo"$_SESSION[leveluser]";?>
        </div>
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU</li>
       
        <?php
				 //Menu Home
				if ($_GET['module']=='home'){
				echo"<li class='active'>
          <a href='media.php?module=home'>
             <i class='fa fa-dashboard'></i> <span>Dashboard</span>
          </a>
        </li>";
				}else{	
				echo"<li>
          <a href='media.php?module=home'>
             <i class='fa fa-dashboard'></i> <span>Dashboard</span>
          </a>
        </li>";
				}			
       	    
           echo "<li>
          <a href='logout.php'>
             <i class='fa  fa-sign-out'></i> <span>Logout</span>
          </a>
        </li>"; 
       
     ?>  
      
 </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
       
     
       
    
        <?php
}

?>
<?php
include "../config/koneksi.php";
$cekuser = mysqli_query($mysqli,"SELECT * FROM users WHERE id_user='1'");
$jmluser = mysqli_num_rows($cekuser);
if($jmluser > 0){
	 header('location: index.php');
} else {
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){

  include "identitas.php";
?>
<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>SBMPTN 2019</title>

<!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap Core CSS -->
    <link href="login/bootstrap.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="login/daftar.css" rel="stylesheet">

<link href="login/font-awesome.css" rel="stylesheet" >

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->


<script type="text/javascript" src="../assets/jquery/jquery-2.0.2.min.js"></script>
<script type="text/javascript">
$(function(){
   $('.alert').hide();
   $('.login-form').submit(function(){
      $('.alert').hide();
      if($('input[name=email]').val() == ""){
         $('.alert').fadeIn().html('<i class="glyphicon glyphicon-envelope"></i> Kotak input <b>Email</b> masih kosong!');
      }else if($('input[name=nik]').val() == ""){
         $('.alert').fadeIn().html('<i class="glyphicon glyphicon-lock"></i> Kotak input <b>NIK</b> masih kosong!');
	  }else if($('input[name=hp]').val() == ""){
         $('.alert').fadeIn().html('<i class="glyphicon glyphicon-lock"></i> Kotak input <b>HP</b> masih kosong!');
	  }else if($('input[name=password]').val() == ""){
         $('.alert').fadeIn().html('<i class="glyphicon glyphicon-lock"></i> Kotak input <b>Password</b> masih kosong!');
	}else if($('input[name=sekolah]').val() == ""){
         $('.alert').fadeIn().html('<i class="glyphicon glyphicon-lock"></i> Kotak input <b>Sekolah</b> masih kosong!');
	}else if($('input[name=nama]').val() == ""){
         $('.alert').fadeIn().html('<i class="glyphicon glyphicon-lock"></i> Kotak input <b>Nama Lengkap</b> masih kosong!');
      }else{
         $.ajax({
            type : "POST",
            url : "lupa.php",
            data : $(this).serialize(),
            success : function(data){
               if(data == "ok") window.location = "sukses.php";
               else $('.alert').fadeIn().html(data);
            }
         });
      }
      return false;
   });


});
</script>

</head>
<body class="hold-transition login-page">
<div class="group">
    <div class="left">
     <img src="../images/07.jpg" alt="Gambar kiri">    
    </div>

<div id="kepala" style="margin-top:0px; color:#86898e; background-color:#e8edf0;">

    </div>
    <div class="right">
	    <div >
        <h3>DAFTAR OPERATOR</h3>
        <p style="color:#8b8a8a">
		Masukan DataLengkap </p>
        <div id="ingat" class="alert">
        </div><form class="login-form">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="number" name="nik" class="form-control" placeholder="NIK" >
              </div><br>

              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" >
              </div>
              <br>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-institution"></i></span>
                <input type="text" name="sekolah" class="form-control" placeholder="Asal Sekolah" >
              </div>
                            <br>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                <input type="number" name="hp" class="form-control" placeholder="NO HP" >
              </div>
              <br><div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input type="email" name="email" class="form-control" placeholder="Masukan Email" >
              </div>
              <br><div class="input-group">
                <span class="input-group-addon"><i class="fa fa-circle"></i></span>
                <input type="password" name="password" class="form-control" placeholder="Masukan Password" >
              </div><br>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-mortar-board"></i></span>
                <select name="tingkat" class="form-control" >
 <option value="smp">SMA</option>


                </select>
              </div><br>
              <p >
  <button type="submit" class="btn btn-info btn-lg btn-small">DAFTAR</button> </p>

                 <!-- /.modal-content -->
          </form>


</div></div></div>
<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
</body>
</html>

<?php
}

else{
	 header('location: media.php?module=home');
}
}
?>

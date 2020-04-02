<?php
session_start();
error_reporting(0);
include "timeout.php";
//fungsi cek akses user

if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){


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

</head>
<body class="hold-transition login-page">
<div class="group">
    <div class="left">
     <img src="../images/07.jpg" alt="Gambar kiri">    
    </div>

<div id="kepala" style="margin-top:0px; color:#86898e; background-color:#e8edf0;"><br>
<h2>SELAMAT </h2>
<br>

    </div>
    <div class="right">
	    <div >
        <h1>SELAMAT</h1>
        <p style="color:#8b8a8a">
		Pendaftaran SUKSES </p>
        <div id="ingat" class="alert">
        <a href="index.php"> <button class="btn btn-info btn-lg btn-small">LOGIN</button></a>
        </div>

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
?>

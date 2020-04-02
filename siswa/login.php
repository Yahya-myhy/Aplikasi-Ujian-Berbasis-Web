<?php
session_start();
ob_start();

//Mengecek status login
if( empty($_SESSION['username']) or empty($_SESSION['password']) ){
   include "../config/koneksi.php";
$identitas = mysqli_query($mysqli,"SELECT * FROM identitas WHERE id_identitas='1'");
$data = mysqli_fetch_array($identitas);
?>
<html>
<head>

<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
 <title><?php echo"$data[nama_website]"; ?></title>
<!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet">
<link media="all" href="../css/header.css" type="text/css" rel="stylesheet">
<link rel="shortcut icon" href="../favicon.png" type="image/x-icon" />
<script type="text/javascript" src="../assets/jquery/jquery-2.0.2.min.js"></script>
<script type="text/javascript">
$(function(){
   $('.alert').hide();
   $('.login-form').submit(function(){
      $('.alert').hide();
      if($('input[name=username]').val() == ""){
         $('.alert').fadeIn().html('Kotak input <b>Username</b> masih kosong!');
      }else if($('input[name=password]').val() == ""){
         $('.alert').fadeIn().html('Kotak input <b>Password</b> masih kosong!');
      }else{
         $.ajax({
            type : "POST",
            url : "login_cek.php",
            data : $(this).serialize(),
            success : function(data){
               if(data == "ok") window.location = "index.php";	
               else $('.alert').fadeIn().html(data);	
            }
         });
      }
      return false;
   });
});
</script>
<script type="text/javascript" src="../assets/jquery/jquery-2.0.2.min.js"></script>
</head>
<body>

<?php include "header.php"; ?>
<div class="container">
		<div class="row">
			<div style="height: 30px;"></div>
		</div>
	</div>	



<div id="notif">
		<div class="container">
			<div class="row">
				<div class="col-md-12 alert" role="alert">
									</div>
			
            </div>
		</div>
	</div>
			

	
	<div class="container">
		<div class="row">
			<div style="height: 84px;"></div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div id="loginbox">
					<div id="logintitle">
						<p>Login Siswa</p>
					</div>
					<div id="loginbody">
						<div style="height: 15px;"></div>
<form class="login-form">
							<table>
							  <tbody><tr>
								
								<td><span class="glyphicon glyphicon-user" aria-hidden="true"></span><input type="text" name="username" placeholder="NIS" autofocus ></td>
								
							  </tr>
							  <tr>
								
								<td><span class="glyphicon glyphicon-lock" aria-hidden="true"></span><input type="password" name="password" placeholder="Password"></td>
								
							  </tr>
							  
							  <tr>
							<td></td>
							</tr>
							  </tbody></table>
					<input value="LOGIN" type="submit">
							
							
						</form>

			  
					</div>
					
				</div>
			</div>
		</div>
	</div>
		<div class="row">
			<div style="height: 75px;"></div>
		</div>
    <div class="summary-log">
    <div class="content">
        <?php echo"$data[nama_website]"; ?>:<strong>1.0.2.1</strong><br>
         </div>
</div>


     
  


</body>
</html>
<?php
} else {
header('location: index.php');
}
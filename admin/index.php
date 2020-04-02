<?php

//fungsi cek akses user

include "../config/koneksi.php";
$cekuser = mysqli_query($mysqli,"SELECT * FROM users WHERE id_user='1'");
$jmluser = mysqli_num_rows($cekuser);
if($jmluser > 0){

if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){

 include "identitas.php";
?>
<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo"$data[nama_website]"; ?></title>

<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->


<script type="text/javascript" src="../assets/jquery/jquery-2.0.2.min.js"></script>
<script type="text/javascript">
$(function(){
   $('.alert').hide();
   $('.login100-form').submit(function(){
      $('.alert').hide();
      if($('input[name=email]').val() == ""){
         $('.alert').fadeIn().html('<i class="glyphicon glyphicon-envelope"></i> Kotak input <b>email</b> masih kosong!');
      }else if($('input[name=password]').val() == ""){
         $('.alert').fadeIn().html('<i class="glyphicon glyphicon-lock"></i> Kotak input <b>Password</b> masih kosong!');
      }else{
         $.ajax({
            type : "POST",
            url : "cek_login.php",
            data : $(this).serialize(),
            success : function(data){
               if(data == "ok") window.location = "media.php?module=home";
               else $('.alert').fadeIn().html(data);
            }
         });
      }
      return false;
   });


});
</script>

</head>
<body style="background-color: #666666;">

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
            <form class="login100-form">
					<span class="login100-form-title p-b-43">
				  LOGIN				</span>
					<div class="login100-form-title p-b-43 alert">
        </div>

					<div class="wrap-input100" >

						<input class="input100" type="email" name="email" placeholder="Email" >


			    </div>


					<div class="wrap-input100" >
						<input class="input100" type="password" name="password" placeholder="Password" >

					</div>



	  <div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn">
							Login
						</button>
					</div>




			  </form>

				<div class="login100-more" style="background-image: url('../images/07.jpg');">
				</div>
			</div>
		</div>
	</div>







</body>
</html>


<?php
}

else{
	 header('location: media.php?module=home');
}
}else{
  header('location: daftar.php');
}
?>

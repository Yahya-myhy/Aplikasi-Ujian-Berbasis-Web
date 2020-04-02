<?php
session_start();
ob_start();

//Mengecek status login
if( empty($_SESSION['username']) or empty($_SESSION['password']) ){
   header('location: login.php');
}
include "../config/koneksi.php";
$identitas = mysqli_query($mysqli,"SELECT * FROM identitas WHERE id_identitas='1'");
$data = mysqli_fetch_array($identitas);
?>

<html>
<head>

<title>UNBK 2017</title>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
 <title><?php echo"$data[nama_website]"; ?></title>

 <link rel="stylesheet" type="text/css" href="../assets/bootstrap/css/bootstrap.min.css"/>
   <link type="text/css" rel="stylesheet" href="../assets/dataTables/css/dataTables.bootstrap.min.css">	
   <script type="text/javascript" src="../assets/jquery/jquery-2.0.2.min.js"></script>
   <script type="text/javascript" src="../assets/bootstrap/js/bootstrap.min.js"></script>
     <script type="text/javascript" src="js/main.js"></script>
    	<link href="css/ujian.css" rel="stylesheet">
<script type="text/javascript" src="js/sidein_menu.js"></script>

<script type="text/javascript" src="js/jquery.min.js"></script>

    <script>
        function disableBackButton() {
            window.history.forward();
        }
        setTimeout("disableBackButton()", 0);
		
    </script>
    
<link href="css/klien.css" rel="stylesheet">

<link href="css/sikil.css" rel="stylesheet">

<script src="js/inline.js"></script>

</head>

<body class="font-medium" style="background-color:#c9c9c9"><div style="visibility: hidden; overflow: hidden; position: absolute; top: 0px; height: 1px; width: auto; padding: 0px; border: 0px none; margin: 0px; text-align: left; text-indent: 0px; text-transform: none; line-height: normal; letter-spacing: normal; word-spacing: normal;"></div>
   
    <div class="container">

        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

<?php include "header.php"; ?>
      
			<div id="isi"></div>   

   

<script src="js/jquery-scrolltofixed.js" type="text/javascript"></script>
<script src="js/masonry.pkgd.min.js"></script>
<script src="js/jquery.cookie.js"></script>
<script src="js/common.js"></script>
<script src="js/main.js"></script>
<script src="js/cookieList.js"></script>
<script src="js/backend.js"></script>

</body>
</html>
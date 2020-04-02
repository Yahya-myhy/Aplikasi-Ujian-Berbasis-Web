<?php
include "../config/koneksi.php";
 $sql  = mysqli_query($mysqli, "SELECT * FROM identitas");
    $r    = mysqli_fetch_array($sql);
if( empty($_SESSION['username']) or empty($_SESSION['password']) ){



   echo "
   <div id='header'>
		<div class='container-fluid'>
			<div class='row'>
				<div class='col-md-12'>
					<div id='logo'>
						<img src='../images/juj.png'>
					</div>
					<div id='welcome'>
						<div id='avatar'>
							<img src='../images/avatar.png'>
						</div>
						<p>Selamat Datang</p>
							<p><b id='nama_siswa'>Silahkan</b></p>
														<p>Login</p>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
  ";
}
else {

	echo "

	   <header style='background-color:rgb(51, 103, 153)'>
<div class='group'>
    <div class='left' style='position: absolute; top: 12px; background-color:rgb(51, 103, 153)'><img src='../images/juj.png' syle=' margin-top: 0px; margin-left: 15px ! important;'>
    </div>

        	<div class='right1'><table width='100%' border='0' cellspacing='5px;' style='margin-top:10px'>
     					<tr>
						<td rowspan='3' width='100px' align='center'>";
						if($_SESSION['foto']='kosong/jpg'){
						echo "<img src='../images/avatar.png' height='60px' width='60px' style=' margin-left:0px; margin-top:5px' class='foto'>";
						} else {
						echo "
						<img src='../foto_user/small_$_SESSION[foto]' height='60px' width='60px' style=' margin-left:0px; margin-top:5px' class='foto'>";}
						echo " </td>
						<td><span  style=' margin-left:0px; margin-top:5px'>Selamat Datang</span></td></tr>
                        <tr><td><span class='user'>$_SESSION[namalengkap]</span></td></tr>
                        <tr><td><span class='log'><a href='logout.php'>Logout</a><span></td></tr>
						</table>
                        </div>

      	</div>
	</div>
</div>
</header>
";
	}
?>

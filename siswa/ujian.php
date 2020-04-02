<script type="text/javascript" src="js/ujian.js"></script>
<script type="text/javascript">
function AlertIt() {
$("#awal").css("display", "block");
$("#ahir").css("display", "none");	
if($("#slideMenu").hasClass('closed')){
				$("#slideMenu").animate({right:0}, 200, function(){
					$(this).removeClass('closed').addClass('opened');
					document.getElementById("kakisoal").style.width = '74%';					
					$("a#toggleLink").removeClass('toggleBtn').addClass('toggleBtnHighlight');
				});
$("#awal").css("display", "block");
$("#ahir").css("display", "none");					
//e.preventDefault();
		//return false;
			}//if close
			if($("#slideMenu").hasClass('opened')){
			
			if ( $(window).width() > 739) {      
				$("#slideMenu").animate({right:-400}, 200, function(){// jika screen kecil gunakan right:-240, untuk lebar right:-400
					$(this).removeClass('opened').addClass('closed');
					document.getElementById("kakisoal").style.width = '97.7%';
					$("a#toggleLink").removeClass('toggleBtnHighlight').addClass('toggleBtn');
				});
			} else if ( $(window).width() > 409) {      
				$("#slideMenu").animate({right:-200}, 200, function(){// jika screen kecil gunakan right:-240, untuk lebar right:-400
					$(this).removeClass('opened').addClass('closed');
					document.getElementById("kakisoal").style.width = '97.7%';
					$("a#toggleLink").removeClass('toggleBtnHighlight').addClass('toggleBtn');
				});
			
			} else {
				$("#slideMenu").animate({right:-240}, 200, function(){// jika screen kecil gunakan right:-240, untuk lebar right:-400
					$(this).removeClass('opened').addClass('closed');
					document.getElementById("kakisoal").style.width = '30%';
					$("a#toggleLink").removeClass('toggleBtnHighlight').addClass('toggleBtn');
				});
}

				

$("#awal").css("display", "none");
$("#ahir").css("display", "block");					
//e.preventDefault();
			}//if close
}
</script>
<script type="text/javascript" src="js/jquery.countdownTimer.js"></script>
<script src="js/kakyusuf.js"></script>
<?php
session_start();
include "../config/koneksi.php"; 

if(empty($_SESSION['username']) or empty($_SESSION['password']) ){
   header('location: login.php');
}

//1 Update status siswa dan membuat array data untuk dimasukkan ke tabel nilai
mysqli_query($mysqli, "UPDATE siswa SET status='mengerjakan' WHERE nis='$_SESSION[nis]'");

$rujian = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM ujian WHERE id_ujian='$_GET[ujian]'"));
if($rujian['acak']=='acak'){
$qsoal = mysqli_query($mysqli, "SELECT * FROM soal WHERE id_ujian='$_GET[ujian]' ORDER BY rand() LIMIT $rujian[jml_soal]");
} else {
$qsoal = mysqli_query($mysqli, "SELECT * FROM soal WHERE id_ujian='$_GET[ujian]' ORDER BY id_soal LIMIT $rujian[jml_soal]");
}
$q2soal = mysqli_query($mysqli, "SELECT * FROM soal WHERE id_ujian='$_GET[ujian]' ORDER BY id_soal");

if(mysqli_num_rows($qsoal)==0) die('<div class="alert alert-warning">Belum ada soal pada ujian ini</div>');

$arr_soal = array();
$arr_jawaban = array();
while($rsoal = mysqli_fetch_array($qsoal)){
   $arr_soal[] = $rsoal['id_soal'];
   $arr_jawaban[] = 0;
}
$soalid = array();
while($r2soal = mysqli_fetch_array($q2soal)){
   $soalid[] = $r2soal['id_soal'];
   }

$acak_soal = implode(",", $arr_soal);
$jawaban = implode(",", $arr_jawaban);


//2 Memasukkan data ke tabel nilai jika data nilai belum ada
$qnilai = mysqli_query($mysqli, "SELECT * FROM nilai WHERE nis='$_SESSION[nis]' AND id_ujian='$_GET[ujian]'");
if(mysqli_num_rows($qnilai) < 1){

$jam = date("H:i:s");
$jm1 = substr($jam,0,2);
$mn1 = substr($jam,3,2);
$dt1 = substr($jam,6,2);
$waktu = date("$rujian[waktu]");
$jm2 = substr($waktu,0,2);
$mn2 = substr($waktu,3,2);
$dt2 = substr($waktu,6,2);
$jam12 = $jm2+$jm1;
$menit = $mn2 + $mn1 ;
$detik = $dt1;
if($menit>60){	
$hr = $jam12 + 1;
$mn = $menit -60;
}
else {	
$hr = $jam12;
$mn = $menit;		
}

$waktuselesai = date ("$hr:$mn:$detik");


   mysqli_query($mysqli, "INSERT INTO nilai SET nis='$_SESSION[nis]', id_ujian='$_GET[ujian]', acak_soal='$acak_soal', jawaban='$jawaban', sisa_waktu='$waktu',waktu_selesai='$waktuselesai'");
 
  $kls = $soalid;
  foreach($kls as $kelas) {
   mysqli_query($mysqli, "INSERT INTO analisis SET nis='$_SESSION[nis]', id_ujian='$_GET[ujian]', id_soal='$kelas', jawaban='0'");
  
  
}
   
} else {

$nil = mysqli_fetch_array($qnilai);

$jam = date("H:i:s");
$jm1 = substr($jam,0,2);
$mn1 = substr($jam,3,2);
$dt1 = substr($jam,6,2);


$selesai = date("$nil[waktu_selesai]");
$jm2 = substr($selesai,0,2);
$mn2 = substr($selesai,3,2);
$dt2 = substr($selesai,6,2);

$mulai = mktime($jm1,$mn1,$dt1); 
$selesai = mktime($jm2,$mn2,$dt2);  

$lama = $selesai - $mulai;

$hr = (int) ($lama / 3600);
$mn = (int) (($lama - ($hr * 3600) ) / 60);
$sc =  $lama - ($hr * 3600) - ($mn * 60) ; 

if($mn < 0){
	mysqli_query($mysqli, "UPDATE nilai SET sisa_waktu = '00:00:01' WHERE nis='$_SESSION[nis]' AND id_ujian='$_GET[ujian]'"); 
}else {
	mysqli_query($mysqli, "UPDATE nilai SET sisa_waktu = '$hr:$mn:$sc' WHERE nis='$_SESSION[nis]' AND id_ujian='$_GET[ujian]'"); 
}	
	}
//3 Menampilkan judul mapel dan sisa waktu
$qnilai = mysqli_query($mysqli, "SELECT * FROM nilai WHERE nis='$_SESSION[nis]' AND id_ujian='$_GET[ujian]'");
$rnilai = mysqli_fetch_array($qnilai);
$sisa_waktu = explode(":", $rnilai['sisa_waktu']);

echo '

<li class="header">
           <div class="main">
           
           <span class="flex-putih">Pelajaran:  </span>
            <span class="flex-item" style="background-color:#06C" id="soal">'.$rujian['judul'].'</span>
             <span class="flex-biru"> <div id="h_timer"></div></span>
			 <span class="flex-abu">Sisa Waktu</span>            
            </div>
        </li>


<input type="hidden" id="ujian" value="'.$_GET['ujian'].'">
<input type="hidden" id="jam" value="'.$sisa_waktu[0].'">
<input type="hidden" id="menit" value="'.$sisa_waktu[1].'">
<input type="hidden" id="detik" value="'.$sisa_waktu[2].'">';

   //4 Mengambil data soal dari database
$arr_soal = explode(",", $rnilai['acak_soal']);
$arr_jawaban = explode(",", $rnilai['jawaban']);
$arr_class = array();

for($s=0; $s<count($arr_soal); $s++){
   $rsoal = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM soal WHERE id_soal='$arr_soal[$s]'"));

//5 Menampilkan no. soal dan soal	
   $no = $s+1;
   $soal = str_replace("../media", "../media", $rsoal['soal']);
   $active = ($no==1) ? "active" : "";
echo ' <div id="picture">
<div class="blok-soal soal-'.$no.' '.$active.'">
 <div id="fontlembarsoal" class="fontlembarsoal">
<span id="hurufsoal"> Soal Nomor :  <a id="jfontsize-d2" style="font-size: 16px; text-decoration: none; cursor: pointer;">&nbsp; '.$no.' &nbsp;</a> </span></div>   
  <div id="lembaran">
<div id="lembaransoal">
<div class="cc-selector">
<p class="soal">'.$soal.'</p><br> 
	<table cellspacing="0px" cellpadding="0px" border="0">
';
   
if ($_SESSION['tingkat']=='smp') {   

//6 Membuat array pilihan dan mengacak pilihan
   $arr_pilihan = array();
   $arr_pilihan[] = array("no" => 1, "pilihan" => $rsoal['pilihan_1']);
   $arr_pilihan[] = array("no" => 2, "pilihan" => $rsoal['pilihan_2']);
   $arr_pilihan[] = array("no" => 3, "pilihan" => $rsoal['pilihan_3']);
   $arr_pilihan[] = array("no" => 4, "pilihan" => $rsoal['pilihan_4']);
   

//7 Menampilkan pilihan	
   $arr_huruf = array("A","B","C","D");	
   $arr_class[$no] = ($arr_jawaban[$s]!=0) ? "ijo" : "";


   for($i=0; $i<=3; $i++){
      $checked = ($arr_jawaban[$s] == $arr_pilihan[$i]['no']) ? "checked" : "";
      $pilihan = str_replace("../media", "../media", $arr_pilihan[$i]['pilihan']);
	   $pilihan = str_replace("p>", "b>", $arr_pilihan[$i]['pilihan']);
      echo '
		<tr>
        <td valign="top">
        
        <input type="radio" name="jawab-'.$no.'" id="huruf-'.$no.'-'.$i.'" '.$checked.'>
          <label for="huruf-'.$no.'-'.$i.'" class="huruf" onclick="kirim_jawaban('.$s.', '.$arr_pilihan[$i]['no'].')">  '.$arr_huruf[$i].'  </label>
 </td>   
        <td class="pilihanjawaban" valign="top">&nbsp; '.$pilihan.' </td></tr>';
   }
}
else {

//6 Membuat array pilihan dan mengacak pilihan
   $arr_pilihan = array();
   $arr_pilihan[] = array("no" => 1, "pilihan" => $rsoal['pilihan_1']);
   $arr_pilihan[] = array("no" => 2, "pilihan" => $rsoal['pilihan_2']);
   $arr_pilihan[] = array("no" => 3, "pilihan" => $rsoal['pilihan_3']);
   $arr_pilihan[] = array("no" => 4, "pilihan" => $rsoal['pilihan_4']);
   $arr_pilihan[] = array("no" => 5, "pilihan" => $rsoal['pilihan_5']);
   

//7 Menampilkan pilihan	
   $arr_huruf = array("A","B","C","D","E");	
   $arr_class[$no] = ($arr_jawaban[$s]!=0) ? "ijo" : "";

	for($i=0; $i<=4; $i++){
      $checked = ($arr_jawaban[$s] == $arr_pilihan[$i]['no']) ? "checked" : "";
      $pilihan = str_replace("../media", "../media", $arr_pilihan[$i]['pilihan']);
	  $pilihan = str_replace("p>", "b>", $arr_pilihan[$i]['pilihan']);
            echo '
		<tr>
        <td valign="top">
        
        <input type="radio" name="jawab-'.$no.'" id="huruf-'.$no.'-'.$i.'" '.$checked.'>
          <label for="huruf-'.$no.'-'.$i.'" class="huruf" onclick="kirim_jawaban('.$s.', '.$arr_pilihan[$i]['no'].')">  '.$arr_huruf[$i].'  </label>
 </td>   
        <td class="pilihanjawaban" valign="top">&nbsp; '.$pilihan.' </td></tr>';
	}
}
		
		echo'
        </table>


 
</div></div></div>
	  

 


<style>
.container1 {
    font-size: 0; /*fix white space*/
	
}
.container1 > div {
    font-size: 16px; /*reset font size*/
    display: inline-block;
    vertical-align: top;
    width: 30.33%;
	border:thin; border-color:#0000FF;
    box-sizing: border-box;
	text-align:left;
	margin-left:20px;

}
@media (max-width: 480px) { /*breakpoint*/
    .container1 > div {
        display: block;
        width: 100%;
		margin-left:20px;
		padding-bottom:15px;
    }
}

</style>
    <style>

.piljwb{
	margin-left:0;    
	border-radius: 30px;
	border-style:solid;
	border-color:#999;
	list-style:none;}


.main {
	margin-right:15px;
	margin-top:10px;
}

.content {
    padding: 20px;
    overflow: hidden;
}
.left {
    float: left;
    width: 680px;
}
.right {
    float: left;
    margin-left: 40px;
}
.summary {
    border: 1px solid #dddddd;
    overflow: hidden;
    margin-top: 20px;
    background-color: white;
}
.summary .caption {
    border-bottom: 1px solid #dddddd;
    background-color: #dddddd;
    font-size: 12pt;
    font-weight: bold;
    padding: 5px;
}
.summary.scroll-to-fixed-fixed {
    margin-top: 0px;
}
.summary.scroll-to-fixed-fixed .caption {
    color: red;
}
.contents {
    width: 150px;
    margin: 10px;
    font-size: 80%;
}
.kakisoal{
	margin-left:15px;
	margin-bottom:10px;
	margin-right:15px;
	background-color:#fff;
	font-size:12px;
	font-weight:bold;
	height:70px;
	left:140px;

	}

.labelprev {
  display: block;
  padding: 10px 10px;
  font-size: 16px;
  margin: 5px auto;  
  background-color: #999;
  border-radius: 2px;
  cursor:pointer;
  width:200px;
  color:#FFF;  
  &:hover {
    cursor: pointer;
  }
}
.labelnext {
  display: block;
  padding: 10px 10px;
  font-size: 16px;
  float:right; 
  margin: 5px auto;   
  background-color: #336898;
  border-radius: 2px;
  cursor:pointer;
  width:200px;
  color:#FFF;  
  &:hover {
    cursor: pointer;
  }
}
input[type="checkbox"] {
  position: relative;
  top: 3px;
  font-size:18px;
    border: 2px solid black;
    width: 20px;
    height: 20px;
    margin: 0;
    padding: 0;
}
.flatRoundedCheckbox
{
    width: 120px;
    height: 40px;
    margin: 20px 50px;
    position: relative;
}
.flatRoundedCheckbox div
{
    width: 100%;
    height:100%;
    background: #d3d3d3;
    border-radius: 50px;
    position: relative;
    top:-30px;
}

</style>

   

<div class="kakisoal" id="kakisoal" style="width: 97.7%;">
 <section class="page-section soal-navigation">
<div class="container1" style="margin-left:-30px;">
     ';
	//8 Menampilkan tombol sebelumnya, ragu-ragu dan berikutnya
 
	   $sebelumnya = $no-1;
   if($no != 1) echo ' <div><a onclick="tampil_soal('.$sebelumnya.')">            
   <button class="btn btn-default btn-prev" >SOAL SEBELUMNYA</button>
      
     </a></div>';
   echo '    <div><label class="labele" style="padding-bottom:10px; padding-top:10px; width:225px">
    <input type="checkbox" autocomplete="off" onchange="ragu_ragu('.$no.')">&nbsp;RAGU-RAGU</label>
	</div>';
	
   $berikutnya = $no+1;
   if($no != count($arr_soal)) echo ' <div><a onclick="tampil_soal('.$berikutnya.')">
<button class="btn btn-primary btn-next activebutton"  style="margin-top:-13px; width:225px"> SOAL BERIKUTNYA</button>                     
               </a></div>';
   else echo ' <div><a  onclick="selesai()">
<button class="btn btn-danger btn-next activebutton"  style="margin-top:-13px; width:225px">SELESAI</button>                     
                 </a></div>';
echo '</div></section></div></div>';
   
}

	 
	echo'
<style>

.labele {
  display: block;
  padding-top:6px;
  padding-bottom:6px;
  font-size: 16px;
  background-color: #eaca08;
  margin-top:-10px;
  padding-left:50px;
  border-radius: 2px;
  cursor:pointer;
  width:210px;
  color:#FFF;  
  &:hover {
    cursor: pointer;
  }
input[type="checkbox"] {
  position: relative;
  top: 3px;
  font-size:18px;
    border: 2px solid black;
    width: 20px;
    height: 20px;
    margin: 0;
    padding: 0;
}

</style>

<style>
#fontlembarsoal{
	margin-top:3px;
	margin-left:15px;
	margin-bottom:0px;
	margin-right:15px;
	background-color:#f0efef;
	font-size:12px;
	font-weight:bold;
	height:45px;
	left:40px;
	padding-top:10px;	
	padding-bottom:3px;	
	}

#tulisansoal{	
	background-color:#fff;
	height:90px;
	font-size:18px;
	font-weight:bold;
	vertical-align:middle;
	top:495px;
}
.tulisansoal{	
	background-color:#fff;
	height:90px;
	font-size:18px;
	font-weight:bold;
	vertical-align:middle;
	top:495px;
}
.nomersoal{	
	top:25px; width:100px;
	background-color:#336898;
	color:#fff;
	height:90px;
	font-size:18px;
	font-weight:bold;
	vertical-align:middle;	
	}	

#lembarsoal{
	margin-top:-8px;
	margin-left:15px;
	margin-bottom:2px;
	margin-right:15px;
	background-color:#fff;
	height:150%;
	    border-radius: 30px;
	border-style:solid;
	border-color:#999;
	}	
	
#hurufsoal{
    padding-left: 30px;
	padding-top:2px;
	padding-bottom:2px;
}

#tampilkan {
    background-color: #336898;
    width: 150px;
    height: 50px;
    margin-right: 20px;
	margin-top:-10px;
    line-height: 20px;
    color: white;
    font-size: 22px;
    text-align: center;
	padding-left:12px;
	padding-right:12px;	
	padding-top:14px;
	padding-bottom:14px;
	float:right;
}	
#kotaksoal{
	width:97%;
	margin:0px auto;
	padding:20px;
	border:solid;
	top:30px;
	border-color:#CCC;
	
}
p{
	padding:20px;
	font-size: 16px;
	}
li{
	list-style:none;
	font-size:18px;
	}

	#lembaran{
	padding:20px;
	margin-left:12px;
	margin-right:12px;
	top:-30px;
	font-size: 12pt;
	background-color:#fff;
	border:solid;
	border-color:#ccc;
	}	
	#lembaransoal{
	padding:20px;
	font-size: 12pt;
	border:solid;
	border-color:#ccc;
	}	
.soal	{
	font-size: 16pt;
	}
.jawaban	{
	padding-bottom:10px;
	font-size: 10pt;
	border:solid;
	border-color:#CCC;
	}	
.pilihanjawaban	{
	font-size: 16pt;
	padding-bottom:15px;
	}	

.noti-jawab {
    position:absolute;
    background-color:white;
    color:#999;
    padding:4px;
    -webkit-border-radius: 30px;
    -moz-border-radius: 30px;
    border-radius: 30px;
	border-style:solid;
	border-color:#999;
    width:30px;
    height:30px;
    text-align:center;
}

	
    </style>
    
<style>
.jawaban	{
	padding-bottom:10px;
	font-size: 10pt;
	border:solid;
	border-color:#CCC;
	}	
.noti-jawab {
    position:absolute;
    background-color:white;
    color:#999;
    padding:4px;
    -webkit-border-radius: 30px;
    -moz-border-radius: 30px;
    border-radius: 30px;
	border-style:solid;
	border-color:#999;
    width:27px;
    height:27px;
    text-align:center;
}

.flatRoundedCheckbox
{
    width: 120px;
    height: 40px;
    margin: 20px 50px;
    position: relative;
}
.flatRoundedCheckbox div
{
    width: 100%;
    height:100%;
    background: #d3d3d3;
    border-radius: 50px;
    position: relative;
    top:-30px;
}  		

.piljwb{
	margin-left:0;    
	border-radius: 30px;
	border-style:solid;
	border-color:#999;
	list-style:none;}

</style>
<!-- Slider !-->

<style>

#slideMenu.closed{
	right:-400px;
}

#slideMenu{
	position:fixed;
	right:0;
	top:120px;
	width:358px;
	height:500px;
	border-left:0px;
	background-color:#efefef;
	z-index:20;
}

#slideMenu a.toggleBtn{
	position:absolute;
	left:-440px;
	margin-left:300px;
	top:0;
	outline:none;
	display:block;
	height:50px;
	background-color:#e46f69;
	width:98px;
	border-width:1px 1px 1px 0px;
	padding:0 5px 0;
	color:#000;
	text-decoration:none;
	font:12px/25px Verdana, Arial, Helvetica, sans-serif;
	z-index:0;
}

#slideMenu a.toggleBtnHighlight{
	position:absolute;
	right:0px;
	margin-right:400px;	
	top:0;
	outline:none;
	display:block;
	height:47px;
	background-color:#e46f69;	
	width:35px;
	border-width:1px 1px 1px 0px;
	padding:0 5px 0;
	color:#000;
	text-decoration:none;
	font:12px/25px Verdana, Arial, Helvetica, sans-serif;
	z-index:0;
}

.contente{
	margin-top:20px;
	margin-left:20px;
	margin-bottom:20px;
	margin-right:20px;
	width:330px;
	z-index:20;
	border-style:solid;
	border:thin;
	border-color:#ccc;
	padding:20px;
	background-color:#FFF;
	overflow:scroll; height:460px;
	font:12px/25px Verdana, Arial, Helvetica, sans-serif;
}

@media (max-width: 500px) { /*breakpoint*/

	#slideMenu.closed{
		right:-240px;
	}
	
	#slideMenu{
		position:fixed;
		right:0;
		top:100px;
		width:238px;
		height:200px;
		border-left:0px;
		/*background-color:#efefef;*/
		background-color:#efefef;
		z-index:20;
	}
	#slideMenu a.toggleBtn{
		position:absolute;
		left:-260px;
		margin-left:160px;
		top:0;
		outline:none;
		display:block;
		height:50px;
		background-color:#e46f69;
		width:98px;
		border-width:1px 1px 1px 0px;
		padding:0 5px 0;
		color:#000;
		text-decoration:none;
		font:12px/25px Verdana, Arial, Helvetica, sans-serif;
		z-index:0;
	}
	#slideMenu a.toggleBtnHighlight{
		position:absolute;
		right:0px;
		margin-right:280px;	
		top:0;
		outline:none;
		display:block;
		height:47px;
		background-color:#e46f69;	
		width:35px;
		border-width:1px 1px 1px 0px;
		padding:0 5px 0;
		color:#000;
		text-decoration:none;
		font:12px/25px Verdana, Arial, Helvetica, sans-serif;
		z-index:60;
	}
	.contente{
		margin-top:20px;
		margin-left:20px;
		margin-bottom:20px;
		margin-right:20px;
		width:200px;
		z-index:20;
		border-style:solid;
		border:thin;
		border-color:#ccc;
		padding:20px;
		background-color:#FFF;
		overflow:scroll; height:160px;
		font:12px/25px Verdana, Arial, Helvetica, sans-serif;
	}
		
}

#noti-count {
    position:absolute;
    top:-12px;
    right:-15px;
    background-color:white;
    color:#313132;
    padding:5px;
    -webkit-border-radius: 30px;
    -moz-border-radius: 30px;
    border-radius: 30px;
	border-style:solid;
	border-color:#313132;
    width:27px;
    height:27px;
    text-align:center;
}








#noti-count div {
    margin-top:-5px;
}
</style>
<div id="slideMenu" class="closed" style="right: -400px;">
	<div class="contente">
<style>
#awal{
	color:#FFF;
	font-family:Arial, Helvetica, sans-serif;
	line-height: 90%;
	margin:0px auto;
	margin-top:20px;
}
#ahir{
	color:#FFF;
	font-family:Arial, Helvetica, sans-serif;
	line-height: 120%;
	margin:0px auto;
	margin-top:10px;
}
#noti-count {
    position:absolute;
    top:-12px;
    right:-15px;
    background-color:white;
    color:#313132;
    padding:5px;
    -webkit-border-radius: 30px;
    -moz-border-radius: 30px;
    border-radius: 30px;
	border-style:solid;
	border-color:#313132;
    width:30px;
    height:30px;
    text-align:center;
}
#noti-count div {
    margin-top:-5px;
}
</style>


<div id="container" style="text-align: center; height: 67px; position: relative;">';
//9 Menampilkan nomor ujian
$arr_huruf = array("0","A","B","C","D","E");  
for($j=1; $j<=$s; $j++){   
	$n = $j - 1;
	$lk =$arr_jawaban[$n]; 
   echo ' <a onclick="tampil_soal('.$j.')" class="item  item-'.$j.' '.$arr_class[$j].'" id="tombil"> 
             <div   id="kotakz'.$j.'" >
           <p style="margin-top:-9px; margin-left:-9px; font-family:Arial, Helvetica, sans-serif; font-size:24px align="center"">
		   		  '.$j.'</p>
           <div id="noti-count" style="border-color:#336898"><div>
	<span id="pilja'.$j.'">'.$arr_huruf[$lk].'</span>    
           </div></div></div></a>';
}    
           echo'<br><br><br><br><br>
    
        </div>

    <style>
        #container
        {
			height:300px;
        }
        
        .item
        {
            width: 50px;
            height: 50px;
			border:#313132;
			color:#fff;
			border-style:solid;
            margin-bottom: 17px;
			font-size:22px;
			line-height:normal;
			position: absolute; 
			left: 72px; 
			top: 0px;
			background-color: rgb(49, 49, 50);
			color: rgb(255, 255, 255); 
			border-color: rgb(49, 49, 50); 
        }
/*Mengatur warna tombol nomor soal*/
.ijo{
background-color: rgb(0, 128, 0);
border-color: rgb(0, 128, 0);
}
.yellow{
	background-color: rgb(234, 202, 8); 
	border-color: rgb(234, 202, 8);
}
.biru{
background-color: rgb(51, 104, 152); 
border-color: rgb(51, 104, 152);

}


    </style>
</div>
	<a style="top:150px; right: -42px;" href="javascript:AlertIt();" class="toggleBtn" id="toggleLink">
    <div id="awal" style="display: none;" align="center"><font size="+3"> &gt; </font></div>
    <div id="ahir" style="display: block;"> <table border="0"><tbody><tr><td width="50px" valign="middle" align="center"><font size="+3" color="#FFFFFF">&lt; </font></td><td> 	
    <font size="-1" color="#FFFFFF">DAFTAR</font> <br><font size="-1" color="#FFFFFF"> SOAL</font></td></tr></tbody></table>
    </div></a>
</div>
';

      

   
 


//10 Menampilkan modal ketika selesai ujian
echo '                  <!-- Modal -->
<div class="modal fade" id="modal-selesai" role="dialog">
    <div class="modal-dialog">
<form  onsubmit="return selesai_ujian('.$_GET['ujian'].')">
           <!-- Modal content-->
        <div class="modal-content">
            <div class="panel-default">
                <div class="panel-heading">
                    <h1 class="panel-title page-label">Konfirmasi Tes</h1>
                </div>
                <div class="panel-body">
                    <div class="inner-content">
                        <div class="wysiwyg-content">
                            <p>
                                Terimakasih telah berpartisipasi dalam tes ini.<br>
                                Silahkan klik tombol SELESAI untuk mengakhiri test.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="row" style="background-color:#fff">
                        <div class="col-xs-offset-3 col-xs-6">
						 

                            <button type="submit" class="btn btn-success"  onclick="return selesai_ujian('.$_GET['ujian'].')">SELESAI</button>
                            <button type="submit" class="btn btn-danger" data-dismiss="modal">TIDAK</button>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </form>
 </div>

';
?>

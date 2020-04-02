 <?php
include "../config/koneksi.php";
include "../config/library.php";



// Bagian Home
if ($_GET['module']=='home'){
include "modul/mod_umum/home.php";
}

// Bagian Operator
elseif ($_GET['module']=='guru'){
include "modul/mod_operator/guru.php";
}
elseif ($_GET['module']=='siswa'){
include "modul/mod_operator/siswa.php";
}
elseif ($_GET['module']=='identitas'){
include "modul/mod_identitas/identitas.php";
}


// Bagian Guru
// Bagian Soal
elseif ($_GET['module']=='soal'){
include "modul/mod_guru/soal.php";
}
// Bagian Soal
elseif ($_GET['module']=='status'){
include "modul/mod_guru/status.php";
}
// Bagian Nilai
elseif ($_GET['module']=='nilai'){
include "modul/mod_guru/nilai.php";
}

// Bagian KAbar
elseif ($_GET['module']=='kabar'){
include "modul/mod_guru/kabar.php";
}
// Bagian Ujian
elseif ($_GET['module']=='ujian'){
include "modul/mod_guru/ujian.php";
}



// Bagian profile
elseif ($_GET['module']=='profile'){
include "modul/mod_umum/profile.php";
}
elseif ($_GET['module']=='pengumuman'){
include "modul/mod_umum/pengumuman.php";
}


// Apabila modul tidak ditemukan
else{
  echo "<p><b>MODUL BELUM ADA ATAU BELUM LENGKAP</b></p>";
}
?>

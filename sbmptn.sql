-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 27 Mar 2019 pada 06.03
-- Versi Server: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uk`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `analisis`
--

CREATE TABLE `analisis` (
  `id_analisis` int(100) NOT NULL,
  `id_ujian` int(100) NOT NULL,
  `id_soal` int(100) NOT NULL,
  `nis` int(100) NOT NULL,
  `jawaban` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `identitas`
--

CREATE TABLE `identitas` (
  `id_identitas` int(5) NOT NULL,
  `nama_website` varchar(100) NOT NULL,
  `pembuka` varchar(50) NOT NULL,
  `url` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `facebook` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `instagram` varchar(100) NOT NULL,
  `twitter` varchar(100) NOT NULL,
  `meta_deskripsi` varchar(250) NOT NULL,
  `meta_keyword` varchar(250) NOT NULL,
  `title` varchar(100) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `gambar2` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `identitas`
--

INSERT INTO `identitas` (`id_identitas`, `nama_website`, `pembuka`, `url`, `email`, `facebook`, `instagram`, `twitter`, `meta_deskripsi`, `meta_keyword`, `title`, `gambar`, `gambar2`) VALUES
(1, 'DEMO', 'Selamat Datang', 'https://kakyusuf.com/sekolahdemo', 'admin@kakyusuf.com', 'https://www.facebook.com/tutorialkkyusuf/', 'https://plus.google.com/u/0/118001942745164139715', 'https://plus.google.com/u/0/118001942745164139715', 'website sekolah Demo', 'sekolah, website, gratis', 'unbk', 'logo.png', '1.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `katajelek`
--

CREATE TABLE `katajelek` (
  `id_jelek` int(11) NOT NULL,
  `kata` varchar(60) COLLATE latin1_general_ci DEFAULT NULL,
  `ganti` varchar(60) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(5) NOT NULL,
  `tingkat` varchar(5) NOT NULL,
  `nama_kelas` varchar(20) NOT NULL,
  `sekolah` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas_ujian`
--

CREATE TABLE `kelas_ujian` (
  `id_ujian` int(5) NOT NULL,
  `id_kelas` int(5) NOT NULL,
  `aktif` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `komentar`
--

CREATE TABLE `komentar` (
  `id_komentar` int(5) NOT NULL,
  `id_berita` int(5) NOT NULL,
  `nama_komentar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `url` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `isi_komentar` text COLLATE latin1_general_ci NOT NULL,
  `tgl` date NOT NULL,
  `jam_komentar` time NOT NULL,
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int(10) NOT NULL,
  `nis` varchar(20) NOT NULL,
  `kelas` int(11) NOT NULL,
  `id_ujian` varchar(100) NOT NULL,
  `acak_soal` text NOT NULL,
  `jawaban` text NOT NULL,
  `sisa_waktu` time NOT NULL,
  `waktu_selesai` time NOT NULL,
  `jml_benar` int(5) NOT NULL,
  `jml_kosong` int(5) NOT NULL,
  `jml_salah` int(5) NOT NULL,
  `nilai` varchar(5) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemberitahuan`
--

CREATE TABLE `pemberitahuan` (
  `id_pemberitahuan` int(100) NOT NULL,
  `id_user` int(100) NOT NULL,
  `pesan` varchar(28) NOT NULL,
  `icon` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id_pengumuman` int(5) NOT NULL,
  `tema` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `sekolah` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `isi_pengumuman` text COLLATE latin1_general_ci NOT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tgl_posting` date NOT NULL,
  `dibaca` int(5) NOT NULL DEFAULT '1',
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `nis` int(100) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `id_kelas` int(5) NOT NULL,
  `status` varchar(20) NOT NULL,
  `waktu` varchar(20) NOT NULL,
  `sekolah` varchar(100) NOT NULL,
  `tingkat` varchar(3) NOT NULL,
  `email` varchar(100) NOT NULL,
  `foto` varchar(100) NOT NULL DEFAULT 'kosong.jpg',
  `level` varchar(100) NOT NULL,
  `id_session` varchar(50) NOT NULL,
  `hp` varchar(20) NOT NULL,
  `wali` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `tentang` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `soal`
--

CREATE TABLE `soal` (
  `id_soal` int(5) NOT NULL,
  `id_ujian` int(5) NOT NULL,
  `soal` text NOT NULL,
  `pilihan_1` text NOT NULL,
  `pilihan_2` text NOT NULL,
  `pilihan_3` text NOT NULL,
  `pilihan_4` text NOT NULL,
  `pilihan_5` text NOT NULL,
  `kunci` int(2) NOT NULL,
  `urut` int(5) NOT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ujian`
--

CREATE TABLE `ujian` (
  `id_ujian` int(5) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `nama_mapel` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `tanggal_akhir` date NOT NULL,
  `waktu` time NOT NULL,
  `jml_soal` int(3) NOT NULL,
  `id_user` int(5) NOT NULL,
  `sekolah` varchar(100) NOT NULL,
  `acak` varchar(100) NOT NULL,
  `tipe` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `id_kelas` int(5) NOT NULL,
  `password` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `nama_lengkap` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `foto` varchar(100) COLLATE latin1_general_ci NOT NULL DEFAULT 'kosong.jpg',
  `level` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT 'user',
  `blokir` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `id_user` int(5) NOT NULL,
  `nik` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `walikelas` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `id_session` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `status` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `sekolah` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tingkat` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `paas` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tentang` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `alamat` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `lulusan` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `hp` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `pelajaran` varchar(100) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `analisis`
--
ALTER TABLE `analisis`
  ADD PRIMARY KEY (`id_analisis`);

--
-- Indexes for table `identitas`
--
ALTER TABLE `identitas`
  ADD PRIMARY KEY (`id_identitas`);

--
-- Indexes for table `katajelek`
--
ALTER TABLE `katajelek`
  ADD PRIMARY KEY (`id_jelek`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id_komentar`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indexes for table `pemberitahuan`
--
ALTER TABLE `pemberitahuan`
  ADD PRIMARY KEY (`id_pemberitahuan`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id_pengumuman`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nis`);

--
-- Indexes for table `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`id_soal`);

--
-- Indexes for table `ujian`
--
ALTER TABLE `ujian`
  ADD PRIMARY KEY (`id_ujian`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `analisis`
--
ALTER TABLE `analisis`
  MODIFY `id_analisis` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `identitas`
--
ALTER TABLE `identitas`
  MODIFY `id_identitas` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `katajelek`
--
ALTER TABLE `katajelek`
  MODIFY `id_jelek` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id_komentar` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pemberitahuan`
--
ALTER TABLE `pemberitahuan`
  MODIFY `id_pemberitahuan` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id_pengumuman` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `nis` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `soal`
--
ALTER TABLE `soal`
  MODIFY `id_soal` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ujian`
--
ALTER TABLE `ujian`
  MODIFY `id_ujian` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

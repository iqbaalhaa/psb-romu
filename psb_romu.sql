-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 28, 2025 at 05:08 PM
-- Server version: 9.1.0
-- PHP Version: 8.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `psb_romu`
--

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

DROP TABLE IF EXISTS `pengumuman`;
CREATE TABLE IF NOT EXISTS `pengumuman` (
  `id_pengumuman` int NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id_pengumuman`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`id_pengumuman`, `judul`, `isi`, `tanggal`) VALUES
(1, 'Pendaftaran Santri Baru', 'Pendaftaran: 01 Maret 2025 s/d 31 Mei 2025\r\nKUOTA TERBATAS!\r\nBuruan Daftar', '2025-02-03');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_berkas_santri`
--

DROP TABLE IF EXISTS `tbl_berkas_santri`;
CREATE TABLE IF NOT EXISTS `tbl_berkas_santri` (
  `id_berkas` int NOT NULL AUTO_INCREMENT,
  `id_santri` int DEFAULT NULL,
  `berkas_ijazah` varchar(255) DEFAULT NULL,
  `berkas_skhun` varchar(255) DEFAULT NULL,
  `berkas_kk` varchar(255) DEFAULT NULL,
  `berkas_akta` varchar(255) DEFAULT NULL,
  `berkas_ktp_ayah` varchar(255) DEFAULT NULL,
  `berkas_ktp_ibu` varchar(255) DEFAULT NULL,
  `status_berkas` enum('Belum Lengkap','Menunggu Verifikasi','Terverifikasi') DEFAULT 'Belum Lengkap',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_berkas`),
  KEY `id_santri` (`id_santri`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_berkas_santri`
--

INSERT INTO `tbl_berkas_santri` (`id_berkas`, `id_santri`, `berkas_ijazah`, `berkas_skhun`, `berkas_kk`, `berkas_akta`, `berkas_ktp_ayah`, `berkas_ktp_ibu`, `status_berkas`, `created_at`, `updated_at`) VALUES
(8, 8, '1739433632_e930f935178e180944c7.jpg', '1739433648_2f460221a4f3759c908c.jpg', '1739433611_0f6cd24ad753ddd210b8.jpg', '1739433622_74be9d4e7433ec61f96d.jpg', '1739433658_fbd1dc31e96245a608d3.jpg', '1739433666_c742996f5a96169494bc.jpg', 'Terverifikasi', '2025-02-13 01:00:11', '2025-02-13 08:06:58'),
(10, 11, NULL, NULL, '1740165096_553ff1eee951dbc9788d.jpg', '1740228423_950cf6e563d893169412.jpg', NULL, NULL, 'Menunggu Verifikasi', '2025-02-21 12:11:36', '2025-02-22 05:47:03'),
(11, 12, NULL, NULL, '1740557002_d880bf47335f57c3c227.jpg', NULL, NULL, NULL, 'Terverifikasi', '2025-02-26 01:03:22', '2025-02-26 08:06:42');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_detail_santri`
--

DROP TABLE IF EXISTS `tbl_detail_santri`;
CREATE TABLE IF NOT EXISTS `tbl_detail_santri` (
  `id_detail` int NOT NULL AUTO_INCREMENT,
  `id_santri` int DEFAULT NULL,
  `alamat` text,
  `desa` varchar(100) DEFAULT NULL,
  `kecamatan` varchar(100) DEFAULT NULL,
  `kabupaten` varchar(100) DEFAULT NULL,
  `provinsi` varchar(100) DEFAULT NULL,
  `kode_pos` varchar(10) DEFAULT NULL,
  `nama_ayah` varchar(100) DEFAULT NULL,
  `nik_ayah` varchar(16) DEFAULT NULL,
  `pendidikan_ayah` varchar(50) DEFAULT NULL,
  `pekerjaan_ayah` varchar(100) DEFAULT NULL,
  `penghasilan_ayah` varchar(50) DEFAULT NULL,
  `no_hp_ayah` varchar(15) DEFAULT NULL,
  `nama_ibu` varchar(100) DEFAULT NULL,
  `nik_ibu` varchar(16) DEFAULT NULL,
  `pendidikan_ibu` varchar(50) DEFAULT NULL,
  `pekerjaan_ibu` varchar(100) DEFAULT NULL,
  `penghasilan_ibu` varchar(50) DEFAULT NULL,
  `no_hp_ibu` varchar(15) DEFAULT NULL,
  `nama_wali` varchar(100) DEFAULT NULL,
  `nik_wali` varchar(16) DEFAULT NULL,
  `pendidikan_wali` varchar(50) DEFAULT NULL,
  `pekerjaan_wali` varchar(100) DEFAULT NULL,
  `penghasilan_wali` varchar(50) DEFAULT NULL,
  `no_hp_wali` varchar(15) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_detail`),
  KEY `id_santri` (`id_santri`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_detail_santri`
--

INSERT INTO `tbl_detail_santri` (`id_detail`, `id_santri`, `alamat`, `desa`, `kecamatan`, `kabupaten`, `provinsi`, `kode_pos`, `nama_ayah`, `nik_ayah`, `pendidikan_ayah`, `pekerjaan_ayah`, `penghasilan_ayah`, `no_hp_ayah`, `nama_ibu`, `nik_ibu`, `pendidikan_ibu`, `pekerjaan_ibu`, `penghasilan_ibu`, `no_hp_ibu`, `nama_wali`, `nik_wali`, `pendidikan_wali`, `pekerjaan_wali`, `penghasilan_wali`, `no_hp_wali`, `created_at`, `updated_at`) VALUES
(3, 11, 'tyuyugtu', 'ere', 'ere', 'ere', 'rt', '12345', 'er', '9807645321457698', 'SD/MI', 'uy', '< 500.000', '08998786678', 'try', '1256349867090563', 'SD/MI', 'uyt', '< 500.000', '098765432187', 'ytyr', '0897645321789054', 'SD/MI', 'ui', '< 500.000', '098765431267', '2025-02-21 12:03:34', '2025-02-22 05:29:57');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jurusan`
--

DROP TABLE IF EXISTS `tbl_jurusan`;
CREATE TABLE IF NOT EXISTS `tbl_jurusan` (
  `id_jurusan` int NOT NULL AUTO_INCREMENT,
  `nama_jurusan` varchar(100) NOT NULL,
  `kuota` int DEFAULT '0',
  `is_active` enum('0','1') DEFAULT '1',
  PRIMARY KEY (`id_jurusan`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_jurusan`
--

INSERT INTO `tbl_jurusan` (`id_jurusan`, `nama_jurusan`, `kuota`, `is_active`) VALUES
(1, 'Ilmu Pengetahuan Alam (IPA)', 150, '1'),
(2, 'Ilmu Pengetahuan Sosial (IPS)', 150, '1'),
(8, 'MAK', 150, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ortu`
--

DROP TABLE IF EXISTS `tbl_ortu`;
CREATE TABLE IF NOT EXISTS `tbl_ortu` (
  `id_ortu` int NOT NULL AUTO_INCREMENT,
  `id_santri` int DEFAULT NULL,
  `nama_ayah` varchar(100) DEFAULT NULL,
  `nik_ayah` varchar(16) DEFAULT NULL,
  `pendidikan_ayah` varchar(50) DEFAULT NULL,
  `pekerjaan_ayah` varchar(50) DEFAULT NULL,
  `penghasilan_ayah` varchar(50) DEFAULT NULL,
  `no_hp_ayah` varchar(15) DEFAULT NULL,
  `nama_ibu` varchar(100) DEFAULT NULL,
  `nik_ibu` varchar(16) DEFAULT NULL,
  `pendidikan_ibu` varchar(50) DEFAULT NULL,
  `pekerjaan_ibu` varchar(50) DEFAULT NULL,
  `penghasilan_ibu` varchar(50) DEFAULT NULL,
  `no_hp_ibu` varchar(15) DEFAULT NULL,
  `nama_wali` varchar(100) DEFAULT NULL,
  `nik_wali` varchar(16) DEFAULT NULL,
  `pendidikan_wali` varchar(50) DEFAULT NULL,
  `pekerjaan_wali` varchar(50) DEFAULT NULL,
  `penghasilan_wali` varchar(50) DEFAULT NULL,
  `no_hp_wali` varchar(15) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_ortu`),
  KEY `id_santri` (`id_santri`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pembayaran`
--

DROP TABLE IF EXISTS `tbl_pembayaran`;
CREATE TABLE IF NOT EXISTS `tbl_pembayaran` (
  `id_pembayaran` int NOT NULL AUTO_INCREMENT,
  `id_santri` int NOT NULL,
  `no_pendaftaran` varchar(20) NOT NULL,
  `tgl_upload` datetime NOT NULL,
  `bukti_pembayaran` varchar(255) NOT NULL,
  `status_pembayaran` int NOT NULL DEFAULT '0',
  `updated_at` datetime DEFAULT NULL,
  `alasan_tolak` text,
  PRIMARY KEY (`id_pembayaran`),
  KEY `id_santri` (`id_santri`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_pembayaran`
--

INSERT INTO `tbl_pembayaran` (`id_pembayaran`, `id_santri`, `no_pendaftaran`, `tgl_upload`, `bukti_pembayaran`, `status_pembayaran`, `updated_at`, `alasan_tolak`) VALUES
(1, 2, 'MTs20250002', '2025-01-30 11:55:57', '1738238157_e3270de4273c34b82c7b.jpg', 2, '2025-01-31 18:15:05', NULL),
(2, 3, 'MA20250001', '2025-01-31 18:20:42', '1738347642_746b55cad8eab0b6402d.jpeg', 2, '2025-01-31 18:21:42', NULL),
(4, 4, 'MTs-2025-0001', '2025-02-03 14:07:44', '1738591664_238eb3004253a5380144.jpeg', 2, '2025-02-03 14:08:30', NULL),
(7, 8, 'MTs-2025-0008', '2025-02-13 07:58:35', '1739777812_e1588d47f357f06c44e0.jpg', 2, '2025-02-20 17:38:48', NULL),
(9, 11, 'MA-2025-0009', '2025-02-22 12:41:49', '1740228109_c9d6587709fc5d250b6f.jpg', 0, '2025-02-22 12:43:19', 'kjkhug'),
(10, 12, 'MA-2025-0012', '2025-02-26 08:14:02', '1740557642_78dfe93223ca3692571a.jpg', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pilihan_jurusan`
--

DROP TABLE IF EXISTS `tbl_pilihan_jurusan`;
CREATE TABLE IF NOT EXISTS `tbl_pilihan_jurusan` (
  `id_pilihan` int NOT NULL AUTO_INCREMENT,
  `id_santri` int DEFAULT NULL,
  `id_jurusan` int DEFAULT NULL,
  `pilihan_ke` enum('1','2') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_pilihan`),
  KEY `id_santri` (`id_santri`),
  KEY `id_jurusan` (`id_jurusan`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_santri`
--

DROP TABLE IF EXISTS `tbl_santri`;
CREATE TABLE IF NOT EXISTS `tbl_santri` (
  `id_santri` int NOT NULL AUTO_INCREMENT,
  `id_user` int DEFAULT NULL,
  `no_pendaftaran` varchar(20) DEFAULT NULL,
  `nisn` varchar(20) DEFAULT NULL,
  `nik` varchar(16) DEFAULT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `asal_sekolah` varchar(100) DEFAULT NULL,
  `jenjang` enum('MTs','MA') DEFAULT NULL,
  `gelombang` int NOT NULL DEFAULT '1' COMMENT '1=Gelombang 1, 2=Gelombang 2',
  `tahun_daftar` year DEFAULT NULL,
  `status_pendaftaran` enum('Menunggu Verifikasi','Berkas Diterima','Lulus Tes','Diterima','Ditolak') DEFAULT 'Menunggu Verifikasi',
  `status_berkas` int NOT NULL DEFAULT '0' COMMENT '0=belum lengkap, 1=lengkap',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_santri`),
  UNIQUE KEY `no_pendaftaran` (`no_pendaftaran`),
  UNIQUE KEY `nisn` (`nisn`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_santri`
--

INSERT INTO `tbl_santri` (`id_santri`, `id_user`, `no_pendaftaran`, `nisn`, `nik`, `nama_lengkap`, `tempat_lahir`, `tgl_lahir`, `jenis_kelamin`, `no_hp`, `asal_sekolah`, `jenjang`, `gelombang`, `tahun_daftar`, `status_pendaftaran`, `status_berkas`, `created_at`) VALUES
(8, 25, 'MTs-2025-0008', '1213141516', NULL, 'Alfi Salam', 'Muara Bungo', '2002-11-20', 'L', '088747491275', 'SDN 158 Rimbo Mulyo', 'MTs', 1, '2025', 'Menunggu Verifikasi', 1, '2025-02-13 07:56:21'),
(11, 28, 'MA-2025-0009', '1234567890098765', '0987654321087654', 'rian', 'bungo', '2003-12-21', 'L', '098765431234', 'sd', 'MA', 1, '2025', 'Menunggu Verifikasi', 1, '2025-02-21 18:43:33'),
(12, 29, 'MA-2025-0012', '1234567890121212', NULL, 'J', 'W', '2007-03-26', 'L', '634248765', 'Qw', 'MA', 1, '2025', 'Menunggu Verifikasi', 1, '2025-02-26 07:58:20');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tahun_ajaran`
--

DROP TABLE IF EXISTS `tbl_tahun_ajaran`;
CREATE TABLE IF NOT EXISTS `tbl_tahun_ajaran` (
  `id_tahun` int NOT NULL AUTO_INCREMENT,
  `tahun_ajaran` varchar(10) DEFAULT NULL,
  `is_active` enum('0','1') DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_tahun`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_tahun_ajaran`
--

INSERT INTO `tbl_tahun_ajaran` (`id_tahun`, `tahun_ajaran`, `is_active`, `created_at`) VALUES
(1, '2024/2025', '0', '2025-02-03 17:58:18'),
(2, '2025/2026', '1', '2025-02-03 17:58:54');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nama_user` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `level` enum('admin','santri') DEFAULT 'santri',
  `jenjang` enum('MTs','MA') DEFAULT NULL,
  `foto` varchar(255) DEFAULT 'default.jpg',
  `is_active` enum('0','1') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `nama_user`, `email`, `password`, `level`, `jenjang`, `foto`, `is_active`, `created_at`) VALUES
(1, 'Admin PSB', 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'admin', NULL, 'user.jpg', '1', '2025-01-20 16:08:24'),
(6, 'Alfi Salan', 'bocilciki20@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'santri', 'MA', '1738590615_fcdef396b802754c34ce.jpeg', '1', '2025-02-03 13:50:15'),
(23, 'Andi Lubis', 'lubis@gmail.com', '547169e9b90c798e0daae9e554ce04d0', 'santri', 'MTs', '1739176006_d3ee544dd52f41b8016e.jpg', '1', '2025-02-10 08:26:46'),
(24, 'Ahmad Ical', 'ical20@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'santri', 'MTs', '1739256817_0da8296dec592ff92d51.jpg', '1', '2025-02-11 06:53:37'),
(25, 'Alfi Salam', 'bocilciki@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'santri', 'MTs', '1739433381_4110eb65fa84dd24aeeb.jpg', '1', '2025-02-13 07:56:21'),
(26, 'wahyu', 'wahyu@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'santri', 'MTs', '1740057827_b61d0e67b430bdb93ad7.jpg', '1', '2025-02-20 13:23:47'),
(27, 'itmam', 'itmam@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'santri', 'MA', '1740082244_1c5573c4a79ecbe869bf.jpg', '1', '2025-02-20 20:10:44'),
(28, 'rian', 'rian@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'santri', 'MA', '1740163413_6305bfd88fa1bc7f2b0f.jpg', '1', '2025-02-21 18:43:33'),
(29, 'J', 'tete@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'santri', 'MA', '1740556700_2f27a06313bcffdd1804.jpg', '1', '2025-02-26 07:58:20');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

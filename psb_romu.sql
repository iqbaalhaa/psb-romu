-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 09, 2025 at 07:56 AM
-- Server version: 8.3.0
-- PHP Version: 8.1.28

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`id_pengumuman`, `judul`, `isi`, `tanggal`) VALUES
(1, 'Pembayaran Uang Pendaftaran', 'Pembayaran Terakhir pada tanggal 5 April 2025', '2025-02-03');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_berkas`
--

DROP TABLE IF EXISTS `tbl_berkas`;
CREATE TABLE IF NOT EXISTS `tbl_berkas` (
  `id_berkas` int NOT NULL AUTO_INCREMENT,
  `id_santri` int NOT NULL,
  `kk` varchar(255) DEFAULT NULL,
  `akta` varchar(255) DEFAULT NULL,
  `ijazah` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_berkas`),
  KEY `id_santri` (`id_santri`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_berkas`
--

INSERT INTO `tbl_berkas` (`id_berkas`, `id_santri`, `kk`, `akta`, `ijazah`) VALUES
(1, 2, '1738315186_da79bf4d8b8d15bdc089.pdf', '1738315191_316dcb3d7bc9c7b83922.pdf', '1738315195_220b76c1d684331c9992.pdf'),
(2, 3, '1738347653_951eca1cee0cc8a7462e.jpeg', '1738347656_71b67668828d0d2437f7.jpeg', '1738347659_e477c14607b16be20ed1.jpeg'),
(3, 5, '1738591426_dda95e4bddec906bfcf4.jpg', '1738591450_4e6ee865b0d1d20e4327.jpg', '1738591467_390cf5e918b03406e72d.jpg'),
(4, 4, '1738591672_c62963c78b6071eb4105.jpeg', '1738591677_c9682066404eb160464a.jpeg', '1738591682_e62f429aee5403e5d64f.jpeg');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_berkas_santri`
--

INSERT INTO `tbl_berkas_santri` (`id_berkas`, `id_santri`, `berkas_ijazah`, `berkas_skhun`, `berkas_kk`, `berkas_akta`, `berkas_ktp_ayah`, `berkas_ktp_ibu`, `status_berkas`, `created_at`, `updated_at`) VALUES
(1, 2, '1738315195_220b76c1d684331c9992.pdf', NULL, '1738315186_da79bf4d8b8d15bdc089.pdf', '1738315191_316dcb3d7bc9c7b83922.pdf', NULL, NULL, 'Menunggu Verifikasi', '2025-02-04 11:04:41', '2025-02-04 11:04:41'),
(2, 3, '1738347659_e477c14607b16be20ed1.jpeg', NULL, '1738347653_951eca1cee0cc8a7462e.jpeg', '1738347656_71b67668828d0d2437f7.jpeg', NULL, NULL, 'Menunggu Verifikasi', '2025-02-04 11:04:41', '2025-02-04 11:04:41'),
(3, 5, '1738591467_390cf5e918b03406e72d.jpg', NULL, '1738591426_dda95e4bddec906bfcf4.jpg', '1738591450_4e6ee865b0d1d20e4327.jpg', NULL, NULL, 'Menunggu Verifikasi', '2025-02-04 11:04:41', '2025-02-04 11:04:41'),
(4, 4, '1738591682_e62f429aee5403e5d64f.jpeg', NULL, '1738591672_c62963c78b6071eb4105.jpeg', '1738591677_c9682066404eb160464a.jpeg', NULL, NULL, 'Menunggu Verifikasi', '2025-02-04 11:04:41', '2025-02-04 11:04:41');

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
  `penghasilan_ayah` decimal(10,2) DEFAULT NULL,
  `nama_ibu` varchar(100) DEFAULT NULL,
  `nik_ibu` varchar(16) DEFAULT NULL,
  `pendidikan_ibu` varchar(50) DEFAULT NULL,
  `pekerjaan_ibu` varchar(100) DEFAULT NULL,
  `penghasilan_ibu` decimal(10,2) DEFAULT NULL,
  `no_hp_ortu` varchar(15) DEFAULT NULL,
  `alamat_ortu` text,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `nama_wali` varchar(100) DEFAULT NULL,
  `nik_wali` varchar(16) DEFAULT NULL,
  `pendidikan_wali` varchar(50) DEFAULT NULL,
  `pekerjaan_wali` varchar(100) DEFAULT NULL,
  `penghasilan_wali` decimal(10,2) DEFAULT NULL,
  `no_hp_wali` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id_detail`),
  KEY `id_santri` (`id_santri`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
(1, 'Ilmu Pengetahuan Alam (IPA)', 0, '1'),
(2, 'Ilmu Pengetahuan Sosial (IPS)', 0, '1'),
(8, 'MAK', 0, '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_pembayaran`
--

INSERT INTO `tbl_pembayaran` (`id_pembayaran`, `id_santri`, `no_pendaftaran`, `tgl_upload`, `bukti_pembayaran`, `status_pembayaran`, `updated_at`, `alasan_tolak`) VALUES
(1, 2, 'MTs20250002', '2025-01-30 11:55:57', '1738238157_e3270de4273c34b82c7b.jpg', 2, '2025-01-31 18:15:05', NULL),
(2, 3, 'MA20250001', '2025-01-31 18:20:42', '1738347642_746b55cad8eab0b6402d.jpeg', 2, '2025-01-31 18:21:42', NULL),
(3, 5, 'MA-2025-0001', '2025-02-03 14:02:11', '1738591331_d493b64e9f5adc838339.jpg', 2, '2025-02-03 14:02:35', NULL),
(4, 4, 'MTs-2025-0001', '2025-02-03 14:07:44', '1738591664_238eb3004253a5380144.jpeg', 2, '2025-02-03 14:08:30', NULL);

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
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_santri`
--

INSERT INTO `tbl_santri` (`id_santri`, `id_user`, `no_pendaftaran`, `nisn`, `nama_lengkap`, `tempat_lahir`, `tgl_lahir`, `jenis_kelamin`, `no_hp`, `asal_sekolah`, `jenjang`, `gelombang`, `tahun_daftar`, `status_pendaftaran`, `status_berkas`, `created_at`) VALUES
(5, 6, 'MA-2025-0001', '1212121212', 'Alfi Salan', 'Muara Bungo', '2014-10-23', 'L', '088747491275', 'Mts Raudhatul Mujawwidin', 'MA', 1, '2025', 'Menunggu Verifikasi', 1, '2025-02-03 13:50:15'),
(2, 3, 'MTs20250002', '1123456789', 'Budi Yanto', 'Jambi', '2011-05-10', 'L', '0822280888', 'Smp 12', 'MTs', 1, '2025', 'Menunggu Verifikasi', 1, '2025-01-20 16:34:53'),
(3, 4, 'MA20250001', '1234567899', 'Tono Toni', 'Jambi', '2018-02-08', 'L', '0822280888', 'Smp 12', 'MA', 1, '2025', 'Menunggu Verifikasi', 1, '2025-01-21 09:17:07'),
(4, 5, 'MTs-2025-0001', '1123456788', 'ini baruu', 'Jambi', '2015-06-16', 'L', '0822280480', 'smk 1', 'MTs', 1, '2025', 'Menunggu Verifikasi', 1, '2025-01-27 17:06:21'),
(12, 20, 'MTs-2025-0006', '1210101910', 'Andi Lubis', 'Medan', '2013-09-03', 'L', '0880213312', 'SD 12 Medan', 'MTs', 1, '2025', 'Menunggu Verifikasi', 0, '2025-02-09 07:38:36'),
(13, 21, 'MA-2025-0013', '1213111223', 'Andi Lubis MA', 'Medan', '2012-10-23', 'L', '08802133125', 'SMP 12 Medan', 'MA', 1, '2025', 'Menunggu Verifikasi', 0, '2025-02-09 07:48:37');

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
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `nama_user`, `email`, `password`, `level`, `jenjang`, `foto`, `is_active`, `created_at`) VALUES
(1, 'Admin PSB', 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'admin', NULL, 'user.jpg', '1', '2025-01-20 16:08:24'),
(3, 'Budi Yanto', 'budi@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'santri', 'MTs', 'user.jpg', '1', '2025-01-20 16:34:53'),
(4, 'Tono Toni', 'tono@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'santri', 'MA', 'default.jpg', '1', '2025-01-21 09:17:07'),
(5, 'ini baruu', 'baru@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'santri', 'MTs', 'user.jpg', '1', '2025-01-27 17:06:21'),
(6, 'Alfi Salan', 'bocilciki20@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'santri', 'MA', '1738590615_fcdef396b802754c34ce.jpeg', '1', '2025-02-03 13:50:15'),
(20, 'Andi Lubis', 'andi@gmail.com', '03339dc0dff443f15c254baccde9bece', 'santri', 'MTs', '1739086716_45f579b688c61ace0de4.jpg', '1', '2025-02-09 07:38:36'),
(21, 'Andi Lubis MA', 'andima@gmail.com', '9813c16a8d8943d8414337c5616dd135', 'santri', 'MA', '1739087317_2bad02ebeb6b95c29a71.png', '1', '2025-02-09 07:48:37');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

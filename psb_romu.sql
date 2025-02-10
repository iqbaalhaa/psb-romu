-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 10, 2025 at 06:43 AM
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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`id_pengumuman`, `judul`, `isi`, `tanggal`) VALUES
(1, 'Pembayaran Uang Pendaftaran', 'Pembayaran Terakhir pada tanggal 5 April 2025', '2025-02-03');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_berkas_santri`
--

INSERT INTO `tbl_berkas_santri` (`id_berkas`, `id_santri`, `berkas_ijazah`, `berkas_skhun`, `berkas_kk`, `berkas_akta`, `berkas_ktp_ayah`, `berkas_ktp_ibu`, `status_berkas`, `created_at`, `updated_at`) VALUES
(5, 5, '1739097771_a4b0e895791af22d22e4.png', '1739097780_4cacac6e5f0d1cdfb7ab.png', '1739097751_7cc23a57c9e765a1bcb2.png', '1739097758_eb2fa320d36305ea5679.png', '1739097793_67aefe3fd72a7a20900d.png', '1739097800_272993a7f14ede76901e.png', 'Terverifikasi', '2025-02-09 03:42:31', '2025-02-09 10:51:44');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
(3, 5, 'MA-2025-0001', '2025-02-09 13:14:57', '1739106897_dbf5ca3ada0a8b0e1776.jpg', 2, '2025-02-09 13:15:21', 'upload ulang'),
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_santri`
--

INSERT INTO `tbl_santri` (`id_santri`, `id_user`, `no_pendaftaran`, `nisn`, `nik`, `nama_lengkap`, `tempat_lahir`, `tgl_lahir`, `jenis_kelamin`, `no_hp`, `asal_sekolah`, `jenjang`, `gelombang`, `tahun_daftar`, `status_pendaftaran`, `status_berkas`, `created_at`) VALUES
(5, 6, 'MA-2025-0001', '1212121212', '2147483647', 'Alfi Salam', 'Muara Bungo', '2014-10-23', 'L', '088747491275', 'Mts Raudhatul Mujawwidin', 'MA', 1, '2025', 'Menunggu Verifikasi', 1, '2025-02-03 13:50:15');

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
(6, 'Alfi Salan', 'bocilciki20@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'santri', 'MA', '1738590615_fcdef396b802754c34ce.jpeg', '1', '2025-02-03 13:50:15');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 30, 2025 at 04:06 AM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_jurusan`
--

INSERT INTO `tbl_jurusan` (`id_jurusan`, `nama_jurusan`, `kuota`, `is_active`) VALUES
(1, 'Ilmu Pengetahuan Alam (IPA)', 0, '1'),
(2, 'Ilmu Pengetahuan Sosial (IPS)', 0, '1'),
(3, 'MAK', 0, '1');

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
-- Table structure for table `tbl_pembayaran`
--

DROP TABLE IF EXISTS `tbl_pembayaran`;
CREATE TABLE IF NOT EXISTS `tbl_pembayaran` (
  `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT,
  `id_santri` int(11) NOT NULL,
  `no_pendaftaran` varchar(20) NOT NULL,
  `tgl_upload` datetime NOT NULL,
  `bukti_pembayaran` varchar(255) NOT NULL,
  `status_pembayaran` int(1) NOT NULL DEFAULT 0 COMMENT '0=belum bayar, 1=menunggu verifikasi, 2=lunas',
  `keterangan` text DEFAULT NULL,
  PRIMARY KEY (`id_pembayaran`),
  KEY `id_santri` (`id_santri`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

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
  `gelombang` int(1) NOT NULL DEFAULT '1' COMMENT '1=Gelombang 1, 2=Gelombang 2',
  `tahun_daftar` year DEFAULT NULL,
  `status_pendaftaran` enum('Menunggu Verifikasi','Berkas Diterima','Lulus Tes','Diterima','Ditolak') DEFAULT 'Menunggu Verifikasi',
  `status_berkas` int(1) NOT NULL DEFAULT '0' COMMENT '0=belum lengkap, 1=lengkap',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_santri`),
  UNIQUE KEY `no_pendaftaran` (`no_pendaftaran`),
  UNIQUE KEY `nisn` (`nisn`),
  KEY `id_user` (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_santri`
--

INSERT INTO `tbl_santri` (`id_santri`, `id_user`, `no_pendaftaran`, `nisn`, `nik`, `nama_lengkap`, `tempat_lahir`, `tgl_lahir`, `jenis_kelamin`, `no_hp`, `asal_sekolah`, `jenjang`, `gelombang`, `tahun_daftar`, `status_pendaftaran`, `status_berkas`, `created_at`) VALUES
(1, 2, 'MTs20250001', '1234567890', NULL, 'Budi Yanto', 'Jambi', '2010-05-19', 'L', '0822280888', 'Smp 12', 'MTs', 1, '2025', 'Menunggu Verifikasi', 0, '2025-01-20 16:15:51'),
(2, 3, 'MTs20250002', '1123456789', NULL, 'Budi Yanto', 'Jambi', '2011-05-10', 'L', '0822280888', 'Smp 12', 'MTs', 1, '2025', 'Menunggu Verifikasi', 0, '2025-01-20 16:34:53'),
(3, 4, 'MA20250001', '1234567899', NULL, 'Tono Toni', 'Jambi', '2018-02-08', 'L', '0822280888', 'Smp 12', 'MA', 1, '2025', 'Menunggu Verifikasi', 0, '2025-01-21 09:17:07'),
(4, 5, 'MTs-2025-0001', '1123456788', NULL, 'ini baruu', 'Jambi', '2015-06-16', 'L', '0822280480', 'smk 1', 'MTs', 1, '2025', 'Menunggu Verifikasi', 0, '2025-01-27 17:06:21');

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `nama_user`, `email`, `password`, `level`, `jenjang`, `foto`, `is_active`, `created_at`) VALUES
(1, 'Admin PSB', 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'admin', NULL, 'user.jpg', '1', '2025-01-20 16:08:24'),
(3, 'Budi Yanto', 'budi@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'santri', 'MTs', 'user.jpg', '1', '2025-01-20 16:34:53'),
(4, 'Tono Toni', 'tono@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'santri', 'MA', 'default.jpg', '1', '2025-01-21 09:17:07'),
(5, 'ini baruu', 'baru@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'santri', 'MTs', 'default.jpg', '1', '2025-01-27 17:06:21');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_berkas`
--

DROP TABLE IF EXISTS `tbl_berkas`;
CREATE TABLE IF NOT EXISTS `tbl_berkas` (
  `id_berkas` int(11) NOT NULL AUTO_INCREMENT,
  `id_santri` int(11) NOT NULL,
  `kk` varchar(255) DEFAULT NULL,
  `akta` varchar(255) DEFAULT NULL,
  `ijazah` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_berkas`),
  KEY `id_santri` (`id_santri`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

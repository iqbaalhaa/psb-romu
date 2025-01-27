-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 20, 2025 at 03:58 PM
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
-- Table structure for table `tbl_jurusan`
--

DROP TABLE IF EXISTS `tbl_jurusan`;
CREATE TABLE IF NOT EXISTS `tbl_jurusan` (
  `id_jurusan` int NOT NULL AUTO_INCREMENT,
  `nama_jurusan` varchar(100) NOT NULL,
  `kuota` int DEFAULT 0,
  `is_active` ENUM('0', '1') DEFAULT '1',
  PRIMARY KEY (`id_jurusan`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_jurusan`
--

INSERT INTO `tbl_jurusan` (`id_jurusan`, `nama_jurusan`) VALUES
(1, 'Ilmu Pengetahuan Alam (IPA)'),
(2, 'Ilmu Pengetahuan Sosial (IPS)'),
(3, 'MAK');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nama_user` varchar(100),
  `email` varchar(100) DEFAULT NULL UNIQUE,
  `password` varchar(255) DEFAULT NULL,
  `level` ENUM('admin', 'santri') DEFAULT 'santri',
  `jenjang` ENUM('MTs', 'MA'),
  `foto` varchar(255) DEFAULT 'default.jpg',
  `is_active` ENUM('0', '1') DEFAULT '1',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `email`, `password`, `level`, `jenjang`, `foto`, `is_active`, `created_at`) VALUES
(1, 'admin@gmail.com', '1234', 'admin', NULL, 'user.jpg', '1', CURRENT_TIMESTAMP);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_santri`
--

DROP TABLE IF EXISTS `tbl_santri`;
CREATE TABLE IF NOT EXISTS `tbl_santri` (
  `id_santri` int NOT NULL AUTO_INCREMENT,
  `id_user` int,
  `no_pendaftaran` varchar(20) UNIQUE,
  `nisn` varchar(20) UNIQUE,
  `nik` varchar(16),
  `nama_lengkap` varchar(100),
  `tempat_lahir` varchar(100),
  `tgl_lahir` date,
  `jenis_kelamin` ENUM('L', 'P'),
  `no_hp` varchar(15),
  `asal_sekolah` varchar(100),
  `jenjang` ENUM('MTs', 'MA'),
  `tahun_daftar` year,
  `status_pendaftaran` ENUM('Menunggu Verifikasi', 'Berkas Diterima', 'Lulus Tes', 'Diterima', 'Ditolak') DEFAULT 'Menunggu Verifikasi',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_santri`),
  FOREIGN KEY (`id_user`) REFERENCES `tbl_user`(`id_user`) ON DELETE CASCADE
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_detail_santri`
--

DROP TABLE IF EXISTS `tbl_detail_santri`;
CREATE TABLE IF NOT EXISTS `tbl_detail_santri` (
  `id_detail` int NOT NULL AUTO_INCREMENT,
  `id_santri` int,
  `alamat` text,
  `desa` varchar(100),
  `kecamatan` varchar(100),
  `kabupaten` varchar(100),
  `provinsi` varchar(100),
  `kode_pos` varchar(10),
  `nama_ayah` varchar(100),
  `nik_ayah` varchar(16),
  `pendidikan_ayah` varchar(50),
  `pekerjaan_ayah` varchar(100),
  `penghasilan_ayah` decimal(10,2),
  `nama_ibu` varchar(100),
  `nik_ibu` varchar(16),
  `pendidikan_ibu` varchar(50),
  `pekerjaan_ibu` varchar(100),
  `penghasilan_ibu` decimal(10,2),
  `no_hp_ortu` varchar(15),
  `alamat_ortu` text,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_detail`),
  FOREIGN KEY (`id_santri`) REFERENCES `tbl_santri`(`id_santri`) ON DELETE CASCADE
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_berkas_santri`
--

DROP TABLE IF EXISTS `tbl_berkas_santri`;
CREATE TABLE IF NOT EXISTS `tbl_berkas_santri` (
  `id_berkas` int NOT NULL AUTO_INCREMENT,
  `id_santri` int,
  `berkas_ijazah` varchar(255),
  `berkas_skhun` varchar(255),
  `berkas_kk` varchar(255),
  `berkas_akta` varchar(255),
  `berkas_ktp_ayah` varchar(255),
  `berkas_ktp_ibu` varchar(255),
  `status_berkas` ENUM('Belum Lengkap', 'Menunggu Verifikasi', 'Terverifikasi') DEFAULT 'Belum Lengkap',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_berkas`),
  FOREIGN KEY (`id_santri`) REFERENCES `tbl_santri`(`id_santri`) ON DELETE CASCADE
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pilihan_jurusan`
--

DROP TABLE IF EXISTS `tbl_pilihan_jurusan`;
CREATE TABLE IF NOT EXISTS `tbl_pilihan_jurusan` (
  `id_pilihan` int NOT NULL AUTO_INCREMENT,
  `id_santri` int,
  `id_jurusan` int,
  `pilihan_ke` ENUM('1', '2'),
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_pilihan`),
  FOREIGN KEY (`id_santri`) REFERENCES `tbl_santri`(`id_santri`) ON DELETE CASCADE,
  FOREIGN KEY (`id_jurusan`) REFERENCES `tbl_jurusan`(`id_jurusan`) ON DELETE CASCADE
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tahun_ajaran`
--

DROP TABLE IF EXISTS `tbl_tahun_ajaran`;
CREATE TABLE IF NOT EXISTS `tbl_tahun_ajaran` (
  `id_tahun` int NOT NULL AUTO_INCREMENT,
  `tahun_ajaran` varchar(10),
  `is_active` ENUM('0', '1') DEFAULT '0',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_tahun`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

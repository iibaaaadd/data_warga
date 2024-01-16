-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2024 at 04:15 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `data_warga`
--

-- --------------------------------------------------------

--
-- Table structure for table `kk`
--

CREATE TABLE `kk` (
  `id_kk` int(11) NOT NULL,
  `nomor_kk` varchar(16) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `kondisi_rumah` varchar(255) DEFAULT NULL,
  `pemilik_rumah` varchar(50) DEFAULT NULL,
  `luas_tanah` double DEFAULT NULL,
  `luas_bangunan` double DEFAULT NULL,
  `jumlah_kamar_mandi` int(11) DEFAULT NULL,
  `jumlah_kamar_tidur` int(11) DEFAULT NULL,
  `jenis_material_bangunan` varchar(50) DEFAULT NULL,
  `listrik_watt` int(11) DEFAULT NULL,
  `npbb` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kk`
--

INSERT INTO `kk` (`id_kk`, `nomor_kk`, `alamat`, `kondisi_rumah`, `pemilik_rumah`, `luas_tanah`, `luas_bangunan`, `jumlah_kamar_mandi`, `jumlah_kamar_tidur`, `jenis_material_bangunan`, `listrik_watt`, `npbb`) VALUES
(1, '124389391830008', 'Dusun Talangan RT 11 RW 06, Desa Gajah Bendo', 'uploads/Rumah 2.jpg', 'Ibad', 120, 234, 1, 3, 'Batu bata', 240, '152367131'),
(3, '3573951538030007', 'Dusun Parengan RT.02 RW.09, Kecamatan Krian, Sidoarjo  ', 'uploads/Rumah 1.jpg', 'Mamat', 80, 20, 1, 3, 'Batu Bata', 900, '0735479'),
(6, '3597637291020004', 'Dusun Melati RT.08 RW.10, Desa Mawar, Kecamatan Sepanjang, Sidoarjo', 'uploads/Rumah 4.jpg', 'Hanif', 40, 35, 1, 4, 'Batako', 2200, '0736492'),
(8, '327254420009', 'Desa Gajah RT 10 RW 05, Desa Gajah Bendo', 'uploads/Rumah 1.jpg', 'Muhammad Habil', 180, 160, 1, 3, 'Batako', 640, '16541278631');

-- --------------------------------------------------------

--
-- Table structure for table `ktp`
--

CREATE TABLE `ktp` (
  `id_ktp` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `jenis_kelamin` char(1) DEFAULT NULL,
  `nik` varchar(16) DEFAULT NULL,
  `foto_ktp` varchar(255) DEFAULT NULL,
  `id_kk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ktp`
--

INSERT INTO `ktp` (`id_ktp`, `nama`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `jenis_kelamin`, `nik`, `foto_ktp`, `id_kk`) VALUES
(1, 'ibad', 'Surabaya', '1998-02-03', 'Dusun Talangan RT 11 RW 06, Desa Gajah Bendo', 'l', '1313212', 'uploads/KTP 1.jpg', 1),
(2, 'Siti', 'Surabaya', '1968-12-20', 'Dusun Talangan RT 11 RW 06, Desa Gajah Bendo', 'P', '13121212', 'uploads/KTP 1.jpg', 1),
(3, 'Choirul Muhammad', 'Pasuruan', '2005-07-14', 'Dusun Talangan RT 11 RW 06, Desa Gajah Bendo', 'L', '138461940005', 'uploads/KTP 1.jpg', 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kk`
--
ALTER TABLE `kk`
  ADD PRIMARY KEY (`id_kk`),
  ADD UNIQUE KEY `nomor_kk` (`nomor_kk`);

--
-- Indexes for table `ktp`
--
ALTER TABLE `ktp`
  ADD PRIMARY KEY (`id_ktp`),
  ADD UNIQUE KEY `nomor_ktp` (`nik`),
  ADD KEY `id_kk` (`id_kk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kk`
--
ALTER TABLE `kk`
  MODIFY `id_kk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ktp`
--
ALTER TABLE `ktp`
  MODIFY `id_ktp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ktp`
--
ALTER TABLE `ktp`
  ADD CONSTRAINT `ktp_ibfk_1` FOREIGN KEY (`id_kk`) REFERENCES `kk` (`id_kk`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

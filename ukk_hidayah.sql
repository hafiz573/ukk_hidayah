-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2025 at 09:39 AM
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
-- Database: `ukk_hidayah`
--

-- --------------------------------------------------------

--
-- Table structure for table `kas`
--

CREATE TABLE `kas` (
  `id_kas` int(11) NOT NULL,
  `id_nik` varchar(16) NOT NULL,
  `bln_1` decimal(10,2) NOT NULL,
  `bln_2` decimal(10,2) NOT NULL,
  `bln_3` decimal(10,2) NOT NULL,
  `bln_4` decimal(10,2) NOT NULL,
  `bln_5` decimal(10,2) NOT NULL,
  `bln_6` decimal(10,2) NOT NULL,
  `bln_7` decimal(10,2) NOT NULL,
  `bln_8` decimal(10,2) NOT NULL,
  `bln_9` decimal(10,2) NOT NULL,
  `bln_10` decimal(10,2) NOT NULL,
  `bln_11` decimal(10,2) NOT NULL,
  `bln_12` decimal(10,2) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `keuangan_rt`
--

CREATE TABLE `keuangan_rt` (
  `id_kas` int(11) NOT NULL,
  `item_kegiatan` varchar(100) NOT NULL,
  `pengeluaran` int(15) NOT NULL,
  `pendapatan` int(15) NOT NULL,
  `saldo_awal` int(15) NOT NULL,
  `saldo_akhir` int(15) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_nik` varchar(16) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('Admin','Warga') DEFAULT 'Warga'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `warga`
--

CREATE TABLE `warga` (
  `id_nik` varchar(16) NOT NULL,
  `nomor_kk` varchar(16) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `pekerjaan` varchar(50) NOT NULL,
  `status_keluarga` varchar(50) NOT NULL,
  `foto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kas`
--
ALTER TABLE `kas`
  ADD PRIMARY KEY (`id_kas`,`id_nik`),
  ADD KEY `fk_kas_warga` (`id_nik`);

--
-- Indexes for table `keuangan_rt`
--
ALTER TABLE `keuangan_rt`
  ADD PRIMARY KEY (`id_kas`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_nik`);

--
-- Indexes for table `warga`
--
ALTER TABLE `warga`
  ADD PRIMARY KEY (`id_nik`),
  ADD UNIQUE KEY `id_nik` (`id_nik`),
  ADD UNIQUE KEY `id_nik_2` (`id_nik`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kas`
--
ALTER TABLE `kas`
  ADD CONSTRAINT `fk_kas_warga` FOREIGN KEY (`id_nik`) REFERENCES `warga` (`id_nik`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_user_warga` FOREIGN KEY (`id_nik`) REFERENCES `warga` (`id_nik`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2024 at 07:38 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pdam`
--

-- --------------------------------------------------------

--
-- Table structure for table `biaya_pemeliharaan`
--

CREATE TABLE `biaya_pemeliharaan` (
  `id` int(11) NOT NULL,
  `biaya_admin` float NOT NULL,
  `biaya_perm` float NOT NULL,
  `status` enum('aktif','tidak') DEFAULT 'aktif',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `biaya_pemeliharaan`
--

INSERT INTO `biaya_pemeliharaan` (`id`, `biaya_admin`, `biaya_perm`, `status`, `created_at`, `updated_at`) VALUES
(1, 2000, 3000, 'aktif', '2024-07-27 01:27:54', '2024-07-27 01:27:54');

-- --------------------------------------------------------

--
-- Table structure for table `dana_keluar`
--

CREATE TABLE `dana_keluar` (
  `id` int(11) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `jumlah_keluar` float(10,2) NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dana_keluar`
--

INSERT INTO `dana_keluar` (`id`, `tanggal_keluar`, `jumlah_keluar`, `keterangan`, `created_at`, `updated_at`) VALUES
(2, '2024-11-09', 543534.00, 'dfasdas', '2024-11-09 17:31:57', NULL),
(3, '2024-11-09', 342343.00, 'fdgfdg', '2024-11-09 17:38:25', NULL),
(4, '2024-12-09', 100000.00, 'hghghj', '2024-11-09 17:45:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `meter_air`
--

CREATE TABLE `meter_air` (
  `id` int(11) NOT NULL,
  `pelanggan_id` int(11) NOT NULL,
  `tagihan_id` int(11) NOT NULL,
  `pembacaan_awal` int(11) NOT NULL,
  `pembacaan_akhir` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meter_air`
--

INSERT INTO `meter_air` (`id`, `pelanggan_id`, `tagihan_id`, `pembacaan_awal`, `pembacaan_akhir`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 0, 10, '2024-10-27 19:20:34', '2024-10-27 19:20:34'),
(2, 1, 3, 10, 12, '2024-11-04 00:42:44', '2024-11-04 00:42:44'),
(3, 1, 4, 12, 15, '2024-11-04 00:43:06', '2024-11-04 00:43:06'),
(4, 1, 5, 15, 16, '2024-11-04 00:57:07', '2024-11-04 00:57:07'),
(5, 2, 6, 0, 34, '2024-11-07 15:48:40', '2024-11-07 15:48:40'),
(6, 4, 7, 0, 23, '2024-11-07 15:49:09', '2024-11-07 15:49:09'),
(7, 5, 8, 0, 34, '2024-11-07 15:49:46', '2024-11-07 15:49:46'),
(8, 2, 9, 34, 39, '2024-11-10 00:15:15', '2024-11-10 00:15:15'),
(9, 1, 10, 16, 20, '2024-11-10 01:15:08', '2024-11-10 01:15:08');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nama` varchar(25) NOT NULL,
  `alamat` text NOT NULL,
  `no_telepon` varchar(15) NOT NULL,
  `email` varchar(25) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `id_user`, `nama`, `alamat`, `no_telepon`, `email`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Denggel', 'Sembung Jambu', '073837383', 'ok@admin.com', '2024-07-27 01:54:42', '2024-07-27 01:54:42', NULL),
(2, 3, 'saala', 'sjaidjai', '23428', 'akundicky123@gmail.com', '2024-07-30 22:13:04', '2024-07-30 22:13:04', NULL),
(4, 4, 'fdsd', 'sdd', 'sdssdf', 'dickyovo99@gmail.com', '2024-07-30 22:14:31', '2024-07-30 22:14:31', NULL),
(5, 5, 'Wabok', 'RT 9', '08292828', 'ok1@admin.com', '2024-07-31 01:36:45', '2024-07-31 01:36:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `tagihan_id` int(11) NOT NULL,
  `tanggal_pembayaran` date NOT NULL DEFAULT current_timestamp(),
  `jumlah_dibayar` decimal(10,2) NOT NULL,
  `metode_pembayaran` enum('cash','midtrans') NOT NULL DEFAULT 'cash',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `tagihan_id`, `tanggal_pembayaran`, `jumlah_dibayar`, `metode_pembayaran`, `created_at`, `updated_at`) VALUES
(2, 3, '2024-11-04', 8000.00, 'cash', '2024-11-03 17:43:25', NULL),
(3, 4, '2024-11-04', 11000.00, 'cash', '2024-11-03 17:45:33', NULL),
(4, 5, '2024-11-04', 5000.00, 'cash', '2024-11-03 17:57:12', NULL),
(5, 10, '2024-12-10', 14000.00, 'cash', '2024-11-09 18:15:16', '2024-11-09 18:15:40');

-- --------------------------------------------------------

--
-- Table structure for table `tagihan`
--

CREATE TABLE `tagihan` (
  `id` int(11) NOT NULL,
  `pelanggan_id` int(11) NOT NULL,
  `bulan` varchar(10) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `jumlah_pemakaian` int(11) NOT NULL,
  `total_tagihan` decimal(10,2) NOT NULL,
  `status` enum('belum_dibayar','dibayar') DEFAULT 'belum_dibayar',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tagihan`
--

INSERT INTO `tagihan` (`id`, `pelanggan_id`, `bulan`, `tahun`, `jumlah_pemakaian`, `total_tagihan`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, '10', '2024', 10, 32000.00, 'dibayar', '2024-10-27 19:20:34', '2024-10-27 22:16:39'),
(5, 1, '11', '2024', 1, 5000.00, 'dibayar', '2024-11-04 00:57:07', '2024-11-04 00:57:12'),
(9, 2, '11', '2024', 5, 17000.00, 'belum_dibayar', '2024-11-10 00:15:15', '2024-11-10 00:15:15'),
(10, 1, '12', '2024', 4, 14000.00, 'dibayar', '2024-11-10 01:15:08', '2024-11-10 01:15:16');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','pegawai','pelanggan') DEFAULT 'pegawai',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Denggel', 'ok@admin.com', '$2y$10$Qq8qzHNWNOlfI2EhDwi3Q.YcorCVEs/Zx9jwaQXtqUoKVqBS3FRMe', 'pelanggan', '2024-10-27 22:11:42', '2024-10-27 22:11:42'),
(5, 'Wabok', 'ok1@admin.com', '$2y$10$BtKfPiTm8Ps7aZHscLnO4OuTnIGGIVEgT4DceUOzLjGf2v/EnOgqS', 'admin', '2024-11-07 14:29:47', '2024-11-07 14:29:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `biaya_pemeliharaan`
--
ALTER TABLE `biaya_pemeliharaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dana_keluar`
--
ALTER TABLE `dana_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meter_air`
--
ALTER TABLE `meter_air`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelanggan_id` (`pelanggan_id`),
  ADD KEY `tagihan_id` (`tagihan_id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tagihan_id` (`tagihan_id`);

--
-- Indexes for table `tagihan`
--
ALTER TABLE `tagihan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `biaya_pemeliharaan`
--
ALTER TABLE `biaya_pemeliharaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dana_keluar`
--
ALTER TABLE `dana_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `meter_air`
--
ALTER TABLE `meter_air`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tagihan`
--
ALTER TABLE `tagihan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2024 at 03:41 PM
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
-- Table structure for table `meter_air`
--

CREATE TABLE `meter_air` (
  `id` int(11) NOT NULL,
  `pelanggan_id` int(11) NOT NULL,
  `bulan` varchar(10) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `pembacaan_awal` int(11) NOT NULL,
  `pembacaan_akhir` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meter_air`
--

INSERT INTO `meter_air` (`id`, `pelanggan_id`, `bulan`, `tahun`, `pembacaan_awal`, `pembacaan_akhir`, `created_at`, `updated_at`) VALUES
(6, 1, '07', '2024', 0, 20, '2024-07-31 01:35:34', '2024-07-31 01:35:34'),
(7, 1, '08', '2024', 20, 30, '2024-07-31 01:36:15', '2024-07-31 01:36:15'),
(8, 5, '07', '2024', 0, 10, '2024-07-31 01:37:00', '2024-07-31 01:37:00'),
(9, 5, '08', '2024', 10, 30, '2024-07-31 02:21:14', '2024-07-31 02:21:14'),
(10, 2, '09', '2024', 0, 120, '2024-09-04 21:05:50', '2024-09-04 21:05:50'),
(11, 1, '09', '2024', 20, 25, '2024-09-05 12:18:51', '2024-09-05 12:18:51');

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
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `id_user`, `nama`, `alamat`, `no_telepon`, `email`, `created_at`, `updated_at`) VALUES
(1, 16, 'Denggel', 'Sembung Jambu', '073837383', 'ok@admin.com', '2024-07-27 01:54:42', '2024-07-27 01:54:42'),
(2, 17, 'saala', 'sjaidjai', '23428', 'akundicky123@gmail.com', '2024-07-30 22:13:04', '2024-07-30 22:13:04'),
(4, NULL, 'fdsd', 'sdd', 'sdssdf', 'dickyovo99@gmail.com', '2024-07-30 22:14:31', '2024-07-30 22:14:31'),
(5, NULL, 'Wabok', 'RT 9', '08292828', 'ok1@admin.com', '2024-07-31 01:36:45', '2024-07-31 01:36:45');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `tagihan_id` int(11) NOT NULL,
  `tanggal_pembayaran` datetime NOT NULL,
  `jumlah_dibayar` decimal(10,2) NOT NULL,
  `metode_pembayaran` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(7, 1, '07', '2024', 20, 62000.00, 'dibayar', '2024-07-31 01:35:34', '2024-07-31 02:06:51'),
(8, 1, '08', '2024', 10, 32000.00, 'dibayar', '2024-07-31 01:36:15', '2024-07-31 02:07:02'),
(9, 5, '07', '2024', 10, 32000.00, 'dibayar', '2024-07-31 01:37:00', '2024-07-31 02:07:08'),
(10, 5, '08', '2024', 20, 62000.00, 'dibayar', '2024-07-31 02:21:14', '2024-09-04 21:06:01'),
(11, 2, '09', '2024', 120, 362000.00, 'dibayar', '2024-09-04 21:05:50', '2024-09-04 21:06:05'),
(12, 1, '09', '2024', 5, 17000.00, 'dibayar', '2024-09-05 12:18:51', '2024-09-05 12:19:02');

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
(16, 'Denggel', 'ok@admin.com', '$2y$10$dxtjWtqSumKvB.wa6UyzseJPyXUYJn7g63majMiIi16LU5Z7c2B96', 'pelanggan', '2024-07-30 22:49:22', '2024-07-30 22:49:22'),
(17, 'saala', 'akundicky123@gmail.com', '$2y$10$DCn7WsZwBpHi3zELHOAkZ.H85JEZKuy.I5XMRb93gHcAbXK/PLscG', 'pelanggan', '2024-09-04 21:02:35', '2024-09-04 21:02:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `biaya_pemeliharaan`
--
ALTER TABLE `biaya_pemeliharaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meter_air`
--
ALTER TABLE `meter_air`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelanggan_id` (`pelanggan_id`);

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
-- AUTO_INCREMENT for table `meter_air`
--
ALTER TABLE `meter_air`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tagihan`
--
ALTER TABLE `tagihan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

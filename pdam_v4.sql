-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 01, 2024 at 02:00 PM
-- Server version: 11.3.2-MariaDB
-- PHP Version: 8.1.28

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
-- Table structure for table `auth_activation_attempts`
--

DROP TABLE IF EXISTS `auth_activation_attempts`;
CREATE TABLE IF NOT EXISTS `auth_activation_attempts` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups`
--

DROP TABLE IF EXISTS `auth_groups`;
CREATE TABLE IF NOT EXISTS `auth_groups` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auth_groups`
--

INSERT INTO `auth_groups` (`id`, `name`, `description`) VALUES
(1, 'Pimpinan', 'Pimpinan PAM Banyu Panguripan'),
(2, 'Bendahara', 'Pemegang Keuanggan'),
(3, 'Petugas', 'Relawan PAM');

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_permissions`
--

DROP TABLE IF EXISTS `auth_groups_permissions`;
CREATE TABLE IF NOT EXISTS `auth_groups_permissions` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`),
  KEY `group_id_permission_id` (`group_id`,`permission_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_users`
--

DROP TABLE IF EXISTS `auth_groups_users`;
CREATE TABLE IF NOT EXISTS `auth_groups_users` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  KEY `auth_groups_users_user_id_foreign` (`user_id`),
  KEY `group_id_user_id` (`group_id`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auth_groups_users`
--

INSERT INTO `auth_groups_users` (`group_id`, `user_id`) VALUES
(3, 13),
(3, 17);

-- --------------------------------------------------------

--
-- Table structure for table `auth_logins`
--

DROP TABLE IF EXISTS `auth_logins`;
CREATE TABLE IF NOT EXISTS `auth_logins` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `email` (`email`(250)),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `email`, `user_id`, `date`, `success`) VALUES
(1, '::1', 'ahmadzulfan002@gmail.com', NULL, '2024-12-01 04:01:26', 0),
(2, '::1', 'ahmadzulfan002@gmail.com', NULL, '2024-12-01 04:01:51', 0),
(3, '::1', 'ahmadzulfan002@gmail.com', NULL, '2024-12-01 04:02:34', 0),
(4, '::1', 'ahmadzulfan00@gmail.com', NULL, '2024-12-01 04:05:26', 0),
(5, '::1', 'ahmadzulfan002@gmail.com', NULL, '2024-12-01 04:05:36', 0),
(6, '::1', 'ahmadzulfan002@gmail.com', NULL, '2024-12-01 04:08:07', 0),
(7, '::1', 'ahmadzulfan002@gmail.com', NULL, '2024-12-01 04:14:46', 0),
(8, '::1', 'ahmadzulfan002@gmail.com', NULL, '2024-12-01 04:46:28', 0),
(9, '::1', 'ahmadzulfan002@gmail.com', NULL, '2024-12-01 04:47:01', 0),
(10, '::1', 'ahmadzulfan002@gmail.com', NULL, '2024-12-01 05:31:27', 0),
(11, '::1', 'ahmadzulfan002@gmail.com', NULL, '2024-12-01 05:31:36', 0),
(12, '::1', 'ahmadzulfan002@gmail.com', NULL, '2024-12-01 05:32:00', 0),
(13, '::1', 'ahmadzulfan002@gmail.com', NULL, '2024-12-01 05:41:18', 0),
(14, '::1', 'ahmadzulfan002@gmail.com', NULL, '2024-12-01 05:49:19', 0),
(15, '::1', 'ahmadzulfan002@gmail.com', NULL, '2024-12-01 05:49:43', 0),
(16, '::1', 'ahmadzulfan002@gmail.com', NULL, '2024-12-01 05:49:49', 0),
(17, '::1', 'ahmadzulfan002@gmail.com', NULL, '2024-12-01 05:52:18', 0),
(18, '::1', 'ahmadzulfan002@gmail.com', NULL, '2024-12-01 05:52:48', 0),
(19, '::1', 'ahmadzulfan002@gmail.com', NULL, '2024-12-01 05:58:09', 0),
(20, '::1', 'ahmadzulfan002@gmail.com', NULL, '2024-12-01 05:58:40', 0),
(21, '::1', 'ahmadzulfan002@gmail.com', NULL, '2024-12-01 05:59:23', 0),
(22, '::1', 'ahmadzulfan002@gmail.com', NULL, '2024-12-01 05:59:33', 0),
(23, '::1', 'ahmadzulfan002@gmail.com', NULL, '2024-12-01 06:06:38', 0),
(24, '::1', 'ahmadzulfan002@gmail.com', NULL, '2024-12-01 06:07:09', 0),
(25, '::1', 'ahmadzulfan002@gmail.com', NULL, '2024-12-01 06:10:38', 0),
(26, '::1', 'ahmadzulfan002@gmail.com', NULL, '2024-12-01 06:15:01', 0),
(27, '::1', 'ahmadzulfan002@gmail.com', NULL, '2024-12-01 06:15:11', 0),
(28, '::1', 'ahmadzulfan002@gmail.com', NULL, '2024-12-01 06:31:44', 0),
(29, '::1', 'admin@gmail.com', 10, '2024-12-01 06:46:45', 1),
(30, '::1', 'ahmadzulfan002@gmail.com', 9, '2024-12-01 07:00:25', 1),
(31, '::1', 'ahmadzulfan002@gmail.com', NULL, '2024-12-01 07:01:41', 0),
(32, '::1', 'ahmadzulfan002@gmail.com', NULL, '2024-12-01 07:02:47', 0),
(33, '::1', 'ahmadzulfan002@gmail.com', NULL, '2024-12-01 11:30:55', 0),
(34, '::1', 'ahmadzulfan002@gmail.com', NULL, '2024-12-01 11:31:12', 0),
(35, '::1', 'ahmadzulfan002@gmail.com', NULL, '2024-12-01 11:39:44', 0),
(36, '::1', 'ahmadzulfan002@gmail.com', NULL, '2024-12-01 11:39:55', 0),
(37, '::1', 'ahmadzulfan002@gmail.com', 17, '2024-12-01 11:45:39', 1),
(38, '::1', 'ahmadzulfan002@gmail.com', 17, '2024-12-01 12:00:02', 1),
(39, '::1', 'ahmadzulfan002@gmail.com', 17, '2024-12-01 12:00:32', 1),
(40, '::1', 'ahmadzulfan002@gmail.com', 17, '2024-12-01 12:07:21', 1),
(41, '::1', 'ahmadzulfan002@gmail.com', 17, '2024-12-01 12:16:45', 1),
(42, '::1', 'ahmadzulfan002@gmail.com', 17, '2024-12-01 12:29:33', 1),
(43, '::1', 'ahmadzulfan002@gmail.com', 17, '2024-12-01 12:42:48', 1),
(44, '::1', 'ahmadzulfan002@gmail.com', 17, '2024-12-01 13:36:52', 1);

-- --------------------------------------------------------

--
-- Table structure for table `auth_permissions`
--

DROP TABLE IF EXISTS `auth_permissions`;
CREATE TABLE IF NOT EXISTS `auth_permissions` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_reset_attempts`
--

DROP TABLE IF EXISTS `auth_reset_attempts`;
CREATE TABLE IF NOT EXISTS `auth_reset_attempts` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_tokens`
--

DROP TABLE IF EXISTS `auth_tokens`;
CREATE TABLE IF NOT EXISTS `auth_tokens` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `expires` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `auth_tokens_user_id_foreign` (`user_id`),
  KEY `selector` (`selector`(250))
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_users_permissions`
--

DROP TABLE IF EXISTS `auth_users_permissions`;
CREATE TABLE IF NOT EXISTS `auth_users_permissions` (
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  KEY `auth_users_permissions_permission_id_foreign` (`permission_id`),
  KEY `user_id_permission_id` (`user_id`,`permission_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `biaya_pemeliharaan`
--

DROP TABLE IF EXISTS `biaya_pemeliharaan`;
CREATE TABLE IF NOT EXISTS `biaya_pemeliharaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `biaya_admin` float NOT NULL,
  `biaya_perm` float NOT NULL,
  `status` enum('aktif','tidak') DEFAULT 'aktif',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `biaya_pemeliharaan`
--

INSERT INTO `biaya_pemeliharaan` (`id`, `biaya_admin`, `biaya_perm`, `status`, `created_at`, `updated_at`) VALUES
(1, 2000, 3000, 'aktif', '2024-07-27 01:27:54', '2024-07-27 01:27:54');

-- --------------------------------------------------------

--
-- Table structure for table `dana_keluar`
--

DROP TABLE IF EXISTS `dana_keluar`;
CREATE TABLE IF NOT EXISTS `dana_keluar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal_keluar` date NOT NULL,
  `jumlah_keluar` float(10,2) NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

DROP TABLE IF EXISTS `meter_air`;
CREATE TABLE IF NOT EXISTS `meter_air` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pelanggan_id` int(11) NOT NULL,
  `tagihan_id` int(11) NOT NULL,
  `pembacaan_awal` int(11) NOT NULL,
  `pembacaan_akhir` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `pelanggan_id` (`pelanggan_id`),
  KEY `tagihan_id` (`tagihan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2017-11-20-223112', 'Myth\\Auth\\Database\\Migrations\\CreateAuthTables', 'default', 'Myth\\Auth', 1732957474, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

DROP TABLE IF EXISTS `pelanggan`;
CREATE TABLE IF NOT EXISTS `pelanggan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `nama` varchar(25) NOT NULL,
  `alamat` text NOT NULL,
  `no_telepon` varchar(15) NOT NULL,
  `email` varchar(25) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `id_user`, `nama`, `alamat`, `no_telepon`, `email`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Denggel', 'Sembung Jambu', '073837383', 'ok@admin.com', '2024-07-27 01:54:42', '2024-07-27 01:54:42', NULL),
(2, 3, 'saala', 'sjaidjai', '23428', 'akundicky123@gmail.com', '2024-07-30 22:13:04', '2024-07-30 22:13:04', NULL),
(4, 4, 'fdsd', 'sdd', 'sdssdf', 'dickyovo99@gmail.com', '2024-07-30 22:14:31', '2024-07-30 22:14:31', NULL),
(5, 5, 'Wabok', 'RT 9', '08292828', 'ok1@admin.com', '2024-07-31 01:36:45', '2024-07-31 01:36:45', NULL),
(6, 6, 'zulfan', '', '0893837263', '', '2024-11-30 16:16:08', '2024-11-30 16:16:08', '2024-11-30 09:16:34'),
(10, 17, 'Ahmad Zulfan', 'sini aja', '0893837263', 'ahmadzulfan002@gmail.com', '2024-12-01 10:30:00', '2024-12-01 10:30:00', NULL),
(11, NULL, 'Ahmad ZulfanOk', 'dfhjf@gmail.com', '0893837263', 'developer@tumbu.co.id', '2024-12-01 19:16:22', '2024-12-01 19:16:22', '2024-12-01 12:16:27');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

DROP TABLE IF EXISTS `pembayaran`;
CREATE TABLE IF NOT EXISTS `pembayaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tagihan_id` int(11) NOT NULL,
  `tanggal_pembayaran` date NOT NULL DEFAULT current_timestamp(),
  `jumlah_dibayar` decimal(10,2) NOT NULL,
  `metode_pembayaran` enum('cash','midtrans') NOT NULL DEFAULT 'cash',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `tagihan_id` (`tagihan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

DROP TABLE IF EXISTS `tagihan`;
CREATE TABLE IF NOT EXISTS `tagihan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pelanggan_id` int(11) NOT NULL,
  `bulan` varchar(10) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `jumlah_pemakaian` int(11) NOT NULL,
  `total_tagihan` decimal(10,2) NOT NULL,
  `status` enum('belum_dibayar','dibayar') DEFAULT 'belum_dibayar',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `reset_hash` varchar(255) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`) USING HASH
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password_hash`, `reset_hash`, `reset_at`, `reset_expires`, `activate_hash`, `status`, `status_message`, `active`, `force_pass_reset`, `created_at`, `updated_at`, `deleted_at`) VALUES
(17, 'Ahmad Zulfan', 'ahmadzulfan002@gmail.com', 'user_457277', '$2y$10$j68JypdgwJvy4Y1Hkm/v/eBW.lT531GTw3FQ3djakooQMzXo0oHS6', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2024-12-01 18:45:16', '2024-12-01 18:45:16', NULL),
(13, 'Arman', 'petugas@pamsimas.co.id', 'Arman', '$2y$10$g7IBSgbw.VjG5X3Z8LJhs.yaEL66qvkkmI9jmUiY.AHg45dYSIONy', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2024-12-01 07:05:39', '2024-12-01 07:05:39', NULL),
(10, 'Administrator', 'admin@gmail.com', 'admin', '$2y$10$gFpArI/IIknMxgmg7/YS0uimGMf0Ih18.XzrTVv5LU6RURNLz9e7G', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2024-12-01 06:46:00', '2024-12-01 06:46:00', NULL),
(15, 'Pengguna', 'user@gmail.com', 'user', '$2y$10$lUjoETWyLIv/L63FEs3caO.8o940pC6DH3BH4BNR9dmh6ShfdVFGq', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2024-12-01 11:30:17', '2024-12-01 11:30:17', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

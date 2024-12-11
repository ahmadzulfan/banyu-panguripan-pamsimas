-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2024 at 04:11 AM
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
-- Database: `pamsimas`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_activation_attempts`
--

CREATE TABLE `auth_activation_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups`
--

CREATE TABLE `auth_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auth_groups`
--

INSERT INTO `auth_groups` (`id`, `name`, `description`) VALUES
(1, 'Pimpinan', 'Pimpinan PAM Banyu Panguripan'),
(2, 'Bendahara', 'Pemegang Keuanggan'),
(3, 'Petugas', 'Relawan PAM'),
(4, 'Pelanggan', 'Pelanggan PAMSIMAS\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_permissions`
--

CREATE TABLE `auth_groups_permissions` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auth_groups_permissions`
--

INSERT INTO `auth_groups_permissions` (`group_id`, `permission_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(2, 5),
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(4, 6);

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auth_groups_users`
--

INSERT INTO `auth_groups_users` (`group_id`, `user_id`) VALUES
(1, 21),
(2, 23),
(3, 13),
(3, 17),
(3, 22),
(3, 34),
(4, 20),
(4, 24),
(4, 25),
(4, 26),
(4, 27),
(4, 31),
(4, 32),
(4, 33),
(4, 35),
(4, 36);

-- --------------------------------------------------------

--
-- Table structure for table `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(44, '::1', 'ahmadzulfan002@gmail.com', 17, '2024-12-01 13:36:52', 1),
(45, '::1', 'ahmadzulfan002@gmail.com', 17, '2024-12-02 03:42:11', 1),
(46, '::1', 'ahmadzulfan002@gmail.com', 17, '2024-12-02 09:04:14', 1),
(47, '::1', 'ahmadzulfan002@gmail.com', 17, '2024-12-02 09:26:33', 1),
(48, '::1', 'ahmadzulfan002@gmail.com', 17, '2024-12-02 10:35:30', 1),
(49, '::1', 'ahmadzulfan002@gmail.com', NULL, '2024-12-02 10:38:11', 0),
(50, '::1', 'ahmadzulfan002@gmail.com', 17, '2024-12-02 10:38:19', 1),
(51, '::1', 'ahmadzulfan002@gmail.com', NULL, '2024-12-02 12:07:59', 0),
(52, '::1', 'ahmadzulfan002@gmail.com', 17, '2024-12-02 12:08:05', 1),
(53, '::1', 'ahmadzulfan002@gmail.com', 17, '2024-12-02 12:24:31', 1),
(54, '::1', 'ahmadzulfan002@gmail.com', 17, '2024-12-02 12:37:53', 1),
(55, '::1', 'ahmadzulfan002@gmail.com', 17, '2024-12-02 12:41:05', 1),
(56, '::1', 'ahmadzulfan002@gmail.com', 17, '2024-12-02 12:47:43', 1),
(57, '::1', 'ahmadzulfan002@gmail.com', NULL, '2024-12-02 12:53:35', 0),
(58, '::1', 'ahmadzulfan002@gmail.com', 17, '2024-12-02 12:53:42', 1),
(59, '::1', 'ahmadzulfan002@gmail.com', 17, '2024-12-02 12:55:21', 1),
(60, '::1', 'ahmadzulfan002@gmail.com', 17, '2024-12-02 13:35:35', 1),
(61, '::1', 'ahmadzulfan002@gmail.com', 17, '2024-12-02 13:41:16', 1),
(62, '::1', 'ahmadzulfan002@gmail.com', NULL, '2024-12-02 14:12:49', 0),
(63, '::1', 'ahmadzulfan002@gmail.com', NULL, '2024-12-02 14:12:56', 0),
(64, '::1', 'ahmadzulfan002@gmail.com', 17, '2024-12-02 14:13:33', 1),
(65, '::1', 'ahmadzulfan002@gmail.com', NULL, '2024-12-03 08:02:52', 0),
(66, '::1', 'ahmadzulfan002@gmail.com', NULL, '2024-12-03 08:02:59', 0),
(67, '::1', 'ahmadzulfan002@gmail.com', NULL, '2024-12-03 08:03:06', 0),
(68, '::1', 'ahmadzulfan002@gmail.com', NULL, '2024-12-03 08:03:12', 0),
(69, '::1', 'ahmadzulfan012@gmail.com', 17, '2024-12-03 08:03:39', 1),
(70, '::1', 'ahmadzulfan012@gmail.com', 17, '2024-12-03 13:31:13', 1),
(71, '::1', 'ok@admin.com', NULL, '2024-12-03 13:44:06', 0),
(72, '::1', 'ok@admin.com', 20, '2024-12-03 13:44:16', 1),
(73, '::1', 'ahmadzulfan012@gmail.com', 17, '2024-12-03 13:44:40', 1),
(74, '::1', 'ok@admin.com', 20, '2024-12-03 13:45:37', 1),
(75, '::1', 'ahmadzulfan012@gmail.com', 17, '2024-12-03 13:46:20', 1),
(76, '::1', 'ok@admin.com', 20, '2024-12-03 13:48:17', 1),
(77, '::1', 'ok@admin.com', 20, '2024-12-03 13:51:17', 1),
(78, '::1', 'ahmadzulfan012@gmail.com', 17, '2024-12-03 13:53:54', 1),
(79, '::1', 'ahmadzulfan012@gmail.com', 17, '2024-12-04 06:28:53', 1),
(80, '::1', 'pimpinan@gmail.com', 21, '2024-12-04 06:43:23', 1),
(81, '::1', 'petugas@gmail.com', 22, '2024-12-04 06:45:43', 1),
(82, '::1', 'bendahara@gmail.com', 23, '2024-12-04 06:47:34', 1),
(83, '::1', 'pelanggan@gmail.com', 24, '2024-12-04 06:48:18', 1),
(84, '::1', 'pimpinan@gmail.com', 21, '2024-12-04 06:48:43', 1),
(85, '::1', 'petugas@gmail.com', 22, '2024-12-04 06:51:47', 1),
(86, '::1', 'petugas@gmail.com', 22, '2025-12-04 06:57:09', 1),
(87, '::1', 'bendahara@gmail.com', 23, '2024-12-04 06:59:05', 1),
(88, '::1', 'pelanggan@gmail.com', 24, '2024-12-04 07:01:10', 1),
(89, '::1', 'pimpinan@gmail.com', 21, '2024-12-04 07:01:33', 1),
(90, '::1', 'petugas@gmail.com', 22, '2024-12-05 04:16:55', 1),
(91, '::1', 'petugas@gmail.com', 22, '2024-12-05 06:43:08', 1),
(92, '::1', 'petugas@gmail.com', 22, '2024-12-05 06:45:48', 1),
(93, '::1', 'petugas@gmail.com', 22, '2024-12-05 07:20:30', 1),
(94, '::1', 'petugas@gmail.com', 22, '2024-12-05 07:28:45', 1),
(95, '::1', 'petugas@gmail.com', 22, '2024-12-05 07:40:11', 1),
(96, '::1', 'petugas@gmail.com', 22, '2024-12-05 08:07:53', 1),
(97, '::1', 'petugas@gmail.com', 22, '2024-12-05 12:21:53', 1),
(98, '::1', 'petugas@gmail.com', 22, '2024-12-05 17:38:11', 1),
(99, '::1', 'petugas@gmail.com', 22, '2024-12-05 18:42:51', 1),
(100, '::1', 'bendahara@gmail.com', 23, '2024-12-05 19:52:59', 1),
(101, '::1', 'pimpinan@gmail.com', 21, '2024-12-09 06:01:58', 1),
(102, '::1', 'pimpinan@gmail.com', 21, '2024-12-09 14:20:59', 1),
(103, '::1', 'petugas@gmail.com', 22, '2024-12-09 14:22:04', 1),
(104, '::1', 'petugas@gmail.com', 22, '2024-12-09 16:11:22', 1),
(105, '::1', 'pimpinan@gmail.com', 21, '2024-12-09 16:20:11', 1),
(106, '::1', 'pimpinan@gmail.com', 21, '2024-12-10 13:18:06', 1),
(107, '::1', 'pimpinan@gmail.com', 21, '2024-12-10 15:15:43', 1),
(108, '::1', 'pimpinan@gmail.com', 21, '2024-12-13 17:33:53', 1),
(109, '::1', 'pimpinan@gmail.com', 21, '2024-12-11 02:21:49', 1),
(110, '::1', 'petugas@gmail.com', 22, '2024-12-11 02:38:58', 1),
(111, '::1', 'agos@gmail.com', 35, '2024-12-11 02:40:15', 1),
(112, '::1', 'agos@gmail.com', 35, '2024-12-11 02:48:32', 1),
(113, '::1', 'pimpinan@gmail.com', 21, '2024-12-11 02:52:09', 1),
(114, '::1', 'petugas@gmail.com', 22, '2024-12-11 02:54:04', 1),
(115, '::1', 'andi@gmail.com', 36, '2024-12-11 02:54:35', 1),
(116, '::1', 'petugas@gmail.com', 22, '2024-12-11 02:57:28', 1),
(117, '::1', 'agos@gmail.com', 35, '2024-12-11 02:57:50', 1);

-- --------------------------------------------------------

--
-- Table structure for table `auth_permissions`
--

CREATE TABLE `auth_permissions` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auth_permissions`
--

INSERT INTO `auth_permissions` (`id`, `name`, `description`) VALUES
(1, 'manage-pelanggan', 'Kelola Data Pelanggan'),
(2, 'manage-users', 'Kelola Data User'),
(3, 'manage-tagihan', 'Kelola Data Tagihan'),
(4, 'manage-laporan', 'Kelola Data Laporan'),
(5, 'manage-keuangan', 'Kelola Data Keuangan'),
(6, 'manage-riwayat-pembayaran', 'Kelola Data Riwayat Pembayaran');

-- --------------------------------------------------------

--
-- Table structure for table `auth_reset_attempts`
--

CREATE TABLE `auth_reset_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auth_reset_attempts`
--

INSERT INTO `auth_reset_attempts` (`id`, `email`, `ip_address`, `user_agent`, `token`, `created_at`) VALUES
(1, 'ahmadzulfan002@gmail.com', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '78e65777014c48eedffcc3c7ea9d836a', '2024-12-02 10:37:51'),
(2, 'ahmadzulfan002@gmail.com', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'c709564fd9129199105a0398e6baf29c', '2024-12-02 19:07:48'),
(3, 'ahmadzulfan002@gmail.com', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '3b0c8a1ff0ab5d32b21440a3754bdb92', '2024-12-02 19:24:11'),
(4, 'ahmadzulfan002@gmail.com', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '94bfeed27fef9abf1ecf890212f88647', '2024-12-02 19:25:03'),
(5, 'ahmadzulfan002@gmail.com', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '042f07cf203aae8e0a82964e4b473e54', '2024-12-02 19:34:41'),
(6, 'ahmadzulfan002@gmail.com', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'ce5396cb759889006ca54a4455d771e9', '2024-12-02 19:35:31'),
(7, 'ahmadzulfan002@gmail.com', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '921e630a5b4ddebeb341712d999f1993', '2024-12-02 19:38:49'),
(8, 'ahmadzulfan002@gmail.com', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'a9f3c4a308d4d7ce0ef67b70b326df99', '2024-12-02 19:55:07'),
(9, 'pimpinan@gmail.com', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', '7441f7bc58c9ca1a6a9c34e7e65e4286', '2024-12-11 00:07:22');

-- --------------------------------------------------------

--
-- Table structure for table `auth_tokens`
--

CREATE TABLE `auth_tokens` (
  `id` int(11) UNSIGNED NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_users_permissions`
--

CREATE TABLE `auth_users_permissions` (
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 2000, 1000, 'aktif', '2024-07-27 01:27:54', '2024-12-04 13:51:25');

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
(5, '2024-12-13', 100000.00, 'dsaff', '2024-12-13 17:35:14', NULL);

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
(2, 30, 2, 0, 10, '2024-12-11 00:24:39', '2024-12-11 00:24:39'),
(3, 23, 3, 0, 10, '2024-12-11 00:32:05', '2024-12-11 00:32:05'),
(4, 35, 4, 0, 30, '2024-12-11 00:32:15', '2024-12-11 00:32:15'),
(5, 25, 5, 0, 20, '2024-12-11 00:32:55', '2024-12-11 00:32:55'),
(6, 32, 6, 0, 12, '2024-12-14 00:34:01', '2024-12-14 00:34:01'),
(7, 33, 7, 0, 12, '2024-12-14 00:34:49', '2024-12-14 00:34:49');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2017-11-20-223112', 'Myth\\Auth\\Database\\Migrations\\CreateAuthTables', 'default', 'Myth\\Auth', 1732957474, 1);

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
  `email` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `id_user`, `nama`, `alamat`, `no_telepon`, `email`, `created_at`, `updated_at`, `deleted_at`) VALUES
(15, NULL, 'pelanggan', 'sembung jambu no.17', '087734342423', 'pelanggan@gmail.com', '2024-12-04 13:40:32', '2024-12-04 13:40:32', '2024-12-09 14:21:37'),
(19, NULL, 'Rasam', 'RT/RW 09/02', '08927256152', NULL, '2024-12-05 14:04:59', '2024-12-05 14:04:59', '2024-12-09 14:21:41'),
(21, NULL, '', 'RT/RW 09/02', '', 'bendahara@gmail.com', '2024-12-05 15:23:28', '2024-12-05 15:23:28', '2024-12-09 14:21:45'),
(22, NULL, 'Rasam 2', 'RT/RW 09/02', '089272561565', 'pelanggan9@gmail.com', '2024-12-05 16:02:34', '2024-12-05 16:02:34', '2024-12-09 14:21:48'),
(23, NULL, 'Daroyah', 'RT/RW 09/02', '088432424323', 'pimpinan@gmail.com', '2024-12-09 21:34:54', '2024-12-09 21:34:54', NULL),
(24, NULL, 'Waryuni', 'RT/RW 09/02', '088432424321', 'waryuni@gmail.com', '2024-12-09 21:35:21', '2024-12-09 21:35:21', NULL),
(25, 36, 'andi', 'RT/RW 09/02', '088432424322', 'andi@gmail.com', '2024-12-09 21:37:00', '2024-12-09 21:37:00', NULL),
(26, NULL, 'Royi', 'RT/RW 09/02', '088432424324', 'royi@gmail.com', '2024-12-09 21:38:15', '2024-12-09 21:38:15', NULL),
(27, NULL, 'Kasmari', 'RT/RW 09/02', '088432424325', 'kasmari@gmail.com', '2024-12-09 21:38:41', '2024-12-09 21:38:41', NULL),
(28, NULL, 'Rayuti', 'RT/RW 09/02', '088432424326', 'rayuti@gmail.com', '2024-12-09 21:39:16', '2024-12-09 21:39:16', NULL),
(29, NULL, 'Kupiyah', 'RT/RW 09/02', '088432424327', 'kupiyah@gmail.com', '2024-12-09 21:39:44', '2024-12-09 21:39:44', NULL),
(30, 35, 'Agos', 'RT/RW 09/02', '088432424328', NULL, '2024-12-09 21:40:37', '2024-12-09 21:40:37', '2024-12-11 02:57:39'),
(31, NULL, 'Paoji', 'RT/RW 09/02', '088432424329', NULL, '2024-12-09 21:40:57', '2024-12-09 21:40:57', NULL),
(32, NULL, 'Hadi', 'RT/RW 09/02', '088432424311', NULL, '2024-12-09 21:41:58', '2024-12-09 21:41:58', NULL),
(33, NULL, 'Tarono', 'RT/RW 09/02', '088432424312', NULL, '2024-12-09 21:42:18', '2024-12-09 21:42:18', NULL),
(34, NULL, 'Supi', 'RT/RW 09/02', '088432424343', NULL, '2024-12-09 21:42:35', '2024-12-09 21:42:35', NULL),
(35, NULL, 'Aliyah', 'RT/RW 09/02', '088432424376', NULL, '2024-12-09 21:42:51', '2024-12-09 21:42:51', NULL),
(36, NULL, 'Daryono', 'RT/RW 09/02', '088432424334', NULL, '2024-12-09 21:43:07', '2024-12-09 21:43:07', NULL),
(37, NULL, 'Tariso', 'RT/RW 09/02', '088432424654', NULL, '2024-12-09 21:43:31', '2024-12-09 21:43:31', NULL),
(38, NULL, 'Taruni', 'RT/RW 09/02', '08843242443', NULL, '2024-12-09 21:45:27', '2024-12-09 21:45:27', NULL),
(39, NULL, 'Manis', 'RT/RW 09/02', '088432425665', NULL, '2024-12-09 21:46:47', '2024-12-09 21:46:47', NULL),
(40, NULL, 'Supi', 'RT/RW 09/02', '0884324243343', NULL, '2024-12-09 21:47:08', '2024-12-09 21:47:08', '2024-12-09 14:47:24'),
(41, NULL, 'Wardi', 'RT/RW 09/02', '08843242455', NULL, '2024-12-09 21:48:03', '2024-12-09 21:48:03', NULL),
(42, NULL, 'Waridi', 'RT/RW 09/02', '0884324243121', NULL, '2024-12-09 21:48:23', '2024-12-09 21:48:23', NULL),
(43, NULL, 'Tabran', 'RT/RW 09/02', '088432424543', NULL, '2024-12-09 21:48:41', '2024-12-09 21:48:41', NULL);

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
(1, 2, '2024-12-11', 12000.00, 'cash', '2024-12-10 17:24:44', NULL),
(2, 3, '2024-12-11', 12000.00, 'cash', '2024-12-10 17:32:19', NULL),
(3, 4, '2024-12-11', 32000.00, 'cash', '2024-12-10 17:32:23', NULL),
(4, 5, '2024-12-11', 22000.00, 'cash', '2024-12-10 17:33:00', NULL),
(5, 6, '2024-12-14', 14000.00, 'cash', '2024-12-13 17:34:05', NULL);

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
(2, 30, '12', '2024', 10, 12000.00, 'dibayar', '2024-12-11 00:24:39', '2024-12-11 00:24:44'),
(3, 23, '12', '2024', 10, 12000.00, 'dibayar', '2024-12-11 00:32:05', '2024-12-11 00:32:19'),
(4, 35, '12', '2024', 30, 32000.00, 'dibayar', '2024-12-11 00:32:15', '2024-12-11 00:32:23'),
(5, 25, '12', '2024', 20, 22000.00, 'dibayar', '2024-12-11 00:32:55', '2024-12-11 00:32:59'),
(6, 32, '12', '2024', 12, 14000.00, 'dibayar', '2024-12-14 00:34:01', '2024-12-14 00:34:05'),
(7, 33, '12', '2024', 12, 14000.00, 'belum_dibayar', '2024-12-14 00:34:49', '2024-12-14 00:34:49');

--
-- Triggers `tagihan`
--
DELIMITER $$
CREATE TRIGGER `delete_meter_air` AFTER DELETE ON `tagihan` FOR EACH ROW DELETE FROM meter_air WHERE tagihan_id = OLD.id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) DEFAULT NULL,
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
  `deleted_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password_hash`, `reset_hash`, `reset_at`, `reset_expires`, `activate_hash`, `status`, `status_message`, `active`, `force_pass_reset`, `created_at`, `updated_at`, `deleted_at`) VALUES
(21, 'pimpinan@gmail.com', 'user_096297', '$2y$10$FHRZf6YC2Os17gcJYlc6meBZzF7ic19H6Vqo8hPRXkI9lTx2c8dcO', NULL, '2024-12-11 00:07:22', NULL, NULL, NULL, NULL, 1, 0, '2024-12-04 13:41:43', '2024-12-11 00:07:22', NULL),
(22, 'petugas@gmail.com', 'user_061074', '$2y$10$uPR5VaRkNMgehYvle4sdgOXilMYquf9gfNk24EjF1Nc2qpbwgcNmy', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2024-12-04 13:42:22', '2024-12-04 13:42:22', NULL),
(23, 'bendahara@gmail.com', 'user_704664', '$2y$10$QjTMy4FsyGLbwJwfNRlusOBn3dACxjzeh1rUwhJaBUjN1AiszIAPS', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2024-12-04 13:42:37', '2024-12-04 13:42:37', NULL),
(24, 'pelanggan@gmail.com', 'user_035181', '$2y$10$ooAFDONHPbrzUggXVkVRguum.u8Hnh4HnkF42slw3QGpw.Q6jkGlq', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2024-12-04 13:42:55', '2024-12-09 14:21:21', '2024-12-09 14:21:21'),
(35, 'agos@gmail.com', 'agos', '$2y$10$QdCrLYd7vgY5s1VDXsbk4OBmLV6h2Hh0Fh1xwUVeMryXQpkxhctAy', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2024-12-11 02:40:04', '2024-12-11 02:40:04', NULL),
(36, 'andi@gmail.com', 'andi', '$2y$10$5qOwLdcyqCRlHaTT.hPTEu3WQj2pESePtS0jqJ3KGSHb/KWU9V9ta', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2024-12-11 02:54:21', '2024-12-11 02:54:21', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups`
--
ALTER TABLE `auth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `group_id_permission_id` (`group_id`,`permission_id`);

--
-- Indexes for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`),
  ADD KEY `group_id_user_id` (`group_id`,`user_id`);

--
-- Indexes for table `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`(250)),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_tokens_user_id_foreign` (`user_id`),
  ADD KEY `selector` (`selector`(250));

--
-- Indexes for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD KEY `auth_users_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `user_id_permission_id` (`user_id`,`permission_id`);

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_telepon` (`no_telepon`),
  ADD UNIQUE KEY `email` (`email`),
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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`) USING HASH;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_groups`
--
ALTER TABLE `auth_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `biaya_pemeliharaan`
--
ALTER TABLE `biaya_pemeliharaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dana_keluar`
--
ALTER TABLE `dana_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `meter_air`
--
ALTER TABLE `meter_air`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tagihan`
--
ALTER TABLE `tagihan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

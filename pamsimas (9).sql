-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Waktu pembuatan: 25 Jul 2025 pada 17.40
-- Versi server: 9.1.0
-- Versi PHP: 8.2.26

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
-- Struktur dari tabel `auth_activation_attempts`
--

DROP TABLE IF EXISTS `auth_activation_attempts`;
CREATE TABLE IF NOT EXISTS `auth_activation_attempts` (
  `id` int UNSIGNED NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_agent` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_groups`
--

DROP TABLE IF EXISTS `auth_groups`;
CREATE TABLE IF NOT EXISTS `auth_groups` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `auth_groups`
--

INSERT INTO `auth_groups` (`id`, `name`, `description`) VALUES
(1, 'Pimpinan', 'Pimpinan PAM Banyu Panguripan'),
(2, 'Bendahara', 'Pemegang Keuanggan'),
(3, 'Petugas', 'Relawan PAM'),
(4, 'Pelanggan', 'Pelanggan PAMSIMAS\r\n');

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_groups_permissions`
--

DROP TABLE IF EXISTS `auth_groups_permissions`;
CREATE TABLE IF NOT EXISTS `auth_groups_permissions` (
  `group_id` int UNSIGNED NOT NULL DEFAULT '0',
  `permission_id` int UNSIGNED NOT NULL DEFAULT '0',
  KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`),
  KEY `group_id_permission_id` (`group_id`,`permission_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `auth_groups_permissions`
--

INSERT INTO `auth_groups_permissions` (`group_id`, `permission_id`) VALUES
(1, 1),
(1, 1),
(1, 2),
(1, 2),
(1, 3),
(1, 3),
(1, 4),
(1, 4),
(1, 5),
(1, 5),
(2, 5),
(2, 5),
(3, 1),
(3, 1),
(3, 2),
(3, 3),
(3, 3),
(3, 4),
(3, 4),
(4, 6),
(4, 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_groups_users`
--

DROP TABLE IF EXISTS `auth_groups_users`;
CREATE TABLE IF NOT EXISTS `auth_groups_users` (
  `group_id` int UNSIGNED NOT NULL DEFAULT '0',
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  KEY `auth_groups_users_user_id_foreign` (`user_id`),
  KEY `group_id_user_id` (`group_id`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `auth_groups_users`
--

INSERT INTO `auth_groups_users` (`group_id`, `user_id`) VALUES
(1, 21),
(1, 21),
(1, 21),
(2, 23),
(2, 23),
(2, 23),
(2, 37),
(2, 37),
(2, 47),
(3, 13),
(3, 13),
(3, 13),
(3, 17),
(3, 17),
(3, 17),
(3, 22),
(3, 22),
(3, 22),
(3, 34),
(3, 34),
(3, 34),
(3, 43),
(3, 43),
(3, 46),
(4, 20),
(4, 20),
(4, 20),
(4, 24),
(4, 24),
(4, 24),
(4, 25),
(4, 25),
(4, 25),
(4, 26),
(4, 26),
(4, 26),
(4, 27),
(4, 27),
(4, 27),
(4, 31),
(4, 31),
(4, 31),
(4, 32),
(4, 32),
(4, 32),
(4, 33),
(4, 33),
(4, 33),
(4, 35),
(4, 35),
(4, 35),
(4, 36),
(4, 36),
(4, 36),
(4, 38),
(4, 38),
(4, 39),
(4, 39),
(4, 40),
(4, 40),
(4, 41),
(4, 41),
(4, 42),
(4, 42),
(4, 44),
(4, 44),
(4, 45);

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_logins`
--

DROP TABLE IF EXISTS `auth_logins`;
CREATE TABLE IF NOT EXISTS `auth_logins` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `email` (`email`(250)),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=222 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `auth_logins`
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
(117, '::1', 'agos@gmail.com', 35, '2024-12-11 02:57:50', 1),
(118, '::1', 'pimpinan@gmail.com', 21, '2024-12-11 07:01:56', 1),
(119, '::1', 'pimpinan@gmail.com', 21, '2024-12-11 15:20:18', 1),
(120, '::1', 'agos@gmail.com', 35, '2024-12-11 16:43:25', 1),
(121, '::1', 'agos@gmail.com', 35, '2024-12-11 16:44:39', 1),
(122, '::1', 'pimpinan@gmail.com', 21, '2024-12-11 16:48:43', 1),
(123, '::1', 'agos@gmail.com', 35, '2024-12-11 16:49:00', 1),
(124, '::1', 'pimpinan@gmail.com', 21, '2024-12-11 16:55:25', 1),
(125, '::1', 'petugas@gmail.com', 22, '2024-12-11 16:57:51', 1),
(126, '::1', 'pimpinan@gmail.com', 21, '2024-12-11 16:58:47', 1),
(127, '::1', 'pimpinan@gmail.com', 21, '2024-12-15 16:35:45', 1),
(128, '::1', 'bendahara@gmail.com', 23, '2024-12-15 16:39:49', 1),
(129, '::1', 'pimpinan@gmail.com', 21, '2024-12-17 17:20:56', 1),
(130, '::1', 'pimpinan@gmail.com', 21, '2025-01-11 07:14:26', 1),
(131, '::1', 'pimpinan@gmail.com', 21, '2025-01-14 14:15:08', 1),
(132, '::1', 'pimpinan@gmail.com', 21, '2025-01-14 14:22:13', 1),
(133, '::1', 'pimpinan@gmail.com', 21, '2025-01-14 14:50:38', 1),
(134, '::1', 'petugas@gmail.com', 22, '2025-01-14 14:51:45', 1),
(135, '::1', 'pimpinan@gmail.com', 21, '2025-01-14 14:52:34', 1),
(136, '::1', 'pimpinan@gmail.com', 21, '2025-01-14 15:28:17', 1),
(137, '::1', 'pimpinan@gmail.com', 21, '2025-01-14 15:34:50', 1),
(138, '::1', 'pimpinan@gmail.com', 21, '2025-01-14 16:31:07', 1),
(139, '::1', 'bendahara@gmail.com', 23, '2025-01-14 16:35:15', 1),
(140, '::1', 'petugas@gmail.com', 22, '2025-01-14 16:37:05', 1),
(141, '::1', 'aliyah@gmail.com', NULL, '2025-01-14 16:39:19', 0),
(142, '::1', 'bendahara@gmail.com', 23, '2025-01-14 16:39:32', 1),
(143, '::1', 'pimpinan@gmail.com', 21, '2025-01-14 16:40:46', 1),
(144, '::1', 'petugas@gmail.com', 22, '2025-01-14 17:10:23', 1),
(145, '::1', 'andi@gmail.com', 36, '2025-01-14 17:11:15', 1),
(146, '::1', 'pimpinan@gmail.com', 21, '2025-01-14 17:14:03', 1),
(147, '::1', 'petugas@gmail.com', 22, '2025-01-14 17:15:01', 1),
(148, '::1', 'pimpinan@gmail.com', 21, '2025-01-14 17:32:13', 1),
(149, '::1', 'petugas2@gmail.com', 43, '2025-01-14 17:33:01', 1),
(150, '::1', 'andi@gmail.com', 36, '2025-01-14 17:36:38', 1),
(151, '::1', 'petugas@gmail.com', 22, '2025-01-14 18:55:33', 1),
(152, '::1', 'andi 2', NULL, '2025-01-14 19:06:47', 0),
(153, '::1', 'petugas@gmail.com', 22, '2025-01-14 19:06:54', 1),
(154, '::1', 'andi111@gmail.com', 36, '2025-01-14 19:07:17', 1),
(155, '::1', 'petugas@gmail.com', 22, '2025-01-14 19:07:38', 1),
(156, '::1', 'andi111@gmail.com', 36, '2025-01-14 19:08:32', 1),
(157, '::1', 'petugas@gmail.com', 22, '2025-01-14 19:11:56', 1),
(158, '::1', 'andi111@gmail.com', 36, '2025-01-14 19:12:56', 1),
(159, '::1', 'pimpinan@gmail.com', 21, '2025-01-14 19:14:52', 1),
(160, '::1', 'petugas@gmail.com', 22, '2025-01-14 19:16:37', 1),
(161, '::1', 'pimpinan@gmail.com', 21, '2025-01-15 06:06:17', 1),
(162, '::1', 'petugas@gmail.com', NULL, '2025-01-15 08:20:42', 0),
(163, '::1', 'petugas@gmail.com', NULL, '2025-01-15 08:20:50', 0),
(164, '::1', 'petugas22@gmail.com', 22, '2025-01-15 08:20:58', 1),
(165, '::1', 'pimpinan@gmail.com', 21, '2025-01-15 08:46:28', 1),
(166, '::1', 'petugas@gmail.com', NULL, '2025-01-15 08:56:59', 0),
(167, '::1', 'petugas@gmail.com', NULL, '2025-01-15 08:57:05', 0),
(168, '::1', 'petugas22@gmail.com', 22, '2025-01-15 08:57:15', 1),
(169, '::1', 'pimpinan@gmail.com', 21, '2025-01-15 09:00:21', 1),
(170, '::1', 'bendahara@gmail.com', 23, '2025-01-15 09:01:09', 1),
(171, '::1', 'petugas@gmail.com', NULL, '2025-01-15 09:01:46', 0),
(172, '::1', 'petugas22@gmail.com', 22, '2025-01-15 09:01:54', 1),
(173, '::1', 'pimpinan@gmail.com', 21, '2025-01-15 09:06:04', 1),
(174, '::1', 'agos', NULL, '2025-01-15 09:09:22', 0),
(175, '::1', 'petugas22@gmail.com', 22, '2025-01-15 09:09:39', 1),
(176, '::1', 'pimpinan@gmail.com', 21, '2025-01-15 09:10:09', 1),
(177, '::1', 'petugas@gmail.com', NULL, '2025-01-17 06:55:12', 0),
(178, '::1', 'petugas@gmail.com', NULL, '2025-01-17 06:55:27', 0),
(179, '::1', 'petugas22@gmail.com', NULL, '2025-01-17 06:55:37', 0),
(180, '::1', 'petugas@gmail.com', NULL, '2025-01-17 06:55:47', 0),
(181, '::1', 'petugas22@gmail.com', 22, '2025-01-17 06:55:55', 1),
(182, '::1', 'petugas@gmail.com', NULL, '2025-01-17 08:09:05', 0),
(183, '::1', 'petugas22@gmail.com', NULL, '2025-01-17 08:09:12', 0),
(184, '::1', 'petugas22@gmail.com', 22, '2025-01-17 08:10:01', 1),
(185, '::1', 'agos', NULL, '2025-01-17 08:23:28', 0),
(186, '::1', 'agos', NULL, '2025-01-17 08:23:35', 0),
(187, '::1', 'pimpinan@gmail.com', 21, '2025-01-17 08:23:41', 1),
(188, '::1', 'andi2', NULL, '2025-01-17 08:24:25', 0),
(189, '::1', 'pimpinan@gmail.com', 21, '2025-01-17 08:24:31', 1),
(190, '::1', 'andi777', NULL, '2025-01-17 08:25:06', 0),
(191, '::1', 'andi777', NULL, '2025-01-17 08:25:15', 0),
(192, '::1', 'kasmari@gmail.com', NULL, '2025-01-17 08:25:29', 0),
(193, '::1', 'pimpinan@gmail.com', 21, '2025-01-17 08:25:40', 1),
(194, '::1', 'petugas@gmail.com', NULL, '2025-01-17 08:26:05', 0),
(195, '::1', 'petugas22@gmail.com', 22, '2025-01-17 08:26:14', 1),
(196, '::1', 'daroyah', NULL, '2025-01-17 08:26:55', 0),
(197, '::1', 'ok2@admin.com', 45, '2025-01-17 08:27:04', 1),
(198, '::1', 'daroyah', NULL, '2025-01-17 08:28:34', 0),
(199, '::1', 'ok2@admin.com', 45, '2025-01-17 08:28:42', 1),
(200, '::1', 'petugas@gmail.com', NULL, '2025-01-17 09:52:04', 0),
(201, '::1', 'petugas22@gmail.com', 22, '2025-01-17 09:52:19', 1),
(202, '::1', 'agos', NULL, '2025-01-17 09:52:46', 0),
(203, '::1', 'ok2@admin.com', 45, '2025-01-17 09:52:55', 1),
(204, '::1', 'petugas@gmail.com', NULL, '2025-01-17 13:27:22', 0),
(205, '::1', 'petugas22@gmail.com', 22, '2025-01-17 13:27:30', 1),
(206, '::1', 'petugas22@gmail.com', 22, '2025-01-17 16:15:43', 1),
(207, '::1', 'petugas22@gmail.com', 22, '2025-01-17 16:27:45', 1),
(208, '::1', 'petugas22@gmail.com', 22, '2025-01-17 16:31:04', 1),
(209, '::1', 'petugas22@gmail.com', 22, '2025-01-17 16:32:17', 1),
(210, '::1', 'petugas@gmail.com', NULL, '2025-01-18 07:49:25', 0),
(211, '::1', 'petugas22@gmail.com', 22, '2025-01-18 07:49:30', 1),
(212, '::1', 'pimpinan@gmail.com', 21, '2025-01-18 07:53:11', 1),
(213, '::1', 'pimpinan@gmail.com', NULL, '2025-01-18 07:53:27', 0),
(214, '::1', 'pimpinan@gmail.com', NULL, '2025-01-18 07:53:33', 0),
(215, '::1', 'pimpinan@gmail.com', NULL, '2025-01-18 07:54:38', 0),
(216, '::1', 'pimpinan@gmail.com', NULL, '2025-01-18 07:54:43', 0),
(217, '::1', 'pimpinan', NULL, '2025-01-18 07:55:03', 0),
(218, '::1', 'pimpinan@gmail.com', 21, '2025-01-18 07:55:54', 1),
(219, '::1', 'bendahara@gmail.com', 23, '2025-07-25 17:34:14', 1),
(220, '::1', 'pimpinan@gmail.com', 21, '2025-07-25 17:38:52', 1),
(221, '::1', 'petugas@gmail.com', 22, '2025-07-25 17:39:05', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_permissions`
--

DROP TABLE IF EXISTS `auth_permissions`;
CREATE TABLE IF NOT EXISTS `auth_permissions` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `auth_permissions`
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
-- Struktur dari tabel `auth_reset_attempts`
--

DROP TABLE IF EXISTS `auth_reset_attempts`;
CREATE TABLE IF NOT EXISTS `auth_reset_attempts` (
  `id` int UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_agent` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `auth_reset_attempts`
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
-- Struktur dari tabel `auth_tokens`
--

DROP TABLE IF EXISTS `auth_tokens`;
CREATE TABLE IF NOT EXISTS `auth_tokens` (
  `id` int UNSIGNED NOT NULL,
  `selector` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `hashedValidator` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `expires` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `auth_tokens_user_id_foreign` (`user_id`),
  KEY `selector` (`selector`(250))
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_users_permissions`
--

DROP TABLE IF EXISTS `auth_users_permissions`;
CREATE TABLE IF NOT EXISTS `auth_users_permissions` (
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `permission_id` int UNSIGNED NOT NULL DEFAULT '0',
  KEY `auth_users_permissions_permission_id_foreign` (`permission_id`),
  KEY `user_id_permission_id` (`user_id`,`permission_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `biaya_pemeliharaan`
--

DROP TABLE IF EXISTS `biaya_pemeliharaan`;
CREATE TABLE IF NOT EXISTS `biaya_pemeliharaan` (
  `id` int NOT NULL,
  `biaya_admin` float NOT NULL,
  `biaya_perm` float NOT NULL,
  `status` enum('aktif','tidak') COLLATE utf8mb4_general_ci DEFAULT 'aktif',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `biaya_pemeliharaan`
--

INSERT INTO `biaya_pemeliharaan` (`id`, `biaya_admin`, `biaya_perm`, `status`, `created_at`, `updated_at`) VALUES
(1, 2000, 1000, 'aktif', '2024-07-27 01:27:54', '2024-12-04 13:51:25'),
(1, 2000, 1000, 'aktif', '2024-07-27 01:27:54', '2024-12-04 13:51:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dana_keluar`
--

DROP TABLE IF EXISTS `dana_keluar`;
CREATE TABLE IF NOT EXISTS `dana_keluar` (
  `id` int NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `jumlah_keluar` float(10,2) NOT NULL,
  `keterangan` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `dana_keluar`
--

INSERT INTO `dana_keluar` (`id`, `tanggal_keluar`, `jumlah_keluar`, `keterangan`, `created_at`, `updated_at`) VALUES
(12, '2024-11-15', 20000.00, 'pulsa listrik', '2024-11-15 14:46:07', NULL),
(13, '2024-10-17', 20000.00, 'pulsa listrik', '2024-11-15 14:46:23', NULL),
(14, '2024-12-15', 20000.00, 'pulsa listrik', '2024-11-15 14:46:38', NULL),
(15, '2025-01-14', 20000.00, 'pulsa listrik', '2025-01-14 16:40:29', NULL),
(5, '2024-12-13', 100000.00, 'dsaff', '2024-12-13 17:35:14', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dana_masuk`
--

DROP TABLE IF EXISTS `dana_masuk`;
CREATE TABLE IF NOT EXISTS `dana_masuk` (
  `id` int NOT NULL,
  `jumlah_masuk` float(11,2) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `keterangan` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `dana_masuk`
--

INSERT INTO `dana_masuk` (`id`, `jumlah_masuk`, `tanggal_masuk`, `keterangan`, `created_at`, `updated_at`) VALUES
(5, 200000.00, '2024-12-15', 'donasi', '2024-12-15 14:43:25', NULL),
(6, 100000.00, '2025-01-14', 'donasi pak rahmat', '2025-01-14 16:40:03', NULL),
(3, 1000000.00, '2024-12-11', 'Dana Talangan dari rusdi', '2024-12-11 17:20:42', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `meter_air`
--

DROP TABLE IF EXISTS `meter_air`;
CREATE TABLE IF NOT EXISTS `meter_air` (
  `id` int NOT NULL,
  `pelanggan_id` int NOT NULL,
  `tagihan_id` int NOT NULL,
  `pembacaan_awal` int NOT NULL,
  `pembacaan_akhir` int NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `meter_air`
--

INSERT INTO `meter_air` (`id`, `pelanggan_id`, `tagihan_id`, `pembacaan_awal`, `pembacaan_akhir`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 0, 19, '2024-12-17 21:49:23', '2024-12-17 21:49:23'),
(34, 60, 34, 0, 20, '2025-01-17 23:33:08', '2025-01-17 23:33:08'),
(35, 60, 35, 20, 30, '2025-01-17 23:33:19', '2025-01-17 23:33:19'),
(37, 60, 37, 30, 40, '2025-01-18 00:53:11', '2025-01-18 00:53:11'),
(2, 30, 2, 0, 10, '2024-12-11 00:24:39', '2024-12-11 00:24:39'),
(3, 23, 3, 0, 10, '2024-12-11 00:32:05', '2024-12-11 00:32:05'),
(4, 35, 4, 0, 30, '2024-12-11 00:32:15', '2024-12-11 00:32:15'),
(5, 25, 5, 0, 20, '2024-12-11 00:32:55', '2024-12-11 00:32:55'),
(6, 32, 6, 0, 12, '2024-12-14 00:34:01', '2024-12-14 00:34:01'),
(7, 33, 7, 0, 12, '2024-12-14 00:34:49', '2024-12-14 00:34:49'),
(0, 30, 0, 10, 40, '2025-07-26 00:39:25', '2025-07-26 00:39:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` bigint UNSIGNED NOT NULL,
  `version` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2017-11-20-223112', 'Myth\\Auth\\Database\\Migrations\\CreateAuthTables', 'default', 'Myth\\Auth', 1732957474, 1),
(1, '2017-11-20-223112', 'Myth\\Auth\\Database\\Migrations\\CreateAuthTables', 'default', 'Myth\\Auth', 1732957474, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

DROP TABLE IF EXISTS `pelanggan`;
CREATE TABLE IF NOT EXISTS `pelanggan` (
  `id` int NOT NULL,
  `id_user` int DEFAULT NULL,
  `nomor_pelanggan` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_general_ci NOT NULL,
  `no_telepon` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `id_user`, `nomor_pelanggan`, `nama`, `alamat`, `no_telepon`, `email`, `created_at`, `updated_at`, `deleted_at`) VALUES
(58, NULL, 'PLG-00001', 'Daroyah', 'RT/RW 09/02', '088432424323', 'ok@admin.com', '2025-01-17 15:10:11', '2025-01-17 15:10:11', NULL),
(60, NULL, 'PLG-00002', 'diki', 'RT/RW 09/02', '08843242432', 'dickyilmansyah01@gmail.com', '2024-12-17 21:45:29', '2024-12-17 21:45:29', NULL),
(62, NULL, 'PLG-00003', 'Tarono', 'RT/RW 09/02', '088432424323', 'okw@admin.com', '2025-01-17 23:21:50', '2025-01-17 23:21:50', NULL),
(15, NULL, '', 'pelanggan', 'sembung jambu no.17', '087734342423', 'pelanggan@gmail.com', '2024-12-04 13:40:32', '2024-12-04 13:40:32', '2024-12-09 14:21:37'),
(19, NULL, '', 'Rasam', 'RT/RW 09/02', '08927256152', NULL, '2024-12-05 14:04:59', '2024-12-05 14:04:59', '2024-12-09 14:21:41'),
(21, NULL, '', '', 'RT/RW 09/02', '', 'bendahara@gmail.com', '2024-12-05 15:23:28', '2024-12-05 15:23:28', '2024-12-09 14:21:45'),
(22, NULL, '', 'Rasam 2', 'RT/RW 09/02', '089272561565', 'pelanggan9@gmail.com', '2024-12-05 16:02:34', '2024-12-05 16:02:34', '2024-12-09 14:21:48'),
(23, NULL, '', 'Daroyah', 'RT/RW 09/02', '088432424323', 'pimpinan@gmail.com', '2024-12-09 21:34:54', '2024-12-09 21:34:54', NULL),
(24, NULL, '', 'Waryuni', 'RT/RW 09/02', '088432424321', 'waryuni@gmail.com', '2024-12-09 21:35:21', '2024-12-09 21:35:21', NULL),
(25, 36, '', 'andi', 'RT/RW 09/02', '088432424322', 'andi@gmail.com', '2024-12-09 21:37:00', '2024-12-09 21:37:00', NULL),
(26, NULL, '', 'Royi', 'RT/RW 09/02', '088432424324', 'royi@gmail.com', '2024-12-09 21:38:15', '2024-12-09 21:38:15', NULL),
(27, NULL, '', 'Kasmari', 'RT/RW 09/02', '088432424325', 'kasmari@gmail.com', '2024-12-09 21:38:41', '2024-12-09 21:38:41', NULL),
(28, NULL, '', 'Rayuti', 'RT/RW 09/02', '088432424326', 'rayuti@gmail.com', '2024-12-09 21:39:16', '2024-12-09 21:39:16', NULL),
(29, NULL, '', 'Kupiyah', 'RT/RW 09/02', '088432424327', 'kupiyah@gmail.com', '2024-12-09 21:39:44', '2024-12-09 21:39:44', NULL),
(30, 35, '', 'Agos', 'RT/RW 09/02', '088432424328', NULL, '2024-12-09 21:40:37', '2024-12-09 21:40:37', NULL),
(31, NULL, '', 'Paoji', 'RT/RW 09/02', '088432424329', NULL, '2024-12-09 21:40:57', '2024-12-09 21:40:57', NULL),
(32, NULL, '', 'Hadi', 'RT/RW 09/02', '088432424311', NULL, '2024-12-09 21:41:58', '2024-12-09 21:41:58', NULL),
(33, NULL, '', 'Tarono', 'RT/RW 09/02', '088432424312', NULL, '2024-12-09 21:42:18', '2024-12-09 21:42:18', NULL),
(34, NULL, '', 'Supi', 'RT/RW 09/02', '088432424343', NULL, '2024-12-09 21:42:35', '2024-12-09 21:42:35', NULL),
(35, NULL, '', 'Aliyah', 'RT/RW 09/02', '088432424376', NULL, '2024-12-09 21:42:51', '2024-12-09 21:42:51', NULL),
(36, NULL, '', 'Daryono', 'RT/RW 09/02', '088432424334', NULL, '2024-12-09 21:43:07', '2024-12-09 21:43:07', NULL),
(37, NULL, '', 'Tariso', 'RT/RW 09/02', '088432424654', NULL, '2024-12-09 21:43:31', '2024-12-09 21:43:31', NULL),
(38, NULL, '', 'Taruni', 'RT/RW 09/02', '08843242443', NULL, '2024-12-09 21:45:27', '2024-12-09 21:45:27', NULL),
(39, NULL, '', 'Manis', 'RT/RW 09/02', '088432425665', NULL, '2024-12-09 21:46:47', '2024-12-09 21:46:47', NULL),
(40, NULL, '', 'Supi', 'RT/RW 09/02', '0884324243343', NULL, '2024-12-09 21:47:08', '2024-12-09 21:47:08', '2024-12-09 14:47:24'),
(41, NULL, '', 'Wardi', 'RT/RW 09/02', '08843242455', NULL, '2024-12-09 21:48:03', '2024-12-09 21:48:03', NULL),
(42, NULL, '', 'Waridi', 'RT/RW 09/02', '0884324243121', NULL, '2024-12-09 21:48:23', '2024-12-09 21:48:23', NULL),
(43, NULL, '', 'Tabran', 'RT/RW 09/02', '088432424543', NULL, '2024-12-09 21:48:41', '2024-12-09 21:48:41', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

DROP TABLE IF EXISTS `pembayaran`;
CREATE TABLE IF NOT EXISTS `pembayaran` (
  `id` int NOT NULL,
  `tagihan_id` int NOT NULL,
  `tanggal_pembayaran` date NOT NULL,
  `jumlah_dibayar` decimal(10,2) NOT NULL,
  `metode_pembayaran` enum('cash','midtrans') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'cash',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `tagihan_id`, `tanggal_pembayaran`, `jumlah_dibayar`, `metode_pembayaran`, `created_at`, `updated_at`) VALUES
(1, 2, '2024-12-11', 12000.00, 'cash', '2024-12-10 10:24:44', NULL),
(2, 3, '2024-12-11', 12000.00, 'cash', '2024-12-10 10:32:19', NULL),
(3, 4, '2024-12-11', 32000.00, 'cash', '2024-12-10 10:32:23', NULL),
(4, 5, '2024-12-11', 22000.00, 'cash', '2024-12-10 10:33:00', NULL),
(5, 6, '2024-12-14', 14000.00, 'cash', '2024-12-13 10:34:05', NULL),
(6, 9, '2024-12-12', 14000.00, 'cash', '2024-12-11 23:49:14', NULL),
(7, 10, '2024-12-12', 10000.00, 'cash', '2024-12-11 23:49:20', NULL),
(8, 13, '2024-12-12', 12000.00, 'cash', '2024-12-11 23:49:35', NULL),
(9, 11, '2024-12-14', 12000.00, 'cash', '2024-12-13 21:16:04', NULL),
(10, 12, '2024-10-15', 22000.00, 'cash', '2024-10-15 07:31:14', NULL),
(11, 15, '2024-10-15', 12000.00, 'cash', '2024-10-15 07:38:21', NULL),
(12, 16, '2024-10-15', 16000.00, 'cash', '2024-10-15 07:38:25', NULL),
(13, 18, '2024-10-15', 12000.00, 'cash', '2024-10-15 07:38:30', NULL),
(14, 19, '2024-11-15', 13000.00, 'cash', '2024-11-15 07:40:36', NULL),
(15, 20, '2024-11-15', 11000.00, 'cash', '2024-11-15 07:40:41', NULL),
(16, 22, '2024-11-15', 10000.00, 'cash', '2024-11-15 07:40:52', NULL),
(17, 23, '2024-11-15', 15000.00, 'cash', '2024-11-15 07:41:00', NULL),
(18, 24, '2024-12-15', 14000.00, 'cash', '2024-12-15 07:42:12', NULL),
(19, 25, '2024-12-15', 11000.00, 'cash', '2024-12-15 07:42:17', NULL),
(21, 30, '2025-01-15', 11000.00, 'cash', '2025-01-14 12:06:01', NULL),
(22, 31, '2025-01-15', 10000.00, 'cash', '2025-01-14 12:08:21', NULL),
(23, 21, '2025-01-15', 9000.00, 'cash', '2025-01-14 12:12:41', NULL),
(25, 37, '2025-01-18', 12000.00, 'cash', '2025-01-17 11:01:23', NULL),
(26, 35, '2025-01-18', 12000.00, 'cash', '2025-01-17 11:01:37', NULL),
(0, 0, '2025-07-26', 32000.00, 'cash', '2025-07-25 17:39:32', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tagihan`
--

DROP TABLE IF EXISTS `tagihan`;
CREATE TABLE IF NOT EXISTS `tagihan` (
  `id` int NOT NULL,
  `pelanggan_id` int NOT NULL,
  `bulan` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `tahun` varchar(4) COLLATE utf8mb4_general_ci NOT NULL,
  `jumlah_pemakaian` int NOT NULL,
  `total_tagihan` decimal(10,2) NOT NULL,
  `status` enum('belum_dibayar','dibayar') COLLATE utf8mb4_general_ci DEFAULT 'belum_dibayar',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tagihan`
--

INSERT INTO `tagihan` (`id`, `pelanggan_id`, `bulan`, `tahun`, `jumlah_pemakaian`, `total_tagihan`, `status`, `created_at`, `updated_at`) VALUES
(12, 25, '10', '2024', 20, 22000.00, 'dibayar', '2024-12-12 13:48:33', '2024-10-15 21:31:14'),
(15, 30, '10', '2024', 10, 12000.00, 'dibayar', '2024-10-15 21:37:43', '2024-10-15 21:38:21'),
(16, 35, '10', '2024', 14, 16000.00, 'dibayar', '2024-10-15 21:37:56', '2024-10-15 21:38:25'),
(17, 23, '10', '2024', 20, 22000.00, 'belum_dibayar', '2024-10-15 21:38:06', '2024-10-15 21:38:06'),
(18, 36, '10', '2024', 10, 12000.00, 'dibayar', '2024-10-15 21:38:16', '2024-10-15 21:38:30'),
(19, 30, '11', '2024', 11, 13000.00, 'dibayar', '2024-10-15 21:39:11', '2024-11-15 21:40:36'),
(20, 35, '11', '2024', 9, 11000.00, 'dibayar', '2024-11-15 21:39:49', '2024-11-15 21:40:41'),
(21, 25, '11', '2024', 7, 9000.00, 'dibayar', '2024-11-15 21:39:59', '2025-01-15 02:12:41'),
(22, 23, '11', '2024', 8, 10000.00, 'dibayar', '2024-11-15 21:40:10', '2024-11-15 21:40:52'),
(23, 36, '11', '2024', 13, 15000.00, 'dibayar', '2024-11-15 21:40:32', '2024-11-15 21:41:00'),
(24, 30, '12', '2024', 12, 14000.00, 'dibayar', '2024-12-15 21:41:35', '2024-12-15 21:42:12'),
(25, 35, '12', '2024', 9, 11000.00, 'dibayar', '2024-12-15 21:41:43', '2024-12-15 21:42:16'),
(26, 25, '12', '2024', 9, 11000.00, 'belum_dibayar', '2024-12-15 21:41:52', '2024-12-15 21:41:52'),
(27, 23, '12', '2024', 9, 11000.00, 'belum_dibayar', '2024-12-15 21:42:00', '2024-12-15 21:42:00'),
(28, 36, '12', '2024', 12, 14000.00, 'belum_dibayar', '2024-12-15 21:42:08', '2024-12-15 21:42:08'),
(30, 36, '01', '2025', 9, 11000.00, 'dibayar', '2025-01-15 02:05:06', '2024-12-17 23:11:04'),
(34, 60, '11', '2024', 20, 22000.00, 'belum_dibayar', '2025-01-17 23:33:08', '2025-01-17 23:33:08'),
(35, 60, '12', '2025', 10, 12000.00, 'dibayar', '2025-01-17 23:33:19', '2025-01-18 01:01:37'),
(37, 60, '01', '2025', 10, 12000.00, 'dibayar', '2025-01-18 00:53:11', '2025-01-18 01:01:23'),
(2, 30, '12', '2024', 10, 12000.00, 'dibayar', '2024-12-11 00:24:39', '2024-12-11 00:24:44'),
(3, 23, '12', '2024', 10, 12000.00, 'dibayar', '2024-12-11 00:32:05', '2024-12-11 00:32:19'),
(4, 35, '12', '2024', 30, 32000.00, 'dibayar', '2024-12-11 00:32:15', '2024-12-11 00:32:23'),
(5, 25, '12', '2024', 20, 22000.00, 'dibayar', '2024-12-11 00:32:55', '2024-12-11 00:32:59'),
(6, 32, '12', '2024', 12, 14000.00, 'dibayar', '2024-12-14 00:34:01', '2024-12-14 00:34:05'),
(7, 33, '12', '2024', 12, 14000.00, 'belum_dibayar', '2024-12-14 00:34:49', '2024-12-14 00:34:49'),
(0, 30, '07', '2025', 30, 32000.00, 'dibayar', '2025-07-26 00:39:25', '2025-07-26 00:39:32');

--
-- Trigger `tagihan`
--
DROP TRIGGER IF EXISTS `delete_meter_air`;
DELIMITER $$
CREATE TRIGGER `delete_meter_air` AFTER DELETE ON `tagihan` FOR EACH ROW DELETE FROM meter_air WHERE tagihan_id = OLD.id
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `delete_pembaran`;
DELIMITER $$
CREATE TRIGGER `delete_pembaran` AFTER DELETE ON `tagihan` FOR EACH ROW DELETE FROM pembayaran WHERE tagihan_id = OLD.id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `username` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password_hash` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `reset_hash` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status_message` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password_hash`, `reset_hash`, `reset_at`, `reset_expires`, `activate_hash`, `status`, `status_message`, `active`, `force_pass_reset`, `created_at`, `updated_at`, `deleted_at`) VALUES
(47, 'bendahara@mail.com', 'bendahara', '$2y$10$3.E6LhSu2KIkv5heHvGfPO4hlTDqC35jcgPQcMfBOxuPYUBvPvOTa', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2025-01-18 07:58:16', '2025-01-18 07:58:16', NULL),
(24, 'pelanggan@gmail.com', 'user_035181', '$2y$10$ooAFDONHPbrzUggXVkVRguum.u8Hnh4HnkF42slw3QGpw.Q6jkGlq', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2024-12-04 13:42:55', '2025-01-18 07:57:24', '2025-01-18 07:57:24'),
(22, 'petugas@gmail.com', 'petugas3', '$2y$10$uPR5VaRkNMgehYvle4sdgOXilMYquf9gfNk24EjF1Nc2qpbwgcNmy', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2024-12-04 13:42:22', '2025-01-18 07:59:07', NULL),
(21, 'pimpinan@gmail.com', 'pimpinan', '$2y$10$FHRZf6YC2Os17gcJYlc6meBZzF7ic19H6Vqo8hPRXkI9lTx2c8dcO', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2024-12-04 13:41:43', '2025-01-18 07:53:20', NULL),
(46, 'petugas2@gmail.com', 'petugas2', '$2y$10$7/cdTYo4bGlPp03DI3KAuuwBrfrmilV2DgeEl4zWSHLBjX8gFP7Dm', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2025-01-18 07:57:14', '2025-01-18 07:57:14', NULL),
(21, 'pimpinan@gmail.com', 'user_096297', '$2y$10$FHRZf6YC2Os17gcJYlc6meBZzF7ic19H6Vqo8hPRXkI9lTx2c8dcO', NULL, '2024-12-11 00:07:22', NULL, NULL, NULL, NULL, 1, 0, '2024-12-04 13:41:43', '2024-12-11 00:07:22', NULL),
(22, 'petugas@gmail.com', 'user_061074', '$2y$10$uPR5VaRkNMgehYvle4sdgOXilMYquf9gfNk24EjF1Nc2qpbwgcNmy', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2024-12-04 13:42:22', '2024-12-04 13:42:22', NULL),
(23, 'bendahara@gmail.com', 'user_704664', '$2y$10$QjTMy4FsyGLbwJwfNRlusOBn3dACxjzeh1rUwhJaBUjN1AiszIAPS', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2024-12-04 13:42:37', '2024-12-04 13:42:37', NULL),
(24, 'pelanggan@gmail.com', 'user_035181', '$2y$10$ooAFDONHPbrzUggXVkVRguum.u8Hnh4HnkF42slw3QGpw.Q6jkGlq', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2024-12-04 13:42:55', '2024-12-09 14:21:21', '2024-12-09 14:21:21'),
(35, 'agos@gmail.com', 'agos', '$2y$10$QdCrLYd7vgY5s1VDXsbk4OBmLV6h2Hh0Fh1xwUVeMryXQpkxhctAy', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2024-12-11 02:40:04', '2024-12-11 02:40:04', NULL),
(36, 'andi@gmail.com', 'andi', '$2y$10$5qOwLdcyqCRlHaTT.hPTEu3WQj2pESePtS0jqJ3KGSHb/KWU9V9ta', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2024-12-11 02:54:21', '2024-12-11 02:54:21', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

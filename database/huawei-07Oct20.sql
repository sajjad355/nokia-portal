-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2020 at 08:48 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `huawei`
--

-- --------------------------------------------------------

--
-- Table structure for table `activation_histories`
--

CREATE TABLE `activation_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` int(11) NOT NULL,
  `imei` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fs_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchase_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activation_histories`
--

INSERT INTO `activation_histories` (`id`, `store_id`, `imei`, `model`, `price`, `fs_code`, `purchase_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 195, '012345678900000', 'Media Pad T3 7(1GB)', '5000', '15393T160722', '2020-10-05 20:18:29', 1, '2020-10-06 13:39:22', '2020-10-06 13:39:22');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `file_id` bigint(20) UNSIGNED NOT NULL,
  `sales_id` int(11) NOT NULL,
  `imei` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_for` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `upload_by` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `file_location` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`file_id`, `sales_id`, `imei`, `file_name`, `file_for`, `file_type`, `upload_by`, `status`, `file_location`, `created_at`, `updated_at`) VALUES
(1, 1, '123456789123456', '1601816781_IMG_20180227_134745.jpg', 'sales', 'image', 15, 1, 'uploads/sales/', '2020-10-04 23:06:39', '2020-10-04 23:06:39'),
(2, 1, '123456789123456', '1601816781_IMG_20180227_134745.jpg', 'sales', 'image', 15, 1, 'uploads/sales/', '2020-10-04 23:06:39', '2020-10-04 23:06:39'),
(3, 2, '123456789123457', '1601818697_07373.jpg', 'sales', 'image', 15, 1, 'uploads/sales/', '2020-10-04 23:38:31', '2020-10-04 23:38:31'),
(4, 2, '123456789123457', '1601818697_07373.jpg', 'sales', 'image', 15, 1, 'uploads/sales/', '2020-10-04 23:38:31', '2020-10-04 23:38:31'),
(5, 3, '123456789987654', '1601818824_07373.jpg', 'sales', 'image', 15, 1, 'uploads/sales/', '2020-10-04 23:40:42', '2020-10-04 23:40:42'),
(6, 3, '123456789987654', '1601818824_07373.jpg', 'sales', 'image', 15, 1, 'uploads/sales/', '2020-10-04 23:40:42', '2020-10-04 23:40:42'),
(7, 2, '123456789987654', '1601819176_07373.jpg', 'receive', 'image', 18, 2, 'uploads/services/', '2020-10-04 23:46:16', '2020-10-04 23:46:16'),
(8, 2, '123456789987654', '1601819176_07373.jpg', 'receive', 'image', 18, 2, 'uploads/services/', '2020-10-04 23:46:16', '2020-10-04 23:46:16'),
(9, 3, '123456789123457', '1601819293_07373.jpg', 'receive', 'image', 18, 2, 'uploads/services/', '2020-10-04 23:48:13', '2020-10-04 23:48:13'),
(10, 3, '123456789123457', '1601819293_07373.jpg', 'receive', 'image', 18, 2, 'uploads/services/', '2020-10-04 23:48:13', '2020-10-04 23:48:13'),
(11, 4, '123456789123456', '1601819406_07373.jpg', 'receive', 'image', 18, 2, 'uploads/services/', '2020-10-04 23:50:06', '2020-10-04 23:50:06'),
(12, 4, '123456789123456', '1601819406_07373.jpg', 'receive', 'image', 18, 2, 'uploads/services/', '2020-10-04 23:50:06', '2020-10-04 23:50:06'),
(13, 4, '012345678900000', '1601871315_20201003_155437.jpg', 'sales', 'image', 207, 1, 'uploads/sales/', '2020-10-05 14:18:29', '2020-10-05 14:18:29'),
(14, 4, '012345678900000', '1601871316_20201003_155513.jpg', 'sales', 'image', 207, 1, 'uploads/sales/', '2020-10-05 14:18:29', '2020-10-05 14:18:29'),
(15, 5, '123456897845621', '1601871714_20201003_155437.jpg', 'sales', 'image', 207, 1, 'uploads/sales/', '2020-10-05 14:23:47', '2020-10-05 14:23:47'),
(16, 5, '123456897845621', '1601871715_20201003_155513.jpg', 'sales', 'image', 207, 1, 'uploads/sales/', '2020-10-05 14:23:47', '2020-10-05 14:23:47'),
(17, 6, '636265696864615', '1601871406_0.jpg', 'sales', 'image', 15, 1, 'uploads/sales/', '2020-10-05 14:25:38', '2020-10-05 14:25:38'),
(18, 6, '636265696864615', '1601871406_0.jpg', 'sales', 'image', 15, 1, 'uploads/sales/', '2020-10-05 14:25:38', '2020-10-05 14:25:38'),
(19, 6, '636265696864615', '1601872084_0.jpg', 'receive', 'image', 18, 2, 'uploads/services/', '2020-10-05 14:28:04', '2020-10-05 14:28:04'),
(20, 6, '636265696864615', '1601872084_0.jpg', 'receive', 'image', 18, 2, 'uploads/services/', '2020-10-05 14:28:04', '2020-10-05 14:28:04'),
(21, 6, '636265696864615', '1601872425_0.jpg', 'delivery', 'image', 18, 3, 'uploads/delivery/', '2020-10-05 14:33:45', '2020-10-05 14:33:45'),
(22, 6, '636265696864615', '1601872425_0.jpg', 'delivery', 'image', 18, 3, 'uploads/delivery/', '2020-10-05 14:33:45', '2020-10-05 14:33:45'),
(23, 4, '123456789123456', '1601872919_0.jpg', 'delivery', 'image', 18, 3, 'uploads/delivery/', '2020-10-05 14:41:59', '2020-10-05 14:41:59'),
(24, 4, '123456789123456', '1601872919_0.jpg', 'delivery', 'image', 18, 3, 'uploads/delivery/', '2020-10-05 14:41:59', '2020-10-05 14:41:59'),
(25, 7, '012345678900000', '1601877004_download.jpg', 'receive', 'image', 209, 2, 'uploads/services/', '2020-10-05 15:50:04', '2020-10-05 15:50:04'),
(26, 7, '012345678900000', '1601877004_maxresdefault.jpg', 'receive', 'image', 209, 2, 'uploads/services/', '2020-10-05 15:50:05', '2020-10-05 15:50:05'),
(27, 7, '012345678900000', '1601877051_download.jpg', 'delivery', 'image', 209, 3, 'uploads/delivery/', '2020-10-05 15:50:51', '2020-10-05 15:50:51'),
(28, 7, '012345678900000', '1601877051_maxresdefault.jpg', 'delivery', 'image', 209, 3, 'uploads/delivery/', '2020-10-05 15:50:51', '2020-10-05 15:50:51'),
(29, 7, '747574757475747', '1601892477_0.jpg', 'sales', 'image', 15, 1, 'uploads/sales/', '2020-10-05 20:08:14', '2020-10-05 20:08:14'),
(30, 7, '747574757475747', '1601892477_0.jpg', 'sales', 'image', 15, 1, 'uploads/sales/', '2020-10-05 20:08:14', '2020-10-05 20:08:14'),
(31, 8, '171150545544554', '1601893027_IMG_20200810_094630.jpg', 'sales', 'image', 15, 1, 'uploads/sales/', '2020-10-05 20:17:34', '2020-10-05 20:17:34'),
(32, 8, '171150545544554', '1601893027_IMG_20200810_094630.jpg', 'sales', 'image', 15, 1, 'uploads/sales/', '2020-10-05 20:17:34', '2020-10-05 20:17:34'),
(33, 9, '747574757475747', '1601893116_0.jpg', 'receive', 'image', 18, 2, 'uploads/services/', '2020-10-05 20:18:37', '2020-10-05 20:18:37'),
(34, 9, '747574757475747', '1601893117_0.jpg', 'receive', 'image', 18, 2, 'uploads/services/', '2020-10-05 20:18:37', '2020-10-05 20:18:37'),
(35, 9, '747574757475747', '1601893162_0.jpg', 'delivery', 'image', 18, 3, 'uploads/delivery/', '2020-10-05 20:19:23', '2020-10-05 20:19:23'),
(36, 9, '747574757475747', '1601893163_0.jpg', 'delivery', 'image', 18, 3, 'uploads/delivery/', '2020-10-05 20:19:23', '2020-10-05 20:19:23'),
(37, 10, '171150545544554', '1601893694_IMG_20200221_170148.jpg', 'receive', 'image', 18, 2, 'uploads/services/', '2020-10-05 20:28:15', '2020-10-05 20:28:15'),
(38, 10, '171150545544554', '1601893695_IMG_20200810_094630.jpg', 'receive', 'image', 18, 2, 'uploads/services/', '2020-10-05 20:28:15', '2020-10-05 20:28:15'),
(39, 9, '123456789000025', '1601904431_download.jpg', 'sales', 'image', 15, 1, 'uploads/sales/', '2020-10-05 23:27:47', '2020-10-05 23:27:47'),
(40, 9, '123456789000025', '1601904431_maxresdefault.jpg', 'sales', 'image', 15, 1, 'uploads/sales/', '2020-10-05 23:27:47', '2020-10-05 23:27:47'),
(41, 10, '258369147852456', '1601908446_0.jpg', 'sales', 'image', 15, 1, 'uploads/sales/', '2020-10-06 00:34:56', '2020-10-06 00:34:56'),
(42, 10, '258369147852456', '1601908446_0.jpg', 'sales', 'image', 15, 1, 'uploads/sales/', '2020-10-06 00:34:56', '2020-10-06 00:34:56'),
(43, 11, '258369147852456', '1601908794_0.jpg', 'receive', 'image', 18, 2, 'uploads/services/', '2020-10-06 00:39:54', '2020-10-06 00:39:54'),
(44, 11, '258369147852456', '1601908794_0.jpg', 'receive', 'image', 18, 2, 'uploads/services/', '2020-10-06 00:39:54', '2020-10-06 00:39:54'),
(45, 11, '258369147852456', '1601908851_0.jpg', 'delivery', 'image', 18, 3, 'uploads/delivery/', '2020-10-06 00:40:52', '2020-10-06 00:40:52'),
(46, 11, '258369147852456', '1601908852_0.jpg', 'delivery', 'image', 18, 3, 'uploads/delivery/', '2020-10-06 00:40:52', '2020-10-06 00:40:52'),
(47, 12, '012345678900000', '1601991841_logo-64fa6df59d79c574b53c5162ccbbb4cf3fb102f8e87eaf2fd204f03c8f0a526d.png', 'delivery', 'image', 209, 3, 'uploads/delivery/', '2020-10-06 13:44:01', '2020-10-06 13:44:01'),
(48, 12, '012345678900000', '1601991841_logo-64fa6df59d79c574b53c5162ccbbb4cf3fb102f8e87eaf2fd204f03c8f0a526d.png', 'delivery', 'image', 209, 3, 'uploads/delivery/', '2020-10-06 13:44:01', '2020-10-06 13:44:01'),
(49, 13, '123456897845621', '1601992448_logo-64fa6df59d79c574b53c5162ccbbb4cf3fb102f8e87eaf2fd204f03c8f0a526d.png', 'receive', 'image', 209, 2, 'uploads/services/', '2020-10-06 13:54:08', '2020-10-06 13:54:08'),
(50, 13, '123456897845621', '1601992448_logo-64fa6df59d79c574b53c5162ccbbb4cf3fb102f8e87eaf2fd204f03c8f0a526d.png', 'receive', 'image', 209, 2, 'uploads/services/', '2020-10-06 13:54:08', '2020-10-06 13:54:08'),
(51, 14, '123456897845621', '1601992716_logo-64fa6df59d79c574b53c5162ccbbb4cf3fb102f8e87eaf2fd204f03c8f0a526d.png', 'receive', 'image', 209, 2, 'uploads/services/', '2020-10-06 13:58:36', '2020-10-06 13:58:36'),
(52, 14, '123456897845621', '1601992716_logo-64fa6df59d79c574b53c5162ccbbb4cf3fb102f8e87eaf2fd204f03c8f0a526d.png', 'receive', 'image', 209, 2, 'uploads/services/', '2020-10-06 13:58:36', '2020-10-06 13:58:36'),
(53, 14, '123456897845621', '1601999936_logo-64fa6df59d79c574b53c5162ccbbb4cf3fb102f8e87eaf2fd204f03c8f0a526d.png', 'delivery', 'image', 209, 3, 'uploads/delivery/', '2020-10-06 15:58:56', '2020-10-06 15:58:56'),
(54, 14, '123456897845621', '1601999936_logo-64fa6df59d79c574b53c5162ccbbb4cf3fb102f8e87eaf2fd204f03c8f0a526d.png', 'delivery', 'image', 209, 3, 'uploads/delivery/', '2020-10-06 15:58:56', '2020-10-06 15:58:56'),
(55, 11, '454545002145456', '1602005250_logo-64fa6df59d79c574b53c5162ccbbb4cf3fb102f8e87eaf2fd204f03c8f0a526d.png', 'sales', 'image', 207, 1, 'uploads/sales/', '2020-10-06 17:27:37', '2020-10-06 17:27:37'),
(56, 11, '454545002145456', '1602005250_logo-64fa6df59d79c574b53c5162ccbbb4cf3fb102f8e87eaf2fd204f03c8f0a526d.png', 'sales', 'image', 207, 1, 'uploads/sales/', '2020-10-06 17:27:37', '2020-10-06 17:27:37'),
(57, 12, '787871202478745', '1602005456_download.jpg', 'sales', 'image', 207, 1, 'uploads/sales/', '2020-10-06 17:31:02', '2020-10-06 17:31:02'),
(58, 12, '787871202478745', '1602005457_maxresdefault.jpg', 'sales', 'image', 207, 1, 'uploads/sales/', '2020-10-06 17:31:02', '2020-10-06 17:31:02');

-- --------------------------------------------------------

--
-- Table structure for table `fscodes`
--

CREATE TABLE `fscodes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fscode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tier` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `sale_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sale_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fscodes`
--

INSERT INTO `fscodes` (`id`, `fscode`, `tier`, `status`, `sale_date`, `sale_by`, `created_at`, `updated_at`) VALUES
(813, '15393T160722', 'T1', 3, '2020-10-05 10:18:29', 193, '2020-09-30 22:52:40', '2020-10-05 14:18:29'),
(814, '17032T117920', 'T1', 3, '2020-10-05 10:23:47', 193, '2020-09-30 22:52:40', '2020-10-05 14:23:47'),
(815, '62137T128368', 'T1', 3, '2020-10-05 19:27:47', 16, '2020-09-30 22:52:40', '2020-10-05 23:27:47'),
(816, '49784T15734', 'T1', 3, '2020-10-06 23:27:37', 193, '2020-09-30 22:52:40', '2020-10-06 17:27:37'),
(817, '15525T18448', 'T1', 1, 'None', 0, '2020-09-30 22:52:40', '2020-09-30 22:52:40'),
(818, '12429T124547', 'T1', 1, 'None', 0, '2020-09-30 22:52:40', '2020-09-30 22:52:40'),
(819, '50232T148850', 'T1', 1, 'None', 0, '2020-09-30 22:52:40', '2020-09-30 22:52:40'),
(820, '39540T149556', 'T1', 1, 'None', 0, '2020-09-30 22:52:40', '2020-09-30 22:52:40'),
(821, '37584T156008', 'T1', 1, 'None', 0, '2020-09-30 22:52:40', '2020-09-30 22:52:40'),
(822, '56962T140338', 'T1', 1, 'None', 0, '2020-09-30 22:52:40', '2020-09-30 22:52:40'),
(823, '48027T216991', 'T2', 1, 'None', 0, '2020-09-30 22:52:40', '2020-09-30 23:12:12'),
(824, '33498T249346', 'T2', 1, 'None', 0, '2020-09-30 22:52:40', '2020-10-01 17:31:41'),
(825, '4293T219388', 'T2', 1, 'None', 0, '2020-09-30 22:52:40', '2020-10-01 17:45:56'),
(826, '11260T263140', 'T2', 1, 'None', 0, '2020-09-30 22:52:40', '2020-09-30 22:52:40'),
(827, '39185T217942', 'T2', 1, 'None', 0, '2020-09-30 22:52:40', '2020-09-30 22:52:40'),
(828, '27678T225876', 'T2', 1, 'None', 0, '2020-09-30 22:52:40', '2020-09-30 22:52:40'),
(829, '64943T244697', 'T2', 1, 'None', 0, '2020-09-30 22:52:40', '2020-09-30 22:52:40'),
(830, '13804T210357', 'T2', 1, 'None', 0, '2020-09-30 22:52:40', '2020-09-30 22:52:40'),
(831, '39529T219256', 'T2', 1, 'None', 0, '2020-09-30 22:52:40', '2020-09-30 22:52:40'),
(832, '29169T220044', 'T2', 1, 'None', 0, '2020-09-30 22:52:40', '2020-09-30 22:52:40'),
(833, '60678T311520', 'T3', 3, '2020-10-05 16:17:34', 16, '2020-09-30 22:52:40', '2020-10-05 20:17:34'),
(834, '36864T319396', 'T3', 1, 'None', 0, '2020-09-30 22:52:40', '2020-10-01 17:55:10'),
(835, '29775T363698', 'T3', 1, 'None', 0, '2020-09-30 22:52:40', '2020-10-01 18:06:24'),
(836, '53073T329615', 'T3', 1, 'None', 0, '2020-09-30 22:52:40', '2020-09-30 22:52:40'),
(837, '16446T347196', 'T3', 1, 'None', 0, '2020-09-30 22:52:40', '2020-09-30 22:52:40'),
(838, '23494T315678', 'T3', 1, 'None', 0, '2020-09-30 22:52:40', '2020-09-30 22:52:40'),
(839, '10007T360693', 'T3', 1, 'None', 0, '2020-09-30 22:52:41', '2020-09-30 22:52:41'),
(840, '56970T341378', 'T3', 1, 'None', 0, '2020-09-30 22:52:41', '2020-09-30 22:52:41'),
(841, '61464T340215', 'T3', 1, 'None', 0, '2020-09-30 22:52:41', '2020-09-30 22:52:41'),
(842, '40457T350718', 'T3', 1, 'None', 0, '2020-09-30 22:52:41', '2020-09-30 22:52:41'),
(843, '51621T420829', 'T4', 3, '2020-10-04 19:06:39', 16, '2020-09-30 22:52:41', '2020-10-04 23:06:39'),
(844, '36263T410683', 'T4', 1, 'None', 0, '2020-09-30 22:52:41', '2020-10-04 16:44:56'),
(845, '36794T454475', 'T4', 1, 'None', 0, '2020-09-30 22:52:41', '2020-09-30 22:52:41'),
(846, '37554T423497', 'T4', 1, 'None', 0, '2020-09-30 22:52:41', '2020-09-30 22:52:41'),
(847, '53989T448032', 'T4', 1, 'None', 0, '2020-09-30 22:52:41', '2020-09-30 22:52:41'),
(848, '12130T450043', 'T4', 1, 'None', 0, '2020-09-30 22:52:41', '2020-09-30 22:52:41'),
(849, '33994T430214', 'T4', 1, 'None', 0, '2020-09-30 22:52:41', '2020-09-30 22:52:41'),
(850, '37387T462346', 'T4', 1, 'None', 0, '2020-09-30 22:52:41', '2020-09-30 22:52:41'),
(851, '59301T457083', 'T4', 1, 'None', 0, '2020-09-30 22:52:41', '2020-09-30 22:52:41'),
(852, '14655T463137', 'T4', 1, 'None', 0, '2020-09-30 22:52:41', '2020-09-30 22:52:41'),
(853, '37212T524464', 'T5', 3, '2020-10-04 19:40:42', 16, '2020-09-30 22:52:41', '2020-10-04 23:40:42'),
(854, '15695T533054', 'T5', 3, '2020-10-05 10:25:38', 16, '2020-09-30 22:52:41', '2020-10-05 14:25:38'),
(855, '61045T512633', 'T5', 3, '2020-10-05 16:08:14', 16, '2020-09-30 22:52:41', '2020-10-05 20:08:14'),
(856, '60319T55647', 'T5', 3, '2020-10-05 20:34:56', 16, '2020-09-30 22:52:41', '2020-10-06 00:34:56'),
(857, '13638T533474', 'T5', 3, '2020-10-06 23:31:02', 193, '2020-09-30 22:52:41', '2020-10-06 17:31:02'),
(858, '62496T550899', 'T5', 1, 'None', 0, '2020-09-30 22:52:41', '2020-09-30 22:52:41'),
(859, '49503T511173', 'T5', 1, 'None', 0, '2020-09-30 22:52:41', '2020-09-30 22:52:41'),
(860, '49660T545383', 'T5', 1, 'None', 0, '2020-09-30 22:52:41', '2020-09-30 22:52:41'),
(861, '63490T546322', 'T5', 1, 'None', 0, '2020-09-30 22:52:41', '2020-09-30 22:52:41'),
(862, '58776T562971', 'T5', 1, 'None', 0, '2020-09-30 22:52:41', '2020-09-30 22:52:41'),
(863, '18465T654674', 'T6', 1, 'None', 0, '2020-09-30 22:52:41', '2020-10-04 20:47:59'),
(864, '5094T660229', 'T6', 1, 'None', 0, '2020-09-30 22:52:41', '2020-09-30 22:52:41'),
(865, '47871T650754', 'T6', 1, 'None', 0, '2020-09-30 22:52:41', '2020-09-30 22:52:41'),
(866, '11851T663749', 'T6', 1, 'None', 0, '2020-09-30 22:52:41', '2020-09-30 22:52:41'),
(867, '5686T618901', 'T6', 1, 'None', 0, '2020-09-30 22:52:41', '2020-09-30 22:52:41'),
(868, '19678T618651', 'T6', 1, 'None', 0, '2020-09-30 22:52:41', '2020-09-30 22:52:41'),
(869, '50968T68696', 'T6', 1, 'None', 0, '2020-09-30 22:52:41', '2020-09-30 22:52:41'),
(870, '56479T647259', 'T6', 1, 'None', 0, '2020-09-30 22:52:41', '2020-09-30 22:52:41'),
(871, '49843T656950', 'T6', 1, 'None', 0, '2020-09-30 22:52:41', '2020-09-30 22:52:41'),
(872, '54416T644668', 'T6', 1, 'None', 0, '2020-09-30 22:52:41', '2020-09-30 22:52:41'),
(873, '6031T730206', 'T7', 3, '2020-10-04 19:38:31', 16, '2020-09-30 22:52:41', '2020-10-04 23:38:31'),
(874, '20339T744516', 'T7', 1, 'None', 0, '2020-09-30 22:52:41', '2020-10-04 16:20:51'),
(875, '4933T726293', 'T7', 1, 'None', 0, '2020-09-30 22:52:41', '2020-09-30 22:52:41'),
(876, '11848T744433', 'T7', 1, 'None', 0, '2020-09-30 22:52:41', '2020-09-30 22:52:41'),
(877, '60824T729011', 'T7', 1, 'None', 0, '2020-09-30 22:52:41', '2020-09-30 22:52:41'),
(878, '15542T760919', 'T7', 1, 'None', 0, '2020-09-30 22:52:41', '2020-09-30 22:52:41'),
(879, '33047T733591', 'T7', 1, 'None', 0, '2020-09-30 22:52:41', '2020-09-30 22:52:41'),
(880, '38730T734801', 'T7', 1, 'None', 0, '2020-09-30 22:52:41', '2020-09-30 22:52:41'),
(881, '11049T744946', 'T7', 1, 'None', 0, '2020-09-30 22:52:41', '2020-09-30 22:52:41'),
(882, '50785T736334', 'T7', 1, 'None', 0, '2020-09-30 22:52:41', '2020-09-30 22:52:41'),
(883, '43340T820957', 'T8', 1, 'None', 0, '2020-09-30 22:52:41', '2020-09-30 22:52:41'),
(884, '32410T828439', 'T8', 1, 'None', 0, '2020-09-30 22:52:41', '2020-09-30 22:52:41'),
(885, '33418T844813', 'T8', 1, 'None', 0, '2020-09-30 22:52:41', '2020-09-30 22:52:41'),
(886, '49539T84519', 'T8', 1, 'None', 0, '2020-09-30 22:52:41', '2020-09-30 22:52:41'),
(887, '52528T847228', 'T8', 1, 'None', 0, '2020-09-30 22:52:41', '2020-09-30 22:52:41'),
(888, '57480T849997', 'T8', 1, 'None', 0, '2020-09-30 22:52:41', '2020-09-30 22:52:41'),
(889, '33244T843358', 'T8', 1, 'None', 0, '2020-09-30 22:52:41', '2020-09-30 22:52:41'),
(890, '61711T846471', 'T8', 1, 'None', 0, '2020-09-30 22:52:41', '2020-09-30 22:52:41'),
(891, '38251T849827', 'T8', 1, 'None', 0, '2020-09-30 22:52:41', '2020-09-30 22:52:41'),
(892, '60598T84992', 'T8', 1, 'None', 0, '2020-09-30 22:52:41', '2020-09-30 22:52:41');

-- --------------------------------------------------------

--
-- Table structure for table `imei`
--

CREATE TABLE `imei` (
  `id` int(11) NOT NULL,
  `imei_four_digit` varchar(255) NOT NULL,
  `imei_full` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `imei`
--

INSERT INTO `imei` (`id`, `imei_four_digit`, `imei_full`) VALUES
(1, '2345', '123456789012345'),
(2, '2341', '123456789012341'),
(3, '9874', '123456789069874'),
(4, '1545', '915020781721545');

-- --------------------------------------------------------

--
-- Table structure for table `imeis`
--

CREATE TABLE `imeis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `imei` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `device_price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `sale_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sale_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `imeis`
--

INSERT INTO `imeis` (`id`, `imei`, `model`, `device_price`, `status`, `sale_date`, `sale_by`, `created_at`, `updated_at`) VALUES
(1, '918523383627751', 'Nokia C3', '7000', 3, '2020-09-14 15:30:08', 1, '2020-09-14 07:06:59', '2020-09-14 09:30:08'),
(2, '985595999374869', 'Nokia C2 Tava', '12000', 1, 'None', 0, '2020-09-14 07:06:59', '2020-09-14 08:38:01'),
(3, '495713598395218', 'Redmi note 3', '35000', 1, 'None', 0, '2020-09-14 07:06:59', '2020-09-14 08:38:01'),
(4, '981224473337458', 'Mate 20', '20000', 1, 'None', 0, '2020-09-14 07:06:59', '2020-09-14 08:38:01'),
(5, '512524736974379', 'Mate 8', '15000', 1, 'None', 0, '2020-09-14 07:06:59', '2020-09-14 08:38:01'),
(6, '496487168387363', 'Samsung M20', '14990', 1, 'None', 0, '2020-09-14 07:06:59', '2020-09-14 08:38:01'),
(7, '537317725414387', 'Realme450', '25000', 1, 'None', 0, '2020-09-14 07:06:59', '2020-09-14 07:06:59'),
(8, '860373656907128', 'Walton', '20000', 3, '2020-09-15 04:20:20', 1, '2020-09-14 07:06:59', '2020-09-14 22:20:20');

-- --------------------------------------------------------

--
-- Table structure for table `import_exports`
--

CREATE TABLE `import_exports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `SN` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Variable_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Industry_aggregation_NZSIOC` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Industry_code_NZSIOC` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Industry_name_NZSIOC` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Units` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Year` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Variable_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Variable_category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Industry_code_ANZSIC06` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(35, '2014_10_12_000000_create_users_table', 1),
(36, '2014_10_12_100000_create_password_resets_table', 1),
(37, '2019_08_19_000000_create_failed_jobs_table', 1),
(38, '2020_03_10_052332_laratrust_setup_tables', 1),
(41, '2020_03_12_090924_create_import_exports_table', 1),
(42, '2020_03_15_080257_create_reports_table', 1),
(52, '2020_03_12_042445_create_outlets_table', 7),
(54, '2020_03_18_182901_create_fscodes_table', 8),
(59, '2020_04_13_215947_create_files_table', 10),
(61, '2020_03_18_090120_create_service_histories_table', 12),
(63, '2020_06_14_210308_create_receive_delivery_histories_table', 14),
(69, '2020_03_10_110050_create_sales_table', 17),
(72, '2020_09_14_044338_create_imeis_table', 19),
(73, '2020_05_13_190853_create_tiers_table', 20),
(74, '2020_06_10_094024_create_phone_models_table', 20),
(75, '2020_10_01_015034_create_temp_files_table', 21),
(76, '2020_10_05_233218_create_activation_histories_table', 21);

-- --------------------------------------------------------

--
-- Table structure for table `outlets`
--

CREATE TABLE `outlets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `store_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `area` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_details` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `outlets`
--

INSERT INTO `outlets` (`id`, `store_code`, `store_name`, `address`, `district`, `area`, `contact_details`, `created_at`, `updated_at`) VALUES
(11, '0008', 'ASC_BCT', 'Shop: 19-22, Block-B, Level-3, Bashundhara City Shopping Complex, Panthapath, Dhaka-1205', 'Dhaka', 'Bashundhara City.', '01313002600', NULL, NULL),
(12, '0009', 'ASC_BOG', 'Al-Amin Complex 3rd floor( old krishi bank), Beside of Altaf Ali Market,In front of Police Fari, Nowab Bari Road, Bogra.', 'Bogra', NULL, '01313002605', NULL, NULL),
(13, '0010', 'ASC_BSL', '121, Sadar Road, 3rd Floor, Bir Srestha Captain Mohiuddin Jahangir Road, Barisal', 'Barisal', NULL, '01708488727', NULL, NULL),
(14, '0011', 'ASC_COM', 'Hemonto Tower (2nd Floor), Nazrul Avenue,  Kandirpar, Ranibazar Road, Comilla.', 'Comilla', NULL, '01313002604', NULL, NULL),
(15, '0012', 'ASC_CTG', 'Faruk Chamber, 3rd Floor, 1403, Sk. Mujib Road , Chowmuhoni, Chittagong.', 'Chittagong', NULL, '01708488723', NULL, NULL),
(16, '0013', 'ASC_GAZ', 'Bhawal Point Center (3rd Floor), Shop: 23-25, Gazipur Chowrasta, Gazipur Sadar Upazila, Dhaka.', 'Dhaka', 'Gazipur', '01313002603', NULL, NULL),
(17, '0014', 'ASC_KHL', '17, KDA Avenue, Seikh para main road, Tetultala More, Opposite of State Bank of India, Khulna-9100', 'Khulna', NULL, '01313002607', NULL, NULL),
(18, '0015', 'ASC_MOT', '56/1, Baitul View Tower, Shop 602-602, 5th Floor, Old Paltan (Opposite of Baitul Mokaram Mosque North Gate), Dhaka-1000.', 'Dhaka', 'Motijheel', '01313002601', NULL, NULL),
(19, '0016', 'ASC_MPR', 'Promise Tower (Opposite of Fire Service), 3rd Floor,Section-06, Plot-23, Main Road-01, Mirpur-02', 'Dhaka', 'Mirpur', '01708488761', NULL, NULL),
(20, '0017', 'ASC_MYM', 'Rekha Complex(2nd Floor) 90, C.K Ghosh Road, Mymensingh', 'Mymensingh', NULL, '01708488731', NULL, NULL),
(21, '0018', 'ASC_NRG', 'Fazar Ali Trade Center (2nd  floor), 78, Bangabondhu Road (2 no. rail gate), Narayangonj-1400', 'Dhaka', 'Narayangonj', '01313002602', NULL, NULL),
(22, '0019', 'ASC_RAJ', 'D.M Vaban, (Opposite of Rajshahi Chamber House) 3rd Floor, 87, Aloker Circle, New Market Road', 'Rajshahi', NULL, '01708488729', NULL, NULL),
(23, '0020', 'ASC_RGN', 'House No. - 123, Shah Bhaban, 2nd Floor, Station Road, Grand Hotel Circle,Kotuwali, Rangpur - 5400', 'Rangpur', NULL, '01704117235', NULL, NULL),
(24, '0021', 'ASC_SVR', 'MK Tower, Level 5, 42, Shaibagh, Shimul Toli, Savar', 'Dhaka', 'Savar', '01708488725', NULL, NULL),
(25, '0022', 'ASC_SYL', 'RB Complex, 2nd floor, Union Bank Building, Beside Woondal Restaurant and Hotel Golden City, East Zindabazar, Sylhet 3100.', 'Sylhet', NULL, '01313002606', NULL, NULL),
(26, '0023', 'ASC_TNG', 'Talukdar Market (Opposite of Fire Service), 2nd Floor, Old Bus Stand, Tangail', 'Dhaka', 'Tangail', '01313002608', NULL, NULL),
(27, '0024', 'ASC_UTT', 'Shop -24, 25, Polwel Carnation Shopping Centre, Level-07, Abdullahpur, Uttara, Dhaka, Bangladesh', 'Dhaka', 'Uttara', '01708488720', NULL, NULL),
(28, '0025', 'Mobile Network (2)', 'Shop No.04,Floor/Level4,Mirpur New Market,Mirpur1 Main Road,Shah Ali Thana,Dhaka', 'Dhaka', 'Dhaka North', '01711111133', NULL, NULL),
(29, '0026', 'Tech Park', 'Shop No.1St,Ground Floor,Parbota Tower,Matbor Mainshion,Khafrul,Dhaka', 'Dhaka', 'Dhaka North', '01821822088', NULL, NULL),
(30, '0027', 'Touch World- Dhaka City-N', 'Shop No.498,Ground Floor,Holding No.498,Manikdi Bazar,Cantonmen Thana,Dhaka', 'Dhaka North', 'Dhaka North', '01774810973', NULL, NULL),
(31, '0028', 'SM Telecom-Dhaka City-N', 'Shop No.A-37,Ground Floor,Rojonigondha Super Market,Cantonment,Khafrul,Dhaka', 'Dhaka', 'Dhaka North', '01711105908', NULL, NULL),
(32, '0029', 'M/S MA Traders', 'Shop No.82/1,Ground Floor,Holding No.82,Shahid Rafique Sharak,Manikganj,Dhaka', 'Dhaka', 'Dhaka North', '01682989802', NULL, NULL),
(35, '0032', 'NR International', 'Shop No.714/715,Floor/Level6,Zamzam Tower,Zamzam Tower,Uttara,Dhaka', 'Dhaka', 'Dhaka North', '01739729355', NULL, NULL),
(36, '0033', 'Haroun Telecom-2', 'Shop No.43,Floor/Level1,Land View Shopping Center,Gulshan Circle-2,Gulshan,Dhaka', 'Dhaka', 'Dhaka North', '01670895646', NULL, NULL),
(38, '0035', 'B.M.A Electronics-Dhaka City-N', 'Shop No.620&621,Level6,Mirpur Shopping Centre,Stadium Road,Mipur 2 no Bus Stand ,Dhaka-1216', 'Dhaka', 'Dhaka North', '01979399992', NULL, NULL),
(40, '0037', 'Mollah Telecom (1)', 'Shop No.511,Floor/Level5,North Tower,House Building,Uttara,Dhaka', 'Dhaka', 'Dhaka North', '01672281182', NULL, NULL),
(41, '0038', 'Z.H Telecom', 'Shop No.536,Level-5,Police Plaza Concord,Biruttam Mir Shawkat Sarak,Gulshan-1,Dhaka', 'Dhaka', 'Dhaka North', '01992029927', NULL, NULL),
(42, '0039', 'M2M Communication-Dhaka City-N', 'Shop No.20/A Block C,Floor/Level4,Jamuna Future Park,Vatara,Dhaka', 'Dhaka', 'Dhaka North', '01977717702', NULL, NULL),
(44, '0041', 'KK Electronics', 'Police Plaza, Gulshan 1 Dhaka', 'Dhaka', 'Dhaka North', '01682879783', NULL, NULL),
(45, '0042', 'Huawei Experience Store (Eerna-Savar)', '\"Shop#3025,Level#03,\r\nSavar City Center,Savar,Dhaka\"', 'Dhaka', 'Dhaka North', '01760533613', NULL, NULL),
(47, '0044', 'Araf Telecom-Dhaka City-N', 'Shop No.45,Floor/Level 3,Sah ali Plaza,Mirpur 10,Khafrul,Dhaka', 'Dhaka', 'Dhaka North', '01722235234', NULL, NULL),
(48, '0045', 'SR Telecom', 'Shop#4D-002,A2,4th Floor,Jamuna Future Park,Basundhara Gate,Dhaka', 'Dhaka', 'Dhaka North', '01724461676', NULL, NULL),
(49, '0046', 'M.Com Services', 'Abul Hosen market Shofipur bazar,Gazipur', 'Dhaka', 'Dhaka Outer', '01714980236', NULL, NULL),
(50, '0047', 'Aporupa Telecom', 'Ground Floor,Holding No.84,Wapda Road,Palash,Narsingdi,Dhaka', 'Dhaka', 'Dhaka Outer', '01716800769', NULL, NULL),
(52, '0049', 'Mishad Smartphone Gallery', ',Ground Floor,MM Plaza,Baukhor Mor Station Road,Narsingdi,Dhaka', 'Dhaka', 'Dhaka Outer', '01737944473', NULL, NULL),
(53, '0050', 'Creative zone', 'Shop No.6,Ground Floor,Alo Shopping Complex,Main Road,Teknaf,Cox\'sbazar,Chattagram', 'Dhaka', 'Dhaka Outer', '01912293930', NULL, NULL),
(54, '0051', 'Cell one mobile', 'Shop No.15,Floor/Level1,Giree Commercial Complex,Chowhatta,Sylhet', 'Dhaka', 'Dhaka Outer', '01611611911', NULL, NULL),
(55, '0052', 'HES(Al Amin Mobile)', 'Shop No.137,Ground Floor,Rose View Complex,Shah Jalal Uposhohor Point,Sylhet', 'Dhaka', 'Dhaka Outer', '01911744020', NULL, NULL),
(57, '0054', 'S, World Telecom', 'Shop No.5,Floor/Level1,Karimullah Market,Bondor Bazar,Sylhet', 'Dhaka', 'Dhaka Outer', '01715074006', NULL, NULL),
(60, '0057', 'HN Telecom 2', 'Shop No.2,Floor/Level1,FR Khan Prince Plaza,Victoria Road,Tangail,Dhaka', 'Dhaka', 'Dhaka Outer', '01936317532', NULL, NULL),
(62, '0059', 'Dip Telecom', 'Shop 1, Yaqub Ali super market (1st Floor), mawna Chowrasta,Sreepur,Gazipur', 'Dhaka', 'Dhaka Outer', '01730160210', NULL, NULL),
(63, '0060', 'HS telecom (1)', 'Shop No.3,Floor/ Level1,Mobile Market,Bus Stand,Shokhipur,Tangail,Dhaka', 'Dhaka', 'Dhaka Outer', '01727088180', NULL, NULL),
(64, '0061', 'Rajon Mobile', 'Shop No.34,Floor/Level1,Shohid Smriti School Market,Joydebpur Bus Stand,Joydebpur,Gazipur,Dhaka', 'Dhaka', 'Dhaka Outer', '01615005005', NULL, NULL),
(66, '0063', 'Comilla Telecom', 'Shop No.6,Floor/Level1,Anupam Super Market,Chowrasta,Joydebpur,Gazipur,Dhaka', 'Dhaka', 'Dhaka Outer', '01744144943', NULL, NULL),
(68, '0065', 'Maria telecom (4)', 'Shop 2, Wahed Tower, Bhaluka, Mymensingh', 'Dhaka', 'Dhaka Outer', '01715993388', NULL, NULL),
(69, '0066', 'Sohi Distribution', 'Shop No.1,Floor/Level1,GP Center,Victoria Road,Tangail,Dhaka', 'Dhaka', 'Dhaka Outer', '01711909853', NULL, NULL),
(70, '0067', 'Habib Telecom (4)', 'Shop No.13,Ground Floor,Zila Parishad Market,T A Road,Brahmanbaria,Chattagram', 'Dhaka', 'Dhaka Outer', '01711584342', NULL, NULL),
(72, '0069', 'Mobile Bazar (11)', 'Shop No.29,Ground Floor,Ridoy Tower,Durgabari Road,Mymensingh,Mymensingh', 'Dhaka', 'Dhaka Outer', '01713738098', NULL, NULL),
(73, '0070', ' Huawei Experience store-Mobilelink International', 'Shop No.23&24,Block-B,Floor/Level1,Bashundhara City Shopping Mall,Panthapath,Tajgaon,Dhaka', 'Dhaka', 'Dhaka South', '01711567790', NULL, NULL),
(74, '0071', ' Huawei Experience store-Eerna-3', 'Block-C,Level-1,Shop-4.B.city', 'Dhaka', 'Dhaka South', '01709651117', NULL, NULL),
(75, '0072', 'Huawei Experience storeArchos-Dhaka City-S', 'Shop No.1/A-1/B,Block A,Floor/Level6,Bashundhara City Shopping Mall,Thana,Dhaka', 'Dhaka', 'Dhaka South', '01678133338', NULL, NULL),
(76, '0073', ' Huawei Experience store-Sahat Electronics', 'Shop No.5/17,Floor/Level4,Eastern Plaza,Kalabagan,Dhaka', 'Dhaka', 'Dhaka South', '01713068850', NULL, NULL),
(77, '0074', ' Huawei Experience store-Irani telecom', 'Shop No.530,Floor/Level4,Motaleb Plaza,Kalabagan,Dhaka', 'Dhaka', 'Dhaka South', '01721533637', NULL, NULL),
(79, '0076', 'New Mobile Hut', 'Shop No.302,2nd Floor,Hasnat Square,B B Road,Narayanganj,Dhaka', 'Dhaka', 'Dhaka South', '01913111009', NULL, NULL),
(81, '0078', 'SB telecom', 'Shop No.74/75,Floor/Level5,Eastern Plus Shopping Complex,Shantinagar,Palton,Dhaka', 'Dhaka', 'Dhaka South', '01611301130', NULL, NULL),
(82, '0079', 'Ideal cellular', 'Shop No.312,Floor/Level2,Baitul Veiw Tower,56/1,Palton,Dhaka', 'Dhaka', 'Dhaka South', '01618787342', NULL, NULL),
(83, '0080', 'Ahnaf Electronics', 'Shop No.302,Floor/Level2,Baitul Veiw Tower,56/1,Purana Paltan,Dhaka', 'Dhaka', 'Dhaka South', '01918161501', NULL, NULL),
(85, '0082', 'Friend Verse', 'Shop No.510,Floor/Level5,Shamoly Square,Mirpur Road,Adabor,Dhaka', 'Dhaka', 'Dhaka South', '01911334493', NULL, NULL),
(87, '0084', 'Bismillah Mobile House', 'Shop No.609,Floor/Level6,Tokyo Square,Ring Road,Adabor,Dhaka', 'Dhaka', 'Dhaka South', '01815321831', NULL, NULL),
(88, '0085', 'Huawei Experience Store(Mohammadpur) ', 'Shop No.2-3,Ground Floor,Mohammadpur Kendrio College Market,Tajmohol Road,Mohammadpur,Dhaka', 'Dhaka', 'Dhaka South', '01975328328', NULL, NULL),
(89, '0086', 'Huawei Experience Store DS Gallery (SMART 2ND)', 'Ground Floor,Holding No.1,KDA Avenue,Khulna', 'Khulna', NULL, '01711295340', NULL, NULL),
(90, '0087', 'The Mobile Store', '13,KDA Avenue,Khulna (Opp State Bank of India)', 'Khulna', NULL, '01713213955', NULL, NULL),
(91, '0088', 'Modern Communication', '05,K.D.A Avenue Baitun-Nur Mosque Market.Khulna', 'Khulna', NULL, '01711079717', NULL, NULL),
(94, '0091', 'HES- Easy Touch', 'Ground Floor,Janhan Ara Market,Holding No.417,Bhola,Barisal', 'Khulna', NULL, '01711339433', NULL, NULL),
(95, '0092', 'HES- Noor Smart Zone', 'Shop No.2,Ground Floor,Holding No.N/2,Sadar road,Patuakhali,Barisal', 'Khulna', NULL, '01748911999', NULL, NULL),
(96, '0093', 'HES- Hello Barishal 6', 'Shop No.303,Floor/Level4,Fatema Center,Barisal', 'Khulna', NULL, '01792312282', NULL, NULL),
(98, '0095', 'Munshi Telecom', 'Shop No.5,Floor/Level1,Vanga bazar, New Market, Vanga,Faridpur.', 'Khulna', NULL, '01742859547', NULL, NULL),
(99, '0096', 'Kazi Electronics', 'Shop No.10,Ground Floor,City Plaza,Puran Bazar,Madaripur', 'Khulna', NULL, '01716817311', NULL, NULL),
(100, '0097', 'H.K Telecom', 'Shop No.453,Floor/Level4,Sanmar Ocean City,CDA Avenue,Nasirabad,Panchlaish,Chattagram', 'Chittagong', NULL, '01814953565', NULL, NULL),
(101, '0098', 'Music Mantra', '444, Sanmar Ocean City, 4th floor, East Nasirabad, Chittagong', 'Chittagong', NULL, '01726398483', NULL, NULL),
(102, '0099', 'Ahad Telecom- Chittagong Metro', 'Shop No.409,Floor/Level4,Sanmar Ocean City,CDA Avenue,Nasirabad,Panchlaish,Chattagram', 'Chittagong', NULL, '01817260461', NULL, NULL),
(103, '0100', 'HUAWEI EXPERIENCE SHOP(Banskhali)', 'Shop No.25,Ground Floor,G.S.Plaza,Banshkhali Pouroshava,Chattagram', 'Chittagong', NULL, '01817766399', NULL, NULL),
(104, '0101', 'Bengal Telecom', 'Shop No.13,Floor/Level1,Apollo Shopping Center,Kotwali Police Station,Chattagram', 'Chittagong', NULL, '01750030626', NULL, NULL),
(105, '0102', 'Rony Enterprise', 'Shop No.306,Floor/Level3,Sayed Center,Chawkbazar,Chattagram', 'Chittagong', NULL, '01940414141', NULL, NULL),
(107, '0104', 'R H Rashed Telecom', 'Shop No.403,Floor/Level4,Finley Square,No.2 Gate,Nasirabad,Chattagram', 'Chittagong', NULL, '01814484811', NULL, NULL),
(108, '0105', 'Baj International', 'Shop No.1&2,Floor/Level1,Central Shopping Complex,GEC Circle,Panchlaish,Chattagram', 'Chittagong', NULL, '01773300100', NULL, NULL),
(110, '0107', 'Mobile Link-(3)', 'Shop No.408/A,Floor/Level3,New Market,Kotwali Police Station,Chattagram', 'Chittagong', NULL, '01819611440', NULL, NULL),
(111, '0108', 'Abedin Brand Shop', 'Shop No.419,Floor/Level3,New Market,Kotwali Police Station,Chattagram', 'Chittagong', NULL, '01876627914', NULL, NULL),
(112, '0109', 'Sheba Brand Shop', 'Shop No.A3,Ground Floor,Hotel Holiday,Main Road,Cox\'sbazar,Chattagram', 'Chittagong', NULL, '01701755001', NULL, NULL),
(114, '0111', 'Ovi Telecom', 'Shop No.6, 1st Floor/Level2,New Super Market,Chokoria,Coxsbazar,Chattagram', 'Chittagong', NULL, '01740600902', NULL, NULL),
(116, '0113', 'World Connection', 'Ground Floor,Majumder Palace,Noakhali Bypass Road,Laksham,Cumilla,Chattagram', 'Chittagong', NULL, '01855366355', NULL, NULL),
(117, '0114', 'M. K Electronics', 'Ground Floor,Lafa Tower,West Bazer,Hajigonj,Chandpur,Chattagram', 'Chittagong', NULL, '01815468471', NULL, NULL),
(118, '0115', 'Nur Smart Shop-Comilla', 'Ground Floor, Jhawtala opposite grameenphone center,Kotowali Thana,Cumilla,Chattagram', 'Chittagong', NULL, '01727745867', NULL, NULL),
(119, '0116', 'Modina Plaza', 'Shop No.G2,Ground Floor,Morshed Alom Complex,Korimpur Road,Chowmohoni,Noakhali.', 'Chittagong', NULL, '01816235433', NULL, NULL),
(121, '0118', 'Cell Finder', 'Shop No.502/A,Floor/Level4,Akhtaruzzaman Center,Double Morring,Chattagram', 'Chittagong', NULL, '01859970777', NULL, NULL),
(122, '0119', 'Idea Smart cafe plus(HES).', 'Shop No.35-36,Floor/Level5,Runner Plaza,Nobab Bari Road,Bogura,Rajshahi', 'Rajshahi ', NULL, '01792475959', NULL, NULL),
(123, '0120', 'Taseen Telecom', 'Ground Floor,Holding No.652,S S Road,Sirajganj,Rajshahi', 'Rajshahi ', NULL, '01711118744', NULL, NULL),
(124, '0121', 'NB TEL', 'Shop No.1,Ground Floor,Lutfunnesa Market,Setabgonj Road,Dinajpur Sadar,Dinajpur,Rajshahi', 'Rajshahi ', NULL, '01715842484', NULL, NULL),
(125, '0122', 'M/S Tuser Enterprise(HES)', 'Shop No.145,Ground Floor,Near Rail Station,Station Road,Ishwardi,Pabna,Rajshahi', 'Rajshahi ', NULL, '01711504093', NULL, NULL),
(126, '0123', 'Z.H Telecom', 'Ground Floor,Holding No.242/A,Greater Road,Boalia,Rajshahi', 'Rajshahi ', NULL, '01711270786', NULL, NULL),
(127, '0124', 'Wave Telecom', 'Ground Floor,New Market,Holding No.0854-00,Bonggobondhu Road,Thakurgaon,Rangpur', 'Rajshahi ', NULL, '01774702233', NULL, NULL),
(128, '0125', 'GABS Trade Linker', 'Shop No.3,Floor/Level1,Abdul Zolil Super Market, Sorisahatir More Main Road,Naogaon,Upazila,Naogaon,Rajshahi', 'Rajshahi ', NULL, '01708702025', NULL, NULL),
(129, '0126', 'Anan\'s', 'Shop No.UMO-108,Ground Floor,Zila Porishod Super Market,Rangpur,Super Market Road,Sodor,Rangpur', 'Rajshahi ', NULL, '01762864676', NULL, NULL),
(130, '0127', 'Top Enterpries (HES ).', 'Ground Floor,Biswas Super Market,Holding No.2808,Thana Road,Pabna,Rajshahi', 'Rajshahi ', NULL, '01711361881', NULL, NULL),
(134, '0128', 'Gadget Narayanganj', '144 B.B.Road,Jahan Plaza,Narayangonj', 'Dhaka South', NULL, '1400628444', '2020-09-16 19:10:13', '2020-09-16 19:10:13'),
(135, '0129', 'EERNA-8', 'Shop#518,519,520,Level#4,Police plaza Concord,Gulshan-1', 'Dhaka North', NULL, '1730701950', '2020-09-16 19:10:13', '2020-09-16 19:10:13'),
(136, '0130', 'Bushra phone', 'Shop No#29,Block#D,Level#6,Bashundhara City', 'Dhaka South', NULL, '1780499455', '2020-09-16 19:10:13', '2020-09-16 19:10:13'),
(137, '0131', 'Aamar Shop.bd', 'Shop# 665,Level - 5,Mirpur Shopping Complex,Mirpur- 02', 'Dhaka North', NULL, '1798221847', '2020-09-16 19:10:13', '2020-09-16 19:10:13'),
(138, '0132', 'Eerna 5(JFP)', 'Level -4 Jamuna Future park,Dhaka', 'Dhaka North', NULL, '1709651168', '2020-09-16 19:10:13', '2020-09-16 19:10:13'),
(139, '0133', 'G&G (JFP)', 'Level:4, Jamuna Future Park, Kuril, Dhaka', 'Dhaka North', NULL, '1712414995', '2020-09-16 19:10:14', '2020-09-16 19:10:14'),
(140, '0134', 'Huawei Mobile Galary', 'Floor/Level1, Hajara monjil, Mohipal Plaza,S S K Road,Feni,Chattagram', 'Chittagong', NULL, '1812429770', '2020-09-16 19:10:14', '2020-09-16 19:10:14'),
(141, '0135', 'Pickabo(BCT)', 'Shop No.32, Block-B,Floor/Level1,Bashundhara City Shopping Mall,Panthapath,Tajgaon,Dhaka', 'Dhaka South', NULL, '1673377374', '2020-09-16 19:10:14', '2020-09-16 19:10:14'),
(142, '0136', 'Mi Zone', '151, KDA New Market Khulna', 'Khulna', NULL, '1713411211', '2020-09-16 19:10:14', '2020-09-16 19:10:14'),
(143, '0137', 'AK Mobile Corner', '82,KDA New Market,Khulna', 'Khulna', NULL, '1711274667', '2020-09-16 19:10:14', '2020-09-16 19:10:14'),
(144, '0138', 'Huawei Experience Store (MHT Telecom)', 'Ground Floor,Zilla Porishod Market,Holding No.20 & 21,Post Office Road,Pirojpur,Khulna', 'Khulna', NULL, '1716178129', '2020-09-16 19:10:14', '2020-09-16 19:10:14'),
(145, '0139', 'Ahsan Telecom (1)', 'Shop No.144,Ground Floor,Monru Shoppingcity,Chowhatta,Sylhet', 'Dhaka Outer', NULL, '1718536205', '2020-09-16 19:10:14', '2020-09-16 19:10:14'),
(146, '0140', 'Mobile Hut(Narayangonj)', 'Shop No.302,2nd Floor,B B Road, Hasnat Square,Narayanganj,Dhaka', 'Dhaka South', NULL, '1913111009', '2020-09-16 19:10:14', '2020-09-16 19:10:14'),
(147, '0141', 'Idea smart cafe', 'Shop No.7-8/17-18,Floor/Level1,Al Amin Complex,Nobab Bari Road,Bogura,Rajshahi', 'Rajshahi', NULL, '1792475959', '2020-09-16 19:10:14', '2020-09-16 19:10:14'),
(148, '0142', 'Tasin Mobile Shop', 'Shop No.01,Ground Floor,Isa kha Plaza Sonargaon,Mograpara Chowrasta, Sonargaon,Narayanganj,Dhaka', 'Dhaka South', NULL, '1821987777', '2020-09-16 19:10:15', '2020-09-16 19:10:15'),
(149, '0143', 'Mobile Fair-Dhaka City-N', 'Shop No.33,Floor/Level3,Rajlaxmi Complex,Rabindro Soroni,West Uttara,Dhaka', 'Dhaka North', NULL, '1716730898', '2020-09-16 19:10:15', '2020-09-16 19:10:15'),
(150, '0144', 'Hello Barisal 4', 'Shop No.13,Floor/Level1,City Plaza,Barisal', 'Khulna', NULL, '1735997931', '2020-09-16 19:10:15', '2020-09-16 19:10:15'),
(151, '0145', 'SS Enterprise - Magura', 'Opposide Of Govt Girls Collage,Magura', 'Khulna', NULL, '1919218824', '2020-09-16 19:10:15', '2020-09-16 19:10:15'),
(152, '0146', 'Bismillah Telecom (25)', '2294,South Halishahor,Bandartila,ctg', 'Chittagong', NULL, '1813190900', '2020-09-16 19:10:15', '2020-09-16 19:10:15'),
(153, '0147', 'Mobile world (8)', 'New market,Ashulia,Dhaka', 'Dhaka North', NULL, '1914031809', '2020-09-16 19:10:15', '2020-09-16 19:10:15'),
(154, '0148', 'Mobile Life', 'TMMS Market, Bogra', 'Rajshahi', NULL, '1711982228', '2020-09-16 19:10:15', '2020-09-16 19:10:15'),
(155, '0149', 'Moubon Cell Bazar (1)', 'N S Road.Borobazar,Kustia', 'Khulna', NULL, '1711218353', '2020-09-16 19:10:15', '2020-09-16 19:10:15'),
(156, '0150', 'Jonone telecom-Dhaka City-S', 'Shop No. -366, level 4th,Rifles Square', 'Dhaka South', NULL, '1913032208', '2020-09-16 19:10:15', '2020-09-16 19:10:15'),
(157, '0151', 'G&G-2', '4,Block-b, Level-1, Bashundhara City', 'Dhaka South', NULL, '1682006176', '2020-09-16 19:10:15', '2020-09-16 19:10:15'),
(158, '0152', 'Nihal Brand Shop', 'Bilkis Market, Coxsbazar', 'Chittagong', NULL, '1817223809', '2020-09-16 19:10:16', '2020-09-16 19:10:16'),
(159, '0153', 'Mobile Hat.', 'Laldighipar,M.K.Road,Jessore', 'Khulna', NULL, '1718182218', '2020-09-16 19:10:16', '2020-09-16 19:10:16'),
(160, '0154', 'Best Plus', 'Navana Shopping Complex, Gulshan 1, Dhaka', 'Dhaka North', NULL, '1817035050', '2020-09-16 19:10:16', '2020-09-16 19:10:16'),
(161, '0155', 'Sky Tel (1)', 'Munsi Para,Dinajpur', 'Rajshahi', NULL, '1711961127', '2020-09-16 19:10:16', '2020-09-16 19:10:16'),
(162, '0156', 'Mobile Zone (7)', 'Madhabdi bazar boro Moszid road, Madhabdi,Narshingdi', 'Dhaka Outer', NULL, '1754398139', '2020-09-16 19:10:16', '2020-09-16 19:10:16'),
(163, '0157', 'Mobile Hut (1)', 'Aftab Plaza,Rajshahi-6100', 'Rajshahi', NULL, '1711395545', '2020-09-16 19:10:16', '2020-09-16 19:10:16'),
(164, '0158', 'TML', 'Shop-39,Level-3,Amir complex,uttara,Dhaka', 'Dhaka North', NULL, '1674008899', '2020-09-16 19:10:16', '2020-09-16 19:10:16'),
(165, '0159', 'Nazma Electric & Mobile Corner', 'GournadiBusStand,Barisal', 'Khulna', NULL, '1711246770', '2020-09-16 19:10:17', '2020-09-16 19:10:17'),
(166, '0160', 'Gunjan Telecom (1)', 'Zila Parishad Super Market(2ndFloor),Sadar,Rangpur', 'Rajshahi', NULL, '1714057947', '2020-09-16 19:10:17', '2020-09-16 19:10:17'),
(167, '0161', 'Mobile World (13)', 'Gausia Super market,Rajshahi-6100', 'Rajshahi', NULL, '1797801158', '2020-09-16 19:10:17', '2020-09-16 19:10:17'),
(168, '0162', 'Mobitel telecom', 'Hajiganj purbo bazaar', 'Chittagong', NULL, '1818273666', '2020-09-16 19:10:17', '2020-09-16 19:10:17'),
(169, '0163', 'S.M.Nokia', 'Choto Bazar , Netrokona Sadar', 'Dhaka Outer', NULL, '1731144942', '2020-09-16 19:10:17', '2020-09-16 19:10:17'),
(170, '0164', 'Jamines Telecom', 'Younus Plaza,Girjha MohhallaBarisal.', 'Khulna', NULL, '1718237770', '2020-09-16 19:10:17', '2020-09-16 19:10:17'),
(171, '0165', 'Mobile Palace (1)', 'Shop-3031, 3rd Floor, Savar City Center, Savar, Dhaka', 'Dhaka North', NULL, '1728639336', '2020-09-16 19:10:17', '2020-09-16 19:10:17'),
(172, '0166', 'Khanika Smart Gallery', 'Sadar Road,Barisal', 'Khulna', NULL, '1713460612', '2020-09-16 19:10:17', '2020-09-16 19:10:17'),
(173, '0167', 'Prince Traders- Chittagong Metro', '560, Aktharuzzaman Center , (4th Floor),Agrabad,CTG.', 'Chittagong', NULL, '1818678266', '2020-09-16 19:10:17', '2020-09-16 19:10:17'),
(174, '0168', 'G&G 13', 'level-6,block-B,shop-1&2 BCT,Dhaka', 'Dhaka South', NULL, '1914437561', '2020-09-16 19:10:17', '2020-09-16 19:10:17'),
(175, '0169', 'Nexus- Chittagong Metro', 'Sanmar,CTG', 'Chittagong', NULL, '1937500500', '2020-09-16 19:10:18', '2020-09-16 19:10:18'),
(176, '0170', 'G&G(Motizheel)', '9-Motizheel,Commercial area', 'Dhaka South', NULL, '1780001923', '2020-09-16 19:10:18', '2020-09-16 19:10:18'),
(177, '0171', 'One Telecom.', 'AR Corner,Pabna', 'Rajshahi', NULL, '1716194853', '2020-09-16 19:10:18', '2020-09-16 19:10:18'),
(178, '0172', 'Zara Telecom-Dhaka City-N', 'Kalachandpur, Norda bustand road, Dhaka', 'Dhaka North', NULL, '1911112210', '2020-09-16 19:10:18', '2020-09-16 19:10:18'),
(179, '0173', 'Mobile Mela 2 (3)', 'Mahipal plaza, Feni', 'Chittagong', NULL, '1819875955', '2020-09-16 19:10:18', '2020-09-16 19:10:18'),
(180, '0174', 'Voice Tel', 'Opposide OE Kc College,Maulana Vashani Sarok,Jhenaidah', 'Khulna', NULL, '1712707090', '2020-09-16 19:10:18', '2020-09-16 19:10:18'),
(181, '0175', 'Shah Yeamin Enterprise', 'Zilaporesod Market,Charfassion', 'Khulna', NULL, '1711702897', '2020-09-16 19:10:18', '2020-09-16 19:10:18'),
(182, '0176', 'G & G(North Tower)', 'North Tower,Uttara.', 'Dhaka North', NULL, '1636474619', '2020-09-16 19:10:18', '2020-09-16 19:10:18'),
(183, '0177', 'Barta Electronics', '447 3rd floorTwin tower', 'Dhaka South', NULL, '1728264658', '2020-09-16 19:10:19', '2020-09-16 19:10:19'),
(184, '0178', 'JSP Smart Zone', 'S:F/36,37 jame mosjid Shoping complex,Sador Munshigonj.', 'Dhaka South', NULL, '1912688448', '2020-09-16 19:10:19', '2020-09-16 19:10:19'),
(185, '0179', 'M-Telecom', 'Aftab Plaza,Sultanabad,Rajshahi-6100', 'Rajshahi', NULL, '1716809040', '2020-09-16 19:10:19', '2020-09-16 19:10:19'),
(186, '0180', 'Tamim Telecom-Narsingdi', 'Baricha, Raipura Road, Belabo', 'Dhaka Outer', NULL, '1782310000', '2020-09-16 19:10:19', '2020-09-16 19:10:19'),
(187, '0181', 'R telecommunication', 'L-3,Rajlaxmi Complex,Uttara', 'Dhaka North', NULL, '1612450440', '2020-09-16 19:10:19', '2020-09-16 19:10:19'),
(188, '0182', 'Picaboo(JFP)', 'Shop No 4A,-026C,JFP', 'Dhaka North', NULL, '1711704601', '2020-09-16 19:10:19', '2020-09-16 19:10:19'),
(189, '0183', 'Moto Hub-2', 'Shop-661,Level-6,Tokyo Square Market,Mohammadpur,Dhaka', 'Dhaka South', NULL, '1709651157', '2020-09-16 19:10:19', '2020-09-16 19:10:19'),
(190, '0184', 'Ujala Point', 'Ujala Mansion,Race Course,Comilla', 'Chittagong', NULL, '1715828456', '2020-09-16 19:10:19', '2020-09-16 19:10:19'),
(191, '0185', 'G&G(Rupayan Golden Age)', 'Rupayan Golden Age, Gulshan 1, Dhaka', 'Dhaka North', NULL, '1716254067', '2020-09-16 19:10:19', '2020-09-16 19:10:19'),
(192, '0186', 'Hallo Barisal 5', 'HemayetUddyanRoad,Girzamoholla,Barisal', 'Khulna', NULL, '1713460612', '2020-09-16 19:10:19', '2020-09-16 19:10:19'),
(193, '0187', 'test store', 'rainkhola, section-2, mirpur', 'Dhaka', 'Dakshinkhan', '01798786889', '2020-09-21 08:52:26', '2020-09-21 08:52:26'),
(194, '0188', 'test store2', 'asasa', 'Pirojpur', NULL, '01798786889', '2020-10-01 20:21:04', '2020-10-01 20:21:04'),
(195, '0189', 'call center', 'asasa', 'Bandarban', NULL, '01798786889', '2020-10-05 15:56:48', '2020-10-05 15:56:48');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'create-users', 'Create Users', 'Create Users', '2020-03-19 05:50:52', '2020-03-19 05:50:52'),
(2, 'read-users', 'Read Users', 'Read Users', '2020-03-19 05:50:52', '2020-03-19 05:50:52'),
(3, 'update-users', 'Update Users', 'Update Users', '2020-03-19 05:50:53', '2020-03-19 05:50:53'),
(4, 'delete-users', 'Delete Users', 'Delete Users', '2020-03-19 05:50:53', '2020-03-19 05:50:53'),
(5, 'create-profile', 'Create Profile', 'Create Profile', '2020-03-19 05:50:53', '2020-03-19 05:50:53'),
(6, 'read-profile', 'Read Profile', 'Read Profile', '2020-03-19 05:50:53', '2020-03-19 05:50:53'),
(7, 'update-profile', 'Update Profile', 'Update Profile', '2020-03-19 05:50:53', '2020-03-19 05:50:53'),
(8, 'delete-profile', 'Delete Profile', 'Delete Profile', '2020-03-19 05:50:53', '2020-03-19 05:50:53'),
(9, 'create-report', 'Create Report', 'Create Report', '2020-03-19 05:50:53', '2020-03-19 05:50:53'),
(10, 'read-report', 'Read Report', 'Read Report', '2020-03-19 05:50:53', '2020-03-19 05:50:53'),
(11, 'update-report', 'Update Report', 'Update Report', '2020-03-19 05:50:53', '2020-03-19 05:50:53'),
(12, 'delete-report', 'Delete Report', 'Delete Report', '2020-03-19 05:50:53', '2020-03-19 05:50:53'),
(13, 'create-store', 'Create Store', 'Create Store', '2020-03-19 05:50:53', '2020-03-19 05:50:53'),
(14, 'read-store', 'Read Store', 'Read Store', '2020-03-19 05:50:53', '2020-03-19 05:50:53'),
(15, 'update-store', 'Update Store', 'Update Store', '2020-03-19 05:50:54', '2020-03-19 05:50:54'),
(16, 'delete-store', 'Delete Store', 'Delete Store', '2020-03-19 05:50:54', '2020-03-19 05:50:54'),
(17, 'create-file', 'Create File', 'Create File', '2020-03-19 05:50:54', '2020-03-19 05:50:54'),
(18, 'read-file', 'Read File', 'Read File', '2020-03-19 05:50:54', '2020-03-19 05:50:54'),
(19, 'update-file', 'Update File', 'Update File', '2020-03-19 05:50:54', '2020-03-19 05:50:54'),
(20, 'delete-file', 'Delete File', 'Delete File', '2020-03-19 05:50:54', '2020-03-19 05:50:54'),
(21, 'create-sales', 'Create Sales', 'Create Sales', '2020-03-19 05:50:54', '2020-03-19 05:50:54'),
(22, 'read-sales', 'Read Sales', 'Read Sales', '2020-03-19 05:50:54', '2020-03-19 05:50:54'),
(23, 'update-sales', 'Update Sales', 'Update Sales', '2020-03-19 05:50:54', '2020-03-19 05:50:54'),
(24, 'delete-sales', 'Delete Sales', 'Delete Sales', '2020-03-19 05:50:54', '2020-03-19 05:50:54'),
(25, 'read-service', 'Read Service', 'Read Service', '2020-03-19 05:50:56', '2020-03-19 05:50:56'),
(26, 'update-service', 'Update Service', 'Update Service', '2020-03-19 05:50:56', '2020-03-19 05:50:56');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(10, 2),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(21, 3),
(22, 1),
(22, 3),
(23, 1),
(23, 3),
(24, 1),
(24, 3),
(25, 4),
(26, 4);

-- --------------------------------------------------------

--
-- Table structure for table `permission_user`
--

CREATE TABLE `permission_user` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_user`
--

INSERT INTO `permission_user` (`permission_id`, `user_id`, `user_type`) VALUES
(5, 5, 'App\\User'),
(6, 5, 'App\\User'),
(7, 5, 'App\\User');

-- --------------------------------------------------------

--
-- Table structure for table `phone_models`
--

CREATE TABLE `phone_models` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `model_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mrp` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `phone_models`
--

INSERT INTO `phone_models` (`id`, `model_name`, `mrp`, `status`, `added_by`, `created_at`, `updated_at`) VALUES
(3, 'Media Pad T3 7(1GB)', '390', 1, 19, '2020-09-30 22:38:05', '2020-09-30 22:39:56'),
(4, 'Y5 2019', '570', 1, 19, '2020-09-30 22:38:23', '2020-09-30 22:39:35'),
(5, 'Media Pad T3 7 (2GB)', '570', 1, 19, '2020-09-30 22:39:15', '2020-09-30 22:39:15'),
(6, 'Y6 Pro 2019', '570', 1, 19, '2020-09-30 22:40:15', '2020-09-30 22:40:15'),
(7, 'Y7 Pro 2019', '570', 1, 19, '2020-09-30 22:41:20', '2020-09-30 22:41:20'),
(8, 'Y6 S', '570', 1, 19, '2020-09-30 22:41:40', '2020-09-30 22:41:40'),
(9, 'Y7 2019', '740', 1, 19, '2020-09-30 22:42:02', '2020-09-30 22:42:02'),
(10, 'Y7 P', '740', 1, 19, '2020-09-30 22:42:25', '2020-09-30 22:42:25'),
(11, 'Media Pad T3 10', '740', 1, 19, '2020-09-30 22:42:42', '2020-09-30 22:42:42'),
(12, 'Nova 3i', '740', 1, 19, '2020-09-30 22:43:21', '2020-09-30 22:43:21'),
(13, 'Y9 2019', '740', 1, 19, '2020-09-30 22:43:38', '2020-09-30 22:43:38'),
(14, 'Y Max', '995', 1, 19, '2020-09-30 22:43:59', '2020-09-30 22:43:59'),
(15, 'Y9 Prime 2019', '995', 1, 19, '2020-09-30 22:44:15', '2020-09-30 22:44:15'),
(16, 'Y8 p', '995', 1, 19, '2020-09-30 22:44:31', '2020-09-30 22:44:31'),
(17, 'P30 Lite', '995', 1, 19, '2020-09-30 22:44:47', '2020-09-30 22:44:47'),
(18, 'Nova 7i', '995', 1, 19, '2020-09-30 22:45:10', '2020-09-30 22:45:10'),
(19, 'Y9 S', '995', 1, 19, '2020-09-30 22:45:30', '2020-09-30 22:45:30'),
(20, 'Nova 5T', '1630', 1, 19, '2020-09-30 22:45:59', '2020-09-30 22:45:59'),
(21, 'P30', '2920', 1, 19, '2020-09-30 22:46:23', '2020-09-30 22:46:23'),
(22, 'P30 Pro', '3920', 1, 19, '2020-09-30 22:46:53', '2020-09-30 22:46:53'),
(23, 'Mate 30 Pro', '2920', 1, 19, '2020-09-30 22:47:11', '2020-09-30 22:47:11'),
(24, 'P 40 Pro', '5180', 1, 19, '2020-09-30 22:47:36', '2020-09-30 22:47:36');

-- --------------------------------------------------------

--
-- Table structure for table `receive_delivery_histories`
--

CREATE TABLE `receive_delivery_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` int(11) NOT NULL,
  `imei` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `receive_delivery_histories`
--

INSERT INTO `receive_delivery_histories` (`id`, `store_id`, `imei`, `status`, `created_at`, `updated_at`) VALUES
(17, 194, '012345678900000', 2, '2020-10-06 13:41:48', '2020-10-06 13:41:48'),
(18, 194, '012345678900000', 3, '2020-10-06 13:44:01', '2020-10-06 13:44:01'),
(20, 194, '123456897845621', 2, '2020-10-06 13:58:36', '2020-10-06 13:58:36'),
(21, 194, '123456897845621', 3, '2020-10-06 15:58:56', '2020-10-06 15:58:56');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'supadmin', 'CPP Admin', 'Supadmin', '2020-03-19 05:50:52', '2020-04-16 02:45:48'),
(2, 'admin', 'Business Partner(1000Fix Head Office)', 'Admin', '2020-03-19 05:50:55', '2020-03-19 05:50:55'),
(3, 'salescenter', 'Sales Center', 'Salescenter', '2020-03-19 05:50:56', '2020-03-19 05:50:56'),
(4, 'servicepoint', 'Service Center', 'Servicepoint', '2020-03-19 05:50:56', '2020-03-19 05:50:56'),
(7, 'insurance', 'Insurance Company', 'Insurance Company', '2020-04-16 02:36:07', '2020-04-16 02:40:46'),
(8, 'callcenter', 'Call Centre', 'Call Centre', '2020-09-20 13:01:44', '2020-09-20 13:05:28');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`role_id`, `user_id`, `user_type`) VALUES
(1, 1, 'App\\User'),
(2, 2, 'App\\User'),
(3, 3, 'App\\User'),
(4, 4, 'App\\User'),
(3, 15, 'App\\User'),
(3, 16, 'App\\User'),
(4, 17, 'App\\User'),
(4, 18, 'App\\User'),
(1, 19, 'App\\User'),
(1, 20, 'App\\User'),
(7, 21, 'App\\User'),
(2, 22, 'App\\User'),
(4, 24, 'App\\User'),
(4, 25, 'App\\User'),
(4, 26, 'App\\User'),
(4, 27, 'App\\User'),
(4, 28, 'App\\User'),
(4, 29, 'App\\User'),
(4, 30, 'App\\User'),
(4, 31, 'App\\User'),
(4, 32, 'App\\User'),
(4, 33, 'App\\User'),
(4, 34, 'App\\User'),
(4, 35, 'App\\User'),
(4, 36, 'App\\User'),
(4, 37, 'App\\User'),
(4, 38, 'App\\User'),
(4, 39, 'App\\User'),
(4, 40, 'App\\User'),
(3, 41, 'App\\User'),
(3, 42, 'App\\User'),
(3, 43, 'App\\User'),
(3, 44, 'App\\User'),
(3, 45, 'App\\User'),
(3, 48, 'App\\User'),
(3, 49, 'App\\User'),
(3, 51, 'App\\User'),
(3, 53, 'App\\User'),
(3, 54, 'App\\User'),
(3, 55, 'App\\User'),
(3, 57, 'App\\User'),
(3, 58, 'App\\User'),
(3, 60, 'App\\User'),
(3, 61, 'App\\User'),
(3, 62, 'App\\User'),
(3, 63, 'App\\User'),
(3, 65, 'App\\User'),
(3, 66, 'App\\User'),
(3, 67, 'App\\User'),
(3, 68, 'App\\User'),
(3, 70, 'App\\User'),
(3, 73, 'App\\User'),
(3, 75, 'App\\User'),
(3, 76, 'App\\User'),
(3, 77, 'App\\User'),
(3, 79, 'App\\User'),
(3, 81, 'App\\User'),
(3, 82, 'App\\User'),
(3, 83, 'App\\User'),
(3, 85, 'App\\User'),
(3, 86, 'App\\User'),
(3, 87, 'App\\User'),
(3, 88, 'App\\User'),
(3, 89, 'App\\User'),
(3, 90, 'App\\User'),
(3, 92, 'App\\User'),
(3, 94, 'App\\User'),
(3, 95, 'App\\User'),
(3, 96, 'App\\User'),
(3, 98, 'App\\User'),
(3, 100, 'App\\User'),
(3, 101, 'App\\User'),
(3, 102, 'App\\User'),
(3, 103, 'App\\User'),
(3, 104, 'App\\User'),
(3, 107, 'App\\User'),
(3, 108, 'App\\User'),
(3, 109, 'App\\User'),
(3, 111, 'App\\User'),
(3, 112, 'App\\User'),
(3, 113, 'App\\User'),
(3, 114, 'App\\User'),
(3, 115, 'App\\User'),
(3, 116, 'App\\User'),
(3, 117, 'App\\User'),
(3, 118, 'App\\User'),
(3, 120, 'App\\User'),
(3, 121, 'App\\User'),
(3, 123, 'App\\User'),
(3, 124, 'App\\User'),
(3, 125, 'App\\User'),
(3, 127, 'App\\User'),
(3, 129, 'App\\User'),
(3, 130, 'App\\User'),
(3, 131, 'App\\User'),
(3, 132, 'App\\User'),
(3, 134, 'App\\User'),
(3, 135, 'App\\User'),
(3, 136, 'App\\User'),
(3, 137, 'App\\User'),
(3, 138, 'App\\User'),
(3, 139, 'App\\User'),
(3, 140, 'App\\User'),
(3, 141, 'App\\User'),
(3, 142, 'App\\User'),
(3, 143, 'App\\User'),
(3, 148, 'App\\User'),
(3, 149, 'App\\User'),
(3, 150, 'App\\User'),
(3, 151, 'App\\User'),
(3, 152, 'App\\User'),
(3, 153, 'App\\User'),
(3, 154, 'App\\User'),
(3, 155, 'App\\User'),
(3, 156, 'App\\User'),
(3, 157, 'App\\User'),
(3, 158, 'App\\User'),
(3, 159, 'App\\User'),
(3, 160, 'App\\User'),
(3, 161, 'App\\User'),
(3, 162, 'App\\User'),
(3, 163, 'App\\User'),
(3, 164, 'App\\User'),
(3, 165, 'App\\User'),
(3, 166, 'App\\User'),
(3, 167, 'App\\User'),
(3, 168, 'App\\User'),
(3, 169, 'App\\User'),
(3, 170, 'App\\User'),
(3, 171, 'App\\User'),
(3, 172, 'App\\User'),
(3, 173, 'App\\User'),
(3, 174, 'App\\User'),
(3, 175, 'App\\User'),
(3, 176, 'App\\User'),
(3, 177, 'App\\User'),
(3, 178, 'App\\User'),
(3, 179, 'App\\User'),
(3, 180, 'App\\User'),
(3, 181, 'App\\User'),
(3, 182, 'App\\User'),
(3, 183, 'App\\User'),
(3, 184, 'App\\User'),
(3, 185, 'App\\User'),
(3, 186, 'App\\User'),
(3, 187, 'App\\User'),
(3, 188, 'App\\User'),
(3, 189, 'App\\User'),
(3, 190, 'App\\User'),
(3, 191, 'App\\User'),
(3, 192, 'App\\User'),
(3, 193, 'App\\User'),
(3, 194, 'App\\User'),
(3, 195, 'App\\User'),
(3, 196, 'App\\User'),
(3, 197, 'App\\User'),
(3, 198, 'App\\User'),
(3, 199, 'App\\User'),
(3, 200, 'App\\User'),
(3, 201, 'App\\User'),
(3, 202, 'App\\User'),
(3, 203, 'App\\User'),
(3, 204, 'App\\User'),
(3, 205, 'App\\User'),
(3, 206, 'App\\User'),
(3, 207, 'App\\User'),
(8, 208, 'App\\User'),
(4, 209, 'App\\User'),
(8, 210, 'App\\User');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(10) UNSIGNED NOT NULL,
  `store_id` int(11) NOT NULL,
  `service_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imei` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emergency_contact` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fs_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fs_mrp` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `device_purchase_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_verified` tinyint(4) DEFAULT NULL,
  `verified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `store_id`, `service_type`, `imei`, `brand`, `model`, `price`, `title`, `gender`, `customer_name`, `date_of_birth`, `mobile`, `emergency_contact`, `email`, `district`, `address`, `fs_code`, `fs_mrp`, `device_purchase_date`, `is_verified`, `verified_by`, `created_at`, `updated_at`) VALUES
(1, 16, 'Don’t Worry Screen Protection', '123456789123456', 'HUAWEI', 'Y Max', '25999', 'MR', 'M', 'Yiu', NULL, '01712258383', NULL, NULL, 'Dhaka', 'Bhawal Point Center (3rd Floor), Shop: 23-25, Gazipur Chowrasta, Gazipur Sadar Upazila, Dhaka.', '51621T420829', '995', NULL, 1, 15, '2020-10-04 23:06:39', '2020-10-04 23:06:39'),
(2, 16, 'Don’t Worry Screen Protection', '123456789123457', 'HUAWEI', 'Y7 Pro 2019', '79999', 'MR', 'M', 'Ka', NULL, '01712258383', NULL, NULL, 'Dhaka', 'Bhawal Point Center (3rd Floor), Shop: 23-25, Gazipur Chowrasta, Gazipur Sadar Upazila, Dhaka.', '6031T730206', '570', NULL, 1, 15, '2020-10-04 23:38:31', '2020-10-04 23:38:31'),
(3, 16, 'Don’t Worry Screen Protection', '123456789987654', 'HUAWEI', 'Y9 2019', '50000', 'MR', 'M', 'utuj', NULL, '01712258383', NULL, NULL, 'Dhaka', 'Bhawal Point Center (3rd Floor), Shop: 23-25, Gazipur Chowrasta, Gazipur Sadar Upazila, Dhaka.', '37212T524464', '740', '09/29/2020', 1, 15, '2020-10-04 23:40:42', '2020-10-04 23:40:42'),
(4, 193, 'Don’t Worry Screen Protection', '012345678900000', 'HUAWEI', 'Media Pad T3 7(1GB)', '5000', 'MR', 'M', 'S. M. Olive Hasan', NULL, '01798786889', NULL, 'olivehasan99@gmail.com', 'Dhaka', 'rainkhola, section-2, mirpur', '15393T160722', '390', NULL, 1, 207, '2020-10-05 14:18:29', '2020-10-05 14:18:29'),
(5, 193, 'Don’t Worry Screen Protection', '123456897845621', 'HUAWEI', 'Media Pad T3 7 (2GB)', '5000', 'MR', 'M', 'S. M. Olive Hasan', NULL, '01798786889', NULL, 'olivehasan99@gmail.com', 'Dhaka', 'rainkhola, section-2, mirpur', '17032T117920', '570', NULL, 1, 207, '2020-10-05 14:23:47', '2020-10-05 14:23:47'),
(6, 16, 'Don’t Worry Screen Protection', '636265696864615', 'HUAWEI', 'Y9 S', '49999', 'MR', 'M', 'mAHMUD', NULL, '01712258383', NULL, NULL, 'Dhaka', 'Bhawal Point Center (3rd Floor), Shop: 23-25, Gazipur Chowrasta, Gazipur Sadar Upazila, Dhaka.', '15695T533054', '995', '09/28/2020', 1, 15, '2020-10-05 14:25:38', '2020-10-05 14:25:38'),
(7, 16, 'Don’t Worry Screen Protection', '747574757475747', 'HUAWEI', 'Media Pad T3 10', '49998', 'MR', 'M', 'Test', NULL, '01712258383', NULL, NULL, 'Dhaka', 'Bhawal Point Center (3rd Floor), Shop: 23-25, Gazipur Chowrasta, Gazipur Sadar Upazila, Dhaka.', '61045T512633', '740', '10/02/2020', 1, 15, '2020-10-05 20:08:14', '2020-10-05 20:08:14'),
(8, 16, 'Don’t Worry Screen Protection', '171150545544554', 'HUAWEI', 'Y7 Pro 2019', '19000', 'MR', 'M', 'M Islam', NULL, '01711505455', NULL, NULL, 'Dhaka', 'Bhawal Point Center (3rd Floor), Shop: 23-25, Gazipur Chowrasta, Gazipur Sadar Upazila, Dhaka.', '60678T311520', '570', NULL, 1, 15, '2020-10-05 20:17:34', '2020-10-05 20:17:34'),
(9, 16, 'Don’t Worry Screen Protection', '123456789000025', 'HUAWEI', 'Y5 2019', '5000', 'MR', 'M', 'j', '01/10/2020', '01798786889', '01934804551', 'olivehasan99@gmail.com', 'Dhaka', 'Bhawal Point Center (3rd Floor), Shop: 23-25, Gazipur Chowrasta, Gazipur Sadar Upazila, Dhaka.', '62137T128368', '570', '07/27/2020', 1, 15, '2020-10-05 23:27:47', '2020-10-05 23:27:47'),
(10, 16, 'Don’t Worry Screen Protection', '258369147852456', 'HUAWEI', 'Nova 7i', '50000', 'MR', 'M', 'Ok', NULL, '01712258383', NULL, NULL, 'Dhaka', 'Bhawal Point Center (3rd Floor), Shop: 23-25, Gazipur Chowrasta, Gazipur Sadar Upazila, Dhaka.', '60319T55647', '995', '10/04/2020', 1, 15, '2020-10-06 00:34:56', '2020-10-06 00:34:56'),
(11, 193, 'Don’t Worry Screen Protection', '454545002145456', 'HUAWEI', 'Media Pad T3 7(1GB)', '5000', 'MR', 'M', 'S. M. Olive Hasan', NULL, '01798786889', NULL, 'olivehasan99@gmail.com', 'Dhaka', 'rainkhola, section-2, mirpur', '49784T15734', '390', NULL, 1, 207, '2020-10-06 17:27:37', '2020-10-06 17:27:37'),
(12, 193, 'Don’t Worry Screen Protection', '787871202478745', 'HUAWEI', 'Media Pad T3 7(1GB)', '49999', 'MR', 'M', 'a', NULL, '01798786889', NULL, NULL, 'Dhaka', 'rainkhola, section-2, mirpur', '13638T533474', '390', NULL, 1, 207, '2020-10-06 17:31:02', '2020-10-06 17:31:02');

-- --------------------------------------------------------

--
-- Table structure for table `service_histories`
--

CREATE TABLE `service_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` int(11) NOT NULL,
  `imei` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fs_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchase_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) UNSIGNED NOT NULL,
  `delivery_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_histories`
--

INSERT INTO `service_histories` (`id`, `store_id`, `imei`, `model`, `price`, `fs_code`, `purchase_date`, `status`, `delivery_date`, `created_at`, `updated_at`) VALUES
(12, 194, '012345678900000', 'Media Pad T3 7(1GB)', '5000', '15393T160722', '2020-10-05 20:18:29', 3, '2020-10-06 13:44:01', '2020-10-06 13:41:48', '2020-10-06 13:44:01'),
(14, 194, '123456897845621', 'Media Pad T3 7 (2GB)', '5000', '17032T117920', '2020-10-05 20:23:47', 3, '2020-10-06 15:58:56', '2020-10-06 13:58:36', '2020-10-06 15:58:56');

-- --------------------------------------------------------

--
-- Table structure for table `temp_files`
--

CREATE TABLE `temp_files` (
  `file_id` bigint(20) UNSIGNED NOT NULL,
  `sales_id` int(11) NOT NULL,
  `imei` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_for` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `upload_by` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `file_location` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tiers`
--

CREATE TABLE `tiers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tier` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_range_start` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_range_end` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tiers`
--

INSERT INTO `tiers` (`id`, `tier`, `price_range_start`, `price_range_end`, `status`, `added_by`, `created_at`, `updated_at`) VALUES
(5, 'T1', '5000', '10000', 1, 19, '2020-09-30 22:27:32', '2020-09-30 22:27:32'),
(6, 'T2', '10001', '15000', 1, 19, '2020-09-30 22:27:54', '2020-09-30 22:27:54'),
(7, 'T3', '15001', '20000', 1, 19, '2020-09-30 22:28:20', '2020-09-30 22:28:20'),
(8, 'T4', '20001', '30000', 1, 19, '2020-09-30 22:28:51', '2020-09-30 22:28:51'),
(9, 'T5', '30001', '50000', 1, 19, '2020-09-30 22:29:43', '2020-09-30 22:29:43'),
(10, 'T6', '50001', '75000', 1, 19, '2020-09-30 22:30:03', '2020-09-30 22:30:03'),
(11, 'T7', '75001', '100000', 1, 19, '2020-09-30 22:30:22', '2020-09-30 22:30:22'),
(12, 'T8', '100001', '150000', 1, 19, '2020-09-30 22:31:35', '2020-09-30 22:31:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `store_id` int(11) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `store_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Supadmin', 'cpp_supadmin', 'supadmin@cpp.com', NULL, '$2y$10$TyPN9bnMozm9easfn.9U4ejmEsqFVcTuWqxqtHMfut5L3vq3iDrbG', NULL, NULL, '2020-03-19 09:50:55', '2020-07-03 12:48:46'),
(2, 'Admin', 'cpp_admin', 'admin@cpp.com', NULL, '$2y$10$QL275kwT8aHhkacBievCduUVNy7rFITL3DAiUHcUcJenlowt6Xy0.', NULL, NULL, '2020-03-19 09:50:56', '2020-03-19 09:50:56'),
(3, 'Salescenter', 'cpp_salescenter', 'salescenter@cpp.com', NULL, '$2y$10$cuhVN.7jaOh8oqzTm/VHBe.nTiZB38vN9g5mmC021JL8KgHq9ENyS', NULL, NULL, '2020-03-19 09:50:56', '2020-03-19 09:50:56'),
(4, 'Servicepoint', 'cpp_servicepoint', 'servicepoint@cpp.com', NULL, '$2y$10$Sbul7o5f8AVGYHVQykZKUOyt5Jv6Ll0jQ9Zp2b.eL3GmWPWxHhuo6', NULL, NULL, '2020-03-19 09:50:57', '2020-06-15 07:48:05'),
(5, 'Cru User', 'cpp_cru_user', 'cru_user@cpp.com', NULL, '$2y$10$GMrayh5olm7elR04.cqCO.5GZLuiPqWTxh0Piy/bhtyVO56KF33IC', NULL, '53JBuzqGdB', '2020-03-19 09:50:57', '2020-03-19 09:50:57'),
(15, 'Anik Telecom', 'ehsan', NULL, NULL, '$2y$10$qezfV7MQuDqSL.4ApfJEWOsL7hvXS2uXfMkN2kaJXi1630rA9.Jsi', 16, NULL, '2020-05-24 03:44:59', '2020-09-01 08:44:58'),
(16, 'Shahnoor Ahmed Khan', 'Shahnoor', NULL, NULL, '$2y$10$MMFf3CT7giioATb4nsrRk.Senly0rIz4rN8iaAwghCKQ1Wjc5/wPu', NULL, NULL, '2020-05-24 03:45:45', '2020-05-24 03:45:45'),
(17, 'Nazmul Hasan', 'nazmul', NULL, NULL, '$2y$10$3wVAnr.x2Js.s3zt0My7oe8HhhMI42DBmy47lUkzN992UWL47H5SO', NULL, NULL, '2020-05-24 03:46:35', '2020-09-14 05:05:52'),
(18, 'Shah Jalal Uddin', 'jalal', NULL, NULL, '$2y$10$EsagWIL6cQuv8YQHkp1eJ.9O8SdqB6TmRXubxMvwrwA2dboDO8n3K', NULL, NULL, '2020-05-24 03:51:33', '2020-05-24 03:51:33'),
(19, 'Masum Ahmed', 'masum', 'masum.ahmed@cppbd.com', NULL, '$2y$10$snWnr7ZVybqs700vIEg6o.3nr4MVqaUzyNlC3KsxbUQuWiRV6wbTa', NULL, NULL, '2020-05-24 03:53:27', '2020-05-24 03:53:27'),
(20, 'kazi Tanvir Mahmud', 'kazi.tanvir', 'kazi.tanvir@cppbd.com', NULL, '$2y$10$x8ut/KhMUVA0kayW7N5CROwDHNJdPZxkzVleZDOz8xya7kc9Isrsy', NULL, NULL, '2020-05-24 03:54:47', '2020-05-24 03:54:47'),
(21, 'Tahsin Jahan', 'tahsin', 'tahsin@reliance.com.bd', NULL, '$2y$10$tdUg5Sne1oLtEhn5.LMRk.buS9HvNn3l7rJW.8javVBESlhUUKKUi', NULL, NULL, '2020-05-24 04:49:26', '2020-05-24 04:49:26'),
(22, 'amith', 'amith', 'amith@smart-bd.com', NULL, '$2y$10$cQoO6HrmBJaK.v842FVj7emRi091AC.ajv1kOq5AxLEJT7NEfG8vm', NULL, NULL, '2020-05-24 06:05:43', '2020-05-24 06:05:43'),
(24, 'ASC_BCT', 'HWASCBCT', NULL, NULL, '$2y$10$HnzBFoLa.i8jQ1oOvbynU.HsQkz250RNcBDNzpydpp3d1TtcE6cRW', 11, NULL, '2020-06-30 15:35:03', '2020-06-30 15:35:03'),
(25, 'ASC_BOG', 'HWASCBOG', NULL, NULL, '$2y$10$R2kBlOVBWZwSsGMBuBqSquSiwuzBQDtEqpQ02MiY4TLTyZU0n0PDm', 12, NULL, '2020-06-30 15:38:42', '2020-06-30 15:38:42'),
(26, 'ASC_BSL', 'HWASCBSL', NULL, NULL, '$2y$10$CY.k1tdkWLe4B/immseCBeF2NEGbNxOKdE3Ur/9QZV9f.HFABfEe.', 13, NULL, '2020-06-30 15:39:15', '2020-06-30 15:39:15'),
(27, 'ASC_COM', 'HWASCCOM', NULL, NULL, '$2y$10$57byrln9DCVZJgo2zJ4tpOIRJ2Mt7uycaLTz2KaYEAFMGgEBGR3Ai', 14, NULL, '2020-06-30 15:39:44', '2020-06-30 15:39:44'),
(28, 'ASC_CTG', 'HWASCCTG', NULL, NULL, '$2y$10$FQ1cbSnxfGzXke8NhBhAaenV7RWBIkSTxAdLHvtYicybAT9uKnrwK', 15, NULL, '2020-06-30 15:40:18', '2020-06-30 15:40:18'),
(29, 'ASC_GAZ', 'HWASCGAZ', NULL, NULL, '$2y$10$15VynZNTeG2othUngur88uhT3fN5TdaTeePQlXxvTyh6K01vQMX.G', 16, NULL, '2020-06-30 15:40:47', '2020-06-30 15:40:47'),
(30, 'ASC_KHL', 'HWASCKHL', NULL, NULL, '$2y$10$cOasgu/VRz7YF54gcwr59u0CUl1GtGzK6a2rsq9v0BHVsOYkHDsme', 17, NULL, '2020-06-30 15:41:18', '2020-06-30 15:41:18'),
(31, 'ASC_MOT', 'HWASCMOT', NULL, NULL, '$2y$10$rv5hc4WYg2eH2GJp95qL7epPxo9jjHWBlay2jFWxasfmwqUu.olby', 18, NULL, '2020-06-30 15:41:49', '2020-06-30 15:41:49'),
(32, 'ASC_MPR', 'HWASCMPR', NULL, NULL, '$2y$10$4tKgXyrmSITJcdvuETq1SeBzqkbYHzMVH3pPC/2SPaR4uDxfikQGW', 19, NULL, '2020-06-30 15:42:21', '2020-06-30 15:42:21'),
(33, 'ASC_MYM', 'HWASCMYM', NULL, NULL, '$2y$10$jWC9ezPGz9kMlphbLWhhwuBYzNY9V7w2srOaC15jOhgMej86aEdPq', 20, NULL, '2020-06-30 15:42:50', '2020-06-30 15:42:50'),
(34, 'ASC_NRG', 'HWASCNRG', NULL, NULL, '$2y$10$Cgc8eYu2TYzSjTEjMrwhuuCSOeIkKk3Bal6Y2Tu5TWR0vA4IPPeDy', 21, NULL, '2020-06-30 15:43:24', '2020-06-30 15:43:24'),
(35, 'ASC_RAJ', 'HWASCRAJ', NULL, NULL, '$2y$10$OScSn42szTCa/MraYhYgi.o6N81Nt5naDLZ1e85z6tC4nmNoUisVW', 22, NULL, '2020-06-30 15:44:07', '2020-06-30 15:44:07'),
(36, 'ASC_RGN', 'HWASCRGN', NULL, NULL, '$2y$10$YoMsUUrvUiTL6sIANeIVguJ9FHMYekJXD3Qf2yr73YkiBkDzStTQO', 23, NULL, '2020-06-30 15:44:44', '2020-06-30 15:44:44'),
(37, 'ASC_SVR', 'HWASCSVR', NULL, NULL, '$2y$10$u51TXyScm9tq5IAq2bmU5uRwQUAKylfvwRArxK2K.IyfPauW/6SMe', 24, NULL, '2020-06-30 15:45:18', '2020-06-30 15:45:18'),
(38, 'ASC_SYL', 'HWASCSYL', NULL, NULL, '$2y$10$2K6ll3mvMl3ibq/C6CwzoOmNbjbt1RH.NB9WLQ6/o90GsiXwxHQg2', 25, NULL, '2020-06-30 15:45:51', '2020-06-30 15:45:51'),
(39, 'ASC_TNG', 'HWASCTNG', NULL, NULL, '$2y$10$cphB76CcNk8ksX7PUnwO2.qbKIo3B2al0qRTmFAGTn9m80nZZxgPe', 26, NULL, '2020-06-30 15:46:27', '2020-06-30 15:46:27'),
(40, 'ASC_UTT', 'HWASCUTT', NULL, NULL, '$2y$10$qkkUjFsPXv9.1DRUCKGB8uYKIgIRGannPDtMjhl7Z0Jx.d27AhBF6', 27, NULL, '2020-06-30 15:46:59', '2020-06-30 15:46:59'),
(41, 'Mobile Network (2)', 'SBGDSDH04231', NULL, NULL, '$2y$10$W9ch0SWJmgaIA7QzSHKQbejUYNx3KExR6bkOim7QKj3b8BErKgui.', 28, NULL, '2020-06-30 15:48:06', '2020-06-30 15:48:06'),
(42, 'Tech Park', 'SBGDSDH01636', NULL, NULL, '$2y$10$ZNHcB4NtfQCZBPRLXqJduOmqjcrFS0fiYM4rkJVXJMYp47QJENbxK', 29, NULL, '2020-06-30 15:48:44', '2020-06-30 15:48:44'),
(43, 'Touch World- Dhaka City-N', 'SBGDSDH01523', NULL, NULL, '$2y$10$jfJJtpcVW/VnE9CM9eeBHub89u/P3iplIG5XCxUk3jbLsGxQIwVyq', 30, NULL, '2020-06-30 15:49:24', '2020-06-30 15:49:24'),
(44, 'SM Telecom-Dhaka City-N', 'SBGDSDH00080', NULL, NULL, '$2y$10$M6H19CanoR8JHJlC1p57RuO0ZfL.vYNe7/rqTCVWy3M4Xd6bj/og6', 31, NULL, '2020-06-30 15:49:59', '2020-06-30 15:49:59'),
(45, 'M/S MA Traders', 'SBGDSDH03504', NULL, NULL, '$2y$10$spdXfbIx.Gzhqx6/ANT6/upf1jw3puE8rXGkANSs6yZSQTh.9lnja', 32, NULL, '2020-06-30 15:50:57', '2020-06-30 15:50:57'),
(48, 'NR International', 'SBGDSDH02246', NULL, NULL, '$2y$10$6aPnXCwM54rqvVPdLbCO1.McYIAweTibOTEeSsYqkbzKG8XQtrQAe', 35, NULL, '2020-06-30 15:55:08', '2020-06-30 15:55:08'),
(49, 'Haroun Telecom-2', 'SBGDSDH00647', NULL, NULL, '$2y$10$59REGdmJKXb6qWn0RRk9xuhXUum1chSPM8rVdxma.RWB7DuLwMK5W', 36, NULL, '2020-06-30 15:55:57', '2020-06-30 15:55:57'),
(51, 'B.M.A Electronics-Dhaka City-N', 'SBGDSDH00308', NULL, NULL, '$2y$10$kCTr7YM343LFWuuCRTMpLOAWPWF7K63mILaSam8FX1YGPEok4Ousq', 38, NULL, '2020-06-30 15:58:39', '2020-06-30 15:58:39'),
(53, 'Mollah Telecom (1)', 'SBGDSDH00240', NULL, NULL, '$2y$10$ylFg4Z7F8wjXDDM9o/s9l.SzuJj8J2jazHUTgL9gdCu0.voS9jQUW', 40, NULL, '2020-06-30 16:00:05', '2020-06-30 16:00:05'),
(54, 'Z.H Telecom', 'SBGDSDH00191', NULL, NULL, '$2y$10$KecwRNGUxc.dhawTFnnGA.8gRq.6sMDjs6dJo7EaSnorfJW6Br8Sm', 41, NULL, '2020-06-30 16:01:12', '2020-06-30 16:01:12'),
(55, 'M2M Communication-Dhaka City-N', 'SBGDSDH00169', NULL, NULL, '$2y$10$.2kJMloa7wTvCF1vABLmqeKAFzTtKS112daYv7ZFzpnS.xf.ukaCy', 42, NULL, '2020-06-30 16:02:00', '2020-06-30 16:02:00'),
(57, 'KK Electronics', 'SBGDSDH01628', NULL, NULL, '$2y$10$mMdD.BbTw4Ovx7cUGgaN.uEJcMUFVFSfF1.VF2vFMLPMdn6/Z55UW', 44, NULL, '2020-06-30 16:03:38', '2020-06-30 16:03:38'),
(58, 'Huawei Experience Store (Eerna-Savar)', 'CNSBD051273', NULL, NULL, '$2y$10$SUiQ13wtSFT.ofod0NhBauxubpB86ze7TP72WYkRfy/z42DrJAcTq', 45, NULL, '2020-06-30 16:04:13', '2020-06-30 16:04:13'),
(60, 'Araf Telecom-Dhaka City-N', 'SBGDSDH00264', NULL, NULL, '$2y$10$tIkBNAN2zt6uRabuqfCg0.ugyZb/RyQiuG4hom74Tuu/.YkKXoFS2', 47, NULL, '2020-06-30 16:05:51', '2020-06-30 16:05:51'),
(61, 'SR Telecom', 'SGSBD061266', NULL, NULL, '$2y$10$.O6vStw3oNKXWKVIFlDoKeDnIZ.r.oBJOUsYoRqG5vmHZW7DHv9FO', 48, NULL, '2020-06-30 16:06:37', '2020-06-30 16:06:37'),
(62, 'M.Com Services', 'SBGDSDH01319', NULL, NULL, '$2y$10$eGdHNoO8.Wg9WB5eAc57A.bZSRl5.E676SlxciTAa6JU26G.oJK6K', 49, NULL, '2020-06-30 16:08:08', '2020-06-30 16:08:08'),
(63, 'Aporupa Telecom', 'SBGDSSY01204', NULL, NULL, '$2y$10$JkjfrH6C7/6p23bJZfwLKu./28.YUp3h4sAdXwXyuRMSY7zFaZIOO', 50, NULL, '2020-06-30 16:09:39', '2020-06-30 16:09:39'),
(65, 'Mishad Smartphone Gallery', 'SBGDSSY00829', NULL, NULL, '$2y$10$yIrBfgSiNKVfIMYGP7eeZuPaoqIw/2a.c5lUJsOCrTn3rpsrXzz/2', 52, NULL, '2020-06-30 16:11:48', '2020-06-30 16:11:48'),
(66, 'Creative zone.', 'SBGDSSY00345', NULL, NULL, '$2y$10$h13TuYSR1jkW1jHqO7LE4./Y1Exofc2B87di0amfY4C5oWpA7BXRa', 53, NULL, '2020-06-30 16:12:39', '2020-06-30 16:12:39'),
(67, 'Cell one mobile', 'SBGDSSY00337', NULL, NULL, '$2y$10$bJVlHvS.jhdumwqat002RuK4nDZae5t24WLTA5ta6l.y3LrACWwFC', 54, NULL, '2020-06-30 16:13:28', '2020-06-30 16:13:28'),
(68, 'HES(Al Amin Mobile)', 'SBGDSSY00333', NULL, NULL, '$2y$10$PFzGpJffnVR839JA6RQlHeJ9aPw2VYva4M.140YUZASbnQ5DdBLXm', 55, NULL, '2020-06-30 16:19:10', '2020-06-30 16:19:10'),
(70, 'S, World Telecom', 'SBGDSSY00043', NULL, NULL, '$2y$10$/X33MyT8x5oPJLS5.wgx7OnICgzq2A584KDqyVVbB.CfD0DnVR1s2', 57, NULL, '2020-06-30 16:21:42', '2020-06-30 16:21:42'),
(73, 'HN Telecom 2', 'SBGDSDH04132', NULL, NULL, '$2y$10$JA8ItuLCOEE0Li3UenNoM.JhlI0rluVINtb4WS5ep537nrkEsT.tG', 60, NULL, '2020-06-30 16:23:19', '2020-06-30 16:23:19'),
(75, 'Dip Telecom', 'SBGDSDH01313', NULL, NULL, '$2y$10$fFR3KqNUBrDR3bXh8ewpAuWw9Ws2r1jGcnZZ0BMoeDRH31HkdA0m6', 62, NULL, '2020-06-30 16:24:51', '2020-06-30 16:24:51'),
(76, 'HS telecom (1)', 'SBGDSDH01045', NULL, NULL, '$2y$10$3xGZFvgsjYk86DaHIZ6ks.NVO1mXk4OXy5BWtalrK/dA.v8BFuvCi', 63, NULL, '2020-06-30 16:43:12', '2020-06-30 16:43:12'),
(77, 'Rajon Mobile', 'SBGDSDH00772', NULL, NULL, '$2y$10$C0q6lKTLvGUpz8PSlssXGuVJl44Yt9Q9jPBfbrg78xkXN9hCwJ5Z6', 64, NULL, '2020-06-30 16:44:06', '2020-06-30 16:44:06'),
(79, 'Comilla Telecom', 'SBGDSDH00473', NULL, NULL, '$2y$10$q4.GZeKlwjXDnGmwEwC0g.1B8diuubFt737cSa7LzXliKfb9C/FHm', 66, NULL, '2020-06-30 16:45:14', '2020-06-30 16:45:14'),
(81, 'Maria telecom (4)', 'SBGDSDH00209', NULL, NULL, '$2y$10$FXX9b7FDDP8Xwqo03X7sEO2D2PCgcaRBxkNxqRnDPs27eVJj2ElTS', 68, NULL, '2020-06-30 16:46:11', '2020-06-30 16:46:11'),
(82, 'Sohi Distribution', 'CNSBD024295', NULL, NULL, '$2y$10$1RtZFWQM3NVJ2Mv5hVAUMOsEc9pjAWtTsTk/i0BWgj2kUPeAcB0T6', 69, NULL, '2020-06-30 16:46:47', '2020-06-30 16:46:47'),
(83, 'Habib Telecom (4)', 'SBGDSSY00017', NULL, NULL, '$2y$10$hOSyHl2kEr30.uNFJld71OcUgp2CtWE2hjnZ.jFW.KF2rbdGOWHn2', 70, NULL, '2020-06-30 16:47:19', '2020-06-30 16:47:19'),
(85, 'Mobile Bazar (11)', 'SBGDSDH00197', NULL, NULL, '$2y$10$nvGFKgcN1lGadNQNXI0OJeNmAmrGH6w2fYFpbT3oqidOxQh2S.62e', 72, NULL, '2020-06-30 16:48:15', '2020-06-30 16:48:15'),
(86, 'Huawei Experience store-Mobilelink International', 'SBGDSDH04244', NULL, NULL, '$2y$10$2IWRpmGyNFuK5EBi.0uac.Yu3FAZs1qDBDGw.4Octw91x5fr3luEm', 73, NULL, '2020-06-30 16:48:44', '2020-06-30 16:48:44'),
(87, 'Huawei Experience store-Eerna-3', 'SGSBD036606', NULL, NULL, '$2y$10$TW42yr2sTWcoGNFcmoobbecTVaUkbRiFTpPGul0r.5nHJsuWL.pIa', 74, NULL, '2020-06-30 16:49:10', '2020-06-30 16:49:10'),
(88, 'Huawei Experience storeArchos-Dhaka City-S', 'SBGDSDH00124', NULL, NULL, '$2y$10$5Ro.FqwGPRTkxLaH/.FFZevGEzWEV5L0VB5Pbj6ecZEMZOZsPLiKq', 75, NULL, '2020-06-30 16:49:39', '2020-06-30 16:49:39'),
(89, 'Huawei Experience store-Sahat Electronics', 'SBGDSDH00015', NULL, NULL, '$2y$10$9CY5oP4aoaL1l45ZnObFSObz2/s/owk0k/pePqHx/b.40HumzcDMW', 76, NULL, '2020-06-30 16:50:07', '2020-06-30 16:50:07'),
(90, 'Huawei Experience store-Irani telecom', 'SBGDSDH01358', NULL, NULL, '$2y$10$Tee.WX9fdqYj7bY7PR82cu.q2oO7rOsXJ1mFrOzzOHixxALZ9drKi', 77, NULL, '2020-06-30 16:50:40', '2020-06-30 16:50:40'),
(92, 'New Mobile Hut', 'SBGDSSY00897', NULL, NULL, '$2y$10$ZXqFrhFpaHwzS7r0S2VUaO3GoBlO6sNfIb3eMZ9p1Dfw5Zt3KBcIS', 79, NULL, '2020-06-30 16:51:33', '2020-06-30 16:51:33'),
(94, 'SB telecom', 'SBGDSDH00435', NULL, NULL, '$2y$10$k46isNjIVrNQhw0hkirvKOaTUa4nURvLnzo1pSlnC0xc5Wm8fmuIq', 81, NULL, '2020-06-30 16:52:48', '2020-06-30 16:52:48'),
(95, 'Ideal cellular', 'SBGDSDH02269', NULL, NULL, '$2y$10$.FnvboxIz63WXJwc2u0h2.5Qlq5KIQyKOasHtQ0kXqx0Vzxj.Jlga', 82, NULL, '2020-06-30 16:53:35', '2020-06-30 16:53:35'),
(96, 'Ahnaf Electronics', 'SBGDSDH00049', NULL, NULL, '$2y$10$A2iLBevznDi9DiSDpN49w.GZai/o9mi7Cz3ZYtIVEyJ.NqcRzcSHK', 83, NULL, '2020-06-30 16:54:17', '2020-06-30 16:54:17'),
(98, 'Friend Verse', 'SBGDSDH02602', NULL, NULL, '$2y$10$0/W5iuQ1AtRA1npEn6Iw0.PxxnBfi2qrD1lCopReylZWMEh1BRRqq', 85, NULL, '2020-06-30 16:55:38', '2020-06-30 16:55:38'),
(100, 'Bismillah Mobile House', 'SBGDSDH01710', NULL, NULL, '$2y$10$Du9JVKdsPEXsK1LuT1OwZufiWORJqXiQ1roUCZKPhzm4.lGH/Ht52', 87, NULL, '2020-06-30 16:56:44', '2020-06-30 16:56:44'),
(101, 'Huawei Experience Store(Mohammadpur)', 'SBGDSDH00041', NULL, NULL, '$2y$10$Eh9F/LcmHmexBWPQ9.SGaeo9BQCIi9iGv4ypk1h2.4y9J.AnkpMxu', 88, NULL, '2020-06-30 16:57:23', '2020-06-30 16:57:23'),
(102, 'Huawei Experience Store DS Gallery (SMART 2ND)', 'SBGDSKH01202', NULL, NULL, '$2y$10$C/BIU1SCQChNxsqc1z6KceYYgtzKezmN/V9j924evuGECG45GjUcS', 89, NULL, '2020-06-30 16:58:00', '2020-06-30 16:58:00'),
(103, 'The Mobile Store', 'SGSBD007527', NULL, NULL, '$2y$10$4OdhGFNYSmQ0etUrmL2Ffez/p8tW1eaL2NsGUwsO3nkhS3mOnNocK', 90, NULL, '2020-06-30 16:58:31', '2020-06-30 16:58:31'),
(104, 'Modern Communication', 'SBGDSKH00936', NULL, NULL, '$2y$10$2zmf6asO3wordlENXZ6VhOrqLDygRcJE3.cx3Yv05eu4vZOa54PN6', 91, NULL, '2020-06-30 16:59:08', '2020-06-30 16:59:08'),
(107, 'HES- Easy Touch', 'SBGDSKH00879', NULL, NULL, '$2y$10$Rw3DzUDhXlopyVUD08egqebHDPGAMVDwYV2XCN.x9LsJOeqrRtCBC', 94, NULL, '2020-06-30 17:00:42', '2020-06-30 17:00:42'),
(108, 'HES- Noor Smart Zone', 'SBGDSKH00029', NULL, NULL, '$2y$10$m1S738w3RmafZ0Wf27.XF.tVnhp2sWId56LUrHlvZRsMbCPeaY7lu', 95, NULL, '2020-06-30 17:01:18', '2020-06-30 17:01:18'),
(109, 'HES- Hello Barishal 6', 'SBGDSKH01190', NULL, NULL, '$2y$10$M/zwHDh3K6tdAyF2HyAA7uhfkoA3QfSwUVFHtUJoNj5U0/c2J1GuS', 96, NULL, '2020-06-30 17:01:47', '2020-06-30 17:01:47'),
(111, 'Munshi Telecom', 'SBGDSKH00925', NULL, NULL, '$2y$10$Mc8cD9kcdHWnJog.iUAsXuODOJMR6XSzFMR7Pg4O/1H4gyC5qM..m', 98, NULL, '2020-06-30 17:02:53', '2020-06-30 17:02:53'),
(112, 'Kazi Electronics', 'SBGDSKH00854', NULL, NULL, '$2y$10$1TKqR50lrVyqwGh3DzLP/uJUGHr.yiSUNvDznRTNJApI4H0qng7yu', 99, NULL, '2020-06-30 17:03:34', '2020-06-30 17:03:34'),
(113, 'H.K Telecom', 'SBGDSCT00016', NULL, NULL, '$2y$10$wrOBcy1hmMAvtHn53uHiWutTf3rWQqCYKvuqiMUwZShmHA6bBImCC', 100, NULL, '2020-06-30 17:04:03', '2020-06-30 17:04:03'),
(114, 'Music Mantra', 'SGSBD033424', NULL, NULL, '$2y$10$RuQ7t5QEWJTjUJ4BoRXpiOtCsMTVTw6IRuajJGsGp0eYjLQNhu5SO', 101, NULL, '2020-06-30 17:04:28', '2020-06-30 17:04:28'),
(115, 'Ahad Telecom- Chittagong Metro', 'SBGDSCT00001', NULL, NULL, '$2y$10$hUqYC172WbChfCKRwZDh0u7H1K3RZZATxVvUo9l3tyephLAK7ulrm', 102, NULL, '2020-06-30 17:04:56', '2020-06-30 17:04:56'),
(116, 'HUAWEI EXPERIENCE SHOP(Banskhali)', 'SBGDSCT00461', NULL, NULL, '$2y$10$EztO34MKiI.N85Vtx8fhoOwJe.iRKc0vP3rW.mHpwo00/lGDM1ZCi', 103, NULL, '2020-06-30 17:05:31', '2020-06-30 17:05:31'),
(117, 'Bengal Telecom', 'SBGDSCT00293', NULL, NULL, '$2y$10$tJ/gc1yzvPqURsnLEuEl4.bTerxPuctdNdhZJVvXN3Z32WetnRfG.', 104, NULL, '2020-06-30 17:05:58', '2020-06-30 17:05:58'),
(118, 'Rony Enterprise', 'SBGDSCT00012', NULL, NULL, '$2y$10$doybRyxlkyL6kCzSHje.H.pSa.Cn2YzJAHW8YQcax8B14R2IfUwTS', 105, NULL, '2020-06-30 17:06:29', '2020-06-30 17:06:29'),
(120, 'R H Rashed Telecom', 'SBGDSCT00582', NULL, NULL, '$2y$10$iOl3oH3gmn9woMfQMKbCeuN45jnLnXZ0FP8NkyGyZ0lfTsDLkww5S', 107, NULL, '2020-06-30 17:07:17', '2020-06-30 17:07:17'),
(121, 'Baj International', 'SBGDSCT00089', NULL, NULL, '$2y$10$q6AJhKRSYDqcDK1ITHuiKutcw1t.kiXDZRBnoJfM20IoyjQ2TacNS', 108, NULL, '2020-06-30 17:07:41', '2020-06-30 17:07:41'),
(123, 'Mobile Link-(3)', 'SBGDSCT00427', NULL, NULL, '$2y$10$DGTl4QmArX8agtEU7wGt2.Vh6/3svifOLRBdGSP.VtjTiS6l1ozE2', 110, NULL, '2020-06-30 17:08:44', '2020-06-30 17:08:44'),
(124, 'Abedin Brand Shop', 'SBGDSCT00096', NULL, NULL, '$2y$10$2xMlWMVD8ljfhcMljRamsul1p4rOHUjjRK3ViYQwTGBWvWbuoyR6C', 111, NULL, '2020-06-30 17:09:12', '2020-06-30 17:09:12'),
(125, 'Sheba Brand Shop', 'SBGDSCT00098', NULL, NULL, '$2y$10$pC8bROJMZzHGP8HW2Ew6FujNhtqJlTg5LBb7DfvYh/Bhjs2/nw8fy', 112, NULL, '2020-06-30 17:09:37', '2020-06-30 17:09:37'),
(127, 'Ovi Telecom', 'SBGDSCT00460', NULL, NULL, '$2y$10$RYbsRTTby291GBzBWZxZnOK.x7a/YMIG.IkzT4OYs0SsRquFqWOl.', 114, NULL, '2020-06-30 17:10:29', '2020-06-30 17:10:29'),
(129, 'World Connection', 'SBGDSCT00490', NULL, NULL, '$2y$10$scPGS9/Va8mHaWYeBz4/quf/woWdbxhOZllKs9/WY3FxjB6eAlRuW', 116, NULL, '2020-06-30 17:11:22', '2020-06-30 17:11:22'),
(130, 'M. K Electronics', 'SBGDSCT00421', NULL, NULL, '$2y$10$i66gxUPU7UIxmX7rGwwMReYdLRsXqElDvklygYd97K0oBH8gF86qS', 117, NULL, '2020-06-30 17:11:53', '2020-06-30 17:11:53'),
(131, 'Nur Smart Shop-Comilla', 'SBGDSCT01066', NULL, NULL, '$2y$10$W2xDU9TKgTP3N69aQbmsEOxgAuMc2goRZOhcFmsLMozbxpbAo5vsa', 118, NULL, '2020-06-30 17:12:16', '2020-06-30 17:12:16'),
(132, 'Modina Plaza', 'SBGDSCT00498', NULL, NULL, '$2y$10$7o.nnqgx2Dy7q1UicKJAE.RFA73AdrMv/S/kXG/L964HzPeIxXhaq', 119, NULL, '2020-06-30 17:12:42', '2020-06-30 17:12:42'),
(134, 'Cell Finder', 'SBGDSCT00095', NULL, NULL, '$2y$10$YQKOUVhtj4hD3sQMXzgwwO2pGV6Q777I7YzP9ycogQ9isvUaDS90e', 121, NULL, '2020-06-30 17:13:38', '2020-06-30 17:13:38'),
(135, 'Idea Smart cafe plus(HES).', 'SBGDSRA01161', NULL, NULL, '$2y$10$O5gfdIXyRnnsqKun5yZJ0.CDX527MENzlQz3fW2mTrlvD0eOvYQ92', 122, NULL, '2020-06-30 17:14:11', '2020-06-30 17:14:11'),
(136, 'Taseen Telecom', 'SBGDSRA00867', NULL, NULL, '$2y$10$Yb3XQseyaSgFPq44rXV1xO/8Hih0ch2Be5xu6n95Gav5sFc02WFES', 123, NULL, '2020-06-30 17:14:38', '2020-06-30 17:14:38'),
(137, 'NB TEL', 'SBGDSRA00846', NULL, NULL, '$2y$10$JZTmOfFFp1shynsdvWaboeaj03iPirOWbtWoWA3ONP7MI7S2eymem', 124, NULL, '2020-06-30 17:15:01', '2020-06-30 17:15:01'),
(138, 'M/S Tuser Enterprise(HES)', 'SBGDSRA00836', NULL, NULL, '$2y$10$wInr6AkKAwaDS.eKipFi/.29CfJ.FSN4D.cZ/mpuLv2uTQIQUF.gW', 125, NULL, '2020-06-30 17:15:28', '2020-06-30 17:15:28'),
(139, 'Z.H Telecom', 'SBGDSRA00776', NULL, NULL, '$2y$10$CrYFs91qHfGCIE7SC6KwEeJfZjNWz6QUpyW8hD2SXsHpg8EH9fqKW', 126, NULL, '2020-06-30 17:16:00', '2020-06-30 17:16:00'),
(140, 'Wave Telecom', 'SBGDSRA00758', NULL, NULL, '$2y$10$XjMIm0rT8qHGNXljD8FTg.1ZB1aaPlM4ZwRTaQnf73ONHLEwPng7u', 127, NULL, '2020-06-30 17:16:27', '2020-06-30 17:16:27'),
(141, 'GABS Trade Linker', 'SBGDSRA00685', NULL, NULL, '$2y$10$K8qC7LUCm2HIws/XvpsAou4xkOTORWrxGu0vl2aaa9awjExfIA2dS', 128, NULL, '2020-06-30 17:16:55', '2020-06-30 17:16:55'),
(142, 'Anan\'s', 'SBGDSRA00652', NULL, NULL, '$2y$10$yJc9VJ6sWYjb2KcwP2/uMOZpu/y6MK2SN9WUI4vrpjM2zvYFkaVUi', 129, NULL, '2020-06-30 17:17:24', '2020-06-30 17:17:24'),
(143, 'Top Enterpries (HES ).', 'SBGDSRA00649', NULL, NULL, '$2y$10$KGO.02uea2RC/TUtGotqu.hCNYOL5Lw4Z/dQdGF26KEwPEZciz7cC', 130, NULL, '2020-06-30 17:17:47', '2020-06-30 17:17:47'),
(148, 'Gadget Narayanganj', 'SGSBD067159', NULL, NULL, '$2y$10$Nrw5GFvB54fHEGzCKXo8U.oaG0zsS4ZWHR.P0cGnhs5okYWrP5dma', 134, NULL, '2020-09-16 19:10:13', '2020-09-16 19:10:13'),
(149, 'EERNA-8', 'SGSBD065034', NULL, NULL, '$2y$10$vlbaHcF7XQNsKeJos5UtK.eeSDMU018Yi/dsRwM8xC7V3hDG.Op8K', 135, NULL, '2020-09-16 19:10:13', '2020-09-16 19:10:13'),
(150, 'Bushra phone', 'SGSBD067649', NULL, NULL, '$2y$10$gRMOtJF2pkO.H/VV..65lehL9OArVdZm7eB/x6CetylzZr7/cs.Au', 136, NULL, '2020-09-16 19:10:13', '2020-09-16 19:10:13'),
(151, 'Aamar Shop.bd', 'SGSBD066694', NULL, NULL, '$2y$10$xSZPwtB6VIhya9IcuqTyEeJWYw1gDDdb9Ks28yLGyTw9eELZIp6h.', 137, NULL, '2020-09-16 19:10:13', '2020-09-16 19:10:13'),
(152, 'Eerna 5(JFP)', 'SGSBD034578', NULL, NULL, '$2y$10$7FC8l3nySBkrkM8hslX8SubyeTvzHBWUPq0Bz8XtWzW5ONrplSINm', 138, NULL, '2020-09-16 19:10:14', '2020-09-16 19:10:14'),
(153, 'G&G (JFP)', 'SBGDSDH00780', NULL, NULL, '$2y$10$hKfkuahVDY.2N2I1.yxQauzir7utOtWjAbUdC9bAj/iXYscxs/cwO', 139, NULL, '2020-09-16 19:10:14', '2020-09-16 19:10:14'),
(154, 'Huawei Mobile Galary', 'CNSBD024297', NULL, NULL, '$2y$10$P3uDj9Acg5r4CadmtG/gzeFuUeFcOrdA/2889S1Q8LwQpOB4xCbwC', 140, NULL, '2020-09-16 19:10:14', '2020-09-16 19:10:14'),
(155, 'Pickabo(BCT)', 'SBGDSDH00128', NULL, NULL, '$2y$10$ci.mElWepxbeIFYL6y8.X.jtDY/HkCQqdBJS0uXnA4VWPJBvvxlca', 141, NULL, '2020-09-16 19:10:14', '2020-09-16 19:10:14'),
(156, 'Mi Zone', 'SBGDSKH01514', NULL, NULL, '$2y$10$uc4ohi45PwAr9GgX1u5PEu4qPh18aR7X8YjTBsb7VQXv16JZUT0TO', 142, NULL, '2020-09-16 19:10:14', '2020-09-16 19:10:14'),
(157, 'AK Mobile Corner', 'SBGDSKH00488', NULL, NULL, '$2y$10$lMeZ5F3sIAj0BuvZuzPH/ekwtnXpI.ujvkPdazjsaEOLHLpgxGTS2', 143, NULL, '2020-09-16 19:10:14', '2020-09-16 19:10:14'),
(158, 'Huawei Experience Store (MHT Telecom)', 'SBGDSKH00563', NULL, NULL, '$2y$10$7LP10c/tcdbgZyvFO0VW.uaRRNiyfALj/69OxojJ9ze1wrwNSmLTW', 144, NULL, '2020-09-16 19:10:14', '2020-09-16 19:10:14'),
(159, 'Ahsan Telecom (1)', 'SBGDSSY00115', NULL, NULL, '$2y$10$U2K84MNsjyMRinoA4ZRYNuekJOK5D9ogulKWsktJqFdFPAHllrtta', 145, NULL, '2020-09-16 19:10:14', '2020-09-16 19:10:14'),
(160, 'Mobile Hut(Narayangonj)', 'SBGDSSY00346', NULL, NULL, '$2y$10$DOzn7Hblx3vg4N4GVbUUtOuA5rHif0l.Lg08MFk4G/u1qpWhG1KpC', 146, NULL, '2020-09-16 19:10:14', '2020-09-16 19:10:14'),
(161, 'Idea smart cafe', 'SBGDSRA00646', NULL, NULL, '$2y$10$iQ1ReFcl9oHUaTCoh2uMg.HnVdchL6V9nokf5Q7ILDjBtLPfJyI8G', 147, NULL, '2020-09-16 19:10:14', '2020-09-16 19:10:14'),
(162, 'Tasin Mobile Shop', 'SBGDSSY00796', NULL, NULL, '$2y$10$86N.GEe1d2i2.woygkpTjOYgUAUXDvHk/.NFG.qR4iTp5W2LpUo6q', 148, NULL, '2020-09-16 19:10:15', '2020-09-16 19:10:15'),
(163, 'Mobile Fair-Dhaka City-N', 'SBGDSDH00219', NULL, NULL, '$2y$10$hF12cvpfmqfOCliWbaA38uPLZ03ajMJ.aX3URHGeD9M5Qb9rGUUb6', 149, NULL, '2020-09-16 19:10:15', '2020-09-16 19:10:15'),
(164, 'Hello Barisal 4', 'SBGDSKH00003', NULL, NULL, '$2y$10$cpKHo4UoSwWtXQBpnsQi3.ItWqCWvOsqF5QK9wLQm7KMQaAXfd3O6', 150, NULL, '2020-09-16 19:10:15', '2020-09-16 19:10:15'),
(165, 'SS Enterprise - Magura', 'SBGDSKH00756', NULL, NULL, '$2y$10$NymHUdNngLtbrGuFv/M01eb3f2j3E5Y8Ir0ZSe9yxo2mGeq4Ztypu', 151, NULL, '2020-09-16 19:10:15', '2020-09-16 19:10:15'),
(166, 'Bismillah Telecom (25)', 'SBGDSCT00272', NULL, NULL, '$2y$10$BbUDDtW71vGOyuA6syBizOPAfc23zoW4avyeBxVbopTiPRCV2.tKy', 152, NULL, '2020-09-16 19:10:15', '2020-09-16 19:10:15'),
(167, 'Mobile world (8)', 'SBGDSDH02384', NULL, NULL, '$2y$10$b4C2ArnP.BeeFPK4tw9GKO3yPmF9A.dtvstoxjGfhWPiT3pWg/SNe', 153, NULL, '2020-09-16 19:10:15', '2020-09-16 19:10:15'),
(168, 'Mobile Life', 'SBGDSRA00008', NULL, NULL, '$2y$10$xaR4PC6gHBjvpJE29OFAFORTY8SWMGHPArWmusin56evixb313zry', 154, NULL, '2020-09-16 19:10:15', '2020-09-16 19:10:15'),
(169, 'Moubon Cell Bazar (1)', 'SBGDSKH00118', NULL, NULL, '$2y$10$9R/TXdBw9Cw0jsJUWIzg0eaSCyzR18aQ1Ys3IQHQvZzptiGF/18/q', 155, NULL, '2020-09-16 19:10:15', '2020-09-16 19:10:15'),
(170, 'Jonone telecom-Dhaka City-S', 'SBGDSDH00009', NULL, NULL, '$2y$10$60E2DKh3Chxh9mtOhQTgS.OiBp5QqpW6RnuCGy7Hw7Z7LmiavgmwO', 156, NULL, '2020-09-16 19:10:15', '2020-09-16 19:10:15'),
(171, 'G&G-2', 'SBGDSDH00126', NULL, NULL, '$2y$10$w71xkL8EOn0.nimVBCm/auMI1TxT0Hq8aRvOpfsaF8zuh2EUzsWh6', 157, NULL, '2020-09-16 19:10:16', '2020-09-16 19:10:16'),
(172, 'Nihal Brand Shop', 'SBGDSCT00477', NULL, NULL, '$2y$10$LFxNmOeX/prxdT1vtrplbeLhmE15xdQSUCOLDRfZcial6w4VaiyHi', 158, NULL, '2020-09-16 19:10:16', '2020-09-16 19:10:16'),
(173, 'Mobile Hat.', 'SBGDSKH01355', NULL, NULL, '$2y$10$9olh5Hmr3j9U4DCEiWJAcOoomxqpqRFDVGsUE36mLdXXg8lcLumwa', 159, NULL, '2020-09-16 19:10:16', '2020-09-16 19:10:16'),
(174, 'Best Plus', 'SBGDSDH00315', NULL, NULL, '$2y$10$qgD38einDvSOXBeX0LdUFOYRLLm9jEjqhiJqBgqyn2kSYhSCkSZF.', 160, NULL, '2020-09-16 19:10:16', '2020-09-16 19:10:16'),
(175, 'Sky Tel (1)', 'SBGDSRA00657', NULL, NULL, '$2y$10$DZ1twZzXL694GHvYhYKa/esQh/D46FtxDkpKF9GllT.I8pdYEBe4G', 161, NULL, '2020-09-16 19:10:16', '2020-09-16 19:10:16'),
(176, 'Mobile Zone (7)', 'SBGDSSY00373', NULL, NULL, '$2y$10$v61X3ouo63Zaf.IUteqKgOwoaqqQ5g1TyluHYE2Ja/n122/4ABk6.', 162, NULL, '2020-09-16 19:10:16', '2020-09-16 19:10:16'),
(177, 'Mobile Hut (1)', 'SBGDSRA00012', NULL, NULL, '$2y$10$J0pwQqiHAgnaU1vM5n4wIuB6uIzGiVGg4Y.HsVTCVUrWjH.gCIhhW', 163, NULL, '2020-09-16 19:10:16', '2020-09-16 19:10:16'),
(178, 'TML', 'SBGDSDH04279', NULL, NULL, '$2y$10$s8eeYrormv7TkegahlfeeOj4H.yLh2B5.CBzi6xXWRlvJRJ6wZt/S', 164, NULL, '2020-09-16 19:10:17', '2020-09-16 19:10:17'),
(179, 'Nazma Electric & Mobile Corner', 'SBGDSKH00008', NULL, NULL, '$2y$10$LdNUznMfRBIxIq4VnzcfsuWC1kXqIts0xhFuupHEJpTHMRWH40E1m', 165, NULL, '2020-09-16 19:10:17', '2020-09-16 19:10:17'),
(180, 'Gunjan Telecom (1)', 'SBGDSRA00020', NULL, NULL, '$2y$10$9cjbsuo/Ps4tdTTiWviaGetOIfnJL/PpZ84FpNbFbTl/NAUbBPicu', 166, NULL, '2020-09-16 19:10:17', '2020-09-16 19:10:17'),
(181, 'Mobile World (13)', 'SBGDSRA00524', NULL, NULL, '$2y$10$nn2PRuaBIEjQ461dqDCBDOmARRmLMiknDF6sMuKJ5Zdpsazqr5ttq', 167, NULL, '2020-09-16 19:10:17', '2020-09-16 19:10:17'),
(182, 'Mobitel telecom', 'SBGDSCT00344', NULL, NULL, '$2y$10$YsxUQSul9ShUTvfZtMrUWucOtgFEZ8qIZEDa2YGGl5hyuRe9dn6VG', 168, NULL, '2020-09-16 19:10:17', '2020-09-16 19:10:17'),
(183, 'S.M.Nokia', 'SBGDSDH00732', NULL, NULL, '$2y$10$3Meq44G/mO5kzXgeNFu/m.JZvQObO2pPdVSOzDfrf/3/iF2dIQlWe', 169, NULL, '2020-09-16 19:10:17', '2020-09-16 19:10:17'),
(184, 'Jamines Telecom', 'SBGDSKH00025', NULL, NULL, '$2y$10$L8Y4kUt.h5iRstWJeToWEeW3eHybd2cbFoK39sAig5IIfGvN8bB9e', 170, NULL, '2020-09-16 19:10:17', '2020-09-16 19:10:17'),
(185, 'Mobile Palace (1)', 'SBGDSDH01107', NULL, NULL, '$2y$10$ideDa4kCRW0CRwCQ98c37OCSNR3htzIgIKkDoaOTATLL5MYeV13n6', 171, NULL, '2020-09-16 19:10:17', '2020-09-16 19:10:17'),
(186, 'Khanika Smart Gallery', 'SBGDSKH00001', NULL, NULL, '$2y$10$idOLoaS7QyN2mioR7elg4ORHVwISQqOpRef6Uszhruk9FfFG733ES', 172, NULL, '2020-09-16 19:10:17', '2020-09-16 19:10:17'),
(187, 'Prince Traders- Chittagong Metro', 'SBGDSCT00232', NULL, NULL, '$2y$10$F93GXFLQkIgjMvrAMlD4MO.QJW4sqnD4ScVhd7ZeD4MIDtFp78JLW', 173, NULL, '2020-09-16 19:10:17', '2020-09-16 19:10:17'),
(188, 'G&G 13', 'SBGDSDH04191', NULL, NULL, '$2y$10$y4FN5awRZxr3EqPLtX./auBKQORuO0fKxe1CY2zUodhbQH4Cg2mra', 174, NULL, '2020-09-16 19:10:18', '2020-09-16 19:10:18'),
(189, 'Nexus- Chittagong Metro', 'SBGDSCT00402', NULL, NULL, '$2y$10$/HHUcnY5h4T5RRR8X14vN.s.DLs58gFphGn2nGM2xAo/n.LtnXB6S', 175, NULL, '2020-09-16 19:10:18', '2020-09-16 19:10:18'),
(190, 'G&G(Motizheel)', 'SBGDSDH01487', NULL, NULL, '$2y$10$sQzPi/Y4gHq.5vd4mA0y2eFelrv0CkeULK8zJTR6h8.BuWF.QdACu', 176, NULL, '2020-09-16 19:10:18', '2020-09-16 19:10:18'),
(191, 'One Telecom.', 'SBGDSRA00016', NULL, NULL, '$2y$10$aE7VdqETsTZRXWrQDhqf/.m7TlkvHu/z8TN.gvEBqgOQG9optcsA.', 177, NULL, '2020-09-16 19:10:18', '2020-09-16 19:10:18'),
(192, 'Zara Telecom-Dhaka City-N', 'SBGDSDH01929', NULL, NULL, '$2y$10$ZsJ8LI7NMhC0hs3l10.of.VCEhWoZfSCouAPkr/DUGydfs1BNvJJq', 178, NULL, '2020-09-16 19:10:18', '2020-09-16 19:10:18'),
(193, 'Mobile Mela 2 (3)', 'SBGDSCT00050', NULL, NULL, '$2y$10$v4Ru2UaY3ctNf.9cdRKLLOncbhOZ0WmbApvCzsivItq3QFlazQvRy', 179, NULL, '2020-09-16 19:10:18', '2020-09-16 19:10:18'),
(194, 'Voice Tel', 'SBGDSKH00323', NULL, NULL, '$2y$10$9MFgRI0r9rI.sGxgQqSbCOkKOSD7XqseIwpONaU0XjWuwmVPIgE5O', 180, NULL, '2020-09-16 19:10:18', '2020-09-16 19:10:18'),
(195, 'Shah Yeamin Enterprise', 'SBGDSKH01472', NULL, NULL, '$2y$10$Vu8/Zs4EeE.FzOo3Q.VlvOTb7LSmXP4Sht6zuJTmQey4px17uEgfm', 181, NULL, '2020-09-16 19:10:18', '2020-09-16 19:10:18'),
(196, 'G & G(North Tower)', 'SBGDSDH00418', NULL, NULL, '$2y$10$6McZFR7j3CNJvpco8ecz6O2nnI8bna.SH58dEDt/SEIdM6mZazTum', 182, NULL, '2020-09-16 19:10:19', '2020-09-16 19:10:19'),
(197, 'Barta Electronics', 'SBGDSDH00055', NULL, NULL, '$2y$10$8McwCdhIhzqH4W/0I.pT9O0C0kDDAlf0Y2.jemFlgOHjTCqP/w6x.', 183, NULL, '2020-09-16 19:10:19', '2020-09-16 19:10:19'),
(198, 'JSP Smart Zone', 'SBGDSSY00354', NULL, NULL, '$2y$10$dFNAl2V/iCZ/l4Mqb.RTxOcyCluShYdqoQwYZUQrdydPJZ1IRqWF2', 184, NULL, '2020-09-16 19:10:19', '2020-09-16 19:10:19'),
(199, 'M-Telecom', 'SBGDSRA00027', NULL, NULL, '$2y$10$KeeRQ0kE9CGXkbgki1.fveUF2vaffgG9PVYv5dCQiiN8PQ19VVS5W', 185, NULL, '2020-09-16 19:10:19', '2020-09-16 19:10:19'),
(200, 'Tamim Telecom-Narsingdi', 'SBGDSSY00893', NULL, NULL, '$2y$10$VLHaONr9fN.ZvofuLA2Y6ezLxssQzVeoLQhyq3WYSKSNzJJiq2gQK', 186, NULL, '2020-09-16 19:10:19', '2020-09-16 19:10:19'),
(201, 'R telecommunication', 'SBGDSDH00477', NULL, NULL, '$2y$10$JZWGeU3DsvTrZINBrysUluG8UdDdMC9LTgRXifmC2/avqpKkKVBI6', 187, NULL, '2020-09-16 19:10:19', '2020-09-16 19:10:19'),
(202, 'Picaboo(JFP)', 'SGSBD054835', NULL, NULL, '$2y$10$ODMr4xuCYQxzm1CdVVQpvO1T1O1Ag2WybtTGvZCyg5kVLDedpEBSq', 188, NULL, '2020-09-16 19:10:19', '2020-09-16 19:10:19'),
(203, 'Moto Hub-2', 'CNSBD051272', NULL, NULL, '$2y$10$LVcBUb13vakDoykYX2NJ0O8JjszEbf.95SsEfTP5uiKpQk3GyESsm', 189, NULL, '2020-09-16 19:10:19', '2020-09-16 19:10:19'),
(204, 'Ujala Point', 'SGSBD035435', NULL, NULL, '$2y$10$AJ/O4Sy66wJ88XKy1WMxoeFMAU0wAYziOe9ZeQNWWP3X6k/laRjw.', 190, NULL, '2020-09-16 19:10:19', '2020-09-16 19:10:19'),
(205, 'G&G(Rupayan Golden Age)', 'SBGDSDH00192', NULL, NULL, '$2y$10$k41gHRfULXuLJstsjSQSc.dL7HCCj1D8rGbiQq1vOrIHo4MYBE8tG', 191, NULL, '2020-09-16 19:10:19', '2020-09-16 19:10:19'),
(206, 'Hallo Barisal 5', 'SBGDSKH00547', NULL, NULL, '$2y$10$QUpT9uR2NNmxv6Ocx7nviOGHKwhwgbuGHtVtiD9c8Kr4D83fUu95a', 192, NULL, '2020-09-16 19:10:19', '2020-09-16 19:10:19'),
(207, 'Test', 'sales', NULL, NULL, '$2y$10$LHsFT62QvwR1w.0r.miL6.awmC9JKMeCwJbddzfM/Dk7ypvQgvPmy', 193, NULL, '2020-09-21 08:53:04', '2020-09-21 08:57:27'),
(208, 'Hasan', 'Hasan', NULL, NULL, '$2y$10$47RtSDknNaS0NI4vQVDYs.2FOvGlWDhss7bkKvJRlBmP6UYmUGjIu', 193, NULL, '2020-09-30 22:51:51', '2020-09-30 22:51:51'),
(209, 'service', 'service', NULL, NULL, '$2y$10$ym88aAuNm1c0gy1p37QJwuedxxFDIwV5WqAbWEp8vkYOASp6izEO2', 194, NULL, '2020-10-01 20:21:43', '2020-10-01 20:21:43'),
(210, 'call', 'call', NULL, NULL, '$2y$10$aF3bh6OU8XYO/1NTGVVUJu28mZ330j6HRXyvMItjwtMNdryxwdt0u', 195, NULL, '2020-10-05 15:57:13', '2020-10-05 15:57:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activation_histories`
--
ALTER TABLE `activation_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`file_id`);

--
-- Indexes for table `fscodes`
--
ALTER TABLE `fscodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `imei`
--
ALTER TABLE `imei`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `imeis`
--
ALTER TABLE `imeis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `imei` (`imei`);

--
-- Indexes for table `import_exports`
--
ALTER TABLE `import_exports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `outlets`
--
ALTER TABLE `outlets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD PRIMARY KEY (`user_id`,`permission_id`,`user_type`),
  ADD KEY `permission_user_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `phone_models`
--
ALTER TABLE `phone_models`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receive_delivery_histories`
--
ALTER TABLE `receive_delivery_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`,`user_type`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sales_id_unique` (`id`);

--
-- Indexes for table `service_histories`
--
ALTER TABLE `service_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_files`
--
ALTER TABLE `temp_files`
  ADD PRIMARY KEY (`file_id`);

--
-- Indexes for table `tiers`
--
ALTER TABLE `tiers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activation_histories`
--
ALTER TABLE `activation_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `file_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `fscodes`
--
ALTER TABLE `fscodes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=893;

--
-- AUTO_INCREMENT for table `imei`
--
ALTER TABLE `imei`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `imeis`
--
ALTER TABLE `imeis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `import_exports`
--
ALTER TABLE `import_exports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `outlets`
--
ALTER TABLE `outlets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `phone_models`
--
ALTER TABLE `phone_models`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `receive_delivery_histories`
--
ALTER TABLE `receive_delivery_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `service_histories`
--
ALTER TABLE `service_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `temp_files`
--
ALTER TABLE `temp_files`
  MODIFY `file_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tiers`
--
ALTER TABLE `tiers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

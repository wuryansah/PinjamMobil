-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 16, 2026 at 07:10 AM
-- Server version: 8.4.3
-- PHP Version: 8.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pinjammobil`
--
CREATE DATABASE IF NOT EXISTS `pinjammobil` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `pinjammobil`;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('pinjam-mobil-operasional-cache-admin@company.com|10.10.21.241', 'i:1;', 1776312090),
('pinjam-mobil-operasional-cache-admin@company.com|10.10.21.241:timer', 'i:1776312090;', 1776312090);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `manager_id` bigint UNSIGNED DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `code`, `manager_id`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Human Resources', 'HR', 8, NULL, '2026-04-07 01:45:47', '2026-04-07 01:45:47'),
(2, 'Marketing', 'MKT', 19, NULL, '2026-04-07 02:01:28', '2026-04-07 21:33:48'),
(3, 'Advertising and Promotion', 'AP', 12, NULL, '2026-04-07 02:02:50', '2026-04-07 21:32:41'),
(4, 'Finance', 'FA', 14, NULL, '2026-04-07 02:03:37', '2026-04-07 21:31:45'),
(5, 'Accounting', 'ACC', 13, NULL, '2026-04-07 02:03:47', '2026-04-07 21:31:53'),
(6, 'Customer Relations', 'CR', 15, NULL, '2026-04-07 02:04:03', '2026-04-07 21:32:01'),
(7, 'Engineering', 'ENG', 16, NULL, '2026-04-07 02:04:16', '2026-04-07 21:32:10'),
(8, 'Finance & Accounting Developer', 'DEV', 20, NULL, '2026-04-07 02:05:30', '2026-04-07 21:34:44'),
(9, 'Center Management', 'CM', 21, NULL, '2026-04-07 02:06:40', '2026-04-07 21:35:56'),
(10, 'Purchasing', 'PUR', 8, NULL, '2026-04-07 02:10:24', '2026-04-07 02:10:24'),
(11, 'Legal', 'LGL', 24, NULL, '2026-04-14 23:39:25', '2026-04-14 23:40:13');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fuel_attachments`
--

CREATE TABLE `fuel_attachments` (
  `id` bigint UNSIGNED NOT NULL,
  `fuel_record_id` bigint UNSIGNED NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fuel_attachments`
--

INSERT INTO `fuel_attachments` (`id`, `fuel_record_id`, `file_path`, `file_name`, `file_type`, `created_at`, `updated_at`) VALUES
(1, 5, 'fuel-attachments/cObH5X3paPqjgL1pdULD05zOP4oyFWqSlYioCavd.png', '1776310389_LOGO M2S White.png', 'image/png', '2026-04-15 20:33:09', '2026-04-15 20:33:09'),
(2, 4, 'fuel-attachments/XkOPit2VBVH7OFTL1A6nPfodJsYDeXxLGjjivPlP.jpg', '1776311263_WhatsApp Image 2026-01-15 at 13.29.16.jpeg', 'image/jpeg', '2026-04-15 20:47:43', '2026-04-15 20:47:43'),
(3, 6, 'fuel-attachments/bn7b84HE9Ras2zWtqHYjITsUMwEMptWdbngwCguR.jpg', '1776319475_logo-files-1594613244.jpg', 'image/jpeg', '2026-04-15 23:04:35', '2026-04-15 23:04:35'),
(4, 7, 'fuel-attachments/NDe6b3FDnEwBCawvDJG5LjslFf7VjqaQ0zxPoh4w.jpg', '1776321561_WhatsApp Image 2026-01-15 at 13.29.16.jpeg', 'image/jpeg', '2026-04-15 23:39:21', '2026-04-15 23:39:21'),
(5, 9, 'fuel-attachments/aQA8KLmsFjJaVVpiSLbHeZUMmrKEzBLWmeNXzBBU.jpg', '1776321741_WhatsApp Image 2026-01-15 at 13.29.16.jpeg', 'image/jpeg', '2026-04-15 23:42:21', '2026-04-15 23:42:21'),
(6, 10, 'fuel-attachments/VnYt7ArHCDp5m7wgN6ZRjLRmkXYDuYi0qqLZL0tp.jpg', '1776321848_WhatsApp Image 2026-01-15 at 13.29.16.jpeg', 'image/jpeg', '2026-04-15 23:44:08', '2026-04-15 23:44:08'),
(7, 11, 'fuel-attachments/OmDQHcTsSHhnBiiqiTe5BIL7CuxXxF6oSpZV2wz4.jpg', '1776321899_WhatsApp Image 2026-01-15 at 13.29.16.jpeg', 'image/jpeg', '2026-04-15 23:44:59', '2026-04-15 23:44:59'),
(8, 12, 'fuel-attachments/Zk164y02SsD7chCmwv7uOMyWZvV038LkxsRrNfEu.jpg', '1776322002_WhatsApp Image 2026-01-15 at 13.29.16.jpeg', 'image/jpeg', '2026-04-15 23:46:42', '2026-04-15 23:46:42'),
(9, 13, 'fuel-attachments/4Y4GFZj0exqd88RIKtj2A2IeP4WgGfInJb6tFsUe.jpg', '1776322051_WhatsApp Image 2026-01-15 at 13.29.16.jpeg', 'image/jpeg', '2026-04-15 23:47:31', '2026-04-15 23:47:31'),
(10, 14, 'fuel-attachments/QC0cr4BOLKTSZtw57TGBLm2K6Nj7l9rVV4WtMjkJ.jpg', '1776322154_WhatsApp Image 2026-01-15 at 13.29.16.jpeg', 'image/jpeg', '2026-04-15 23:49:14', '2026-04-15 23:49:14');

-- --------------------------------------------------------

--
-- Table structure for table `fuel_records`
--

CREATE TABLE `fuel_records` (
  `id` bigint UNSIGNED NOT NULL,
  `vehicle_id` bigint UNSIGNED NOT NULL,
  `refuel_date` date NOT NULL,
  `kilometer` decimal(12,2) NOT NULL,
  `start_km` decimal(12,2) DEFAULT NULL,
  `fuel_amount` decimal(8,2) NOT NULL,
  `fuel_type` enum('Pertalite','Pertamax','Pertamax Turbo','BioSolar','PertaminaDex') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price_per_liter` decimal(10,2) DEFAULT NULL,
  `fuel_cost` decimal(12,2) DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fuel_records`
--

INSERT INTO `fuel_records` (`id`, `vehicle_id`, `refuel_date`, `kilometer`, `start_km`, `fuel_amount`, `fuel_type`, `price_per_liter`, `fuel_cost`, `location`, `notes`, `created_at`, `updated_at`) VALUES
(4, 12, '2026-02-07', 44920.00, 44560.00, 29.62, 'PertaminaDex', 13500.00, 399870.00, 'SPBU Pangeran Jayakarta', NULL, '2026-04-15 19:35:23', '2026-04-15 19:35:23'),
(5, 11, '2026-01-08', 152537.00, 152314.00, 33.49, 'Pertamax', 12350.00, 413601.50, 'SPBU Kenanga', NULL, '2026-04-15 19:41:58', '2026-04-15 20:38:31'),
(6, 11, '2026-02-19', 152726.00, 152537.00, 21.19, 'Pertamax', 11800.00, 250042.00, 'SPBU Pangeran Jayakarta', NULL, '2026-04-15 23:04:35', '2026-04-15 23:04:35'),
(7, 12, '2025-10-30', 44560.00, 44247.00, 36.03, 'PertaminaDex', 13700.00, 493611.00, 'SPBU Pangeran Jayakarta', NULL, '2026-04-15 23:39:21', '2026-04-15 23:39:21'),
(8, 13, '2025-12-02', 54690.00, 54456.00, 38.36, 'PertaminaDex', 15000.00, 575400.00, 'SPBU Pangeran Jayakarta', NULL, '2026-04-15 23:41:33', '2026-04-15 23:41:33'),
(9, 13, '2026-02-18', 54977.00, 54690.00, 22.22, 'PertaminaDex', 13500.00, 299970.00, 'SPBU Pangeran Jayakarta', NULL, '2026-04-15 23:42:21', '2026-04-15 23:42:32'),
(10, 9, '2025-12-12', 155995.00, 155645.00, 32.13, 'PertaminaDex', 15000.00, 481950.00, 'SPBU Pangeran Jayakarta', NULL, '2026-04-15 23:44:08', '2026-04-15 23:44:08'),
(11, 9, '2026-03-17', 156458.00, 155995.00, 32.66, NULL, 14500.00, 473570.00, 'SPBU Pangeran Jayakarta', NULL, '2026-04-15 23:44:58', '2026-04-15 23:44:58'),
(12, 10, '2026-01-08', 142501.00, 142243.00, 32.25, 'Pertamax', 12350.00, 398287.50, 'SPBU Pangeran Jayakarta', NULL, '2026-04-15 23:46:42', '2026-04-15 23:46:42'),
(13, 10, '2026-02-06', 142842.00, 142501.00, 38.25, 'Pertamax', 11800.00, 451350.00, NULL, NULL, '2026-04-15 23:47:31', '2026-04-15 23:47:31'),
(14, 10, '2026-03-30', 143093.00, 142842.00, 37.89, 'Pertamax', 12300.00, 466047.00, 'SPBU Pangeran Jayakarta', NULL, '2026-04-15 23:49:14', '2026-04-15 23:49:14');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_01_01_000003_create_vehicles_table', 1),
(5, '2024_01_01_000004_create_vehicle_requests_table', 1),
(6, '2024_01_01_000005_create_usage_records_table', 1),
(7, '2024_01_01_000006_create_notifications_table', 1),
(8, '2026_04_07_082834_add_manager_id_to_users_table', 2),
(9, '2026_04_07_082905_create_departments_table', 2),
(11, '2026_04_07_084804_add_manager_to_roles_enum', 3),
(12, '2026_04_07_085715_fix_users_role_column', 4),
(13, '2026_04_07_085613_update_users_role_enum', 5),
(14, '2026_04_07_091544_add_manager_notes_to_vehicle_requests', 5),
(15, '2026_04_07_091812_update_vehicle_requests_status_enum', 6),
(16, '2026_04_07_094439_create_fuel_records_table', 7),
(17, '2026_04_07_095107_add_price_per_liter_to_fuel_records', 8),
(18, '2026_04_07_095715_create_fuel_attachments_table', 9),
(19, '2026_04_07_102348_add_start_km_to_fuel_records', 10),
(20, '2026_04_08_025942_add_current_kilometer_to_vehicles_table', 11),
(21, '2026_04_08_045052_add_request_id_to_notifications_table', 12),
(22, '2026_04_08_060742_add_driver_cancelled_to_status_enum', 13),
(23, '2026_04_15_083000_add_timestamps_to_usage_records_table', 14),
(25, '2026_04_16_000000_add_fuel_type_to_fuel_records_table', 15);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `request_id` bigint UNSIGNED DEFAULT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `request_id`, `type`, `title`, `message`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'request_created', 'New Vehicle Request', 'Vidi has submitted a new vehicle request.', 1, '2026-04-15 20:50:01', '2026-04-15 20:51:10'),
(2, 18, 1, 'request_approved', 'Request Approved by Manager', 'Your vehicle request has been approved by the manager.', 1, '2026-04-15 20:50:43', '2026-04-15 21:01:26'),
(3, 18, 1, 'request_approved', 'Request Approved', 'Your vehicle request has been approved. Vehicle and driver assigned.', 1, '2026-04-15 20:51:25', '2026-04-15 21:01:26'),
(4, 5, 1, 'trip_assigned', 'New Trip Assigned', 'You have been assigned to a trip to APL.', 0, '2026-04-15 20:51:25', '2026-04-15 20:51:25'),
(5, 18, 1, 'trip_started', 'Trip Started', 'Your trip has been started by the admin.', 1, '2026-04-15 20:52:17', '2026-04-15 21:01:26'),
(6, 18, 1, 'trip_completed', 'Trip Completed', 'Your vehicle request has been completed by the admin.', 1, '2026-04-15 20:52:52', '2026-04-15 21:01:26'),
(7, 1, 2, 'request_created', 'New Vehicle Request', 'Vidi has submitted a new vehicle request.', 1, '2026-04-15 21:02:37', '2026-04-15 21:03:34'),
(8, 18, 2, 'request_approved', 'Request Approved by Manager', 'Your vehicle request has been approved by the manager.', 0, '2026-04-15 21:03:14', '2026-04-15 21:03:14'),
(9, 18, 2, 'request_approved', 'Request Approved', 'Your vehicle request has been approved. Vehicle and driver assigned.', 0, '2026-04-15 21:03:47', '2026-04-15 21:03:47'),
(10, 5, 2, 'trip_assigned', 'New Trip Assigned', 'You have been assigned to a trip to Sency.', 0, '2026-04-15 21:03:47', '2026-04-15 21:03:47'),
(11, 18, 2, 'trip_started', 'Trip Started', 'Your trip has been started by the admin.', 0, '2026-04-15 21:04:13', '2026-04-15 21:04:13'),
(12, 18, 2, 'trip_completed', 'Trip Completed', 'Your vehicle request has been completed by the admin.', 0, '2026-04-15 21:04:42', '2026-04-15 21:04:42'),
(13, 1, 3, 'request_created', 'New Vehicle Request', 'Boedi Tegoeh has submitted a new vehicle request.', 1, '2026-04-15 21:06:22', '2026-04-15 21:42:31'),
(14, 8, 3, 'request_rejected', 'Request Rejected', 'Your vehicle request has been rejected by admin.', 0, '2026-04-15 22:03:54', '2026-04-15 22:03:54');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('0vyHk4JxMFO1BvruVBBdz0Aok1RPuIjjqSYadzie', NULL, '10.10.21.62', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM1FoYTl4MkZSc1BlRzhRVEpzSFU0UTFEUzZhSk9PNzZjelc3cWIxUCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776318151),
('1hRZEaFKwvrLYlc8GPgc5pI80r2Xtd0gyGvDtM21', 8, '10.10.21.241', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoieWJqMjdkbXVoNGdraHRuUk0yaXdwV0tQQ2FDdkJ1Q3FPeUh0WE9INiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly8xMC4xMC4yMS4xOTYvcmVxdWVzdHMiO3M6NToicm91dGUiO3M6MTQ6InJlcXVlc3RzLmluZGV4Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6ODt9', 1776312389),
('1LhRx3C6RH2EEgOV13NqV8Ijhgy2TC5wzIxfOBns', NULL, '10.10.21.189', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYTJqUDEyOHJIV3FZOW1zdTlzOGxqSFZiR2gwcUpveVpPSDIwTm9FVCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776317755),
('1lUwSivQPSCGcawR7SaCO3d26fr3qkx1kE6lexB8', NULL, '10.10.21.96', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVEJOaWNXQ3RBSGVEUVFrQXZqeUNSMklTZWNCSkM0RUJYTU9IaEs4WSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776317256),
('24p6XMzZ6ft6Uu1bYgCTKQ00KyKCD2M4uFr72uw2', NULL, '10.10.21.30', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSGpCMjF6MHVGdjN5Q0ladndrcXFHcmg3b2o0Q1BvMURqSzBMaTVzdSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776315142),
('27FhifjbGWijlubW0oLoXthJEMPGxVD9hqTCokmx', NULL, '10.10.21.39', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaXdRdklQOGRtaG9ScWg5Vm1ZYUJ0a0xCeWtzdjNSYzdteDNmeGlmbyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776320415),
('2f277igIkF468oMrHkLOabBGpmpxaIAYz6mAm3Dy', NULL, '10.10.21.72', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQTJzWGhIUUVxZmVJZmNrTHB0dWlRN1o5UHFBYkF2bFRnb2laODBjUSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776318136),
('2lNU8cWLaBFKpagM0TVG9E9XFZxSvfqhLGWV54ue', NULL, '10.10.21.241', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibGYxcXlRbUJhV3NocGEyc2JWc1M1S2dQdXBlYW9qWEtjdTl2V0h0QiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776313387),
('4fsVfhZxNDonctLLUz76CJWGSWwR1Fs8ntWbW9A7', NULL, '10.10.21.102', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSU5CSVNEdGpEckZkZjRLNHg2NkZDdGVBbDVRUFZKcEkwdWo2aDVSdSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776313210),
('62znr7dqZZDbGT9TDuTakFxxt7thbIqpM3spebCz', NULL, '10.10.21.192', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicE5HREhyWEpHWGRqZm5KbklBeXFoenJFYU1aTUpWMnJvekNVWWVGWSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776313219),
('67UAPKrdbhtLnyhXqE7IX5XxZgiM7G0L8OBpKDK5', NULL, '10.10.21.72', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNW9nUXVERUJRcEVrOWJBUlYweXVDT2RhdWp1cHd5ajZsS3d6N25ySCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776321737),
('6jRlg6KcW2IjfNLHygMK2QfNa951sOAIaitSoifv', NULL, '10.10.21.176', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWHFteDhKWHJKVTExVzB5MDNXRkduYlloYlFYbFRyZEg3OGZIWVQ5cCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776317924),
('6vAXdIRgYqmAkHiio9lFhZGLShXJoDLSllG818bN', NULL, '10.10.21.189', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSVZJcGRFcklCNWRpV0pXTkRkcHB2bW5LZzNqQXF2aG9TSlNGZzJTYiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776321349),
('6vjLNvPW4tE54AgjJe7GBrZrHJb6tkRf8lRJGDVs', NULL, '10.10.21.129', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiV3N6bHR6d0lHYlB6ZHMyb2dYWVJ2WVFEUGhJT0dXb3dxeGhWQ2pVVCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776321786),
('6w5Ki8I7Ltvq5mmpYxZKHOw2s75y4Dy9lVMDPWpi', NULL, '10.10.21.96', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidEEwUVA1Wnp1Y2hOUlF6dTVpQTBNODVmV1RIbjNlOFBmNTdPWVYwViI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776320859),
('6XzgjJTfxct9uPO9BwuusevjWhhv1TiPmHerALg6', NULL, '10.10.21.98', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVE5EVVBBUE14RlJPaWtqZlFzRE9HeHpSb092UzY5dUgxMkRyU3AxUiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776317783),
('6ZKMHAX4pHumuIimToHZg1CVt6NOEt81hPedhmIA', NULL, '10.10.21.238', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMWRlcm5MeGk5T2ZKYlBOTTFJQVdRUjduMkxidE00bmJwcEVOM0J5aCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776319458),
('82CCriqy6lzI3BAcu1JKF4aeUqePZJMOdQ1U7xKn', NULL, '10.10.21.180', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSjBZcHFKSHBOOXNJaXc4cFJ1cHBNejVaNk1aaW9vNXNoc3hmck5RMiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776318738),
('8ybetAk9aewyKlkV106YSInoHHciMKBxMvWrBwyC', 1, '10.10.21.196', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiaExSRzRWd1MyTWE3Q05QU1p4Vk42cDhKRlA3dGtSWmZQN0ZlSmtyViI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHA6Ly8xMC4xMC4yMS4xOTYvdXNlcnMiO3M6NToicm91dGUiO3M6MTE6InVzZXJzLmluZGV4Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1776322298),
('9DC69qeDvaPKZBEbpw1ym7gh5evnGlgR8rU131CJ', NULL, '10.10.21.65', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaTJLQ25QSDBIN3plcWpuNkxwU0tBMHd3N3p5SzdEOVVNQUNCWEZMaiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776320708),
('9Z0ikTIKm09BnbbJpJ5Jen40aqghgo7eSn48Q2Xf', NULL, '10.10.21.192', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYXVUQ0FFbWgxNlpNTkViREF2blVSYkJ5ODlqWnpRWmRlc2lrM0NGViI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776320429),
('A31CYoZ1ajZf4AjLUPaqh0nlU842jBtjEVxYvrh5', NULL, '10.10.21.30', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVHZUUE9EbXpoVWNHSFJhbERlUzFuaEtWdnVSaXJRNU92cGxHVk5xaSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776319458),
('aaJ9y64hJw3f3YOrQnJa66OcVeUdI2aEnOCji0sq', NULL, '10.10.21.73', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiejNJS0xGM1BOOUt4NHNDaE9KSlBOOEthdHpzaUc4ZzJVcmg5MWd3eCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776313937),
('ac40hkWIVcQv9l87940bNMcm02QSaaacsbMJXart', NULL, '10.10.21.129', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQTFrMDJJeVZ3ZDd3cVFocnlZSFdtNE1qSmg5OERqN0VpTXp3RzMwayI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776314579),
('aDrGHPI4EAfN0NQaDqUwMMrjLhTfnw8c19eXhbHV', NULL, '10.10.21.147', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRUlLekpKU2lDdWlkbFp1TmFrRlRHTUJ2RkI0RU9XNzRqS1VBWGRCQSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776316892),
('bgLhjvVLwffuDsENJNxlpWnvNjNyZlWFgtZy8UxG', NULL, '10.10.21.63', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWHZCUWNjQkRhOWdUQ3hPUlV6N3NNbWJMN05RU0lPU1JqV3VkV3REMCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776323108),
('Br5yh9t03e7Lc9f8kzUUyrQbDcCrnPsfuFSUZ02X', NULL, '10.10.21.250', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMzN0YktBSGFMMGNVZ09uRHNjc3FEa0dVbXVwVkZyN242N1o2bUxjQiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776319284),
('bvkI06TWHvUb4XNV7OWaKvtcXD4EsgMLk6W29Gec', NULL, '10.10.21.143', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibGhuSEQzWTNmN2tYVlRLOWsyUXVBekNWazlUaWdZZVRyMWdnc1dXeiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776312770),
('CRb34HRWNAgDaEqj8ki8Q1SkszvxsHxMZ3leXDwB', NULL, '10.10.21.211', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicUxOSlZxUFdVU1RwUEtwWVFhOHl6ME1Sd0pScEdRNXBlNzVNZU11MyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776321285),
('dDk2XEcbEh0ua2mW6kjgKqOAZxlMqutCkjpshLYa', NULL, '10.10.21.179', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ0hVSVFvRzJ2UmV1anpvOVlsdkdTZDZSd2l3QlFRNE00UzJHcHEwYiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776319458),
('E24sOkfviX7TJNVcc4SZgxpTzxC0NRP0h4mxws32', NULL, '10.10.21.98', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidEVQVTdvdDF4V2lHZ241Y1hrb2VteTl2cEFNQkF2Z0V6amgxa2NPRCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776321379),
('E6a3o7tGrcAWSgLsXr8OsP0dlnso3fo5n7wAVljX', NULL, '10.10.21.96', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQ090RWZGc012VUVLdUhMSDZYR3hUZVFVYm00M2FwNXZwRlFBNTlBcSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776313653),
('ejBvnJmdTjJUcDhQnGkPDsO9Hqvj36c3M1HtAa7f', NULL, '10.10.21.194', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiREk2emJGWXZzSmh2ejNMQkpSMnh2TTMzNUVZTVNWWlJCdWhac2FRQyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776320489),
('fCaB9AYSBCnY3Vr3CQEhufN0duhpy9JZKieXAkCZ', NULL, '10.10.21.53', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiU1R3aHBGMk5QSFRXMUVrNlVZTEd6bldad3pFOG5OS2FCMkozYWZJaSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776313057),
('fHl3XQAm5rNv411MXpEGxylrVsrWMfc1HDLkpCsk', NULL, '10.10.21.52', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQUwxNGRzRUZSeWk2T1RJR1lhOHU1bkRveHVXT0gycFhQTG1tV0NkUCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776314397),
('fvFYtFx0CfDNCAJXART78XRyJbAuo3t597RV9BDI', NULL, '10.10.21.102', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoib0hEZ0JRd2JkVktmbmtsTUx0b3BOZmpjZjNUd05HdzU1WEdSQlU5UiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776320413),
('GjXIMWMPz18NLYQYrOVcUQS6SXrE7JJmpU8dwDvk', NULL, '10.10.21.211', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTlhnVENtcUl2SFlUSFRiQkFGRFhrZVBVeVprcWxkdUZVUlBFak11dCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776314074),
('gY7ecZJgKbnxE2N1xebzCxR67xU9xiWWZW0iteE1', NULL, '10.10.21.52', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiT1hQU1YzMXVsWXRTRWczaWIzR0hkR3JKalpCTEh4Y2RlR2dEbkpjSiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776318020),
('iB63Sdt7saDLIUqqVgBckqFIfcxQALzfJvLg2bWb', NULL, '10.10.21.129', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSnlsT1RTdFhaMExNUlNtYWoxUlNMZktwejV3Wk8zUmVablVKVkJYTyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776318181),
('In3ujdNIg030uXyCyb1lMNAJNNEMeQQCjymfrz7c', NULL, '10.10.21.7', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM1NTNU9WZEMzdVpNc0p6eklRSmtyMm9BVGxWdlFVVXo4Ynd0aFhydSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776315142),
('j7bJLeeNtsB0ATCVilH2e11JP4UqNV1X51zuFFA3', NULL, '10.10.21.73', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTTF6cUZOcXdLdmtzRWxiNHAwWWxHMHp0ZXhlWnVPNlhxRGJSMHVhcCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776317539),
('Jvak3cM5T8ifnYQv64iXj3WSp1pCFH4wqLzRQGiv', NULL, '10.10.21.53', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMXpLWXdtbUlOTXFSOTQxRHVFU0tRUUtoME1CV3NQd2NLbUxHZXFJeCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776316661),
('K6ZotIrVeLDp0LN9UzBPBuZvo0syPNkGPYBjbAMN', NULL, '10.10.21.67', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiV1lWWWNxMVdVVkw3amVOYnN6dm9QWW1ZZzc0cWF6ZUhmSUxQTlZSYiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776318925),
('KP4HtdYMp2JswZFCaCsBokkuAkQcLXV0saBity1a', NULL, '10.10.21.250', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaGVwaDJIclJaS1hXdUNuT3lDWVpwbGx2WVlJaHVjRGJ5S1VXclhBUyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776315677),
('lMP86qmFXICn6YV6tsiZ7zjyZaKJsATjVqxtKI19', NULL, '10.10.21.63', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieEJXdWNqRVVnWmE5djZaTFhHTTdzWDZGS2pjNndaN0o5c1BrVHpkVSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776315919),
('MJZUJy6vjlT4uwold51GtpeSmO1Y3Q6hrXiZGWgL', NULL, '10.10.21.45', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibkNhdUtoR1psdEZFTXpMOTRBRHJrZVFmMjlvMGxKeXhrR1J2WVBzNiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776322364),
('mt7b2QolsbMuzXOKs9rJwEd9cOqBFuFBGffMaQUH', NULL, '10.10.21.67', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibm1WWmZQRHBRSG00Rmw5Z3pwS053RGpJS255MHY0WTBCcWRGdnIzcSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776322527),
('MWEvOIPzEPbwILG93gyn048pkEQAhmfuoUpszH2F', NULL, '10.10.21.241', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMkJxZW5FeXB1akJJRVN0Y2QyWGxwcDI5T05MQ1BXdHV6dEF0OERPUiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776316987),
('NEVoqdEuLUKGBWI4lloA2CT32v38S0EVfo2NBIE8', NULL, '10.10.21.147', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTUEwR0pqYk93RVY4SUxTN2J2R1M5cVhJUFVCSjJEWDVKUVYzd3JIcCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776313296),
('NhjH0v6VTsP5IVDPLZV6y8E4GfZJdLJXQoJjnxxB', NULL, '10.10.21.7', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiU3NSWUpaYlB6b3ZDdlBoTGUzN3JhTHhNVFVMRXFUQVRZNUhOV0ZqViI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776319457),
('oAOGP6jPu1x6vtXwcW8F4yI6ic87mwM7Mx5n2gFT', NULL, '10.10.21.192', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaWtjTnpQTVRkVDZOdnJITmczRGdFcjY0Tk5SVlBrZ1dVcjZic2lKZSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776316827),
('OKtOFr0LOcywOwQhRA629gowX12bOMDVyIILDJ4K', NULL, '10.10.21.20', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQW9HaHI4b0VWbktnRVQwSWhGSUVKc0NQSjdHUW5wRzByTDhoWE9JQiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776313706),
('P0csPtl8ysXAo9csh8rxhFwauXNcABBsi92FpeOj', NULL, '10.10.21.65', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibGlRNVJveVJERExSODhKNG93MjBZY2FWRWUwcHowbE9XTlpoc1FxdiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776317100),
('pLDiPIGlw8NplrNJ1SP7iVi9k2dem3HE31iq37pV', NULL, '10.10.21.238', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidmxUUVJZMVd6Z1pMcFRTWkZkblNIYTFnRXJrdXMzemRvOHZPZkhIQyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776315143),
('PYe7hysbULr82Q9MrBuliWMSWf5O2xWg55VQluH0', NULL, '10.10.21.63', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRzN1Y3JGUnAwSUdvSG1zMEszc05pQ0dub3VKOWhSSXREaVQzR0hEVyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776319514),
('QkAV8h7rArJdqCLr0MtjjRz1oFhIQ7gs7KWkyhXs', NULL, '10.10.21.63', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicXZORmtCWnRyeXJodDNnWVh1ZE9MZk52aUpLSWJ5dTRhTWhRbEJxNyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776312316),
('RAhe7ipLuzKDyYpRQbLJ91zRJImdl3D69AnSgyx2', NULL, '10.10.21.241', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibzMzMkkxOURrMWpxQ2VLamtyZnlCNzZhQ3ZJbWlPRHI1azNsZ0hiNCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776320590),
('S3jMXTsuJ4J3s9k4u8Qcqb9dQlJWtLERdNfSb1kG', NULL, '10.10.21.143', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWWZJaVEwU3ZBWTNOY2Q2WDJzOTN3QlhrQVhibm9qUUpLQWhwWHVFZiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776319972),
('SfiD4V5sh2MAJDntWbAvlwK3qVeURbUSzWTcV4d0', NULL, '10.10.21.72', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicWhhNmhEbWhyR1p6Rm1ia0ZPa05FVjhLV0xQR0NzTExUTTB2eVR5RyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776314538),
('sGY0jrvERmF6JarokfhmmMJdXl1GapoJEHDKN78s', NULL, '10.10.21.73', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiN1llbHNPNldYQjNxSmx3NHROVGNqQVJrMWkyNmduRXhYdkNMbWNFSyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776321144),
('T5MqwdvqtrjgZRHyWHffBDE63OLO0CHFARExH3IA', NULL, '10.10.21.194', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWVZCUmRBT1hqalhkR0NaWUxiVEpMM3JjTmI4Rnd4aWRRZWNhOTJrdiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776313280),
('U0GgegvsvvwI27MLK2rZsibZtt5pR5l3q8DGMMFy', NULL, '10.10.21.20', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMzFEdk1TTGM1WUZSN3AyTDJ1Z3ZoRUFlYktZUmJFWHhuYzRwRjJ2ViI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776323055),
('u0Iurga7PvEe0sVRbyDyDyiOrqj6G9iWBdwVC0uc', NULL, '10.10.21.53', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNlZZemQ0eVFFQnhsdlIzcVFDYkkzRDZHYWhDMXk1bG9zZ1lkam9raCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776320262),
('u8Zh0RhX5T42xcxbst7mStRxRa6cD2KemoDDRRqG', NULL, '10.10.21.65', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSjVtWDF1bFR6d240eWpNRVpMOTVuUDBtQ1JBZU5ialhLOTBNbVNXZSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776313499),
('uhQNVakUoCqMEmoDWRgyj8qzGk1bm1EXNX8CkrWK', NULL, '10.10.21.67', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoickYyM2dWdlpDQkU5Z1FQb3JBZmYwZm0zdGsybXIwMEFVUzVoZnpHSiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776315323),
('uIFZE7pzeQFsW1WMIItl3UqMkLrYaLvwMiLpwp3d', NULL, '10.10.21.147', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSmtibzJMajRMUWlDZjROTnd6WEY3dDNjWEVia3U0S1J5R25lOEZPNiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776320498),
('uScHRP1T2xSE5ugPn6N3K3OfdIVhe6137bByX7dU', NULL, '10.10.21.20', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibW1HNzJSRm5HTkJackQ1eVp4ZWJTSTNJYlFic2RzcTlzc1daaWFkUSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776318738),
('UvfnzqUK2of25iHnckEjUXQdW2yxjfkHpj0yy80p', NULL, '10.10.21.98', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQVZDQ21hNmh0RG1aQzhZemxyUEJubWNhcjNGQ2pYcnpodFhRd2xndSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776314181),
('v08z1Bqr5QhNiW2rYU4rMAMF1otHM78STzbnKz9I', NULL, '10.10.21.45', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSGxqVG5PcjlyYm42QmFxSmtQMWtEakF5RkRtRmZ1ZXF1NnpsN1psTCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776315149),
('VdjvWtXWGHaVUCdQnD7MVvckNO22JCuQpI6RW43I', NULL, '10.10.21.176', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZk9SZWdHc1VnMmRPdGRuMFBwcUxwZmZQU1VPUWlvMGxuUzQ5UDB2aCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776314320),
('veq12h9Lrq2l2GNkT04WeXT7UbdZ5v8g6jzs0fs4', NULL, '10.10.21.62', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibjJjdTQ4cU41S0FDazl2SGFzUmtiWDFMSUZMYjZVU0pqeXZsSG9FbSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776321760),
('voLgIo2qxpX7hK3m4Jb4zyzs8y4xa81O43zwIcTr', NULL, '10.10.21.143', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiclYyZVMwdU9YdjNWallOSkZrN3B0OUN0TktvSWlWTTdPbUdkS0pMOSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776316370),
('WGnNVcSi0nKS30y02Mugvjg43jJxhjGwCdNkCuFV', NULL, '10.10.21.211', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMlZtVHJpZmRCQ0ZnaHRXSks4aEduYjVhQ2lsbjI1eFlWdXRIWDBlTiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776317674),
('wR4QEQoNpRuQS7UqDa6Nk2F8CSgjq0Prc8LmiOHr', NULL, '10.10.21.194', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZUl1d29kU1k2UG1jV0hrQms5SmkxbmtKdGhOTm1IRFZTWDV4NUhlTCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776316884),
('XEEnI9P9sEXnu8kN9XzkXZ1fc6knVvfQvHhyCKZF', NULL, '10.10.21.176', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoia3VrVDJlZ3BSMGJhR0F1Z1U5aDdTSnB3Mk1nbEI1U3RpWU9Kdk9VWCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776321520),
('XYFw16N9U2pDokyS3qzqKqcpWwCUNZZ90zbw3H2V', NULL, '10.10.21.62', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOFdBeVgzT3VPSktUREs3Q2Z1Y1NWV2lHRXl4THNIVDhUZFdzU25kVSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776314554),
('yD4oL7jyZWpJegnTwePRfDhdgrDC8SRnLPUjRAEW', NULL, '10.10.21.250', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYXJoZVp5YWV2Nkp5VDBhQUo2WndoQVRrdGFNZGZBNXJjVU1FVnFCeCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776322889),
('Ye6E4xJ4yWfheeC3ZLhdiKIXdm8d9S6W7DCtKXAJ', NULL, '10.10.21.102', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVWpSZzRDQlN0WFdEVW56azNicGNCSE4xWmFZY01aa2gyTTIwV0VmQyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776316812),
('ye7jdXEf8gWVzFzXBna9sOAFOSGdqJt6WCRCcxyG', NULL, '10.10.21.39', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieGlXbjhXRTlidGRUY0RSc09CakVLbzNIYlJFTWxMYmtZQW5HZExqUCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776313211),
('ykx6mE8EDoOkHAVoM0wKJoINcho2coqMNMtF1sjf', NULL, '10.10.21.52', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSDNxTlN0TDF6cGVZekFNdldTREFFcFJxRW93bVJCQVh4RThVTmVZUyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776321625),
('YLa063D90aNSJg9wMV2LIELSGiyVnWG1gX5azMoe', NULL, '10.10.21.39', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUHJYQzc5TlNvRXZ3aURDNUNYbmZCaHBNU3BwUDhDMVZkU2FPMmxjeiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776316812),
('YqZ2p9Pj0Q98RF2rTBRiuTOBIfX9BHILLtkdBABc', NULL, '10.10.21.189', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOFFHbVM2SDg3aE5JWWc0MXlRZUVaUVViV25DVHlLVTJwWmxYVjNRQyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776314144),
('zndFMeph6l4iS09Ff2pMEmZLtTE8I5mLXA6rjzwc', NULL, '10.10.21.45', 'HomeNet/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZFBLQ09WemkxcFVNck9NQlhtblZCSVZjS29heURaMUFwS21oQ1hEcyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly8xMC4xMC4yMS4xOTYiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1776318756);

-- --------------------------------------------------------

--
-- Table structure for table `usage_records`
--

CREATE TABLE `usage_records` (
  `id` bigint UNSIGNED NOT NULL,
  `request_id` bigint UNSIGNED NOT NULL,
  `start_km` decimal(10,2) DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_km` decimal(10,2) DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `fuel_used` decimal(6,2) DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `usage_records`
--

INSERT INTO `usage_records` (`id`, `request_id`, `start_km`, `start_time`, `end_km`, `end_time`, `fuel_used`, `notes`, `created_at`, `updated_at`) VALUES
(1, 1, 152366.00, '2026-04-16 03:49:00', 152367.00, '2026-04-16 03:53:00', NULL, NULL, '2026-04-15 20:52:17', '2026-04-15 20:52:52'),
(2, 2, 44920.00, '2026-04-16 05:05:00', 44935.00, '2026-04-16 07:07:00', NULL, NULL, '2026-04-15 21:04:13', '2026-04-15 21:04:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','employee','manager','driver') COLLATE utf8mb4_unicode_ci DEFAULT 'employee',
  `department` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `manager_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `department`, `phone`, `remember_token`, `created_at`, `updated_at`, `manager_id`) VALUES
(1, 'Administrator', 'admin@pinjammobil.com', '2026-04-14 19:31:29', '$2y$12$.yjln2WfSpSqhxs0xjyQ8uJzy4J5vzyFaXP0Xb5dt6ZCpJLqJe2ie', 'admin', 'IT', '081234567890', '9hLiBe4jzOfoRPa8ncD41L5v3uRg68krhfe46GamOCkd39PcroIdHsYaNCFX', '2026-04-06 22:08:58', '2026-04-14 19:31:29', NULL),
(2, 'John Supervisor', 'supervisor@pinjammobil.com', NULL, '$2y$12$tgFFOpvo.OEqWoBJbSN01OKsf74Fyy.cRCUmKFELJuTTC4HNCAC.m', 'manager', 'Operations', '081234567891', NULL, '2026-04-06 22:08:59', '2026-04-06 22:08:59', NULL),
(3, 'Alice Employee', 'employee@pinjammobil.com', NULL, '$2y$12$GrXHYsYgPsX2207x07SXzOv6yBUx.SUNr3a2Nv.X6vRQHYSAFN45a', 'employee', 'Marketing', '081234567892', NULL, '2026-04-06 22:08:59', '2026-04-06 22:08:59', NULL),
(4, 'Bob Employee', 'bob@pinjammobil.com', NULL, '$2y$12$k8SVw86i7au0JnBRI65wM.VPmkDb/GmtpsuKm3lf6usL.aU5DygRW', 'employee', 'Sales', '081234567893', NULL, '2026-04-06 22:08:59', '2026-04-06 22:08:59', NULL),
(5, 'Y u s u p', 'yusup@pinjammobil.com', NULL, '$2y$12$YrcnlpN7Kc6MR9/J9SL.Cedi/cCvMIACmu57/7t5wTDBByMslYycW', 'driver', 'HR', '081234567894', NULL, '2026-04-06 22:08:59', '2026-04-07 02:09:47', 8),
(6, 'Warsono', 'warsono@pinjammobil.com', NULL, '$2y$12$XISphLKvbzeW0vNf7Fkfo.PGsumri1ynfGCEe/xqxNWG.zvR4IfE2', 'driver', 'HR', '081234567895', NULL, '2026-04-06 22:09:00', '2026-04-07 02:10:08', 8),
(8, 'Boedi Tegoeh', 'boedi@pinjammobil.com', NULL, '$2y$12$h1gmhvhxJ14IX.Zr3Y6bL.mrvWD7tPGiXE8lY4FaxRQo.6Ozi5PDS', 'manager', 'HR', '081234567897', NULL, '2026-04-06 22:09:00', '2026-04-07 01:46:56', NULL),
(9, 'Eve Employee', 'eve@pinjammobil.com', NULL, '$2y$12$DosFW/bQ5EhU.JT5Ibvjvu42t/Yla4tlKRjiIHDt35SDbhCYF83VK', 'employee', 'IT', '081234567898', NULL, '2026-04-06 22:09:00', '2026-04-06 22:09:00', NULL),
(10, 'Risyan', 'risyan@pinjammobil.com', NULL, '$2y$12$IbMS9XP7AtXYxctJMTKjOe1Z9R.BSLxxYfPDz00v/E4FIR/PuXtY.', 'employee', 'FA', '081234567899', NULL, '2026-04-06 22:09:01', '2026-04-07 02:13:59', 14),
(11, 'Rafly Apriansyah', 'rafly@pinjammobil.com', NULL, '$2y$12$UosCfMrrPibY3ZPXZizvyOeps6qgETcij8de7QlRSZklvt5DARHaS', 'driver', 'HR', '0838', NULL, '2026-04-07 01:46:32', '2026-04-07 01:46:32', 8),
(12, 'Luffy', 'luffy@pinjammobil.com', NULL, '$2y$12$nHt3RS.JNeaP4U.DEl3svO8.C/4XtAkzUVpd.t5t.yZG3SNknazkW', 'manager', 'AP', NULL, NULL, '2026-04-07 02:07:10', '2026-04-07 02:07:10', NULL),
(13, 'Chrisye Vico', 'chrisye@pinjammobil.com', NULL, '$2y$12$rtwkFPPdPHPy0Ce3LNTpFeuUCOkoeGO9vZsREIuhUPxjtiwbHhp4i', 'manager', 'ACC', NULL, NULL, '2026-04-07 02:07:36', '2026-04-07 02:07:36', NULL),
(14, 'Asmawati', 'asmawati@pinjammobil.com', NULL, '$2y$12$oCOQZ1uIPzG5ahGZg2cc9.ivZ8QFA1LuXQAtwsIswu.VmxUHzXtI.', 'manager', 'FA', NULL, NULL, '2026-04-07 02:08:07', '2026-04-07 02:08:07', NULL),
(15, 'Seno Haryo Putro', 'seno@pinjammobil.com', NULL, '$2y$12$UKIGBORGIXz2nD4/FDlSBuagPvReEwye/w1OK6MgmWObT6u4ZDkYu', 'manager', 'CR', NULL, NULL, '2026-04-07 02:08:33', '2026-04-07 02:08:33', NULL),
(16, 'Jaelan', 'jaelan@pinjammobil.com', NULL, '$2y$12$TMYB1WCElN0U1ELUiI9u9OSHMQwHRBTn.Se4XqU6ff1tNUR18qFqC', 'manager', 'ENG', NULL, NULL, '2026-04-07 02:08:58', '2026-04-07 02:08:58', NULL),
(17, 'Henria Yarmufa', 'ria@pinjammobil.com', NULL, '$2y$12$OAP4LpD0Prt4Qf1rkW85UuZCsaXpqhPFT061QrunbpkqUtF0GrKxK', 'employee', 'PUR', NULL, NULL, '2026-04-07 02:10:58', '2026-04-07 02:10:58', 8),
(18, 'Vidi', 'vidi@pinjammobil.com', NULL, '$2y$12$65Oe46nH0x7bSY7QK8SzFuyrOQlwbbperBMQAfnG2lBJwfX3L/wT.', 'employee', 'HR', NULL, NULL, '2026-04-07 02:11:53', '2026-04-07 19:10:17', 8),
(19, 'Angela Aju Utama', 'angela@pinjammobil.com', NULL, '$2y$12$oWG6gkoGxUCXhOJkbT4awe5LZzKBWRl.bJiopkcwIVrOdm3iflMKq', 'manager', 'MKT', NULL, NULL, '2026-04-07 21:33:22', '2026-04-07 21:33:22', NULL),
(20, 'Niki', 'niki@pinjammobil.com', NULL, '$2y$12$Jo4ixc9JhM9cvHlvEI0TgO9486aokwkdiNZhPyHmRJqzWD1Ft2WgC', 'manager', 'DEV', NULL, NULL, '2026-04-07 21:34:15', '2026-04-07 21:34:15', NULL),
(21, 'Fandyanto', 'fandyanto@pinjammobil.com', NULL, '$2y$12$3LsDhXJEO.tsCBy4kq3n0OTQe7t1HBnONHX8..ABI51wuNuUYYkLe', 'manager', 'CM', NULL, NULL, '2026-04-07 21:35:18', '2026-04-07 21:35:18', NULL),
(22, 'Anastasia', 'ana@pinjammobil.com', NULL, '$2y$12$Xib98.CBu/SUBGHI23KJBOZTaRX/9qloQBamd7lo7HZEwFgzcnHtO', 'employee', 'CM', NULL, NULL, '2026-04-07 21:35:45', '2026-04-07 21:35:45', 21),
(23, 'deddy irawan', 'deddy@pinjammobil.com', NULL, '$2y$12$.EPFE6uKmLiknS4qdqtkFu8.TPSE1fr6gIuXrwTjeX3x.NJ/Ammnu', 'employee', 'HR', NULL, 'tYlRSJV7ls8q992XZLe0QqBuPMDLzxx7pXNP1ivTCqwLagwiglrBAyUjaRIE', '2026-04-08 20:05:01', '2026-04-08 20:05:01', 8),
(24, 'Dian Rahmawati', 'dianr@pinjammobil.com', NULL, '$2y$12$NhS07ONhSKcCIJ.v6BRH9upFP//.gLvAk61eJhUdppIjWRByAd2r6', 'manager', 'LGL', NULL, NULL, '2026-04-14 23:39:56', '2026-04-14 23:39:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plate_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('car','van','truck','motorcycle') COLLATE utf8mb4_unicode_ci NOT NULL,
  `condition` enum('good','needs_maintenance','unavailable') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'good',
  `availability` enum('available','in_use','maintenance') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'available',
  `driver_id` bigint UNSIGNED DEFAULT NULL,
  `current_kilometer` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `name`, `plate_number`, `type`, `condition`, `availability`, `driver_id`, `current_kilometer`, `created_at`, `updated_at`) VALUES
(9, 'Isuzu Phanter', 'B 8452 BY', 'car', 'good', 'available', 6, 156458.00, '2026-04-07 01:01:21', '2026-04-15 23:44:59'),
(10, 'Avanza Silver', 'B 8325 B', 'car', 'good', 'available', 11, 143093.00, '2026-04-07 01:01:47', '2026-04-15 23:49:14'),
(11, 'Avanza Hitam', 'B 8519 B', 'car', 'good', 'available', 5, 152726.00, '2026-04-07 01:02:02', '2026-04-15 23:04:35'),
(12, 'Innova', 'B 1116 UII', 'car', 'good', 'available', 5, 44560.00, '2026-04-07 01:02:20', '2026-04-15 23:39:21'),
(13, 'Pickup', 'B 9365 JD', 'van', 'good', 'available', 6, 54977.00, '2026-04-07 02:39:59', '2026-04-15 23:42:21');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_requests`
--

CREATE TABLE `vehicle_requests` (
  `id` bigint UNSIGNED NOT NULL,
  `borrower_id` bigint UNSIGNED NOT NULL,
  `vehicle_id` bigint UNSIGNED DEFAULT NULL,
  `driver_id` bigint UNSIGNED DEFAULT NULL,
  `destination` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purpose` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime NOT NULL,
  `status` enum('pending','manager_approved','manager_rejected','admin_approved','admin_rejected','in_progress','completed','driver_cancelled') COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `manager_notes` text COLLATE utf8mb4_unicode_ci,
  `supervisor_notes` text COLLATE utf8mb4_unicode_ci,
  `admin_notes` text COLLATE utf8mb4_unicode_ci,
  `approved_by` bigint UNSIGNED DEFAULT NULL,
  `assigned_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicle_requests`
--

INSERT INTO `vehicle_requests` (`id`, `borrower_id`, `vehicle_id`, `driver_id`, `destination`, `purpose`, `start_datetime`, `end_datetime`, `status`, `manager_notes`, `supervisor_notes`, `admin_notes`, `approved_by`, `assigned_by`, `created_at`, `updated_at`) VALUES
(1, 18, 10, 5, 'APL', 'meeting struktur', '2026-04-16 10:49:00', '2026-04-16 10:52:00', 'completed', NULL, NULL, NULL, 8, 1, '2026-04-15 20:50:01', '2026-04-15 20:52:52'),
(2, 18, 12, 5, 'Sency', 'belanja ngabisin duit', '2026-04-16 12:03:00', '2026-04-16 16:07:00', 'completed', 'jangan lama lama', NULL, NULL, 8, 1, '2026-04-15 21:02:37', '2026-04-15 21:04:42'),
(3, 8, NULL, NULL, 'GBK', 'Nonton bola', '2026-04-16 11:06:00', '2026-04-16 15:00:00', 'admin_rejected', NULL, NULL, 'test', 8, 1, '2026-04-15 21:06:22', '2026-04-15 22:03:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departments_name_unique` (`name`),
  ADD UNIQUE KEY `departments_code_unique` (`code`),
  ADD KEY `departments_manager_id_foreign` (`manager_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fuel_attachments`
--
ALTER TABLE `fuel_attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fuel_attachments_fuel_record_id_foreign` (`fuel_record_id`);

--
-- Indexes for table `fuel_records`
--
ALTER TABLE `fuel_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fuel_records_vehicle_id_foreign` (`vehicle_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `usage_records`
--
ALTER TABLE `usage_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usage_records_request_id_foreign` (`request_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_manager_id_foreign` (`manager_id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vehicles_plate_number_unique` (`plate_number`),
  ADD KEY `vehicles_driver_id_foreign` (`driver_id`);

--
-- Indexes for table `vehicle_requests`
--
ALTER TABLE `vehicle_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicle_requests_borrower_id_foreign` (`borrower_id`),
  ADD KEY `vehicle_requests_vehicle_id_foreign` (`vehicle_id`),
  ADD KEY `vehicle_requests_driver_id_foreign` (`driver_id`),
  ADD KEY `vehicle_requests_approved_by_foreign` (`approved_by`),
  ADD KEY `vehicle_requests_assigned_by_foreign` (`assigned_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fuel_attachments`
--
ALTER TABLE `fuel_attachments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `fuel_records`
--
ALTER TABLE `fuel_records`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `usage_records`
--
ALTER TABLE `usage_records`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `vehicle_requests`
--
ALTER TABLE `vehicle_requests`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_manager_id_foreign` FOREIGN KEY (`manager_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `fuel_attachments`
--
ALTER TABLE `fuel_attachments`
  ADD CONSTRAINT `fuel_attachments_fuel_record_id_foreign` FOREIGN KEY (`fuel_record_id`) REFERENCES `fuel_records` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `fuel_records`
--
ALTER TABLE `fuel_records`
  ADD CONSTRAINT `fuel_records_vehicle_id_foreign` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `usage_records`
--
ALTER TABLE `usage_records`
  ADD CONSTRAINT `usage_records_request_id_foreign` FOREIGN KEY (`request_id`) REFERENCES `vehicle_requests` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_manager_id_foreign` FOREIGN KEY (`manager_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `vehicles_driver_id_foreign` FOREIGN KEY (`driver_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `vehicle_requests`
--
ALTER TABLE `vehicle_requests`
  ADD CONSTRAINT `vehicle_requests_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `vehicle_requests_assigned_by_foreign` FOREIGN KEY (`assigned_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `vehicle_requests_borrower_id_foreign` FOREIGN KEY (`borrower_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vehicle_requests_driver_id_foreign` FOREIGN KEY (`driver_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `vehicle_requests_vehicle_id_foreign` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

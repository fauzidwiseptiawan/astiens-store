-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2024 at 04:04 AM
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
-- Database: `db_astiens`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` text DEFAULT NULL,
  `ext` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `is_active` enum('0','1') NOT NULL DEFAULT '1',
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `name`, `slug`, `image`, `ext`, `size`, `is_active`, `is_deleted`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 'Addidas', 'addidas', '1722336646_e3tZctFJ6es65oGghS6D6RfXpUvQxf462DztXXc0.jpg', 'png', '5975', '1', '0', '2024-07-30 10:50:48', '1', NULL, NULL, NULL, NULL),
(2, 'Alosa', 'alosa', '1722336724_WJBdI8ruL06tYFHNyuhCUoSSmp0fwLY0THnzmeht.jpg', 'png', '7902', '1', '0', '2024-07-30 10:59:52', '1', '2024-07-30 10:59:52', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `position_order` tinyint(4) NOT NULL,
  `meta` varchar(255) DEFAULT NULL,
  `meta_desc` text DEFAULT NULL,
  `image` text NOT NULL,
  `ext` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `is_active` enum('0','1') NOT NULL DEFAULT '1',
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `slug`, `position_order`, `meta`, `meta_desc`, `image`, `ext`, `size`, `is_active`, `is_deleted`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 'Women Clothing & Fashion', 'women-clothing-&-fashion', 1, 'Women Clothing & Fashion', 'Women Clothing & Fashion', '1721930470_V7PbqhwELyJdDKTvtJq55KxmHhU1TCNN7XU2excd.jpg', 'jpg', '55349', '1', '0', '2024-07-29 14:38:24', '1', '2024-07-29 14:38:24', '1', NULL, NULL),
(2, 'Men Clothing & Fashion', 'men-clothing-&-fashion', 2, 'Men Clothing & Fashion', 'Men Clothing & Fashion', '1722257012_Ym3yGeRLTv9BHctDMcFTCcuD78XKGweLZkALtjoz.jpg', 'jpg', '59260', '1', '0', '2024-07-29 14:38:28', '1', '2024-07-29 14:38:28', '1', NULL, NULL),
(3, 'Computer & Accessories', 'computer-&-accessories', 3, 'Computer & Accessories', 'Computer & Accessories', '1722332711_PsRGATwFM8B8Wp4DuKoLprC7JEQ40S9hPVU4L1JE.jpg', 'jpg', '39184', '1', '0', '2024-07-30 09:45:13', '1', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_user_table', 1),
(2, '2024_07_21_102311_create_category_table', 1),
(3, '2024_07_21_102357_create_sub_category_table', 1),
(4, '2024_07_21_102416_create_brand_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('UmQBWGB9mqLsTthtav1FM1QHr9LCjKtA1apdxfRs', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiR2NjdXE5UWFIUndNTHlYdTB3dGJ4NUJCOW1tMmJKQUNnWVR0MVJpOSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wYW5lbC9hZG1pbi9icmFuZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1722337192);

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `is_active` enum('0','1') NOT NULL DEFAULT '1',
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`id`, `category_id`, `name`, `slug`, `is_active`, `is_deleted`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 1, 'Pakaian Anak Balita', 'pakaian-anak-balita', '1', '0', '2024-07-30 10:30:53', '1', '2024-07-30 10:27:01', '1', NULL, NULL),
(2, 2, 'Pakaian Pria Dewasa', 'pakaian-pria-dewasa', '1', '0', '2024-07-30 09:39:52', '1', NULL, NULL, NULL, NULL),
(3, 1, 'Pakaian Wanita', 'pakaian-wanita', '1', '0', '2024-07-30 10:30:52', '1', NULL, '1', NULL, NULL),
(4, 3, 'Keyboard', 'keyboard', '1', '0', '2024-07-30 09:45:43', '1', NULL, NULL, NULL, NULL),
(5, 3, 'Mouse Gaming', 'mouse-gaming', '1', '0', '2024-07-30 09:46:47', '1', NULL, NULL, NULL, NULL),
(6, 3, 'Monitor', 'monitor', '1', '0', '2024-07-30 09:47:25', '1', NULL, NULL, NULL, NULL),
(7, 3, 'Motherboard', 'motherboard', '1', '0', '2024-07-30 09:49:48', '1', NULL, NULL, NULL, NULL),
(8, 3, 'VGA', 'vga', '1', '0', '2024-07-30 09:51:26', '1', NULL, NULL, NULL, NULL),
(9, 3, 'RAM', 'ram', '1', '0', '2024-07-30 09:52:28', '1', NULL, NULL, NULL, NULL),
(10, 3, 'Mousepad', 'mousepad', '1', '0', '2024-07-30 09:53:17', '1', NULL, NULL, NULL, NULL),
(11, 3, 'Holder Laptop', 'holder-laptop', '1', '0', '2024-07-30 09:54:59', '1', NULL, NULL, NULL, NULL),
(12, 2, '123', '123', '1', '1', '2024-07-30 10:31:21', '1', '2024-07-30 10:31:21', NULL, NULL, '1'),
(13, 2, '123123', '123123', '1', '1', '2024-07-30 10:31:56', '1', '2024-07-30 10:31:56', NULL, NULL, '1'),
(14, 2, '3213123', '3213123', '1', '1', '2024-07-30 10:31:56', '1', '2024-07-30 10:31:56', NULL, NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` enum('0','1') NOT NULL DEFAULT '1',
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `email_verified_at`, `password`, `is_active`, `is_deleted`, `remember_token`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$12$cSQIWi7alzDK1onxvVBfz.XEZPiDM.QWNwei2SDudof2U7pkTgGpC', '1', '0', NULL, '2024-07-25 17:51:15', NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brand_name_unique` (`name`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_name_unique` (`name`),
  ADD UNIQUE KEY `category_slug_unique` (`slug`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sub_category_name_unique` (`name`),
  ADD UNIQUE KEY `sub_category_slug_unique` (`slug`),
  ADD KEY `sub_category_category_id_foreign` (`category_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD CONSTRAINT `sub_category_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

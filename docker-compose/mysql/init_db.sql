-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 17, 2021 at 09:14 PM
-- Server version: 5.7.33-0ubuntu0.18.04.1
-- PHP Version: 7.2.34-18+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fleet`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_04_15_104109_create_trips_table', 1),
(5, '2021_04_15_104128_create_stations_table', 1),
(6, '2021_04_15_104232_create_station_trip_table', 1),
(7, '2021_04_15_105122_create_trip_user_table', 1),
(8, '2032_04_15_104636_create_foreign_keys', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stations`
--

CREATE TABLE `stations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stations`
--

INSERT INTO `stations` (`id`, `name`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'Cairo', 'Curabitur aliquet quam id dui posuere blandit. Donec rutrum congue leo eget malesuada. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Nulla quis lorem ut libero malesuada feugiat.', '2021-04-16 10:43:53', '2021-04-16 11:14:02'),
(2, 'Al Minya', 'Donec rutrum congue leo eget malesuada. Proin eget tortor risus. Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.', '2021-04-16 10:44:39', '2021-04-16 11:13:45'),
(3, 'Al Fayoum', 'Cras ultricies ligula sed magna dictum porta. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Nulla quis lorem ut libero malesuada feugiat.', '2021-04-16 10:44:51', '2021-04-16 11:13:29'),
(4, 'Asyut', 'Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Sed porttitor lectus nibh.', '2021-04-16 10:45:17', '2021-04-16 11:13:11'),
(5, 'Giza', 'Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque velit nisi, pretium ut lacinia in, elementum id enim.', '2021-04-16 10:46:37', '2021-04-16 11:12:54');

-- --------------------------------------------------------

--
-- Table structure for table `station_trip`
--

CREATE TABLE `station_trip` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `trip_id` bigint(20) UNSIGNED NOT NULL,
  `station_id` bigint(20) UNSIGNED NOT NULL,
  `stop_order` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `station_trip`
--

INSERT INTO `station_trip` (`id`, `created_at`, `updated_at`, `trip_id`, `station_id`, `stop_order`) VALUES
(2, NULL, NULL, 1, 2, 2),
(3, NULL, NULL, 1, 3, 3),
(5, NULL, NULL, 1, 5, 5),
(8, NULL, NULL, 1, 1, 1),
(10, NULL, NULL, 2, 5, 2),
(11, NULL, NULL, 2, 4, 2),
(12, NULL, NULL, 2, 2, 4),
(13, NULL, NULL, 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `trips`
--

CREATE TABLE `trips` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trip_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trips`
--

INSERT INTO `trips` (`id`, `name`, `trip_time`, `created_at`, `updated_at`) VALUES
(1, 'Cairo - Asyut', '2021-04-17 13:07:45', '2021-04-16 10:55:16', '2021-04-17 11:07:45'),
(2, 'Menouf -Tanta', '2021-04-16 23:08:12', '2021-04-16 21:08:12', '2021-04-16 21:08:12');

-- --------------------------------------------------------

--
-- Table structure for table `trip_user`
--

CREATE TABLE `trip_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `seat_number` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `trip_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `pickup_station_id` bigint(20) UNSIGNED NOT NULL,
  `arrival_station_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trip_user`
--

INSERT INTO `trip_user` (`id`, `seat_number`, `created_at`, `updated_at`, `trip_id`, `user_id`, `pickup_station_id`, `arrival_station_id`) VALUES
(14, 1, NULL, NULL, 1, 29, 3, 5),
(15, 1, NULL, NULL, 2, 1, 5, 4),
(16, 3, NULL, NULL, 2, 36, 5, 2),
(18, 2, NULL, NULL, 2, 52, 5, 2),
(19, 4, NULL, NULL, 2, 54, 5, 4),
(20, 1, NULL, NULL, 2, 53, 1, 5),
(23, 5, NULL, NULL, 2, 50, 1, 4),
(26, 2, NULL, NULL, 1, 1, 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','normal') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'normal',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Nady Shalaby', 'admin@gmail.com', 'admin', NULL, '$2y$10$AcjJhhyuY46Ev83zs.4.G.PuqBZm0b7VhvsmNbo2dpmulr0QjRXJW', 've9ffSexVfLjVGQ4ZBgGIp50NuXYy3HeWkQdwDifq1jfAgVpFpOzNIQCCVwB', '2021-04-15 10:22:35', '2021-04-17 10:49:37'),
(5, 'Miss Hailie Murray MD', 'towne.axel@example.org', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '7c0An2vURw', '2021-04-17 06:06:50', '2021-04-17 06:06:50'),
(6, 'Mark Luettgen', 'mlynch@example.net', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'ljpG87CU02', '2021-04-17 06:06:50', '2021-04-17 06:06:50'),
(7, 'Brandi Hane', 'marlee50@example.net', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'FWY2r07BE3', '2021-04-17 06:06:50', '2021-04-17 06:06:50'),
(8, 'Noelia Lind', 'gilbert84@example.org', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'zioNHmtNtv', '2021-04-17 06:06:50', '2021-04-17 06:06:50'),
(9, 'Kieran Huels I', 'grady.armani@example.com', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'oNacxIR1da', '2021-04-17 06:06:50', '2021-04-17 06:06:50'),
(10, 'Meda Bernier', 'dagmar34@example.net', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'ngY1RzHtFp', '2021-04-17 06:06:50', '2021-04-17 06:06:50'),
(11, 'Chelsey Funk', 'lavern.brakus@example.com', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'LRklutZUtz', '2021-04-17 06:06:50', '2021-04-17 06:06:50'),
(12, 'Florence Kulas', 'rolfson.rickie@example.com', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'qoq50bU3ql', '2021-04-17 06:06:50', '2021-04-17 06:06:50'),
(13, 'Damien Mayert', 'kaia.durgan@example.net', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'iH9yeCO7Sq', '2021-04-17 06:06:50', '2021-04-17 06:06:50'),
(14, 'Tanner Blanda', 'susan76@example.com', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'gEde4Gv849', '2021-04-17 06:06:50', '2021-04-17 06:06:50'),
(15, 'Stefan Haley', 'blaise.klocko@example.com', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'ITmaems18T', '2021-04-17 06:06:50', '2021-04-17 06:06:50'),
(16, 'Prof. Casper Harris', 'winston24@example.com', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'BQv4nVBDz9', '2021-04-17 06:06:50', '2021-04-17 06:06:50'),
(17, 'Ardella Sporer', 'wdach@example.net', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'acamLrLUpt', '2021-04-17 06:06:50', '2021-04-17 06:06:50'),
(18, 'Aglae Okuneva', 'orobel@example.com', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'pgA2mLan5g', '2021-04-17 06:06:50', '2021-04-17 06:06:50'),
(19, 'Miss Lysanne Torp', 'boyer.daren@example.com', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'XPyavlHAn1', '2021-04-17 06:06:50', '2021-04-17 06:06:50'),
(20, 'Daija Morissette', 'frami.melody@example.org', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'uUVDoiugq3', '2021-04-17 06:06:50', '2021-04-17 06:06:50'),
(21, 'Gunner Osinski', 'ebeahan@example.com', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Z6EGrAVziG', '2021-04-17 06:06:50', '2021-04-17 06:06:50'),
(22, 'Rowena Moen', 'emerald.fadel@example.org', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'NOz1T6tq38', '2021-04-17 06:06:51', '2021-04-17 06:06:51'),
(23, 'Jon Spinka', 'susie00@example.org', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'pW1b8KiFri', '2021-04-17 06:06:51', '2021-04-17 06:06:51'),
(24, 'Otis Vandervort', 'oconnell.estrella@example.com', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Dd2C2cU2CZ', '2021-04-17 06:06:51', '2021-04-17 06:06:51'),
(25, 'Mrs. Lysanne Marquardt', 'aaron75@example.com', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '6W7u1IAQa2', '2021-04-17 06:06:51', '2021-04-17 06:06:51'),
(26, 'Adelbert Kulas', 'janiya30@example.com', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'lggeU4407n', '2021-04-17 06:06:51', '2021-04-17 06:06:51'),
(27, 'Maiya Thompson', 'cydney.prosacco@example.com', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Xn16lfP742', '2021-04-17 06:06:51', '2021-04-17 06:06:51'),
(28, 'Ignacio Schmeler III', 'bradtke.georgiana@example.com', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'C9wZYM16ch', '2021-04-17 06:06:51', '2021-04-17 06:06:51'),
(29, 'Fidel West', 'zbosco@example.org', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'YUaYH8TDHI', '2021-04-17 06:06:51', '2021-04-17 06:06:51'),
(30, 'Donna Waters', 'kathlyn.robel@example.org', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'qiD0rRO9NL', '2021-04-17 06:06:51', '2021-04-17 06:06:51'),
(31, 'Shanny Luettgen', 'jermaine.zieme@example.net', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'H6T3mBrzXw', '2021-04-17 06:06:51', '2021-04-17 06:06:51'),
(32, 'Gwendolyn Treutel', 'zackery82@example.org', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'ntzGAOlilR', '2021-04-17 06:06:51', '2021-04-17 06:06:51'),
(33, 'Patrick Stroman', 'lfahey@example.org', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'ORPOA2Du4V', '2021-04-17 06:06:51', '2021-04-17 06:06:51'),
(34, 'Nicholaus Schmeler Sr.', 'velda.abshire@example.net', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2cME26e0Zb', '2021-04-17 06:06:51', '2021-04-17 06:06:51'),
(35, 'Brody Zulauf DVM', 'tbrekke@example.net', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1OWvOrvRxT', '2021-04-17 06:06:52', '2021-04-17 06:06:52'),
(36, 'Zoe Marvin', 'cruickshank.ahmad@example.org', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'i3NJgEBePq', '2021-04-17 06:06:52', '2021-04-17 06:06:52'),
(37, 'Omer Gorczany', 'brakus.terrell@example.com', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'k3NI25omNd', '2021-04-17 06:06:52', '2021-04-17 06:06:52'),
(38, 'Jason Kulas', 'vjohnson@example.net', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '7cNOhaz6Cn', '2021-04-17 06:06:52', '2021-04-17 06:06:52'),
(39, 'Mr. Sidney Kassulke', 'lang.norris@example.com', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'pHkvAAFH9N', '2021-04-17 06:06:52', '2021-04-17 06:06:52'),
(40, 'Milo Torp', 'patience.labadie@example.net', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '8H5SEpZNWI', '2021-04-17 06:06:52', '2021-04-17 06:06:52'),
(41, 'Ms. Clarabelle Lind', 'berniece.sipes@example.org', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'MjavlF5UsQ', '2021-04-17 06:06:52', '2021-04-17 06:06:52'),
(42, 'Myles Pfeffer', 'lchamplin@example.org', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'IDy2CpK0VG', '2021-04-17 06:06:52', '2021-04-17 06:06:52'),
(43, 'Alexandro Hermann', 'amalia.kilback@example.net', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'hfhURoQEtz', '2021-04-17 06:06:52', '2021-04-17 06:06:52'),
(44, 'Donald Carter', 'milan.bartell@example.com', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'fKbWgpngcS', '2021-04-17 06:06:52', '2021-04-17 06:06:52'),
(45, 'Kenya Beer', 'myrna.boehm@example.net', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '42uheKzyyg', '2021-04-17 06:06:52', '2021-04-17 06:06:52'),
(46, 'Branson Murazik DVM', 'kilback.delphine@example.com', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Y0PVxKkOoX', '2021-04-17 06:06:52', '2021-04-17 06:06:52'),
(47, 'Asa Ward', 'gaylord.maribel@example.org', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'dZSbcKVRZo', '2021-04-17 06:06:52', '2021-04-17 06:06:52'),
(48, 'Mrs. Arlie Collier V', 'blanche.ernser@example.net', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'tQ57yVOVBZ', '2021-04-17 06:06:52', '2021-04-17 06:06:52'),
(49, 'Audreanne Keeling', 'wintheiser.lafayette@example.net', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'FfqixVjSeo', '2021-04-17 06:06:52', '2021-04-17 06:06:52'),
(50, 'Kelton McClure', 'hwuckert@example.com', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'RIVKInHReG', '2021-04-17 06:06:52', '2021-04-17 06:06:52'),
(51, 'Mrs. Eudora Schroeder', 'ruth.koss@example.net', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'FBX0O2dIAF', '2021-04-17 06:06:52', '2021-04-17 06:06:52'),
(52, 'Miss Elyssa Zieme', 'ora.reilly@example.org', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'DyVt4d1I8J', '2021-04-17 06:06:52', '2021-04-17 06:06:52'),
(53, 'Harmon Macejkovic', 'braun.jonathon@example.com', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'RiFnQ7ezut', '2021-04-17 06:06:52', '2021-04-17 06:06:52'),
(54, 'Samir Christiansen', 'normal@gmail.com', 'normal', '2021-04-17 06:06:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'GYWqjmfkvZn9Ejkafpm7hGsLiVHZ8fpI9xAIMXYXqvHaGTQ1kPdibjRyht8L', '2021-04-17 06:06:52', '2021-04-17 10:45:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `stations`
--
ALTER TABLE `stations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `station_trip`
--
ALTER TABLE `station_trip`
  ADD PRIMARY KEY (`id`),
  ADD KEY `station_trip_trip_id_foreign` (`trip_id`),
  ADD KEY `station_trip_station_id_foreign` (`station_id`);

--
-- Indexes for table `trips`
--
ALTER TABLE `trips`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trip_user`
--
ALTER TABLE `trip_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trip_user_trip_id_foreign` (`trip_id`),
  ADD KEY `trip_user_user_id_foreign` (`user_id`),
  ADD KEY `trip_user_pickup_station_id_foreign` (`pickup_station_id`),
  ADD KEY `trip_user_arrival_station_id_foreign` (`arrival_station_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `stations`
--
ALTER TABLE `stations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `station_trip`
--
ALTER TABLE `station_trip`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `trips`
--
ALTER TABLE `trips`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `trip_user`
--
ALTER TABLE `trip_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `station_trip`
--
ALTER TABLE `station_trip`
  ADD CONSTRAINT `station_trip_station_id_foreign` FOREIGN KEY (`station_id`) REFERENCES `stations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `station_trip_trip_id_foreign` FOREIGN KEY (`trip_id`) REFERENCES `trips` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `trip_user`
--
ALTER TABLE `trip_user`
  ADD CONSTRAINT `trip_user_arrival_station_id_foreign` FOREIGN KEY (`arrival_station_id`) REFERENCES `stations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trip_user_pickup_station_id_foreign` FOREIGN KEY (`pickup_station_id`) REFERENCES `stations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trip_user_trip_id_foreign` FOREIGN KEY (`trip_id`) REFERENCES `trips` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trip_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

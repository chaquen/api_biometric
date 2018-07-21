-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2018 at 07:20 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ong`
--

-- --------------------------------------------------------

--
-- Table structure for table `detalle_huellas`
--

CREATE TABLE `detalle_huellas` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `dedo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `huella_binaria` blob NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detalle_participantes`
--

CREATE TABLE `detalle_participantes` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `event_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `eventos`
--

CREATE TABLE `eventos` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_ref` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `city` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `atachments` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state` tinyint(1) NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `eventos`
--

INSERT INTO `eventos` (`id`, `id_ref`, `name`, `description`, `date`, `city`, `address`, `atachments`, `state`, `img`, `created_at`, `updated_at`) VALUES
(1, 45, 'Test 2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor i', '2018-05-03 15:34:28', 'Bogotá, Colombia', 'Calle 127 cr 57', 'none', 0, 'main_img.png', NULL, NULL),
(2, 45, 'Evento test', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor i', '2018-05-03 15:31:44', 'La Dorada, Caldas, Colombia', 'Cr 14-15', '1525379656pdf_example.pdf', 0, '376.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2018_05_14_015149_create_eventos_table', 1),
('2018_05_14_141803_create_participantes_table', 1),
('2018_05_14_142407_create_detalle_participantes_table', 1),
('2018_05_30_042356_create_detalle_huellas_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `participantes`
--

CREATE TABLE `participantes` (
  `id` int(10) UNSIGNED NOT NULL,
  `tipo_doc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `documento` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lugar_exp` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pri_apellido` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seg_apellido` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pri_nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seg_nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ciud_nacimiento` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dep_nacimiento` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_nac` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `genero` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cap_dife` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `etnia` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zona` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `municipio` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `celular` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `escolaridad` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `titulo_obt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `proceso` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `organizacion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `participantes`
--

INSERT INTO `participantes` (`id`, `tipo_doc`, `documento`, `lugar_exp`, `pri_apellido`, `seg_apellido`, `pri_nombre`, `seg_nombre`, `ciud_nacimiento`, `dep_nacimiento`, `fecha_nac`, `genero`, `cap_dife`, `etnia`, `zona`, `municipio`, `celular`, `email`, `escolaridad`, `titulo_obt`, `proceso`, `organizacion`, `state`, `created_at`, `updated_at`) VALUES
(1, 'CC', '1', '1', '1', '1', '1', '1', '1', '1', '0001-01-01', 'Hombre', '1', '1', '1', '1', '1', '1', 'Primaria', '1', '1', '1', 0, NULL, NULL),
(2, 'CC', '2', '2', '2', '2', '2', '2', '2', '2', '0002-02-02', 'Hombre', '2', '2', '2', '2', '2', '2', 'Primaria', '2', '2', '2', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state` tinyint(1) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `lastname`, `pass`, `state`, `email`, `remember_token`, `created_at`, `updated_at`) VALUES
(45, 'Test 1 coordinador', 'No borrar', '8bANA9yfZH', 0, 'amora094@gmail.com', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detalle_huellas`
--
ALTER TABLE `detalle_huellas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalle_huellas_user_id_foreign` (`user_id`);

--
-- Indexes for table `detalle_participantes`
--
ALTER TABLE `detalle_participantes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalle_participantes_user_id_foreign` (`user_id`),
  ADD KEY `detalle_participantes_event_id_foreign` (`event_id`);

--
-- Indexes for table `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `eventos_id_ref_foreign` (`id_ref`);

--
-- Indexes for table `participantes`
--
ALTER TABLE `participantes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detalle_huellas`
--
ALTER TABLE `detalle_huellas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detalle_participantes`
--
ALTER TABLE `detalle_participantes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `participantes`
--
ALTER TABLE `participantes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detalle_huellas`
--
ALTER TABLE `detalle_huellas`
  ADD CONSTRAINT `detalle_huellas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `participantes` (`id`);

--
-- Constraints for table `detalle_participantes`
--
ALTER TABLE `detalle_participantes`
  ADD CONSTRAINT `detalle_participantes_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `eventos` (`id`),
  ADD CONSTRAINT `detalle_participantes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `participantes` (`id`);

--
-- Constraints for table `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `eventos_id_ref_foreign` FOREIGN KEY (`id_ref`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

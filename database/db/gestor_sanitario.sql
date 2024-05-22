-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 22, 2024 at 01:39 PM
-- Server version: 8.2.0
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


-- --------------------------------------------------------

--
-- Table structure for table `administrators`
--

DROP TABLE IF EXISTS `administrators`;
CREATE TABLE IF NOT EXISTS `administrators` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `administrators`
--



-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
CREATE TABLE IF NOT EXISTS `documents` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  `type` enum('cita','analitica','consulta') NOT NULL,
  `extension` varchar(10) NOT NULL,
  `size` varchar(100) NOT NULL,
  `content` longblob,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `autor` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_gd_sanitarios` (`autor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `drafs`
--

DROP TABLE IF EXISTS `drafs`;
CREATE TABLE IF NOT EXISTS `drafs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT NULL,
  `content` json DEFAULT NULL,
  `user_id` int NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_drafts_users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `requestnotifications`
--

DROP TABLE IF EXISTS `requestnotifications`;
CREATE TABLE IF NOT EXISTS `requestnotifications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(200) CHARACTER SET utf8 NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `request_type` enum('change_password','change_name_user','change_role') NOT NULL,
  `emisor` int NOT NULL,
  `destinatary` int NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `status` enum('pendiente','proceso','aprobado','denegado') CHARACTER SET utf8 NOT NULL DEFAULT 'pendiente',
  `rubbised` enum('0','1') CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `viewed` enum('0','1') CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `updated_at` datetime DEFAULT NULL,
  `_token` text,
  PRIMARY KEY (`id`),
  KEY `fk_requestnotifications_administrators` (`destinatary`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `requestnotifications`
--



-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(50) NOT NULL,
  `user_agent` varchar(200) NOT NULL,
  `login_time` datetime DEFAULT NULL,
  `logout_time` datetime DEFAULT NULL,
  `user_id` int NOT NULL,
  `status` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_session_users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sessions`
--



-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `colegiate` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `phone` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `role` enum('staff','medico','user','enfermero') NOT NULL,
  `activated` enum('0','1') NOT NULL DEFAULT '0',
  `remember_token` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `session_id` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `email_verified_at`, `created_at`, `updated_at`, `colegiate`, `phone`, `role`, `activated`, `remember_token`, `session_id`) VALUES
(2, 'dani', 'YWRtaW4xMjM=', 'dani@gestor.com', '2024-05-20 18:03:53', '2024-05-15 12:14:02', '2024-05-22 11:28:28', NULL, '696294856', 'staff', '1', 'lGjhPjFUz5PlULj4j71YNdCiNuMYpCZySOoOnPJiL7OrzwNE8vOvglm9poK4', 'gcRUV5UT6vQVV3EFAcfMh9erAcESEMcw70hsVzXQ'),
(12, 'ivan gonzalez valles', 'YWRtaW4xMjM=', 'ivanartista96@gmail.com', '2024-05-22 09:53:29', '2024-05-20 17:41:31', '2024-05-22 11:41:29', NULL, '657203570', 'staff', '1', 'px5La5tfsg2LMtV0gIxu5U7QDEYojhonHazqAx46TOlJYCo0YKnSaMf57siJ', 'fR9fxQv1W8ObB16SKqvyQIJOOnoPVtNAKXwKc9oJ'),
(13, 'ivan gonzalez valles', 'QWRtaW4xMjM0KiE=', 'ivan.web.developer.96@gmail.com', '2024-05-21 08:17:15', '2024-05-21 08:15:27', '2024-05-22 11:38:14', NULL, '657203570', 'user', '1', 'bnDUmapFBWqgkQP1lAH3TBqCKxtXeMtbUwXUry3UprwvnceVChCgIGcTBUan', 'ZZBR8ThZVVFmVG55J1jCuzPvv72XXPlorjYJsD3f'),
(14, 'andrei', 'YWRtaW4xMjM=', 'andreipopa0783@gmail.com', '2024-05-21 17:29:34', '2024-05-21 17:29:17', '2024-05-21 17:29:34', NULL, NULL, 'user', '1', NULL, NULL);

INSERT INTO `administrators` (`id`, `name`, `email`, `created_at`, `updated_at`) VALUES
(2, 'dani', 'dani@gestor.com', '2024-05-20 17:35:39', '2024-05-20 17:35:39'),
(12, 'ivan gonzalez valles', 'ivanartista96@gmail.com', '2024-05-20 15:41:31', '2024-05-20 15:41:31');

INSERT INTO `sessions` (`id`, `ip_address`, `user_agent`, `login_time`, `logout_time`, `user_id`, `status`) VALUES
(1, '127.0.0.1', '0Pi8MkzEBOndha1XJ6VD9BTjgJ0OdpCKmUNPGYMp', '2024-05-15 10:15:50', '2024-05-15 10:16:23', 2, '1'),
(2, '127.0.0.1', '6VWV7FtH9E7XT3Jg12wrKUdrsdriyY54mdGHksd1', NULL, '2024-05-15 17:33:50', 2, '0'),
(3, '127.0.0.1', '6VWV7FtH9E7XT3Jg12wrKUdrsdriyY54mdGHksd1', '2024-05-15 10:35:42', '2024-05-15 17:33:50', 2, '1'),
(4, '127.0.0.1', '58HZW2Sh1auyHZaH4rRA5yLVeF6DPoM61IpsK1YS', '2024-05-15 17:33:57', '2024-05-16 09:06:44', 2, '1'),
(5, '127.0.0.1', 'W8isSwbPQcznmyXruoCL6w0LWWfX3NJpyfzwECex', '2024-05-16 09:11:41', '2024-05-16 09:30:40', 2, '1'),
(16, '127.0.0.1', 'MjI3XnGphenJ9gk3AkKsH4ofD2VuBmETvSfyoKEC', '2024-05-16 12:01:19', NULL, 2, '1'),
(17, '127.0.0.1', '7UTvuoZl0gHlotrdy5vgyYCzFeM8dmM80uCVEAMc', '2024-05-16 12:01:37', '2024-05-16 12:03:04', 2, '1'),
(18, '127.0.0.1', '5cUUMvti9pwdXJxR8Wt8lzsqKdOLBNDpDYXR8dN1', '2024-05-16 12:03:10', '2024-05-16 12:03:12', 2, '1'),
(19, '127.0.0.1', '4A39J9iluUpxDICwpLVmF5edOBFyEoWLLDjh8DpN', '2024-05-16 12:03:21', '2024-05-16 12:04:21', 2, '1'),
(20, '127.0.0.1', 'zC2tGj9JaqCywGh7TOgi19ZZEEccvLDl6a0NUZka', NULL, NULL, 2, '0'),
(21, '127.0.0.1', 'zC2tGj9JaqCywGh7TOgi19ZZEEccvLDl6a0NUZka', '2024-05-16 12:04:54', NULL, 2, '1'),
(22, '127.0.0.1', '8V5gK5t21872YQm0fVbQtmfJrDygVbdkN6ZcVJv0', '2024-05-16 17:42:20', '2024-05-17 06:52:38', 2, '1'),
(23, '127.0.0.1', 'grX0d5deszb7Ans7DSmhD0fV7xmFPnTxu8bjoZRR', '2024-05-17 08:31:35', '2024-05-17 10:04:16', 2, '1'),
(24, '127.0.0.1', 'CmKNyoylx4awoZYR5aDdHI2IMLB3nDyTSoQhdS0n', '2024-05-17 12:01:05', '2024-05-17 12:01:54', 2, '1'),
(25, '127.0.0.1', '3O2bi2ug4UuOkbx6nwYrDsF0Gu4Tdt0lSQK05JzL', '2024-05-17 13:10:00', '2024-05-17 13:11:36', 2, '1'),
(26, '127.0.0.1', 'nSDn7TMTKpxNukeN8viYhzYbnW3hrWYVLrQOXCPf', '2024-05-17 16:48:46', '2024-05-17 16:49:06', 2, '1'),
(27, '127.0.0.1', '6TslGom1oBSHQPAxLyIMtFgs33hJpsfhp1YwkGmg', '2024-05-17 16:50:52', '2024-05-17 16:51:10', 2, '1'),
(28, '127.0.0.1', 'Ws40n2yqTzwcOPpvH5aBYij4xUpbjg14iebhrplS', '2024-05-17 20:09:13', '2024-05-17 20:44:13', 2, '1'),
(29, '127.0.0.1', 'BLwTgcGtmu8u63OFf57h73etKKNSe7LYlbTkxqCj', '2024-05-17 20:49:15', NULL, 2, '1'),
(30, '127.0.0.1', 'JWuEAEDWo7LqXifljMD9unXfkBIIkkAoXfycBcJ3', '2024-05-18 00:31:15', '2024-05-18 00:31:20', 2, '1'),
(31, '127.0.0.1', 'Nn2KHx0mPGVsalS25kkBZ9R0uNpk0eEJIfoQOA6E', '2024-05-18 10:11:05', '2024-05-18 22:24:14', 2, '1'),
(32, '127.0.0.1', 'FOssSOakWF0L7v03n7UPiIeGH4Fysix5xPiLl1Nv', '2024-05-18 22:31:47', NULL, 2, '1'),
(33, '127.0.0.1', 'p6z3xqarZaUzKBNj7VNMsZ493uimYmHzgUYrOP3s', '2024-05-19 09:01:01', '2024-05-19 21:31:12', 2, '1'),
(34, '127.0.0.1', 'mY7ZN6es1VFuujIJvAOhDa72JxGFIIt2lpAnZgZt', '2024-05-19 21:31:25', '2024-05-19 21:41:43', 2, '1'),
(37, '127.0.0.1', 'n0oXZI4G9RWj1BBeWyJokVwemSkygpYzZSNkFfYo', '2024-05-19 22:25:31', NULL, 2, '1'),
(38, '127.0.0.1', 'Ck2MNt2qSnb0wdUknpiiOeT5wFFgztTvtIVyaiS6', '2024-05-19 22:25:40', '2024-05-20 15:28:38', 2, '1'),
(43, '127.0.0.1', 'DhqVJdV8CtY3vUWsFjkR2AHnoZlhkdkJlyYLT8MJ', '2024-05-20 15:37:12', NULL, 2, '1'),
(44, '127.0.0.1', 'WKY92WNzvEcBqooHU8IKzfSjdxyFKhtMTKODqbm2', '2024-05-20 15:39:04', '2024-05-20 15:39:44', 2, '1'),
(46, '127.0.0.1', 'LYMc2CrzIe6JwQM1FfTv2602Qojz6fLMsEOU3465', '2024-05-20 15:44:46', '2024-05-20 15:44:48', 2, '1'),
(48, '127.0.0.1', 'jfDHuL91iZ2cdp5mMZQ7hjt84ixrscWooqzIPFPI', '2024-05-20 15:49:16', '2024-05-20 18:14:16', 2, '1'),
(50, '127.0.0.1', '4qiujmQIy6ys32lDFuQXglugqYgRr5SRbqv2iMmf', NULL, '2024-05-21 08:14:19', 2, '0'),
(51, '127.0.0.1', '4qiujmQIy6ys32lDFuQXglugqYgRr5SRbqv2iMmf', '2024-05-20 21:36:56', '2024-05-21 08:14:19', 2, '1'),
(52, '127.0.0.1', 'uXPHu6DKXpyB2nrck3AGoBdU1XbglL5mjtW5xtKS', NULL, '2024-05-21 08:15:46', 12, '0'),
(53, '127.0.0.1', 'uXPHu6DKXpyB2nrck3AGoBdU1XbglL5mjtW5xtKS', NULL, '2024-05-21 08:15:46', 12, '0'),
(54, '127.0.0.1', 'uXPHu6DKXpyB2nrck3AGoBdU1XbglL5mjtW5xtKS', '2024-05-21 08:14:52', '2024-05-21 08:15:46', 2, '1'),
(55, '127.0.0.1', 'Ir7ixahPuLcIz9WaIv3qzkvFdws1s6ElovHAuc20', NULL, '2024-05-21 08:17:22', 13, '0'),
(56, '127.0.0.1', 'Ir7ixahPuLcIz9WaIv3qzkvFdws1s6ElovHAuc20', NULL, '2024-05-21 08:17:22', 13, '0'),
(57, '127.0.0.1', 'Ir7ixahPuLcIz9WaIv3qzkvFdws1s6ElovHAuc20', '2024-05-21 08:16:27', '2024-05-21 08:17:22', 2, '1'),
(58, '127.0.0.1', 'JXs6xCa2QMmmnfJbgMkk8tlk3CXvnKNpRjNZGNQ7', NULL, '2024-05-21 08:20:40', 12, '0'),
(59, '127.0.0.1', 'JXs6xCa2QMmmnfJbgMkk8tlk3CXvnKNpRjNZGNQ7', '2024-05-21 08:17:43', '2024-05-21 08:20:40', 13, '1'),
(60, '127.0.0.1', 'ZaRsfzsMcQOnatEhLge14Y2v48KmSdYw9Jd5RAwU', '2024-05-21 08:20:51', '2024-05-21 09:09:02', 2, '1'),
(61, '127.0.0.1', 'zPXytmsYG5iZtfkeSxPZxvIbdOOvMiGmSBpRtjeb', '2024-05-21 09:09:46', '2024-05-21 09:12:27', 2, '1'),
(62, '127.0.0.1', 'EtkJOVXYyx7OuvvEDYpjiiTUyiLpGPD2nOWpPeec', '2024-05-21 09:20:16', '2024-05-21 09:20:19', 2, '1'),
(63, '127.0.0.1', 'evFZIGoKRXu6boZqkAbW6valcyTSy2vx6uoeJALk', '2024-05-21 09:22:09', '2024-05-21 09:26:27', 2, '1'),
(64, '127.0.0.1', 'sNVNz8t47FCcKVAuoxVe9WaJHOUKSMFKkcEjH9cs', '2024-05-21 09:26:43', '2024-05-21 09:27:18', 2, '1'),
(65, '127.0.0.1', 'XYpaXIXPOTfDkvpaBgD1jZc3BZ4o8RCnRQGZ7IBd', '2024-05-21 09:27:26', '2024-05-21 09:33:09', 2, '1'),
(66, '127.0.0.1', 'ExO4HE00NwWeyiGCQMm98d2CduU5nVhOq5BCb69H', '2024-05-21 09:41:14', '2024-05-21 09:57:35', 2, '1'),
(67, '127.0.0.1', 'tP9sL8Cz6yWG3JjbalMVcXAmwWYZXWmGXrctXdBc', '2024-05-21 10:32:03', '2024-05-21 20:23:01', 2, '1'),
(68, '127.0.0.1', '0eYxlyikNFrNjDeJolIxSq6DPj9ZuhU3ExQxcOry', '2024-05-21 20:23:16', '2024-05-21 20:50:38', 12, '1'),
(69, '127.0.0.1', '0bPDJYl1y1eq6DHMeI9Wcaep0l7hwWKadKxUBnyA', '2024-05-21 20:50:45', NULL, 2, '1'),
(70, '127.0.0.1', 'LjChe1geEnSNi8v2kol9OqMGVZ8BCIWJTkerpkgd', '2024-05-22 09:02:49', '2024-05-22 09:41:29', 2, '1'),
(71, '127.0.0.1', '8y0N46PhFVYGlTMjA7jKYVPChgvzS67EgahCv1r8', '2024-05-22 09:41:43', '2024-05-22 09:51:49', 13, '1'),
(72, '127.0.0.1', 'ce23gU75JhmlwhGvPTaFqttu5w70MXNI5W0Dx7WK', '2024-05-22 09:51:56', '2024-05-22 09:55:36', 2, '1'),
(73, '127.0.0.1', 'J0vLKC56vjQBQo1pO6BuqGYeFuZW0zJUX5NzZTDy', '2024-05-22 09:55:51', '2024-05-22 11:23:29', 13, '1'),
(74, '127.0.0.1', 'gcRUV5UT6vQVV3EFAcfMh9erAcESEMcw70hsVzXQ', '2024-05-22 11:28:28', '2024-05-22 11:37:52', 2, '1'),
(75, '127.0.0.1', 'ZZBR8ThZVVFmVG55J1jCuzPvv72XXPlorjYJsD3f', NULL, '2024-05-22 11:41:22', 2, '0'),
(76, '127.0.0.1', 'ZZBR8ThZVVFmVG55J1jCuzPvv72XXPlorjYJsD3f', '2024-05-22 11:38:14', '2024-05-22 11:41:22', 13, '1'),
(77, '127.0.0.1', 'fR9fxQv1W8ObB16SKqvyQIJOOnoPVtNAKXwKc9oJ', '2024-05-22 11:41:29', '2024-05-22 13:38:42', 12, '1');
--
-- Constraints for dumped tables
--

INSERT INTO `requestnotifications` (`id`, `title`, `description`, `request_type`, `emisor`, `destinatary`, `created_at`, `status`, `rubbised`, `viewed`, `updated_at`, `_token`) VALUES
(11, 'Cambio de contraseña', 'Buenos dias, \r\n\r\nQuisiera un cambio de contraseña ya que no me acuerdo gracias\r\n\r\nSaludos', 'change_password', 13, 12, '2024-05-22 11:40:10', 'denegado', '0', '1', '2024-05-22 13:37:30', 'cQ5PTYSMnto6uilGAvCKHe051KaWHfPS9k5jGz2o');

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `fk_gd_sanitarios` FOREIGN KEY (`autor`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `drafs`
--
ALTER TABLE `drafs`
  ADD CONSTRAINT `fk_drafts_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `requestnotifications`
--
ALTER TABLE `requestnotifications`
  ADD CONSTRAINT `fk_requestnotifications_administrators` FOREIGN KEY (`destinatary`) REFERENCES `administrators` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `fk_session_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
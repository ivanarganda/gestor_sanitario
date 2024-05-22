-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 22, 2024 at 12:05 AM
-- Server version: 8.2.0
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gestor_sanitario`
--

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

INSERT INTO `administrators` (`id`, `name`, `email`, `created_at`, `updated_at`) VALUES
(2, 'dani', 'dani@gestor.com', '2024-05-20 17:35:39', '2024-05-20 17:35:39'),
(12, 'ivan gonzalez valles', 'ivanartista96@gmail.com', '2024-05-20 15:41:31', '2024-05-20 15:41:31');

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
  `title` varchar(200) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `request_type` enum('change_password','change_name_user','change_role') NOT NULL,
  `emisor` int NOT NULL,
  `destinatary` int NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `status` enum('pendiente','proceso','aprobado') NOT NULL,
  `rubbised` enum('0','1') NOT NULL,
  `viewed` enum('0','1') NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_requestnotifications_administrators` (`destinatary`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `requestnotifications`
--

INSERT INTO `requestnotifications` (`id`, `title`, `description`, `request_type`, `emisor`, `destinatary`, `created_at`, `status`, `rubbised`, `viewed`, `updated_at`) VALUES
(1, 'Cambio de contraseña', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque architecto aspernatur accusamus nobis molestias iste, distinctio ducimus totam dolor necessitatibus quos, ipsam quibusdam consectetur modi quaerat consequuntur, ipsa soluta! Quidem?Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque architecto aspernatur accusamus nobis molestias iste, distinctio ducimus totam dolor necessitatibus quos, ipsam quibusdam consectetur modi quaerat consequuntur, ipsa soluta! Quidem?Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque architecto aspernatur accusamus nobis molestias iste, distinctio ducimus totam dolor necessitatibus quos, ipsam quibusdam consectetur modi quaerat consequuntur, ipsa soluta! Quidem?Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque architecto aspernatur accusamus nobis molestias iste, distinctio ducimus totam dolor necessitatibus quos, ipsam quibusdam consectetur modi quaerat consequuntur, ipsa soluta! Quidem?Lorem ipsum dolor si', 'change_password', 13, 2, '2024-05-21 10:20:35', 'aprobado', '0', '1', '2024-05-22 00:02:25'),
(2, 'Cambio de grupo', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque architecto aspernatur accusamus nobis molestias iste, distinctio ducimus totam dolor necessitatibus quos, ipsam quibusdam consectetur modi quaerat consequuntur, ipsa soluta! Quidem?', 'change_role', 13, 2, '2024-05-21 10:20:35', 'pendiente', '0', '0', NULL),
(3, 'Cambio de grupo', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque architecto aspernatur accusamus nobis molestias iste, distinctio ducimus totam dolor necessitatibus quos, ipsam quibusdam consectetur modi quaerat consequuntur, ipsa soluta! Quidem?', 'change_role', 13, 2, '2024-05-21 10:20:35', 'pendiente', '0', '0', NULL),
(4, 'Cambio de nombre de usuario', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque architecto aspernatur accusamus nobis molestias iste, distinctio ducimus totam dolor necessitatibus quos, ipsam quibusdam consectetur modi quaerat consequuntur, ipsa soluta! Quidem?', 'change_name_user', 13, 2, '2024-05-21 10:20:35', 'pendiente', '0', '0', NULL),
(5, 'Cambio de grupo', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque architecto aspernatur accusamus nobis molestias iste, distinctio ducimus totam dolor necessitatibus quos, ipsam quibusdam consectetur modi quaerat consequuntur, ipsa soluta! Quidem?Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque architecto aspernatur accusamus nobis molestias iste, distinctio ducimus totam dolor necessitatibus quos, ipsam quibusdam consectetur modi quaerat consequuntur, ipsa soluta! Quidem?', 'change_role', 13, 12, '2024-05-21 10:20:35', 'pendiente', '0', '0', NULL),
(6, 'Cambio de nombre de usuario', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque architecto aspernatur accusamus nobis molestias iste, distinctio ducimus totam dolor necessitatibus quos, ipsam quibusdam consectetur modi quaerat consequuntur, ipsa soluta! Quidem?', 'change_name_user', 13, 12, '2024-05-21 10:20:35', 'pendiente', '0', '0', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `email_verified_at`, `created_at`, `updated_at`, `colegiate`, `phone`, `role`, `activated`, `remember_token`, `session_id`) VALUES
(2, 'dani', 'YWRtaW4xMjM=', 'dani@gestor.com', '2024-05-20 18:03:53', '2024-05-15 12:14:02', '2024-05-21 20:50:45', NULL, '696294856', 'staff', '1', 'U8eaEkFXkTs3fy201CW8vTEvVKtx3npupvMuk4gvBN3mxVBuouxQCJqYSloz', '0bPDJYl1y1eq6DHMeI9Wcaep0l7hwWKadKxUBnyA'),
(12, 'ivan gonzalez valles', 'YWRtaW4xMjM=', 'ivanartista96@gmail.com', '2024-05-20 17:41:31', '2024-05-20 17:41:31', '2024-05-21 20:23:16', NULL, '657203570', 'staff', '1', 'E8khxUGxBia7pWQgU9H5NEKbS9QUgOscEGTHRsIY0H7V2SNxTlaVSuKadf1n', '0eYxlyikNFrNjDeJolIxSq6DPj9ZuhU3ExQxcOry'),
(13, 'ivan gonzalez valles', 'QWRtaW4xMjM0KiE=', 'ivan.web.developer.96@gmail.com', '2024-05-21 08:17:15', '2024-05-21 08:15:27', '2024-05-21 08:17:43', NULL, '657203570', 'user', '1', 'HlXgXUGGtBnoZfbWZM1fEkYShD60MqIl4EDsdgMTWSj3rSS7ER5sTJCkCDwP', 'JXs6xCa2QMmmnfJbgMkk8tlk3CXvnKNpRjNZGNQ7'),
(14, 'andrei', 'YWRtaW4xMjM=', 'andreipopa0783@gmail.com', '2024-05-21 17:29:34', '2024-05-21 17:29:17', '2024-05-21 17:29:34', NULL, NULL, 'user', '1', NULL, NULL);

--
-- Constraints for dumped tables
--

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

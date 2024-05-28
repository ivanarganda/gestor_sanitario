-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 27, 2024 at 11:18 PM
-- Server version: 8.2.0
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


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
-- Table structure for table `chatnotificationsrequest`
--

DROP TABLE IF EXISTS `chatnotificationsrequest`;
CREATE TABLE IF NOT EXISTS `chatnotificationsrequest` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT NULL,
  `message` text,
  `emisor` int NOT NULL,
  `destinatary` int NOT NULL,
  `viewed` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `request_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_requestnotifications_chat` (`request_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chatnotificationsrequest`
--

INSERT INTO `chatnotificationsrequest` (`id`, `title`, `message`, `emisor`, `destinatary`, `viewed`, `created_at`, `request_id`) VALUES
(7, 'Cambio contraseña', 'Hola administrador', 13, 12, '0', '2024-05-27 20:33:10', 13),
(8, 'Cambio contraseña', '¿Hola ivan que tal estas?', 12, 13, '0', '2024-05-27 20:33:16', 13),
(9, 'Cambio contraseña', 'Muy bien', 13, 12, '0', '2024-05-27 20:33:19', 13),
(10, 'Cambio contraseña', 'Hola Dani', 13, 2, '0', '2024-05-27 20:33:22', 13),
(11, 'Cambio contraseña', '¿Hola ivan que tal estas?', 2, 13, '0', '2024-05-27 20:33:25', 13),
(12, 'Cambio contraseña', 'Muy bien', 13, 2, '0', '2024-05-27 20:33:27', 13);

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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `requestnotifications`
--

INSERT INTO `requestnotifications` (`id`, `title`, `description`, `request_type`, `emisor`, `destinatary`, `created_at`, `status`, `rubbised`, `viewed`, `updated_at`, `_token`) VALUES
(11, 'Cambio de contraseña', 'Buenos dias, \r\n\r\nQuisiera un cambio de contraseña ya que no me acuerdo gracias\r\n\r\nSaludos', 'change_password', 13, 12, '2024-05-22 11:40:10', 'pendiente', '0', '0', '2024-05-25 22:26:12', 'cQ5PTYSMnto6uilGAvCKHe051KaWHfPS9k5jGz2o'),
(13, 'Cambio de contraseña', 'Quisiera un cambio de contraseña', 'change_password', 13, 2, '2024-05-25 11:40:15', 'aprobado', '0', '1', '2024-05-26 18:46:57', '6rYTw0tLPPsUKbiihpy4lYjk0NGlQk4oJC64PKuA'),
(14, 'Cambio de grupo', 'Cambiame de grupo a enfermeros por favor', 'change_role', 13, 12, '2024-05-25 13:27:11', 'pendiente', '0', '1', '2024-05-27 11:26:42', 'so7jO0ucuLDrcoQJPWA0po923KsQZ9uypgQBtQiS');

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
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8;

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
(2, 'dani', 'YWRtaW4xMjM=', 'dani@gestor.com', '2024-05-20 18:03:53', '2024-05-15 12:14:02', '2024-05-27 11:55:07', NULL, '696294856', 'staff', '1', 'Wl3Dh2ubk0vouZTTtp1WXgsC7j2q1cAEj0xKdfi1RdszmLyasutbWX76p2hd', 'ZuzWh0sz6Rikjz3l2OfhJVxLKKSdkTJGl0xXvBCR'),
(12, 'ivan gonzalez valles', 'YWRtaW4xMjM=', 'ivanartista96@gmail.com', '2024-05-22 09:53:29', '2024-05-20 17:41:31', '2024-05-27 10:05:16', NULL, '657203570', 'staff', '1', 'w90LOfpzlXhz8CqJ62TTlIGkVc2xV4AzSZXuaUePuc9mMEocxrSEDQYJc3iO', 'WaJ7NbPq9CQXky04NDoOk5pJh4eq4Rl8jdwDLi08'),
(13, 'ivan gonzalez valles', 'YWRtaW4xMjM=', 'ivan.web.developer.96@gmail.com', '2024-05-21 08:17:15', '2024-05-21 08:15:27', '2024-05-27 11:55:18', NULL, '657203570', 'user', '1', '5YbqJi9kHlertL7qgFL4Cf0zQA1FwvmqqoUjnR1godfrIEl2jHmgDa4oKdlN', 'JH4Jw7jXjhFLGbMR7UkLu80rPHZlMP5qJWI91ttp'),
(14, 'andrei', 'YWRtaW4xMjM=', 'andreipopa0783@gmail.com', '2024-05-23 18:06:00', '2024-05-21 17:29:17', '2024-05-23 18:06:00', NULL, NULL, 'user', '1', NULL, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chatnotificationsrequest`
--
ALTER TABLE `chatnotificationsrequest`
  ADD CONSTRAINT `fk_requestnotifications_chat` FOREIGN KEY (`request_id`) REFERENCES `requestnotifications` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
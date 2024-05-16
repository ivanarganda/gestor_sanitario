-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 16, 2024 at 05:32 PM
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
CREATE DATABASE IF NOT EXISTS `gestor_sanitario` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `gestor_sanitario`;

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `change_engine_for_all_tables`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `change_engine_for_all_tables` (IN `dbName` VARCHAR(64), IN `newEngine` VARCHAR(64))   BEGIN
    DECLARE done INT DEFAULT 0;
    DECLARE tableName VARCHAR(64);
    DECLARE alterStmt VARCHAR(255);

    DECLARE cur CURSOR FOR 
    SELECT table_name 
    FROM information_schema.tables 
    WHERE table_schema = dbName AND table_type = 'BASE TABLE';

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

    OPEN cur;

    read_loop: LOOP
        FETCH cur INTO tableName;
        IF done THEN
            LEAVE read_loop;
        END IF;

        SET @alterStmt = CONCAT('ALTER TABLE ', dbName, '.', tableName, ' ENGINE = ', newEngine);
        PREPARE stmt FROM @alterStmt;
        EXECUTE stmt;
        DEALLOCATE PREPARE stmt;
    END LOOP;

    CLOSE cur;
END$$

DELIMITER ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `ip_address`, `user_agent`, `login_time`, `logout_time`, `user_id`, `status`) VALUES
(1, '127.0.0.1', '0Pi8MkzEBOndha1XJ6VD9BTjgJ0OdpCKmUNPGYMp', '2024-05-15 10:15:50', '2024-05-15 10:16:23', 2, '1'),
(2, '127.0.0.1', '6VWV7FtH9E7XT3Jg12wrKUdrsdriyY54mdGHksd1', NULL, '2024-05-15 17:33:50', 2, '0'),
(3, '127.0.0.1', '6VWV7FtH9E7XT3Jg12wrKUdrsdriyY54mdGHksd1', '2024-05-15 10:35:42', '2024-05-15 17:33:50', 2, '1'),
(4, '127.0.0.1', '58HZW2Sh1auyHZaH4rRA5yLVeF6DPoM61IpsK1YS', '2024-05-15 17:33:57', '2024-05-16 09:06:44', 2, '1'),
(5, '127.0.0.1', 'W8isSwbPQcznmyXruoCL6w0LWWfX3NJpyfzwECex', '2024-05-16 09:11:41', '2024-05-16 09:30:40', 2, '1'),
(6, '127.0.0.1', 'rSJ7qaI0IYWAYnfFToG8tgfAQRF1iT0Qu7cN67na', NULL, NULL, 6, '0'),
(7, '127.0.0.1', 'rSJ7qaI0IYWAYnfFToG8tgfAQRF1iT0Qu7cN67na', NULL, NULL, 6, '0'),
(8, '127.0.0.1', 'rSJ7qaI0IYWAYnfFToG8tgfAQRF1iT0Qu7cN67na', NULL, NULL, 4, '0'),
(9, '127.0.0.1', 'rSJ7qaI0IYWAYnfFToG8tgfAQRF1iT0Qu7cN67na', NULL, NULL, 4, '0'),
(10, '127.0.0.1', 'rSJ7qaI0IYWAYnfFToG8tgfAQRF1iT0Qu7cN67na', NULL, NULL, 4, '0'),
(11, '127.0.0.1', 'rSJ7qaI0IYWAYnfFToG8tgfAQRF1iT0Qu7cN67na', NULL, NULL, 4, '0'),
(12, '127.0.0.1', 'rSJ7qaI0IYWAYnfFToG8tgfAQRF1iT0Qu7cN67na', NULL, NULL, 4, '0'),
(13, '127.0.0.1', 'rSJ7qaI0IYWAYnfFToG8tgfAQRF1iT0Qu7cN67na', NULL, NULL, 4, '0'),
(14, '127.0.0.1', 'rSJ7qaI0IYWAYnfFToG8tgfAQRF1iT0Qu7cN67na', '2024-05-16 09:36:18', NULL, 4, '1'),
(15, '127.0.0.1', 'AU9oisgW44jyRyIQcTRMMXedykOY39Mhrr3EwyW5', '2024-05-16 09:36:37', '2024-05-16 11:34:05', 4, '1'),
(16, '127.0.0.1', 'MjI3XnGphenJ9gk3AkKsH4ofD2VuBmETvSfyoKEC', '2024-05-16 12:01:19', NULL, 2, '1'),
(17, '127.0.0.1', '7UTvuoZl0gHlotrdy5vgyYCzFeM8dmM80uCVEAMc', '2024-05-16 12:01:37', '2024-05-16 12:03:04', 2, '1'),
(18, '127.0.0.1', '5cUUMvti9pwdXJxR8Wt8lzsqKdOLBNDpDYXR8dN1', '2024-05-16 12:03:10', '2024-05-16 12:03:12', 2, '1'),
(19, '127.0.0.1', '4A39J9iluUpxDICwpLVmF5edOBFyEoWLLDjh8DpN', '2024-05-16 12:03:21', '2024-05-16 12:04:21', 2, '1'),
(20, '127.0.0.1', 'zC2tGj9JaqCywGh7TOgi19ZZEEccvLDl6a0NUZka', NULL, NULL, 2, '0'),
(21, '127.0.0.1', 'zC2tGj9JaqCywGh7TOgi19ZZEEccvLDl6a0NUZka', '2024-05-16 12:04:54', NULL, 2, '1');

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
  `colegiate` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `phone` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `role` enum('staff','medico','user','enfermero') NOT NULL,
  `activated` enum('0','1') NOT NULL DEFAULT '0',
  `remember_token` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `session_id` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `email_verified_at`, `created_at`, `updated_at`, `colegiate`, `phone`, `role`, `activated`, `remember_token`, `session_id`) VALUES
(2, 'dani', 'YWRtaW4xMjM=', 'dani@gestor.com', '2024-05-15 12:14:02', '2024-05-15 12:14:02', '2024-05-16 12:04:54', NULL, '696294856', 'staff', '1', 'Wrj2UpcaML4s4dx5MZrSpinxYrzXx5ceNO3COPNe13r79os37B4cuGEfNFx1', 'zC2tGj9JaqCywGh7TOgi19ZZEEccvLDl6a0NUZka'),
(4, 'ivan gonzalez valles', 'ZmRncmZnZmdmc2Q=', 'ivanartista96@gmail.com', '2024-05-16 11:36:08', '2024-05-15 15:02:45', '2024-05-16 09:36:37', NULL, NULL, 'user', '0', 'E6Hap30s8EcMZJk5bjlI3P6VjzXOJLqFQUwO9rdbJyFTDJNYkOxS7cype4SY', 'AU9oisgW44jyRyIQcTRMMXedykOY39Mhrr3EwyW5'),
(5, 'ivan gonzalez valles', 'YWRtaW4xMjM0', 'ivanartista73@gmail.com', NULL, '2024-05-16 07:03:26', NULL, '12345678', '657203570', 'medico', '0', NULL, NULL),
(6, 'pepito', 'MTIzNA==', 'hola@hola.es', NULL, '2024-05-16 09:29:28', NULL, NULL, '0000000', 'user', '0', NULL, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `fk_gd_sanitarios` FOREIGN KEY (`autor`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `fk_session_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

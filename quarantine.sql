-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 26, 2021 at 04:21 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webapp_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `quarantine`
--

DROP TABLE IF EXISTS `quarantine`;
CREATE TABLE IF NOT EXISTS `quarantine` (
  `quarantine_id` tinyint(5) NOT NULL AUTO_INCREMENT,
  `user_id` tinyint(5) NOT NULL,
  `country` varchar(30) NOT NULL,
  `start_date` timestamp NOT NULL,
  `end_date` timestamp NOT NULL,
  `is_done` tinyint(1) NOT NULL,
  `city` varchar(30) NOT NULL,
  PRIMARY KEY (`quarantine_id`),
  KEY `quarantine_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quarantine`
--

INSERT INTO `quarantine` (`quarantine_id`, `user_id`, `country`, `start_date`, `end_date`, `is_done`, `city`) VALUES
(1, 1, 'Korea', '2021-03-31 16:13:10', '2021-04-08 16:13:10', 0, 'Ilsan'),
(2, 2, 'Hong Kong', '2021-04-14 16:13:54', '2021-04-23 16:13:54', 1, 'Hong Kong');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

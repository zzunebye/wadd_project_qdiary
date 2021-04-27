-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 26, 2021 at 04:46 PM
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
-- Table structure for table `card`
--

DROP TABLE IF EXISTS `card`;
CREATE TABLE IF NOT EXISTS `card` (
  `card_id` tinyint(5) NOT NULL AUTO_INCREMENT,
  `card_content` varchar(300) NOT NULL,
  `card_pic` blob,
  `quarantine_id` tinyint(5) NOT NULL,
  `created_time` timestamp NOT NULL,
  PRIMARY KEY (`card_id`),
  KEY `card_quarantine` (`quarantine_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `card`
--

INSERT INTO `card` (`card_id`, `card_content`, `card_pic`, `quarantine_id`, `created_time`) VALUES
(1, 'so boring day....... i wanna have chicken so bad.....ahhhhhhhhhhh', NULL, 1, '2021-04-21 16:14:23'),
(2, 'i get used to this life,.... but still wanna have chicken so bad..... where are you, chicken,... i m waiting for you', NULL, 1, '2021-04-27 16:15:50');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `comment_id` tinyint(5) NOT NULL AUTO_INCREMENT,
  `card_id` tinyint(5) NOT NULL,
  `comment_content` varchar(300) NOT NULL,
  `user_id` tinyint(5) NOT NULL,
  `created_time` timestamp NOT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `comment_card` (`card_id`),
  KEY `comment_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `card_id`, `comment_content`, `user_id`, `created_time`) VALUES
(1, 1, 'so fat ass, you gotta use fat', 2, '2021-04-27 16:15:50');

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

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `on_quarantine` tinyint(1) NOT NULL,
  `profile_picture` blob,
  `last_update` timestamp NULL DEFAULT NULL,
  `user_id` tinyint(5) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`email`, `password`, `first_name`, `last_name`, `on_quarantine`, `profile_picture`, `last_update`, `user_id`) VALUES
('ji385@naver.com', '1234567!', 'Jiseok', 'Hong', 1, NULL, NULL, 1),
('john5017@naver.com', '1234567!', 'JunYoung', 'Bang', 1, NULL, NULL, 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `card`
--
ALTER TABLE `card`
  ADD CONSTRAINT `card_quarantine` FOREIGN KEY (`quarantine_id`) REFERENCES `quarantine` (`quarantine_id`);

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_card` FOREIGN KEY (`card_id`) REFERENCES `card` (`card_id`),
  ADD CONSTRAINT `comment_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

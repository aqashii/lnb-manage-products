-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 20, 2024 at 08:29 AM
-- Server version: 8.2.0
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lb_product_manage`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=120 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(107, 'ladies'),
(109, 'mens'),
(118, 'ashiq'),
(119, 'hekdds');

-- --------------------------------------------------------

--
-- Table structure for table `lb_products`
--

DROP TABLE IF EXISTS `lb_products`;
CREATE TABLE IF NOT EXISTS `lb_products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cat_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `quality_code` int NOT NULL,
  `color` varchar(255) NOT NULL,
  `drop_status` varchar(255) NOT NULL,
  `sell_channel` varchar(255) NOT NULL,
  `brought_price` varchar(100) DEFAULT NULL,
  `sell_price` int NOT NULL,
  `sold_price` int NOT NULL,
  `sold_status` varchar(255) NOT NULL,
  `sold_date` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=99 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lb_products`
--

INSERT INTO `lb_products` (`id`, `cat_id`, `name`, `size`, `quality_code`, `color`, `drop_status`, `sell_channel`, `brought_price`, `sell_price`, `sold_price`, `sold_status`, `sold_date`, `photo`) VALUES
(96, 107, 'safw', '4rtw', 1, 'dfas', 'Yes', 'facebook', '2341', 24324, 3242, 'Yes', '214214', '4861e2a82dcb98f3da120314d1d491d0.png'),
(97, 107, 'qwdeqw', '213', 5, 'ad', 'Yes', 'instagram', '324234', 2341243, 12412, 'Yes', '21421', '3cccfad57ac45f1b2270d823f2ef249c.png'),
(62, 109, 'afs', '234', 8, 'dsf', 'Yes', 'instagram', '324', 235, 124, 'Yes', '124', 'ff295bb64895cbafb3ed09bcfa931d60.jpeg'),
(63, 109, 'afs', '234', 8, 'dsf', 'Yes', 'instagram', '324', 235, 124, 'Yes', '124', 'b5b6580c78b0b31bdaee8a73e7f84fea.jpeg'),
(64, 109, 'afs', '234', 8, 'dsf', 'Yes', 'instagram', '324', 235, 124, 'Yes', '124', 'd5c5419f867ee7ea8462d1ecc25a785b.jpeg'),
(65, 109, 'afs', '234', 8, 'dsf', 'Yes', 'instagram', '324', 235, 124, 'Yes', '124', 'fcb8f03812480756328e79e405b442db.jpeg'),
(98, 118, '3wetrwe3tr', '213', 3, 'eret', 'Yes', 'instagram', '432453', 242345, 324234, 'Yes', '12442', '02c77d3cf965433760c0c03b9eff6bdc.png');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 23, 2023 at 10:12 AM
-- Server version: 8.2.0
-- PHP Version: 8.1.26

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
) ENGINE=MyISAM AUTO_INCREMENT=110 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(107, 'ladies'),
(109, 'mens');

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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `lb_products`
--

INSERT INTO `lb_products` (`id`, `cat_id`, `name`, `size`, `quality_code`, `color`, `drop_status`, `sell_channel`, `brought_price`, `sell_price`, `sold_price`, `sold_status`, `sold_date`) VALUES
(11, 107, 'jacket', '36', 7, 'black', 'Yes', 'instagram', '5', 0, 1548, 'No', ''),
(12, 108, 'pant', '37', 6, 'blue', 'Yes', 'instagram', '22aed', 548, 0, 'Yes', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

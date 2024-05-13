-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 04, 2023 at 03:23 PM
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
-- Database: `dason_php`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customername` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phonenumber` varchar(100) NOT NULL,
  `budget` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customername`, `address`, `phonenumber`, `budget`) VALUES
(1, 'sdsdad', 'yapa sevana', '0701491877', 'saada');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_order`
--

DROP TABLE IF EXISTS `delivery_order`;
CREATE TABLE IF NOT EXISTS `delivery_order` (
  `agent_do_no` varchar(100) NOT NULL,
  `serial_no` varchar(100) NOT NULL,
  `consignee_name_address` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  PRIMARY KEY (`agent_do_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_order`
--

INSERT INTO `delivery_order` (`agent_do_no`, `serial_no`, `consignee_name_address`, `location`) VALUES
('888888', '9888', '', 'http://localhost/Flotilla-logistic/assets/BILL OF DELIVERY ORDER/888888.html');

-- --------------------------------------------------------

--
-- Table structure for table `form`
--

DROP TABLE IF EXISTS `form`;
CREATE TABLE IF NOT EXISTS `form` (
  `BL_No` int(100) NOT NULL AUTO_INCREMENT,
  `file_location` varchar(100) NOT NULL,
  PRIMARY KEY (`BL_No`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_commercial`
--

DROP TABLE IF EXISTS `invoice_commercial`;
CREATE TABLE IF NOT EXISTS `invoice_commercial` (
  `bl_no` varchar(100) NOT NULL,
  `shippername` varchar(100) NOT NULL,
  `consignee_name` varchar(100) NOT NULL,
  `location` varchar(500) NOT NULL,
  PRIMARY KEY (`bl_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice_commercial`
--

INSERT INTO `invoice_commercial` (`bl_no`, `shippername`, `consignee_name`, `location`) VALUES
('000001', '', '', 'http://localhost/Flotilla%20logistic/Admin/Flotilla%20logistic/assets/000001.html');

-- --------------------------------------------------------

--
-- Table structure for table `manifest_invoice`
--

DROP TABLE IF EXISTS `manifest_invoice`;
CREATE TABLE IF NOT EXISTS `manifest_invoice` (
  `manifest_id` varchar(100) NOT NULL,
  `generator_id` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  PRIMARY KEY (`manifest_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `useremail` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `useremail` (`useremail`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `useremail`, `username`, `password`, `token`, `created_at`) VALUES
(1, 'admin@gmail.com', 'admin', '$2y$10$6vlRcpQf4kJYF/i4oFYrC.GYqCB9C65bkConbiE15UZ9dcqEjdmnu', '754bcf4b23f6b6f887e30182f22ac0b7bd577256d26e7e744546ac8403ee855a3aa236909dd98571731913e85f8dd1b1e7c9', '2021-12-04 17:53:37');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

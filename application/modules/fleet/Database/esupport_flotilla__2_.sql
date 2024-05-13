-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2024 at 11:12 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `esupport_flotilla (2)`
--

-- --------------------------------------------------------

--
-- Table structure for table `creadit_invoice`
--

CREATE TABLE `creadit_invoice` (
  `invoiceNum` varchar(100) NOT NULL,
  `companyName` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customername` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phonenumber` varchar(100) NOT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customername`, `address`, `phonenumber`, `email`) VALUES
('', '', '', NULL),
('Deruwan Chalithanga', 'galle', '0779138787', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `debit_invoice`
--

CREATE TABLE `debit_invoice` (
  `invoiceNum` varchar(100) NOT NULL,
  `companyName` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_order`
--

CREATE TABLE `delivery_order` (
  `agent_do_no` varchar(100) NOT NULL,
  `serial_no` varchar(100) NOT NULL,
  `consignee_name_address` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fleet_booking`
--

CREATE TABLE `fleet_booking` (
  `trip_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `vehicle_name` varchar(255) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `join_date` date NOT NULL,
  `start_location` varchar(255) NOT NULL,
  `end_location` varchar(255) NOT NULL,
  `trip_type` varchar(255) NOT NULL,
  `total_price` decimal(10,0) NOT NULL,
  `trip_status` varchar(255) NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fleet_customer`
--

CREATE TABLE `fleet_customer` (
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` int(20) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fleet_driver`
--

CREATE TABLE `fleet_driver` (
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` int(50) NOT NULL,
  `dob` date NOT NULL,
  `join_date` date NOT NULL,
  `lincese_number` varchar(255) NOT NULL,
  `lincese_type` varchar(255) NOT NULL,
  `expiry_date` date NOT NULL,
  `driver_status` varchar(255) NOT NULL,
  `Working_time` time(6) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fleet_insurance`
--

CREATE TABLE `fleet_insurance` (
  `provider_name` varchar(255) NOT NULL,
  `vehicle_name` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `recurring_date` date NOT NULL,
  `recurring_period` varchar(255) NOT NULL,
  `insurance_deductible` int(255) NOT NULL,
  `charge_payble` int(255) NOT NULL,
  `policy_number` int(255) NOT NULL,
  `policy_document` varchar(255) NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fleet_vehicle`
--

CREATE TABLE `fleet_vehicle` (
  `vehicle_name` varchar(255) NOT NULL,
  `teacher` varchar(255) NOT NULL,
  `chassis_number` varchar(255) NOT NULL,
  `odometer` int(255) NOT NULL,
  `model_year` year(4) NOT NULL,
  `engine_transmission` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fleet_vehicle`
--

INSERT INTO `fleet_vehicle` (`vehicle_name`, `teacher`, `chassis_number`, `odometer`, `model_year`, `engine_transmission`, `location`) VALUES
('toyota', 'erp', 'k643', 62800, '2010', 'Engine: 1.5L Inline-3, Transmission: 6-Speed Automatic', 'hhhh'),
('Honda Accord', 'Joseph Fiennes	', 'XYZ987654321', 102, '2011', 'Engine: 3.5L V6, Transmission: 8-Speed Automatic	', 'Main City Streets	kkk');

-- --------------------------------------------------------

--
-- Table structure for table `form`
--

CREATE TABLE `form` (
  `BL_No` int(100) NOT NULL,
  `file_location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_commercial`
--

CREATE TABLE `invoice_commercial` (
  `bl_no` varchar(100) NOT NULL,
  `shippername` varchar(100) NOT NULL,
  `consignee_name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `location` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manifest_invoice`
--

CREATE TABLE `manifest_invoice` (
  `manifest_id` varchar(100) NOT NULL,
  `generator_id` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shippers`
--

CREATE TABLE `shippers` (
  `id` int(11) NOT NULL,
  `shippername` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phonenumber` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `shippers`
--

INSERT INTO `shippers` (`id`, `shippername`, `address`, `phonenumber`) VALUES
(1, 'sasa', 'asasas', 'asas');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `useremail` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `useremail`, `username`, `password`, `token`, `created_at`) VALUES
(1, 'admin@gmail.com', 'admin', '$2y$10$6vlRcpQf4kJYF/i4oFYrC.GYqCB9C65bkConbiE15UZ9dcqEjdmnu', '754bcf4b23f6b6f887e30182f22ac0b7bd577256d26e7e744546ac8403ee855a3aa236909dd98571731913e85f8dd1b1e7c9', '2021-12-04 17:53:37');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `id` int(11) NOT NULL,
  `vendorname` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phonenumber` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`id`, `vendorname`, `address`, `phonenumber`) VALUES
(1, 'exsasa', 'asasa', '1212121212'),
(2, 'test', 'No.11 Alagoda,poojapitiya', '0766969200');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `creadit_invoice`
--
ALTER TABLE `creadit_invoice`
  ADD PRIMARY KEY (`invoiceNum`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`phonenumber`);

--
-- Indexes for table `debit_invoice`
--
ALTER TABLE `debit_invoice`
  ADD PRIMARY KEY (`invoiceNum`);

--
-- Indexes for table `delivery_order`
--
ALTER TABLE `delivery_order`
  ADD PRIMARY KEY (`agent_do_no`);

--
-- Indexes for table `fleet_booking`
--
ALTER TABLE `fleet_booking`
  ADD PRIMARY KEY (`trip_id`);

--
-- Indexes for table `fleet_customer`
--
ALTER TABLE `fleet_customer`
  ADD PRIMARY KEY (`mobile`);

--
-- Indexes for table `fleet_driver`
--
ALTER TABLE `fleet_driver`
  ADD PRIMARY KEY (`mobile`);

--
-- Indexes for table `fleet_insurance`
--
ALTER TABLE `fleet_insurance`
  ADD PRIMARY KEY (`policy_number`);

--
-- Indexes for table `fleet_vehicle`
--
ALTER TABLE `fleet_vehicle`
  ADD PRIMARY KEY (`chassis_number`);

--
-- Indexes for table `form`
--
ALTER TABLE `form`
  ADD PRIMARY KEY (`BL_No`);

--
-- Indexes for table `invoice_commercial`
--
ALTER TABLE `invoice_commercial`
  ADD PRIMARY KEY (`bl_no`);

--
-- Indexes for table `manifest_invoice`
--
ALTER TABLE `manifest_invoice`
  ADD PRIMARY KEY (`manifest_id`);

--
-- Indexes for table `shippers`
--
ALTER TABLE `shippers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `useremail` (`useremail`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fleet_booking`
--
ALTER TABLE `fleet_booking`
  MODIFY `trip_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `fleet_driver`
--
ALTER TABLE `fleet_driver`
  MODIFY `mobile` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=763706089;

--
-- AUTO_INCREMENT for table `fleet_insurance`
--
ALTER TABLE `fleet_insurance`
  MODIFY `policy_number` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `form`
--
ALTER TABLE `form`
  MODIFY `BL_No` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shippers`
--
ALTER TABLE `shippers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

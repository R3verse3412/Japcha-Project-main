-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2023 at 05:44 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `japcha`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'sample'),
(2, 'sample2'),
(3, 'sample23'),
(4, 'sample4'),
(5, 'sample5'),
(6, 'sample6');

-- --------------------------------------------------------

--
-- Table structure for table `customer_account`
--

CREATE TABLE `customer_account` (
  `customer_id` bigint(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `confirm_password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `customer_address` text NOT NULL,
  `contact_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_account`
--

INSERT INTO `customer_account` (`customer_id`, `username`, `password`, `confirm_password`, `email`, `customer_address`, `contact_number`) VALUES
(1, 'adner', 'asdf', 'asdf', 'adnerdevila23@gmail.com', 'Block 16 Lot 03', 12345),
(2, 'adner', 'adg', 'adg', 'adnerdevila23@gmail.com', 'Block 16 Lot 03', 12345678),
(3, 'adner', 'A1234567', 'A1234567', 'adnerdevila23@gmail.com', 'Block 16 Lot 03', 2147483647),
(4, 'adner', 'F1234567', '', 'adner_devila@yahoo.com', 'Block 16 Lot 03', 2147483647),
(5, 'adner', 'A1234567', 'A1234567', 'nerudesu18@gmail.com', 'Block 16 Lot 03', 2147483647),
(6, 'adner', 'A1234567', 'A1234567', 'menarddevila@gmail.com', 'Block 16 Lot 03', 2147483647),
(7, 'adner', 'A1234567', 'A1234567', 'adnerdevila23@gmail.com', 'Block 16 Lot 03', 2147483647),
(8, 'adner', 'A1234567', 'A1234567', 'adnerdevila23@gmail.com', 'Block 16 Lot 03', 2147483647),
(9, 'adner', 'A1234567', 'A1234567', 'adnerdevila23@gmail.com', 'Block 16 Lot 03', 2147483647),
(10, 'adner', 'A1234567', 'A1234567', 'adnerdevila23@gmail.com', 'Block 16 Lot 03', 2147483647),
(11, 'adner', 'A12345678', 'A12345678', 'adnerdevila23@gmail.com', 'Block 16 Lot 03', 2147483647),
(12, 'adner', 'A1234567', 'A1234567', 'adnerdevila23@gmail.com', 'Block 16 Lot 03', 2147483647),
(13, 'adner', 'A1234567', 'A1234567', 'adnerdevila23@gmail.com', 'Block 16 Lot 03', 2147483647),
(14, 'addd', 'A1234567', 'A1234567', 'adnerdevila23@gmail.com', 'Block 16 Lot 03', 2147483647),
(15, 'adner', 'A1234567', 'A1234567', 'adnerdevila23@gmail.com', 'Block 16 Lot 03', 2147483647),
(16, 'adner', 'A1234567', 'A1234567', 'adnerdevila23@gmail.com', 'Block 16 Lot 03', 2147483647),
(17, 'adner', 'A1234567', 'A1234567', 'adnerdevila23@gmail.com', 'Block 16 Lot 03', 2147483647),
(18, 'adner', 'A1234567', 'A1234567', 'adnerdevila23@gmail.com', 'Block 16 Lot 03', 2147483647),
(19, 'adner', 'A1234567', 'A1234567', 'adnerdevila23@gmail.com', 'Block 16 Lot 03', 2147483647),
(20, 'Adner Devila', 'A1234567', 'A1234567', 'nerudesu18@gmail.com', 'Block 16 Lot 03', 2147483647),
(21, 'devila', 'A1234567', 'A1234567', 'adnerdevila23@gmail.com', 'Block 16 Lot 03', 2147483647);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `customer_account`
--
ALTER TABLE `customer_account`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `username` (`username`),
  ADD KEY `email` (`email`),
  ADD KEY `contact_number` (`contact_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customer_account`
--
ALTER TABLE `customer_account`
  MODIFY `customer_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

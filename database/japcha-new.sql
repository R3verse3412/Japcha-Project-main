-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2023 at 03:27 PM
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
-- Database: `japcha-new`
--

-- --------------------------------------------------------

--
-- Table structure for table `addons`
--

CREATE TABLE `addons` (
  `addons_id` int(11) NOT NULL,
  `addons_name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `addons`
--

INSERT INTO `addons` (`addons_id`, `addons_name`, `price`, `created_at`) VALUES
(1, 'Nata', 19.99, '2023-10-07 15:47:04');

-- --------------------------------------------------------

--
-- Table structure for table `admin_account`
--

CREATE TABLE `admin_account` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `userlevel_id` int(11) NOT NULL,
  `contact` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_account`
--

INSERT INTO `admin_account` (`admin_id`, `username`, `email`, `password`, `userlevel_id`, `contact`) VALUES
(2, 'Adner Devila', 'sample@gmail.com', '$2y$10$5QVimcQSehGdEuJiRV2XZ.CzYTLmEg8zcpYIg95IyVzOx6DqJwGRy', 1, '121314'),
(3, 'Sample Admin', 'adnerdevila23@gmail.com', '$2y$10$TtQ93ocf6ar7umEJsKC/L./W3SzRAisIzqzfZpbVP0R7U4n.NXS8e', 2, '12345678910'),
(4, 'Third Admin', 'adnerdevs18@gmail.com', '$2y$10$/qiWQpkkqRZIAF6pGf5jLeO3oqzASx/xSsoY1LUBYQPwTx6V/wVca', 3, '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `created_at`, `updated_at`) VALUES
(1, 'Electronics', '2023-10-07 16:05:41', '2023-10-07 16:05:41'),
(2, 'Clothing', '2023-10-07 16:05:41', '2023-10-07 16:05:41'),
(3, 'Shake', '2023-10-07 16:22:55', '2023-10-07 16:22:55');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cms`
--

CREATE TABLE `cms` (
  `cms_id` int(11) NOT NULL,
  `japcha` text DEFAULT 'Default Japcha Text',
  `order_note` text DEFAULT 'Default Order Note',
  `socials` text DEFAULT 'Default Socials Text',
  `policy` text DEFAULT 'Default Policy Text',
  `location` text DEFAULT 'Default Location Text',
  `contact` text DEFAULT 'Default Contact Text',
  `title_data` text DEFAULT 'YOUR ONE-STOP FLAVORFUL SHOP',
  `subtitle` text DEFAULT 'MILK TEA • FRUIT TEA • MANGO GRAHAM CAKE • FRAPPE • ETC',
  `fbLink` text DEFAULT 'https://www.fb.com/',
  `ytLink` text DEFAULT 'https://www.youtube.com/',
  `instagramLink` text DEFAULT 'https://www.instagram.com/'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cms`
--

INSERT INTO `cms` (`cms_id`, `japcha`, `order_note`, `socials`, `policy`, `location`, `contact`, `title_data`, `subtitle`, `fbLink`, `ytLink`, `instagramLink`) VALUES
(1, 'Default Japcha Text', 'Default Order Note', 'Default Socials Text', 'Default Policy Text', 'Default Location Text', 'Default Contact Text', 'YOUR ONE-STOP FLAVORFUL SHOP', 'MILK TEA • FRUIT TEA • MANGO GRAHAM CAKE • FRAPPE • ETC', 'https://www.fb.com/', 'https://www.youtube.com/', 'https://www.instagram.com/');

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
(2, 'Sample user', '$2y$10$oEILB6ovaXRxCbxXUEu.h.yDZdpZ320pgS3riRu9eag6DyX.ZHqgu', '123', 'sample@gmail.com', 'Block 16 Lot 03', 12345);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `image_url`, `product_name`, `description`, `category_id`) VALUES
(3, 'IMG-6521fffe3df2a8.44940034.png', 'sample product', '123131', 3);

-- --------------------------------------------------------

--
-- Table structure for table `product_sizes`
--

CREATE TABLE `product_sizes` (
  `sizes_id` int(11) NOT NULL,
  `size_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_sizes`
--

INSERT INTO `product_sizes` (`sizes_id`, `size_name`) VALUES
(1, 'Small'),
(2, 'Medium'),
(3, 'Large'),
(4, 'Extra Large');

-- --------------------------------------------------------

--
-- Table structure for table `product_variation`
--

CREATE TABLE `product_variation` (
  `prodsizes_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `sizes_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_variation`
--

INSERT INTO `product_variation` (`prodsizes_id`, `product_id`, `sizes_id`, `price`, `quantity`) VALUES
(1, 3, 1, 1212.00, 12);

-- --------------------------------------------------------

--
-- Table structure for table `user_level`
--

CREATE TABLE `user_level` (
  `userlevel_id` int(11) NOT NULL,
  `user_level_name` varchar(255) NOT NULL DEFAULT 'Admin',
  `dashboard_view` tinyint(1) NOT NULL DEFAULT 0,
  `dashboard_edit` tinyint(1) NOT NULL DEFAULT 0,
  `contentManagement_view` tinyint(1) NOT NULL DEFAULT 0,
  `contentManagement_create` tinyint(1) NOT NULL DEFAULT 0,
  `contentManagement_edit` tinyint(1) NOT NULL DEFAULT 0,
  `contentManagement_delete` tinyint(1) NOT NULL DEFAULT 0,
  `fileManagement_view` tinyint(1) NOT NULL DEFAULT 0,
  `fileManagement_create` tinyint(1) NOT NULL DEFAULT 0,
  `fileManagement_edit` tinyint(1) NOT NULL DEFAULT 0,
  `fileManagement_delete` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_level`
--

INSERT INTO `user_level` (`userlevel_id`, `user_level_name`, `dashboard_view`, `dashboard_edit`, `contentManagement_view`, `contentManagement_create`, `contentManagement_edit`, `contentManagement_delete`, `fileManagement_view`, `fileManagement_create`, `fileManagement_edit`, `fileManagement_delete`) VALUES
(1, 'Admin', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(2, 'Cashier', 1, 0, 1, 1, 0, 0, 1, 0, 0, 0),
(3, 'Barista', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addons`
--
ALTER TABLE `addons`
  ADD PRIMARY KEY (`addons_id`);

--
-- Indexes for table `admin_account`
--
ALTER TABLE `admin_account`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `fk_user_level` (`userlevel_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `cms`
--
ALTER TABLE `cms`
  ADD PRIMARY KEY (`cms_id`);

--
-- Indexes for table `customer_account`
--
ALTER TABLE `customer_account`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD PRIMARY KEY (`sizes_id`);

--
-- Indexes for table `product_variation`
--
ALTER TABLE `product_variation`
  ADD PRIMARY KEY (`prodsizes_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `sizes_id` (`sizes_id`);

--
-- Indexes for table `user_level`
--
ALTER TABLE `user_level`
  ADD PRIMARY KEY (`userlevel_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addons`
--
ALTER TABLE `addons`
  MODIFY `addons_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_account`
--
ALTER TABLE `admin_account`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cms`
--
ALTER TABLE `cms`
  MODIFY `cms_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer_account`
--
ALTER TABLE `customer_account`
  MODIFY `customer_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_sizes`
--
ALTER TABLE `product_sizes`
  MODIFY `sizes_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_variation`
--
ALTER TABLE `product_variation`
  MODIFY `prodsizes_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_level`
--
ALTER TABLE `user_level`
  MODIFY `userlevel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_account`
--
ALTER TABLE `admin_account`
  ADD CONSTRAINT `admin_account_ibfk_1` FOREIGN KEY (`userlevel_id`) REFERENCES `user_level` (`userlevel_id`),
  ADD CONSTRAINT `fk_user_level` FOREIGN KEY (`userlevel_id`) REFERENCES `user_level` (`userlevel_id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `product_variation`
--
ALTER TABLE `product_variation`
  ADD CONSTRAINT `product_variation_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `product_variation_ibfk_2` FOREIGN KEY (`sizes_id`) REFERENCES `product_sizes` (`sizes_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

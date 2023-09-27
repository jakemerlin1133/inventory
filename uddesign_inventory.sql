-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2023 at 10:16 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uddesign_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `Category_ID` int(11) NOT NULL,
  `Category_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`Category_ID`, `Category_name`) VALUES
(1, 'Jacket'),
(2, 'Shirt');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_ID` int(11) NOT NULL,
  `customer_FN` varchar(20) NOT NULL,
  `customer_LN` varchar(20) NOT NULL,
  `operated_by` varchar(30) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_ID`, `customer_FN`, `customer_LN`, `operated_by`, `date`) VALUES
(222, 'jake russel', 'merlin', 'jake merlin', '2023-07-07 15:18:22'),
(223, 'qweqwe', 'qweqeq', 'jake merlin', '2023-07-07 15:24:39'),
(224, 'asd', 'asdasdas', 'jan jan', '2023-07-11 15:07:39'),
(225, 'test', 'test', 'jake merlin', '2023-07-12 15:37:08'),
(226, 'test2', 'test2', 'jake merlin', '2023-07-12 15:37:58'),
(227, 'test3', 'test3', 'jake merlin', '2023-07-12 15:41:56'),
(228, 'test4', 'test4', 'jan jan', '2023-07-12 15:47:18'),
(229, 'test10', 'test10', 'test test', '2023-07-12 16:00:09'),
(230, 'jake', 'merlin', 'jake russel  merlin', '2023-07-12 16:05:22'),
(231, 'jake merlin', 'merlin', 'jake merlin', '2023-07-13 08:57:44'),
(232, 'jake', 'merlin', 'jake merlin', '2023-09-12 14:26:22');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `Inventory_ID` int(11) NOT NULL,
  `Item_ID` int(11) NOT NULL,
  `Size_ID` int(11) NOT NULL,
  `Stocks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`Inventory_ID`, `Item_ID`, `Size_ID`, `Stocks`) VALUES
(66, 1, 1, 18),
(67, 1, 2, 29),
(68, 2, 2, 7),
(69, 3, 1, 1),
(70, 1, 3, 1),
(71, 1, 4, 2),
(72, 1, 5, 1),
(73, 1, 6, 1),
(74, 2, 1, 26),
(75, 2, 3, 2),
(76, 2, 4, 1),
(77, 2, 5, 1),
(78, 2, 6, 1),
(79, 3, 2, 49),
(80, 3, 3, 1),
(81, 3, 4, 1),
(82, 3, 5, 1),
(83, 3, 6, 11);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `Item_ID` int(11) NOT NULL,
  `Category_ID` int(11) NOT NULL,
  `Item_Image` varchar(100) NOT NULL,
  `Item_Name` varchar(20) NOT NULL,
  `Item_Price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`Item_ID`, `Category_ID`, `Item_Image`, `Item_Name`, `Item_Price`) VALUES
(1, 0, 'Hoodie.jpg', 'UDD Hoodie Jacket', 650),
(2, 0, 'tshirt.webp', 'UDD T-shirt', 450),
(3, 0, 'Varsity.webp', 'UDD Varsity Jacket', 1200);

-- --------------------------------------------------------

--
-- Table structure for table `item_stocks_history`
--

CREATE TABLE `item_stocks_history` (
  `Item_history_ID` int(11) NOT NULL,
  `Date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `Item_ID` int(11) NOT NULL,
  `Size_ID` int(11) NOT NULL,
  `Stocks_added` int(11) NOT NULL,
  `Added_By` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_stocks_history`
--

INSERT INTO `item_stocks_history` (`Item_history_ID`, `Date_added`, `Item_ID`, `Size_ID`, `Stocks_added`, `Added_By`) VALUES
(1, '2023-07-07 15:43:41', 1, 1, 1, 'jake merlin'),
(2, '2023-07-07 15:44:41', 1, 1, 1, 'jake merlin'),
(3, '2023-07-07 16:39:26', 2, 1, 25, 'jake merlin'),
(4, '2023-07-07 16:40:20', 3, 2, 25, 'jake merlin'),
(5, '2023-07-07 16:40:50', 3, 2, 23, 'jake russel lambino'),
(6, '2023-07-10 16:30:06', 3, 6, 10, 'jake merlin'),
(7, '2023-07-12 15:18:29', 1, 1, 1, 'jake merlin'),
(8, '2023-07-12 15:18:31', 1, 1, 1, 'jake merlin'),
(9, '2023-07-12 15:18:34', 1, 1, 1, 'jake merlin'),
(10, '2023-07-12 15:18:37', 1, 1, 1, 'jake merlin'),
(11, '2023-07-12 15:18:39', 1, 1, 1, 'jake merlin'),
(12, '2023-07-12 15:18:41', 1, 1, 1, 'jake merlin'),
(13, '2023-07-12 15:19:08', 1, 1, 1, 'jake merlin'),
(14, '2023-07-12 15:19:44', 1, 1, 1, 'jake merlin'),
(15, '2023-07-12 15:19:48', 1, 1, 1, 'jake merlin'),
(16, '2023-07-12 15:21:44', 1, 1, 1, 'jake merlin'),
(17, '2023-07-12 15:22:01', 1, 1, 2, 'jake merlin'),
(18, '2023-07-12 15:23:07', 1, 1, 2, 'jake merlin'),
(19, '2023-07-12 15:23:17', 1, 1, 3, 'jake merlin'),
(20, '2023-07-12 15:28:49', 1, 1, 1, 'jake merlin'),
(21, '2023-07-12 15:30:05', 1, 2, 1, 'jake merlin'),
(22, '2023-07-12 15:30:15', 1, 2, 6, 'jake merlin'),
(23, '2023-07-12 15:57:36', 1, 1, 1, 'test test'),
(24, '2023-07-12 16:00:39', 1, 1, 1, 'test test'),
(25, '2023-07-12 16:05:00', 3, 1, 10, 'jake russel  merlin');

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `Size_ID` int(11) NOT NULL,
  `Size_Name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`Size_ID`, `Size_Name`) VALUES
(1, 'SMALL'),
(2, 'MEDIUM'),
(3, 'LARGE'),
(4, 'XL'),
(5, 'XXL'),
(6, 'XXXL'),
(18, 'XXXXL');

-- --------------------------------------------------------

--
-- Table structure for table `sold_item_record`
--

CREATE TABLE `sold_item_record` (
  `sold_ID` int(11) NOT NULL,
  `customer_ID` int(11) NOT NULL,
  `Item_Name` varchar(20) NOT NULL,
  `Item_Size` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `Discount` int(11) NOT NULL,
  `Item_Price` int(11) NOT NULL,
  `Total_Price` int(11) NOT NULL,
  `Discounted_Price` int(11) NOT NULL,
  `Date_Sold` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sold_item_record`
--

INSERT INTO `sold_item_record` (`sold_ID`, `customer_ID`, `Item_Name`, `Item_Size`, `quantity`, `Discount`, `Item_Price`, `Total_Price`, `Discounted_Price`, `Date_Sold`) VALUES
(245, 223, 'UDD Varsity Jacket', 'SMALL', 1, 0, 1200, 1200, 1200, '2023-07-07 15:24:39'),
(246, 224, 'UDD Varsity Jacket', 'SMALL', 1, 0, 1200, 1200, 1200, '2023-07-11 15:07:39'),
(248, 226, 'UDD Hoodie Jacket', 'SMALL', 1, 50, 650, 650, 325, '2023-07-12 15:37:58'),
(249, 227, 'UDD Hoodie Jacket', 'MEDIUM', 1, 55, 650, 650, 293, '2023-07-12 15:41:56'),
(254, 232, 'UDD Hoodie Jacket', 'SMALL', 1, 12, 650, 650, 572, '2023-09-12 14:26:22');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_ID` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `user_status` varchar(20) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `activation` varchar(20) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_ID`, `username`, `password`, `user_status`, `first_name`, `lastname`, `activation`, `date_created`) VALUES
(1, 'admin', 'admin', 'admin', 'jake', 'merlin', 'activate', '2023-07-06 11:37:45'),
(2, 'seller', 'seller', 'seller', 'jake', 'merlin', 'activate', '2023-07-06 11:37:45'),
(4, 'jan', 'jan', 'seller', 'jan', 'jan', 'activate', '2023-07-06 11:37:45'),
(11, 'test', 'test', 'seller', 'test', 'test', 'activate', '2023-07-06 11:37:45'),
(14, 'lambino', 'merlin', 'seller', 'jake russel', 'lambino', 'deactivate', '2023-07-06 11:37:45'),
(15, 'testing', 'testing', 'seller', 'testing', 'testing', 'deactivate', '2023-07-06 15:12:13'),
(16, 'andrew', 'andrew', 'seller', 'andrew', 'andrew', 'activate', '2023-07-07 07:23:23'),
(17, 'semiadmin', 'semiadmin', 'semi-admin', 'jake russel ', 'merlin', 'activate', '2023-07-11 15:41:37'),
(18, 'test2', 'test2', 'seller', 'test2', 'test2', 'deactivate', '2023-07-11 16:20:58'),
(19, 'test3', 'test3', 'semi-admin', 'test3', 'test3', 'deactivate', '2023-07-11 16:21:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`Category_ID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_ID`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`Inventory_ID`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`Item_ID`);

--
-- Indexes for table `item_stocks_history`
--
ALTER TABLE `item_stocks_history`
  ADD PRIMARY KEY (`Item_history_ID`);

--
-- Indexes for table `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`Size_ID`);

--
-- Indexes for table `sold_item_record`
--
ALTER TABLE `sold_item_record`
  ADD PRIMARY KEY (`sold_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `Category_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=233;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `Inventory_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `Item_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `item_stocks_history`
--
ALTER TABLE `item_stocks_history`
  MODIFY `Item_history_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `size`
--
ALTER TABLE `size`
  MODIFY `Size_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `sold_item_record`
--
ALTER TABLE `sold_item_record`
  MODIFY `sold_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=255;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

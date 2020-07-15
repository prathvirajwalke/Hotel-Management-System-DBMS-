-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 29, 2019 at 04:03 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ai`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `con_order` (IN `username1` VARCHAR(20), IN `total1` INT)  BEGIN
DECLARE bNumber INT;

INSERT INTO `final_order`(`username`,`total`) VALUES (username1,total1);
SELECT `bill_no` into @bNumber FROM `final_order` ORDER BY `bill_no` DESC LIMIT 1;
insert into pending_order (bill_no,item_name,qty) select @bNumber,temp_cart.item_name,temp_cart.qty from temp_cart where username=username1;
DELETE FROM `temp_cart` WHERE username=username1;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `username` varchar(20) NOT NULL,
  `password` varchar(256) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`username`, `password`, `phone`, `email`) VALUES
('akshaykale', '5eb5e5449ab985cb54ae90dba33ee7f0', 9130101199, 'akshaykale17799@gmail.com'),
('kaushal', 'fdc7fa533f362138a54d93885b03eb6f', 8308605588, 'kaushal.bhandari3@gmail.com'),
('omkar', '3c5645f08b8cc70757d24ae31d88821e', 1111111111, 'omkar@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `final_order`
--

CREATE TABLE `final_order` (
  `username` varchar(20) NOT NULL,
  `bill_no` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `final_order`
--

INSERT INTO `final_order` (`username`, `bill_no`, `total`) VALUES
('kaushal', 4, 740),
('kaushal', 5, 660);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `bill_no` int(11) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `qty` int(11) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `m_name` varchar(20) NOT NULL,
  `m_pass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`m_name`, `m_pass`) VALUES
('manager', 'Manager@123');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `item_name` varchar(50) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`item_name`, `price`) VALUES
('2_X_Cheese_Burger', 80),
('Americano_Coffee', 60),
('Black_Bean_Burger', 60),
('Cappaccino_Coffee', 80),
('Cheese _Burger', 60),
('Cheese_Pizza', 60),
('Chipotle_Sandwich', 70),
('Classical_Sandwich', 70),
('Cocoa_Coffee', 30),
('Cold_Coffee', 40),
('Cold_Coffee_With_Crush', 60),
('Corn_Pizza', 70),
('Espresso_Coffee', 50),
('Garlic_Sandwich', 50),
('Grilled_Sandwich', 70),
('Idli_Sambhar', 40),
('Italian_Pizza', 80),
('Italian_Sandwich', 80),
('Latte_Coffee', 60),
('Margerita_Pizza', 80),
('Masala_Dosa', 60),
('Mocha_Coffee', 70),
('Napolian_Sandwich', 60),
('Omlete', 60),
('Onion_Cheese_Pizza', 70),
('Panner_Burger', 70),
('Panner_Cheese_Burger', 80),
('Panner_Cheese_Pizza', 90),
('Panner_Pizza', 70),
('Paratha', 40),
('Poha', 30),
('Sheera', 30),
('Special_Burger', 90),
('Turkey_Burger', 80),
('Upma', 30),
('Uttappa', 50),
('Veg_Burger', 50),
('Veg_Cheese_Sandwich', 60),
('Veg_Pizza', 80),
('Veg_Sandwich', 50);

-- --------------------------------------------------------

--
-- Table structure for table `pending_order`
--

CREATE TABLE `pending_order` (
  `bill_no` int(11) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `qty` int(11) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Preparing'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pending_order`
--

INSERT INTO `pending_order` (`bill_no`, `item_name`, `qty`, `status`) VALUES
(4, 'Idli_Sambhar', 8, 'Preparing'),
(4, 'Masala_Dosa', 2, 'Preparing'),
(4, 'Omlete', 3, 'Preparing'),
(5, 'Idli_Sambhar', 3, 'Preparing'),
(5, 'Masala_Dosa', 1, 'Preparing'),
(5, 'Omlete', 8, 'Preparing');

-- --------------------------------------------------------

--
-- Table structure for table `temp_cart`
--

CREATE TABLE `temp_cart` (
  `username` varchar(20) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `final_order`
--
ALTER TABLE `final_order`
  ADD PRIMARY KEY (`bill_no`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD KEY `bill_no` (`bill_no`),
  ADD KEY `item_name` (`item_name`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`m_name`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`item_name`);

--
-- Indexes for table `pending_order`
--
ALTER TABLE `pending_order`
  ADD KEY `bill_no` (`bill_no`),
  ADD KEY `item_name` (`item_name`);

--
-- Indexes for table `temp_cart`
--
ALTER TABLE `temp_cart`
  ADD KEY `username` (`username`),
  ADD KEY `item_name` (`item_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `final_order`
--
ALTER TABLE `final_order`
  MODIFY `bill_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `final_order`
--
ALTER TABLE `final_order`
  ADD CONSTRAINT `final_order_ibfk_1` FOREIGN KEY (`username`) REFERENCES `customer` (`username`);

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`bill_no`) REFERENCES `final_order` (`bill_no`),
  ADD CONSTRAINT `logs_ibfk_2` FOREIGN KEY (`item_name`) REFERENCES `menu` (`item_name`);

--
-- Constraints for table `pending_order`
--
ALTER TABLE `pending_order`
  ADD CONSTRAINT `pending_order_ibfk_1` FOREIGN KEY (`bill_no`) REFERENCES `final_order` (`bill_no`),
  ADD CONSTRAINT `pending_order_ibfk_2` FOREIGN KEY (`item_name`) REFERENCES `menu` (`item_name`);

--
-- Constraints for table `temp_cart`
--
ALTER TABLE `temp_cart`
  ADD CONSTRAINT `temp_cart_ibfk_1` FOREIGN KEY (`username`) REFERENCES `customer` (`username`),
  ADD CONSTRAINT `temp_cart_ibfk_2` FOREIGN KEY (`item_name`) REFERENCES `menu` (`item_name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

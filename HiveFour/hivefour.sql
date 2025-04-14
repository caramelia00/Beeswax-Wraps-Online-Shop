-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2024 at 01:34 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hivefour`
--
DROP DATABASE IF EXISTS `hivefour`;
CREATE DATABASE IF NOT EXISTS `hivefour` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `hivefour`;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `Order_ID` varchar(45) NOT NULL,
  `Order_Date` varchar(45) NOT NULL,
  `Order_Time` varchar(45) NOT NULL,
  `Status_ID` varchar(45) DEFAULT NULL,
  `User_ID` varchar(45) DEFAULT NULL,
  `Payment_Receipt` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`Order_ID`, `Order_Date`, `Order_Time`, `Status_ID`, `User_ID`, `Payment_Receipt`) VALUES
('O01', '2024-05-01', '10:00:00.000000', 'S04', 'U01', '../../assets/payReceipt/O01.pdf'),
('O02', '2024-05-02', '11:15:00.000000', 'S01', 'U02', '../../assets/payReceipt/O02.pdf'),
('O03', '2024-05-03', '09:30:00.000000', 'S03', 'U03', '../../assets/payReceipt/O03.pdf'),
('O04', '2024-06-15', '04:54:53', 'S01', 'U01', '../../assets/payReceipt/O04.pdf'),
('O05', '2024-06-15', '05:13:34', 'S01', 'U06', '../../assets/payReceipt/O05.pdf'),
('O07', '2024-06-26', '08:28:00', 'S03', 'U05', '../../assets/payReceipt/O07.pdf'),
('O08', '2024-06-28', '10:10:16', 'S04', 'U10', '../../assets/payReceipt/O08.png'),
('O09', '2024-06-28', '10:27:42', 'S01', 'U10', '../../assets/payReceipt/O09.png'),
('O10', '2024-07-03', '04:14:49', 'S01', 'U11', '../../assets/payReceipt/O10.png'),
('O11', '2024-07-03', '04:46:53', 'S02', 'U05', '../../assets/payReceipt/O11.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `Order_Details_ID` varchar(45) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Product_ID` varchar(45) DEFAULT NULL,
  `Order_ID` varchar(45) DEFAULT NULL,
  `Size_ID` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`Order_Details_ID`, `Quantity`, `Product_ID`, `Order_ID`, `Size_ID`) VALUES
('OD01', 2, 'PD1', 'O01', 'S'),
('OD02', 3, 'PD2', 'O02', 'L'),
('OD03', 6, 'PD3', 'O03', 'M'),
('OD04', 9, 'PD2', 'O04', 'M'),
('OD05', 1, 'PD3', 'O04', 'S'),
('OD06', 3, 'PD2', 'O05', 'S'),
('OD09', 1, 'PD7', 'O07', 'M'),
('OD10', 2, 'PD4', 'O07', 'S'),
('OD11', 2, 'PD6', 'O08', 'S'),
('OD12', 1, 'PD1', 'O08', 'L'),
('OD13', 2, 'PD2', 'O08', 'M'),
('OD14', 1, 'PD2', 'O09', 'L'),
('OD15', 2, 'PD2', 'O10', 'M'),
('OD16', 1, 'PD6', 'O11', 'S');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `Product_ID` varchar(45) NOT NULL,
  `Product_Name` varchar(45) NOT NULL,
  `Product_Image` varchar(60) DEFAULT NULL,
  `Product_Status_ID` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`Product_ID`, `Product_Name`, `Product_Image`, `Product_Status_ID`) VALUES
('PD1', 'Earth & Sun Beeswax Wraps', '../../assets/prodPic/PD1.png', 'PDS1'),
('PD2', 'Gummy Bears Beeswax Wraps', '../../assets/prodPic/PD2.png', 'PDS1'),
('PD3', 'Dried Caesalpinia Flower Beeswax Wraps', '../../assets/prodPic/PD3.png', 'PDS1'),
('PD4', 'Red & Green Beeswax Wraps', '../../assets/prodPic/PD4.png', 'PDS1'),
('PD5', 'Fried Chicken Beeswax Wraps', '../../assets/prodPic/PD5.png', 'PDS2'),
('PD6', 'Hari Hari Raya Beeswax Wraps', '../../assets/prodPic/PD6.png', 'PDS1'),
('PD7', 'UiTM Di Hatiku Beeswax Wraps', '../../assets/prodPic/PD7.png', 'PDS1'),
('PD8', 'I am (Not) Ok Beeswax Wraps', '../../assets/prodPic/PD8.png', 'PDS1');

-- --------------------------------------------------------

--
-- Table structure for table `product_status`
--

CREATE TABLE `product_status` (
  `Product_Status_ID` varchar(45) NOT NULL,
  `Status_Name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_status`
--

INSERT INTO `product_status` (`Product_Status_ID`, `Status_Name`) VALUES
('PDS1', 'Available'),
('PDS2', 'Unavailable');

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `Size_ID` varchar(45) NOT NULL,
  `Size_Name` varchar(45) NOT NULL,
  `Size_Description` varchar(50) DEFAULT NULL,
  `Size_Price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`Size_ID`, `Size_Name`, `Size_Description`, `Size_Price`) VALUES
('L', 'Large', '13\" x 14\"', 25),
('M', 'Medium', '10\" x 11\"', 20),
('S', 'Small', '7\" x 8\"', 10);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `Status_ID` varchar(45) NOT NULL,
  `Status_Name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`Status_ID`, `Status_Name`) VALUES
('S01', 'Pending'),
('S02', 'Preparing'),
('S03', 'Delivered'),
('S04', 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `User_ID` varchar(45) NOT NULL,
  `User_Name` varchar(45) NOT NULL,
  `User_Full_Name` varchar(50) NOT NULL,
  `User_Email` varchar(45) NOT NULL,
  `User_Password` varchar(255) NOT NULL,
  `Profile_Pic` varchar(60) NOT NULL,
  `Type_ID` varchar(46) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`User_ID`, `User_Name`, `User_Full_Name`, `User_Email`, `User_Password`, `Profile_Pic`, `Type_ID`) VALUES
('U01', 'amzati200', 'Amirah Izzati Binti Aminuddin', 'amirah@gmail.com', '$2y$10$ntmcfveHLwRNgy1VoKwq.OmUNJvGRXo7I8L1.1IWS54PbLgAcZ5MG', '../../assets/userPic/amirah.jpg', 'UT01'),
('U02', 'aalifAziz', 'Aliff Aziz Bin Alif Syukri', 'aaziz@gmail.com', '$2y$10$Q1k0hZlFasuIngSPUCmCAeDbfhz1lKqRmiCC/p1ziP80.QtfGiVMm', '../../assets/userPic/alif.jpg', 'UT01'),
('U03', 'syabat04', 'Nur Batrisyia Binti Norul Haizal', 'batrisyia@gmail.com', '$2y$10$YT0YfR1skQ6ucW0omtlk/ez9B6lhBgkk7bQTmJOrItnzlO/KfgFI2', '../../assets/userPic/batrisyia.jpg', 'UT01'),
('U04', 'aidandellion', 'Aida Syazwani Binti Samani', 'aida@gmail.com', '$2y$10$zgs1igpdBWym8tbRl3lD6OOrYpjZcxfCjeOlMCJSgCHWPuBVsmv1i', '../../assets/userPic/aida.jpg', 'UT02'),
('U05', 'a_alicafe23', 'Nurul Aliah Haifaa Binti Nasiruddin', 'aliah@gmail.com', '$2y$10$oqQRdqK.tUxnxfxFgtw.jOM3s/fm1xKDw3IlSjOuSNoMRMBXoZNWm', '../../assets/userPic/aliah.jpg', 'UT01'),
('U06', 'Ainaalysha', 'Aina Alysha Binti Mohd Nasir', 'ainaalysha01@gmail.com', '$2y$10$5lWcq5z5x8m9qF.q8XsRjujqF588fSadstjvCg7Fw8vXS4pdoddn2', '../../assets/userPic/U06.png', 'UT01'),
('U07', 'aida04', 'Aida Shazwani Binti Samani', 'aida04@gmail.com', '$2y$10$LJN0X4rHNiW2RFZbowGC5OX.LSCHMnQtEkUsZgmQe8UV1Ta2ZlnWi', '../../assets/userPic/U07.jpg', 'UT01'),
('U08', 'f', 'f', 'f@gmail.com', '$2y$10$TRAie3Xh5Bmf/edEIzvRq.Jy.M0nSAmgQ.VH96Tpydl9VfYp0kBhO', '../../assets/userPic/default.jpg', 'UT01'),
('U09', 'rozeleenda', 'Madam Rozeelenda', 'rozel@gmail.com', '$2y$10$FwUgSAMas8OIOmCH/ZVzkOYjI6p0cCkv2b2W2hUfjZT7SS/ESeDva', '../../assets/userPic/default.jpg', 'UT01'),
('U10', 'saqyfh', 'khadijah saqifah', 'saqifah@gmail.com', '$2y$10$BA/X.7MfcstYnKvuuTA1Cub0SLzt6b4eKswCrOsh8IQA8CWuVYpsa', '../../assets/userPic/U10.jpg', 'UT01'),
('U11', 'AdibAlea', 'Nuradibalea Ibtisam binti Mohd Afandi', 'adibalea@gmail.com', '$2y$10$whAT1L1WhUNpKePiZ2am2OhUNL/ADfH98DK/aJfCKxtT8lw2phpJi', '../../assets/userPic/default.jpg', 'UT01'),
('U12', 'ff', 'f', 'ff@gmail.com', '$2y$10$J6XF6e8rhX6CgXWaNeji3eRBwFep4McCJ8UsgLoIPdDOgPzvpWtfm', '../../assets/userPic/default.jpg', 'UT01');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `User_Details_ID` varchar(45) NOT NULL,
  `Address1` varchar(50) NOT NULL,
  `Address2` varchar(50) DEFAULT NULL,
  `Postcode` varchar(45) NOT NULL,
  `State` varchar(45) NOT NULL,
  `City` varchar(45) NOT NULL,
  `Phone_No` varchar(45) NOT NULL,
  `User_ID` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`User_Details_ID`, `Address1`, `Address2`, `Postcode`, `State`, `City`, `Phone_No`, `User_ID`) VALUES
('UD01', '123, Jalan Tun Razak', 'Apartment B, Unit 2B', '50400', 'WP Kuala Lumpur', 'Kuala Lumpur', '0124248001', 'U01'),
('UD02', '45, Jalan Ampang', 'Taman Ampang', '68000', 'WP Kuala Lumpur', 'Ampang', '01239485760', 'U02'),
('UD03', '789, Jalan Sultan Ismail', 'NULL', '50250', 'WP Kuala Lumpur', 'Kuala Lumpur', '0146060411', 'U03'),
('UD04', 'Lot 2410, Lorong Kenanga', 'Kampung Sijangkang', '42500', 'Selangor', 'Telok Panglima Garang', '01647839256', 'U04'),
('UD05', '12, Jalan Kuchai Lama', 'NULL', '58200', 'WP Kuala Lumpur', 'Kuala Lumpur', '01452378695', 'U05'),
('UD06', 'No 37, Lorong Sungai Isap Damai 25', 'r', '25150', 'Pahang', 'Kuantan', '011-17825256', 'U06'),
('UD07', 'Floor 99', 'Menara KLCC', '0000', 'WP Kuala Lumpur', 'Kuala Lumpur', '011111111', 'U07'),
('UD08', 'f', ' ', 'f', 'f', 'f', 'f', 'U08'),
('UD09', 'UiTM Raub', 'Cawangan Pahang', '0000', 'Pahang', 'Raub', '0112345678', 'U09'),
('UD10', 'LOT 2410, JALAN KENANGA, KAMPUNG SIJANGKANG', 'KL', '42500', 'SELANGOR', 'TELOK PANGLIMA GARANG', '01163840791', 'U10'),
('UD11', 'No 77, Jalan Shahbandar 3, ', 'Taman Shahbandar', '27600', 'Pahang', 'Raub', '01139233317', 'U11'),
('UD12', 'f', 'f', 'f', 'f', 'f', 'f', 'U12');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `Type_ID` varchar(45) NOT NULL,
  `Type_Name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`Type_ID`, `Type_Name`) VALUES
('UT01', 'Customer'),
('UT02', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Order_ID`),
  ADD KEY `Status_ID` (`Status_ID`),
  ADD KEY `User_ID` (`User_ID`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`Order_Details_ID`),
  ADD KEY `Product_ID` (`Product_ID`),
  ADD KEY `Order_ID` (`Order_ID`),
  ADD KEY `Size_ID` (`Size_ID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`Product_ID`),
  ADD KEY `fk_product_status` (`Product_Status_ID`);

--
-- Indexes for table `product_status`
--
ALTER TABLE `product_status`
  ADD PRIMARY KEY (`Product_Status_ID`);

--
-- Indexes for table `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`Size_ID`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`Status_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`User_ID`),
  ADD KEY `Type_ID` (`Type_ID`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`User_Details_ID`),
  ADD KEY `User_ID` (`User_ID`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`Type_ID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`Status_ID`) REFERENCES `status` (`Status_ID`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`User_ID`) REFERENCES `users` (`User_ID`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`Product_ID`) REFERENCES `product` (`Product_ID`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`Order_ID`) REFERENCES `orders` (`Order_ID`),
  ADD CONSTRAINT `order_details_ibfk_3` FOREIGN KEY (`Size_ID`) REFERENCES `size` (`Size_ID`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_product_status` FOREIGN KEY (`Product_Status_ID`) REFERENCES `product_status` (`Product_Status_ID`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`Type_ID`) REFERENCES `user_type` (`Type_ID`);

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `user_details_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `users` (`User_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2024 at 09:46 AM
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
-- Database: `utmadvance`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Contact` varchar(255) NOT NULL,
  `Verification_code` varchar(255) NOT NULL,
  `Profile_photo` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Username`, `Password`, `Email`, `Address`, `Contact`, `Verification_code`, `Profile_photo`) VALUES
('Admin Test', '$2y$10$Ed1c0GkmVyntXM3FYiZFbOz4NdKWsRR4KXFzCoYxULcWp9FBRKIwy', 'ngezheyu1225@gmail.com', '1A, Jalan A', '01110884238', '249738', '../Uploads/Screenshot (421).png');

-- --------------------------------------------------------

--
-- Table structure for table `blazer`
--

CREATE TABLE `blazer` (
  `BlazerID` int(11) NOT NULL,
  `ProductID` int(11) DEFAULT NULL,
  `ProductName` varchar(255) DEFAULT NULL,
  `SizeS` int(11) DEFAULT NULL,
  `SizeM` int(11) DEFAULT NULL,
  `SizeL` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blazer`
--

INSERT INTO `blazer` (`BlazerID`, `ProductID`, `ProductName`, `SizeS`, `SizeM`, `SizeL`) VALUES
(7, 3, 'Blazer1', 0, 0, 0),
(10, 11, 'Blazer3', 0, 0, 0),
(11, 12, 'Blazer4', 3, 5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `CartID` int(11) NOT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `ProductID` int(11) DEFAULT NULL,
  `Size` varchar(10) DEFAULT NULL,
  `Quantity` int(11) DEFAULT 1,
  `AddedDate` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Contact` varchar(255) NOT NULL,
  `Verification_code` varchar(255) NOT NULL,
  `Profile_photo` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Username`, `Password`, `Email`, `Address`, `Contact`, `Verification_code`, `Profile_photo`) VALUES
('NgeZY', '$2y$10$OJjKZwFvEPxJz62vRfpROOFdV4L4qt6SOnsytbLU2uwrTyubWCosK', 'zheyunge@gmail.com', '1A, Jalan Azman', '01110884238', '864224', '../Uploads/Screenshot (448).png'),
('fenrir', '$2y$10$T7C1UDmppSLpMd5F4zEG9.FZiRQb9/ISBnWUOtWacJ8WIeix4UBPy', 'alnhakim2005@gmail.com', 'Pacific bay', '0139650334', '232195', '../Uploads/fwen.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Subject` varchar(255) NOT NULL,
  `Message` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`Name`, `Email`, `Subject`, `Message`) VALUES
('Test', 'zheyunge@gmail.com', 'Test', 'Testing123'),
('Nge', 'zheyunge@gmail.com', 'Test', 'Test123'),
('Customer', 'majob16748@rogtat.com', 'CustomerTest', 'Test123'),
('joe', 'joeyichin123@gmail.com', 'Hello', '\nhello website\n\n'),
('Nge', 'zheyunge@gmail.com', 'Guest Feedback', 'Hello'),
('Nge', 'zheyunge04@gmail.com', 'Customer Feedback', 'Hi'),
('Nge', 'zheyunge@gmail.com', 'Test', 'Test meeting');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `OrderID` int(11) NOT NULL,
  `CustomerName` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Total` decimal(10,2) NOT NULL,
  `OrderDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `Status` enum('Pending','Processing','Shipped','Delivered','Cancelled') DEFAULT 'Pending',
  `ShippingAddress` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`OrderID`, `CustomerName`, `Email`, `Total`, `OrderDate`, `Status`, `ShippingAddress`) VALUES
(1, 'Nge Zhe Yu', 'ngezy041225@gmail.com', 129.00, '2024-10-18 07:38:34', 'Pending', '1A, Jalan A');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `OrderItemID` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `Size` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`OrderItemID`, `OrderID`, `ProductID`, `Quantity`, `Price`, `Size`) VALUES
(1, 1, 1, 1, 40.00, 'S'),
(2, 1, 3, 1, 89.00, 'M');

-- --------------------------------------------------------

--
-- Table structure for table `password`
--

CREATE TABLE `password` (
  `Admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password`
--

INSERT INTO `password` (`Admin_password`) VALUES
('1225');

-- --------------------------------------------------------

--
-- Table structure for table `pending_verification`
--

CREATE TABLE `pending_verification` (
  `id` int(11) NOT NULL,
  `Username` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Contact` varchar(255) DEFAULT NULL,
  `Role` enum('admin','customer') NOT NULL,
  `verification_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pending_verification`
--

INSERT INTO `pending_verification` (`id`, `Username`, `Password`, `Email`, `Address`, `Contact`, `Role`, `verification_token`, `created_at`) VALUES
(15, 'dada', '$2y$10$Kmyc4v629ApMxJbo2bKvYenuMOrLCnhv80uCiNno8LSJgFduQQKrG', 'dabed25144@baakal.com', '', '5525', 'customer', '93050a8ecef76c061ccfe7e7ef1d825a', '2024-09-10 02:32:04'),
(16, 'da', '$2y$10$pkedgCdzTuH6ktCRVRymB.FIsJT09ZyGWjoLJCjVqiXCEx/L.XHWm', 'relami8288@rogtat.com', '', '0124233292', 'customer', '7c185eb1c09236992deded3953b7bc21', '2024-09-10 02:34:14'),
(17, 'da', '$2y$10$Yp5zIj3TOar09MYbCwJ8IeOuTaFRviEObs1GZVtog6/vwWliIcLmm', 'relami8288@rogat.com', 'dad', '', 'customer', '45d5e477ad79d8d9f6b821bb6dd6d859', '2024-09-10 02:36:39'),
(18, 'da', '$2y$10$cveu4X3m2tJ.A7fcoeSmNeFEOqhkJ1tZbCMExdwWlEu2YKAe12LT6', 'relami8288@roat.com', 'dad', '', 'customer', '3ff1025763d785c6b7d827d61b73d149', '2024-09-10 02:37:02');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(255) NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `Category` varchar(100) NOT NULL,
  `StockQuantity` int(11) NOT NULL,
  `Status` varchar(50) NOT NULL,
  `Image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ProductID`, `ProductName`, `Price`, `Category`, `StockQuantity`, `Status`, `Image`) VALUES
(1, 'Shirt1', 40.00, 'Shirts', 12, 'In Stock', '../Products/WhatsApp Image 2024-10-08 at 10.36.49_f3de0f54.jpg'),
(3, 'Blazer1', 89.00, 'Blazers', 0, 'Not In Stock', '../Products/WhatsApp Image 2024-10-08 at 11.33.20_7e5989a8.jpg'),
(4, 'Accessories1', 10.00, 'Accessories', 29, 'In Stock', '../Products/WhatsApp Image 2024-10-08 at 10.32.51_3369d8be.jpg'),
(5, 'Shirt2', 35.00, 'Shirts', 28, 'In Stock', '../Products/WhatsApp Image 2024-10-08 at 10.38.18_b01c0ccf.jpg'),
(6, 'Shirt3', 44.00, 'Shirts', 0, 'Not In Stock', '../Products/WhatsApp Image 2024-10-08 at 10.39.48_2d21cda0.jpg'),
(8, 'Accessories2', 20.00, 'Accessories', 0, 'Not In Stock', '../Products/WhatsApp Image 2024-10-08 at 10.34.08_72b0ed73.jpg'),
(9, 'Accessories3', 8.00, 'Accessories', 7, 'In Stock', '../Products/77c804e1fa1178d04e29d1c1775f1b2b[1].jpg'),
(11, 'Blazer3', 85.00, 'Blazers', 0, 'Not In Stock', '../Products/WhatsApp Image 2024-10-08 at 11.37.12_120849f0.jpg'),
(12, 'Blazer4', 79.00, 'Blazers', 11, 'In Stock', '../Products/WhatsApp Image 2024-10-08 at 14.03.10_5258b30f.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `shirt`
--

CREATE TABLE `shirt` (
  `ShirtID` int(11) NOT NULL,
  `ProductID` int(11) DEFAULT NULL,
  `ProductName` varchar(255) DEFAULT NULL,
  `SizeS` int(11) DEFAULT NULL,
  `SizeM` int(11) DEFAULT NULL,
  `SizeL` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shirt`
--

INSERT INTO `shirt` (`ShirtID`, `ProductID`, `ProductName`, `SizeS`, `SizeM`, `SizeL`) VALUES
(1, 1, 'Shirt1', 6, 2, 4),
(3, 5, 'Shirt2', 12, 13, 3),
(4, 6, 'Shirt3', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Contact` varchar(255) NOT NULL,
  `Verification_code` varchar(255) NOT NULL,
  `Profile_photo` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`Username`, `Password`, `Email`, `Address`, `Contact`, `Verification_code`, `Profile_photo`) VALUES
('Staff Test', '$2y$10$l5BllUUfVNCC5FB4w1qN.OgiG40.h7BVT/Ul6lli9.36FvtJpeZti', 'ngezy041225@gmail.com', '1A, Jalan A', '01242332923', '753507', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blazer`
--
ALTER TABLE `blazer`
  ADD PRIMARY KEY (`BlazerID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`CartID`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`OrderID`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`OrderItemID`);

--
-- Indexes for table `pending_verification`
--
ALTER TABLE `pending_verification`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ProductID`);

--
-- Indexes for table `shirt`
--
ALTER TABLE `shirt`
  ADD PRIMARY KEY (`ShirtID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blazer`
--
ALTER TABLE `blazer`
  MODIFY `BlazerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `CartID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `OrderItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pending_verification`
--
ALTER TABLE `pending_verification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `shirt`
--
ALTER TABLE `shirt`
  MODIFY `ShirtID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blazer`
--
ALTER TABLE `blazer`
  ADD CONSTRAINT `blazer_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`);

--
-- Constraints for table `shirt`
--
ALTER TABLE `shirt`
  ADD CONSTRAINT `shirt_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

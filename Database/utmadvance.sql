-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2024 at 12:23 PM
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
(7, 3, 'Test3', 10, 15, 7);

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
('fenrir', '$2y$10$T7C1UDmppSLpMd5F4zEG9.FZiRQb9/ISBnWUOtWacJ8WIeix4UBPy', 'alnhakim2005@gmail.com', 'Pacific bay', '0139650334', '232195', '../Uploads/fwen.jpg'),
('joeyichin', '$2y$10$kAL0CkSDrQDnErKlZ0OEaesnNuM1hBxhr54WK/US8I/Wc3FWzzh46', 'joeyichin123@gmail.com', '123 Banana Street', '0124233292', '386739', ''),
('Customer 1', '$2y$10$P5Mj6Xv4NMCM1gsh3nXQnOekDAvyGMOJ98fMKj//8veZap5oO3URm', 'zheyunge04@gmail.com', '1A, Jalan A', '01110884238', '540368', '../Uploads/Screenshot (482).png');

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
(1, 'Test', 10.00, 'Shirts', 9, 'In Stock', '../Products/Screenshot (473).png'),
(3, 'Test3', 90.00, 'Blazers', 32, 'Not In Stock', NULL),
(4, 'Test4', 45.00, 'Accessories', 29, 'In Stock', '../Products/Screenshot 2024-09-28 181519.png'),
(5, 'Test5', 101.00, 'Shirts', 28, 'In Stock', '../Products/Screenshot (469).png');

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
(1, 1, 'Test', 3, 2, 4),
(3, 5, 'Test5', 12, 13, 3);

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
  MODIFY `BlazerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pending_verification`
--
ALTER TABLE `pending_verification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `shirt`
--
ALTER TABLE `shirt`
  MODIFY `ShirtID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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

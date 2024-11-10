-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主机： localhost:3306
-- 生成日期： 2024-11-10 04:56:40
-- 服务器版本： 8.0.39-30
-- PHP 版本： 8.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `hynmhemy_utmadvance`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE `admin` (
  `Username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Contact` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Verification_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Profile_photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`Username`, `Password`, `Email`, `Address`, `Contact`, `Verification_code`, `Profile_photo`) VALUES
('ZYNge', '$2y$10$Ed1c0GkmVyntXM3FYiZFbOz4NdKWsRR4KXFzCoYxULcWp9FBRKIwy', 'ngezheyu1225@gmail.com', '1A, Jalan Azman, Kampung Merdeka, 83000 Batu Pahat, Johor.', '01110884238', '249738', '../Uploads/Screenshot (25).png'),
('fenrir', '$2y$10$xL6de2.AohpIJbBeqEwBtuoEgHGQKoGrJ3Q3EayJVksh.UOTgZfE2', 'fenrirwarwolf@gmail.com', 'Pacific bay', '0107077700', NULL, NULL),
('almuqrameen', '$2y$10$CjrkF3oNURUiuH2eelPEzeRZjxvbcUaw5yDF9vjmPNEGnwisYOAey', 'muqralol@gmail.com', 'kl', '01110069484', NULL, NULL),
('Potato', '$2y$10$3cXt0DThsMg5cMjzT8IVkuod6uf2zb4PZjiTrBfgsmkqUTeR2dHDm', 'fenrirsyonanto@gmail.com', 'Potato empire near asuka\'s house ', '0139650331', NULL, NULL),
('joeyichin', '$2y$10$NLxnYcBDvB6PEvJOfYx/W.P4/LkDXw53C2NnxsWQ.QQ/quQDKsOpa', 'joeyichin@gmail.com', 'ABC 123', '0124233292', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `blazer`
--

CREATE TABLE `blazer` (
  `BlazerID` int NOT NULL,
  `ProductID` int DEFAULT NULL,
  `ProductName` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `SizeS` int DEFAULT NULL,
  `SizeM` int DEFAULT NULL,
  `SizeL` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `blazer`
--

INSERT INTO `blazer` (`BlazerID`, `ProductID`, `ProductName`, `SizeS`, `SizeM`, `SizeL`) VALUES
(7, 3, 'Blazer1', 0, 0, 0),
(10, 11, 'Blazer3', 0, 0, 0),
(11, 12, 'Blazer4', 3, 5, 3),
(13, 19, 'Blazer5', 0, 0, 0),
(14, 20, 'Blazer6', 2, 3, 4);

-- --------------------------------------------------------

--
-- 表的结构 `cart`
--

CREATE TABLE `cart` (
  `CartID` int NOT NULL,
  `Email` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ProductID` int DEFAULT NULL,
  `Size` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Quantity` int DEFAULT '1',
  `AddedDate` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `cart`
--

INSERT INTO `cart` (`CartID`, `Email`, `ProductID`, `Size`, `Quantity`, `AddedDate`) VALUES
(15, 'muqralol@gmail.com', 1, 'M', 1, '2024-11-02 10:06:20'),
(28, 'ngezheyu1225@gmail.com', 4, NULL, 1, '2024-11-04 00:44:59'),
(30, 'fenrirsyonanto@gmail.com', 12, 'M', 1, '2024-11-04 01:05:23'),
(33, 'joeyichin123@gmail.com', 1, 'M', 1, '2024-11-04 07:34:50'),
(34, 'dayangnurnazihah.m@gmail.com', 4, NULL, 1, '2024-11-04 19:31:40');

-- --------------------------------------------------------

--
-- 表的结构 `customer`
--

CREATE TABLE `customer` (
  `Username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Contact` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Verification_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Profile_photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `customer`
--

INSERT INTO `customer` (`Username`, `Password`, `Email`, `Address`, `Contact`, `Verification_code`, `Profile_photo`) VALUES
('NgeZY', '$2y$10$OJjKZwFvEPxJz62vRfpROOFdV4L4qt6SOnsytbLU2uwrTyubWCosK', 'zheyunge@gmail.com', '1A, Jalan Azman', '01110884238', '864224', '../Uploads/Screenshot (448).png'),
('fenrir', '$2y$10$T7C1UDmppSLpMd5F4zEG9.FZiRQb9/ISBnWUOtWacJ8WIeix4UBPy', 'alnhakim2005@gmail.com', 'Pacific bay', '0139650334', '789587', '../Uploads/fwen.jpg'),
('asdf', '$2y$10$fLgaGPiwKfj084nZqwlM7ui1PrW2bwtxqwb1ihYIRY/JkQl452d0S', 'xareg46838@bulatox.com', 'pasar ikhwan di putrajaya', '1231231321', NULL, NULL),
('abuyaskibidi', '$2y$10$DWJbICOA4aS86GrHuCUrn.lImMZwVcCKuBOwipSenTlZVkO36KbKm', 's1luipj3eu@somelora.com', 'pasar ikhwan di putrajaya', '1231313223', NULL, NULL),
('CustomerTest', '$2y$10$cnMBFBUi9NslJ5XBrzsipuhDWW.nE8C2ycaEXO2NwPnJf9h/aLZH2', 'zyzyzyzy1225@gmail.com', '1A, Jalan A', '01110884238', NULL, NULL),
('abuyasigma', '$2y$10$YDeUNej.GjomtWlkqUPCh.DsfxBflW3TI1r3HItsCXKXnaL.TPMhS', 'aimanafiq05@gmail.com', 'pasar ikhwan di putrajaya', '01232323232', NULL, NULL),
('zerol', '$2y$10$TxhlZN7bY4Ma9KcGepRrD.9H1JZyjJzANz71LR4YyXI.MKyk.8QRa', 'almuqrameen@gmail.com', 'klkl', '01110069484', NULL, NULL),
('hakim', '$2y$10$eS0yXq7fTyx8wVGT1y78qeBClq0rYg3h7Xl21GToMcwtt6E67M3i.', 'alnhakim2004@gmail.com', 'Pacific bay', '0107077700', NULL, NULL),
('joeyichin123@gmail.com', '$2y$10$f9hrqHRplj/42p.kFwFXw.o0EqtQCJRWjRFVr0yzRGdHw7ahZtb.q', 'joeyichin123@gmail.com', '123 abc', '0124233292', NULL, NULL),
('dayangnurnazihah', '$2y$10$6x1MZ/lJm5IwfM5kT1IZgeEMEvsDKVkx.Og4uCb9McEhjBN8TSG0W', 'dayangnurnazihah.m@gmail.com', 'SERI KEMBANGAN', '60105190074', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `feedback`
--

CREATE TABLE `feedback` (
  `Name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Subject` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Message` longtext COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `feedback`
--

INSERT INTO `feedback` (`Name`, `Email`, `Subject`, `Message`) VALUES
('Test', 'zheyunge@gmail.com', 'Test', 'Testing123'),
('Nge', 'zheyunge@gmail.com', 'Test', 'Test123'),
('Customer', 'majob16748@rogtat.com', 'CustomerTest', 'Test123'),
('joe', 'joeyichin123@gmail.com', 'Hello', '\nhello website\n\n'),
('Nge', 'zheyunge@gmail.com', 'Guest Feedback', 'Hello'),
('Nge', 'zheyunge04@gmail.com', 'Customer Feedback', 'Hi'),
('Nge', 'zheyunge@gmail.com', 'Test', 'Test meeting'),
('HostTest', 'zheyunge@gmail.com', 'Test Host', 'Host testing');

-- --------------------------------------------------------

--
-- 表的结构 `order`
--

CREATE TABLE `order` (
  `OrderID` int NOT NULL,
  `CustomerName` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Total` decimal(10,2) NOT NULL,
  `OrderDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Status` enum('Pending','Processing','Shipped','Delivered','Cancelled') COLLATE utf8mb4_general_ci DEFAULT 'Pending',
  `ShippingAddress` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `order`
--

INSERT INTO `order` (`OrderID`, `CustomerName`, `Email`, `Total`, `OrderDate`, `Status`, `ShippingAddress`) VALUES
(1, 'Nge Zhe Yu', 'ngezy041225@gmail.com', 129.00, '2024-10-18 07:38:34', 'Processing', '1A, Jalan A'),
(2, 'Nge Zhe Yu', 'zheyunge@gmail.com', 40.00, '2024-10-30 05:12:37', 'Pending', '1A, Jalan Azman'),
(3, 'Nge Zhe Yu', 'zheyunge@gmail.com', 89.00, '2024-10-30 05:15:57', 'Pending', '1A, Jalan Azman'),
(4, 'Nge Zhe Yu', 'zheyunge@gmail.com', 10.00, '2024-10-30 05:34:09', 'Pending', '1A, Jalan Azman'),
(5, 'Nge Zhe Yu', 'zheyunge@gmail.com', 44.00, '2024-10-30 05:38:22', 'Pending', '1A, Jalan Azman'),
(6, 'Nge Zhe Yu', 'zheyunge@gmail.com', 35.00, '2024-10-30 05:41:15', 'Pending', '1A, Jalan Azman'),
(7, 'Nge Zhe Yu', 'zheyunge@gmail.com', 8.00, '2024-10-30 05:47:06', 'Pending', '1A, Jalan Azman'),
(8, '2 3', 'zheyunge@gmail.com', 54.00, '2024-10-30 05:47:57', 'Pending', '1A, Jalan Azman'),
(9, 'AL AL SAUFFEEN', 'almuqrameen@gmail.com', 40.00, '2024-11-02 16:15:02', 'Pending', 'asdasd'),
(10, 'AL AL SAUFFEEN', 'almuqrameen@gmail.com', 89.00, '2024-11-02 16:19:23', 'Pending', 'asda'),
(11, 'AL AL SAUFFEEN', 'almuqrameen@gmail.com', 40.00, '2024-11-02 16:36:59', 'Pending', 'qew'),
(12, 'sd sda', 'almuqrameen@gmail.com', 40.00, '2024-11-02 16:46:10', 'Pending', 'aa'),
(13, 'AL AL SAUFFEEN', 'almuqrameen@gmail.com', 40.00, '2024-11-02 17:00:17', 'Cancelled', 'moxha latte'),
(14, 'AL AL SAUFFEEN', 'almuqrameen@gmail.com', 40.00, '2024-11-02 17:13:32', 'Pending', 'asd'),
(15, 'Lukman Hakim', 'alnhakim2004@gmail.com', 218.00, '2024-11-03 15:54:03', 'Pending', 'Pacific bay'),
(16, 'Lukman Hakim', 'alnhakim2004@gmail.com', 89.00, '2024-11-04 03:47:25', 'Pending', 'Pacific bay'),
(17, 'Lukman Hakim', 'alnhakim2004@gmail.com', 120.00, '2024-11-04 03:48:53', 'Pending', 'Pacific bay'),
(18, 'Potato  Rotten', 'fenrirsyonanto@gmail.com', 240.00, '2024-11-04 08:01:05', 'Pending', 'Potato empire near asuka\'s house '),
(19, 'Nge Zhe Yu', 'zheyunge@gmail.com', 10.00, '2024-11-04 14:04:40', 'Pending', '1A, Jalan Azman'),
(20, 'Nge Zhe Yu', 'zheyunge@gmail.com', 129.00, '2024-11-06 02:54:59', 'Pending', '1A, Jalan Azman'),
(21, 'Nge Zhe Yu', 'zheyunge@gmail.com', 40.00, '2024-11-06 03:59:09', 'Pending', '1A, Jalan Azman');

-- --------------------------------------------------------

--
-- 表的结构 `order_items`
--

CREATE TABLE `order_items` (
  `OrderItemID` int NOT NULL,
  `OrderID` int NOT NULL,
  `ProductID` int NOT NULL,
  `Quantity` int NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `Size` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `order_items`
--

INSERT INTO `order_items` (`OrderItemID`, `OrderID`, `ProductID`, `Quantity`, `Price`, `Size`) VALUES
(1, 1, 1, 1, 40.00, 'S'),
(2, 1, 3, 1, 89.00, 'M'),
(3, 2, 1, 1, 40.00, 'M'),
(4, 3, 3, 1, 89.00, 'M'),
(5, 4, 4, 1, 10.00, NULL),
(6, 5, 6, 1, 44.00, 'S'),
(7, 6, 5, 1, 35.00, 'M'),
(8, 7, 9, 1, 8.00, NULL),
(9, 8, 4, 1, 10.00, NULL),
(10, 8, 6, 1, 44.00, 'M'),
(11, 9, 1, 1, 40.00, 'M'),
(12, 10, 3, 1, 89.00, 'M'),
(13, 11, 1, 1, 40.00, 'M'),
(14, 12, 1, 1, 40.00, 'M'),
(15, 13, 1, 1, 40.00, 'M'),
(16, 14, 1, 1, 40.00, 'M'),
(17, 15, 3, 2, 89.00, 'M'),
(18, 15, 1, 1, 40.00, 'M'),
(19, 16, 3, 1, 89.00, 'L'),
(20, 17, 1, 1, 40.00, 'S'),
(21, 17, 1, 1, 40.00, 'M'),
(22, 17, 1, 1, 40.00, 'L'),
(23, 18, 9, 30, 8.00, NULL),
(24, 19, 4, 1, 10.00, NULL),
(25, 20, 3, 1, 89.00, 'S'),
(26, 20, 1, 1, 40.00, 'M'),
(27, 21, 1, 1, 40.00, 'M');

-- --------------------------------------------------------

--
-- 表的结构 `password`
--

CREATE TABLE `password` (
  `Admin_password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `password`
--

INSERT INTO `password` (`Admin_password`) VALUES
('1225');

-- --------------------------------------------------------

--
-- 表的结构 `pending_verification`
--

CREATE TABLE `pending_verification` (
  `id` int NOT NULL,
  `Username` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Password` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Address` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Contact` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Role` enum('admin','customer') COLLATE utf8mb4_general_ci NOT NULL,
  `verification_token` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `pending_verification`
--

INSERT INTO `pending_verification` (`id`, `Username`, `Password`, `Email`, `Address`, `Contact`, `Role`, `verification_token`, `created_at`) VALUES
(15, 'dada', '$2y$10$Kmyc4v629ApMxJbo2bKvYenuMOrLCnhv80uCiNno8LSJgFduQQKrG', 'dabed25144@baakal.com', '', '5525', 'customer', '93050a8ecef76c061ccfe7e7ef1d825a', '2024-09-10 02:32:04'),
(16, 'da', '$2y$10$pkedgCdzTuH6ktCRVRymB.FIsJT09ZyGWjoLJCjVqiXCEx/L.XHWm', 'relami8288@rogtat.com', '', '0124233292', 'customer', '7c185eb1c09236992deded3953b7bc21', '2024-09-10 02:34:14'),
(17, 'da', '$2y$10$Yp5zIj3TOar09MYbCwJ8IeOuTaFRviEObs1GZVtog6/vwWliIcLmm', 'relami8288@rogat.com', 'dad', '', 'customer', '45d5e477ad79d8d9f6b821bb6dd6d859', '2024-09-10 02:36:39'),
(18, 'da', '$2y$10$cveu4X3m2tJ.A7fcoeSmNeFEOqhkJ1tZbCMExdwWlEu2YKAe12LT6', 'relami8288@roat.com', 'dad', '', 'customer', '3ff1025763d785c6b7d827d61b73d149', '2024-09-10 02:37:02'),
(21, 'abuya', '$2y$10$ZCJcf28NrMq/nf4HBU04CecJQfU7jswxX5cqO1E2cP5auTG8L0p0q', 'wacoy47936@bulatox.com', 'pasar ikhwan di putrajaya', '1953852228', 'customer', 'c2b79ff988586c1eeb591d2cb917c5b0', '2024-10-27 02:30:57'),
(22, 'abuya2', '$2y$10$/e.2MvBRKxxDyk.zdrFRSOW1RzQ5ouUVfiXHI1ANWY.zgTZNfX2Ya', 'xuvukydy@logsmarter.net', 'pasar ikhwan di putrajaya', '1964915420', 'customer', '1f98173b2b6d6fafe814a4a5906ade1a', '2024-10-27 02:33:52'),
(23, 'abuya3', '$2y$10$EKXu0DBsDYCDEtq4fIDe5ODvzKU9eUbdz7axtbLtl2krrBFnoMyNu', 'toqyfedi@teleg.eu', 'pasar ikhwan di putrajaya', '12312312312', 'customer', '8c1960e11b131c2b2680d0abe7c30e3b', '2024-10-27 03:01:32'),
(24, 'abuya4', '$2y$10$x5tlmbGA1Cq30w4XP5Zg4e2bLiRjyDib7t9UbN8tLusVRx0bqDHO.', 'qxdw9@livinitlarge.net', 'pasar ikhwan di putrajaya', '1234123455', 'customer', '07cb0ed00f427ac7e4f42983391197f6', '2024-10-27 03:05:02'),
(25, 'abuya123', '$2y$10$///DnKfymHv0BcNptoY0aO20XAyCjn9gDm.EVwu1h0SdRub7z0j7.', 'famen14545@acroins.com', 'Pasar ikhwan di putrajaya', '1231231132', 'customer', 'e9ea87f2d1c5974df437b889610fdb9b', '2024-10-27 05:19:07');

-- --------------------------------------------------------

--
-- 表的结构 `product`
--

CREATE TABLE `product` (
  `ProductID` int NOT NULL,
  `ProductName` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `Category` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `StockQuantity` int NOT NULL,
  `Status` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `product`
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
(12, 'Blazer4', 79.00, 'Blazers', 11, 'In Stock', '../Products/WhatsApp Image 2024-10-08 at 14.03.10_5258b30f.jpg'),
(19, 'Blazer5', 111.00, 'Blazers', 0, 'Not In Stock', '../Products/WhatsApp Image 2024-11-04 at 17.31.29_eb37a89c.jpg'),
(20, 'Blazer6', 79.00, 'Blazers', 9, 'In Stock', '../Products/WhatsApp Image 2024-11-04 at 17.29.02_c8682d7b.jpg'),
(21, 'Shirt4', 44.00, 'Shirts', 12, 'In Stock', '../Products/WhatsApp Image 2024-11-04 at 17.22.23_43845261.jpg'),
(22, 'Shirt5', 35.00, 'Shirts', 0, 'Not In Stock', '../Products/WhatsApp Image 2024-11-04 at 17.21.33_94c75c1b.jpg');

-- --------------------------------------------------------

--
-- 表的结构 `shirt`
--

CREATE TABLE `shirt` (
  `ShirtID` int NOT NULL,
  `ProductID` int DEFAULT NULL,
  `ProductName` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `SizeS` int DEFAULT NULL,
  `SizeM` int DEFAULT NULL,
  `SizeL` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `shirt`
--

INSERT INTO `shirt` (`ShirtID`, `ProductID`, `ProductName`, `SizeS`, `SizeM`, `SizeL`) VALUES
(1, 1, 'Shirt1', 6, 2, 4),
(3, 5, 'Shirt2', 12, 13, 3),
(4, 6, 'Shirt3', 0, 0, 0),
(6, 21, 'Shirt4', 4, 5, 3),
(7, 22, 'Shirt5', 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `staff`
--

CREATE TABLE `staff` (
  `Username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Contact` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Verification_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Profile_photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `staff`
--

INSERT INTO `staff` (`Username`, `Password`, `Email`, `Address`, `Contact`, `Verification_code`, `Profile_photo`) VALUES
('Staff Test', '$2y$10$l5BllUUfVNCC5FB4w1qN.OgiG40.h7BVT/Ul6lli9.36FvtJpeZti', 'ngezy041225@gmail.com', '1A, Jalan A', '01242332923', '753507', ''),
(NULL, '$2y$10$4KdK0KXJZkAT7efXRPiUqeG8VIJvkDegNU4225hfQ8aAt9Xe.IFZS', 'zyzyzyzy1225@gmail.com', NULL, NULL, NULL, NULL),
(NULL, '$2y$10$IMSndKpzRrrql23XzhE.BOyFl183w8PMsPbCMYCC3mjHZDxndpX0K', 'zheyunge0412@gmail.com', NULL, NULL, NULL, NULL),
(NULL, '$2y$10$zvaoPCKijnzaY.pMsVuOq.OGwuGMfjNKgKEFLRdEP.pMAsKOCWcVW', 'chuerqi01@gmail.com', NULL, NULL, NULL, NULL),
(NULL, '$2y$10$A3HLcFbK7uNcGvxwaa9/lu/tmRQI0D8lGs7wAaCbCy1dhfpqxb.qC', 'ngeyu@graduate.utm.my', NULL, NULL, NULL, NULL);

--
-- 转储表的索引
--

--
-- 表的索引 `blazer`
--
ALTER TABLE `blazer`
  ADD PRIMARY KEY (`BlazerID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- 表的索引 `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`CartID`);

--
-- 表的索引 `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`OrderID`);

--
-- 表的索引 `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`OrderItemID`);

--
-- 表的索引 `pending_verification`
--
ALTER TABLE `pending_verification`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- 表的索引 `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ProductID`);

--
-- 表的索引 `shirt`
--
ALTER TABLE `shirt`
  ADD PRIMARY KEY (`ShirtID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `blazer`
--
ALTER TABLE `blazer`
  MODIFY `BlazerID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- 使用表AUTO_INCREMENT `cart`
--
ALTER TABLE `cart`
  MODIFY `CartID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- 使用表AUTO_INCREMENT `order`
--
ALTER TABLE `order`
  MODIFY `OrderID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- 使用表AUTO_INCREMENT `order_items`
--
ALTER TABLE `order_items`
  MODIFY `OrderItemID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- 使用表AUTO_INCREMENT `pending_verification`
--
ALTER TABLE `pending_verification`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- 使用表AUTO_INCREMENT `product`
--
ALTER TABLE `product`
  MODIFY `ProductID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- 使用表AUTO_INCREMENT `shirt`
--
ALTER TABLE `shirt`
  MODIFY `ShirtID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 限制导出的表
--

--
-- 限制表 `blazer`
--
ALTER TABLE `blazer`
  ADD CONSTRAINT `blazer_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`);

--
-- 限制表 `shirt`
--
ALTER TABLE `shirt`
  ADD CONSTRAINT `shirt_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

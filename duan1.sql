-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2023 at 01:22 PM
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
-- Database: `duan1`
--

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `delete` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `img`, `title`, `subtitle`, `status`, `delete`) VALUES
(2, 'slider-2.png', 'fhgjh', 'dcdvv', 0, 1),
(3, 'slider-3.png', 'dfvgf', 'gdfgrt', 0, 0),
(4, 'slider-4.png', 'fvjkb', 'sdajbkch', 0, 0),
(5, 'slider-5.png', 'dsaevg', 'dsaefr', 0, 0),
(7, 'slider-7.png', 'safc', 'safv', 0, 0),
(8, 'slider-8.png', 'dvds', 'sdaf', 0, 0),
(157, 'slider-6.png', '123', '234', 0, 0),
(158, 'screencapture-duanthaynam-demowebct-online-thoitrang-elements-pages-contact-2023-11-08-14_28_40.png', 'av', 'av', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `payment_methods` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0. Thanh toán khi nhận hàng 1. Thanh toán online',
  `total` int(11) NOT NULL,
  `order_date` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0. Đơn hàng mới 1. Đang xử lý 2. Đang giao hàng 3. Đã giao hàng',
  `created_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`id`, `id_user`, `name`, `address`, `phone`, `email`, `payment_methods`, `total`, `order_date`, `status`, `created_at`, `update_at`) VALUES
(66, 1, 'toandt', 'cantho', '0345625641', 'toan11156@gmail.com', 2, 9, '10:28:54am 08/12/2023', 0, NULL, NULL),
(67, 1, 'toandt', 'cantho1111', '0346254236', 'toan11156@gmail.com', 2, 17, '10:32:32am 08/12/2023', 0, NULL, NULL),
(68, 1, 'toandt', 'cantho', '0564523651', 'toan11156@gmail.com', 2, 4, '10:33:39am 08/12/2023', 0, NULL, NULL),
(69, 1, 'toandt', 'cantho', '0254635125', 'toan11156@gmail.com', 2, 5, '10:35:06am 08/12/2023', 0, NULL, NULL),
(70, 1, 'toandt', 'cantho', '0352456325', 'toan11156@gmail.com', 2, 5, '10:35:56am 08/12/2023', 0, NULL, NULL),
(71, 1, 'toandt', 'cantho', '0365265423', 'toan11156@gmail.com', 1, 5, '10:36:32am 08/12/2023', 0, NULL, NULL),
(72, 1, 'toandt', 'Cantho', '0354665234', 'cuong147@gmail.com', 2, 8, '12:48:37pm 12/12/2023', 0, NULL, NULL),
(73, 1, 'toandt', 'Cantho11', '0365445136', 'cuong147@gmail.com', 2, 5, '12:49:42pm 12/12/2023', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bill_detail`
--

CREATE TABLE `bill_detail` (
  `id` int(11) NOT NULL,
  `id_pro` int(11) NOT NULL,
  `id_bill` int(11) NOT NULL,
  `price` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bill_detail`
--

INSERT INTO `bill_detail` (`id`, `id_pro`, `id_bill`, `price`, `quantity`, `created_at`, `update_at`) VALUES
(61, 8, 66, 5, 1, NULL, NULL),
(62, 6, 66, 4, 1, NULL, NULL),
(63, 8, 67, 5, 1, NULL, NULL),
(64, 6, 67, 4, 1, NULL, NULL),
(65, 5, 67, 8, 1, NULL, NULL),
(66, 6, 68, 4, 1, NULL, NULL),
(67, 8, 69, 5, 1, NULL, NULL),
(68, 8, 70, 5, 1, NULL, NULL),
(69, 8, 71, 5, 1, NULL, NULL),
(70, 5, 72, 8, 1, NULL, NULL),
(71, 8, 73, 5, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `id_pro` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total` double(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `id_pro`, `id_user`, `img`, `name`, `price`, `quantity`, `total`, `created_at`, `update_at`) VALUES
(1, 4, 21, 'upload/../upload/Acer_Wallpaper_04_3840x2400.jpg', 'quần dài', 465, 3, 1395.00, NULL, NULL),
(2, 3, 21, 'upload/../upload/Acer_Wallpaper_01_3840x2400.jpg', 'vgfgf', 54, 3, 163.35, NULL, NULL),
(3, 4, 22, 'upload/../upload/Acer_Wallpaper_04_3840x2400.jpg', 'quần dài', 465, 1, 465.00, NULL, NULL),
(4, 4, 22, 'upload/../upload/Acer_Wallpaper_04_3840x2400.jpg', 'quần dài', 465, 3, 1395.00, NULL, NULL),
(5, 2, 22, 'upload/../upload/Hinh-Nen-Dep-Cho-May-Tinh.jpg', 'vgfgf', 4, 3, 12.00, NULL, NULL),
(6, 3, 22, 'upload/', 'vgfgf', 54, 1, 54.45, NULL, NULL),
(7, 3, 22, 'upload/', 'vgfgf', 54, 1, 54.45, NULL, NULL),
(8, 3, 22, 'upload/', 'vgfgf', 54, 1, 54.45, NULL, NULL),
(9, 3, 22, 'upload/', 'vgfgf', 54, 1, 54.45, NULL, NULL),
(10, 4, 22, 'upload/../upload/Acer_Wallpaper_04_3840x2400.jpg', 'quần dài', 465, 1, 465.00, NULL, NULL),
(11, 4, 22, 'upload/../upload/Acer_Wallpaper_04_3840x2400.jpg', 'quần dài', 465, 1, 465.00, NULL, NULL),
(12, 2, 22, 'upload/../upload/Hinh-Nen-Dep-Cho-May-Tinh.jpg', 'vgfgf', 4, 2, 8.00, NULL, NULL),
(13, 5, 1, 'upload/../upload/Acer_Wallpaper_04_3840x2400.jpg', 'aaaaaaa', 8, 1, 8.00, NULL, NULL),
(14, 6, 1, 'upload/../upload/Acer_Wallpaper_04_3840x2400.jpg', 'quần ngắn', 4, 1, 4.00, NULL, NULL),
(15, 5, 1, 'upload/../upload/Acer_Wallpaper_04_3840x2400.jpg', 'aaaaaaa', 8, 1, 8.00, NULL, NULL),
(16, 6, 1, 'upload/../upload/Acer_Wallpaper_04_3840x2400.jpg', 'quần ngắn', 4, 1, 4.00, NULL, NULL),
(17, 8, 1, 'upload/../upload/Acer_Wallpaper_05_3840x2400.jpg', 'máy dập', 5, 1, 5.00, NULL, NULL),
(18, 9, 1, 'upload/../upload/Acer_Wallpaper_05_3840x2400.jpg', 'ZZZZZ', 20, 1, 20.00, NULL, NULL),
(19, 9, 1, 'upload/../upload/Acer_Wallpaper_05_3840x2400.jpg', 'ZZZZZ', 20, 1, 20.00, NULL, NULL),
(20, 5, 1, 'upload/../upload/Acer_Wallpaper_04_3840x2400.jpg', 'aaaaaaa', 8, 1, 8.00, NULL, NULL),
(21, 5, 1, 'upload/../upload/Acer_Wallpaper_04_3840x2400.jpg', 'aaaaaaa', 8, 1, 8.00, NULL, NULL),
(22, 8, 1, 'upload/../upload/Acer_Wallpaper_05_3840x2400.jpg', 'máy dập', 5, 1, 5.00, NULL, NULL),
(23, 8, 1, 'upload/../upload/Acer_Wallpaper_05_3840x2400.jpg', 'máy dập', 5, 1, 5.00, NULL, NULL),
(24, 6, 1, 'upload/../upload/Acer_Wallpaper_04_3840x2400.jpg', 'quần ngắn', 4, 1, 4.00, NULL, NULL),
(25, 6, 1, 'upload/../upload/Acer_Wallpaper_04_3840x2400.jpg', 'quần ngắn', 4, 1, 4.00, NULL, NULL),
(26, 7, 1, 'upload/../upload/Acer_Wallpaper_05_3840x2400.jpg', 'áo khoác', 10, 1, 10.00, NULL, NULL),
(27, 6, 1, 'upload/../upload/Acer_Wallpaper_04_3840x2400.jpg', 'quần ngắn', 4, 1, 4.00, NULL, NULL),
(28, 7, 1, 'upload/../upload/Acer_Wallpaper_05_3840x2400.jpg', 'áo khoác', 10, 1, 10.00, NULL, NULL),
(29, 6, 1, 'upload/../upload/Acer_Wallpaper_04_3840x2400.jpg', 'quần ngắn', 4, 1, 4.00, NULL, NULL),
(30, 7, 1, 'upload/../upload/Acer_Wallpaper_05_3840x2400.jpg', 'áo khoác', 10, 1, 10.00, NULL, NULL),
(31, 6, 1, 'upload/../upload/Acer_Wallpaper_04_3840x2400.jpg', 'quần ngắn', 4, 1, 4.00, NULL, NULL),
(32, 7, 1, 'upload/../upload/Acer_Wallpaper_05_3840x2400.jpg', 'áo khoác', 10, 1, 10.00, NULL, NULL),
(33, 6, 1, 'upload/../upload/Acer_Wallpaper_04_3840x2400.jpg', 'quần ngắn', 4, 1, 4.00, NULL, NULL),
(34, 7, 1, 'upload/../upload/Acer_Wallpaper_05_3840x2400.jpg', 'áo khoác', 10, 2, 20.00, NULL, NULL),
(35, 8, 1, 'upload/../upload/Acer_Wallpaper_05_3840x2400.jpg', 'máy dập', 5, 1, 5.00, NULL, NULL),
(36, 6, 1, 'upload/../upload/Acer_Wallpaper_04_3840x2400.jpg', 'quần ngắn', 4, 1, 4.00, NULL, NULL),
(37, 7, 1, 'upload/../upload/Acer_Wallpaper_05_3840x2400.jpg', 'áo khoác', 10, 2, 20.00, NULL, NULL),
(38, 8, 1, 'upload/../upload/Acer_Wallpaper_05_3840x2400.jpg', 'máy dập', 5, 1, 5.00, NULL, NULL),
(39, 6, 1, 'upload/../upload/Acer_Wallpaper_04_3840x2400.jpg', 'quần ngắn', 4, 1, 4.00, NULL, NULL),
(40, 7, 1, 'upload/../upload/Acer_Wallpaper_05_3840x2400.jpg', 'áo khoác', 10, 2, 20.00, NULL, NULL),
(41, 8, 1, 'upload/../upload/Acer_Wallpaper_05_3840x2400.jpg', 'máy dập', 5, 1, 5.00, NULL, NULL),
(42, 6, 1, 'upload/../upload/Acer_Wallpaper_04_3840x2400.jpg', 'quần ngắn', 4, 1, 4.00, NULL, NULL),
(43, 7, 1, 'upload/../upload/Acer_Wallpaper_05_3840x2400.jpg', 'áo khoác', 10, 2, 20.00, NULL, NULL),
(44, 8, 1, 'upload/../upload/Acer_Wallpaper_05_3840x2400.jpg', 'máy dập', 5, 1, 5.00, NULL, NULL),
(45, 6, 1, 'upload/../upload/Acer_Wallpaper_04_3840x2400.jpg', 'quần ngắn', 4, 1, 4.00, NULL, NULL),
(46, 7, 1, 'upload/../upload/Acer_Wallpaper_05_3840x2400.jpg', 'áo khoác', 10, 2, 20.00, NULL, NULL),
(47, 8, 1, 'upload/../upload/Acer_Wallpaper_05_3840x2400.jpg', 'máy dập', 5, 1, 5.00, NULL, NULL),
(48, 6, 1, 'upload/../upload/Acer_Wallpaper_04_3840x2400.jpg', 'quần ngắn', 4, 1, 4.00, NULL, NULL),
(49, 7, 1, 'upload/../upload/Acer_Wallpaper_05_3840x2400.jpg', 'áo khoác', 10, 2, 20.00, NULL, NULL),
(50, 8, 1, 'upload/../upload/Acer_Wallpaper_05_3840x2400.jpg', 'máy dập', 5, 1, 5.00, NULL, NULL),
(51, 4, 1, 'upload/../upload/Acer_Wallpaper_04_3840x2400.jpg', 'quần dài', 465, 1, 465.00, NULL, NULL),
(52, 4, 1, 'upload/../upload/Acer_Wallpaper_04_3840x2400.jpg', 'quần dài', 465, 1, 465.00, NULL, NULL),
(53, 5, 1, 'upload/../upload/Acer_Wallpaper_04_3840x2400.jpg', 'aaaaaaa', 8, 1, 8.00, NULL, NULL),
(54, 5, 1, 'upload/../upload/Acer_Wallpaper_04_3840x2400.jpg', 'aaaaaaa', 8, 1, 8.00, NULL, NULL),
(55, 5, 1, 'upload/../upload/Acer_Wallpaper_04_3840x2400.jpg', 'aaaaaaa', 8, 1, 8.00, NULL, NULL),
(56, 5, 1, 'upload/../upload/Acer_Wallpaper_04_3840x2400.jpg', 'aaaaaaa', 8, 1, 8.00, NULL, NULL),
(57, 5, 1, 'upload/../upload/Acer_Wallpaper_04_3840x2400.jpg', 'aaaaaaa', 8, 1, 8.00, NULL, NULL),
(58, 5, 1, 'upload/../upload/Acer_Wallpaper_04_3840x2400.jpg', 'aaaaaaa', 8, 1, 8.00, NULL, NULL),
(59, 8, 1, 'upload/../upload/Acer_Wallpaper_05_3840x2400.jpg', 'máy dập', 5, 1, 5.00, NULL, NULL),
(60, 8, 1, 'upload/../upload/Acer_Wallpaper_05_3840x2400.jpg', 'máy dập', 5, 1, 5.00, NULL, NULL),
(61, 8, 1, 'upload/../upload/Acer_Wallpaper_05_3840x2400.jpg', 'máy dập', 5, 1, 5.00, NULL, NULL),
(62, 6, 1, 'upload/../upload/Acer_Wallpaper_04_3840x2400.jpg', 'quần ngắn', 4, 1, 4.00, NULL, NULL),
(63, 8, 1, 'upload/../upload/Acer_Wallpaper_05_3840x2400.jpg', 'máy dập', 5, 1, 5.00, NULL, NULL),
(64, 6, 1, 'upload/../upload/Acer_Wallpaper_04_3840x2400.jpg', 'quần ngắn', 4, 1, 4.00, NULL, NULL),
(65, 5, 1, 'upload/../upload/Acer_Wallpaper_04_3840x2400.jpg', 'aaaaaaa', 8, 1, 8.00, NULL, NULL),
(66, 6, 1, 'upload/../upload/Acer_Wallpaper_04_3840x2400.jpg', 'quần ngắn', 4, 1, 4.00, NULL, NULL),
(67, 8, 1, 'upload/../upload/Acer_Wallpaper_05_3840x2400.jpg', 'máy dập', 5, 1, 5.00, NULL, NULL),
(68, 8, 1, 'upload/../upload/Acer_Wallpaper_05_3840x2400.jpg', 'máy dập', 5, 1, 5.00, NULL, NULL),
(69, 8, 1, 'upload/../upload/Acer_Wallpaper_05_3840x2400.jpg', 'máy dập', 5, 1, 5.00, NULL, NULL),
(70, 5, 1, 'upload/../upload/Acer_Wallpaper_04_3840x2400.jpg', 'aaaaaaa', 8, 1, 8.00, NULL, NULL),
(71, 8, 1, 'upload/../upload/Acer_Wallpaper_05_3840x2400.jpg', 'máy dập', 5, 1, 5.00, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0. Ẩn 1. Hiện',
  `delete` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0. Ẩn 1. Xóa',
  `created_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `status`, `delete`, `created_at`, `update_at`) VALUES
(1, 'Milks & Dairiesghgh', 0, 0, NULL, NULL),
(2, 'Clothing', 0, 0, NULL, NULL),
(3, 'Pet Foods', 0, 0, NULL, NULL),
(4, 'Baking material', 0, 0, NULL, NULL),
(40, 'áo', 0, 0, NULL, NULL),
(75, 'asssa', 0, 0, NULL, NULL),
(76, 'âsasas', 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `id_pro` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `content` varchar(255) DEFAULT NULL,
  `delete` tinyint(4) NOT NULL DEFAULT 0,
  `comment_date` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `id_pro`, `id_user`, `content`, `delete`, `comment_date`, `created_at`, `update_at`) VALUES
(2, 2, 2, 'đẹp quá', 0, '2023-11-21', NULL, NULL),
(3, 2, 2, 'xuất sắc', 0, '2023-11-20', NULL, NULL),
(5, 1, 2, 'đẹp đó', 0, '14:09:am 2023-11-19', NULL, NULL),
(7, 2, 1, 'vip...', 0, '2023-11-20', NULL, NULL),
(12, 2, 2, 'xấu', 0, '2023-11-20', NULL, NULL),
(13, 4, 1, 'abcdfi', 0, '08:18:59am 21/11/2023', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `id_pro` int(11) NOT NULL,
  `img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `id_pro`, `img`) VALUES
(4, 2, '../upload/Acer_Wallpaper_01_3840x2400.jpg'),
(5, 2, '../upload/Acer_Wallpaper_02_3840x2400.jpg'),
(6, 2, '../upload/Acer_Wallpaper_03_3840x2400.jpg'),
(7, 2, '../upload/Acer_Wallpaper_04_3840x2400.jpg'),
(8, 2, '../upload/Acer_Wallpaper_05_3840x2400.jpg'),
(9, 2, '../upload/Hinh-Nen-Dep-Cho-May-Tinh.jpg'),
(11, 4, '../upload/Acer_Wallpaper_04_3840x2400.jpg'),
(12, 5, '../upload/Acer_Wallpaper_01_3840x2400.jpg'),
(13, 5, '../upload/Acer_Wallpaper_03_3840x2400.jpg'),
(14, 5, '../upload/Acer_Wallpaper_04_3840x2400.jpg'),
(15, 6, '../upload/Acer_Wallpaper_04_3840x2400.jpg'),
(16, 7, '../upload/Acer_Wallpaper_05_3840x2400.jpg'),
(17, 8, '../upload/Acer_Wallpaper_05_3840x2400.jpg'),
(18, 9, '../upload/Acer_Wallpaper_05_3840x2400.jpg'),
(19, 10, '../upload/Acer_Wallpaper_05_3840x2400.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `momo`
--

CREATE TABLE `momo` (
  `id` int(11) NOT NULL,
  `partnerCode` varchar(50) DEFAULT NULL,
  `orderId` varchar(50) DEFAULT NULL,
  `requestId` varchar(50) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `orderInfo` varchar(50) DEFAULT NULL,
  `orderType` varchar(50) DEFAULT NULL,
  `transId` varchar(50) DEFAULT NULL,
  `payType` varchar(50) DEFAULT NULL,
  `signature` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `momo`
--

INSERT INTO `momo` (`id`, `partnerCode`, `orderId`, `requestId`, `amount`, `orderInfo`, `orderType`, `transId`, `payType`, `signature`) VALUES
(1, 'MOMOBKUN20180529', '3070', '1701701816', 33480000, 'Thanh toán qua MoMo', 'momo_wallet', '3105754743', 'napas', '2fcb4050b61c9b447ea777182495da81aa09b0b67d89c13751'),
(2, 'MOMOBKUN20180529', '6398', '1701972926', 11160000, 'Thanh toán qua MoMo', 'momo_wallet', '1701972932476', '', '63566b60d153964f9925e89a39960279601a7b0f38d8fd4b3b'),
(3, 'MOMOBKUN20180529', '6398', '1701972926', 11160000, 'Thanh toán qua MoMo', 'momo_wallet', '1701972932476', '', '63566b60d153964f9925e89a39960279601a7b0f38d8fd4b3b'),
(4, 'MOMOBKUN20180529', '5987', '1702028192', 120000, 'Thanh toán qua MoMo', 'momo_wallet', '1702028198158', '', '4f04ee3f68a1c5d7cf8b9cd66664d348eff432755a32a3fbbe');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `id_bill` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `account_no` varchar(255) DEFAULT NULL,
  `credit_amount` varchar(255) DEFAULT NULL,
  `ben_account_name` varchar(255) DEFAULT NULL,
  `desription` varchar(255) DEFAULT NULL,
  `sentaction_time` timestamp NULL DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` double(10,2) DEFAULT NULL,
  `describe` varchar(255) DEFAULT NULL,
  `view` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0. Ẩn 1. Hiện',
  `delete` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0. Ẩn 1. Xóa',
  `created_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `id_category`, `name`, `price`, `describe`, `view`, `status`, `delete`, `created_at`, `update_at`) VALUES
(1, 2, 'aos', 5.00, 'abc', NULL, 0, 0, NULL, NULL),
(2, 4, 'vgfgf', 4.00, 'ghgg', NULL, 0, 0, NULL, NULL),
(3, 40, 'vgfgf', 54.45, 'sá', NULL, 0, 1, NULL, NULL),
(4, 2, 'quần dài', 465.00, 'quần dài đó má', NULL, 0, 0, NULL, NULL),
(5, 4, 'aaaaaaa', 8.00, 'đt nè 3', NULL, 0, 0, NULL, NULL),
(6, 4, 'quần ngắn', 4.00, 'quần ngắn', NULL, 0, 0, NULL, NULL),
(7, 4, 'áo khoác', 10.00, 'áo khoác', NULL, 0, 0, NULL, NULL),
(8, 4, 'máy dập', 5.00, 'M để sắp xếp nè', NULL, 0, 0, NULL, NULL),
(9, 76, 'ZZZZZ', 20.00, 'Z nè ha', NULL, 0, 0, NULL, NULL),
(10, 76, 'asdasdasd', 10.00, 'tesst', NULL, 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0. Ẩn 1. Hiện',
  `delete` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0. Ẩn 1. Xóa',
  `role` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0. Admin 1. Người Dùng',
  `created_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL,
  `google_id` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `facebook_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `pass`, `email`, `address`, `phone`, `price`, `status`, `delete`, `role`, `created_at`, `update_at`, `google_id`, `facebook_id`) VALUES
(1, 'toandt', 'e10adc3949ba59abbe56e057f20f883e', 'cuong147@gmail.com', 'cantho1', '0345654523', NULL, 1, 0, 1, NULL, NULL, '', ''),
(2, 'Cmall', 'e10adc3949ba59abbe56e057f20f883e', 'ngoccuong147258@gmail.com', 'Cần Thơ', '0354233641', NULL, 0, 0, 1, NULL, NULL, '', ''),
(21, 'Cương Ngọc', NULL, 'ngoccuong147258@gmail.com', NULL, NULL, NULL, 0, 0, 0, NULL, NULL, '', '1506013780244113'),
(22, 'Nguyen Hoang Ngoc Cuong (FPL CT)', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', NULL, 0, 0, 0, NULL, NULL, '112968436523285069278', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `bill_detail`
--
ALTER TABLE `bill_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pro` (`id_pro`,`id_bill`),
  ADD KEY `id_bill` (`id_bill`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pro` (`id_pro`,`id_user`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_name` (`name`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pro` (`id_pro`,`id_user`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pro` (`id_pro`);

--
-- Indexes for table `momo`
--
ALTER TABLE `momo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_bill` (`id_bill`,`id_user`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_category` (`id_category`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `bill_detail`
--
ALTER TABLE `bill_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `momo`
--
ALTER TABLE `momo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `bill_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Constraints for table `bill_detail`
--
ALTER TABLE `bill_detail`
  ADD CONSTRAINT `bill_detail_ibfk_1` FOREIGN KEY (`id_pro`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `bill_detail_ibfk_2` FOREIGN KEY (`id_bill`) REFERENCES `bill` (`id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`id_pro`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`id_pro`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`id_pro`) REFERENCES `products` (`id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`id_bill`) REFERENCES `bill` (`id`),
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

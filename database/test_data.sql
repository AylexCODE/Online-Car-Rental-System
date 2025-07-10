-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2025 at 04:06 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 8.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car_rental_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `BrandID` int(11) NOT NULL,
  `BrandName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`BrandID`, `BrandName`) VALUES
(4, 'CC'),
(2, 'COROLLA'),
(8, 'HDHYD'),
(5, 'HH'),
(3, 'TOYOTA'),
(1, 'WIGO');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `CarID` int(11) NOT NULL,
  `BrandID` int(11) NOT NULL,
  `ModelID` int(11) NOT NULL,
  `FuelType` varchar(16) NOT NULL,
  `Transmission` varchar(16) NOT NULL,
  `RentalPrice` double(10,2) NOT NULL,
  `Availability` tinyint(1) NOT NULL,
  `ImageName` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`CarID`, `BrandID`, `ModelID`, `FuelType`, `Transmission`, `RentalPrice`, `Availability`, `ImageName`) VALUES
(1, 1, 1, 'Gasoline', 'Continuously Var', 2000.00, 1, 'wigo_c_gvt.png'),
(2, 2, 2, 'Gasoline', 'Automatic', 1471.91, 1, 'corolla_cross_1-8_gr-s.png'),
(3, 3, 3, 'Gasoline', 'Automatic', 3690.27, 1, 'camry_2-5_v_hev_cvt.png'),
(4, 3, 4, 'Gasoline', 'Continuously Var', 2445.83, 1, 'corolla_atlis.png'),
(5, 3, 5, 'Gasoline', 'Continuously Var', 2236.11, 1, 'yaris_cross_1-5_s_hev_cvt.png'),
(6, 3, 6, 'Diesel', 'Dual Clutch', 3688.88, 1, 'fortuner_gr_s.png'),
(7, 3, 7, 'Diesel', 'Dual Clutch', 4009.00, 1, 'land_cruiser_3-3_v6.png'),
(8, 3, 8, 'Gasoline', 'Dual Clutch', 3337.50, 1, 'land_cruiser_prado_2-4_turbo.png'),
(9, 3, 9, 'Gasoline', 'Continuously Var', 2741.66, 1, 'zenix.png'),
(10, 3, 10, 'Gasoline', 'Continuously Var', 1487.50, 1, 'avanza_1-5_g.png'),
(11, 3, 11, 'Diesel', 'Semi-Automatic', 2945.20, 1, 'tamaraw_2-4_gl_dropside.png'),
(12, 3, 12, 'Diesel', 'Manual', 5713.00, 1, 'coaster_29_seater.png'),
(13, 3, 13, 'Gasoline', 'Dual Clutch', 908.50, 1, 'lite_ace_panel_van.png'),
(14, 3, 14, 'Gasoline', 'Automatic', 3033.33, 1, 'hilux_2-5_gr_sport.png'),
(15, 3, 15, 'Gasoline', 'Continuously Var', 6515.27, 1, 'alphard_2-5_hev_cvt.png');

-- --------------------------------------------------------

--
-- Table structure for table `car_statistics`
--

CREATE TABLE `car_statistics` (
  `StatisticsID` int(11) NOT NULL,
  `CarID` int(11) NOT NULL,
  `CustomerID` int(11) NOT NULL,
  `DateTime` datetime NOT NULL,
  `Type` varchar(50) NOT NULL,
  `Damages` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `car_statistics`
--

INSERT INTO `car_statistics` (`StatisticsID`, `CarID`, `CustomerID`, `DateTime`, `Type`, `Damages`) VALUES
(1, 5, 2, '2025-05-12 00:12:55', 'Retrieve', 'Cracked Windshields'),
(2, 5, 2, '2025-05-12 00:13:23', 'Return', 'Cracked Windshields'),
(3, 2, 2, '2025-05-12 00:14:23', 'Retrieve', 'Cracked Windshields'),
(4, 2, 2, '2025-05-12 00:14:35', 'Return', 'Scratches'),
(5, 1, 2, '2025-05-12 00:15:33', 'Retrieve', 'Scratches'),
(6, 1, 2, '2025-05-12 00:15:51', 'Return', '');

-- --------------------------------------------------------

--
-- Table structure for table `damages`
--

CREATE TABLE `damages` (
  `CarID` int(11) NOT NULL,
  `IsDamaged` tinyint(1) NOT NULL,
  `Dents` tinyint(1) NOT NULL,
  `Scratches` tinyint(1) NOT NULL,
  `ChippedPaint` tinyint(1) NOT NULL,
  `CrackedWindshields` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `damages`
--

INSERT INTO `damages` (`CarID`, `IsDamaged`, `Dents`, `Scratches`, `ChippedPaint`, `CrackedWindshields`) VALUES
(1, 0, 0, 0, 0, 0),
(2, 1, 0, 1, 0, 0),
(3, 1, 0, 0, 1, 1),
(4, 0, 0, 0, 0, 0),
(5, 1, 0, 0, 0, 1),
(6, 0, 0, 0, 0, 0),
(7, 0, 0, 0, 0, 0),
(8, 0, 0, 0, 0, 0),
(9, 0, 0, 0, 0, 0),
(10, 0, 0, 0, 0, 0),
(11, 0, 0, 0, 0, 0),
(12, 0, 0, 0, 0, 0),
(13, 0, 0, 0, 0, 0),
(14, 0, 0, 0, 0, 0),
(15, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `LocationID` int(11) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `AddressCode` varchar(100) NOT NULL,
  `DistanceKM` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`LocationID`, `Address`, `AddressCode`, `DistanceKM`) VALUES
(1, 'Bisu Balilihan Campus', 'PXW6+572, Provincial Road, Balilihan, Bohol', 0.00),
(2, 'Balilihan Municipal Hall', 'QX3C+WFW, Balilihan, 6342 Bohol', 1.90),
(3, 'Cabad Barangay Hall', 'QW3V+6VV, Barangay Road (Cabad), Balilihan, Bohol', 4.00);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `LogID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `DateAndTime` datetime NOT NULL,
  `Activity` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`LogID`, `UserID`, `DateAndTime`, `Activity`) VALUES
(1, 1, '2025-05-11 23:03:07', 'Signup'),
(2, 1, '2025-05-11 23:04:59', 'Login'),
(3, 2, '2025-05-11 23:28:01', 'Login'),
(4, 2, '2025-05-11 23:28:21', 'Booked Car ID 1'),
(5, 2, '2025-05-11 23:29:44', 'Retrieved Car Rental ID 1'),
(6, 2, '2025-05-11 23:29:47', 'Return Car ID 1'),
(7, 2, '2025-05-11 23:29:56', 'Left A Review From Rental ID 1'),
(8, 2, '2025-05-11 23:30:21', 'Return Car ID 1'),
(9, 2, '2025-05-11 23:30:25', 'Return Car ID 1'),
(10, 2, '2025-05-11 23:30:30', 'Return Car ID 1'),
(11, 2, '2025-05-11 23:30:52', 'Return Car ID 1'),
(12, 2, '2025-05-11 23:30:59', 'Return Car ID 1'),
(13, 2, '2025-05-11 23:31:11', 'Return Car ID 1'),
(14, 2, '2025-05-11 23:33:39', 'Booked Car ID 2'),
(15, 2, '2025-05-11 23:34:30', 'Retrieved Car Rental ID 2'),
(16, 2, '2025-05-11 23:34:33', 'Return Car ID 2'),
(17, 2, '2025-05-11 23:35:51', 'Return Car ID 2'),
(18, 2, '2025-05-11 23:37:07', 'Return Car ID 2'),
(19, 2, '2025-05-11 23:37:15', 'Return Car ID 2'),
(20, 2, '2025-05-11 23:37:27', 'Return Car ID 2'),
(21, 2, '2025-05-11 23:37:46', 'Return Car ID 2'),
(22, 2, '2025-05-11 23:38:34', 'Return Car ID 2'),
(23, 2, '2025-05-11 23:39:36', 'Return Car ID 2'),
(24, 2, '2025-05-11 23:40:04', 'Return Car ID 2'),
(25, 2, '2025-05-11 23:40:09', 'Return Car ID 2'),
(26, 2, '2025-05-11 23:41:05', 'Return Car ID 2'),
(27, 2, '2025-05-11 23:41:21', 'Booked Car ID 2'),
(28, 2, '2025-05-11 23:42:10', 'Retrieved Car Rental ID 3'),
(29, 2, '2025-05-11 23:42:38', 'Return Car ID 2'),
(30, 2, '2025-05-11 23:48:33', 'Return Car ID 2'),
(31, 2, '2025-05-11 23:50:22', 'Return Car ID 2'),
(32, 2, '2025-05-11 23:50:45', 'Return Car ID 2'),
(33, 2, '2025-05-11 23:51:09', 'Return Car ID 2'),
(34, 2, '2025-05-11 23:53:45', 'Return Car ID 2'),
(35, 2, '2025-05-11 23:54:07', 'Booked Car ID 4'),
(36, 2, '2025-05-11 23:54:58', 'Retrieved Car Rental ID 4'),
(37, 2, '2025-05-11 23:55:26', 'Return Car ID 4'),
(38, 2, '2025-05-11 23:56:34', 'Return Car ID 4'),
(39, 2, '2025-05-11 23:57:04', 'Return Car ID 4'),
(40, 2, '2025-05-11 23:57:21', 'Return Car ID 4'),
(41, 2, '2025-05-11 23:58:14', 'Return Car ID 4'),
(42, 2, '2025-05-11 23:59:13', 'Booked Car ID 3'),
(43, 2, '2025-05-12 00:00:09', 'Retrieved Car Rental ID 5'),
(44, 2, '2025-05-12 00:02:43', 'Return Car ID 3'),
(45, 2, '2025-05-12 00:08:38', 'Booked Car ID 1'),
(46, 2, '2025-05-12 00:08:58', 'Retrieved Car Rental ID 6'),
(47, 2, '2025-05-12 00:09:40', 'Return Car ID 1'),
(48, 2, '2025-05-12 00:12:08', 'Booked Car ID 5'),
(49, 2, '2025-05-12 00:12:55', 'Retrieved Car Rental ID 7'),
(50, 2, '2025-05-12 00:13:23', 'Return Car ID 5'),
(51, 2, '2025-05-12 00:13:46', 'Booked Car ID 2'),
(52, 2, '2025-05-12 00:14:23', 'Retrieved Car Rental ID 8'),
(53, 2, '2025-05-12 00:14:35', 'Return Car ID 2'),
(54, 2, '2025-05-12 00:14:59', 'Booked Car ID 1'),
(55, 2, '2025-05-12 00:15:33', 'Retrieved Car Rental ID 9'),
(56, 2, '2025-05-12 00:15:51', 'Return Car ID 1'),
(57, 1, '2025-05-13 09:23:59', 'Login'),
(58, 1, '2025-05-13 09:24:15', 'Login'),
(59, 1, '2025-05-13 09:24:56', 'Logout'),
(60, 2, '2025-05-13 10:15:36', 'Login'),
(61, 2, '2025-05-13 10:18:44', 'Logout'),
(62, 1, '2025-05-13 10:18:54', 'Login'),
(63, 1, '2025-05-13 10:49:45', 'Added Voucher UID Uedu, Discount = 566, Type = Cash, Expiry Date = 2025-05-13, And Max Uses = 50'),
(64, 1, '2025-05-13 10:51:21', 'Added Voucher UID Uedd, Discount = 566, Type = Cash, Expiry Date = 2025-05-13, And Max Uses = 50'),
(65, 1, '2025-05-13 11:11:11', 'Added Voucher UID Udud, Discount = 25, Type = Cash, Expiry Date = 2025-05-13, And Max Uses = 80'),
(66, 1, '2025-05-13 11:11:50', 'Added Voucher UID Usys, Discount = 65, Type = Cash, Expiry Date = 2025-05-13, And Max Uses = 20'),
(67, 1, '2025-05-13 11:12:06', 'Added Voucher UID Usjh, Discount = 65, Type = Cash, Expiry Date = 2025-05-13, And Max Uses = 20');

-- --------------------------------------------------------

--
-- Table structure for table `models`
--

CREATE TABLE `models` (
  `ModelID` int(11) NOT NULL,
  `BrandID` int(11) NOT NULL,
  `ModelName` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `models`
--

INSERT INTO `models` (`ModelID`, `BrandID`, `ModelName`) VALUES
(1, 1, 'G CVT'),
(2, 2, 'CROSS 1.8 GR-S'),
(3, 3, 'CAMRY'),
(4, 3, 'COROLLA ATLIS'),
(5, 3, 'YARIS CROSS'),
(6, 3, 'FORTUNER'),
(7, 3, 'LAND CRUISER'),
(8, 3, 'LAND CRUISER PRADO'),
(9, 3, 'ZENIX'),
(10, 3, 'AVANZA'),
(11, 3, 'TAMARAW'),
(12, 3, 'COASTER'),
(13, 3, 'LITE ACE Panel Van'),
(14, 3, 'HILUX'),
(15, 3, 'ALPHARD');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `PaymentID` int(11) NOT NULL,
  `RentalID` int(11) NOT NULL,
  `PaymentDate` varchar(50) NOT NULL,
  `PaymentFrequency` varchar(12) NOT NULL,
  `AmountPaid` double(10,2) NOT NULL,
  `PaymentMethod` varchar(24) NOT NULL,
  `PaymentStatus` int(3) NOT NULL,
  `VoucherID` varchar(16) NOT NULL DEFAULT 'None'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`PaymentID`, `RentalID`, `PaymentDate`, `PaymentFrequency`, `AmountPaid`, `PaymentMethod`, `PaymentStatus`, `VoucherID`) VALUES
(1, 1, '2025-05-11 23:28:21', 'Daily', 2010.00, 'GCash', 1, 'NA'),
(2, 2, '2025-05-11 23:33:39', 'Daily', 1481.91, 'GCash', 1, 'NA'),
(3, 3, '2025-05-11 23:41:21', 'Daily', 1481.91, 'GCash', 1, 'NA'),
(4, 4, '2025-05-11 23:54:07', 'Daily', 2455.83, 'GCash', 1, 'NA'),
(5, 5, '2025-05-11 23:59:13', 'Daily', 3700.27, 'GCash', 0, 'NA'),
(6, 6, '2025-05-12 00:08:38', 'Daily', 2010.00, 'PayPal', 1, 'NA'),
(7, 7, '2025-05-12 00:12:08', 'Daily', 2246.11, 'GCash', 1, 'NA'),
(8, 8, '2025-05-12 00:13:46', 'Daily', 1481.91, 'Bank Transfer', 1, 'NA'),
(9, 9, '2025-05-12 00:14:59', 'Daily', 2010.00, 'GCash', 1, 'NA');

-- --------------------------------------------------------

--
-- Table structure for table `rentals`
--

CREATE TABLE `rentals` (
  `RentalID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `CarID` int(11) NOT NULL,
  `PickUpLocationID` int(11) NOT NULL,
  `DropOffLocationID` int(11) NOT NULL,
  `StartDate` datetime NOT NULL,
  `EndDate` datetime NOT NULL,
  `Penalty` double(10,2) NOT NULL,
  `Status` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rentals`
--

INSERT INTO `rentals` (`RentalID`, `UserID`, `CarID`, `PickUpLocationID`, `DropOffLocationID`, `StartDate`, `EndDate`, `Penalty`, `Status`) VALUES
(1, 2, 1, 2, 2, '2025-05-09 23:28:00', '2025-05-11 23:30:00', 50.00, 3),
(2, 2, 2, 2, 2, '2025-03-13 23:33:56', '2025-05-11 23:40:00', 50.00, 3),
(3, 2, 2, 2, 2, '2025-05-07 23:41:00', '2025-05-11 23:51:00', 100.00, 3),
(4, 2, 4, 2, 2, '2025-04-23 23:53:00', '2025-05-11 23:58:00', 0.00, 3),
(5, 2, 3, 2, 2, '2025-05-11 23:58:00', '2025-05-12 00:05:00', 0.00, 3),
(6, 2, 1, 2, 2, '2025-05-12 00:08:00', '2025-05-12 00:12:00', 4000.00, 3),
(7, 2, 5, 2, 2, '2025-05-12 00:11:00', '2025-05-12 00:15:00', 10000.00, 3),
(8, 2, 2, 2, 2, '2025-05-12 00:13:00', '2025-05-12 00:15:00', 50.00, 3),
(9, 2, 1, 2, 2, '2025-05-12 00:14:00', '2025-05-12 00:14:00', 50.00, 3);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `ReviewID` int(11) NOT NULL,
  `RentalID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `CarID` int(11) NOT NULL,
  `UserReview` varchar(255) NOT NULL,
  `Rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`ReviewID`, `RentalID`, `UserID`, `CarID`, `UserReview`, `Rating`) VALUES
(1, 1, 2, 1, 'Nice! ', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `TicketID` int(11) NOT NULL,
  `UserID` int(12) NOT NULL,
  `Conversation` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`Conversation`)),
  `Status` tinyint(4) NOT NULL,
  `Date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `PhoneNumber` varchar(11) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `DoB` date NOT NULL,
  `DriversLicense` varchar(50) NOT NULL,
  `Role` varchar(16) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `DateCreated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Table structure for table `vouchers`
--

CREATE TABLE `vouchers` (
  `VoucherUID` varchar(8) NOT NULL,
  `Discount` double(5,2) NOT NULL,
  `Type` varchar(16) NOT NULL,
  `ExpiryDate` datetime NOT NULL,
  `UsedTimes` int(11) NOT NULL,
  `MaxUsage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vouchers`
--

INSERT INTO `vouchers` (`VoucherUID`, `Discount`, `Type`, `ExpiryDate`, `UsedTimes`, `MaxUsage`) VALUES
('Udud', 25.00, 'Cash', '2025-05-13 00:00:00', 0, 80),
('Uedd', 566.00, 'Cash', '2025-05-13 00:00:00', 0, 50),
('Uedu', 566.00, 'Cash', '2025-05-13 00:00:00', 0, 50),
('Usjh', 65.00, 'Cash', '2025-05-13 00:00:00', 0, 20),
('Usys', 65.00, 'Cash', '2025-05-13 00:00:00', 0, 20);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`BrandID`),
  ADD UNIQUE KEY `BrandName` (`BrandName`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`CarID`),
  ADD KEY `BrandID` (`BrandID`),
  ADD KEY `ModelID` (`ModelID`);

--
-- Indexes for table `car_statistics`
--
ALTER TABLE `car_statistics`
  ADD PRIMARY KEY (`StatisticsID`),
  ADD KEY `car_statistics_ibfk_1` (`CustomerID`),
  ADD KEY `car_statistics_ibfk_2` (`CarID`);

--
-- Indexes for table `damages`
--
ALTER TABLE `damages`
  ADD PRIMARY KEY (`CarID`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`LocationID`),
  ADD UNIQUE KEY `Address` (`Address`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`LogID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `models`
--
ALTER TABLE `models`
  ADD PRIMARY KEY (`ModelID`),
  ADD UNIQUE KEY `ModelName` (`ModelName`),
  ADD KEY `BrandID` (`BrandID`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`PaymentID`),
  ADD KEY `RentalID` (`RentalID`);

--
-- Indexes for table `rentals`
--
ALTER TABLE `rentals`
  ADD PRIMARY KEY (`RentalID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `CarID` (`CarID`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`ReviewID`),
  ADD KEY `RentalID` (`RentalID`),
  ADD KEY `CarID` (`CarID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`TicketID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `DLicense` (`DriversLicense`),
  ADD UNIQUE KEY `PhoneNo` (`PhoneNumber`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `vouchers`
--
ALTER TABLE `vouchers`
  ADD PRIMARY KEY (`VoucherUID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `BrandID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `CarID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `car_statistics`
--
ALTER TABLE `car_statistics`
  MODIFY `StatisticsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `LocationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `LogID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `models`
--
ALTER TABLE `models`
  MODIFY `ModelID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `PaymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `rentals`
--
ALTER TABLE `rentals`
  MODIFY `RentalID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `ReviewID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `TicketID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `cars_ibfk_1` FOREIGN KEY (`BrandID`) REFERENCES `brands` (`BrandID`),
  ADD CONSTRAINT `cars_ibfk_2` FOREIGN KEY (`ModelID`) REFERENCES `models` (`ModelID`);

--
-- Constraints for table `car_statistics`
--
ALTER TABLE `car_statistics`
  ADD CONSTRAINT `car_statistics_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `car_statistics_ibfk_2` FOREIGN KEY (`CarID`) REFERENCES `cars` (`CarID`);

--
-- Constraints for table `damages`
--
ALTER TABLE `damages`
  ADD CONSTRAINT `damages_ibfk_1` FOREIGN KEY (`CarID`) REFERENCES `cars` (`CarID`);

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `models`
--
ALTER TABLE `models`
  ADD CONSTRAINT `models_ibfk_1` FOREIGN KEY (`BrandID`) REFERENCES `brands` (`BrandID`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`RentalID`) REFERENCES `rentals` (`RentalID`);

--
-- Constraints for table `rentals`
--
ALTER TABLE `rentals`
  ADD CONSTRAINT `rentals_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `rentals_ibfk_2` FOREIGN KEY (`CarID`) REFERENCES `cars` (`CarID`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`RentalID`) REFERENCES `rentals` (`RentalID`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`CarID`) REFERENCES `cars` (`CarID`),
  ADD CONSTRAINT `reviews_ibfk_3` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

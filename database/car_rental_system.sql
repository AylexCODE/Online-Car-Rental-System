-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2025 at 09:01 PM
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
-- Database: `car_rental_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `BrandID` int(11) NOT NULL,
  `BrandName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`BrandID`, `BrandName`) VALUES
(1, 'Toyota');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `CarID` int(11) NOT NULL,
  `BrandID` int(11) NOT NULL,
  `Model` varchar(50) NOT NULL,
  `FuelType` varchar(16) NOT NULL,
  `Transmission` varchar(16) NOT NULL,
  `RentalPrice` varchar(12) NOT NULL,
  `LocationID` int(11) NOT NULL,
  `Availability` tinyint(1) NOT NULL,
  `ImageName` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`CarID`, `BrandID`, `Model`, `FuelType`, `Transmission`, `RentalPrice`, `LocationID`, `Availability`, `ImageName`) VALUES
(1, 1, 'Fortuner', 'Petrol', 'Manual', '4999.49', 1, 0, ''),
(2, 2, 'P540 Super fast Aperta', 'Petrol', 'Manual', '6999.99', 2, 1, ''),
(3, 2, 'as', 'Gasoline', 'Manual', '', 1, 0, 'Activity3.jpg.png'),
(4, 2, 'as', 'Gasoline', 'Manual', '', 1, 0, 'Activity3.jpgA.png'),
(5, 2, 'sa', 'Gasoline', 'Manual', '?1221', 1, 0, 'Activity3.jpgAA.png');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `LocationID` int(11) NOT NULL,
  `Address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`LocationID`, `Address`) VALUES
(1, 'Barangay, Town, Province, Country'),
(2, 'San Roque, Balilihan, Bohol, Philipines');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Name`, `PhoneNumber`, `Email`, `DoB`, `DriversLicense`, `Role`, `Password`, `DateCreated`) VALUES
(1, 'Lex Code', '09634356322', 'lexcode@gmail.com', '2003-10-16', '125-98-210832', 'Admin', '$2y$10$M93Kq6TIVLZC75yRCa17NeoYSDzjScTLg.EH1tciUj3UEDTxHJGgu', '2025-03-24 21:48:11'),
(3, 'as as', '09122122121', 'as@gmail.com', '2003-03-07', '121-22-121212', 'Customer', '$2y$10$iKMMgLHrtzV9GGyfSEA4.uLaHWsNLY8/KhZN6k3HrB/RxnsJeuVL.', '2025-03-29 14:34:34'),
(5, 'as as', '09121212121', 'ley@gmail.com', '2004-03-03', '121-21-212121', 'Customer', '$2y$10$52gr13rki0jLpsGEHWJhJuHmhibdg8odHWZxoaAKj3wygKa1Wsvq.', '2025-03-29 18:29:03'),
(7, 'sa as', '09124356533', 'sasa@gmail.com', '2007-03-01', '121-21-1176gd', 'Customer', '$2y$10$MW59AYifeoq1VXs0zaFiIOvOu0VxDnH1C5YRQa1vRdWKcj05Y8Kx.', '2025-04-03 20:15:37');

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
  ADD PRIMARY KEY (`CarID`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`LocationID`),
  ADD UNIQUE KEY `Address` (`Address`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `DLicense` (`DriversLicense`),
  ADD UNIQUE KEY `PhoneNo` (`PhoneNumber`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `BrandID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `CarID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `LocationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

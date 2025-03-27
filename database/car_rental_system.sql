-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2025 at 01:09 AM
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
(1, 'Toyota'),
(2, 'Ferrari');

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
  `RentalPrice` double NOT NULL,
  `LocationID` int(11) NOT NULL,
  `Availability` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`CarID`, `BrandID`, `Model`, `FuelType`, `Transmission`, `RentalPrice`, `LocationID`, `Availability`) VALUES
(1, 1, 'Fortuner', 'Petrol', 'Manual', 4999.49, 1, 0),
(2, 2, 'P540 Super fast Aperta', 'Petrol', 'Manual', 6999.99, 2, 1);

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
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Name`, `PhoneNumber`, `Email`, `DoB`, `DriversLicense`, `Role`, `Password`, `DateCreated`) VALUES
(1, 'Lex Code', '09634356322', 'lexcode@gmail.com', '2003-10-16', '125-98-210832', 'Admin', '$2y$10$M93Kq6TIVLZC75yRCa17NeoYSDzjScTLg.EH1tciUj3UEDTxHJGgu', '2025-03-24 21:48:11'),
(3, 'Ley Man', '09796461648', 'ley@gmail.com', '2000-03-20', '726-72-287273', 'Customer', '$2y$10$5ihowacDQlp1dNDygloGRegvd6beBu.GWzDlOE/HzJtrNf4ekHY9O', '2025-03-26 19:14:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`BrandID`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`CarID`);

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
  MODIFY `BrandID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `CarID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2023 at 04:39 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parking`
--

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `Customer Name` varchar(50) NOT NULL,
  `Telephone Number` varchar(12) NOT NULL,
  `Vehicle Number` varchar(8) NOT NULL,
  `Vehicle Category` varchar(5) NOT NULL,
  `Fuel type` varchar(5) NOT NULL,
  `Location` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `customerName` varchar(255) NOT NULL,
  `telephone` int(10) NOT NULL,
  `vehicleNo` varchar(100) NOT NULL,
  `vehicleCategory` varchar(100) NOT NULL,
  `fuelType` varchar(10) NOT NULL,
  `location` varchar(100) NOT NULL,
  `password` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `customerName`, `telephone`, `vehicleNo`, `vehicleCategory`, `fuelType`, `location`, `password`) VALUES
(1, 'sa', 0, 'sanduni@gmail.com', '', 'Diesel', 'Gampaha', 'sanduni'),
(2, 'sa', 2132, 'wp-1234', '', 'Petrol', 'Colombo', 'sandunid'),
(3, 'sa', 55555, 'dx@gmail.com', '', 'Petrol', 'Colombo', 'sandun'),
(4, 'Sanduni', 314444444, '00000', '', 'Petrol', 'Colombo', 'sanduni8'),
(5, 'Sanduni', 314444444, 'b', '', 'Petrol', 'Colombo', 'gggggggg'),
(6, 'Sanduni', 314444444, 'bn', '', 'Petrol', 'Colombo', ';;;;;;;;'),
(7, 'Sanduni', 314444444, 'sanduni@gmail.comb', '', 'Petrol', 'Colombo', 'sanduni/');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`Vehicle Number`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

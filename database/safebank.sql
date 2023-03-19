-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2023 at 09:32 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `safebank`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `AccountNo` varchar(12) NOT NULL,
  `Balance` varchar(100) NOT NULL,
  `SavingBalance` varchar(100) NOT NULL,
  `SavingTarget` varchar(100) NOT NULL,
  `AccountType` text NOT NULL,
  `State` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--


-- --------------------------------------------------------

--
-- Table structure for table `customer_detail`
--

CREATE TABLE `customer_detail` (
  `C_No` int(11) NOT NULL,
  `Account_No` varchar(12) NOT NULL,
  `C_First_Name` text NOT NULL,
  `C_Last_Name` text NOT NULL,
  `C_Father_Name` text NOT NULL,
  `C_Mother_Name` text NOT NULL,
  `C_Birth_Date` date NOT NULL,
  `C_Mobile_No` varchar(10) NOT NULL,
  `C_Email` varchar(200) NOT NULL,
  `C_Gender` text NOT NULL,
  `Create_Date` date NOT NULL DEFAULT current_timestamp(),
  `ProfileColor` varchar(100) NOT NULL,
  `ProfileImage` varchar(400) NOT NULL,
  `Bio` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_detail`
--


-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `ID` int(11) NOT NULL,
  `AccountNo` varchar(12) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `Password` varchar(40) NOT NULL,
  `Status` varchar(20) NOT NULL,
  `State` int(11) NOT NULL,
  `AuthKey` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--


-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `AccountNo` varchar(12) NOT NULL,
  `FAccountNo` varchar(12) NOT NULL,
  `Name` text NOT NULL,
  `Amount` varchar(100) NOT NULL,
  `Debit` varchar(100) NOT NULL,
  `Credit` varchar(100) NOT NULL,
  `DateTime` datetime NOT NULL DEFAULT current_timestamp(),
  `Status` text NOT NULL,
  `ProfileColor` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction`
--


--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `AccountNo` (`AccountNo`);

--
-- Indexes for table `customer_detail`
--
ALTER TABLE `customer_detail`
  ADD PRIMARY KEY (`C_No`),
  ADD UNIQUE KEY `Account_No` (`Account_No`),
  ADD UNIQUE KEY `C_Email` (`C_Email`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`AccountNo`),
  ADD UNIQUE KEY `Unique` (`ID`),
  ADD UNIQUE KEY `AccountNo` (`AccountNo`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customer_detail`
--
ALTER TABLE `customer_detail`
  MODIFY `C_No` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

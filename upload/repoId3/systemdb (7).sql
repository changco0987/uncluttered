-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2022 at 02:04 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `systemdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admintb`
--

CREATE TABLE `admintb` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `loginCount` int(11) DEFAULT NULL,
  `activeLogin` int(11) DEFAULT NULL,
  `sessionExpiry` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `announcementtb`
--

CREATE TABLE `announcementtb` (
  `id` int(11) NOT NULL,
  `heading` varchar(50) NOT NULL,
  `content` varchar(500) DEFAULT NULL,
  `imageName` varchar(100) DEFAULT NULL,
  `isShow` tinyint(1) NOT NULL DEFAULT 0,
  `type` varchar(100) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dtr`
--

CREATE TABLE `dtr` (
  `id` int(11) NOT NULL,
  `dataId` int(11) NOT NULL,
  `temperature` varchar(10) DEFAULT NULL,
  `accType` varchar(100) NOT NULL,
  `time_in` varchar(100) DEFAULT NULL,
  `time_out` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `facultytb`
--

CREATE TABLE `facultytb` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `imageName` varchar(100) DEFAULT NULL,
  `contact_number` varchar(12) NOT NULL,
  `department` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `gateStat` varchar(50) DEFAULT NULL,
  `dtrId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `guardiantb`
--

CREATE TABLE `guardiantb` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contact_number` varchar(12) NOT NULL,
  `studentId` varchar(50) NOT NULL,
  `qr_ExDate` varchar(100) DEFAULT NULL,
  `imageName` varchar(100) DEFAULT NULL,
  `status` varchar(100) NOT NULL,
  `notification` tinyint(1) NOT NULL,
  `gateStat` varchar(50) DEFAULT NULL,
  `dtrId` int(11) DEFAULT NULL,
  `otp` varchar(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `logstb`
--

CREATE TABLE `logstb` (
  `id` int(11) NOT NULL,
  `activity` varchar(500) NOT NULL,
  `creator` varchar(50) NOT NULL,
  `ipAdd` varchar(100) NOT NULL,
  `accType` varchar(100) NOT NULL,
  `dateStamp` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `qrsettingstb`
--

CREATE TABLE `qrsettingstb` (
  `id` int(11) NOT NULL,
  `expiryHrs` int(11) NOT NULL,
  `qrStatus` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `studentstb`
--

CREATE TABLE `studentstb` (
  `id` int(11) NOT NULL,
  `studentId` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `course` varchar(50) NOT NULL,
  `section` varchar(20) NOT NULL,
  `year` varchar(20) NOT NULL,
  `age` int(10) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contact_number` varchar(11) NOT NULL,
  `imageName` varchar(100) DEFAULT NULL,
  `status` varchar(100) NOT NULL,
  `guardianName` varchar(100) DEFAULT NULL,
  `guardianNum` varchar(11) DEFAULT NULL,
  `school` varchar(200) DEFAULT NULL,
  `gateStat` varchar(50) DEFAULT NULL,
  `dtrId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `visitortb`
--

CREATE TABLE `visitortb` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contact_number` varchar(12) NOT NULL,
  `qr_ExDate` varchar(100) DEFAULT NULL,
  `imageName` varchar(100) DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `gateStat` varchar(50) DEFAULT NULL,
  `dtrId` int(11) DEFAULT NULL,
  `otp` varchar(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admintb`
--
ALTER TABLE `admintb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `announcementtb`
--
ALTER TABLE `announcementtb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dtr`
--
ALTER TABLE `dtr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facultytb`
--
ALTER TABLE `facultytb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guardiantb`
--
ALTER TABLE `guardiantb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logstb`
--
ALTER TABLE `logstb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qrsettingstb`
--
ALTER TABLE `qrsettingstb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `studentstb`
--
ALTER TABLE `studentstb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitortb`
--
ALTER TABLE `visitortb`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admintb`
--
ALTER TABLE `admintb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `announcementtb`
--
ALTER TABLE `announcementtb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dtr`
--
ALTER TABLE `dtr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `facultytb`
--
ALTER TABLE `facultytb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guardiantb`
--
ALTER TABLE `guardiantb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logstb`
--
ALTER TABLE `logstb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `qrsettingstb`
--
ALTER TABLE `qrsettingstb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `studentstb`
--
ALTER TABLE `studentstb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visitortb`
--
ALTER TABLE `visitortb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 22, 2021 at 09:33 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `CRUD`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `ID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`ID`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Personal Documents', '2021-08-22 08:05:21', '2021-08-22 08:05:21'),
(2, 'Canadian Entity Documents', '2021-08-22 08:05:21', '2021-08-22 08:05:21'),
(3, 'Current Entity Documents', '2021-08-22 08:05:21', '2021-08-22 08:05:21');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `category_id`, `name`, `created_at`, `updated_at`) VALUES
(2, 1, 'Passport', '2021-08-22 08:04:45', '2021-08-22 08:06:20'),
(6, 1, 'Photo', '2021-08-22 08:04:45', '2021-08-22 08:04:45'),
(7, 2, 'North Client List', '2021-08-22 08:04:45', '2021-08-22 08:04:45'),
(9, 2, 'Potential Clients in North America', '2021-08-22 08:04:45', '2021-08-22 08:04:45'),
(10, 2, 'Business Letter Suppport', '2021-08-22 08:04:45', '2021-08-22 08:04:45'),
(11, 3, 'Vendor Contracts', '2021-08-22 08:04:45', '2021-08-22 08:04:45'),
(12, 3, 'Lease Contracts', '2021-08-22 08:04:45', '2021-08-22 08:04:45'),
(13, 3, 'Technology and Intelectual Property', '2021-08-22 08:04:45', '2021-08-22 08:04:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `test` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `test` FOREIGN KEY (`category_id`) REFERENCES `categories` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

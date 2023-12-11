-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2023 at 03:13 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `queueing_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `login_list`
--

CREATE TABLE `login_list` (
  `id` int(11) NOT NULL,
  `role` varchar(150) NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_list`
--

INSERT INTO `login_list` (`id`, `role`, `username`, `password`) VALUES
(1, 'administrator', 'admin', 'admin1');

-- --------------------------------------------------------

--
-- Table structure for table `queue_list`
--

CREATE TABLE `queue_list` (
  `id` int(11) NOT NULL,
  `priority` varchar(150) NOT NULL,
  `status` varchar(150) NOT NULL,
  `added_at` datetime NOT NULL DEFAULT current_timestamp(),
  `finished_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `queue_list`
--

INSERT INTO `queue_list` (`id`, `priority`, `status`, `added_at`, `finished_at`) VALUES
(34, '3', 'DONE', '2023-04-16 23:39:45', '2023-04-18 13:44:12'),
(35, '4', 'DONE', '2023-04-17 00:16:01', '2023-04-18 14:00:05'),
(51, '1', 'DONE', '2023-04-18 01:41:35', '2023-04-18 14:03:42'),
(53, '2', 'DONE', '2023-04-18 03:33:53', '2023-04-18 03:34:25'),
(54, '2', 'DONE', '2023-04-18 03:34:05', '2023-04-18 03:34:20'),
(55, '4', 'CALLED', '2023-04-18 14:22:10', NULL),
(56, '3', 'DONE', '2023-04-18 14:23:31', '2023-04-18 14:26:01'),
(57, '3', 'CALLED', '2023-04-18 14:33:41', NULL),
(58, '2', 'CALLED', '2023-04-18 14:38:27', NULL),
(60, '1', 'READY', '2023-04-18 14:39:49', NULL),
(61, '2', 'WAITING', '2023-04-22 22:07:23', NULL),
(62, '2', 'PROCESSING', '2023-04-22 22:16:54', NULL),
(83, '2', 'CALLED', '2023-05-16 12:33:00', NULL),
(149, '4', 'WAITING', '2023-05-30 20:28:08', NULL),
(150, '4', 'WAITING', '2023-06-01 11:55:10', NULL),
(159, '2', 'WAITING', '2023-06-01 13:19:01', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login_list`
--
ALTER TABLE `login_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `queue_list`
--
ALTER TABLE `queue_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login_list`
--
ALTER TABLE `login_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `queue_list`
--
ALTER TABLE `queue_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

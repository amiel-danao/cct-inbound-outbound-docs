-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2023 at 03:33 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cct`
--

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `send_to` varchar(255) NOT NULL,
  `uploaded_by` varchar(100) NOT NULL,
  `date_upload` date NOT NULL,
  `document_type` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT 'pending',
  `archive` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `file_name`, `file_path`, `send_to`, `uploaded_by`, `date_upload`, `document_type`, `status`, `archive`) VALUES
(7, 'file1', '/uploads/2CHAP-1-3revision.docx', 'user2', 'user1', '2023-02-07', 'Personal', 'approved', 1),
(8, 'file22', '/uploads/2CHAP-1-3revision.docx', 'user2', 'user1', '2023-02-07', 'Non-Personal', 'approved', 0),
(9, 'file33', '/uploads/3sample.pdf', 'user1', 'user2', '2023-02-07', 'Personal', 'approved', 0),
(10, 'file1', '/uploads/2see8.jpg', 'user2', 'user1', '2023-02-09', 'Non-Personal', 'pending', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `user_type` varchar(10) NOT NULL DEFAULT 'user',
  `last_login` datetime DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `middle_name`, `last_name`, `contact_number`, `user_type`, `last_login`, `active`) VALUES
(1, 'admin@admin.com', 'admin', 'admin', 'admin', 'admin', '09954261220', 'admin', '2023-02-20 15:32:30', 1),
(2, 'user1', 'admin', 'amiel', 'Fegalquin', 'Danao', '09954261220', 'user', '2023-02-20 14:25:27', 0),
(3, 'user2', 'admin', 'amiel', 'Fegalquin', 'Danao', '09954261220', 'user', NULL, 1),
(4, 'user3', 'admin', 'amiel', 'Fegalquin', 'Danao', '09954261220', 'user', NULL, 1),
(5, 'user4', 'admin', 'amiel', 'Fegalquin', 'Danao', '09954261220', 'user', NULL, 1),
(6, 'users_has_no_white_space', 'notCommonPassword123$', 'amiel', 'Fegalquin', 'Danao', '', 'user', NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2023 at 12:09 AM
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
-- Database: `attendance_monitoring`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `name`, `user_id`, `role`) VALUES
(34, 'admin@gmail.com', '$2y$10$uo8sqNFJxhkrMQI8VmZPdurlWX9E6w8SR/4VfAo5hizss77d63dfG', 'Admini', '903435738', 'Admin'),
(36, 'estab@gmail.com', '$2y$10$/ZvfXE1pO6U114aLYXGQ2OwXS7u3WeCyGJj/zp4/fdwEUAjoaJ3lu', 'NIXEN', '789575239', 'Establishment');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(255) NOT NULL,
  `section_id` int(255) NOT NULL,
  `student_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `section_id`, `student_id`) VALUES
(9, 1, 38),
(11, 1, 36),
(12, 1, 31);

-- --------------------------------------------------------

--
-- Table structure for table `dtr`
--

CREATE TABLE `dtr` (
  `id` int(255) NOT NULL,
  `student_id` int(255) NOT NULL,
  `estab_id` int(255) NOT NULL,
  `time_in_am` time NOT NULL,
  `in_am` varchar(2) NOT NULL,
  `time_out_am` time NOT NULL,
  `out_am` varchar(2) NOT NULL,
  `time_in_pm` time NOT NULL,
  `in_pm` varchar(2) NOT NULL,
  `time_out_pm` time NOT NULL,
  `out_pm` varchar(2) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dtr`
--

INSERT INTO `dtr` (`id`, `student_id`, `estab_id`, `time_in_am`, `in_am`, `time_out_am`, `out_am`, `time_in_pm`, `in_pm`, `time_out_pm`, `out_pm`, `date`) VALUES
(21, 31, 2, '09:37:00', 'PM', '09:38:00', 'PM', '09:38:00', 'PM', '09:38:00', 'PM', '2023-11-02');

-- --------------------------------------------------------

--
-- Table structure for table `establishment`
--

CREATE TABLE `establishment` (
  `id` int(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `establishment_name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `creator_id` int(255) NOT NULL,
  `creator_name` varchar(255) NOT NULL,
  `creator_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `establishment`
--

INSERT INTO `establishment` (`id`, `code`, `establishment_name`, `location`, `creator_id`, `creator_name`, `creator_email`) VALUES
(2, '2023002', 'NIXEN', 'offline', 35, 'Nixen Tech', 'estab@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id` int(255) NOT NULL,
  `establishment_id` int(255) NOT NULL,
  `student_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id`, `establishment_id`, `student_id`) VALUES
(11, 2, 36),
(12, 2, 31);

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `id` int(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `section_name` varchar(255) NOT NULL,
  `admin_id` int(255) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`id`, `code`, `section_name`, `admin_id`, `admin_name`, `admin_email`) VALUES
(1, '2023001', 'CRANE', 34, 'Admini', 'admin@gmail.com'),
(2, '2023004', 'EAGLE', 34, 'Admini', 'admin@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `user_id`, `role`) VALUES
(31, 'mangao.christian.04@gmail.com', '$2y$10$fAdeTdZpj3Ah.DWbmJtUcOWMH2HcGxYpKLr.rmgVVyX/0kzJ9iRJO', 'Ketchan', '333758789', 'Student'),
(36, 'lovegellay@gmail.com', '$2y$10$OlnO.1Ng2.jDXs3SezPQrus02y6lYZUjRTUGbGCUNSfNkqsCAzgfC', 'Gellay', '621566478', 'Student'),
(38, 'test@gmail.com', '$2y$10$wH3969CxnHduUyJEktBATOyOhAADr5qIibDrWnaUnXrpbPzAPXh3e', 'Test', '436201130', 'Student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dtr`
--
ALTER TABLE `dtr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `establishment`
--
ALTER TABLE `establishment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `dtr`
--
ALTER TABLE `dtr`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `establishment`
--
ALTER TABLE `establishment`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

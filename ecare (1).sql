-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2024 at 10:05 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecare`
--

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `patient_id` int(11) NOT NULL,
  `appointment_date` date NOT NULL,
  `time` time NOT NULL,
  `first_name` varchar(64) NOT NULL,
  `last_name` varchar(64) NOT NULL,
  `gender` enum('Male','Female','Prefer not to say') NOT NULL,
  `birthdate` date NOT NULL DEFAULT current_timestamp(),
  `contact_num` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `appointment_status` enum('Confirmed','Pending','Cancelled') NOT NULL DEFAULT 'Pending',
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`patient_id`, `appointment_date`, `time`, `first_name`, `last_name`, `gender`, `birthdate`, `contact_num`, `address`, `purpose`, `appointment_status`, `id`) VALUES
(1, '2024-06-21', '15:00:00', 'Jennifer', 'Smith', 'Female', '2024-06-02', '09123456789', 'orion', 'Checkup', 'Pending', 1),
(6, '2024-06-12', '07:16:00', 'Scean', 'Dulatre', 'Male', '2024-06-04', '09456663687', 'Limay, Bataan', 'Heartburn', 'Confirmed', 7),
(7, '2024-06-18', '08:02:00', 'Christian', 'Vergara', 'Male', '2024-06-28', '09123126412', 'Binalonan, Pangasinan', 'Checkup', 'Pending', 3),
(8, '2024-06-03', '15:07:00', 'Eman', 'Macaraeg', 'Male', '2024-06-11', '090202020202', 'Abucay, Bataan', 'Chest pain', 'Cancelled', 8),
(10, '2024-08-31', '13:30:00', 'Aleli', 'Paneza', 'Female', '2004-04-08', '09217256271', 'San Manuel', 'Follow up checkup', 'Cancelled', 3),
(13, '2024-06-22', '14:30:00', 'Alice', 'Mendoza', 'Female', '2002-04-02', '09126432781', 'Balanga, Bataan', 'Initial checkup', 'Confirmed', 9);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `account_type` enum('patient','doctor') NOT NULL,
  `first_name` varchar(64) NOT NULL,
  `last_name` varchar(64) NOT NULL,
  `birthdate` date NOT NULL,
  `email_address` varchar(64) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `account_type`, `first_name`, `last_name`, `birthdate`, `email_address`, `username`, `password`) VALUES
(1, 'patient', 'Claricel', 'Vergara', '2001-04-07', 'hehe@yoyo.com', 'clvrgr', 'gandako'),
(2, 'doctor', 'John', 'Smith', '1999-04-03', 'doctor@hospital.com', 'smith', 'smith123'),
(3, 'patient', 'Cha', 'Paneza', '2003-02-12', 'aleli@email.com', 'aleli', 'aleli123'),
(6, 'patient', 'ray', 'sabino', '2001-07-24', 'lab@lablab.com', 'rayden', 'crushakonito'),
(7, 'patient', 'scean', 'dulatre', '2003-07-07', 'ya@email.com', 'scean', 'sceanz'),
(8, 'patient', 'eman', 'macaraeg', '2024-06-11', 'eman@email.com', 'eman', 'eman123'),
(9, 'patient', 'Alice', 'Mendoza', '2003-07-19', 'sample@email.com', 'sample1', 'sample123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`patient_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

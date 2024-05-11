-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 01, 2024 at 08:05 PM
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
-- Database: `dentalclinic`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('Mohamad', '$2y$10$75Oog/XHzusctk7ghmiu6.XW5pLEc1TykGWglhejaI1f1P8/H/Hi.'),
('Ali', '$2y$10$dZiBy3H/8kzwWJYdbp3/wOf7SBpt7KN1tZnzF93m6oEmBt4QtF1jW'),
('Hasan', '$2y$10$Zo4lp0jCHtJUJccGZHRzhONsNU0208NI1QW09HYNrpZT9YOALGUwW');

-- --------------------------------------------------------

--
-- Table structure for table `contact_form`
--

CREATE TABLE `contact_form` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `date` datetime NOT NULL,
  `type` varchar(100) NOT NULL,
  `price` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_form`
--

INSERT INTO `contact_form` (`id`, `name`, `email`, `number`, `date`, `type`, `price`) VALUES
(35, 'Mohamad Bahja', 'Mohamadbahja414@gmail.com', '96176890315', '2024-01-02 16:15:00', 'regular_checkup', '50.00'),
(36, 'Mohamad Issa', 'mohamadissa@gmail.com', '96181790813', '2024-01-03 12:30:00', 'teeth_whitening', '150.00'),
(37, 'Hasan Rhayel', 'hasanrhayel@gmail.com', '96178890567', '2024-01-07 13:30:00', 'crowns', '180.00'),
(38, 'Jaber Mobarak', 'jabermobarak@gmail.com', '96176171563', '2024-01-10 17:20:00', 'implants', '300.00'),
(39, 'Mohamad Hamadi', 'mohamadhamadi@gmail.com', '96181970426', '2024-01-11 15:40:00', 'tooth_extraction', '120.00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`) VALUES
('Mohamad', '$2y$10$VH7OG4qzapIWFNmDhOaJY.gd0xwtmOiNx5kpZUKCFWE.NtIzw390W'),
('Mohamad2', '$2y$10$ttJasFOfGybZSLOWNxhSDelwda23btj2X3NBa9bzRmApld4g0AShG'),
('Mohamad3', '$2y$10$RkZHrj.YV6p/2j1WJ3agUeayHzESGk6EA6MXbSeTEqA7dhtCAYIeC');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD UNIQUE KEY `username` (`username`) USING HASH;

--
-- Indexes for table `contact_form`
--
ALTER TABLE `contact_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_form`
--
ALTER TABLE `contact_form`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

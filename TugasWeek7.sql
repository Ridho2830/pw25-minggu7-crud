-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 29, 2025 at 05:31 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `TugasWeek7`
--

-- --------------------------------------------------------

--
-- Table structure for table `crud_134`
--

CREATE TABLE `crud_134` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `noTelp` varchar(20) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `is_logged_in` tinyint(1) DEFAULT 0,
  `session_id` varchar(255) DEFAULT NULL,
  `last_activity` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crud_134`
--

INSERT INTO `crud_134` (`id`, `username`, `password`, `nama`, `alamat`, `email`, `noTelp`, `role`, `is_logged_in`, `session_id`, `last_activity`, `created_at`) VALUES
(2, 'admin', '$2y$10$ftX6eiW2e21cQ1Y9PlSalOk2aklRmaNKrdUgrAAVb4v5YSSTWJDj.', 'admin', 'Jl. Sriwijaya No.333, Punia, Kec. Mataram, Kota Mataram, NTB', 'admin@gmail.com', '123456789', 'admin', 1, 'c4b7f86bae2357657e3c8edf4344061d', '2025-04-29 20:34:27', '2025-04-28 17:56:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `crud_134`
--
ALTER TABLE `crud_134`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `crud_134`
--
ALTER TABLE `crud_134`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

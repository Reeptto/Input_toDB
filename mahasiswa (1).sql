-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2025 at 02:47 PM
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
-- Database: `mahasiswa`
--

-- --------------------------------------------------------

--
-- Table structure for table `mhs`
--

CREATE TABLE `mhs` (
  `id` int(11) NOT NULL,
  `nama_mhs` varchar(50) NOT NULL,
  `nipd` varchar(12) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `created_app` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_app` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mhs`
--

INSERT INTO `mhs` (`id`, `nama_mhs`, `nipd`, `tgl_lahir`, `alamat`, `created_app`, `updated_app`) VALUES
(21, 'Ade', '240789', '0000-00-00', 'Lamaran', '2025-04-08 05:01:36', NULL),
(23, 'Ahmad', '240788', '2025-03-01', 'Bogor', '2025-04-08 05:02:35', NULL),
(24, 'Ari', '240787', '2025-03-02', 'Karawang', '2025-04-08 05:05:03', NULL),
(25, 'Bayu', '240786', '2025-03-03', 'Cibuaya', '2025-04-08 05:09:08', NULL),
(26, 'Rafal', '240785', '2025-03-04', 'East', '2025-04-08 05:11:56', NULL),
(27, 'Budi', '240784', '2025-03-05', 'Jakarta', '2025-04-08 06:28:51', NULL),
(28, 'Badeni', '240783', '2025-03-06', 'West', '2025-04-08 06:29:54', NULL),
(29, 'Oczy', '240782', '2025-03-07', 'North', '2025-04-11 12:07:58', NULL),
(30, 'Jolenta', '240781', '2025-03-08', 'South', '2025-04-11 12:16:22', NULL),
(31, 'Draka', '240780', '2025-03-09', 'Poland', '2025-04-11 12:34:23', NULL),
(32, 'Albert', '240779', '2025-03-10', 'Poland', '2025-04-11 12:34:50', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mhs`
--
ALTER TABLE `mhs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mhs`
--
ALTER TABLE `mhs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

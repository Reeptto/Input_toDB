-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Bulan Mei 2025 pada 06.11
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

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
-- Struktur dari tabel `auth`
--

CREATE TABLE `auth` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL,
  `role` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `auth`
--

INSERT INTO `auth` (`id`, `username`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin123', 'admin', '2025-05-03 03:18:47', NULL),
(3, 'AriAprianto', '$2y$10$1ITUvA57iQmiPi6D99I0quVZcGDRRRlXY5zomkqggu1Q46aBFL3Ga', 'administrator', '2025-05-03 04:48:56', NULL),
(4, 'nendys', '$2y$10$Yhxcifbe0Nux8YmdC.hQeeqqSLiVcmic2VOZlKf23MWehkFFFJZxO', 'Administrator', '2025-05-05 03:11:56', NULL),
(5, 'array', '$2y$10$bKMCTqLKKz5YDaw1JD6Fr.iHsf.Wk1drRDss6hAkOkgAPljzzPQmW', 'administrator', '2025-05-24 01:32:17', NULL),
(6, 'Ase', '$2y$10$kxc0327pkT9/7UEpbZ72u.TXrkiloGGBRE91skNWHj4TL53nTSGQG', 'administrator', '2025-05-24 02:08:01', NULL),
(7, 'admin1', '$2y$10$cMDBCa6O0Ab8Fobfw5.lfO7UyNojoO7GGGUMB4NqjcuGecWaAN6x.', 'administrator', '2025-05-24 03:43:11', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `auth`
--
ALTER TABLE `auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

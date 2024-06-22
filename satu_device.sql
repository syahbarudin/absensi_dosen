-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2024 at 05:00 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `satu_device`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id` int(11) NOT NULL,
  `dosen_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id`, `dosen_id`, `username`, `tanggal`, `waktu`, `lokasi`, `created_at`, `updated_at`) VALUES
(1, 2, 'ical', '2024-06-18', '19:50:54', '-6.247601, 107.118967', '2024-06-18 12:50:54', '2024-06-18 12:50:54'),
(2, 3, 'ucok', '2024-06-19', '07:15:18', '-6.323684639115995, 107.16941502577238', '2024-06-19 00:15:18', '2024-06-19 00:15:18'),
(3, 2, 'ical', '2024-06-19', '09:10:57', '-6.3236632309203475, 107.16934209586866', '2024-06-19 02:10:57', '2024-06-19 02:10:57'),
(4, 4, 'frans', '2024-06-19', '09:38:20', '-6.323695898673921, 107.16925587028223', '2024-06-19 02:38:20', '2024-06-19 02:38:20');

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `device_info` varchar(255) DEFAULT NULL,
  `last_login` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_device_info` varchar(255) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id`, `username`, `password`, `device_info`, `last_login`, `created_at`, `last_device_info`, `ip_address`) VALUES
(2, 'ical', '$2y$10$ZhrZ1.AQMEemCcz4u.1wqulsLTamJMgwPFcvtYB7jwhShx4DzdS.G', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:126.0) Gecko/20100101 Firefox/126.0', '2024-06-19 02:04:17', '2024-06-18 12:21:36', NULL, '::1'),
(3, 'ucok', '$2y$10$YIHwp/1321BEVoZUlZ.LHuyIQK7CAX6VD1NfZfLxzwYRd1wMiC2zO', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:126.0) Gecko/20100101 Firefox/126.0', '2024-06-19 02:34:16', '2024-06-19 00:14:43', NULL, '::1'),
(4, 'frans', '$2y$10$XASgL3SBao470QGnYdMdqez/8GS8mhwvkub7PujZ8cOKl8DCRi6PS', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:126.0) Gecko/20100101 Firefox/126.0', '2024-06-19 02:37:42', '2024-06-19 02:35:38', NULL, '::1');

-- --------------------------------------------------------

--
-- Table structure for table `janji_temu`
--

CREATE TABLE `janji_temu` (
  `id` int(10) NOT NULL,
  `dosen_id` int(10) NOT NULL,
  `mahasiswa_id` int(10) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `tempat` varchar(255) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `status` enum('Menunggu','Disetujui','Dibatalkan') NOT NULL DEFAULT 'Menunggu',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `janji_temu`
--

INSERT INTO `janji_temu` (`id`, `dosen_id`, `mahasiswa_id`, `tanggal`, `waktu`, `tempat`, `keterangan`, `status`, `created_at`, `updated_at`) VALUES
(5, 3, 1, '2024-06-19', '11:30:00', 'Kampus', 'Skripsi', 'Menunggu', '2024-06-19 00:58:04', '2024-06-19 00:58:04');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `device_info` varchar(255) DEFAULT NULL,
  `last_login` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_device_info` varchar(255) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `username`, `password`, `device_info`, `last_login`, `created_at`, `last_device_info`, `ip_address`) VALUES
(1, 'udin', '$2y$10$5I8i3inbxeye06AS7VRx7usKiepiR33LfBD.VLELfnJqZ75JpA3Vy', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:126.0) Gecko/20100101 Firefox/126.0', '2024-06-19 02:38:42', '2024-05-14 11:38:20', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:126.0) Gecko/20100101 Firefox/126.0', '::1'),
(2, 'panjul', '$2y$10$FHAtFoLTpJGV6kYXCFu.puw/7/txBavXAz1ZlqMRNgbcERgOHca0S', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:126.0) Gecko/20100101 Firefox/126.0', '2024-05-26 08:16:55', '2024-05-20 09:41:17', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:126.0) Gecko/20100101 Firefox/126.0', NULL),
(3, 'dina', '$2y$10$QAVSwBeosWZBMA4yUDOj/.wiajCmxQQlRyBGyrXsSIGXcJ/G696Wm', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:126.0) Gecko/20100101 Firefox/126.0', '2024-06-18 09:14:28', '2024-05-22 01:42:19', NULL, '::1'),
(4, 'kntl24', '$2y$10$s9q6A/5p9RCJ3foVzQSajeb9lYvYRn3NcOzCWUpIWiUT8P11ccpKW', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', '2024-06-03 01:18:56', '2024-06-03 01:18:42', NULL, '172.10.15.54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dosen_id` (`dosen_id`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`) USING BTREE;

--
-- Indexes for table `janji_temu`
--
ALTER TABLE `janji_temu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dosen_id` (`dosen_id`),
  ADD KEY `mahasiswa_id` (`mahasiswa_id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `janji_temu`
--
ALTER TABLE `janji_temu`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_ibfk_1` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `janji_temu`
--
ALTER TABLE `janji_temu`
  ADD CONSTRAINT `janji_temu_ibfk_1` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`id`),
  ADD CONSTRAINT `janji_temu_ibfk_2` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswa` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

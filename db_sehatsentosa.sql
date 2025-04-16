-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2025 at 04:32 PM
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
-- Database: `db_sehatsentosa`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `id_jadwal` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `status` enum('pending','selesai','batal') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `id_jadwal`, `id_pasien`, `status`, `created_at`) VALUES
(1, 1, 2, 'selesai', '2025-04-03 12:35:29'),
(4, 5, 2, 'batal', '2025-04-03 12:51:10'),
(5, 6, 2, 'selesai', '2025-04-03 12:57:09'),
(6, 3, 2, 'batal', '2025-04-03 12:57:20'),
(7, 2, 3, 'selesai', '2025-04-03 13:11:13'),
(8, 4, 2, 'selesai', '2025-04-03 13:24:42');

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `id_poli` int(11) NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`id`, `nama`, `id_poli`, `no_telepon`, `email`, `password_hash`, `created_at`) VALUES
(1, 'Dr. Andi Wijaya', 1, '+6281234567890', 'andi.wijaya@rshospital.com', '$2y$10$50HCiYlkwxs3fk/p.lDTUuJOregQq/hrbj0ovN.70TuOSYiQDi7fi', '2025-04-03 10:18:47'),
(2, 'Dr. Rina Kurniawan', 1, '+6289876543210', 'rina.kurniawan@rshospital.com', '$2y$10$oaelFmtcW3mVgi49l8pmgOfahlYB6oB05W4BgaO7WtMwd7xN/vkOa', '2025-04-03 10:18:47'),
(3, 'Dr. Budi Santoso', 2, '+6281122334455', 'budi.santoso@rshospital.com', '$2y$10$zfSYEhm7TPOplTaFJT/NpufdLgxxCQ/a5mOr9tHS3yZcozM5R6756', '2025-04-03 10:18:47'),
(4, 'Dr. Siti Handayani', 2, '+6285566778899', 'siti.handayani@rshospital.com', '$2y$10$ZHicu8YlzI7aAb4LN2DYC.D6aNdMKxCIqS69PVV6YvoJEDJQgtSqO', '2025-04-03 10:18:48'),
(5, 'Dr. Lina Kusuma', 3, '+6282233445566', 'lina.kusuma@rshospital.com', '$2y$10$COmh/YtkQqSx67RAvE.Hj.TeZWrSlKhNT348bkT9AovmUK.UEbJxq', '2025-04-03 10:18:48'),
(6, 'Dr. Fahrul Syah', 3, '+6286677889900', 'fahrul.syah@rshospital.com', '$2y$10$Z7.5eqBFJxi50PP34Tt9s.Oe3OtAuZXcd0t7xuJd2nqsgS.dxECeC', '2025-04-03 10:18:48');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_dokter`
--

CREATE TABLE `jadwal_dokter` (
  `id` int(11) NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `hari` enum('senin','selasa','rabu','kamis','jumat','sabtu','minggu') NOT NULL,
  `waktu_mulai` time NOT NULL,
  `waktu_selesai` time NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `kuota` int(11) DEFAULT 20
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal_dokter`
--

INSERT INTO `jadwal_dokter` (`id`, `id_dokter`, `hari`, `waktu_mulai`, `waktu_selesai`, `lokasi`, `kuota`) VALUES
(1, 1, 'senin', '08:00:00', '12:00:00', 'Lantai 1, Ruang 101', 20),
(2, 1, 'rabu', '14:00:00', '18:00:00', 'Lantai 1, Ruang 101', 20),
(3, 2, 'selasa', '09:00:00', '13:00:00', 'Lantai 2, Ruang 205', 15),
(4, 3, 'rabu', '08:30:00', '12:30:00', 'Lantai 3, Ruang 301', 18),
(5, 4, 'kamis', '10:00:00', '14:00:00', 'Lantai 2, Ruang 207', 20),
(6, 5, 'jumat', '08:00:00', '12:00:00', 'Lantai 3, Ruang 305', 15),
(7, 6, 'sabtu', '09:00:00', '13:00:00', 'Lantai 1, Ruang 102', 12);

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id_pasien` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `alamat` text NOT NULL,
  `no_telepon` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password_hash` varchar(100) NOT NULL,
  `tanggal_daftar` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id_pasien`, `nama_lengkap`, `tanggal_lahir`, `jenis_kelamin`, `alamat`, `no_telepon`, `email`, `password_hash`, `tanggal_daftar`) VALUES
(2, 'Iwan Haryatno', '2200-02-09', 'L', 'Desa Windujaya, RT 03 RW 03, Kecamatan KedungBanteng', '+6288232400859', 'iwnharry61@gmail.com', '$2y$10$uu2Nd/I9LuOCEEONZ6NSB.7ZngLw4JTbmLTDGfghr7SM8A96WO3sC', '2025-04-03 10:45:56'),
(3, 'Lorem Ipsum', '2010-10-10', 'L', 'Purwokerto\r\nBanyumas', '+628561840781', 'loremipsum@lorem.com', '$2y$10$5jxnMBJwq6upSSFjy8AOB.PgbDL18duCaN9HhErSnPkYVP1JQ8Gim', '2025-04-03 13:11:06');

-- --------------------------------------------------------

--
-- Table structure for table `poli`
--

CREATE TABLE `poli` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `poli`
--

INSERT INTO `poli` (`id`, `nama`, `deskripsi`, `created_at`) VALUES
(1, 'Umum', NULL, '2025-04-03 10:13:04'),
(2, 'Gigi', NULL, '2025-04-03 10:13:44'),
(3, 'Anak', NULL, '2025-04-03 10:13:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_jadwal` (`id_jadwal`),
  ADD KEY `id_pasien` (`id_pasien`);

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_poli` (`id_poli`);

--
-- Indexes for table `jadwal_dokter`
--
ALTER TABLE `jadwal_dokter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_dokter` (`id_dokter`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id_pasien`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `poli`
--
ALTER TABLE `poli`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jadwal_dokter`
--
ALTER TABLE `jadwal_dokter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id_pasien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `poli`
--
ALTER TABLE `poli`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal_dokter` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id_pasien`) ON DELETE CASCADE;

--
-- Constraints for table `dokter`
--
ALTER TABLE `dokter`
  ADD CONSTRAINT `dokter_ibfk_1` FOREIGN KEY (`id_poli`) REFERENCES `poli` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jadwal_dokter`
--
ALTER TABLE `jadwal_dokter`
  ADD CONSTRAINT `jadwal_dokter_ibfk_1` FOREIGN KEY (`id_dokter`) REFERENCES `dokter` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

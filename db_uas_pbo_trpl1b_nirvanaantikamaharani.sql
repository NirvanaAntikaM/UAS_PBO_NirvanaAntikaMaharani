-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 23, 2026 at 03:06 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_uas_pbo_trpl1b_nirvanaantikamaharani`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_karyawan`
--

CREATE TABLE `tabel_karyawan` (
  `id_karyawan` int NOT NULL,
  `nama_karyawan` varchar(100) NOT NULL,
  `departemen` varchar(50) NOT NULL,
  `hari_kerja_masuk` int NOT NULL,
  `gaji_dasar_per_hari` decimal(10,2) NOT NULL,
  `jenis_karyawan` enum('kontrak','tetap','magang') NOT NULL,
  `durasi_kontrak_bulan` int DEFAULT NULL,
  `agensi_penyalur` varchar(100) DEFAULT NULL,
  `tunjangan_kesehatan` decimal(10,2) DEFAULT NULL,
  `opsi_saham_id` varchar(50) DEFAULT NULL,
  `uang_saku_bulanan` decimal(10,2) DEFAULT NULL,
  `sertifikat_kampus_merdeka` varchar(100) DEFAULT NULL,
  `tanggal_dibuat` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tabel_karyawan`
--

INSERT INTO `tabel_karyawan` (`id_karyawan`, `nama_karyawan`, `departemen`, `hari_kerja_masuk`, `gaji_dasar_per_hari`, `jenis_karyawan`, `durasi_kontrak_bulan`, `agensi_penyalur`, `tunjangan_kesehatan`, `opsi_saham_id`, `uang_saku_bulanan`, `sertifikat_kampus_merdeka`, `tanggal_dibuat`) VALUES
(1, 'Aditya Pratama', 'IT Engine', 22, 250000.00, 'tetap', NULL, NULL, 500000.00, 'ESOP-001', NULL, NULL, '2026-06-23 03:06:28'),
(2, 'Budi Santoso', 'Finance', 21, 200000.00, 'tetap', NULL, NULL, 450000.00, 'ESOP-002', NULL, NULL, '2026-06-23 03:06:28'),
(3, 'Citra Dewi', 'HRD', 22, 180000.00, 'tetap', NULL, NULL, 400000.00, 'ESOP-003', NULL, NULL, '2026-06-23 03:06:28'),
(4, 'Deni Cahyono', 'Marketing', 20, 190000.00, 'tetap', NULL, NULL, 400000.00, 'ESOP-004', NULL, NULL, '2026-06-23 03:06:28'),
(5, 'Eka Sari', 'IT Engine', 22, 260000.00, 'tetap', NULL, NULL, 550000.00, 'ESOP-005', NULL, NULL, '2026-06-23 03:06:28'),
(6, 'Fajar Hidayat', 'Operations', 23, 175000.00, 'tetap', NULL, NULL, 350000.00, 'ESOP-006', NULL, NULL, '2026-06-23 03:06:28'),
(7, 'Gita Permata', 'Finance', 22, 210000.00, 'tetap', NULL, NULL, 450000.00, 'ESOP-007', NULL, NULL, '2026-06-23 03:06:28'),
(8, 'Hendra Wijaya', 'IT Engine', 22, 220000.00, 'kontrak', 12, 'PT Mitratama Solusindo', NULL, NULL, NULL, NULL, '2026-06-23 03:06:28'),
(9, 'Indah Lestari', 'Marketing', 19, 170000.00, 'kontrak', 6, 'PT Talent Nusantara', NULL, NULL, NULL, NULL, '2026-06-23 03:06:28'),
(10, 'Joko Susilo', 'Operations', 21, 160000.00, 'kontrak', 12, 'PT Mitratama Solusindo', NULL, NULL, NULL, NULL, '2026-06-23 03:06:28'),
(11, 'Kurniawati', 'HRD', 22, 170000.00, 'kontrak', 6, 'PT Bersama Jaya', NULL, NULL, NULL, NULL, '2026-06-23 03:06:28'),
(12, 'Laksana Tri', 'Creative', 20, 180000.00, 'kontrak', 6, 'PT Talent Nusantara', NULL, NULL, NULL, NULL, '2026-06-23 03:06:28'),
(13, 'Mega Utami', 'Finance', 22, 190000.00, 'kontrak', 12, 'PT Mitratama Solusindo', NULL, NULL, NULL, NULL, '2026-06-23 03:06:28'),
(14, 'Novan Adi', 'IT Engine', 21, 230000.00, 'kontrak', 24, 'PT Tech Indo', NULL, NULL, NULL, NULL, '2026-06-23 03:06:28'),
(15, 'Oki Ramadhan', 'IT Engine', 20, 90000.00, 'magang', NULL, NULL, NULL, NULL, 1500000.00, 'MSIB-BATCH6-01', '2026-06-23 03:06:28'),
(16, 'Putri Ayu', 'Creative', 22, 80000.00, 'magang', NULL, NULL, NULL, NULL, 1200000.00, 'MSIB-BATCH6-02', '2026-06-23 03:06:28'),
(17, 'Qori Mulyadi', 'HRD', 21, 80000.00, 'magang', NULL, NULL, NULL, NULL, 1200000.00, 'MSIB-BATCH6-03', '2026-06-23 03:06:28'),
(18, 'Rian Hidayat', 'Marketing', 18, 85000.00, 'magang', NULL, NULL, NULL, NULL, 1300000.00, 'Bukan Kampus Merdeka', '2026-06-23 03:06:28'),
(19, 'Siti Aminah', 'Finance', 22, 90000.00, 'magang', NULL, NULL, NULL, NULL, 1500000.00, 'MSIB-BATCH6-04', '2026-06-23 03:06:28'),
(20, 'Taufik Ismail', 'IT Engine', 20, 95000.00, 'magang', NULL, NULL, NULL, NULL, 1600000.00, 'MSIB-BATCH6-05', '2026-06-23 03:06:28'),
(21, 'Utari Widya', 'Creative', 21, 80000.00, 'magang', NULL, NULL, NULL, NULL, 1200000.00, 'Bukan Kampus Merdeka', '2026-06-23 03:06:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_karyawan`
--
ALTER TABLE `tabel_karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_karyawan`
--
ALTER TABLE `tabel_karyawan`
  MODIFY `id_karyawan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

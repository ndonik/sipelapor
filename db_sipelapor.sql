-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2023 at 06:11 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sipelapor`
--

-- --------------------------------------------------------

--
-- Table structure for table `bulan`
--

CREATE TABLE `bulan` (
  `id` int(3) NOT NULL,
  `bulan` varchar(100) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bulan`
--

INSERT INTO `bulan` (`id`, `bulan`, `create_at`, `update_at`) VALUES
(2, 'Febuari', '2023-05-25 20:08:16', '2023-05-25 09:57:59'),
(3, 'Maret', '2022-07-06 23:12:13', '2022-07-06 23:12:13'),
(4, 'April', '2022-07-06 23:12:33', '2022-07-06 23:12:33'),
(5, 'Mei', '2022-07-06 23:12:50', '2022-07-06 23:12:50'),
(6, 'Juni', '2022-07-06 23:13:07', '2022-07-06 23:13:07'),
(7, 'Juli', '2022-07-06 23:13:19', '2022-07-06 23:13:19'),
(8, 'Agustus', '2022-07-22 00:56:43', '2022-07-22 00:56:43'),
(9, 'September', '2022-07-22 00:56:53', '2022-07-22 00:56:53'),
(10, 'Oktober', '2022-07-22 00:57:01', '2022-07-22 00:57:01'),
(11, 'November', '2022-07-22 00:57:11', '2022-07-22 00:57:11'),
(12, 'Desember', '2022-07-22 00:57:19', '2022-07-22 00:57:19'),
(13, 'Januari', '2022-05-18 00:13:38', '2023-05-25 10:08:45');

-- --------------------------------------------------------

--
-- Table structure for table `data_padi`
--

CREATE TABLE `data_padi` (
  `id` int(5) NOT NULL,
  `nomor` varchar(20) NOT NULL,
  `id_provinsi` int(5) NOT NULL,
  `id_kabupaten` int(5) NOT NULL,
  `id_kecamatan` int(5) NOT NULL,
  `id_bulan` int(5) NOT NULL,
  `tahun` int(5) NOT NULL,
  `status` enum('Pending','Complete') NOT NULL,
  `status_verifikasi` enum('Pending','Cancel','Complete') NOT NULL,
  `id_user` int(5) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_padi`
--

INSERT INTO `data_padi` (`id`, `nomor`, `id_provinsi`, `id_kabupaten`, `id_kecamatan`, `id_bulan`, `tahun`, `status`, `status_verifikasi`, `id_user`, `create_at`, `update_at`) VALUES
(8, '1605072', 16, 1605, 1605072, 7, 2022, 'Complete', 'Complete', 2, '2022-07-11 21:57:34', '2022-07-11 22:02:14'),
(18, '1605072', 16, 1605, 1605072, 2, 2022, 'Complete', 'Complete', 1, '2022-07-22 01:00:09', '2022-07-24 07:45:43'),
(27, '1605072', 16, 1605, 1605072, 4, 2023, 'Complete', 'Complete', 1, '2023-04-05 09:08:46', '2023-04-05 09:11:37'),
(28, '123', 34, 3402, 3402070, 5, 2023, 'Complete', 'Pending', 1, '2023-05-23 21:10:37', '2023-05-23 21:12:04'),
(29, '16052', 34, 3402, 3402140, 5, 2023, 'Complete', 'Pending', 1, '2023-05-24 10:42:03', '2023-05-24 10:46:06'),
(30, '16052', 34, 3402, 3402140, 2, 2022, 'Complete', 'Pending', 1, '2023-05-25 10:03:31', '2023-05-25 10:04:26'),
(31, '16052', 34, 3402, 3402140, 2, 2023, 'Complete', 'Pending', 1, '2023-05-25 10:05:11', '2023-05-25 10:06:31');

-- --------------------------------------------------------

--
-- Table structure for table `data_palawija`
--

CREATE TABLE `data_palawija` (
  `id` int(5) NOT NULL,
  `nomor` varchar(20) NOT NULL,
  `id_provinsi` int(5) NOT NULL,
  `id_kabupaten` int(5) NOT NULL,
  `id_kecamatan` int(5) NOT NULL,
  `id_bulan` int(5) NOT NULL,
  `tahun` int(5) NOT NULL,
  `status` enum('Pending','Complete') NOT NULL,
  `status_verifikasi` enum('Pending','Cancel','Complete') NOT NULL,
  `id_user` int(5) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_palawija`
--

INSERT INTO `data_palawija` (`id`, `nomor`, `id_provinsi`, `id_kabupaten`, `id_kecamatan`, `id_bulan`, `tahun`, `status`, `status_verifikasi`, `id_user`, `create_at`, `update_at`) VALUES
(3, '1605072', 16, 1605, 1605072, 7, 2022, 'Pending', 'Pending', 1, '2022-07-23 22:34:23', '2022-07-23 22:34:23');

-- --------------------------------------------------------

--
-- Table structure for table `detail_padi`
--

CREATE TABLE `detail_padi` (
  `id` int(10) NOT NULL,
  `id_data_padi` int(10) NOT NULL,
  `id_kategori_padi` int(3) NOT NULL,
  `id_subkategori_padi` int(5) NOT NULL,
  `jenis_sawah` enum('Sawah','Bukan','Semua') NOT NULL,
  `sawah_panen` int(5) NOT NULL,
  `sawah_tanam` int(5) NOT NULL,
  `sawah_rusak` int(5) NOT NULL,
  `bukan_panen` int(5) NOT NULL,
  `bukan_tanam` int(5) NOT NULL,
  `bukan_rusak` int(5) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_padi`
--

INSERT INTO `detail_padi` (`id`, `id_data_padi`, `id_kategori_padi`, `id_subkategori_padi`, `jenis_sawah`, `sawah_panen`, `sawah_tanam`, `sawah_rusak`, `bukan_panen`, `bukan_tanam`, `bukan_rusak`, `create_at`, `update_at`) VALUES
(5, 8, 2, 1, 'Sawah', 5, 8, 4, 0, 0, 0, '2022-07-11 21:58:50', NULL),
(6, 18, 3, 7, 'Bukan', 0, 0, 0, 7, 8, 1, '2022-07-22 01:04:50', '2022-07-22 01:29:36'),
(15, 27, 2, 1, 'Sawah', 6, 4, 2, 0, 0, 0, '2023-04-05 09:09:39', NULL),
(16, 28, 2, 1, 'Sawah', 5, 8, 3, 0, 0, 0, '2023-05-23 21:11:38', NULL),
(17, 29, 2, 2, 'Bukan', 0, 0, 0, 10, 12, 0, '2023-05-24 10:43:53', NULL),
(18, 30, 2, 1, 'Sawah', 12, 12, 0, 0, 0, 0, '2023-05-25 10:04:05', NULL),
(19, 31, 3, 5, 'Bukan', 0, 0, 0, 10, 10, 0, '2023-05-25 10:06:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `detail_palawija`
--

CREATE TABLE `detail_palawija` (
  `id` int(10) NOT NULL,
  `id_data_palawija` int(10) NOT NULL,
  `id_kategori_palawija` int(3) NOT NULL,
  `id_subkategori_palawija` int(5) NOT NULL,
  `jenis_sawah` enum('Sawah','Bukan','Semua') NOT NULL,
  `sawah_panen` int(5) NOT NULL,
  `sawah_panen_muda` int(5) NOT NULL,
  `sawah_panen_ternak` int(5) NOT NULL,
  `sawah_tanam` int(5) NOT NULL,
  `sawah_rusak` int(5) NOT NULL,
  `bukan_panen` int(5) NOT NULL,
  `bukan_panen_muda` int(5) NOT NULL,
  `bukan_panen_ternak` int(5) NOT NULL,
  `bukan_tanam` int(5) NOT NULL,
  `bukan_rusak` int(5) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_palawija`
--

INSERT INTO `detail_palawija` (`id`, `id_data_palawija`, `id_kategori_palawija`, `id_subkategori_palawija`, `jenis_sawah`, `sawah_panen`, `sawah_panen_muda`, `sawah_panen_ternak`, `sawah_tanam`, `sawah_rusak`, `bukan_panen`, `bukan_panen_muda`, `bukan_panen_ternak`, `bukan_tanam`, `bukan_rusak`, `create_at`, `update_at`) VALUES
(3, 3, 1, 1, 'Semua', 8, 3, 4, 16, 1, 6, 5, 4, 16, 2, '2022-07-23 22:51:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kategori_padi`
--

CREATE TABLE `kategori_padi` (
  `id` int(3) NOT NULL,
  `uraian` varchar(200) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori_padi`
--

INSERT INTO `kategori_padi` (`id`, `uraian`, `create_at`, `update_at`) VALUES
(2, 'Jenis Padi', '2022-07-06 23:06:03', '2022-07-27 22:44:58'),
(3, 'Jenis Pengairan', '2022-07-06 23:06:31', '2022-07-06 23:06:31');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_palawija`
--

CREATE TABLE `kategori_palawija` (
  `id` int(3) NOT NULL,
  `uraian` varchar(200) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori_palawija`
--

INSERT INTO `kategori_palawija` (`id`, `uraian`, `create_at`, `update_at`) VALUES
(1, 'Jagung', '2022-07-22 00:21:33', '2022-07-22 00:23:47'),
(2, 'Kedelai', '2022-07-22 00:22:33', '2022-07-22 00:26:59'),
(3, 'Kacang Tanah', '2022-07-22 00:24:01', '2022-07-22 00:26:59'),
(4, 'Ubi Kayu / Singkong', '2022-07-22 00:24:21', '2022-07-22 00:26:59'),
(5, 'Ubi Jalar / Ketela Rambat', '2022-07-22 00:24:39', '2022-07-22 00:26:59'),
(6, 'Kacang Hijau', '2022-07-22 00:24:56', '2022-07-22 00:26:59'),
(7, 'Sorgum / Cantel', '2022-07-22 00:25:10', '2022-07-22 00:26:59'),
(8, 'Gandum', '2022-07-22 00:25:25', '2022-07-22 00:26:59'),
(9, 'Talas', '2022-07-22 00:25:35', '2022-07-22 00:26:59'),
(10, 'Ganyong', '2022-07-22 00:25:44', '2022-07-22 00:26:59'),
(11, 'Umbi Lainnya', '2022-07-22 00:25:59', '2022-07-22 00:26:59');

-- --------------------------------------------------------

--
-- Table structure for table `subkategori_padi`
--

CREATE TABLE `subkategori_padi` (
  `id` int(5) NOT NULL,
  `id_kategori_padi` int(3) NOT NULL,
  `uraian` varchar(200) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subkategori_padi`
--

INSERT INTO `subkategori_padi` (`id`, `id_kategori_padi`, `uraian`, `create_at`, `update_at`) VALUES
(1, 2, 'Hibrida Bantuan Pemerintah', '2022-07-06 23:08:27', '2022-07-21 16:49:07'),
(2, 2, 'Hibirda Non Bantuan Pemerintah', '2022-07-06 23:08:52', '2022-07-21 16:49:23'),
(3, 2, 'Inbrida Bantuan Pemerintah', '2022-07-06 23:09:07', '2022-07-21 16:49:31'),
(4, 2, 'Inbrida Non Bantuan Pemerintah', '2022-07-06 23:09:21', '2022-07-22 03:36:46'),
(5, 3, 'Sawah Irigasi', '2022-07-06 23:10:11', '2022-07-21 16:49:55'),
(6, 3, 'Sawah Tadah Hujan', '2022-07-06 23:10:33', '2022-07-21 16:50:03'),
(7, 3, 'Sawah Rawa Pasang Surut', '2022-07-06 23:10:50', '2022-07-21 16:50:12'),
(8, 3, 'Sawah Rawa Lebak', '2022-07-06 23:11:32', '2022-07-21 16:50:21');

-- --------------------------------------------------------

--
-- Table structure for table `subkategori_palawija`
--

CREATE TABLE `subkategori_palawija` (
  `id` int(5) NOT NULL,
  `id_kategori_palawija` int(3) NOT NULL,
  `uraian` varchar(200) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subkategori_palawija`
--

INSERT INTO `subkategori_palawija` (`id`, `id_kategori_palawija`, `uraian`, `create_at`, `update_at`) VALUES
(1, 1, 'Hibrida Bantuan Pemerintah', '2022-07-22 00:45:43', '2022-07-22 00:45:43'),
(5, 1, 'Hibirda Non Bantuan Pemerintah', '2022-07-22 00:46:56', '2022-07-22 00:46:56'),
(6, 1, 'Komposit', '2022-07-22 00:47:26', '2022-07-22 00:47:26'),
(7, 1, 'Lokal', '2022-07-22 00:47:35', '2022-07-22 00:47:35'),
(8, 2, 'Bantuan Pemerintah', '2022-07-22 00:48:08', '2022-07-22 00:48:08'),
(9, 2, 'Non Bantuan Pemerintah', '2022-07-22 00:48:18', '2022-07-22 00:48:18'),
(10, 4, 'Bantuan Pemerintah', '2022-07-22 00:49:12', '2022-07-22 00:49:12'),
(11, 4, 'Non Bantuan Pemerintah', '2022-07-22 00:49:20', '2022-07-22 00:49:20');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(3) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `nama_lengkap` varchar(200) NOT NULL,
  `jabatan` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `no_hp` varchar(25) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `level` enum('Admin','Penginput','Pengawas') NOT NULL,
  `status` enum('Y','N') NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nip`, `nama_lengkap`, `jabatan`, `email`, `no_hp`, `username`, `password`, `level`, `status`, `create_at`, `update_at`) VALUES
(1, '1111', 'Admin', 'Admin', 'Admin@gmail.com', '081111111111', 'admin', '465c194afb65670f38322df087f0a9bb225cc257e43eb4ac5a0c98ef5b3173ac', 'Admin', 'Y', '2022-06-25 18:04:25', '2022-06-25 18:04:25'),
(2, '1700016027', 'Penyuluh Satu', 'Penyuluh', 'penyuluh1@gmail.com', '0831', 'penyuluh1', 'fc0175757543c9e5e34692c955921915064045791e98df9692fedbf2e3e76dca', 'Penginput', 'Y', '2022-07-06 22:58:07', '2022-07-06 23:20:26'),
(3, '1700016028', 'Penyuluh Dua', 'Penyuluh', 'penyuluh2@gmail.com', '0814', 'penyuluh2', 'b78871d91234298a7511512309a6f189307b6a2d94cf929e887bbb02700adc00', 'Penginput', 'Y', '2022-07-06 22:59:46', '2022-07-06 23:20:38'),
(4, '1600016027', 'Pengawas Satu', 'Pengawas', 'pengawas1@gmail.com', '0823', 'pengawas1', 'd91362985d3e6a3636ee86d0a7f8ac11674fd11921c03718c1fbbe06d274bf45', 'Pengawas', 'Y', '2022-07-06 23:01:52', '2022-07-06 23:01:52'),
(5, '1600016028', 'Pengawas Dua', 'Pengawas', 'pengawas2@gmail.com', '0824', 'pengawas2', 'd254e469fe92f115166afaef1cd9e235fd53cb1473828fa5ab59c51bceafa17a', 'Pengawas', 'Y', '2022-07-06 23:03:50', '2022-07-27 22:04:11'),
(6, '13', '13', '31', '131@a.a', '13', '131', '12345678', 'Admin', 'N', '2022-07-30 00:52:53', '2023-05-10 22:35:05');

-- --------------------------------------------------------

--
-- Table structure for table `user_padi`
--

CREATE TABLE `user_padi` (
  `id` int(5) NOT NULL,
  `id_data_padi` int(5) NOT NULL,
  `id_user` int(5) NOT NULL,
  `catatan` text NOT NULL,
  `status` enum('Pending','Correction','Complete') NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_padi`
--

INSERT INTO `user_padi` (`id`, `id_data_padi`, `id_user`, `catatan`, `status`, `create_at`, `update_at`) VALUES
(6, 8, 4, '', 'Complete', '2022-07-11 21:59:04', '2022-07-11 22:02:14'),
(7, 8, 5, 'Ok', 'Complete', '2022-07-11 21:59:40', '2022-07-11 22:03:23'),
(10, 18, 4, 'Sip', 'Complete', '2022-07-22 01:29:58', '2022-07-24 07:45:43'),
(11, 18, 5, '', 'Pending', '2022-07-22 01:30:09', '2022-07-22 01:30:09'),
(14, 27, 4, 'Oke', 'Complete', '2023-04-05 09:09:58', '2023-04-05 09:11:37'),
(15, 28, 4, '', 'Pending', '2023-05-23 21:11:55', '2023-05-23 21:11:55'),
(16, 29, 4, '', 'Pending', '2023-05-24 10:44:23', '2023-05-24 10:44:23'),
(17, 30, 4, '', 'Pending', '2023-05-25 10:04:16', '2023-05-25 10:04:16'),
(18, 31, 4, '', 'Pending', '2023-05-25 10:06:22', '2023-05-25 10:06:22');

-- --------------------------------------------------------

--
-- Table structure for table `user_palawija`
--

CREATE TABLE `user_palawija` (
  `id` int(5) NOT NULL,
  `id_data_palawija` int(5) NOT NULL,
  `id_user` int(5) NOT NULL,
  `catatan` text NOT NULL,
  `status` enum('Pending','Correction','Complete') NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_palawija`
--

INSERT INTO `user_palawija` (`id`, `id_data_palawija`, `id_user`, `catatan`, `status`, `create_at`, `update_at`) VALUES
(3, 3, 4, '', 'Pending', '2022-07-23 22:52:48', '2022-07-23 22:52:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bulan`
--
ALTER TABLE `bulan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_padi`
--
ALTER TABLE `data_padi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_bulan` (`id_bulan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `data_palawija`
--
ALTER TABLE `data_palawija`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_bulan` (`id_bulan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `detail_padi`
--
ALTER TABLE `detail_padi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_data_padi` (`id_data_padi`),
  ADD KEY `id_kategori_padi` (`id_kategori_padi`),
  ADD KEY `id_subkategori_padi` (`id_subkategori_padi`);

--
-- Indexes for table `detail_palawija`
--
ALTER TABLE `detail_palawija`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_data_palawija` (`id_data_palawija`),
  ADD KEY `id_kategori_palawija` (`id_kategori_palawija`),
  ADD KEY `id_subkategori_palawija` (`id_subkategori_palawija`);

--
-- Indexes for table `kategori_padi`
--
ALTER TABLE `kategori_padi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori_palawija`
--
ALTER TABLE `kategori_palawija`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subkategori_padi`
--
ALTER TABLE `subkategori_padi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kategori_padi` (`id_kategori_padi`);

--
-- Indexes for table `subkategori_palawija`
--
ALTER TABLE `subkategori_palawija`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kategori_palawija` (`id_kategori_palawija`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_padi`
--
ALTER TABLE `user_padi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_data_padi` (`id_data_padi`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `user_palawija`
--
ALTER TABLE `user_palawija`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_data_padi` (`id_data_palawija`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bulan`
--
ALTER TABLE `bulan`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `data_padi`
--
ALTER TABLE `data_padi`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `data_palawija`
--
ALTER TABLE `data_palawija`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `detail_padi`
--
ALTER TABLE `detail_padi`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `detail_palawija`
--
ALTER TABLE `detail_palawija`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kategori_padi`
--
ALTER TABLE `kategori_padi`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kategori_palawija`
--
ALTER TABLE `kategori_palawija`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `subkategori_padi`
--
ALTER TABLE `subkategori_padi`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `subkategori_palawija`
--
ALTER TABLE `subkategori_palawija`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_padi`
--
ALTER TABLE `user_padi`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user_palawija`
--
ALTER TABLE `user_palawija`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_padi`
--
ALTER TABLE `data_padi`
  ADD CONSTRAINT `data_padi_ibfk_1` FOREIGN KEY (`id_bulan`) REFERENCES `bulan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `data_padi_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_palawija`
--
ALTER TABLE `data_palawija`
  ADD CONSTRAINT `data_palawija_ibfk_1` FOREIGN KEY (`id_bulan`) REFERENCES `bulan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `data_palawija_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_padi`
--
ALTER TABLE `detail_padi`
  ADD CONSTRAINT `detail_padi_ibfk_1` FOREIGN KEY (`id_data_padi`) REFERENCES `data_padi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_padi_ibfk_2` FOREIGN KEY (`id_kategori_padi`) REFERENCES `kategori_padi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_padi_ibfk_3` FOREIGN KEY (`id_subkategori_padi`) REFERENCES `subkategori_padi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_palawija`
--
ALTER TABLE `detail_palawija`
  ADD CONSTRAINT `detail_palawija_ibfk_1` FOREIGN KEY (`id_data_palawija`) REFERENCES `data_palawija` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_palawija_ibfk_2` FOREIGN KEY (`id_kategori_palawija`) REFERENCES `kategori_palawija` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_palawija_ibfk_3` FOREIGN KEY (`id_subkategori_palawija`) REFERENCES `subkategori_palawija` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subkategori_padi`
--
ALTER TABLE `subkategori_padi`
  ADD CONSTRAINT `subkategori_padi_ibfk_1` FOREIGN KEY (`id_kategori_padi`) REFERENCES `kategori_padi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subkategori_palawija`
--
ALTER TABLE `subkategori_palawija`
  ADD CONSTRAINT `subkategori_palawija_ibfk_1` FOREIGN KEY (`id_kategori_palawija`) REFERENCES `kategori_palawija` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_padi`
--
ALTER TABLE `user_padi`
  ADD CONSTRAINT `user_padi_ibfk_1` FOREIGN KEY (`id_data_padi`) REFERENCES `data_padi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_padi_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_palawija`
--
ALTER TABLE `user_palawija`
  ADD CONSTRAINT `user_palawija_ibfk_1` FOREIGN KEY (`id_data_palawija`) REFERENCES `data_palawija` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_palawija_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

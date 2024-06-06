-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2024 at 04:36 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bkadrev`
--

-- --------------------------------------------------------

--
-- Table structure for table `aset`
--

CREATE TABLE `aset` (
  `asetID` bigint(20) UNSIGNED NOT NULL,
  `namaAset` varchar(150) NOT NULL,
  `Lokasi` varchar(300) NOT NULL,
  `Kategori` varchar(150) NOT NULL,
  `Jenis` varchar(150) NOT NULL,
  `Panjang` double(8,2) NOT NULL,
  `Lebar` double(8,2) NOT NULL,
  `Luas` double(8,2) NOT NULL,
  `Tarif` bigint(20) NOT NULL,
  `jumlahAset` int(11) NOT NULL,
  `jumlahTersedia` int(11) NOT NULL,
  `Status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `aset`
--

INSERT INTO `aset` (`asetID`, `namaAset`, `Lokasi`, `Kategori`, `Jenis`, `Panjang`, `Lebar`, `Luas`, `Tarif`, `jumlahAset`, `jumlahTersedia`, `Status`, `created_at`, `updated_at`) VALUES
(1, 'Mall Jalan A', 'ya dimana gatau', 'Tanah dan Bangunan', 'Tanah dan bangunan untuk usaha atau industri beserta halamannya (Jalan Golongan A)', 20.00, 25.00, 500.00, 7500, 4, 2, 'Disewa', '2024-01-25 08:22:00', '2024-01-25 08:23:18'),
(2, 'Mall Jalan A', 'ya dimana gatau', 'Tanah dan Bangunan', 'Tanah dan bangunan untuk usaha atau industri beserta halamannya (Jalan Golongan A)', 99.00, 99.00, 9801.00, 7500, 5, 2, 'Disewa', '2024-01-25 08:22:30', '2024-01-25 08:23:18');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(3, '2024_01_22_074909_aset', 1),
(4, '2024_01_22_074923_sewa', 1),
(5, '2024_01_22_075932_pj', 1),
(6, '2024_01_22_075940_skrd', 1),
(7, '2024_01_22_075949_pembayaran', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `pembayaranID` bigint(20) UNSIGNED NOT NULL,
  `Nama` bigint(20) UNSIGNED NOT NULL,
  `NPWR` varchar(20) NOT NULL,
  `Alamat` varchar(300) NOT NULL,
  `namaAset` bigint(20) UNSIGNED NOT NULL,
  `Lokasi` varchar(300) NOT NULL,
  `Panjang` double(8,2) NOT NULL,
  `Lebar` double(8,2) NOT NULL,
  `Tarif` bigint(20) NOT NULL,
  `mulaiSewa` date NOT NULL,
  `lamaSewa` int(11) NOT NULL,
  `akhirSewa` date NOT NULL,
  `Total` bigint(20) UNSIGNED NOT NULL,
  `namaPetugas` varchar(150) NOT NULL,
  `tanggalPembayaran` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pj`
--

CREATE TABLE `pj` (
  `pjID` bigint(20) UNSIGNED NOT NULL,
  `namaPJ` varchar(150) NOT NULL,
  `NIP` varchar(18) NOT NULL,
  `Jabatan` varchar(150) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sewa`
--

CREATE TABLE `sewa` (
  `sewaID` bigint(20) UNSIGNED NOT NULL,
  `Nama` varchar(150) NOT NULL,
  `NIK` varchar(16) NOT NULL DEFAULT 'nilai_default',
  `Telepon` varchar(20) NOT NULL,
  `NPWR` varchar(20) NOT NULL,
  `Alamat` varchar(300) NOT NULL,
  `namaAset` bigint(20) UNSIGNED NOT NULL,
  `Jumlah` int(11) NOT NULL,
  `mulaiSewa` date NOT NULL,
  `lamaSewa` int(11) NOT NULL,
  `akhirSewa` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sewa`
--

INSERT INTO `sewa` (`sewaID`, `Nama`, `NIK`, `Telepon`, `NPWR`, `Alamat`, `namaAset`, `Jumlah`, `mulaiSewa`, `lamaSewa`, `akhirSewa`, `created_at`, `updated_at`) VALUES
(1, 'fleaaka', '1234567891234567', '12345678909', '12345676543', 'coba tebak dimana', 1, 2, '2024-01-25', 12, '2025-01-25', '2024-01-25 08:23:18', '2024-01-25 08:23:18'),
(2, 'fleaaka', '1234567891234567', '12345678909', '12345676543', 'coba tebak dimana', 2, 3, '2024-01-25', 12, '2025-01-25', '2024-01-25 08:23:18', '2024-01-25 08:23:18');

-- --------------------------------------------------------

--
-- Table structure for table `skrd`
--

CREATE TABLE `skrd` (
  `skrdID` bigint(20) UNSIGNED NOT NULL,
  `Nama` bigint(20) UNSIGNED NOT NULL,
  `NPWR` varchar(20) NOT NULL,
  `Alamat` varchar(300) NOT NULL,
  `namaAset` bigint(20) UNSIGNED NOT NULL,
  `Lokasi` varchar(300) NOT NULL,
  `Kategori` varchar(150) NOT NULL,
  `Jenis` varchar(150) NOT NULL,
  `mulaiSewa` date NOT NULL,
  `lamaSewa` int(11) NOT NULL,
  `akhirSewa` date NOT NULL,
  `Panjang` double(8,2) NOT NULL,
  `Lebar` double(8,2) NOT NULL,
  `Tarif` bigint(20) NOT NULL,
  `Jumlah` int(11) NOT NULL,
  `Harga` bigint(20) NOT NULL,
  `Denda` bigint(20) NOT NULL,
  `Pengurangan` bigint(20) NOT NULL,
  `Total` bigint(20) NOT NULL,
  `Terbilang` varchar(500) NOT NULL,
  `tanggalCetak` date NOT NULL,
  `NamaPJ` bigint(20) UNSIGNED NOT NULL,
  `Jabatan` varchar(150) NOT NULL,
  `NIP` varchar(18) NOT NULL,
  `statusPembayaran` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aset`
--
ALTER TABLE `aset`
  ADD PRIMARY KEY (`asetID`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`pembayaranID`),
  ADD KEY `pembayaran_nama_foreign` (`Nama`),
  ADD KEY `pembayaran_namaaset_foreign` (`namaAset`),
  ADD KEY `pembayaran_total_foreign` (`Total`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pj`
--
ALTER TABLE `pj`
  ADD PRIMARY KEY (`pjID`);

--
-- Indexes for table `sewa`
--
ALTER TABLE `sewa`
  ADD PRIMARY KEY (`sewaID`),
  ADD KEY `sewa_namaaset_foreign` (`namaAset`);

--
-- Indexes for table `skrd`
--
ALTER TABLE `skrd`
  ADD PRIMARY KEY (`skrdID`),
  ADD KEY `skrd_nama_foreign` (`Nama`),
  ADD KEY `skrd_namaaset_foreign` (`namaAset`),
  ADD KEY `skrd_namapj_foreign` (`NamaPJ`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aset`
--
ALTER TABLE `aset`
  MODIFY `asetID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `pembayaranID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pj`
--
ALTER TABLE `pj`
  MODIFY `pjID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sewa`
--
ALTER TABLE `sewa`
  MODIFY `sewaID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `skrd`
--
ALTER TABLE `skrd`
  MODIFY `skrdID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_nama_foreign` FOREIGN KEY (`Nama`) REFERENCES `sewa` (`sewaID`),
  ADD CONSTRAINT `pembayaran_namaaset_foreign` FOREIGN KEY (`namaAset`) REFERENCES `aset` (`asetID`),
  ADD CONSTRAINT `pembayaran_total_foreign` FOREIGN KEY (`Total`) REFERENCES `skrd` (`skrdID`);

--
-- Constraints for table `sewa`
--
ALTER TABLE `sewa`
  ADD CONSTRAINT `sewa_namaaset_foreign` FOREIGN KEY (`namaAset`) REFERENCES `aset` (`asetID`);

--
-- Constraints for table `skrd`
--
ALTER TABLE `skrd`
  ADD CONSTRAINT `skrd_nama_foreign` FOREIGN KEY (`Nama`) REFERENCES `sewa` (`sewaID`),
  ADD CONSTRAINT `skrd_namaaset_foreign` FOREIGN KEY (`namaAset`) REFERENCES `aset` (`asetID`),
  ADD CONSTRAINT `skrd_namapj_foreign` FOREIGN KEY (`NamaPJ`) REFERENCES `pj` (`pjID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

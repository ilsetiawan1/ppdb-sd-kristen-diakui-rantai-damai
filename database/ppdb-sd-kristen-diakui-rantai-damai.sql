-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2026 at 10:27 AM
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
-- Database: `ppdb-sd-kristen-diakui-rantai-damai`
--

-- --------------------------------------------------------

--
-- Table structure for table `biaya_daftar_ulang`
--

CREATE TABLE `biaya_daftar_ulang` (
  `id` int(11) NOT NULL,
  `nama_biaya` varchar(100) NOT NULL,
  `nominal` int(11) NOT NULL,
  `tahun_ajaran` varchar(9) NOT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan','Semua') NOT NULL DEFAULT 'Semua',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `biaya_daftar_ulang`
--

INSERT INTO `biaya_daftar_ulang` (`id`, `nama_biaya`, `nominal`, `tahun_ajaran`, `jenis_kelamin`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Infaq pengembangan', 6000000, '2024/2025', 'Semua', 1, '2024-08-14 09:37:39', '2024-08-14 09:37:39'),
(2, 'Seragam Putra', 705000, '2024/2025', 'Laki-Laki', 1, '2024-08-14 09:38:21', '2024-08-14 09:38:21'),
(3, 'Seragam Putri (Termasuk Kerudung)', 830000, '2024/2025', 'Perempuan', 1, '2024-08-14 09:38:47', '2024-08-14 09:39:35'),
(5, 'Buku Paket', 1500000, '2024/2025', 'Semua', 1, '2024-08-14 09:40:35', '2024-08-14 09:41:52');

-- --------------------------------------------------------

--
-- Table structure for table `foto`
--

CREATE TABLE `foto` (
  `id_foto` int(11) NOT NULL,
  `foto` varchar(225) DEFAULT NULL,
  `status` enum('Mulai','Berakhir') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `foto`
--

INSERT INTO `foto` (`id_foto`, `foto`, `status`, `created_at`, `updated_at`) VALUES
(6, '1718271660.jpg', 'Berakhir', '2024-06-13 09:41:55', '09:41:55'),
(7, '1718271715.jpg', 'Berakhir', '2024-07-29 09:37:08', '09:37:08'),
(10, '1722246060.jpg', 'Berakhir', '2024-07-29 09:49:15', '09:49:15'),
(11, 'landing/assets/img/foto/1722246555.jpg', 'Berakhir', '2024-07-29 09:49:20', '09:49:20'),
(12, 'landing/assets/img/foto/1722246560.jpg', 'Berakhir', '2024-07-29 09:51:09', '09:51:09'),
(13, 'landing/assets/img/foto/1722246669.jpg', 'Berakhir', '2024-07-30 05:17:30', '05:17:30'),
(14, '1722316650.jpg', 'Berakhir', '2024-07-30 05:23:32', '05:23:32'),
(15, '1722317012.jpg', 'Mulai', '2024-07-29 22:23:32', '05:23:32');

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_07_02_095433_add_email_to_tb_casis_table', 2),
(6, '2024_07_02_100313_create_jobs_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tahun_ajar`
--

CREATE TABLE `tahun_ajar` (
  `id_ajar` int(11) NOT NULL,
  `tahun_ajar` varchar(50) DEFAULT NULL,
  `mulai_pendaftaran` date DEFAULT NULL,
  `batas_pendaftaran` date DEFAULT NULL,
  `tgl_seleksi` date DEFAULT NULL,
  `status` enum('Berlangsung','Berakhir','Belum Dimulai') DEFAULT NULL,
  `kuota` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tahun_ajar`
--

INSERT INTO `tahun_ajar` (`id_ajar`, `tahun_ajar`, `mulai_pendaftaran`, `batas_pendaftaran`, `tgl_seleksi`, `status`, `kuota`, `created_at`, `updated_at`) VALUES
(1, '2024/2025', '2024-06-15', '2024-07-30', '2024-07-26', 'Berlangsung', 96, '2024-08-14 10:29:15', '2024-08-14 18:48:22'),
(2, '2025/2026', '2025-06-15', '2025-06-30', '2025-07-26', 'Belum Dimulai', 96, '2024-08-14 10:29:17', '2024-08-14 16:47:33'),
(3, '2026/2027', '2026-06-16', '2026-06-06', '2026-07-26', 'Belum Dimulai', 96, '2024-08-14 10:29:20', '2024-08-14 16:47:44');

-- --------------------------------------------------------

--
-- Table structure for table `tb_casis`
--

CREATE TABLE `tb_casis` (
  `id_casis` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `nik` varchar(16) NOT NULL,
  `tempat_lahir` varchar(20) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') DEFAULT NULL,
  `jml_saudara` int(11) DEFAULT NULL,
  `nama_ortu` varchar(50) DEFAULT NULL,
  `tempat_lahir_ortu` varchar(20) DEFAULT NULL,
  `tanggal_lahir_ortu` date DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `pendidikan_ortu` enum('Tidak Bersekolah','SD','SMP','SMA','S1','S2','S3') DEFAULT NULL,
  `pekerjaan_ortu` varchar(20) DEFAULT NULL,
  `gaji_ortu` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_casis`
--

INSERT INTO `tb_casis` (`id_casis`, `user_id`, `nama`, `email`, `nik`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `jenis_kelamin`, `jml_saudara`, `nama_ortu`, `tempat_lahir_ortu`, `tanggal_lahir_ortu`, `no_hp`, `pendidikan_ortu`, `pekerjaan_ortu`, `gaji_ortu`, `created_at`, `updated_at`) VALUES
(24, 38, 'Rizal Wahyudi', NULL, '1234567899', 'Klaten', '2008-07-17', 'Jl. Murhum', 'Laki-Laki', 2, 'yongssss', 'Yogjakarta', '1991-07-17', '082388291019', 'S1', 'Dosen', 300000, '2024-08-14 11:06:15', '16:55:13');

-- --------------------------------------------------------

--
-- Table structure for table `tb_daftar_ulang`
--

CREATE TABLE `tb_daftar_ulang` (
  `id_daftar_ulang` int(11) NOT NULL,
  `pendaftaran_id` int(11) DEFAULT NULL,
  `tahun_ajaran` varchar(9) NOT NULL,
  `tgl_daftar_ulang` date NOT NULL,
  `total_biaya` int(11) NOT NULL,
  `metode_pembayaran` enum('Cicilan','Lunas') NOT NULL,
  `jumlah_bayar` int(11) NOT NULL,
  `status_bayar` enum('Berhasil','Menunggu Konfirmasi','Gagal') NOT NULL,
  `bukti_pembayaran` varchar(225) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_daftar_ulang`
--

INSERT INTO `tb_daftar_ulang` (`id_daftar_ulang`, `pendaftaran_id`, `tahun_ajaran`, `tgl_daftar_ulang`, `total_biaya`, `metode_pembayaran`, `jumlah_bayar`, `status_bayar`, `bukti_pembayaran`, `keterangan`, `created_at`, `updated_at`) VALUES
(8, 30, '2024/2025', '2024-08-14', 8205000, 'Lunas', 8205000, 'Berhasil', 'bukti_pembayaran/1723655684_A91cyzayu_1shr23t_404.png', 'pembayran berhasil', '2024-08-14 10:14:44', '2024-08-14 10:55:51');

-- --------------------------------------------------------

--
-- Table structure for table `tb_panitia`
--

CREATE TABLE `tb_panitia` (
  `id_panitia` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') DEFAULT NULL,
  `status` enum('Aktif','Non Aktif') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_panitia`
--

INSERT INTO `tb_panitia` (`id_panitia`, `user_id`, `nama`, `jenis_kelamin`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'Panitia Seleksi', 'Perempuan', 'Aktif', '2024-07-02 11:19:19', '14:56:19'),
(6, 53, 'Panitia 1', 'Laki-Laki', 'Aktif', '2026-05-11 20:15:21', NULL),
(7, 54, 'panitia dua', 'Laki-Laki', 'Aktif', '2026-05-11 14:19:25', '21:19:25');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembayaran`
--

CREATE TABLE `tb_pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `casis_id` int(11) DEFAULT NULL,
  `tgl_pembayaran` date DEFAULT NULL,
  `jumlah_pembayaran` int(11) DEFAULT NULL,
  `status_pembayaran` enum('Lunas','Belum Lunas') DEFAULT NULL,
  `bukti_pembayaran` varchar(225) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_pembayaran`
--

INSERT INTO `tb_pembayaran` (`id_pembayaran`, `casis_id`, `tgl_pembayaran`, `jumlah_pembayaran`, `status_pembayaran`, `bukti_pembayaran`, `created_at`, `updated_at`) VALUES
(28, 24, '2024-07-30', 100000, 'Lunas', '1722314075_1720201228_.jpeg', '2024-07-30 05:13:01', '05:13:01');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pendaftaran`
--

CREATE TABLE `tb_pendaftaran` (
  `id_pendaftaran` int(11) NOT NULL,
  `casis_id` int(11) DEFAULT NULL,
  `ajar_id` int(11) DEFAULT NULL,
  `tgl_pendaftaran` date DEFAULT NULL,
  `status` enum('Berhasil','Pending','Gagal') DEFAULT NULL,
  `akte` varchar(225) DEFAULT NULL,
  `kk` varchar(225) DEFAULT NULL,
  `foto` varchar(225) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` time DEFAULT NULL,
  `status_daftar_ulang` enum('Belum','Sudah') DEFAULT 'Belum'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_pendaftaran`
--

INSERT INTO `tb_pendaftaran` (`id_pendaftaran`, `casis_id`, `ajar_id`, `tgl_pendaftaran`, `status`, `akte`, `kk`, `foto`, `created_at`, `updated_at`, `status_daftar_ulang`) VALUES
(30, 24, 1, '2024-07-30', 'Berhasil', 'akte_1722313679.jpg', 'kk_1722313647.jpg', 'foto_1722313663.png', '2024-08-14 18:53:34', '17:55:51', 'Belum');

-- --------------------------------------------------------

--
-- Table structure for table `tb_seleksi`
--

CREATE TABLE `tb_seleksi` (
  `id_seleksi` int(11) NOT NULL,
  `pendaftaran_id` int(11) DEFAULT NULL,
  `casis_id` int(11) DEFAULT NULL,
  `tgl_seleksi` date DEFAULT NULL,
  `nilai_baca` int(11) DEFAULT NULL,
  `nilai_tulis` int(11) DEFAULT NULL,
  `nilai_hitung` int(11) DEFAULT NULL,
  `nilai_ngaji` int(11) DEFAULT NULL,
  `nilai_wawancara` int(11) DEFAULT NULL,
  `total_nilai` int(11) DEFAULT NULL,
  `nilai_akhir` int(11) DEFAULT NULL,
  `hasil_seleksi` enum('Lolos','Tidak Lolos') DEFAULT NULL,
  `status` enum('Berhasil','Pending') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_seleksi`
--

INSERT INTO `tb_seleksi` (`id_seleksi`, `pendaftaran_id`, `casis_id`, `tgl_seleksi`, `nilai_baca`, `nilai_tulis`, `nilai_hitung`, `nilai_ngaji`, `nilai_wawancara`, `total_nilai`, `nilai_akhir`, `hasil_seleksi`, `status`, `created_at`, `updated_at`) VALUES
(9, 30, 24, '2024-07-18', 70, 87, 70, 77, 70, 374, 75, 'Lolos', 'Berhasil', '2024-07-21 13:46:38', '13:46:38');

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
  `role` enum('Calon Siswa','Admin','Kepala Sekolah','Panitia') DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$10$rhFYwOifVx7VZ6ahYtuD8Ot4dS5tg83O8fOkCKj.owGbK7noleIqe', 'Admin', NULL, '2024-05-18 06:09:20', '2024-05-18 06:09:22'),
(2, 'Panitia', 'panitia@gmail.com', NULL, '$2y$10$ar.aROzkV0hivUEec5pU7entNV8SbEPvL.KD2Dk20Y/UA8M.0yq7.', 'Panitia', NULL, '2024-05-25 07:56:19', '2024-05-25 07:56:19'),
(38, 'Rizal', 'rizal@gmail.com', NULL, '$2y$10$iQHaA/Na3AZFYErccA/saelEDUD2yH0p60u/Yfap/qSUqneXyPQE.', 'Calon Siswa', NULL, '2024-07-17 09:34:03', '2024-07-17 09:34:03'),
(45, 'madang', 'madang@gmail.com', NULL, '$2y$10$Rdtgx80FoPXbMJ/bq9xxQOcgbUTGF55jkrFbXHqGVtAMBOWo4a39i', 'Calon Siswa', NULL, '2024-07-28 07:58:40', '2024-07-28 07:58:40'),
(46, 'hamid', 'hamid@gmail.com', NULL, '$2y$10$CFM4a8NwkWbNqBGDHLFhmOFfxMyEYaIPyMJPuEDtIMyyoYjsAnnJK', 'Calon Siswa', NULL, '2024-07-29 23:16:49', '2024-07-29 23:16:49'),
(50, 'gilang', 'gilang@gmail.com', NULL, '$2y$10$sMXzENFBCIWWlLPUQLlGaulG7XynGmFfcsrxiax8Hvi5Jaz9gHU7.', 'Calon Siswa', NULL, '2024-08-14 08:53:28', '2024-08-14 08:53:28'),
(51, 'candra', 'candra@gmail.com', NULL, '$2y$10$xgCQdFzJiJdmu0ZihcnTOeSZFZgk5KCqkjFEjFjH2HcDjV4ZWWqmC', 'Calon Siswa', NULL, '2024-08-14 08:53:53', '2024-08-14 08:53:53'),
(52, 'Admin 1', 'admin1@gmail.com', NULL, '$2y$10$8daz1vhGRgUm9j3JDrplceC50JgnkgETREoeNHZvSWTzVDP9YKJn2', 'Admin', NULL, '2026-05-11 20:15:21', '2026-05-11 14:11:50'),
(53, 'Panitia 1', 'panitia1@gmail.com', NULL, '$2y$10$KwG31vKvOQbq5iipbsel8u2O4qJrlrptMT.i35Fef2Vfuicah6F9u', 'Panitia', NULL, '2026-05-11 20:15:21', '2026-05-11 14:12:26'),
(54, 'panitia 2', 'panitia2@gmail.com', NULL, '$2y$10$rFUtH//.EYTpmLOPuuoZUu7u8VazUxjyKxaazOpkiAe98xptJwaRG', 'Panitia', NULL, '2026-05-11 14:19:25', '2026-05-11 14:19:25'),
(55, 'Muhammad Ilham Setiawan', 'm.ilsetiawan1@gmail.com', NULL, '$2y$10$AtHEasf1UcUIX/pQpdVfgOwECOjoa14fIUVnYY5JEztskYoWjDhV.', 'Calon Siswa', NULL, '2026-05-12 00:56:56', '2026-05-12 00:56:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `biaya_daftar_ulang`
--
ALTER TABLE `biaya_daftar_ulang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`id_foto`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tahun_ajar`
--
ALTER TABLE `tahun_ajar`
  ADD PRIMARY KEY (`id_ajar`);

--
-- Indexes for table `tb_casis`
--
ALTER TABLE `tb_casis`
  ADD PRIMARY KEY (`id_casis`),
  ADD UNIQUE KEY `uq_nik` (`nik`),
  ADD KEY `id_user` (`user_id`);

--
-- Indexes for table `tb_daftar_ulang`
--
ALTER TABLE `tb_daftar_ulang`
  ADD PRIMARY KEY (`id_daftar_ulang`),
  ADD KEY `pendaftaran_id` (`pendaftaran_id`);

--
-- Indexes for table `tb_panitia`
--
ALTER TABLE `tb_panitia`
  ADD PRIMARY KEY (`id_panitia`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_casis` (`casis_id`);

--
-- Indexes for table `tb_pendaftaran`
--
ALTER TABLE `tb_pendaftaran`
  ADD PRIMARY KEY (`id_pendaftaran`),
  ADD KEY `id_casis` (`casis_id`),
  ADD KEY `tb_pendaftaran_ibfk_2` (`ajar_id`);

--
-- Indexes for table `tb_seleksi`
--
ALTER TABLE `tb_seleksi`
  ADD PRIMARY KEY (`id_seleksi`),
  ADD KEY `id_pendaftaran` (`pendaftaran_id`),
  ADD KEY `id_casis` (`casis_id`);

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
-- AUTO_INCREMENT for table `biaya_daftar_ulang`
--
ALTER TABLE `biaya_daftar_ulang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `foto`
--
ALTER TABLE `foto`
  MODIFY `id_foto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tahun_ajar`
--
ALTER TABLE `tahun_ajar`
  MODIFY `id_ajar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_casis`
--
ALTER TABLE `tb_casis`
  MODIFY `id_casis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tb_daftar_ulang`
--
ALTER TABLE `tb_daftar_ulang`
  MODIFY `id_daftar_ulang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_panitia`
--
ALTER TABLE `tb_panitia`
  MODIFY `id_panitia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tb_pendaftaran`
--
ALTER TABLE `tb_pendaftaran`
  MODIFY `id_pendaftaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tb_seleksi`
--
ALTER TABLE `tb_seleksi`
  MODIFY `id_seleksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_casis`
--
ALTER TABLE `tb_casis`
  ADD CONSTRAINT `tb_casis_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_daftar_ulang`
--
ALTER TABLE `tb_daftar_ulang`
  ADD CONSTRAINT `tb_daftar_ulang_ibfk_1` FOREIGN KEY (`pendaftaran_id`) REFERENCES `tb_pendaftaran` (`id_pendaftaran`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_panitia`
--
ALTER TABLE `tb_panitia`
  ADD CONSTRAINT `tb_panitia_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD CONSTRAINT `tb_pembayaran_ibfk_1` FOREIGN KEY (`casis_id`) REFERENCES `tb_casis` (`id_casis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_pendaftaran`
--
ALTER TABLE `tb_pendaftaran`
  ADD CONSTRAINT `tb_pendaftaran_ibfk_1` FOREIGN KEY (`casis_id`) REFERENCES `tb_casis` (`id_casis`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_pendaftaran_ibfk_2` FOREIGN KEY (`ajar_id`) REFERENCES `tahun_ajar` (`id_ajar`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_seleksi`
--
ALTER TABLE `tb_seleksi`
  ADD CONSTRAINT `tb_seleksi_ibfk_1` FOREIGN KEY (`pendaftaran_id`) REFERENCES `tb_pendaftaran` (`id_pendaftaran`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_seleksi_ibfk_2` FOREIGN KEY (`casis_id`) REFERENCES `tb_casis` (`id_casis`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

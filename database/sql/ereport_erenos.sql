-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 30, 2023 at 06:36 AM
-- Server version: 5.7.33
-- PHP Version: 8.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ereport_erenos`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `NIP` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `namaGuru` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `idJadwal` bigint(20) UNSIGNED NOT NULL,
  `idKelas` bigint(20) UNSIGNED NOT NULL,
  `idThnAjaran` bigint(20) UNSIGNED NOT NULL,
  `NIP` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hari` enum('senin','selasa','rabu','kamis','jumat','sabtu') COLLATE utf8mb4_unicode_ci NOT NULL,
  `idPelajaran` bigint(20) UNSIGNED NOT NULL,
  `mulai` time NOT NULL,
  `selesai` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kehadiran`
--

CREATE TABLE `kehadiran` (
  `idKehadiran` bigint(20) UNSIGNED NOT NULL,
  `tanggal` datetime NOT NULL,
  `idJadwal` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kehadiran_d`
--

CREATE TABLE `kehadiran_d` (
  `idKehadiran_D` bigint(20) UNSIGNED NOT NULL,
  `idKehadiran` bigint(20) UNSIGNED NOT NULL,
  `NIS` char(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Hadir','Sakit','Izin','Alpha') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `idKelas` bigint(20) UNSIGNED NOT NULL,
  `kelas` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mappingkelas_d`
--

CREATE TABLE `mappingkelas_d` (
  `idMappingKelas_D` bigint(20) UNSIGNED NOT NULL,
  `idMapping` bigint(20) UNSIGNED NOT NULL,
  `NIS` char(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mapping_kelas`
--

CREATE TABLE `mapping_kelas` (
  `idMapping` bigint(20) UNSIGNED NOT NULL,
  `idKelas` bigint(20) UNSIGNED NOT NULL,
  `idThnAjaran` bigint(20) UNSIGNED NOT NULL,
  `NIP` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE `materi` (
  `idMateri` bigint(20) UNSIGNED NOT NULL,
  `materi` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idPelajaran` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(5, '2023_03_05_074840_add_username', 1),
(8, '2023_03_08_065538_create_kelas_table', 2),
(9, '2023_03_08_070748_create_pelajaran_table', 2),
(11, '2023_03_08_085956_create_siswa_table', 4),
(12, '2023_04_10_124741_create_tahun_ajaran_table', 5),
(13, '2023_04_04_104016_create_guru_table', 6),
(14, '2023_03_08_062233_create_table_jadwal', 7),
(15, '2023_04_24_102211_create_fk_jadwal_table', 7),
(23, '2023_06_19_112041_create_materi_table', 10),
(24, '2023_06_19_112607_create_fk_materi_table', 10),
(35, '2023_06_19_113101_create_nilai_table', 15),
(36, '2023_06_24_232036_create_fk_nilai_table', 15),
(37, '2023_06_24_231523_create_nilai_d_table', 16),
(38, '2023_06_24_232524_create_fk_nilai_d_table', 17),
(39, '2023_04_15_034156_create_mappingkelas_table', 18),
(40, '2023_04_15_035130_create_fk_mappingkelas_table', 18),
(41, '2023_04_15_042227_create_mappingkealas_d_table', 19),
(42, '2023_04_15_042612_create_fk_mappingkelas_d_table', 19),
(43, '2023_05_05_054451_create_kehadiran_table', 20),
(44, '2023_05_05_055054_create_fk_kehadiran_table', 20),
(45, '2023_05_05_054735_create_kehadiran_d_table', 21),
(46, '2023_05_05_055451_create_fk_kehadiran_d_table', 21);

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `idNilai` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `aspek` enum('Pengetahuan','Keterampilan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` enum('Harian','Pertengahan Tengah Semester','Pertengahan Akhir Semester') COLLATE utf8mb4_unicode_ci NOT NULL,
  `idMateri` bigint(20) UNSIGNED NOT NULL,
  `idKelas` bigint(20) UNSIGNED NOT NULL,
  `NIP` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nilai_d`
--

CREATE TABLE `nilai_d` (
  `idNilai_D` bigint(20) UNSIGNED NOT NULL,
  `nilai` decimal(4,1) NOT NULL,
  `idNilai` bigint(20) UNSIGNED NOT NULL,
  `NIS` char(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pelajaran`
--

CREATE TABLE `pelajaran` (
  `idPelajaran` bigint(20) UNSIGNED NOT NULL,
  `kodePelajaran` int(8) NOT NULL,
  `nmPelajaran` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nmSingkatan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KKM` tinyint(4) NOT NULL,
  `deskripsiA` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsiB` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsiC` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsiD` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `NIS` char(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nmSiswa` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nmPanggil` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tinggi` decimal(4,1) NOT NULL,
  `berat` decimal(4,1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tahun_ajaran`
--

CREATE TABLE `tahun_ajaran` (
  `idThnAjaran` bigint(20) UNSIGNED NOT NULL,
  `thnAjaran` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `semester` enum('Gasal','Genap') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NIP` char(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` tinyint(4) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `NIP`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'Superadmin', '3412491256', 'superadmin@gmail.com', '2023-06-29 23:32:34', '$2y$10$S7mVpDf3vuf/gPSrdu3h1esdFwAyi/BaECp24cr2YqKTwEKEZl5WG', 1, '49SStmT3csdkMjuZrqlGhA3xnQwVECL76EYba3wmpMdpw8ALgcCqUCuXqeUf', '2023-06-29 23:32:34', '2023-06-29 23:32:34'),
(2, 'guru', 'Guru', '3429494466', 'guru@gmail.com', '2023-06-29 23:32:34', '$2y$10$4R4iCegkys92Q0TTQJMc/.DGijqsHOuXgZTt4XDOygeJOdilEjqcO', 0, 'WT1yqFj4S4', '2023-06-29 23:32:34', '2023-06-29 23:32:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`NIP`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`idJadwal`),
  ADD KEY `fk_jadwal_kelas` (`idKelas`),
  ADD KEY `fk_jadwal_tahunajaran` (`idThnAjaran`),
  ADD KEY `fk_jadwal_guru` (`NIP`),
  ADD KEY `fk_jadwal_pelajaran` (`idPelajaran`);

--
-- Indexes for table `kehadiran`
--
ALTER TABLE `kehadiran`
  ADD PRIMARY KEY (`idKehadiran`),
  ADD KEY `fk_kehadiran_jadwal` (`idJadwal`);

--
-- Indexes for table `kehadiran_d`
--
ALTER TABLE `kehadiran_d`
  ADD PRIMARY KEY (`idKehadiran_D`),
  ADD KEY `fk_kehadiran_d_kehadiran` (`idKehadiran`),
  ADD KEY `fk_kehadiran_d_siswa` (`NIS`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`idKelas`);

--
-- Indexes for table `mappingkelas_d`
--
ALTER TABLE `mappingkelas_d`
  ADD PRIMARY KEY (`idMappingKelas_D`),
  ADD KEY `fk_mappingkelas_d_mappingkelas` (`idMapping`),
  ADD KEY `fk_mappingkelas_d_siswa` (`NIS`);

--
-- Indexes for table `mapping_kelas`
--
ALTER TABLE `mapping_kelas`
  ADD PRIMARY KEY (`idMapping`),
  ADD KEY `fk_mappingkelas_kelas` (`idKelas`),
  ADD KEY `fk_mappingkelas_tahunajaran` (`idThnAjaran`),
  ADD KEY `fk_mappingkelas_guru` (`NIP`);

--
-- Indexes for table `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`idMateri`),
  ADD KEY `fk_materi_pelajaran` (`idPelajaran`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`idNilai`),
  ADD KEY `fk_nilai_guru` (`NIP`),
  ADD KEY `fk_nilai_kelas` (`idKelas`),
  ADD KEY `fk_nilai_materi` (`idMateri`);

--
-- Indexes for table `nilai_d`
--
ALTER TABLE `nilai_d`
  ADD PRIMARY KEY (`idNilai_D`),
  ADD KEY `fk_nilai_d_nilai` (`idNilai`),
  ADD KEY `fk_nilai_d_siswa` (`NIS`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pelajaran`
--
ALTER TABLE `pelajaran`
  ADD PRIMARY KEY (`idPelajaran`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`NIS`);

--
-- Indexes for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  ADD PRIMARY KEY (`idThnAjaran`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `idJadwal` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kehadiran`
--
ALTER TABLE `kehadiran`
  MODIFY `idKehadiran` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kehadiran_d`
--
ALTER TABLE `kehadiran_d`
  MODIFY `idKehadiran_D` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `idKelas` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mappingkelas_d`
--
ALTER TABLE `mappingkelas_d`
  MODIFY `idMappingKelas_D` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mapping_kelas`
--
ALTER TABLE `mapping_kelas`
  MODIFY `idMapping` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `materi`
--
ALTER TABLE `materi`
  MODIFY `idMateri` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `idNilai` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nilai_d`
--
ALTER TABLE `nilai_d`
  MODIFY `idNilai_D` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pelajaran`
--
ALTER TABLE `pelajaran`
  MODIFY `idPelajaran` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  MODIFY `idThnAjaran` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `fk_jadwal_guru` FOREIGN KEY (`NIP`) REFERENCES `guru` (`NIP`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_jadwal_kelas` FOREIGN KEY (`idKelas`) REFERENCES `kelas` (`idKelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_jadwal_pelajaran` FOREIGN KEY (`idPelajaran`) REFERENCES `pelajaran` (`idPelajaran`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_jadwal_tahunajaran` FOREIGN KEY (`idThnAjaran`) REFERENCES `tahun_ajaran` (`idThnAjaran`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kehadiran`
--
ALTER TABLE `kehadiran`
  ADD CONSTRAINT `fk_kehadiran_jadwal` FOREIGN KEY (`idJadwal`) REFERENCES `jadwal` (`idJadwal`) ON UPDATE CASCADE;

--
-- Constraints for table `kehadiran_d`
--
ALTER TABLE `kehadiran_d`
  ADD CONSTRAINT `fk_kehadiran_d_kehadiran` FOREIGN KEY (`idKehadiran`) REFERENCES `kehadiran` (`idKehadiran`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_kehadiran_d_siswa` FOREIGN KEY (`NIS`) REFERENCES `siswa` (`NIS`) ON UPDATE CASCADE;

--
-- Constraints for table `mappingkelas_d`
--
ALTER TABLE `mappingkelas_d`
  ADD CONSTRAINT `fk_mappingkelas_d_mappingkelas` FOREIGN KEY (`idMapping`) REFERENCES `mapping_kelas` (`idMapping`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_mappingkelas_d_siswa` FOREIGN KEY (`NIS`) REFERENCES `siswa` (`NIS`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mapping_kelas`
--
ALTER TABLE `mapping_kelas`
  ADD CONSTRAINT `fk_mappingkelas_guru` FOREIGN KEY (`NIP`) REFERENCES `guru` (`NIP`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_mappingkelas_kelas` FOREIGN KEY (`idKelas`) REFERENCES `kelas` (`idKelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_mappingkelas_tahunajaran` FOREIGN KEY (`idThnAjaran`) REFERENCES `tahun_ajaran` (`idThnAjaran`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `materi`
--
ALTER TABLE `materi`
  ADD CONSTRAINT `fk_materi_pelajaran` FOREIGN KEY (`idPelajaran`) REFERENCES `pelajaran` (`idPelajaran`) ON UPDATE CASCADE;

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `fk_nilai_guru` FOREIGN KEY (`NIP`) REFERENCES `guru` (`NIP`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_nilai_kelas` FOREIGN KEY (`idKelas`) REFERENCES `kelas` (`idKelas`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_nilai_materi` FOREIGN KEY (`idMateri`) REFERENCES `materi` (`idMateri`) ON UPDATE CASCADE;

--
-- Constraints for table `nilai_d`
--
ALTER TABLE `nilai_d`
  ADD CONSTRAINT `fk_nilai_d_nilai` FOREIGN KEY (`idNilai`) REFERENCES `nilai` (`idNilai`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_nilai_d_siswa` FOREIGN KEY (`NIS`) REFERENCES `siswa` (`NIS`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for siakad_db
DROP DATABASE IF EXISTS `siakad_db`;
CREATE DATABASE IF NOT EXISTS `siakad_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `siakad_db`;

-- Dumping structure for table siakad_db.dosen
DROP TABLE IF EXISTS `dosen`;
CREATE TABLE IF NOT EXISTS `dosen` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `nip` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `departemen` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dosen_user_id_foreign` (`user_id`),
  KEY `nip` (`nip`),
  CONSTRAINT `dosen_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table siakad_db.dosen: ~2 rows (approximately)
DELETE FROM `dosen`;
INSERT INTO `dosen` (`id`, `user_id`, `nip`, `nama`, `departemen`, `created_at`, `updated_at`) VALUES
	(3, 4, '10019', 'siska', 'Informatika', '2025-01-03 08:15:32', '2025-01-13 00:24:29'),
	(5, 6, '1009', 'Tubagus', 'Fakultas Kedokteran', '2025-01-06 06:06:51', '2025-01-06 06:06:51');

-- Dumping structure for table siakad_db.jadwal_perkuliahan
DROP TABLE IF EXISTS `jadwal_perkuliahan`;
CREATE TABLE IF NOT EXISTS `jadwal_perkuliahan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `mata_kuliah_id` int NOT NULL,
  `dosen_id` int NOT NULL,
  `hari` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `ruangan` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `semester` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mata_kuliah_id` (`mata_kuliah_id`),
  KEY `dosen_id` (`dosen_id`),
  CONSTRAINT `FK_jadwal_perkuliahan_mata_kuliah` FOREIGN KEY (`mata_kuliah_id`) REFERENCES `mata_kuliah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table siakad_db.jadwal_perkuliahan: ~1 rows (approximately)
DELETE FROM `jadwal_perkuliahan`;
INSERT INTO `jadwal_perkuliahan` (`id`, `mata_kuliah_id`, `dosen_id`, `hari`, `jam_mulai`, `jam_selesai`, `ruangan`, `created_at`, `updated_at`, `semester`) VALUES
	(15, 17, 3, 'Senin', '07:30:00', '08:30:00', 'Private', '2025-01-13 08:32:51', '2025-01-13 08:32:51', '3'),
	(16, 18, 3, 'Selasa', '16:00:00', '17:00:00', 'Private', '2025-01-13 09:10:55', '2025-01-13 09:10:55', '6');

-- Dumping structure for table siakad_db.khs
DROP TABLE IF EXISTS `khs`;
CREATE TABLE IF NOT EXISTS `khs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `mahasiswa_id` int NOT NULL,
  `mata_kuliah_id` int NOT NULL,
  `nilai` decimal(5,2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_khs_mahasiswa` (`mahasiswa_id`),
  KEY `FK_khs_mata_kuliah` (`mata_kuliah_id`),
  CONSTRAINT `FK_khs_mahasiswa` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_khs_mata_kuliah` FOREIGN KEY (`mata_kuliah_id`) REFERENCES `mata_kuliah` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table siakad_db.khs: ~0 rows (approximately)
DELETE FROM `khs`;

-- Dumping structure for table siakad_db.krs
DROP TABLE IF EXISTS `krs`;
CREATE TABLE IF NOT EXISTS `krs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `mahasiswa_id` int NOT NULL,
  `mata_kuliah_id` int NOT NULL,
  `semester` int NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `jadwal_id` int DEFAULT NULL,
  `nilai` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mahasiswa_id` (`mahasiswa_id`),
  KEY `mata_kuliah_id` (`mata_kuliah_id`),
  CONSTRAINT `FK_krs_mahasiswa` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table siakad_db.krs: ~1 rows (approximately)
DELETE FROM `krs`;
INSERT INTO `krs` (`id`, `mahasiswa_id`, `mata_kuliah_id`, `semester`, `created_at`, `updated_at`, `jadwal_id`, `nilai`) VALUES
	(6, 17, 17, 1, '2025-01-13 09:10:14', '2025-01-13 09:10:14', 15, NULL);

-- Dumping structure for table siakad_db.mahasiswa
DROP TABLE IF EXISTS `mahasiswa`;
CREATE TABLE IF NOT EXISTS `mahasiswa` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `nim` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `jurusan` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `angkatan` year NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mahasiswa_user_id_foreign` (`user_id`),
  CONSTRAINT `mahasiswa_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table siakad_db.mahasiswa: ~1 rows (approximately)
DELETE FROM `mahasiswa`;
INSERT INTO `mahasiswa` (`id`, `user_id`, `nim`, `nama`, `jurusan`, `angkatan`, `created_at`, `updated_at`) VALUES
	(17, 18, '112220099', 'almaida', 'Informatikaa', '2021', '2025-01-13 00:23:41', '2025-01-13 00:24:02');

-- Dumping structure for table siakad_db.mata_kuliah
DROP TABLE IF EXISTS `mata_kuliah`;
CREATE TABLE IF NOT EXISTS `mata_kuliah` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dosen_id` int DEFAULT NULL,
  `kode_mk` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_mk` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `sks` int NOT NULL,
  `semester` int NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kode_mk` (`kode_mk`),
  KEY `nama_mk` (`nama_mk`),
  KEY `FK_mata_kuliah_dosen` (`dosen_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table siakad_db.mata_kuliah: ~3 rows (approximately)
DELETE FROM `mata_kuliah`;
INSERT INTO `mata_kuliah` (`id`, `dosen_id`, `kode_mk`, `nama_mk`, `sks`, `semester`, `created_at`, `updated_at`) VALUES
	(17, 4, 'A01', 'Pemograman', 3, 1, '2025-01-08 06:10:54', '2025-01-08 06:10:54'),
	(18, 6, 'A03', 'Python', 2, 3, '2025-01-09 01:50:27', '2025-01-09 01:50:27'),
	(19, 6, 'ABC1', 'Data Mining', 3, 1, '2025-01-13 00:43:26', '2025-01-13 00:43:26');

-- Dumping structure for table siakad_db.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table siakad_db.migrations: ~13 rows (approximately)
DELETE FROM `migrations`;
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
	(1, '2025-01-02-175651', 'App\\Database\\Migrations\\CreateTables', 'default', 'App', 1735864229, 1),
	(2, '2025-01-02-184938', 'App\\Database\\Migrations\\CreateTableNilai', 'default', 'App', 1735864229, 1),
	(3, '2025-01-03-005226', 'App\\Database\\Migrations\\AddDosenIdToUsersTable', 'default', 'App', 1735866265, 2),
	(4, '2025-01-03-010344', 'App\\Database\\Migrations\\CreateJadwalPerkuliahanTable', 'default', 'App', 1735866305, 3),
	(5, '2025-01-03-011202', 'App\\Database\\Migrations\\CreateKrsTable', 'default', 'App', 1735866775, 4),
	(6, '2025-01-03-011758', 'App\\Database\\Migrations\\AddJadwalIdToKrsTable', 'default', 'App', 1735867111, 5),
	(7, '2025-01-03-012546', 'App\\Database\\Migrations\\CreateNilaiMahasiswaTable', 'default', 'App', 1735867615, 6),
	(8, '2025-01-06-013129', 'App\\Database\\Migrations\\AddDosenIdToMataKuliah', 'default', 'App', 1736127139, 7),
	(9, '2025-01-06-041329', 'App\\Database\\Migrations\\AddNilaiToKrs', 'default', 'App', 1736136829, 8),
	(10, '2025-01-06-043504', 'App\\Database\\Migrations\\AddNilaiToKrs', 'default', 'App', 1736138135, 9),
	(11, '2025-01-07-011248', 'App\\Database\\Migrations\\AddNilaiToKrs', 'default', 'App', 1736212463, 10),
	(12, '2025-01-07-020540', 'App\\Database\\Migrations\\AddKHStable', 'default', 'App', 1736215922, 11),
	(13, '2025-01-09-013146', 'App\\Database\\Migrations\\AddSemestertoJadwalPerkuliahan', 'default', 'App', 1736386491, 12);

-- Dumping structure for table siakad_db.nilai
DROP TABLE IF EXISTS `nilai`;
CREATE TABLE IF NOT EXISTS `nilai` (
  `id` int NOT NULL AUTO_INCREMENT,
  `mahasiswa_id` int NOT NULL,
  `mata_kuliah_id` int NOT NULL,
  `dosen_id` int NOT NULL,
  `nilai` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_nilai_krs_2` (`mata_kuliah_id`),
  KEY `FK_nilai_krs` (`mahasiswa_id`),
  KEY `FK_nilai_dosen` (`dosen_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table siakad_db.nilai: ~0 rows (approximately)
DELETE FROM `nilai`;

-- Dumping structure for table siakad_db.nilai_mahasiswa
DROP TABLE IF EXISTS `nilai_mahasiswa`;
CREATE TABLE IF NOT EXISTS `nilai_mahasiswa` (
  `id` int NOT NULL AUTO_INCREMENT,
  `mahasiswa_id` int NOT NULL,
  `mata_kuliah_id` int NOT NULL,
  `semester` int NOT NULL,
  `nilai` decimal(5,2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mahasiswa_id` (`mahasiswa_id`),
  KEY `mata_kuliah_id` (`mata_kuliah_id`),
  CONSTRAINT `FK_nilai_mahasiswa_mahasiswa` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_nilai_mahasiswa_mata_kuliah` FOREIGN KEY (`mata_kuliah_id`) REFERENCES `mata_kuliah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table siakad_db.nilai_mahasiswa: ~0 rows (approximately)
DELETE FROM `nilai_mahasiswa`;

-- Dumping structure for table siakad_db.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('admin','dosen','mahasiswa') COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table siakad_db.users: ~11 rows (approximately)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'Admin123', 'admin', '2025-01-03 07:31:12', '2025-01-03 07:31:14'),
	(2, 'alma', '$2y$10$IA1ctvIkEdqHO8aD1SWrOOnlXP638dg58uhGmNxvrfhGPifi6tvRa', 'mahasiswa', '2025-01-03 07:46:28', '2025-01-03 07:46:29'),
	(4, '10019', '$2y$10$IA1ctvIkEdqHO8aD1SWrOOnlXP638dg58uhGmNxvrfhGPifi6tvRa', 'dosen', '2025-01-03 08:15:32', '2025-01-03 08:15:32'),
	(5, 'admin1', '$2y$10$Tsbyww2.udzGllwyEGIHJOAcE59DFoSTEYaJTNTC3j/rvmt0j/qlu', 'admin', '2025-01-06 06:04:16', '2025-01-06 06:04:16'),
	(6, '1009', '$2y$10$gVLj8sUdXSC2d5v28vjhAunztLJkk4OfscE7OwJYcpWV8e.Vcml5.', 'dosen', '2025-01-06 06:06:51', '2025-01-06 06:06:51'),
	(7, '0019', '$2y$10$NCsYqeYgX0f90sYM2ZXtueY4RD8VZrgXD3WR9kHPBBuXPRVT3iTkG', 'dosen', '2025-01-06 06:50:12', '2025-01-06 06:50:12'),
	(8, '21425', '$2y$10$PhV2re80z3hqz1MYXYa7RuiQ8ZjfK2u0Ai6MASORqZM0CvLYsclaS', 'dosen', '2025-01-06 08:49:09', '2025-01-06 08:49:09'),
	(10, '33211', '$2y$10$2QGzaABNolW6tsmtojAtt.a2nfmdJa5Lgw51C3eYGpI4RjP1SnO52', 'mahasiswa', '2025-01-08 02:52:25', '2025-01-08 02:52:25'),
	(11, '113568', '$2y$10$V3tb.OBEhSO0he1hgUXyq.SiCjz93cUvX8FPnEq2OcQ.moPpA8U6e', 'dosen', '2025-01-08 02:58:13', '2025-01-08 02:58:13'),
	(15, '11222009', '$2y$10$oTSMsGTWwM/QtRSyx8Z.HueTL/bnvAVzGEergtzjQE/bk.9Ml/ln.', 'mahasiswa', '2025-01-09 08:01:08', '2025-01-09 08:01:08'),
	(18, '112220099', '$2y$10$qbSl9wsukLmgkQN8adCUwOvMxLSB5WDi9ebRqoNeuA.vtnFCr/n8q', 'mahasiswa', '2025-01-13 00:23:41', '2025-01-13 00:23:41');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

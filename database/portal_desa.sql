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

-- Dumping structure for table agenda
DROP TABLE IF EXISTS `agenda`;
CREATE TABLE IF NOT EXISTS `agenda` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `jam` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table agenda: ~0 rows (approximately)
DELETE FROM `agenda`;

-- Dumping structure for table anggota_kkn
DROP TABLE IF EXISTS `anggota_kkn`;
CREATE TABLE IF NOT EXISTS `anggota_kkn` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prodi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fakultas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `posisi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` text COLLATE utf8mb4_unicode_ci,
  `nim` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table anggota_kkn: ~1 rows (approximately)
DELETE FROM `anggota_kkn`;

-- Dumping structure for table aspirasi
DROP TABLE IF EXISTS `aspirasi`;
CREATE TABLE IF NOT EXISTS `aspirasi` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pesan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'diterima',
  `balasan` text COLLATE utf8mb4_unicode_ci,
  `anonim` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table aspirasi: ~0 rows (approximately)
DELETE FROM `aspirasi`;

-- Dumping structure for table bank_sampah_nasabah
DROP TABLE IF EXISTS `bank_sampah_nasabah`;
CREATE TABLE IF NOT EXISTS `bank_sampah_nasabah` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `poin` int NOT NULL DEFAULT '0',
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bank_sampah_nasabah: ~3 rows (approximately)
DELETE FROM `bank_sampah_nasabah`;
INSERT INTO `bank_sampah_nasabah` (`id`, `nama`, `nik`, `alamat`, `no_hp`, `poin`, `aktif`, `created_at`, `updated_at`) VALUES
	(1, 'Bu Sari', '1234567890', 'Dusun I', '081111111111', 2400, 1, '2026-06-23 03:42:28', '2026-06-23 03:42:28'),
	(2, 'Pak Hendra', '1234567891', 'Dusun II', '081111111112', 1950, 1, '2026-06-23 03:42:28', '2026-06-23 03:42:28'),
	(3, 'Bu Dewi', '1234567892', 'Dusun I', '081111111113', 1800, 1, '2026-06-23 03:42:28', '2026-06-23 03:42:28');

-- Dumping structure for table berita
DROP TABLE IF EXISTS `berita`;
CREATE TABLE IF NOT EXISTS `berita` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `penulis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` text COLLATE utf8mb4_unicode_ci,
  `ringkasan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `konten` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `views` int NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table berita: ~1 rows (approximately)
DELETE FROM `berita`;
INSERT INTO `berita` (`id`, `judul`, `kategori`, `tanggal`, `penulis`, `foto`, `ringkasan`, `konten`, `views`, `published`, `created_at`, `updated_at`) VALUES
	(2, 'Tim KKN Periode 108 Kelompok 146 Resmi Bertugas', 'KKN', '2025-06-17', 'Tim KKN', 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=600', 'Mahasiswa KKN Universitas Bengkulu Periode 108 Kelompok 146 resmi memulai pengabdian mereka di Desa Talang Marap.', 'Sebanyak 10 mahasiswa dari berbagai fakultas di Universitas Bengkulu siap mengabdi dan berkontribusi dalam pembangunan Desa Talang Marap selama 40 hari ke depan.', 412, 1, '2026-06-23 03:42:27', '2026-06-28 00:43:25');

-- Dumping structure for table data_sampah
DROP TABLE IF EXISTS `data_sampah`;
CREATE TABLE IF NOT EXISTS `data_sampah` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `bulan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` int NOT NULL DEFAULT '0',
  `organik` int NOT NULL DEFAULT '0',
  `anorganik` int NOT NULL DEFAULT '0',
  `b3` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table data_sampah: ~3 rows (approximately)
DELETE FROM `data_sampah`;
INSERT INTO `data_sampah` (`id`, `bulan`, `total`, `organik`, `anorganik`, `b3`, `created_at`, `updated_at`) VALUES
	(1, '2025-06', 2840, 1704, 994, 142, '2026-06-23 03:42:28', '2026-06-23 03:42:28'),
	(2, '2025-05', 2680, 1608, 938, 134, '2026-06-23 03:42:28', '2026-06-23 03:42:28'),
	(3, '2025-04', 2520, 1512, 882, 126, '2026-06-23 03:42:28', '2026-06-23 03:42:28');

-- Dumping structure for table dokumen
DROP TABLE IF EXISTS `dokumen`;
CREATE TABLE IF NOT EXISTS `dokumen` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date DEFAULT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipe` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dokumen: ~4 rows (approximately)
DELETE FROM `dokumen`;
INSERT INTO `dokumen` (`id`, `nama`, `kategori`, `tanggal`, `ukuran`, `tipe`, `url`, `created_at`, `updated_at`) VALUES
	(1, 'RPJMDes 2020-2025', 'Perencanaan', '2020-01-15', '2.4 MB', 'PDF', NULL, '2026-06-23 03:42:28', '2026-06-23 03:42:28'),
	(2, 'APBDes 2025', 'Keuangan', '2025-01-10', '1.8 MB', 'PDF', NULL, '2026-06-23 03:42:28', '2026-06-23 03:42:28'),
	(3, 'Monografi Desa 2024', 'Profil', '2024-12-31', '3.2 MB', 'PDF', NULL, '2026-06-23 03:42:28', '2026-06-23 03:42:28'),
	(4, 'Peraturan Desa No.1/2025', 'Peraturan', '2025-03-01', '0.8 MB', 'PDF', NULL, '2026-06-23 03:42:28', '2026-06-23 03:42:28');

-- Dumping structure for table galeri
DROP TABLE IF EXISTS `galeri`;
CREATE TABLE IF NOT EXISTS `galeri` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table galeri: ~0 rows (approximately)
DELETE FROM `galeri`;

-- Dumping structure for table laporan_sampah
DROP TABLE IF EXISTS `laporan_sampah`;
CREATE TABLE IF NOT EXISTS `laporan_sampah` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'diterima',
  `catatan_admin` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laporan_sampah: ~0 rows (approximately)
DELETE FROM `laporan_sampah`;

-- Dumping structure for table migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table migrations: ~4 rows (approximately)
DELETE FROM `migrations`;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(2, '2024_01_01_000001_create_all_tables', 1),
	(3, '2024_01_02_000001_create_peta_rumah_table', 2),
	(4, '2026_06_27_000001_add_role_to_users_table', 3),
	(5, '2026_06_27_000002_add_email_verification_to_users_table', 4);

-- Dumping structure for table pengaturan
DROP TABLE IF EXISTS `pengaturan`;
CREATE TABLE IF NOT EXISTS `pengaturan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pengaturan_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pengaturan: ~20 rows (approximately)
DELETE FROM `pengaturan`;
INSERT INTO `pengaturan` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
	(1, 'nama_desa', 'Desa Talang Marap', '2026-06-23 03:42:26', '2026-06-23 03:42:26'),
	(2, 'kecamatan', 'Kecamatan Kelam Tengah', '2026-06-23 03:42:26', '2026-06-23 03:42:26'),
	(3, 'kabupaten', 'Kabupaten Kaur', '2026-06-23 03:42:26', '2026-06-23 03:42:26'),
	(4, 'provinsi', 'Provinsi Bengkulu', '2026-06-23 03:42:26', '2026-06-23 03:42:26'),
	(5, 'tagline', 'Mengenal Desa, Mengelola Data, Membangun Masa Depan', '2026-06-23 03:42:26', '2026-06-23 03:42:26'),
	(6, 'kepala_desa', 'Bapak Sumarno', '2026-06-23 03:42:26', '2026-06-23 03:42:26'),
	(7, 'whatsapp', '6281234567890', '2026-06-23 03:42:26', '2026-06-23 03:42:26'),
	(8, 'email', 'desatalangmarap@gmail.com', '2026-06-23 03:42:26', '2026-06-23 03:42:26'),
	(9, 'alamat', 'Jl. Raya Talang Marap No. 1, Kec. Kelam Tengah, Kab. Kaur', '2026-06-23 03:42:26', '2026-06-23 03:42:26'),
	(10, 'jam_operasional', 'Senin - Jumat: 08.00 - 16.00 WIB', '2026-06-23 03:42:27', '2026-06-23 03:42:27'),
	(11, 'instagram', 'desatalangmarap', '2026-06-23 03:42:27', '2026-06-23 03:42:27'),
	(12, 'facebook', 'Desa Talang Marap', '2026-06-23 03:42:27', '2026-06-23 03:42:27'),
	(13, 'tiktok', '@desatalangmarap', '2026-06-23 03:42:27', '2026-06-23 03:42:27'),
	(14, 'youtube', 'Smart Village Talang Marap', '2026-06-23 03:42:27', '2026-06-23 03:42:27'),
	(15, 'jumlah_penduduk', '660', '2026-06-23 03:42:27', '2026-06-23 04:20:36'),
	(16, 'jumlah_kk', '164', '2026-06-23 03:42:27', '2026-06-23 04:20:36'),
	(17, 'luas_wilayah', '24.5 km²', '2026-06-23 03:42:27', '2026-06-23 03:42:27'),
	(18, 'jumlah_dusun', '4', '2026-06-23 03:42:27', '2026-06-23 03:42:27'),
	(19, 'maps_desa', 'https://www.google.com/maps?q=-4.35,103.12', '2026-06-23 03:42:27', '2026-06-23 03:42:27'),
	(20, 'koordinat_desa', '-4.35, 103.12', '2026-06-23 03:42:27', '2026-06-23 03:42:27');

-- Dumping structure for table perangkat_desa
DROP TABLE IF EXISTS `perangkat_desa`;
CREATE TABLE IF NOT EXISTS `perangkat_desa` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` text COLLATE utf8mb4_unicode_ci,
  `kontak` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `urutan` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table perangkat_desa: ~1 rows (approximately)
DELETE FROM `perangkat_desa`;

-- Dumping structure for table personal_access_tokens
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table personal_access_tokens: ~0 rows (approximately)
DELETE FROM `personal_access_tokens`;

-- Dumping structure for table pesan_kontak
DROP TABLE IF EXISTS `pesan_kontak`;
CREATE TABLE IF NOT EXISTS `pesan_kontak` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subjek` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pesan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sudah_dibaca` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pesan_kontak: ~0 rows (approximately)
DELETE FROM `pesan_kontak`;

-- Dumping structure for table peta_rumah
DROP TABLE IF EXISTS `peta_rumah`;
CREATE TABLE IF NOT EXISTS `peta_rumah` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `no_rumah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_kk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rw` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dusun` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lat` decimal(10,7) NOT NULL,
  `lng` decimal(10,7) NOT NULL,
  `jumlah_jiwa` int NOT NULL DEFAULT '1',
  `status_rumah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'tetap',
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table peta_rumah: ~0 rows (approximately)
DELETE FROM `peta_rumah`;

-- Dumping structure for table program_kerja
DROP TABLE IF EXISTS `program_kerja`;
CREATE TABLE IF NOT EXISTS `program_kerja` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'planned',
  `progress` int NOT NULL DEFAULT '0',
  `target` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `output` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `pic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table program_kerja: ~0 rows (approximately)
DELETE FROM `program_kerja`;

-- Dumping structure for table statistik_desa
DROP TABLE IF EXISTS `statistik_desa`;
CREATE TABLE IF NOT EXISTS `statistik_desa` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tahun` int NOT NULL,
  `penduduk` int NOT NULL DEFAULT '0',
  `kk` int NOT NULL DEFAULT '0',
  `laki_laki` int NOT NULL DEFAULT '0',
  `perempuan` int NOT NULL DEFAULT '0',
  `umkm` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table statistik_desa: ~0 rows (approximately)
DELETE FROM `statistik_desa`;

-- Dumping structure for table umkm
DROP TABLE IF EXISTS `umkm`;
CREATE TABLE IF NOT EXISTS `umkm` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` text COLLATE utf8mb4_unicode_ci,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kontak` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pemilik` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stok` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table umkm: ~0 rows (approximately)
DELETE FROM `umkm`;

-- Dumping structure for table users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'editor',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table users: ~1 rows (approximately)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Admin Desa', 'admin@desatalangmarap.id', '2026-06-28 00:41:37', '$2y$12$Ch50wC5uDxBJLzf.oTlQZePFGDuVQUwIwUVRzkVfTN/8LSs524B5y', 'admin', NULL, '2026-06-23 03:42:26', '2026-06-23 03:42:26');

-- Dumping structure for table wisata
DROP TABLE IF EXISTS `wisata`;
CREATE TABLE IF NOT EXISTS `wisata` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` text COLLATE utf8mb4_unicode_ci,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `fasilitas` json DEFAULT NULL,
  `harga` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jam_operasional` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `maps` text COLLATE utf8mb4_unicode_ci,
  `rating` decimal(3,1) NOT NULL DEFAULT '0.0',
  `pengunjung` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table wisata: ~0 rows (approximately)
DELETE FROM `wisata`;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

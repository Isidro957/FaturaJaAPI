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


-- Dumping database structure for native_startkitdb
CREATE DATABASE IF NOT EXISTS `native_startkitdb` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `native_startkitdb`;

-- Dumping structure for table native_startkitdb.areas
CREATE TABLE IF NOT EXISTS `areas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `org_id` bigint unsigned NOT NULL,
  `name_area` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slogan_area` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefone_area` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_area` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descricao_area` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `areas_email_area_unique` (`email_area`),
  KEY `areas_org_id_foreign` (`org_id`),
  CONSTRAINT `areas_org_id_foreign` FOREIGN KEY (`org_id`) REFERENCES `organizacoes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table native_startkitdb.areas: ~0 rows (approximately)
INSERT INTO `areas` (`id`, `org_id`, `name_area`, `slogan_area`, `telefone_area`, `email_area`, `descricao_area`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Informática', 'TIC', '927800505', 'informatica@gmail.com', 'TICs', '2025-04-16 21:42:21', '2025-04-16 21:42:22');

-- Dumping structure for table native_startkitdb.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table native_startkitdb.cache: ~0 rows (approximately)

-- Dumping structure for table native_startkitdb.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table native_startkitdb.cache_locks: ~0 rows (approximately)

-- Dumping structure for table native_startkitdb.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table native_startkitdb.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table native_startkitdb.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table native_startkitdb.jobs: ~0 rows (approximately)

-- Dumping structure for table native_startkitdb.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table native_startkitdb.job_batches: ~0 rows (approximately)

-- Dumping structure for table native_startkitdb.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table native_startkitdb.migrations: ~7 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000001_create_cache_table', 1),
	(2, '0001_01_01_000002_create_jobs_table', 1),
	(3, '2025_04_16_155514_create_roles_table', 1),
	(4, '2025_04_16_162905_create_organizacoes_table', 1),
	(5, '2025_04_16_163630_create_areas_table', 1),
	(6, '0001_01_01_000000_create_users_table', 2),
	(7, '2025_04_16_155642_create_role__users_table', 3);

-- Dumping structure for table native_startkitdb.organizacoes
CREATE TABLE IF NOT EXISTS `organizacoes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name_org` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nif_org` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo_org` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefone_org` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_org` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provincia_org` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `regime_org` varchar(2048) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descricao_org` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `organizacoes_nif_org_unique` (`nif_org`),
  UNIQUE KEY `organizacoes_telefone_org_unique` (`telefone_org`),
  UNIQUE KEY `organizacoes_email_org_unique` (`email_org`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table native_startkitdb.organizacoes: ~2 rows (approximately)
INSERT INTO `organizacoes` (`id`, `name_org`, `nif_org`, `logo_org`, `telefone_org`, `email_org`, `provincia_org`, `regime_org`, `descricao_org`, `created_at`, `updated_at`) VALUES
	(1, 'SDOCA LDA', '5001160419', '5001160419', '923678529', 'sistema.sdoc167@gmail.com', 'Luanda', 'Privada', 'Gestão Documental', '2025-04-16 21:25:52', '2025-04-16 21:25:53'),
	(7, 'Sdoca', '927800505', 'userpadrao.png', '927800505', 'sdoca@gmail.com', 'Luanda', 'Regime Especial', 'Sdoca', '2025-04-21 20:47:27', '2025-04-21 20:47:27'),
	(9, 'Sdoca, LDA', '244927800505', 'img/users/S37KK.LL@3x.png', '244927800505', 'sdoca244@gmail.com', 'Luanda', 'Regime Simplificado', 'as', '2025-04-23 13:43:09', '2025-04-23 13:43:09');

-- Dumping structure for table native_startkitdb.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table native_startkitdb.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table native_startkitdb.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permission` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table native_startkitdb.roles: ~8 rows (approximately)
INSERT INTO `roles` (`id`, `name`, `slug`, `permission`, `created_at`, `updated_at`) VALUES
	(1, 'Super Admin', 'SADM', '{"super-admin-post":true,"admin-post":true,"supervi-post":true,"estagiario-post":true,"user-post":true,"create-post":true,"gci-post":true,"rh-post":true,"gti-post":true,"online-post":true,"publish-post":true}', '2025-04-16 20:28:37', '2025-04-16 20:28:37'),
	(2, 'Admin', 'ADM', '{"admin-post":true,"supervi-post":true,"estagiario-post":true,"user-post":true,"create-post":true,"gci-post":true,"rh-post":true,"gti-post":true,"online-post":true,"publish-post":true}', '2025-04-16 20:28:37', '2025-04-16 20:28:37'),
	(3, 'Supervisor', 'supervisor', '{"supervi-post":true,"estagiario-post":true,"user-post":true,"create-post":true,"online-post":true,"publish-post":true}', '2025-04-16 20:28:37', '2025-04-16 20:28:37'),
	(4, 'Estagiário', 'estagiario', '{"estagiario-post":true,"user-post":true,"create-post":true,"online-post":true,"publish-post":true}', '2025-04-16 20:28:37', '2025-04-16 20:28:37'),
	(5, 'User', 'user', '{"user-post":true,"create-post":true,"online-post":true,"publish-post":true}', '2025-04-16 20:28:37', '2025-04-16 20:28:37'),
	(6, 'GTI', 'gti', '{"create-post":true,"gti-post":true,"publish-post":true,"online-post":true}', '2025-04-16 20:28:37', '2025-04-16 20:28:37'),
	(7, 'GCI', 'gci', '{"create-post":true,"gci-post":true,"publish-post":true,"online-post":true}', '2025-04-16 20:28:37', '2025-04-16 20:28:37'),
	(8, 'RH', 'rh', '{"create-post":true,"rh-post":true,"publish-post":true,"online-post":true}', '2025-04-16 20:28:37', '2025-04-16 20:28:37');

-- Dumping structure for table native_startkitdb.role__users
CREATE TABLE IF NOT EXISTS `role__users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `role__users_user_id_role_id_unique` (`user_id`,`role_id`),
  KEY `role__users_role_id_foreign` (`role_id`),
  CONSTRAINT `role__users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  CONSTRAINT `role__users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table native_startkitdb.role__users: ~2 rows (approximately)
INSERT INTO `role__users` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, NULL, NULL),
	(3, 3, 2, '2025-04-21 20:47:27', '2025-04-21 20:47:27'),
	(4, 4, 2, '2025-04-23 13:43:10', '2025-04-23 13:43:10');

-- Dumping structure for table native_startkitdb.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table native_startkitdb.sessions: ~1 rows (approximately)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('Yr61h36FnJ2m5GYdajmtXUI0aQFNQ1wyp9WqXxWt', 3, '192.168.1.88', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36 Edg/135.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiRUh0ZlVjMThTa0I2RzZuaEFOODNaVXF1NVdEME5CTkgwTkRuaG1rQSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xOTIuMTY4LjEuODg6MjAyNS9vcmdhbml6YXRpb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO3M6NDoiYXV0aCI7YToxOntzOjIxOiJwYXNzd29yZF9jb25maXJtZWRfYXQiO2k6MTc0NTQxNDA1NDt9fQ==', 1745420443);

-- Dumping structure for table native_startkitdb.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id_area` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `condicao_user` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_user_id_area_foreign` (`user_id_area`),
  CONSTRAINT `users_user_id_area_foreign` FOREIGN KEY (`user_id_area`) REFERENCES `areas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table native_startkitdb.users: ~3 rows (approximately)
INSERT INTO `users` (`id`, `user_id_area`, `name`, `profile_photo_path`, `email`, `email_verified_at`, `password`, `condicao_user`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Marcial Mbango', NULL, 'marcialmbango@gmail.com', NULL, '$2y$12$IRX2ZhUxoj453jpFli13EOpg98Odk3HKQBp1Fak5hXKrPYy1NMRtC', NULL, NULL, '2025-04-16 20:43:09', '2025-04-16 20:43:09'),
	(3, 1, 'Informática', 'userpadrao.png', 'sdoca@gmail.com', NULL, '$2y$12$sXDvVVOnRaDw0K7Q6PgMe.LgK27wMjPZWbfNMHvdWC8bXAhaxAsJi', 'Activo', NULL, '2025-04-21 20:47:27', '2025-04-21 20:47:27'),
	(4, 1, 'Informática', 'img/users/S37KK.LL@3x.png', 'sdoca244@gmail.com', NULL, '$2y$12$EdMFv2HSupbruzRKtR3rqO9A0UBBavjEP2qMKK7nfOUqc9F03Z2M.', 'Activo', NULL, '2025-04-23 13:43:10', '2025-04-23 13:43:10');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

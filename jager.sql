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


-- Dumping database structure for jager-bakery
CREATE DATABASE IF NOT EXISTS `jager-bakery` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `jager-bakery`;

-- Dumping structure for table jager-bakery.carts
CREATE TABLE IF NOT EXISTS `carts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `frontend_user_id` bigint unsigned DEFAULT NULL,
  `product_id` bigint unsigned NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `carts_frontend_user_id_foreign` (`frontend_user_id`),
  KEY `carts_product_id_foreign` (`product_id`),
  CONSTRAINT `carts_frontend_user_id_foreign` FOREIGN KEY (`frontend_user_id`) REFERENCES `frontend_users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jager-bakery.carts: ~0 rows (approximately)

-- Dumping structure for table jager-bakery.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ket` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jager-bakery.categories: ~4 rows (approximately)
INSERT INTO `categories` (`id`, `nama_kategori`, `gambar`, `ket`, `created_at`, `updated_at`) VALUES
	(26, 'Roti', '1720003382.jpg', 'Beragam roti berkualitas tinggi dengan tekstur lembut dan rasa lezat.', '2024-07-03 03:43:02', '2024-07-04 21:06:47'),
	(27, 'Kue Tradisional', '1720003402.jpg', 'Nikmati kue tradisional dengan resep autentik dari berbagai daerah.', '2024-07-03 03:43:22', '2024-07-03 03:43:22'),
	(28, 'Pudding', '1720003423.jpg', 'Aneka pudding lembut dan creamy dengan rasa yang kaya.', '2024-07-03 03:43:43', '2024-07-03 03:43:43'),
	(33, 'Kukis', '1720168501.jpg', 'Pilihan kukis renyah dan manis, dipanggang dengan bahan terbaik.', '2024-07-04 18:03:49', '2024-07-05 01:35:01');

-- Dumping structure for table jager-bakery.failed_jobs
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

-- Dumping data for table jager-bakery.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table jager-bakery.frontend_users
CREATE TABLE IF NOT EXISTS `frontend_users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_hp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `frontend_users_email_unique` (`email`),
  UNIQUE KEY `frontend_users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jager-bakery.frontend_users: ~5 rows (approximately)
INSERT INTO `frontend_users` (`id`, `email`, `nomor_hp`, `address`, `username`, `password`, `created_at`, `updated_at`) VALUES
	(5, 'test@mail.com', '6281971283123', NULL, 'testtt', '$2y$12$C77fsT6hIh.kuJMZ6gzpfusWcQMUiGEfcS77G6cPZqHzwO1esG0RS', '2024-07-18 23:37:03', '2024-07-18 23:37:03'),
	(6, 'bisa@gmail.com', '081231231313', NULL, 'bisaa', '$2y$12$SMlhu.fDtlQBpCdQ9nmtAu/N2px1TD8cS/pvcFKhYCtKlSN9EfloS', '2024-07-18 23:40:49', '2024-07-18 23:40:49'),
	(7, 'radhita@gmail.com', '08123458767', NULL, 'Radhita', '$2y$12$ytKGeTWxOCgXVP6YUx8eiOQ/4ktCCXsWzQrZqNWFM6R4d8WQEXhxy', '2024-07-19 00:15:59', '2024-07-19 00:15:59'),
	(8, 'login@gmail.com', '0817896611', NULL, 'login', '$2y$12$Q9fdcT9b3j2mZcTz2UhWu.9endu6fbwxNZ7MyJc5PO.W8bErnWDZW', '2024-07-19 01:31:22', '2024-07-19 01:31:22'),
	(9, 'coba1@gmail.com', '628972121772', 'Jl. Yogyakarta', 'Radhitaray1', '$2y$12$DJAZYLz3n9jzQXS9mi1FTuVT5Q6oHeUeN/10r.8jmrMoKQxh/hBiK', '2024-07-19 03:20:27', '2024-07-19 21:14:57'),
	(10, 'siska@gmail.com', '628171626221', NULL, 'Siska', '$2y$12$YVlB3UGMdeTrH389sDoPP.Zhq.IrwyD.3DBiXL6E0/9b524sE1Mja', '2024-07-20 17:53:44', '2024-07-20 17:53:44');

-- Dumping structure for table jager-bakery.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jager-bakery.migrations: ~12 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(6, '2014_10_12_000000_create_users_table', 1),
	(7, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(8, '2019_08_19_000000_create_failed_jobs_table', 1),
	(9, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(10, '2024_07_03_064920_create_categories_table', 1),
	(12, '2024_07_08_044445_create_products_table', 2),
	(13, '2024_07_16_131452_create_frontend_users_table', 3),
	(14, '2024_07_19_112133_create_carts_table', 4),
	(15, '2024_07_20_035609_add_address_to_frontend_users_table', 5),
	(16, '2024_07_20_042234_create_orders_table', 6),
	(17, '2024_07_20_042240_create_order_items_table', 6),
	(18, '2024_07_20_055429_add_status_to_orders_table', 7),
	(19, '2024_07_20_071450_add_payment_status_and_snap_token_to_orders_table', 8),
	(20, '2024_07_20_095133_update_payment_status_in_orders_table', 9),
	(21, '2024_07_21_004733_add_shipping_columns_to_orders_table', 10),
	(22, '2024_07_21_035454_create_testimonials_table', 11);

-- Dumping structure for table jager-bakery.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `frontend_user_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `payment_status` enum('Pending','Unpaid','Paid') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `shipping_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_details` text COLLATE utf8mb4_unicode_ci,
  `snap_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_frontend_user_id_foreign` (`frontend_user_id`),
  CONSTRAINT `orders_frontend_user_id_foreign` FOREIGN KEY (`frontend_user_id`) REFERENCES `frontend_users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jager-bakery.orders: ~6 rows (approximately)
INSERT INTO `orders` (`id`, `frontend_user_id`, `name`, `phone`, `address`, `total`, `created_at`, `updated_at`, `status`, `payment_status`, `shipping_status`, `shipping_details`, `snap_token`) VALUES
	(14, 9, 'Radhitaray1', '628972121772', 'Jl. Yogyakarta1', 8500.00, '2024-07-20 16:45:39', '2024-07-20 16:46:07', 'pending', 'Paid', NULL, NULL, '12cd1ab1-7051-40ef-b858-d44b66d49078'),
	(15, 9, 'Radhitaray1', '628972121772', 'Jl. Yogyakarta', 8500.00, '2024-07-20 16:56:28', '2024-07-20 17:48:57', 'pending', 'Paid', 'Dikirim', 'Fast', 'b428377e-401e-4aeb-9085-33e61dee5363'),
	(16, 10, 'Siska', '628171626221', 'Jl. Condongcatur', 20000.00, '2024-07-20 17:54:38', '2024-07-20 17:54:59', 'pending', 'Paid', NULL, NULL, '84a1f2fe-d5a9-4faf-acb7-c1173b93472c'),
	(17, 10, 'Siska', '628171626221', 'Jl. Gejayan', 12500.00, '2024-07-20 18:12:53', '2024-07-20 18:13:07', 'pending', 'Paid', NULL, NULL, '8cf7fffb-7231-490f-9634-b77c1e613217'),
	(18, 10, 'Siska', '628171626221', 'Jl.MAas', 11500.00, '2024-07-20 18:14:00', '2024-07-20 18:14:14', 'pending', 'Paid', NULL, NULL, '0653dfcd-a60b-4cbb-aadf-e99aa36e01f3'),
	(19, 10, 'Siska', '628171626221', 'asd', 6000.00, '2024-07-20 18:16:40', '2024-07-20 18:19:17', 'pending', 'Paid', 'Belum Dikirim', NULL, '97967740-8aa2-4069-a058-ba3e300db51b');

-- Dumping structure for table jager-bakery.order_items
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_order_id_foreign` (`order_id`),
  KEY `order_items_product_id_foreign` (`product_id`),
  CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jager-bakery.order_items: ~6 rows (approximately)
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
	(14, 14, 8, 1, 8500.00, '2024-07-20 16:45:39', '2024-07-20 16:45:39'),
	(15, 15, 8, 1, 8500.00, '2024-07-20 16:56:28', '2024-07-20 16:56:28'),
	(16, 16, 8, 1, 8500.00, '2024-07-20 17:54:38', '2024-07-20 17:54:38'),
	(17, 16, 7, 1, 11500.00, '2024-07-20 17:54:38', '2024-07-20 17:54:38'),
	(18, 17, 6, 1, 12500.00, '2024-07-20 18:12:53', '2024-07-20 18:12:53'),
	(19, 18, 7, 1, 11500.00, '2024-07-20 18:14:00', '2024-07-20 18:14:00'),
	(20, 19, 9, 1, 6000.00, '2024-07-20 18:16:40', '2024-07-20 18:16:40');

-- Dumping structure for table jager-bakery.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jager-bakery.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table jager-bakery.personal_access_tokens
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

-- Dumping data for table jager-bakery.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table jager-bakery.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int NOT NULL,
  `stok` int NOT NULL,
  `category_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_category_id_foreign` (`category_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jager-bakery.products: ~4 rows (approximately)
INSERT INTO `products` (`id`, `nama_produk`, `deskripsi`, `image`, `harga`, `stok`, `category_id`, `created_at`, `updated_at`) VALUES
	(6, 'Roti Sosis', 'Bread with chicken sausage, mayonnaise, cheese, tomato sauce and parsley on top.', '1720581360.jpg', 12500, 8, 26, '2024-07-09 20:16:00', '2024-07-20 18:13:07'),
	(7, 'Milky Bun', 'Sweet butter bread with cookies topping.', '1720583084.jpg', 11500, 10, 26, '2024-07-09 20:44:44', '2024-07-20 18:14:14'),
	(8, 'Sugar Pillow', 'Sweet buttery bread sprinkled with sugar on top.', '1720583177.jpg', 8500, 15, 26, '2024-07-09 20:46:17', '2024-07-09 20:46:17'),
	(9, 'Bika Ambon Potong', 'Bika Ambon Potong', '1720583832.jpeg', 6000, 4, 27, '2024-07-09 20:57:12', '2024-07-20 18:16:56'),
	(10, 'Pudding Kelengkeng', 'Pudding Kelengkeng yang Lezat dan Bergizi', '1721525268.jpg', 141000, 8, 28, '2024-07-20 18:27:48', '2024-07-20 18:27:48');

-- Dumping structure for table jager-bakery.testimonials
CREATE TABLE IF NOT EXISTS `testimonials` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` int NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jager-bakery.testimonials: ~4 rows (approximately)
INSERT INTO `testimonials` (`id`, `name`, `email`, `image`, `rating`, `message`, `created_at`, `updated_at`) VALUES
	(2, 'Radhita', NULL, 'uploads/testimonials/1721535058.jpg', 5, 'Roti Jager sangat enak sekali', '2024-07-20 21:10:58', '2024-07-20 21:10:58'),
	(3, 'Siska', NULL, 'uploads/testimonials/1721535654.jpg', 5, 'Saya suka sekali dengan croissant di Jager Bakery. Teksturnya sangat renyah di luar dan lembut di dalam. Top!', '2024-07-20 21:20:54', '2024-07-20 21:20:54'),
	(4, 'Rizky', NULL, 'uploads/testimonials/1721535684.jpg', 5, 'Kue-kue dari Jager Bakery selalu jadi favorit keluarga kami. Rasanya autentik dan bahan-bahannya terasa berkualitas tinggi.', '2024-07-20 21:21:24', '2024-07-20 21:21:24'),
	(5, 'Sara', NULL, 'uploads/testimonials/1721535750.jpg', 5, 'Jager Bakery selalu memberikan pelayanan yang ramah dan cepat. Roti-roti yang kami pesan selalu datang tepat waktu dan masih hangat. Terima kasih!', '2024-07-20 21:22:30', '2024-07-20 21:22:30');

-- Dumping structure for table jager-bakery.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table jager-bakery.users: ~0 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(2, 'Admin', 'admin@gmail.com', NULL, '$2y$12$OGdDBXc7zWbc5UfPcSc62upkdonYvtPF3GNgjPyR7FwqIEtk9V.FO', NULL, '2024-07-03 03:59:56', '2024-07-03 03:59:56');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

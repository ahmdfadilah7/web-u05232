-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 25, 2023 at 11:28 PM
-- Server version: 8.0.33-0ubuntu0.22.04.2
-- PHP Version: 8.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web-u05232`
--

-- --------------------------------------------------------

--
-- Table structure for table `alamats`
--

CREATE TABLE `alamats` (
  `id` bigint UNSIGNED NOT NULL,
  `pelanggan_id` bigint UNSIGNED NOT NULL,
  `nama_penerima` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_penerima` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `alamats`
--

INSERT INTO `alamats` (`id`, `pelanggan_id`, `nama_penerima`, `no_penerima`, `alamat`, `created_at`, `updated_at`) VALUES
(5, 4, 'Randy Salim', '08955267188', 'Kp. Jauh Rt 01/02\r\nDesa Terdekat, Kec. Dimana - manaa', '2023-06-04 15:45:19', '2023-06-04 15:45:19'),
(6, 4, 'Randy Salim 2', '08955267188', 'Kp. Terdekat\r\nDesa Terjauh, Kec. Dimana - Mana', '2023-06-04 15:45:48', '2023-06-04 15:45:48'),
(7, 6, 'Rudi', '08955267188', 'Test 1', '2023-06-05 05:22:53', '2023-06-05 05:22:53'),
(8, 6, 'Rudi 2', '08955267188', 'Test 2', '2023-06-05 05:23:07', '2023-06-05 05:23:07');

-- --------------------------------------------------------

--
-- Table structure for table `analisis_alternatifs`
--

CREATE TABLE `analisis_alternatifs` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_alternatif_1` bigint UNSIGNED NOT NULL,
  `kode_alternatif_2` bigint UNSIGNED NOT NULL,
  `kode_kriteria` bigint UNSIGNED NOT NULL,
  `nilai` double NOT NULL,
  `bobot` double DEFAULT NULL,
  `jumlah` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `analisis_alternatifs`
--

INSERT INTO `analisis_alternatifs` (`id`, `kode_alternatif_1`, `kode_alternatif_2`, `kode_kriteria`, `nilai`, `bobot`, `jumlah`, `created_at`, `updated_at`) VALUES
(1, 4, 4, 2, 1, 1.2539682539682, 0.79746835443041, NULL, '2023-06-25 14:36:32'),
(2, 4, 4, 3, 1, 1.3428571428571, 0.74468085106385, NULL, '2023-06-25 12:23:13'),
(3, 4, 4, 4, 1, 1.6428571428571, 0.60869565217393, NULL, '2023-06-25 12:24:12'),
(4, 4, 5, 2, 9, 11.285714285714, 0.7974683544304, NULL, '2023-06-25 14:36:33'),
(5, 5, 4, 2, 0.11111111111111, 1.2539682539682, 0.088607594936712, NULL, '2023-06-25 14:36:33'),
(6, 5, 5, 2, 1, 11.285714285714, 0.088607594936711, NULL, '2023-06-25 14:36:33'),
(7, 4, 5, 3, 7, 9.4, 0.74468085106383, NULL, '2023-06-25 12:23:13'),
(8, 5, 4, 3, 0.14285714285714, 1.3428571428571, 0.10638297872341, NULL, '2023-06-25 12:23:13'),
(9, 5, 5, 3, 1, 9.4, 0.1063829787234, NULL, '2023-06-25 12:23:13'),
(10, 4, 5, 4, 2, 3.2857142857143, 0.60869565217391, NULL, '2023-06-25 12:24:12'),
(11, 5, 4, 4, 0.5, 1.6428571428571, 0.30434782608696, NULL, '2023-06-25 12:24:12'),
(12, 5, 5, 4, 1, 3.2857142857143, 0.30434782608696, NULL, '2023-06-25 12:24:12'),
(13, 4, 6, 2, 7, 8.7777777777778, 0.79746835443038, NULL, '2023-06-25 14:36:33'),
(14, 6, 4, 2, 0.14285714285714, 1.2539682539682, 0.11392405063291, NULL, '2023-06-25 14:36:33'),
(15, 5, 6, 2, 0.77777777777778, 8.7777777777778, 0.088607594936709, NULL, '2023-06-25 14:36:33'),
(16, 6, 5, 2, 1.2857142857143, 11.285714285714, 0.11392405063292, NULL, '2023-06-25 14:36:33'),
(17, 6, 6, 2, 1, 8.7777777777778, 0.11392405063291, NULL, '2023-06-25 14:36:33'),
(18, 4, 6, 3, 5, 6.7142857142857, 0.74468085106383, NULL, '2023-06-25 12:23:13'),
(19, 6, 4, 3, 0.2, 1.3428571428571, 0.14893617021277, NULL, '2023-06-25 12:23:13'),
(20, 5, 6, 3, 0.71428571428571, 6.7142857142857, 0.1063829787234, NULL, '2023-06-25 12:23:13'),
(21, 6, 5, 3, 1.4, 9.4, 0.14893617021277, NULL, '2023-06-25 12:23:13'),
(22, 6, 6, 3, 1, 6.7142857142857, 0.14893617021277, NULL, '2023-06-25 12:23:13'),
(23, 4, 6, 4, 7, 11.5, 0.60869565217391, NULL, '2023-06-25 12:24:12'),
(24, 6, 4, 4, 0.14285714285714, 1.6428571428571, 0.086956521739131, NULL, '2023-06-25 12:24:12'),
(25, 5, 6, 4, 3.5, 11.5, 0.30434782608696, NULL, '2023-06-25 12:24:12'),
(26, 6, 5, 4, 0.28571428571429, 3.2857142857143, 0.086956521739131, NULL, '2023-06-25 12:24:12'),
(27, 6, 6, 4, 1, 11.5, 0.08695652173913, NULL, '2023-06-25 12:24:12');

-- --------------------------------------------------------

--
-- Table structure for table `analisis_kriterias`
--

CREATE TABLE `analisis_kriterias` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_kriteria_1` bigint UNSIGNED NOT NULL,
  `kode_kriteria_2` bigint UNSIGNED NOT NULL,
  `nilai` double NOT NULL,
  `bobot` double DEFAULT NULL,
  `jumlah` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `analisis_kriterias`
--

INSERT INTO `analisis_kriterias` (`id`, `kode_kriteria_1`, `kode_kriteria_2`, `nilai`, `bobot`, `jumlah`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 1, 1.5333333333333, 0.65217391304349, NULL, '2023-06-25 10:18:41'),
(2, 2, 3, 3, 4.6, 0.65217391304348, NULL, '2023-06-25 10:18:41'),
(3, 3, 2, 0.33333333333333, 1.5333333333333, 0.21739130434783, NULL, '2023-06-25 10:18:41'),
(4, 3, 3, 1, 4.6, 0.21739130434783, NULL, '2023-06-25 10:18:41'),
(5, 2, 4, 5, 7.6666666666667, 0.65217391304348, NULL, '2023-06-25 10:18:41'),
(6, 4, 2, 0.2, 1.5333333333333, 0.1304347826087, NULL, '2023-06-25 10:18:41'),
(7, 3, 4, 1.6666666666667, 7.6666666666667, 0.21739130434783, NULL, '2023-06-25 10:18:41'),
(8, 4, 3, 0.6, 4.6, 0.1304347826087, NULL, '2023-06-25 10:18:41'),
(9, 4, 4, 1, 7.6666666666667, 0.1304347826087, NULL, '2023-06-25 10:18:41');

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_bank` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo_bank` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `nama_bank`, `logo_bank`, `created_at`, `updated_at`) VALUES
(1, 'BCA', 'images/Bank-BCA-HYN6.webp', '2023-05-31 21:20:20', '2023-05-31 21:24:06');

-- --------------------------------------------------------

--
-- Table structure for table `barangs`
--

CREATE TABLE `barangs` (
  `id` bigint UNSIGNED NOT NULL,
  `kategori_id` bigint UNSIGNED NOT NULL,
  `nama_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barangs`
--

INSERT INTO `barangs` (`id`, `kategori_id`, `nama_barang`, `foto_barang`, `harga_barang`, `stok`, `created_at`, `updated_at`) VALUES
(10, 4, 'Vans 1', 'images/Barang-Vans-1-Vk2W.jpg', '550000', 10, '2023-06-25 13:03:07', '2023-06-25 13:03:07'),
(11, 4, 'Vans 2', 'images/Barang-Vans-2-nSx2.jpg', '387000', 10, '2023-06-25 13:03:37', '2023-06-25 13:03:37'),
(12, 5, 'Vans 3', 'images/Barang-Vans-3-DNO0.jpg', '289000', 10, '2023-06-25 13:05:06', '2023-06-25 13:05:06'),
(13, 5, 'Vans 4', 'images/Barang-Vans-4-M5mK.jpg', '289000', 10, '2023-06-25 13:05:27', '2023-06-25 13:05:27'),
(14, 6, 'Vans 5', 'images/Barang-Vans-5-UFo3.jpg', '215000', 10, '2023-06-25 13:06:32', '2023-06-25 13:06:32');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_pengirim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_pengirim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subjek_pengirim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pesan` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `nama_pengirim`, `email_pengirim`, `subjek_pengirim`, `pesan`, `created_at`, `updated_at`) VALUES
(2, 'Randy Salim', 'randy@gmail.com', 'Tesst', 'Berhasil', '2023-06-05 05:29:45', '2023-06-05 05:29:45');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hasil_alternatifs`
--

CREATE TABLE `hasil_alternatifs` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_alternatif` bigint UNSIGNED NOT NULL,
  `kode_kriteria` bigint UNSIGNED NOT NULL,
  `nilai_alternatif` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hasil_alternatifs`
--

INSERT INTO `hasil_alternatifs` (`id`, `kode_alternatif`, `kode_kriteria`, `nilai_alternatif`, `created_at`, `updated_at`) VALUES
(4, 4, 3, 0.74468085106384, NULL, NULL),
(5, 5, 3, 0.1063829787234, NULL, NULL),
(6, 6, 3, 0.14893617021277, NULL, NULL),
(7, 4, 4, 0.60869565217392, NULL, NULL),
(8, 5, 4, 0.30434782608696, NULL, NULL),
(9, 6, 4, 0.086956521739131, NULL, NULL),
(13, 4, 2, 0.7974683544304, NULL, NULL),
(14, 5, 2, 0.088607594936711, NULL, NULL),
(15, 6, 2, 0.11392405063291, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_invoice` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pelanggan_id` bigint UNSIGNED NOT NULL,
  `jasakirim_id` bigint UNSIGNED DEFAULT NULL,
  `rekening_id` bigint UNSIGNED DEFAULT NULL,
  `total_invoice` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('0','1','2','3','4','5') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0 di keranjang, 1 checkout, 2 upload pembayaran, 3 konfirmasi, 4 selesai, 5 batal',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `kode_invoice`, `pelanggan_id`, `jasakirim_id`, `rekening_id`, `total_invoice`, `status`, `created_at`, `updated_at`) VALUES
(13, 'INVKJ99040620231UG8X', 4, 1, 2, '537000', '4', '2023-06-04 15:42:54', '2023-06-04 15:51:07'),
(14, 'INVKJ9904062023LOUKH', 4, 3, 3, '152000', '1', '2023-06-04 15:53:15', '2023-06-04 15:53:39'),
(15, 'INVKJ9905062023T62MW', 6, 1, 2, '683000', '4', '2023-06-05 05:20:51', '2023-06-05 05:27:49');

-- --------------------------------------------------------

--
-- Table structure for table `jasa_kirims`
--

CREATE TABLE `jasa_kirims` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jasa_kirims`
--

INSERT INTO `jasa_kirims` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'JNE', '2023-06-03 07:00:22', '2023-06-03 07:00:22'),
(3, 'J&T', '2023-06-03 07:00:45', '2023-06-03 07:00:45');

-- --------------------------------------------------------

--
-- Table structure for table `kategoris`
--

CREATE TABLE `kategoris` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategoris`
--

INSERT INTO `kategoris` (`id`, `name`, `created_at`, `updated_at`) VALUES
(4, 'Slip On', '2023-06-25 11:41:03', '2023-06-25 11:41:03'),
(5, 'Authentic', '2023-06-25 11:41:55', '2023-06-25 11:41:55'),
(6, 'Era', '2023-06-25 11:42:58', '2023-06-25 11:42:58');

-- --------------------------------------------------------

--
-- Table structure for table `kriterias`
--

CREATE TABLE `kriterias` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_kriteria` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kriteria` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai_kriteria` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kriterias`
--

INSERT INTO `kriterias` (`id`, `kode_kriteria`, `kriteria`, `nilai_kriteria`, `created_at`, `updated_at`) VALUES
(2, 'KR001', 'Harga', 0.65217391304348, '2023-06-25 05:39:32', '2023-06-25 10:26:54'),
(3, 'KR002', 'Bahan', 0.21739130434783, '2023-06-25 05:39:57', '2023-06-25 10:26:54'),
(4, 'KR003', 'Ukuran', 0.1304347826087, '2023-06-25 05:40:36', '2023-06-25 10:26:54');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_05_31_164637_create_pelanggans_table', 1),
(6, '2023_05_31_165037_create_kategoris_table', 1),
(7, '2023_05_31_165152_create_barangs_table', 2),
(8, '2023_05_31_165749_create_transaksis_table', 3),
(9, '2023_06_01_021547_create_settings_table', 4),
(10, '2023_06_01_032002_create_banks_table', 5),
(11, '2023_06_01_032011_create_rekenings_table', 5),
(12, '2023_06_02_082845_create_sliders_table', 6),
(14, '2023_06_02_111829_create_invoices_table', 7),
(15, '2023_06_02_112415_add_field_invoice_id_to_transaksis', 8),
(16, '2023_06_03_112206_add_field_pelanggan_id_to_invoices', 9),
(17, '2023_06_03_134756_create_jasa_kirims_table', 10),
(18, '2023_06_03_141146_add_field_jasakirim_id_to_invoices', 11),
(19, '2023_06_03_155452_create_pembayarans_table', 12),
(20, '2023_06_03_172337_add_field_foto_to_pelanggans', 13),
(21, '2023_06_03_195658_create_alamats_table', 14),
(22, '2023_06_04_110649_add_field_total_invoice_to_invoices', 15),
(23, '2023_06_04_122759_add_field_nama_penerima_to_pelanggans', 16),
(24, '2023_06_04_140223_create_contacts_table', 17),
(25, '2023_06_04_144249_add_field_foto_to_users', 18),
(27, '2023_06_25_113911_create_kriterias_table', 19),
(28, '2023_06_25_121738_create_analisis_kriterias_table', 20),
(29, '2023_06_25_132227_create_nilais_table', 21),
(30, '2023_06_25_182145_create_analisis_alternatifs_table', 22),
(31, '2023_06_25_190835_create_hasil_alternatifs_table', 23),
(32, '2023_06_25_193306_create_rankings_table', 24);

-- --------------------------------------------------------

--
-- Table structure for table `nilais`
--

CREATE TABLE `nilais` (
  `id` bigint UNSIGNED NOT NULL,
  `kepentingan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nilais`
--

INSERT INTO `nilais` (`id`, `kepentingan`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, '1', 'Kedua elemen sama pentingnya', '2023-06-25 06:33:31', '2023-06-25 06:33:31'),
(2, '2', 'Nilai antara dua nilai pertimbangan yang berdekatan', '2023-06-25 06:33:41', '2023-06-25 06:33:41'),
(3, '3', 'Elemen yang satu sedikit lebih penting daripada elemen lainnya', '2023-06-25 06:33:48', '2023-06-25 06:33:48'),
(4, '4', 'Nilai antara dua nilai pertimbangan yang berdekatan', '2023-06-25 06:33:57', '2023-06-25 06:33:57'),
(5, '5', 'Elemen yang satu lebih penting daripada elemen lainnya', '2023-06-25 06:34:04', '2023-06-25 06:34:04'),
(6, '6', 'Nilai antara dua nilai pertimbangan yang berdekatan', '2023-06-25 06:34:13', '2023-06-25 06:34:13'),
(7, '7', 'Satu elemen jelas lebih mutlak penting daripada elemen lainnya', '2023-06-25 06:34:23', '2023-06-25 06:34:23'),
(8, '8', 'Nilai antara dua nilai pertimbangan yang berdekatan', '2023-06-25 06:34:33', '2023-06-25 06:34:33'),
(10, '9', 'Satu elemen mutlak penting daripada elemen lainnya', '2023-06-25 06:39:24', '2023-06-25 06:39:24');

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
-- Table structure for table `pelanggans`
--

CREATE TABLE `pelanggans` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jns_kelamin` enum('Pria','Wanita') COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_penerima` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_penerima` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` longtext COLLATE utf8mb4_unicode_ci,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pelanggans`
--

INSERT INTO `pelanggans` (`id`, `name`, `foto`, `username`, `email`, `no_hp`, `tgl_lahir`, `jns_kelamin`, `nama_penerima`, `no_penerima`, `alamat`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 'Randy Salim', NULL, 'randy_salim', 'randy@gmail.com', '08912737188', '2001-06-05', 'Pria', 'Randy Salim', '08955267188', 'Kp. Jauh Rt 01/02\r\nDesa Terdekat, Kec. Dimana - manaa', NULL, '$2y$10$2QoC4Om8oFd/MdfuGX7gveqZtYsXCpT2yOviyeCc8frBKS8.oggrq', NULL, '2023-06-04 15:38:16', '2023-06-04 15:53:39'),
(5, 'Randy Salim', NULL, 'randy_salim1', 'randy1@gmail.com', '08984712771', '2001-06-05', 'Pria', NULL, NULL, NULL, NULL, '$2y$10$L8ioAW3aO/G9sPxDnWlr0eXUgfXOhHD2zOYnSR4KVC8p2uf.aWp3a', NULL, '2023-06-04 15:42:02', '2023-06-04 15:42:02'),
(6, 'Rudi', NULL, 'rudi_123', 'rudi@gmail.com', '0898641711', '2001-06-05', 'Pria', 'Rudi 2', '08955267188', 'Test 2', NULL, '$2y$10$zdcKRaEVAPggYJwzl8Eh3OkXSp7522TOyatxsS0AwUmdB0mQsYZXG', NULL, '2023-06-05 05:20:09', '2023-06-05 05:24:15');

-- --------------------------------------------------------

--
-- Table structure for table `pembayarans`
--

CREATE TABLE `pembayarans` (
  `id` bigint UNSIGNED NOT NULL,
  `invoice_id` bigint UNSIGNED NOT NULL,
  `bukti_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0 Menunggu Konfirmasi, 1 Berhasil, 2 Gagal',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembayarans`
--

INSERT INTO `pembayarans` (`id`, `invoice_id`, `bukti_pembayaran`, `status`, `created_at`, `updated_at`) VALUES
(6, 13, 'images/Bukti-Pembayaran-INVKJ99040620231UG8X-HVy.jpg', '1', '2023-06-04 15:47:53', '2023-06-04 15:50:40'),
(7, 15, 'images/Bukti-Pembayaran-INVKJ9905062023T62MW-cW9.jpg', '1', '2023-06-05 05:25:08', '2023-06-05 05:27:22');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rankings`
--

CREATE TABLE `rankings` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_alternatif` bigint UNSIGNED NOT NULL,
  `nilai` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rankings`
--

INSERT INTO `rankings` (`id`, `kode_alternatif`, `nilai`, `created_at`, `updated_at`) VALUES
(1, 4, 0.68307745801834, NULL, NULL),
(2, 5, 0.89316681219536, NULL, NULL),
(3, 6, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rekenings`
--

CREATE TABLE `rekenings` (
  `id` bigint UNSIGNED NOT NULL,
  `bank_id` bigint UNSIGNED NOT NULL,
  `nama_rekening` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_rekening` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rekenings`
--

INSERT INTO `rekenings` (`id`, `bank_id`, `nama_rekening`, `no_rekening`, `created_at`, `updated_at`) VALUES
(2, 1, 'Kios Jaya 99', '21717711', '2023-06-02 01:14:37', '2023-06-02 01:14:37'),
(3, 1, 'Kios Jaya 99', '8712618901', '2023-06-04 15:52:57', '2023-06-04 15:52:57');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_website` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `favicon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `google_map` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `about_us` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `nama_website`, `logo`, `favicon`, `alamat`, `google_map`, `email`, `no_telp`, `about_us`, `created_at`, `updated_at`) VALUES
(1, 'Kios Jaya 99', 'images/Logo-Kios-Jaya-99-Cunk.png', 'images/Favicon-Kios-Jaya-99-Nwlu.png', 'Kios Jaya 99', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.976542690506!2d106.8182876743306!3d-6.397024293593563!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69eb9b9ebc6ce9%3A0x3f35d853d6f1c144!2sWarung%20Nako%20Kopi%20Nako%20Depok!5e0!3m2!1sid!2sid!4v1685588296364!5m2!1sid!2sid', 'kiosjaya99@gmail.com', '081272181990', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '2023-05-31 19:59:29', '2023-05-31 20:09:39');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint UNSIGNED NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 'images/Slider-LEXyt.jpg', '2023-06-02 01:42:41', '2023-06-02 01:45:42'),
(2, 'images/Slider-4PtdX.jpg', '2023-06-02 01:55:30', '2023-06-02 01:55:30');

-- --------------------------------------------------------

--
-- Table structure for table `transaksis`
--

CREATE TABLE `transaksis` (
  `id` bigint UNSIGNED NOT NULL,
  `invoice_id` bigint UNSIGNED NOT NULL,
  `barang_id` bigint UNSIGNED NOT NULL,
  `pelanggan_id` bigint UNSIGNED NOT NULL,
  `pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jasa_kirim` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kuantitas` int NOT NULL,
  `total` int NOT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('Administrator','Pegawai') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `foto`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Superadmin', 'superadmin', NULL, 'superadmin@gmail.com', NULL, '$2y$10$UwCGQLdm1u5JVB8nGl8Goe9.5xN6kasBQkbmWXUgOy.I2JSWyRw..', 'Administrator', NULL, '2023-05-31 19:12:18', '2023-05-31 19:12:18'),
(2, 'Pegawai 1', 'pegawai_1', '', 'pegawai1@gmail.com', NULL, '$2y$10$ar2XZlm4JemIzLXpEmD58OlH3tfITw2vKlpHXJ81yUnsHibIq4Up2', 'Pegawai', NULL, '2023-06-04 08:02:53', '2023-06-05 05:36:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alamats`
--
ALTER TABLE `alamats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alamats_pelanggan_id_foreign` (`pelanggan_id`);

--
-- Indexes for table `analisis_alternatifs`
--
ALTER TABLE `analisis_alternatifs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `analisis_alternatifs_kode_alternatif_1_foreign` (`kode_alternatif_1`),
  ADD KEY `analisis_alternatifs_kode_alternatif_2_foreign` (`kode_alternatif_2`),
  ADD KEY `analisis_alternatifs_kode_kriteria_foreign` (`kode_kriteria`);

--
-- Indexes for table `analisis_kriterias`
--
ALTER TABLE `analisis_kriterias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `analisis_kriterias_kode_kriteria_1_foreign` (`kode_kriteria_1`),
  ADD KEY `analisis_kriterias_kode_kriteria_2_foreign` (`kode_kriteria_2`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barangs`
--
ALTER TABLE `barangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barangs_kategori_id_foreign` (`kategori_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `hasil_alternatifs`
--
ALTER TABLE `hasil_alternatifs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hasil_alternatifs_kode_alternatif_foreign` (`kode_alternatif`),
  ADD KEY `hasil_alternatifs_kode_kriteria_foreign` (`kode_kriteria`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoices_pelanggan_id_foreign` (`pelanggan_id`);

--
-- Indexes for table `jasa_kirims`
--
ALTER TABLE `jasa_kirims`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategoris`
--
ALTER TABLE `kategoris`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kriterias`
--
ALTER TABLE `kriterias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilais`
--
ALTER TABLE `nilais`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pelanggans`
--
ALTER TABLE `pelanggans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pelanggans_username_unique` (`username`),
  ADD UNIQUE KEY `pelanggans_email_unique` (`email`);

--
-- Indexes for table `pembayarans`
--
ALTER TABLE `pembayarans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembayarans_invoice_id_foreign` (`invoice_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `rankings`
--
ALTER TABLE `rankings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rankings_kode_alternatif_foreign` (`kode_alternatif`);

--
-- Indexes for table `rekenings`
--
ALTER TABLE `rekenings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rekenings_bank_id_foreign` (`bank_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksis`
--
ALTER TABLE `transaksis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksis_barang_id_foreign` (`barang_id`),
  ADD KEY `transaksis_pelanggan_id_foreign` (`pelanggan_id`),
  ADD KEY `transaksis_invoice_id_foreign` (`invoice_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alamats`
--
ALTER TABLE `alamats`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `analisis_alternatifs`
--
ALTER TABLE `analisis_alternatifs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `analisis_kriterias`
--
ALTER TABLE `analisis_kriterias`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `barangs`
--
ALTER TABLE `barangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hasil_alternatifs`
--
ALTER TABLE `hasil_alternatifs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `jasa_kirims`
--
ALTER TABLE `jasa_kirims`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kategoris`
--
ALTER TABLE `kategoris`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kriterias`
--
ALTER TABLE `kriterias`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `nilais`
--
ALTER TABLE `nilais`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pelanggans`
--
ALTER TABLE `pelanggans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pembayarans`
--
ALTER TABLE `pembayarans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rankings`
--
ALTER TABLE `rankings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rekenings`
--
ALTER TABLE `rekenings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaksis`
--
ALTER TABLE `transaksis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alamats`
--
ALTER TABLE `alamats`
  ADD CONSTRAINT `alamats_pelanggan_id_foreign` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `analisis_alternatifs`
--
ALTER TABLE `analisis_alternatifs`
  ADD CONSTRAINT `analisis_alternatifs_kode_alternatif_1_foreign` FOREIGN KEY (`kode_alternatif_1`) REFERENCES `kategoris` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `analisis_alternatifs_kode_alternatif_2_foreign` FOREIGN KEY (`kode_alternatif_2`) REFERENCES `kategoris` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `analisis_alternatifs_kode_kriteria_foreign` FOREIGN KEY (`kode_kriteria`) REFERENCES `kriterias` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `analisis_kriterias`
--
ALTER TABLE `analisis_kriterias`
  ADD CONSTRAINT `analisis_kriterias_kode_kriteria_1_foreign` FOREIGN KEY (`kode_kriteria_1`) REFERENCES `kriterias` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `analisis_kriterias_kode_kriteria_2_foreign` FOREIGN KEY (`kode_kriteria_2`) REFERENCES `kriterias` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `barangs`
--
ALTER TABLE `barangs`
  ADD CONSTRAINT `barangs_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategoris` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hasil_alternatifs`
--
ALTER TABLE `hasil_alternatifs`
  ADD CONSTRAINT `hasil_alternatifs_kode_alternatif_foreign` FOREIGN KEY (`kode_alternatif`) REFERENCES `kategoris` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hasil_alternatifs_kode_kriteria_foreign` FOREIGN KEY (`kode_kriteria`) REFERENCES `kriterias` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_pelanggan_id_foreign` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pembayarans`
--
ALTER TABLE `pembayarans`
  ADD CONSTRAINT `pembayarans_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rankings`
--
ALTER TABLE `rankings`
  ADD CONSTRAINT `rankings_kode_alternatif_foreign` FOREIGN KEY (`kode_alternatif`) REFERENCES `kategoris` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rekenings`
--
ALTER TABLE `rekenings`
  ADD CONSTRAINT `rekenings_bank_id_foreign` FOREIGN KEY (`bank_id`) REFERENCES `banks` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transaksis`
--
ALTER TABLE `transaksis`
  ADD CONSTRAINT `transaksis_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `barangs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksis_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksis_pelanggan_id_foreign` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggans` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 13 Sep 2023 pada 04.01
-- Versi server: 8.0.30
-- Versi PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `finance_form`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `banks`
--

CREATE TABLE `banks` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `division_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `banks`
--

INSERT INTO `banks` (`id`, `name`, `division_id`, `created_at`, `updated_at`) VALUES
(1, 'BRI 12345678', 1, '2023-09-02 11:07:00', '2023-09-02 11:07:00'),
(2, 'BRI 12345678', 2, '2023-09-02 11:07:00', '2023-09-02 11:07:00'),
(3, 'BRI 12345678', 3, '2023-09-02 11:07:00', '2023-09-02 11:07:00'),
(4, 'BRI 12345678', 4, '2023-09-02 11:07:00', '2023-09-02 11:07:00'),
(5, 'BNI 12345678', 1, '2023-09-02 11:07:00', '2023-09-02 11:07:00'),
(6, 'BNI 12345678', 2, '2023-09-02 11:07:00', '2023-09-02 11:07:00'),
(7, 'BNI 12345678', 3, '2023-09-02 11:07:00', '2023-09-02 11:07:00'),
(8, 'BNI 12345678', 4, '2023-09-02 11:07:00', '2023-09-02 11:07:00'),
(9, 'MANDIRI 12345678', 1, '2023-09-02 11:07:01', '2023-09-02 11:07:01'),
(10, 'MANDIRI 12345678', 2, '2023-09-02 11:07:01', '2023-09-02 11:07:01'),
(11, 'MANDIRI 12345678', 3, '2023-09-02 11:07:01', '2023-09-02 11:07:01'),
(12, 'MANDIRI 12345678', 4, '2023-09-02 11:07:01', '2023-09-02 11:07:01'),
(13, 'BCA 12345678', 1, '2023-09-02 11:07:01', '2023-09-02 11:07:01'),
(14, 'BCA 12345678', 2, '2023-09-02 11:07:01', '2023-09-02 11:07:01'),
(15, 'BCA 12345678', 3, '2023-09-02 11:07:01', '2023-09-02 11:07:01'),
(16, 'BCA 12345678', 4, '2023-09-02 11:07:01', '2023-09-02 11:07:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `debit_note`
--

CREATE TABLE `debit_note` (
  `id` bigint UNSIGNED NOT NULL,
  `no_invoice` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_date` datetime DEFAULT NULL,
  `tax_invoice_serial_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_invoice_date` datetime DEFAULT NULL,
  `no_debit_note` int NOT NULL DEFAULT '0',
  `id_division` bigint UNSIGNED NOT NULL,
  `for` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_charge` bigint NOT NULL DEFAULT '0',
  `received_from` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `debit_note_date` datetime DEFAULT NULL,
  `currency` enum('idr','usd','sgd') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'idr',
  `vat` int NOT NULL DEFAULT '0',
  `wht_id` bigint UNSIGNED DEFAULT NULL,
  `bank_id` bigint UNSIGNED DEFAULT NULL,
  `status_id` bigint UNSIGNED NOT NULL,
  `wht_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wht_date` datetime DEFAULT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `debit_note`
--

INSERT INTO `debit_note` (`id`, `no_invoice`, `invoice_date`, `tax_invoice_serial_no`, `tax_invoice_date`, `no_debit_note`, `id_division`, `for`, `bank_charge`, `received_from`, `debit_note_date`, `currency`, `vat`, `wht_id`, `bank_id`, `status_id`, `wht_no`, `wht_date`, `note`, `created_at`, `updated_at`) VALUES
(1, '33435', '2023-09-11 00:00:00', 'sfsdfdsf', '2023-09-11 00:00:00', 1, 1, 'dsfsdf', 1, 'erffdsf', '2023-09-11 00:00:00', 'idr', 11, 1, 1, 4, '4355', '2023-09-11 00:00:00', NULL, '2023-09-11 07:47:30', '2023-09-11 07:47:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `decription_debit`
--

CREATE TABLE `decription_debit` (
  `id` bigint UNSIGNED NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` bigint NOT NULL DEFAULT '0',
  `type` enum('reg','add') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'reg',
  `id_debit_note` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `decription_debit`
--

INSERT INTO `decription_debit` (`id`, `value`, `price`, `type`, `id_debit_note`, `created_at`, `updated_at`) VALUES
(1, 'dsfds', 100000, 'reg', 1, '2023-09-11 07:47:30', '2023-09-11 07:47:30'),
(2, 'fsf', 100000, 'reg', 1, '2023-09-11 07:47:30', '2023-09-11 07:47:30'),
(3, 'asfsf', 100000, 'add', 1, '2023-09-11 07:47:30', '2023-09-11 07:47:30'),
(4, 'afasf', 100000, 'add', 1, '2023-09-11 07:47:30', '2023-09-11 07:47:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `description`
--

CREATE TABLE `description` (
  `id` bigint UNSIGNED NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` bigint NOT NULL DEFAULT '0',
  `type` enum('reg','add') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'reg',
  `id_payment_request` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `description`
--

INSERT INTO `description` (`id`, `value`, `price`, `type`, `id_payment_request`, `created_at`, `updated_at`) VALUES
(1, 'Prof.', 693096, 'reg', 1, '2023-09-02 11:07:01', '2023-09-02 11:07:01'),
(2, 'Miss', 251313, 'reg', 1, '2023-09-02 11:07:01', '2023-09-02 11:07:01'),
(3, 'Mrs.', 749097, 'add', 1, '2023-09-02 11:07:01', '2023-09-02 11:07:01'),
(4, 'Dr.', 655192, 'add', 1, '2023-09-02 11:07:01', '2023-09-02 11:07:01'),
(5, 'Dr.', 341368, 'reg', 2, '2023-09-02 11:07:02', '2023-09-02 11:07:02'),
(6, 'Prof.', 438617, 'reg', 2, '2023-09-02 11:07:02', '2023-09-02 11:07:02'),
(7, 'Mr.', 945156, 'add', 2, '2023-09-02 11:07:02', '2023-09-02 11:07:02'),
(8, 'Mrs.', 200485, 'add', 2, '2023-09-02 11:07:02', '2023-09-02 11:07:02'),
(9, 'Mr.', 699577, 'reg', 3, '2023-09-02 11:07:02', '2023-09-02 11:07:02'),
(10, 'Ms.', 473065, 'reg', 3, '2023-09-02 11:07:02', '2023-09-02 11:07:02'),
(11, 'Miss', 995813, 'add', 3, '2023-09-02 11:07:02', '2023-09-02 11:07:02'),
(12, 'Prof.', 147062, 'add', 3, '2023-09-02 11:07:02', '2023-09-02 11:07:02'),
(13, 'Mrs.', 877651, 'reg', 4, '2023-09-02 11:07:02', '2023-09-02 11:07:02'),
(14, 'Miss', 562529, 'reg', 4, '2023-09-02 11:07:02', '2023-09-02 11:07:02'),
(15, 'Dr.', 419782, 'add', 4, '2023-09-02 11:07:02', '2023-09-02 11:07:02'),
(16, 'Prof.', 785536, 'add', 4, '2023-09-02 11:07:02', '2023-09-02 11:07:02'),
(17, 'Mrs.', 784953, 'reg', 5, '2023-09-02 11:07:02', '2023-09-02 11:07:02'),
(18, 'Dr.', 481421, 'reg', 5, '2023-09-02 11:07:02', '2023-09-02 11:07:02'),
(19, 'Ms.', 310521, 'add', 5, '2023-09-02 11:07:02', '2023-09-02 11:07:02'),
(20, 'Prof.', 340924, 'add', 5, '2023-09-02 11:07:02', '2023-09-02 11:07:02'),
(21, 'Prof.', 597253, 'reg', 6, '2023-09-02 11:07:02', '2023-09-02 11:07:02'),
(22, 'Prof.', 859518, 'reg', 6, '2023-09-02 11:07:02', '2023-09-02 11:07:02'),
(23, 'Mrs.', 505078, 'add', 6, '2023-09-02 11:07:02', '2023-09-02 11:07:02'),
(24, 'Mr.', 605953, 'add', 6, '2023-09-02 11:07:02', '2023-09-02 11:07:02'),
(25, 'Miss', 224369, 'reg', 7, '2023-09-02 11:07:02', '2023-09-02 11:07:02'),
(26, 'Miss', 968324, 'reg', 7, '2023-09-02 11:07:02', '2023-09-02 11:07:02'),
(27, 'Dr.', 138228, 'add', 7, '2023-09-02 11:07:02', '2023-09-02 11:07:02'),
(28, 'Mr.', 838582, 'add', 7, '2023-09-02 11:07:03', '2023-09-02 11:07:03'),
(29, 'Dr.', 162790, 'reg', 8, '2023-09-02 11:07:03', '2023-09-02 11:07:03'),
(30, 'Mr.', 388212, 'reg', 8, '2023-09-02 11:07:03', '2023-09-02 11:07:03'),
(31, 'Mr.', 261481, 'add', 8, '2023-09-02 11:07:03', '2023-09-02 11:07:03'),
(32, 'Prof.', 554835, 'add', 8, '2023-09-02 11:07:03', '2023-09-02 11:07:03'),
(33, 'Dr.', 825932, 'reg', 9, '2023-09-02 11:07:03', '2023-09-02 11:07:03'),
(34, 'Mr.', 162399, 'reg', 9, '2023-09-02 11:07:03', '2023-09-02 11:07:03'),
(35, 'Mr.', 800688, 'add', 9, '2023-09-02 11:07:03', '2023-09-02 11:07:03'),
(36, 'Ms.', 706302, 'add', 9, '2023-09-02 11:07:03', '2023-09-02 11:07:03'),
(37, 'Dr.', 178429, 'reg', 10, '2023-09-02 11:07:03', '2023-09-02 11:07:03'),
(38, 'Prof.', 229447, 'reg', 10, '2023-09-02 11:07:03', '2023-09-02 11:07:03'),
(39, 'Mrs.', 533249, 'add', 10, '2023-09-02 11:07:03', '2023-09-02 11:07:03'),
(40, 'Prof.', 965243, 'add', 10, '2023-09-02 11:07:03', '2023-09-02 11:07:03'),
(41, 'Mr.', 417823, 'reg', 11, '2023-09-02 11:07:03', '2023-09-02 11:07:03'),
(42, 'Mr.', 170751, 'reg', 11, '2023-09-02 11:07:03', '2023-09-02 11:07:03'),
(43, 'Prof.', 397038, 'add', 11, '2023-09-02 11:07:03', '2023-09-02 11:07:03'),
(44, 'Prof.', 943881, 'add', 11, '2023-09-02 11:07:03', '2023-09-02 11:07:03'),
(45, 'Miss', 140400, 'reg', 12, '2023-09-02 11:07:03', '2023-09-02 11:07:03'),
(46, 'Prof.', 224962, 'reg', 12, '2023-09-02 11:07:03', '2023-09-02 11:07:03'),
(47, 'Prof.', 947622, 'add', 12, '2023-09-02 11:07:03', '2023-09-02 11:07:03'),
(48, 'Mrs.', 316685, 'add', 12, '2023-09-02 11:07:03', '2023-09-02 11:07:03'),
(49, 'Mr.', 924515, 'reg', 13, '2023-09-02 11:07:04', '2023-09-02 11:07:04'),
(50, 'Dr.', 527802, 'reg', 13, '2023-09-02 11:07:04', '2023-09-02 11:07:04'),
(51, 'Prof.', 257841, 'add', 13, '2023-09-02 11:07:04', '2023-09-02 11:07:04'),
(52, 'Prof.', 690992, 'add', 13, '2023-09-02 11:07:04', '2023-09-02 11:07:04'),
(53, 'Prof.', 305580, 'reg', 14, '2023-09-02 11:07:04', '2023-09-02 11:07:04'),
(54, 'Mr.', 268588, 'reg', 14, '2023-09-02 11:07:04', '2023-09-02 11:07:04'),
(55, 'Prof.', 339005, 'add', 14, '2023-09-02 11:07:04', '2023-09-02 11:07:04'),
(56, 'Dr.', 830193, 'add', 14, '2023-09-02 11:07:04', '2023-09-02 11:07:04'),
(57, 'Dr.', 122078, 'reg', 15, '2023-09-02 11:07:04', '2023-09-02 11:07:04'),
(58, 'Dr.', 292296, 'reg', 15, '2023-09-02 11:07:04', '2023-09-02 11:07:04'),
(59, 'Mrs.', 795612, 'add', 15, '2023-09-02 11:07:04', '2023-09-02 11:07:04'),
(60, 'Prof.', 301383, 'add', 15, '2023-09-02 11:07:04', '2023-09-02 11:07:04'),
(61, 'Prof.', 122126, 'reg', 16, '2023-09-02 11:07:04', '2023-09-02 11:07:04'),
(62, 'Ms.', 328567, 'reg', 16, '2023-09-02 11:07:04', '2023-09-02 11:07:04'),
(63, 'Ms.', 449821, 'add', 16, '2023-09-02 11:07:04', '2023-09-02 11:07:04'),
(64, 'Prof.', 627969, 'add', 16, '2023-09-02 11:07:04', '2023-09-02 11:07:04'),
(65, 'Dr.', 405143, 'reg', 17, '2023-09-02 11:07:04', '2023-09-02 11:07:04'),
(66, 'Prof.', 156783, 'reg', 17, '2023-09-02 11:07:04', '2023-09-02 11:07:04'),
(67, 'Miss', 723906, 'add', 17, '2023-09-02 11:07:04', '2023-09-02 11:07:04'),
(68, 'Mr.', 584441, 'add', 17, '2023-09-02 11:07:04', '2023-09-02 11:07:04'),
(69, 'Mr.', 641546, 'reg', 18, '2023-09-02 11:07:04', '2023-09-02 11:07:04'),
(70, 'Dr.', 951588, 'reg', 18, '2023-09-02 11:07:04', '2023-09-02 11:07:04'),
(71, 'Miss', 491089, 'add', 18, '2023-09-02 11:07:05', '2023-09-02 11:07:05'),
(72, 'Dr.', 796087, 'add', 18, '2023-09-02 11:07:05', '2023-09-02 11:07:05'),
(73, 'Dr.', 489810, 'reg', 19, '2023-09-02 11:07:05', '2023-09-02 11:07:05'),
(74, 'Ms.', 648003, 'reg', 19, '2023-09-02 11:07:05', '2023-09-02 11:07:05'),
(75, 'Prof.', 332831, 'add', 19, '2023-09-02 11:07:05', '2023-09-02 11:07:05'),
(76, 'Prof.', 199149, 'add', 19, '2023-09-02 11:07:05', '2023-09-02 11:07:05'),
(77, 'Ms.', 538043, 'reg', 20, '2023-09-02 11:07:05', '2023-09-02 11:07:05'),
(78, 'Dr.', 682932, 'reg', 20, '2023-09-02 11:07:05', '2023-09-02 11:07:05'),
(79, 'Mrs.', 795204, 'add', 20, '2023-09-02 11:07:05', '2023-09-02 11:07:05'),
(80, 'Mr.', 902002, 'add', 20, '2023-09-02 11:07:05', '2023-09-02 11:07:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `division`
--

CREATE TABLE `division` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `division`
--

INSERT INTO `division` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'PT. ESR INDONESIA MANAGEMENT', 'EIM', '2023-09-02 11:07:00', '2023-09-02 11:07:00'),
(2, 'PT. ESR INDONESIA HOLDINGS', 'EIH', '2023-09-02 11:07:00', '2023-09-02 11:07:00'),
(3, 'PT. ESR INDONESIA PROPERTIES ONE', 'EIPO', '2023-09-02 11:07:00', '2023-09-02 11:07:00'),
(4, 'PT. ESR INDONESIA PROPERTIES TWO', 'EIPT', '2023-09-02 11:07:00', '2023-09-02 11:07:00'),
(5, 'PT. ESR INDONESIA PROPERTIES THREE', 'EIPTh', '2023-09-02 11:07:00', '2023-09-02 11:07:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `filedns`
--

CREATE TABLE `filedns` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `debit_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `fileprs`
--

CREATE TABLE `fileprs` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_02_08_031242_create_statuses_table', 1),
(6, '2023_03_14_040422_create_whts_table', 1),
(7, '2023_03_14_140438_create_division_table', 1),
(8, '2023_03_14_141622_create_banks_table', 1),
(9, '2023_03_14_152509_create_vendors_table', 1),
(10, '2023_03_14_153437_create_payment_request_table', 1),
(11, '2023_03_14_153452_create_description_table', 1),
(12, '2023_03_28_222023_create_debit_note_table', 1),
(13, '2023_03_31_143128_create_decription_debit_table', 1),
(14, '2023_06_12_012913_create_vats_table', 1),
(15, '2023_08_21_035410_create_fileprs_table', 1),
(16, '2023_09_01_091119_create_filedns_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `payment_request`
--

CREATE TABLE `payment_request` (
  `id` bigint UNSIGNED NOT NULL,
  `invoice_date` datetime DEFAULT NULL,
  `received_date` datetime DEFAULT NULL,
  `contract` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_pr` datetime DEFAULT NULL,
  `no_pr` bigint NOT NULL DEFAULT '0',
  `id_division` bigint UNSIGNED NOT NULL,
  `for` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `due_date` bigint NOT NULL DEFAULT '0',
  `bank_charge` bigint NOT NULL DEFAULT '0',
  `currency` enum('idr','usd','sgd') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'idr',
  `vat` int NOT NULL DEFAULT '0',
  `wht_id` bigint UNSIGNED DEFAULT NULL,
  `bank_id` bigint UNSIGNED DEFAULT NULL,
  `vendor_id` bigint UNSIGNED DEFAULT NULL,
  `status_id` bigint UNSIGNED NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid_date` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `payment_request`
--

INSERT INTO `payment_request` (`id`, `invoice_date`, `received_date`, `contract`, `date_pr`, `no_pr`, `id_division`, `for`, `due_date`, `bank_charge`, `currency`, `vat`, `wht_id`, `bank_id`, `vendor_id`, `status_id`, `note`, `paid_date`, `created_at`, `updated_at`) VALUES
(1, '1998-02-04 16:26:02', '1988-04-08 05:23:02', 'V', '2023-09-01 17:40:15', 0, 3, 'Schamberger-Runolfsson', 0, 1, 'idr', 1, NULL, 3, 4, 2, NULL, NULL, '2023-09-02 11:07:01', '2023-09-02 11:07:01'),
(2, '1988-04-18 08:45:09', '1989-12-30 19:58:01', 'B', '2023-08-10 19:24:22', 1, 2, 'Harvey, Cole and Champlin', 0, 1, 'idr', 1, NULL, 14, 4, 3, NULL, NULL, '2023-09-02 11:07:01', '2023-09-02 11:07:01'),
(3, '2018-06-30 07:01:53', '2001-01-05 06:05:09', 'i', '2023-08-26 08:16:30', 2, 2, 'Pfannerstill-Prohaska', 0, 1, 'idr', 1, NULL, 6, 3, 2, NULL, NULL, '2023-09-02 11:07:02', '2023-09-02 11:07:02'),
(4, '2017-12-17 12:02:35', '2011-10-03 12:43:28', 'h', '2023-08-13 14:11:25', 3, 4, 'Brekke and Sons', 0, 1, 'idr', 1, NULL, 8, 2, 3, NULL, NULL, '2023-09-02 11:07:02', '2023-09-02 11:07:02'),
(5, '1974-04-25 05:02:42', '2009-05-23 14:38:19', 'A', '2023-08-29 07:24:43', 4, 2, 'Runolfsson LLC', 0, 1, 'idr', 1, NULL, 6, 2, 4, NULL, '2023-09-02 18:07:02', '2023-09-02 11:07:02', '2023-09-02 11:07:02'),
(6, '1983-04-19 23:35:32', '1991-09-23 18:07:39', '~', '2023-08-20 04:42:17', 5, 2, 'Kohler, Grady and Ryan', 0, 1, 'idr', 1, NULL, 2, 4, 4, NULL, '2023-09-02 18:07:02', '2023-09-02 11:07:02', '2023-09-02 11:07:02'),
(7, '1975-11-27 10:03:40', '1998-05-08 10:03:49', 'B', '2023-08-31 11:28:27', 6, 2, 'Goldner, Jacobi and Price', 0, 1, 'idr', 1, NULL, 6, 3, 4, NULL, '2023-09-02 18:07:02', '2023-09-02 11:07:02', '2023-09-02 11:07:02'),
(8, '1992-03-08 15:49:21', '1988-11-16 04:28:23', 'L', '2023-08-26 22:15:14', 7, 2, 'Berge-Strosin', 0, 1, 'idr', 1, NULL, 2, 2, 3, NULL, NULL, '2023-09-02 11:07:03', '2023-09-02 11:07:03'),
(9, '2021-07-21 12:01:16', '1996-09-16 10:04:02', 'z', '2023-08-29 06:04:01', 8, 4, 'Simonis LLC', 0, 1, 'idr', 1, NULL, 4, 1, 3, NULL, NULL, '2023-09-02 11:07:03', '2023-09-02 11:07:03'),
(10, '1974-08-27 06:31:24', '1978-03-29 11:03:17', '+', '2023-08-29 00:09:51', 9, 1, 'Kerluke-Marquardt', 0, 1, 'idr', 1, NULL, 5, 3, 1, NULL, NULL, '2023-09-02 11:07:03', '2023-09-02 11:07:03'),
(11, '2022-12-17 17:07:53', '1983-05-04 14:19:20', '4', '2023-08-26 09:08:07', 10, 4, 'Shanahan-Wilderman', 0, 1, 'idr', 1, NULL, 8, 1, 3, NULL, NULL, '2023-09-02 11:07:03', '2023-09-02 11:07:03'),
(12, '2016-12-05 06:02:39', '1981-01-15 01:17:20', 't', '2023-08-17 06:00:05', 11, 4, 'Pfannerstill-Breitenberg', 0, 1, 'idr', 1, NULL, 4, 2, 4, NULL, '2023-09-02 18:07:03', '2023-09-02 11:07:03', '2023-09-02 11:07:03'),
(13, '1976-08-06 08:52:42', '1979-11-13 00:13:42', 'y', '2023-08-13 00:42:02', 12, 4, 'Osinski-Schowalter', 0, 1, 'idr', 1, NULL, 16, 1, 2, NULL, NULL, '2023-09-02 11:07:03', '2023-09-02 11:07:03'),
(14, '2012-08-20 21:59:46', '1972-08-09 19:57:43', '3', '2023-08-06 08:59:12', 13, 1, 'Wuckert LLC', 0, 1, 'idr', 1, NULL, 5, 4, 2, NULL, NULL, '2023-09-02 11:07:04', '2023-09-02 11:07:04'),
(15, '2000-11-16 00:29:39', '1985-04-10 14:23:40', 'm', '2023-08-09 11:50:33', 14, 1, 'Heaney and Sons', 0, 1, 'idr', 1, NULL, 13, 2, 3, NULL, NULL, '2023-09-02 11:07:04', '2023-09-02 11:07:04'),
(16, '1972-04-24 17:48:44', '1985-12-16 06:34:27', 'i', '2023-08-05 17:41:32', 15, 2, 'Durgan, McDermott and Brakus', 0, 1, 'idr', 1, NULL, 6, 3, 1, NULL, NULL, '2023-09-02 11:07:04', '2023-09-02 11:07:04'),
(17, '1986-10-09 02:46:25', '2006-05-05 01:54:35', ':', '2023-08-22 00:48:43', 16, 2, 'Labadie and Sons', 0, 1, 'idr', 1, NULL, 2, 2, 3, NULL, NULL, '2023-09-02 11:07:04', '2023-09-02 11:07:04'),
(18, '1976-04-27 11:05:13', '2016-12-09 00:32:58', 'D', '2023-08-09 14:06:23', 17, 4, 'Heathcote and Sons', 0, 1, 'idr', 1, NULL, 8, 4, 1, NULL, NULL, '2023-09-02 11:07:04', '2023-09-02 11:07:04'),
(19, '2010-03-29 06:39:07', '2009-07-04 18:37:40', '1', '2023-08-04 10:16:49', 18, 2, 'Feeney LLC', 0, 1, 'idr', 1, NULL, 14, 2, 2, NULL, NULL, '2023-09-02 11:07:05', '2023-09-02 11:07:05'),
(20, '1978-05-14 14:29:13', '1991-05-23 10:28:16', 'O', '2023-08-15 03:14:32', 19, 3, 'Schiller and Sons', 0, 1, 'idr', 1, NULL, 3, 4, 4, NULL, '2023-09-02 18:07:05', '2023-09-02 11:07:05', '2023-09-02 11:07:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
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
-- Struktur dari tabel `statuses`
--

CREATE TABLE `statuses` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `statuses`
--

INSERT INTO `statuses` (`id`, `name`, `color`) VALUES
(1, 'Pending Approval', 'orange'),
(2, 'Processing', 'orange'),
(3, 'Reject', 'red'),
(4, 'Paid', 'green');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','user','supervisor') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@finance.form', NULL, '$2y$10$u48a1qHMkQ0OD4nvb7mMseBpMZOpqK28PwaDqlAyiMPaPpNW4lf8u', 'admin', NULL, '2023-09-02 11:07:01', '2023-09-02 11:07:01'),
(2, 'User', 'user@finance.form', NULL, '$2y$10$pjmyB8vcXKsljie/cDehl.xU.WakTrxM04vWQci4yjEgoaHY6R3ze', 'user', NULL, '2023-09-02 11:07:01', '2023-09-02 11:07:01'),
(3, 'supervisor', 'supervisor@finance.form', NULL, '$2y$10$s93KVGHM7K56UqWwa2thO./7Q7gJtsldidZf2cdV4it9SmqtKHjMq', 'supervisor', NULL, '2023-09-02 11:07:01', '2023-09-02 11:07:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `vats`
--

CREATE TABLE `vats` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'VAT',
  `value` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `vats`
--

INSERT INTO `vats` (`id`, `name`, `value`, `created_at`, `updated_at`) VALUES
(1, 'VAT', 11, '2023-09-02 11:07:01', '2023-09-02 11:07:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `vendors`
--

CREATE TABLE `vendors` (
  `id` bigint UNSIGNED NOT NULL,
  `beneficary` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `vendors`
--

INSERT INTO `vendors` (`id`, `beneficary`, `bank`, `detail`, `created_at`, `updated_at`) VALUES
(1, 'PT JAYA', 'BRI 1234566789', 'A', '2023-09-02 11:07:00', '2023-09-02 11:07:00'),
(2, 'PT JAYA', 'BCA 1234566789', 'B', '2023-09-02 11:07:00', '2023-09-02 11:07:00'),
(3, 'PT MAKMUR', 'BRI 1234566789', 'C', '2023-09-02 11:07:00', '2023-09-02 11:07:00'),
(4, 'PT MAKMUR', 'BNI 1234566789', 'D', '2023-09-02 11:07:00', '2023-09-02 11:07:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `whts`
--

CREATE TABLE `whts` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` double(8,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `whts`
--

INSERT INTO `whts` (`id`, `name`, `value`, `created_at`, `updated_at`) VALUES
(1, 'WHT 21', 2.00, '2023-09-02 11:07:01', '2023-09-02 11:07:01'),
(2, 'WHT 22', 3.00, '2023-09-02 11:07:01', '2023-09-02 11:07:01');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `banks_division_id_foreign` (`division_id`);

--
-- Indeks untuk tabel `debit_note`
--
ALTER TABLE `debit_note`
  ADD PRIMARY KEY (`id`),
  ADD KEY `debit_note_id_division_foreign` (`id_division`),
  ADD KEY `debit_note_wht_id_foreign` (`wht_id`),
  ADD KEY `debit_note_bank_id_foreign` (`bank_id`),
  ADD KEY `debit_note_status_id_foreign` (`status_id`);

--
-- Indeks untuk tabel `decription_debit`
--
ALTER TABLE `decription_debit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `decription_debit_id_debit_note_foreign` (`id_debit_note`);

--
-- Indeks untuk tabel `description`
--
ALTER TABLE `description`
  ADD PRIMARY KEY (`id`),
  ADD KEY `description_id_payment_request_foreign` (`id_payment_request`);

--
-- Indeks untuk tabel `division`
--
ALTER TABLE `division`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `filedns`
--
ALTER TABLE `filedns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `filedns_debit_id_foreign` (`debit_id`);

--
-- Indeks untuk tabel `fileprs`
--
ALTER TABLE `fileprs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fileprs_payment_id_foreign` (`payment_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `payment_request`
--
ALTER TABLE `payment_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_request_wht_id_foreign` (`wht_id`),
  ADD KEY `payment_request_id_division_foreign` (`id_division`),
  ADD KEY `payment_request_bank_id_foreign` (`bank_id`),
  ADD KEY `payment_request_vendor_id_foreign` (`vendor_id`),
  ADD KEY `payment_request_status_id_foreign` (`status_id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `vats`
--
ALTER TABLE `vats`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `whts`
--
ALTER TABLE `whts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `banks`
--
ALTER TABLE `banks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `debit_note`
--
ALTER TABLE `debit_note`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `decription_debit`
--
ALTER TABLE `decription_debit`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `description`
--
ALTER TABLE `description`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT untuk tabel `division`
--
ALTER TABLE `division`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `filedns`
--
ALTER TABLE `filedns`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `fileprs`
--
ALTER TABLE `fileprs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `payment_request`
--
ALTER TABLE `payment_request`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `vats`
--
ALTER TABLE `vats`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `whts`
--
ALTER TABLE `whts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `banks`
--
ALTER TABLE `banks`
  ADD CONSTRAINT `banks_division_id_foreign` FOREIGN KEY (`division_id`) REFERENCES `division` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `debit_note`
--
ALTER TABLE `debit_note`
  ADD CONSTRAINT `debit_note_bank_id_foreign` FOREIGN KEY (`bank_id`) REFERENCES `banks` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `debit_note_id_division_foreign` FOREIGN KEY (`id_division`) REFERENCES `division` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `debit_note_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `debit_note_wht_id_foreign` FOREIGN KEY (`wht_id`) REFERENCES `whts` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `decription_debit`
--
ALTER TABLE `decription_debit`
  ADD CONSTRAINT `decription_debit_id_debit_note_foreign` FOREIGN KEY (`id_debit_note`) REFERENCES `debit_note` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `description`
--
ALTER TABLE `description`
  ADD CONSTRAINT `description_id_payment_request_foreign` FOREIGN KEY (`id_payment_request`) REFERENCES `payment_request` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `filedns`
--
ALTER TABLE `filedns`
  ADD CONSTRAINT `filedns_debit_id_foreign` FOREIGN KEY (`debit_id`) REFERENCES `debit_note` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `fileprs`
--
ALTER TABLE `fileprs`
  ADD CONSTRAINT `fileprs_payment_id_foreign` FOREIGN KEY (`payment_id`) REFERENCES `payment_request` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `payment_request`
--
ALTER TABLE `payment_request`
  ADD CONSTRAINT `payment_request_bank_id_foreign` FOREIGN KEY (`bank_id`) REFERENCES `banks` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_request_id_division_foreign` FOREIGN KEY (`id_division`) REFERENCES `division` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_request_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_request_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_request_wht_id_foreign` FOREIGN KEY (`wht_id`) REFERENCES `whts` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 14, 2025 at 09:06 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eivixocp_tsabata`
--

-- --------------------------------------------------------

--
-- Table structure for table `absen`
--

CREATE TABLE `absen` (
  `id` bigint UNSIGNED NOT NULL,
  `id_guru` bigint UNSIGNED NOT NULL,
  `id_santri` bigint UNSIGNED NOT NULL,
  `status` int NOT NULL DEFAULT '0' COMMENT '0 = Belum Absen, 1 = Sudah Absen, 2 = Izin',
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `tanggal_absensi` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_guru`
--

CREATE TABLE `data_guru` (
  `id` bigint UNSIGNED NOT NULL,
  `id_grup_cabang` bigint UNSIGNED DEFAULT NULL,
  `id_grup_santri` bigint UNSIGNED DEFAULT NULL,
  `id_users` bigint UNSIGNED NOT NULL,
  `lulusan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` text COLLATE utf8mb4_unicode_ci,
  `riwayat_mengajar` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_guru`
--

INSERT INTO `data_guru` (`id`, `id_grup_cabang`, `id_grup_santri`, `id_users`, `lulusan`, `foto`, `riwayat_mengajar`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 1, NULL, NULL, NULL, '2024-12-20 18:35:12', '2024-12-20 18:35:12'),
(7, NULL, NULL, 27, NULL, NULL, NULL, '2025-02-06 04:14:47', '2025-02-06 04:14:47');

-- --------------------------------------------------------

--
-- Table structure for table `data_santri`
--

CREATE TABLE `data_santri` (
  `id` bigint UNSIGNED NOT NULL,
  `id_grup_cabang` bigint UNSIGNED NOT NULL,
  `id_grup_santri` bigint UNSIGNED NOT NULL,
  `id_grup_kelompok` bigint UNSIGNED NOT NULL,
  `no_identitas` bigint NOT NULL,
  `nama_lengkap` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `link_sertifikat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0' COMMENT '0 = Aktif, 1 = Lulus',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_santri`
--

INSERT INTO `data_santri` (`id`, `id_grup_cabang`, `id_grup_santri`, `id_grup_kelompok`, `no_identitas`, `nama_lengkap`, `alamat`, `tgl_lahir`, `jenis_kelamin`, `keterangan`, `link_sertifikat`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 3277021606170002, 'Abdul Lathif Haufanhazza Alhusayn', 'Perum. Samudera Residence Blok B 65 No. 03 A, RT 6,RW 25, , Desa/Kel. Tajur Halang, Kec. Tajurhalang, 16320', '2017-06-16', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(2, 1, 1, 1, 3201376807170002, 'ADZKIYA SYAQUILA', 'KP. KALISUREN, RT 1,RW 3, , Desa/Kel. Kalisuren, Kec. Tajurhalang, 16320', '2017-07-28', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(3, 1, 1, 1, 3204296409170001, 'Ahada Puji Alesa', 'Jl Bintaro Permai I, RT 1,RW 10, , Bintaro, Kec. Pesanggrahan, 12330', '2017-09-24', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(4, 1, 1, 1, 3173024512170004, 'ALIVIYA ATHALLA AZKAYRA', 'Samudera Residence Cluster Leopard, RT 5,RW 25, , Desa/Kel. Tajur Halang, Kec. Tajurhalang, 16320', '2017-12-05', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(5, 1, 1, 1, 3201372802180001, 'Athallah Razqa Alhanan', 'Perum Bumi Indah Pesona Blok D-37/09, RT 3,RW 16, , Kalisuren, Kec. Tajurhalang, 16313', '2018-02-28', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(6, 1, 1, 1, 1871122603180001, 'Azizan Omar Hamza', 'Perumahan Pondok Mutiara, RT 11,RW 3, , Sasak Panjang, Kec. Tajurhalang, 16320', '2018-03-26', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(7, 1, 1, 2, 3175054109170004, 'AZLEA MADA HAYU WIBOWO', 'JL. PERJUANGAN KOMPLEK PDK B.58, RT 4,RW 10, SUNYARAGI, SUNYARAGI, Kec. Kesambi, 45130', '2017-09-01', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(8, 1, 1, 2, 3201370811170002, 'Faiz Kenzie Hamizan', 'Komplek Inkopad Blok G20/07, RT 7,RW 6, , Sasak Panjang, Kec. Tajurhalang, 16320', '2017-11-08', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(9, 1, 1, 2, 3173070211170004, 'Faiz Muhammad Al Farizzi', 'Perum Alam Tajurhalang, RT 3,RW 4, , Desa/Kel. Tajur Halang, Kec. Tajurhalang, 16320', '2017-11-02', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(10, 1, 1, 2, 3201370103180003, 'Ibraheem', 'Komplek Inkopad Blok A 1 No 20, RT 1,RW 5, , Sasak Panjang, Kec. Tajurhalang, 16320', '2018-03-01', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(11, 1, 1, 2, 3201376805180001, 'Inara Ghania Fathiyyaturahma', 'Komplek Inkopad Blok A 1 No 17, RT 1,RW 5, , Sasak Panjang, Kec. Tajurhalang, 16320', '2018-05-28', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(12, 1, 1, 2, 3276080201180004, 'Khayri Sakha Asshauqi', 'Cilodong, RT 4,RW 5, , Desa/Kel. Cilodong, Kec. Cilodong, 16474', '2018-01-02', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(13, 1, 1, 2, 3201375407170001, 'Lathifa Fakhira Shakila', 'Komplek Inkopad Blok D 8 No 1, RT 18,RW 5, , Sasak Panjang, Kec. Tajurhalang, 16320', '2017-07-14', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(14, 1, 1, 3, 3275111812170004, 'Muhamad Dzaky Ma\'ali Putra Asim', 'Kp. Kalisuren, RT 1,RW 5, , Kalisuren, Kec. Tajurhalang, 16320', '2017-12-18', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(15, 1, 1, 3, 3173042509170002, 'Muhammad Abinaya Bhayusuta', 'Perum Kalisuren Paradise, RT 0,RW 0, , Kalisuren, Kec. Tajurhalang, 16320', '2017-09-25', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(16, 1, 1, 3, 3175012507180002, 'Muhammad Rylan Alimni', 'Inkopad blok d18/09, RT 19,RW 5, , Sasak Panjang, Kec. Tajurhalang, ', '2018-07-25', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(17, 1, 1, 3, 3271052906170004, 'Nabil Ibnu Madjid', 'Komplek Inkopad Blok B 7, RT 2,RW 5, , Sasak Panjang, Kec. Tajurhalang, 16320', '2017-06-29', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(18, 1, 1, 3, 3201010507170003, 'Nadhif Dzaki Attaqi', 'Perum Kinan City Residence Blok F No. 7, RT 1,RW 9, , Desa/Kel. Tengah, Kec. Cibinong, 16914', '2017-07-05', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(19, 1, 1, 3, 3201376802180001, 'Nawra Fateeha Mujahidah', 'Perum. Alam Tajurhalang Blok G/03, RT 3,RW 4, , Desa/Kel. Tajur Halang, Kec. Tajurhalang, 16320', '2018-02-28', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(20, 1, 1, 3, 3201105311170002, 'Qiana Alula Almahyra', 'Waru Jaya, RT 3,RW 1, , Warujaya, Kec. Parung, 16330', '2017-11-13', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(21, 1, 1, 4, 3201132205170004, 'Ridzwan Ardita Zahwa', 'Bukit Waringin E3/17, RT 9,RW 10, , Desa/Kel. Kedung Waringin, Kec. Bojong Gede, 16303', '2017-05-22', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(22, 1, 1, 4, 1213061408170002, 'Risky Pratama Siregar', 'KP. Bulak, RT 1,RW 6, , Kalisuren, Kec. Tajurhalang, 16320', '2017-08-14', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(23, 1, 1, 4, 3175064308180007, 'Shazana Almahira Vionania Utarto Rahman', 'Jl Sentra Primer Timur Residence K 1123 D, RT 13,RW 6, , Pulo Gebang, Kec. Cakung, ', '2018-08-03', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(24, 1, 1, 4, 6305126711170002, 'Syakila Sahidatu Sa\'diyah', 'Jl. Kartika Sejahtera, RT 0,RW 0, , Kalisuren, Kec. Tajurhalang, 16320', '2017-11-27', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(25, 1, 2, 4, 3271010309170001, 'ABID AFFAN ABYAN', 'GRIYA INTILAND ASRIBLOK E NO 9, RT 0,RW 8, KAMPUNG KARET, Desa/Kel. Tajur Halang, Kec. Tajurhalang, 16320', '2017-09-03', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(26, 1, 2, 4, 3174076401180004, 'Afiza Hanan Saputra', 'Jl. Gotong Royong, RT 12,RW 6, , Gandaria Utara, Kec. Kebayoran Baru, 12140', '2018-01-24', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(27, 1, 2, 4, 3674040210170002, 'Ahlami Kamil Priatna', 'KP Maruga Jl Raya Pamulang II, RT 1,RW 4, , Desa/Kel. Sarua, Kec. Ciputat, 15414', '2017-10-02', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(28, 1, 2, 5, 3674012306170001, 'Ahmad Sahil Rizqi Ramadhan', 'Komp. Avani, RT 5,RW 2, Ragamukti, Citayam, Kec. Tajurhalang, ', '2017-06-23', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(29, 1, 2, 5, 3174026102180001, 'Aisyah Qimora Widanti', 'Perumahan Puri Indra Kila Blok B No. 6, RT 11,RW 4, , Sasak Panjang, Kec. Tajurhalang, 16320', '2018-02-21', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(30, 1, 2, 5, 3176075105180004, 'Alleandra Nuha Lailatus Witdiyo', 'Jl Cemara 2 Sasak Panjang Permai Blok C4 No. 14, RT 7,RW 12, , Sasak Panjang, Kec. Tajurhalang, 16320', '2018-05-11', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(31, 1, 2, 5, 3674066108170004, 'Annisa Rizqiah Dania', 'Reni Jaya Jln. Sumbawa 4 Blok M-4/14, RT 2,RW 6, , Pondok Benda, Kec. Pamulang, 15434', '2017-08-21', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(32, 1, 2, 5, 3201375704170002, 'Ayesha Inayatillah Risyanova', 'Komp. Ikopad Blok G-18/04, RT 7,RW 6, , Sasak Panjang, Kec. Tajurhalang, 16320', '2017-04-17', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(34, 1, 2, 5, 3174072004170003, 'Azzam Mahasin Achmad', 'JL H Syahrin No 26A, RT 9,RW 1, , Gandaria Utara, Kec. Kebayoran Baru, 12140', '2017-04-20', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(35, 1, 2, 6, 3173012012170016, 'ILYAS AR RASYIID NASUTION', 'PERUMAHAN GRANDWOOD RESIDENCE, RT 1,RW 1, , Kalisuren, Kec. Tajurhalang, 16320', '2017-12-20', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(36, 1, 2, 6, 3174104612170004, 'KEENAR ANSYARI MUMTAZAH', 'PERUMAHAN AMARTHA RESIDENCE BLOK B6, RT 0,RW 0, , Desa/Kel. Sasak Panjang, Kec. Tajurhalang, 16320', '2017-12-06', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(37, 1, 2, 6, 3276101112170007, 'KEVIN RASYA ATHARIZZ', 'PARUNG PERMATA INDAH, RT 6,RW 11, , KALISUREN, Kec. Tajurhalang, 16320', '2017-12-11', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(38, 1, 2, 6, 3201374308170001, 'Kinanti Ayu Putri Kunteyadji', 'Komplek Inkopad, RT 5,RW 1, , Desa/Kel. Sasak Panjang, Kec. Tajurhalang, 16320', '2017-08-03', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(39, 1, 2, 6, 3271030405180004, 'MOCHAMAD FARREL HAMIZAN', 'ISLAMIC GRANDVILLAGE BLOK MINA I NO. 27, RT 0,RW 0, , Kalisuren, Kec. Tajurhalang, 16320', '2018-05-04', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(40, 1, 2, 6, 3201370502180005, 'Muhammad Fahrezi Al Faruq', 'Perum. Alam Hijau Parung Blok Alamanda 7/12, RT 3,RW 4, , Kalisuren, Kec. Tajurhalang, 16320', '2018-02-05', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(41, 1, 2, 6, 3276051508170002, 'Muhammad Sulthan Kasyaf AlHabsyi', 'Komplek Inkopad Blok G 8 No. 24, RT 3,RW 6, , Sasak Panjang, Kec. Tajurhalang, 16320', '2017-08-15', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(42, 1, 2, 7, 3175096503170002, 'Naora Zakiya Kamilah', 'JL.Arco Raya, Benzema Residence 2 Blok A10, RT 7,RW 2, , Citayam, Kec. Tajurhalang, ', '2017-03-25', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(43, 1, 2, 7, 3216060311170001, 'Natan Al Fatih', 'Griya Mulia D 1, RT 1,RW 2, , Desa/Kel. Tajur Halang, Kec. Tajurhalang, 16320', '2017-11-03', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(44, 1, 2, 7, 3201376410170002, 'Raisya Putri Almahyra', 'Komplek Inkopad Blok L 10 No 10, RT 10,RW 7, , Sasak Panjang, Kec. Tajurhalang, 16320', '2017-10-24', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(45, 1, 2, 7, 3201377009170002, 'Rania Alesha Putriani', 'Komplek Inkopad Blok F 15 No. 11, RT 14,RW 5, , Sasak Panjang, Kec. Tajurhalang, 16320', '2017-09-30', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(46, 1, 2, 7, 3307091811170003, 'Rifat Haidar Mukti', 'Perum. Samasta Citayam Blok F-02, RT 4,RW 4, , Citayam, Kec. Tajurhalang, 16320', '2017-11-18', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(47, 1, 2, 7, 3201376105180001, 'Sybilla Aleisya Nugroho', 'Komplek Inkopad Blok G 1 No 05, RT 2,RW 6, , Sasak Panjang, Kec. Tajurhalang, 16320', '2018-05-21', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(48, 1, 3, 7, 3603231308170001, 'Aditya Zafran', 'Perum Samudera Residence Blok B-40/08, RT 7,RW 0, , Desa/Kel. Tajur Halang, Kec. Tajurhalang, 16320', '2017-08-13', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(49, 1, 3, 8, 3208261311170001, 'Akmal Abdul Faqih', 'Perum. De Paris Residence Blok C2 No. 18, RT 5,RW 5, Kalisuren, Kalisuren, Kec. Tajurhalang, 16320', '2017-11-13', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(50, 1, 3, 8, 3173076103180006, 'Alifiya Khansa Humaira', 'Jl. Palmerah Utara, RT 11,RW 4, , Desa/Kel. Palmerah, Kec. Palmerah, ', '2018-03-21', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(51, 1, 3, 8, 3201374906170003, 'Arsyila Alfathunissa', 'Komplek Inkopad Blok J8 No 6 B, RT 15,RW 6, , Sasak Panjang, Kec. Tajurhalang, 16320', '2017-06-09', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(52, 1, 3, 8, 3171012403170001, 'AZMI GHIFARI AL FARIZQI', 'PURA BOJONG GEDE BLOK G5/10, RT 2,RW 14, , Desa/Kel. Tajur Halang, Kec. Tajurhalang, ', '2017-03-24', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(53, 1, 3, 8, 3174072102170001, 'CHEVA AQIL PUTRA', 'Komplek INKOPAD Blok E4 No.8, RT 6,RW 5, SASAKPANJANG, Desa/Kel. Sasak Panjang, Kec. Tajurhalang, 16320', '2017-02-21', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(54, 1, 3, 8, 3201376302170002, 'Fazeela Yuka Millyadiana', 'Parung Permata Indah, RT 12,RW 6, , Kalisuren, Kec. Tajurhalang, 16320', '2017-02-23', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(55, 1, 3, 8, 3201371912170002, 'Galang Raffasya Valerio Chifo', 'Komp. Inkopad Blok L-1/01, RT 1,RW 7, , Sasak Panjang, Kec. Tajurhalang, 16320', '2017-12-19', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(56, 1, 3, 9, 3175034501170003, 'Haisha Hanum Hanania', 'Perumahan Graha Bumi Indah Nusantara Jl.Kepodang Blok E No 3, RT 0,RW 0, , Kalisuren, Kec. Tajurhalang, 16320', '2017-01-05', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(57, 1, 3, 9, 3201375105180004, 'Keisya Nayyara Ananditya', 'Samasta Citayam Blok A 11, RT 4,RW 4, , Citayam, Kec. Tajurhalang, 16320', '2018-05-11', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(58, 1, 3, 9, 3201265106180002, 'Kenzie Xavier Ramadhan', 'BIP Blok D 36 No 23, RT 3,RW 16, , Kalisuren, Kec. Tajurhalang, ', '2018-06-11', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(59, 1, 3, 9, 3276031507170005, 'KENZIO RAFAEZA SHAKEEL', 'PERUM DE PARIS RESIDENCE BLOK D2 NO.4, RT 0,RW 0, , Desa/Kel. Kalisuren, Kec. Tajurhalang, 16320', '2017-07-15', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(60, 1, 3, 9, 1806262105180001, 'Mokhammad As Syahmi Ramadhan', 'KPR. Swakelola Blok D No. 3, RT 1,RW 6, , Desa/Kel. Tajur Halang, Kec. Tajurhalang, 16320', '2018-05-21', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(61, 1, 3, 9, 3201376810170001, 'Nafeeza Salsabila Alhusaeni', 'Kampun Utan, RT 2,RW 7, , Kalisuren, Kec. Tajurhalang, 16320', '2017-10-28', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(62, 1, 3, 9, 3312124903180001, 'Namira Alisya Frisca Awanda', 'Perumahan Deparis Residen Jalan Daun Akasia VI Blok A 11 No 12, RT 0,RW 0, , Kalisuren, Kec. Tajurhalang, 16320', '2018-03-09', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(63, 1, 3, 10, 3201370407180001, 'NARESWARA DEFFINIKA KHAWARIZMI', 'PONDOK MUTIARA BLOK G3/11, RT 5,RW 11, , Desa/Kel. Sasak Panjang, Kec. Tajurhalang, 16318', '2018-07-04', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(64, 1, 3, 10, 3175093004170005, 'Nathaan Darmawan Syabani', 'Jl. Cibubur VIII, RT 2,RW 9, , Cibubur, Kec. Ciracas, 13720', '2017-04-30', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(65, 1, 3, 10, 3276024902180005, 'Nayara Edrea Nurcahyo', 'Bumi Citra Asri Blok B 5 No. 11, RT 0,RW 0, , Desa/Kel. Tonjong, Kec. Tajurhalang, ', '2018-02-09', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(66, 1, 3, 10, 3201371707170006, 'Raffasya Arfan Mahardika', 'Komplek Inkopad Blok J-2/22, RT 17,RW 6, , Sasak Panjang, Kec. Tajurhalang, 16320', '2017-07-17', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(67, 1, 3, 10, 3671065203180001, 'Ratusya Sherina Ghani', 'Perum. De Paris Residence jl. daun salam 8 Blok C20 no. 19, RT 0,RW 0, Kalisuren, Kalisuren, Kec. Tajurhalang, 16320', '2018-03-12', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(68, 1, 3, 10, 3201372511160001, 'RAYHAN ABDUL HAFIZ', 'PERUM BUMI INDAH PESONA BLOK A-25/01, RT 5,RW 13, , Desa/Kel. Kalisuren, Kec. Tajurhalang, ', '2016-11-25', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(69, 1, 3, 10, 3674066812170012, 'SYAHIRA AZKADINA SHANUM', 'Jl. Swadaya Parakan No. 17, RT 4,RW 8, , Pondok Benda, Kec. Pamulang, 15434', '2017-12-28', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(70, 1, 3, 11, 1471016811170001, 'Zahra Althafunnisa', 'Perum Permata Arco Residence Blok A No. 8, RT 0,RW 0, , Desa/Kel. Tajur Halang, Kec. Tajurhalang, 16320', '2017-11-28', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(71, 1, 4, 11, 3201372302170003, 'Abil Hasan Al Wiro\'ie', 'Kalisuren gang apotek ashila, RT 2,RW 5, , Kalisuren, Kec. Tajurhalang, 16320', '2017-02-23', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(72, 1, 4, 11, 3201370907170001, 'Arsen Maulana Shidqi', 'Komplek Sarana Indah Residen, RT 3,RW 3, , Kalisuren, Kec. Tajurhalang, 16320', '2017-07-09', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(73, 1, 4, 11, 3201206306180001, 'Ashilla Qiana Zahra Febriani', 'Perum. Citra Kalisuren Indah Blok F no. 23, RT 1,RW 4, Kalisuren, Kalisuren, Kec. Tajurhalang, 16320', '2018-06-23', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(74, 1, 4, 11, 3323035811170002, 'Assyifa Adreena Syazfa', 'Jl Jendral Sudirman No. 88 B, RT 1,RW 6, , Jampirejo, Kec. Temanggung, 56215', '2017-11-18', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(75, 1, 4, 11, 3201376305170005, 'Attaya Kinara Rudiansyah', 'Green Terraces Blok B 1 No 7, RT 2,RW 5, , Kalisuren, Kec. Tajurhalang, 16320', '2017-05-23', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(76, 1, 4, 11, 3174056002180002, 'Azrha Ghaida Athalla', 'Samudera Residence, RT 6,RW 25, , Tajur Halang, Kec. Tajurhalang, 16320', '2018-02-20', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(77, 1, 4, 12, 3201376304170002, 'Danisha Hikari Thio', 'Komplek Inkopad Blok D 8, RT 18,RW 5, , Sasak Panjang, Kec. Tajurhalang, 16320', '2017-04-23', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(78, 1, 4, 12, 3201135704180005, 'Ghaitsa Saqeena Rijaludin', 'Pondok Bambu Kuning G 3/1, RT 9,RW 14, , Desa/Kel. Bojong Gede, Kec. Bojong Gede, ', '2018-04-17', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(79, 1, 4, 12, 3201370201180002, 'Ghifari Rasyid Alhanan', 'Komplek Inkopad Blok D 3 No.13, RT 4,RW 5, , Sasak Panjang, Kec. Tajurhalang, 16320', '2018-01-02', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(80, 1, 4, 12, 3201374401180002, 'Hana Afiqa Rahma', 'Perum Sasak Panjang Permai Blok G-5A/35, RT 5,RW 12, , Sasak Panjang, Kec. Tajurhalang, 16320', '2018-01-04', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(81, 1, 4, 12, 3175102804170016, 'Muhammad Azzami Alvaro Musyaffa', 'Komplek Inkopad Blok Q 5 No. 11, RT 0,RW 0, , Sasak Panjang, Kec. Tajurhalang, 16320', '2017-04-28', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(82, 1, 4, 12, 3201371409170001, 'Muhammad Faizulhaq Jamal', 'Komplek Inkopad Blok A 3 No. 8, RT 1,RW 5, , Sasak Panjang, Kec. Tajurhalang, 16320', '2017-09-14', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(83, 1, 4, 12, 3174020709170001, 'Muhammad Gibran Algiffari', 'Jl. Menteng Rawa Panjang, RT 1,RW 6, , Menteng Atas, Kec. Setia Budi, 12960', '2017-09-07', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(84, 1, 4, 13, 3201372707170005, 'MUHAMMAD SYAFIQ', 'PERUM GRIYA KALISUREN BLOK B-1/13, RT 2,RW 14, , Kalisuren, Kec. Tajurhalang, 16320', '2017-07-27', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(85, 1, 4, 13, 3174041809170011, 'Muhammad Urwah Bassam Absana', 'Perumahan De Green Teracces Kalisuren Blok A 4 No.12, RT 0,RW 0, , Kalisuren, Kec. Tajurhalang, 16320', '2017-09-18', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(86, 1, 4, 13, 3259490000000000, 'Noushafarin Zia Latif', 'Jl. Bali Paradise Blok A 4 No 18, RT 0,RW 0, , Kalisuren, Kec. Tajurhalang, 16320', '2017-12-27', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(87, 1, 4, 13, 3276030804180001, 'Raffasya Shazad Irawan', 'Jl. Mangga, RT 2,RW 11, Kadaung, Desa/Kel. Kedaung, Kec. Sawangan, 16516', '2018-04-08', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(88, 1, 4, 13, 3201373004180001, 'REINO AL ZAIDAN', 'KP. KALISUREN, RT 1,RW 5, , Desa/Kel. Kalisuren, Kec. Tajurhalang, 16320', '2018-04-30', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(89, 1, 4, 13, 3674055801180002, 'Sakha Inara Basyuni', 'Perum. Alam Hijau Parung Bougenville 2 No. 16, RT 0,RW 0, , Kalisuren, Kec. Tajurhalang, 16320', '2018-01-18', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(90, 1, 4, 13, 3674014710170003, 'Shazia Qaireen Nata atmadja', 'Komp. Avani Garden, RT 6,RW 2, Citayam, Citayam, Kec. Tajurhalang, 16305', '2017-10-07', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(91, 1, 4, 14, 3277034305180002, 'Syafira Athalia Fadlillah Faber', 'Jl. AMD Sentra Tajurhalang, RT 1,RW 12, , Desa/Kel. Tajur Halang, Kec. Tajurhalang, 16320', '2018-05-03', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(92, 1, 4, 14, 3201010204170005, 'SYERKHAN AL GHAZALI', 'PERUMAHAN NINGS RESIDENCE BLOK K NO 16, RT 3,RW 1, , Kalisuren, Kec. Tajurhalang, 16317', '2017-04-02', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(93, 1, 4, 14, 3276094908170001, 'Zivana Adzkia Praditya', 'Perum. Avani Garden, RT 6,RW 2, Citayam, Desa/Kel. Tajur Halang, Kec. Tajurhalang, 16320', '2017-08-09', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(94, 2, 5, 14, 3674030311160001, 'Afham Faeyza Sudarmanto', 'Samudera Residence Cluster Rainbow B67 No. 10, RT 6,RW 25, , Tajur Halang, Kec. Tajurhalang, ', '2016-11-03', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(95, 2, 5, 14, 3201372910160001, 'Afnan Fadil Alam', 'Deparis Residence Blok B29 No. 2, RT 3,RW 5, , Kalisuren, Kec. Tajurhalang, ', '2016-10-29', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(96, 2, 5, 14, 3173074307160002, 'Afsheen Almas Saef', 'Nyiur Mekar Residence Blok F8, RT 0,RW 0, , Sasak Panjang, Kec. Tajurhalang, ', '2016-07-03', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(97, 2, 5, 14, 3175026501170004, 'AISYAH NUR ALIFA HAKIM', 'PERUM NING\'S RESIDENCE BLOK K-15, RT 0,RW 0, , KALISUREN, Kec. Tajurhalang, 16320', '2017-01-25', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(98, 2, 5, 15, 3276105103160007, 'Al Khansa Nashron Aziiza', 'Perum Samudera Residence Cluster rainbow, RT 6,RW 25, , Desa/Kel. Tajur Halang, Kec. Tajurhalang, ', '2016-03-11', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(99, 2, 5, 15, 3273186705170001, 'Anindia Keisha Ramadhani', 'Kampung Utan, RT 0,RW 0, , Kalisuren, Kec. Tajurhalang, ', '2017-05-27', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(100, 2, 5, 15, 3674030708160003, 'Arkha Tsani Athalla', 'Komp. Avani, RT 5,RW 2, Komp. Avani, Citayam, Kec. Tajurhalang, ', '2016-08-07', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(101, 2, 5, 15, 3201374103170001, 'Arsyila Romeesa Riswanto', 'Jl. Perum D\'Phaniisan 1 C No 4, RT 4,RW 1, , Kalisuren, Kec. Tajurhalang, 16320', '2017-03-01', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(102, 2, 5, 15, 3674056908160001, 'Dhifaf Ellard Syauqiyya', 'Deparis Residence Blok A 16 No 22, RT 4,RW 5, , Kalisuren, Kec. Tajurhalang, 16320', '2016-08-26', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(103, 2, 5, 15, 3278055609160008, 'Earlyta Khaira Wilda', 'Pesona Ciputih Blok E8 No. 12, RT 0,RW 0, , Sukamulya, Kec. Rumpin, ', '2016-09-16', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(104, 2, 5, 15, 3174073108160002, 'FAIREL ATHARIZZ PRANANTO', 'Perum Alam Hijau Blok Amanda 4 No. 11, RT 3,RW 4, Kalisuren, Kalisuren, Kec. Tajurhalang, 16320', '2016-08-31', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(105, 2, 5, 16, 3201374908160001, 'Fairuuz Hasnaa Qadriyyah', 'Komplek Inkopad Blok G20/07, RT 6,RW 7, , Sasak Panjang, Kec. Tajurhalang, ', '2016-08-09', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(106, 2, 5, 16, 3201370507160001, 'Haidar Ikramul Athalla Wibowo', 'Komplek Inkopad Blok F 9/12, RT 13,RW 5, , Kalisuren, Kec. Tajurhalang, ', '2016-07-05', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(107, 2, 5, 16, 3275085809160003, 'IFTINA ASSYABIYA RAFIFA', 'PERUM SAMUDERA RESIDENCE CLUSTER RAINBOW B62/7, RT 6,RW 25, , TAJURHALANG, Kec. Tajurhalang, 16317', '2016-09-18', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(108, 2, 5, 16, 3201376208160003, 'Ines Larasati', 'Komplek Inkopad Blok B4 / 21, RT 9,RW 5, , Sasak Panjang, Kec. Tajurhalang, ', '2016-08-22', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(109, 2, 5, 16, 3174046704170012, 'Keyli Alesha Yasmin', 'Deparis Residence Blok A10 No. 8, RT 2,RW 0, , Kalisuren, Kec. Tajurhalang, ', '2017-04-27', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(110, 2, 5, 16, 3201374801170003, 'Khayla Maisa Rinjani', 'Komplek Inkopad Blok B 2 No 10, RT 2,RW 5, , Sasak Panjang, Kec. Tajurhalang, 16320', '2017-01-08', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(111, 2, 5, 16, 3172045803170004, 'MAFAZA GHAIDA MUDHIA', 'PERUM DE PARIS RESIDENCE BLOK B5/17, RT 0,RW 0, , Desa/Kel. Kalisuren, Kec. Tajurhalang, 16315', '2017-03-18', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(112, 2, 5, 17, 3201370110160001, 'Muhammad Rafa alfarizi', 'Komplek Inkopad Blok F 21/8, RT 11,RW 5, , Sasak Panjang, Kec. Tajurhalang, ', '2016-10-01', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(113, 2, 5, 17, 3201371308160001, 'Muhammad Zainul Khusna', 'Perum Permata Lebakwangi blok f no.6, RT 0,RW 0, , Pamager Sari, Kec. Parung, ', '2016-08-13', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(114, 2, 5, 17, 3201374906170002, 'QUEENSHA ALMAHYRA NUGROHO', 'KOMP. INKOPAD BLOK F-22/16, RT 11,RW 5, , Desa/Kel. Sasak Panjang, Kec. Tajurhalang, 16320', '2017-06-09', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(115, 2, 5, 17, 3201371905170001, 'Salman Tufayl Abqary', 'Komplek Inkopad Blok F 18 No 1, RT 14,RW 5, , Sasak Panjang, Kec. Tajurhalang, 16320', '2017-05-19', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(116, 2, 5, 17, 3174076809151001, 'Salvina Azalia Achmad', 'Deparis 2 By Avani Residence Blok F3, RT 0,RW 0, , Kalisuren, Kec. Tajurhalang, ', '2015-09-28', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(117, 2, 5, 17, 3175072202170002, 'Sean Arzaquna Pratama', 'Perum. De Paris 2 residence jl. kalisuren 3 Blok F no. 4, RT 0,RW 0, , Kalisuren, Kec. Tajurhalang, 16320', '2017-02-22', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(118, 2, 6, 17, 3603280908160002, 'Ahmad Azzam Al Arkan', 'Perum Graha Permata Cikupa Blok I No. 10, RT 2,RW 6, , Ciakar, Kec. Panongan, ', '2016-08-09', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(119, 2, 6, 18, 3271016505160002, 'Aisyah Ayudya Inara Lubis', 'Jalan Raya Inkopad, RT 1,RW 7, , Sasak Panjang, Kec. Tajurhalang, ', '2016-05-25', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(120, 2, 6, 18, 3174066012150006, 'Alesya Sabrina Ahlami', 'Grand Mutiara Nanggerang, RT 6,RW 5, , Kalisuren, Kec. Tajurhalang, 16320', '2015-12-20', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(121, 2, 6, 18, 3201377011160003, 'ALMAIDA NURUL AINI', 'GRIYA KALISUREN ASRI BLOK D4 NO 3, RT 3,RW 15, , KALISUREN, Kec. Tajurhalang, 16318', '2016-11-30', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(122, 2, 6, 18, 3201374311160001, 'ANBIYAA NALADHIPA SETIAWAN', 'Komp. Inkopad Blok C9/C4, RT 2,RW 6, , Sasak Panjang, Kec. Tajurhalang, 16320', '2016-11-03', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(123, 2, 6, 18, 3201374501170001, 'Asya Ardenia Hertanto', 'Komplek Inkopad Blok K 7 No 13, RT 16,RW 6, , Sasak Panjang, Kec. Tajurhalang, 16320', '2017-01-05', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(124, 2, 6, 18, 3206060308160002, 'Athariz Mahesa Santana', 'Perum Samasta Citayam Blok B-17, RT 4,RW 4, Citayam, Citayam, Kec. Tajurhalang, ', '2016-08-03', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(125, 2, 6, 18, 3174057005160013, 'Azeema Meccayla Abimanyu', 'De Paris Residence 2 C10, RT 0,RW 0, , Kalisuren, Kec. Tajurhalang, 16320', '2016-05-30', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(126, 2, 6, 19, 3201376603170002, 'Ciella Zahira Rinjaya', 'Komplek Inkopad Blok G26/10, RT 0,RW 0, , Sasakpanjang, Kec. Tajurhalang, ', '2017-03-26', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(127, 2, 6, 19, 3404110510160002, 'Fatih Arsyad Kesuma', 'Palm Pavilion 2 No A3 Jln. Raya Arco, RT 1,RW 2, , Citayam, Kec. Tajurhalang, 16320', '2016-10-05', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(128, 2, 6, 19, 3201375111160002, 'Hani Safa Humaira', 'Komplek Inkopad Blok F30 No. 01, RT 2,RW 6, , Sasak Panjang, Kec. Tajurhalang, ', '2016-11-11', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(129, 2, 6, 19, 3201372309160001, 'Khair Rayyan Permana', 'Perum. De Paris 2 by Avani Residence Blok E4, RT 3,RW 5, , Kalisuren, Kec. Tajurhalang, 16320', '2016-09-23', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(130, 2, 6, 19, 3175081410160006, 'Laiv Dzuhairi Perdana', 'Parung Permata Indah, RT 3,RW 12, , Kalisuren, Kec. Tajurhalang, 16320', '2016-10-14', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(131, 2, 6, 19, 3175104403170007, 'Laqueenza Shazfa Amrielda', 'Jl. Puri Sawangan Residence Blok A 2 No14, RT 5,RW 2, , Citayam, Kec. Tajurhalang, ', '2017-03-04', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(132, 2, 6, 19, 3276055706170006, 'Malika Izzaty Ramadhania', 'JL.Arco Raya No.161 Benzema Residence II B7, RT 0,RW 0, , Citayam, Kec. Tajurhalang, ', '2017-06-17', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(133, 2, 6, 20, 3201100605160002, 'MUHAMMAD ABQORIY TAUFIQ', 'JL. GRAHA ANGSANA .NO 6, RT 4,RW 20, GRAHA MARGAASIH, LAGADAR, Kec. Margaasih, 40212', '2016-05-06', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(134, 2, 6, 20, 3215130701160001, 'Muhammad Al-Mafatih Nasution', 'Samudera Residence, RT 6,RW 25, , Desa/Kel. Tajur Halang, Kec. Tajurhalang, ', '2016-01-07', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(135, 2, 6, 20, 3174020401170004, 'Muhammad Arkhan Keenan', 'Benzema Residence 2 Blok B5 Jl. Arco Raya, RT 7,RW 2, , Citayam, Kec. Tajurhalang, 16320', '2017-01-04', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(136, 2, 6, 20, 3201372203160002, 'Muhammad Farid', 'Sasak Panjang, RT 4,RW 8, , Desa/Kel. Tajur Halang, Kec. Tajurhalang, ', '2016-03-22', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(137, 2, 6, 20, 3202132705160001, 'Naufal Amanullah', 'Kp. Sudimampir, RT 3,RW 2, , Desa/Kel. Cimanggis, Kec. Bojong Gede, ', '2016-05-27', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(138, 2, 6, 20, 3202226612160002, 'PUTRI AUNA MAKKULAWA', 'Komplek Alam Hijau Parung, RT 4,RW 4, , Kalisuren, Kec. Tajurhalang, ', '2016-12-26', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(139, 2, 6, 20, 3174077006160001, 'RAMADHANI CALISTA NUGRAHA', 'Perumahan Pondok Mutiara No. 15 Blok G 1, RT 5,RW 11, , Sasak Panjang, Kec. Tajurhalang, ', '2016-06-30', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(140, 2, 6, 21, 3174052907170002, 'Salman Al-Farizy Maulana', 'Parung Permata Indah Blok C1 No. 17, RT 3,RW 12, , Kalisuren, Kec. Tajurhalang, ', '2017-07-29', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(141, 2, 6, 21, 3271056810160003, 'SENJA SHAKILA FAUZY', 'Tanah Baru No. 57, RT 0,RW 4, , Desa/Kel. Tanahbaru, Kec. Kota Bogor Utara, 16320', '2016-10-28', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(142, 2, 6, 21, 3174072312160001, 'Sultan Muhammad Al-Fatih', 'Perum. Puri Sawangan Residence Blok A2 No. 4, RT 5,RW 4, , Citayam, Kec. Tajurhalang, 16320', '2016-12-23', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(143, 2, 7, 21, 3174035310160005, 'ADISTY INARA ROHIMAN', 'Perum. Samudra Residence Cluster Neontetra Blok B-4/11, RT 7,RW 2, , Desa/Kel. Tajur Halang, Kec. Tajurhalang, 16320', '2016-10-13', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(144, 2, 7, 21, 3671136702170001, 'ALFIYAH KHOERO INSAN', 'DEPARIS RESIDENCE BLOK A22 NO 2, RT 0,RW 0, , KALISUREN, Kec. Tajurhalang, ', '2017-02-27', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(145, 2, 7, 21, 3175064807170010, 'Alifa Inara Daulay', 'Perum. Square Garden No. B12 Kalisuren, RT 0,RW 0, , Kalisuren, Kec. Tajurhalang, 16320', '2017-07-08', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(146, 2, 7, 21, 3201375805160001, 'AQUINA SHAQILA ALMAHYRA FIRDAUS', 'Perum PPI Blok F4 Nomor 01, RT 1,RW 7, , Kalisuren, Kec. Tajurhalang, ', '2016-05-18', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(147, 2, 7, 22, 3174055208160006, 'Arshyla Salsabila Agustiawan', 'Deparis Residence Jl. Akasia 2 Blok A 8 No 26, RT 0,RW 0, , Kalisuren, Kec. Tajurhalang, 16320', '2016-08-12', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(148, 2, 7, 22, 3175081107160003, 'Avraya Al Zafran Yudistira', 'Komplek Inkopad Blok B10 No. 07, RT 10,RW 5, , Sasak Panjang, Kec. Tajurhalang, ', '2016-07-11', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(149, 2, 7, 22, 3201374510160001, 'Ayra Callista Putri', 'Kampung Tajurhalang, RT 3,RW 4, , Desa/Kel. Tajur Halang, Kec. Tajurhalang, ', '2016-10-05', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(150, 2, 7, 22, 3671065106160001, 'FAIZA KHANSA AZZALFA', 'Perum Samasta Citayam, RT 4,RW 6, , Citayam, Kec. Tajurhalang, ', '2016-06-11', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(151, 2, 7, 22, 3276055308160007, 'FELISHA ADARA GUSTAMAN', 'PERUM INKOPAD SWAKELOLA BLOK D5, RT 0,RW 0, , KALISUREN, Kec. Tajurhalang, 16320', '2016-08-13', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(152, 2, 7, 22, 3205111112160001, 'GHAZY ALFARIZY AS\'ADI RAHMAN', 'PERUM. GRIYA INTILAND ASRI, RT 0,RW 0, , SASAKPANJANG, Kec. Tajurhalang, 16320', '2016-12-11', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(153, 2, 7, 22, 3276064812160005, 'Jasyiyah Ahditia Uma', 'Komplek Inkopad Blok B1, RT 2,RW 5, , Sasak Panjang, Kec. Tajurhalang, 16320', '2016-12-08', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(154, 2, 7, 23, 3201373105170003, 'Mahesa Ramadhan Pamungkas', 'Komplek Inkopad Blok E3 No. 1, RT 6,RW 5, , Sasak Panjang, Kec. Tajurhalang, ', '2017-05-31', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(155, 2, 7, 23, 3201371012160002, 'Muhammad Kamil Rasyiqul', 'Komplek Inkopad Blok A 1 No 18, RT 1,RW 5, , Sasak Panjang, Kec. Tajurhalang, 16320', '2016-12-10', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(156, 2, 7, 23, 3201371306170003, 'MUHAMMAD KAZUHIKO', 'PERUM DE PARIS RESIDENCE BLOK C 10/30, RT 0,RW 0, , Desa/Kel. Kalisuren, Kec. Tajurhalang, 16320', '2017-06-13', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(157, 2, 7, 23, 3174050107171008, 'Muhammad Shaquille Arrazka', 'Jl. HJ Kathong Griya Labana, RT 1,RW 2, , Kalisuren, Kec. Tajurhalang, 16320', '2017-07-01', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(158, 2, 7, 23, 3201372702160001, 'Muhammad Syafiq Albendry', 'Komplek Inkopad Blok B 7 No 28, RT 2,RW 5, , Sasak Panjang, Kec. Tajurhalang, 16320', '2016-02-27', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(159, 2, 7, 23, 3175092106170005, 'MUHAMMAD SYAKIR HANIF', 'GRIYA KALISUREN ASRI BLOK E2 NO 19, RT 2,RW 15, , KALISUREN, Kec. Tajurhalang, 16320', '2017-06-21', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(160, 2, 7, 23, 3201372207170001, 'Qaishar Kahfi Johari', 'Perum. Nings Residence Blok N/ No 04, RT 3,RW 1, , Kalisuren, Kec. Tajurhalang, 16320', '2017-07-22', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(161, 2, 7, 24, 3201080406170001, 'Ramadhan Sakhi Ar Rayyan', 'Perumahan Samasta Citayam Blok K No. 6, RT 0,RW 0, , Citayam, Kec. Tajurhalang, 16320', '2017-06-04', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(162, 2, 7, 24, 3276034807170002, 'RULLITA MASHEL ARETHA FARZANA', 'Komplek Inkopad, RT 17,RW 6, , Sasak Panjang, Kec. Tajurhalang, ', '2017-07-08', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(163, 2, 7, 24, 3174071701170001, 'Sakha Khalif Ar Azzam', 'Jl. Green Tajur Village Blok A 10, RT 0,RW 0, , Kalisuren, Kec. Tajurhalang, 16320', '2017-01-17', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(164, 2, 7, 24, 3201376609160002, 'SHANUM VARISHA ADIFA', 'Deparis Residence Blok C 27 No. 12, RT 0,RW 0, , KALISUREN, Kec. Tajurhalang, ', '2016-09-26', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(165, 2, 7, 24, 3173072411160004, 'Sultan Attalah Agustin', 'Kampung Bulak, RT 6,RW 2, , Kalisuren, Kec. Tajurhalang, 16320', '2016-11-24', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(166, 2, 7, 24, 3201374511160004, 'TSARA ANINDIA IRAWAN', 'PERUM ALAM PARUNG HIJAU BLOK ANGGREK NO.25, RT 0,RW 0, , KALISUREN, Kec. Tajurhalang, 16320', '2016-11-05', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(167, 2, 7, 24, 3276066111160004, 'Zalfa Naadhira Anugerah', 'Jl. H Asmawi Gg. Sukun, RT 3,RW 15, , Desa/Kel. Beji, Kec. Beji, 16320', '2016-11-21', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(168, 3, 8, 25, 3173055409151005, 'ABIYYAH NURQORIROH MUFIDHAH', 'Casa Magnolia Blok D3, RT 7,RW 3, , Tajur Halang, Kec. Tajurhalang, 16320', '2015-09-14', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(169, 3, 8, 25, 3201371511150002, 'Abizar Bagaskara', 'Komplek Inkopad Blok R 2 No 15, RT 5,RW 7, , Sasak Panjang, Kec. Tajurhalang, 16320', '2015-11-15', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(170, 3, 8, 25, 3201372611150001, 'AHMAD QUTUZ', 'Griya Kalisuren Asri, RT 1,RW 15, , Kalisuren, Kec. Tajurhalang, 16320', '2015-11-26', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(171, 3, 8, 25, 3201374902160001, 'AISHA HANUM PRAMUDITA', 'PURI BUKIT DEPOK BLOK G-3/16, RT 0,RW 0, , Desa/Kel. Tajur Halang, Kec. Tajurhalang, ', '2016-02-09', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(172, 3, 8, 25, 3315101007150002, 'ALBIA LINGAR RAMADHAN', 'Jl. Kampung Bulu, Perum. Samasta Citayam Blok D6, RT 0,RW 0, SODO, Citayam, Kec. Tajurhalang, ', '2015-07-10', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(173, 3, 8, 25, 3173086910151005, 'ALESHA AINUN NAHDA', 'Jln. Cherry Komplek De Paris Residence Blok C25 No. 24, RT 4,RW 3, , Kalisuren, Kec. Tajurhalang, 16320', '2015-10-29', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(174, 3, 8, 25, 3674040109151002, 'Alifiandra Hamizan Priatna', 'Amarta Residence Blok D3 No 9, RT 0,RW 0, , Kalisuren, Kec. Tajurhalang, ', '2015-09-01', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(175, 3, 8, 26, 3175064605160010, 'Amanda Zhafira Adeeva Setiawan', 'Perumahan samasta Citayam Jl.Kampung Bulu, RT 4,RW 4, , Kampung Bulu, Kec. Tajurhalang, 16320', '2016-05-06', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(176, 3, 8, 26, 3174066012150003, 'AQILLA AULIDYA HARYANTO', 'Perum De Paris Residence Blok C4/3, RT 0,RW 0, , Kalisuren, Kec. Tajurhalang, 16320', '2015-12-20', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(177, 3, 8, 26, 3302271809150002, 'Arbian Putra Nugroho', 'Jl. Samudera Pasifik Raya Aryagreen Blok C 2 No 40, RT 0,RW 0, , Sasak Panjang, Kec. Tajurhalang, 16320', '2015-09-18', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(178, 3, 8, 26, 3201374811150004, 'Arnisa Syahria Rafanda', 'Perum. Bumi Indah Pesona Blok D37 No. 9, RT 3,RW 16, , Kalisuren, Kec. Tajurhalang, 16320', '2015-11-08', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(179, 3, 8, 26, 3201105402160006, 'ASHILA QAIRINA PUTRI', 'Perum. Samudera Residence Cluster Discus Blok 6 No 5, RT 2,RW 6, , Kalisuren, Kec. Tajurhalang, 16320', '2016-02-14', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(180, 3, 8, 26, 3674052105161006, 'Azzam Muhammad Syahnif', 'Perum. Klasteria Hasanah I , Kp. Baru Babakan, RT 2,RW 10, , Ragajaya, Kec. Bojong Gede, ', '2016-05-21', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(181, 3, 8, 26, 3276112204160001, 'Haidar Faris Maulana', 'Jl.Kampung Bulak, RT 2,RW 4, , Duren Seribu, Kec. Bojongsari, ', '2016-04-22', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(182, 3, 8, 27, 3201375810150001, 'Kasyifa Adzkia Almumtazah', 'Kalisuren, RT 1,RW 4, , Kalisuren, Kec. Tajurhalang, ', '2015-10-18', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(183, 3, 8, 27, 3671062608150007, 'KENZIE RAYHAN WIDJONARKO', 'Inkopad Blok R3 No. 17, RT 0,RW 0, , Sasak Panjang, Kec. Tajurhalang, ', '2015-08-26', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(184, 3, 8, 27, 3276070601160004, 'MAHARDIKA ABIMANYU BASTIAN', 'PERUMAHAN SAMUDERA RESIDENCE, RT 4,RW 25, , Tajur Halang, Kec. Tajurhalang, 16320', '2016-01-06', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(185, 3, 8, 27, 3172034206160002, 'Maryam Inara Sativa Akib', 'Perum. Klaster Hasanah Citayam 1 Blok D No 1, RT 2,RW 10, , Ragajaya, Kec. Bojong Gede, ', '2016-06-02', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(186, 3, 8, 27, 3201371306150001, 'MUHAMAD HAZIQ AL RAZIQ', 'Kp. Jampang No.41, RT 1,RW 11, , Kalisuren, Kec. Tajurhalang, 16320', '2015-06-13', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(187, 3, 8, 27, 3174043007151010, 'Muhammad Ikrimah Abdur Jundu Rahman', 'Perumaahan Green Terraces Blok A 4 No 12, RT 0,RW 0, , Kalisuren, Kec. Tajurhalang, 16320', '2015-07-30', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(188, 3, 8, 27, 3602191405150001, 'Prinsa Riandra Andriawan', 'Kp.Lebak Wangi, RT 3,RW 1, , Pamegarsari, Kec. Parung, 16330', '2015-05-14', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(189, 3, 8, 28, 3674034112151005, 'QAIREEN AZALEA LATIF', 'PERUM BALI PARADISE BLOK A4/18, RT 0,RW 0, , KALISUREN, Kec. Tajurhalang, 16320', '2015-12-01', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(190, 3, 8, 28, 3276112511150001, 'Rafandra Tirta Wirawan', 'Perum Sawangan Elok Blok BD 1/7, RT 2,RW 7, , Duren Mekar, Kec. Bojongsari, 16518', '2015-11-25', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(191, 3, 8, 28, 3201134105150001, 'RAFIFAH ZALFA NADHIFA', 'Perum. Bali Paradise Cluster Sanur Blok B1 No. 11, RT 1,RW 1, , Kalisuren, Kec. Tajurhalang, 16320', '2015-05-01', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(192, 3, 8, 28, 3171072206151010, 'Rama Aditya Putra', 'Perum. Samudra Residence Cluster Leopard B80 No. 12, RT 0,RW 0, , Sasak Panjang, Kec. Tajurhalang, 16320', '2015-06-22', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(193, 3, 8, 28, 3173074705151006, 'Salma Aqilah Agustin', 'Jl.Inkopad Raya Kampung bulak,, RT 2,RW 6, , Kalisuren, Kec. Tajurhalang, 16320', '2015-05-07', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(194, 3, 8, 28, 3275020902160003, 'SHARKAN ZAIN SAPUTRA', 'Banteng, RT 2,RW 12, Kranji, Kranji, Kec. Bekasi Barat, 17135', '2016-02-09', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(195, 3, 8, 28, 3674016005161003, 'SYAKILA AZZAHRA', 'JL CIATER RAYA, RT 5,RW 9, , CIATER, Kec. Serpong, 15317', '2016-05-20', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(196, 3, 8, 29, 3201375412150001, 'WIDI GIZKA RENGGANIS', 'KOMP.INKOPAD BLOK D20/9 RT5/5 SASAK PANJANG, RT 5,RW 5, , Sasak Panjang, Kec. Tajurhalang, 16320', '2015-12-14', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(197, 3, 9, 29, 3276063006150001, 'Abhinaya Affan Arandra', 'Perumahan Deparis 2, RT 0,RW 0, Kalisuren, Kalisuren, Kec. Tajurhalang, 16311', '2015-06-30', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(198, 3, 9, 29, 1808142609150001, 'Abidzar Sangkan Maldini', 'Perum D\'Phani\'isan Blok C no. 06, RT 1,RW 4, , Kalisuren, Kec. Tajurhalang, 16320', '2015-09-26', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(199, 3, 9, 29, 3674021603161001, 'Abyan Arsyad Rasfalah', 'De Paris Residence Jl. Pandan 2 Blok B2 no 8, RT 0,RW 0, , Kalisuren, Kec. Tajurhalang, ', '2016-03-16', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(200, 3, 9, 29, 3201376810150001, 'Adzkia Samha Al Arif', 'Komplel Inkopad Blok R 2 No 19, RT 5,RW 7, , Kalisuren, Kec. Tajurhalang, 16320', '2015-10-28', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(201, 3, 9, 29, 3173065711151009, 'Afika Sobriana Wahida', 'Kampung Bulu Citayam Grande Asri 01, RT 3,RW 6, , Citayam, Kec. Tajurhalang, ', '2015-11-17', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(202, 3, 9, 29, 3201376602160005, 'Alesha Syamsa Elbahri', 'Komplek Inkopad Blok C4 /17, RT 3,RW 5, , Sasak panjang, Kec. Tajurhalang, ', '2016-02-26', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(203, 3, 9, 30, 3175105202160004, 'Alifia Zahra Salim', 'Perum. Arraya Residence Blok C6, RT 2,RW 2, , Citayam, Kec. Tajurhalang, 16320', '2016-02-12', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(204, 3, 9, 30, 3174071107160003, 'Alifiandra Nadava Akbar', 'De Paris Residance Jl. Daun Akasia 11 Blok A 7, RT 0,RW 0, , Kalisuren, Kec. Tajurhalang, 16320', '2016-07-11', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(205, 3, 9, 30, 3174090704151007, 'ANDI ADRIAN WIBISANA PAJAR', 'NING\'S KHASANAH BLOK A No. 12, RT 3,RW 14, , Kalisuren, Kec. Tajurhalang, 16320', '2015-04-07', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(206, 3, 9, 30, 3324106901160001, 'Anindya Ilmi Amalia', 'Jl. Raya Kalisuren No 90, RT 0,RW 0, , Kalisuren, Kec. Tajurhalang, 16320', '2016-01-29', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(207, 3, 9, 30, 3277032502160002, 'Daffa Rafandra Faber', 'Jl.Amd Kp. Karet perum Sentra Tajurhalang ruko No.28, RT 12,RW 1, , Sasak Panjang, Kec. Tajurhalang, 40512', '2016-02-25', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(208, 3, 9, 30, 3201372703160002, 'Devandra Bryan Pratama', 'Perum Sarana Indah Residence Blok B1/06, RT 3,RW 3, , Kalisuren, Kec. Tajurhalang, 16320', '2016-03-27', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(209, 3, 9, 30, 3275021705160012, 'Fairel Arkhan Calief Pulungan', 'Komplek Inkopad Blok A 1 No 29, RT 1,RW 5, , Sasak Panjang, Kec. Tajurhalang, ', '2016-05-17', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(210, 3, 9, 31, 3201371010150002, 'Fastabiqul Khairat Fisabilillah', 'Komp.Inkopad Blok F 16 No 6, RT 14,RW 5, , Sasak Panjang, Kec. Tajurhalang, 16320', '2015-10-10', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(211, 3, 9, 31, 3201372204150004, 'GILANG ALDRICH KAHFI', 'Jl. H. Kain Ragamukti, RT 3,RW 2, , Citayam, Kec. Tajurhalang, 16320', '2015-04-22', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(212, 3, 9, 31, 3216075103150003, 'ILUNADYA TASYA KALILA', 'Perum. Samasta Citayam, Kp. Buluh., RT 4,RW 0, , Citayam, Kec. Tajurhalang, ', '2015-03-11', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(213, 3, 9, 31, 3171035704160002, 'JELITA NAZIFA PRICILLIA', 'Jl. Kenari 6, RT 1,RW 16, Perum. Bumi Indah Pesona Blok D6/No. 21, Kalisuren, Kec. Tajurhalang, ', '2016-04-17', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(214, 3, 9, 31, 3276091702160001, 'Kenzie Rasendriya Sulkan', 'Komplek Inkopad Blok A 3 No 3, RT 1,RW 5, , Sasak Panjang, Kec. Tajurhalang, 16320', '2016-02-17', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(215, 3, 9, 31, 3174065609151004, 'Khairatun Hisan', 'Nyiur Mekar Residence, RT 0,RW 0, , Sasak Panjang, Kec. Tajurhalang, ', '2015-09-16', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(216, 3, 9, 31, 3201371601160002, 'MUHAMMAD RAFA SYAKUR', 'Griya Kalisuren Asri E3/2-3, RT 2,RW 15, , Kalisuren, Kec. Tajurhalang, ', '2016-01-16', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(217, 3, 9, 32, 3201375609140003, 'NADIA ELMIRA', 'KALISUREN, RT 1,RW 3, KALISUREN, TAJUR HALANG, Kec. Kota Bogor Tengah, ', '2014-09-16', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(218, 3, 9, 32, 3201375007160003, 'Nafisha Khanza Azkadina', 'Perum Alam Hijau Parung, RT 3,RW 4, , Kalisuren, Kec. Tajurhalang, 16320', '2016-07-10', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(219, 3, 9, 32, 3208264911150001, 'Novelica Suci Khoirunnisa', 'Perum. De paris Residence Blok C3 No. 08, RT 4,RW 5, , Kalisuren, Kec. Tajurhalang, 16320', '2015-11-09', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49');
INSERT INTO `data_santri` (`id`, `id_grup_cabang`, `id_grup_santri`, `id_grup_kelompok`, `no_identitas`, `nama_lengkap`, `alamat`, `tgl_lahir`, `jenis_kelamin`, `keterangan`, `link_sertifikat`, `status`, `created_at`, `updated_at`) VALUES
(220, 3, 9, 32, 3201370207160002, 'Sakti Vira Yudha', 'Komplek Inkopad Blok B8 No 15, RT 9,RW 5, , Sasak Panjang, Kec. Tajurhalang, 16320', '2016-07-02', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(221, 3, 9, 32, 3674032312151003, 'SANKO FARUNAKO RABBANA', 'PERUM DE PARIS Blok B1 No.10 Jl. Daun Pandan, RT 0,RW 0, , Kalisuren, Kec. Tajurhalang, 16320', '2015-12-23', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(222, 3, 9, 32, 3674055003151003, 'Shahia Yona Nabil', 'The Samudera Residence Cluster Rainbow B69 No 18, RT 6,RW 25, , Tajur Halang, Kec. Tajurhalang, 16320', '2015-03-10', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(223, 3, 9, 32, 2172021308150005, 'Ubaidillah Rahman', 'Perum Kalisuren Paradise Blok B3 No 5, RT 7,RW 6, , Kalisuren, Kec. Tajurhalang, 16320', '2015-08-13', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(224, 3, 9, 33, 3276075007150002, 'Yasmine Naura Yumna', 'Deparis 2 Byavani Blok G 20, RT 0,RW 0, , Kalisuren, Kec. Tajurhalang, 16320', '2015-07-10', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(225, 3, 10, 33, 3201120202160004, 'ABRISAM LUTHFAN ATMAJA', 'Jl. Daun Pulus 3 Blok B22/3, RT 3,RW 5, Perumahan De Paris, Kalisuren, Kec. Tajurhalang, 16320', '2016-02-02', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(226, 3, 10, 33, 3276056609150008, 'Adeeva Raisha Maulidina', 'Nyiur Mekar Residence, RT ,RW , , Sasak Panjang, Kec. Tajurhalang, ', '2015-09-26', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(227, 3, 10, 33, 3201101309150002, 'Adhyasthapoldi Pranaja Iswandi', 'KP. Lebakwangi, RT 3,RW 1, , Pamegarsari, Kec. Parungpanjang, ', '2015-09-13', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(228, 3, 10, 33, 3174054102160002, 'ADIBA AQILA', 'KALISUREN PERUM ALAM HIJAU PARUNG ROSE 4/14, RT 3,RW 4, , KALISUREN, Kec. Tajurhalang, ', '2016-02-01', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(229, 3, 10, 33, 3201371204160001, 'Ahmad Zidan Hermawan', 'KOmplek Inkopad Blok B 1/07, RT 2,RW 5, , Kalisuren, Kec. Tajurhalang, ', '2016-04-12', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(230, 3, 10, 33, 3201376410150003, 'AQILA FIKA BAHTIAR', 'PERUM ALAM HIJAU PARUNG BLOK B-3/09, RT 3,RW 4, , KALISUREN, Kec. Tajurhalang, 16320', '2015-10-24', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(231, 3, 10, 34, 3175055608160003, 'Arsyifa Salsabila Rosady', 'Perum Alam Hijau Parung Blok Alamanda 5 No 31, RT 0,RW 0, , Kalisuren, Kec. Tajurhalang, ', '2016-08-16', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(232, 3, 10, 34, 3175042002160002, 'Attaya Bilal Rizkillah', 'Perum ARCO Residence Blok A2 No 8, RT 5,RW 1, , Citayam, Kec. Tajurhalang, ', '2016-02-20', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(233, 3, 10, 34, 3173016404160004, 'Aufia Refani Nasution', 'Jalan Raya Kalisuren, RT 0,RW 0, , Kalisuren, Kec. Tajurhalang, 16320', '2016-04-24', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(234, 3, 10, 34, 3201122905150002, 'Ayyash Tsaqib Robbani', 'KP Jampang Gg.Mesjid, RT 4,RW 6, Jampang, Jampang, Kec. Kemang, 16310', '2015-05-29', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(235, 3, 10, 34, 6305126606150001, 'Farhana Aisha Salsabila', 'Kampung Utan, RT 0,RW 0, , Kalisuren, Kec. Tajurhalang, ', '2015-06-26', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(236, 3, 10, 34, 3276100811150002, 'GARY ALKHALIFI', 'PARUNG PERMATA INDAH, RT 6,RW 12, , KALISUREN, Kec. Tajurhalang, 16318', '2015-11-08', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(237, 3, 10, 34, 3271044405160008, 'Khayla Almeera Maritza', 'Perum.Grand Mulia Kalisuren Blok B1 No 6, RT 0,RW 0, , Kalisuren, Kec. Tajurhalang, 16320', '2016-05-04', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(238, 3, 10, 35, 3201371911150001, 'MAHER ZAIDAN MUZAKKI', 'Jl. AMD Sasak Panjang, RT 4,RW 8, , Sasak Panjang, Kec. Tajurhalang, 16320', '2015-11-19', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(239, 3, 10, 35, 3174030903160005, 'MUHAMMAD ABBYAN PANDU GERHANA', 'JL. MAMPANG PRAPATAN XI NO.10, RT 6,RW 4, , TEGAL PARANG, Kec. Mampang Prapatan, 12790', '2016-03-09', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(240, 3, 10, 35, 3206120911150001, 'Muhammad Arkaan Kamil', 'Perum Parung Permata Indah Blok B 3/05, RT 3,RW 12, , Kalisuren, Kec. Tajurhalang, ', '2015-11-09', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(241, 3, 10, 35, 3674062803161001, 'Muhammad Azzam Al Fawwaz', 'Jl. Arya Putra Gang Swadaya, RT 6,RW 15, Kedaung, Kedaung, Kec. Pamulang, 15415', '2016-03-28', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(242, 3, 10, 35, 3301200711150003, 'Muhammad Rafa Al Arkhan', 'Komplek Inkopad Blok F10 No 18, RT 12,RW 5, , Kalisuren, Kec. Tajurhalang, ', '2015-11-07', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(243, 3, 10, 35, 3201372311150001, 'MUHAMMAD RAYNAND ARKAN ASSYAFI', 'DEPARIS RESIDENCE BLOK B15 NO 15, RT 0,RW 0, , KALISUREN, Kec. Tajurhalang, 16320', '2015-11-23', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(244, 3, 10, 35, 3174063007151004, 'NABIL NAILUN NABHAN SETIAWAN', 'Perum Sasakpanjang Permai Blok I4 No. 2A, RT 2,RW 0, , Sasak Panjang, Kec. Tajurhalang, 16317', '2015-07-30', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(245, 3, 10, 36, 3674064701161002, 'Naura Shafira', 'Perum. Grand Mulia Kalisuren Blok B2 No. 15, RT 2,RW 9, , Kalisuren, Kec. Tajurhalang, 16320', '2016-01-07', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(246, 3, 10, 36, 3201372604160001, 'Radika Muhammad Al Kholifi', 'Komplek Inkopad Blok D 17/11, RT 19,RW 5, , Kalisuren, Kec. Tajurhalang, ', '2016-04-26', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(247, 3, 10, 36, 3174082110151002, 'RAFLI SAKHA ALFARIZY', 'Alam Hijau Parung Blok B1 No. 17, RT 3,RW 4, , Kalisuren, Kec. Tajurhalang, 16320', '2015-10-21', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(248, 3, 10, 36, 3175041604160006, 'Raihan Ahnaf Maulana Junaedi', 'Avani Terra Residence Blok G No 3, RT 0,RW 0, , Kalisuren, Kec. Tajurhalang, ', '2016-04-16', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(249, 3, 10, 36, 3201376402160001, 'Rainna Schatzi Kamila', 'Komplek Inkopad Blok D9 / 1, RT 18,RW 5, , Kalisuren, Kec. Tajurhalang, ', '2016-02-24', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(250, 3, 10, 36, 3201376809160001, 'Ratu Anaya Siregar', 'Komplek Inkopad Blok F 21/6, RT 11,RW 0, , Sasak Panjang, Kec. Tajurhalang, ', '2016-09-28', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(251, 3, 10, 36, 3174096505160011, 'SOVIA AZZAHRA', 'PERUMAHAN ALAM HIJAU PARUNG BLOK B.3 NO.2, RT 3,RW 4, , KALISUREN, Kec. Tajurhalang, 16320', '2016-05-25', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(252, 3, 10, 37, 3201137105150008, 'TIARA BESTARINA', 'KAMPUNG MUTIARA BARU, RT 2,RW 11, KEDUNGWARINGIN, KEDUNGWARINGIN, Kec. Bojong Gede, 16923', '2015-05-31', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(253, 4, 11, 37, 3201374211140001, 'ADZKIA SAMHA SAUFA', 'KOMPLEK PARUNG PARUNG PERTAMA INDAH BLOK E1 NO. 57, RT 6,RW 12, , KALISUREN, Kec. Tajurhalang, ', '2014-11-02', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(254, 4, 11, 37, 3173080906141001, 'AMSYAR AL JAZARI', 'INKOPAD, RT 0,RW 0, , Sasak Panjang, Kec. Tajurhalang, ', '2014-06-09', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(255, 4, 11, 37, 3175045610141005, 'Aqeela Khanza Humaira', 'Jl.Ja Abah No 11 Blok DA No 24, RT 2,RW 1, , Tengah Kramat Jati, Kec. Kramat Jati, ', '2014-10-16', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(256, 4, 11, 37, 3205040803140005, 'Aqlan Lazuardi Hermawan', 'Perum.Samudera Residence Rainbow B65 / 3 A, RT 0,RW 25, , Tajur Halang, Kec. Tajurhalang, 16320', '2014-03-08', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(257, 4, 11, 37, 3173043108141006, 'Chairul Azzam Nafadillah', 'Samudera Residence Neon Tetra B3/29, RT 0,RW 0, , Tajur Halang, Kec. Tajurhalang, ', '2014-08-31', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(258, 4, 11, 37, 3201372207140001, 'Dzafran Satyanagara', 'Komp.Inkopad Blok D4 No 10, RT 4,RW 5, , Sasak Panjang, Kec. Tajurhalang, 16320', '2014-07-22', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(259, 4, 11, 38, 3276011009140001, 'FAQIH KHAIRY RAHMAN', 'KP. JAMPANG, RT 1,RW 9, , KALISUREN, Kec. Tajurhalang, ', '2014-09-10', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(260, 4, 11, 38, 3201372305150001, 'FAUZAN ADNAN HABIBI', 'KP. BERKAT, RT 1,RW 1, , KALISUREN, Kec. Tajurhalang, ', '2015-05-23', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(261, 4, 11, 38, 3302117108140001, 'GISYEL JACINDA AFRIANTO', 'PERUMAHAN ALAM HIJAU PARUNG NO 12, RT 3,RW 4, , KALISUREN, Kec. Tajurhalang, ', '2014-08-31', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(262, 4, 11, 38, 3201104105150001, 'Hannah Nazihah Rachman', 'Perum Deparis Residence Blok C22 No 21, RT 0,RW 0, , Kalisuren, Kec. Tajurhalang, 16320', '2015-05-01', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(263, 4, 11, 38, 3276016102140001, 'IRHA HANA AQILAH', 'PERUM GRIYA SATRIA JINGGA BLOK G3/2, RT 4,RW 12, , RAGAJAYA, Kec. Bojong Gede, ', '2014-02-21', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(264, 4, 11, 38, 3201373011140002, 'Kafka Abidzar alghifari', 'KOMPLEK INKOPAD BLOK D10/02, RT 18,RW 5, , Sasak Panjang, Kec. Tajurhalang, ', '2014-11-30', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(265, 4, 11, 38, 3201372712140001, 'KEANU AL GHIFARI PRASTYO', 'INKOPAD BLOK M8, RT 3,RW 7, , Desa/Kel. Sasak Panjang, Kec. Tajurhalang, 16320', '2014-12-27', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(266, 4, 11, 39, 3174071808141006, 'Keisya Aqilah Putri', 'Komp.Inkopad Blok  E4 No 8, RT 6,RW 5, , Sasak Panjang, Kec. Tajurhalang, 16320', '2014-08-18', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(267, 4, 11, 39, 3326100203140002, 'Kenzie Raffaes Sukoco', 'Perum.Deparis Residence Blok B3 No 9, RT 1,RW 5, , Kalisuren, Kec. Tajurhalang, 16320', '2014-03-02', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(268, 4, 11, 39, 3201374703150002, 'KHAYLA DZAKIYYAH AGHNI WIBOWO', 'Kp. Utan, RT 1,RW 7, , KALISUREN, Kec. Tajurhalang, ', '2015-03-07', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(269, 4, 11, 39, 3201256201150001, 'Melodya Alinka Simphony', 'Curug, RT 0,RW 0, , Curug, Kec. Gunung Sindur, ', '2015-01-22', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(270, 4, 11, 39, 3174076510141001, 'Nadine Qaireen Delisha', 'Perum Deparis Residence Blok C14 No 15, RT 0,RW 0, , Kalisuren, Kec. Tajurhalang, 16320', '2014-10-25', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(271, 4, 11, 39, 3201195502150001, 'NADZIRA GHEFIRA AZZAHRA', 'PERUMAHAN CASA MAGNOLIA, RT 0,RW 0, , KALISUREN, Kec. Tajurhalang, ', '2015-02-15', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(272, 4, 11, 39, 3174070903141001, 'Rayyan Hanif Fathurrahman', 'Perum Puri Sawangan Residence Blok A2 No. 4, RT 5,RW 2, , Citayam, Kec. Tajurhalang, 16320', '2014-03-09', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(273, 4, 11, 40, 3212251411140001, 'RAZIQ HANAN', 'PERUMAHAN ALAM HIJAU PARUNG BLOK AL.3 NO.29, RT 3,RW 4, , KALISUREN, Kec. Tajurhalang, 16320', '2014-11-14', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(274, 4, 11, 40, 3174051706141004, 'SULTHAN AL MUZAFFAR MAULANA', 'PERUM. PARUNG PERAMATA INDAH BLOK C1 NO. 7, RT 3,RW 11, , KALISUREN, Kec. Tajurhalang, ', '2014-06-17', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(275, 4, 11, 40, 3201374408140001, 'TAZKIA RAHMA', 'PERUM PPI BLOK B-2/10A, RT 3,RW 12, , KALISUREN, Kec. Tajurhalang, 16320', '2014-08-04', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(276, 4, 11, 40, 3172040409141003, 'THARIQ IHSANUL QOLBI', 'DE PARIS RESIDENCE BLOK B5/17, RT 0,RW 0, , KALISUREN, Kec. Tajurhalang, 16320', '2014-09-04', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(277, 4, 11, 40, 3201136703150002, 'ZAIRA HAFIZA', 'PERUMAHAN ALAM HIJAU PARUNG BLOK AL.3 NO.34, RT 3,RW 4, , KALISUREN, Kec. Tajurhalang, 16320', '2015-03-27', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(278, 4, 12, 40, 1371112210140005, 'DWIMORHNEZ KING DIHAZORA SANTOSO', 'PERUMAHAN SASAKPANJANG PERMAI BLOK I3 NO 11, RT 2,RW 12, , Sasak Panjang, Kec. Tajurhalang, ', '2014-10-22', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(279, 4, 12, 40, 3174064506141001, 'EARLYTA ARSYFA MAHIRA', 'PERUMAHAN GRAND MUTIARA NANGGERANG, RT 4,RW 3, , NANGGERANG, Kec. Tajurhalang, ', '2014-06-05', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(280, 4, 12, 41, 3201374512130004, 'Farah Diba Samara', 'Komplek INKOPAD Blok A, RT 1,RW 5, , Sasak Panjang, Kec. Tajurhalang, 16320', '2013-12-05', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(281, 4, 12, 41, 3201375605150003, 'GREVI VALERIA NURKHAIRA CHIFO', 'KOMPLEK INKOPAD BLOK L1/1, RT 1,RW 7, , Sasak Panjang, Kec. Tajurhalang, ', '2015-05-16', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(282, 4, 12, 41, 3175096004151003, 'HUSNA AZZAHRA', 'DE PARIS RESIDENCE BLOK C17/25, RT 4,RW 5, , KALISUREN, Kec. Tajurhalang, ', '2015-04-20', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(283, 4, 12, 41, 3311022804140002, 'Ibrahim Azzam Al Amwal', ' Perum.Samudra Residence Cluster Rainbow B70 N0 19, RT 2,RW 25, , Tajur Halang, Kec. Tajurhalang, 16320', '2014-04-28', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(284, 4, 12, 41, 3201371701150002, 'Ilham Mufarid', 'Kp.Ragamukti, RT 3,RW 2, , Citayam, Kec. Tajurhalang, ', '2015-01-17', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(285, 4, 12, 41, 3201374711140004, 'Inayah El Faiqoh', 'Komplek INKOPAD Blok B1/13, RT 2,RW 5, , Sasak Panjang, Kec. Tajurhalang, 16320', '2014-11-07', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(286, 4, 12, 41, 3201372808150002, 'Jibril Arsakha Haeidar', 'Perum.Graha Kalisuren Blok I 27, RT 1,RW 7, , Kalisuren, Kec. Tajurhalang, 16320', '2015-08-28', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(287, 4, 12, 42, 3171046209151002, 'Kayla Arliana Azzahra', 'Perum.Villa Madani Blok B7, RT 3,RW 1, , Kalisuren, Kec. Tajurhalang, 16320', '2015-09-22', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(288, 4, 12, 42, 3174050811141010, 'MICHAEL ABHINAYA SURYAPRABHAWASENA', 'DE PARIS RESIDENCE BLOK B9 NO. 6, RT 1,RW 4, , KALISUREN, Kec. Tajurhalang, ', '2014-11-08', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(289, 4, 12, 42, 3276055005150005, 'Mikhaila Alesha Assyabiya', 'Jl Arco Raya benzema Residence 2 B7, RT ,RW , , Citayam, Kec. Tajurhalang, ', '2015-05-10', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(290, 4, 12, 42, 3172021303151005, 'MUHAMMAD ABYAS ABRISAM', 'BHAKTI NO.21, RT 4,RW 1, , SUNTER JAYA, Kec. Tanjung Priok, 14350', '2015-03-13', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(291, 4, 12, 42, 3671132401140004, 'MUHAMMAD AKHDAN MUMTAZ', 'Kp. Sasakpanjang, RT 1,RW 3, , sasak panjang, Kec. Tajurhalang, ', '2014-01-24', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(292, 4, 12, 42, 3201370509140002, 'Muhammad Maheswara Winata', 'Komplek Inkopad Blok J8 No 16c, RT 15,RW 6, , Sasak Panjang, Kec. Tajurhalang, 16320', '2014-09-05', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(293, 4, 12, 42, 3174040905151007, 'MUHAMMAD ZAIN ARRAFIF', 'PERUM. DEPARIS RESIDENCE BLOK A10/08, RT 2,RW 5, , Desa/Kel. Kalisuren, Kec. Tajurhalang, 16320', '2015-05-09', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(294, 4, 12, 43, 3671015103150005, 'MUKHBITA HANANIA HAKEEM', 'INKOPAD, RT 0,RW 0, , KALISUREN, Kec. Tajurhalang, ', '2015-03-11', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(295, 4, 12, 43, 3171056102161001, 'Nabila Aisyah Nadine', 'JL. VIOLET SAMUDERA RESIDENCE CLUSTER RAINBOW B73/25, RT 0,RW 0, , Tajur Halang, Kec. Tajurhalang, ', '2015-02-21', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(296, 4, 12, 43, 3323031207140002, 'NAUFAL DANENDRA', 'PERUM. DEPARIS RESIDENCE BLOK B1 NO. 20, RT 0,RW 0, , KALISUREN, Kec. Tajurhalang, ', '2014-07-12', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(297, 4, 12, 43, 3201372510140001, 'Raden Fadhil Saadi Ahza', 'Perum.Graha Suaka Klola Blok I No 16, RT 0,RW 0, , Tajur Halang, Kec. Tajurhalang, 16320', '2014-10-25', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(298, 4, 12, 43, 3329170604150002, 'Sagara Cikal Basyuni', 'Perum Alam Hijau Parung Blok B2 No. 16, RT 0,RW 0, , Kalisuren, Kec. Tajurhalang, 16320', '2015-04-06', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(299, 4, 12, 43, 3674046105151003, 'SHOFIYAH RAHMA PUTRI', 'Kp. Utan Raya, RT 3,RW 7, , KALISUREN, Kec. Tajurhalang, ', '2015-05-21', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(300, 4, 12, 43, 3175075708141010, 'Zalma Saafia Amalina', 'Deparis Residence Blok A5 No 7, RT 1,RW 5, , Kalisuren, Kec. Tajurhalang, 16320', '2014-08-17', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(301, 4, 12, 44, 3322021408140002, 'Zyan Arjuna Albar', 'Klero, RT 9,RW 2, , Klero, Kec. Tengaran, 50775', '2014-08-14', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(302, 4, 13, 44, 3208136508140002, 'ADYA FHATINA NUGRAHA', 'KP BALI, RT 3,RW 4, , KALIDERES, Kec. Kali Deres, 11840', '2014-08-25', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(303, 4, 13, 44, 3201374409140002, 'AISYAH MUTYA AALINARRAHMA', 'Griya Kalisuren Asri, RT 2,RW 15, , Kalisuren, Kec. Tajurhalang, ', '2014-09-04', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(304, 4, 13, 44, 3173026104141005, 'ALYSSA ANINDYA SAKHI MUSLIM', 'Jl Anyar 6 NO 24 B, RT 7,RW 10, , WIJAYA KUSUMA, Kec. Grogol Petamburan, 11460', '2014-04-21', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(305, 4, 13, 44, 3201376606150003, 'ARIQA ELYSIA SHAZIA', 'PERUMAHAN PARUNG PERMATA INDAH, RT 4,RW 12, , KALISUREN, Kec. Tajurhalang, ', '2015-06-26', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(306, 4, 13, 44, 3172022805151007, 'ATHALLAH DHAFIN ALFARIZQY', 'KP. UTAN, RT 3,RW 7, , KALISUREN, Kec. Tajurhalang, ', '2015-05-28', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(307, 4, 13, 44, 3201372608140001, 'Cielo Daniyal Rinjaya', '`Komplek inkopad Blok G No 10, RT 3,RW 6, , Sasak Panjang, Kec. Tajurhalang, 16320', '2014-08-26', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(308, 4, 13, 45, 3201371108140001, 'DAFFI HAFIZ ATALLAH', 'KOMPLEK INKOPAD BLOK D7 NO. 2, RT 18,RW 4, , Sasak Panjang, Kec. Tajurhalang, ', '2014-08-11', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(309, 4, 13, 45, 3271016503150001, 'DINDA LUTFIA NADHIF', 'GRIYA INTILAND BLOK E1/9, RT 0,RW 0, , Tajur Halang, Kec. Tajurhalang, 16320', '2015-03-25', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(310, 4, 13, 45, 3201376404140002, 'DZAKIYAH AIRA HANUM', 'Kp. Utan, RT 1,RW 7, , Kalisuren, Kec. Tajurhalang, 16320', '2014-04-24', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(311, 4, 13, 45, 3404114501150001, 'Ervina Alesha Kesuma', 'Perum.Palm Pavilion 2 No A3, RT 1,RW 2, , Ragamukti, Kec. Tajurhalang, 16320', '2015-01-05', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(312, 4, 13, 45, 3201371705150001, 'FARRAND RASYID ATMAJA', 'KALISUREN PARADISE BLOK B3/17, RT 6,RW 7, , Tajur Halang, Kec. Tajurhalang, 16320', '2015-05-17', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(313, 4, 13, 45, 3172021004151008, 'Farrel Alvino', 'Kp. Kalisuren, RT 1,RW 3, , Kalisuren, Kec. Tajurhalang, ', '2015-04-10', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(314, 4, 13, 45, 3201372107140001, 'GHIYAS AZFAR BUANA', 'KOMPLEK INKOPAD BLOK D3 NO. 13, RT 0,RW 0, , Sasak Panjang, Kec. Tajurhalang, ', '2014-07-21', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(315, 4, 13, 46, 3276030503150004, 'HANIN LEKSONO PUTRI', 'JLN.KOPRAL DAMAN, RT 1,RW 3, , Sawangan Baru, Kec. Sawangan, 16511', '2015-03-05', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(316, 4, 13, 46, 3201375902150001, 'Haura Rafifah Suwono', 'Komplek Inkopad Blok D 6 No 21, RT 4,RW 5, , Sasak Panjang, Kec. Tajurhalang, 16320', '2015-02-19', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(317, 4, 13, 46, 3201116007140002, 'MARITZA KHANSA RIZQY MARWANDI', 'DEPARIS RESIDENCE BLOK A5 NO. 6, RT 0,RW 0, , KALISUREN, Kec. Tajurhalang, ', '2014-07-20', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(318, 4, 13, 46, 3201375605150006, 'MEISYA SHALIHA', 'KOMPLEK PARUNG PERMATA INDAH BLOK E1/47, RT 6,RW 10, , KALISUREN, Kec. Tajurhalang, ', '2015-05-16', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(319, 4, 13, 46, 3201371207140003, 'MUHAMAD SAHJUDIN', 'DE PARIS RESIDENCE BLOK C10 NO 17, RT 0,RW 0, , KALISUREN, Kec. Tajurhalang, 16320', '2014-07-12', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(320, 4, 13, 46, 3175011010141002, 'Muhammad Raynar Arganta', 'Perum Inkopad Blok D18 No 9, RT 19,RW 5, , Sasak Panjang, Kec. Tajurhalang, 16320', '2014-10-10', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(321, 4, 13, 46, 3174050508131005, 'Raden Wishaka Augusto Tjokroadiredjo', 'Perum.Tjitra Mas Residence Blok F 4 No 14, RT 4,RW 1, , Kalisuren, Kec. Tajurhalang, 16320', '2013-08-05', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(322, 4, 13, 47, 3201370305140001, 'RIFQI PRASETYO', 'Kp Karet, RT 1,RW 8, , Tajur Halang, Kec. Tajurhalang, ', '2014-05-03', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(323, 4, 13, 47, 3174045102151004, 'SHANUM QONITA AZRA', 'KP. BULU SASAKPANJANG SAMASTA CITAYAM A7, RT 0,RW 0, , Sasak Panjang, Kec. Tajurhalang, ', '2015-02-11', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(324, 4, 13, 47, 3174091811141012, 'SYAFIQ SYADIDUL AZMI', 'INKOPAD BLOK A NO 3, RT 1,RW 4, SASAK PANJANG, KALISUREN, Kec. Tajurhalang, 16320', '2014-11-18', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(325, 4, 13, 47, 3201374502150002, 'UFAIRA ZAILA ARRETA', 'KP. BARU, RT 3,RW 5, , CITAYAM, Kec. Tajurhalang, ', '2015-05-02', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(326, 4, 13, 47, 3674062405140001, 'Waleed Khalil Elfaroug Elsheikh', 'Alam Hijau Parung Alamanda 3 No 23, RT 0,RW 0, , Kalisuren, Kec. Tajurhalang, 16320', '2014-05-24', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(327, 5, 14, 47, 3276052001140004, 'Adrian Bagas Pramudya', 'Kecak 1, RT 0,RW 0, , Mekar Jaya, Kec. Sukmajaya, ', '2014-01-20', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(328, 5, 14, 47, 3201371006140002, 'AHDA FAHMI HILMAN', 'JL. MEUNASAH CUT KOMPLEK PAJAK KANWIL DESA DOY KEC. ULEE KARENG BANDA ACEH, RT 1,RW 15, , DOY, Kec. Ulee Kareng, 23117', '2014-06-10', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(329, 5, 14, 48, 3205246504140001, 'Aika Aprilia Duratul Jannah', 'Kampung Utan, RT 2,RW 7, , Kalisuren, Kec. Tajurhalang, ', '2014-04-25', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(330, 5, 14, 48, 3201105807140001, 'Aisyah Hilda Taufiq', 'Jln. Hj Mawi , RT ,RW , , Waru, Kec. Parung, ', '2014-07-18', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(331, 5, 14, 48, 3171070209131002, 'ALFIYAN NASIR', 'PALEM GANDA SARI 1, RT 0,RW 0, , KARANG TENGAH, Kec. Karang Tengah, ', '2013-09-02', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(332, 5, 14, 48, 3515144109130005, 'ALINA SYAKIRA', 'Puri Gardena Blok E5-12 , RT 0,RW 0, , Pegadungan, Kec. Kali Deres, ', '2013-09-01', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(333, 5, 14, 48, 3175090405141003, 'Alkhalifi Zikri Muezza Ammar', 'Citayam Grande Asri 1 Blok D No 8, RT 0,RW 0, , Citayam, Kec. Tajurhalang, ', '2014-05-04', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(334, 5, 14, 48, 3201375911130002, 'Aqila Aulia Rahmaiza', 'Perum BIP Blok B37 No 27, RT 3,RW 16, , Kalisuren, Kec. Tajurhalang, ', '2013-11-19', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(335, 5, 14, 48, 3275021903140005, 'ASYRAAF ZAFRAN SAPUTRA', 'Jl. Raya Kalisuren, RT 1,RW 11, , Kalisuren, Kec. Tajurhalang, 16320', '2014-03-19', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(336, 5, 14, 49, 3674011010130007, 'Atallah Afsheen', 'Tajurpulo Residence Blok A No. 07, RT 0,RW 0, , Sasak Panjang, Kec. Tajurhalang, 16320', '2013-10-10', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(337, 5, 14, 49, 3201376306140001, 'Avifah Zaidan Nasution', 'Pool Bina Marga, RT 0,RW 0, , Kayumanis, Kec. Tanah Sareal, ', '2014-06-23', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(338, 5, 14, 49, 3203090108130002, 'Azzam Arradhi Gunawan', 'perumahan Inkopad, RT 0,RW 0, , Kalisuren, Kec. Tajurhalang, 16320', '2013-08-01', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(339, 5, 14, 49, 3201370410131001, 'Daffa Arya Pratama', 'Kp Kaliputih, RT 0,RW 0, , Citayam, Kec. Tajurhalang, ', '2013-10-04', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(340, 5, 14, 49, 3201376206140002, 'Dzakiyya Talita Sakhi Haeidar', 'Komp.Inkopad BPTWP Blok I 27, RT 1,RW 7, , Kalisuren, Kec. Tajurhalang, 16320', '2014-06-22', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(341, 5, 14, 49, 3201371003140001, 'DZIKRI NURFATTAH PRATAMA', 'Perumahan PPI blok C-2/8D, RT 3,RW 12, , Kalisuren, Kec. Tajurhalang, 16320', '2014-03-10', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(342, 5, 14, 49, 3201376607140001, 'ELMYRA HOORIN AIYN IMADUDIN NATSIR', 'KAMPUNG UTAN , RT 2,RW 7, KALISUREN, KALISUREN, Kec. Tajurhalang, 16320', '2014-07-26', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(343, 5, 14, 50, 3275111904140002, 'FAIZ ATHAAILLAAH PUTRA ASIM', 'Kp. Kalisuren, RT 1,RW 5, , Kalisuren, Kec. Tajurhalang, 16320', '2014-04-19', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(344, 5, 14, 50, 3276110611130001, 'Hafiz Nur Faizi', 'Perum Samasta Blok I, RT 4,RW 4, , Citayam, Kec. Tajurhalang, ', '2013-11-06', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(345, 5, 14, 50, 3671134904130002, 'ISTAGHNAE KHOERO KHOLKIAH', 'Perumahan Deparis Blok B4 No7 Tajur Halang Bogor, RT 0,RW 0, Deparis Residence, Tajur Halang, Kec. Tajurhalang, ', '2013-04-09', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(346, 5, 14, 50, 3276062209130004, 'Keanu Ahditia Shidik', 'Komplek Inkopad Blok B1/20, RT 2,RW 5, , Sasak Panjang, Kec. Tajurhalang, ', '2013-09-22', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(347, 5, 14, 50, 3201376412130005, 'Khaira Anindita Desviandari', 'Perum. Kalisuren Paradise Blok C-3/10, RT 5,RW 7, , Tajur Halang, Kec. Tajurhalang, ', '2013-12-24', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(348, 5, 14, 50, 3201372805140001, 'Mohammad Riza Khalifa Hadi', 'Perumahan Kalisuren Paradise Blok C1 No. 9, RT 4,RW 7, , Tajur Halang, Kec. Tajurhalang, ', '2014-05-28', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(349, 5, 14, 50, 3171070503141004, 'Muhammad Fathan', 'Jalan Raya Kartika Sejahtera, RT 0,RW 0, , Kalisuren, Kec. Tajurhalang, ', '2014-03-05', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(350, 5, 14, 51, 3301105609130001, 'Nada Almira Salsabila', 'Perum. Samudra Residence Blok B-7/15, RT 4,RW 25, , Tajur Halang, Kec. Tajurhalang, ', '2013-09-16', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(351, 5, 14, 51, 3171031311131007, 'NOVALDY YULIYANTO', 'JL. LIO NO.131, RT 3,RW 8, , Bojong Pondok Terong, Kec. Cipayung, ', '2013-11-13', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(352, 5, 14, 51, 3201371812130004, 'Prakasa Viragupti', 'Komplek INKOPAD Blok B8/14, RT 9,RW 5, , Sasak Panjang, Kec. Tajurhalang, 16320', '2013-12-18', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(353, 5, 14, 51, 3276095804130002, 'Syaqila Najsyawa Nur', 'Deparis Residence Jl.daun Pandan 2 Blok B3 No 24, RT 5,RW 3, , Kalisuren, Kec. Tajurhalang, ', '2013-04-18', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(354, 5, 14, 51, 3173052704131005, 'Zulfi Al Kahfi', 'Komplek Inkopad, RT ,RW , , Kalisuren, Kec. Tajurhalang, ', '2013-04-27', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(355, 5, 15, 51, 3174060806141003, 'Affan Dzaky Haryanto', 'Jln. Cemara II Deparis Residence Blok C4/3, RT 4,RW 2, , Kalisuren, Kec. Tajurhalang, ', '2014-06-08', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(356, 5, 15, 51, 3276012704140006, 'Albi Denzel Maulana', 'Rangkapan Jaya, RT 0,RW 0, , Rangkapan Jaya Baru, Kec. Pancoran Mas, ', '2014-04-27', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(357, 5, 15, 52, 3201375903140001, 'Almahira Hazna Kamila', 'Pondok Padalarang Indah, RT ,RW , , Padalarang, Kec. Padalarang, ', '2014-03-19', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(358, 5, 15, 52, 3276042501140002, 'Amirul Yanuar Ikhwan', 'Puri Sawangan Residence Blok E1/24, RT 0,RW 0, , Citayam, Kec. Tajurhalang, ', '2014-01-25', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(359, 5, 15, 52, 3171021310131001, 'ARSHAKA VIRENDRA SHAFWAN', 'JL. KACA KACA N0 7, RT 12,RW 4, , PASAR BARU, Kec. Sawah Besar, ', '2013-10-13', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(360, 5, 15, 52, 3276036908130002, 'Bella Violetta Aqila', 'Bedahan, RT 0,RW 0, , Bedahan, Kec. Sawangan, ', '2013-08-29', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(361, 5, 15, 52, 3671120503140001, 'Danendra Alvaro Hamizan', 'Jl. Raden Saleh - GG Lurah RT 006/002, RT ,RW , , Karang Tengah, Kec. Karang Tengah, ', '2014-03-05', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(362, 5, 15, 52, 3201370208130001, 'Danish Abidzar', 'Kp.Kalisuren, RT 1,RW 5, , Kalisuren, Kec. Tajurhalang, 16320', '2013-08-02', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(363, 5, 15, 52, 3173075611131005, 'ELENA HASSYAVINA', 'JOMBANG RAYA, RT 0,RW 0, VILLA BINTARO, JOMBANG, Kec. Ciputat, 15413', '2013-11-16', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(364, 5, 15, 53, 3201371807140002, 'Hafiz Wibijaya Ramadhan', 'KOmp.Inkopad Blok F10 N0 10, RT 13,RW 5, , Sasak Panjang, Kec. Tajurhalang, 16320', '2014-07-18', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(365, 5, 15, 53, 3173016511131001, 'Kayyisah Shidqiyah', 'Perum.Baitussalam Permai 2 Kp. utan, RT 3,RW 7, , Kalisuren, Kec. Tajurhalang, 16320', '2013-11-25', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(366, 5, 15, 53, 3174050210131002, 'Kenzie Raditya Wijaya', 'Komp.Inkopad, RT 0,RW 0, , Sasak Panjang, Kec. Tajurhalang, 16320', '2013-10-02', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(367, 5, 15, 53, 3173073005131008, 'Khalifah Altru Saef', 'Nyiur residence RT 03/01, RT ,RW , , Sasak panjang, Kec. Tajurhalang, ', '2013-05-30', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(368, 5, 15, 53, 3172025410131001, 'KHANSA AFIQAH GHASANI', 'PERUMAHAN ALAM HIJAU PARUNG ALAMANDA 7 NO 7, RT ,RW , , KALISUREN, Kec. Tajurhalang, ', '2013-10-14', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(369, 5, 15, 53, 3276110509130003, 'Mikhail Kurniawan Anugroho', 'Jln. Rivaria Dalam 4 No. 1/09, RT 4,RW 1, , Bedahan, Kec. Sawangan, ', '2013-09-05', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(370, 5, 15, 53, 3201370802140001, 'Muhamad Raffa Febryan Athalla', 'Inkopad, RT 0,RW 0, , Sasak Panjang, Kec. Tajurhalang, ', '2014-02-08', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(371, 5, 15, 54, 3201371008140004, 'Muhammad Al Farizi Nasution', 'kampung utan, RT 1,RW 7, , Kalisuren, Kec. Tajurhalang, 16320', '2014-08-10', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(372, 5, 15, 54, 3174040505141011, 'Muhammad Benzema Putra Hidayat', 'Perumahan BIP Blok D22 No. 22, RT 1,RW 16, , Kalisuren, Kec. Tajurhalang, ', '2014-05-05', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(373, 5, 15, 54, 3276102311130009, 'Muhammad Faaiz Ibrahim', 'Perum Samudera Residence Rainbow Blok B65, RT 2,RW 25, , Tajur Halang, Kec. Tajurhalang, ', '2013-11-23', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(374, 5, 15, 54, 3173056206141001, 'Nadine Elvira Sakhi', 'KP. Karet, RT 2,RW 8, , Tajur Halang, Kec. Tajurhalang, ', '2014-06-22', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(375, 5, 15, 54, 3301100305140004, 'NAHLA AKHTAR ABRISAM ANNUR', 'KOMPLEK INKOPAD BLOK C8, RT 10,RW 5, KALISUREN, SASAK PANJANG, Kec. Tajurhalang, 16320', '2014-05-03', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(376, 5, 15, 54, 3201376106140003, 'NAJMAH HAFIDHATUL HASNA', 'Komplek Inkopad Blok F15 No.15, RT 14,RW 5, , Sasak Panjang, Kec. Tajurhalang, 16320', '2014-06-21', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(377, 5, 15, 54, 3276082506140006, 'NATHAN KURNIA LIBIANO', 'Komp. Inkopad Blok D9/1, RT 18,RW 5, , Sasak Panjang, Kec. Tajurhalang, 16320', '2014-06-25', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(378, 5, 15, 55, 3201375912130002, 'Queensha Salik Khalieza', 'Komplek INKOPAD Blok D5/7, RT 4,RW 5, , Sasak Panjang, Kec. Tajurhalang, ', '2013-12-19', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(379, 5, 15, 55, 3271052910130003, 'Raditya Naufal Alghifari', 'Komplek INKOPAD Blok D17/11, RT 19,RW 5, , Sasak Panjang, Kec. Tajurhalang, ', '2013-10-29', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(380, 5, 15, 55, 3174054802141001, 'Rafifatu Rifda prananto', 'Jl. Kri Ajak No. 41 D Komp AL, RT 3,RW 8, , Gandaria Utara, Kec. Kebayoran Baru, ', '2014-02-08', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(381, 5, 15, 55, 3201371311130002, 'Raihaan Atharizz Khalif', 'Komp. Inkopad Blok F15 No 11, RT 14,RW 5, , Sasak Panjang, Kec. Tajurhalang, ', '2013-11-13', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(382, 5, 15, 55, 3174071312131003, 'Rayhan Gavriel Alfatih', 'Avani Gyoen Residence blokB5/01 Jln. Kp Kaliputih RT 03/03 , RT 3,RW , , Citayam, Kec. Tajurhalang, ', '2013-12-13', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(383, 5, 15, 55, 3201374404140003, 'REVITA MAZOYA ZAHIDA', 'KOMPLEK INKOPAD BLOK D16, RT 19,RW 5, SASAK PANJANG, SASAK PANJANG, Kec. Tajurhalang, ', '2014-04-04', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(384, 5, 15, 55, 3175071408131008, 'Rizky Syakur Pratama', 'Perum.Nings Resident Blok L4, RT 0,RW 0, , Kalisuren, Kec. Tajurhalang, 16320', '2013-08-14', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(385, 5, 15, 56, 3310241108130002, 'Sulthan Sabian Putra Agung', 'Jl. Raya Tonjong No 18, RT 0,RW 0, , Tahurhalang, Kec. Kemang, ', '2013-08-11', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(386, 6, 16, 56, 3201371608120002, 'ADRIAN AZMI PAMUNGKAS', 'INKOPAD BLOK D10, RT 17,RW 5, KALISUREN, SASAK PANJANG, Kec. Tajurhalang, 16320', '2012-08-16', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(387, 6, 16, 56, 3201372309120002, 'AGEST ZALFA FIERALDY', 'SARANA INDAH RESIDENCE, RT ,RW , KALISUREN, KALISUREN, Kec. Tajurhalang, 16320', '2012-09-23', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(388, 6, 16, 56, 3201372901130001, 'AHMAD MALIK SAEFULLAH', 'Komplek Inkopad Blok F-23/05, RT 11,RW 5, , Sasak Panjang, Kec. Tajurhalang, 16320', '2013-01-29', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(389, 6, 16, 56, 3210101109130004, 'Al Azhar Radhitya Adikara', 'jln. daun Pandang 05 Deparis Residence B6 No. 18, RT 3,RW 5, , Kalisuren, Kec. Tajurhalang, 16320', '2013-09-11', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(390, 6, 16, 56, 3674052812120003, 'Amhar Izza Mulkillah', 'Perum Pondok Mutiara, RT 4,RW 11, , Sasak Panjang, Kec. Tajurhalang, ', '2012-12-28', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(391, 6, 16, 56, 3201376907131004, 'Annisa Naila Ramadhani Nainggolan', 'Komplek Inkopad Blok G 17/6, RT 8,RW 6, , Sasak Panjang, Kec. Tajurhalang, ', '2013-07-29', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(392, 6, 16, 57, 3201375408131001, 'Aqilla Naila Prastya', 'Perum Alam Hijau Parung Blok Alamada 1/09, RT 3,RW 4, , Kalisuren, Kec. Tajurhalang, ', '2013-08-14', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(393, 6, 16, 57, 3201372208131001, 'Athaya Azzamy Kunteyadji', 'Komplek Inkopad Blok A1 No 18, RT 1,RW 5, , Sasak Panjang, Kec. Tajurhalang, 16320', '2013-08-22', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(394, 6, 16, 57, 3276106109120004, 'AURELIA ZIFFARA AL - AMIN', 'BUMI INDAH PESONA BLOK D 33, RT 3,RW 16, KALISUREN, KALISUREN, Kec. Tajurhalang, ', '2012-09-21', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(395, 6, 16, 57, 3201371308130001, 'Azam Zulfa khoir', 'Komplek Inkopad Blok E 12/2, RT 15,RW 5, , Sasak Panjang, Kec. Tajurhalang, 16320', '2013-08-13', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(396, 6, 16, 57, 3201100710120005, 'Bintang Rizky Firdauz', 'Kampung Lebak Wangi, RT 2,RW 2, , Parung, Kec. Parung, 16330', '2012-10-07', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(397, 6, 16, 57, 3201374703131002, 'CHIKA AURELLIA SAVERO', 'INKOPAD BLOK G1, RT 6,RW 6, SASAK PANJANG, SASAK PANJANG, Kec. Tajurhalang, 16320', '2013-03-07', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(398, 6, 16, 57, 1371116802130003, 'FRECELINNEZ QUEEN DIAMORHA SANTOSO', 'IKUR KOTO, RT 4,RW 1, , KOTO PANJANG IKUA KOTO, Kec. Tajurhalang, ', '2013-01-28', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(399, 6, 16, 58, 3175026212121010, 'Jasmine Alsyaira Piliang', 'Perum.Bumi Indah Pesona Blok D 32, RT 3,RW 16, , Kalisuren, Kec. Tajurhalang, ', '2012-12-22', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(400, 6, 16, 58, 3201371003130002, 'KENZIE ALKHALIFI AGYAN', 'GRIYA KALISUREN BLOK E-4/24, RT 2,RW 15, , Kalisuren, Kec. Tajurhalang, 16320', '2013-03-10', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(401, 6, 16, 58, 3276014909120003, 'Lavilma Zulaikha Qolby', 'Perum Grande Hills Blok J11, RT 6,RW 5, , Citayam, Kec. Tajurhalang, ', '2012-09-09', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(402, 6, 16, 58, 3302021902120005, 'Muhammad Arkharega Rafandra', 'jln Hiu Komplek Samudra Residence blok 21 No. 3, RT 3,RW 25, , Tajur Halang, Kec. Tajurhalang, 16320', '2012-02-19', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(403, 6, 16, 58, 3201371907131002, 'Muhammad Fabian Hardiansyah', 'Komplek INKOPAD Blok E 12/14, RT 16,RW 5, , Sasak Panjang, Kec. Tajurhalang, 16320', '2013-07-19', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(404, 6, 16, 58, 3174032503131006, 'Muhammad Ilyas Prayoga', 'Perum Samudra Residence Cluster Neon Tetra Blok B4/11, RT 0,RW 25, , Sasak Panjang, Kec. Tajurhalang, 16320', '2013-03-25', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(405, 6, 16, 58, 3201042010131001, 'Muzaffar Naveed Hisyam El Azzam', 'Komplek Inkopad Blok G 25/15, RT 6,RW 6, , Sasak Panjang, Kec. Tajurhalang, ', '2013-10-20', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(406, 6, 16, 59, 3201376106130005, 'NAFISAH DZAKIRA AFTHANI', 'INKOPAD BLOK L12 NO 3, RT 10,RW 7, , SASAK PANJANG, Kec. Tajurhalang, 16320', '2013-06-21', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(407, 6, 16, 59, 3201376211130001, 'Naura Althea Cantika', 'Komplek Inkopad Nlok F12 No. 13, RT 13,RW 5, , Sasak Panjang, Kec. Tajurhalang, 16320', '2013-11-22', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(408, 6, 16, 59, 3171070809121002, 'Rafandra Aqlan Rudika', 'Parung Permata Indah Blok B2/1, RT 3,RW 12, , Kalisuren, Kec. Tajurhalang, ', '2012-09-08', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(409, 6, 16, 59, 3174022410121002, 'Rama Khautsar Adhikara', 'Perum Samasta Citayam Blok I/5, RT 4,RW 4, Bulu, Citayam, Kec. Tajurhalang, ', '2012-10-24', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(410, 6, 16, 59, 3201372304131001, 'Sakha Wistara Ahnaf Wibowo', 'Komplek Inkopad Blok F 9/12, RT 13,RW 5, , Sasak Panjang, Kec. Tajurhalang, ', '2013-04-23', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(411, 6, 16, 59, 3671067011120007, 'SHAVIRA SHEANA WIDJONARKO', 'Komplek Inkopad Blok R3 No. 17, RT ,RW , , Sasak Panjang, Kec. Tajurhalang, ', '2012-11-30', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(412, 6, 16, 59, 3201376707130004, 'TAJ HANUN', 'GRIYA KALISUREN ASRI BLOK D5 No.19, RT 1,RW 15, , Kalisuren, Kec. Tajurhalang, 16320', '2013-07-27', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(413, 6, 16, 60, 3276114502130002, 'Yasmin Rizky', 'Jl. Serua Raya Perum Graha Yasa Asri Blok C No. 12, RT ,RW , , Serua, Kec. Bojongsari, ', '2013-02-05', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(414, 6, 17, 60, 3173050112121005, 'Albianza Chalief Ahnafa', 'Kp Kalisuren, RT ,RW , , Kalisuren, Kec. Tajurhalang, ', '2012-12-01', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(415, 6, 17, 60, 3201375012121001, 'ARETHA MARYAM BETA AYUNDARIS', 'BUMI INSANI BLOK B6A, RT 4,RW 9, , TONJONG, Kec. Tajurhalang, 16320', '2012-12-10', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(416, 6, 17, 60, 3173015005131008, 'Ayra Yuristika Ahwani Salsabila', 'Jalan Kampung Baru, RT 0,RW 0, , Kampung Baru, Kec. Tajurhalang, 16320', '2013-05-10', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(417, 6, 17, 60, 3201376505131001, 'DINDA AISYAQILA', 'KP.UTAN, RT 3,RW 7, , KALISUREN, Kec. Tajurhalang, 16320', '2013-05-25', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(418, 6, 17, 60, 3201370103131001, 'Erlangga Cakra Buana', 'Komp. Inkopad Blok E3/01, RT 6,RW 5, , Sasak Panjang, Kec. Tajurhalang, ', '2013-03-01', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(419, 6, 17, 60, 3201376206130001, 'Fahira Nur Azura', 'Perum.Griya Kalisuren Asri Blok 4/3, RT 3,RW 15, , Kalisuren, Kec. Tajurhalang, ', '2013-06-22', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(420, 6, 17, 61, 3674035406130002, 'KHANSA JAUZA ALYA', 'KP BULU, RT 1,RW 5, , CITAYAM, Kec. Tajurhalang, 16320', '2013-06-14', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(421, 6, 17, 61, 3171074704131002, 'Kirania Putri Asyifa', 'Komplek Samudera Residence Cluster Leopard B80/12, RT 1,RW 23, , Tajur Halang, Kec. Tajurhalang, 16320', '2013-04-07', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(422, 6, 17, 61, 3276114510120001, 'Lalita ainaa\'edian Putri', 'Perum De Paris Residence, RT 3,RW 5, , Kalisuren, Kec. Tajurhalang, ', '2012-10-05', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(423, 6, 17, 61, 3201370311120002, 'Mochammad Al Irsyad Billah', 'Perum.Parung Permata Indah Blok f 4/6, RT ,RW , , Kalisuren, Kec. Tajurhalang, ', '2012-11-03', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(424, 6, 17, 61, 3171012406131002, 'MUHAMMAD AZZAAM FAUZAN', 'PERUMAHAN PARUNG PERMATA INDAH E3/26, RT 6,RW 12, , KALSUREN, Kec. Tajurhalang, ', '2013-06-24', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(425, 6, 17, 61, 3201371401131001, 'MUHAMMAD FAUZAN HAIDAR', 'INKOPAD BLOK K2/3, RT 16,RW 6, , SASAK PANJANG, Kec. Tajurhalang, 16320', '2013-01-14', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(426, 6, 17, 61, 3276033011120001, 'MUHAMMAD HANIF ALI MAHENDRA', 'MELATI TIRTA TIMUR BLOK BD 35, RT ,RW , , Pengasinan, Kec. Sawangan, 16518', '2012-11-30', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(427, 6, 17, 62, 3276032509120001, 'Muhammad Razi Barakah', 'Perum Bumi Sawangan Indah Blok D3a/122, RT 7,RW 10, , Pengasinan, Kec. Sawangan, ', '2012-09-25', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(428, 6, 17, 62, 3174051905131008, 'MUHAMMAD SULTAN SUGIYANTO PUTRA', 'INKOPAD BLOK B11 NO 4, RT 9,RW 5, SASAK PANJANG, SASAK PANJANG, Kec. Tajurhalang, ', '2013-05-19', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(429, 6, 17, 62, 3201104711120001, 'NAHLAH ALTHAFUNNISA RACHMAN', 'DE PARIS BLOK C22/21, RT ,RW , , KALISUREN, Kec. Tajurhalang, 16320', '2012-11-07', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(430, 6, 17, 62, 3201044708120004, 'NAMIRA AYSIRA', 'PERUM RSCM BLOK A. 5/2, RT 3,RW 9, , CILEBUT BARAT, Kec. Sukaraja, 16710', '2012-08-07', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(431, 6, 17, 62, 3201371108120001, 'Prayata Kautsar Delkash', 'Perum Inkopad Blok K6/20, RT 16,RW 6, , Sasak Panjang, Kec. Tajurhalang, ', '2012-08-11', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(432, 6, 17, 62, 3201374610130004, 'Qisya Shazia Husna', 'Komp. Inkopad Blok E15/13, RT 16,RW 5, , Sasak Panjang, Kec. Tajurhalang, ', '2013-10-06', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(433, 6, 17, 62, 3201371004130002, 'Raden Asyraf Fachrul Ahza', 'Jl. Raya Inkopad Perum.Graha suaka klola Kalisuren, RT ,RW , , Kalisuren, Kec. Tajurhalang, ', '2013-04-10', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(434, 6, 17, 63, 3276111604130002, 'Raffa Az Zayyan Putra Fauzi', 'Duren Mekar, RT 3,RW 1, , Duren Mekar, Kec. Bojongsari, ', '2013-04-16', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(435, 6, 17, 63, 3276031106120004, 'Rafie Zain Akbar', 'BSI Blok A4 No. 18, RT 2,RW 9, , Pengasinan, Kec. Sawangan, 16518', '2012-06-11', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(436, 6, 17, 63, 3171026801131006, 'RAIN NADHEERA ALARICE', 'Perumahan Jatijajar Blok E12 No. 27, Jatijajar Tapos Depok, RT 5,RW 14, , Jatijajar, Kec. Tapos, 16455', '2013-01-28', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(437, 6, 17, 63, 3201370112070009, 'RAVA ELHURR HUSAYN', 'INKOPAD BLOK B7/9, RT 2,RW 5, , SASAK PANJANG, Kec. Tajurhalang, 16320', '2013-05-06', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(438, 6, 17, 63, 3172021804120001, 'SALMAN AL FARISI', 'Jl. STM Walang Jaya Gang Sepakat N0. 79, RT 7,RW 5, , Tugu Selatan, Kec. Koja, ', '2012-04-12', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(439, 6, 17, 63, 3201376909131001, 'SHAZIA NAZHIFA', 'KOMPLEK INKOPAD BLOK F18, RT 14,RW 5, SASAK PANJANG, SASAK PANJANG, Kec. Tajurhalang, 16320', '2013-09-29', 'Perempuan', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(440, 6, 17, 63, 3201372502130001, 'SYAHN ATHARAYA NUGROHO', 'KOMPLEK INKOPAD BLOK E1, RT 2,RW 6, SASAK PANJANG, SASAK PANJANG, Kec. Tajurhalang, 16320', '2013-02-25', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49'),
(441, 6, 17, 64, 1471916811170001, 'Zabran Safaraz', 'Kubang jaya, RT 0,RW 0, , kubang jaya, Kec. Siak Hulu, ', '2013-06-14', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49');
INSERT INTO `data_santri` (`id`, `id_grup_cabang`, `id_grup_santri`, `id_grup_kelompok`, `no_identitas`, `nama_lengkap`, `alamat`, `tgl_lahir`, `jenis_kelamin`, `keterangan`, `link_sertifikat`, `status`, `created_at`, `updated_at`) VALUES
(442, 6, 17, 64, 3201371402130003, 'Zulfan Fayyadh', 'Kp Sasak Panjang, RT 1,RW 2, Sasak Panjang, Sasak Panjang, Kec. Tajurhalang, ', '2013-02-14', 'Laki-Laki', '', '', 0, '2025-01-31 09:13:49', '2025-01-31 09:13:49');

-- --------------------------------------------------------

--
-- Table structure for table `data_walisantri`
--

CREATE TABLE `data_walisantri` (
  `id` bigint UNSIGNED NOT NULL,
  `id_santri` bigint UNSIGNED NOT NULL,
  `nama_wali` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_identitas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telepon` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `hubungan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `grup_cabang`
--

CREATE TABLE `grup_cabang` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_grup` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_grup` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `grup_cabang`
--

INSERT INTO `grup_cabang` (`id`, `nama_grup`, `alamat_grup`, `created_at`, `updated_at`) VALUES
(1, 'Kelas 1', 'Jl. Pangeran Diponegoro - Belakang Pasar', '2024-12-20 18:36:18', '2025-02-07 00:54:42'),
(2, 'Kelas 2', 'Jl. Ir Soekarno Hatta No.56', '2024-12-20 18:36:26', '2024-12-20 18:36:26'),
(3, 'Kelas 3', 'Jl. Diponegoro', '2025-01-31 01:22:53', '2025-01-31 01:22:53'),
(4, 'Kelas 4', 'Jl. Ir. Soekarno', '2025-01-31 01:22:53', '2025-01-31 01:22:53'),
(5, 'Kelas 5', 'Jl. Bypass Ngurah Rai', '2025-01-31 01:22:53', '2025-01-31 01:22:53'),
(6, 'Kelas 6', 'Jl. Denpasar', '2025-01-31 01:22:53', '2025-01-31 01:22:53'),
(10, 'Kelas 7', 'Jl. Dr. Cipto Mangunkusumo', '2025-02-06 05:06:58', '2025-02-06 05:06:58');

-- --------------------------------------------------------

--
-- Table structure for table `grup_santri`
--

CREATE TABLE `grup_santri` (
  `id` bigint UNSIGNED NOT NULL,
  `id_cabang` bigint UNSIGNED NOT NULL,
  `nama_grup` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_maksimal` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `grup_santri`
--

INSERT INTO `grup_santri` (`id`, `id_cabang`, `nama_grup`, `jumlah_maksimal`, `created_at`, `updated_at`) VALUES
(1, 1, 'Rombel 1A', 24, '2024-12-20 18:36:37', '2024-12-20 18:36:37'),
(2, 1, 'Rombel 1B', 23, '2024-12-20 18:36:44', '2024-12-20 18:36:44'),
(3, 1, 'Rombel 1C', 23, '2025-01-31 01:31:33', '2025-01-31 01:31:33'),
(4, 1, 'Rombel 1D', 23, '2025-01-31 01:31:33', '2025-01-31 01:31:33'),
(5, 2, 'Rombel 2A', 24, '2025-01-31 01:33:05', '2025-01-31 01:33:05'),
(6, 2, 'Rombel 2B', 25, '2025-01-31 01:33:05', '2025-01-31 01:33:05'),
(7, 2, 'Rombel 2C', 25, '2025-01-31 01:33:05', '2025-01-31 01:33:05'),
(8, 3, 'Rombel 3A', 29, '2025-01-31 01:33:05', '2025-01-31 01:33:05'),
(9, 3, 'Rombel 3B', 28, '2025-01-31 01:53:35', '2025-01-31 01:53:35'),
(10, 3, 'Rombel 3C', 28, '2025-01-31 01:53:35', '2025-01-31 01:53:35'),
(11, 4, 'Rombel 4A', 25, '2025-01-31 01:53:35', '2025-01-31 01:53:35'),
(12, 4, 'Rombel 4B', 24, '2025-01-31 01:53:35', '2025-01-31 01:53:35'),
(13, 4, 'Rombel 4C', 25, '2025-01-31 01:53:35', '2025-01-31 01:53:35'),
(14, 5, 'Rombel 5A', 28, '2025-01-31 01:53:35', '2025-01-31 01:53:35'),
(15, 5, 'Rombel 5B', 31, '2025-01-31 01:57:30', '2025-01-31 01:57:30'),
(16, 6, 'Rombel 6A', 28, '2025-01-31 01:57:30', '2025-01-31 01:57:30'),
(17, 6, 'Rombel 6B', 29, '2025-01-31 01:57:30', '2025-01-31 01:57:30'),
(20, 10, 'Rombel 7AB', 15, '2025-02-06 06:35:07', '2025-02-07 00:56:54');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id` bigint UNSIGNED NOT NULL,
  `id_guru` bigint UNSIGNED NOT NULL,
  `id_santri` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `juz`
--

CREATE TABLE `juz` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_juz` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `juz`
--

INSERT INTO `juz` (`id`, `nama_juz`, `created_at`, `updated_at`) VALUES
(17, 'Juz 30', '2025-01-08 08:29:55', '2025-01-08 08:29:55');

-- --------------------------------------------------------

--
-- Table structure for table `juz_level`
--

CREATE TABLE `juz_level` (
  `id` bigint UNSIGNED NOT NULL,
  `id_juz` bigint UNSIGNED DEFAULT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `juz_level`
--

INSERT INTO `juz_level` (`id`, `id_juz`, `level`, `created_at`, `updated_at`) VALUES
(46, 17, '1', '2025-01-09 20:08:39', '2025-01-09 20:08:39');

-- --------------------------------------------------------

--
-- Table structure for table `juz_surat`
--

CREATE TABLE `juz_surat` (
  `id` bigint UNSIGNED NOT NULL,
  `id_juz_level` bigint UNSIGNED DEFAULT NULL,
  `nama_surat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `juz_surat`
--

INSERT INTO `juz_surat` (`id`, `id_juz_level`, `nama_surat`, `created_at`, `updated_at`) VALUES
(37, 46, 'An-Naba', '2025-01-09 20:11:12', '2025-01-09 20:11:12'),
(38, 46, 'An-Nazi\'at', '2025-01-09 20:11:12', '2025-01-09 20:11:12'),
(39, 46, 'Abasa', '2025-01-09 20:11:12', '2025-01-09 20:11:12'),
(40, 46, 'At-Takwir', '2025-01-09 20:11:12', '2025-01-09 20:11:12'),
(41, 46, 'Al-Infitar', '2025-01-09 20:11:12', '2025-01-09 20:11:12'),
(42, 46, 'Al-Mutaffifin', '2025-01-09 20:11:12', '2025-01-09 20:11:12'),
(43, 46, 'Al-Inshiqaq', '2025-01-09 20:11:12', '2025-01-09 20:11:12'),
(44, 46, 'Al-Buruj', '2025-01-09 20:11:12', '2025-01-09 20:11:12'),
(45, 46, 'At-Tariq', '2025-01-09 20:11:12', '2025-01-09 20:11:12'),
(46, 46, 'Al-A\'la', '2025-01-09 20:11:12', '2025-01-09 20:11:12'),
(47, 46, 'Al-Ghashiya', '2025-01-09 20:11:12', '2025-01-09 20:11:12'),
(48, 46, 'Al-Fajr', '2025-01-09 20:11:12', '2025-01-09 20:11:12'),
(49, 46, 'Al-Balad', '2025-01-09 20:11:12', '2025-01-09 20:11:12'),
(50, 46, 'Ash-Shams', '2025-01-09 20:11:12', '2025-01-09 20:11:12'),
(51, 46, 'Al-Lail', '2025-01-09 20:11:12', '2025-01-09 20:11:12'),
(52, 46, 'Ad-Duha', '2025-01-09 20:11:12', '2025-01-09 20:11:12'),
(53, 46, 'Al-Inshirah', '2025-01-09 20:11:12', '2025-01-09 20:11:12'),
(54, 46, 'At-Tin', '2025-01-09 20:11:12', '2025-01-09 20:11:12'),
(55, 46, 'Al-Alaq', '2025-01-09 20:11:12', '2025-01-09 20:11:12'),
(56, 46, 'Al-Qadr', '2025-01-09 20:11:12', '2025-01-09 20:11:12'),
(57, 46, 'Al-Bayyina', '2025-01-09 20:11:12', '2025-01-09 20:11:12'),
(58, 46, 'Az-Zalzalah', '2025-01-09 20:11:12', '2025-01-09 20:11:12'),
(59, 46, 'Al-Adiyat', '2025-01-09 20:11:12', '2025-01-09 20:11:12'),
(60, 46, 'Al-Qari\'ah', '2025-01-09 20:11:12', '2025-01-09 20:11:12'),
(61, 46, 'At-Takathur', '2025-01-09 20:11:12', '2025-01-09 20:11:12'),
(62, 46, 'Al-Asr', '2025-01-09 20:11:12', '2025-01-09 20:11:12'),
(63, 46, 'Al-Humazah', '2025-01-09 20:11:12', '2025-01-09 20:11:12'),
(64, 46, 'Al-Fil', '2025-01-09 20:11:12', '2025-01-09 20:11:12'),
(65, 46, 'Quraish', '2025-01-09 20:11:12', '2025-01-09 20:11:12'),
(66, 46, 'Al-Ma\'un', '2025-01-09 20:11:12', '2025-01-09 20:11:12'),
(67, 46, 'Al-Kawthar', '2025-01-09 20:11:12', '2025-01-09 20:11:12'),
(68, 46, 'Al-Kafirun', '2025-01-09 20:11:12', '2025-01-09 20:11:12'),
(69, 46, 'An-Nasr', '2025-01-09 20:11:12', '2025-01-09 20:11:12'),
(70, 46, 'Al-Masad', '2025-01-09 20:11:12', '2025-01-09 20:11:12'),
(71, 46, 'Al-Ikhlas', '2025-01-09 20:11:12', '2025-01-09 20:11:12'),
(72, 46, 'Al-Falaq', '2025-01-09 20:11:12', '2025-01-09 20:11:12'),
(73, 46, 'An-Nas', '2025-01-09 20:11:12', '2025-01-09 20:11:12');

-- --------------------------------------------------------

--
-- Table structure for table `kelompok_quran`
--

CREATE TABLE `kelompok_quran` (
  `id` bigint UNSIGNED NOT NULL,
  `id_rombel` bigint UNSIGNED NOT NULL,
  `nama_kelompok` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `jumlah` int NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kelompok_quran`
--

INSERT INTO `kelompok_quran` (`id`, `id_rombel`, `nama_kelompok`, `jumlah`, `created_at`, `updated_at`) VALUES
(1, 1, 'Kelompok 1', 6, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(2, 1, 'Kelompok 2', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(3, 1, 'Kelompok 3', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(4, 1, 'Kelompok 4', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(5, 2, 'Kelompok 5', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(6, 2, 'Kelompok 6', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(7, 0, 'Kelompok 7', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(8, 0, 'Kelompok 8', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(9, 0, 'Kelompok 9', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(10, 0, 'Kelompok 10', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(11, 0, 'Kelompok 11', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(12, 0, 'Kelompok 12', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(13, 0, 'Kelompok 13', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(14, 0, 'Kelompok 14', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(15, 0, 'Kelompok 15', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(16, 0, 'Kelompok 16', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(17, 0, 'Kelompok 17', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(18, 0, 'Kelompok 18', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(19, 0, 'Kelompok 19', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(20, 0, 'Kelompok 20', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(21, 0, 'Kelompok 21', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(22, 0, 'Kelompok 22', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(23, 0, 'Kelompok 23', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(24, 0, 'Kelompok 24', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(25, 0, 'Kelompok 25', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(26, 0, 'Kelompok 26', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(27, 0, 'Kelompok 27', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(28, 0, 'Kelompok 28', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(29, 0, 'Kelompok 29', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(30, 0, 'Kelompok 30', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(31, 0, 'Kelompok 31', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(32, 0, 'Kelompok 32', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(33, 0, 'Kelompok 33', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(34, 0, 'Kelompok 34', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(35, 0, 'Kelompok 35', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(36, 0, 'Kelompok 36', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(37, 0, 'Kelompok 37', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(38, 0, 'Kelompok 38', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(39, 0, 'Kelompok 39', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(40, 0, 'Kelompok 40', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(41, 0, 'Kelompok 41', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(42, 0, 'Kelompok 42', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(43, 0, 'Kelompok 43', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(44, 0, 'Kelompok 44', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(45, 0, 'Kelompok 45', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(46, 0, 'Kelompok 46', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(47, 0, 'Kelompok 47', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(48, 0, 'Kelompok 48', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(49, 0, 'Kelompok 49', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(50, 0, 'Kelompok 50', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(51, 0, 'Kelompok 51', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(52, 0, 'Kelompok 52', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(53, 0, 'Kelompok 53', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(54, 0, 'Kelompok 54', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(55, 0, 'Kelompok 55', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(56, 0, 'Kelompok 56', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(57, 0, 'Kelompok 57', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(58, 0, 'Kelompok 58', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(59, 0, 'Kelompok 59', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(60, 0, 'Kelompok 60', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(61, 0, 'Kelompok 61', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(62, 0, 'Kelompok 62', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(63, 0, 'Kelompok 63', 7, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(64, 0, 'Kelompok 64', 2, '2025-01-31 15:40:01', '2025-01-31 15:40:01'),
(65, 20, 'Kelompok Utsman bin Affan', 5, '2025-02-06 15:15:03', '2025-02-07 08:13:37');

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_12_11_132242_db_tsabata', 1);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_mtahfidz`
--

CREATE TABLE `nilai_mtahfidz` (
  `id` bigint UNSIGNED NOT NULL,
  `id_guru` bigint UNSIGNED NOT NULL,
  `id_santri` bigint UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `juz` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_juz` bigint UNSIGNED NOT NULL,
  `id_juz_level` bigint UNSIGNED NOT NULL,
  `pengetahuan` int NOT NULL,
  `fashohah` int NOT NULL,
  `tajwid` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nilai_mtahfidz`
--

INSERT INTO `nilai_mtahfidz` (`id`, `id_guru`, `id_santri`, `tanggal`, `juz`, `id_juz`, `id_juz_level`, `pengetahuan`, `fashohah`, `tajwid`, `created_at`, `updated_at`) VALUES
(1, 3, 15, '2025-01-09', '17', 46, 37, 80, 80, 80, '2025-01-09 20:38:38', '2025-01-09 20:38:38'),
(2, 2, 14, '2025-01-10', '17', 46, 40, 22, 22, 22, '2025-01-10 08:57:06', '2025-01-10 08:57:06'),
(3, 25, 14, '2018-12-12', '17', 46, 54, 8, 7, 9, '2025-01-10 10:46:31', '2025-01-10 10:46:31'),
(4, 3, 15, '2025-01-10', '17', 46, 37, 80, 80, 80, '2025-01-10 12:33:55', '2025-01-10 12:33:55'),
(5, 3, 14, '2025-01-23', '17', 46, 55, 80, 80, 90, '2025-01-23 07:57:37', '2025-01-23 07:57:37'),
(6, 3, 14, '2025-01-24', '17', 46, 47, 80, 80, 90, '2025-01-24 01:52:18', '2025-01-24 01:52:18');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_mtahsin`
--

CREATE TABLE `nilai_mtahsin` (
  `id` bigint UNSIGNED NOT NULL,
  `id_guru` bigint UNSIGNED NOT NULL,
  `id_santri` bigint UNSIGNED NOT NULL,
  `jilid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nilai_mtahsin`
--

INSERT INTO `nilai_mtahsin` (`id`, `id_guru`, `id_santri`, `jilid`, `level`, `nilai`, `created_at`, `updated_at`) VALUES
(1, 2, 14, '1', '1', 22, '2025-01-10 09:03:31', '2025-01-10 09:03:31'),
(2, 25, 14, '5', '3/4', 9, '2025-01-10 10:51:30', '2025-01-10 10:51:30'),
(3, 3, 14, '1', '17', 82, '2025-01-30 02:57:04', '2025-01-30 02:57:04'),
(4, 3, 15, '1', '17', 82, '2025-01-30 02:57:16', '2025-01-30 02:57:16');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_murojaah`
--

CREATE TABLE `nilai_murojaah` (
  `id` bigint UNSIGNED NOT NULL,
  `id_guru` bigint UNSIGNED NOT NULL,
  `id_santri` bigint UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `juz` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_surah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nilai_murojaah`
--

INSERT INTO `nilai_murojaah` (`id`, `id_guru`, `id_santri`, `tanggal`, `waktu`, `juz`, `nama_surah`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 3, 15, '2025-01-08', '22:00:00', '17', 'An-Naba', 'Sudah', '2025-01-09 20:30:37', '2025-01-09 20:30:37');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_ptahfidz`
--

CREATE TABLE `nilai_ptahfidz` (
  `id` bigint UNSIGNED NOT NULL,
  `id_guru` bigint UNSIGNED NOT NULL,
  `id_santri` bigint UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `id_juz` bigint UNSIGNED NOT NULL,
  `id_surah` bigint UNSIGNED NOT NULL,
  `ayat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nilai_ptahfidz`
--

INSERT INTO `nilai_ptahfidz` (`id`, `id_guru`, `id_santri`, `tanggal`, `id_juz`, `id_surah`, `ayat`, `keterangan`, `created_at`, `updated_at`) VALUES
(30, 27, 35, '2025-02-14', 17, 37, '10', 'Belum Lancar', '2025-02-14 07:20:19', '2025-02-14 08:04:26'),
(31, 27, 1, '2025-02-14', 17, 48, '7', 'Lancar', '2025-02-14 07:28:46', '2025-02-14 07:28:46'),
(32, 27, 16, '2025-02-14', 17, 47, '22', 'Lancar', '2025-02-14 07:40:19', '2025-02-14 08:16:14'),
(33, 27, 14, '2025-02-14', 17, 38, '7', 'Belum ada', '2025-02-14 07:41:24', '2025-02-14 07:41:24');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_ptahsin`
--

CREATE TABLE `nilai_ptahsin` (
  `id` bigint UNSIGNED NOT NULL,
  `id_guru` bigint UNSIGNED NOT NULL,
  `id_santri` bigint UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `jilid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `halaman` int NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nilai_ptahsin`
--

INSERT INTO `nilai_ptahsin` (`id`, `id_guru`, `id_santri`, `tanggal`, `jilid`, `halaman`, `keterangan`, `created_at`, `updated_at`) VALUES
(53, 27, 28, '2025-02-13', '5', 12, 'Belum lancar', '2025-02-12 17:07:35', '2025-02-12 17:07:35'),
(54, 27, 29, '2025-02-13', '1', 12, 'Belum lancar', '2025-02-12 17:26:11', '2025-02-12 17:26:11'),
(55, 27, 31, '2025-02-13', '1', 12, 'Belum lancar', '2025-02-12 17:26:39', '2025-02-12 17:26:39'),
(56, 27, 30, '2025-02-13', '5', 12, 'Belum lancar', '2025-02-12 17:26:57', '2025-02-12 17:26:57'),
(57, 27, 1, '2025-02-13', '1', 12, 'Lancar', '2025-02-12 17:27:38', '2025-02-12 17:27:38'),
(58, 27, 35, '2025-02-13', '2', 10, 'Belum lancar', '2025-02-13 13:36:24', '2025-02-13 13:36:24'),
(59, 27, 36, '2025-02-13', '5', 10, 'Belum lancar', '2025-02-13 13:36:48', '2025-02-13 13:36:48'),
(60, 27, 1, '2025-02-14', '2', 12, 'Lancar', '2025-02-14 02:34:33', '2025-02-14 02:34:33'),
(61, 27, 2, '2025-02-14', '2', 8, 'Lancar', '2025-02-14 02:34:52', '2025-02-14 02:34:52'),
(62, 27, 30, '2025-02-14', '5', 10, 'Belum lancar', '2025-02-14 09:02:31', '2025-02-14 09:02:31'),
(63, 27, 28, '2025-02-14', '2', 10, 'Lancar', '2025-02-14 09:02:53', '2025-02-14 09:02:53');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_tasmi`
--

CREATE TABLE `nilai_tasmi` (
  `id` bigint UNSIGNED NOT NULL,
  `id_guru` bigint UNSIGNED NOT NULL,
  `id_santri` bigint UNSIGNED NOT NULL,
  `juz` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tajwid1` int NOT NULL,
  `tajwid2` int NOT NULL,
  `tajwid3` int NOT NULL,
  `tajwid4` int NOT NULL,
  `fashohah1` int NOT NULL,
  `fashohah2` int NOT NULL,
  `fashohah3` int NOT NULL,
  `fashohah4` int NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nilai_tasmi`
--

INSERT INTO `nilai_tasmi` (`id`, `id_guru`, `id_santri`, `juz`, `tajwid1`, `tajwid2`, `tajwid3`, `tajwid4`, `fashohah1`, `fashohah2`, `fashohah3`, `fashohah4`, `status`, `created_at`, `updated_at`) VALUES
(6, 2, 14, 'Juz 30', 80, 85, 90, 95, 80, 85, 90, 95, 1, '2025-01-02 01:45:45', '2025-01-02 01:45:45'),
(7, 2, 14, 'Juz 29', 80, 85, 90, 95, 80, 85, 90, 95, 1, '2025-01-02 01:46:33', '2025-01-02 01:46:33');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('tVOjKSjw6P98E6mvZSeX779iEpYAvcFSi4ZosXFQ', 27, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36 Edg/133.0.0.0', 'YToyMzp7czo2OiJfdG9rZW4iO3M6NDA6InhJV1R1WWN0cEZxNERkY3E4bVE4S0JEdlAya3JnMVA5bnY3TTU5MkUiO3M6NjoiX2ZsYXNoIjthOjI6e3M6MzoibmV3IjthOjA6e31zOjM6Im9sZCI7YTowOnt9fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM0OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvbWFzdGVyLW5pbGFpIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjc7czo3OiJpZF9ndXJ1IjtpOjI3O3M6OToiaWRfc2FudHJpIjtzOjI6IjE2IjtzOjEyOiJpZEdydXBDYWJhbmciO3M6MToiMSI7czoxMjoiaWRHcnVwU2FudHJpIjtzOjE6IjIiO3M6MTQ6ImlkR3J1cEtlbG9tcG9rIjtzOjE6IjUiO3M6NzoidGFuZ2dhbCI7czoxMDoiMjAyNS0wMi0xNCI7czo2OiJpZF9qdXoiO3M6MjoiNDYiO3M6NzoibGV2ZWxJRCI7czoyOiI0NiI7czo4OiJpZF9zdXJhaCI7czoyOiI0OCI7czoxMDoic2FudHJpRGF0YSI7YTo2OntpOjA7Tzo4OiJzdGRDbGFzcyI6Mjp7czoyOiJpZCI7aToyODtzOjEyOiJuYW1hX2xlbmdrYXAiO3M6MjY6IkFobWFkIFNhaGlsIFJpenFpIFJhbWFkaGFuIjt9aToxO086ODoic3RkQ2xhc3MiOjI6e3M6MjoiaWQiO2k6Mjk7czoxMjoibmFtYV9sZW5na2FwIjtzOjIxOiJBaXN5YWggUWltb3JhIFdpZGFudGkiO31pOjI7Tzo4OiJzdGRDbGFzcyI6Mjp7czoyOiJpZCI7aTozMDtzOjEyOiJuYW1hX2xlbmdrYXAiO3M6MzE6IkFsbGVhbmRyYSBOdWhhIExhaWxhdHVzIFdpdGRpeW8iO31pOjM7Tzo4OiJzdGRDbGFzcyI6Mjp7czoyOiJpZCI7aTozMTtzOjEyOiJuYW1hX2xlbmdrYXAiO3M6MjA6IkFubmlzYSBSaXpxaWFoIERhbmlhIjt9aTo0O086ODoic3RkQ2xhc3MiOjI6e3M6MjoiaWQiO2k6MzI7czoxMjoibmFtYV9sZW5na2FwIjtzOjI4OiJBeWVzaGEgSW5heWF0aWxsYWggUmlzeWFub3ZhIjt9aTo1O086ODoic3RkQ2xhc3MiOjI6e3M6MjoiaWQiO2k6MzQ7czoxMjoibmFtYV9sZW5na2FwIjtzOjIwOiJBenphbSBNYWhhc2luIEFjaG1hZCI7fX1zOjk6InN1cmFoRGF0YSI7YTozNzp7aTowO086ODoic3RkQ2xhc3MiOjI6e3M6MjoiaWQiO2k6Mzc7czoxMDoibmFtYV9zdXJhdCI7czo3OiJBbi1OYWJhIjt9aToxO086ODoic3RkQ2xhc3MiOjI6e3M6MjoiaWQiO2k6Mzg7czoxMDoibmFtYV9zdXJhdCI7czoxMDoiQW4tTmF6aSdhdCI7fWk6MjtPOjg6InN0ZENsYXNzIjoyOntzOjI6ImlkIjtpOjM5O3M6MTA6Im5hbWFfc3VyYXQiO3M6NToiQWJhc2EiO31pOjM7Tzo4OiJzdGRDbGFzcyI6Mjp7czoyOiJpZCI7aTo0MDtzOjEwOiJuYW1hX3N1cmF0IjtzOjk6IkF0LVRha3dpciI7fWk6NDtPOjg6InN0ZENsYXNzIjoyOntzOjI6ImlkIjtpOjQxO3M6MTA6Im5hbWFfc3VyYXQiO3M6MTA6IkFsLUluZml0YXIiO31pOjU7Tzo4OiJzdGRDbGFzcyI6Mjp7czoyOiJpZCI7aTo0MjtzOjEwOiJuYW1hX3N1cmF0IjtzOjEzOiJBbC1NdXRhZmZpZmluIjt9aTo2O086ODoic3RkQ2xhc3MiOjI6e3M6MjoiaWQiO2k6NDM7czoxMDoibmFtYV9zdXJhdCI7czoxMToiQWwtSW5zaGlxYXEiO31pOjc7Tzo4OiJzdGRDbGFzcyI6Mjp7czoyOiJpZCI7aTo0NDtzOjEwOiJuYW1hX3N1cmF0IjtzOjg6IkFsLUJ1cnVqIjt9aTo4O086ODoic3RkQ2xhc3MiOjI6e3M6MjoiaWQiO2k6NDU7czoxMDoibmFtYV9zdXJhdCI7czo4OiJBdC1UYXJpcSI7fWk6OTtPOjg6InN0ZENsYXNzIjoyOntzOjI6ImlkIjtpOjQ2O3M6MTA6Im5hbWFfc3VyYXQiO3M6NzoiQWwtQSdsYSI7fWk6MTA7Tzo4OiJzdGRDbGFzcyI6Mjp7czoyOiJpZCI7aTo0NztzOjEwOiJuYW1hX3N1cmF0IjtzOjExOiJBbC1HaGFzaGl5YSI7fWk6MTE7Tzo4OiJzdGRDbGFzcyI6Mjp7czoyOiJpZCI7aTo0ODtzOjEwOiJuYW1hX3N1cmF0IjtzOjc6IkFsLUZhanIiO31pOjEyO086ODoic3RkQ2xhc3MiOjI6e3M6MjoiaWQiO2k6NDk7czoxMDoibmFtYV9zdXJhdCI7czo4OiJBbC1CYWxhZCI7fWk6MTM7Tzo4OiJzdGRDbGFzcyI6Mjp7czoyOiJpZCI7aTo1MDtzOjEwOiJuYW1hX3N1cmF0IjtzOjk6IkFzaC1TaGFtcyI7fWk6MTQ7Tzo4OiJzdGRDbGFzcyI6Mjp7czoyOiJpZCI7aTo1MTtzOjEwOiJuYW1hX3N1cmF0IjtzOjc6IkFsLUxhaWwiO31pOjE1O086ODoic3RkQ2xhc3MiOjI6e3M6MjoiaWQiO2k6NTI7czoxMDoibmFtYV9zdXJhdCI7czo3OiJBZC1EdWhhIjt9aToxNjtPOjg6InN0ZENsYXNzIjoyOntzOjI6ImlkIjtpOjUzO3M6MTA6Im5hbWFfc3VyYXQiO3M6MTE6IkFsLUluc2hpcmFoIjt9aToxNztPOjg6InN0ZENsYXNzIjoyOntzOjI6ImlkIjtpOjU0O3M6MTA6Im5hbWFfc3VyYXQiO3M6NjoiQXQtVGluIjt9aToxODtPOjg6InN0ZENsYXNzIjoyOntzOjI6ImlkIjtpOjU1O3M6MTA6Im5hbWFfc3VyYXQiO3M6NzoiQWwtQWxhcSI7fWk6MTk7Tzo4OiJzdGRDbGFzcyI6Mjp7czoyOiJpZCI7aTo1NjtzOjEwOiJuYW1hX3N1cmF0IjtzOjc6IkFsLVFhZHIiO31pOjIwO086ODoic3RkQ2xhc3MiOjI6e3M6MjoiaWQiO2k6NTc7czoxMDoibmFtYV9zdXJhdCI7czoxMDoiQWwtQmF5eWluYSI7fWk6MjE7Tzo4OiJzdGRDbGFzcyI6Mjp7czoyOiJpZCI7aTo1ODtzOjEwOiJuYW1hX3N1cmF0IjtzOjExOiJBei1aYWx6YWxhaCI7fWk6MjI7Tzo4OiJzdGRDbGFzcyI6Mjp7czoyOiJpZCI7aTo1OTtzOjEwOiJuYW1hX3N1cmF0IjtzOjk6IkFsLUFkaXlhdCI7fWk6MjM7Tzo4OiJzdGRDbGFzcyI6Mjp7czoyOiJpZCI7aTo2MDtzOjEwOiJuYW1hX3N1cmF0IjtzOjEwOiJBbC1RYXJpJ2FoIjt9aToyNDtPOjg6InN0ZENsYXNzIjoyOntzOjI6ImlkIjtpOjYxO3M6MTA6Im5hbWFfc3VyYXQiO3M6MTE6IkF0LVRha2F0aHVyIjt9aToyNTtPOjg6InN0ZENsYXNzIjoyOntzOjI6ImlkIjtpOjYyO3M6MTA6Im5hbWFfc3VyYXQiO3M6NjoiQWwtQXNyIjt9aToyNjtPOjg6InN0ZENsYXNzIjoyOntzOjI6ImlkIjtpOjYzO3M6MTA6Im5hbWFfc3VyYXQiO3M6MTA6IkFsLUh1bWF6YWgiO31pOjI3O086ODoic3RkQ2xhc3MiOjI6e3M6MjoiaWQiO2k6NjQ7czoxMDoibmFtYV9zdXJhdCI7czo2OiJBbC1GaWwiO31pOjI4O086ODoic3RkQ2xhc3MiOjI6e3M6MjoiaWQiO2k6NjU7czoxMDoibmFtYV9zdXJhdCI7czo3OiJRdXJhaXNoIjt9aToyOTtPOjg6InN0ZENsYXNzIjoyOntzOjI6ImlkIjtpOjY2O3M6MTA6Im5hbWFfc3VyYXQiO3M6ODoiQWwtTWEndW4iO31pOjMwO086ODoic3RkQ2xhc3MiOjI6e3M6MjoiaWQiO2k6Njc7czoxMDoibmFtYV9zdXJhdCI7czoxMDoiQWwtS2F3dGhhciI7fWk6MzE7Tzo4OiJzdGRDbGFzcyI6Mjp7czoyOiJpZCI7aTo2ODtzOjEwOiJuYW1hX3N1cmF0IjtzOjEwOiJBbC1LYWZpcnVuIjt9aTozMjtPOjg6InN0ZENsYXNzIjoyOntzOjI6ImlkIjtpOjY5O3M6MTA6Im5hbWFfc3VyYXQiO3M6NzoiQW4tTmFzciI7fWk6MzM7Tzo4OiJzdGRDbGFzcyI6Mjp7czoyOiJpZCI7aTo3MDtzOjEwOiJuYW1hX3N1cmF0IjtzOjg6IkFsLU1hc2FkIjt9aTozNDtPOjg6InN0ZENsYXNzIjoyOntzOjI6ImlkIjtpOjcxO3M6MTA6Im5hbWFfc3VyYXQiO3M6OToiQWwtSWtobGFzIjt9aTozNTtPOjg6InN0ZENsYXNzIjoyOntzOjI6ImlkIjtpOjcyO3M6MTA6Im5hbWFfc3VyYXQiO3M6ODoiQWwtRmFsYXEiO31pOjM2O086ODoic3RkQ2xhc3MiOjI6e3M6MjoiaWQiO2k6NzM7czoxMDoibmFtYV9zdXJhdCI7czo2OiJBbi1OYXMiO319czoxNDoibmFtYUdydXBDYWJhbmciO086ODoic3RkQ2xhc3MiOjI6e3M6MjoiaWQiO2k6MTtzOjk6Im5hbWFfZ3J1cCI7czo3OiJLZWxhcyAxIjt9czoxNDoibmFtYUdydXBTYW50cmkiO086ODoic3RkQ2xhc3MiOjM6e3M6MjoiaWQiO2k6MjtzOjk6ImlkX2NhYmFuZyI7aToxO3M6OToibmFtYV9ncnVwIjtzOjk6IlJvbWJlbCAxQiI7fXM6MTY6Im5hbWFHcnVwS2Vsb21wb2siO086ODoic3RkQ2xhc3MiOjM6e3M6MjoiaWQiO2k6NTtzOjk6ImlkX3JvbWJlbCI7aToyO3M6MTM6Im5hbWFfa2Vsb21wb2siO3M6MTA6IktlbG9tcG9rIDUiO31zOjc6Im5hbWFKdXoiO086ODoic3RkQ2xhc3MiOjI6e3M6MjoiaWQiO2k6MTc7czo4OiJuYW1hX2p1eiI7czo2OiJKdXogMzAiO31zOjk6Im5hbWFMZXZlbCI7Tzo4OiJzdGRDbGFzcyI6Mzp7czoyOiJpZCI7aTo0NjtzOjY6ImlkX2p1eiI7aToxNztzOjU6ImxldmVsIjtzOjE6IjEiO31zOjE1OiJzZWxlY3RlZF9zYW50cmkiO2E6Nzp7aTowO3M6MjoiMzQiO2k6MTtzOjI6IjM1IjtpOjI7czoxOiIxIjtpOjM7czoyOiIxNiI7aTo0O3M6MjoiMTQiO2k6NTtzOjI6IjMwIjtpOjY7czoyOiIyOCI7fXM6MTQ6InNlbGVjdGVkX3N1cmFoIjthOjU6e2k6MDtzOjI6IjM5IjtpOjE7czoyOiIzNyI7aToyO3M6MjoiNDgiO2k6MztzOjI6IjQ3IjtpOjQ7czoyOiIzOCI7fXM6MzoianV6IjtzOjI6IjE3Ijt9', 1739523804);

-- --------------------------------------------------------

--
-- Table structure for table `settings_web`
--

CREATE TABLE `settings_web` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_website` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi_website` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `keyword_website` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo_website` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_website` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telpon_website` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1' COMMENT '0 = Maintenance, 1 = Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings_web`
--

INSERT INTO `settings_web` (`id`, `nama_website`, `deskripsi_website`, `keyword_website`, `logo_website`, `email_website`, `telpon_website`, `status`) VALUES
(1, 'Tsabata', 'Lembaga pendidikan yang berfokus pada pengajaran Al-Qur\'an dan akhlak.', 'Tsabata, Pengajaran Al Quran', 'logo/1735392220_Logo-Tsabata-Circle.png', 'rtq.tsabata@gmail.com', '08568525337', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `id_wali` int DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_lengkap` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` int NOT NULL DEFAULT '1' COMMENT '0 = Admin, 1 = Guru, 2 = Wali Santri',
  `status` int NOT NULL DEFAULT '1' COMMENT '0 = Tidak Aktif, 1 = Aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `id_wali`, `username`, `nama_lengkap`, `email`, `password`, `level`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 'masmutdev', 'Masmut Dev', 'masmutofficial@gmail.com', '$2y$12$4zF/TehzlMu4QJOENolfOugw7.e4lDZszD7luNdv5TF1Fe7P4FEKS', 0, 1, '2024-12-20 18:35:12', '2024-12-20 18:35:12'),
(27, NULL, 'guru', 'Guru', 'guru@gmail.com', '$2y$12$MkINR4rskoD2IHp.dqyB3erXujcjgGX7qC6XGF1FVa.SK8p06H8pO', 1, 1, '2025-02-06 04:14:47', '2025-02-06 04:14:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absen`
--
ALTER TABLE `absen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `absen_id_guru_foreign` (`id_guru`),
  ADD KEY `absen_id_santri_foreign` (`id_santri`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `data_guru`
--
ALTER TABLE `data_guru`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_guru_id_grup_cabang_foreign` (`id_grup_cabang`),
  ADD KEY `data_guru_id_grup_santri_foreign` (`id_grup_santri`),
  ADD KEY `data_guru_id_users_foreign` (`id_users`);

--
-- Indexes for table `data_santri`
--
ALTER TABLE `data_santri`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_santri_id_grup_cabang_foreign` (`id_grup_cabang`),
  ADD KEY `data_santri_id_grup_santri_foreign` (`id_grup_santri`),
  ADD KEY `id_grup_kelompok` (`id_grup_kelompok`);

--
-- Indexes for table `data_walisantri`
--
ALTER TABLE `data_walisantri`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_walisantri_id_santri_foreign` (`id_santri`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `grup_cabang`
--
ALTER TABLE `grup_cabang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grup_santri`
--
ALTER TABLE `grup_santri`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cabang` (`id_cabang`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jadwal_id_guru_foreign` (`id_guru`),
  ADD KEY `jadwal_id_santri_foreign` (`id_santri`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `juz`
--
ALTER TABLE `juz`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `juz_level`
--
ALTER TABLE `juz_level`
  ADD PRIMARY KEY (`id`),
  ADD KEY `juz_level_id_juz_foreign` (`id_juz`);

--
-- Indexes for table `juz_surat`
--
ALTER TABLE `juz_surat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `juz_surat_id_juz_level_foreign` (`id_juz_level`);

--
-- Indexes for table `kelompok_quran`
--
ALTER TABLE `kelompok_quran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_rombel` (`id_rombel`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai_mtahfidz`
--
ALTER TABLE `nilai_mtahfidz`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai_mtahsin`
--
ALTER TABLE `nilai_mtahsin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai_murojaah`
--
ALTER TABLE `nilai_murojaah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai_ptahfidz`
--
ALTER TABLE `nilai_ptahfidz`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai_ptahsin`
--
ALTER TABLE `nilai_ptahsin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai_tasmi`
--
ALTER TABLE `nilai_tasmi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings_web`
--
ALTER TABLE `settings_web`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `absen`
--
ALTER TABLE `absen`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `data_guru`
--
ALTER TABLE `data_guru`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `data_santri`
--
ALTER TABLE `data_santri`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=443;

--
-- AUTO_INCREMENT for table `data_walisantri`
--
ALTER TABLE `data_walisantri`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grup_cabang`
--
ALTER TABLE `grup_cabang`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `grup_santri`
--
ALTER TABLE `grup_santri`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `juz`
--
ALTER TABLE `juz`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `juz_level`
--
ALTER TABLE `juz_level`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `juz_surat`
--
ALTER TABLE `juz_surat`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `kelompok_quran`
--
ALTER TABLE `kelompok_quran`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `nilai_mtahfidz`
--
ALTER TABLE `nilai_mtahfidz`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `nilai_mtahsin`
--
ALTER TABLE `nilai_mtahsin`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `nilai_murojaah`
--
ALTER TABLE `nilai_murojaah`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `nilai_ptahfidz`
--
ALTER TABLE `nilai_ptahfidz`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `nilai_ptahsin`
--
ALTER TABLE `nilai_ptahsin`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `nilai_tasmi`
--
ALTER TABLE `nilai_tasmi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `settings_web`
--
ALTER TABLE `settings_web`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absen`
--
ALTER TABLE `absen`
  ADD CONSTRAINT `absen_id_guru_foreign` FOREIGN KEY (`id_guru`) REFERENCES `data_guru` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `absen_id_santri_foreign` FOREIGN KEY (`id_santri`) REFERENCES `data_santri` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_guru`
--
ALTER TABLE `data_guru`
  ADD CONSTRAINT `data_guru_id_grup_cabang_foreign` FOREIGN KEY (`id_grup_cabang`) REFERENCES `grup_cabang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `data_guru_id_grup_santri_foreign` FOREIGN KEY (`id_grup_santri`) REFERENCES `grup_santri` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `data_guru_id_users_foreign` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_santri`
--
ALTER TABLE `data_santri`
  ADD CONSTRAINT `data_santri_id_grup_cabang_foreign` FOREIGN KEY (`id_grup_cabang`) REFERENCES `grup_cabang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `data_santri_id_grup_kelompok` FOREIGN KEY (`id_grup_kelompok`) REFERENCES `kelompok_quran` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `data_santri_id_grup_santri_foreign` FOREIGN KEY (`id_grup_santri`) REFERENCES `grup_santri` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_walisantri`
--
ALTER TABLE `data_walisantri`
  ADD CONSTRAINT `data_walisantri_id_santri_foreign` FOREIGN KEY (`id_santri`) REFERENCES `data_santri` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `grup_santri`
--
ALTER TABLE `grup_santri`
  ADD CONSTRAINT `data_santri_id_cabang_foreign` FOREIGN KEY (`id_cabang`) REFERENCES `grup_cabang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_id_guru_foreign` FOREIGN KEY (`id_guru`) REFERENCES `data_guru` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwal_id_santri_foreign` FOREIGN KEY (`id_santri`) REFERENCES `data_santri` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `juz_level`
--
ALTER TABLE `juz_level`
  ADD CONSTRAINT `juz_level_id_juz_foreign` FOREIGN KEY (`id_juz`) REFERENCES `juz` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `juz_surat`
--
ALTER TABLE `juz_surat`
  ADD CONSTRAINT `juz_surat_id_juz_level_foreign` FOREIGN KEY (`id_juz_level`) REFERENCES `juz_level` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `kelompok_quran`
--
ALTER TABLE `kelompok_quran`
  ADD CONSTRAINT `data_santri_kelompok_quran_foreign` FOREIGN KEY (`id_rombel`) REFERENCES `grup_santri` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 17, 2020 at 06:22 PM
-- Server version: 5.7.31-0ubuntu0.18.04.1
-- PHP Version: 7.3.20-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `momeawedding`
--

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE `artikel` (
  `artikel_id` int(11) NOT NULL,
  `artikel_nm` char(250) NOT NULL,
  `category_id` int(11) NOT NULL,
  `description` longtext,
  `artikel_img` text NOT NULL,
  `status_cd` enum('normal','nullified') DEFAULT 'normal',
  `created_user` int(11) NOT NULL,
  `created_dttm` datetime NOT NULL,
  `updated_user` int(11) NOT NULL,
  `updated_dttm` datetime NOT NULL,
  `nullified_user` int(11) NOT NULL,
  `nullified_dttm` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `artikel`
--

INSERT INTO `artikel` (`artikel_id`, `artikel_nm`, `category_id`, `description`, `artikel_img`, `status_cd`, `created_user`, `created_dttm`, `updated_user`, `updated_dttm`, `nullified_user`, `nullified_dttm`) VALUES
(1, 'Alasan Kenapa Kamu Harus Menggunakan Wedding Planner / Wedding Organizer?', 3, '<p>Saat ini pernikahan bukanlah merupakan hal yang biasa, kamu akan \r\nmenemukan acara pernikahan tiap weekend di banyak tempat. Bahkan kamu \r\nmungkin mengalami kebingungan saat akan memilih tempat mana yang harus \r\ndidahulukan ketika kamu menerima lebih dari satu undangan dalam satu \r\nhari. Faktanya, setiap pasangan memiliki impian tersendiri dalam \r\nmerencanakan bentuk pernikahan mereka. Sebagian orang berpikir bahwa \r\nmenggunakan jasa Wedding Planner / Wedding Organizer merupakan suatu \r\nfaktor yang mempengaruhi meningkatnya biaya yang harus dikeluarkan. \r\nNamun, di sisi lain menggunakan jasa Wedding Planner / Wedding Organizer\r\n juga merupakan hal yang penting dan dapat mempermudah proses persiapan \r\nhingga proses pernikahan usai. Pernahkah kalian mendengar sebuah \r\npenyesalan pengantin yang menyebutkan bahwa mereka menyesal karena tidak\r\n menggunakan jasa Wedding Planner / Wedding Organizer ?</p><p>Banyak pasangan yang mengabaikan untuk menggunakan jasa Wedding Planner,\r\n pada akhirnya mereka menyesal karena acara tidak berjalan sempurna. Ada\r\n banyak hal yang harus dipersiapkan sebelum melakukan pernikahan seperti\r\n gedung, vendor, dekorasi, fotografer, makeup, wardrobe, catering, dll. \r\nBanyak sekali bukan?</p><p>Jadi, kenapa Wedding Planner / Wedding Organizer itu penting? Berikut \r\nbeberapa alasan yang dapat membuat kamu akan berpikir untuk menggunakan \r\njasa Wedding Planner / Wedding Organizer.</p>', '1600275668_f49e2648e13fc1ccc4a7.jpg', 'normal', 0, '2020-09-17 12:32:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(2, 'Selektif Dapatkan Wedding Organizer dan Wedding Planner Kompeten', 3, '<p>Mempunyai persamaan membantu calon pengantin, antara wedding organizer \r\ndan wedding planner mempunyai tugas yang agak berbeda. Wedding planner \r\nbiasanya sudah terlibat sejak awal persiapan, sebab wedding planner \r\nberada mendamping calon pengantin untuk mengatur dan merekomendasikan \r\nvendor apa saja yang dapat mewujudkan konsep pernikahan seperti yang \r\ndibayangkan calon pengantin. Berbeda halnya dengan wedding organizer \r\nyang terlibat hanya di hari-H. Wedding organizer lebih berperan di \r\nhari-H untuk mengatur laju acara tetap pada jalurnya.<br>\r\nBanyaknya jumlah wedding organizer atau wedding planner membuat para \r\ncalon pengantin bingung memilih. Hampir semua mengatakan kemampuan \r\nmereka yang terbaik, akan tetapi apakah dengan semudah itu dipercaya? \r\nDan agar tidak salah memilih wedding organizer atau wedding planner, \r\nberikut langkah untuk menyaring wedding organizer atau wedding planner \r\nyang kompeten.</p><p>Malu bertanya sesat di jalan, pepatah tersebut menyiratkan nasihat bijak\r\n untuk rajin bertanya agar tidak terjebak situasi yang salah. Begitu pun\r\n halnya memilih vendor, mintalah saran dari beberapa teman yang sudah \r\npernah menikah. Dari pengalaman mereka Anda akan mendapat beberapa nama \r\nvendor yang terbaik yang dapat dijadikan pertimbangan.</p>', '1600310881_32a60bdc4912210eb3b9.jpg', 'normal', 0, '2020-09-17 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_nm` varchar(150) NOT NULL,
  `type` enum('product','vendor','gallery','portofolio','artikel') DEFAULT NULL,
  `status_cd` enum('normal','nullified') DEFAULT 'normal',
  `created_user` int(11) NOT NULL,
  `created_dttm` datetime NOT NULL,
  `updated_user` int(11) NOT NULL,
  `updated_dttm` datetime NOT NULL,
  `nullified_user` int(11) NOT NULL,
  `nullified_dttm` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_nm`, `type`, `status_cd`, `created_user`, `created_dttm`, `updated_user`, `updated_dttm`, `nullified_user`, `nullified_dttm`) VALUES
(1, 'Indoor', 'product', 'normal', 2, '2020-09-16 14:52:18', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(2, 'Outdoor', 'product', 'normal', 2, '2020-09-16 20:40:49', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(3, 'Pernikahan', 'artikel', 'normal', 2, '2020-09-16 23:14:34', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(4, 'Gedung', 'vendor', 'nullified', 2, '2020-09-17 11:24:22', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(5, 'Bima Sakti', 'portofolio', 'normal', 2, '2020-09-17 14:51:29', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(6, 'The Sultan', 'portofolio', 'normal', 2, '2020-09-17 15:30:52', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `company_id` int(11) NOT NULL,
  `company_nm` varchar(255) DEFAULT NULL,
  `company_phone` varchar(30) NOT NULL,
  `company_email` varchar(255) NOT NULL,
  `company_address` text NOT NULL,
  `company_logo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`company_id`, `company_nm`, `company_phone`, `company_email`, `company_address`, `company_logo`) VALUES
(1, 'Momea Wedding Planner', '(0711) 718 688', 'momeawedding@gmail.com', 'Jl. Sumpah Pemuda Blok K No.1A, Lorok Pakjo, Kec. Ilir Bar. I, Kota Palembang, Sumatera Selatan 30126', '1600250393_0c20edd70f5053932297.png');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `gallery_id` int(11) NOT NULL,
  `gallery_nm` char(250) NOT NULL,
  `category_id` int(11) NOT NULL,
  `description` text,
  `status_cd` enum('normal','nullified') DEFAULT NULL,
  `created_user` int(11) NOT NULL,
  `created_dttm` datetime NOT NULL,
  `update_user` int(11) NOT NULL,
  `update_dttm` datetime NOT NULL,
  `nullified_user` int(11) NOT NULL,
  `nullified_dttm` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`gallery_id`, `gallery_nm`, `category_id`, `description`, `status_cd`, `created_user`, `created_dttm`, `update_user`, `update_dttm`, `nullified_user`, `nullified_dttm`) VALUES
(1, 'Gallery #1', 3, '', 'normal', 2, '2020-09-17 16:25:04', 0, '0000-00-00 00:00:00', 2, '2020-09-17 16:43:02');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `images_id` int(11) NOT NULL,
  `fk_id` int(11) NOT NULL,
  `images_path` text,
  `images_nm` text,
  `type` enum('product','category','vendor','gallery','portofolio','artikel') DEFAULT NULL,
  `status_cd` enum('normal','nullified') DEFAULT NULL,
  `created_user` int(11) NOT NULL,
  `created_dttm` datetime NOT NULL,
  `updated_user` int(11) NOT NULL,
  `updated_dttm` datetime NOT NULL,
  `nullified_user` int(11) NOT NULL,
  `nullified_dttm` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`images_id`, `fk_id`, `images_path`, `images_nm`, `type`, `status_cd`, `created_user`, `created_dttm`, `updated_user`, `updated_dttm`, `nullified_user`, `nullified_dttm`) VALUES
(1, 5, 'img/product', '1599409903_26ab0c5ba492b6217407.png', 'product', 'normal', 2, '2020-09-06 23:31:43', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(2, 5, 'img/product', '1599409903_efe9251392d889753666.png', 'product', 'normal', 2, '2020-09-06 23:31:43', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(3, 5, 'img/product', '1599409903_0a6b8b9ab3bddde2e81b.png', 'product', 'normal', 2, '2020-09-06 23:31:43', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(4, 5, 'img/product', '1599409903_8f3908d18ffa0736dd98.jpg', 'product', 'normal', 2, '2020-09-06 23:31:43', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(9, 0, 'img/product', '1599454004_2e998e106cc52f1d7c70.jpeg', 'product', 'normal', 0, '0000-00-00 00:00:00', 2, '2020-09-07 11:46:44', 0, '0000-00-00 00:00:00'),
(10, 0, 'img/product', '1599454004_3429141871742045fef9.png', 'product', 'normal', 0, '0000-00-00 00:00:00', 2, '2020-09-07 11:46:44', 0, '0000-00-00 00:00:00'),
(11, 5, 'img/product', '1599454071_61828e0142df029b235a.jpeg', 'product', 'normal', 0, '0000-00-00 00:00:00', 2, '2020-09-07 11:47:51', 0, '0000-00-00 00:00:00'),
(12, 5, 'img/product', '1599454071_0e585071c4f3bcf58a9b.png', 'product', 'normal', 0, '0000-00-00 00:00:00', 2, '2020-09-07 11:47:51', 0, '0000-00-00 00:00:00'),
(13, 4, 'img/product', '1599454222_56495a670a575d40d3c1.jpg', 'product', 'normal', 0, '0000-00-00 00:00:00', 2, '2020-09-07 11:50:22', 0, '0000-00-00 00:00:00'),
(14, 4, 'img/product', '1599454222_462dd3f886fdb393c54b.png', 'product', 'normal', 0, '0000-00-00 00:00:00', 2, '2020-09-07 11:50:22', 0, '0000-00-00 00:00:00'),
(15, 4, 'img/product', '1599454222_6a0d1360a0d34b24076c.png', 'product', 'normal', 0, '0000-00-00 00:00:00', 2, '2020-09-07 11:50:22', 0, '0000-00-00 00:00:00'),
(16, 3, 'img/product', '1599454243_d48c77171815e7963dae.png', 'product', 'normal', 0, '0000-00-00 00:00:00', 2, '2020-09-07 11:50:43', 0, '0000-00-00 00:00:00'),
(17, 3, 'img/product', '1599454243_2f8b8150f69ecbddce0d.png', 'product', 'normal', 0, '0000-00-00 00:00:00', 2, '2020-09-07 11:50:43', 0, '0000-00-00 00:00:00'),
(18, 3, 'img/product', '1599454243_a87689a26000249822b5.png', 'product', 'normal', 0, '0000-00-00 00:00:00', 2, '2020-09-07 11:50:43', 0, '0000-00-00 00:00:00'),
(19, 3, 'img/product', '1599454243_aa72463d2edcb78ac957.png', 'product', 'normal', 0, '0000-00-00 00:00:00', 2, '2020-09-07 11:50:43', 0, '0000-00-00 00:00:00'),
(20, 3, 'img/product', '1599454243_e468e00050217f71c869.png', 'product', 'normal', 0, '0000-00-00 00:00:00', 2, '2020-09-07 11:50:43', 0, '0000-00-00 00:00:00'),
(21, 3, 'img/product', '1599454243_ba8ea895aa799d073a3b.png', 'product', 'normal', 0, '0000-00-00 00:00:00', 2, '2020-09-07 11:50:43', 0, '0000-00-00 00:00:00'),
(22, 3, 'img/product', '1599454243_73b7fc784dce1cea988c.png', 'product', 'normal', 0, '0000-00-00 00:00:00', 2, '2020-09-07 11:50:43', 0, '0000-00-00 00:00:00'),
(23, 6, 'img/product', '1599572894_3285f9edda9ee785461c.png', 'product', 'normal', 2, '2020-09-08 20:48:14', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(24, 6, 'img/product', '1599572894_d90c87199c1af0edfe38.png', 'product', 'normal', 2, '2020-09-08 20:48:14', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(25, 6, 'img/product', '1599572894_ee07a12e1485f0f4c48f.png', 'product', 'normal', 2, '2020-09-08 20:48:14', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(26, 6, 'img/product', '1599636350_06e9ae90f4a13a02ed2f.jpg', 'product', 'normal', 0, '0000-00-00 00:00:00', 2, '2020-09-09 14:25:50', 0, '0000-00-00 00:00:00'),
(27, 6, 'img/product', '1599636350_a3f222f9b08cc6487b09.png', 'product', 'normal', 0, '0000-00-00 00:00:00', 2, '2020-09-09 14:25:50', 0, '0000-00-00 00:00:00'),
(28, 6, 'img/product', '1599636350_ce2a6d7e307fc2331c84.png', 'product', 'normal', 0, '0000-00-00 00:00:00', 2, '2020-09-09 14:25:50', 0, '0000-00-00 00:00:00'),
(29, 1, 'img/product', '1600313676_6fa3ffda67532e040012.jpg', 'product', 'normal', 2, '2020-09-17 10:34:36', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(30, 1, 'img/product', '1600313676_88e015d328c12706bfd8.jpg', 'product', 'normal', 2, '2020-09-17 10:34:36', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(31, 1, 'img/product', '1600313676_9913f3d3080879bdf8f0.jpg', 'product', 'normal', 2, '2020-09-17 10:34:36', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(32, 1, 'img/portofolio', '1600329114_0f4c37d8cb6bcbe76434.jpg', 'portofolio', 'normal', 2, '2020-09-17 14:51:54', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(33, 2, 'img/portofolio', '1600331492_8cfbc72ac9a968b85f89.jpg', 'portofolio', 'normal', 2, '2020-09-17 15:31:32', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(34, 2, 'img/product', '1600333225_0f3549a7a7dc32f83182.jpg', 'product', 'normal', 2, '2020-09-17 16:00:25', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(35, 2, 'img/product', '1600333225_1b30df2fcd2ab40ca0df.jpg', 'product', 'normal', 2, '2020-09-17 16:00:25', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(36, 2, 'img/product', '1600333225_309d7dc535fe4e90d7a6.jpg', 'product', 'normal', 2, '2020-09-17 16:00:25', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(37, 3, 'img/product', '1600333735_a4394b8c65b50a4fd34c.jpg', 'product', 'normal', 2, '2020-09-17 16:08:55', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(38, 1, 'img/gallery', '1600334704_4e006b3ecfde99a7476a.jpg', 'gallery', 'normal', 2, '2020-09-17 16:25:04', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(39, 3, 'img/portofolio', '1600341521_4e776f55790f02adc375.jpg', 'portofolio', 'normal', 2, '2020-09-17 18:18:41', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `portofolio`
--

CREATE TABLE `portofolio` (
  `portofolio_id` int(11) NOT NULL,
  `portofolio_nm` char(250) NOT NULL,
  `category_id` int(11) NOT NULL,
  `description` text,
  `status_cd` enum('normal','nullified') DEFAULT NULL,
  `created_user` int(11) NOT NULL,
  `created_dttm` datetime NOT NULL,
  `update_user` int(11) NOT NULL,
  `update_dttm` datetime NOT NULL,
  `nullified_user` int(11) NOT NULL,
  `nullified_dttm` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `portofolio`
--

INSERT INTO `portofolio` (`portofolio_id`, `portofolio_nm`, `category_id`, `description`, `status_cd`, `created_user`, `created_dttm`, `update_user`, `update_dttm`, `nullified_user`, `nullified_dttm`) VALUES
(1, 'Indah Dan Zaki', 5, '', 'nullified', 2, '2020-09-17 14:51:54', 0, '0000-00-00 00:00:00', 2, '2020-09-17 15:48:17'),
(2, 'Gita dan Paul', 6, '', 'nullified', 2, '2020-09-17 15:31:32', 0, '0000-00-00 00:00:00', 2, '2020-09-17 15:48:42'),
(3, 'Bambang dan Bimbing', 6, '', 'normal', 2, '2020-09-17 18:18:41', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_cd` char(20) DEFAULT NULL,
  `product_nm` varchar(255) DEFAULT NULL,
  `price1` int(11) NOT NULL,
  `price2` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `description` longtext,
  `status_cd` enum('normal','nullified') NOT NULL,
  `created_user` int(11) DEFAULT NULL,
  `created_dttm` datetime NOT NULL,
  `updated_user` int(11) DEFAULT NULL,
  `updated_dttm` datetime NOT NULL,
  `nullified_user` int(11) DEFAULT NULL,
  `nullified_dttm` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_cd`, `product_nm`, `price1`, `price2`, `category_id`, `description`, `status_cd`, `created_user`, `created_dttm`, `updated_user`, `updated_dttm`, `nullified_user`, `nullified_dttm`) VALUES
(1, '001', 'Paket A', 100000000, 80000000, 1, '<p>Kursi 1.000 Buah<br>\r\nSofa VIP 2 Sheet<br>\r\nPelaminan Dekorasi<br>\r\nMini Garden<br>\r\nGazebo<br>\r\nStanding Flower<br>\r\nRed Carpet<br>\r\nFoye Photobooth<br>\r\nSolo Keyboard + 1 Singer<br>\r\nMeja VIP Bulat 10 Buah<br>\r\nSound System &amp; Lighting<br>\r\nRuangan Full AC<br>\r\nListrik<br>\r\nGenset 3500 KVA<br>\r\nMeja Registrasi 2 Buah<br>\r\nKeamanan (Security &amp; Anggota AURI)<br>\r\nKapasitas Parkir +700 Mobil</p>', 'normal', 2, '2020-09-17 10:34:36', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00'),
(2, '002', 'Paket B', 80000000, 50000000, 2, '<div class=\"woocommerce-product-details__short-description\">\r\n	<p>Wedding Planner By Makna Wedding<br>\r\nKursi 1.000 Buah<br>\r\nSofa VIP 2 Sheet<br>\r\nPelaminan Dekorasi<br>\r\nMini Garden<br>\r\nGazebo<br>\r\nStanding Flower<br>\r\nRed Carpet<br>\r\nFoye Photobooth<br>\r\nSolo Keyboard + 1 Singer<br>\r\nMeja VIP Bulat 10 Buah<br>\r\nSound System &amp; Lighting<br>\r\nRuangan Full AC<br>\r\nListrik<br>\r\nGenset 3500 KVA<br>\r\nMeja Registrasi 2 Buah<br>\r\nKeamanan (Security &amp; Anggota AURI)<br>\r\nKapasitas Parkir +700 Mobil</p>\r\n<p>AKAD<br>\r\nDekorasi Pelaminan Standart Akad Nikah By Success Decoration<br>\r\nKasur &amp; Meja Akad Nikah (Lesehan)<br>\r\nHias Kamar Pengantin By Success Decoration<br>\r\nBusana Pengantin Akad By IDM, Ellegance<br>\r\nMelati Pengantin Akad<br>\r\nTata Rias Pengantin By Miao Miao, Ciqa Rizka<br>\r\n2 Orang Tata Rias lbu Akad<br>\r\n2 Stel Songket lbu Akad<br>\r\n2 Stel Beskap &amp; Rumpak Tanjak Bapak<br>\r\nHenna, Lulur &amp; Tangas<br>\r\n20 Buah Keranjang Hantaran Free Dekor<br>\r\n1 Buah Tempat Mas Kawin</p>\r\n<p>RESEPSI<br>\r\nBusana Pengantin Resepsi By IDM, Ellegance<br>\r\nMelati Pengantin Resepsi<br>\r\nTata Rias Pengantin By Miao Miao, Ciqa Rizka<br>\r\n2 Orang Tata Rias lbu dan Besan<br>\r\n2 Stel Songket lbu<br>\r\n2 Stel Beskap &amp; Rumpak Tanjak Bapak<br>\r\nTari Persembahan<br>\r\nTari Kreasi</p>\r\n<p>FOTO DAN VIDEO (AKAD DAN RESEPSI)<br>\r\nBy Next Studio, Luminore, Java<br>\r\nAlbum Kolase 15 Sheet + 2 Keping DVD<br>\r\nFree Foto Prewed By Next Studio</p>\r\n<p>LAIN LAIN<br>\r\nCatering Menu B 1.000 Porsi By Diraniga, Flora (Ayam, Daging)<br>\r\n2 Orang Pembawa Acara<br>\r\n4 Buah Buku Tamu</p>\r\n</div>', 'normal', 2, '2020-09-17 16:00:25', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00'),
(3, '003', 'Paket C', 100000000, 80000000, 1, '<p>asdasd<br></p>', 'normal', 2, '2020-09-17 16:08:55', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `slider_id` int(11) NOT NULL,
  `title` text,
  `sub_title` text,
  `slider_img` text NOT NULL,
  `status_cd` enum('normal','nullified') NOT NULL DEFAULT 'normal',
  `created_user` int(11) DEFAULT NULL,
  `created_dttm` datetime NOT NULL,
  `updated_user` int(11) DEFAULT NULL,
  `updated_dttm` datetime NOT NULL,
  `nullified_user` int(11) DEFAULT NULL,
  `nullified_dttm` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`slider_id`, `title`, `sub_title`, `slider_img`, `status_cd`, `created_user`, `created_dttm`, `updated_user`, `updated_dttm`, `nullified_user`, `nullified_dttm`) VALUES
(1, 'Momea Wedding Planner', 'It\'s All About The Day', '1600341652_fa23d460e89687fa7c50.jpg', 'normal', 2, '2020-09-17 18:20:52', 2, '2020-09-17 18:22:01', NULL, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `testimoni`
--

CREATE TABLE `testimoni` (
  `testimoni_id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `status_cd` enum('normal','approved','rejected','nullified') NOT NULL DEFAULT 'normal',
  `created_dttm` datetime NOT NULL,
  `approved_user` int(11) NOT NULL,
  `approved_dttm` datetime NOT NULL,
  `rejected_user` int(11) NOT NULL,
  `rejected_dttm` datetime NOT NULL,
  `nullified_user` int(11) NOT NULL,
  `nullified_dttm` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testimoni`
--

INSERT INTO `testimoni` (`testimoni_id`, `nama`, `email`, `isi`, `status_cd`, `created_dttm`, `approved_user`, `approved_dttm`, `rejected_user`, `rejected_dttm`, `nullified_user`, `nullified_dttm`) VALUES
(1, 'Akhmad Affandy S', 'andiiick@gmail.com', 'Test 1..2..3.. Test 1..2..3.. Test 1..2..3.. Test 1..2..3.. Test 1..2..3.. Test 1..2..3.. Test 1..2..3.. Test 1..2..3.. Test 1..2..3.. Test 1..2..3.. Test 1..2..3.. Test 1..2..3.. Test 1..2..3.. Test 1..2..3.. Test 1..2..3.. Test 1..2..3.. Test 1..2..3.. Test 1..2..3.. ', 'normal', '0000-00-00 00:00:00', 2, '2020-09-08 15:58:35', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(2, 'bbbbbbbbbbbbb2', 'bbbbbbbbbbb2', 'bbbbbbbbbbbbbbbbbbbb2', 'nullified', '0000-00-00 00:00:00', 2, '2020-09-09 22:22:25', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(3, 'aaaaaaaaaaaaaaa', 'vbbbbbbbbbbbbbb', 'aaaaaaaaaaaa', 'nullified', '0000-00-00 00:00:00', 2, '2020-09-09 22:05:25', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `gender` enum('L','P') NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `level` int(1) DEFAULT NULL,
  `avatar` text NOT NULL,
  `created_user` int(11) DEFAULT NULL,
  `created_dttm` datetime NOT NULL,
  `updated_user` int(11) DEFAULT NULL,
  `updated_dttm` datetime NOT NULL,
  `nullified_user` int(11) DEFAULT NULL,
  `nullified_dttm` datetime NOT NULL,
  `status_acc` enum('active','deactive') DEFAULT NULL,
  `status_act` enum('normal','nullified') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `username`, `gender`, `password`, `level`, `avatar`, `created_user`, `created_dttm`, `updated_user`, `updated_dttm`, `nullified_user`, `nullified_dttm`, `status_acc`, `status_act`) VALUES
(1, 'User', 'user', 'L', '10470c3b4b1fed12c3baac014be15fac67c6e815', 3, 'avatar.png', 2, '2020-08-09 04:43:23', 1, '2020-09-05 20:40:19', NULL, '0000-00-00 00:00:00', 'active', 'normal'),
(2, 'Administrator', 'admin', 'L', '10470c3b4b1fed12c3baac014be15fac67c6e815', 1, '', 1, '2020-08-09 04:44:33', 2, '2020-09-17 17:11:43', NULL, '0000-00-00 00:00:00', 'active', 'normal'),
(3, 'User3', 'user3', 'P', '10470c3b4b1fed12c3baac014be15fac67c6e815', 2, '', 1, '2020-09-05 08:40:02', 1, '2020-09-05 20:42:43', 1, '2020-09-05 21:10:53', 'active', 'normal'),
(5, 'Akhmad Affandy S', 'andiiick', 'L', '10470c3b4b1fed12c3baac014be15fac67c6e815', 1, '', 2, '2020-09-16 23:08:16', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', 'active', 'normal');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `vendor_id` int(11) NOT NULL,
  `vendor_nm` char(250) NOT NULL,
  `category_id` int(11) NOT NULL,
  `description` text,
  `image` text NOT NULL,
  `status_cd` enum('normal','nullified') DEFAULT 'normal',
  `created_user` int(11) NOT NULL,
  `created_dttm` datetime NOT NULL,
  `updated_user` int(11) NOT NULL,
  `updated_dttm` datetime NOT NULL,
  `nullified_user` int(11) NOT NULL,
  `nullified_dttm` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendor_id`, `vendor_nm`, `category_id`, `description`, `image`, `status_cd`, `created_user`, `created_dttm`, `updated_user`, `updated_dttm`, `nullified_user`, `nullified_dttm`) VALUES
(1, 'BU 1', 1, '', '1600078347_8c6deaace329964a889e.svg', 'nullified', 2, '2020-09-14 17:12:27', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(2, 'The Sultan', 1, '', '1600099323_162a57be145f5af88b71.svg', 'nullified', 2, '2020-09-14 23:02:03', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`artikel_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`gallery_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`images_id`);

--
-- Indexes for table `portofolio`
--
ALTER TABLE `portofolio`
  ADD PRIMARY KEY (`portofolio_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`slider_id`);

--
-- Indexes for table `testimoni`
--
ALTER TABLE `testimoni`
  ADD PRIMARY KEY (`testimoni_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`vendor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artikel`
--
ALTER TABLE `artikel`
  MODIFY `artikel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `gallery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `images_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `portofolio`
--
ALTER TABLE `portofolio`
  MODIFY `portofolio_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `slider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `testimoni`
--
ALTER TABLE `testimoni`
  MODIFY `testimoni_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `vendor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

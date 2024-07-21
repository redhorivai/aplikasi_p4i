-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 20, 2023 at 12:28 PM
-- Server version: 10.11.2-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms_simkkn`
--

-- --------------------------------------------------------

--
-- Table structure for table `bcms_artikel`
--

CREATE TABLE `bcms_artikel` (
  `artikel_id` int(11) NOT NULL,
  `type` enum('slider','artikel') DEFAULT NULL,
  `title` char(225) NOT NULL,
  `description` text NOT NULL,
  `banner_nm` text NOT NULL,
  `thumbnail_nm` text NOT NULL,
  `status_cd` enum('normal','nullified') NOT NULL DEFAULT 'normal',
  `created_dttm` datetime NOT NULL,
  `created_user` int(11) NOT NULL,
  `updated_dttm` datetime NOT NULL,
  `updated_user` int(11) NOT NULL,
  `nullified_dttm` datetime NOT NULL,
  `nullified_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bcms_company`
--

CREATE TABLE `bcms_company` (
  `company_id` int(11) NOT NULL,
  `company_nm` char(225) NOT NULL,
  `email` char(225) NOT NULL,
  `cellphone_informasi` char(225) NOT NULL,
  `cellphone_marketing` char(225) NOT NULL,
  `cellphone_sms_online` char(225) NOT NULL,
  `addr_txt` text NOT NULL,
  `link_website` char(225) NOT NULL,
  `facebook` char(225) NOT NULL,
  `instagram` char(225) NOT NULL,
  `company_logo` text NOT NULL,
  `created_user` int(11) NOT NULL,
  `created_dttm` datetime NOT NULL,
  `updated_user` int(11) NOT NULL,
  `updated_dttm` datetime NOT NULL,
  `nullified_user` int(11) NOT NULL,
  `nullified_dttm` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bcms_company`
--

INSERT INTO `bcms_company` (`company_id`, `company_nm`, `email`, `cellphone_informasi`, `cellphone_marketing`, `cellphone_sms_online`, `addr_txt`, `link_website`, `facebook`, `instagram`, `company_logo`, `created_user`, `created_dttm`, `updated_user`, `updated_dttm`, `nullified_user`, `nullified_dttm`) VALUES
(1, 'UNIVERSITAS MUHAMMADYAH PALEMBANG', 'redhorivai@gmail.com', '(0711) 513022', '(0711) 513022', '(0711) 513022', 'Alamat: Jl. Jendral A. Yani, Kel. 13 Ulu, Kec. Seberang Ulu II, Palembang, Kode Pos 30263', 'https://simkkn-muhammadyah.com', '@redho.rivai', '@binarykid', '1687056044_beb2d413963f508516e2.jpg', 0, '0000-00-00 00:00:00', 1, '2023-06-18 09:40:44', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `bcms_pengaduan`
--

CREATE TABLE `bcms_pengaduan` (
  `id_pengaduan` int(11) NOT NULL,
  `nama_pengirim` char(225) NOT NULL,
  `email` int(11) NOT NULL,
  `no_telp` char(225) NOT NULL,
  `catatan` text NOT NULL,
  `created_dttm` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bcms_pengaduan`
--

INSERT INTO `bcms_pengaduan` (`id_pengaduan`, `nama_pengirim`, `email`, `no_telp`, `catatan`, `created_dttm`) VALUES
(1, 'Meriam Belina', 0, '082282676924', 'hahaha ', '2020-11-13 00:00:00'),
(2, 'Meriam Belina', 0, '082282676924', 'hahaha\n', '2020-11-13 00:00:00'),
(3, 'Okta ler', 0, '0818612672', 'hahaha yang tidak ', '2020-11-13 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `bcms_periode`
--

CREATE TABLE `bcms_periode` (
  `id_periode` int(11) NOT NULL,
  `nm_periode` varchar(30) NOT NULL,
  `semester` enum('genap','ganjil') NOT NULL,
  `buka_pendaftaran` datetime NOT NULL,
  `tutup_pendaftaran` datetime NOT NULL,
  `status_cd` enum('normal','nullified') NOT NULL,
  `status_acc` enum('active','deactive') NOT NULL,
  `created_user` int(11) NOT NULL,
  `created_dttm` datetime NOT NULL,
  `updated_user` int(11) NOT NULL,
  `updated_dttm` datetime NOT NULL,
  `nullified_user` int(11) NOT NULL,
  `nullified_dttm` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bcms_periode`
--

INSERT INTO `bcms_periode` (`id_periode`, `nm_periode`, `semester`, `buka_pendaftaran`, `tutup_pendaftaran`, `status_cd`, `status_acc`, `created_user`, `created_dttm`, `updated_user`, `updated_dttm`, `nullified_user`, `nullified_dttm`) VALUES
(1, 'Tahun Ajaran 2023', 'genap', '2023-06-20 00:00:01', '2023-06-30 23:59:59', 'normal', 'active', 1, '2023-06-20 04:54:35', 0, '2023-06-20 04:54:35', 0, '2023-06-20 04:54:35');

-- --------------------------------------------------------

--
-- Table structure for table `bcms_users`
--

CREATE TABLE `bcms_users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `gender` enum('L','P') NOT NULL,
  `email` varchar(182) NOT NULL,
  `phone` char(50) NOT NULL,
  `address` text NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `level` char(30) DEFAULT NULL,
  `avatar` text NOT NULL,
  `created_user` int(11) DEFAULT NULL,
  `created_dttm` datetime NOT NULL,
  `updated_user` int(11) DEFAULT NULL,
  `updated_dttm` datetime NOT NULL,
  `nullified_user` int(11) DEFAULT NULL,
  `nullified_dttm` datetime NOT NULL,
  `status_acc` enum('active','deactive') DEFAULT 'active',
  `status_cd` enum('normal','nullified') DEFAULT 'normal'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bcms_users`
--

INSERT INTO `bcms_users` (`user_id`, `name`, `username`, `gender`, `email`, `phone`, `address`, `password`, `level`, `avatar`, `created_user`, `created_dttm`, `updated_user`, `updated_dttm`, `nullified_user`, `nullified_dttm`, `status_acc`, `status_cd`) VALUES
(1, 'redhorivai', 'redhorivai', 'L', 'redhorivai@gmail.com', '085273083460', 'Jl. Segaran 15 ilir', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Super User', '', 1, '2020-11-22 19:33:01', 1, '2020-12-05 22:02:55', 1, '2020-11-28 21:57:56', 'active', 'normal');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bcms_artikel`
--
ALTER TABLE `bcms_artikel`
  ADD PRIMARY KEY (`artikel_id`);

--
-- Indexes for table `bcms_company`
--
ALTER TABLE `bcms_company`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `bcms_pengaduan`
--
ALTER TABLE `bcms_pengaduan`
  ADD PRIMARY KEY (`id_pengaduan`);

--
-- Indexes for table `bcms_periode`
--
ALTER TABLE `bcms_periode`
  ADD PRIMARY KEY (`id_periode`);

--
-- Indexes for table `bcms_users`
--
ALTER TABLE `bcms_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bcms_artikel`
--
ALTER TABLE `bcms_artikel`
  MODIFY `artikel_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bcms_company`
--
ALTER TABLE `bcms_company`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bcms_pengaduan`
--
ALTER TABLE `bcms_pengaduan`
  MODIFY `id_pengaduan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bcms_periode`
--
ALTER TABLE `bcms_periode`
  MODIFY `id_periode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bcms_users`
--
ALTER TABLE `bcms_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2023 at 08:19 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ewins`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartID` int(11) NOT NULL,
  `c_stafiID` int(11) NOT NULL,
  `c_produktID` int(11) NOT NULL,
  `c_njesiID` int(11) NOT NULL,
  `c_nr_barkod` varchar(50) NOT NULL,
  `c_emri_produktit` varchar(250) NOT NULL,
  `c_nr_serial` int(11) NOT NULL,
  `c_sasia` decimal(10,2) NOT NULL DEFAULT 0.00,
  `c_tvsh1` decimal(10,2) DEFAULT 0.00,
  `c_cmimi_pa_tvsh` decimal(10,2) NOT NULL,
  `c_vlera_pa_tvsh` decimal(10,2) NOT NULL,
  `c_vlera_e_tvsh` decimal(10,2) NOT NULL,
  `c_vlera_me_tvsh` decimal(10,2) NOT NULL,
  `c_zbritje` decimal(10,2) NOT NULL,
  `c_vlera_total` decimal(10,2) NOT NULL,
  `castatusi` varchar(255) NOT NULL DEFAULT 'aktiv',
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `isDeleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `furnitoret`
--

CREATE TABLE `furnitoret` (
  `furnitorID` int(11) NOT NULL,
  `stafiID` int(11) NOT NULL,
  `kompania` varchar(250) NOT NULL,
  `kontakt` varchar(250) NOT NULL,
  `telefon` int(11) NOT NULL,
  `fustatusi` varchar(255) NOT NULL DEFAULT 'aktiv',
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `isDeleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `furnitoret`
--

INSERT INTO `furnitoret` (`furnitorID`, `stafiID`, `kompania`, `kontakt`, `telefon`, `fustatusi`, `dateCreated`, `dateUpdated`, `isDeleted`) VALUES
(1, 1, 'Ceva dhe hekura', 'fillan fisteki', 7004545, 'aktiv', '2022-08-17 00:00:00', '2023-05-24 17:18:28', 0);

-- --------------------------------------------------------

--
-- Table structure for table `historia`
--

CREATE TABLE `historia` (
  `historiaID` int(11) NOT NULL,
  `stafiID` int(11) NOT NULL,
  `action` varchar(255) NOT NULL,
  `module` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `hstatusi` varchar(255) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `isDeleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `historia`
--

INSERT INTO `historia` (`historiaID`, `stafiID`, `action`, `module`, `message`, `hstatusi`, `dateCreated`, `dateUpdated`, `isDeleted`) VALUES
(45, 1, 'create', 'Produkti', 'Regjistruar me sukses.', 'success', '2022-08-17 04:16:17', '2022-08-17 02:16:17', 0),
(46, 1, 'create', 'Produkti', 'Regjistruar me sukses.', 'success', '2022-08-17 04:17:13', '2022-08-17 02:17:13', 0),
(47, 1, 'create', 'Produkti', 'Regjistruar me sukses.', 'success', '2022-08-17 04:34:30', '2022-08-17 02:34:30', 0),
(48, 1, 'delete', 'produktet', 'U fshij me sukses.', 'success', '2022-08-20 13:15:50', '2023-05-14 13:05:40', 1),
(49, 1, 'delete', 'produktet', 'U fshij me sukses.', 'success', '2022-08-21 01:17:13', '2022-08-20 23:17:13', 0),
(50, 1, 'delete', 'produktet', 'U fshij me sukses.', 'success', '2022-08-21 01:39:38', '2022-08-20 23:39:38', 0),
(51, 1, 'create', 'produktet', 'Regjistruar me sukses.', 'success', '2022-08-22 02:05:57', '2022-08-22 00:05:57', 0),
(52, 1, 'create', 'produktet', 'Regjistruar me sukses.', 'success', '2022-08-22 02:07:36', '2022-08-22 00:07:36', 0),
(53, 1, 'create', 'produktet', 'Regjistruar me sukses.', 'success', '2022-08-22 02:44:58', '2022-08-22 00:44:58', 0),
(54, 1, 'create', 'produktet', 'Regjistruar me sukses.', 'success', '2022-08-22 02:46:09', '2022-08-22 00:46:09', 0),
(55, 1, 'create', 'produktet', 'Regjistruar me sukses.', 'success', '2022-08-22 03:31:30', '2022-08-22 01:31:30', 0),
(56, 1, 'create', 'produktet', 'Regjistruar me sukses.', 'success', '2022-08-22 03:33:03', '2022-08-22 01:33:03', 0),
(57, 1, 'create', 'produktet', 'Regjistruar me sukses.', 'success', '2022-08-22 03:34:51', '2022-08-22 01:34:51', 0),
(58, 1, 'create', 'produktet', 'Regjistruar me sukses.', 'success', '2022-08-22 03:36:16', '2022-08-22 01:36:16', 0),
(59, 1, 'create', 'produktet', 'Regjistruar me sukses.', 'success', '2022-08-22 03:43:21', '2022-08-22 01:43:21', 0),
(60, 1, 'create', 'produktet', 'Regjistruar me sukses.', 'success', '2022-08-22 03:48:23', '2022-08-22 01:48:23', 0),
(61, 1, 'edit', 'konsumatori', 'Regjistruar me sukses.', 'success', '2022-08-22 04:55:21', '2022-08-22 02:55:21', 0),
(62, 2, 'create', 'produktet', 'Regjistruar me sukses.', 'success', '2022-08-23 02:20:18', '2022-08-23 00:20:18', 0),
(63, 1, 'create', 'produktet', 'Regjistruar me sukses.', 'success', '2022-09-01 20:25:09', '2022-09-01 18:25:09', 0),
(64, 1, 'delete', 'stafi', 'U fshij me sukses.', 'success', '2022-09-03 02:12:34', '2022-09-03 00:12:34', 0),
(65, 1, 'delete', 'stafi', 'U fshij me sukses.', 'success', '2022-09-03 02:12:43', '2022-09-03 00:12:43', 0),
(66, 1, 'delete', 'stafi', 'U fshij me sukses.', 'success', '2022-09-03 02:13:15', '2022-09-03 00:13:15', 0),
(67, 1, 'delete', 'stafi', 'U fshij me sukses.', 'success', '2022-09-03 02:16:10', '2022-09-03 00:16:10', 0),
(68, 1, 'delete', 'stafi', 'U fshij me sukses.', 'success', '2022-09-03 02:16:16', '2022-09-03 00:16:16', 0),
(69, 1, 'delete', 'stafi', 'U fshij me sukses.', 'success', '2022-09-03 02:16:18', '2022-09-03 00:16:18', 0),
(70, 1, 'delete', 'stafi', 'U fshij me sukses.', 'success', '2022-09-03 02:16:22', '2022-09-03 00:16:22', 0),
(71, 1, 'delete', 'stafi', 'U fshij me sukses.', 'success', '2022-09-03 02:17:09', '2022-09-03 00:17:09', 0),
(72, 1, 'delete', 'stafi', 'U fshij me sukses.', 'success', '2022-09-03 02:18:47', '2022-09-03 00:18:47', 0),
(73, 1, 'delete', 'stafi', 'U fshij me sukses.', 'success', '2022-09-03 02:21:50', '2022-09-03 00:21:50', 0),
(74, 1, 'delete', 'njesit', 'U fshij me sukses.', 'success', '2022-09-03 02:24:33', '2022-09-03 00:24:33', 0),
(75, 1, 'delete', 'njesit', 'U fshij me sukses.', 'success', '2022-09-03 02:26:43', '2022-09-03 00:26:43', 0),
(76, 1, 'delete', 'njesit', 'U fshij me sukses.', 'success', '2022-09-03 02:29:14', '2022-09-03 00:29:14', 0),
(77, 1, 'delete', 'njesit', 'U fshij me sukses.', 'success', '2022-09-03 02:29:18', '2022-09-03 00:29:18', 0),
(78, 1, 'delete', 'njesit', 'U fshij me sukses.', 'success', '2022-09-03 02:30:22', '2022-09-03 00:30:22', 0),
(79, 1, 'delete', 'njesit', 'U fshij me sukses.', 'success', '2022-09-03 02:35:47', '2022-09-03 00:35:47', 0),
(80, 1, 'delete', 'njesit', 'U fshij me sukses.', 'success', '2022-09-03 02:40:22', '2022-09-03 00:40:22', 0),
(81, 1, 'delete', 'njesit', 'U fshij me sukses.', 'success', '2022-09-03 02:41:22', '2022-09-03 00:41:22', 0),
(82, 1, 'delete', 'njesit', 'U fshij me sukses.', 'success', '2022-09-03 02:43:02', '2022-09-03 00:43:02', 0),
(83, 1, 'delete', 'njesit', 'U fshij me sukses.', 'success', '2022-09-03 02:56:59', '2022-09-03 00:56:59', 0),
(84, 1, 'delete', 'stafi', 'U fshij me sukses.', 'success', '2022-09-03 03:07:28', '2022-09-03 01:07:28', 0),
(85, 1, 'create', 'produktet', 'Regjistruar me sukses.', 'success', '2022-09-05 03:07:30', '2022-09-05 01:07:30', 0),
(86, 1, 'create', 'produktet', 'Regjistruar me sukses.', 'success', '2022-09-05 03:10:11', '2022-09-05 01:10:11', 0),
(87, 1, 'delete', 'njesit', 'U fshij me sukses.', 'success', '2022-09-11 04:37:38', '2022-09-11 02:37:38', 0),
(88, 1, 'delete', 'njesit', 'U fshij me sukses.', 'success', '2022-09-11 04:37:41', '2022-09-11 02:37:41', 0),
(89, 1, 'delete', 'produktet', 'U fshij me sukses.', 'success', '2022-09-11 04:38:12', '2022-09-11 02:38:12', 0),
(90, 1, 'create', 'produktet', 'Regjistruar me sukses.', 'success', '2022-11-09 02:19:52', '2022-11-09 01:19:52', 0),
(91, 1, 'create', 'produktet', 'Regjistruar me sukses.', 'success', '2022-11-09 02:24:23', '2022-11-09 01:24:23', 0),
(92, 1, 'create', 'produktet', 'Regjistruar me sukses.', 'success', '2022-11-20 05:36:33', '2022-11-20 04:36:33', 0),
(93, 1, 'create', 'produktet', 'Regjistruar me sukses.', 'success', '2022-11-20 05:37:23', '2022-11-20 04:37:23', 0),
(94, 1, 'edit', 'konsumatori', 'Regjistruar me sukses.', 'success', '2022-11-24 01:58:42', '2022-11-24 00:58:42', 0),
(95, 1, 'edit', 'konfigurime', 'Regjistruar me sukses.', 'success', '2022-12-04 01:39:44', '2022-12-04 00:39:44', 0),
(96, 1, 'edit', 'konfigurime', 'Regjistruar me sukses.', 'success', '2022-12-12 17:12:31', '2022-12-12 16:12:31', 0),
(97, 1, 'edit', 'konfigurime', 'Regjistruar me sukses.', 'success', '2022-12-12 17:12:58', '2023-05-14 13:05:43', 1),
(98, 1, 'delete', 'produktet', 'U fshij me sukses.', 'success', '2023-05-01 01:52:38', '2023-04-30 23:52:38', 0),
(99, 1, 'edit', 'konsumatori', 'Regjistruar me sukses.', 'success', '2023-05-09 18:32:25', '2023-05-09 16:32:25', 0),
(100, 1, 'create', 'produktet', 'Regjistruar me sukses.', 'success', '2023-05-09 18:35:35', '2023-05-14 13:05:35', 1),
(101, 1, 'edit', 'konfigurime', 'Regjistruar me sukses.', 'success', '2023-05-15 16:42:27', '2023-05-15 14:42:27', 0),
(102, 1, 'edit', 'konsumatori', 'Regjistruar me sukses.', 'success', '2023-05-15 16:57:00', '2023-05-15 14:57:00', 0),
(103, 1, 'edit', 'konsumatori', 'Regjistruar me sukses.', 'success', '2023-05-15 16:57:23', '2023-05-15 14:57:23', 0),
(104, 1, 'delete', 'konsumatori', 'U fshij me sukses.', 'success', '2023-05-15 17:02:44', '2023-05-15 15:02:44', 0),
(105, 1, 'delete', 'konsumatori', 'U fshij me sukses.', 'success', '2023-05-15 17:03:20', '2023-05-15 15:03:20', 0),
(106, 4, 'create', 'stafi', 'Regjistruar me sukses.', 'success', '2023-05-19 12:28:39', '2023-05-19 10:28:39', 0),
(107, 4, 'create', 'stafi', 'Regjistruar me sukses.', 'success', '2023-05-19 12:29:44', '2023-05-19 10:29:44', 0),
(108, 4, 'create', 'stafi', 'Regjistruar me sukses.', 'success', '2023-05-19 12:33:43', '2023-05-19 10:33:43', 0),
(109, 4, 'create', 'stafi', 'Regjistruar me sukses.', 'success', '2023-05-19 12:33:50', '2023-05-19 10:33:50', 0),
(110, 4, 'create', 'stafi', 'Regjistruar me sukses.', 'success', '2023-05-19 12:34:22', '2023-05-19 10:34:22', 0),
(111, 4, 'create', 'stafi', 'Regjistruar me sukses.', 'success', '2023-05-19 12:35:20', '2023-05-19 10:35:20', 0),
(112, 4, 'create', 'stafi', 'Regjistruar me sukses.', 'success', '2023-05-19 12:36:31', '2023-05-19 10:36:31', 0),
(113, 4, 'create', 'stafi', 'Regjistruar me sukses.', 'success', '2023-05-19 12:38:03', '2023-05-19 10:38:03', 0),
(114, 4, 'create', 'stafi', 'Regjistruar me sukses.', 'success', '2023-05-19 12:38:16', '2023-05-19 10:38:16', 0),
(115, 4, 'edit', 'konsumatori', 'Regjistruar me sukses.', 'success', '2023-05-19 22:12:39', '2023-05-19 20:12:39', 0),
(116, 4, 'edit', 'konsumatori', 'Regjistruar me sukses.', 'success', '2023-05-19 22:12:52', '2023-05-19 20:12:52', 0),
(117, 4, 'create', 'stafi', 'Regjistruar me sukses.', 'success', '2023-05-21 13:05:30', '2023-05-21 11:05:30', 0),
(118, 4, 'edit', 'konfigurime', 'Regjistruar me sukses.', 'success', '2023-05-21 13:24:15', '2023-05-21 11:24:15', 0),
(119, 4, 'edit', 'konfigurime', 'Regjistruar me sukses.', 'success', '2023-05-21 13:25:16', '2023-05-21 11:25:16', 0),
(120, 4, 'edit', 'konfigurime', 'Regjistruar me sukses.', 'success', '2023-05-21 13:27:30', '2023-05-21 11:27:30', 0),
(121, 4, 'edit', 'konfigurime', 'Regjistruar me sukses.', 'success', '2023-05-21 13:29:46', '2023-05-24 07:46:07', 1),
(122, 4, 'edit', 'konfigurime', 'Regjistruar me sukses.', 'success', '2023-05-21 13:30:43', '2023-05-21 12:39:45', 1),
(123, 4, 'create', 'produktet', 'Regjistruar me sukses.', 'success', '2023-05-24 19:48:53', '2023-05-24 17:48:53', 0);

-- --------------------------------------------------------

--
-- Table structure for table `konfigurime`
--

CREATE TABLE `konfigurime` (
  `konfigurimeID` int(11) NOT NULL,
  `fshati` varchar(255) NOT NULL,
  `komuna` varchar(255) NOT NULL,
  `qyteti` varchar(255) NOT NULL,
  `shteti` varchar(255) NOT NULL,
  `kontakt_person` varchar(255) NOT NULL,
  `mobil` varchar(255) CHARACTER SET utf32 COLLATE utf32_swedish_ci NOT NULL,
  `email` varchar(255) NOT NULL,
  `web` varchar(255) NOT NULL,
  `cmimi_kubik` float(10,2) NOT NULL COMMENT 'Çmimi aktual për kubik',
  `cmimi_kycjes` float(10,2) NOT NULL COMMENT 'Çmimi aktual për kyçje',
  `njesia` varchar(255) NOT NULL,
  `valuta` varchar(255) NOT NULL,
  `tvsh` float(10,2) NOT NULL COMMENT 'Vlera aktuale e tvsh 1	',
  `tvsh2` float(10,2) NOT NULL COMMENT 'Vlera aktuale e tvsh 2',
  `banka` varchar(255) NOT NULL,
  `banka_adresa` varchar(255) NOT NULL,
  `banka_mobil` varchar(255) NOT NULL,
  `banka_email` varchar(255) NOT NULL,
  `xhirollogaria` int(11) NOT NULL,
  `tekst` text NOT NULL,
  `tekst2` varchar(255) NOT NULL,
  `logo1` varchar(255) NOT NULL,
  `logo2` varchar(255) NOT NULL,
  `komment` varchar(255) NOT NULL,
  `kstatusi` varchar(255) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `konfigurime`
--

INSERT INTO `konfigurime` (`konfigurimeID`, `fshati`, `komuna`, `qyteti`, `shteti`, `kontakt_person`, `mobil`, `email`, `web`, `cmimi_kubik`, `cmimi_kycjes`, `njesia`, `valuta`, `tvsh`, `tvsh2`, `banka`, `banka_adresa`, `banka_mobil`, `banka_email`, `xhirollogaria`, `tekst`, `tekst2`, `logo1`, `logo2`, `komment`, `kstatusi`, `dateCreated`, `dateUpdated`) VALUES
(1, 'Celopek', 'Brevenice', 'Tetove', 'MV', 'Liridon', '070612345', '', '', 12.00, 200.00, 'mᶟ', 'den', 0.00, 0.00, 'Stopanska Banka', '', '', '', 234234, 'Emri i ndermarrjes', 'Me respekt ndermarrja', '646a00e330167.png', '', '', '', '2022-03-06 00:48:11', '2023-05-21 11:30:43');

-- --------------------------------------------------------

--
-- Table structure for table `konsumatoret`
--

CREATE TABLE `konsumatoret` (
  `konsumatorID` int(11) NOT NULL,
  `konsumator_code` int(11) DEFAULT NULL,
  `stafiID` int(11) NOT NULL,
  `k_emri` varchar(255) NOT NULL,
  `k_mbiemri` varchar(255) NOT NULL,
  `firma` varchar(255) NOT NULL,
  `nr_amez` varchar(255) NOT NULL,
  `tip_konsumator` varchar(255) NOT NULL COMMENT 'P.sh. Person fizik ose Person juridik',
  `rruga` varchar(255) CHARACTER SET utf32 COLLATE utf32_swedish_ci NOT NULL,
  `fshati` varchar(255) NOT NULL,
  `komuna` varchar(255) NOT NULL,
  `qyteti` varchar(255) NOT NULL,
  `shteti` varchar(255) NOT NULL,
  `adresa_perkohshme` varchar(255) NOT NULL,
  `mobil` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `komment` varchar(255) NOT NULL,
  `kostatusi` varchar(255) NOT NULL DEFAULT 'aktiv',
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `isDeleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `konsumatoret`
--

INSERT INTO `konsumatoret` (`konsumatorID`, `konsumator_code`, `stafiID`, `k_emri`, `k_mbiemri`, `firma`, `nr_amez`, `tip_konsumator`, `rruga`, `fshati`, `komuna`, `qyteti`, `shteti`, `adresa_perkohshme`, `mobil`, `email`, `komment`, `kostatusi`, `dateCreated`, `dateUpdated`, `isDeleted`) VALUES
(1, 49373677, 1, 'Belul', 'Qazimi', '7 marsi', '2309980470022', 'Person juridik', '101 pn', 'Chelopek', 'Bervenice', 'Tetove', 'NMK', 'Zvicer', '070564452', '', '', 'aktiv', '2022-03-06 00:49:37', '2023-05-15 15:02:53', 0),
(2, 128518224, 1, 'neshat', 'ademi', '', '2309980470023', 'Person fizik', '10', 'Ch', 'B', 'Tetovo', 'NMK', 'Zvicer', '12121211', '', '', 'aktiv', '2022-03-06 01:28:51', '2023-05-24 17:51:31', 0),
(3, 131143038, 1, 'liridon', 'rtyryt', '', '1234567891234', 'Person fizik', '101 pn', 'Chelopek', 'Br', 'Tetovo', 'NMK', '', '', '', '', 'inaktiv', '2022-03-06 01:31:14', '2023-05-15 15:03:20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `njesit`
--

CREATE TABLE `njesit` (
  `njesiID` int(11) NOT NULL,
  `emri_njesis` varchar(50) NOT NULL,
  `njesia` varchar(50) NOT NULL,
  `njstatusi` varchar(255) NOT NULL DEFAULT 'aktiv',
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `isDeleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `njesit`
--

INSERT INTO `njesit` (`njesiID`, `emri_njesis`, `njesia`, `njstatusi`, `dateCreated`, `dateUpdated`, `isDeleted`) VALUES
(1, 'copa', 'copa', 'aktiv', '2023-05-24 19:19:56', '2023-05-24 17:20:24', 0),
(2, 'kilogram', 'kg', 'aktiv', '2023-05-24 19:19:56', '2023-05-24 17:20:24', 0),
(3, 'gram', 'gr', 'aktiv', '2023-05-24 19:19:56', '2023-05-24 17:20:24', 0),
(4, 'meter', 'm', 'aktiv', '2023-05-24 19:19:56', '2023-05-24 17:20:24', 0),
(5, 'meterkatror', 'm^2', 'aktiv', '2023-05-24 19:19:56', '2023-05-24 17:20:24', 0);

-- --------------------------------------------------------

--
-- Table structure for table `oferte_fature`
--

CREATE TABLE `oferte_fature` (
  `oferte_fatureID` int(11) NOT NULL,
  `konsumatorID` int(11) NOT NULL,
  `stafiID` int(11) NOT NULL,
  `numri_ofertes_fatures` varchar(250) NOT NULL,
  `pershkrimi_ofertes` varchar(100) NOT NULL,
  `gjithsej_sasia` decimal(10,2) NOT NULL,
  `gjithsej_pa_tvsh` decimal(10,2) NOT NULL,
  `gjithsej_e_tvsh` decimal(10,2) NOT NULL,
  `gjithsej_me_tvsh` decimal(10,2) NOT NULL,
  `gjithsej_zbritje` decimal(10,2) NOT NULL,
  `gjithsej_total` decimal(10,2) NOT NULL,
  `valuta` varchar(50) NOT NULL,
  `ofstatusi` varchar(50) DEFAULT 'pa paguar',
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `isDeleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `oferte_fature`
--

INSERT INTO `oferte_fature` (`oferte_fatureID`, `konsumatorID`, `stafiID`, `numri_ofertes_fatures`, `pershkrimi_ofertes`, `gjithsej_sasia`, `gjithsej_pa_tvsh`, `gjithsej_e_tvsh`, `gjithsej_me_tvsh`, `gjithsej_zbritje`, `gjithsej_total`, `valuta`, `ofstatusi`, `dateCreated`, `dateUpdated`, `isDeleted`) VALUES
(539, 1, 1, '100520232291', 'rterere', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', 'pa paguar', '2023-05-24 19:01:14', '0000-00-00 00:00:00', 0),
(540, 1, 1, '100520234836', 'ryry', '2.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', 'pa paguar', '2023-05-24 19:01:14', '0000-00-00 00:00:00', 0),
(541, 2, 1, '100520235789', 'ertet', '2.00', '67712.00', '0.00', '0.00', '0.00', '0.00', '', 'pa paguar', '2023-05-24 19:01:14', '0000-00-00 00:00:00', 0),
(542, 2, 1, '100520237931', 'tttttt', '6.00', '3479.00', '0.00', '0.00', '0.00', '0.00', '', 'pa paguar', '2023-05-24 19:01:14', '0000-00-00 00:00:00', 0),
(543, 1, 1, '100520237748', 'yuiyui', '3.00', '3574.00', '0.00', '0.00', '0.00', '0.00', '', 'pa paguar', '2023-05-24 19:01:14', '0000-00-00 00:00:00', 0),
(544, 2, 1, '100520236018', 'rtyr', '7.00', '3574.00', '0.00', '0.00', '0.00', '0.00', '', 'pa paguar', '2023-05-24 19:01:14', '0000-00-00 00:00:00', 0),
(545, 2, 1, '100520236560', 'jetmor', '8.00', '3574.00', '0.00', '0.00', '0.00', '0.00', '', 'pa paguar', '2023-05-24 19:01:14', '0000-00-00 00:00:00', 0),
(546, 1, 1, '100520234221', 'rryrt', '6.00', '3538.00', '0.00', '0.00', '0.00', '0.00', '', 'pa paguar', '2023-05-24 19:01:14', '0000-00-00 00:00:00', 0),
(547, 2, 1, '100520237196', 'sdfsdfsdf', '2.00', '95.00', '0.00', '0.00', '0.00', '0.00', '', 'pa paguar', '2023-05-24 19:01:14', '0000-00-00 00:00:00', 0),
(548, 1, 1, '100520236278', 'asdasd', '40.00', '3574.00', '0.00', '0.00', '0.00', '0.00', '', 'pa paguar', '2023-05-24 19:01:14', '0000-00-00 00:00:00', 0),
(549, 1, 1, '100520232254', 'werwer', '1.00', '3443.00', '0.00', '0.00', '0.00', '0.00', '', 'pa paguar', '2023-05-24 19:01:14', '0000-00-00 00:00:00', 0),
(550, 1, 1, '100520236659', 'ertert', '1.00', '95.00', '0.00', '0.00', '0.00', '0.00', '', 'pa paguar', '2023-05-24 19:01:14', '0000-00-00 00:00:00', 0),
(551, 1, 1, '100520231418', 'ertert', '1.00', '3443.00', '0.00', '0.00', '0.00', '0.00', '', 'pa paguar', '2023-05-24 19:01:14', '0000-00-00 00:00:00', 0),
(552, 1, 1, '100520236090', 'dfgdfg', '1.00', '3443.00', '0.00', '0.00', '0.00', '0.00', '', 'pa paguar', '2023-05-24 19:01:14', '0000-00-00 00:00:00', 0),
(553, 1, 1, '100520235288', 'ryt', '1.00', '95.00', '0.00', '0.00', '0.00', '0.00', '', 'pa paguar', '2023-05-24 19:01:14', '0000-00-00 00:00:00', 0),
(554, 1, 1, '100520232011', 'wtet', '1.00', '95.00', '0.00', '0.00', '0.00', '0.00', '', 'pa paguar', '2023-05-24 19:01:14', '0000-00-00 00:00:00', 0),
(555, 1, 1, '110520235635', 'fsfsdf', '6.00', '17310.00', '629.00', '4167.00', '0.00', '0.00', '', 'pa paguar', '2023-05-24 19:01:14', '0000-00-00 00:00:00', 0),
(556, 1, 1, '110520238301', 'dfgddg', '3.00', '226.00', '16.00', '147.00', '0.00', '0.00', '', 'pa paguar', '2023-05-24 19:01:14', '0000-00-00 00:00:00', 0),
(557, 1, 1, '110520238446', 'gjgjgj', '3.00', '226.00', '16.00', '147.00', '0.00', '0.00', '', 'pa paguar', '2023-05-24 19:01:14', '0000-00-00 00:00:00', 0),
(558, 1, 1, '110520237726', 'rtyryrt', '2.00', '190.00', '10.00', '105.00', '0.00', '0.00', '', 'pa paguar', '2023-05-24 19:01:14', '0000-00-00 00:00:00', 0),
(559, 1, 1, '110520237807', 'jetmirr', '2.00', '131.00', '16.00', '147.00', '0.00', '0.00', '', 'pa paguar', '2023-05-24 19:01:14', '0000-00-00 00:00:00', 0),
(560, 1, 1, '120520233324', 'ryrtyr', '5.00', '13867.00', '629.00', '4167.00', '0.00', '0.00', '', 'pa paguar', '2023-05-24 19:01:14', '0000-00-00 00:00:00', 0),
(561, 2, 1, '140520234330', 'sdfsldfjksd', '1.00', '95.00', '10.00', '105.00', '0.00', '0.00', '', 'pa paguar', '2023-05-24 19:01:14', '0000-00-00 00:00:00', 0),
(562, 1, 1, '140520232209', 'gdgdfgdf', '10.00', '17690.00', '629.00', '4167.00', '0.00', '0.00', '', 'pa paguar', '2023-05-24 19:01:14', '0000-00-00 00:00:00', 0),
(563, 1, 1, '140520234220', 'gdfgf', '3.00', '285.00', '10.00', '105.00', '0.00', '0.00', '', 'pa paguar', '2023-05-24 19:01:14', '0000-00-00 00:00:00', 0),
(564, 1, 1, '140520232809', 'dfgdf', '3.00', '226.00', '25.48', '146.98', '0.00', '0.00', '', 'pa paguar', '2023-05-24 19:01:14', '0000-00-00 00:00:00', 0),
(565, 1, 1, '140520236865', 'dgdg', '1.00', '3443.00', '619.74', '4062.74', '0.00', '0.00', '', 'pa paguar', '2023-05-24 19:01:14', '0000-00-00 00:00:00', 0),
(566, 1, 1, '140520233436', 'dsaasd', '1.00', '36.00', '6.48', '4105.22', '0.00', '0.00', '', 'pa paguar', '2023-05-24 19:01:14', '0000-00-00 00:00:00', 0),
(567, 1, 1, '150520237467', 'uuo', '4.00', '380.00', '38.00', '104.50', '0.00', '0.00', '', 'pa paguar', '2023-05-24 19:01:14', '0000-00-00 00:00:00', 0),
(568, 1, 1, '150520235213', 'fgh', '2.00', '3538.00', '629.24', '4167.24', '0.00', '0.00', '', 'pa paguar', '2023-05-24 19:01:14', '0000-00-00 00:00:00', 0),
(569, 1, 1, '150520233998', 'tuty', '11.00', '3980.00', '692.74', '4209.72', '0.00', '0.00', '', 'pa paguar', '2023-05-24 19:01:14', '0000-00-00 00:00:00', 0),
(570, 1, 1, '150520233937', '56756', '1.00', '95.00', '9.50', '104.50', '0.00', '0.00', '', 'pa paguar', '2023-05-24 19:01:14', '0000-00-00 00:00:00', 0),
(571, 2, 1, '150520238558', '4646', '1.00', '95.00', '9.50', '104.50', '0.00', '0.00', '', 'pa paguar', '2023-05-24 19:01:14', '0000-00-00 00:00:00', 0),
(572, 1, 1, '150520232625', 'hffhfg', '1.00', '3443.00', '619.74', '4062.74', '0.00', '0.00', '', 'pa paguar', '2023-05-24 19:01:14', '0000-00-00 00:00:00', 0),
(573, 1, 1, '160520231523', 'fghfgh', '6.00', '3918.00', '666.74', '4584.74', '0.00', '0.00', '', 'pa paguar', '2023-05-24 19:01:14', '0000-00-00 00:00:00', 0),
(574, 1, 4, '190520236470', '3453443534534', '1.00', '3443.00', '619.74', '4062.74', '0.00', '0.00', '', 'pa paguar', '2023-05-24 19:01:14', '0000-00-00 00:00:00', 0),
(576, 1, 4, '240520234219', 'test', '1.00', '95.00', '9.50', '104.50', '0.00', '0.00', '', 'pa paguar', '2023-05-24 19:06:33', '2023-05-24 17:06:33', 0),
(577, 2, 4, '240520235227', 'sdfsdf', '2.00', '131.00', '15.98', '146.98', '0.00', '0.00', '', 'pa paguar', '2023-05-24 19:10:00', '2023-05-24 17:10:00', 0),
(578, 2, 4, '240520235172', 'fdgfdgh', '3.00', '195.00', '59.50', '254.50', '0.00', '0.00', '', 'pa paguar', '2023-05-24 19:53:03', '2023-05-24 17:53:03', 0),
(579, 1, 4, '240520235373', 'kjotttsddsfs', '4.00', '231.00', '65.98', '296.98', '0.00', '0.00', '', 'pa paguar', '2023-05-24 19:53:30', '2023-05-24 17:53:30', 0),
(580, 2, 4, '240520235872', 'gfjfgjh', '3.00', '3543.00', '669.74', '4212.74', '0.00', '0.00', '', 'pa paguar', '2023-05-24 20:12:27', '2023-05-24 18:12:27', 0),
(581, 1, 4, '240520236313', 'dfgdfgdfg', '4.00', '3638.00', '679.24', '4317.24', '0.00', '0.00', '', 'pa paguar', '2023-05-24 20:14:10', '2023-05-24 18:14:10', 0),
(582, 2, 4, '240520238010', 'fghfggfhfgh', '4.00', '231.00', '65.98', '296.98', '0.00', '0.00', '', 'pa paguar', '2023-05-24 20:18:42', '2023-05-24 18:18:42', 0);

-- --------------------------------------------------------

--
-- Table structure for table `oferte_fature_items`
--

CREATE TABLE `oferte_fature_items` (
  `oferte_fature_itemID` int(11) NOT NULL,
  `a_oferte_fatureID` int(11) NOT NULL DEFAULT 0,
  `konsumatorID` int(11) NOT NULL,
  `a_stafiID` int(11) NOT NULL,
  `a_produktID` int(11) NOT NULL,
  `a_njesiID` int(11) NOT NULL,
  `a_nr_rendor` int(11) NOT NULL,
  `a_nr_barkod` varchar(50) NOT NULL,
  `a_emri_produktit` varchar(250) NOT NULL,
  `a_nr_serial` int(11) NOT NULL,
  `a_sasia` decimal(10,2) NOT NULL DEFAULT 0.00,
  `a_tvsh1` decimal(10,2) DEFAULT 0.00,
  `a_cmimi_pa_tvsh` decimal(10,2) NOT NULL,
  `a_vlera_pa_tvsh` decimal(10,2) NOT NULL,
  `a_vlera_e_tvsh` decimal(10,2) NOT NULL,
  `a_vlera_me_tvsh` decimal(10,2) NOT NULL,
  `a_zbritje` decimal(10,2) NOT NULL,
  `a_shuma_total` decimal(10,2) NOT NULL,
  `ofistatusi` varchar(255) NOT NULL DEFAULT 'aktiv',
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `isDeleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `oferte_fature_items`
--

INSERT INTO `oferte_fature_items` (`oferte_fature_itemID`, `a_oferte_fatureID`, `konsumatorID`, `a_stafiID`, `a_produktID`, `a_njesiID`, `a_nr_rendor`, `a_nr_barkod`, `a_emri_produktit`, `a_nr_serial`, `a_sasia`, `a_tvsh1`, `a_cmimi_pa_tvsh`, `a_vlera_pa_tvsh`, `a_vlera_e_tvsh`, `a_vlera_me_tvsh`, `a_zbritje`, `a_shuma_total`, `ofistatusi`, `dateCreated`, `dateUpdated`, `isDeleted`) VALUES
(1124, 539, 1, 1, 20, 1, 1, '', 'elementi', 0, '1.00', '10.00', '67676.00', '67676.00', '6767.60', '74443.60', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1125, 540, 1, 1, 20, 1, 1, '', 'elementi', 0, '1.00', '10.00', '67676.00', '67676.00', '6767.60', '74443.60', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1126, 540, 1, 1, 21, 4, 2, '', 'col 20', 0, '1.00', '18.00', '3443.00', '3443.00', '619.74', '4062.74', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1127, 541, 2, 1, 20, 1, 1, '', 'elementi', 0, '1.00', '10.00', '67676.00', '67676.00', '6767.60', '74443.60', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1128, 541, 2, 1, 23, 5, 2, '', 'elemti trete', 0, '1.00', '36.00', '36.00', '36.00', '12.96', '48.96', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1129, 542, 2, 1, 23, 5, 1, '', 'elemti trete', 0, '5.00', '36.00', '36.00', '180.00', '64.80', '244.80', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1130, 542, 2, 1, 21, 4, 2, '', 'col 20', 0, '1.00', '18.00', '3443.00', '3443.00', '619.74', '4062.74', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1131, 543, 1, 1, 20, 1, 1, '', 'elementi', 0, '1.00', '10.00', '95.00', '95.00', '9.50', '104.50', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1132, 543, 1, 1, 21, 4, 2, '', 'col 20', 0, '1.00', '18.00', '3443.00', '3443.00', '619.74', '4062.74', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1133, 543, 1, 1, 23, 5, 3, '', 'elemti trete', 0, '1.00', '18.00', '36.00', '36.00', '6.48', '42.48', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1134, 544, 2, 1, 21, 4, 1, '', 'col 20', 0, '5.00', '18.00', '3443.00', '17215.00', '3098.70', '20313.70', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1135, 544, 2, 1, 20, 1, 2, '', 'elementi', 0, '1.00', '10.00', '95.00', '95.00', '9.50', '104.50', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1136, 544, 2, 1, 23, 5, 3, '', 'elemti trete', 0, '1.00', '18.00', '36.00', '36.00', '6.48', '42.48', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1146, 545, 2, 1, 20, 1, 1, '', 'elementi', 0, '5.00', '10.00', '95.00', '475.00', '47.50', '522.50', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1147, 545, 2, 1, 21, 4, 2, '', 'col 20', 0, '1.00', '18.00', '3443.00', '3443.00', '619.74', '4062.74', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1148, 545, 2, 1, 23, 5, 3, '', 'elemti trete', 0, '2.00', '18.00', '36.00', '72.00', '12.96', '84.96', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1149, 546, 1, 1, 20, 1, 1, '', 'elementi', 0, '5.00', '10.00', '95.00', '475.00', '47.50', '522.50', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1150, 546, 1, 1, 21, 4, 2, '', 'col 20', 0, '1.00', '18.00', '3443.00', '3443.00', '619.74', '4062.74', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1151, 547, 2, 1, 20, 1, 1, '', 'elementi', 0, '2.00', '10.00', '95.00', '190.00', '19.00', '209.00', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1152, 548, 1, 1, 21, 4, 1, '', 'col 20', 0, '10.00', '18.00', '3443.00', '34430.00', '6197.40', '40627.40', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1153, 548, 1, 1, 20, 1, 2, '', 'elementi', 0, '19.00', '10.00', '95.00', '1805.00', '180.50', '1985.50', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1154, 548, 1, 1, 23, 5, 3, '', 'elemti trete', 0, '11.00', '18.00', '36.00', '396.00', '71.28', '467.28', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1155, 549, 1, 1, 21, 4, 1, '', 'col 20', 0, '1.00', '18.00', '3443.00', '3443.00', '619.74', '4062.74', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1156, 550, 1, 1, 20, 1, 1, '', 'elementi', 0, '1.00', '10.00', '95.00', '95.00', '9.50', '104.50', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1157, 551, 1, 1, 21, 4, 1, '', 'col 20', 0, '1.00', '18.00', '3443.00', '3443.00', '619.74', '4062.74', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1158, 552, 1, 1, 21, 4, 1, '', 'col 20', 0, '1.00', '18.00', '3443.00', '3443.00', '619.74', '4062.74', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1159, 553, 1, 1, 20, 1, 1, '', 'elementi', 0, '1.00', '10.00', '95.00', '95.00', '9.50', '104.50', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1160, 554, 1, 1, 20, 1, 1, '', 'elementi', 0, '1.00', '10.00', '95.00', '95.00', '9.50', '104.50', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1167, 555, 1, 1, 20, 1, 1, '', 'elementi', 0, '1.00', '10.00', '95.00', '95.00', '9.50', '104.50', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1168, 555, 1, 1, 21, 4, 2, '', 'col 20', 0, '5.00', '18.00', '3443.00', '17215.00', '3098.70', '20313.70', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1169, 556, 1, 1, 20, 1, 1, '', 'elementi', 0, '2.00', '10.00', '95.00', '190.00', '19.00', '209.00', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1170, 556, 1, 1, 23, 5, 2, '', 'elemti trete', 0, '1.00', '18.00', '36.00', '36.00', '6.48', '42.48', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1171, 557, 1, 1, 20, 1, 1, '', 'elementi', 0, '2.00', '10.00', '95.00', '190.00', '19.00', '209.00', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1172, 557, 1, 1, 23, 5, 2, '', 'elemti trete', 0, '1.00', '18.00', '36.00', '36.00', '6.48', '42.48', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1173, 558, 1, 1, 20, 1, 1, '', 'elementi', 0, '2.00', '10.00', '95.00', '190.00', '19.00', '209.00', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1174, 559, 1, 1, 20, 1, 1, '', 'elementi', 0, '1.00', '10.00', '95.00', '95.00', '9.50', '104.50', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1175, 559, 1, 1, 23, 5, 2, '', 'elemti trete', 0, '1.00', '18.00', '36.00', '36.00', '6.48', '42.48', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1176, 560, 1, 1, 21, 4, 1, '', 'col 20', 0, '4.00', '18.00', '3443.00', '13772.00', '2478.96', '16250.96', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1177, 560, 1, 1, 20, 1, 2, '', 'elementi', 0, '1.00', '10.00', '95.00', '95.00', '9.50', '104.50', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1178, 561, 2, 1, 20, 1, 1, '', 'elementi', 0, '1.00', '10.00', '95.00', '95.00', '9.50', '104.50', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1179, 562, 1, 1, 20, 1, 1, '', 'elementi', 0, '5.00', '10.00', '95.00', '475.00', '47.50', '522.50', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1180, 562, 1, 1, 21, 4, 2, '', 'col 20', 0, '5.00', '18.00', '3443.00', '17215.00', '3098.70', '20313.70', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1181, 563, 1, 1, 20, 1, 1, '', 'elementi', 0, '3.00', '10.00', '95.00', '285.00', '28.50', '313.50', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1182, 564, 1, 1, 20, 1, 1, '', 'elementi', 0, '2.00', '10.00', '95.00', '190.00', '19.00', '209.00', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1183, 564, 1, 1, 23, 5, 2, '', 'elemti trete', 0, '1.00', '18.00', '36.00', '36.00', '6.48', '42.48', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1184, 565, 1, 1, 21, 4, 1, '', 'col 20', 0, '1.00', '18.00', '3443.00', '3443.00', '619.74', '4062.74', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1185, 566, 1, 1, 21, 4, 1, '', 'col 20', 0, '0.00', '18.00', '3443.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1186, 566, 1, 1, 23, 5, 2, '', 'elemti trete', 0, '1.00', '18.00', '36.00', '36.00', '6.48', '42.48', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1187, 567, 1, 1, 20, 1, 1, '', 'elementi', 0, '4.00', '10.00', '95.00', '380.00', '38.00', '418.00', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1188, 568, 1, 1, 20, 1, 1, '', 'elementi', 0, '1.00', '10.00', '95.00', '95.00', '9.50', '104.50', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1189, 568, 1, 1, 21, 4, 2, '', 'col 20', 0, '1.00', '18.00', '3443.00', '3443.00', '619.74', '4062.74', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1190, 569, 1, 1, 20, 1, 1, '', 'elementi', 0, '3.00', '10.00', '95.00', '285.00', '28.50', '313.50', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1191, 569, 1, 1, 21, 4, 2, '', 'col 20', 0, '1.00', '18.00', '3443.00', '3443.00', '619.74', '4062.74', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1192, 569, 1, 1, 23, 5, 3, '', 'elemti trete', 0, '7.00', '18.00', '36.00', '252.00', '45.36', '297.36', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1193, 570, 1, 1, 20, 1, 1, '', 'elementi', 0, '1.00', '10.00', '95.00', '95.00', '9.50', '104.50', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1194, 571, 2, 1, 20, 1, 1, '', 'elementi', 0, '1.00', '10.00', '95.00', '95.00', '9.50', '104.50', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1195, 572, 1, 1, 21, 4, 1, '', 'col 20', 0, '1.00', '18.00', '3443.00', '3443.00', '619.74', '4062.74', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1196, 573, 1, 1, 20, 1, 1, '', 'elementi', 0, '5.00', '10.00', '95.00', '475.00', '47.50', '522.50', '95.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1197, 573, 1, 1, 21, 4, 2, '', 'col 20', 0, '1.00', '18.00', '3443.00', '3443.00', '619.74', '4062.74', '516.45', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1198, 574, 1, 4, 21, 4, 1, '', 'col 20', 0, '1.00', '18.00', '3443.00', '3443.00', '619.74', '4062.74', '0.00', '0.00', 'aktiv', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(1200, 576, 1, 4, 20, 1, 1, '', 'elementi', 0, '1.00', '10.00', '95.00', '95.00', '9.50', '104.50', '0.00', '0.00', 'aktiv', '2023-05-24 19:06:33', '2023-05-24 17:06:33', 0),
(1201, 577, 2, 4, 20, 1, 1, '', 'elementi', 0, '1.00', '10.00', '95.00', '95.00', '9.50', '104.50', '0.00', '0.00', 'aktiv', '2023-05-24 19:10:00', '2023-05-24 17:10:00', 0),
(1202, 577, 2, 4, 23, 5, 2, '', 'elemti trete', 0, '1.00', '18.00', '36.00', '36.00', '6.48', '42.48', '0.00', '0.00', 'aktiv', '2023-05-24 19:10:00', '2023-05-24 17:10:00', 0),
(1203, 578, 2, 4, 20, 1, 1, '', 'elementi', 0, '1.00', '10.00', '95.00', '95.00', '9.50', '104.50', '0.00', '0.00', 'aktiv', '2023-05-24 19:53:03', '2023-05-24 17:53:03', 0),
(1204, 578, 2, 4, 24, 1, 2, '', 'test1', 0, '2.00', '50.00', '50.00', '100.00', '50.00', '150.00', '0.00', '0.00', 'aktiv', '2023-05-24 19:53:03', '2023-05-24 17:53:03', 0),
(1205, 579, 1, 4, 20, 1, 1, '', 'elementi', 0, '1.00', '10.00', '95.00', '95.00', '9.50', '104.50', '0.00', '0.00', 'aktiv', '2023-05-24 19:53:30', '2023-05-24 17:53:30', 0),
(1206, 579, 1, 4, 23, 5, 2, '', 'elemti trete', 0, '1.00', '18.00', '36.00', '36.00', '6.48', '42.48', '0.00', '0.00', 'aktiv', '2023-05-24 19:53:30', '2023-05-24 17:53:30', 0),
(1207, 579, 1, 4, 24, 1, 3, '', 'test1', 0, '2.00', '50.00', '50.00', '100.00', '50.00', '150.00', '0.00', '0.00', 'aktiv', '2023-05-24 19:53:30', '2023-05-24 17:53:30', 0),
(1208, 580, 2, 4, 21, 4, 1, '', 'col 20', 0, '1.00', '18.00', '3443.00', '3443.00', '619.74', '4062.74', '0.00', '0.00', 'aktiv', '2023-05-24 20:12:27', '2023-05-24 18:12:27', 0),
(1209, 580, 2, 4, 24, 1, 2, '', 'test1', 0, '2.00', '50.00', '50.00', '100.00', '50.00', '150.00', '0.00', '0.00', 'aktiv', '2023-05-24 20:12:27', '2023-05-24 18:12:27', 0),
(1210, 581, 1, 4, 20, 1, 1, '', 'elementi', 0, '1.00', '10.00', '95.00', '95.00', '9.50', '104.50', '0.00', '0.00', 'aktiv', '2023-05-24 20:14:10', '2023-05-24 18:14:10', 0),
(1211, 581, 1, 4, 21, 4, 2, '', 'col 20', 0, '1.00', '18.00', '3443.00', '3443.00', '619.74', '4062.74', '0.00', '0.00', 'aktiv', '2023-05-24 20:14:10', '2023-05-24 18:14:10', 0),
(1212, 581, 1, 4, 24, 1, 3, '', 'test1', 0, '2.00', '50.00', '50.00', '100.00', '50.00', '150.00', '0.00', '0.00', 'aktiv', '2023-05-24 20:14:10', '2023-05-24 18:14:10', 0),
(1213, 582, 2, 4, 23, 5, 1, '', 'elemti trete', 0, '1.00', '18.00', '36.00', '36.00', '6.48', '42.48', '0.00', '0.00', 'aktiv', '2023-05-24 20:18:42', '2023-05-24 18:18:42', 0),
(1214, 582, 2, 4, 24, 1, 2, '', 'test1', 0, '2.00', '50.00', '50.00', '100.00', '50.00', '150.00', '0.00', '0.00', 'aktiv', '2023-05-24 20:18:42', '2023-05-24 18:18:42', 0),
(1215, 582, 2, 4, 20, 1, 3, '', 'elementi', 0, '1.00', '10.00', '95.00', '95.00', '9.50', '104.50', '0.00', '0.00', 'aktiv', '2023-05-24 20:18:42', '2023-05-24 18:18:42', 0);

-- --------------------------------------------------------

--
-- Table structure for table `produktet`
--

CREATE TABLE `produktet` (
  `produktID` int(11) NOT NULL,
  `furnitorID` int(11) NOT NULL,
  `stafiID` int(11) NOT NULL,
  `produkt_catID` int(11) NOT NULL,
  `njesiID` int(11) NOT NULL,
  `emriProduktit` varchar(100) NOT NULL,
  `pershkrimiProdukit` varchar(100) NOT NULL,
  `sasia` decimal(10,2) NOT NULL,
  `barkodi` varchar(100) NOT NULL,
  `serialnumer` varchar(11) NOT NULL,
  `cmimiBleres` float NOT NULL,
  `cmimiShites` decimal(10,2) NOT NULL,
  `tvsh1` decimal(10,2) NOT NULL DEFAULT 0.00,
  `tvsh2` decimal(10,0) NOT NULL DEFAULT 0,
  `zbritje` decimal(10,2) NOT NULL,
  `garancion_prej` date DEFAULT NULL,
  `garancion_deri` date DEFAULT NULL,
  `sasiakritike` float NOT NULL,
  `produktType` varchar(255) NOT NULL DEFAULT 'produkt',
  `pstatusi` varchar(50) NOT NULL DEFAULT 'aktiv',
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `isDeleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `produktet`
--

INSERT INTO `produktet` (`produktID`, `furnitorID`, `stafiID`, `produkt_catID`, `njesiID`, `emriProduktit`, `pershkrimiProdukit`, `sasia`, `barkodi`, `serialnumer`, `cmimiBleres`, `cmimiShites`, `tvsh1`, `tvsh2`, `zbritje`, `garancion_prej`, `garancion_deri`, `sasiakritike`, `produktType`, `pstatusi`, `dateCreated`, `dateUpdated`, `isDeleted`) VALUES
(20, 1, 1, 1, 1, 'elementi', 'dgdfg', '1.00', '', '', 56, '95.00', '10.00', '0', '0.00', '0000-00-00', '0000-00-00', 0, 'produkt', '', '0000-00-00 00:00:00', '2023-05-24 17:21:57', 0),
(21, 1, 1, 1, 4, 'col 20', 'dfgdfgd', '1.00', '', '', 34, '3443.00', '18.00', '0', '0.00', '0000-00-00', '0000-00-00', 0, 'produkt', '', '0000-00-00 00:00:00', '2023-05-24 17:21:57', 0),
(22, 1, 1, 1, 1, 'ssmsms', 'dgdfg', '1.00', '', '', 676, '902.00', '10.00', '0', '0.00', '0000-00-00', '0000-00-00', 0, 'produkt', '', '0000-00-00 00:00:00', '2023-05-24 17:21:57', 1),
(23, 1, 1, 1, 5, 'elemti trete', 'sdfsdfsdf', '1.00', '434', '', 15, '36.00', '18.00', '0', '0.00', '0000-00-00', '0000-00-00', 0, 'produkt', 'aktiv', '0000-00-00 00:00:00', '2023-05-24 17:21:57', 0),
(24, 1, 1, 4, 1, 'test1', 'kote kot', '2.00', '434', '6545646465', 20, '50.00', '50.00', '25', '0.00', '2023-06-02', '0000-00-00', 0, 'produkt', 'aktiv', '2023-05-24 19:48:53', '2023-05-24 17:48:53', 0);

-- --------------------------------------------------------

--
-- Table structure for table `produktet_cat`
--

CREATE TABLE `produktet_cat` (
  `produkt_catID` int(11) NOT NULL,
  `furnitorID` int(11) NOT NULL,
  `emri_cat` varchar(50) NOT NULL,
  `pershkrimiCat` varchar(250) NOT NULL,
  `pocstatusi` varchar(255) NOT NULL DEFAULT 'aktiv',
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `isDeleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `produktet_cat`
--

INSERT INTO `produktet_cat` (`produkt_catID`, `furnitorID`, `emri_cat`, `pershkrimiCat`, `pocstatusi`, `dateCreated`, `dateUpdated`, `isDeleted`) VALUES
(1, 1, 'oxhak', 'oxhaqe', 'aktiv', '2022-08-23 00:00:00', '2023-05-24 17:22:51', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sherbimet`
--

CREATE TABLE `sherbimet` (
  `sherbimID` int(11) NOT NULL,
  `emri` varchar(250) NOT NULL,
  `pershkrimi` text NOT NULL,
  `cmimi` float NOT NULL,
  `shstatusi` varchar(255) NOT NULL DEFAULT 'aktiv',
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `isDeleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stafi`
--

CREATE TABLE `stafi` (
  `stafiID` int(11) NOT NULL,
  `emri` varchar(255) NOT NULL,
  `mbiemri` varchar(255) NOT NULL,
  `titulli` varchar(255) NOT NULL COMMENT 'P.sh. BSc. ',
  `emriperdorues` varchar(255) NOT NULL COMMENT 'E-mail i përdoruesit ose Puntorit',
  `fjalekalimi` varchar(250) NOT NULL COMMENT 'Password i përdoruesit ose Puntorit',
  `email` varchar(255) DEFAULT NULL,
  `data_punesimit` date NOT NULL,
  `image` varchar(255) DEFAULT NULL COMMENT 'Fotoja e Punëtorit',
  `isAdmin` int(11) NOT NULL COMMENT 'Nëse Punëtori i ka Privilegjet e kufizuara',
  `komment` varchar(255) NOT NULL,
  `ststatusi` varchar(255) NOT NULL DEFAULT 'aktiv',
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `isDeleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `stafi`
--

INSERT INTO `stafi` (`stafiID`, `emri`, `mbiemri`, `titulli`, `emriperdorues`, `fjalekalimi`, `email`, `data_punesimit`, `image`, `isAdmin`, `komment`, `ststatusi`, `dateCreated`, `dateUpdated`, `isDeleted`) VALUES
(1, 'jetmir', 'qazimi', 'admin', 'jetmir1', '$2y$10$tRPk/jA/xXpEwSkaYU/gHOZ2/XojgJFuCzC4z3UhQpd8YRaslYN2i', NULL, '2021-08-02', 'jetmir.jpg', 1, '', 'aktiv', '2021-08-02 00:00:00', '2021-12-17 21:34:32', 0),
(2, 'shqipe', 'qazimi', 'shef', 'shqipe', '$2y$10$u1I1jSH.xK/onoLkLjFZ4.QVJ5xEGX5YIhmBHThO1jM8vMU2k9isS', NULL, '2021-12-31', 'katze.jpg', 0, '', 'aktiv', '2021-08-02 00:00:00', '2021-12-17 21:34:32', 0),
(3, 'test', 'test', 'mr', 'test', '$2y$10$pFZBWv.l5OEN8tnWAeshsOL2mBcHa24/uu0g3QuFfgAybOWHGYjHe', NULL, '2021-08-11', 'meer.jpg', 0, '', 'jo aktiv', '2021-08-28 00:00:00', '2022-11-16 01:33:22', 1),
(4, 'Neshat', 'Ademi', 'BSc.', 'nesho', '$2y$10$RFTjftS.WkMsuBgUHGjfE.3ut.R1V6YoBrJzXlaXpBRsCyk20V2zO', NULL, '2021-08-29', '6469fafa460c5.png', 1, '', 'aktiv', '2021-08-29 00:00:00', '2023-05-21 11:05:30', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartID`);

--
-- Indexes for table `furnitoret`
--
ALTER TABLE `furnitoret`
  ADD PRIMARY KEY (`furnitorID`);

--
-- Indexes for table `historia`
--
ALTER TABLE `historia`
  ADD PRIMARY KEY (`historiaID`);

--
-- Indexes for table `konfigurime`
--
ALTER TABLE `konfigurime`
  ADD PRIMARY KEY (`konfigurimeID`);

--
-- Indexes for table `konsumatoret`
--
ALTER TABLE `konsumatoret`
  ADD PRIMARY KEY (`konsumatorID`);

--
-- Indexes for table `njesit`
--
ALTER TABLE `njesit`
  ADD PRIMARY KEY (`njesiID`);

--
-- Indexes for table `oferte_fature`
--
ALTER TABLE `oferte_fature`
  ADD PRIMARY KEY (`oferte_fatureID`),
  ADD UNIQUE KEY `fatur_numer` (`numri_ofertes_fatures`);

--
-- Indexes for table `oferte_fature_items`
--
ALTER TABLE `oferte_fature_items`
  ADD PRIMARY KEY (`oferte_fature_itemID`);

--
-- Indexes for table `produktet`
--
ALTER TABLE `produktet`
  ADD PRIMARY KEY (`produktID`);

--
-- Indexes for table `produktet_cat`
--
ALTER TABLE `produktet_cat`
  ADD PRIMARY KEY (`produkt_catID`);

--
-- Indexes for table `sherbimet`
--
ALTER TABLE `sherbimet`
  ADD PRIMARY KEY (`sherbimID`);

--
-- Indexes for table `stafi`
--
ALTER TABLE `stafi`
  ADD PRIMARY KEY (`stafiID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2072;

--
-- AUTO_INCREMENT for table `furnitoret`
--
ALTER TABLE `furnitoret`
  MODIFY `furnitorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `historia`
--
ALTER TABLE `historia`
  MODIFY `historiaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `konsumatoret`
--
ALTER TABLE `konsumatoret`
  MODIFY `konsumatorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `njesit`
--
ALTER TABLE `njesit`
  MODIFY `njesiID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `oferte_fature`
--
ALTER TABLE `oferte_fature`
  MODIFY `oferte_fatureID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=583;

--
-- AUTO_INCREMENT for table `oferte_fature_items`
--
ALTER TABLE `oferte_fature_items`
  MODIFY `oferte_fature_itemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1216;

--
-- AUTO_INCREMENT for table `produktet`
--
ALTER TABLE `produktet`
  MODIFY `produktID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `produktet_cat`
--
ALTER TABLE `produktet_cat`
  MODIFY `produkt_catID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sherbimet`
--
ALTER TABLE `sherbimet`
  MODIFY `sherbimID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stafi`
--
ALTER TABLE `stafi`
  MODIFY `stafiID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2023 at 05:19 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

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
-- Table structure for table `artikujt_per_oferte_fature`
--

CREATE TABLE `artikujt_per_oferte_fature` (
  `artikujt_perofert_fature_ID` int(11) NOT NULL,
  `a_ofertatID` int(11) NOT NULL DEFAULT 0,
  `konsumatorID` int(11) NOT NULL,
  `a_stafiID` int(11) NOT NULL,
  `a_produktetID` int(11) NOT NULL,
  `a_njesiID` int(11) NOT NULL,
  `a_nr_rendor` int(11) NOT NULL,
  `a_nr_barkod` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `a_emri_produktit` varchar(250) COLLATE utf8_swedish_ci NOT NULL,
  `a_nr_serial` int(11) NOT NULL,
  `a_sasia` decimal(10,2) NOT NULL DEFAULT 0.00,
  `a_tvsh1` decimal(10,2) DEFAULT 0.00,
  `a_cmimi_pa_tvsh` decimal(10,2) NOT NULL,
  `a_vlera_pa_tvsh` decimal(10,2) NOT NULL,
  `a_vlera_e_tvsh` decimal(10,2) NOT NULL,
  `a_vlera_me_tvsh` decimal(10,2) NOT NULL,
  `a_zbritje` decimal(10,2) NOT NULL,
  `a_shuma_total` int(11) NOT NULL,
  `isDeleted` int(11) NOT NULL,
  `dateUpdated` date NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `artikujt_per_oferte_fature`
--

INSERT INTO `artikujt_per_oferte_fature` (`artikujt_perofert_fature_ID`, `a_ofertatID`, `konsumatorID`, `a_stafiID`, `a_produktetID`, `a_njesiID`, `a_nr_rendor`, `a_nr_barkod`, `a_emri_produktit`, `a_nr_serial`, `a_sasia`, `a_tvsh1`, `a_cmimi_pa_tvsh`, `a_vlera_pa_tvsh`, `a_vlera_e_tvsh`, `a_vlera_me_tvsh`, `a_zbritje`, `a_shuma_total`, `isDeleted`, `dateUpdated`, `date_created`) VALUES
(1114, 526, 1, 4, 21, 4, 1, '', 'col 20', 0, '1.00', '18.00', '3443.00', '3443.00', '619.74', '4062.74', '0.00', 0, 0, '0000-00-00', '0000-00-00'),
(1115, 526, 1, 4, 20, 1, 2, '', 'elementi', 0, '1.00', '10.00', '67676.00', '67676.00', '6767.60', '74443.60', '0.00', 0, 0, '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_ID` int(11) NOT NULL,
  `c_stafiID` int(11) NOT NULL,
  `c_produktetID` int(11) NOT NULL,
  `c_njesiID` int(11) NOT NULL,
  `c_nr_barkod` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `c_emri_produktit` varchar(250) COLLATE utf8_swedish_ci NOT NULL,
  `c_nr_serial` int(11) NOT NULL,
  `c_sasia` decimal(10,2) NOT NULL DEFAULT 0.00,
  `c_tvsh1` decimal(10,2) DEFAULT 0.00,
  `c_cmimi_pa_tvsh` decimal(10,2) NOT NULL,
  `c_vlera_pa_tvsh` decimal(10,2) NOT NULL,
  `c_vlera_e_tvsh` decimal(10,2) NOT NULL,
  `c_vlera_me_tvsh` decimal(10,2) NOT NULL,
  `c_zbritje` decimal(10,2) NOT NULL,
  `isDeleted` int(11) NOT NULL,
  `dateUpdated` date NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cat_produktet`
--

CREATE TABLE `cat_produktet` (
  `cat_produktetID` int(11) NOT NULL,
  `furnitoretID` int(11) NOT NULL,
  `emri_cat` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `pershkrimiCat` varchar(250) COLLATE utf8_swedish_ci NOT NULL,
  `isDeleted` int(11) NOT NULL,
  `dateCreated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `cat_produktet`
--

INSERT INTO `cat_produktet` (`cat_produktetID`, `furnitoretID`, `emri_cat`, `pershkrimiCat`, `isDeleted`, `dateCreated`) VALUES
(1, 1, 'oxhak', 'oxhaqe', 0, '2022-08-23');

-- --------------------------------------------------------

--
-- Table structure for table `furnitoret`
--

CREATE TABLE `furnitoret` (
  `furnitoretID` int(11) NOT NULL,
  `stafiID` int(11) NOT NULL,
  `Kompania` varchar(250) COLLATE utf8_swedish_ci NOT NULL,
  `PersonKontakt` varchar(250) COLLATE utf8_swedish_ci NOT NULL,
  `Telefon` int(11) NOT NULL,
  `isDeleted` int(11) NOT NULL,
  `dateCreated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `furnitoret`
--

INSERT INTO `furnitoret` (`furnitoretID`, `stafiID`, `Kompania`, `PersonKontakt`, `Telefon`, `isDeleted`, `dateCreated`) VALUES
(1, 1, 'Ceva dhe hekura', 'fillan fisteki', 7004545, 0, '2022-08-17');

-- --------------------------------------------------------

--
-- Table structure for table `historia`
--

CREATE TABLE `historia` (
  `historiaID` int(11) NOT NULL,
  `stafiID` int(11) NOT NULL,
  `action` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `module` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `message` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `hstatusi` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
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
(48, 1, 'delete', 'produktet', 'U fshij me sukses.', 'success', '2022-08-20 13:15:50', '2022-08-20 11:15:50', 0),
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
(97, 1, 'edit', 'konfigurime', 'Regjistruar me sukses.', 'success', '2022-12-12 17:12:58', '2022-12-12 16:12:58', 0),
(98, 1, 'delete', 'produktet', 'U fshij me sukses.', 'success', '2023-05-01 01:52:38', '2023-04-30 23:52:38', 0);

-- --------------------------------------------------------

--
-- Table structure for table `konfigurime`
--

CREATE TABLE `konfigurime` (
  `konfigurimeID` int(11) NOT NULL,
  `fshati` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `komuna` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `qyteti` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `shteti` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `kontakt_person` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `mobil` varchar(255) CHARACTER SET utf32 COLLATE utf32_swedish_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `web` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `cmimi_kubik` float(10,2) NOT NULL COMMENT 'Çmimi aktual për kubik',
  `cmimi_kycjes` float(10,2) NOT NULL COMMENT 'Çmimi aktual për kyçje',
  `njesia` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `valuta` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `tvsh` float(10,2) NOT NULL COMMENT 'Vlera aktuale e tvsh 1	',
  `tvsh2` float(10,2) NOT NULL COMMENT 'Vlera aktuale e tvsh 2',
  `banka` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `banka_adresa` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `banka_mobil` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `banka_email` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `xhirollogaria` int(11) NOT NULL,
  `tekst` text COLLATE utf8_swedish_ci NOT NULL,
  `tekst2` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `logo1` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `logo2` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `komment` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `kstatusi` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `konfigurime`
--

INSERT INTO `konfigurime` (`konfigurimeID`, `fshati`, `komuna`, `qyteti`, `shteti`, `kontakt_person`, `mobil`, `email`, `web`, `cmimi_kubik`, `cmimi_kycjes`, `njesia`, `valuta`, `tvsh`, `tvsh2`, `banka`, `banka_adresa`, `banka_mobil`, `banka_email`, `xhirollogaria`, `tekst`, `tekst2`, `logo1`, `logo2`, `komment`, `kstatusi`, `dateCreated`, `dateUpdated`) VALUES
(1, 'Chelopek i Ri', 'Brvenica', 'Tetovo', 'NMK', 'Seo i ndermarrjes', '0706', '', '', 12.00, 200.00, 'mᶟ', 'den', 0.00, 0.00, 'Stopanska Banka', '', '', '', 234234, 'Emri i ndermarrjes', 'Me respekt ndermarrja', '638bec509db7d.png', '', '', '', '2022-03-06 00:48:11', '2022-12-12 16:12:58');

-- --------------------------------------------------------

--
-- Table structure for table `konsumatoret`
--

CREATE TABLE `konsumatoret` (
  `konsumatorID` int(11) NOT NULL,
  `konsumator_code` int(11) DEFAULT NULL,
  `stafiID` int(11) NOT NULL,
  `k_emri` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `k_mbiemri` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `firma` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `nr_amez` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `tip_konsumator` varchar(255) COLLATE utf8_swedish_ci NOT NULL COMMENT 'P.sh. Person fizik ose Person juridik',
  `rruga` varchar(255) CHARACTER SET utf32 COLLATE utf32_swedish_ci NOT NULL,
  `fshati` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `komuna` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `qyteti` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `shteti` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `adresa_perkohshme` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `mobil` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `komment` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `kostatusi` varchar(255) COLLATE utf8_swedish_ci NOT NULL DEFAULT 'aktiv',
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `isDeleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `konsumatoret`
--

INSERT INTO `konsumatoret` (`konsumatorID`, `konsumator_code`, `stafiID`, `k_emri`, `k_mbiemri`, `firma`, `nr_amez`, `tip_konsumator`, `rruga`, `fshati`, `komuna`, `qyteti`, `shteti`, `adresa_perkohshme`, `mobil`, `email`, `komment`, `kostatusi`, `dateCreated`, `dateUpdated`, `isDeleted`) VALUES
(1, 49373677, 1, 'Belul', 'Qazimi', '7 marsi', '2309980470022', 'Person juridik', '101 pn', 'Chelopek', 'Bervenice', 'Tetove', 'NMK', 'Zvicer', '070564452', '', '', 'aktiv', '2022-03-06 00:49:37', '2022-12-04 01:40:27', 0),
(2, 128518224, 1, 'Emine', 'Qazimi', '', '2309980470022', 'Person fizik', '10', 'Ch', 'B', 'Tetovo', 'NMK', 'Zvicer', '12121211', '', '', 'aktiv', '2022-03-06 01:28:51', '2022-03-05 23:28:51', 0),
(3, 131143038, 1, 'liridon', 'Qazimi', '', '1234567891234', 'Person fizik', '101 pn', 'Chelopek', 'Br', 'Tetovo', 'NMK', '', '', '', '', 'aktiv', '2022-03-06 01:31:14', '2022-03-06 22:43:34', 0);

-- --------------------------------------------------------

--
-- Table structure for table `njesit`
--

CREATE TABLE `njesit` (
  `njesiID` int(11) NOT NULL,
  `emri_njesis` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `njesia` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `isDeleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `njesit`
--

INSERT INTO `njesit` (`njesiID`, `emri_njesis`, `njesia`, `isDeleted`) VALUES
(1, 'copa', 'copa', 0),
(2, 'kilogram', 'kg', 0),
(3, 'gram', 'gr', 0),
(4, 'meter', 'm', 0),
(5, 'meterkatror', 'm^2', 0);

-- --------------------------------------------------------

--
-- Table structure for table `oferte_fature`
--

CREATE TABLE `oferte_fature` (
  `ofertatID` int(11) NOT NULL,
  `konsumatorID` int(11) NOT NULL,
  `stafiID` int(11) NOT NULL,
  `numri_ofertes_fatures` varchar(250) COLLATE utf8_swedish_ci NOT NULL,
  `pershkrimi_ofertes` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `gjithsej_sasia` int(11) NOT NULL,
  `gjithsej_zbritje` int(11) NOT NULL,
  `gjithsej_pa_tvsh` int(11) NOT NULL,
  `gjithsej_e_tvsh` int(11) NOT NULL,
  `gjithsej_me_tvsh` int(11) NOT NULL,
  `gjithsej_total` int(11) NOT NULL,
  `valuta` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `statusi` varchar(50) COLLATE utf8_swedish_ci DEFAULT 'pa paguar',
  `isDeleted` int(11) NOT NULL DEFAULT 0,
  `dateUpdated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `oferte_fature`
--

INSERT INTO `oferte_fature` (`ofertatID`, `konsumatorID`, `stafiID`, `numri_ofertes_fatures`, `pershkrimi_ofertes`, `gjithsej_sasia`, `gjithsej_zbritje`, `gjithsej_pa_tvsh`, `gjithsej_e_tvsh`, `gjithsej_me_tvsh`, `gjithsej_total`, `valuta`, `statusi`, `isDeleted`, `dateUpdated`) VALUES
(526, 1, 4, '030520236413', 'test', 0, 0, 0, 0, 0, 0, '', 'pa paguar', 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `produktet`
--

CREATE TABLE `produktet` (
  `produktetID` int(11) NOT NULL,
  `furnitoretID` int(11) NOT NULL,
  `stafiID` int(11) NOT NULL,
  `cat_produktetID` int(11) NOT NULL,
  `njesiID` int(11) NOT NULL,
  `emriProduktit` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `pershkrimiProdukit` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `sasia` decimal(10,2) NOT NULL,
  `serialnumer` varchar(11) COLLATE utf8_swedish_ci NOT NULL,
  `cmimiBleres` float NOT NULL,
  `cmimiShites` decimal(10,2) NOT NULL,
  `tvsh1` decimal(10,2) NOT NULL DEFAULT 0.00,
  `tvsh2` decimal(10,0) NOT NULL DEFAULT 0,
  `zbritje` decimal(10,2) NOT NULL,
  `garancion_prej` date DEFAULT NULL,
  `garancion_deri` date DEFAULT NULL,
  `sasiakritike` float NOT NULL,
  `pstatusi` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `isDeleted` int(11) NOT NULL,
  `dateCreated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `produktet`
--

INSERT INTO `produktet` (`produktetID`, `furnitoretID`, `stafiID`, `cat_produktetID`, `njesiID`, `emriProduktit`, `pershkrimiProdukit`, `sasia`, `serialnumer`, `cmimiBleres`, `cmimiShites`, `tvsh1`, `tvsh2`, `zbritje`, `garancion_prej`, `garancion_deri`, `sasiakritike`, `pstatusi`, `isDeleted`, `dateCreated`) VALUES
(20, 1, 1, 1, 1, 'elementi', 'dgdfg', '1.00', '', 676, '67676.00', '10.00', '0', '0.00', '0000-00-00', '0000-00-00', 0, '', 0, '0000-00-00'),
(21, 1, 1, 1, 4, 'col 20', 'dfgdfgd', '1.00', '', 34, '3443.00', '18.00', '0', '0.00', '0000-00-00', '0000-00-00', 0, '', 0, '0000-00-00'),
(22, 1, 1, 1, 1, 'ssmsms', 'dgdfg', '1.00', '', 676, '67676.00', '10.00', '0', '0.00', '0000-00-00', '0000-00-00', 0, '', 1, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `sherbimetpagesat`
--

CREATE TABLE `sherbimetpagesat` (
  `sherbimetPagesatID` int(11) NOT NULL,
  `emriSherbimit` varchar(250) COLLATE utf8_swedish_ci NOT NULL,
  `pershkrimiSherbimit` text COLLATE utf8_swedish_ci NOT NULL,
  `cmimiSherbimit` float NOT NULL,
  `statusiSherbimit` int(11) NOT NULL,
  `isDeleted` int(11) NOT NULL,
  `dateCreated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stafi`
--

CREATE TABLE `stafi` (
  `stafiID` int(11) NOT NULL,
  `emri` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `mbiemri` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `titulli` varchar(255) COLLATE utf8_swedish_ci NOT NULL COMMENT 'P.sh. BSc. ',
  `emriperdorues` varchar(255) COLLATE utf8_swedish_ci NOT NULL COMMENT 'E-mail i përdoruesit ose Puntorit',
  `fjalekalimi` varchar(250) COLLATE utf8_swedish_ci NOT NULL COMMENT 'Password i përdoruesit ose Puntorit',
  `email` varchar(255) COLLATE utf8_swedish_ci DEFAULT NULL,
  `data_punesimit` date NOT NULL,
  `image` varchar(255) COLLATE utf8_swedish_ci DEFAULT NULL COMMENT 'Fotoja e Punëtorit',
  `isAdmin` int(11) NOT NULL COMMENT 'Nëse Punëtori i ka Privilegjet e kufizuara',
  `komment` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `ststatusi` varchar(255) COLLATE utf8_swedish_ci NOT NULL DEFAULT 'aktiv',
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
(4, 'Neshat', 'Ademi', 'BSc.', 'nesho', '$2y$10$RFTjftS.WkMsuBgUHGjfE.3ut.R1V6YoBrJzXlaXpBRsCyk20V2zO', NULL, '2021-08-29', '612bf1c78500e.jpg', 1, '', 'aktiv', '2021-08-29 00:00:00', '2022-11-16 01:33:19', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artikujt_per_oferte_fature`
--
ALTER TABLE `artikujt_per_oferte_fature`
  ADD PRIMARY KEY (`artikujt_perofert_fature_ID`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_ID`);

--
-- Indexes for table `cat_produktet`
--
ALTER TABLE `cat_produktet`
  ADD PRIMARY KEY (`cat_produktetID`);

--
-- Indexes for table `furnitoret`
--
ALTER TABLE `furnitoret`
  ADD PRIMARY KEY (`furnitoretID`);

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
  ADD PRIMARY KEY (`ofertatID`),
  ADD UNIQUE KEY `fatur_numer` (`numri_ofertes_fatures`);

--
-- Indexes for table `produktet`
--
ALTER TABLE `produktet`
  ADD PRIMARY KEY (`produktetID`);

--
-- Indexes for table `sherbimetpagesat`
--
ALTER TABLE `sherbimetpagesat`
  ADD PRIMARY KEY (`sherbimetPagesatID`);

--
-- Indexes for table `stafi`
--
ALTER TABLE `stafi`
  ADD PRIMARY KEY (`stafiID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artikujt_per_oferte_fature`
--
ALTER TABLE `artikujt_per_oferte_fature`
  MODIFY `artikujt_perofert_fature_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1116;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1947;

--
-- AUTO_INCREMENT for table `cat_produktet`
--
ALTER TABLE `cat_produktet`
  MODIFY `cat_produktetID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `furnitoret`
--
ALTER TABLE `furnitoret`
  MODIFY `furnitoretID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `historia`
--
ALTER TABLE `historia`
  MODIFY `historiaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

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
  MODIFY `ofertatID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=527;

--
-- AUTO_INCREMENT for table `produktet`
--
ALTER TABLE `produktet`
  MODIFY `produktetID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `sherbimetpagesat`
--
ALTER TABLE `sherbimetpagesat`
  MODIFY `sherbimetPagesatID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stafi`
--
ALTER TABLE `stafi`
  MODIFY `stafiID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

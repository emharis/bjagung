-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.24 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for bajaagung_db
DROP DATABASE IF EXISTS `bajaagung_db`;
CREATE DATABASE IF NOT EXISTS `bajaagung_db` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `bajaagung_db`;


-- Dumping structure for table bajaagung_db.appsetting
DROP TABLE IF EXISTS `appsetting`;
CREATE TABLE IF NOT EXISTS `appsetting` (
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table bajaagung_db.appsetting: ~3 rows (approximately)
DELETE FROM `appsetting`;
/*!40000 ALTER TABLE `appsetting` DISABLE KEYS */;
INSERT INTO `appsetting` (`name`, `value`) VALUES
	('customer_jatuh_tempo', '4'),
	('penjualan_counter', '7'),
	('sidebar_collapse', '1');
/*!40000 ALTER TABLE `appsetting` ENABLE KEYS */;


-- Dumping structure for table bajaagung_db.bank
DROP TABLE IF EXISTS `bank`;
CREATE TABLE IF NOT EXISTS `bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table bajaagung_db.bank: ~23 rows (approximately)
DELETE FROM `bank`;
/*!40000 ALTER TABLE `bank` DISABLE KEYS */;
INSERT INTO `bank` (`id`, `nama`) VALUES
	(1, 'BCA'),
	(2, 'MANDIRI'),
	(3, 'BRI'),
	(4, 'BRI SYARIAH'),
	(5, 'BANK SYARIAH MANDIRI'),
	(6, 'MUAMALAT'),
	(7, 'BCA SYARIAH'),
	(8, 'BANK JATIM'),
	(9, 'CIMB NIAGA'),
	(10, 'BNI'),
	(11, 'BTN'),
	(12, 'BUKOPIN'),
	(13, 'DANAMON'),
	(14, 'BANK MASPION'),
	(15, 'BTPN'),
	(16, 'BANK MEGA'),
	(17, 'BANK MEGA SYARIAH'),
	(18, 'BNI SYARIAH'),
	(19, 'PANIN BANK'),
	(20, 'PERMATA BANK'),
	(21, 'BII MAYBANK'),
	(22, 'HSBC'),
	(23, 'CITIBANK');
/*!40000 ALTER TABLE `bank` ENABLE KEYS */;


-- Dumping structure for table bajaagung_db.barang
DROP TABLE IF EXISTS `barang`;
CREATE TABLE IF NOT EXISTS `barang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `kode` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nama` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kategori_id` int(11) DEFAULT NULL,
  `rol` int(11) DEFAULT NULL COMMENT 'Reorder level',
  `berat` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_barang_kategori` (`kategori_id`),
  CONSTRAINT `FK_barang_kategori` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table bajaagung_db.barang: ~68 rows (approximately)
DELETE FROM `barang`;
/*!40000 ALTER TABLE `barang` DISABLE KEYS */;
INSERT INTO `barang` (`id`, `created_at`, `kode`, `nama`, `kategori_id`, `rol`, `berat`) VALUES
	(14, '2016-05-13 06:48:50', 'ST1', '0,2x30', 33, 10, 45),
	(15, '2016-05-13 06:51:28', 'ST2', '0,2 x 38', 33, 10, 45),
	(16, '2016-05-13 06:51:49', 'ST3', '0,2 x 45', 33, 10, 50),
	(17, '2016-05-13 06:52:20', 'ST4', '0,2 x 50', 33, 10, 48),
	(18, '2016-05-13 06:52:48', 'ST5', '0,2 x 55', 33, 10, 50),
	(19, '2016-05-13 06:53:05', 'ST6', '0,2 X 60', 33, 10, 48),
	(20, '2016-05-13 06:53:24', 'ST7', '0,2 X 72', 33, 10, 50),
	(21, '2016-05-13 06:54:11', 'ST8-48', '0,2 X 76 - 48', 33, 10, 48),
	(22, '2016-05-13 06:54:32', 'ST8-45', '0,2 X 76 - 45', 33, 10, 45),
	(23, '2016-05-13 06:54:56', 'ST10', '0,2 X 88', 33, 10, 45),
	(24, '2016-05-13 06:55:27', 'ST11', '0,2 X 90', 33, 10, 48),
	(25, '2016-05-13 06:56:24', 'GL1', '0,3 X 60', 34, 10, 50),
	(26, '2016-05-13 06:56:43', 'GL2', '0,3 X 90', 34, 10, 50),
	(27, '2016-05-13 07:29:43', 'KW1', '12', 35, 10, 50),
	(28, '2016-05-13 07:30:03', 'KW2', '14', 35, 10, 50),
	(29, '2016-05-13 07:30:18', 'KW3', '16', 35, 10, 50),
	(30, '2016-05-13 07:30:37', 'KW4', '18', 35, 10, 25),
	(31, '2016-05-13 07:30:52', 'KW5', '22', 35, 10, 25),
	(32, '2016-05-13 07:31:49', 'BD1', 'SPaq', 36, 10, 25),
	(33, '2016-05-13 07:32:02', 'BDHP', 'HP', 36, 10, 25),
	(34, '2016-05-13 07:32:31', 'BDRRT25', 'RRT 25', 36, 10, 25),
	(35, '2016-05-13 07:33:14', 'BDRRT20', 'RRT 20', 36, 10, 20),
	(36, '2016-05-13 07:35:23', 'BDSQ', 'SQ', 36, 10, 25),
	(37, '2016-05-13 07:35:44', 'SG6', 'X6', 28, 10, 1),
	(38, '2016-05-13 07:35:55', 'SG7', 'X7', 28, 10, 1),
	(39, '2016-05-13 07:36:06', 'SG8', 'X8', 28, 10, 1),
	(40, '2016-05-13 07:36:22', 'SG10', 'X10', 28, 10, 1),
	(41, '2016-05-13 07:37:14', 'LMRJ', 'RAJAWALI KB', 32, 10, 60),
	(42, '2016-05-13 07:38:11', 'PKSQ34', 'SQ 3/4', 31, 10, 30),
	(43, '2016-05-13 07:38:36', 'PKSQ1', 'SQ 1', 31, 10, 30),
	(44, '2016-05-13 07:38:54', 'PKSQ114', 'SQ 1 1/4"', 31, 10, 30),
	(45, '2016-05-13 07:39:14', 'PKSQ112', 'SQ 1 1/2', 31, 10, 30),
	(46, '2016-05-13 07:39:44', 'PKSQ134', 'SQ 1 3/4', 31, 10, 30),
	(47, '2016-05-13 07:40:11', 'PKSQ2', 'SQ 2', 31, 10, 30),
	(48, '2016-05-13 07:40:32', 'PKSQ212', 'SQ 2 1/2', 31, 10, 30),
	(49, '2016-05-13 07:40:53', 'PKPD34', 'PANDA 3/4', 31, 10, 30),
	(50, '2016-05-13 07:41:06', 'PKPD1', 'PANDA 1', 31, 10, 30),
	(51, '2016-05-13 07:41:28', 'PKPD114', 'PANDA 1 1/4', 31, 10, 30),
	(52, '2016-05-13 07:41:43', 'PKPD112', 'PANDA 1 1/2', 31, 10, 30),
	(53, '2016-05-13 07:41:53', 'PKPD134', 'PANDA 1 3/4', 31, 10, 30),
	(54, '2016-05-13 07:42:08', 'PKPD2', 'PANDA 2', 31, 10, 30),
	(55, '2016-05-13 07:42:22', 'PKPD212', 'PANDA 2 1/2', 31, 10, 30),
	(56, '2016-05-13 07:42:36', 'PKBB34', 'BB 3/4', 31, 10, 30),
	(57, '2016-05-13 07:42:49', 'PKBB1', 'BB 1', 31, 10, 30),
	(58, '2016-05-13 07:43:24', 'PKBB114', 'BB 1 1/4', 31, 10, 30),
	(59, '2016-05-13 07:43:39', 'PKBB112', 'BB 1 1/2', 31, 10, 30),
	(60, '2016-05-13 07:44:04', 'PKBB134', 'BB 1 3/4', 31, 10, 30),
	(61, '2016-05-13 07:44:16', 'PKBB2', 'BB 2', 31, 10, 30),
	(62, '2016-05-13 07:44:28', 'PKBB212', 'BB 2 1/2', 31, 10, 30),
	(63, '2016-05-13 07:49:33', 'PKSP34', 'SP 3/4"', 31, 10, 30),
	(64, '2016-06-05 05:57:09', 'PKKLB', 'KALSIBOT', 31, 10, 1),
	(65, '2016-06-05 06:08:21', 'KRBMDQ', 'MDQ', 37, 10, 25),
	(66, '2016-06-05 06:09:16', 'PKPYSQ', 'PAYUNG SQ', 31, 10, 15),
	(67, '2016-06-05 06:09:31', 'PKPYRRT', 'PAYUNG RRT', 31, 1, 48),
	(68, '2016-06-05 06:10:07', 'KWLKT114', 'LOKET 1 1/4', 35, 1, 1),
	(70, '2016-06-05 06:20:50', 'PKSP112', 'SP 1 1/2"', 31, 1, 30),
	(71, '2016-06-05 06:21:13', 'PKSP134', 'SP 1 3/4"', 31, 1, 30),
	(72, '2016-06-05 06:22:04', 'PKSP2', 'SP 2"', 31, 1, 30),
	(73, '2016-06-05 06:22:24', 'PKSP212+', 'SP 2 1/2+"', 31, 1, 30),
	(74, '2016-06-05 06:22:49', 'PKKG1', 'KING 1', 31, 1, 30),
	(75, '2016-06-05 06:23:05', 'PKKG114', 'KING 1 1/4"', 31, 1, 30),
	(76, '2016-06-05 06:23:24', 'PKKG112', 'KING 1 1/2"', 31, 1, 30),
	(77, '2016-06-05 06:23:48', 'PKKG134', 'KING 1 3/4"', 31, 1, 30),
	(78, '2016-06-05 06:24:00', 'PKKG2', 'KING 2"', 31, 1, 30),
	(79, '2016-06-05 06:24:23', 'PKKG212+', 'KING 2 1/2+"', 31, 1, 30),
	(80, '2016-06-05 06:24:58', 'PKPAQ58', 'PAQ 5/8', 31, 1, 10),
	(81, '2016-06-05 06:25:19', 'PK984', '98+ 4"', 31, 1, 30),
	(82, '2016-06-05 06:25:38', 'PKARC', 'ARCHO M', 31, 1, 1);
/*!40000 ALTER TABLE `barang` ENABLE KEYS */;


-- Dumping structure for table bajaagung_db.beli
DROP TABLE IF EXISTS `beli`;
CREATE TABLE IF NOT EXISTS `beli` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `no_inv` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `disc` int(11) DEFAULT NULL,
  `grand_total` int(11) DEFAULT NULL,
  `tipe` enum('T','K') COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Tunai / Kredit',
  `status` enum('Y','N') COLLATE utf8_unicode_ci DEFAULT 'Y' COMMENT 'Lunas atau belum',
  `can_edit` enum('Y','N') COLLATE utf8_unicode_ci DEFAULT 'Y',
  PRIMARY KEY (`id`),
  UNIQUE KEY `no_nota` (`no_inv`),
  KEY `FK_beli_supplier` (`supplier_id`),
  CONSTRAINT `FK_beli_supplier` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table bajaagung_db.beli: ~0 rows (approximately)
DELETE FROM `beli`;
/*!40000 ALTER TABLE `beli` DISABLE KEYS */;
/*!40000 ALTER TABLE `beli` ENABLE KEYS */;


-- Dumping structure for table bajaagung_db.beli_barang
DROP TABLE IF EXISTS `beli_barang`;
CREATE TABLE IF NOT EXISTS `beli_barang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `beli_id` int(11) DEFAULT NULL,
  `barang_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__beli` (`beli_id`),
  KEY `FK__barang` (`barang_id`),
  CONSTRAINT `FK__barang` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`),
  CONSTRAINT `FK__beli` FOREIGN KEY (`beli_id`) REFERENCES `beli` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table bajaagung_db.beli_barang: ~0 rows (approximately)
DELETE FROM `beli_barang`;
/*!40000 ALTER TABLE `beli_barang` DISABLE KEYS */;
/*!40000 ALTER TABLE `beli_barang` ENABLE KEYS */;


-- Dumping structure for table bajaagung_db.customer
DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `nama` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nama_kontak` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telp` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telp_2` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alamat` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table bajaagung_db.customer: ~9 rows (approximately)
DELETE FROM `customer`;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` (`id`, `created_at`, `nama`, `nama_kontak`, `telp`, `telp_2`, `alamat`) VALUES
	(1, '2016-06-03 14:48:01', 'UD SINAR MULYA', 'HABIBI', '08567546757', NULL, 'TANGGULANGIN, SIDOARJO'),
	(2, '2016-06-19 07:30:02', 'TOKO SETYA AGUNG', 'AGUNG', '( 031 ) 8054545', '', 'Kompl Ruko Tmn Jenggala B/5 Sidoarjo'),
	(3, '2016-06-19 07:30:41', 'DUMBER JADI', 'BUDI', '( 031 ) 8946315', '', 'Jl Tanggulangin Sidoarjo'),
	(4, '2016-06-19 07:30:59', 'UD TELOGO ARTO', 'ARI', '( 031 ) 8922613', '', 'Kompl Pd Sidokare Asri Bl AJ/12 Sidoarjo'),
	(5, '2016-06-19 07:31:27', 'WARGA BUMI ASRI', 'ASRI', '( 031 ) 8940183', '', 'Jl Ngampelsari 15 Sidoarjo'),
	(6, '2016-06-19 07:31:50', 'UD WARINGIN', 'H. IMAM', '( 031 ) 8951356', '', 'Ds Putat RT 01/01 Sidoarjo'),
	(7, '2016-06-19 07:32:16', 'ABADI GENTENG JATIWANGI', 'H. IKHSAN', '( 031 ) 8962921', '', 'Jl Raya Buduran 27 Sidoarjo'),
	(8, '2016-06-19 07:32:35', 'UD AGUNG MAKMUR', 'AGUNG', '( 031 ) 8925447', '', 'Jl Urang Agung RT 010/04 Sidoarjo'),
	(9, '2016-06-19 07:35:43', 'UD BAROKAH', 'HJ. UMI NUNIK', '( 031 ) 8949227', '', 'Jl Kali Tgh Slt RT 002/03 Sidoarjo');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;


-- Dumping structure for table bajaagung_db.harga_jual
DROP TABLE IF EXISTS `harga_jual`;
CREATE TABLE IF NOT EXISTS `harga_jual` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `barang_id` int(11) DEFAULT NULL,
  `harga_beli` int(11) DEFAULT NULL,
  `harga_jual` int(11) DEFAULT NULL,
  `hpp` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table bajaagung_db.harga_jual: ~68 rows (approximately)
DELETE FROM `harga_jual`;
/*!40000 ALTER TABLE `harga_jual` DISABLE KEYS */;
INSERT INTO `harga_jual` (`id`, `created_at`, `barang_id`, `harga_beli`, `harga_jual`, `hpp`) VALUES
	(1, '2016-06-05 08:43:03', 37, 32500, 34125, 32500),
	(2, '2016-06-05 08:43:03', 38, 37900, 39795, 37900),
	(3, '2016-06-05 08:43:03', 39, 43350, 45518, 43350),
	(4, '2016-06-05 08:43:03', 40, 54170, 56879, 54170),
	(5, '2016-06-05 08:43:03', 42, 309000, 324450, 309000),
	(6, '2016-06-05 08:43:03', 43, 306000, 321300, 306000),
	(7, '2016-06-05 08:43:03', 44, 300000, 315000, 300000),
	(8, '2016-06-05 08:43:03', 45, 286500, 300825, 286500),
	(9, '2016-06-05 08:43:03', 46, 276000, 289800, 276000),
	(10, '2016-06-05 08:43:03', 47, 256500, 269325, 256500),
	(11, '2016-06-05 08:43:03', 48, 253500, 266175, 253500),
	(12, '2016-06-05 08:43:03', 49, 303000, 318150, 303000),
	(13, '2016-06-05 08:43:03', 50, 300000, 315000, 300000),
	(14, '2016-06-05 08:43:03', 51, 294000, 308700, 294000),
	(15, '2016-06-05 08:43:03', 52, 280500, 294525, 280500),
	(16, '2016-06-05 08:43:03', 53, 264000, 277200, 264000),
	(17, '2016-06-05 08:43:03', 54, 250500, 263025, 250500),
	(18, '2016-06-05 08:43:03', 55, 247500, 259875, 247500),
	(19, '2016-06-05 08:43:03', 56, 321000, 337050, 321000),
	(20, '2016-06-05 08:43:03', 57, 294000, 308700, 294000),
	(21, '2016-06-05 08:43:03', 58, 285000, 299250, 285000),
	(22, '2016-06-05 08:43:03', 59, 279000, 292950, 279000),
	(23, '2016-06-05 08:43:03', 60, 264000, 277200, 264000),
	(24, '2016-06-05 08:43:03', 61, 243000, 255150, 243000),
	(25, '2016-06-05 08:43:03', 62, 237000, 248850, 237000),
	(26, '2016-06-05 08:43:03', 63, 222000, 233100, 222000),
	(27, '2016-06-05 08:43:03', 64, 14350, 15068, 14350),
	(28, '2016-06-05 08:43:03', 66, 216000, 226800, 216000),
	(29, '2016-06-05 08:43:03', 67, 580800, 609840, 580800),
	(30, '2016-06-05 08:43:03', 70, 201000, 211050, 201000),
	(31, '2016-06-05 08:43:03', 71, 195000, 204750, 195000),
	(32, '2016-06-05 08:43:03', 72, 186000, 195300, 186000),
	(33, '2016-06-05 08:43:03', 73, 186000, 195300, 186000),
	(34, '2016-06-05 08:43:03', 74, 223500, 234675, 223500),
	(35, '2016-06-05 08:43:03', 75, 214500, 225225, 214500),
	(36, '2016-06-05 08:43:03', 76, 199500, 209475, 199500),
	(37, '2016-06-05 08:43:03', 77, 193500, 203175, 193500),
	(38, '2016-06-05 08:43:03', 78, 184500, 193725, 184500),
	(39, '2016-06-05 08:43:03', 79, 184500, 193725, 184500),
	(40, '2016-06-05 08:43:03', 80, 128000, 134400, 128000),
	(41, '2016-06-05 08:43:03', 81, 202500, 212625, 202500),
	(42, '2016-06-05 08:43:03', 82, 420000, 441000, 420000),
	(43, '2016-06-05 08:43:03', 41, 615000, 645750, 615000),
	(44, '2016-06-05 08:43:03', 14, 243000, 255150, 243000),
	(45, '2016-06-05 08:43:03', 15, 333000, 349650, 333000),
	(46, '2016-06-05 08:43:03', 16, 412500, 433125, 412500),
	(47, '2016-06-05 08:43:03', 17, 439200, 461160, 439200),
	(48, '2016-06-05 08:43:03', 18, 525000, 551250, 525000),
	(49, '2016-06-05 08:43:03', 19, 520800, 546840, 520800),
	(50, '2016-06-05 08:43:03', 20, 648000, 680400, 648000),
	(51, '2016-06-05 08:43:03', 21, 736800, 773640, 736800),
	(52, '2016-06-05 08:43:03', 22, 690750, 725288, 690750),
	(53, '2016-06-05 08:43:03', 23, 783000, 822150, 783000),
	(54, '2016-06-05 08:43:03', 24, 801600, 841680, 801600),
	(55, '2016-06-05 08:43:03', 25, 862500, 905625, 862500),
	(56, '2016-06-05 08:43:03', 26, 1525000, 1601250, 1525000),
	(57, '2016-06-05 08:43:03', 27, 480000, 504000, 480000),
	(58, '2016-06-05 08:43:03', 28, 430000, 451500, 430000),
	(59, '2016-06-05 08:43:03', 29, 450000, 472500, 450000),
	(60, '2016-06-05 08:43:03', 30, 237500, 249375, 237500),
	(61, '2016-06-05 08:43:03', 31, 250000, 262500, 250000),
	(62, '2016-06-05 08:43:03', 68, 126000, 132300, 126000),
	(63, '2016-06-05 08:43:03', 32, 228750, 240188, 228750),
	(64, '2016-06-05 08:43:03', 33, 212500, 223125, 212500),
	(65, '2016-06-05 08:43:03', 34, 195000, 204750, 195000),
	(66, '2016-06-05 08:43:03', 35, 156000, 163800, 156000),
	(67, '2016-06-05 08:43:03', 36, 215000, 225750, 215000),
	(68, '2016-06-05 08:43:03', 65, 495000, 519750, 495000);
/*!40000 ALTER TABLE `harga_jual` ENABLE KEYS */;


-- Dumping structure for table bajaagung_db.hutang
DROP TABLE IF EXISTS `hutang`;
CREATE TABLE IF NOT EXISTS `hutang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `beli_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `grand_total` int(11) DEFAULT '0',
  `lunas` enum('Y','N') COLLATE utf8_unicode_ci DEFAULT 'N',
  `sisa_bayar` int(11) DEFAULT '0',
  `sudah_bayar` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_hutang_supplier` (`supplier_id`),
  KEY `FK_hutang_beli` (`beli_id`),
  CONSTRAINT `FK_hutang_beli` FOREIGN KEY (`beli_id`) REFERENCES `beli` (`id`),
  CONSTRAINT `FK_hutang_supplier` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table bajaagung_db.hutang: ~0 rows (approximately)
DELETE FROM `hutang`;
/*!40000 ALTER TABLE `hutang` DISABLE KEYS */;
/*!40000 ALTER TABLE `hutang` ENABLE KEYS */;


-- Dumping structure for table bajaagung_db.hutang_cicil
DROP TABLE IF EXISTS `hutang_cicil`;
CREATE TABLE IF NOT EXISTS `hutang_cicil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `hutang_id` int(11) DEFAULT NULL,
  `bayar` int(11) DEFAULT NULL,
  `sisa` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_hutang_cicil_hutang` (`hutang_id`),
  CONSTRAINT `FK_hutang_cicil_hutang` FOREIGN KEY (`hutang_id`) REFERENCES `hutang` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table bajaagung_db.hutang_cicil: ~0 rows (approximately)
DELETE FROM `hutang_cicil`;
/*!40000 ALTER TABLE `hutang_cicil` DISABLE KEYS */;
/*!40000 ALTER TABLE `hutang_cicil` ENABLE KEYS */;


-- Dumping structure for table bajaagung_db.jual
DROP TABLE IF EXISTS `jual`;
CREATE TABLE IF NOT EXISTS `jual` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `no_inv` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `sales_id` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `disc` int(11) DEFAULT NULL,
  `grand_total` int(11) DEFAULT NULL,
  `tipe` enum('T','K') COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Tunai / Kredit',
  `status` enum('Y','N') COLLATE utf8_unicode_ci DEFAULT 'N' COMMENT 'Lunas atau belum',
  `can_edit` enum('Y','N') COLLATE utf8_unicode_ci DEFAULT 'Y',
  PRIMARY KEY (`id`),
  KEY `FK_jual_customer` (`customer_id`),
  KEY `FK_jual_sales` (`sales_id`),
  CONSTRAINT `FK_jual_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
  CONSTRAINT `FK_jual_sales` FOREIGN KEY (`sales_id`) REFERENCES `sales` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table bajaagung_db.jual: ~3 rows (approximately)
DELETE FROM `jual`;
/*!40000 ALTER TABLE `jual` DISABLE KEYS */;
INSERT INTO `jual` (`id`, `created_at`, `no_inv`, `tgl`, `customer_id`, `sales_id`, `total`, `disc`, `grand_total`, `tipe`, `status`, `can_edit`) VALUES
	(3, '2016-06-17 07:11:50', 'ALI/170601', '2016-06-17', 1, 3, 350000, 0, 350000, 'K', 'N', 'Y'),
	(4, '2016-06-18 16:57:13', 'ALI/180602', '2016-06-18', 1, 3, 937125, 0, 937125, 'K', 'N', 'Y'),
	(5, '2016-06-19 07:36:31', 'ALI/190603', '2016-06-19', 8, 3, 825300, 25300, 800000, 'K', 'N', 'Y'),
	(6, '2016-06-20 16:19:53', 'ALI/200604', '2016-06-20', 1, 3, 1146600, 50000, 1096600, 'K', 'N', 'Y'),
	(7, '2016-06-23 17:21:19', 'ALI/230605', '2016-06-23', 7, 3, 1168808, 50808, 1118000, 'K', 'N', 'Y'),
	(8, '2016-06-24 09:52:34', 'PAR/240606', '2016-06-24', 5, 5, 5731690, 101690, 5630000, 'K', 'N', 'Y');
/*!40000 ALTER TABLE `jual` ENABLE KEYS */;


-- Dumping structure for table bajaagung_db.jual_barang
DROP TABLE IF EXISTS `jual_barang`;
CREATE TABLE IF NOT EXISTS `jual_barang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `jual_id` int(11) DEFAULT NULL,
  `barang_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `harga_satuan` int(11) DEFAULT NULL,
  `harga_salesman` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_jual_barang_jual` (`jual_id`),
  KEY `FK_jual_barang_barang` (`barang_id`),
  CONSTRAINT `FK_jual_barang_barang` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`),
  CONSTRAINT `FK_jual_barang_jual` FOREIGN KEY (`jual_id`) REFERENCES `jual` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table bajaagung_db.jual_barang: ~20 rows (approximately)
DELETE FROM `jual_barang`;
/*!40000 ALTER TABLE `jual_barang` DISABLE KEYS */;
INSERT INTO `jual_barang` (`id`, `created_at`, `jual_id`, `barang_id`, `qty`, `harga_satuan`, `harga_salesman`, `total`) VALUES
	(3, '2016-06-17 07:11:50', 3, 42, 1, 324450, 350000, 350000),
	(4, '2016-06-18 16:57:13', 4, 43, 1, 321300, 321300, 321300),
	(5, '2016-06-18 16:57:13', 4, 44, 1, 315000, 315000, 315000),
	(6, '2016-06-18 16:57:14', 4, 45, 1, 300825, 300825, 300825),
	(7, '2016-06-19 07:36:31', 5, 48, 1, 266175, 266175, 266175),
	(8, '2016-06-19 07:36:31', 5, 47, 1, 269325, 269325, 269325),
	(9, '2016-06-19 07:36:31', 5, 46, 1, 289800, 289800, 289800),
	(10, '2016-06-20 16:19:53', 6, 43, 1, 321300, 321300, 321300),
	(11, '2016-06-20 16:19:53', 6, 46, 1, 289800, 289800, 289800),
	(12, '2016-06-20 16:19:53', 6, 47, 1, 269325, 269325, 269325),
	(13, '2016-06-20 16:19:53', 6, 48, 1, 266175, 266175, 266175),
	(14, '2016-06-23 17:21:19', 7, 39, 1, 45518, 45518, 45518),
	(15, '2016-06-23 17:21:19', 7, 21, 1, 773640, 773640, 773640),
	(16, '2016-06-23 17:21:19', 7, 15, 1, 349650, 349650, 349650),
	(17, '2016-06-24 09:52:34', 8, 32, 5, 240188, 240188, 1200940),
	(18, '2016-06-24 09:52:34', 8, 28, 4, 451500, 451500, 1806000),
	(19, '2016-06-24 09:52:34', 8, 31, 1, 262500, 262500, 262500),
	(20, '2016-06-24 09:52:34', 8, 27, 1, 504000, 504000, 504000),
	(21, '2016-06-24 09:52:34', 8, 14, 5, 255150, 255150, 1275750),
	(22, '2016-06-24 09:52:34', 8, 37, 20, 34125, 34125, 682500);
/*!40000 ALTER TABLE `jual_barang` ENABLE KEYS */;


-- Dumping structure for table bajaagung_db.kategori
DROP TABLE IF EXISTS `kategori`;
CREATE TABLE IF NOT EXISTS `kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `nama` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `satuan_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_kategori_satuan` (`satuan_id`),
  CONSTRAINT `FK_kategori_satuan` FOREIGN KEY (`satuan_id`) REFERENCES `satuan` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table bajaagung_db.kategori: ~8 rows (approximately)
DELETE FROM `kategori`;
/*!40000 ALTER TABLE `kategori` DISABLE KEYS */;
INSERT INTO `kategori` (`id`, `created_at`, `nama`, `satuan_id`) VALUES
	(28, '2016-05-12 06:46:07', 'SENG GELOMBANG', 2),
	(31, '2016-05-12 06:55:40', 'PAKU', 1),
	(32, '2016-05-12 07:25:13', 'LEM', 1),
	(33, '2016-05-13 06:39:41', 'SENG TALANG', 3),
	(34, '2016-05-13 06:56:04', 'GALVALUM', 5),
	(35, '2016-05-13 07:29:18', 'KAWAT', 3),
	(36, '2016-05-13 07:31:19', 'BENDRAT', 3),
	(37, '2016-06-05 06:07:58', 'KARBIT', 1);
/*!40000 ALTER TABLE `kategori` ENABLE KEYS */;


-- Dumping structure for table bajaagung_db.permissions
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `nama` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table bajaagung_db.permissions: ~0 rows (approximately)
DELETE FROM `permissions`;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;


-- Dumping structure for table bajaagung_db.piutang
DROP TABLE IF EXISTS `piutang`;
CREATE TABLE IF NOT EXISTS `piutang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `jual_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT '0',
  `lunas` enum('Y','N') COLLATE utf8_unicode_ci DEFAULT 'N',
  `sisa_bayar` int(11) DEFAULT '0',
  `sudah_bayar` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_piutang_customer` (`customer_id`),
  KEY `FK_piutang_jual` (`jual_id`),
  CONSTRAINT `FK_piutang_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
  CONSTRAINT `FK_piutang_jual` FOREIGN KEY (`jual_id`) REFERENCES `jual` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table bajaagung_db.piutang: ~3 rows (approximately)
DELETE FROM `piutang`;
/*!40000 ALTER TABLE `piutang` DISABLE KEYS */;
INSERT INTO `piutang` (`id`, `created_at`, `jual_id`, `customer_id`, `total`, `lunas`, `sisa_bayar`, `sudah_bayar`) VALUES
	(2, '2016-06-17 07:11:51', 3, 1, 350000, 'N', 350000, 0),
	(3, '2016-06-18 16:57:14', 4, 1, 937125, 'N', 937125, 0),
	(4, '2016-06-19 07:36:31', 5, 8, 800000, 'N', 800000, 0),
	(5, '2016-06-20 16:19:53', 6, 1, 1096600, 'N', 1096600, 0),
	(6, '2016-06-23 17:21:19', 7, 7, 1118000, 'N', 1118000, 0),
	(7, '2016-06-24 09:52:34', 8, 5, 5630000, 'N', 5630000, 0);
/*!40000 ALTER TABLE `piutang` ENABLE KEYS */;


-- Dumping structure for table bajaagung_db.piutang_cicil
DROP TABLE IF EXISTS `piutang_cicil`;
CREATE TABLE IF NOT EXISTS `piutang_cicil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `piutang_id` int(11) DEFAULT NULL,
  `bayar` int(11) DEFAULT NULL,
  `sisa` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_piutang_cicil_piutang` (`piutang_id`),
  CONSTRAINT `FK_piutang_cicil_piutang` FOREIGN KEY (`piutang_id`) REFERENCES `piutang` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table bajaagung_db.piutang_cicil: ~0 rows (approximately)
DELETE FROM `piutang_cicil`;
/*!40000 ALTER TABLE `piutang_cicil` DISABLE KEYS */;
/*!40000 ALTER TABLE `piutang_cicil` ENABLE KEYS */;


-- Dumping structure for table bajaagung_db.roles
DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `nama` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table bajaagung_db.roles: ~0 rows (approximately)
DELETE FROM `roles`;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;


-- Dumping structure for table bajaagung_db.role_permission
DROP TABLE IF EXISTS `role_permission`;
CREATE TABLE IF NOT EXISTS `role_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `permission_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__roles` (`role_id`),
  KEY `FK__permissions` (`permission_id`),
  CONSTRAINT `FK__permissions` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`),
  CONSTRAINT `FK__roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table bajaagung_db.role_permission: ~0 rows (approximately)
DELETE FROM `role_permission`;
/*!40000 ALTER TABLE `role_permission` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_permission` ENABLE KEYS */;


-- Dumping structure for table bajaagung_db.sales
DROP TABLE IF EXISTS `sales`;
CREATE TABLE IF NOT EXISTS `sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `kode` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nama` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ktp` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telp` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telp_2` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alamat` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kode` (`kode`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table bajaagung_db.sales: ~2 rows (approximately)
DELETE FROM `sales`;
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
INSERT INTO `sales` (`id`, `created_at`, `kode`, `nama`, `ktp`, `telp`, `telp_2`, `alamat`) VALUES
	(3, '2016-05-11 20:01:18', 'ALI', 'ALI SUTANTO', '892378734658', '08987877676', '', 'Sidoarjo'),
	(4, '2016-05-11 20:01:44', 'SUP', 'SUPRIADI', '89732845678365873', '089989878876', '', 'Porong'),
	(5, '2016-06-24 09:51:00', 'PAR', 'PARMO', '23476387468326', '085556767879', '', 'SIDOARJO');
/*!40000 ALTER TABLE `sales` ENABLE KEYS */;


-- Dumping structure for table bajaagung_db.satuan
DROP TABLE IF EXISTS `satuan`;
CREATE TABLE IF NOT EXISTS `satuan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `nama` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table bajaagung_db.satuan: ~4 rows (approximately)
DELETE FROM `satuan`;
/*!40000 ALTER TABLE `satuan` DISABLE KEYS */;
INSERT INTO `satuan` (`id`, `created_at`, `nama`) VALUES
	(1, '2016-05-12 06:12:45', 'DOS'),
	(2, '2016-05-12 06:12:48', 'LEMBAR'),
	(3, '2016-05-12 06:32:58', 'ROLL'),
	(5, '2016-05-13 06:40:30', 'LONJOR');
/*!40000 ALTER TABLE `satuan` ENABLE KEYS */;


-- Dumping structure for procedure bajaagung_db.SP_CLEAR_ALL_TRANS
DROP PROCEDURE IF EXISTS `SP_CLEAR_ALL_TRANS`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_CLEAR_ALL_TRANS`()
BEGIN
	delete from hutang_cicil;
	delete from hutang;
	delete from stok_moving;
	delete from stok;
	delete from beli_barang;
	delete from beli;
	#update current harga ke null
	
END//
DELIMITER ;


-- Dumping structure for procedure bajaagung_db.SP_DELETE_PROCCESS_JUAL
DROP PROCEDURE IF EXISTS `SP_DELETE_PROCCESS_JUAL`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DELETE_PROCCESS_JUAL`()
BEGIN
delete from piutang_cicil;
delete from piutang;

update stok set current_stok = stok_awal;
delete from stok_moving where tipe = 'O';

delete from jual_barang;
delete from jual;

update appsetting set value = 1  where name = 'penjualan_counter';

END//
DELIMITER ;


-- Dumping structure for procedure bajaagung_db.SP_DELETE_PROCESS_BELI
DROP PROCEDURE IF EXISTS `SP_DELETE_PROCESS_BELI`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DELETE_PROCESS_BELI`()
BEGIN
	delete from hutang;
	delete from stok_moving;
	delete from stok;
	delete from beli_barang;
	delete from beli;
	update barang set harga_jual_current = NULL;
END//
DELIMITER ;


-- Dumping structure for table bajaagung_db.stok
DROP TABLE IF EXISTS `stok`;
CREATE TABLE IF NOT EXISTS `stok` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tgl` date NOT NULL,
  `barang_id` int(11) NOT NULL DEFAULT '0',
  `stok_awal` int(11) NOT NULL DEFAULT '0',
  `current_stok` int(11) NOT NULL DEFAULT '0',
  `tipe` enum('M','B') COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'M: Manual, B: Beli/Pembelian',
  `harga` int(11) DEFAULT NULL,
  `beli_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_stok_barang` (`barang_id`),
  CONSTRAINT `FK_stok_barang` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table bajaagung_db.stok: ~69 rows (approximately)
DELETE FROM `stok`;
/*!40000 ALTER TABLE `stok` DISABLE KEYS */;
INSERT INTO `stok` (`id`, `created_at`, `tgl`, `barang_id`, `stok_awal`, `current_stok`, `tipe`, `harga`, `beli_id`) VALUES
	(1, '2016-06-05 05:29:35', '2016-06-05', 14, 10, 5, 'M', 243000, NULL),
	(30, '2016-06-05 05:50:05', '2016-06-05', 14, 1, 1, 'M', 243000, NULL),
	(31, '2016-06-05 05:50:19', '2016-06-05', 15, 3, 2, 'M', 333000, NULL),
	(32, '2016-06-05 05:50:46', '2016-06-05', 16, 1, 1, 'M', 412500, NULL),
	(33, '2016-06-05 05:51:05', '2016-06-05', 17, 16, 16, 'M', 439200, NULL),
	(34, '2016-06-05 05:51:21', '2016-06-05', 18, 2, 2, 'M', 525000, NULL),
	(35, '2016-06-05 05:51:39', '2016-06-05', 19, 34, 34, 'M', 520800, NULL),
	(36, '2016-06-05 05:51:58', '2016-06-05', 20, 14, 14, 'M', 648000, NULL),
	(37, '2016-06-05 05:53:52', '2016-06-05', 22, 9, 9, 'M', 690750, NULL),
	(38, '2016-06-05 05:54:11', '2016-06-05', 21, 3, 2, 'M', 736800, NULL),
	(39, '2016-06-05 05:54:28', '2016-06-05', 23, 2, 2, 'M', 783000, NULL),
	(40, '2016-06-05 05:54:58', '2016-06-05', 24, 8, 8, 'M', 801600, NULL),
	(41, '2016-06-05 05:55:20', '2016-06-05', 25, 6, 6, 'M', 862500, NULL),
	(42, '2016-06-05 05:55:48', '2016-06-05', 26, 3, 3, 'M', 1525000, NULL),
	(43, '2016-06-05 05:59:05', '2016-06-05', 64, 6, 6, 'M', 14350, NULL),
	(44, '2016-06-05 05:59:30', '2016-06-05', 27, 1, 0, 'M', 480000, NULL),
	(45, '2016-06-05 05:59:50', '2016-06-05', 28, 8, 4, 'M', 430000, NULL),
	(46, '2016-06-05 06:00:22', '2016-06-05', 29, 7, 7, 'M', 450000, NULL),
	(47, '2016-06-05 06:00:48', '2016-06-05', 30, 2, 2, 'M', 237500, NULL),
	(48, '2016-06-05 06:01:02', '2016-06-05', 31, 1, 0, 'M', 250000, NULL),
	(49, '2016-06-05 06:01:21', '2016-06-05', 32, 26, 21, 'M', 228750, NULL),
	(50, '2016-06-05 06:03:42', '2016-06-05', 33, 95, 95, 'M', 212500, NULL),
	(51, '2016-06-05 06:04:08', '2016-06-05', 34, 51, 51, 'M', 195000, NULL),
	(52, '2016-06-05 06:04:30', '2016-06-05', 35, 56, 56, 'M', 156000, NULL),
	(53, '2016-06-05 06:04:53', '2016-06-05', 36, 8, 8, 'M', 215000, NULL),
	(54, '2016-06-05 06:05:13', '2016-06-05', 37, 225, 205, 'M', 32500, NULL),
	(55, '2016-06-05 06:05:34', '2016-06-05', 38, 275, 275, 'M', 37900, NULL),
	(56, '2016-06-05 06:05:53', '2016-06-05', 39, 395, 394, 'M', 43350, NULL),
	(57, '2016-06-05 06:06:10', '2016-06-05', 40, 610, 610, 'M', 54170, NULL),
	(58, '2016-06-05 06:06:30', '2016-06-05', 41, 116, 116, 'M', 615000, NULL),
	(59, '2016-06-05 06:08:37', '2016-06-05', 65, 11, 11, 'M', 495000, NULL),
	(60, '2016-06-05 06:10:26', '2016-06-05', 66, 6, 6, 'M', 216000, NULL),
	(61, '2016-06-05 06:10:45', '2016-06-05', 67, 3, 3, 'M', 580800, NULL),
	(62, '2016-06-05 06:11:01', '2016-06-05', 68, 1, 1, 'M', 126000, NULL),
	(63, '2016-06-05 06:11:33', '2016-06-05', 42, 1, 0, 'M', 309000, NULL),
	(64, '2016-06-05 06:11:50', '2016-06-05', 43, 3, 1, 'M', 306000, NULL),
	(65, '2016-06-05 06:12:04', '2016-06-05', 44, 1, 0, 'M', 300000, NULL),
	(66, '2016-06-05 06:12:22', '2016-06-05', 45, 1, 0, 'M', 286500, NULL),
	(67, '2016-06-05 06:12:42', '2016-06-05', 46, 12, 10, 'M', 276000, NULL),
	(68, '2016-06-05 06:13:00', '2016-06-05', 47, 5, 3, 'M', 256500, NULL),
	(69, '2016-06-05 06:14:14', '2016-06-05', 48, 40, 38, 'M', 253500, NULL),
	(70, '2016-06-05 06:14:44', '2016-06-05', 49, 1, 1, 'M', 303000, NULL),
	(71, '2016-06-05 06:14:57', '2016-06-05', 50, 1, 1, 'M', 300000, NULL),
	(72, '2016-06-05 06:15:17', '2016-06-05', 51, 6, 6, 'M', 294000, NULL),
	(73, '2016-06-05 06:15:39', '2016-06-05', 52, 7, 7, 'M', 280500, NULL),
	(74, '2016-06-05 06:15:57', '2016-06-05', 53, 12, 12, 'M', 264000, NULL),
	(75, '2016-06-05 06:16:51', '2016-06-05', 54, 29, 29, 'M', 250500, NULL),
	(76, '2016-06-05 06:17:10', '2016-06-05', 55, 82, 82, 'M', 247500, NULL),
	(77, '2016-06-05 06:17:29', '2016-06-05', 56, 2, 2, 'M', 321000, NULL),
	(78, '2016-06-05 06:17:47', '2016-06-05', 57, 1, 1, 'M', 294000, NULL),
	(79, '2016-06-05 06:18:07', '2016-06-05', 58, 1, 1, 'M', 285000, NULL),
	(80, '2016-06-05 06:18:23', '2016-06-05', 59, 3, 3, 'M', 279000, NULL),
	(81, '2016-06-05 06:18:41', '2016-06-05', 60, 4, 4, 'M', 264000, NULL),
	(82, '2016-06-05 06:19:00', '2016-06-05', 61, 5, 5, 'M', 243000, NULL),
	(83, '2016-06-05 06:19:24', '2016-06-05', 62, 38, 38, 'M', 237000, NULL),
	(84, '2016-06-05 06:19:47', '2016-06-05', 63, 1, 1, 'M', 222000, NULL),
	(85, '2016-06-05 06:27:09', '2016-06-05', 70, 3, 3, 'M', 201000, NULL),
	(86, '2016-06-05 06:27:25', '2016-06-05', 71, 7, 7, 'M', 195000, NULL),
	(87, '2016-06-05 06:27:40', '2016-06-05', 72, 10, 10, 'M', 186000, NULL),
	(88, '2016-06-05 06:27:55', '2016-06-05', 73, 8, 8, 'M', 186000, NULL),
	(89, '2016-06-05 06:28:18', '2016-06-05', 74, 1, 1, 'M', 223500, NULL),
	(90, '2016-06-05 06:28:36', '2016-06-05', 75, 5, 5, 'M', 214500, NULL),
	(91, '2016-06-05 06:28:51', '2016-06-05', 76, 4, 4, 'M', 199500, NULL),
	(92, '2016-06-05 06:29:11', '2016-06-05', 78, 6, 6, 'M', 184500, NULL),
	(93, '2016-06-05 06:29:25', '2016-06-05', 79, 28, 28, 'M', 184500, NULL),
	(94, '2016-06-05 06:29:44', '2016-06-05', 80, 1, 1, 'M', 128000, NULL),
	(95, '2016-06-05 06:29:57', '2016-06-05', 81, 1, 1, 'M', 202500, NULL),
	(96, '2016-06-05 06:30:12', '2016-06-05', 82, 35, 35, 'M', 420000, NULL),
	(97, '2016-06-05 08:40:53', '2016-06-05', 77, 1, 1, 'M', 193500, NULL);
/*!40000 ALTER TABLE `stok` ENABLE KEYS */;


-- Dumping structure for table bajaagung_db.stok_moving
DROP TABLE IF EXISTS `stok_moving`;
CREATE TABLE IF NOT EXISTS `stok_moving` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `stok_id` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `tipe` enum('I','O') COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'I=Int, O=Out',
  `jual_id` int(11) DEFAULT NULL COMMENT 'penjualan id, ketika barang keluar',
  PRIMARY KEY (`id`),
  KEY `FK_stok_moving_stok` (`stok_id`),
  CONSTRAINT `FK_stok_moving_stok` FOREIGN KEY (`stok_id`) REFERENCES `stok` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table bajaagung_db.stok_moving: ~69 rows (approximately)
DELETE FROM `stok_moving`;
/*!40000 ALTER TABLE `stok_moving` DISABLE KEYS */;
INSERT INTO `stok_moving` (`id`, `created_at`, `stok_id`, `jumlah`, `tipe`, `jual_id`) VALUES
	(1, '2016-06-05 05:29:35', 1, 10, 'I', NULL),
	(30, '2016-06-05 05:50:05', 30, 1, 'I', NULL),
	(31, '2016-06-05 05:50:19', 31, 3, 'I', NULL),
	(32, '2016-06-05 05:50:46', 32, 1, 'I', NULL),
	(33, '2016-06-05 05:51:05', 33, 16, 'I', NULL),
	(34, '2016-06-05 05:51:21', 34, 2, 'I', NULL),
	(35, '2016-06-05 05:51:39', 35, 34, 'I', NULL),
	(36, '2016-06-05 05:51:58', 36, 14, 'I', NULL),
	(37, '2016-06-05 05:53:52', 37, 9, 'I', NULL),
	(38, '2016-06-05 05:54:11', 38, 3, 'I', NULL),
	(39, '2016-06-05 05:54:28', 39, 2, 'I', NULL),
	(40, '2016-06-05 05:54:58', 40, 8, 'I', NULL),
	(41, '2016-06-05 05:55:20', 41, 6, 'I', NULL),
	(42, '2016-06-05 05:55:48', 42, 3, 'I', NULL),
	(43, '2016-06-05 05:59:05', 43, 6, 'I', NULL),
	(44, '2016-06-05 05:59:30', 44, 1, 'I', NULL),
	(45, '2016-06-05 05:59:50', 45, 8, 'I', NULL),
	(46, '2016-06-05 06:00:22', 46, 7, 'I', NULL),
	(47, '2016-06-05 06:00:48', 47, 2, 'I', NULL),
	(48, '2016-06-05 06:01:02', 48, 1, 'I', NULL),
	(49, '2016-06-05 06:01:21', 49, 26, 'I', NULL),
	(50, '2016-06-05 06:03:42', 50, 95, 'I', NULL),
	(51, '2016-06-05 06:04:08', 51, 51, 'I', NULL),
	(52, '2016-06-05 06:04:30', 52, 56, 'I', NULL),
	(53, '2016-06-05 06:04:53', 53, 8, 'I', NULL),
	(54, '2016-06-05 06:05:13', 54, 225, 'I', NULL),
	(55, '2016-06-05 06:05:34', 55, 275, 'I', NULL),
	(56, '2016-06-05 06:05:53', 56, 395, 'I', NULL),
	(57, '2016-06-05 06:06:10', 57, 610, 'I', NULL),
	(58, '2016-06-05 06:06:30', 58, 116, 'I', NULL),
	(59, '2016-06-05 06:08:37', 59, 11, 'I', NULL),
	(60, '2016-06-05 06:10:26', 60, 6, 'I', NULL),
	(61, '2016-06-05 06:10:45', 61, 3, 'I', NULL),
	(62, '2016-06-05 06:11:01', 62, 1, 'I', NULL),
	(63, '2016-06-05 06:11:33', 63, 1, 'I', NULL),
	(64, '2016-06-05 06:11:50', 64, 3, 'I', NULL),
	(65, '2016-06-05 06:12:04', 65, 1, 'I', NULL),
	(66, '2016-06-05 06:12:22', 66, 1, 'I', NULL),
	(67, '2016-06-05 06:12:42', 67, 12, 'I', NULL),
	(68, '2016-06-05 06:13:00', 68, 5, 'I', NULL),
	(69, '2016-06-05 06:14:14', 69, 40, 'I', NULL),
	(70, '2016-06-05 06:14:44', 70, 1, 'I', NULL),
	(71, '2016-06-05 06:14:57', 71, 1, 'I', NULL),
	(72, '2016-06-05 06:15:17', 72, 6, 'I', NULL),
	(73, '2016-06-05 06:15:39', 73, 7, 'I', NULL),
	(74, '2016-06-05 06:15:57', 74, 12, 'I', NULL),
	(75, '2016-06-05 06:16:51', 75, 29, 'I', NULL),
	(76, '2016-06-05 06:17:10', 76, 82, 'I', NULL),
	(77, '2016-06-05 06:17:29', 77, 2, 'I', NULL),
	(78, '2016-06-05 06:17:47', 78, 1, 'I', NULL),
	(79, '2016-06-05 06:18:07', 79, 1, 'I', NULL),
	(80, '2016-06-05 06:18:23', 80, 3, 'I', NULL),
	(81, '2016-06-05 06:18:41', 81, 4, 'I', NULL),
	(82, '2016-06-05 06:19:00', 82, 5, 'I', NULL),
	(83, '2016-06-05 06:19:24', 83, 38, 'I', NULL),
	(84, '2016-06-05 06:19:47', 84, 1, 'I', NULL),
	(85, '2016-06-05 06:27:09', 85, 3, 'I', NULL),
	(86, '2016-06-05 06:27:25', 86, 7, 'I', NULL),
	(87, '2016-06-05 06:27:40', 87, 10, 'I', NULL),
	(88, '2016-06-05 06:27:55', 88, 8, 'I', NULL),
	(89, '2016-06-05 06:28:18', 89, 1, 'I', NULL),
	(90, '2016-06-05 06:28:36', 90, 5, 'I', NULL),
	(91, '2016-06-05 06:28:51', 91, 4, 'I', NULL),
	(92, '2016-06-05 06:29:11', 92, 6, 'I', NULL),
	(93, '2016-06-05 06:29:25', 93, 28, 'I', NULL),
	(94, '2016-06-05 06:29:44', 94, 1, 'I', NULL),
	(95, '2016-06-05 06:29:57', 95, 1, 'I', NULL),
	(96, '2016-06-05 06:30:12', 96, 35, 'I', NULL),
	(97, '2016-06-05 08:40:53', 97, 1, 'I', NULL),
	(100, '2016-06-17 07:11:51', 63, 1, 'O', 3),
	(101, '2016-06-18 16:57:13', 64, 1, 'O', 4),
	(102, '2016-06-18 16:57:14', 65, 1, 'O', 4),
	(103, '2016-06-18 16:57:14', 66, 1, 'O', 4),
	(104, '2016-06-19 07:36:31', 69, 1, 'O', 5),
	(105, '2016-06-19 07:36:31', 68, 1, 'O', 5),
	(106, '2016-06-19 07:36:31', 67, 1, 'O', 5),
	(107, '2016-06-20 16:19:53', 64, 1, 'O', 6),
	(108, '2016-06-20 16:19:53', 67, 1, 'O', 6),
	(109, '2016-06-20 16:19:53', 68, 1, 'O', 6),
	(110, '2016-06-20 16:19:53', 69, 1, 'O', 6),
	(111, '2016-06-23 17:21:19', 56, 1, 'O', 7),
	(112, '2016-06-23 17:21:19', 38, 1, 'O', 7),
	(113, '2016-06-23 17:21:19', 31, 1, 'O', 7),
	(114, '2016-06-24 09:52:34', 49, 5, 'O', 8),
	(115, '2016-06-24 09:52:34', 45, 4, 'O', 8),
	(116, '2016-06-24 09:52:34', 48, 1, 'O', 8),
	(117, '2016-06-24 09:52:34', 44, 1, 'O', 8),
	(118, '2016-06-24 09:52:34', 1, 5, 'O', 8),
	(119, '2016-06-24 09:52:34', 54, 20, 'O', 8);
/*!40000 ALTER TABLE `stok_moving` ENABLE KEYS */;


-- Dumping structure for table bajaagung_db.supplier
DROP TABLE IF EXISTS `supplier`;
CREATE TABLE IF NOT EXISTS `supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `nama` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nama_kontak` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telp` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telp_2` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alamat` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `jatuh_tempo` int(11) DEFAULT NULL COMMENT 'dalam satuan minggu',
  `rek` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table bajaagung_db.supplier: ~2 rows (approximately)
DELETE FROM `supplier`;
/*!40000 ALTER TABLE `supplier` DISABLE KEYS */;
INSERT INTO `supplier` (`id`, `created_at`, `nama`, `nama_kontak`, `telp`, `telp_2`, `alamat`, `jatuh_tempo`, `rek`) VALUES
	(1, '2016-05-12 08:15:17', 'PT BAJA STEEL', 'ALWI', '0899878967896', '08989787678576', 'Surabaya', 2, '1234567890'),
	(2, '2016-05-22 17:09:35', 'PT MASPION', 'ALI MARKUS', '083495678436587', '', 'SIDOARJO', 8, '008 997 665 887');
/*!40000 ALTER TABLE `supplier` ENABLE KEYS */;


-- Dumping structure for table bajaagung_db.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` date NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `verified` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table bajaagung_db.users: ~0 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


-- Dumping structure for table bajaagung_db.user_role
DROP TABLE IF EXISTS `user_role`;
CREATE TABLE IF NOT EXISTS `user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_user_role_users` (`user_id`),
  KEY `FK_user_role_roles` (`role_id`),
  CONSTRAINT `FK_user_role_roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_user_role_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table bajaagung_db.user_role: ~0 rows (approximately)
DELETE FROM `user_role`;
/*!40000 ALTER TABLE `user_role` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_role` ENABLE KEYS */;


-- Dumping structure for view bajaagung_db.VIEW_BARANG
DROP VIEW IF EXISTS `VIEW_BARANG`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `VIEW_BARANG` (
	`id` INT(11) NOT NULL,
	`created_at` TIMESTAMP NULL,
	`kode` VARCHAR(10) NULL COLLATE 'utf8_unicode_ci',
	`nama` VARCHAR(250) NULL COLLATE 'utf8_unicode_ci',
	`kategori_id` INT(11) NULL,
	`kategori` VARCHAR(250) NULL COLLATE 'utf8_unicode_ci',
	`satuan_id` INT(11) NULL,
	`satuan` VARCHAR(250) NULL COLLATE 'utf8_unicode_ci',
	`berat` INT(11) NULL,
	`harga_jual` BIGINT(11) NULL
) ENGINE=MyISAM;


-- Dumping structure for view bajaagung_db.VIEW_BELI
DROP VIEW IF EXISTS `VIEW_BELI`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `VIEW_BELI` (
	`id` INT(11) NOT NULL,
	`created_at` TIMESTAMP NULL,
	`no_inv` VARCHAR(50) NULL COLLATE 'utf8_unicode_ci',
	`tipe` ENUM('T','K') NULL COMMENT 'Tunai / Kredit' COLLATE 'utf8_unicode_ci',
	`tgl` DATE NULL,
	`tgl_formatted` VARCHAR(10) NULL COLLATE 'utf8mb4_general_ci',
	`supplier_id` INT(11) NULL,
	`total` INT(11) NULL,
	`grand_total` INT(11) NULL,
	`disc` INT(11) NULL,
	`supplier` VARCHAR(150) NULL COLLATE 'utf8_unicode_ci',
	`can_edit` ENUM('Y','N') NULL COLLATE 'utf8_unicode_ci'
) ENGINE=MyISAM;


-- Dumping structure for view bajaagung_db.VIEW_BELI_BARANG
DROP VIEW IF EXISTS `VIEW_BELI_BARANG`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `VIEW_BELI_BARANG` (
	`id` INT(11) NOT NULL,
	`created_at` TIMESTAMP NULL,
	`beli_id` INT(11) NULL,
	`barang_id` INT(11) NULL,
	`kode` VARCHAR(10) NULL COLLATE 'utf8_unicode_ci',
	`satuan` VARCHAR(250) NULL COLLATE 'utf8_unicode_ci',
	`qty` INT(11) NULL,
	`harga` INT(11) NULL,
	`total` INT(11) NULL,
	`barang` VARCHAR(250) NULL COLLATE 'utf8_unicode_ci',
	`kategori_id` INT(11) NULL,
	`kategori` VARCHAR(250) NULL COLLATE 'utf8_unicode_ci',
	`nama_barang_full` VARCHAR(501) NULL COLLATE 'utf8_unicode_ci'
) ENGINE=MyISAM;


-- Dumping structure for view bajaagung_db.VIEW_JUAL
DROP VIEW IF EXISTS `VIEW_JUAL`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `VIEW_JUAL` (
	`id` INT(11) NOT NULL,
	`created_at` TIMESTAMP NULL,
	`no_inv` VARCHAR(50) NULL COLLATE 'utf8_unicode_ci',
	`tgl` DATE NULL,
	`tgl_formatted` VARCHAR(10) NULL COLLATE 'utf8mb4_general_ci',
	`customer_id` INT(11) NULL,
	`customer` VARCHAR(150) NULL COLLATE 'utf8_unicode_ci',
	`sales_id` INT(11) NULL,
	`salesman` VARCHAR(150) NULL COLLATE 'utf8_unicode_ci',
	`total` INT(11) NULL,
	`disc` INT(11) NULL,
	`grand_total` INT(11) NULL,
	`tipe` ENUM('T','K') NULL COMMENT 'Tunai / Kredit' COLLATE 'utf8_unicode_ci',
	`status` ENUM('Y','N') NULL COMMENT 'Lunas atau belum' COLLATE 'utf8_unicode_ci',
	`can_edit` ENUM('Y','N') NULL COLLATE 'utf8_unicode_ci'
) ENGINE=MyISAM;


-- Dumping structure for view bajaagung_db.VIEW_JUAL_BARANG
DROP VIEW IF EXISTS `VIEW_JUAL_BARANG`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `VIEW_JUAL_BARANG` (
	`id` INT(11) NOT NULL,
	`created_at` TIMESTAMP NULL,
	`jual_id` INT(11) NULL,
	`barang_id` INT(11) NULL,
	`kategori` VARCHAR(250) NULL COLLATE 'utf8_unicode_ci',
	`satuan` VARCHAR(250) NULL COLLATE 'utf8_unicode_ci',
	`kode` VARCHAR(10) NULL COLLATE 'utf8_unicode_ci',
	`barang` VARCHAR(250) NULL COLLATE 'utf8_unicode_ci',
	`nama_full` VARCHAR(501) NULL COLLATE 'utf8_unicode_ci',
	`qty` INT(11) NULL,
	`harga_satuan` INT(11) NULL,
	`harga_salesman` INT(11) NULL,
	`total` INT(11) NULL
) ENGINE=MyISAM;


-- Dumping structure for view bajaagung_db.VIEW_KATEGORI
DROP VIEW IF EXISTS `VIEW_KATEGORI`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `VIEW_KATEGORI` (
	`id` INT(11) NOT NULL,
	`created_at` TIMESTAMP NULL,
	`nama` VARCHAR(250) NULL COLLATE 'utf8_unicode_ci',
	`satuan_id` INT(11) NULL,
	`satuan` VARCHAR(250) NULL COLLATE 'utf8_unicode_ci',
	`ref` BIGINT(21) NULL
) ENGINE=MyISAM;


-- Dumping structure for view bajaagung_db.VIEW_PEMBELIAN
DROP VIEW IF EXISTS `VIEW_PEMBELIAN`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `VIEW_PEMBELIAN` (
	`id` INT(11) NOT NULL,
	`created_at` TIMESTAMP NULL,
	`can_edit` ENUM('Y','N') NULL COLLATE 'utf8_unicode_ci',
	`no_inv` VARCHAR(50) NULL COLLATE 'utf8_unicode_ci',
	`tgl` DATE NULL,
	`tgl_formatted` VARCHAR(10) NULL COLLATE 'utf8mb4_general_ci',
	`supplier_id` INT(11) NULL,
	`total` BIGINT(11) NOT NULL,
	`disc` BIGINT(11) NOT NULL,
	`grand_total` BIGINT(12) NULL,
	`tipe` ENUM('T','K') NULL COMMENT 'Tunai / Kredit' COLLATE 'utf8_unicode_ci',
	`status` ENUM('Y','N') NULL COMMENT 'Lunas atau belum' COLLATE 'utf8_unicode_ci',
	`supplier` VARCHAR(150) NULL COLLATE 'utf8_unicode_ci'
) ENGINE=MyISAM;


-- Dumping structure for view bajaagung_db.VIEW_PENJUALAN
DROP VIEW IF EXISTS `VIEW_PENJUALAN`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `VIEW_PENJUALAN` (
	`jual_barang_id` INT(11) NOT NULL,
	`jual_id` INT(11) NULL,
	`created_at` TIMESTAMP NULL,
	`tgl_formatted` VARCHAR(10) NULL COLLATE 'utf8mb4_general_ci',
	`no_inv` VARCHAR(50) NULL COLLATE 'utf8_unicode_ci',
	`tgl` DATE NULL,
	`customer_id` INT(11) NULL,
	`nama` VARCHAR(150) NULL COLLATE 'utf8_unicode_ci',
	`sales_id` INT(11) NULL,
	`kode_salesman` VARCHAR(50) NULL COLLATE 'utf8_unicode_ci',
	`salesman` VARCHAR(150) NULL COLLATE 'utf8_unicode_ci',
	`total` INT(11) NULL,
	`disc` INT(11) NULL,
	`grand_total` INT(11) NULL,
	`tipe` ENUM('T','K') NULL COMMENT 'Tunai / Kredit' COLLATE 'utf8_unicode_ci',
	`status` ENUM('Y','N') NULL COMMENT 'Lunas atau belum' COLLATE 'utf8_unicode_ci',
	`can_edit` ENUM('Y','N') NULL COLLATE 'utf8_unicode_ci',
	`barang_id` INT(11) NULL,
	`kategori` VARCHAR(250) NULL COLLATE 'utf8_unicode_ci',
	`barang` VARCHAR(250) NULL COLLATE 'utf8_unicode_ci',
	`barang_full` VARCHAR(501) NULL COLLATE 'utf8_unicode_ci',
	`qty` INT(11) NULL,
	`harga_satuan` INT(11) NULL,
	`harga_salesman` INT(11) NULL,
	`sub_total` INT(11) NULL
) ENGINE=MyISAM;


-- Dumping structure for view bajaagung_db.VIEW_SATUAN
DROP VIEW IF EXISTS `VIEW_SATUAN`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `VIEW_SATUAN` (
	`id` INT(11) NOT NULL,
	`created_at` TIMESTAMP NULL,
	`nama` VARCHAR(250) NULL COLLATE 'utf8_unicode_ci',
	`ref` BIGINT(21) NULL
) ENGINE=MyISAM;


-- Dumping structure for view bajaagung_db.VIEW_STOK
DROP VIEW IF EXISTS `VIEW_STOK`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `VIEW_STOK` (
	`id` INT(11) NOT NULL,
	`created_at` TIMESTAMP NOT NULL,
	`tgl` DATE NOT NULL,
	`barang_id` INT(11) NOT NULL,
	`stok_awal` INT(11) NOT NULL,
	`current_stok` INT(11) NOT NULL,
	`tipe` ENUM('M','B') NULL COMMENT 'M: Manual, B: Beli/Pembelian' COLLATE 'utf8_unicode_ci',
	`harga` INT(11) NULL,
	`total_harga` BIGINT(21) NULL
) ENGINE=MyISAM;


-- Dumping structure for view bajaagung_db.VIEW_STOK_BARANG
DROP VIEW IF EXISTS `VIEW_STOK_BARANG`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `VIEW_STOK_BARANG` (
	`id` INT(11) NOT NULL,
	`created_at` TIMESTAMP NULL,
	`kode` VARCHAR(10) NULL COLLATE 'utf8_unicode_ci',
	`nama` VARCHAR(250) NULL COLLATE 'utf8_unicode_ci',
	`nama_full` VARCHAR(501) NULL COLLATE 'utf8_unicode_ci',
	`kategori_id` INT(11) NULL,
	`kategori` VARCHAR(250) NULL COLLATE 'utf8_unicode_ci',
	`satuan_id` INT(11) NULL,
	`satuan` VARCHAR(250) NULL COLLATE 'utf8_unicode_ci',
	`berat` INT(11) NULL,
	`harga_jual_current` BIGINT(11) NULL,
	`stok` DECIMAL(32,0) NOT NULL,
	`hpp` VARCHAR(97) NULL COLLATE 'utf8mb4_general_ci',
	`hpp_fix` DECIMAL(16,0) NULL
) ENGINE=MyISAM;


-- Dumping structure for view bajaagung_db.VIEW_BARANG
DROP VIEW IF EXISTS `VIEW_BARANG`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `VIEW_BARANG`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `VIEW_BARANG` AS select `b`.`id` AS `id`,`b`.`created_at` AS `created_at`,`b`.`kode` AS `kode`,`b`.`nama` AS `nama`,`b`.`kategori_id` AS `kategori_id`,`k`.`nama` AS `kategori`,`k`.`satuan_id` AS `satuan_id`,`s`.`nama` AS `satuan`,`b`.`berat` AS `berat`,(select `harga_jual`.`harga_jual` from `harga_jual` where (`harga_jual`.`barang_id` = `b`.`id`) order by `harga_jual`.`id` desc limit 1) AS `harga_jual` from ((`barang` `b` join `kategori` `k` on((`b`.`kategori_id` = `k`.`id`))) join `satuan` `s` on((`k`.`satuan_id` = `s`.`id`))) ;


-- Dumping structure for view bajaagung_db.VIEW_BELI
DROP VIEW IF EXISTS `VIEW_BELI`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `VIEW_BELI`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `VIEW_BELI` AS select `b`.`id` AS `id`,`b`.`created_at` AS `created_at`,`b`.`no_inv` AS `no_inv`,`b`.`tipe` AS `tipe`,`b`.`tgl` AS `tgl`,date_format(`b`.`tgl`,'%d-%m-%Y') AS `tgl_formatted`,`b`.`supplier_id` AS `supplier_id`,`b`.`total` AS `total`,`b`.`grand_total` AS `grand_total`,`b`.`disc` AS `disc`,`s`.`nama` AS `supplier`,`b`.`can_edit` AS `can_edit` from (`beli` `b` join `supplier` `s` on((`b`.`supplier_id` = `s`.`id`))) ;


-- Dumping structure for view bajaagung_db.VIEW_BELI_BARANG
DROP VIEW IF EXISTS `VIEW_BELI_BARANG`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `VIEW_BELI_BARANG`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `VIEW_BELI_BARANG` AS select `bb`.`id` AS `id`,`bb`.`created_at` AS `created_at`,`bb`.`beli_id` AS `beli_id`,`bb`.`barang_id` AS `barang_id`,`b`.`kode` AS `kode`,`s`.`nama` AS `satuan`,`bb`.`qty` AS `qty`,`bb`.`harga` AS `harga`,`bb`.`total` AS `total`,`b`.`nama` AS `barang`,`b`.`kategori_id` AS `kategori_id`,`k`.`nama` AS `kategori`,concat(`k`.`nama`,' ',`b`.`nama`) AS `nama_barang_full` from (((`beli_barang` `bb` join `barang` `b` on((`bb`.`barang_id` = `b`.`id`))) join `kategori` `k` on((`b`.`kategori_id` = `k`.`id`))) join `satuan` `s` on((`k`.`satuan_id` = `s`.`id`))) ;


-- Dumping structure for view bajaagung_db.VIEW_JUAL
DROP VIEW IF EXISTS `VIEW_JUAL`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `VIEW_JUAL`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `VIEW_JUAL` AS select j.id,j.created_at,j.no_inv,j.tgl,date_format(`tgl`,'%d-%m-%Y') AS `tgl_formatted`,j.customer_id,c.nama as customer,j.sales_id,s.nama as salesman,j.total
,j.disc,j.grand_total,j.tipe,j.`status`,j.can_edit
from jual  as j
inner join customer as c on j.customer_id = c.id
inner join sales as s on j.sales_id = s.id ;


-- Dumping structure for view bajaagung_db.VIEW_JUAL_BARANG
DROP VIEW IF EXISTS `VIEW_JUAL_BARANG`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `VIEW_JUAL_BARANG`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `VIEW_JUAL_BARANG` AS select jb.id,jb.created_at,jb.jual_id,jb.barang_id,
k.nama as kategori,s.nama as satuan, b.kode, b.nama as barang, concat(k.nama," ",b.nama) as nama_full,
jb.qty,jb.harga_satuan,jb.harga_salesman,jb.total
from jual_barang as jb
inner join barang b  on jb.barang_id = b.id
inner join kategori k on b.kategori_id = k.id
inner join satuan s on k.satuan_id = s.id ;


-- Dumping structure for view bajaagung_db.VIEW_KATEGORI
DROP VIEW IF EXISTS `VIEW_KATEGORI`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `VIEW_KATEGORI`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `VIEW_KATEGORI` AS select `k`.`id` AS `id`,`k`.`created_at` AS `created_at`,`k`.`nama` AS `nama`,`k`.`satuan_id` AS `satuan_id`,`s`.`nama` AS `satuan`,(select count(`b`.`id`) from `barang` `b` where (`b`.`kategori_id` = `k`.`id`)) AS `ref` from (`kategori` `k` join `satuan` `s` on((`k`.`satuan_id` = `s`.`id`))) ;


-- Dumping structure for view bajaagung_db.VIEW_PEMBELIAN
DROP VIEW IF EXISTS `VIEW_PEMBELIAN`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `VIEW_PEMBELIAN`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `VIEW_PEMBELIAN` AS select `b`.`id` AS `id`,`b`.`created_at` AS `created_at`,`b`.`can_edit` AS `can_edit`,`b`.`no_inv` AS `no_inv`,`b`.`tgl` AS `tgl`,date_format(`b`.`tgl`,'%d-%m-%Y') AS `tgl_formatted`,`b`.`supplier_id` AS `supplier_id`,ifnull(`b`.`total`,0) AS `total`,ifnull(`b`.`disc`,0) AS `disc`,(`b`.`total` - ifnull(`b`.`disc`,0)) AS `grand_total`,`b`.`tipe` AS `tipe`,`b`.`status` AS `status`,`s`.`nama` AS `supplier` from (`beli` `b` join `supplier` `s` on((`b`.`supplier_id` = `s`.`id`))) ;


-- Dumping structure for view bajaagung_db.VIEW_PENJUALAN
DROP VIEW IF EXISTS `VIEW_PENJUALAN`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `VIEW_PENJUALAN`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `VIEW_PENJUALAN` AS select jb.id as jual_barang_id,jb.jual_id, 
j.created_at,date_format(`j`.`tgl`,'%d-%m-%Y') AS `tgl_formatted`,j.no_inv,j.tgl,j.customer_id, c.nama ,j.sales_id,s.kode as kode_salesman, 
s.nama as salesman,j.total,j.disc,j.grand_total,j.tipe,j.`status`,j.can_edit
 ,jb.barang_id,k.nama as kategori,b.nama as barang,concat(k.nama," ",b.nama) as barang_full,jb.qty,jb.harga_satuan,
jb.harga_salesman,jb.total as sub_total
from jual_barang as jb
inner join jual as j on jb.jual_id = j.id
inner join customer as c on j.customer_id = c.id
inner join sales as s on j.sales_id = s.id
inner join barang as b on jb.barang_id = b.id
inner join kategori as k on b.kategori_id = k.id ;


-- Dumping structure for view bajaagung_db.VIEW_SATUAN
DROP VIEW IF EXISTS `VIEW_SATUAN`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `VIEW_SATUAN`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `VIEW_SATUAN` AS select `s`.`id` AS `id`,`s`.`created_at` AS `created_at`,`s`.`nama` AS `nama`,(select count(`k`.`id`) from `kategori` `k` where (`k`.`satuan_id` = `s`.`id`)) AS `ref` from `satuan` `s` ;


-- Dumping structure for view bajaagung_db.VIEW_STOK
DROP VIEW IF EXISTS `VIEW_STOK`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `VIEW_STOK`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `VIEW_STOK` AS select `stok`.`id` AS `id`,`stok`.`created_at` AS `created_at`,`stok`.`tgl` AS `tgl`,`stok`.`barang_id` AS `barang_id`,`stok`.`stok_awal` AS `stok_awal`,`stok`.`current_stok` AS `current_stok`,`stok`.`tipe` AS `tipe`,`stok`.`harga` AS `harga`,(`stok`.`harga` * `stok`.`stok_awal`) AS `total_harga` from `stok` ;


-- Dumping structure for view bajaagung_db.VIEW_STOK_BARANG
DROP VIEW IF EXISTS `VIEW_STOK_BARANG`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `VIEW_STOK_BARANG`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `VIEW_STOK_BARANG` AS select `b`.`id` AS `id`,`b`.`created_at` AS `created_at`,`b`.`kode` AS `kode`,ucase(`b`.`nama`) AS `nama`,ucase(concat(`k`.`nama`,' ',`b`.`nama`)) AS `nama_full`,`b`.`kategori_id` AS `kategori_id`,`k`.`nama` AS `kategori`,`k`.`satuan_id` AS `satuan_id`,`s`.`nama` AS `satuan`,`b`.`berat` AS `berat`,(select `harga_jual`.`harga_jual` from `harga_jual` where (`harga_jual`.`barang_id` = `b`.`id`) order by `harga_jual`.`id` desc limit 1) AS `harga_jual_current`,ifnull((select sum(`stok`.`current_stok`) from `stok` where ((`stok`.`current_stok` > 0) and (`stok`.`barang_id` = `b`.`id`))),0) AS `stok`,format((select (sum(`VIEW_STOK`.`total_harga`) / sum(`VIEW_STOK`.`stok_awal`)) AS `hpp` from `VIEW_STOK` where ((`VIEW_STOK`.`current_stok` > 0) and (`VIEW_STOK`.`barang_id` = `b`.`id`))),0) AS `hpp`,(select ceiling((sum(`VIEW_STOK`.`total_harga`) / sum(`VIEW_STOK`.`stok_awal`))) AS `hpp_fix_up` from `VIEW_STOK` where ((`VIEW_STOK`.`current_stok` > 0) and (`VIEW_STOK`.`barang_id` = `b`.`id`))) AS `hpp_fix` from ((`barang` `b` join `kategori` `k` on((`b`.`kategori_id` = `k`.`id`))) join `satuan` `s` on((`k`.`satuan_id` = `s`.`id`))) ;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

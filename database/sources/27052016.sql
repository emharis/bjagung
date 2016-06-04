-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.24 - Source distribution
-- Server OS:                    Linux
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

-- Dumping data for table bajaagung_db.appsetting: ~2 rows (approximately)
DELETE FROM `appsetting`;
/*!40000 ALTER TABLE `appsetting` DISABLE KEYS */;
INSERT INTO `appsetting` (`name`, `value`) VALUES
	('customer_jatuh_tempo', '4'),
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
  `harga_jual_current` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_barang_kategori` (`kategori_id`),
  CONSTRAINT `FK_barang_kategori` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table bajaagung_db.barang: ~50 rows (approximately)
DELETE FROM `barang`;
/*!40000 ALTER TABLE `barang` DISABLE KEYS */;
INSERT INTO `barang` (`id`, `created_at`, `kode`, `nama`, `kategori_id`, `rol`, `berat`, `harga_jual_current`) VALUES
	(14, '2016-05-13 06:48:50', 'ST1', '0,2x30', 33, 10, 45, NULL),
	(15, '2016-05-13 06:51:28', 'ST2', '0,2 x 38', 33, 10, 45, NULL),
	(16, '2016-05-13 06:51:49', 'ST3', '0,2 x 45', 33, 10, 50, NULL),
	(17, '2016-05-13 06:52:20', 'ST4', '0,2 x 50', 33, 10, 48, NULL),
	(18, '2016-05-13 06:52:48', 'ST5', '0,2 x 55', 33, 10, 50, NULL),
	(19, '2016-05-13 06:53:05', 'ST6', '0,2 X 60', 33, 10, 48, NULL),
	(20, '2016-05-13 06:53:24', 'ST7', '0,2 X 72', 33, 10, 50, NULL),
	(21, '2016-05-13 06:54:11', 'ST8A', '0,2 X 76 A', 33, 10, 48, NULL),
	(22, '2016-05-13 06:54:32', 'ST8B', '0,2 X 76 B', 33, 10, 45, NULL),
	(23, '2016-05-13 06:54:56', 'ST10', '0,2 X 88', 33, 10, 45, NULL),
	(24, '2016-05-13 06:55:27', 'ST11', '0,2 X 90', 33, 10, 48, NULL),
	(25, '2016-05-13 06:56:24', 'GL1', '0,3 X 60', 34, 10, 50, NULL),
	(26, '2016-05-13 06:56:43', 'GL2', '0,3 X 90', 34, 10, 50, NULL),
	(27, '2016-05-13 07:29:43', 'KW1', '12', 35, 10, 50, NULL),
	(28, '2016-05-13 07:30:03', 'KW2', '14', 35, 10, 50, NULL),
	(29, '2016-05-13 07:30:18', 'KW3', '16', 35, 10, 50, NULL),
	(30, '2016-05-13 07:30:37', 'KW4', '18', 35, 10, 25, NULL),
	(31, '2016-05-13 07:30:52', 'KW5', '22', 35, 10, 25, NULL),
	(32, '2016-05-13 07:31:49', 'BD1', 'SPaq', 36, 10, 25, NULL),
	(33, '2016-05-13 07:32:02', 'BDHP', 'HP', 36, 10, 25, NULL),
	(34, '2016-05-13 07:32:31', 'BDRRT25', 'RRT 25', 36, 10, 25, 231000),
	(35, '2016-05-13 07:33:14', 'BDRRT20', 'RRT 20', 36, 10, 20, 226800),
	(36, '2016-05-13 07:35:23', 'BDSQ', 'SQ', 36, 10, 25, 220000),
	(37, '2016-05-13 07:35:44', 'SG6', 'X6', 28, 10, 1, NULL),
	(38, '2016-05-13 07:35:55', 'SG7', 'X7', 28, 10, 1, NULL),
	(39, '2016-05-13 07:36:06', 'SG8', 'X8', 28, 10, 1, NULL),
	(40, '2016-05-13 07:36:22', 'SG10', 'X10', 28, 10, 1, NULL),
	(41, '2016-05-13 07:37:14', 'LMRJ', 'RAJAWALI KB', 32, 10, 60, NULL),
	(42, '2016-05-13 07:38:11', 'PKSQ34', 'SQ 3/4', 31, 10, 30, NULL),
	(43, '2016-05-13 07:38:36', 'PKSQ1', 'SQ 1', 31, 10, 30, NULL),
	(44, '2016-05-13 07:38:54', 'PKSQ114', 'SQ 1 1/4"', 31, 10, 30, NULL),
	(45, '2016-05-13 07:39:14', 'PKSQ112', 'SQ 1 1/2', 31, 10, 30, NULL),
	(46, '2016-05-13 07:39:44', 'PKSQ134', 'SQ 1 3/4', 31, 10, 30, NULL),
	(47, '2016-05-13 07:40:11', 'PKSQ2', 'SQ 2', 31, 10, 30, NULL),
	(48, '2016-05-13 07:40:32', 'PKSQ212', 'SQ 2 1/2', 31, 10, 30, NULL),
	(49, '2016-05-13 07:40:53', 'PKPD34', 'PANDA 3/4', 31, 10, 30, NULL),
	(50, '2016-05-13 07:41:06', 'PKPD1', 'PANDA 1', 31, 10, 30, NULL),
	(51, '2016-05-13 07:41:28', 'PKPD114', 'PANDA 1 1/4', 31, 10, 30, NULL),
	(52, '2016-05-13 07:41:43', 'PKPD112', 'PANDA 1 1/2', 31, 10, 30, NULL),
	(53, '2016-05-13 07:41:53', 'PKPD134', 'PANDA 1 3/4', 31, 10, 30, NULL),
	(54, '2016-05-13 07:42:08', 'PKPD2', 'PANDA 2', 31, 10, 30, NULL),
	(55, '2016-05-13 07:42:22', 'PKPD212', 'PANDA 2 1/2', 31, 10, 30, NULL),
	(56, '2016-05-13 07:42:36', 'PKBB34', 'BB 3/4', 31, 10, 30, NULL),
	(57, '2016-05-13 07:42:49', 'PKBB1', 'BB 1', 31, 10, 30, NULL),
	(58, '2016-05-13 07:43:24', 'PKBB114', 'BB 1 1/4', 31, 10, 30, NULL),
	(59, '2016-05-13 07:43:39', 'PKBB112', 'BB 1 1/2', 31, 10, 30, NULL),
	(60, '2016-05-13 07:44:04', 'PKBB134', 'BB 1 3/4', 31, 10, 30, NULL),
	(61, '2016-05-13 07:44:16', 'PKBB2', 'BB 2', 31, 10, 30, NULL),
	(62, '2016-05-13 07:44:28', 'PKBB212', 'BB 2 1/2', 31, 10, 30, NULL),
	(63, '2016-05-13 07:49:33', 'PKSP34', 'SP 3/4', 31, 10, 30, NULL);
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `no_nota` (`no_inv`),
  KEY `FK_beli_supplier` (`supplier_id`),
  CONSTRAINT `FK_beli_supplier` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table bajaagung_db.beli: ~1 rows (approximately)
DELETE FROM `beli`;
/*!40000 ALTER TABLE `beli` DISABLE KEYS */;
INSERT INTO `beli` (`id`, `created_at`, `no_inv`, `tgl`, `supplier_id`, `total`, `disc`, `grand_total`, `tipe`, `status`) VALUES
	(20, '2016-05-26 17:20:40', 'BJ0001', '2016-05-26', 1, 1000000, 0, 1000000, 'K', 'N');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table bajaagung_db.beli_barang: ~1 rows (approximately)
DELETE FROM `beli_barang`;
/*!40000 ALTER TABLE `beli_barang` DISABLE KEYS */;
INSERT INTO `beli_barang` (`id`, `created_at`, `beli_id`, `barang_id`, `qty`, `harga`, `total`) VALUES
	(3, '2016-05-26 17:20:40', 20, 42, 10, 100000, 1000000);
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table bajaagung_db.customer: ~0 rows (approximately)
DELETE FROM `customer`;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;


-- Dumping structure for procedure bajaagung_db.DELETE_PROCESS_BELI
DROP PROCEDURE IF EXISTS `DELETE_PROCESS_BELI`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `DELETE_PROCESS_BELI`()
BEGIN
	delete from hutang;
	delete from stok_moving;
	delete from stok;
	delete from beli_barang;
	delete from beli;
	
END//
DELIMITER ;


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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table bajaagung_db.harga_jual: ~4 rows (approximately)
DELETE FROM `harga_jual`;
/*!40000 ALTER TABLE `harga_jual` DISABLE KEYS */;
INSERT INTO `harga_jual` (`id`, `created_at`, `barang_id`, `harga_beli`, `harga_jual`, `hpp`) VALUES
	(15, '2016-05-19 16:19:44', 36, 217000, 230020, 217000),
	(16, '2016-05-19 16:20:09', 35, 216500, 226800, 216500),
	(17, '2016-05-19 16:21:18', 34, 220000, 231000, 220000),
	(18, '2016-05-19 16:46:06', 36, 217000, 238700, 217000);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table bajaagung_db.hutang: ~1 rows (approximately)
DELETE FROM `hutang`;
/*!40000 ALTER TABLE `hutang` DISABLE KEYS */;
INSERT INTO `hutang` (`id`, `created_at`, `beli_id`, `supplier_id`, `grand_total`, `lunas`, `sisa_bayar`, `sudah_bayar`) VALUES
	(1, '2016-05-26 17:20:40', 20, 1, 1000000, 'N', 1000000, 0);
/*!40000 ALTER TABLE `hutang` ENABLE KEYS */;


-- Dumping structure for table bajaagung_db.hutang_cicil
DROP TABLE IF EXISTS `hutang_cicil`;
CREATE TABLE IF NOT EXISTS `hutang_cicil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `hutang_id` int(11) DEFAULT NULL,
  `bayar` int(11) DEFAULT NULL,
  `sisa` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table bajaagung_db.hutang_cicil: ~0 rows (approximately)
DELETE FROM `hutang_cicil`;
/*!40000 ALTER TABLE `hutang_cicil` DISABLE KEYS */;
/*!40000 ALTER TABLE `hutang_cicil` ENABLE KEYS */;


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
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table bajaagung_db.kategori: ~7 rows (approximately)
DELETE FROM `kategori`;
/*!40000 ALTER TABLE `kategori` DISABLE KEYS */;
INSERT INTO `kategori` (`id`, `created_at`, `nama`, `satuan_id`) VALUES
	(28, '2016-05-12 06:46:07', 'Seng Gelombang', 2),
	(31, '2016-05-12 06:55:40', 'Paku', 1),
	(32, '2016-05-12 07:25:13', 'Lem', 1),
	(33, '2016-05-13 06:39:41', 'Seng Talang', 3),
	(34, '2016-05-13 06:56:04', 'GALVALUM', 5),
	(35, '2016-05-13 07:29:18', 'Kawat', 3),
	(36, '2016-05-13 07:31:19', 'BENDRAT', 3);
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table bajaagung_db.sales: ~2 rows (approximately)
DELETE FROM `sales`;
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
INSERT INTO `sales` (`id`, `created_at`, `kode`, `nama`, `ktp`, `telp`, `telp_2`, `alamat`) VALUES
	(3, '2016-05-11 20:01:18', 'ALI', 'Ali Sutanto', '892378734658', '08987877676', '', 'Sidoarjo'),
	(4, '2016-05-11 20:01:44', 'SUP', 'Supriadi', '89732845678365873', '089989878876', '', 'Porong');
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
	(1, '2016-05-12 06:12:45', 'Dos'),
	(2, '2016-05-12 06:12:48', 'Lembar'),
	(3, '2016-05-12 06:32:58', 'Roll'),
	(5, '2016-05-13 06:40:30', 'Lonjor');
/*!40000 ALTER TABLE `satuan` ENABLE KEYS */;


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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table bajaagung_db.stok: ~1 rows (approximately)
DELETE FROM `stok`;
/*!40000 ALTER TABLE `stok` DISABLE KEYS */;
INSERT INTO `stok` (`id`, `created_at`, `tgl`, `barang_id`, `stok_awal`, `current_stok`, `tipe`, `harga`, `beli_id`) VALUES
	(30, '2016-05-26 17:20:40', '2016-05-26', 42, 10, 10, 'B', 100000, 20);
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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table bajaagung_db.stok_moving: ~1 rows (approximately)
DELETE FROM `stok_moving`;
/*!40000 ALTER TABLE `stok_moving` DISABLE KEYS */;
INSERT INTO `stok_moving` (`id`, `created_at`, `stok_id`, `jumlah`, `tipe`, `jual_id`) VALUES
	(30, '2016-05-26 17:20:40', 30, 10, 'I', NULL);
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
	(1, '2016-05-12 08:15:17', 'PT Baja Steel', 'Alwi', '0899878967896', '08989787678576', 'Surabaya', 2, '1234567890'),
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
	`berat` INT(11) NULL
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
	`disc` INT(11) NULL,
	`supplier` VARCHAR(150) NULL COLLATE 'utf8_unicode_ci'
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
	`harga_jual_current` BIGINT(11) NOT NULL,
	`stok` DECIMAL(32,0) NOT NULL,
	`hpp` DECIMAL(46,4) NULL,
	`hpp_fix` DECIMAL(16,0) NULL
) ENGINE=MyISAM;


-- Dumping structure for view bajaagung_db.VIEW_BARANG
DROP VIEW IF EXISTS `VIEW_BARANG`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `VIEW_BARANG`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `VIEW_BARANG` AS select `b`.`id` AS `id`,`b`.`created_at` AS `created_at`,`b`.`kode` AS `kode`,`b`.`nama` AS `nama`,`b`.`kategori_id` AS `kategori_id`,`k`.`nama` AS `kategori`,`k`.`satuan_id` AS `satuan_id`,`s`.`nama` AS `satuan`,`b`.`berat` AS `berat` from ((`barang` `b` join `kategori` `k` on((`b`.`kategori_id` = `k`.`id`))) join `satuan` `s` on((`k`.`satuan_id` = `s`.`id`)));


-- Dumping structure for view bajaagung_db.VIEW_BELI
DROP VIEW IF EXISTS `VIEW_BELI`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `VIEW_BELI`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `VIEW_BELI` AS select `b`.`id` AS `id`,`b`.`created_at` AS `created_at`,`b`.`no_inv` AS `no_inv`,`b`.`tipe` AS `tipe`,`b`.`tgl` AS `tgl`,date_format(`b`.`tgl`,'%d-%m-%Y') AS `tgl_formatted`,`b`.`supplier_id` AS `supplier_id`,`b`.`total` AS `total`,`b`.`disc` AS `disc`,`s`.`nama` AS `supplier` from (`beli` `b` join `supplier` `s` on((`b`.`supplier_id` = `s`.`id`)));


-- Dumping structure for view bajaagung_db.VIEW_BELI_BARANG
DROP VIEW IF EXISTS `VIEW_BELI_BARANG`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `VIEW_BELI_BARANG`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `VIEW_BELI_BARANG` AS select `bb`.`id` AS `id`,`bb`.`created_at` AS `created_at`,`bb`.`beli_id` AS `beli_id`,`bb`.`barang_id` AS `barang_id`,`b`.`kode` AS `kode`,`s`.`nama` AS `satuan`,`bb`.`qty` AS `qty`,`bb`.`harga` AS `harga`,`bb`.`total` AS `total`,`b`.`nama` AS `barang`,`b`.`kategori_id` AS `kategori_id`,`k`.`nama` AS `kategori`,concat(`k`.`nama`,' ',`b`.`nama`) AS `nama_barang_full` from (((`beli_barang` `bb` join `barang` `b` on((`bb`.`barang_id` = `b`.`id`))) join `kategori` `k` on((`b`.`kategori_id` = `k`.`id`))) join `satuan` `s` on((`k`.`satuan_id` = `s`.`id`)));


-- Dumping structure for view bajaagung_db.VIEW_KATEGORI
DROP VIEW IF EXISTS `VIEW_KATEGORI`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `VIEW_KATEGORI`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `VIEW_KATEGORI` AS select `k`.`id` AS `id`,`k`.`created_at` AS `created_at`,`k`.`nama` AS `nama`,`k`.`satuan_id` AS `satuan_id`,`s`.`nama` AS `satuan`,(select count(`b`.`id`) from `barang` `b` where (`b`.`kategori_id` = `k`.`id`)) AS `ref` from (`kategori` `k` join `satuan` `s` on((`k`.`satuan_id` = `s`.`id`)));


-- Dumping structure for view bajaagung_db.VIEW_PEMBELIAN
DROP VIEW IF EXISTS `VIEW_PEMBELIAN`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `VIEW_PEMBELIAN`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `VIEW_PEMBELIAN` AS select `b`.`id` AS `id`,`b`.`created_at` AS `created_at`,`b`.`no_inv` AS `no_inv`,`b`.`tgl` AS `tgl`,date_format(`b`.`tgl`,'%d-%m-%Y') AS `tgl_formatted`,`b`.`supplier_id` AS `supplier_id`,ifnull(`b`.`total`,0) AS `total`,ifnull(`b`.`disc`,0) AS `disc`,(`b`.`total` - ifnull(`b`.`disc`,0)) AS `grand_total`,`b`.`tipe` AS `tipe`,`b`.`status` AS `status`,`s`.`nama` AS `supplier` from (`beli` `b` join `supplier` `s` on((`b`.`supplier_id` = `s`.`id`)));


-- Dumping structure for view bajaagung_db.VIEW_SATUAN
DROP VIEW IF EXISTS `VIEW_SATUAN`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `VIEW_SATUAN`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `VIEW_SATUAN` AS select `s`.`id` AS `id`,`s`.`created_at` AS `created_at`,`s`.`nama` AS `nama`,(select count(`k`.`id`) from `kategori` `k` where (`k`.`satuan_id` = `s`.`id`)) AS `ref` from `satuan` `s`;


-- Dumping structure for view bajaagung_db.VIEW_STOK
DROP VIEW IF EXISTS `VIEW_STOK`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `VIEW_STOK`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `VIEW_STOK` AS select `stok`.`id` AS `id`,`stok`.`created_at` AS `created_at`,`stok`.`tgl` AS `tgl`,`stok`.`barang_id` AS `barang_id`,`stok`.`stok_awal` AS `stok_awal`,`stok`.`current_stok` AS `current_stok`,`stok`.`tipe` AS `tipe`,`stok`.`harga` AS `harga`,(`stok`.`harga` * `stok`.`stok_awal`) AS `total_harga` from `stok`;


-- Dumping structure for view bajaagung_db.VIEW_STOK_BARANG
DROP VIEW IF EXISTS `VIEW_STOK_BARANG`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `VIEW_STOK_BARANG`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `VIEW_STOK_BARANG` AS select `b`.`id` AS `id`,`b`.`created_at` AS `created_at`,`b`.`kode` AS `kode`,`b`.`nama` AS `nama`,concat(`k`.`nama`,' ',`b`.`nama`) AS `nama_full`,`b`.`kategori_id` AS `kategori_id`,`k`.`nama` AS `kategori`,`k`.`satuan_id` AS `satuan_id`,`s`.`nama` AS `satuan`,`b`.`berat` AS `berat`,ifnull(`b`.`harga_jual_current`,0) AS `harga_jual_current`,ifnull((select sum(`stok`.`current_stok`) from `stok` where ((`stok`.`current_stok` > 0) and (`stok`.`barang_id` = `b`.`id`))),0) AS `stok`,(select (sum(`VIEW_STOK`.`total_harga`) / sum(`VIEW_STOK`.`stok_awal`)) AS `hpp` from `VIEW_STOK` where ((`VIEW_STOK`.`current_stok` > 0) and (`VIEW_STOK`.`barang_id` = `b`.`id`))) AS `hpp`,(select ceiling((sum(`VIEW_STOK`.`total_harga`) / sum(`VIEW_STOK`.`stok_awal`))) AS `hpp_fix_up` from `VIEW_STOK` where ((`VIEW_STOK`.`current_stok` > 0) and (`VIEW_STOK`.`barang_id` = `b`.`id`))) AS `hpp_fix` from ((`barang` `b` join `kategori` `k` on((`b`.`kategori_id` = `k`.`id`))) join `satuan` `s` on((`k`.`satuan_id` = `s`.`id`)));
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

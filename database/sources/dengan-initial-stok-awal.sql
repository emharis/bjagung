--
-- DbNinja v3.2.6 for MySQL
--
-- Dump date: 2016-08-31 09:52:21 (UTC)
-- Server version: 5.6.24
-- Database: bajaagung_db
--

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;

DROP DATABASE IF EXISTS `bajaagung_db`;
CREATE DATABASE `bajaagung_db` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `bajaagung_db`;

--
-- Structure for table: appsetting
--
DROP TABLE IF EXISTS `appsetting`;
CREATE TABLE `appsetting` (
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Structure for table: bank
--
DROP TABLE IF EXISTS `bank`;
CREATE TABLE `bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Structure for table: barang
--
DROP TABLE IF EXISTS `barang`;
CREATE TABLE `barang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `kode` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nama` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kategori_id` int(11) DEFAULT NULL,
  `rol` int(11) DEFAULT NULL COMMENT 'Reorder level',
  `berat` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_barang_kategori` (`kategori_id`),
  CONSTRAINT `FK_barang_kategori` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Structure for table: beli
--
DROP TABLE IF EXISTS `beli`;
CREATE TABLE `beli` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `po_num` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `no_inv` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `jatuh_tempo` date DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `subtotal` int(11) DEFAULT NULL,
  `disc` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `tipe` enum('T','K') COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Tunai / Kredit',
  `status` enum('O','V') COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'O : Open PO, V: Validated',
  `can_edit` enum('Y','N') COLLATE utf8_unicode_ci DEFAULT 'Y',
  `user_id` int(11) DEFAULT NULL,
  `note` mediumtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `no_nota` (`no_inv`),
  UNIQUE KEY `UQ_po_num` (`po_num`),
  KEY `FK_beli_supplier` (`supplier_id`),
  CONSTRAINT `FK_beli_supplier` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Structure for table: beli_barang
--
DROP TABLE IF EXISTS `beli_barang`;
CREATE TABLE `beli_barang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `beli_id` int(11) DEFAULT NULL,
  `barang_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `subtotal` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__beli` (`beli_id`),
  KEY `FK__barang` (`barang_id`),
  CONSTRAINT `FK__barang` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`),
  CONSTRAINT `FK__beli` FOREIGN KEY (`beli_id`) REFERENCES `beli` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Structure for table: customer
--
DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `nama` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nama_kontak` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telp` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telp_2` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alamat` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Structure for table: harga_jual
--
DROP TABLE IF EXISTS `harga_jual`;
CREATE TABLE `harga_jual` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `barang_id` int(11) DEFAULT NULL,
  `harga_beli` int(11) DEFAULT NULL,
  `harga_jual` int(11) DEFAULT NULL,
  `hpp` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Structure for table: hutang
--
DROP TABLE IF EXISTS `hutang`;
CREATE TABLE `hutang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `beli_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `grand_total` int(11) DEFAULT '0',
  `lunas` enum('Y','N') COLLATE utf8_unicode_ci DEFAULT 'N',
  `sisa_bayar` int(11) DEFAULT '0',
  `sudah_bayar` int(11) DEFAULT '0',
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_hutang_supplier` (`supplier_id`),
  KEY `FK_hutang_beli` (`beli_id`),
  CONSTRAINT `FK_hutang_beli` FOREIGN KEY (`beli_id`) REFERENCES `beli` (`id`),
  CONSTRAINT `FK_hutang_supplier` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Structure for table: hutang_cicil
--
DROP TABLE IF EXISTS `hutang_cicil`;
CREATE TABLE `hutang_cicil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `hutang_id` int(11) DEFAULT NULL,
  `bayar` int(11) DEFAULT NULL,
  `sisa` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_hutang_cicil_hutang` (`hutang_id`),
  CONSTRAINT `FK_hutang_cicil_hutang` FOREIGN KEY (`hutang_id`) REFERENCES `hutang` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Structure for table: inventory_adjustment
--
DROP TABLE IF EXISTS `inventory_adjustment`;
CREATE TABLE `inventory_adjustment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `inventory_reference` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `inventory_of` enum('I','S') COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'I=Initial Inventory, S=Stock Opname',
  `product_of` enum('A','S') COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'A=All of products; S=Select Product Manually',
  `barang_id` int(11) DEFAULT NULL,
  `tgl` datetime DEFAULT NULL,
  `status` enum('D','P','V') COLLATE utf8_unicode_ci DEFAULT 'D' COMMENT 'D = Draft, P=In Progress, V=Validated',
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Structure for table: inventory_adjustment_detail
--
DROP TABLE IF EXISTS `inventory_adjustment_detail`;
CREATE TABLE `inventory_adjustment_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) DEFAULT NULL,
  `inventory_adjustment_id` int(11) DEFAULT NULL,
  `barang_id` int(11) DEFAULT NULL,
  `theoretical_qty` int(11) DEFAULT NULL,
  `real_qty` int(11) DEFAULT NULL,
  `cost` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_inventory_adjustment_detaill_inventory_adjustment` (`inventory_adjustment_id`),
  KEY `FK_inventory_adjustment_detaill_barang` (`barang_id`),
  CONSTRAINT `FK_inventory_adjustment_detaill_barang` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`),
  CONSTRAINT `FK_inventory_adjustment_detaill_inventory_adjustment` FOREIGN KEY (`inventory_adjustment_id`) REFERENCES `inventory_adjustment` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=585 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Structure for table: jual
--
DROP TABLE IF EXISTS `jual`;
CREATE TABLE `jual` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `so_no` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `no_inv` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `salesman_id` int(11) DEFAULT NULL,
  `subtotal` int(11) DEFAULT NULL,
  `disc` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `status` enum('O','V') COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'O=Open, V=Validate',
  `can_edit` enum('Y','N') COLLATE utf8_unicode_ci DEFAULT 'Y',
  `note` text COLLATE utf8_unicode_ci,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_jual_customer` (`customer_id`),
  KEY `FK_jual_sales` (`salesman_id`),
  CONSTRAINT `FK_jual_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
  CONSTRAINT `FK_jual_sales` FOREIGN KEY (`salesman_id`) REFERENCES `salesman` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Structure for table: jual_barang
--
DROP TABLE IF EXISTS `jual_barang`;
CREATE TABLE `jual_barang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `jual_id` int(11) DEFAULT NULL,
  `barang_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `harga_satuan` int(11) DEFAULT NULL,
  `harga_salesman` int(11) DEFAULT NULL,
  `subtotal` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_jual_barang_jual` (`jual_id`),
  KEY `FK_jual_barang_barang` (`barang_id`),
  CONSTRAINT `FK_jual_barang_barang` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`),
  CONSTRAINT `FK_jual_barang_jual` FOREIGN KEY (`jual_id`) REFERENCES `jual` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Structure for table: kategori
--
DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `nama` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `satuan_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_kategori_satuan` (`satuan_id`),
  CONSTRAINT `FK_kategori_satuan` FOREIGN KEY (`satuan_id`) REFERENCES `satuan` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Structure for table: permissions
--
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `nama` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Structure for table: piutang
--
DROP TABLE IF EXISTS `piutang`;
CREATE TABLE `piutang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `jual_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT '0',
  `lunas` enum('Y','N') COLLATE utf8_unicode_ci DEFAULT 'N',
  `sisa_bayar` int(11) DEFAULT '0',
  `sudah_bayar` int(11) DEFAULT '0',
  `user_id` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_piutang_customer` (`customer_id`),
  KEY `FK_piutang_jual` (`jual_id`),
  CONSTRAINT `FK_piutang_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
  CONSTRAINT `FK_piutang_jual` FOREIGN KEY (`jual_id`) REFERENCES `jual` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Structure for table: piutang_cicil
--
DROP TABLE IF EXISTS `piutang_cicil`;
CREATE TABLE `piutang_cicil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `piutang_id` int(11) DEFAULT NULL,
  `bayar` int(11) DEFAULT NULL,
  `sisa` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_piutang_cicil_piutang` (`piutang_id`),
  CONSTRAINT `FK_piutang_cicil_piutang` FOREIGN KEY (`piutang_id`) REFERENCES `piutang` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Structure for table: role_permission
--
DROP TABLE IF EXISTS `role_permission`;
CREATE TABLE `role_permission` (
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


--
-- Structure for table: roles
--
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `nama` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Structure for table: salesman
--
DROP TABLE IF EXISTS `salesman`;
CREATE TABLE `salesman` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `kode` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nama` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ktp` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telp` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telp_2` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alamat` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kode` (`kode`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Structure for table: satuan
--
DROP TABLE IF EXISTS `satuan`;
CREATE TABLE `satuan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `nama` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Structure for table: stok
--
DROP TABLE IF EXISTS `stok`;
CREATE TABLE `stok` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tgl` date NOT NULL,
  `barang_id` int(11) NOT NULL DEFAULT '0',
  `stok_awal` int(11) NOT NULL DEFAULT '0',
  `current_stok` int(11) NOT NULL DEFAULT '0',
  `tipe` enum('M','B') COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'M: Manual, B: Beli/Pembelian',
  `harga` int(11) DEFAULT NULL,
  `beli_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_stok_barang` (`barang_id`),
  CONSTRAINT `FK_stok_barang` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Structure for table: stok_moving
--
DROP TABLE IF EXISTS `stok_moving`;
CREATE TABLE `stok_moving` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `stok_id` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `tipe` enum('I','O') COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'I=Int, O=Out',
  `jual_id` int(11) DEFAULT NULL COMMENT 'penjualan id, ketika barang keluar',
  `inventory_adjustment_detail_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_stok_moving_stok` (`stok_id`),
  CONSTRAINT `FK_stok_moving_stok` FOREIGN KEY (`stok_id`) REFERENCES `stok` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Structure for table: supplier
--
DROP TABLE IF EXISTS `supplier`;
CREATE TABLE `supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `nama` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nama_kontak` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telp` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telp_2` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alamat` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `jatuh_tempo` int(11) DEFAULT NULL COMMENT 'dalam satuan minggu',
  `rek` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Structure for table: supplier_bill
--
DROP TABLE IF EXISTS `supplier_bill`;
CREATE TABLE `supplier_bill` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `bill_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `beli_id` int(11) DEFAULT NULL,
  `bill_no` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('O','P') COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'O=Open, P=Paid',
  `subtotal` int(11) DEFAULT NULL,
  `disc` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `amount_due` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Structure for table: supplier_bill_payment
--
DROP TABLE IF EXISTS `supplier_bill_payment`;
CREATE TABLE `supplier_bill_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `tanggal` date DEFAULT NULL,
  `supplier_bill_id` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fkey_hngdsilund` (`supplier_bill_id`),
  CONSTRAINT `fkey_hngdsilund` FOREIGN KEY (`supplier_bill_id`) REFERENCES `supplier_bill` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Structure for table: user_role
--
DROP TABLE IF EXISTS `user_role`;
CREATE TABLE `user_role` (
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Structure for table: users
--
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Structure for view: VIEW_BARANG
--
DROP VIEW IF EXISTS `VIEW_BARANG`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `bajaagung_db`.`VIEW_BARANG` AS select `b`.`id` AS `id`,`b`.`created_at` AS `created_at`,concat('[',`b`.`kode`,'] ',`k`.`nama`,' ',`b`.`nama`) AS `nama_full`,`b`.`kode` AS `kode`,`b`.`nama` AS `nama`,`b`.`kategori_id` AS `kategori_id`,`k`.`nama` AS `kategori`,`k`.`satuan_id` AS `satuan_id`,`s`.`nama` AS `satuan`,`b`.`berat` AS `berat`,`b`.`rol` AS `rol`,(select `bajaagung_db`.`harga_jual`.`harga_jual` from `bajaagung_db`.`harga_jual` where (`bajaagung_db`.`harga_jual`.`barang_id` = `b`.`id`) order by `bajaagung_db`.`harga_jual`.`id` desc limit 1) AS `harga_jual`,(select (case when (count(0) > 0) then 0 else 1 end) from `bajaagung_db`.`stok` where (`bajaagung_db`.`stok`.`barang_id` = `b`.`id`)) AS `can_delete` from ((`bajaagung_db`.`barang` `b` join `bajaagung_db`.`kategori` `k` on((`b`.`kategori_id` = `k`.`id`))) join `bajaagung_db`.`satuan` `s` on((`k`.`satuan_id` = `s`.`id`)));


--
-- Structure for view: VIEW_BELI
--
DROP VIEW IF EXISTS `VIEW_BELI`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `bajaagung_db`.`VIEW_BELI` AS select `b`.`id` AS `id`,`b`.`created_at` AS `created_at`,`b`.`po_num` AS `po_num`,`b`.`no_inv` AS `no_inv`,`b`.`tipe` AS `tipe`,`b`.`tgl` AS `tgl`,`b`.`jatuh_tempo` AS `jatuh_tempo`,date_format(`b`.`tgl`,'%d-%m-%Y') AS `tgl_formatted`,date_format(`b`.`jatuh_tempo`,'%d-%m-%Y') AS `jatuh_tempo_formatted`,`b`.`supplier_id` AS `supplier_id`,`b`.`subtotal` AS `total`,`b`.`total` AS `grand_total`,`b`.`disc` AS `disc`,`s`.`nama` AS `supplier`,`b`.`can_edit` AS `can_edit`,`b`.`status` AS `status`,`b`.`note` AS `note` from (`bajaagung_db`.`beli` `b` join `bajaagung_db`.`supplier` `s` on((`b`.`supplier_id` = `s`.`id`)));


--
-- Structure for view: VIEW_BELI_BARANG
--
DROP VIEW IF EXISTS `VIEW_BELI_BARANG`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `bajaagung_db`.`VIEW_BELI_BARANG` AS select `bb`.`id` AS `id`,`vb`.`po_num` AS `po_num`,`vb`.`no_inv` AS `no_inv`,`bb`.`created_at` AS `created_at`,date_format(`bb`.`created_at`,'%d-%m-%Y') AS `tgl_formatted`,`bb`.`beli_id` AS `beli_id`,`bb`.`barang_id` AS `barang_id`,`b`.`kode` AS `kode`,`s`.`nama` AS `satuan`,`bb`.`qty` AS `qty`,`bb`.`harga` AS `harga`,`bb`.`subtotal` AS `subtotal`,`b`.`nama` AS `barang`,`b`.`kategori_id` AS `kategori_id`,`k`.`nama` AS `kategori`,concat('[',`b`.`kode`,'] ',`k`.`nama`,' ',`b`.`nama`) AS `nama_barang_full`,`vb`.`supplier_id` AS `supplier_id`,`vb`.`supplier` AS `supplier` from ((((`bajaagung_db`.`beli_barang` `bb` join `bajaagung_db`.`barang` `b` on((`bb`.`barang_id` = `b`.`id`))) join `bajaagung_db`.`kategori` `k` on((`b`.`kategori_id` = `k`.`id`))) join `bajaagung_db`.`satuan` `s` on((`k`.`satuan_id` = `s`.`id`))) join `bajaagung_db`.`VIEW_BELI` `vb` on((`bb`.`beli_id` = `vb`.`id`)));


--
-- Structure for view: VIEW_CUSTOMER
--
DROP VIEW IF EXISTS `VIEW_CUSTOMER`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `bajaagung_db`.`VIEW_CUSTOMER` AS select `bajaagung_db`.`customer`.`id` AS `id`,`bajaagung_db`.`customer`.`note` AS `note`,`bajaagung_db`.`customer`.`created_at` AS `created_at`,`bajaagung_db`.`customer`.`nama` AS `nama`,`bajaagung_db`.`customer`.`nama_kontak` AS `nama_kontak`,`bajaagung_db`.`customer`.`telp` AS `telp`,`bajaagung_db`.`customer`.`telp_2` AS `telp_2`,`bajaagung_db`.`customer`.`alamat` AS `alamat`,(select count(0) from `bajaagung_db`.`jual` where (`bajaagung_db`.`jual`.`customer_id` = `bajaagung_db`.`customer`.`id`)) AS `ref` from `bajaagung_db`.`customer`;


--
-- Structure for view: VIEW_JUAL
--
DROP VIEW IF EXISTS `VIEW_JUAL`;
;


--
-- Structure for view: VIEW_JUAL_BARANG
--
DROP VIEW IF EXISTS `VIEW_JUAL_BARANG`;
;


--
-- Structure for view: VIEW_KATEGORI
--
DROP VIEW IF EXISTS `VIEW_KATEGORI`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `bajaagung_db`.`VIEW_KATEGORI` AS select `k`.`id` AS `id`,`k`.`created_at` AS `created_at`,`k`.`nama` AS `nama`,`k`.`satuan_id` AS `satuan_id`,`s`.`nama` AS `satuan`,(select count(`b`.`id`) from `bajaagung_db`.`barang` `b` where (`b`.`kategori_id` = `k`.`id`)) AS `ref`,(select (case when (count(0) > 0) then 0 else 1 end) from `bajaagung_db`.`barang` where (`bajaagung_db`.`barang`.`kategori_id` = `k`.`id`)) AS `can_delete` from (`bajaagung_db`.`kategori` `k` join `bajaagung_db`.`satuan` `s` on((`k`.`satuan_id` = `s`.`id`)));


--
-- Structure for view: VIEW_PEMBELIAN
--
DROP VIEW IF EXISTS `VIEW_PEMBELIAN`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `bajaagung_db`.`VIEW_PEMBELIAN` AS select `b`.`id` AS `id`,`b`.`created_at` AS `created_at`,`b`.`can_edit` AS `can_edit`,`b`.`no_inv` AS `no_inv`,`b`.`tgl` AS `tgl`,date_format(`b`.`tgl`,'%d-%m-%Y') AS `tgl_formatted`,`b`.`supplier_id` AS `supplier_id`,ifnull(`b`.`total`,0) AS `total`,ifnull(`b`.`disc`,0) AS `disc`,(`b`.`total` - ifnull(`b`.`disc`,0)) AS `grand_total`,`b`.`tipe` AS `tipe`,`b`.`status` AS `status`,`s`.`nama` AS `supplier` from (`bajaagung_db`.`beli` `b` join `bajaagung_db`.`supplier` `s` on((`b`.`supplier_id` = `s`.`id`)));


--
-- Structure for view: VIEW_PENJUALAN
--
DROP VIEW IF EXISTS `VIEW_PENJUALAN`;
;


--
-- Structure for view: VIEW_SALESMAN
--
DROP VIEW IF EXISTS `VIEW_SALESMAN`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `bajaagung_db`.`VIEW_SALESMAN` AS select `bajaagung_db`.`salesman`.`id` AS `id`,`bajaagung_db`.`salesman`.`created_at` AS `created_at`,`bajaagung_db`.`salesman`.`kode` AS `kode`,`bajaagung_db`.`salesman`.`nama` AS `nama`,`bajaagung_db`.`salesman`.`ktp` AS `ktp`,`bajaagung_db`.`salesman`.`telp` AS `telp`,`bajaagung_db`.`salesman`.`telp_2` AS `telp_2`,`bajaagung_db`.`salesman`.`alamat` AS `alamat`,`bajaagung_db`.`salesman`.`user_id` AS `user_id`,(select count(0) from `bajaagung_db`.`jual` where (`bajaagung_db`.`jual`.`salesman_id` = `bajaagung_db`.`salesman`.`id`)) AS `ref` from `bajaagung_db`.`salesman`;


--
-- Structure for view: VIEW_SALES_ORDER
--
DROP VIEW IF EXISTS `VIEW_SALES_ORDER`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `bajaagung_db`.`VIEW_SALES_ORDER` AS select `j`.`id` AS `id`,`j`.`created_at` AS `created_at`,`j`.`so_no` AS `so_no`,`j`.`no_inv` AS `no_inv`,`j`.`tgl` AS `tgl`,date_format(`j`.`tgl`,'%d-%m-%Y') AS `tgl_formatted`,`j`.`customer_id` AS `customer_id`,`c`.`nama` AS `customer`,`j`.`salesman_id` AS `salesman_id`,`s`.`nama` AS `salesman`,concat('[',`s`.`kode`,'] - ',`s`.`nama`) AS `nama_salesman_full`,`j`.`subtotal` AS `subtotal`,`j`.`disc` AS `disc`,`j`.`total` AS `total`,`j`.`status` AS `status`,`j`.`can_edit` AS `can_edit`,`j`.`note` AS `note` from ((`bajaagung_db`.`jual` `j` join `bajaagung_db`.`customer` `c` on((`j`.`customer_id` = `c`.`id`))) join `bajaagung_db`.`salesman` `s` on((`j`.`salesman_id` = `s`.`id`)));


--
-- Structure for view: VIEW_SALES_ORDER_PRODUCTS
--
DROP VIEW IF EXISTS `VIEW_SALES_ORDER_PRODUCTS`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `bajaagung_db`.`VIEW_SALES_ORDER_PRODUCTS` AS select `jb`.`id` AS `id`,`jb`.`created_at` AS `created_at`,`jb`.`jual_id` AS `jual_id`,`jb`.`barang_id` AS `barang_id`,`k`.`nama` AS `kategori`,`s`.`nama` AS `satuan`,`b`.`kode` AS `kode`,`b`.`nama` AS `barang`,concat('[',`b`.`kode`,'] ',`k`.`nama`,' ',`b`.`nama`) AS `nama_full`,`jb`.`qty` AS `qty`,`jb`.`harga_satuan` AS `harga_satuan`,`jb`.`harga_salesman` AS `harga_salesman`,`jb`.`subtotal` AS `subtotal`,(select `VIEW_STOK_BARANG`.`stok` from `bajaagung_db`.`VIEW_STOK_BARANG` where (`VIEW_STOK_BARANG`.`id` = `jb`.`barang_id`)) AS `stok_on_db` from (((`bajaagung_db`.`jual_barang` `jb` join `bajaagung_db`.`barang` `b` on((`jb`.`barang_id` = `b`.`id`))) join `bajaagung_db`.`kategori` `k` on((`b`.`kategori_id` = `k`.`id`))) join `bajaagung_db`.`satuan` `s` on((`k`.`satuan_id` = `s`.`id`)));


--
-- Structure for view: VIEW_SATUAN
--
DROP VIEW IF EXISTS `VIEW_SATUAN`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `bajaagung_db`.`VIEW_SATUAN` AS select `s`.`id` AS `id`,`s`.`created_at` AS `created_at`,`s`.`nama` AS `nama`,(select count(`k`.`id`) from `bajaagung_db`.`kategori` `k` where (`k`.`satuan_id` = `s`.`id`)) AS `ref` from `bajaagung_db`.`satuan` `s`;


--
-- Structure for view: VIEW_STOK
--
DROP VIEW IF EXISTS `VIEW_STOK`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `bajaagung_db`.`VIEW_STOK` AS select `bajaagung_db`.`stok`.`id` AS `id`,`bajaagung_db`.`stok`.`created_at` AS `created_at`,`bajaagung_db`.`stok`.`tgl` AS `tgl`,`bajaagung_db`.`stok`.`barang_id` AS `barang_id`,`bajaagung_db`.`stok`.`stok_awal` AS `stok_awal`,`bajaagung_db`.`stok`.`current_stok` AS `current_stok`,`bajaagung_db`.`stok`.`tipe` AS `tipe`,`bajaagung_db`.`stok`.`harga` AS `harga`,(`bajaagung_db`.`stok`.`harga` * `bajaagung_db`.`stok`.`stok_awal`) AS `total_harga` from `bajaagung_db`.`stok`;


--
-- Structure for view: VIEW_STOK_BARANG
--
DROP VIEW IF EXISTS `VIEW_STOK_BARANG`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `bajaagung_db`.`VIEW_STOK_BARANG` AS select `b`.`id` AS `id`,`b`.`created_at` AS `created_at`,`b`.`kode` AS `kode`,ucase(`b`.`nama`) AS `nama`,ucase(concat('[',`b`.`kode`,'] ',`k`.`nama`,' ',`b`.`nama`)) AS `nama_full`,`b`.`kategori_id` AS `kategori_id`,`k`.`nama` AS `kategori`,`k`.`satuan_id` AS `satuan_id`,`s`.`nama` AS `satuan`,`b`.`berat` AS `berat`,`b`.`rol` AS `rol`,(select `bajaagung_db`.`harga_jual`.`harga_jual` from `bajaagung_db`.`harga_jual` where (`bajaagung_db`.`harga_jual`.`barang_id` = `b`.`id`) order by `bajaagung_db`.`harga_jual`.`id` desc limit 1) AS `harga_jual`,ifnull((select sum(`bajaagung_db`.`stok`.`current_stok`) from `bajaagung_db`.`stok` where ((`bajaagung_db`.`stok`.`current_stok` > 0) and (`bajaagung_db`.`stok`.`barang_id` = `b`.`id`))),0) AS `stok`,format((select (sum(`VIEW_STOK`.`total_harga`) / sum(`VIEW_STOK`.`stok_awal`)) AS `hpp` from `bajaagung_db`.`VIEW_STOK` where ((`VIEW_STOK`.`current_stok` > 0) and (`VIEW_STOK`.`barang_id` = `b`.`id`))),0) AS `hpp`,(select ceiling((sum(`VIEW_STOK`.`total_harga`) / sum(`VIEW_STOK`.`stok_awal`))) AS `hpp_fix_up` from `bajaagung_db`.`VIEW_STOK` where ((`VIEW_STOK`.`current_stok` > 0) and (`VIEW_STOK`.`barang_id` = `b`.`id`))) AS `hpp_fix`,(select (case when (count(0) > 0) then 0 else 1 end) from `bajaagung_db`.`stok` where (`bajaagung_db`.`stok`.`barang_id` = `b`.`id`)) AS `can_delete` from ((`bajaagung_db`.`barang` `b` join `bajaagung_db`.`kategori` `k` on((`b`.`kategori_id` = `k`.`id`))) join `bajaagung_db`.`satuan` `s` on((`k`.`satuan_id` = `s`.`id`)));


--
-- Structure for view: VIEW_SUPPLIER
--
DROP VIEW IF EXISTS `VIEW_SUPPLIER`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `bajaagung_db`.`VIEW_SUPPLIER` AS select `bajaagung_db`.`supplier`.`id` AS `id`,`bajaagung_db`.`supplier`.`created_at` AS `created_at`,`bajaagung_db`.`supplier`.`nama` AS `nama`,`bajaagung_db`.`supplier`.`nama_kontak` AS `nama_kontak`,`bajaagung_db`.`supplier`.`telp` AS `telp`,`bajaagung_db`.`supplier`.`telp_2` AS `telp_2`,`bajaagung_db`.`supplier`.`alamat` AS `alamat`,`bajaagung_db`.`supplier`.`jatuh_tempo` AS `jatuh_tempo`,`bajaagung_db`.`supplier`.`rek` AS `rek`,`bajaagung_db`.`supplier`.`note` AS `note`,(select count(0) from `bajaagung_db`.`beli` where (`bajaagung_db`.`beli`.`supplier_id` = `bajaagung_db`.`supplier`.`id`)) AS `ref` from `bajaagung_db`.`supplier`;


--
-- Structure for procedure: SP_CLEAR_ALL_TRANS
--
DROP PROCEDURE IF EXISTS `SP_CLEAR_ALL_TRANS`;
DELIMITER $$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_CLEAR_ALL_TRANS`()
BEGIN
	delete from hutang_cicil;
	delete from hutang;
	delete from stok_moving;
	delete from stok;
	delete from beli_barang;
	delete from beli;
	#update current harga ke null
	
END$$

DELIMITER ;


--
-- Structure for procedure: SP_DELETE_PROCCESS_JUAL
--
DROP PROCEDURE IF EXISTS `SP_DELETE_PROCCESS_JUAL`;
DELIMITER $$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DELETE_PROCCESS_JUAL`()
BEGIN
delete from jual_barang;
delete from jual;

END$$

DELIMITER ;


--
-- Structure for procedure: SP_DELETE_PROCESS_BELI
--
DROP PROCEDURE IF EXISTS `SP_DELETE_PROCESS_BELI`;
DELIMITER $$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DELETE_PROCESS_BELI`()
BEGIN
	delete from hutang;
	delete from stok_moving;
	delete from stok;
	delete from beli_barang;
	delete from beli;
END$$

DELIMITER ;


--
-- Data for table: appsetting
--
LOCK TABLES `appsetting` WRITE;
ALTER TABLE `appsetting` DISABLE KEYS;

INSERT INTO `appsetting` (`name`,`value`) VALUES ('customer_jatuh_tempo','4'),('penjualan_counter','1'),('po_counter','17'),('sidebar_collapse','1'),('so_counter','9'),('supplier_bill_counter','5');

ALTER TABLE `appsetting` ENABLE KEYS;
UNLOCK TABLES;
COMMIT;

--
-- Data for table: bank
--
LOCK TABLES `bank` WRITE;
ALTER TABLE `bank` DISABLE KEYS;

INSERT INTO `bank` (`id`,`nama`) VALUES (1,'BCA'),(2,'MANDIRI'),(3,'BRI'),(4,'BRI SYARIAH'),(5,'BANK SYARIAH MANDIRI'),(6,'MUAMALAT'),(7,'BCA SYARIAH'),(8,'BANK JATIM'),(9,'CIMB NIAGA'),(10,'BNI'),(11,'BTN'),(12,'BUKOPIN'),(13,'DANAMON'),(14,'BANK MASPION'),(15,'BTPN'),(16,'BANK MEGA'),(17,'BANK MEGA SYARIAH'),(18,'BNI SYARIAH'),(19,'PANIN BANK'),(20,'PERMATA BANK'),(21,'BII MAYBANK'),(22,'HSBC'),(23,'CITIBANK');

ALTER TABLE `bank` ENABLE KEYS;
UNLOCK TABLES;
COMMIT;

--
-- Data for table: barang
--
LOCK TABLES `barang` WRITE;
ALTER TABLE `barang` DISABLE KEYS;

INSERT INTO `barang` (`id`,`created_at`,`kode`,`nama`,`kategori_id`,`rol`,`berat`,`user_id`) VALUES (14,'2016-05-13 06:48:50','ST1','0,2x30',33,10,45,NULL),(15,'2016-05-13 06:51:28','ST2','0,2 x 38',33,10,45,NULL),(16,'2016-05-13 06:51:49','ST3','0,2 x 45',33,10,50,NULL),(17,'2016-05-13 06:52:20','ST4','0,2 x 50',33,10,48,NULL),(18,'2016-05-13 06:52:48','ST5','0,2 x 55',33,10,50,NULL),(19,'2016-05-13 06:53:05','ST6','0,2 X 60',33,10,48,NULL),(20,'2016-05-13 06:53:24','ST7','0,2 X 72',33,10,50,NULL),(21,'2016-05-13 06:54:11','ST8-48','0,2 X 76 - 48',33,10,48,NULL),(22,'2016-05-13 06:54:32','ST8-45','0,2 X 76 - 45',33,10,45,NULL),(23,'2016-05-13 06:54:56','ST10','0,2 X 88',33,11,45,NULL),(24,'2016-05-13 06:55:27','ST11','0,2 X 90',33,10,48,NULL),(25,'2016-05-13 06:56:24','GL1','0,3 X 60',34,10,50,NULL),(26,'2016-05-13 06:56:43','GL2','0,3 X 90',34,10,50,NULL),(27,'2016-05-13 07:29:43','KW1','12',35,10,50,NULL),(28,'2016-05-13 07:30:03','KW2','14',35,10,50,NULL),(29,'2016-05-13 07:30:18','KW3','16',35,10,50,NULL),(30,'2016-05-13 07:30:37','KW4','18',35,10,25,NULL),(31,'2016-05-13 07:30:52','KW5','22',35,10,25,NULL),(32,'2016-05-13 07:31:49','BD1','SPaq',36,10,25,NULL),(33,'2016-05-13 07:32:02','BDHP','HP',36,10,25,NULL),(34,'2016-05-13 07:32:31','BDRRT25','RRT 25',36,10,25,NULL),(35,'2016-05-13 07:33:14','BDRRT20','RRT 20',36,10,20,NULL),(36,'2016-05-13 07:35:23','BDSQ','SQ',36,10,25,NULL),(37,'2016-05-13 07:35:44','SG6','X6',28,10,1,NULL),(38,'2016-05-13 07:35:55','SG7','X7',28,10,1,NULL),(39,'2016-05-13 07:36:06','SG8','X8',28,10,1,NULL),(40,'2016-05-13 07:36:22','SG10','X10',28,10,1,NULL),(41,'2016-05-13 07:37:14','LMRJ','RAJAWALI KB',32,10,60,NULL),(42,'2016-05-13 07:38:11','PKSQ34','SQ 3/4',31,10,30,NULL),(43,'2016-05-13 07:38:36','PKSQ1','SQ 1',31,10,30,NULL),(44,'2016-05-13 07:38:54','PKSQ114','SQ 1 1/4\"',31,10,30,NULL),(45,'2016-05-13 07:39:14','PKSQ112','SQ 1 1/2',31,10,30,NULL),(46,'2016-05-13 07:39:44','PKSQ134','SQ 1 3/4',31,10,30,NULL),(47,'2016-05-13 07:40:11','PKSQ2','SQ 2',31,10,30,NULL),(48,'2016-05-13 07:40:32','PKSQ212','SQ 2 1/2',31,10,30,NULL),(49,'2016-05-13 07:40:53','PKPD34','PANDA 3/4',31,10,30,NULL),(50,'2016-05-13 07:41:06','PKPD1','PANDA 1',31,10,30,NULL),(51,'2016-05-13 07:41:28','PKPD114','PANDA 1 1/4',31,10,30,NULL),(52,'2016-05-13 07:41:43','PKPD112','PANDA 1 1/2',31,10,30,NULL),(53,'2016-05-13 07:41:53','PKPD134','PANDA 1 3/4',31,10,30,NULL),(54,'2016-05-13 07:42:08','PKPD2','PANDA 2',31,10,30,NULL),(55,'2016-05-13 07:42:22','PKPD212','PANDA 2 1/2',31,10,30,NULL),(56,'2016-05-13 07:42:36','PKBB34','BB 3/4',31,10,30,NULL),(57,'2016-05-13 07:42:49','PKBB1','BB 1',31,10,30,NULL),(58,'2016-05-13 07:43:24','PKBB114','BB 1 1/4',31,10,30,NULL),(59,'2016-05-13 07:43:39','PKBB112','BB 1 1/2',31,10,30,NULL),(60,'2016-05-13 07:44:04','PKBB134','BB 1 3/4',31,10,30,NULL),(61,'2016-05-13 07:44:16','PKBB2','BB 2',31,10,30,NULL),(62,'2016-05-13 07:44:28','PKBB212','BB 2 1/2',31,10,30,NULL),(63,'2016-05-13 07:49:33','PKSP34','SP 3/4\"',31,10,30,NULL),(64,'2016-06-05 05:57:09','PKKLB','KALSIBOT',31,10,1,NULL),(65,'2016-06-05 06:08:21','KRBMDQ','MDQ',37,10,25,NULL),(66,'2016-06-05 06:09:16','PKPYSQ','PAYUNG SQ',31,10,15,NULL),(67,'2016-06-05 06:09:31','PKPYRRT','PAYUNG RRT',31,1,48,NULL),(68,'2016-06-05 06:10:07','KWLKT114','LOKET 1 1/4',35,1,1,NULL),(70,'2016-06-05 06:20:50','PKSP112','SP 1 1/2\"',31,1,30,NULL),(71,'2016-06-05 06:21:13','PKSP134','SP 1 3/4\"',31,1,30,NULL),(72,'2016-06-05 06:22:04','PKSP2','SP 2\"',31,1,30,NULL),(73,'2016-06-05 06:22:24','PKSP212+','SP 2 1/2+\"',31,1,30,NULL),(74,'2016-06-05 06:22:49','PKKG1','KING 1',31,1,30,NULL),(75,'2016-06-05 06:23:05','PKKG114','KING 1 1/4\"',31,1,30,NULL),(76,'2016-06-05 06:23:24','PKKG112','KING 1 1/2\"',31,1,30,NULL),(77,'2016-06-05 06:23:48','PKKG134','KING 1 3/4\"',31,1,30,NULL),(78,'2016-06-05 06:24:00','PKKG2','KING 2\"',31,1,30,NULL),(79,'2016-06-05 06:24:23','PKKG212+','KING 2 1/2+\"',31,1,30,NULL),(80,'2016-06-05 06:24:58','PKPAQ58','PAQ 5/8',31,1,10,NULL),(81,'2016-06-05 06:25:19','PK984','98+ 4\"',31,1,30,NULL),(82,'2016-06-05 06:25:38','PKARC','ARCHO M',31,1,1,NULL);

ALTER TABLE `barang` ENABLE KEYS;
UNLOCK TABLES;
COMMIT;

--
-- Data for table: beli
--
LOCK TABLES `beli` WRITE;
ALTER TABLE `beli` DISABLE KEYS;

-- Table contains no data

ALTER TABLE `beli` ENABLE KEYS;
UNLOCK TABLES;
COMMIT;

--
-- Data for table: beli_barang
--
LOCK TABLES `beli_barang` WRITE;
ALTER TABLE `beli_barang` DISABLE KEYS;

-- Table contains no data

ALTER TABLE `beli_barang` ENABLE KEYS;
UNLOCK TABLES;
COMMIT;

--
-- Data for table: customer
--
LOCK TABLES `customer` WRITE;
ALTER TABLE `customer` DISABLE KEYS;

INSERT INTO `customer` (`id`,`created_at`,`nama`,`nama_kontak`,`telp`,`telp_2`,`alamat`,`note`,`user_id`) VALUES (1,'2016-06-03 14:48:01','UD SINAR MULYA','HABIBI','08567546757',NULL,'TANGGULANGIN, SIDOARJO',NULL,NULL),(2,'2016-06-19 07:30:02','TOKO SETYA AGUNG','AGUNG','( 031 ) 8054545','','Kompl Ruko Tmn Jenggala B/5 Sidoarjo',NULL,NULL),(3,'2016-06-19 07:30:41','SUMBER JADI','BUDI','( 031 ) 8946315','','Jl Tanggulangin Sidoarjo',NULL,NULL),(4,'2016-06-19 07:30:59','UD TELOGO ARTO','ARI','( 031 ) 8922613','','Kompl Pd Sidokare Asri Bl AJ/12 Sidoarjo',NULL,NULL),(5,'2016-06-19 07:31:27','WARGA BUMI ASRI','ASRI','( 031 ) 8940183','','Jl Ngampelsari 15 Sidoarjo',NULL,NULL),(6,'2016-06-19 07:31:50','UD WARINGIN','H. IMAM','( 031 ) 8951356','','Ds Putat RT 01/01 Sidoarjo',NULL,NULL),(7,'2016-06-19 07:32:16','ABADI GENTENG JATIWANGI','H. IKHSAN','( 031 ) 8962921','','Jl Raya Buduran 27 Sidoarjo',NULL,NULL),(8,'2016-06-19 07:32:35','UD AGUNG MAKMUR','AGUNG','( 031 ) 8925447','','Jl Urang Agung RT 010/04 Sidoarjo',NULL,NULL),(9,'2016-06-19 07:35:43','UD BAROKAH','HJ. UMI NUNIK','( 031 ) 8949227','','Jl Kali Tgh Slt RT 002/03 Sidoarjo','',NULL);

ALTER TABLE `customer` ENABLE KEYS;
UNLOCK TABLES;
COMMIT;

--
-- Data for table: harga_jual
--
LOCK TABLES `harga_jual` WRITE;
ALTER TABLE `harga_jual` DISABLE KEYS;

INSERT INTO `harga_jual` (`id`,`created_at`,`barang_id`,`harga_beli`,`harga_jual`,`hpp`,`user_id`) VALUES (1,'2016-08-30 22:23:39',43,NULL,39500,38,1),(2,'2016-08-30 22:25:34',42,NULL,35500,34,1);

ALTER TABLE `harga_jual` ENABLE KEYS;
UNLOCK TABLES;
COMMIT;

--
-- Data for table: hutang
--
LOCK TABLES `hutang` WRITE;
ALTER TABLE `hutang` DISABLE KEYS;

-- Table contains no data

ALTER TABLE `hutang` ENABLE KEYS;
UNLOCK TABLES;
COMMIT;

--
-- Data for table: hutang_cicil
--
LOCK TABLES `hutang_cicil` WRITE;
ALTER TABLE `hutang_cicil` DISABLE KEYS;

-- Table contains no data

ALTER TABLE `hutang_cicil` ENABLE KEYS;
UNLOCK TABLES;
COMMIT;

--
-- Data for table: inventory_adjustment
--
LOCK TABLES `inventory_adjustment` WRITE;
ALTER TABLE `inventory_adjustment` DISABLE KEYS;

INSERT INTO `inventory_adjustment` (`id`,`created_at`,`inventory_reference`,`inventory_of`,`product_of`,`barang_id`,`tgl`,`status`,`user_id`) VALUES (1,'2016-08-31 15:59:20','STOK AWAL','I',NULL,0,'2016-08-31 15:59:20','V',1);

ALTER TABLE `inventory_adjustment` ENABLE KEYS;
UNLOCK TABLES;
COMMIT;

--
-- Data for table: inventory_adjustment_detail
--
LOCK TABLES `inventory_adjustment_detail` WRITE;
ALTER TABLE `inventory_adjustment_detail` DISABLE KEYS;

INSERT INTO `inventory_adjustment_detail` (`id`,`created_at`,`user_id`,`inventory_adjustment_id`,`barang_id`,`theoretical_qty`,`real_qty`,`cost`) VALUES (516,'2016-08-31 16:43:58',1,1,82,0,35,420000),(517,'2016-08-31 16:43:58',1,1,42,0,1,10300),(518,'2016-08-31 16:43:58',1,1,43,0,3,10200),(519,'2016-08-31 16:43:58',1,1,44,0,1,10000),(520,'2016-08-31 16:43:58',1,1,45,0,1,9550),(521,'2016-08-31 16:43:58',1,1,46,0,12,9200),(522,'2016-08-31 16:43:58',1,1,47,0,5,8550),(523,'2016-08-31 16:43:58',1,1,48,0,40,8450),(524,'2016-08-31 16:43:58',1,1,49,0,1,10100),(525,'2016-08-31 16:43:58',1,1,50,0,1,10000),(526,'2016-08-31 16:43:58',1,1,51,0,6,9800),(527,'2016-08-31 16:43:58',1,1,52,0,7,9350),(528,'2016-08-31 16:43:58',1,1,53,0,12,8800),(529,'2016-08-31 16:43:58',1,1,54,0,29,8350),(530,'2016-08-31 16:43:58',1,1,55,0,82,8250),(531,'2016-08-31 16:43:58',1,1,56,0,2,10700),(532,'2016-08-31 16:43:58',1,1,57,0,1,9800),(533,'2016-08-31 16:43:58',1,1,58,0,1,9500),(534,'2016-08-31 16:43:58',1,1,59,0,3,9300),(535,'2016-08-31 16:43:58',1,1,60,0,4,8800),(536,'2016-08-31 16:43:58',1,1,61,0,5,8100),(537,'2016-08-31 16:43:58',1,1,62,0,38,7900),(538,'2016-08-31 16:43:58',1,1,63,0,1,7400),(539,'2016-08-31 16:43:58',1,1,64,0,6,14350),(540,'2016-08-31 16:43:58',1,1,66,0,6,14400),(541,'2016-08-31 16:43:58',1,1,67,0,3,12100),(542,'2016-08-31 16:43:58',1,1,70,0,3,6700),(543,'2016-08-31 16:43:58',1,1,71,0,7,6500),(544,'2016-08-31 16:43:58',1,1,72,0,10,6200),(545,'2016-08-31 16:43:58',1,1,73,0,8,6200),(546,'2016-08-31 16:43:58',1,1,74,0,1,7450),(547,'2016-08-31 16:43:58',1,1,75,0,5,7150),(548,'2016-08-31 16:43:58',1,1,76,0,4,6650),(549,'2016-08-31 16:43:58',1,1,77,0,1,6450),(550,'2016-08-31 16:43:58',1,1,78,0,6,6150),(551,'2016-08-31 16:43:58',1,1,79,0,28,6150),(552,'2016-08-31 16:43:58',1,1,80,0,1,12800),(553,'2016-08-31 16:43:58',1,1,81,0,1,6750),(554,'2016-08-31 16:43:58',1,1,41,0,116,10250),(555,'2016-08-31 16:43:58',1,1,65,0,11,19800),(556,'2016-08-31 16:43:58',1,1,37,0,225,32500),(557,'2016-08-31 16:43:58',1,1,38,0,275,37900),(558,'2016-08-31 16:43:58',1,1,39,0,395,43350),(559,'2016-08-31 16:43:58',1,1,40,0,610,54170),(560,'2016-08-31 16:43:58',1,1,14,0,1,5400),(561,'2016-08-31 16:43:58',1,1,15,0,3,7400),(562,'2016-08-31 16:43:58',1,1,16,0,1,8250),(563,'2016-08-31 16:43:58',1,1,17,0,16,9150),(564,'2016-08-31 16:43:58',1,1,18,0,2,10500),(565,'2016-08-31 16:43:58',1,1,19,0,34,10850),(566,'2016-08-31 16:43:58',1,1,20,0,14,14400),(567,'2016-08-31 16:43:58',1,1,21,0,3,15350),(568,'2016-08-31 16:43:58',1,1,22,0,9,15350),(569,'2016-08-31 16:43:58',1,1,23,0,2,17400),(570,'2016-08-31 16:43:58',1,1,24,0,8,16700),(571,'2016-08-31 16:43:58',1,1,27,0,1,9600),(572,'2016-08-31 16:43:58',1,1,28,0,8,8600),(573,'2016-08-31 16:43:58',1,1,29,0,7,9000),(574,'2016-08-31 16:43:58',1,1,30,0,2,9500),(575,'2016-08-31 16:43:58',1,1,31,0,1,10000),(576,'2016-08-31 16:43:58',1,1,68,0,1,126000),(577,'2016-08-31 16:43:58',1,1,32,0,26,9150),(578,'2016-08-31 16:43:58',1,1,33,0,95,8500),(579,'2016-08-31 16:43:58',1,1,34,0,51,7800),(580,'2016-08-31 16:43:58',1,1,35,0,56,7800),(581,'2016-08-31 16:43:58',1,1,36,0,8,8600),(582,'2016-08-31 16:43:58',1,1,25,0,6,17250),(583,'2016-08-31 16:43:58',1,1,26,0,3,30500);

ALTER TABLE `inventory_adjustment_detail` ENABLE KEYS;
UNLOCK TABLES;
COMMIT;

--
-- Data for table: jual
--
LOCK TABLES `jual` WRITE;
ALTER TABLE `jual` DISABLE KEYS;

-- Table contains no data

ALTER TABLE `jual` ENABLE KEYS;
UNLOCK TABLES;
COMMIT;

--
-- Data for table: jual_barang
--
LOCK TABLES `jual_barang` WRITE;
ALTER TABLE `jual_barang` DISABLE KEYS;

-- Table contains no data

ALTER TABLE `jual_barang` ENABLE KEYS;
UNLOCK TABLES;
COMMIT;

--
-- Data for table: kategori
--
LOCK TABLES `kategori` WRITE;
ALTER TABLE `kategori` DISABLE KEYS;

INSERT INTO `kategori` (`id`,`created_at`,`nama`,`satuan_id`,`user_id`) VALUES (28,'2016-05-12 06:46:07','SENG GELOMBANG',2,NULL),(31,'2016-05-12 06:55:40','PAKU',1,NULL),(32,'2016-05-12 07:25:13','LEM',1,NULL),(33,'2016-05-13 06:39:41','SENG TALANG',3,NULL),(34,'2016-05-13 06:56:04','GALVALUM',5,NULL),(35,'2016-05-13 07:29:18','KAWAT',3,NULL),(36,'2016-05-13 07:31:19','BENDRAT',3,NULL),(37,'2016-06-05 06:07:58','KARBIT',1,NULL);

ALTER TABLE `kategori` ENABLE KEYS;
UNLOCK TABLES;
COMMIT;

--
-- Data for table: permissions
--
LOCK TABLES `permissions` WRITE;
ALTER TABLE `permissions` DISABLE KEYS;

-- Table contains no data

ALTER TABLE `permissions` ENABLE KEYS;
UNLOCK TABLES;
COMMIT;

--
-- Data for table: piutang
--
LOCK TABLES `piutang` WRITE;
ALTER TABLE `piutang` DISABLE KEYS;

-- Table contains no data

ALTER TABLE `piutang` ENABLE KEYS;
UNLOCK TABLES;
COMMIT;

--
-- Data for table: piutang_cicil
--
LOCK TABLES `piutang_cicil` WRITE;
ALTER TABLE `piutang_cicil` DISABLE KEYS;

-- Table contains no data

ALTER TABLE `piutang_cicil` ENABLE KEYS;
UNLOCK TABLES;
COMMIT;

--
-- Data for table: role_permission
--
LOCK TABLES `role_permission` WRITE;
ALTER TABLE `role_permission` DISABLE KEYS;

-- Table contains no data

ALTER TABLE `role_permission` ENABLE KEYS;
UNLOCK TABLES;
COMMIT;

--
-- Data for table: roles
--
LOCK TABLES `roles` WRITE;
ALTER TABLE `roles` DISABLE KEYS;

INSERT INTO `roles` (`id`,`created_at`,`updated_at`,`nama`,`description`) VALUES (1,'2016-08-12 04:19:19','2016-08-12 04:19:20','ADM','ADMINISTRATOR'),(2,'2016-08-12 04:19:39','2016-08-12 04:19:40','CSH','CASHIER');

ALTER TABLE `roles` ENABLE KEYS;
UNLOCK TABLES;
COMMIT;

--
-- Data for table: salesman
--
LOCK TABLES `salesman` WRITE;
ALTER TABLE `salesman` DISABLE KEYS;

INSERT INTO `salesman` (`id`,`created_at`,`kode`,`nama`,`ktp`,`telp`,`telp_2`,`alamat`,`user_id`) VALUES (3,'2016-05-11 20:01:18','ALI','ALI SUTANTO','892378734658','08987877676','','Sidoarjo',NULL),(4,'2016-05-11 20:01:44','SUP','SUPRIADI','89732845678365873','089989878876','','Porong',NULL),(5,'2016-06-24 09:51:00','PAR','PARMO','23476387468326','085556767879','','SIDOARJO',NULL);

ALTER TABLE `salesman` ENABLE KEYS;
UNLOCK TABLES;
COMMIT;

--
-- Data for table: satuan
--
LOCK TABLES `satuan` WRITE;
ALTER TABLE `satuan` DISABLE KEYS;

INSERT INTO `satuan` (`id`,`created_at`,`nama`,`user_id`) VALUES (1,'2016-05-12 06:12:45','DOS',NULL),(2,'2016-05-12 06:12:48','LEMBAR',NULL),(3,'2016-05-12 06:32:58','ROLL',NULL),(5,'2016-05-13 06:40:30','LONJOR',NULL);

ALTER TABLE `satuan` ENABLE KEYS;
UNLOCK TABLES;
COMMIT;

--
-- Data for table: stok
--
LOCK TABLES `stok` WRITE;
ALTER TABLE `stok` DISABLE KEYS;

INSERT INTO `stok` (`id`,`created_at`,`tgl`,`barang_id`,`stok_awal`,`current_stok`,`tipe`,`harga`,`beli_id`,`user_id`) VALUES (19,'2016-08-31 16:44:33','2016-08-31',82,35,35,'M',420000,NULL,1),(20,'2016-08-31 16:44:33','2016-08-31',42,1,1,'M',10300,NULL,1),(21,'2016-08-31 16:44:33','2016-08-31',43,3,3,'M',10200,NULL,1),(22,'2016-08-31 16:44:33','2016-08-31',44,1,1,'M',10000,NULL,1),(23,'2016-08-31 16:44:33','2016-08-31',45,1,1,'M',9550,NULL,1),(24,'2016-08-31 16:44:33','2016-08-31',46,12,12,'M',9200,NULL,1),(25,'2016-08-31 16:44:33','2016-08-31',47,5,5,'M',8550,NULL,1),(26,'2016-08-31 16:44:33','2016-08-31',48,40,40,'M',8450,NULL,1),(27,'2016-08-31 16:44:33','2016-08-31',49,1,1,'M',10100,NULL,1),(28,'2016-08-31 16:44:33','2016-08-31',50,1,1,'M',10000,NULL,1),(29,'2016-08-31 16:44:33','2016-08-31',51,6,6,'M',9800,NULL,1),(30,'2016-08-31 16:44:33','2016-08-31',52,7,7,'M',9350,NULL,1),(31,'2016-08-31 16:44:33','2016-08-31',53,12,12,'M',8800,NULL,1),(32,'2016-08-31 16:44:33','2016-08-31',54,29,29,'M',8350,NULL,1),(33,'2016-08-31 16:44:33','2016-08-31',55,82,82,'M',8250,NULL,1),(34,'2016-08-31 16:44:33','2016-08-31',56,2,2,'M',10700,NULL,1),(35,'2016-08-31 16:44:33','2016-08-31',57,1,1,'M',9800,NULL,1),(36,'2016-08-31 16:44:33','2016-08-31',58,1,1,'M',9500,NULL,1),(37,'2016-08-31 16:44:33','2016-08-31',59,3,3,'M',9300,NULL,1),(38,'2016-08-31 16:44:33','2016-08-31',60,4,4,'M',8800,NULL,1),(39,'2016-08-31 16:44:33','2016-08-31',61,5,5,'M',8100,NULL,1),(40,'2016-08-31 16:44:33','2016-08-31',62,38,38,'M',7900,NULL,1),(41,'2016-08-31 16:44:33','2016-08-31',63,1,1,'M',7400,NULL,1),(42,'2016-08-31 16:44:33','2016-08-31',64,6,6,'M',14350,NULL,1),(43,'2016-08-31 16:44:33','2016-08-31',66,6,6,'M',14400,NULL,1),(44,'2016-08-31 16:44:33','2016-08-31',67,3,3,'M',12100,NULL,1),(45,'2016-08-31 16:44:33','2016-08-31',70,3,3,'M',6700,NULL,1),(46,'2016-08-31 16:44:33','2016-08-31',71,7,7,'M',6500,NULL,1),(47,'2016-08-31 16:44:33','2016-08-31',72,10,10,'M',6200,NULL,1),(48,'2016-08-31 16:44:33','2016-08-31',73,8,8,'M',6200,NULL,1),(49,'2016-08-31 16:44:33','2016-08-31',74,1,1,'M',7450,NULL,1),(50,'2016-08-31 16:44:33','2016-08-31',75,5,5,'M',7150,NULL,1),(51,'2016-08-31 16:44:33','2016-08-31',76,4,4,'M',6650,NULL,1),(52,'2016-08-31 16:44:33','2016-08-31',77,1,1,'M',6450,NULL,1),(53,'2016-08-31 16:44:33','2016-08-31',78,6,6,'M',6150,NULL,1),(54,'2016-08-31 16:44:33','2016-08-31',79,28,28,'M',6150,NULL,1),(55,'2016-08-31 16:44:33','2016-08-31',80,1,1,'M',12800,NULL,1),(56,'2016-08-31 16:44:33','2016-08-31',81,1,1,'M',6750,NULL,1),(57,'2016-08-31 16:44:33','2016-08-31',41,116,116,'M',10250,NULL,1),(58,'2016-08-31 16:44:33','2016-08-31',65,11,11,'M',19800,NULL,1),(59,'2016-08-31 16:44:33','2016-08-31',37,225,225,'M',32500,NULL,1),(60,'2016-08-31 16:44:33','2016-08-31',38,275,275,'M',37900,NULL,1),(61,'2016-08-31 16:44:33','2016-08-31',39,395,395,'M',43350,NULL,1),(62,'2016-08-31 16:44:33','2016-08-31',40,610,610,'M',54170,NULL,1),(63,'2016-08-31 16:44:33','2016-08-31',14,1,1,'M',5400,NULL,1),(64,'2016-08-31 16:44:33','2016-08-31',15,3,3,'M',7400,NULL,1),(65,'2016-08-31 16:44:33','2016-08-31',16,1,1,'M',8250,NULL,1),(66,'2016-08-31 16:44:33','2016-08-31',17,16,16,'M',9150,NULL,1),(67,'2016-08-31 16:44:33','2016-08-31',18,2,2,'M',10500,NULL,1),(68,'2016-08-31 16:44:33','2016-08-31',19,34,34,'M',10850,NULL,1),(69,'2016-08-31 16:44:33','2016-08-31',20,14,14,'M',14400,NULL,1),(70,'2016-08-31 16:44:33','2016-08-31',21,3,3,'M',15350,NULL,1),(71,'2016-08-31 16:44:33','2016-08-31',22,9,9,'M',15350,NULL,1),(72,'2016-08-31 16:44:33','2016-08-31',23,2,2,'M',17400,NULL,1),(73,'2016-08-31 16:44:33','2016-08-31',24,8,8,'M',16700,NULL,1),(74,'2016-08-31 16:44:33','2016-08-31',27,1,1,'M',9600,NULL,1),(75,'2016-08-31 16:44:33','2016-08-31',28,8,8,'M',8600,NULL,1),(76,'2016-08-31 16:44:33','2016-08-31',29,7,7,'M',9000,NULL,1),(77,'2016-08-31 16:44:33','2016-08-31',30,2,2,'M',9500,NULL,1),(78,'2016-08-31 16:44:33','2016-08-31',31,1,1,'M',10000,NULL,1),(79,'2016-08-31 16:44:33','2016-08-31',68,1,1,'M',126000,NULL,1),(80,'2016-08-31 16:44:33','2016-08-31',32,26,26,'M',9150,NULL,1),(81,'2016-08-31 16:44:33','2016-08-31',33,95,95,'M',8500,NULL,1),(82,'2016-08-31 16:44:33','2016-08-31',34,51,51,'M',7800,NULL,1),(83,'2016-08-31 16:44:33','2016-08-31',35,56,56,'M',7800,NULL,1),(84,'2016-08-31 16:44:33','2016-08-31',36,8,8,'M',8600,NULL,1),(85,'2016-08-31 16:44:33','2016-08-31',25,6,6,'M',17250,NULL,1),(86,'2016-08-31 16:44:33','2016-08-31',26,3,3,'M',30500,NULL,1);

ALTER TABLE `stok` ENABLE KEYS;
UNLOCK TABLES;
COMMIT;

--
-- Data for table: stok_moving
--
LOCK TABLES `stok_moving` WRITE;
ALTER TABLE `stok_moving` DISABLE KEYS;

INSERT INTO `stok_moving` (`id`,`created_at`,`stok_id`,`jumlah`,`tipe`,`jual_id`,`inventory_adjustment_detail_id`,`user_id`) VALUES (10,'2016-08-31 16:44:33',19,35,'I',NULL,516,1),(11,'2016-08-31 16:44:33',20,1,'I',NULL,517,1),(12,'2016-08-31 16:44:33',21,3,'I',NULL,518,1),(13,'2016-08-31 16:44:33',22,1,'I',NULL,519,1),(14,'2016-08-31 16:44:33',23,1,'I',NULL,520,1),(15,'2016-08-31 16:44:33',24,12,'I',NULL,521,1),(16,'2016-08-31 16:44:33',25,5,'I',NULL,522,1),(17,'2016-08-31 16:44:33',26,40,'I',NULL,523,1),(18,'2016-08-31 16:44:33',27,1,'I',NULL,524,1),(19,'2016-08-31 16:44:33',28,1,'I',NULL,525,1),(20,'2016-08-31 16:44:33',29,6,'I',NULL,526,1),(21,'2016-08-31 16:44:33',30,7,'I',NULL,527,1),(22,'2016-08-31 16:44:33',31,12,'I',NULL,528,1),(23,'2016-08-31 16:44:33',32,29,'I',NULL,529,1),(24,'2016-08-31 16:44:33',33,82,'I',NULL,530,1),(25,'2016-08-31 16:44:33',34,2,'I',NULL,531,1),(26,'2016-08-31 16:44:33',35,1,'I',NULL,532,1),(27,'2016-08-31 16:44:33',36,1,'I',NULL,533,1),(28,'2016-08-31 16:44:33',37,3,'I',NULL,534,1),(29,'2016-08-31 16:44:33',38,4,'I',NULL,535,1),(30,'2016-08-31 16:44:33',39,5,'I',NULL,536,1),(31,'2016-08-31 16:44:33',40,38,'I',NULL,537,1),(32,'2016-08-31 16:44:33',41,1,'I',NULL,538,1),(33,'2016-08-31 16:44:33',42,6,'I',NULL,539,1),(34,'2016-08-31 16:44:33',43,6,'I',NULL,540,1),(35,'2016-08-31 16:44:33',44,3,'I',NULL,541,1),(36,'2016-08-31 16:44:33',45,3,'I',NULL,542,1),(37,'2016-08-31 16:44:33',46,7,'I',NULL,543,1),(38,'2016-08-31 16:44:33',47,10,'I',NULL,544,1),(39,'2016-08-31 16:44:33',48,8,'I',NULL,545,1),(40,'2016-08-31 16:44:33',49,1,'I',NULL,546,1),(41,'2016-08-31 16:44:33',50,5,'I',NULL,547,1),(42,'2016-08-31 16:44:33',51,4,'I',NULL,548,1),(43,'2016-08-31 16:44:33',52,1,'I',NULL,549,1),(44,'2016-08-31 16:44:33',53,6,'I',NULL,550,1),(45,'2016-08-31 16:44:33',54,28,'I',NULL,551,1),(46,'2016-08-31 16:44:33',55,1,'I',NULL,552,1),(47,'2016-08-31 16:44:33',56,1,'I',NULL,553,1),(48,'2016-08-31 16:44:33',57,116,'I',NULL,554,1),(49,'2016-08-31 16:44:33',58,11,'I',NULL,555,1),(50,'2016-08-31 16:44:33',59,225,'I',NULL,556,1),(51,'2016-08-31 16:44:33',60,275,'I',NULL,557,1),(52,'2016-08-31 16:44:33',61,395,'I',NULL,558,1),(53,'2016-08-31 16:44:33',62,610,'I',NULL,559,1),(54,'2016-08-31 16:44:33',63,1,'I',NULL,560,1),(55,'2016-08-31 16:44:33',64,3,'I',NULL,561,1),(56,'2016-08-31 16:44:33',65,1,'I',NULL,562,1),(57,'2016-08-31 16:44:33',66,16,'I',NULL,563,1),(58,'2016-08-31 16:44:33',67,2,'I',NULL,564,1),(59,'2016-08-31 16:44:33',68,34,'I',NULL,565,1),(60,'2016-08-31 16:44:33',69,14,'I',NULL,566,1),(61,'2016-08-31 16:44:33',70,3,'I',NULL,567,1),(62,'2016-08-31 16:44:33',71,9,'I',NULL,568,1),(63,'2016-08-31 16:44:33',72,2,'I',NULL,569,1),(64,'2016-08-31 16:44:33',73,8,'I',NULL,570,1),(65,'2016-08-31 16:44:33',74,1,'I',NULL,571,1),(66,'2016-08-31 16:44:33',75,8,'I',NULL,572,1),(67,'2016-08-31 16:44:33',76,7,'I',NULL,573,1),(68,'2016-08-31 16:44:33',77,2,'I',NULL,574,1),(69,'2016-08-31 16:44:33',78,1,'I',NULL,575,1),(70,'2016-08-31 16:44:33',79,1,'I',NULL,576,1),(71,'2016-08-31 16:44:33',80,26,'I',NULL,577,1),(72,'2016-08-31 16:44:33',81,95,'I',NULL,578,1),(73,'2016-08-31 16:44:33',82,51,'I',NULL,579,1),(74,'2016-08-31 16:44:33',83,56,'I',NULL,580,1),(75,'2016-08-31 16:44:33',84,8,'I',NULL,581,1),(76,'2016-08-31 16:44:33',85,6,'I',NULL,582,1),(77,'2016-08-31 16:44:33',86,3,'I',NULL,583,1);

ALTER TABLE `stok_moving` ENABLE KEYS;
UNLOCK TABLES;
COMMIT;

--
-- Data for table: supplier
--
LOCK TABLES `supplier` WRITE;
ALTER TABLE `supplier` DISABLE KEYS;

INSERT INTO `supplier` (`id`,`created_at`,`nama`,`nama_kontak`,`telp`,`telp_2`,`alamat`,`jatuh_tempo`,`rek`,`note`,`user_id`) VALUES (1,'2016-05-12 08:15:17','PT BAJA STEEL','ALWI','0899878967896','08989787678576','Surabaya',14,'1234567890','',NULL),(2,'2016-05-22 17:09:35','PT MASPION','ALI MARKUS','083495678436587','','SIDOARJO',30,'008 997 665 887','',NULL),(3,'2016-08-31 15:54:01','PT BENTENG MAS ABADI','ROY','0813-7774-8789','','Jl. Margomulyo Permai No.32C Surabaya 60184',40,NULL,'',1),(4,'2016-08-31 15:58:35','PT PAKU INDAH WARU','BUDI','08189897677565','','Jl Kapasan 169-G Surabaya',45,NULL,'',1);

ALTER TABLE `supplier` ENABLE KEYS;
UNLOCK TABLES;
COMMIT;

--
-- Data for table: supplier_bill
--
LOCK TABLES `supplier_bill` WRITE;
ALTER TABLE `supplier_bill` DISABLE KEYS;

-- Table contains no data

ALTER TABLE `supplier_bill` ENABLE KEYS;
UNLOCK TABLES;
COMMIT;

--
-- Data for table: supplier_bill_payment
--
LOCK TABLES `supplier_bill_payment` WRITE;
ALTER TABLE `supplier_bill_payment` DISABLE KEYS;

-- Table contains no data

ALTER TABLE `supplier_bill_payment` ENABLE KEYS;
UNLOCK TABLES;
COMMIT;

--
-- Data for table: user_role
--
LOCK TABLES `user_role` WRITE;
ALTER TABLE `user_role` DISABLE KEYS;

INSERT INTO `user_role` (`id`,`created_at`,`updated_at`,`user_id`,`role_id`) VALUES (1,'2016-08-12 04:20:00','2016-08-12 04:20:01',1,1);

ALTER TABLE `user_role` ENABLE KEYS;
UNLOCK TABLES;
COMMIT;

--
-- Data for table: users
--
LOCK TABLES `users` WRITE;
ALTER TABLE `users` DISABLE KEYS;

INSERT INTO `users` (`id`,`created_at`,`updated_at`,`name`,`username`,`email`,`password`,`remember_token`,`verified`) VALUES (1,'2016-08-11 17:19:31','2016-08-21','','admin','admin@localhost.com','$2y$10$IfJZtmvoB3HFgyv3PEdIVe7IZCOrATXv/P1yw3JC7Yrio/8uYzuHC','BAror6vAeHGIucicJ27Lf0Az3wRQxHgf5xdgoIibKtBQM3pU7p6g6tRquTEX',1);

ALTER TABLE `users` ENABLE KEYS;
UNLOCK TABLES;
COMMIT;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;


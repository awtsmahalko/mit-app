# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 192.168.64.2 (MySQL 5.5.5-10.4.11-MariaDB)
# Database: pims_db
# Generation Time: 2021-11-18 02:41:00 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table tbl_canvass_details
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_canvass_details`;

CREATE TABLE `tbl_canvass_details` (
  `canvass_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `canvass_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `packaging_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `qty` decimal(12,2) NOT NULL,
  `cost` decimal(12,2) NOT NULL,
  PRIMARY KEY (`canvass_detail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `tbl_canvass_details` WRITE;
/*!40000 ALTER TABLE `tbl_canvass_details` DISABLE KEYS */;

INSERT INTO `tbl_canvass_details` (`canvass_detail_id`, `canvass_id`, `item_id`, `packaging_id`, `supplier_id`, `qty`, `cost`)
VALUES
	(1,2,8,1,3,10.00,25.00),
	(2,2,8,1,1,10.00,15.00),
	(3,2,8,2,3,10.00,16.00),
	(4,2,8,2,1,10.00,10.00),
	(5,2,12,1,3,14.00,13.00),
	(6,2,12,1,1,14.00,12.00),
	(7,2,3,1,3,4.00,14.00),
	(8,2,3,1,1,4.00,15.00),
	(9,2,11,1,3,4.00,16.00),
	(10,2,11,1,1,4.00,17.00),
	(29,3,12,1,3,4.00,1.00),
	(30,3,12,1,1,4.00,2.00),
	(31,3,12,1,4,4.00,3.00),
	(32,3,9,2,3,5.00,4.00),
	(33,3,9,2,1,5.00,5.00),
	(34,3,9,2,4,5.00,6.00);

/*!40000 ALTER TABLE `tbl_canvass_details` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_canvass_header
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_canvass_header`;

CREATE TABLE `tbl_canvass_header` (
  `canvass_id` int(11) NOT NULL AUTO_INCREMENT,
  `canvass_date` date NOT NULL,
  `pr_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `canvass_status` varchar(1) NOT NULL DEFAULT '' COMMENT 'S:Saved,F:Finished',
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`canvass_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `tbl_canvass_header` WRITE;
/*!40000 ALTER TABLE `tbl_canvass_header` DISABLE KEYS */;

INSERT INTO `tbl_canvass_header` (`canvass_id`, `canvass_date`, `pr_id`, `user_id`, `canvass_status`, `date_modified`)
VALUES
	(2,'2021-10-22',1,1,'F','2021-10-22 09:05:16'),
	(3,'2021-11-11',4,1,'F','2021-11-11 10:08:21');

/*!40000 ALTER TABLE `tbl_canvass_header` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_canvass_suppliers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_canvass_suppliers`;

CREATE TABLE `tbl_canvass_suppliers` (
  `cs_id` int(11) NOT NULL AUTO_INCREMENT,
  `canvass_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  PRIMARY KEY (`cs_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `tbl_canvass_suppliers` WRITE;
/*!40000 ALTER TABLE `tbl_canvass_suppliers` DISABLE KEYS */;

INSERT INTO `tbl_canvass_suppliers` (`cs_id`, `canvass_id`, `supplier_id`)
VALUES
	(4,2,3),
	(5,2,1),
	(6,3,3),
	(7,3,1),
	(8,3,4);

/*!40000 ALTER TABLE `tbl_canvass_suppliers` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_items
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_items`;

CREATE TABLE `tbl_items` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(75) NOT NULL,
  `item_desc` varchar(100) NOT NULL,
  `item_serial_no` varchar(50) NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `tbl_items` WRITE;
/*!40000 ALTER TABLE `tbl_items` DISABLE KEYS */;

INSERT INTO `tbl_items` (`item_id`, `item_name`, `item_desc`, `item_serial_no`, `date_modified`)
VALUES
	(3,'Envelope, Plastic, Legal','s','s','2021-10-13 16:16:53'),
	(4,'Sign Pen, 0.3 (dozen)','s',' s','2021-10-13 16:17:12'),
	(5,'TAPE, TRANSPARENT, width: 48mm (±1mm)','sa','s','2021-10-13 16:17:25'),
	(6,'FOLDER, TAGBOARD, for legal size documents	',' ',' ','2021-10-15 11:36:37'),
	(7,'Tabbing',' ',' ','2021-10-15 11:36:53'),
	(8,'Correction Tape	','for ',' 1000145','2021-10-19 15:41:39'),
	(9,'RECORD BOOK, 300 PAGES, size: 214mm x 278mm min	',' ',' ','2021-10-15 11:37:17'),
	(10,'NOTE PAD,stick on 50mm x 76mm (2\" x 3\") min	',' ',' ','2021-10-15 11:37:29'),
	(11,'Cutter Knife	',' ',' ','2021-10-15 11:37:39'),
	(12,'Stapler #35, with stapple wire remover	',' ',' ','2021-10-15 11:37:49'),
	(13,'Pentelpen',' ',' ','2021-10-15 11:37:59');

/*!40000 ALTER TABLE `tbl_items` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_items_packaging
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_items_packaging`;

CREATE TABLE `tbl_items_packaging` (
  `ip_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `packaging_id` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`ip_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `tbl_items_packaging` WRITE;
/*!40000 ALTER TABLE `tbl_items_packaging` DISABLE KEYS */;

INSERT INTO `tbl_items_packaging` (`ip_id`, `item_id`, `packaging_id`, `date_modified`)
VALUES
	(1,11,1,'2021-10-16 16:34:49'),
	(4,8,1,'2021-10-16 21:37:33'),
	(5,8,2,'2021-10-16 21:37:33'),
	(6,3,1,'2021-10-16 21:37:45'),
	(7,3,2,'2021-10-16 21:37:45'),
	(8,12,1,'2021-10-19 14:52:07'),
	(9,12,2,'2021-10-19 14:52:07'),
	(10,9,1,'2021-10-19 14:52:13'),
	(11,9,2,'2021-10-19 14:52:13'),
	(12,13,1,'2021-10-19 14:52:19'),
	(13,13,2,'2021-10-19 14:52:19'),
	(14,10,1,'2021-10-19 14:52:27'),
	(15,10,2,'2021-10-19 14:52:27'),
	(16,6,1,'2021-10-19 14:52:33'),
	(17,6,2,'2021-10-19 14:52:33'),
	(18,4,2,'2021-10-19 14:52:40'),
	(19,5,1,'2021-10-19 14:52:48');

/*!40000 ALTER TABLE `tbl_items_packaging` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_packaging
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_packaging`;

CREATE TABLE `tbl_packaging` (
  `packaging_id` int(11) NOT NULL AUTO_INCREMENT,
  `packaging_name` varchar(30) NOT NULL,
  `actual_qty` decimal(11,2) NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`packaging_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `tbl_packaging` WRITE;
/*!40000 ALTER TABLE `tbl_packaging` DISABLE KEYS */;

INSERT INTO `tbl_packaging` (`packaging_id`, `packaging_name`, `actual_qty`, `date_modified`)
VALUES
	(1,'piece',1.00,'2021-10-13 11:40:37'),
	(2,'pack',12.00,'2021-10-16 21:37:14');

/*!40000 ALTER TABLE `tbl_packaging` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_purchase_order_details
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_purchase_order_details`;

CREATE TABLE `tbl_purchase_order_details` (
  `po_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `po_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `packaging_id` int(11) NOT NULL,
  `qty` decimal(12,2) NOT NULL,
  `cost` decimal(12,2) NOT NULL,
  `serve_status` int(1) NOT NULL,
  PRIMARY KEY (`po_detail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `tbl_purchase_order_details` WRITE;
/*!40000 ALTER TABLE `tbl_purchase_order_details` DISABLE KEYS */;

INSERT INTO `tbl_purchase_order_details` (`po_detail_id`, `po_id`, `item_id`, `packaging_id`, `qty`, `cost`, `serve_status`)
VALUES
	(1,1,8,1,10.00,15.00,1),
	(2,1,8,2,10.00,10.00,1),
	(3,1,12,1,14.00,12.00,1),
	(4,1,3,1,4.00,15.00,1),
	(5,1,11,1,4.00,17.00,1),
	(6,2,12,1,4.00,1.00,0),
	(7,2,9,2,5.00,4.00,0);

/*!40000 ALTER TABLE `tbl_purchase_order_details` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_purchase_order_header
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_purchase_order_header`;

CREATE TABLE `tbl_purchase_order_header` (
  `po_id` int(11) NOT NULL AUTO_INCREMENT,
  `pr_id` int(11) NOT NULL,
  `po_date` date NOT NULL,
  `canvass_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `po_status` varchar(2) NOT NULL DEFAULT '' COMMENT 'FS=Fully Served,P=Partial,S=Saved',
  `io_id` int(11) NOT NULL,
  `pc_id` int(11) NOT NULL,
  `date_inspected` date DEFAULT NULL,
  `date_received` date DEFAULT NULL,
  PRIMARY KEY (`po_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `tbl_purchase_order_header` WRITE;
/*!40000 ALTER TABLE `tbl_purchase_order_header` DISABLE KEYS */;

INSERT INTO `tbl_purchase_order_header` (`po_id`, `pr_id`, `po_date`, `canvass_id`, `supplier_id`, `date_modified`, `user_id`, `po_status`, `io_id`, `pc_id`, `date_inspected`, `date_received`)
VALUES
	(1,1,'2021-10-22',2,1,'2021-10-22 09:24:24',1,'FS',4,5,'2021-11-17','2021-11-17'),
	(2,4,'2021-11-17',3,3,'2021-11-17 11:33:40',6,'S',0,0,NULL,NULL);

/*!40000 ALTER TABLE `tbl_purchase_order_header` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_purchase_request_details
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_purchase_request_details`;

CREATE TABLE `tbl_purchase_request_details` (
  `pr_detail_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pr_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `packaging_id` int(11) NOT NULL,
  `qty` decimal(12,2) NOT NULL,
  `cost` decimal(12,2) NOT NULL,
  PRIMARY KEY (`pr_detail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `tbl_purchase_request_details` WRITE;
/*!40000 ALTER TABLE `tbl_purchase_request_details` DISABLE KEYS */;

INSERT INTO `tbl_purchase_request_details` (`pr_detail_id`, `pr_id`, `item_id`, `packaging_id`, `qty`, `cost`)
VALUES
	(1,1,8,1,10.00,15.00),
	(2,1,8,2,10.00,5.00),
	(3,1,12,1,14.00,6.00),
	(4,1,3,1,4.00,9.00),
	(5,1,11,1,4.00,9.00),
	(6,2,11,1,4.00,5.00),
	(7,2,8,1,4.00,5.00),
	(8,2,6,1,4.00,8.00),
	(9,2,10,2,45.00,10.00),
	(10,3,11,1,15.00,12.00),
	(11,3,4,2,5.00,4.00),
	(12,3,5,1,10.00,15.00),
	(13,4,12,1,4.00,5.00),
	(14,4,9,2,5.00,6.00);

/*!40000 ALTER TABLE `tbl_purchase_request_details` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_purchase_request_header
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_purchase_request_header`;

CREATE TABLE `tbl_purchase_request_header` (
  `pr_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pr_no` varchar(30) NOT NULL,
  `pr_year` year(4) NOT NULL,
  `pr_mo` int(2) NOT NULL,
  `pr_batch` int(11) NOT NULL,
  `pr_department` varchar(4) NOT NULL DEFAULT '',
  `pr_date` date NOT NULL,
  `pr_purpose` varchar(155) NOT NULL DEFAULT '',
  `pr_status` varchar(1) NOT NULL DEFAULT 'S' COMMENT 'S=Saved, P=Pending, A=Approved',
  `pr_mode` varchar(50) NOT NULL DEFAULT '',
  `pr_expense` varchar(50) NOT NULL,
  `pr_suppliers` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `approved_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`pr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `tbl_purchase_request_header` WRITE;
/*!40000 ALTER TABLE `tbl_purchase_request_header` DISABLE KEYS */;

INSERT INTO `tbl_purchase_request_header` (`pr_id`, `pr_no`, `pr_year`, `pr_mo`, `pr_batch`, `pr_department`, `pr_date`, `pr_purpose`, `pr_status`, `pr_mode`, `pr_expense`, `pr_suppliers`, `user_id`, `approved_by`, `date_modified`)
VALUES
	(1,'2021-07-001-ELEM','2021',7,1,'ELEM','2021-10-21','Office Supplies','A','Office Supplies','Shopping','3,1,4',1,6,'2021-10-21 11:54:31'),
	(2,'2021-07-002-ELEM','2021',6,2,'ELEM','2021-10-21','Office Supplies','P','Shopping','Office Supplies','',1,6,'2021-10-21 14:05:33'),
	(3,'2021-07-003-ELEM','2021',4,3,'ELEM','2021-10-22','Office Supplies','A','Small Value','Other supplies and materials','3,1,4',1,6,'2021-10-22 08:28:03'),
	(4,'2021-07-001-JHS','2021',8,1,'JHS','2021-10-22','OFFICE SUPPLIES','A','Small Value','Office Supplies','3,1,4',1,6,'2021-10-22 09:20:39');

/*!40000 ALTER TABLE `tbl_purchase_request_header` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_receiving_details
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_receiving_details`;

CREATE TABLE `tbl_receiving_details` (
  `rr_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `rr_id` int(11) NOT NULL,
  `orig_qty` decimal(12,2) NOT NULL,
  `qty` decimal(12,2) NOT NULL,
  `item_id` int(11) NOT NULL,
  `packaging_id` int(11) NOT NULL,
  `cost` decimal(12,2) NOT NULL,
  PRIMARY KEY (`rr_detail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `tbl_receiving_details` WRITE;
/*!40000 ALTER TABLE `tbl_receiving_details` DISABLE KEYS */;

INSERT INTO `tbl_receiving_details` (`rr_detail_id`, `rr_id`, `orig_qty`, `qty`, `item_id`, `packaging_id`, `cost`)
VALUES
	(1,1,10.00,10.00,8,1,15.00),
	(2,1,10.00,10.00,8,2,10.00),
	(3,1,14.00,14.00,12,1,12.00),
	(4,1,4.00,4.00,3,1,15.00),
	(5,1,4.00,4.00,11,1,17.00);

/*!40000 ALTER TABLE `tbl_receiving_details` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_receiving_header
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_receiving_header`;

CREATE TABLE `tbl_receiving_header` (
  `rr_id` int(11) NOT NULL AUTO_INCREMENT,
  `pr_id` int(11) NOT NULL,
  `po_id` int(11) NOT NULL,
  `rr_date` date NOT NULL,
  `rr_invoice` bigint(20) NOT NULL,
  `rr_invoice_date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `rr_status` varchar(2) NOT NULL DEFAULT '' COMMENT 'FS=Fully Served, P=Partial',
  PRIMARY KEY (`rr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `tbl_receiving_header` WRITE;
/*!40000 ALTER TABLE `tbl_receiving_header` DISABLE KEYS */;

INSERT INTO `tbl_receiving_header` (`rr_id`, `pr_id`, `po_id`, `rr_date`, `rr_invoice`, `rr_invoice_date`, `user_id`, `date_modified`, `rr_status`)
VALUES
	(1,1,1,'2021-10-22',1000,'2021-10-22',1,'2021-10-22 09:24:44','FS');

/*!40000 ALTER TABLE `tbl_receiving_header` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_release_details
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_release_details`;

CREATE TABLE `tbl_release_details` (
  `release_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `release_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `packaging_id` int(11) NOT NULL,
  `qty` decimal(12,2) NOT NULL,
  `cost` decimal(12,2) NOT NULL,
  `day_consume` int(11) NOT NULL,
  PRIMARY KEY (`release_detail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `tbl_release_details` WRITE;
/*!40000 ALTER TABLE `tbl_release_details` DISABLE KEYS */;

INSERT INTO `tbl_release_details` (`release_detail_id`, `release_id`, `item_id`, `packaging_id`, `qty`, `cost`, `day_consume`)
VALUES
	(1,1,8,2,10.00,15.00,0),
	(2,1,12,1,15.00,16.00,0),
	(3,1,5,1,6.00,13.00,0),
	(4,2,8,1,10.00,15.00,0);

/*!40000 ALTER TABLE `tbl_release_details` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_release_header
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_release_header`;

CREATE TABLE `tbl_release_header` (
  `release_id` int(11) NOT NULL AUTO_INCREMENT,
  `release_no` varchar(50) NOT NULL DEFAULT '',
  `release_batch` int(11) NOT NULL,
  `release_date` date NOT NULL,
  `department` varchar(15) NOT NULL DEFAULT '',
  `release_status` varchar(1) NOT NULL DEFAULT '',
  `release_days_consume` int(11) NOT NULL,
  `remarks` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`release_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `tbl_release_header` WRITE;
/*!40000 ALTER TABLE `tbl_release_header` DISABLE KEYS */;

INSERT INTO `tbl_release_header` (`release_id`, `release_no`, `release_batch`, `release_date`, `department`, `release_status`, `release_days_consume`, `remarks`, `user_id`, `date_modified`)
VALUES
	(1,'2021-11-001-ELEM-ISSUE',1,'2021-11-04','ELEM','F',12,'a',5,'2021-10-29 10:06:06'),
	(2,'2021-11-002-JHS-ISSUE',2,'2021-11-16','JHS','S',10,'fd',5,'2021-11-16 15:16:02'),
	(3,'2021-11-003-ELEM-ISSUE',3,'2021-11-16','ELEM','S',5,'sa',5,'2021-11-16 15:43:19'),
	(4,'2021-11-004-ELEM-ISSUE',4,'2021-11-16','ELEM','S',5,'12',5,'2021-11-16 15:44:05');

/*!40000 ALTER TABLE `tbl_release_header` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_suppliers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_suppliers`;

CREATE TABLE `tbl_suppliers` (
  `supplier_id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(100) NOT NULL,
  `supplier_owner` varchar(100) NOT NULL DEFAULT '',
  `supplier_address` varchar(150) NOT NULL,
  `supplier_contact_no` varchar(15) NOT NULL,
  `supplier_email` varchar(255) NOT NULL DEFAULT '',
  `supplier_tin` varchar(15) NOT NULL DEFAULT '',
  `remarks` varchar(100) NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`supplier_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `tbl_suppliers` WRITE;
/*!40000 ALTER TABLE `tbl_suppliers` DISABLE KEYS */;

INSERT INTO `tbl_suppliers` (`supplier_id`, `supplier_name`, `supplier_owner`, `supplier_address`, `supplier_contact_no`, `supplier_email`, `supplier_tin`, `remarks`, `date_modified`)
VALUES
	(1,'CIAN & CYAN SCHOOL SUPPLIES TRADING','CHARMAINE J. ZARCENO','Bacolod City','09457100454','eduard16carton@gmail.com','764-000-111-123','test','2021-11-15 10:53:37'),
	(3,'A & E BOOKSTORE	','','Sagay City','09125156111','eduard16carton@gmail.com','764-000-123-321','s','2021-11-11 09:24:47'),
	(4,'NOVELS TRADING','','Sagay City','0945541514','eduard16carton@gmail.com','764-123-000-000','a','2021-11-11 09:25:02');

/*!40000 ALTER TABLE `tbl_suppliers` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_users`;

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_fname` varchar(30) NOT NULL,
  `user_mname` varchar(30) NOT NULL,
  `user_lname` varchar(30) NOT NULL,
  `user_category` varchar(3) NOT NULL,
  `user_email` varchar(255) NOT NULL DEFAULT '',
  `user_contact_no` varchar(11) NOT NULL DEFAULT '',
  `username` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `pc_designation` varchar(4) DEFAULT NULL COMMENT 'ELEM,JHS,SHS',
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `tbl_users` WRITE;
/*!40000 ALTER TABLE `tbl_users` DISABLE KEYS */;

INSERT INTO `tbl_users` (`user_id`, `user_fname`, `user_mname`, `user_lname`, `user_category`, `user_email`, `user_contact_no`, `username`, `password`, `pc_designation`, `date_modified`)
VALUES
	(1,'Stephanie Dane','S.','Salvador','AA','eduard16carton@gmail.com','09096836075','admin','0cc175b9c0f1b6a831c399e269772661',NULL,'2021-11-15 11:03:38'),
	(4,'Martin Luis','A.','Delante','IO','eduard16carton@gmail.com','09096836075','io','f98ed07a4d5f50f7de1410d905f1477f',NULL,'2021-11-15 10:22:25'),
	(5,'Lyseth','S.','Martinez','PC','eduard16carton@gmail.com','09096836075','pcelem','bc54f4d60f1cec0f9a6cb70e13f2127a','ELEM','2021-11-15 13:56:22'),
	(6,'BAC',' ',' ','BAC','eduard16carton@gmail.com','09096836075','bac','79ec16df80b57696a03bb364410061f3',NULL,'2021-10-13 09:18:49'),
	(8,'Alfie','V.','Silva','PC','eduard16carton@gmail.com','09096836075','pcjhs','902cd45de9df829eaa7c7e779731b8cd','JHS','2021-11-15 13:56:50'),
	(9,'Bartlome','S.','Lamag','PC','eduard16carton@gmail.com','09096836075','pcshs','bcce08e3d96971b1a1434b88d05354ac','SHS','2021-11-15 13:58:07');

/*!40000 ALTER TABLE `tbl_users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

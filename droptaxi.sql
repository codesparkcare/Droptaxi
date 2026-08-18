-- MariaDB dump 10.19  Distrib 10.4.28-MariaDB, for osx10.10 (x86_64)
--
-- Host: localhost    Database: droptaxi
-- ------------------------------------------------------
-- Server version	10.4.28-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('superadmin','admin') DEFAULT 'superadmin',
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'Super Admin','admin@droptaxi.com','admin','$2y$10$2dC2nW/vNDnpb3IIgwI3xuXIv3tkIYqj5P1xqJeA3JNtuE23dWp2m','superadmin','2026-08-16 22:15:13');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bookings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_id` varchar(30) NOT NULL,
  `trip_type` varchar(50) NOT NULL,
  `pickup_location` varchar(255) NOT NULL,
  `drop_location` varchar(255) DEFAULT NULL,
  `pickup_date` date NOT NULL,
  `pickup_time` time NOT NULL,
  `return_date` date DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `vehicle_name` varchar(100) NOT NULL,
  `distance_km` decimal(10,2) DEFAULT 0.00,
  `per_km_rate` decimal(10,2) DEFAULT 0.00,
  `driver_batta` decimal(10,2) DEFAULT 0.00,
  `permit_fee` decimal(10,2) DEFAULT 0.00,
  `toll_fee` decimal(10,2) DEFAULT 0.00,
  `estimated_fare` decimal(10,2) NOT NULL,
  `total_fare` decimal(10,2) DEFAULT 0.00,
  `coupon_code` varchar(50) DEFAULT NULL,
  `discount_amount` decimal(10,2) DEFAULT 0.00,
  `passenger_name` varchar(100) NOT NULL,
  `passenger_phone` varchar(20) NOT NULL,
  `passenger_email` varchar(150) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `payment_status` enum('pending','paid','failed') DEFAULT 'pending',
  `payment_id` varchar(100) DEFAULT NULL,
  `razorpay_order_id` varchar(100) DEFAULT NULL,
  `booking_status` enum('new','confirmed','assigned','completed','cancelled') DEFAULT 'new',
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `booking_id` (`booking_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookings`
--

LOCK TABLES `bookings` WRITE;
/*!40000 ALTER TABLE `bookings` DISABLE KEYS */;
INSERT INTO `bookings` VALUES (1,'DT202608161575','One Way Drop','Chennai','Bangalore','2026-08-20','10:00:00',NULL,1,'Sedan (Dzire / Etios)',350.00,14.00,300.00,0.00,0.00,5200.00,5200.00,NULL,0.00,'Rajesh Kumar','9876543210','rajesh@example.com',NULL,'pending',NULL,NULL,'new','2026-08-16 22:17:33');
/*!40000 ALTER TABLE `bookings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coupons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `discount_type` enum('flat','percent') NOT NULL DEFAULT 'flat',
  `discount_value` decimal(10,2) NOT NULL DEFAULT 0.00,
  `min_order_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `is_one_time` tinyint(1) NOT NULL DEFAULT 0,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `expiry_date` date DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupons`
--

LOCK TABLES `coupons` WRITE;
/*!40000 ALTER TABLE `coupons` DISABLE KEYS */;
INSERT INTO `coupons` VALUES (1,'SAVE100','flat',100.00,1000.00,0,'active',NULL,'2026-08-17 10:46:07'),(2,'WELCOME10','percent',10.00,500.00,1,'active',NULL,'2026-08-17 10:46:07');
/*!40000 ALTER TABLE `coupons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enquiries`
--

DROP TABLE IF EXISTS `enquiries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `enquiries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('unread','read','contacted') DEFAULT 'unread',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enquiries`
--

LOCK TABLES `enquiries` WRITE;
/*!40000 ALTER TABLE `enquiries` DISABLE KEYS */;
/*!40000 ALTER TABLE `enquiries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(100) NOT NULL,
  `setting_value` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `setting_key` (`setting_key`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'site_title','DropTaxi - All Over Tamil Nadu Drop Taxi Service','2026-08-16 22:15:13','2026-08-16 22:15:13'),(2,'contact_phone','+91 98765 43210','2026-08-16 22:15:13','2026-08-16 22:15:13'),(3,'contact_email','info@droptaxi.com','2026-08-16 22:15:13','2026-08-16 22:15:13'),(4,'whatsapp_number','919876543210','2026-08-16 22:15:13','2026-08-16 22:15:13'),(5,'smtp_host','smtp.gmail.com','2026-08-16 22:15:13','2026-08-16 22:15:13'),(6,'smtp_port','587','2026-08-16 22:15:13','2026-08-16 22:15:13'),(7,'smtp_user','','2026-08-16 22:15:13','2026-08-16 22:15:13'),(8,'smtp_pass','','2026-08-16 22:15:13','2026-08-16 22:15:13'),(9,'smtp_crypto','tls','2026-08-16 22:15:13','2026-08-16 22:15:13'),(10,'smtp_from_email','noreply@droptaxi.com','2026-08-16 22:15:13','2026-08-16 22:15:13'),(11,'smtp_from_name','DropTaxi Booking Service','2026-08-16 22:15:13','2026-08-16 22:15:13'),(12,'razorpay_key_id','rzp_test_samplekey123','2026-08-16 22:15:13','2026-08-16 22:15:13'),(13,'razorpay_key_secret','sample_secret_key_123','2026-08-16 22:15:13','2026-08-16 22:15:13'),(14,'razorpay_enabled','1','2026-08-16 22:15:13','2026-08-16 22:15:13'),(15,'google_map_key','AIzaSyDEO3zPEcZiGQ2zM5qcDvPqLbHgg9WFPbQ','2026-08-17 10:24:25','2026-08-17 10:24:25');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicles`
--

DROP TABLE IF EXISTS `vehicles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `type_key` varchar(50) NOT NULL,
  `capacity` int(11) NOT NULL,
  `baggage` int(11) DEFAULT 2,
  `min_km_oneway` int(11) DEFAULT 130,
  `min_km_roundtrip` int(11) DEFAULT 250,
  `per_km_oneway` decimal(10,2) NOT NULL,
  `per_km_roundtrip` decimal(10,2) NOT NULL,
  `driver_batta_oneway` decimal(10,2) DEFAULT 300.00,
  `driver_batta_roundtrip` decimal(10,2) DEFAULT 400.00,
  `base_fare` decimal(10,2) DEFAULT 0.00,
  `image_url` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `type_key` (`type_key`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicles`
--

LOCK TABLES `vehicles` WRITE;
/*!40000 ALTER TABLE `vehicles` DISABLE KEYS */;
INSERT INTO `vehicles` VALUES (1,'Sedan (Dzire / Etios)','sedan',4,2,130,250,14.00,13.00,300.00,400.00,0.00,NULL,'Comfortable AC Sedan ideal for up to 4 passengers with light luggage.','active','2026-08-16 22:15:13'),(2,'SUV / Ertiga','suv',6,4,130,250,19.00,17.00,400.00,500.00,0.00,NULL,'Spacious AC SUV suitable for family trips with ample legroom.','active','2026-08-16 22:15:13'),(3,'Innova Crysta','innova',7,5,130,250,22.00,20.00,400.00,500.00,0.00,NULL,'Premium executive luxury MUV for comfortable long outstation journeys.','active','2026-08-16 22:15:13'),(4,'Tempo Traveller','tempo',12,10,150,300,28.00,25.00,600.00,700.00,0.00,NULL,'Large group luxury van equipped with AC and spacious seats.','active','2026-08-16 22:15:13');
/*!40000 ALTER TABLE `vehicles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `otp_code` varchar(10) DEFAULT NULL,
  `otp_expiry` datetime DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `status` enum('active','blocked') NOT NULL DEFAULT 'active',
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `phone` (`phone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Table structure for table `drivers`
--

DROP TABLE IF EXISTS `drivers`;
CREATE TABLE `drivers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `licence_doc` varchar(255) DEFAULT NULL,
  `aadhar_doc` varchar(255) DEFAULT NULL,
  `pan_card_doc` varchar(255) DEFAULT NULL,
  `bank_account_doc` varchar(255) DEFAULT NULL,
  `is_phone_verified` tinyint(1) NOT NULL DEFAULT 0,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `phone` (`phone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-08-17 10:56:15

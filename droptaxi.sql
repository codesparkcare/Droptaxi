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
-- Table structure for table `blogs`
--

DROP TABLE IF EXISTS `blogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `excerpt` text DEFAULT NULL,
  `content` longtext NOT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `category` varchar(100) DEFAULT 'Travel Guide',
  `author` varchar(100) DEFAULT 'DropTaxi Editorial',
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `status` enum('published','draft') NOT NULL DEFAULT 'published',
  `published_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blogs`
--

LOCK TABLES `blogs` WRITE;
/*!40000 ALTER TABLE `blogs` DISABLE KEYS */;
INSERT INTO `blogs` VALUES (1,'Top Benefits of One Way Drop Taxi in Tamil Nadu: Save 40% on Outstation Travel','benefits-of-one-way-drop-taxi-tamil-nadu','Discover why one way drop taxi booking is revolutionizing outstation travel in Tamil Nadu. Learn how to pay only for the distance you travel with zero return fare.','<h2>Why Pay Double When You Only Need One Way?</h2><p>Traditional outstation taxi operators commonly charge round-trip fares even when you only need to travel from one city to another. With <strong>DropTaxi One Way service</strong>, you only pay for the exact distance travelled, saving up to 40% on your travel budget.</p><h3>Key Advantages of DropTaxi:</h3><ul><li><strong>Pay Only One-Way:</strong> Zero return kilometer charges for intercity trips.</li><li><strong>Doorstep Pickup & Drop:</strong> Convenient pickup from any neighborhood in Chennai, Madurai, Coimbatore, Tirunelveli, and Trichy.</li><li><strong>Transparent Billing:</strong> Pre-calculated fares with toll estimates and driver allowance included upfront.</li><li><strong>Well-Maintained AC Fleet:</strong> Clean Sedans (Dzire, Etios) and SUVs (Ertiga, Innova) with verified professional chauffeurs.</li></ul><p>Ready to experience hassle-free outstation travel? Book your one way taxi online now!</p>',NULL,'Travel Guide','DropTaxi Editorial','Benefits of One Way Drop Taxi in Tamil Nadu | Save 40% on Taxi Booking','one way drop taxi, outstation drop taxi, drop taxi tamil nadu, taxi booking online, chennai to madurai drop taxi, coimbatore drop taxi','Save up to 40% on outstation travel in Tamil Nadu with DropTaxi one-way drop taxi service. Pay only for one way with transparent per-km rates and verified drivers.',143,'published','2026-08-18 17:28:00','2026-08-18 17:28:00','2026-08-23 17:28:00'),(2,'How to Book Online Taxi in Tamil Nadu: Complete Step-by-Step Guide','how-to-book-online-taxi-tamil-nadu','A simple step-by-step tutorial on booking one-way and round-trip outstation cabs online with instant fare calculation and immediate confirmation.','<h2>Easy 3-Step Online Taxi Booking</h2><p>Booking a drop taxi has never been easier. Follow these simple steps to confirm your cab in under 2 minutes:</p><ol><li><strong>Enter Pickup & Drop Locations:</strong> Type your area name or city to instantly see the driving distance and estimated tolls.</li><li><strong>Choose Your Vehicle:</strong> Select from affordable Sedans, spacious 6-seater SUVs, luxury Innova Crysta, or 12-seater Tempo Travellers.</li><li><strong>Instant Confirmation:</strong> Receive your booking ID, driver assignment, and live SMS updates immediately.</li></ol><h3>Safety First with Verified Drivers</h3><p>Every driver undergoes strict background verification and vehicle safety audits, guaranteeing peace of mind on long highway journeys.</p>',NULL,'Booking Tips','DropTaxi Team','How to Book Online Taxi in Tamil Nadu | Online Drop Taxi Booking Guide','online taxi, taxi booking, book cab online, drop taxi booking, outstation taxi booking tamil nadu, near by droptaxi','Step-by-step guide to online taxi booking in Tamil Nadu. Book one-way and round-trip outstation cabs in 3 easy steps with instant fare calculation.',98,'published','2026-08-20 17:28:00','2026-08-20 17:28:00','2026-08-23 17:28:00'),(3,'Finding Nearby Drop Taxi & Outstation Cabs for Fast Highway Travel','finding-nearby-drop-taxi-outstation-cabs','Need a nearby drop taxi urgently? Here is how to find the closest verified outstation cab with 24x7 emergency and scheduled pickup across South India.','<h2>24x7 Nearby Outstation Cabs On Demand</h2><p>Whether you need an early morning airport transfer or an emergency one-way intercity cab, DropTaxi connects you with the nearest active chauffeur in your district.</p><h3>Coverage Across 38+ Districts:</h3><p>We serve all major highways and hubs including NH44, NH45, NH83 connecting Chennai, Madurai, Coimbatore, Salem, Tirunelveli, Trichy, Nagercoil, Tenkasi, and Bangalore.</p><p>Call our 24x7 helpline or book online for guaranteed on-time pickups!</p>',NULL,'Travel Guide','DropTaxi Editorial','Nearby Drop Taxi & Outstation Cabs Across Tamil Nadu | 24x7 Taxi Booking','near by droptaxi, nearby taxi, outstation cabs near me, two way drop taxi, intercity drop taxi, emergency drop taxi','Find reliable nearby drop taxi and outstation cabs across Tamil Nadu. 24x7 fast pickup, transparent per-km billing, and AC vehicles.',85,'published','2026-08-22 17:28:00','2026-08-22 17:28:00','2026-08-23 17:28:00');
/*!40000 ALTER TABLE `blogs` ENABLE KEYS */;
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
  `driver_id` int(11) DEFAULT NULL,
  `driver_name` varchar(100) DEFAULT NULL,
  `driver_phone` varchar(20) DEFAULT NULL,
  `vehicle_name` varchar(100) NOT NULL,
  `distance_km` decimal(10,2) DEFAULT 0.00,
  `per_km_rate` decimal(10,2) DEFAULT 0.00,
  `driver_batta` decimal(10,2) DEFAULT 0.00,
  `toll_count` int(11) DEFAULT 0,
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
  `booking_status` enum('new','confirmed','assigned','picked_up','completed','cancelled') DEFAULT 'new',
  `created_at` datetime DEFAULT current_timestamp(),
  `accepted_at` datetime DEFAULT NULL,
  `picked_up_at` datetime DEFAULT NULL,
  `completed_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `booking_id` (`booking_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookings`
--

LOCK TABLES `bookings` WRITE;
/*!40000 ALTER TABLE `bookings` DISABLE KEYS */;
INSERT INTO `bookings` VALUES (1,'DT202608161575','One Way Drop','Chennai','Bangalore','2026-08-20','10:00:00',NULL,1,NULL,NULL,NULL,NULL,'Sedan (Dzire / Etios)',350.00,14.00,300.00,0,0.00,0.00,5200.00,5200.00,NULL,0.00,'Rajesh Kumar','9876543210','rajesh@example.com',NULL,'failed',NULL,NULL,'cancelled','2026-08-16 22:17:33',NULL,NULL,NULL),(2,'DT202608177146','One Way Drop','Madurai, Tamil Nadu, India','Chennai, Tamil Nadu, India','2026-08-17','09:00:00',NULL,1,1,NULL,NULL,NULL,'Sedan (Dzire / Etios)',456.00,14.00,300.00,0,0.00,680.00,7364.00,7364.00,NULL,0.00,'Abdul Kader','08110899000','ak812282@gmail.com',NULL,'failed',NULL,NULL,'cancelled','2026-08-17 13:20:56',NULL,NULL,NULL),(3,'DT202608176237','Outstation Round Trip','Erode, Tamil Nadu, India','Tirunelveli, Tamil Nadu, India','2026-08-18','09:00:00','2026-08-22',1,2,NULL,NULL,NULL,'Sedan (Dzire / Etios)',361.00,13.00,400.00,0,0.00,1190.00,10976.00,10976.00,NULL,0.00,'ABDUL KADER U','09894812282','ak812282@gmail.com',NULL,'failed',NULL,NULL,'cancelled','2026-08-17 16:45:56',NULL,NULL,NULL);
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
  `is_one_time` tinyint(1) NOT NULL DEFAULT 1,
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
INSERT INTO `coupons` VALUES (1,'SAVE100','flat',100.00,1000.00,1,'active',NULL,'2026-08-17 10:46:07'),(2,'WELCOME10','percent',10.00,500.00,1,'active',NULL,'2026-08-17 10:46:07');
/*!40000 ALTER TABLE `coupons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,'Abdul Kader','08110899000','ak812282@gmail.com','8674','2026-08-23 07:36:02',1,'active','2026-08-17 13:20:56'),(2,'ABDUL KADER U','09894812282','ak812282@gmail.com',NULL,NULL,1,'active','2026-08-17 15:24:00'),(3,'Rajesh Kumar','9876543210','test@example.com',NULL,NULL,1,'active','2026-08-17 15:50:48'),(4,'Expresscarts - Online Delivery','8110899000','admin@expresscarts.in','1970','2026-08-23 16:40:00',0,'active','2026-08-23 10:56:09');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `drivers`
--

DROP TABLE IF EXISTS `drivers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `drivers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `otp_code` varchar(10) DEFAULT NULL,
  `otp_expiry` datetime DEFAULT NULL,
  `licence_doc` varchar(255) DEFAULT NULL,
  `aadhar_doc` varchar(255) DEFAULT NULL,
  `pan_card_doc` varchar(255) DEFAULT NULL,
  `bank_account_doc` varchar(255) DEFAULT NULL,
  `vehicle_number` varchar(50) DEFAULT NULL,
  `vehicle_type` varchar(50) DEFAULT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `fcm_token` text DEFAULT NULL,
  `is_phone_verified` tinyint(1) NOT NULL DEFAULT 0,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `is_online` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `phone` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `drivers`
--

LOCK TABLES `drivers` WRITE;
/*!40000 ALTER TABLE `drivers` DISABLE KEYS */;
INSERT INTO `drivers` VALUES (1,'Syed Ameena','9638527410',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,0,'active',1,'2026-08-18 13:49:25','2026-08-18 13:54:17');
/*!40000 ALTER TABLE `drivers` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'site_title','Royal Drop Taxi - All Over Tamil Nadu Drop Taxi & Outstation Cab Service','2026-08-16 22:15:13','2026-08-23 20:02:35'),(2,'contact_phone','+91 98765 43210','2026-08-16 22:15:13','2026-08-16 22:15:13'),(3,'contact_email','info@droptaxi.com','2026-08-16 22:15:13','2026-08-16 22:15:13'),(4,'whatsapp_number','919876543210','2026-08-16 22:15:13','2026-08-16 22:15:13'),(5,'smtp_host','smtp.gmail.com','2026-08-16 22:15:13','2026-08-16 22:15:13'),(6,'smtp_port','587','2026-08-16 22:15:13','2026-08-16 22:15:13'),(7,'smtp_user','','2026-08-16 22:15:13','2026-08-16 22:15:13'),(8,'smtp_pass','','2026-08-16 22:15:13','2026-08-16 22:15:13'),(9,'smtp_crypto','tls','2026-08-16 22:15:13','2026-08-16 22:15:13'),(10,'smtp_from_email','noreply@droptaxi.com','2026-08-16 22:15:13','2026-08-16 22:15:13'),(11,'smtp_from_name','Royal Drop Taxi Booking Service','2026-08-16 22:15:13','2026-08-23 20:02:35'),(12,'razorpay_key_id','rzp_test_samplekey123','2026-08-16 22:15:13','2026-08-16 22:15:13'),(13,'razorpay_key_secret','sample_secret_key_123','2026-08-16 22:15:13','2026-08-16 22:15:13'),(14,'razorpay_enabled','1','2026-08-16 22:15:13','2026-08-16 22:15:13'),(15,'google_map_key','AIzaSyDEO3zPEcZiGQ2zM5qcDvPqLbHgg9WFPbQ','2026-08-17 10:24:25','2026-08-23 19:55:19'),(16,'home_meta_title','DropTaxi | Best One Way Drop Taxi & Outstation Cabs in Tamil Nadu','2026-08-23 20:58:00','2026-08-23 20:58:00'),(17,'home_meta_keywords','taxi booking, one way drop taxi, two way drop taxi, near by droptaxi, online taxi, outstation drop taxi, drop taxi chennai, drop taxi madurai, drop taxi coimbatore, drop taxi tirunelveli, drop taxi trichy, drop taxi salem, intercity cab booking','2026-08-23 20:58:00','2026-08-23 20:58:00'),(18,'home_meta_description','Book reliable One Way Drop Taxi & Outstation Cabs across Tamil Nadu, Bangalore & Pondicherry. Pay only for one way. Lowest per km rates, zero hidden charges, 24x7 verified drivers.','2026-08-23 20:58:00','2026-08-23 20:58:00'),(19,'og_image','assets/images/og-banner.jpg','2026-08-23 20:58:00','2026-08-23 20:58:00');
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
INSERT INTO `vehicles` VALUES (1,'Sedan (Dzire / Etios)','sedan',4,2,30,60,14.00,13.00,300.00,400.00,0.00,NULL,'Comfortable AC Sedan ideal for up to 4 passengers with light luggage.','active','2026-08-16 22:15:13'),(2,'SUV / Ertiga','suv',6,4,30,60,19.00,17.00,400.00,500.00,0.00,NULL,'Spacious AC SUV suitable for family trips with ample legroom.','active','2026-08-16 22:15:13'),(3,'Innova Crysta','innova',7,5,30,60,22.00,20.00,400.00,500.00,0.00,NULL,'Premium executive luxury MUV for comfortable long outstation journeys.','active','2026-08-16 22:15:13'),(4,'Tempo Traveller','tempo',12,10,30,60,28.00,25.00,600.00,700.00,0.00,NULL,'Large group luxury van equipped with AC and spacious seats.','active','2026-08-16 22:15:13');
/*!40000 ALTER TABLE `vehicles` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-08-23 21:04:36

-- MySQL dump 10.13  Distrib 5.7.23, for Linux (x86_64)
--
-- Host: localhost    Database: bucontra_propertyhookup
-- ------------------------------------------------------
-- Server version	5.7.23-0ubuntu0.16.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `AuthAssignment`
--

DROP TABLE IF EXISTS `AuthAssignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `AuthAssignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`),
  CONSTRAINT `AuthAssignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `AuthAssignment`
--

LOCK TABLES `AuthAssignment` WRITE;
/*!40000 ALTER TABLE `AuthAssignment` DISABLE KEYS */;
/*!40000 ALTER TABLE `AuthAssignment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `AuthItem`
--

DROP TABLE IF EXISTS `AuthItem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `AuthItem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `AuthItem`
--

LOCK TABLES `AuthItem` WRITE;
/*!40000 ALTER TABLE `AuthItem` DISABLE KEYS */;
/*!40000 ALTER TABLE `AuthItem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `AuthItemChild`
--

DROP TABLE IF EXISTS `AuthItemChild`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `AuthItemChild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `AuthItemChild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `AuthItemChild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `AuthItemChild`
--

LOCK TABLES `AuthItemChild` WRITE;
/*!40000 ALTER TABLE `AuthItemChild` DISABLE KEYS */;
/*!40000 ALTER TABLE `AuthItemChild` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Rights`
--

DROP TABLE IF EXISTS `Rights`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Rights` (
  `itemname` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  PRIMARY KEY (`itemname`),
  CONSTRAINT `Rights_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Rights`
--

LOCK TABLES `Rights` WRITE;
/*!40000 ALTER TABLE `Rights` DISABLE KEYS */;
/*!40000 ALTER TABLE `Rights` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ad_client`
--

DROP TABLE IF EXISTS `ad_client`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ad_client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad_category_id` int(11) DEFAULT NULL,
  `company_name` varchar(255) NOT NULL,
  `rep_name` varchar(128) DEFAULT NULL,
  `company_logo` varchar(255) DEFAULT NULL,
  `company_address` varchar(255) DEFAULT NULL,
  `company_website` varchar(255) DEFAULT NULL,
  `contact_phone_number` varchar(12) DEFAULT NULL,
  `alt_contact_phone_number` varchar(12) DEFAULT NULL,
  `contact_email` varchar(128) DEFAULT NULL,
  `alt_contact_email` varchar(128) DEFAULT NULL,
  `ad_tag_line` varchar(255) DEFAULT NULL,
  `ad_description` text,
  `ad_confirmation_message` text,
  `message_to_advertiser` text,
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1',
  `for_all` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_ad_category_id` (`ad_category_id`),
  CONSTRAINT `FK_ad_category_id` FOREIGN KEY (`ad_category_id`) REFERENCES `ad_client_category` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ad_client`
--

LOCK TABLES `ad_client` WRITE;
/*!40000 ALTER TABLE `ad_client` DISABLE KEYS */;
/*!40000 ALTER TABLE `ad_client` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ad_client_activity`
--

DROP TABLE IF EXISTS `ad_client_activity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ad_client_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status_activity` int(11) DEFAULT '1',
  `client_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_first_name` varchar(128) DEFAULT NULL,
  `user_last_name` varchar(128) DEFAULT NULL,
  `user_phone_number` varchar(12) DEFAULT NULL,
  `user_email` varchar(128) DEFAULT NULL,
  `user_address` varchar(256) DEFAULT NULL,
  `user_comment` text,
  `user_lon` float(10,6) DEFAULT NULL,
  `user_lat` float(10,6) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `status_activity` (`status_activity`),
  KEY `updated_at` (`updated_at`),
  KEY `user_id` (`user_id`),
  KEY `client_id` (`client_id`),
  CONSTRAINT `client_id` FOREIGN KEY (`client_id`) REFERENCES `ad_client` (`id`),
  CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ad_client_activity`
--

LOCK TABLES `ad_client_activity` WRITE;
/*!40000 ALTER TABLE `ad_client_activity` DISABLE KEYS */;
/*!40000 ALTER TABLE `ad_client_activity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ad_client_category`
--

DROP TABLE IF EXISTS `ad_client_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ad_client_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad_category` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ad_client_category`
--

LOCK TABLES `ad_client_category` WRITE;
/*!40000 ALTER TABLE `ad_client_category` DISABLE KEYS */;
INSERT INTO `ad_client_category` VALUES (1,'Property Manager'),(2,'Lender'),(3,'Insurance'),(4,'Pool Service');
/*!40000 ALTER TABLE `ad_client_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ad_client_city`
--

DROP TABLE IF EXISTS `ad_client_city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ad_client_city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad_client_id` int(11) DEFAULT NULL,
  `ad_city_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ad_city_id` (`ad_city_id`),
  KEY `FK_ad_city_client_id` (`ad_client_id`),
  CONSTRAINT `FK_ad_city_client_id` FOREIGN KEY (`ad_client_id`) REFERENCES `ad_client` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ad_client_city`
--

LOCK TABLES `ad_client_city` WRITE;
/*!40000 ALTER TABLE `ad_client_city` DISABLE KEYS */;
/*!40000 ALTER TABLE `ad_client_city` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ad_client_county`
--

DROP TABLE IF EXISTS `ad_client_county`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ad_client_county` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad_client_id` int(11) DEFAULT NULL,
  `ad_county_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ad_county_id` (`ad_county_id`),
  KEY `FK_ad_county_client_id` (`ad_client_id`),
  CONSTRAINT `FK_ad_county_client_id` FOREIGN KEY (`ad_client_id`) REFERENCES `ad_client` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ad_client_county`
--

LOCK TABLES `ad_client_county` WRITE;
/*!40000 ALTER TABLE `ad_client_county` DISABLE KEYS */;
/*!40000 ALTER TABLE `ad_client_county` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ad_client_state`
--

DROP TABLE IF EXISTS `ad_client_state`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ad_client_state` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad_client_id` int(11) DEFAULT NULL,
  `ad_state_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ad_state_id` (`ad_state_id`),
  KEY `FK_ad_state_client_id` (`ad_client_id`),
  CONSTRAINT `FK_ad_state_client_id` FOREIGN KEY (`ad_client_id`) REFERENCES `ad_client` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ad_client_state`
--

LOCK TABLES `ad_client_state` WRITE;
/*!40000 ALTER TABLE `ad_client_state` DISABLE KEYS */;
/*!40000 ALTER TABLE `ad_client_state` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ad_client_zipcode`
--

DROP TABLE IF EXISTS `ad_client_zipcode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ad_client_zipcode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad_client_id` int(11) DEFAULT NULL,
  `ad_zipcode_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ad_zipcode_id` (`ad_zipcode_id`),
  KEY `FK_ad_zipcode_client_id` (`ad_client_id`),
  CONSTRAINT `FK_ad_zipcode_client_id` FOREIGN KEY (`ad_client_id`) REFERENCES `ad_client` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ad_client_zipcode`
--

LOCK TABLES `ad_client_zipcode` WRITE;
/*!40000 ALTER TABLE `ad_client_zipcode` DISABLE KEYS */;
/*!40000 ALTER TABLE `ad_client_zipcode` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alerts_scheduled_messages`
--

DROP TABLE IF EXISTS `alerts_scheduled_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alerts_scheduled_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `message_1` text,
  `message_2` text,
  `message_3` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alerts_scheduled_messages`
--

LOCK TABLES `alerts_scheduled_messages` WRITE;
/*!40000 ALTER TABLE `alerts_scheduled_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `alerts_scheduled_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `create_time` int(11) DEFAULT NULL,
  `author` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `post_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_comment_post` (`post_id`),
  CONSTRAINT `FK_comment_post` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compare_estimated_price_table`
--

DROP TABLE IF EXISTS `compare_estimated_price_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `compare_estimated_price_table` (
  `compare_estimate_id` int(11) DEFAULT NULL,
  `property_type` int(11) DEFAULT NULL,
  `stage` int(11) DEFAULT NULL,
  `year_estimated` varchar(255) DEFAULT NULL,
  `lot_estimated` varchar(255) DEFAULT NULL,
  `house_estimated` varchar(255) DEFAULT NULL,
  `lot_weighted` varchar(255) DEFAULT NULL,
  `house_weighted` varchar(255) DEFAULT NULL,
  `bathrooms_weighted` int(11) DEFAULT '5',
  `bedrooms_weighted` int(11) DEFAULT '2',
  `garages_weighted` int(11) DEFAULT '3',
  `pool_weighted` int(11) DEFAULT '5',
  `distance` varchar(255) DEFAULT NULL,
  `beds_estimated` tinyint(3) NOT NULL DEFAULT '0',
  `baths_estimated` tinyint(3) NOT NULL DEFAULT '0',
  `subdivision_comp` tinyint(1) NOT NULL DEFAULT '0',
  `min_comp` tinyint(3) NOT NULL DEFAULT '8',
  `house_views_comp` tinyint(1) NOT NULL DEFAULT '0',
  `sub_type_comp` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compare_estimated_price_table`
--

LOCK TABLES `compare_estimated_price_table` WRITE;
/*!40000 ALTER TABLE `compare_estimated_price_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `compare_estimated_price_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cron_market_info_area`
--

DROP TABLE IF EXISTS `cron_market_info_area`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cron_market_info_area` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `area` varchar(64) NOT NULL,
  `date` varchar(255) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `sale` int(11) DEFAULT NULL,
  `sold` int(11) DEFAULT NULL,
  `foreclosure` int(11) DEFAULT NULL,
  `short_sales` int(11) DEFAULT NULL,
  `avg_price` double DEFAULT NULL,
  `high_ppsf` double DEFAULT NULL,
  `low_ppsf` double DEFAULT NULL,
  `avg_ppsf` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `area` (`area`),
  KEY `date` (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cron_market_info_area`
--

LOCK TABLES `cron_market_info_area` WRITE;
/*!40000 ALTER TABLE `cron_market_info_area` DISABLE KEYS */;
/*!40000 ALTER TABLE `cron_market_info_area` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cron_market_info_city`
--

DROP TABLE IF EXISTS `cron_market_info_city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cron_market_info_city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city_id` int(11) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `sale` int(11) DEFAULT NULL,
  `sold` int(11) DEFAULT NULL,
  `foreclosure` int(11) DEFAULT NULL,
  `short_sales` int(11) DEFAULT NULL,
  `avg_price` double DEFAULT NULL,
  `high_ppsf` double DEFAULT NULL,
  `low_ppsf` double DEFAULT NULL,
  `avg_ppsf` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `city_id` (`city_id`),
  KEY `date` (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cron_market_info_city`
--

LOCK TABLES `cron_market_info_city` WRITE;
/*!40000 ALTER TABLE `cron_market_info_city` DISABLE KEYS */;
/*!40000 ALTER TABLE `cron_market_info_city` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cron_market_info_county`
--

DROP TABLE IF EXISTS `cron_market_info_county`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cron_market_info_county` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `county_id` int(11) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `sale` int(11) DEFAULT NULL,
  `sold` int(11) DEFAULT NULL,
  `foreclosure` int(11) DEFAULT NULL,
  `short_sales` int(11) DEFAULT NULL,
  `avg_price` double DEFAULT NULL,
  `high_ppsf` double DEFAULT NULL,
  `low_ppsf` double DEFAULT NULL,
  `avg_ppsf` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `county_id` (`county_id`),
  KEY `date` (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cron_market_info_county`
--

LOCK TABLES `cron_market_info_county` WRITE;
/*!40000 ALTER TABLE `cron_market_info_county` DISABLE KEYS */;
/*!40000 ALTER TABLE `cron_market_info_county` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cron_market_info_state`
--

DROP TABLE IF EXISTS `cron_market_info_state`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cron_market_info_state` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state_id` int(11) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `sale` int(11) DEFAULT NULL,
  `sold` int(11) DEFAULT NULL,
  `foreclosure` int(11) DEFAULT NULL,
  `short_sales` int(11) DEFAULT NULL,
  `avg_price` double DEFAULT NULL,
  `high_ppsf` double DEFAULT NULL,
  `low_ppsf` double DEFAULT NULL,
  `avg_ppsf` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `state_id` (`state_id`),
  KEY `date` (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cron_market_info_state`
--

LOCK TABLES `cron_market_info_state` WRITE;
/*!40000 ALTER TABLE `cron_market_info_state` DISABLE KEYS */;
/*!40000 ALTER TABLE `cron_market_info_state` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cron_market_info_subdivision`
--

DROP TABLE IF EXISTS `cron_market_info_subdivision`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cron_market_info_subdivision` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subdivision` varchar(64) NOT NULL,
  `date` varchar(255) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `sale` int(11) DEFAULT NULL,
  `sold` int(11) DEFAULT NULL,
  `foreclosure` int(11) DEFAULT NULL,
  `short_sales` int(11) DEFAULT NULL,
  `avg_price` double DEFAULT NULL,
  `high_ppsf` double DEFAULT NULL,
  `low_ppsf` double DEFAULT NULL,
  `avg_ppsf` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subdivision` (`subdivision`),
  KEY `date` (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cron_market_info_subdivision`
--

LOCK TABLES `cron_market_info_subdivision` WRITE;
/*!40000 ALTER TABLE `cron_market_info_subdivision` DISABLE KEYS */;
/*!40000 ALTER TABLE `cron_market_info_subdivision` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `details_map_shapes`
--

DROP TABLE IF EXISTS `details_map_shapes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `details_map_shapes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` varchar(50) NOT NULL,
  `prop_id` int(11) NOT NULL,
  `shape` text,
  `excluded_props_by_shape` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `details_map_shapes`
--

LOCK TABLES `details_map_shapes` WRITE;
/*!40000 ALTER TABLE `details_map_shapes` DISABLE KEYS */;
/*!40000 ALTER TABLE `details_map_shapes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `landing_page`
--

DROP TABLE IF EXISTS `landing_page`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `landing_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `search_id` int(11) DEFAULT NULL,
  `post_top_id` int(11) DEFAULT NULL,
  `post_bottom_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `updated_at` (`updated_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `landing_page`
--

LOCK TABLES `landing_page` WRITE;
/*!40000 ALTER TABLE `landing_page` DISABLE KEYS */;
/*!40000 ALTER TABLE `landing_page` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lookup`
--

DROP TABLE IF EXISTS `lookup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lookup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `code` int(11) NOT NULL,
  `type` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lookup`
--

LOCK TABLES `lookup` WRITE;
/*!40000 ALTER TABLE `lookup` DISABLE KEYS */;
INSERT INTO `lookup` VALUES (1,'Draft',1,'PostStatus',1),(2,'Published',2,'PostStatus',2),(3,'Archived',3,'PostStatus',3),(4,'Pending Approval',1,'CommentStatus',1),(5,'Approved',2,'CommentStatus',2),(6,'Draft',1,'LandingPageStatus',1),(7,'Published',2,'LandingPageStatus',2),(8,'Archived',3,'LandingPageStatus',3),(9,'Inactive',1,'AdClientStatus',1),(10,'Active',2,'AdClientStatus',2),(11,'Pending Approval',1,'AdClientActivityStatus',1),(12,'Approved',2,'AdClientActivityStatus',2),(13,'Sended',3,'AdClientActivityStatus',3);
/*!40000 ALTER TABLE `lookup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `market_trend_table`
--

DROP TABLE IF EXISTS `market_trend_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `market_trend_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `property_type` tinyint(3) DEFAULT NULL,
  `property_zipcode` int(8) DEFAULT NULL,
  `t_count` int(11) DEFAULT NULL,
  `avg_percentage_diff` decimal(5,2) DEFAULT NULL,
  `factor_type` enum('','fundamentals_factor','conditional_factor') DEFAULT '',
  `factor_value` decimal(12,8) DEFAULT '0.00000000',
  `factor_min` decimal(12,8) DEFAULT '0.00000000',
  `factor_max` decimal(12,8) DEFAULT '0.00000000',
  `compass_point` enum('','South','North','West','East') DEFAULT '',
  `house_faces` enum('','South','North','West','East','M','G') DEFAULT '',
  `house_views` varchar(100) DEFAULT NULL,
  `street_name` varchar(50) DEFAULT NULL,
  `pool` tinyint(4) DEFAULT NULL,
  `spa` enum('','No','Yes') DEFAULT '',
  `stories` varchar(30) DEFAULT NULL,
  `lot_description` varchar(100) DEFAULT NULL,
  `building_description` varchar(64) DEFAULT NULL,
  `carport_type` enum('','Attached Carport','Detached Carport') DEFAULT '',
  `converted_garage` enum('','No','Yes') DEFAULT '',
  `exterior_structure` varchar(10) DEFAULT NULL,
  `roof` varchar(100) DEFAULT NULL,
  `electrical_system` varchar(100) DEFAULT NULL,
  `plumbing_system` varchar(12) DEFAULT NULL,
  `built_desc` varchar(18) DEFAULT NULL,
  `exterior_grounds` varchar(100) DEFAULT NULL,
  `prop_desc` varchar(128) DEFAULT NULL,
  `over_all_property` varchar(12) DEFAULT NULL,
  `foreclosure` enum('','No','Yes') DEFAULT '',
  `short_sale` enum('','No','Yes') DEFAULT '',
  `sub_type` varchar(50) DEFAULT '',
  `factor_included` tinyint(1) DEFAULT '1',
  `studio` enum('','No','Yes') DEFAULT '',
  `condo_conversion` enum('','No','Yes') DEFAULT '',
  `association_features_available` varchar(50) DEFAULT '',
  `association_fee_1` int(11) DEFAULT '0',
  `assessment` enum('','No','Yes') DEFAULT '',
  `sidlid` enum('','No','Yes') DEFAULT '',
  `parking_description` varchar(50) DEFAULT '',
  `fence_type` varchar(60) DEFAULT '',
  `court_approval` enum('','No','Yes') DEFAULT '',
  `bath_downstairs` enum('','No','Yes') DEFAULT '',
  `bedroom_downstairs` enum('','No','Yes') DEFAULT '',
  `great_room` enum('','No','Yes') DEFAULT '',
  `bath_downstairs_description` varchar(20) DEFAULT '',
  `flooring_description` varchar(20) DEFAULT '',
  `furnishings_description` varchar(36) DEFAULT '',
  `heating_features` varchar(50) DEFAULT '',
  `possession_description` enum('','Estimated Completion Date','Current Lease Agreement','By Agreement-CLA','Close of Escrow','Immediate') DEFAULT '',
  `financing_considered` varchar(20) DEFAULT '',
  `reporeo` enum('','No','Yes') DEFAULT '',
  `litigation` enum('','Unknown','No','Yes') DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `market_trend_table`
--

LOCK TABLES `market_trend_table` WRITE;
/*!40000 ALTER TABLE `market_trend_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `market_trend_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `tags` text COLLATE utf8_unicode_ci,
  `status` int(11) NOT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `author_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post`
--

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profession_field_collection`
--

DROP TABLE IF EXISTS `profession_field_collection`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profession_field_collection` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `collection_id` int(11) DEFAULT NULL,
  `authitem_name` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `office` varchar(255) DEFAULT NULL,
  `street_address` varchar(255) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `county` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `phone_office` varchar(255) DEFAULT NULL,
  `phone_fax` varchar(255) DEFAULT NULL,
  `phone_home` varchar(255) DEFAULT NULL,
  `phone_mobile` varchar(255) DEFAULT NULL,
  `website_url` varchar(255) DEFAULT NULL,
  `tagline` varchar(255) DEFAULT NULL,
  `years_of_experience` varchar(255) DEFAULT NULL,
  `years_of_experience_text` varchar(255) DEFAULT NULL,
  `area_expertise` varchar(255) DEFAULT NULL,
  `area_expertise_text` varchar(255) DEFAULT NULL,
  `about_me` varchar(255) DEFAULT NULL,
  `upload_photo` varchar(255) DEFAULT NULL,
  `office_logo` varchar(255) DEFAULT NULL,
  `upload_logo` varchar(255) DEFAULT NULL,
  `listing_type` varchar(255) DEFAULT NULL,
  `payment_type` varchar(255) DEFAULT NULL,
  `join_date` varchar(255) DEFAULT NULL,
  `join_only_date` varchar(255) DEFAULT NULL,
  `membership_expire_date` varchar(255) DEFAULT NULL,
  `membership_subscription_date` varchar(255) DEFAULT NULL,
  `audit_expire_date` varchar(255) DEFAULT NULL,
  `profile_completion_percentage` varchar(255) DEFAULT NULL,
  `rating_average` varchar(255) DEFAULT NULL,
  `agent_last_login` varchar(255) DEFAULT NULL,
  `agent_comments` varchar(255) DEFAULT NULL,
  `profile_notification` varchar(255) DEFAULT NULL,
  `website_notification` varchar(255) DEFAULT NULL,
  `listings_notification` varchar(255) DEFAULT NULL,
  `subscription` varchar(255) DEFAULT NULL,
  `timestamp` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profession_field_collection`
--

LOCK TABLES `profession_field_collection` WRITE;
/*!40000 ALTER TABLE `profession_field_collection` DISABLE KEYS */;
/*!40000 ALTER TABLE `profession_field_collection` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profiles`
--

DROP TABLE IF EXISTS `profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profiles` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  CONSTRAINT `user_profile_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profiles`
--

LOCK TABLES `profiles` WRITE;
/*!40000 ALTER TABLE `profiles` DISABLE KEYS */;
/*!40000 ALTER TABLE `profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profiles_fields`
--

DROP TABLE IF EXISTS `profiles_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profiles_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `varname` varchar(50) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `field_type` varchar(50) NOT NULL DEFAULT '',
  `field_size` int(3) NOT NULL DEFAULT '0',
  `field_size_min` int(3) NOT NULL DEFAULT '0',
  `required` int(1) NOT NULL DEFAULT '0',
  `match` varchar(255) NOT NULL DEFAULT '',
  `range` varchar(255) NOT NULL DEFAULT '',
  `error_message` varchar(255) NOT NULL DEFAULT '',
  `other_validator` text,
  `default` varchar(255) NOT NULL DEFAULT '',
  `widget` varchar(255) NOT NULL DEFAULT '',
  `widgetparams` text,
  `position` int(3) NOT NULL DEFAULT '0',
  `visible` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profiles_fields`
--

LOCK TABLES `profiles_fields` WRITE;
/*!40000 ALTER TABLE `profiles_fields` DISABLE KEYS */;
/*!40000 ALTER TABLE `profiles_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `property_info`
--

DROP TABLE IF EXISTS `property_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `property_info` (
  `property_id` int(11) DEFAULT NULL,
  `year_biult_id` int(11) DEFAULT NULL,
  `pool` int(11) DEFAULT NULL,
  `garages` int(11) DEFAULT NULL,
  `mid` int(11) DEFAULT NULL,
  `property_title` varchar(255) DEFAULT NULL,
  `house_square_footage` int(11) DEFAULT NULL,
  `lot_acreage` double DEFAULT NULL,
  `property_type` int(11) DEFAULT NULL,
  `property_price` int(11) DEFAULT NULL,
  `bathrooms` decimal(6,2) DEFAULT '0.00',
  `bedrooms` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `property_street` varchar(255) DEFAULT NULL,
  `property_state_id` int(11) DEFAULT NULL,
  `property_county_id` int(11) DEFAULT NULL,
  `property_city_id` int(11) DEFAULT NULL,
  `property_zipcode` int(11) DEFAULT NULL,
  `property_uploaded_date` varchar(255) DEFAULT NULL,
  `property_updated_date` varchar(255) DEFAULT NULL,
  `property_expire_date` varchar(255) DEFAULT NULL,
  `photo1` varchar(255) DEFAULT NULL,
  `caption1` varchar(255) DEFAULT NULL,
  `getlongitude` double DEFAULT NULL,
  `getlatitude` double DEFAULT NULL,
  `estimated_price` int(11) DEFAULT NULL,
  `percentage_depreciation_value` decimal(5,2) DEFAULT '0.00',
  `comp_stage` int(11) DEFAULT NULL,
  `estimated_price_recalc_at` datetime DEFAULT NULL,
  `low_range` int(11) DEFAULT NULL,
  `high_range` int(11) DEFAULT NULL,
  `property_status` varchar(255) DEFAULT NULL,
  `user_session_id` varchar(255) DEFAULT NULL,
  `visible` varchar(255) DEFAULT NULL,
  `sub_type` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `subdivision` varchar(255) DEFAULT NULL,
  `schools` varchar(255) DEFAULT NULL,
  `community_name` varchar(255) DEFAULT NULL,
  `community_features` varchar(255) DEFAULT NULL,
  `property_fetatures` varchar(255) DEFAULT NULL,
  `mls_sysid` int(11) DEFAULT NULL,
  `views` int(11) DEFAULT NULL,
  `$public_remarks` varchar(255) DEFAULT NULL,
  `street_number` int(11) DEFAULT NULL,
  `street_name` varchar(50) DEFAULT NULL,
  `building_number` tinyint(3) DEFAULT NULL,
  `location` varchar(12) DEFAULT NULL,
  `property_type_mls` varchar(22) DEFAULT NULL,
  `elevator_floor` tinyint(4) DEFAULT NULL,
  `converted_to_real_property` enum('No','Yes') DEFAULT 'No',
  `manufactured` enum('No','Yes') DEFAULT 'No',
  `ownership` varchar(25) DEFAULT NULL,
  `building_description` varchar(64) DEFAULT NULL,
  `comps` int(11) NOT NULL DEFAULT '0',
  `fundamentals_factor` decimal(12,8) DEFAULT '0.00000000',
  `conditional_factor` decimal(12,8) DEFAULT '0.00000000',
  `house_square_footage_gravity` decimal(10,8) DEFAULT '1.00000000',
  `lot_footage_gravity` decimal(10,8) DEFAULT '1.00000000',
  `mls_name` varchar(50) DEFAULT NULL,
  `public_remarks` varchar(1000) DEFAULT NULL,
  UNIQUE KEY `property_id` (`property_id`),
  KEY `mls_conformity` (`mls_sysid`,`mls_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property_info`
--

LOCK TABLES `property_info` WRITE;
/*!40000 ALTER TABLE `property_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `property_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `property_info_additional_brokerage_details`
--

DROP TABLE IF EXISTS `property_info_additional_brokerage_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `property_info_additional_brokerage_details` (
  `property_info_brokerage_details` int(11) DEFAULT NULL,
  `property_id` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `fireplace_features` varchar(255) DEFAULT NULL,
  `heating_features` varchar(255) DEFAULT NULL,
  `exterior_construction_features` varchar(255) DEFAULT NULL,
  `roofing_features` varchar(255) DEFAULT NULL,
  `interior_features` varchar(255) DEFAULT NULL,
  `exterior_features` varchar(255) DEFAULT NULL,
  `sales_history` varchar(255) DEFAULT NULL,
  `tax_history` varchar(255) DEFAULT NULL,
  `foreclosure` varchar(255) DEFAULT NULL,
  `short_sale` varchar(255) DEFAULT NULL,
  `page_link` varchar(255) DEFAULT NULL,
  `updated_mid` varchar(255) DEFAULT NULL,
  `brokerage_mid` int(11) DEFAULT NULL,
  `mls_id` varchar(255) DEFAULT NULL,
  `pagent_name` varchar(255) DEFAULT NULL,
  `pagent_phone` varchar(255) DEFAULT NULL,
  `pagent_phone_fax` varchar(255) DEFAULT NULL,
  `pagent_phone_home` varchar(255) DEFAULT NULL,
  `pagent_phone_mobile` varchar(255) DEFAULT NULL,
  `pagent_website` varchar(255) DEFAULT NULL,
  `list_agent_public_id` int(11) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `buyer_broker_code` varchar(6) DEFAULT NULL,
  `buyer_agent_public_id` int(11) DEFAULT NULL,
  `lo_phone` varchar(12) DEFAULT NULL,
  `list_office_code` varchar(6) DEFAULT NULL,
  `owner_licensee` enum('No','Yes','Related') DEFAULT 'No',
  `realtor` enum('No','Yes') DEFAULT 'No',
  `sale_office_bonus` enum('No','Yes') DEFAULT 'No',
  `commission_excluded` enum('No','Yes') DEFAULT 'No',
  `commission_variable` enum('No','Yes') DEFAULT 'No',
  `additional_showing` varchar(55) DEFAULT NULL,
  `ladom` tinyint(5) DEFAULT NULL,
  `home_protection_plan` enum('No','Yes') DEFAULT 'No',
  `open_house_flag` tinyint(1) DEFAULT NULL,
  `list_date` datetime DEFAULT NULL,
  `list_price` int(11) DEFAULT NULL,
  `original_list_price` int(11) DEFAULT NULL,
  `pricechgdate` datetime DEFAULT NULL,
  `sale_price` int(11) DEFAULT NULL,
  `previous_price` int(11) DEFAULT NULL,
  `status_updates` varchar(25) DEFAULT NULL,
  `t_status_date` datetime DEFAULT NULL,
  `internet` enum('No','Yes') DEFAULT 'No',
  `idx` varchar(1) DEFAULT NULL,
  `images` tinyint(2) DEFAULT NULL,
  `photo_excluded` enum('No','Yes') DEFAULT 'No',
  `photo_instructions` enum('','User will upload by clicking on TOOLS in MLXchange/Fusion','No photo will be taken or supplied','MLSPHOT') DEFAULT '',
  `last_image_trans_date` datetime DEFAULT NULL,
  `lpsqft_wcents` decimal(10,2) DEFAULT NULL,
  `lpsqft` decimal(10,2) DEFAULT NULL,
  `spsqft_wcents` decimal(10,2) DEFAULT NULL,
  `splp` decimal(10,2) DEFAULT NULL,
  `public_address` enum('No','Yes') DEFAULT 'No',
  `commentary` enum('No','Yes') DEFAULT 'No',
  `avm` enum('No','Yes') DEFAULT 'No',
  `documentfolderid` int(11) DEFAULT NULL,
  `documentfoldercount` tinyint(3) DEFAULT NULL,
  `record_delete_date` datetime DEFAULT NULL,
  `record_delete_flag` enum('No','Yes') DEFAULT 'No',
  `directions` varchar(170) DEFAULT NULL,
  `contingency_desc` enum('','Offer Accepted Pending Final Signatures','Short Sale Approval','Sell Buyer Property','Release of Liens','Court Approval','Inspections','Financing') DEFAULT '',
  `temp_off_mrkt_status_desc` varchar(52) DEFAULT NULL,
  `possession_description` enum('','Estimated Completion Date','Current Lease Agreement','By Agreement-CLA','Close of Escrow','Immediate') DEFAULT '',
  `statuschangedate` datetime DEFAULT NULL,
  `entry_date` datetime DEFAULT NULL,
  `acceptance_date` datetime DEFAULT NULL,
  `dom` tinyint(4) DEFAULT NULL,
  `active_dom` tinyint(4) DEFAULT NULL,
  `est_clolse_dt` datetime DEFAULT NULL,
  `actual_close_date` datetime DEFAULT NULL,
  `days_from_listing_to_close` tinyint(4) DEFAULT NULL,
  `last_transaction_code` varchar(2) DEFAULT NULL,
  `last_transaction_date` datetime DEFAULT NULL,
  `package_available` enum('No','Yes') DEFAULT 'No',
  `property_insurance` int(11) DEFAULT NULL,
  `sold_appraisal` int(11) DEFAULT NULL,
  `sold_down_payment` int(11) DEFAULT NULL,
  `earnest_deposit` int(11) DEFAULT NULL,
  `sellers_contribution` int(11) DEFAULT NULL,
  `financing_considered` varchar(84) DEFAULT NULL,
  `amt_owner_will_carry` int(11) DEFAULT NULL,
  `existing_rent` int(11) DEFAULT NULL,
  `nod_date` datetime DEFAULT NULL,
  `reporeo` enum('No','Yes') DEFAULT 'No',
  `auction_date` datetime DEFAULT NULL,
  `auction_type` enum('','Absolute','Reserve') DEFAULT '',
  `additional_au_sold_terms` varchar(12) DEFAULT NULL,
  `litigation` enum('Unknown','No','Yes') DEFAULT 'Unknown',
  `litigation_type` enum('','Construction Defect','Association','Both','Other') DEFAULT '',
  `studio_rent` tinyint(4) DEFAULT NULL,
  `cap_rate` decimal(10,3) DEFAULT NULL,
  `gross_rent_multiplier` decimal(10,3) DEFAULT NULL,
  `owner_will_carry` enum('No','Yes') DEFAULT 'No',
  `current_loan_assumable` enum('','No','Yes') DEFAULT '',
  `cash_to_assume` int(11) DEFAULT NULL,
  `cost_per_unit` int(11) DEFAULT NULL,
  `gross_operating_income` int(11) DEFAULT NULL,
  `yearly_operating_income` int(11) DEFAULT NULL,
  `tenant_pays` varchar(50) DEFAULT NULL,
  `other_income_description` varchar(60) DEFAULT NULL,
  `amount_owner_will_carry` int(11) DEFAULT NULL,
  `noi` int(11) DEFAULT NULL,
  `yearly_operating_expense` int(11) DEFAULT NULL,
  `yearly_other_income` int(11) DEFAULT NULL,
  `other_encumbrance_desc` varchar(16) DEFAULT NULL,
  `expense_source` varchar(60) DEFAULT NULL,
  `vacancy` tinyint(4) DEFAULT NULL,
  `service_contract_inc` varchar(30) DEFAULT NULL,
  `parcel_num` varchar(44) DEFAULT NULL,
  `legal_location_range` tinyint(4) DEFAULT NULL,
  `legal_lctn_range_search` tinyint(4) DEFAULT NULL,
  `legal_location_section` tinyint(4) DEFAULT NULL,
  `legal_lctn_section_search` tinyint(4) DEFAULT NULL,
  `legal_location_township` tinyint(4) DEFAULT NULL,
  `legal_lctntownship_search` tinyint(4) DEFAULT NULL,
  `tax_district` varchar(20) DEFAULT NULL,
  `assessed_imp_value` int(11) DEFAULT NULL,
  `assessed_land_value` int(11) DEFAULT NULL,
  `block_number` varchar(6) DEFAULT NULL,
  `lot_number` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property_info_additional_brokerage_details`
--

LOCK TABLES `property_info_additional_brokerage_details` WRITE;
/*!40000 ALTER TABLE `property_info_additional_brokerage_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `property_info_additional_brokerage_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `property_info_additional_brokerage_details_history`
--

DROP TABLE IF EXISTS `property_info_additional_brokerage_details_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `property_info_additional_brokerage_details_history` (
  `property_info_brokerage_details` int(11) DEFAULT NULL,
  `property_id` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `fireplace_features` varchar(255) DEFAULT NULL,
  `heating_features` varchar(255) DEFAULT NULL,
  `exterior_construction_features` varchar(255) DEFAULT NULL,
  `roofing_features` varchar(255) DEFAULT NULL,
  `interior_features` varchar(255) DEFAULT NULL,
  `exterior_features` varchar(255) DEFAULT NULL,
  `sales_history` varchar(255) DEFAULT NULL,
  `tax_history` varchar(255) DEFAULT NULL,
  `foreclosure` varchar(255) DEFAULT NULL,
  `short_sale` varchar(255) DEFAULT NULL,
  `page_link` varchar(255) DEFAULT NULL,
  `updated_mid` varchar(255) DEFAULT NULL,
  `brokerage_mid` int(11) DEFAULT NULL,
  `mls_id` varchar(255) DEFAULT NULL,
  `pagent_name` varchar(255) DEFAULT NULL,
  `pagent_phone` varchar(255) DEFAULT NULL,
  `pagent_phone_fax` varchar(255) DEFAULT NULL,
  `pagent_phone_home` varchar(255) DEFAULT NULL,
  `pagent_phone_mobile` varchar(255) DEFAULT NULL,
  `pagent_website` varchar(255) DEFAULT NULL,
  `list_agent_public_id` int(11) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `buyer_broker_code` varchar(6) DEFAULT NULL,
  `buyer_agent_public_id` int(11) DEFAULT NULL,
  `lo_phone` varchar(12) DEFAULT NULL,
  `list_office_code` varchar(6) DEFAULT NULL,
  `owner_licensee` enum('No','Yes','Related') DEFAULT 'No',
  `realtor` enum('No','Yes') DEFAULT 'No',
  `sale_office_bonus` enum('No','Yes') DEFAULT 'No',
  `commission_excluded` enum('No','Yes') DEFAULT 'No',
  `commission_variable` enum('No','Yes') DEFAULT 'No',
  `additional_showing` varchar(55) DEFAULT NULL,
  `ladom` tinyint(5) DEFAULT NULL,
  `home_protection_plan` enum('No','Yes') DEFAULT 'No',
  `open_house_flag` tinyint(1) DEFAULT NULL,
  `list_date` datetime DEFAULT NULL,
  `list_price` int(11) DEFAULT NULL,
  `original_list_price` int(11) DEFAULT NULL,
  `pricechgdate` datetime DEFAULT NULL,
  `sale_price` int(11) DEFAULT NULL,
  `previous_price` int(11) DEFAULT NULL,
  `status_updates` varchar(25) DEFAULT NULL,
  `t_status_date` datetime DEFAULT NULL,
  `internet` enum('No','Yes') DEFAULT 'No',
  `idx` varchar(1) DEFAULT NULL,
  `images` tinyint(2) DEFAULT NULL,
  `photo_excluded` enum('No','Yes') DEFAULT 'No',
  `photo_instructions` enum('','User will upload by clicking on TOOLS in MLXchange/Fusion','No photo will be taken or supplied','MLSPHOT') DEFAULT '',
  `last_image_trans_date` datetime DEFAULT NULL,
  `lpsqft_wcents` decimal(10,2) DEFAULT NULL,
  `lpsqft` decimal(10,2) DEFAULT NULL,
  `spsqft_wcents` decimal(10,2) DEFAULT NULL,
  `splp` decimal(10,2) DEFAULT NULL,
  `public_address` enum('No','Yes') DEFAULT 'No',
  `commentary` enum('No','Yes') DEFAULT 'No',
  `avm` enum('No','Yes') DEFAULT 'No',
  `documentfolderid` int(11) DEFAULT NULL,
  `documentfoldercount` tinyint(3) DEFAULT NULL,
  `record_delete_date` datetime DEFAULT NULL,
  `record_delete_flag` enum('No','Yes') DEFAULT 'No',
  `directions` varchar(170) DEFAULT NULL,
  `contingency_desc` enum('','Offer Accepted Pending Final Signatures','Short Sale Approval','Sell Buyer Property','Release of Liens','Court Approval','Inspections','Financing') DEFAULT '',
  `temp_off_mrkt_status_desc` varchar(52) DEFAULT NULL,
  `possession_description` enum('','Estimated Completion Date','Current Lease Agreement','By Agreement-CLA','Close of Escrow','Immediate') DEFAULT '',
  `statuschangedate` datetime DEFAULT NULL,
  `entry_date` datetime DEFAULT NULL,
  `acceptance_date` datetime DEFAULT NULL,
  `dom` tinyint(4) DEFAULT NULL,
  `active_dom` tinyint(4) DEFAULT NULL,
  `est_clolse_dt` datetime DEFAULT NULL,
  `actual_close_date` datetime DEFAULT NULL,
  `days_from_listing_to_close` tinyint(4) DEFAULT NULL,
  `last_transaction_code` varchar(2) DEFAULT NULL,
  `last_transaction_date` datetime DEFAULT NULL,
  `package_available` enum('No','Yes') DEFAULT 'No',
  `property_insurance` int(11) DEFAULT NULL,
  `sold_appraisal` int(11) DEFAULT NULL,
  `sold_down_payment` int(11) DEFAULT NULL,
  `earnest_deposit` int(11) DEFAULT NULL,
  `sellers_contribution` int(11) DEFAULT NULL,
  `financing_considered` varchar(84) DEFAULT NULL,
  `amt_owner_will_carry` int(11) DEFAULT NULL,
  `existing_rent` int(11) DEFAULT NULL,
  `nod_date` datetime DEFAULT NULL,
  `reporeo` enum('No','Yes') DEFAULT 'No',
  `auction_date` datetime DEFAULT NULL,
  `auction_type` enum('','Absolute','Reserve') DEFAULT '',
  `additional_au_sold_terms` varchar(12) DEFAULT NULL,
  `litigation` enum('Unknown','No','Yes') DEFAULT 'Unknown',
  `litigation_type` enum('','Construction Defect','Association','Both','Other') DEFAULT '',
  `studio_rent` tinyint(4) DEFAULT NULL,
  `cap_rate` decimal(10,3) DEFAULT NULL,
  `gross_rent_multiplier` decimal(10,3) DEFAULT NULL,
  `owner_will_carry` enum('No','Yes') DEFAULT 'No',
  `current_loan_assumable` enum('','No','Yes') DEFAULT '',
  `cash_to_assume` int(11) DEFAULT NULL,
  `cost_per_unit` int(11) DEFAULT NULL,
  `gross_operating_income` int(11) DEFAULT NULL,
  `yearly_operating_income` int(11) DEFAULT NULL,
  `tenant_pays` varchar(50) DEFAULT NULL,
  `other_income_description` varchar(60) DEFAULT NULL,
  `amount_owner_will_carry` int(11) DEFAULT NULL,
  `noi` int(11) DEFAULT NULL,
  `yearly_operating_expense` int(11) DEFAULT NULL,
  `yearly_other_income` int(11) DEFAULT NULL,
  `other_encumbrance_desc` varchar(16) DEFAULT NULL,
  `expense_source` varchar(60) DEFAULT NULL,
  `vacancy` tinyint(4) DEFAULT NULL,
  `service_contract_inc` varchar(30) DEFAULT NULL,
  `parcel_num` varchar(44) DEFAULT NULL,
  `legal_location_range` tinyint(4) DEFAULT NULL,
  `legal_lctn_range_search` tinyint(4) DEFAULT NULL,
  `legal_location_section` tinyint(4) DEFAULT NULL,
  `legal_lctn_section_search` tinyint(4) DEFAULT NULL,
  `legal_location_township` tinyint(4) DEFAULT NULL,
  `legal_lctntownship_search` tinyint(4) DEFAULT NULL,
  `tax_district` varchar(20) DEFAULT NULL,
  `assessed_imp_value` int(11) DEFAULT NULL,
  `assessed_land_value` int(11) DEFAULT NULL,
  `block_number` varchar(6) DEFAULT NULL,
  `lot_number` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property_info_additional_brokerage_details_history`
--

LOCK TABLES `property_info_additional_brokerage_details_history` WRITE;
/*!40000 ALTER TABLE `property_info_additional_brokerage_details_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `property_info_additional_brokerage_details_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `property_info_additional_details`
--

DROP TABLE IF EXISTS `property_info_additional_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `property_info_additional_details` (
  `property_additional_detail_id` int(11) DEFAULT NULL,
  `property_id` int(11) DEFAULT NULL,
  `over_all_property` int(11) DEFAULT NULL,
  `exterior_grounds` varchar(255) DEFAULT NULL,
  `exterior_structure` varchar(255) DEFAULT NULL,
  `roof` varchar(255) DEFAULT NULL,
  `ac_system` varchar(255) DEFAULT NULL,
  `electrical_system` varchar(255) DEFAULT NULL,
  `interior_structure` varchar(255) DEFAULT NULL,
  `plumbing_system` varchar(255) DEFAULT NULL,
  `kitchen` varchar(255) DEFAULT NULL,
  `bath_sink_qty` int(11) DEFAULT NULL,
  `bath_sink_top_qty` int(11) DEFAULT NULL,
  `bath_faucets_standard_qty` int(11) DEFAULT NULL,
  `bath_faucets_upgraded_qty` int(11) DEFAULT NULL,
  `bath_medicine_cabinet_qty` int(11) DEFAULT NULL,
  `bath_wall_mirrors_qty` int(11) DEFAULT NULL,
  `bath_plas_shower_surround_qty` int(11) DEFAULT NULL,
  `bath_shower_wall_surrounds_qty` int(11) DEFAULT NULL,
  `bath_shower_doorset_qty` int(11) DEFAULT NULL,
  `bath_tub_shower_pan_qty` int(11) DEFAULT NULL,
  `bath_toilet_qty` int(11) DEFAULT NULL,
  `bath_upgraded_kitchen_cabinet_qty` int(11) DEFAULT NULL,
  `bath_stand_kitchen_cabinet_qty` int(11) DEFAULT NULL,
  `door_replace_garage_qty` int(11) DEFAULT NULL,
  `door_replace_interior_qty` int(11) DEFAULT NULL,
  `door_replace_garage_motor_qty` int(11) DEFAULT NULL,
  `door_replace_new_windows_qty` int(11) DEFAULT NULL,
  `new_water_heater_qty` int(11) DEFAULT NULL,
  `kitchen_dishwasher_qty` int(11) DEFAULT NULL,
  `kitchen_garbage_disposal_qty` int(11) DEFAULT NULL,
  `kitchen_microwave_qty` int(11) DEFAULT NULL,
  `kitchen_refridgerator_qty` int(11) DEFAULT NULL,
  `kitchen_sink_faucet_qty` int(11) DEFAULT NULL,
  `kitchen_sink_qty` int(11) DEFAULT NULL,
  `kitchen_stove_qty` int(11) DEFAULT NULL,
  `kitchen_sink_hoods_qty` int(11) DEFAULT NULL,
  `flooring_carpeting_covers_per` int(11) DEFAULT NULL,
  `floor_carpeting_covers_select` varchar(255) DEFAULT NULL,
  `floor_vinyl_covers_per` int(11) DEFAULT NULL,
  `floor_vinyl_covers_select` varchar(255) DEFAULT NULL,
  `floor_ceramic_tile_covers_per` int(11) DEFAULT NULL,
  `floor_ceramic_tile_covers_select` varchar(255) DEFAULT NULL,
  `floor_porcelain_tile_covers_per` int(11) DEFAULT NULL,
  `floor_porcelain_tile_covers_select` varchar(255) DEFAULT NULL,
  `floor_stone_tile_covers_per` int(11) DEFAULT NULL,
  `floor_stone_tile_covers_select` varchar(255) DEFAULT NULL,
  `floor_wood_pergo_covers_per` int(11) DEFAULT NULL,
  `floor_wood_pergo_covers_select` varchar(255) DEFAULT NULL,
  `floor_other_finish_covers_per` int(11) DEFAULT NULL,
  `kitchen_countertops` varchar(25) DEFAULT NULL,
  `numdenother` tinyint(3) DEFAULT NULL,
  `numloft` tinyint(3) DEFAULT NULL,
  `bath_downstairs` enum('No','Yes') DEFAULT 'No',
  `bedroom_downstairs` enum('No','Yes') DEFAULT 'No',
  `great_room` enum('No','Yes') DEFAULT 'No',
  `baths_34` tinyint(3) DEFAULT NULL,
  `full_baths` tinyint(3) DEFAULT NULL,
  `half_bath` tinyint(3) DEFAULT NULL,
  `interior_description` varchar(112) DEFAULT NULL,
  `bath_downstairs_description` varchar(20) DEFAULT NULL,
  `dining_room_description` varchar(76) DEFAULT NULL,
  `dining_room_dimensions` varchar(7) DEFAULT NULL,
  `family_room_description` varchar(86) DEFAULT NULL,
  `family_room_dimensions` varchar(7) DEFAULT NULL,
  `living_room_description` varchar(76) DEFAULT NULL,
  `living_room_dimensions` varchar(7) DEFAULT NULL,
  `master_bath_description` varchar(120) DEFAULT NULL,
  `flooring_description` varchar(78) DEFAULT NULL,
  `furnishings_description` varchar(36) DEFAULT NULL,
  `kitchen_flooring` varchar(26) DEFAULT NULL,
  `great_room_dimensions` varchar(7) DEFAULT NULL,
  `master_bedroom_description` varchar(132) DEFAULT NULL,
  `master_bedroom_dimensions` varchar(7) DEFAULT NULL,
  `bedroom_2nd_description` varchar(64) DEFAULT NULL,
  `bedroom_2nd_dimensions` varchar(7) DEFAULT NULL,
  `bedroom_3rd_description` varchar(64) DEFAULT NULL,
  `bedroom_3rd_dimensions` varchar(7) DEFAULT NULL,
  `bedroom_4th_description` varchar(64) DEFAULT NULL,
  `bedroom_4th_dimensions` varchar(7) DEFAULT NULL,
  `bedroom_5th_description` varchar(64) DEFAULT NULL,
  `bedroom_5th_dimensions` varchar(7) DEFAULT NULL,
  `num_of_loft_areas` tinyint(3) DEFAULT NULL,
  `loft_description` varchar(58) DEFAULT NULL,
  `loft_dimensions` varchar(7) DEFAULT NULL,
  `loft_dimensions_1st_floor` varchar(7) DEFAULT NULL,
  `loft_dimensions_2nd_floor` varchar(7) DEFAULT NULL,
  `unit_description` varchar(20) DEFAULT NULL,
  `miscellaneous_description` varchar(46) DEFAULT NULL,
  `pets_allowed` enum('No','Yes') DEFAULT 'No',
  `pet_description` varchar(30) DEFAULT NULL,
  `weight_limit` tinyint(3) DEFAULT NULL,
  `number_of_pets` tinyint(3) DEFAULT NULL,
  `denother_dimensions` varchar(7) DEFAULT NULL,
  `bedroom_1_1_12_bath` tinyint(3) DEFAULT NULL,
  `bedroom_1_1_bath` tinyint(3) DEFAULT NULL,
  `bedroom_1_2_bath` tinyint(3) DEFAULT NULL,
  `bedroom_1_rent` tinyint(3) DEFAULT NULL,
  `bedroom_1_num_unfurn` tinyint(3) DEFAULT NULL,
  `bedroom_2_1_12_bath` tinyint(3) DEFAULT NULL,
  `bedroom_2_1_bath` tinyint(3) DEFAULT NULL,
  `bedroom_2_2_bath` tinyint(3) DEFAULT NULL,
  `bedroom_2_rent` tinyint(4) DEFAULT NULL,
  `bedroom_2_num_unfurn` tinyint(3) DEFAULT NULL,
  `bedroom_3_1_12_bath` tinyint(3) DEFAULT NULL,
  `bedroom_3_1_bath` tinyint(3) DEFAULT NULL,
  `bedroom_3_2_bath` tinyint(3) DEFAULT NULL,
  `bedroom_3_rent` tinyint(4) DEFAULT NULL,
  `bedroom_3_num_unfurn` tinyint(3) DEFAULT NULL,
  `studio_1_12_bath` tinyint(3) DEFAULT NULL,
  `studio_1_bath` tinyint(3) DEFAULT NULL,
  `studio_2_bath` tinyint(3) DEFAULT NULL,
  `avg_sqft_amt_for_a_1_bd` tinyint(5) DEFAULT NULL,
  `avg_sqft_amt_for_a_2_bd` tinyint(5) DEFAULT NULL,
  `avg_sqft_amt_for_a_3_bd` tinyint(5) DEFAULT NULL,
  `avg_sqft_amt_for_a_stud` tinyint(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property_info_additional_details`
--

LOCK TABLES `property_info_additional_details` WRITE;
/*!40000 ALTER TABLE `property_info_additional_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `property_info_additional_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `property_info_additional_details_history`
--

DROP TABLE IF EXISTS `property_info_additional_details_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `property_info_additional_details_history` (
  `property_additional_detail_id` int(11) DEFAULT NULL,
  `property_id` int(11) DEFAULT NULL,
  `over_all_property` varchar(100) NOT NULL,
  `exterior_grounds` varchar(100) NOT NULL,
  `exterior_structure` varchar(100) NOT NULL,
  `roof` varchar(100) NOT NULL,
  `ac_system` varchar(100) NOT NULL,
  `electrical_system` varchar(100) NOT NULL,
  `interior_structure` varchar(100) NOT NULL,
  `plumbing_system` varchar(100) NOT NULL,
  `kitchen` varchar(100) NOT NULL,
  `bath_sink_qty` int(11) DEFAULT NULL,
  `bath_sink_top_qty` int(11) DEFAULT NULL,
  `bath_faucets_standard_qty` int(11) DEFAULT NULL,
  `bath_faucets_upgraded_qty` int(11) DEFAULT NULL,
  `bath_medicine_cabinet_qty` int(11) DEFAULT NULL,
  `bath_wall_mirrors_qty` int(11) DEFAULT NULL,
  `bath_plas_shower_surround_qty` int(11) DEFAULT NULL,
  `bath_shower_wall_surrounds_qty` int(11) DEFAULT NULL,
  `bath_shower_doorset_qty` int(11) DEFAULT NULL,
  `bath_tub_shower_pan_qty` int(11) DEFAULT NULL,
  `bath_toilet_qty` int(11) DEFAULT NULL,
  `bath_upgraded_kitchen_cabinet_qty` int(11) DEFAULT NULL,
  `bath_stand_kitchen_cabinet_qty` int(11) DEFAULT NULL,
  `door_replace_garage_qty` int(11) DEFAULT NULL,
  `door_replace_interior_qty` int(11) DEFAULT NULL,
  `door_replace_garage_motor_qty` int(11) DEFAULT NULL,
  `door_replace_new_windows_qty` int(11) DEFAULT NULL,
  `new_water_heater_qty` int(11) DEFAULT NULL,
  `kitchen_dishwasher_qty` int(11) DEFAULT NULL,
  `kitchen_garbage_disposal_qty` int(11) DEFAULT NULL,
  `kitchen_microwave_qty` int(11) DEFAULT NULL,
  `kitchen_refridgerator_qty` int(11) DEFAULT NULL,
  `kitchen_sink_faucet_qty` int(11) DEFAULT NULL,
  `kitchen_sink_qty` int(11) DEFAULT NULL,
  `kitchen_stove_qty` int(11) DEFAULT NULL,
  `kitchen_sink_hoods_qty` int(11) DEFAULT NULL,
  `flooring_carpeting_covers_per` int(11) DEFAULT NULL,
  `floor_carpeting_covers_select` varchar(255) DEFAULT NULL,
  `floor_vinyl_covers_per` int(11) DEFAULT NULL,
  `floor_vinyl_covers_select` varchar(255) DEFAULT NULL,
  `floor_ceramic_tile_covers_per` int(11) DEFAULT NULL,
  `floor_ceramic_tile_covers_select` varchar(255) DEFAULT NULL,
  `floor_porcelain_tile_covers_per` int(11) DEFAULT NULL,
  `floor_porcelain_tile_covers_select` varchar(255) DEFAULT NULL,
  `floor_stone_tile_covers_per` int(11) DEFAULT NULL,
  `floor_stone_tile_covers_select` varchar(255) DEFAULT NULL,
  `floor_wood_pergo_covers_per` int(11) DEFAULT NULL,
  `floor_wood_pergo_covers_select` varchar(255) DEFAULT NULL,
  `floor_other_finish_covers_per` int(11) DEFAULT NULL,
  `kitchen_countertops` varchar(25) DEFAULT NULL,
  `numdenother` tinyint(3) DEFAULT NULL,
  `numloft` tinyint(3) DEFAULT NULL,
  `bath_downstairs` enum('No','Yes') DEFAULT 'No',
  `bedroom_downstairs` enum('No','Yes') DEFAULT 'No',
  `great_room` enum('No','Yes') DEFAULT 'No',
  `baths_34` tinyint(3) DEFAULT NULL,
  `full_baths` tinyint(3) DEFAULT NULL,
  `half_bath` tinyint(3) DEFAULT NULL,
  `interior_description` varchar(112) DEFAULT NULL,
  `bath_downstairs_description` varchar(20) DEFAULT NULL,
  `dining_room_description` varchar(76) DEFAULT NULL,
  `dining_room_dimensions` varchar(7) DEFAULT NULL,
  `family_room_description` varchar(86) DEFAULT NULL,
  `family_room_dimensions` varchar(7) DEFAULT NULL,
  `living_room_description` varchar(76) DEFAULT NULL,
  `living_room_dimensions` varchar(7) DEFAULT NULL,
  `master_bath_description` varchar(120) DEFAULT NULL,
  `flooring_description` varchar(78) DEFAULT NULL,
  `furnishings_description` varchar(36) DEFAULT NULL,
  `kitchen_flooring` varchar(26) DEFAULT NULL,
  `great_room_dimensions` varchar(7) DEFAULT NULL,
  `master_bedroom_description` varchar(132) DEFAULT NULL,
  `master_bedroom_dimensions` varchar(7) DEFAULT NULL,
  `bedroom_2nd_description` varchar(64) DEFAULT NULL,
  `bedroom_2nd_dimensions` varchar(7) DEFAULT NULL,
  `bedroom_3rd_description` varchar(64) DEFAULT NULL,
  `bedroom_3rd_dimensions` varchar(7) DEFAULT NULL,
  `bedroom_4th_description` varchar(64) DEFAULT NULL,
  `bedroom_4th_dimensions` varchar(7) DEFAULT NULL,
  `bedroom_5th_description` varchar(64) DEFAULT NULL,
  `bedroom_5th_dimensions` varchar(7) DEFAULT NULL,
  `num_of_loft_areas` tinyint(3) DEFAULT NULL,
  `loft_description` varchar(58) DEFAULT NULL,
  `loft_dimensions` varchar(7) DEFAULT NULL,
  `loft_dimensions_1st_floor` varchar(7) DEFAULT NULL,
  `loft_dimensions_2nd_floor` varchar(7) DEFAULT NULL,
  `unit_description` varchar(20) DEFAULT NULL,
  `miscellaneous_description` varchar(46) DEFAULT NULL,
  `pets_allowed` enum('No','Yes') DEFAULT 'No',
  `pet_description` varchar(30) DEFAULT NULL,
  `weight_limit` tinyint(3) DEFAULT NULL,
  `number_of_pets` tinyint(3) DEFAULT NULL,
  `denother_dimensions` varchar(7) DEFAULT NULL,
  `bedroom_1_1_12_bath` tinyint(3) DEFAULT NULL,
  `bedroom_1_1_bath` tinyint(3) DEFAULT NULL,
  `bedroom_1_2_bath` tinyint(3) DEFAULT NULL,
  `bedroom_1_rent` tinyint(3) DEFAULT NULL,
  `bedroom_1_num_unfurn` tinyint(3) DEFAULT NULL,
  `bedroom_2_1_12_bath` tinyint(3) DEFAULT NULL,
  `bedroom_2_1_bath` tinyint(3) DEFAULT NULL,
  `bedroom_2_2_bath` tinyint(3) DEFAULT NULL,
  `bedroom_2_rent` tinyint(4) DEFAULT NULL,
  `bedroom_2_num_unfurn` tinyint(3) DEFAULT NULL,
  `bedroom_3_1_12_bath` tinyint(3) DEFAULT NULL,
  `bedroom_3_1_bath` tinyint(3) DEFAULT NULL,
  `bedroom_3_2_bath` tinyint(3) DEFAULT NULL,
  `bedroom_3_rent` tinyint(4) DEFAULT NULL,
  `bedroom_3_num_unfurn` tinyint(3) DEFAULT NULL,
  `studio_1_12_bath` tinyint(3) DEFAULT NULL,
  `studio_1_bath` tinyint(3) DEFAULT NULL,
  `studio_2_bath` tinyint(3) DEFAULT NULL,
  `avg_sqft_amt_for_a_1_bd` tinyint(5) DEFAULT NULL,
  `avg_sqft_amt_for_a_2_bd` tinyint(5) DEFAULT NULL,
  `avg_sqft_amt_for_a_3_bd` tinyint(5) DEFAULT NULL,
  `avg_sqft_amt_for_a_stud` tinyint(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property_info_additional_details_history`
--

LOCK TABLES `property_info_additional_details_history` WRITE;
/*!40000 ALTER TABLE `property_info_additional_details_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `property_info_additional_details_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `property_info_cron_estimated_price`
--

DROP TABLE IF EXISTS `property_info_cron_estimated_price`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `property_info_cron_estimated_price` (
  `est_id` int(11) DEFAULT NULL,
  `property_zipcode` int(11) DEFAULT NULL,
  `last_property_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property_info_cron_estimated_price`
--

LOCK TABLES `property_info_cron_estimated_price` WRITE;
/*!40000 ALTER TABLE `property_info_cron_estimated_price` DISABLE KEYS */;
/*!40000 ALTER TABLE `property_info_cron_estimated_price` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `property_info_cron_load_photo`
--

DROP TABLE IF EXISTS `property_info_cron_load_photo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `property_info_cron_load_photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mls_sysid` bigint(20) DEFAULT NULL,
  `process` int(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `process_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mls_sysid` (`mls_sysid`),
  KEY `process_at` (`process_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property_info_cron_load_photo`
--

LOCK TABLES `property_info_cron_load_photo` WRITE;
/*!40000 ALTER TABLE `property_info_cron_load_photo` DISABLE KEYS */;
/*!40000 ALTER TABLE `property_info_cron_load_photo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `property_info_details`
--

DROP TABLE IF EXISTS `property_info_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `property_info_details` (
  `property_detail_id` int(11) DEFAULT NULL,
  `property_id` int(11) DEFAULT NULL,
  `stories` varchar(255) DEFAULT NULL,
  `spa` int(11) DEFAULT NULL,
  `apt_suite` varchar(255) DEFAULT NULL,
  `amenities_stove_id` int(11) DEFAULT NULL,
  `amenities_refrigerator` int(11) DEFAULT NULL,
  `amenities_dishwasher` int(11) DEFAULT NULL,
  `amenities_washer_id` int(11) DEFAULT NULL,
  `amenities_fireplace_id` int(11) DEFAULT NULL,
  `amenities_parking_id` int(11) DEFAULT NULL,
  `amenities_microwave` int(11) DEFAULT NULL,
  `amenities_gated_community` int(11) DEFAULT NULL,
  `photo2` varchar(255) DEFAULT NULL,
  `caption2` varchar(255) DEFAULT NULL,
  `photo3` varchar(255) DEFAULT NULL,
  `caption3` varchar(255) DEFAULT NULL,
  `photo4` varchar(255) DEFAULT NULL,
  `caption4` varchar(255) DEFAULT NULL,
  `photo5` varchar(255) DEFAULT NULL,
  `caption5` varchar(255) DEFAULT NULL,
  `interior_features` varchar(255) DEFAULT NULL,
  `exterior_features` varchar(255) DEFAULT NULL,
  `first_sale_type` int(11) DEFAULT NULL,
  `second_sale_type` int(11) DEFAULT NULL,
  `property_repair_price` double DEFAULT NULL,
  `reference` varchar(255) DEFAULT NULL,
  `lot_sqft` int(11) DEFAULT NULL,
  `lot_depth` int(11) DEFAULT NULL,
  `lot_frontage` int(11) DEFAULT NULL,
  `subdivision_name_xp` varchar(30) DEFAULT NULL,
  `city` varchar(32) DEFAULT NULL,
  `town` varchar(32) DEFAULT NULL,
  `county` varchar(20) DEFAULT NULL,
  `subdivision_number` tinyint(4) DEFAULT NULL,
  `subdivision_num_search` tinyint(4) DEFAULT NULL,
  `metro_map_coor` varchar(2) DEFAULT NULL,
  `metro_map_page` tinyint(2) DEFAULT NULL,
  `metro_map_coor_xp` varchar(2) DEFAULT NULL,
  `metro_map_page_xp` tinyint(3) DEFAULT NULL,
  `add_liv_area` int(11) DEFAULT NULL,
  `total_liv_area` int(11) DEFAULT NULL,
  `mh_year_built` tinyint(4) DEFAULT NULL,
  `beds_total_poss` tinyint(2) DEFAULT NULL,
  `pool_indoor` enum('No','Yes') DEFAULT 'No',
  `spa_indoor` enum('No','Yes') DEFAULT 'No',
  `model` varchar(10) DEFAULT NULL,
  `built_desc` varchar(18) DEFAULT NULL,
  `prop_desc` varchar(128) DEFAULT NULL,
  `parking_spaces` varchar(15) DEFAULT NULL,
  `carport_type` enum('','Attached Carport','Detached Carport') DEFAULT '',
  `converted_garage` enum('No','Yes') DEFAULT 'No',
  `studio` enum('No','Yes') DEFAULT 'No',
  `condo_conversion` enum('No','Yes') DEFAULT 'No',
  `unit_desc` varchar(128) DEFAULT NULL,
  `compass_point` enum('','South','North','West','East') DEFAULT '',
  `house_faces` enum('','South','North','West','East','M','G') DEFAULT '',
  `house_views` varchar(100) DEFAULT NULL,
  `jr_high_school` varchar(32) DEFAULT NULL,
  `high_school` varchar(36) DEFAULT NULL,
  `elementary_school` varchar(32) DEFAULT NULL,
  `association_features_available` varchar(320) DEFAULT NULL,
  `association_fee_1` int(11) DEFAULT NULL,
  `association_fee_1_type` enum('','Monthly','Quarterly','Yearly','None') DEFAULT '',
  `association_name` varchar(20) DEFAULT NULL,
  `association_fee_includes` varchar(132) DEFAULT NULL,
  `assessment` enum('No','Yes') DEFAULT 'No',
  `assessment_amount` int(11) DEFAULT NULL,
  `assessment_amount_type` enum('','Quarterly','Annually','Monthly') DEFAULT '',
  `sidlid` enum('No','Yes') DEFAULT 'No',
  `sidlid_annual_amount` int(11) DEFAULT NULL,
  `sidlid_balance` int(11) DEFAULT NULL,
  `association_fee_2` int(11) DEFAULT NULL,
  `association_fee_2_type` enum('','Monthly','Quarterly','Yearly','None') DEFAULT '',
  `master_plan_fee_amount` int(11) DEFAULT NULL,
  `master_plan_fee_type` enum('','Monthly','Quarterly','Yearly','None') DEFAULT '',
  `security` varchar(60) DEFAULT NULL,
  `hoa_minimum_rental_cycle` enum('','6 Months','3 Months','Monthly','Annual','Other') DEFAULT '',
  `age_restricted_community` enum('No','Yes') DEFAULT 'No',
  `services_available_on_site` varchar(128) DEFAULT NULL,
  `on_site_staff` enum('No','Yes') DEFAULT 'No',
  `on_site_staff_includes` varchar(128) DEFAULT NULL,
  `association_phone` varchar(12) DEFAULT NULL,
  `restrictions` varchar(22) DEFAULT NULL,
  `prop_amenities_description` varchar(128) DEFAULT NULL,
  `maintenance` int(11) DEFAULT NULL,
  `management` int(11) DEFAULT NULL,
  `num_terraces` tinyint(2) DEFAULT NULL,
  `terrace_total_sqft` tinyint(5) DEFAULT NULL,
  `terrace_location` varchar(50) DEFAULT NULL,
  `storage_unit_desc` enum('','Association Owned','Leased','Owned') DEFAULT '',
  `storage_units_num` tinyint(2) DEFAULT NULL,
  `storage_unit_dim` varchar(7) DEFAULT NULL,
  `storage_secure` enum('No','Yes') DEFAULT 'No',
  `lot_description` varchar(100) DEFAULT NULL,
  `carport` tinyint(2) DEFAULT NULL,
  `parking_description` varchar(160) DEFAULT NULL,
  `fence` enum('Front Yard Fully Fenced','Property Fully Fenced','Backyard Full Fenced','Partial','None') DEFAULT 'None',
  `fence_type` varchar(60) DEFAULT NULL,
  `energy_description` varchar(72) DEFAULT NULL,
  `pool_length` tinyint(3) DEFAULT NULL,
  `pool_width` tinyint(3) DEFAULT NULL,
  `pool_description` varchar(52) DEFAULT NULL,
  `spa_description` varchar(35) DEFAULT NULL,
  `equestrian_description` varchar(37) DEFAULT NULL,
  `fall_spectacular` enum('No','Yes') DEFAULT 'No',
  `dishwasher_description` varchar(32) DEFAULT NULL,
  `disposal_included` enum('No','Yes') DEFAULT 'No',
  `refrigerator_description` varchar(24) DEFAULT NULL,
  `dryer_included` enum('No','Yes') DEFAULT 'No',
  `washer_dryer_location` varchar(43) DEFAULT NULL,
  `dryer_utilities` enum('None','Electric','LP Gas','Gas','Both') DEFAULT 'None',
  `fireplace_location` varchar(46) DEFAULT NULL,
  `court_approval` enum('No','Yes') DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property_info_details`
--

LOCK TABLES `property_info_details` WRITE;
/*!40000 ALTER TABLE `property_info_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `property_info_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `property_info_details_history`
--

DROP TABLE IF EXISTS `property_info_details_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `property_info_details_history` (
  `property_detail_id` int(11) DEFAULT NULL,
  `property_id` int(11) DEFAULT NULL,
  `stories` varchar(255) DEFAULT NULL,
  `spa` int(11) DEFAULT NULL,
  `apt_suite` varchar(255) DEFAULT NULL,
  `amenities_stove_id` int(11) DEFAULT NULL,
  `amenities_refrigerator` int(11) DEFAULT NULL,
  `amenities_dishwasher` int(11) DEFAULT NULL,
  `amenities_washer_id` int(11) DEFAULT NULL,
  `amenities_fireplace_id` int(11) DEFAULT NULL,
  `amenities_parking_id` int(11) DEFAULT NULL,
  `amenities_microwave` int(11) DEFAULT NULL,
  `amenities_gated_community` int(11) DEFAULT NULL,
  `photo2` varchar(255) DEFAULT NULL,
  `caption2` varchar(255) DEFAULT NULL,
  `photo3` varchar(255) DEFAULT NULL,
  `caption3` varchar(255) DEFAULT NULL,
  `photo4` varchar(255) DEFAULT NULL,
  `caption4` varchar(255) DEFAULT NULL,
  `photo5` varchar(255) DEFAULT NULL,
  `caption5` varchar(255) DEFAULT NULL,
  `interior_features` varchar(255) DEFAULT NULL,
  `exterior_features` varchar(255) DEFAULT NULL,
  `first_sale_type` int(11) DEFAULT NULL,
  `second_sale_type` int(11) DEFAULT NULL,
  `property_repair_price` double DEFAULT NULL,
  `reference` varchar(255) DEFAULT NULL,
  `lot_sqft` int(11) DEFAULT NULL,
  `lot_depth` int(11) DEFAULT NULL,
  `lot_frontage` int(11) DEFAULT NULL,
  `subdivision_name_xp` varchar(30) DEFAULT NULL,
  `city` varchar(32) DEFAULT NULL,
  `town` varchar(32) DEFAULT NULL,
  `county` varchar(20) DEFAULT NULL,
  `subdivision_number` tinyint(4) DEFAULT NULL,
  `subdivision_num_search` tinyint(4) DEFAULT NULL,
  `metro_map_coor` varchar(2) DEFAULT NULL,
  `metro_map_page` tinyint(2) DEFAULT NULL,
  `metro_map_coor_xp` varchar(2) DEFAULT NULL,
  `metro_map_page_xp` tinyint(3) DEFAULT NULL,
  `add_liv_area` int(11) DEFAULT NULL,
  `total_liv_area` int(11) DEFAULT NULL,
  `mh_year_built` tinyint(4) DEFAULT NULL,
  `beds_total_poss` tinyint(2) DEFAULT NULL,
  `pool_indoor` enum('No','Yes') DEFAULT 'No',
  `spa_indoor` enum('No','Yes') DEFAULT 'No',
  `model` varchar(10) DEFAULT NULL,
  `built_desc` varchar(18) DEFAULT NULL,
  `prop_desc` varchar(128) DEFAULT NULL,
  `parking_spaces` varchar(15) DEFAULT NULL,
  `carport_type` enum('','Attached Carport','Detached Carport') DEFAULT '',
  `converted_garage` enum('No','Yes') DEFAULT 'No',
  `studio` enum('No','Yes') DEFAULT 'No',
  `condo_conversion` enum('No','Yes') DEFAULT 'No',
  `unit_desc` varchar(128) DEFAULT NULL,
  `compass_point` enum('','South','North','West','East') DEFAULT '',
  `house_faces` enum('','South','North','West','East','M','G') DEFAULT '',
  `house_views` varchar(100) DEFAULT NULL,
  `jr_high_school` varchar(32) DEFAULT NULL,
  `high_school` varchar(36) DEFAULT NULL,
  `elementary_school` varchar(32) DEFAULT NULL,
  `association_features_available` varchar(320) DEFAULT NULL,
  `association_fee_1` int(11) DEFAULT NULL,
  `association_fee_1_type` enum('','Monthly','Quarterly','Yearly','None') DEFAULT '',
  `association_name` varchar(20) DEFAULT NULL,
  `association_fee_includes` varchar(132) DEFAULT NULL,
  `assessment` enum('No','Yes') DEFAULT 'No',
  `assessment_amount` int(11) DEFAULT NULL,
  `assessment_amount_type` enum('','Quarterly','Annually','Monthly') DEFAULT '',
  `sidlid` enum('No','Yes') DEFAULT 'No',
  `sidlid_annual_amount` int(11) DEFAULT NULL,
  `sidlid_balance` int(11) DEFAULT NULL,
  `association_fee_2` int(11) DEFAULT NULL,
  `association_fee_2_type` enum('','Monthly','Quarterly','Yearly','None') DEFAULT '',
  `master_plan_fee_amount` int(11) DEFAULT NULL,
  `master_plan_fee_type` enum('','Monthly','Quarterly','Yearly','None') DEFAULT '',
  `security` varchar(60) DEFAULT NULL,
  `hoa_minimum_rental_cycle` enum('','6 Months','3 Months','Monthly','Annual','Other') DEFAULT '',
  `age_restricted_community` enum('No','Yes') DEFAULT 'No',
  `services_available_on_site` varchar(128) DEFAULT NULL,
  `on_site_staff` enum('No','Yes') DEFAULT 'No',
  `on_site_staff_includes` varchar(128) DEFAULT NULL,
  `association_phone` varchar(12) DEFAULT NULL,
  `restrictions` varchar(22) DEFAULT NULL,
  `prop_amenities_description` varchar(128) DEFAULT NULL,
  `maintenance` int(11) DEFAULT NULL,
  `management` int(11) DEFAULT NULL,
  `num_terraces` tinyint(2) DEFAULT NULL,
  `terrace_total_sqft` tinyint(5) DEFAULT NULL,
  `terrace_location` varchar(50) DEFAULT NULL,
  `storage_unit_desc` enum('','Association Owned','Leased','Owned') DEFAULT '',
  `storage_units_num` tinyint(2) DEFAULT NULL,
  `storage_unit_dim` varchar(7) DEFAULT NULL,
  `storage_secure` enum('No','Yes') DEFAULT 'No',
  `lot_description` varchar(100) DEFAULT NULL,
  `carport` tinyint(2) DEFAULT NULL,
  `parking_description` varchar(160) DEFAULT NULL,
  `fence` enum('Front Yard Fully Fenced','Property Fully Fenced','Backyard Full Fenced','Partial','None') DEFAULT 'None',
  `fence_type` varchar(60) DEFAULT NULL,
  `energy_description` varchar(72) DEFAULT NULL,
  `pool_length` tinyint(3) DEFAULT NULL,
  `pool_width` tinyint(3) DEFAULT NULL,
  `pool_description` varchar(52) DEFAULT NULL,
  `spa_description` varchar(35) DEFAULT NULL,
  `equestrian_description` varchar(37) DEFAULT NULL,
  `fall_spectacular` enum('No','Yes') DEFAULT 'No',
  `dishwasher_description` varchar(32) DEFAULT NULL,
  `disposal_included` enum('No','Yes') DEFAULT 'No',
  `refrigerator_description` varchar(24) DEFAULT NULL,
  `dryer_included` enum('No','Yes') DEFAULT 'No',
  `washer_dryer_location` varchar(43) DEFAULT NULL,
  `dryer_utilities` enum('None','Electric','LP Gas','Gas','Both') DEFAULT 'None',
  `fireplace_location` varchar(46) DEFAULT NULL,
  `court_approval` enum('No','Yes') DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property_info_details_history`
--

LOCK TABLES `property_info_details_history` WRITE;
/*!40000 ALTER TABLE `property_info_details_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `property_info_details_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `property_info_history`
--

DROP TABLE IF EXISTS `property_info_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `property_info_history` (
  `property_id` int(11) DEFAULT NULL,
  `year_biult_id` int(11) DEFAULT NULL,
  `pool` int(11) DEFAULT NULL,
  `garages` int(11) DEFAULT NULL,
  `mid` int(11) DEFAULT NULL,
  `property_title` varchar(255) DEFAULT NULL,
  `house_square_footage` int(11) DEFAULT NULL,
  `lot_acreage` double DEFAULT NULL,
  `property_type` int(11) DEFAULT NULL,
  `property_price` int(11) DEFAULT NULL,
  `bathrooms` decimal(6,2) DEFAULT '0.00',
  `bedrooms` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `property_street` varchar(255) DEFAULT NULL,
  `property_state_id` int(11) DEFAULT NULL,
  `property_county_id` int(11) DEFAULT NULL,
  `property_city_id` int(11) DEFAULT NULL,
  `property_zipcode` int(11) DEFAULT NULL,
  `property_uploaded_date` varchar(255) DEFAULT NULL,
  `property_updated_date` varchar(255) DEFAULT NULL,
  `property_expire_date` varchar(255) DEFAULT NULL,
  `photo1` varchar(255) DEFAULT NULL,
  `caption1` varchar(255) DEFAULT NULL,
  `getlongitude` double DEFAULT NULL,
  `getlatitude` double DEFAULT NULL,
  `estimated_price` int(11) DEFAULT NULL,
  `percentage_depreciation_value` decimal(5,2) DEFAULT '0.00',
  `property_status` varchar(255) DEFAULT NULL,
  `user_session_id` varchar(255) DEFAULT NULL,
  `visible` varchar(255) DEFAULT NULL,
  `sub_type` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `subdivision` varchar(255) DEFAULT NULL,
  `schools` varchar(255) DEFAULT NULL,
  `community_name` varchar(255) DEFAULT NULL,
  `community_features` varchar(255) DEFAULT NULL,
  `property_fetatures` varchar(255) DEFAULT NULL,
  `mls_sysid` int(11) DEFAULT NULL,
  `street_number` int(11) DEFAULT NULL,
  `street_name` varchar(50) DEFAULT NULL,
  `building_number` tinyint(3) DEFAULT NULL,
  `location` varchar(12) DEFAULT NULL,
  `property_type_mls` varchar(22) DEFAULT NULL,
  `elevator_floor` tinyint(4) DEFAULT NULL,
  `converted_to_real_property` enum('No','Yes') DEFAULT 'No',
  `manufactured` enum('No','Yes') DEFAULT 'No',
  `ownership` varchar(25) DEFAULT NULL,
  `building_description` varchar(64) DEFAULT NULL,
  `mls_name` varchar(50) DEFAULT NULL,
  `public_remarks` varchar(1000) DEFAULT NULL,
  KEY `mls_conformity` (`mls_sysid`,`mls_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property_info_history`
--

LOCK TABLES `property_info_history` WRITE;
/*!40000 ALTER TABLE `property_info_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `property_info_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `property_info_slug`
--

DROP TABLE IF EXISTS `property_info_slug`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `property_info_slug` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `property_id` int(11) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `property_id` (`property_id`),
  KEY `slug` (`slug`),
  CONSTRAINT `FK_slug_property_info` FOREIGN KEY (`property_id`) REFERENCES `property_info` (`property_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property_info_slug`
--

LOCK TABLES `property_info_slug` WRITE;
/*!40000 ALTER TABLE `property_info_slug` DISABLE KEYS */;
/*!40000 ALTER TABLE `property_info_slug` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscription_ipn_log`
--

DROP TABLE IF EXISTS `subscription_ipn_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_ipn_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `txn_type` varchar(128) DEFAULT NULL,
  `subscr_id` varchar(128) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `custom` text,
  `process_step` text,
  `full_post` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `txn_type` (`txn_type`),
  KEY `subscr_id` (`subscr_id`),
  CONSTRAINT `fk_subscription_ipn_log_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscription_ipn_log`
--

LOCK TABLES `subscription_ipn_log` WRITE;
/*!40000 ALTER TABLE `subscription_ipn_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `subscription_ipn_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscription_plans`
--

DROP TABLE IF EXISTS `subscription_plans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_plans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_name` varchar(128) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `price_type` varchar(128) DEFAULT NULL,
  `period` varchar(128) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `service_name` (`service_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscription_plans`
--

LOCK TABLES `subscription_plans` WRITE;
/*!40000 ALTER TABLE `subscription_plans` DISABLE KEYS */;
/*!40000 ALTER TABLE `subscription_plans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscription_transactions`
--

DROP TABLE IF EXISTS `subscription_transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `site_sbsrc_id` int(11) DEFAULT NULL,
  `txn_id` varchar(256) DEFAULT NULL,
  `payment_date` datetime DEFAULT NULL,
  `txn_type` varchar(128) DEFAULT NULL,
  `subscr_id` varchar(128) DEFAULT NULL,
  `recurring` tinyint(4) DEFAULT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `payment_status` varchar(128) DEFAULT NULL,
  `payment_gross` decimal(10,2) DEFAULT NULL,
  `mc_gross` decimal(10,2) DEFAULT NULL,
  `mc_currency` varchar(128) DEFAULT NULL,
  `business` varchar(255) DEFAULT NULL,
  `payer_status` varchar(128) DEFAULT NULL,
  `payer_email` varchar(255) DEFAULT NULL,
  `receiver_email` varchar(255) DEFAULT NULL,
  `custom` text,
  `full_txn_info` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `txn_id` (`txn_id`),
  KEY `payer_email` (`payer_email`),
  KEY `fk_site_sbsrc_id` (`site_sbsrc_id`),
  KEY `site_sbsrc_id` (`payer_email`),
  CONSTRAINT `fk_site_sbsrc_id` FOREIGN KEY (`site_sbsrc_id`) REFERENCES `subscriptions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_subscription_transactions_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscription_transactions`
--

LOCK TABLES `subscription_transactions` WRITE;
/*!40000 ALTER TABLE `subscription_transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `subscription_transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscriptions`
--

DROP TABLE IF EXISTS `subscriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscriptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `trans_id` varchar(255) DEFAULT NULL,
  `subscr_id` varchar(255) DEFAULT NULL,
  `subscription_id` int(11) DEFAULT NULL,
  `payment_date` datetime DEFAULT NULL,
  `status` varchar(128) DEFAULT NULL,
  `items_count` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `updated_at` (`updated_at`),
  KEY `user_id` (`user_id`),
  KEY `subscription_id` (`subscription_id`),
  KEY `subscr_id` (`subscr_id`),
  KEY `trans_id` (`trans_id`),
  CONSTRAINT `fk_subscriptions_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `subscription_id` FOREIGN KEY (`subscription_id`) REFERENCES `subscription_plans` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscriptions`
--

LOCK TABLES `subscriptions` WRITE;
/*!40000 ALTER TABLE `subscriptions` DISABLE KEYS */;
/*!40000 ALTER TABLE `subscriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `frequency` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag`
--

LOCK TABLES `tag` WRITE;
/*!40000 ALTER TABLE `tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_alerts_messages`
--

DROP TABLE IF EXISTS `tbl_alerts_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_alerts_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `document` varchar(250) NOT NULL DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_alerts_messages`
--

LOCK TABLES `tbl_alerts_messages` WRITE;
/*!40000 ALTER TABLE `tbl_alerts_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_alerts_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_cron_market_info_zipcode`
--

DROP TABLE IF EXISTS `tbl_cron_market_info_zipcode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_cron_market_info_zipcode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `zipcode_id` int(11) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `sale` int(11) DEFAULT NULL,
  `sold` int(11) DEFAULT NULL,
  `foreclosure` int(11) DEFAULT NULL,
  `short_sales` int(11) DEFAULT NULL,
  `avg_price` double DEFAULT NULL,
  `high_ppsf` double DEFAULT NULL,
  `low_ppsf` double DEFAULT NULL,
  `avg_ppsf` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_cron_market_info_zipcode`
--

LOCK TABLES `tbl_cron_market_info_zipcode` WRITE;
/*!40000 ALTER TABLE `tbl_cron_market_info_zipcode` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_cron_market_info_zipcode` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_migration`
--

DROP TABLE IF EXISTS `tbl_migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_migration` (
  `version` varchar(255) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_migration`
--

LOCK TABLES `tbl_migration` WRITE;
/*!40000 ALTER TABLE `tbl_migration` DISABLE KEYS */;
INSERT INTO `tbl_migration` VALUES ('m000000_000000_base',1534161984),('m141029_150838_create_saved_searches_table',1534173493),('m141029_151457_create_saved_search_criteria_table',1534173493),('m141030_124918_create_saved_search_emails_table',1534173493),('m141111_090434_create_property_info_event_log_table',1534173493),('m141218_110000_create_property_info_photo',1534173493),('m141218_110331_add_index_photonew',1534173493),('m150200_113709_create_property_info',1534173493),('m150204_080000_create_cron_market_info_subdivision',1534173493),('m150204_081000_create_cron_market_info_zipcode',1534173493),('m150204_081200_create_cron_market_info_area',1534173493),('m150204_081410_create_cron_market_info_county',1534173493),('m150204_081470_create_profession_field_collection',1534173493),('m150204_081500_create_cron_market_info_state',1534173493),('m150204_084307_create_cron_market_info_city',1534173493),('m150204_084308_create_index_cron_market_info',1534173493),('m150220_103636_create_property_info_cron_estimated_price',1534173494),('m150220_103637_change_property_info_cron_estimated_price',1534173494),('m150220_103638_create_compare_estimated_price_table',1534173494),('m150223_113705_create_property_info_details_history',1534173494),('m150223_113705_create_property_info_history',1534173494),('m150229_105936_create_property_info_details',1534173494),('m150303_125251_create_table_property_info_cron_load_photo',1534173494),('m150310_080109_update_compare_estimated_price_table',1534173494),('m150318_074419_update_compare_estimated_price_table',1534173494),('m150323_113705_create_property_info_additional_details',1534173494),('m150323_113710_update_property_info_table',1534173494),('m150326_081048_update_property_info_details_table',1534173494),('m150330_070126_update_property_info_table',1534173494),('m150331_110554_update_property_info_additional_details',1534173494),('m150406_090448_create_market_trend_table',1534173494),('m150406_130109_update_compare_estimated_price_table',1534173494),('m150407_091446_create_property_info_additional_brokerage_details',1534173494),('m150407_091448_update_property_info_additional_brokerage_details',1534173495),('m150409_105936_update_property_info',1534173495),('m150410_105936_update_property_info',1534173495),('m150414_105936_update_property_info',1534173495),('m150416_105936_update_market_trend_table',1534173495),('m150420_101925_update_compare_estimated_price_table',1534173495),('m150428_091447_create_property_info_additional_brokerage_details_history',1534173495),('m150428_091448_update_property_info_additional_brokerage_details',1534173495),('m150428_110552_create_property_info_additional_details_history',1534173495),('m150428_110554_update_property_info_additional_details',1534173495),('m150428_150554_update_property_info_additional_details',1534173495),('m150429_105936_update_property_info',1534173495),('m150512_105936_update_property_info',1534173495),('m150513_105936_update_market_trend_table',1534173495),('m150519_105936_update_market_trend_table',1534173495),('m150519_105937_update_property_info',1534173495),('m150519_115936_update_market_trend_table',1534173495),('m150520_105936_update_market_trend_table',1534173495),('m150520_105937_update_property_info',1534173495),('m150604_105936_update_market_trend_table',1534173495),('m150609_105936_update_market_trend_table',1534173496),('m150618_105936_create_user_oauth_table',1534173496),('m150622_105936_update_market_trend_table',1534173496),('m150623_105936_update_market_trend_table',1534173496),('m150630_101925_update_compare_estimated_price_table',1534173496),('m150702_101925_update_compare_estimated_price_table',1534173496),('m150715_125251_create_table_property_info_slug',1534173496),('m150720_101925_create_seourl_tables',1534173496),('m150731_101925_create_blog_tables',1534246721),('m150805_091925_create_landing_table',1534246902),('m150810_150838_update_saved_searches_table',1534248239),('m150819_105936_update_market_trend_table',1534248239),('m150821_105936_update_property_info',1534248239),('m150831_105936_update_property_info',1534248239),('m150911_110838_create_ad_client_table',1534248240),('m150919_110838_update_ad_client_table',1534248240),('m150922_091925_create_ad_client_activity_table',1534248240),('m151105_083522_create_subscription_plans',1534248240),('m151105_093746_create_subscriptions',1534248240),('m151105_104601_create_subscription_transactions',1534248240),('m151105_121019_update_subscriptions',1534248668),('m151105_141744_update_subscriptions',1534248878),('m151106_105132_update_subscriptions_change_txn_id_type',1534248878),('m151106_122733_update_subscription_transactions_add_site_sbscr_id',1534248878),('m151126_110826_create_tbl_alerts_messages',1534248878),('m151126_152144_update_tbl_alerts_messages',1534248878),('m151126_153044_create_tbl_alerts_scheduled_messages',1534248878),('m151203_134554_create_indexes_for_usrs_and_users_profiles',1534252337),('m160126_104645_create_subscription_ipn_log',1534252337),('m160226_102959_create_details_map_shapes',1534253280),('m160517_082059_add_column_mls_name_in_propertyinfo',1534253280),('m160517_090602_create_multiple_index_of_mls_comformity',1534253280),('m160601_094410_add_column_mls_name_in_propertyinfohistory',1534253280),('m160601_094510_create_multiple_index_of_mls_comformity_history',1534253280),('m160729_085145_create_table_user_property_info',1534253280),('m161102_100755_add_column_publick_remarks',1534253280);
/*!40000 ALTER TABLE `tbl_migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_profiles`
--

DROP TABLE IF EXISTS `tbl_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_profiles` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(50) NOT NULL DEFAULT '',
  `firstname` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_profiles`
--

LOCK TABLES `tbl_profiles` WRITE;
/*!40000 ALTER TABLE `tbl_profiles` DISABLE KEYS */;
INSERT INTO `tbl_profiles` VALUES (1,'Admin','Administrator'),(2,'Demo','Demo');
/*!40000 ALTER TABLE `tbl_profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_profiles_fields`
--

DROP TABLE IF EXISTS `tbl_profiles_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_profiles_fields` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `varname` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `field_type` varchar(50) NOT NULL,
  `field_size` varchar(15) NOT NULL DEFAULT '0',
  `field_size_min` varchar(15) NOT NULL DEFAULT '0',
  `required` int(1) NOT NULL DEFAULT '0',
  `match` varchar(255) NOT NULL DEFAULT '',
  `range` varchar(255) NOT NULL DEFAULT '',
  `error_message` varchar(255) NOT NULL DEFAULT '',
  `other_validator` varchar(5000) NOT NULL DEFAULT '',
  `default` varchar(255) NOT NULL DEFAULT '',
  `widget` varchar(255) NOT NULL DEFAULT '',
  `widgetparams` varchar(5000) NOT NULL DEFAULT '',
  `position` int(3) NOT NULL DEFAULT '0',
  `visible` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `varname` (`varname`,`widget`,`visible`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_profiles_fields`
--

LOCK TABLES `tbl_profiles_fields` WRITE;
/*!40000 ALTER TABLE `tbl_profiles_fields` DISABLE KEYS */;
INSERT INTO `tbl_profiles_fields` VALUES (1,'lastname','Last Name','VARCHAR','50','3',1,'','','Incorrect Last Name (length between 3 and 50 characters).','','','','',1,3),(2,'firstname','First Name','VARCHAR','50','3',1,'','','Incorrect First Name (length between 3 and 50 characters).','','','','',0,3);
/*!40000 ALTER TABLE `tbl_profiles_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_property_info_event_log`
--

DROP TABLE IF EXISTS `tbl_property_info_event_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_property_info_event_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) DEFAULT NULL,
  `property_id` int(11) DEFAULT NULL,
  `run_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_property_info_event_log`
--

LOCK TABLES `tbl_property_info_event_log` WRITE;
/*!40000 ALTER TABLE `tbl_property_info_event_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_property_info_event_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_property_info_photo`
--

DROP TABLE IF EXISTS `tbl_property_info_photo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_property_info_photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `property_id` int(11) DEFAULT NULL,
  `photo2` varchar(255) DEFAULT NULL,
  `caption2` varchar(255) DEFAULT NULL,
  `photo3` varchar(255) DEFAULT NULL,
  `caption3` varchar(255) DEFAULT NULL,
  `photo4` varchar(255) DEFAULT NULL,
  `caption4` varchar(255) DEFAULT NULL,
  `photo5` varchar(255) DEFAULT NULL,
  `caption5` varchar(255) DEFAULT NULL,
  `photo6` varchar(255) DEFAULT NULL,
  `photo7` varchar(255) DEFAULT NULL,
  `photo8` varchar(255) DEFAULT NULL,
  `photo9` varchar(255) DEFAULT NULL,
  `photo10` varchar(255) DEFAULT NULL,
  `photo11` varchar(255) DEFAULT NULL,
  `photo12` varchar(255) DEFAULT NULL,
  `photo13` varchar(255) DEFAULT NULL,
  `photo14` varchar(255) DEFAULT NULL,
  `photo15` varchar(255) DEFAULT NULL,
  `photo16` varchar(255) DEFAULT NULL,
  `photo17` varchar(255) DEFAULT NULL,
  `photo18` varchar(255) DEFAULT NULL,
  `photo19` varchar(255) DEFAULT NULL,
  `photo20` varchar(255) DEFAULT NULL,
  `photo21` varchar(255) DEFAULT NULL,
  `photo22` varchar(255) DEFAULT NULL,
  `photo23` varchar(255) DEFAULT NULL,
  `photo24` varchar(255) DEFAULT NULL,
  `photo25` varchar(255) DEFAULT NULL,
  `photo26` varchar(255) DEFAULT NULL,
  `photo27` varchar(255) DEFAULT NULL,
  `photo28` varchar(255) DEFAULT NULL,
  `photo29` varchar(255) DEFAULT NULL,
  `photo30` varchar(255) DEFAULT NULL,
  `photo31` varchar(255) DEFAULT NULL,
  `photo32` varchar(255) DEFAULT NULL,
  `photo33` varchar(255) DEFAULT NULL,
  `photo34` varchar(255) DEFAULT NULL,
  `photo35` varchar(255) DEFAULT NULL,
  `photo36` varchar(255) DEFAULT NULL,
  `photo37` varchar(255) DEFAULT NULL,
  `photo38` varchar(255) DEFAULT NULL,
  `photo39` varchar(255) DEFAULT NULL,
  `photo40` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `property_id` (`property_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_property_info_photo`
--

LOCK TABLES `tbl_property_info_photo` WRITE;
/*!40000 ALTER TABLE `tbl_property_info_photo` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_property_info_photo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_saved_search_criteria`
--

DROP TABLE IF EXISTS `tbl_saved_search_criteria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_saved_search_criteria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `saved_search_id` int(11) DEFAULT NULL,
  `attr_name` varchar(255) DEFAULT NULL,
  `attr_value` text,
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_saved_search_criteria`
--

LOCK TABLES `tbl_saved_search_criteria` WRITE;
/*!40000 ALTER TABLE `tbl_saved_search_criteria` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_saved_search_criteria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_saved_search_emails`
--

DROP TABLE IF EXISTS `tbl_saved_search_emails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_saved_search_emails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `saved_search_id` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_saved_search_emails`
--

LOCK TABLES `tbl_saved_search_emails` WRITE;
/*!40000 ALTER TABLE `tbl_saved_search_emails` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_saved_search_emails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_saved_searches`
--

DROP TABLE IF EXISTS `tbl_saved_searches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_saved_searches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email_alert_freq` int(11) DEFAULT NULL,
  `expiry_date` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_saved_searches`
--

LOCK TABLES `tbl_saved_searches` WRITE;
/*!40000 ALTER TABLE `tbl_saved_searches` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_saved_searches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_session`
--

DROP TABLE IF EXISTS `tbl_session`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_session` (
  `id` char(32) NOT NULL,
  `expire` int(11) DEFAULT NULL,
  `data` longblob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_session`
--

LOCK TABLES `tbl_session` WRITE;
/*!40000 ALTER TABLE `tbl_session` DISABLE KEYS */;
INSERT INTO `tbl_session` VALUES ('e0vnp417shaj4r9msoqur88v3r',1534342158,'');
/*!40000 ALTER TABLE `tbl_session` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_user_property_info`
--

DROP TABLE IF EXISTS `tbl_user_property_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_user_property_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `user_property_status` varchar(255) NOT NULL,
  `user_property_note` varchar(255) DEFAULT NULL,
  `create_date` datetime NOT NULL,
  `last_changed_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user_property_info`
--

LOCK TABLES `tbl_user_property_info` WRITE;
/*!40000 ALTER TABLE `tbl_user_property_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_user_property_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_users`
--

DROP TABLE IF EXISTS `tbl_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `activkey` varchar(128) NOT NULL DEFAULT '',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastvisit_at` datetime DEFAULT NULL,
  `superuser` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `status` (`status`),
  KEY `superuser` (`superuser`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_users`
--

LOCK TABLES `tbl_users` WRITE;
/*!40000 ALTER TABLE `tbl_users` DISABLE KEYS */;
INSERT INTO `tbl_users` VALUES (1,'admin','21232f297a57a5a743894a0e4a801fc3','webmaster@example.com','9a24eff8c15a6a141ece27eb6947da0f','2018-08-15 12:29:24',NULL,1,1),(2,'demo','fe01ce2a7fbac8fafaed7c982a04e229','demo@example.com','099f825543f7850cc038b90aaff39fac','2018-08-15 12:29:24',NULL,0,1);
/*!40000 ALTER TABLE `tbl_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_users_profiles`
--

DROP TABLE IF EXISTS `tbl_users_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_users_profiles` (
  `user_profile_id` int(11) DEFAULT NULL,
  `mid` int(11) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `office` varchar(255) DEFAULT NULL,
  `street_address` varchar(255) DEFAULT NULL,
  `street_number` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `zipcode` int(11) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `phone_office` varchar(255) DEFAULT NULL,
  `phone_fax` varchar(255) DEFAULT NULL,
  `phone_home` varchar(255) DEFAULT NULL,
  `phone_mobile` varchar(255) DEFAULT NULL,
  `website_url` varchar(255) DEFAULT NULL,
  `tagline` varchar(255) DEFAULT NULL,
  `years_of_experience` varchar(255) DEFAULT NULL,
  `years_of_experience_text` varchar(255) DEFAULT NULL,
  `area_expertise` varchar(255) DEFAULT NULL,
  `area_expertise_text` varchar(255) DEFAULT NULL,
  `about_me` varchar(255) DEFAULT NULL,
  `upload_photo` varchar(255) DEFAULT NULL,
  `office_logo` varchar(255) DEFAULT NULL,
  `upload_logo` varchar(255) DEFAULT NULL,
  `listing_type` int(11) DEFAULT NULL,
  `payment_type` int(11) DEFAULT NULL,
  `join_date` varchar(255) DEFAULT NULL,
  `join_only_date` varchar(255) DEFAULT NULL,
  `membership_expire_date` varchar(255) DEFAULT NULL,
  `membership_subscription_date` varchar(255) DEFAULT NULL,
  `audit_expire_date` varchar(255) DEFAULT NULL,
  `profile_completion_percentage` int(11) DEFAULT NULL,
  `rating_average` double DEFAULT NULL,
  `agent_last_login` int(11) DEFAULT NULL,
  `agent_comments` varchar(255) DEFAULT NULL,
  `profile_notification` varchar(255) DEFAULT NULL,
  `website_notification` varchar(255) DEFAULT NULL,
  `listings_notification` varchar(255) DEFAULT NULL,
  `subscription` varchar(255) DEFAULT NULL,
  `timestamp` datetime DEFAULT NULL,
  KEY `membership_expire_date` (`membership_expire_date`),
  KEY `payment_type` (`payment_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_users_profiles`
--

LOCK TABLES `tbl_users_profiles` WRITE;
/*!40000 ALTER TABLE `tbl_users_profiles` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_users_profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_oauth`
--

DROP TABLE IF EXISTS `user_oauth`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_oauth` (
  `user_id` int(11) NOT NULL,
  `provider` varchar(45) NOT NULL,
  `identifier` varchar(64) NOT NULL,
  `profile_cache` text,
  `session_data` text,
  PRIMARY KEY (`provider`,`identifier`),
  UNIQUE KEY `unic_user_id_name` (`user_id`,`provider`),
  KEY `oauth_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_oauth`
--

LOCK TABLES `user_oauth` WRITE;
/*!40000 ALTER TABLE `user_oauth` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_oauth` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL DEFAULT '',
  `password` varchar(128) NOT NULL DEFAULT '',
  `email` varchar(128) NOT NULL DEFAULT '',
  `activkey` varchar(128) NOT NULL DEFAULT '',
  `createtime` int(10) NOT NULL DEFAULT '0',
  `lastvisit` int(10) NOT NULL DEFAULT '0',
  `superuser` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_username` (`username`),
  UNIQUE KEY `user_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yiiseo_main`
--

DROP TABLE IF EXISTS `yiiseo_main`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yiiseo_main` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `content` text,
  `active` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `url` (`url`),
  KEY `updated_at` (`updated_at`),
  CONSTRAINT `url` FOREIGN KEY (`url`) REFERENCES `yiiseo_url` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yiiseo_main`
--

LOCK TABLES `yiiseo_main` WRITE;
/*!40000 ALTER TABLE `yiiseo_main` DISABLE KEYS */;
/*!40000 ALTER TABLE `yiiseo_main` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yiiseo_property`
--

DROP TABLE IF EXISTS `yiiseo_property`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yiiseo_property` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `content` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `url1` (`url`),
  KEY `updated_at` (`updated_at`),
  CONSTRAINT `url1` FOREIGN KEY (`url`) REFERENCES `yiiseo_url` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yiiseo_property`
--

LOCK TABLES `yiiseo_property` WRITE;
/*!40000 ALTER TABLE `yiiseo_property` DISABLE KEYS */;
/*!40000 ALTER TABLE `yiiseo_property` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yiiseo_url`
--

DROP TABLE IF EXISTS `yiiseo_url`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yiiseo_url` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) DEFAULT NULL,
  `language` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `url` (`url`),
  KEY `updated_at` (`updated_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yiiseo_url`
--

LOCK TABLES `yiiseo_url` WRITE;
/*!40000 ALTER TABLE `yiiseo_url` DISABLE KEYS */;
/*!40000 ALTER TABLE `yiiseo_url` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-08-15 17:40:42

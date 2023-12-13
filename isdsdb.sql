-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: isdsdb
-- ------------------------------------------------------
-- Server version	8.0.34

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Category` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `csfs`
--

DROP TABLE IF EXISTS `csfs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `csfs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `HelpdeskID` int NOT NULL,
  `Responsiveness` int NOT NULL,
  `Assurance` int NOT NULL,
  `Integrity` int NOT NULL,
  `Reliability` int NOT NULL,
  `Outcome` int NOT NULL,
  `AccessToFacilities` int NOT NULL,
  `Communication` int NOT NULL,
  `OverallRating` int NOT NULL,
  `Comment` text,
  `Suggestion` text,
  `CreatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `divisions`
--

DROP TABLE IF EXISTS `divisions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `divisions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Division` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employees` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `address` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `files` (
  `id` int NOT NULL AUTO_INCREMENT,
  `HelpdeskID` int NOT NULL,
  `FileName` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `filefk_idx` (`HelpdeskID`),
  CONSTRAINT `filefk` FOREIGN KEY (`HelpdeskID`) REFERENCES `helpdesks` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `helpdesks`
--

DROP TABLE IF EXISTS `helpdesks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `helpdesks` (
  `id` int NOT NULL AUTO_INCREMENT,
  `RequestNo` varchar(45) NOT NULL,
  `CategoryID` int NOT NULL,
  `SubCategoryID` int NOT NULL,
  `PreferredSchedule` datetime DEFAULT NULL,
  `Complaint` text NOT NULL,
  `RequestedBy` int NOT NULL,
  `DateRequested` date NOT NULL,
  `RequestType` enum('ICT Helpdesk','ICT Maintenance') DEFAULT 'ICT Helpdesk',
  `ServicePriority` enum('High','Medium','Low') DEFAULT 'Medium',
  `RepairType` enum('Minor','Major') DEFAULT 'Minor',
  `RepairClassification` enum('Simple','Medium','Complex','Highly Technical') DEFAULT 'Simple',
  `AssignedStaff` int DEFAULT NULL,
  `DateReceived` date DEFAULT NULL,
  `DateScheduled` date DEFAULT NULL,
  `DatetimeStarted` datetime DEFAULT NULL,
  `DatetimeFinished` datetime DEFAULT NULL,
  `Diagnosis` text,
  `Remarks` text,
  `ServicedBy` int DEFAULT NULL,
  `ApprovedBy` int DEFAULT NULL,
  `Medium` enum('ICT System','Phone','Memo','Intercom','Email') DEFAULT 'ICT System',
  `PropertyNo` varchar(45) DEFAULT NULL,
  `Csf` enum('Pending','Done') DEFAULT 'Pending',
  `Status` enum('Open','Pending','Completed','Denied','Cancelled','Unserviceable','Pre-Repair') DEFAULT 'Open',
  `CreatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `RequestNo_UNIQUE` (`RequestNo`),
  KEY `fk2_idx` (`CategoryID`),
  KEY `fk3_idx` (`SubCategoryID`),
  KEY `fk4_idx` (`AssignedStaff`),
  KEY `fk5_idx` (`ServicedBy`),
  KEY `fk6_idx` (`ApprovedBy`),
  CONSTRAINT `fk2` FOREIGN KEY (`CategoryID`) REFERENCES `categories` (`id`),
  CONSTRAINT `fk3` FOREIGN KEY (`SubCategoryID`) REFERENCES `subcategories` (`id`),
  CONSTRAINT `fk4` FOREIGN KEY (`AssignedStaff`) REFERENCES `users` (`id`),
  CONSTRAINT `fk5` FOREIGN KEY (`ServicedBy`) REFERENCES `users` (`id`),
  CONSTRAINT `fk6` FOREIGN KEY (`ApprovedBy`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subcategories`
--

DROP TABLE IF EXISTS `subcategories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subcategories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `CategoryID` int NOT NULL,
  `SubCategory` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`,`CategoryID`),
  KEY `fk7_idx` (`CategoryID`),
  CONSTRAINT `fk7` FOREIGN KEY (`CategoryID`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(45) NOT NULL,
  `MiddleName` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `LastName` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Position` varchar(45) DEFAULT NULL,
  `Email` varchar(45) NOT NULL,
  `DateOfBirth` date DEFAULT NULL,
  `Sex` enum('Male','Female') DEFAULT NULL,
  `Address` varchar(100) NOT NULL,
  `ClientType` enum('Citizen','Business','Government') DEFAULT NULL,
  `Phone` varchar(20) NOT NULL,
  `DivisionID` int DEFAULT NULL,
  `PWD` enum('Yes','No') DEFAULT 'No',
  `Username` varchar(45) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `TempPassword` varchar(45) DEFAULT NULL,
  `Role` enum('Employee','Officer','Staff','Admin') DEFAULT 'Employee',
  `Status` enum('Available','Unavailable','Loaded') DEFAULT 'Available',
  `Activation` enum('Activated','Deactivated') DEFAULT 'Activated',
  `CreatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-12-13 16:41:32

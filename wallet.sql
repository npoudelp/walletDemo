-- MariaDB dump 10.19  Distrib 10.9.4-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: cello
-- ------------------------------------------------------
-- Server version	10.9.4-MariaDB

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
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `account` (
  `aid` int(255) NOT NULL AUTO_INCREMENT,
  `uid` int(255) DEFAULT NULL,
  `balance` int(255) NOT NULL,
  PRIMARY KEY (`aid`),
  KEY `uid` (`uid`),
  CONSTRAINT `account_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account`
--

LOCK TABLES `account` WRITE;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` VALUES
(3,3,2894),
(4,4,9010),
(5,5,100);
/*!40000 ALTER TABLE `account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accountLog`
--

DROP TABLE IF EXISTS `accountLog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accountLog` (
  `alid` int(255) NOT NULL AUTO_INCREMENT,
  `uid` int(255) DEFAULT NULL,
  `sender` varchar(255) NOT NULL,
  `receiver` varchar(255) NOT NULL,
  `amount` int(255) NOT NULL,
  `newAmount` int(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `type` varchar(10) NOT NULL,
  PRIMARY KEY (`alid`),
  KEY `uid` (`uid`),
  CONSTRAINT `accountLog_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accountLog`
--

LOCK TABLES `accountLog` WRITE;
/*!40000 ALTER TABLE `accountLog` DISABLE KEYS */;
INSERT INTO `accountLog` VALUES
(5,3,'Master','Niroj Poudel',1000,9000,'09-01-2023','11:52:26am','sent'),
(6,4,'Master','Niroj Poudel',1000,1000,'09-01-2023','11:52:26am','received'),
(7,3,'Master','niroj poudel',100,8900,'09-01-2023','02:00:34pm','sent'),
(8,4,'Master','niroj poudel',100,1100,'09-01-2023','02:00:34pm','received'),
(9,4,'Niroj Poudel','master',1100,0,'09-01-2023','02:02:18pm','sent'),
(10,3,'Niroj Poudel','master',1100,10000,'09-01-2023','02:02:18pm','received'),
(11,3,'Master','niroj poudel',100,9900,'09-01-2023','02:16:35pm','sent'),
(12,4,'Master','niroj poudel',100,100,'09-01-2023','02:16:35pm','received'),
(13,4,'Niroj Poudel','master',110,0,'09-01-2023','02:25:30pm','sent'),
(14,3,'Niroj Poudel','master',110,10000,'09-01-2023','02:25:30pm','received'),
(15,3,'Master','niroj poudel',10,9880,'09-01-2023','02:40:47pm','sent'),
(16,4,'Master','niroj poudel',10,10,'09-01-2023','02:40:47pm','received'),
(17,3,'Master','master',880,9000,'09-01-2023','02:47:21pm','sent'),
(18,3,'Master','master',880,10760,'09-01-2023','02:47:21pm','received'),
(19,3,'Master','master',1234,9526,'09-01-2023','02:49:42pm','sent'),
(20,3,'Master','master',1234,11994,'09-01-2023','02:49:42pm','received'),
(21,3,'Master','niroj poudel',10000,1994,'09-01-2023','02:51:49pm','sent'),
(22,4,'Master','niroj poudel',10000,10010,'09-01-2023','02:51:49pm','received'),
(23,3,'Master','kalyan',100,1894,'09-01-2023','03:10:15pm','sent'),
(24,5,'Master','kalyan',100,100,'09-01-2023','03:10:15pm','received'),
(25,4,'Niroj Poudel','master',1000,9010,'12-01-2023','07:49:12am','sent'),
(26,3,'Niroj Poudel','master',1000,2894,'12-01-2023','07:49:12am','received');
/*!40000 ALTER TABLE `accountLog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userLog`
--

DROP TABLE IF EXISTS `userLog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userLog` (
  `ulid` int(255) NOT NULL AUTO_INCREMENT,
  `uid` int(255) DEFAULT NULL,
  `details` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  PRIMARY KEY (`ulid`),
  KEY `uid` (`uid`),
  CONSTRAINT `userLog_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userLog`
--

LOCK TABLES `userLog` WRITE;
/*!40000 ALTER TABLE `userLog` DISABLE KEYS */;
INSERT INTO `userLog` VALUES
(12,3,'Logged in with ip : 103.104.28.218','09-01-2023','11:39:27am','City: Ilām, continent: Asia, Country: Nepal, Province: Province 1'),
(13,4,'Logged in with ip : 103.104.28.218','09-01-2023','11:46:01am','City: Ilām, continent: Asia, Country: Nepal, Province: Province 1'),
(14,4,'Logged in with ip : 103.104.28.218','09-01-2023','11:50:16am','City: Ilām, continent: Asia, Country: Nepal, Province: Province 1'),
(15,4,'Logged in with ip : 103.104.28.218','09-01-2023','11:50:20am','City: Ilām, continent: Asia, Country: Nepal, Province: Province 1'),
(16,3,'Logged in with ip : 103.104.28.218','09-01-2023','11:51:36am','City: Ilām, continent: Asia, Country: Nepal, Province: Province 1'),
(17,3,'Logged in with ip : 103.104.28.218','09-01-2023','02:00:12pm','City: Ilām, continent: Asia, Country: Nepal, Province: Province 1'),
(18,4,'Logged in with ip : 103.104.28.218','09-01-2023','02:01:01pm','City: Ilām, continent: Asia, Country: Nepal, Province: Province 1'),
(19,3,'Logged in with ip : 103.104.28.218','09-01-2023','02:49:25pm','City: Ilām, continent: Asia, Country: Nepal, Province: Province 1'),
(20,4,'Logged in with ip : 103.104.28.218','09-01-2023','02:52:18pm','City: Ilām, continent: Asia, Country: Nepal, Province: Province 1'),
(21,5,'Logged in with ip : 103.104.28.218','09-01-2023','03:09:47pm','City: Ilām, continent: Asia, Country: Nepal, Province: Province 1'),
(22,3,'Logged in with ip : 103.104.28.218','09-01-2023','03:10:00pm','City: Ilām, continent: Asia, Country: Nepal, Province: Province 1'),
(23,4,'Logged in with ip : ','12-01-2023','07:45:46am',''),
(24,3,'Logged in with ip : ','12-01-2023','07:48:46am','');
/*!40000 ALTER TABLE `userLog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `uid` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(3,'Master','Nepal','9812345678','master@master.com','$2y$10$47SHVvsH4mV7hKkhduZPy.2SQj2te8vUhNYw6Qh.u88b0FRUADneK'),
(4,'Niroj Poudel','Urlabari','9862258058','npoudelp@gmail.com','$2y$10$WbNjxmZt6S8pMJKuOwKXAOyRKdyRXi7L8uuNBP8/wLDN1M/Py2LJ2'),
(5,'kalyan','Ithari','9825341454','niro@gmail.com','$2y$10$quGKfIFIY3GNP08hjJvNrudE4YCmIq/eRkHzmYtWa21LXF0UbXr92');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-01-17 20:17:40

-- MySQL dump 10.13  Distrib 8.0.16, for macos10.14 (x86_64)
--
-- Host: localhost    Database: local
-- ------------------------------------------------------
-- Server version	8.0.16

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8mb4 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `migrations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'m0001_initial.php','2022-11-15 21:22:17');
INSERT INTO `migrations` VALUES (2,'m0002_add_password_to_user.php','2022-11-15 21:22:17');
INSERT INTO `migrations` VALUES (3,'m1668588328_user_status_default.php','2022-11-16 09:04:40');
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `password` varchar(512) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'test@prova.it','maiobarbero',0,'2022-11-16 09:05:12','12345678');
INSERT INTO `users` VALUES (3,'test2@prova.it','maiobarbero',0,'2022-11-16 09:49:53','$2y$10$8KAKadcWlJtgkYzUK3UtS.2p8ILyfwz0Zh3DRU9ruwF3F9y2khKX2');
INSERT INTO `users` VALUES (4,'test3@prova.it','maiobarbero',0,'2022-11-16 09:51:26','$2y$10$F6ZUeF5xyL9FIbhILR576.4sNcKDqBI79APGp1qOW5ceDJQI8fRni');
INSERT INTO `users` VALUES (5,'test4@prova.it','maiobarbero',0,'2022-11-16 09:52:54','$2y$10$mjRrzPJlcNgEz.RvxaajXOR2LFAF6slFZQS04o6mQ7qgy6D6tt.L6');
INSERT INTO `users` VALUES (6,'123@123.or','maiobarbero',0,'2022-11-16 09:53:55','$2y$10$rwNi1vzeWZBj2PJ.TkevEORwJ1PmkXcLr0Zkh7dtx0wSg8TlKviHK');
INSERT INTO `users` VALUES (7,'1243@123.or','maiobarbero',0,'2022-11-16 09:55:39','$2y$10$UC83J1X/oaU90T/DZ5c86.oDP7JcTRHScR113o6OwiCxa.a6uF47K');
INSERT INTO `users` VALUES (8,'123@test.it','maiobarbero',0,'2022-11-16 13:35:09','$2y$10$9bXsSNR.bov0/S2fEonGvOWJEKkewbdEk/DLdw0FcLg0KLm2j/QIu');
INSERT INTO `users` VALUES (9,'1233@test.it','maiobarbero',0,'2022-11-16 13:37:01','$2y$10$amYxT2rS6GIlijJ8.5PGFOA1L8JS64x8UkyjTUeK9IsOf98LtX5ee');
INSERT INTO `users` VALUES (10,'1233@test.it','maiobarbero',0,'2022-11-16 13:38:19','$2y$10$x5aHIJcOFbhQtZF/Y6XvXelZyWSdNZEY455b/phkXAGMiPXsqj5ou');
INSERT INTO `users` VALUES (11,'12323@test.it','maiobarbero',0,'2022-11-16 13:38:25','$2y$10$EflvK2QR263rt7j9YB0by.mbeAA/CRUwhoWEkh71Xbdr3eqZF.bx6');
INSERT INTO `users` VALUES (12,'1232d3@test.it','maiobarbero',0,'2022-11-16 13:51:02','$2y$10$Fi7zWD.ztY.WY1XVDwDzTuEpcCVTvLdZj8rlEtJgR1dYXwmGFJBBa');
INSERT INTO `users` VALUES (13,'1tt232d3@test.it','maiobarbero',0,'2022-11-16 13:51:13','$2y$10$wXHE5kHa13YSQDlJ.yXls.2If90nKEoazi3ueE2CaeHX/Y4bq.Txa');
INSERT INTO `users` VALUES (14,'1tt23rr2d3@test.it','maiobarbero',0,'2022-11-16 13:53:53','$2y$10$UJBjlgMRpp5CkYnSiuLKKO4PHPeqvAdjR0Ym6zWWaZ.s/ghf86O2K');
INSERT INTO `users` VALUES (15,'123@dewjqh.it','maiobarbero',0,'2022-11-16 13:56:15','$2y$10$QGSKjKTLCCuYO8OUex79F.z.Vb2rdrSypcjun0c7avGapNvxZ5DV2');
INSERT INTO `users` VALUES (16,'fsdfsdfsd@12232.or','fse',0,'2022-11-16 14:00:09','$2y$10$B99ybqphZbTJmxQ8m3gI6e6gosEn6ANhOAIp7BRdanMcl5wbKrmd2');
INSERT INTO `users` VALUES (17,'21321@eqwieiwq.it','maiobarbero',0,'2022-11-16 14:02:10','$2y$10$28b6SNkRjFhAN/JtCegZaOFWU2LLosZmY2t8ohjfkQQue2D48wI3S');
INSERT INTO `users` VALUES (18,'dsadasdasdaa@112.it','sdadas',0,'2022-11-16 14:09:35','$2y$10$d.s5ywrCpDahQzBK9iNR5u.q3fmWdR1vM91dViKITWbhz3SAe3AiG');
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

-- Dump completed on 2022-11-16 15:35:55

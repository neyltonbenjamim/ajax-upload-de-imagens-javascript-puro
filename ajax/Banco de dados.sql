CREATE DATABASE  IF NOT EXISTS `ajaxupload` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `ajaxupload`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: ajaxupload
-- ------------------------------------------------------
-- Server version	5.7.14

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
-- Table structure for table `imagem`
--

DROP TABLE IF EXISTS `imagem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `imagem` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `keywords` text NOT NULL,
  `img_src` char(5) NOT NULL,
  `img_nome` varchar(40) NOT NULL,
  `img_data` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imagem`
--

LOCK TABLES `imagem` WRITE;
/*!40000 ALTER TABLE `imagem` DISABLE KEYS */;
INSERT INTO `imagem` VALUES (37,'Imagem ','','05/21','8d16c233ca6ff1708e56c6719f4f5111.png','2017-05-21'),(38,'Kakashi ','','05/21','a0ac9c4527a88bd06881332e66e852b0.jpg','2017-05-21'),(39,'Imagens em HD ','imagens hd','05/21','f0e3b0d95c9bf5a6c9486f8f64158db4.jpg','2017-05-21'),(43,'Imagens em HD 4','imagens hd','05/21','b26eca59f6ea67f196af3ffee958b0a9.jpg','2017-05-21'),(42,'Imagens em HD 3','imagens hd','05/21','12d9e4e4422330e4f3f70df2b023fdf0.jpg','2017-05-21'),(41,'Imagens em HD 2','imagens hd','05/21','0e0b12d167c203130966170cb9e4246d.jpg','2017-05-21'),(40,'Imagens em HD 1','imagens hd','05/21','720d468d72b3482098f005a7b355005f.jpg','2017-05-21');
/*!40000 ALTER TABLE `imagem` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-21 23:59:29

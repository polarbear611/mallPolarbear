-- MySQL dump 10.11
--
-- Host: localhost    Database: shoppolarbear
-- ------------------------------------------------------
-- Server version	5.0.90-community-nt

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
-- Table structure for table `polarbear_admin`
--

DROP TABLE IF EXISTS `polarbear_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `polarbear_admin` (
  `id` tinyint(3) unsigned NOT NULL auto_increment,
  `username` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(60) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `polarbear_admin`
--

LOCK TABLES `polarbear_admin` WRITE;
/*!40000 ALTER TABLE `polarbear_admin` DISABLE KEYS */;
INSERT INTO `polarbear_admin` VALUES (1,'admin','21232f297a57a5a743894a0e4a801fc3',''),(4,'admin1','e00cf25ad42683b3df678c61f42c6bda','admin1@qq.com'),(3,'root','e10adc3949ba59abbe56e057f20f883e','root@qq.com');
/*!40000 ALTER TABLE `polarbear_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `polarbear_album`
--

DROP TABLE IF EXISTS `polarbear_album`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `polarbear_album` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `pId` int(10) unsigned NOT NULL,
  `albumPath` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `polarbear_album`
--

LOCK TABLES `polarbear_album` WRITE;
/*!40000 ALTER TABLE `polarbear_album` DISABLE KEYS */;
INSERT INTO `polarbear_album` VALUES (1,2,'72f5de0830e10adf511183aac9a1218f.jpg'),(2,3,'1ffe7fc02dd327b31c66fe4d727fe577.jpg'),(3,4,'5889551ae18089b2feb35296224be0e6.jpg');
/*!40000 ALTER TABLE `polarbear_album` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `polarbear_cate`
--

DROP TABLE IF EXISTS `polarbear_cate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `polarbear_cate` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `cName` varchar(30) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `polarbear_cate`
--

LOCK TABLES `polarbear_cate` WRITE;
/*!40000 ALTER TABLE `polarbear_cate` DISABLE KEYS */;
INSERT INTO `polarbear_cate` VALUES (1,'绗旇鏈數鑴?),(2,'鎵嬫満'),(3,'瀹剁敤鐢靛櫒'),(4,'绮惧搧瀹跺叿'),(6,'绮惧搧瀹跺叿');
/*!40000 ALTER TABLE `polarbear_cate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `polarbear_pro`
--

DROP TABLE IF EXISTS `polarbear_pro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `polarbear_pro` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `pName` varchar(255) NOT NULL,
  `cId` int(10) unsigned NOT NULL,
  `pSn` varchar(50) NOT NULL,
  `pNum` int(10) unsigned NOT NULL default '0',
  `mPrice` decimal(10,2) NOT NULL,
  `pPrice` decimal(10,2) NOT NULL,
  `pDesc` mediumtext,
  `pImg` varchar(255) NOT NULL,
  `pubTime` int(10) unsigned NOT NULL,
  `isShow` tinyint(1) NOT NULL default '1',
  `isHot` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `pName` (`pName`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `polarbear_pro`
--

LOCK TABLES `polarbear_pro` WRITE;
/*!40000 ALTER TABLE `polarbear_pro` DISABLE KEYS */;
INSERT INTO `polarbear_pro` VALUES (2,'DELL',1,'59182',2,'10000.00','5000.00','','',1484660971,1,0),(3,'姝槾',3,'892398427',23,'2999.00','1999.00','','',1484661243,1,0),(4,'姹熷皬鐧?,3,'1029331',32,'20.00','15.00','','',1484664629,1,0);
/*!40000 ALTER TABLE `polarbear_pro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `polarbear_user`
--

DROP TABLE IF EXISTS `polarbear_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `polarbear_user` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `sex` enum('脛脨','脜庐','卤拢脙脺') NOT NULL default '卤拢脙脺',
  `email` varchar(60) NOT NULL,
  `face` varchar(50) NOT NULL,
  `regTime` int(10) unsigned NOT NULL,
  `activeFlag` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `polarbear_user`
--

LOCK TABLES `polarbear_user` WRITE;
/*!40000 ALTER TABLE `polarbear_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `polarbear_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-01-21 21:41:33

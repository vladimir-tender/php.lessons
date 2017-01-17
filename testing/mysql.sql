-- MySQL dump 10.13  Distrib 5.5.50, for Win32 (x86)
--
-- Host: localhost    Database: testing
-- ------------------------------------------------------
-- Server version	5.5.50

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
-- Table structure for table `test`
--

DROP TABLE IF EXISTS `test`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `question` varchar(255) DEFAULT NULL,
  `ans1` varchar(255) DEFAULT NULL,
  `ans2` varchar(255) DEFAULT NULL,
  `ans3` varchar(255) DEFAULT NULL,
  `ans4` varchar(255) DEFAULT NULL,
  `ans5` varchar(255) DEFAULT NULL,
  `vote1` int(11) NOT NULL DEFAULT '0',
  `vote2` int(11) NOT NULL DEFAULT '0',
  `vote3` int(11) NOT NULL DEFAULT '0',
  `vote4` int(11) NOT NULL DEFAULT '0',
  `vote5` int(11) NOT NULL DEFAULT '0',
  `ips` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test`
--

LOCK TABLES `test` WRITE;
/*!40000 ALTER TABLE `test` DISABLE KEYS */;
INSERT INTO `test` VALUES (1,'3а обедом вы сядете рядом с шефом или с несимпатичным вам человеком?','С начальником','Пообедую позже','Рядом с тем человеком',NULL,NULL,0,0,0,0,0,''),(2,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,0,0,''),(3,'Вам поручили задание и ваш шеф, и директор. Как вы поступите?','Сделаю все по порядку','Обращусь к шефу','Займусь новым заданием',NULL,NULL,0,0,0,0,0,''),(4,'Вам не удалось выполнить работу в срок, как будете улаживать это ?','Поставлю в известность шефа','Умру, но сделаю в срок!','Пусть улаживает начальство','Другое','Третье',0,0,0,0,0,''),(5,'Между вами и одним из коллег произошла ссора. Как вы себя поведете?','Перестану разговаривать','Не обращу внимание','Буду выяснять отношения','Еще одно','Еще второе',0,0,0,0,0,''),(6,'Вы случайно узнали о любовной связи шефа с секретаршей. Вы:','Поделитесь этим с коллегами','Сохраните в тайне','Забудете','Запомните','Запишите',0,0,0,0,0,''),(7,'Как по-вашему, что необходимо для продвижения по служебной лестнице?','Труд и интеллект','Протекция','Личное обаяние','Любвеобилие','Целеустремленность',0,0,0,0,0,'');
/*!40000 ALTER TABLE `test` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-01-04 14:39:37

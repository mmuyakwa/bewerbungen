-- TABLE-INFO
-- TABLE|uebersicht|23|16384||InnoDB
-- EOF TABLE-INFO
--
-- Dump by MySQLDumper 1.24.4 (http://mysqldumper.net)
/*!40101 SET NAMES 'utf8' */;
SET FOREIGN_KEY_CHECKS=0;
-- Dump created: 2019-11-23 13:02

--
-- Create Table `uebersicht`
--

DROP TABLE IF EXISTS `uebersicht`;
CREATE TABLE `uebersicht` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firma` varchar(100) COLLATE utf8_bin NOT NULL,
  `adresse` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `tel` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `bemerkungen` varchar(1000) COLLATE utf8_bin DEFAULT NULL,
  `webseite` varchar(400) COLLATE utf8_bin DEFAULT NULL,
  `beworben` int(11) DEFAULT NULL,
  `absage` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Data for Table `uebersicht`
--

SET FOREIGN_KEY_CHECKS=1;
-- EOB


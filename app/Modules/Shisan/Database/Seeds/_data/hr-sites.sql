# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.24-0ubuntu0.12.04.1)
# Database: hr
# Generation Time: 2015-02-03 18:28:55 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table sites
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sites`;

CREATE TABLE `sites` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `primary_phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `secondary_phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zipcode` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `logo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT '1',
  `division_id` int(11) DEFAULT NULL,
  `ad_code` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bld_number` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status_id` int(11) NOT NULL DEFAULT '1',
  `notes` text COLLATE utf8_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `sites` WRITE;
/*!40000 ALTER TABLE `sites` DISABLE KEYS */;

INSERT INTO `sites` (`id`, `name`, `email`, `primary_phone`, `secondary_phone`, `website`, `address`, `city`, `state`, `zipcode`, `logo`, `user_id`, `division_id`, `ad_code`, `bld_number`, `status_id`, `notes`, `deleted_at`, `created_at`, `updated_at`)
VALUES
	(1,'Administration Building',NULL,'847-5600',NULL,'bryantschools.org','350 School Drive','Bryant','Arkansas',NULL,'admin.JPG',1,1,'ADMIN','26',1,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(2,'Bryant Elementary School',NULL,'847-5642',NULL,'bryantschools.org','412 Woodland Drive','Bryant','Arkansas',NULL,'admin.JPG',1,3,'BES','',1,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(3,'Collegeville Elementary School',NULL,'847-5670',NULL,'bryantschools.org','4818 Highway 5 north','Bryant','Arkansas',NULL,'admin.JPG',1,3,'CES','',1,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(4,'Davis Elementary School',NULL,'455-5672',NULL,'bryantschools.org','12001 Country Line Road','Bryant','Arkansas',NULL,'admin.JPG',1,3,'DES','',1,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(5,'Hill Farm Elementary School',NULL,'653-5950',NULL,'bryantschools.org','500 Hill Farm Road','Bryant','Arkansas',NULL,'admin.JPG',1,3,'HFES','',1,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(6,'Hurricane Creek Elementary School',NULL,'653-1012',NULL,'bryantschools.org','6091 Alcoa Road','Bryant','Arkansas',NULL,'admin.JPG',1,3,'HCES','',1,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(7,'Paron Elementary School',NULL,'594-5622',NULL,'bryantschools.org','22265 Highway 9','Bryant','Arkansas',NULL,'admin.JPG',1,3,'PES','',1,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(8,'Salem Elementary School',NULL,'316-0263',NULL,'bryantschools.org','2701 Salem Road','Bryant','Arkansas',NULL,'admin.JPG',1,3,'SES','',1,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(9,'Springhill Elementary School',NULL,'847-5675',NULL,'bryantschools.org','2716 Northlake Road','Bryant','Arkansas',NULL,'admin.JPG',1,3,'SPES','',1,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(10,'Bryant Middle School',NULL,'847-5651',NULL,'bryantschools.org','310 School Drive','Bryant','Arkansas',NULL,'admin.JPG',1,4,'BMS','',1,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(11,'Bethel Middle School',NULL,'316-0937',NULL,'bryantschools.org','5415 Northlake Road','Bryant','Arkansas',NULL,'admin.JPG',1,4,'BEMS','',1,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(12,'Bryant High School',NULL,'847-5605',NULL,'bryantschools.org','801 North Reynolds Road','Bryant','Arkansas',NULL,'admin.JPG',1,5,'BHS','',1,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(13,'District',NULL,'',NULL,'bryantschools.org','','Bryant','Arkansas',NULL,'admin.JPG',1,1,'DIST','',1,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(14,'Second Chance Ranch',NULL,'',NULL,'bryantschools.org','','Bryant','Arkansas',NULL,'admin.JPG',1,1,'SCR','',1,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00');

/*!40000 ALTER TABLE `sites` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

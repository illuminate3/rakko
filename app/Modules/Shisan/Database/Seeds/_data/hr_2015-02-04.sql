# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.24-0ubuntu0.12.04.1)
# Database: hr
# Generation Time: 2015-02-04 21:08:04 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table divisions
# ------------------------------------------------------------

LOCK TABLES `divisions` WRITE;
/*!40000 ALTER TABLE `divisions` DISABLE KEYS */;

INSERT INTO `divisions` (`id`, `name`, `description`, `deleted_at`, `created_at`, `updated_at`)
VALUES
	(1,'District','District',NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(2,'Kindergarten','Kindergarten',NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(3,'Elementary School','Elementary School',NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(4,'Middle School','Middle School',NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(5,'High School','High School',NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00');

/*!40000 ALTER TABLE `divisions` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

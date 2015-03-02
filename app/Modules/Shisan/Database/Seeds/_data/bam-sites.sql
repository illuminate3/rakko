# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.30-1~dotdeb.0)
# Database: bam
# Generation Time: 2015-02-03 18:28:32 +0000
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

LOCK TABLES `sites` WRITE;
/*!40000 ALTER TABLE `sites` DISABLE KEYS */;

INSERT INTO `sites` (`id`, `name`, `description`, `principal_sg`, `teacher_sg`, `student_sg`, `created_at`, `updated_at`)
VALUES
	(1,'Technology','Technology department','TechSystemAdmins','TechTeam','Temp','2013-02-07 15:31:03','2013-05-23 10:25:42'),
	(2,'BHS','Bryant High School','BHS Principals','BHS Teachers','BHS Students','2013-02-07 15:31:22','2013-05-23 14:41:57'),
	(3,'BEMS','Bethel Middle School','BEMS Principals','BEMS Teachers','BEMS Students','2013-02-07 15:33:17','2013-05-23 14:42:15'),
	(4,'BES','Bryant Elementary School','BES Principals','BES Teachers','BES Students','2013-02-07 15:33:44','2013-05-23 14:43:40'),
	(5,'BMS','Bryant Middle School','BMS Principals','BMS Teachers','BMS Students','2013-02-07 15:34:08','2013-05-23 14:45:09'),
	(6,'CES','Collegeville Elementary School','CES Principals','CES Teachers','CES Students','2013-02-07 15:34:52','2013-05-23 14:44:47'),
	(7,'DES','Davis Elementary School','DES Principals','DES Teachers','DES Students','2013-02-07 15:35:20','2013-05-23 14:44:24'),
	(8,'HFES','Hill Farm Elementary School','HFES Principals','HFES Teachers','HFES Students','2013-02-07 15:35:43','2013-05-23 14:41:40'),
	(9,'HCES','Hurricane Creek Elementary School','HCES Principals','HCES Teachers','HCES Students','2013-02-07 15:36:03','2013-05-23 14:44:09'),
	(10,'PES','Paron Elementary School','PES Principals','PES Teachers','PES Students','2013-02-07 15:36:28','2013-05-23 14:43:54'),
	(11,'SES','Salem Elementary School','SES_Principals','SESTeachers','sesstudents_SG','2013-02-07 15:36:49','2013-02-07 15:36:49'),
	(12,'SPES','Spring Hill Elementary School','SPES_Principals','SPESTeachers','spesstudents_SG','2013-02-07 15:37:27','2013-02-07 15:37:27'),
	(13,'In Repair','Assets located in Technology for repair.','TechSystemAdmins','TechTeam','SUMMERHELP_SG','2013-04-01 09:34:06','2013-04-01 09:34:06'),
	(14,'Disposal','Disposed assets.','/','/','/','2013-04-01 10:04:18','2013-04-01 10:04:18'),
	(15,'Transportation / Maintenance','Transportation / Maintenance','Transportation_SG','Employee','-','2013-04-08 08:10:33','2014-07-10 14:00:30'),
	(16,'Second Chance Ranch','Second Chance Ranch','/','/','/','2013-04-29 09:13:22','2013-04-29 09:13:22'),
	(17,'Administration','Administration','Administration_SG','Employee','/','2013-05-08 10:37:14','2013-05-08 10:37:14'),
	(18,'Technology  Check Out','Technology Dept','TechSystemAdmins','TechTeam','Temp','2013-05-29 15:24:57','2013-05-29 15:24:57'),
	(19,'Recycle','Recycle Assets','/','/','/','2013-06-10 14:07:25','2013-06-10 14:07:25'),
	(20,'SPED','SPED Bldg. 600','SPED_Principals','SPED_Teachers','SPED_Students','2013-08-22 12:31:45','2013-08-22 12:31:45'),
	(21,'Replacement','Sent Back to Company for Replacement','/','/','/','2013-11-04 09:39:43','2013-11-04 09:39:43'),
	(22,'Athletic Department','Athletics','Athletic_sg','/','/','2013-11-14 16:59:57','2013-11-14 17:02:07'),
	(23,'600','GTE and SPED Building','600_Principals','600_Teachers','600_Students','2014-04-17 12:50:57','2014-04-17 12:50:57'),
	(24,'Parent Center','Bldg. # 34','Parent Center_sg','Teacher_sg','Student_sg','2014-05-19 11:18:03','2014-05-19 11:18:03'),
	(25,'ESL','English as a Second Language','ESL Admin','ESL Teachers','ESL Students','2014-05-27 09:54:12','2014-05-27 09:54:12'),
	(26,'Returned Equipment','Equipment that has been returned to the company: wrong merchandise sent, damaged in shipment etc.','/','/','/','2014-08-21 14:11:38','2014-08-21 14:11:38'),
	(27,'Food Service ','Cafeteria','FoodService Admin','Foodservice Workers ','Foodservice Students','2014-09-16 13:19:56','2014-09-16 13:20:41'),
	(28,'PLACE','PLACE Bldg. # 601','PLACE_Principal','PLACE_Teacher','PLACE_Student','2014-10-21 12:54:59','2014-10-21 12:54:59');

/*!40000 ALTER TABLE `sites` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

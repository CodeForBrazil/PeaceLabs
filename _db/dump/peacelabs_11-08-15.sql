# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Hôte: 127.0.0.1 (MySQL 5.6.10)
# Base de données: peacelabs
# Temps de génération: 2015-08-11 13:43:44 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Affichage de la table activity
# ------------------------------------------------------------

DROP TABLE IF EXISTS `activity`;

CREATE TABLE `activity` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL DEFAULT '',
  `description` text,
  `image` int(11) DEFAULT NULL COMMENT 'media.id',
  `group` int(11) DEFAULT NULL COMMENT 'group.id',
  `privacy` int(11) DEFAULT NULL,
  `owner` int(11) NOT NULL COMMENT 'user.id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Affichage de la table activity_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `activity_user`;

CREATE TABLE `activity_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `activity_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `comment` text,
  PRIMARY KEY (`id`),
  KEY `activity_user` (`activity_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Affichage de la table media
# ------------------------------------------------------------

DROP TABLE IF EXISTS `media`;

CREATE TABLE `media` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `public_id` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Affichage de la table user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varbinary(255) DEFAULT NULL,
  `avatar` int(11) DEFAULT NULL COMMENT 'media.id',
  `bio` text,
  `city` varchar(256) DEFAULT NULL,
  `alias` varchar(64) DEFAULT NULL,
  `roles` int(11) NOT NULL DEFAULT '0',
  `confirmation` varchar(32) DEFAULT NULL,
  `dateadd` datetime DEFAULT NULL,
  `dateupdate` datetime DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

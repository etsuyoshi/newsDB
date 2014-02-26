/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# テーブルのダンプ blogs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `blogs`;

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `url` text,
  `rss_url` text,
  `saveddate` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `blogs` WRITE;
/*!40000 ALTER TABLE `blogs` DISABLE KEYS */;

INSERT INTO `blogs` (`id`, `name`, `url`, `rss_url`, `saveddate`)
VALUES
	(1,'はてなブックマーク','http://b.hatena.ne.jp/hotentry','http://b.hatena.ne.jp/entrylist?sort=hot&threshold=100&mode=rss','2014-02-06 22:05:44'),
	(2,'ロイター(トップニュース)','http://jp.reuters.com/','http://feeds.reuters.com/reuters/JPTopNews','2014-02-06 22:39:38'),
	(3,'日本経済新聞','http://www.nikkeibp.co.jp/rss/index.rdf','http://feed.nikkeibp.co.jp/rss/nikkeibp/subject.rdf','2014-02-06 22:05:25'),
	(4,'Googleニュース','https://news.google.co.jp/','http://news.google.com/news?hl=ja&ned=us&ie=UTF-8&oe=UTF-8&output=rss','2014-02-06 20:57:29'),
	(5,'Techable','http://techable.jp/','http://techable.jp/feed','2014-02-06 21:03:01');

/*!40000 ALTER TABLE `blogs` ENABLE KEYS */;
UNLOCK TABLES;


# テーブルのダンプ rss
# ------------------------------------------------------------

DROP TABLE IF EXISTS `rss`;

CREATE TABLE `rss` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datetime` datetime DEFAULT NULL,
  `blog_id` int(11) NOT NULL,
  `title` text,
  `url` text,
  `description` text,
  `body` text,
  `hatebu` int(11) DEFAULT NULL,
  `saveddate` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

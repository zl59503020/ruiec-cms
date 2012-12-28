# Host: localhost  (Version: 5.5.24-log)
# Date: 2012-12-28 18:02:05
# Generator: MySQL-Front 5.3  (Build 1.20)

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE */;
/*!40101 SET SQL_MODE='' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES */;
/*!40103 SET SQL_NOTES='ON' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

DROP DATABASE IF EXISTS `ruieccms`;
CREATE DATABASE `ruieccms` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `ruieccms`;

#
# Source for table "ruiec_404"
#

DROP TABLE IF EXISTS `ruiec_404`;
CREATE TABLE `ruiec_404` (
  `itemid` int(11) NOT NULL AUTO_INCREMENT,
  `surl` varchar(255) DEFAULT NULL COMMENT '来源路径',
  `furl` varchar(255) NOT NULL DEFAULT '' COMMENT '访问路径',
  `username` varchar(255) DEFAULT NULL COMMENT '用户名',
  `addtime` varchar(255) DEFAULT NULL COMMENT '操作时间',
  `ip` varchar(255) DEFAULT NULL COMMENT '操作IP地址',
  `userAgent` varchar(500) DEFAULT NULL COMMENT '用户代理信息',
  PRIMARY KEY (`itemid`)
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8 COMMENT='404记录日志表';

#
# Data for table "ruiec_404"
#

INSERT INTO `ruiec_404` VALUES (3,'http://www.baidu.com/','http://192.168.1.3/demo/artDialog/_doc/new.html','Guest','1354926823','192.168.1.3','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML,Google) Chrome/23.0.1271.95 Safari/537.11'),(11,'http://bbs.csdn.net/topics/360015963','http://localhost/fenzhi/index.php?sk=1251931143xg','Guest','1355541157','127.0.0.1','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11'),(12,'','http://192.168.1.3/news.php','Guest','1355725067','192.168.1.88','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11'),(13,'http://192.168.1.3/news/list.php?catid=7','http://192.168.1.3/scripts/jquery/jquery-1.3.2.min.js','Guest','1355726118','192.168.1.88','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11'),(14,'http://192.168.1.3/news/list.php?catid=7','http://192.168.1.3/templates/green/js/base.js','Guest','1355726118','192.168.1.88','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11'),(15,'http://192.168.1.3/news/list.php?catid=7','http://192.168.1.3/skin/images/body_bg.gif','Guest','1355726118','192.168.1.88','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11'),(16,'http://192.168.1.3/news/list.php?catid=7','http://192.168.1.3/skin/images/logo.png','Guest','1355726118','192.168.1.88','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11'),(17,'http://192.168.1.3/news/list.php?catid=7','http://192.168.1.3/file/JavaScript/templates/green/js/base.js','Guest','1355726598','192.168.1.88','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11'),(18,'http://192.168.1.3/news/list.php?catid=7','http://192.168.1.3/skin/images/gotop.gif','Guest','1355726614','192.168.1.88','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11'),(19,'http://192.168.1.3/news/','http://192.168.1.3/skin/dt/images/gotop.gif','Guest','1355726842','192.168.1.88','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11'),(20,'http://192.168.1.3/news/','http://192.168.1.3/skin/dt/images/logo.png','Guest','1355726901','192.168.1.88','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11'),(21,'http://192.168.1.3/news/','http://192.168.1.3/skin/dt/layout.css','Guest','1355728195','192.168.1.88','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11'),(22,'http://192.168.1.3/news/','http://192.168.1.3/skin/dt/base.css','Guest','1355728195','192.168.1.88','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11'),(23,'http://192.168.1.3/admin.php?file=comment&mid=18','http://192.168.1.3/skin/dt/image/messagebg.gif','Guest','1355729294','192.168.1.3','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11'),(24,'http://192.168.1.3/admin.php?file=comment&mid=18','http://192.168.1.3/skin/dt/image/message.gif','Guest','1355729294','192.168.1.3','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11'),(25,'http://192.168.1.3/news/','http://192.168.1.3/skin/images/icon_arrow_blue.gif','Guest','1355729427','192.168.1.88','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11'),(26,'http://192.168.1.3/news/','http://192.168.1.3/skin/images/sprite.gif','Guest','1355729427','192.168.1.88','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11'),(27,'http://192.168.1.3/news/','http://192.168.1.3/upload/201210/22/201210221025591061.jpg','Guest','1355729427','192.168.1.88','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11'),(28,'http://192.168.1.3/news/','http://192.168.1.3/skin/dt/images/sprite.gif','Guest','1355730083','192.168.1.88','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11'),(29,'http://192.168.1.3/news/','http://192.168.1.3/news/show-75.aspx','Guest','1355730843','192.168.1.3','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11'),(30,'http://192.168.1.3/news/','http://192.168.1.3/news/6/2.aspx','Guest','1355793176','192.168.1.3','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11'),(31,'http://xlissue110.sandai.net','http://xlissue110.sandai.net/s1347247336281.thunderaddin?fid=4N8BRCNrO5G1YcoKPJKQFJJayA2QngEAAAAAAI15NEawgHXQIP/o4ZtRfNotzXmF&mid=666&threshold=150&tid=DCB1C11BAF4D82325048077F86DFC0FC&srcid=0','Guest','1355796648','127.0.0.1','Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.1; Trident/6.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; .NET4.0C; .NET4.0E)'),(32,'http://xlissue110.sandai.net','http://xlissue110.sandai.net/s1353665194427.thunderaddin?fid=Lzi35MXjl3xPwMOvSv11onr03G1wUAQAAAAAADCC5w1aL06X2UQPZkHLcFT2CLyy&mid=666&threshold=150&tid=42A7ABA78012EF9402F36943C0C0B312&srcid=0','Guest','1355796664','127.0.0.1','Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.1; Trident/6.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; .NET4.0C; .NET4.0E)'),(33,'http://xlissue110.sandai.net','http://xlissue110.sandai.net/s1351593699227.thunderaddin?fid=wDzq5FnLhG3d7FNZ8PH9U3MzGSRwRyAAAAAAAGLoTfyyFakpJ+1uYHjdmkSjyTRs&mid=666&threshold=150&tid=9BF80DC09CC9ACC76F5D4FFE5B5CC2E3&srcid=0','Guest','1355796684','127.0.0.1','Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.1; Trident/6.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; .NET4.0C; .NET4.0E)'),(34,'http://xlissue110.sandai.net','http://xlissue110.sandai.net/s1354010268477.thunderaddin?fid=7DZHaIwOmkpPUYwKoXtDS7HK0L3IXRwAAAAAAKksKHrgMyGvv4+a+SLH6QFMFFwb&mid=666&threshold=150&tid=B2C7167061188DF092BB8D00ADCF3298&srcid=0','Guest','1355796700','127.0.0.1','Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.1; Trident/6.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; .NET4.0C; .NET4.0E)'),(35,'http://xlissue110.sandai.net','http://xlissue110.sandai.net/R_XMPSetup_4.9.5.1331-recommend.exe?fid=VPVzdOb/rXaW70gOiAQeuRuWbSvQV0QCAAAAAM/ZTFrtR/dq1VYHy8e58Eamucvv&mid=666&threshold=150&tid=0AABF7528D36F73154824B35D872D952&srcid=0','Guest','1355811486','127.0.0.1','Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.1; Trident/6.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; .NET4.0C; .NET4.0E)'),(36,'','http://192.168.1.3/robots.txt','Guest','1355812125','192.168.1.88','Mozilla/5.0 (Windows NT 6.2; rv:17.0) Gecko/20100101 Firefox/17.0'),(37,'','http://192.168.1.3/sitemap.xml','Guest','1355812128','192.168.1.88','Mozilla/5.0 (Windows NT 6.2; rv:17.0) Gecko/20100101 Firefox/17.0'),(38,'http://192.168.1.3/news/','http://192.168.1.3/skin/dt/images/icon_arrow_blue.gif','Guest','1355813766','192.168.1.88','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11'),(39,'http://192.168.1.3/news/list.php?catid=7','http://192.168.1.3/skin/dt/base.css','Guest','1355815172','192.168.1.88','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11'),(40,'http://192.168.1.3/news/list.php?catid=7','http://192.168.1.3/skin/dt/layout.css','Guest','1355815172','192.168.1.88','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11'),(41,'http://192.168.1.3/news/','http://192.168.1.3/upload/201210/22/201210221025591061.jpg','Guest','1355815887','192.168.1.88','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11'),(42,'http://192.168.1.3/news/','http://192.168.1.3/upload/201210/20/201210201343435821.jpg','Guest','1355817207','192.168.1.88','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11'),(43,'http://192.168.1.3/news/','http://192.168.1.3/skin/images/dot.gif','Guest','1355817207','192.168.1.88','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11'),(44,'http://192.168.1.3/news/list.php?catid=19','http://192.168.1.3/skin/dt/image/messagebg.gif','Guest','1355819026','192.168.1.3','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11'),(45,'http://192.168.1.3/news/list.php?catid=19','http://192.168.1.3/skin/dt/image/message.gif','Guest','1355819026','192.168.1.3','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11'),(46,'http://192.168.1.3/news/show.php?itemid=17','http://192.168.1.3/skin/images/newdigg-bg.png','Guest','1355821143','192.168.1.88','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11'),(47,'http://192.168.1.3/news/','http://192.168.1.3/news/6.aspx','Guest','1355823403','192.168.1.88','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11'),(48,'http://192.168.1.3/admin.php','http://192.168.1.3/fileid=list&dir=article','Guest','1355824526','192.168.1.88','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11'),(49,'http://192.168.1.3/news/list.php?catid=7&page=2','http://192.168.1.3/news/1','Guest','1355880638','192.168.1.3','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11'),(50,'http://xlissue110.sandai.net','http://xlissue110.sandai.net/s1347247336281.thunderaddin?fid=4N8BRCNrO5G1YcoKPJKQFJJayA2QngEAAAAAAI15NEawgHXQIP/o4ZtRfNotzXmF&mid=666&threshold=150&tid=DCB1C11BAF4D82325048077F86DFC0FC&srcid=0','Guest','1355897974','127.0.0.1','Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.1; Trident/6.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; .NET4.0C; .NET4.0E)'),(51,'http://xlissue110.sandai.net','http://xlissue110.sandai.net/s1355385505263.thunderaddin?fid=Nxg6Bd71WL88Nm1KqYnAwEiFXsYgVAQAAAAAAHByAEtZRPEFuRq9bCqcX2FWNQJE&mid=666&threshold=150&tid=701F680DDDEB90B648182C437892AD0A&srcid=0','Guest','1355897984','127.0.0.1','Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.1; Trident/6.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; .NET4.0C; .NET4.0E)'),(52,'http://xlissue110.sandai.net','http://xlissue110.sandai.net/s1351593699227.thunderaddin?fid=wDzq5FnLhG3d7FNZ8PH9U3MzGSRwRyAAAAAAAGLoTfyyFakpJ+1uYHjdmkSjyTRs&mid=666&threshold=150&tid=9BF80DC09CC9ACC76F5D4FFE5B5CC2E3&srcid=0','Guest','1355897994','127.0.0.1','Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.1; Trident/6.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; .NET4.0C; .NET4.0E)'),(53,'http://xlissue110.sandai.net','http://xlissue110.sandai.net/s1354010268477.thunderaddin?fid=7DZHaIwOmkpPUYwKoXtDS7HK0L3IXRwAAAAAAKksKHrgMyGvv4+a+SLH6QFMFFwb&mid=666&threshold=150&tid=B2C7167061188DF092BB8D00ADCF3298&srcid=0','Guest','1355898008','127.0.0.1','Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.1; Trident/6.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; .NET4.0C; .NET4.0E)'),(54,'','http://192.168.1.3/robots.txt','Guest','1355905446','192.168.1.104','Mozilla/5.0 (Windows NT 6.2; rv:17.0) Gecko/20100101 Firefox/17.0'),(55,'','http://192.168.1.3/sitemap.xml','Guest','1355905446','192.168.1.104','Mozilla/5.0 (Windows NT 6.2; rv:17.0) Gecko/20100101 Firefox/17.0'),(56,'http://192.168.1.3/skin/dt/style.css','http://192.168.1.3/skin/dt/layout.css','Guest','1355905456','192.168.1.104','Mozilla/5.0 (Windows NT 6.2; rv:17.0) Gecko/20100101 Firefox/17.0'),(57,'http://192.168.1.3/skin/dt/style.css','http://192.168.1.3/skin/dt/base.css','Guest','1355905456','192.168.1.104','Mozilla/5.0 (Windows NT 6.2; rv:17.0) Gecko/20100101 Firefox/17.0'),(58,'http://192.168.1.3/skin/dt/style.css','http://192.168.1.3/skin/images/dot.gif','Guest','1355905456','192.168.1.104','Mozilla/5.0 (Windows NT 6.2; rv:17.0) Gecko/20100101 Firefox/17.0'),(59,'http://192.168.1.3/news/show.php?itemid=18','http://192.168.1.3/templates/green/images/user_avatar.png','Guest','1355906489','192.168.1.104','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11'),(60,'http://192.168.1.3/news/show.php?itemid=18','http://192.168.1.3/tools/verify_code.ashx','Guest','1355906679','192.168.1.104','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11'),(61,'http://192.168.1.3/news/show.php?itemid=9','http://192.168.1.3/file/JavaScript/comment.js','Guest','1355966880','192.168.1.3','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11'),(62,'http://xlissue110.sandai.net','http://xlissue110.sandai.net/guide.otherpage.png?fid=pzbe9srbYY2n/TyHtgJKovhQyWhQhwMAAAAAAEkF8ah5u78W/Lensn3zkxMzIHGr&mid=666&threshold=60&tid=16A623AA35D015E97284C6C25797D8EF&srcid=0','Guest','1355995256','127.0.0.1','Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.1; Trident/6.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; .NET4.0C; .NET4.0E)'),(63,'http://xlissue110.sandai.net','http://xlissue110.sandai.net/guide.mainpage.png?fid=1OFYnAWD4ZL7+AVH+kCTG3xFFsbQBQQAAAAAAGvIayIz6tH4N/VwDt2d32SOW3HN&mid=666&threshold=60&tid=B3F6025E107BD288131C7ABA691696DE&srcid=0','Guest','1355995256','127.0.0.1','Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.1; Trident/6.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; .NET4.0C; .NET4.0E)'),(64,'http://xlissue110.sandai.net','http://xlissue110.sandai.net/all_update_731.zip?fid=vuJoIt5nRDzBA95ZiiU6WQgfixYqnXkAAAAAAP40E9hcm6qFGihni/oxlYuM5WYk&mid=666&threshold=60&tid=51CAF666297A78251D64AB07F07778BB&srcid=0','Guest','1355995264','127.0.0.1','Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.1; Trident/6.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; .NET4.0C; .NET4.0E)'),(65,'http://xlissue110.sandai.net','http://xlissue110.sandai.net/all_update_731.zip?fid=vuJoIt5nRDzBA95ZiiU6WQgfixYqnXkAAAAAAP40E9hcm6qFGihni/oxlYuM5WYk&mid=666&threshold=60&tid=51CAF666297A78251D64AB07F07778BB&srcid=0%20http://xlissue110.sandai.net/guide.mainpage.png?fid=1','Guest','1355995264','127.0.0.1','Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.1; Trident/6.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; .NET4.0C; .NET4.0E)'),(66,'http://192.168.1.3/news/show.php?itemid=18','http://192.168.1.3/skin/dt/layout.css','Guest','1355995784','192.168.1.3','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.97 Safari/537.11'),(67,'http://192.168.1.3/news/show.php?itemid=18','http://192.168.1.3/skin/dt/base.css','Guest','1355995784','192.168.1.3','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.97 Safari/537.11'),(68,'http://192.168.1.3/news/list.php?catid=7','http://192.168.1.3/index.aspx','Guest','1355995796','192.168.1.3','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.97 Safari/537.11'),(69,'http://192.168.1.3/news/','http://192.168.1.3/skin/images/dot.gif','Guest','1355995799','192.168.1.3','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.97 Safari/537.11'),(70,'','http://192.168.1.3/robots.txt','Guest','1356057860','192.168.1.104','Mozilla/5.0 (Windows NT 6.2; rv:17.0) Gecko/20100101 Firefox/17.0'),(71,'','http://192.168.1.3/sitemap.xml','Guest','1356057860','192.168.1.104','Mozilla/5.0 (Windows NT 6.2; rv:17.0) Gecko/20100101 Firefox/17.0'),(72,'http://192.168.1.3/news/show.php?itemid=11','http://192.168.1.3/skin/images/icon_arrow_blue.gif','Guest','1356078510','192.168.1.3','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.97 Safari/537.11'),(73,'http://192.168.1.3/news/show.php?itemid=17','http://192.168.1.3/skin/dt/layout.css','Guest','1356082846','192.168.1.3','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.97 Safari/537.11'),(74,'http://192.168.1.3/news/show.php?itemid=17','http://192.168.1.3/skin/dt/base.css','Guest','1356082846','192.168.1.3','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.97 Safari/537.11'),(75,'http://192.168.1.3/news/show.php?itemid=17','http://192.168.1.3/news/null?0.23264189413748682','Guest','1356084265','192.168.1.3','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.97 Safari/537.11'),(76,'http://192.168.1.3/news/','http://192.168.1.3/skin/images/dot.gif','Guest','1356085292','192.168.1.3','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.97 Safari/537.11'),(77,'http://192.168.1.3/down/','http://192.168.1.3/skin/dt/down.css','Guest','1356158942','192.168.1.3','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.97 Safari/537.11'),(78,'http://192.168.1.3/down/show.php?itemid=10','http://192.168.1.3/skin/dt/image/message.gif','Guest','1356160782','192.168.1.3','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.97 Safari/537.11'),(79,'http://192.168.1.3/down/show.php?itemid=10','http://192.168.1.3/skin/dt/image/messagebg.gif','Guest','1356160782','192.168.1.3','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.97 Safari/537.11'),(80,'http://192.168.1.3/down/','http://192.168.1.3/skin/dt/layout.css','Guest','1356316743','192.168.1.3','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.97 Safari/537.11'),(81,'http://192.168.1.3/down/','http://192.168.1.3/skin/dt/down.css','Guest','1356316743','192.168.1.3','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.97 Safari/537.11'),(82,'http://192.168.1.3/down/','http://192.168.1.3/skin/dt/base.css','Guest','1356316743','192.168.1.3','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.97 Safari/537.11'),(83,'http://192.168.1.3/admin.php?file=fields&tbname=down_19&action=add','http://192.168.1.3/skin/dt/image/messagebg.gif','Guest','1356338577','192.168.1.3','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.97 Safari/537.11'),(84,'http://192.168.1.3/admin.php?file=fields&tbname=down_19&action=add','http://192.168.1.3/skin/dt/image/message.gif','Guest','1356338577','192.168.1.3','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.97 Safari/537.11'),(85,'http://192.168.1.3/down/show.php?itemid=10','http://192.168.1.3/skin/dt/base.css','Guest','1356416163','192.168.1.3','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.97 Safari/537.11'),(86,'http://192.168.1.3/down/show.php?itemid=10','http://192.168.1.3/skin/dt/layout.css','Guest','1356416163','192.168.1.3','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.97 Safari/537.11'),(87,'http://192.168.1.3/down/show.php?itemid=10','http://192.168.1.3/skin/dt/down.css','Guest','1356416163','192.168.1.3','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.97 Safari/537.11'),(88,'http://192.168.1.3/down/','http://192.168.1.3/upload/201210/22/201210221641205768.jpg','Guest','1356421991','192.168.1.106','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.97 Safari/537.11'),(89,'http://192.168.1.3/down/','http://192.168.1.3/upload/201210/22/201210221647536218.jpg','Guest','1356421991','192.168.1.106','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.97 Safari/537.11'),(90,'http://192.168.1.3/down/','http://192.168.1.3/upload/201210/23/201210231350163795.jpg','Guest','1356421991','192.168.1.106','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.97 Safari/537.11'),(91,'http://192.168.1.3/down/','http://192.168.1.3/upload/201210/21/201210211433570142.jpg','Guest','1356421991','192.168.1.106','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.97 Safari/537.11'),(92,'http://192.168.1.3/down/','http://192.168.1.3/upload/201210/22/201210221634334069.jpg','Guest','1356421991','192.168.1.106','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.97 Safari/537.11'),(93,'http://192.168.1.3/news/','http://192.168.1.3/skin/images/dot.gif','Guest','1356422379','192.168.1.106','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.97 Safari/537.11'),(94,'http://192.168.1.3/down/','http://192.168.1.3/file/image/view.jpg','Guest','1356423487','192.168.1.106','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.97 Safari/537.11'),(95,'http://www.internetdownloadmanager.com/data/395012712/','http://www.internetdownloadmanager.com/data/395012712/register.cgi','Guest','1356448755','127.0.0.1','Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0; Trident/4.0)'),(96,'http://192.168.1.3/down/show.php?itemid=11','http://192.168.1.3/skin/dt/base.css','Guest','1356506213','192.168.1.3','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.97 Safari/537.11'),(97,'http://192.168.1.3/down/show.php?itemid=11','http://192.168.1.3/skin/dt/layout.css','Guest','1356506213','192.168.1.3','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.97 Safari/537.11'),(98,'','http://192.168.1.3/sitemap.xml','Guest','1356570746','192.168.1.106','Mozilla/5.0 (Windows NT 6.2; rv:17.0) Gecko/20100101 Firefox/17.0'),(99,'','http://192.168.1.3/robots.txt','Guest','1356570745','192.168.1.106','Mozilla/5.0 (Windows NT 6.2; rv:17.0) Gecko/20100101 Firefox/17.0'),(100,'http://192.168.1.3/news/','http://192.168.1.3/skin/images/dot.gif','Guest','1356580102','192.168.1.3','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.97 Safari/537.11'),(101,'http://www.internetdownloadmanager.com/data/395012712/','http://www.internetdownloadmanager.com/data/395012712/register.cgi','Guest','1356585767','127.0.0.1','Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0; Trident/4.0)'),(102,'http://192.168.1.3/news/show.php?itemid=18','http://192.168.1.3/skin/dt/layout.css','Guest','1356659372','192.168.1.3','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.97 Safari/537.11'),(103,'http://192.168.1.3/news/show.php?itemid=18','http://192.168.1.3/skin/dt/base.css','Guest','1356659372','192.168.1.3','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.97 Safari/537.11'),(104,'http://192.168.1.3/news/show.php?itemid=18','http://192.168.1.3/skin/images/icon_arrow_blue.gif','Guest','1356659373','192.168.1.3','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.97 Safari/537.11'),(105,'http://192.168.1.3/photos/','http://192.168.1.3/skin/dt/photo.css','Guest','1356663249','192.168.1.104','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11 AlexaToolbar/alxg-3.1'),(106,'http://192.168.1.3/photos/','http://192.168.1.3/photos/DT_PATHfile/flash/slide.swf','Guest','1356663249','192.168.1.104','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11 AlexaToolbar/alxg-3.1'),(107,'','http://192.168.1.3/robots.txt','Guest','1356665126','192.168.1.106','Mozilla/5.0 (Windows NT 6.2; rv:17.0) Gecko/20100101 Firefox/17.0'),(108,'','http://192.168.1.3/sitemap.xml','Guest','1356665126','192.168.1.106','Mozilla/5.0 (Windows NT 6.2; rv:17.0) Gecko/20100101 Firefox/17.0'),(109,'','http://192.168.1.3/login.php','Guest','1356677573','192.168.1.106','Mozilla/5.0 (Windows NT 6.2; rv:17.0) Gecko/20100101 Firefox/17.0');

#
# Source for table "ruiec_admin"
#

DROP TABLE IF EXISTS `ruiec_admin`;
CREATE TABLE `ruiec_admin` (
  `adminid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL COMMENT '会员ID',
  `listorder` int(11) DEFAULT NULL COMMENT '排序',
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `url` varchar(255) DEFAULT NULL COMMENT '链接',
  `moduleid` int(11) DEFAULT NULL COMMENT '模块ID',
  `file` varchar(255) DEFAULT NULL COMMENT '文件',
  `action` varchar(255) DEFAULT NULL COMMENT '行为',
  PRIMARY KEY (`adminid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员自定义表';

#
# Data for table "ruiec_admin"
#


#
# Source for table "ruiec_ads"
#

DROP TABLE IF EXISTS `ruiec_ads`;
CREATE TABLE `ruiec_ads` (
  `adid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL COMMENT '广告标题',
  `type` int(11) DEFAULT '0' COMMENT '广告类型 0:文字 1:图片 2:flash 3:自定义',
  `url` varchar(255) DEFAULT NULL COMMENT '广告链接',
  `content` text COMMENT '内容',
  `starttime` varchar(255) DEFAULT NULL COMMENT '开始时间',
  `overtime` varchar(255) DEFAULT NULL COMMENT '结束时间',
  `width` int(11) DEFAULT '0' COMMENT '宽',
  `height` int(11) DEFAULT '0' COMMENT '高',
  `time` varchar(255) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`adid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='广告表';

#
# Data for table "ruiec_ads"
#


#
# Source for table "ruiec_article_18"
#

DROP TABLE IF EXISTS `ruiec_article_18`;
CREATE TABLE `ruiec_article_18` (
  `itemid` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `catid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '栏目ID',
  `level` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '级别',
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '标题',
  `introduce` varchar(500) NOT NULL DEFAULT '' COMMENT '内容简介',
  `tag` varchar(100) NOT NULL DEFAULT '' COMMENT '标签',
  `keyword` varchar(255) NOT NULL DEFAULT '' COMMENT '关键字',
  `author` varchar(50) NOT NULL DEFAULT '' COMMENT '作者',
  `copyfrom` varchar(30) NOT NULL DEFAULT '' COMMENT '来源',
  `fromurl` varchar(255) NOT NULL DEFAULT '' COMMENT '来源链接',
  `hits` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '点击次数',
  `thumb` varchar(255) NOT NULL DEFAULT '' COMMENT '标题图片',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `edittime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  `ip` varchar(50) NOT NULL DEFAULT '' COMMENT 'IP',
  `template` varchar(30) NOT NULL DEFAULT '0' COMMENT '内容模版',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `islink` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否为外部链接',
  `linkurl` varchar(255) NOT NULL DEFAULT '' COMMENT '链接地址',
  `filename` varchar(255) NOT NULL DEFAULT '' COMMENT '自定义文件名称',
  `note` varchar(255) NOT NULL DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`itemid`),
  KEY `addtime` (`addtime`),
  KEY `catid` (`catid`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COMMENT='新闻中心';

#
# Data for table "ruiec_article_18"
#

/*!40000 ALTER TABLE `ruiec_article_18` DISABLE KEYS */;
INSERT INTO `ruiec_article_18` VALUES (8,15,0,'公司主页快照','aaaaaaaaaaa','','公司主页快照,数码产品','','','',5,'http://www.taociwto.com/file/upload/201011/13/11-29-41-97-181.jpg',1354877686,1355823090,'192.168.1.3','',3,0,'show.php?itemid=8','',''),(9,19,6,'习近平视察深圳 现场无欢迎横幅及列队迎送','国家领导人车队昨日到深圳视察，据香港媒体报道，这是习近平任总书记后首次离京视察，深圳前海附近道路畅通如常，现场没有任何欢迎横幅，也没有列队迎送的环节。凤凰卫视昨日《华文大直播》节目播出“习近平视察深圳无列队欢送环节”。据报道，国家领导人车队','','习近平视察深圳 现场无欢迎横幅及列队迎送,IT资讯,软媒动态','','','',11,'http://192.168.1.3/file/upload/2012/12/18//13558145453727.jpg',1354938333,1355822313,'192.168.1.3','',3,0,'show.php?itemid=9','',''),(10,20,1,'799元360特供机：“海尔小潜艇”下周限量发售','   10月19日消息，360和海尔共同宣布，360特供机新成员——海尔小潜艇，将于下周二（10月23日）正式发售，现货1万台，售价799元。    海尔小潜艇，IP67级三防设计（防水、防尘、防刮），超长待机。    海尔此前还曾和360','','799元360特供机：“海尔小潜艇”下周限量发售,数码产品 &raquo; 智能手机','','','',2,'',1355815726,1355815726,'192.168.1.88','',3,0,'show.php?itemid=10','',''),(11,22,5,'小蛮腰随心扭，联想Win8变形本Twist宣传视频',' 联想Win8翻转设备ThinkPad Twist给大家留下了比较深刻的印象，其最大的卖点就是可以随心旋转。    近日联想发布了ThinkPad Twist的视频广告，广告中展示了ThinkPad Twist可以随心旋转的优点，小蛮腰真的','','小蛮腰随心扭，联想Win8变形本Twist宣传视频,数码产品 &raquo; 笔记本电脑','','','',5,'',1355815770,1355819357,'192.168.1.88','',3,0,'show.php?itemid=11','',''),(12,16,0,'iPad Mini 23日登场','   说起本周最值得关注的新闻就要属苹果的邀请函的发布了，虽然本次苹果发布会将要发布的具体产品我们无从得知，但是苹果有很大的可能性将会在23日发布其小尺寸平板iPad Mini。而大家一直抱有很大期望的微软Surface也已经在苏宁开售，同','','iPad Mini 23日登场,数码产品 &raquo; 平板电脑','','','',1,'',1355815808,1355815808,'192.168.1.88','',3,0,'show.php?itemid=12','',''),(13,16,1,'Surface英国/加拿大也火爆 但微软喜忧参半','   在加拿大和英国，Surface同样十分火爆，当前，两国的微软在线商店上都无法再预订到不含Touch Cover的32GB版Surface了。    不含Touch Cover的32GB版Surface在加拿大的预售价为519美元，英国','','Surface英国/加拿大也火爆 但微软喜忧参半,数码产品 &raquo; 平板电脑','','','',4,'',1355815828,1355815828,'192.168.1.88','',3,0,'show.php?itemid=13','',''),(14,21,1,'历史性时刻：ARM首次成功模拟运行x86','   ARM在移动领域风生水起，但是要想在桌面和服务器上占领一席之地，最大的麻烦就在于不兼容最为普及的x86代码系统和程序，而出路只有两条：要么大力推进自己的生态系统，要么模拟运行x86，就像曾经的全美达那样。    今年七月份，英国厂商B','','历史性时刻：ARM首次成功模拟运行x86,IT资讯 &raquo; 科技要闻','','','',2,'',1355815928,1355815928,'192.168.1.88','',3,0,'show.php?itemid=14','',''),(15,21,1,'技术宅拯救世界：用纸糊一辆自行车','   你见过纸糊的自行车吗？来自以色列的工程师兼自行车爱好者伊扎尔·加夫尼（Izhar Gafni）就糊出了一辆。这辆自行车除了车胎和链条等配件材料之外完全由回收利用的硬纸板制成，并且成本仅需 12 美元。有了这种环保廉价的自行车，都市人群','','技术宅拯救世界：用纸糊一辆自行车,IT资讯 &raquo; 科技要闻','','','',3,'',1355815960,1355815960,'192.168.1.88','',3,0,'show.php?itemid=15','',''),(16,19,1,'Win8，最后的Windows操作系统','   Salesforce.com的首席执行官管Marc Benioff一直是以直言不讳而著称的，现在他又就Win8做了一个大胆的预测。    据外媒Computerworld.com报道，Marc Benioff在纽约的一次公司大会上，公','','Win8，最后的Windows操作系统,IT资讯 &raquo; 软媒动态','','','',4,'',1355815985,1355815985,'192.168.1.88','',3,0,'show.php?itemid=16','',''),(17,19,0,'微软宣布Office365大学生版：十个理由让你爱她','10月20日消息，微软正式宣布全新的面向高校学生的“Office 365 University”计划。Office 365大学版将于2013年第一季度正式上线，会通过线上、零售商以及微软商店面向全球52个市场推出。从今天起，符合条件的学生可','Windows Microsoft','微软宣布Office365大学生版：十个理由让你爱她,Windows,Microsoft,IT资讯,软媒动态','','','',4,'',1355816004,1356078569,'192.168.1.88','',3,0,'show.php?itemid=17','',''),(18,21,0,'微软哪个部门最赚钱？','   10月20日消息，据国外媒体报道，在微软发布其首款平板电脑Surface时，CEO史蒂夫•鲍尔默（Steve Ballmer）就指出：“Windows是微软的最核心业务，范围涵盖个人电脑、服务器、手机操作系统以及云计算平台Azure。','Surface Windows Microsoft','微软哪个部门最赚钱？,Surface,Windows,Microsoft,IT资讯,科技要闻','','','',7,'',1355816045,1356078550,'192.168.1.88','',3,0,'show.php?itemid=18','',''),(19,15,0,'百度一下','百度一下百度一下百度一下','','百度一下,数码产品','','','',0,'',1356085339,1356085339,'192.168.1.3','',3,1,'http://www.baidu.com/','','');
/*!40000 ALTER TABLE `ruiec_article_18` ENABLE KEYS */;

#
# Source for table "ruiec_article_data_18"
#

DROP TABLE IF EXISTS `ruiec_article_data_18`;
CREATE TABLE `ruiec_article_data_18` (
  `itemid` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '新闻ID',
  `content` longtext NOT NULL COMMENT '内容',
  PRIMARY KEY (`itemid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='新闻中心内容';

#
# Data for table "ruiec_article_data_18"
#

/*!40000 ALTER TABLE `ruiec_article_data_18` DISABLE KEYS */;
INSERT INTO `ruiec_article_data_18` VALUES (8,'<p>00000000bbbbbbbbbbbbbbb<br /></p>'),(9,'<p style=\"font-size:14px;line-height:23px;text-indent:2em;color:#2b2b2b;font-family:宋体, serif;text-align:justify;background-color:#ffffff;\">国家领导人车队昨日到深圳视察，据香港媒体报道，这是习近平任总书记后首次离京视察，深圳前海附近道路畅通如常，现场没有任何欢迎横幅，也没有列队迎送的环节。</p><p style=\"font-size:14px;line-height:23px;text-indent:2em;color:#2b2b2b;font-family:宋体, serif;text-align:justify;background-color:#ffffff;\">凤凰卫视昨日《华文大直播》节目播出“习近平视察深圳无列队欢送环节”。据报道，国家领导人车队昨日到深圳视察，记者在蛇口港看到标志性牌子，写着“空谈误国”、“实干兴邦”，习近平在11月底视察时提出空谈误国和实干兴邦的概念。</p><p style=\"font-size:14px;line-height:23px;text-indent:2em;color:#2b2b2b;font-family:宋体, serif;text-align:justify;background-color:#ffffff;\">昨日下午，记者看到深圳前海附近的道路畅通如常，下午三点半时看到由8辆车组成的一个车队进入深圳前海深港合作区，但现场没有看到任何的欢迎横幅，也没有列队迎送的这样一个环节。</p><p style=\"font-size:14px;line-height:23px;text-indent:2em;color:#2b2b2b;font-family:宋体, serif;text-align:justify;background-color:#ffffff;\">此前，中共中央政治局会议出台规定，要求领导干部调研要轻车简从，减少交通管制，一般是不封路。现场有建设工人说，看来中央的高层是说到做到。有工作人员称，希望中央高层这次到前海能够带来更多的优惠政策。记者在事后采访前海管理局局长郑宏杰，他表示，详细情况稍后会向大家公布。据了解，中央高层一行在周末还将前往莲花山公园，并到渔民村看望民众。</p><p style=\"font-size:14px;line-height:23px;text-indent:2em;color:#2b2b2b;font-family:宋体, serif;text-align:justify;background-color:#ffffff;\">据报道，今年是邓小平“92南巡”20周年，有舆论认为中央高层重走南巡路也是意在展现坚持改革开放的决心。</p><p><br /></p>'),(10,'<p style=\"padding:0px;list-style:none;color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;margin-top:15px;margin-bottom:15px;\"> &nbsp; &nbsp; &nbsp; &nbsp;10月19日消息，360和海尔共同宣布，360特供机新成员——海尔小潜艇，将于下周二（10月23日）正式发售，现货1万台，售价799元。</p><p style=\"padding:0px;list-style:none;color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;margin-top:15px;margin-bottom:15px;\"> &nbsp; &nbsp; &nbsp; &nbsp;海尔小潜艇，IP67级三防设计（防水、防尘、防刮），超长待机。</p><p style=\"padding:0px;list-style:none;color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;margin-top:15px;margin-bottom:15px;\"> &nbsp; &nbsp; &nbsp; &nbsp;海尔此前还曾和360合作推出“海尔超级旗舰W910”360特供机，其售价是1999元。</p><p style=\"padding:0px;list-style:none;color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;text-align:center;margin-top:15px;margin-bottom:15px;\"><img src=\"http://192.168.1.3/file/upload/2012/12/18/15-28-46-35-1.jpg\" style=\"border:0px;max-width:670px;\" /></p><p><br /></p>'),(11,'<div class=\"current_nav\" style=\"color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;\"> &nbsp; 联想Win8翻转设备ThinkPad Twist给大家留下了比较深刻的印象，其最大的卖点就是可以随心旋转。</div><div id=\"paragraph\" class=\"post_content\" style=\"color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;\"><p style=\"padding:0px;list-style:none;margin-top:15px;margin-bottom:15px;\"> &nbsp; &nbsp; &nbsp; &nbsp;近日联想发布了ThinkPad Twist的视频广告，广告中展示了ThinkPad Twist可以随心旋转的优点，小蛮腰真的很灵活啊。下面就来看下这个视频吧，其实这是一款很帅气也很灵活的产品。广告拍的也不错啊，很有大片范儿。</p><p style=\"padding:0px;list-style:none;text-align:center;margin-top:15px;margin-bottom:15px;\"><img src=\"http://192.168.1.3/file/upload/2012/12/18/15-29-30-99-1.jpg\" style=\"border:0px;max-width:670px;\" /></p><p style=\"padding:0px;list-style:none;margin-top:15px;margin-bottom:15px;\"> &nbsp; &nbsp; &nbsp; &nbsp;联想超极本ThinkPad Twist屏幕大小为12.5英寸，触摸屏可以旋转，也可以折叠成平板。搭载Windows8 Pro系统，配置英特尔酷睿i7处理器，支持3G网络，用户可选择500GB硬盘或128GB固态硬盘，售价为849美元起。</p></div><p><br /></p>'),(12,'<p style=\"padding:0px;list-style:none;color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;margin-top:15px;margin-bottom:15px;\"> &nbsp; &nbsp; &nbsp; &nbsp;说起本周最值得关注的新闻就要属苹果的邀请函的发布了，虽然本次苹果发布会将要发布的具体产品我们无从得知，但是苹果有很大的可能性将会在23日发布其小尺寸平板iPad Mini。而大家一直抱有很大期望的微软Surface也已经在苏宁开售，同时本周还有很多其他有意思的新闻，相信一定不会令大家失望的，接下来就让手机中国整理的平板新闻汇总：</p><p style=\"padding:0px;list-style:none;color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;text-align:center;margin-top:15px;margin-bottom:15px;\"><img src=\"http://192.168.1.3/file/upload/2012/12/18/15-30-08-45-1.jpg\" style=\"border:0px;max-width:670px;\" /></p><p style=\"padding:0px;list-style:none;color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;margin-top:15px;margin-bottom:15px;\"> &nbsp; &nbsp; &nbsp; &nbsp;此前曾有消息称，苏宁将会率先开售微软的自有平板Surface。现在微软已经大方的承认这个传闻，随后苏宁也表示会在10月17日正式开启它的预购（10月26日0点与全球同步正式发售）。</p><p style=\"padding:0px;list-style:none;color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;text-align:center;margin-top:15px;margin-bottom:15px;\"><img border=\"0\" src=\"http://192.168.1.3/file/upload/2012/12/18/15-30-08-44-1.jpg\" width=\"500\" height=\"375\" style=\"border:0px;max-width:670px;\" /></p><p style=\"padding:0px;list-style:none;color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;margin-top:15px;margin-bottom:15px;\"><strong style=\"color:#dc2523;\">微软Surface RT</strong></p><p style=\"padding:0px;list-style:none;color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;margin-top:15px;margin-bottom:15px;\"> &nbsp; &nbsp; &nbsp; &nbsp;从之前曝光的消息来看，Surface RT版将会搭载主频1.4GHz的NVIDIA Tegra 3四核处理器，而之前微软公布的参数为，该机厚度为9.3mm，整机重约676克，配备的是10.6英寸16:9触摸屏，分辨率为1920×1080像素，并内置USB 2.0、microSD、Micro HD Video接口和31.5Wh电池。</p><p style=\"padding:0px;list-style:none;color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;text-align:center;margin-top:15px;margin-bottom:15px;\"><img src=\"http://192.168.1.3/file/upload/2012/12/18/15-30-08-91-1.jpg\" style=\"border:0px;max-width:670px;\" /></p><p style=\"padding:0px;list-style:none;color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;margin-top:15px;margin-bottom:15px;\"><strong style=\"color:#dc2523;\">微软Surface RT</strong></p><p style=\"padding:0px;list-style:none;color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;margin-top:15px;margin-bottom:15px;\"> &nbsp; &nbsp; &nbsp; &nbsp;目前接受预定的只有Surface RT版，其中32GB版本的售价为3688元（16GB Wi-Fi版iPad 3也是这个价格），而标配黑色触摸屏键盘Touch Cover的Surface 32GB售价为4488元，64GB的价格则为5288元。随后微软还表示，为了让更多的中国用户近距离了解和感受Surface，苏宁电器将在其零售商店中设置它的专区，陈列并展示Surface，同时配备专业的销售人员。需要注意的是，微软还提供了Surface的多种配件，诸如拥有5种不同配色（黑色、白色、洋红色、青蓝色以及红色）的触控式键盘保护套Touch Cover，其售价为908.88元，而黑色实体键盘保护套的价格是988.88元。</p><p><br /></p>'),(13,'<div class=\"content\" style=\"padding:20px;color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;word-break:break-all;\"><p style=\"padding:0px;list-style:none;margin-top:15px;margin-bottom:15px;\"><strong style=\"color:#dc2523;\"> &nbsp; &nbsp; &nbsp; &nbsp;在加拿大和英国，Surface同样十分火爆</strong>，当前，<strong style=\"color:#dc2523;\">两国的微软在线商店上都无法再预订到不含Touch Cover的32GB版Surface了</strong>。</p><p style=\"padding:0px;list-style:none;margin-top:15px;margin-bottom:15px;\"> &nbsp; &nbsp; &nbsp; &nbsp;不含Touch Cover的32GB版Surface在加拿大的预售价为519美元，英国为399英镑。</p><p style=\"padding:0px;list-style:none;margin-top:15px;margin-bottom:15px;\"> &nbsp; &nbsp; &nbsp; &nbsp;微软当前并未公开透露已经有多少台Surface被预订，但是从当前的情形来看，32GB版Surface更受欢迎，尤其是不带Touch Cover的。这一结果一定是让微软喜忧参半。</p><p style=\"padding:0px;list-style:none;margin-top:15px;margin-bottom:15px;\"> &nbsp; &nbsp; &nbsp; &nbsp;自开始推广Surface以来，Touch Cover一直是微软宣传的重中之重，Touch Cover是微软专为Surface研发的外置触摸虚拟键盘，同时兼具保护套作用，是微软的创新产品。<strong style=\"color:#dc2523;\">微软一直希望消费者能够喜欢它，但是，显然，Touch Cover那高昂的售价让大家望而却步</strong>。在美国，不含Touch Cover的32GB版Surface价格比含Cover的便宜100美元，在我国，不含Touch Cover的32GB版Surface价格则低出800元。</p><p style=\"padding:0px;list-style:none;text-align:center;margin-top:15px;margin-bottom:15px;\"><img alt=\"Surface英国/加拿大也火爆 但微软喜忧参半\" src=\"http://192.168.1.3/file/upload/2012/12/18/15-30-28-70-1.jpg\" style=\"border:1px solid black;max-width:670px;\" /></p></div><p><br /></p>'),(14,'<p style=\"padding:0px;list-style:none;color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;margin-top:15px;margin-bottom:15px;\"> &nbsp; &nbsp; &nbsp; ARM在移动领域风生水起，但是要想在桌面和服务器上占领一席之地，最大的麻烦就在于不兼容最为普及的x86代码系统和程序，而出路只有两条：要么大力推进自己的生态系统，要么模拟运行x86，就像曾经的全美达那样。</p><p style=\"padding:0px;list-style:none;color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;margin-top:15px;margin-bottom:15px;\"> &nbsp; &nbsp; &nbsp; &nbsp;今年七月份，英国厂商Boston Server推出了基于Calxeda ARM架构处理器的服务器“Viridis”，之后也一直在披露其工作进展，近日更是豪气万丈地官方宣布了一个历史性时刻的到来：这套ARM平台第一次成功运行了x86代码！</p><p style=\"padding:0px;list-style:none;color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;margin-top:15px;margin-bottom:15px;\"> &nbsp; &nbsp; &nbsp; &nbsp;过去一段时间里，Boston一直在和来自Eltech的工程师团队就此进行合作。这家貌似来自俄罗斯的公司正在ARM服务器上开发能够运行x86程序的软件，并且已经成功开发出了一种可作为模拟器使用的二进制转换器(binary translator)，能够发挥出大约45%的原生ARM性能。</p><p style=\"padding:0px;list-style:none;color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;margin-top:15px;margin-bottom:15px;\"> &nbsp; &nbsp; &nbsp; &nbsp;双方在Viridis平台上进行了六大类别的深入测试后，将这一模拟效率提高到了65%，并且会争取在近期继续提高到80%，乃至更高。</p><p style=\"padding:0px;list-style:none;color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;margin-top:15px;margin-bottom:15px;\"> &nbsp; &nbsp; &nbsp; &nbsp;虽然Boston拒绝披露具体细节，但是AnandTech网站分析指出，Eltech的模拟器是实时翻译、运行x86代码的，因此整个模拟器会有些偏大，毕竟它要在两套完全不同的指令集架构之间牵线搭桥，不同于VMware那样在x86-x86之间转换。</p><p style=\"padding:0px;list-style:none;color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;margin-top:15px;margin-bottom:15px;\"> &nbsp; &nbsp; &nbsp; &nbsp;据称，Eltech使用了1MB的转换器缓存，这意味着代码转换可以重复利用，但随着缓存逐渐填满，重复利用率就会迅速降低，而且只有相对轻便的代码才能运行得比较快，获得宣称的45-65%的转换效率。</p><p style=\"padding:0px;list-style:none;color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;margin-top:15px;margin-bottom:15px;\"> &nbsp; &nbsp; &nbsp; &nbsp;但是我们知道，大多数服务器应用的代码和指令都很大，所以Eltech的转换器能否高效率运行它们也有待观察。高性能计算软件倒是相对不那么复杂，但这玩意儿对处理器性能要求又特别高，很难说服他们放弃x86、改用ARM再去模拟x86(何苦来着)。</p><p style=\"padding:0px;list-style:none;color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;margin-top:15px;margin-bottom:15px;\"> &nbsp; &nbsp; &nbsp; &nbsp;总的来说，二进制转换器在特定场合下还是有用的，比如某些特定的Web应用软件不算很大，又是闭源的，没有ARM版本，但除此之外就很难说了。ARM服务器真想闯出一片天地，最稳妥的还得是催生一整套针对ARM架构完全优化编译的Linux软件。</p><p><br /></p>'),(15,'<p style=\"padding:0px;list-style:none;color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;margin-top:15px;margin-bottom:15px;\"> &nbsp; &nbsp; &nbsp; 你见过纸糊的自行车吗？来自以色列的工程师兼自行车爱好者伊扎尔·加夫尼（Izhar Gafni）就糊出了一辆。这辆自行车除了车胎和链条等配件材料之外完全由回收利用的硬纸板制成，并且成本仅需 12 美元。有了这种环保廉价的自行车，都市人群又多了一种节能减排的出行方式。同时，该自行车在收入较低的发展中国家将大有市场。</p><p style=\"padding:0px;list-style:none;color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;text-align:center;margin-top:15px;margin-bottom:15px;\"><img src=\"http://192.168.1.3/file/upload/2012/12/18/15-32-40-76-1.png\" style=\"border:0px;max-width:670px;\" /></p><p style=\"padding:0px;list-style:none;color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;margin-top:15px;margin-bottom:15px;\"> &nbsp; &nbsp; &nbsp; &nbsp;伊扎尔最初的创意来自于他听说有人造出了一艘纸质的独木舟，他也由此萌生出制造纸质自行车的念头。尽管“专家”们极力劝告他放弃自己的“痴心妄想”，但伊扎尔在妻子的鼓励下还是选择了将想法付诸实践。为了造出成本低廉、质量可靠且适合日常使用的纸质自行车，伊扎尔花了整整三年来实验他的各个模型，终于在最近取得了成功。</p><p style=\"padding:0px;list-style:none;color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;margin-top:15px;margin-bottom:15px;\">纸质自行车的制造流程并不简单。首先，伊扎尔要将硬纸板被裁减为特定的形状，之后将纸板折叠、粘合、挤压，制成具备特定强度的自行车部件。之后，伊扎尔使用自己钻研出的独门秘方再次处理这些部件，使其拥有更高的强度。最后，伊扎尔给每个部件刷上松香进行防水处理，再和组装普通自行车一样把每个部件组装起来。</p><p style=\"padding:0px;list-style:none;color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;margin-top:15px;margin-bottom:15px;\">通过下面这个视频，我们可以了解一下纸质自行车是怎样诞生的。</p><p style=\"padding:0px;list-style:none;color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;text-align:center;margin-top:15px;margin-bottom:15px;\"><embed height=\"500\" type=\"application/x-shockwave-flash\" align=\"middle\" width=\"600\" src=\"http://player.youku.com/player.php/sid/XNDYzNzk5ODY0/v.swf\" flashvars=\"winType=index\" quality=\"high\" allowfullscreen=\"true\" style=\"visibility:visible;\" /></p><p style=\"padding:0px;list-style:none;color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;margin-top:15px;margin-bottom:15px;\"> &nbsp; &nbsp; &nbsp; &nbsp;伊扎尔研发的纸质自行车仅有9公斤重，而同类型的自行车通常都有14公斤。虽然是纸质的，但此自行车不仅防水防潮，还能承载高达220公斤的重量。该自行车使用十分方便，无需任何调试，任何会骑自行车的人都能瞬间上手。而由二手车胎和二手汽车同步齿带打造的车胎和链条也保证了低廉的成本和可靠的质量。</p><p style=\"padding:0px;list-style:none;color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;margin-top:15px;margin-bottom:15px;\"> &nbsp; &nbsp; &nbsp; &nbsp;伊扎尔如今还在精益求精地优化纸质自行车的工艺流程，他估计成品纸质自行车的市场售价应该为20美元。20美元的售价在发展中国家非常有竞争力，尤其是这样一辆外观拉轰质量靠谱的环保自行车。对于发达地区的自行车爱好者而言，有了20美元一辆的自行车，大家就不用再担心自行车被盗的问题了。</p><p style=\"padding:0px;list-style:none;color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;margin-top:15px;margin-bottom:15px;\"> &nbsp; &nbsp; &nbsp; 伊扎尔表示，未来他将推出成人版和儿童版两种规格的纸质自行车，而成人版的纸质自行车上还将安装一个电动马达，使其华丽丽地升级为纸质电动自行车。</p><p style=\"padding:0px;list-style:none;color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;text-align:center;margin-top:15px;margin-bottom:15px;\"><img src=\"http://192.168.1.3/file/upload/2012/12/18/15-32-40-97-1.png\" style=\"border:0px;max-width:670px;\" /></p><p style=\"padding:0px;list-style:none;color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;margin-top:15px;margin-bottom:15px;\"> &nbsp; &nbsp; &nbsp; &nbsp;如果纸质自行车上市，你会去买一辆来试试吗？</p><p><br /></p>'),(16,'<p style=\"padding:0px;list-style:none;color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;margin-top:15px;margin-bottom:15px;\"> &nbsp; &nbsp; &nbsp; &nbsp;Salesforce.com的首席执行官管Marc Benioff一直是以直言不讳而著称的，现在他又就Win8做了一个大胆的预测。</p><p style=\"padding:0px;list-style:none;color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;margin-top:15px;margin-bottom:15px;\"> &nbsp; &nbsp; &nbsp; &nbsp;据外媒Computerworld.com报道，Marc Benioff在纽约的一次公司大会上，公开称Windows8将会成为微软Windows操作系统的“终结者”，随着越来越多的企业软件服务迁移到基于云的解决方案，Windows会最终变得“无关紧要”。</p><p style=\"padding:0px;list-style:none;color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;text-align:center;margin-top:15px;margin-bottom:15px;\"><img src=\"http://192.168.1.3/file/upload/2012/12/18/15-33-05-51-1.jpg\" style=\"border:0px;max-width:670px;\" /></p><p style=\"padding:0px;list-style:none;color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;margin-top:15px;margin-bottom:15px;\"> &nbsp; &nbsp; &nbsp; &nbsp;Marc Benioff称现在很多大公司都想从PC中解放出来，让员工带着便携式个人电脑来工作。</p><p style=\"padding:0px;list-style:none;color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;margin-top:15px;margin-bottom:15px;\"> &nbsp; &nbsp; &nbsp; &nbsp;微软对Marc Benioff的言论并未作出任何回应。我们需要注意的一点，其实微软的Windows 8以及Windows RT系统，还有Windows Phone 8都是以便携性和云连接为主题设计研发的</p><p><br /></p>'),(17,'<p style=\"padding:0px;list-style:none;color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;margin-top:15px;margin-bottom:15px;\">10月20日消息，微软正式宣布全新的面向高校学生的“Office 365 University”计划。Office 365大学版将于2013年第一季度正式上线，会通过线上、零售商以及微软商店面向全球52个市场推出。</p><p style=\"padding:0px;list-style:none;color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;margin-top:15px;margin-bottom:15px;\">从今天起，符合条件的学生可以购买Office University 2010或者Office University for Mac 2011，并可以获赠免费的Office 365 University订阅。</p><p style=\"padding:0px;list-style:none;color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;margin-top:15px;margin-bottom:15px;\"><img src=\"http://192.168.1.3/file/upload/2012/12/18/15-33-24-40-1.jpg\" style=\"border:0px;max-width:670px;\" /></p><p style=\"padding:0px;list-style:none;color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;margin-top:15px;margin-bottom:15px;\">高校学生会爱上Office 365 University的10个理由如下：</p><p style=\"padding:0px;list-style:none;color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;margin-top:15px;margin-bottom:15px;\"><strong style=\"color:#dc2523;\">最好的Office</strong>：包括全新的Word、PowerPoint、Excel、OneNote、Outlook、Publisher和Access。</p><p style=\"padding:0px;list-style:none;color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;margin-top:15px;margin-bottom:15px;\"><strong style=\"color:#dc2523;\">最好的价格</strong>：每月1.67美元。预计四年订阅的零售价是79.99美元。</p><p style=\"padding:0px;list-style:none;color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;margin-top:15px;margin-bottom:15px;\"><strong style=\"color:#dc2523;\">四年</strong>：若继续再上学四年，可以续约一下，获得总计8年的Office 365 University。</p><p style=\"padding:0px;list-style:none;color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;margin-top:15px;margin-bottom:15px;\"><strong style=\"color:#dc2523;\">数字笔记</strong>：通过触控、笔或者键盘在OneNote上记录笔记，并可保存在云中和通过多设备访问。</p><p style=\"padding:0px;list-style:none;color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;margin-top:15px;margin-bottom:15px;\"><strong style=\"color:#dc2523;\">保存到SkyDrive</strong>：Office 365 University默认将文档保存到SkyDrive，所以内容会始终在设备间同步。</p><p style=\"padding:0px;list-style:none;color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;margin-top:15px;margin-bottom:15px;\"><strong style=\"color:#dc2523;\">更多的存储</strong>：额外获得20GB的SkyDrive存储，总计为27GB。</p><p style=\"padding:0px;list-style:none;color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;margin-top:15px;margin-bottom:15px;\"><strong style=\"color:#dc2523;\">Skype</strong>：每月60分钟的Skype国际通话。</p><p style=\"padding:0px;list-style:none;color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;margin-top:15px;margin-bottom:15px;\"><strong style=\"color:#dc2523;\">新升级</strong>：获得未来的升级和改进。</p><p style=\"padding:0px;list-style:none;color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;margin-top:15px;margin-bottom:15px;\"><strong style=\"color:#dc2523;\">两设备的安装</strong>：一个用户可以将Office 365 University可以安装到两台电脑（PC或 Mac）中。</p><p style=\"padding:0px;list-style:none;color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;margin-top:15px;margin-bottom:15px;\"><strong style=\"color:#dc2523;\">办公需求</strong>：使用它，即使是离开电脑依旧可以通过互联网实现Office的全部功能。</p><p style=\"padding:0px;list-style:none;color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;margin-top:15px;margin-bottom:15px;\">认证机构中的全日制/非全日制高校学生和教职工均可购买Office 365 University。高校生、教职工在激活Office 365 University产品的过程中需要提供身份验证。除了微软零售店要求售前验证身份，其他的主要购买渠道则都是在售后认证身份。</p><p><br /></p>'),(18,'<p style=\"padding:0px;list-style:none;color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;margin-top:15px;margin-bottom:15px;\"> &nbsp; &nbsp; &nbsp; &nbsp;10月20日消息，据国外媒体报道，在微软发布其首款平板电脑Surface时，CEO史蒂夫•鲍尔默（Steve Ballmer）就指出：“Windows是微软的最核心业务，范围涵盖个人电脑、服务器、手机操作系统以及云计算平台Azure。”</p><p style=\"padding:0px;list-style:none;color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;margin-top:15px;margin-bottom:15px;\"> &nbsp; &nbsp; &nbsp; &nbsp;虽然鲍尔默所言不虚，但从上个季度的财报来看，Windows却并不是微软运营利润的最大来源业务，而来自隶属于Office业务的商务部门的运营利润达到Windows的两倍。甚至连来自服务器和工具的运营利润都要高于Windows部门。</p><p style=\"padding:0px;list-style:none;color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;text-align:center;margin-top:15px;margin-bottom:15px;\"><img src=\"http://192.168.1.3/file/upload/2012/12/18/15-34-05-75-1.jpg\" style=\"border:0px;max-width:670px;\" /></p><p style=\"padding:0px;list-style:none;color:#33383d;font-family:&#39;microsoft yahei&#39;;font-size:13px;line-height:24px;background-color:#ffffff;margin-top:15px;margin-bottom:15px;\"> &nbsp; &nbsp; &nbsp; &nbsp;微软目前正处于从Windows7向Windows8转型的过渡期，这是Windows部门运营利润表现不佳的主要原因。一旦Windows 8销售在本季度到明年的这段时间里出现上涨，微软Windows部门的运营利润届时将出现反弹</p><p><br /></p>'),(19,'');
/*!40000 ALTER TABLE `ruiec_article_data_18` ENABLE KEYS */;

#
# Source for table "ruiec_category"
#

DROP TABLE IF EXISTS `ruiec_category`;
CREATE TABLE `ruiec_category` (
  `catid` int(11) NOT NULL AUTO_INCREMENT COMMENT '分类id',
  `moduleid` int(11) DEFAULT NULL COMMENT '模块ID',
  `catname` varchar(255) DEFAULT NULL COMMENT '栏目名称',
  `catdir` varchar(255) DEFAULT NULL COMMENT '栏目目录',
  `linkurl` varchar(255) DEFAULT NULL COMMENT '链接地址',
  `parentid` int(11) DEFAULT NULL COMMENT '上级ID',
  `listorder` int(11) DEFAULT NULL COMMENT '排序',
  `template` varchar(255) DEFAULT NULL COMMENT '栏目模板',
  `show_template` varchar(255) DEFAULT NULL COMMENT '内容模板',
  `seo_title` varchar(255) DEFAULT NULL COMMENT 'SEO标题',
  `seo_keywords` varchar(255) DEFAULT NULL COMMENT 'SEO关键词',
  `seo_description` varchar(255) DEFAULT NULL COMMENT 'SEO描述',
  PRIMARY KEY (`catid`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COMMENT='分类表';

#
# Data for table "ruiec_category"
#

INSERT INTO `ruiec_category` VALUES (7,18,'IT资讯','function','list.php?catid=7',0,0,'','','','bbbbb','ccccccccccccccccccccccc'),(15,18,'数码产品','shuma','list.php?catid=15',0,0,'','','','',''),(16,18,'平板电脑','pingban','list.php?catid=16',15,0,'','','','',''),(19,18,'软媒动态','meiti','list.php?catid=19',7,0,'','','','',''),(20,18,'智能手机','phone','list.php?catid=20',15,0,'','','','',''),(21,18,'科技要闻','keji','list.php?catid=21',7,0,'','','','',''),(22,18,'笔记本电脑','bijiben','list.php?catid=22',15,0,'','','','',''),(23,19,'源码分享','source','list.php?catid=23',0,0,'','','','',''),(24,19,'图片素材','image','list.php?catid=24',0,0,'','','','','');

#
# Source for table "ruiec_comment"
#

DROP TABLE IF EXISTS `ruiec_comment`;
CREATE TABLE `ruiec_comment` (
  `itemid` int(11) NOT NULL AUTO_INCREMENT COMMENT '评论ID',
  `comment_id` int(11) DEFAULT '0' COMMENT '回复评论id',
  `moduleid` int(11) DEFAULT NULL COMMENT '模块id',
  `infoid` int(11) DEFAULT NULL COMMENT '关联信息id',
  `username` varchar(255) DEFAULT NULL COMMENT '评论用户名',
  `userip` varchar(255) DEFAULT NULL COMMENT 'IP',
  `addtime` varchar(255) DEFAULT NULL COMMENT '评论时间',
  `content` text COMMENT '评论内容',
  `useragent` varchar(255) DEFAULT NULL COMMENT '用户代理信息',
  `status` int(11) DEFAULT '0' COMMENT '评论状态 0 未通过 1 已通过',
  `other` text COMMENT '其它',
  PRIMARY KEY (`itemid`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COMMENT='评论信息表';

#
# Data for table "ruiec_comment"
#

INSERT INTO `ruiec_comment` VALUES (2,1,18,9,'ZongLiang2','192.168.1.3','1354878176','aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11',0,NULL),(5,1,18,9,'ZongLiang2','192.168.1.3','1354878176','aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11',0,NULL),(7,1,18,15,'ZongLiang2','192.168.1.3','1354878176','aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11',0,'a:2:{s:5:\"email\";s:16:\"649236041@qq.com\";s:2:\"qq\";s:6:\"545454\";}'),(14,0,18,15,'阿斯达斯','192.168.1.104','1355909689','aaaaaaaaaaa','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11',0,'a:2:{s:5:\"email\";s:16:\"746436329@qq.com\";s:2:\"qq\";s:6:\"545454\";}'),(15,0,18,15,'','192.168.1.3','1355975494','','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11',0,'a:2:{s:5:\"email\";s:0:\"\";s:2:\"qq\";s:0:\"\";}'),(16,0,18,9,'zongliang','192.168.1.3','1356056728','哈哈. 正好看下会怎么样...','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.97 Safari/537.11',0,'a:2:{s:5:\"email\";s:16:\"649236041@qq.com\";s:2:\"qq\";s:9:\"649236041\";}'),(17,0,18,9,'zongliang','192.168.1.3','1356056858','哈哈. 正好看下会怎么样...','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.97 Safari/537.11',0,'a:2:{s:5:\"email\";s:16:\"649236041@qq.com\";s:2:\"qq\";s:9:\"649236041\";}'),(18,0,18,9,'Test...','192.168.1.3','1356057805','111111111111111111','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.97 Safari/537.11',0,'a:2:{s:5:\"email\";s:20:\"zl59503020@gmail.com\";s:2:\"qq\";s:6:\"123456\";}'),(19,0,18,11,'ASDA','192.168.1.104','1356057891','746436329746436329746436329746436329746436329746436329746436329746436329746436329746436329','Mozilla/5.0 (Windows NT 6.2; rv:17.0) Gecko/20100101 Firefox/17.0',1,'a:2:{s:5:\"email\";s:16:\"746436329@qq.com\";s:2:\"qq\";s:9:\"746436329\";}'),(20,0,18,18,'ZongLiang','192.168.1.3','1356058342','估计应该是财务部门吧?','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.97 Safari/537.11',1,'a:2:{s:5:\"email\";s:16:\"649236041@qq.com\";s:2:\"qq\";s:16:\"649236041@qq.com\";}'),(21,0,18,18,'China','192.168.1.3','1356058455','估计可能是吧. 哈哈..','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.97 Safari/537.11',1,'a:2:{s:5:\"email\";s:19:\"zongliang@gmail.com\";s:2:\"qq\";s:9:\"542123156\";}'),(22,0,18,9,'aaaaaa','192.168.1.3','1356062630','...原来如此...','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.97 Safari/537.11',1,'a:2:{s:5:\"email\";s:16:\"649236041@qq.com\";s:2:\"qq\";s:9:\"111111111\";}'),(23,0,18,9,'ChinaMaYang','192.168.1.3','1356062746','深圳前海附近的道路畅通如常...','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.97 Safari/537.11',1,'a:2:{s:5:\"email\";s:16:\"562248302@qq.com\";s:2:\"qq\";s:9:\"562248302\";}'),(24,0,18,11,'ASDA','192.168.1.104','1356063034','ASDAASDAASDAASDAASDAASDA','Mozilla/5.0 (Windows NT 6.2; rv:17.0) Gecko/20100101 Firefox/17.0',1,'a:2:{s:5:\"email\";s:16:\"746436329@qq.com\";s:2:\"qq\";s:9:\"746436329\";}'),(25,0,18,11,'ASDA','192.168.1.104','1356063070','ASDAASDAASDA','Mozilla/5.0 (Windows NT 6.2; rv:17.0) Gecko/20100101 Firefox/17.0',1,'a:2:{s:5:\"email\";s:16:\"746436329@qq.com\";s:2:\"qq\";s:9:\"746436329\";}'),(26,0,18,17,'zongliang','192.168.1.3','1356078907','office 学生版???','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.97 Safari/537.11',1,'a:2:{s:5:\"email\";s:16:\"649236041@qq.com\";s:2:\"qq\";s:9:\"562248302\";}'),(27,0,18,16,'a','192.168.1.3','1356081018','d','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.97 Safari/537.11',1,'a:2:{s:5:\"email\";s:1:\"b\";s:2:\"qq\";s:1:\"c\";}'),(28,0,18,16,'b','192.168.1.3','1356081091','ssss','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.97 Safari/537.11',1,'a:2:{s:5:\"email\";s:2:\"bc\";s:2:\"qq\";s:2:\"dd\";}');

#
# Source for table "ruiec_down_19"
#

DROP TABLE IF EXISTS `ruiec_down_19`;
CREATE TABLE `ruiec_down_19` (
  `itemid` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `catid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '栏目ID',
  `level` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '级别',
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '标题',
  `downurl` varchar(500) NOT NULL DEFAULT '' COMMENT '资源共享链接',
  `introduce` varchar(500) NOT NULL DEFAULT '' COMMENT '内容简介',
  `content` longtext NOT NULL COMMENT '内容说明',
  `tag` varchar(100) NOT NULL DEFAULT '' COMMENT '标签',
  `keyword` varchar(255) NOT NULL DEFAULT '' COMMENT '关键字',
  `author` varchar(50) NOT NULL DEFAULT '' COMMENT '作者',
  `copyfrom` varchar(30) NOT NULL DEFAULT '' COMMENT '来源',
  `fromurl` varchar(255) NOT NULL DEFAULT '' COMMENT '来源链接',
  `hits` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '点击次数',
  `downcount` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '下载次数',
  `thumb` varchar(255) NOT NULL DEFAULT '' COMMENT '标题图片',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `edittime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  `ip` varchar(50) NOT NULL DEFAULT '' COMMENT 'IP',
  `template` varchar(30) NOT NULL DEFAULT '0' COMMENT '内容模版',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `islink` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否为外部链接',
  `linkurl` varchar(255) NOT NULL DEFAULT '' COMMENT '链接地址',
  `filename` varchar(255) NOT NULL DEFAULT '' COMMENT '自定义文件名称',
  `note` varchar(255) NOT NULL DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`itemid`),
  KEY `addtime` (`addtime`),
  KEY `catid` (`catid`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='资源共享';

#
# Data for table "ruiec_down_19"
#

/*!40000 ALTER TABLE `ruiec_down_19` DISABLE KEYS */;
INSERT INTO `ruiec_down_19` VALUES (10,23,0,'Ruiec JavaScript 库.','http://192.168.1.3/file/upload/2012/12/22//13561607404210.rar','ruiec.js ','<p>ruiec.js &nbsp;<img src=\"http://192.168.1.3/file/upload/2012/12/22/15-19-27-94-1.gif\" /></p>','','Ruiec JavaScript 库.,源码分享','','','',6,105,'',1356160767,1356507688,'192.168.1.3','',3,0,'show.php?itemid=10','',''),(11,24,0,'国际信用卡PNG图标','http://192.168.1.3/file/upload/2012/12/25//135642378298.zip','国际信用卡PNG图标国际信用卡PNG图标','<p>国际信用卡PNG图标国际信用卡PNG图标国际信用卡PNG图标国际信用卡PNG图标国际信用卡PNG图标国际信用卡PNG图标国际信用卡PNG图标国际信用卡PNG图标国际信用卡PNG图标国际信用卡PNG图标国际信用卡PNG图标国际信用卡PNG图标国际信用卡PNG图标<br /></p>','LED世贸网','国际信用卡PNG图标,LED世贸网,图片素材','admin','LED世贸网','http://www.lcwto.com',1,0,'http://192.168.1.3/file/upload/2012/12/25//13564237636263.jpg.min.jpg',1356423807,1356507620,'192.168.1.106','',3,0,'show.php?itemid=11','','');
/*!40000 ALTER TABLE `ruiec_down_19` ENABLE KEYS */;

#
# Source for table "ruiec_fields"
#

DROP TABLE IF EXISTS `ruiec_fields`;
CREATE TABLE `ruiec_fields` (
  `itemid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ItemID',
  `tbname` varchar(255) DEFAULT NULL COMMENT '表名',
  `name` varchar(255) DEFAULT NULL COMMENT '字段名',
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `note` varchar(255) DEFAULT NULL COMMENT '提示',
  `type` varchar(255) DEFAULT NULL COMMENT '字段类型',
  `length` varchar(255) DEFAULT NULL COMMENT '长度',
  `html` varchar(255) DEFAULT NULL COMMENT 'HTML输入类型',
  `default_value` text COMMENT '默认值',
  `option_value` text COMMENT '选项',
  `other` text COMMENT '其它',
  PRIMARY KEY (`itemid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='自定义字段表';

#
# Data for table "ruiec_fields"
#


#
# Source for table "ruiec_groups"
#

DROP TABLE IF EXISTS `ruiec_groups`;
CREATE TABLE `ruiec_groups` (
  `itemid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '分组名称',
  `type` varchar(255) DEFAULT NULL COMMENT '分组类型',
  `competence` text COMMENT '权限',
  `other` varchar(255) DEFAULT NULL COMMENT '其它',
  PRIMARY KEY (`itemid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='用户分组表';

#
# Data for table "ruiec_groups"
#

INSERT INTO `ruiec_groups` VALUES (1,'系统内置','系统分组',NULL,NULL),(2,'超级管理员','自定义分组','a:10:{s:6:\"config\";s:1:\"1\";s:1:\"a\";s:1:\"1\";s:1:\"b\";s:1:\"1\";s:1:\"c\";s:1:\"1\";s:1:\"d\";s:1:\"1\";s:1:\"e\";s:1:\"1\";s:1:\"f\";s:1:\"1\";s:1:\"g\";s:1:\"1\";s:1:\"h\";s:1:\"1\";s:6:\"module\";a:4:{i:2;a:5:{s:6:\"insert\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:6:\"update\";s:1:\"1\";s:6:\"select\";s:1:\"1\";s:7:\"setting\";s:1:\"1\";}i:18;a:5:{s:6:\"insert\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:6:\"update\";s:1:\"1\";s:6:\"select\";s:1:\"1\";s:7:\"setting\";s:1:\"1\";}i:19;a:5:{s:6:\"insert\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:6:\"update\";s:1:\"1\";s:6:\"select\";s:1:\"1\";s:7:\"setting\";s:1:\"1\";}i:20;a:5:{s:6:\"insert\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:6:\"update\";s:1:\"1\";s:6:\"select\";s:1:\"1\";s:7:\"setting\";s:1:\"1\";}}}',NULL),(3,'管理员','自定义分组','a:10:{s:6:\"config\";s:1:\"1\";s:1:\"a\";s:1:\"1\";s:1:\"b\";s:1:\"1\";s:1:\"c\";s:1:\"1\";s:1:\"d\";s:1:\"1\";s:1:\"e\";s:1:\"1\";s:1:\"f\";s:1:\"1\";s:1:\"g\";s:1:\"1\";s:1:\"h\";s:1:\"1\";s:6:\"module\";a:4:{i:2;a:5:{s:6:\"insert\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:6:\"update\";s:1:\"1\";s:6:\"select\";s:1:\"1\";s:7:\"setting\";s:1:\"1\";}i:18;a:5:{s:6:\"insert\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:6:\"update\";s:1:\"1\";s:6:\"select\";s:1:\"1\";s:7:\"setting\";s:1:\"1\";}i:19;a:5:{s:6:\"insert\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:6:\"update\";s:1:\"1\";s:6:\"select\";s:1:\"1\";s:7:\"setting\";s:1:\"1\";}i:20;a:5:{s:6:\"insert\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:6:\"update\";s:1:\"1\";s:6:\"select\";s:1:\"1\";s:7:\"setting\";s:1:\"1\";}}}',NULL),(4,'VIP会员','自定义分组',NULL,NULL),(5,'会员','自定义分组',NULL,NULL),(6,'游客','自定义分组',NULL,NULL),(8,'测试分组','自定义添加','a:10:{s:6:\"config\";s:1:\"1\";s:1:\"a\";s:1:\"1\";s:1:\"b\";s:1:\"1\";s:1:\"c\";s:1:\"1\";s:1:\"d\";s:1:\"1\";s:1:\"e\";s:1:\"1\";s:1:\"f\";s:1:\"1\";s:1:\"g\";s:1:\"1\";s:1:\"h\";s:1:\"1\";s:6:\"module\";a:4:{i:2;a:5:{s:6:\"insert\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:6:\"update\";s:1:\"1\";s:6:\"select\";s:1:\"1\";s:7:\"setting\";s:1:\"1\";}i:18;a:5:{s:6:\"insert\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:6:\"update\";s:1:\"1\";s:6:\"select\";s:1:\"1\";s:7:\"setting\";s:1:\"1\";}i:19;a:5:{s:6:\"insert\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:6:\"update\";s:1:\"1\";s:6:\"select\";s:1:\"1\";s:7:\"setting\";s:1:\"1\";}i:20;a:5:{s:6:\"insert\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:6:\"update\";s:1:\"1\";s:6:\"select\";s:1:\"1\";s:7:\"setting\";s:1:\"1\";}}}','Guest');

#
# Source for table "ruiec_key_link"
#

DROP TABLE IF EXISTS `ruiec_key_link`;
CREATE TABLE `ruiec_key_link` (
  `Id` int(11) NOT NULL DEFAULT '0' COMMENT 'id',
  `key` varchar(255) DEFAULT NULL COMMENT '关键词',
  `url` varchar(255) DEFAULT NULL COMMENT '链接地址',
  `maxcount` int(11) DEFAULT NULL COMMENT '最多出现次数',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='内链表';

#
# Data for table "ruiec_key_link"
#


#
# Source for table "ruiec_logs"
#

DROP TABLE IF EXISTS `ruiec_logs`;
CREATE TABLE `ruiec_logs` (
  `itemid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL DEFAULT '' COMMENT '用户名',
  `content` text NOT NULL COMMENT '内容说明',
  `addtime` varchar(255) DEFAULT '' COMMENT '操作时间',
  `ip` varchar(255) DEFAULT NULL COMMENT '操作IP',
  `userAgent` varchar(500) DEFAULT NULL COMMENT '用户代理信息',
  PRIMARY KEY (`itemid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='记录日志表';

#
# Data for table "ruiec_logs"
#


#
# Source for table "ruiec_member"
#

DROP TABLE IF EXISTS `ruiec_member`;
CREATE TABLE `ruiec_member` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL COMMENT '用户名',
  `password` varchar(255) DEFAULT NULL COMMENT '密码',
  `email` varchar(255) DEFAULT NULL COMMENT '邮箱',
  `groupid` int(11) DEFAULT NULL COMMENT '用户组',
  `status` int(11) DEFAULT '1' COMMENT '0冻结1正常',
  `truename` varchar(255) DEFAULT NULL COMMENT '真实姓名',
  `sex` int(11) DEFAULT '1' COMMENT '性别',
  `company` varchar(255) DEFAULT NULL COMMENT '公司',
  `phone` varchar(255) DEFAULT NULL COMMENT '电话',
  `qq` varchar(255) DEFAULT NULL COMMENT 'QQ号码',
  `logincount` int(11) DEFAULT '0' COMMENT '登录次数',
  `lastlogintime` varchar(255) DEFAULT NULL COMMENT '上一次登录时间',
  `lastloginip` varchar(255) DEFAULT NULL COMMENT '上一次登录IP',
  `time` varchar(255) DEFAULT NULL COMMENT '注册时间',
  `ip` varchar(255) DEFAULT NULL COMMENT '注册IP',
  `userAgent` varchar(500) DEFAULT NULL COMMENT '注册用户代理',
  `other` text COMMENT '其它信息',
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='用户表';

#
# Data for table "ruiec_member"
#

INSERT INTO `ruiec_member` VALUES (1,'admin','cade3ae501d034295e1d52cf5f8219b4','348666262@qq.com',1,1,'ZongLiang',1,'深圳源中瑞科技有限公司','13418371347','348666262',0,'','163.125.209.2','','163.125.209.2','',NULL);

#
# Source for table "ruiec_module"
#

DROP TABLE IF EXISTS `ruiec_module`;
CREATE TABLE `ruiec_module` (
  `moduleid` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(255) DEFAULT NULL COMMENT '模型',
  `name` varchar(255) DEFAULT NULL COMMENT '模型名称',
  `moduledir` varchar(255) DEFAULT NULL COMMENT '模型目录',
  `domain` varchar(255) DEFAULT NULL COMMENT '绑定域名',
  `linkurl` varchar(255) DEFAULT NULL COMMENT '链接地址',
  `listorder` int(11) DEFAULT NULL COMMENT '排序',
  `islink` int(11) DEFAULT '0' COMMENT '外部链接',
  `ismenu` int(11) DEFAULT '0' COMMENT '是否出现在导航',
  `isblank` int(11) DEFAULT '0' COMMENT '是否新窗口打开',
  `disabled` int(11) DEFAULT '0' COMMENT '是否禁用',
  `installtime` varchar(255) DEFAULT NULL COMMENT '安装时间',
  PRIMARY KEY (`moduleid`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COMMENT='系统模型表';

#
# Data for table "ruiec_module"
#

INSERT INTO `ruiec_module` VALUES (1,'ruiec','核心模块','ruiec','http://www.ruiec.com/','http://192.168.1.3/',0,0,0,0,0,'1353501086'),(2,'member','会员系统','member','http://www.ruiec.com/','http://www.ruiec.com/',1,0,0,0,0,'1353501086'),(18,'article','新闻中心','news','','http://192.168.1.3/news/',18,0,1,0,0,'1353922275'),(19,'down','资源共享','down','','http://192.168.1.3/down/',19,0,1,0,0,'1356157958'),(20,'photo','美图欣赏','photos','','http://192.168.1.3/photos/',20,0,1,0,0,'1356661356');

#
# Source for table "ruiec_oauth"
#

DROP TABLE IF EXISTS `ruiec_oauth`;
CREATE TABLE `ruiec_oauth` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL DEFAULT '' COMMENT '会员名',
  `site` varchar(30) NOT NULL DEFAULT '' COMMENT '第三方平台',
  `openid` varchar(255) NOT NULL DEFAULT '' COMMENT '用户唯一标识',
  `nickname` varchar(255) NOT NULL DEFAULT '' COMMENT '昵称',
  `avatar` varchar(255) NOT NULL DEFAULT '' COMMENT '头像',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '空间地址',
  `logintimes` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '登录次数',
  `logintime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上次登录',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '绑定时间',
  PRIMARY KEY (`Id`),
  KEY `username` (`username`),
  KEY `site` (`site`,`openid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='一键登录';

#
# Data for table "ruiec_oauth"
#


#
# Source for table "ruiec_photo_20"
#

DROP TABLE IF EXISTS `ruiec_photo_20`;
CREATE TABLE `ruiec_photo_20` (
  `itemid` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `catid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '栏目ID',
  `level` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '级别',
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '标题',
  `introduce` varchar(500) NOT NULL DEFAULT '' COMMENT '内容简介',
  `tag` varchar(100) NOT NULL DEFAULT '' COMMENT '标签',
  `keyword` varchar(255) NOT NULL DEFAULT '' COMMENT '关键字',
  `author` varchar(50) NOT NULL DEFAULT '' COMMENT '作者',
  `copyfrom` varchar(30) NOT NULL DEFAULT '' COMMENT '来源',
  `fromurl` varchar(255) NOT NULL DEFAULT '' COMMENT '来源链接',
  `hits` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '点击次数',
  `thumb` varchar(255) NOT NULL DEFAULT '' COMMENT '标题图片',
  `images` longtext NOT NULL COMMENT '图片地址',
  `content` longtext NOT NULL COMMENT '内容',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `edittime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  `ip` varchar(50) NOT NULL DEFAULT '' COMMENT 'IP',
  `template` varchar(30) NOT NULL DEFAULT '0' COMMENT '内容模版',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `islink` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否为外部链接',
  `linkurl` varchar(255) NOT NULL DEFAULT '' COMMENT '链接地址',
  `filename` varchar(255) NOT NULL DEFAULT '' COMMENT '自定义文件名称',
  `note` varchar(255) NOT NULL DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`itemid`),
  KEY `addtime` (`addtime`),
  KEY `catid` (`catid`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='美图欣赏';

#
# Data for table "ruiec_photo_20"
#

/*!40000 ALTER TABLE `ruiec_photo_20` DISABLE KEYS */;
/*!40000 ALTER TABLE `ruiec_photo_20` ENABLE KEYS */;

#
# Source for table "ruiec_question_verify"
#

DROP TABLE IF EXISTS `ruiec_question_verify`;
CREATE TABLE `ruiec_question_verify` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) DEFAULT NULL COMMENT '问题',
  `answer` varchar(255) DEFAULT NULL COMMENT '答案',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='问题验证表';

#
# Data for table "ruiec_question_verify"
#


#
# Source for table "ruiec_search_keys"
#

DROP TABLE IF EXISTS `ruiec_search_keys`;
CREATE TABLE `ruiec_search_keys` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) DEFAULT NULL COMMENT '关键字',
  `count` int(11) DEFAULT '0' COMMENT '次数',
  `ishot` int(1) DEFAULT '0' COMMENT '是否热门',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='搜索关键字表';

#
# Data for table "ruiec_search_keys"
#


#
# Source for table "ruiec_seo_infos"
#

DROP TABLE IF EXISTS `ruiec_seo_infos`;
CREATE TABLE `ruiec_seo_infos` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL DEFAULT '' COMMENT 'key',
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `keywords` varchar(255) DEFAULT NULL COMMENT '关键词',
  `description` text COMMENT '描述',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='SEO信息表';

#
# Data for table "ruiec_seo_infos"
#


#
# Source for table "ruiec_setting"
#

DROP TABLE IF EXISTS `ruiec_setting`;
CREATE TABLE `ruiec_setting` (
  `item` int(11) DEFAULT NULL COMMENT '类型',
  `item_key` varchar(255) DEFAULT NULL COMMENT '键',
  `item_value` text COMMENT '值'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='设置信息表';

#
# Data for table "ruiec_setting"
#

INSERT INTO `ruiec_setting` VALUES (0,'backtime','1354064056'),(19,'template_index',''),(19,'template_list',''),(19,'template_show',''),(19,'template_search',''),(19,'thumb_width','120'),(19,'thumb_height','90'),(19,'introduce_length','120'),(19,'order','addtime desc'),(19,'save_remotepic','1'),(19,'clear_link','1'),(19,'level','推荐下载|热门资源'),(19,'page_islide','5'),(19,'page_icat','10'),(19,'show_icat','1'),(19,'page_irecimg','10'),(19,'page_ihits','10'),(19,'pagesize','20'),(19,'page_child','10'),(19,'show_lcat','1'),(19,'page_lrecimg','10'),(19,'page_lrec','10'),(19,'page_lhits','10'),(19,'page_srelate','10'),(19,'page_srecimg','10'),(19,'page_srec','10'),(19,'page_shits','10'),(19,'max_width','750'),(19,'comment','1'),(19,'show_np','1'),(19,'index_html','0'),(19,'list_html','0'),(19,'htm_list_prefix',''),(19,'htm_list_urlid','0'),(19,'php_list_urlid','3'),(19,'show_html','0'),(19,'htm_item_prefix',''),(19,'htm_item_urlid','1'),(19,'php_item_urlid','3'),(19,'seo_title_index','{模块名称}{分隔符}{页码}{网站名称}'),(19,'seo_keywords_index',''),(19,'seo_description_index',''),(19,'seo_title_list','{分类SEO标题}{页码}{模块名称}{分隔符}{网站名称}'),(19,'seo_keywords_list',''),(19,'seo_description_list',''),(19,'seo_title_show','{内容标题}{分隔符}{分类名称}{模块名称}{分隔符}{网站名称}'),(19,'seo_keywords_show',''),(19,'seo_description_show',''),(19,'seo_title_search','{关键词}{分类名称}{模块名称}搜索{分隔符}{页码}{网站名称}'),(19,'seo_keywords_search',''),(19,'seo_description_search',''),(18,'template_index',''),(18,'template_list',''),(18,'template_show',''),(18,'template_search',''),(18,'thumb_width','120'),(18,'thumb_height','90'),(18,'introduce_length','120'),(18,'order','addtime desc'),(18,'save_remotepic','1'),(18,'clear_link','1'),(18,'level','文字类文章推荐|幻灯图片|推荐图文|头条相关|头条推荐|图片类文章推荐'),(18,'page_islide','5'),(18,'page_icat','10'),(18,'show_icat','1'),(18,'page_irecimg','10'),(18,'page_ihits','10'),(18,'pagesize','5'),(18,'page_child','10'),(18,'show_lcat','1'),(18,'page_lrecimg','10'),(18,'page_lrec','10'),(18,'page_lhits','10'),(18,'page_srelate','10'),(18,'page_srecimg','10'),(18,'page_srec','10'),(18,'page_shits','10'),(18,'max_width','750'),(18,'comment','1'),(18,'show_np','1'),(18,'index_html','1'),(18,'list_html','0'),(18,'htm_list_prefix',''),(18,'htm_list_urlid','0'),(18,'php_list_urlid','3'),(18,'show_html','0'),(18,'htm_item_prefix',''),(18,'htm_item_urlid','1'),(18,'php_item_urlid','3'),(18,'seo_title_index','{模块名称}{分隔符}{页码}{网站名称}'),(18,'seo_keywords_index',''),(18,'seo_description_index',''),(18,'seo_title_list','{分类SEO标题}{页码}{模块名称}{分隔符}{网站名称}'),(18,'seo_keywords_list',''),(18,'seo_description_list',''),(18,'seo_title_show','{内容标题}{分隔符}{分类名称}{模块名称}{分隔符}{网站名称}'),(18,'seo_keywords_show',''),(18,'seo_description_show',''),(18,'seo_title_search','{关键词}{分类名称}{模块名称}搜索{分隔符}{页码}{网站名称}'),(18,'seo_keywords_search',''),(18,'seo_description_search',''),(1,'sitename','源中瑞网络传媒CMS'),(1,'weblogo','http://192.168.1.3/file/upload/2012/11/21/20121121114913_89942.gif'),(1,'webcrod','110'),(1,'webcopyright','Copyright © 2010 - 2015. ruiec.com. All Rights Reserved.<br />电话：00000000000 QQ:000000000 Email:ruiec@ruiec.com'),(1,'webcompany','深圳源中瑞科技有限公司'),(1,'webtel',''),(1,'webmail','649236041@qq.com'),(1,'editor','ueditor'),(1,'webstatus','1'),(1,'webcloseinfo','网站维护中，请稍候访问...'),(1,'seo_delimiter','_'),(1,'seo_title','源中瑞网络传媒_CMS系统'),(1,'seo_keywords','CMS'),(1,'seo_description','Ruiec CMS System.'),(1,'index','index'),(1,'file_ext','html'),(1,'index_html','0'),(1,'rewrite','0'),(1,'log_404','1'),(1,'smtp_host','smtp.qq.com'),(1,'smtp_port','25'),(1,'smtp_user','348666262@qq.com'),(1,'smtp_pass','ledoem'),(1,'mail_name','RuiecCMS'),(1,'mail_sign','-- by ruiec CMS.'),(1,'mail_log','1'),(20,'template_index',''),(20,'template_list',''),(20,'template_show',''),(20,'template_search',''),(20,'thumb_width','120'),(20,'thumb_height','90'),(20,'introduce_length','120'),(20,'order','addtime desc'),(20,'save_remotepic','1'),(20,'clear_link','1'),(20,'level','推荐文章|幻灯图片|推荐图文|头条相关|头条推荐'),(20,'page_islide','5'),(20,'page_icat','10'),(20,'show_icat','1'),(20,'page_irecimg','10'),(20,'page_ihits','10'),(20,'pagesize','20'),(20,'page_child','10'),(20,'show_lcat','1'),(20,'page_lrecimg','10'),(20,'page_lrec','10'),(20,'page_lhits','10'),(20,'page_srelate','10'),(20,'page_srecimg','10'),(20,'page_srec','10'),(20,'page_shits','10'),(20,'max_width','750'),(20,'comment','1'),(20,'show_np','1'),(20,'index_html','1'),(20,'list_html','0'),(20,'htm_list_prefix',''),(20,'htm_list_urlid','0'),(20,'php_list_urlid','3'),(20,'show_html','0'),(20,'htm_item_prefix',''),(20,'htm_item_urlid','1'),(20,'php_item_urlid','3'),(20,'seo_title_index','{模块名称}{分隔符}{页码}{网站名称}'),(20,'seo_keywords_index',''),(20,'seo_description_index',''),(20,'seo_title_list','{分类SEO标题}{页码}{模块名称}{分隔符}{网站名称}'),(20,'seo_keywords_list',''),(20,'seo_description_list',''),(20,'seo_title_show','{内容标题}{分隔符}{分类名称}{模块名称}{分隔符}{网站名称}'),(20,'seo_keywords_show',''),(20,'seo_description_show',''),(20,'seo_title_search','{关键词}{分类名称}{模块名称}搜索{分隔符}{页码}{网站名称}'),(20,'seo_keywords_search',''),(20,'seo_description_search',''),(20,'title_index','{$seo_modulename}{$seo_delimiter}{$seo_page}{$seo_sitename}'),(20,'title_list','{$seo_cattitle}{$seo_page}{$seo_modulename}{$seo_delimiter}{$seo_sitename}'),(20,'title_show','{$seo_showtitle}{$seo_delimiter}{$seo_catname}{$seo_modulename}{$seo_delimiter}{$seo_sitename}'),(20,'title_search','{$seo_kw}{$seo_catname}{$seo_modulename}搜索{$seo_delimiter}{$seo_page}{$seo_sitename}'),(20,'keywords_index',''),(20,'keywords_list',''),(20,'keywords_show',''),(20,'keywords_search',''),(20,'description_index',''),(20,'description_list',''),(20,'description_show',''),(20,'description_search','');

#
# Source for table "ruiec_shield_keys"
#

DROP TABLE IF EXISTS `ruiec_shield_keys`;
CREATE TABLE `ruiec_shield_keys` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) DEFAULT NULL COMMENT '关键字',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='屏蔽关键字';

#
# Data for table "ruiec_shield_keys"
#


#
# Source for table "ruiec_spider_info"
#

DROP TABLE IF EXISTS `ruiec_spider_info`;
CREATE TABLE `ruiec_spider_info` (
  `spiderid` int(11) NOT NULL AUTO_INCREMENT COMMENT '蜘蛛ID',
  `key` varchar(255) DEFAULT NULL COMMENT '关键字',
  `value` varchar(255) DEFAULT NULL COMMENT '名称',
  `other` varchar(255) DEFAULT NULL COMMENT '其它信息',
  PRIMARY KEY (`spiderid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='蜘蛛信息表';

#
# Data for table "ruiec_spider_info"
#

INSERT INTO `ruiec_spider_info` VALUES (1,'baidu','百度蜘蛛',NULL),(2,'google','Google蜘蛛',NULL),(3,'yahoo','雅虎蜘蛛',NULL),(4,'bing','Bing蜘蛛',NULL),(5,'soso','Soso蜘蛛',NULL),(6,'sogou','搜狗蜘蛛',NULL),(7,'other','其它蜘蛛',NULL);

#
# Source for table "ruiec_spider_logs"
#

DROP TABLE IF EXISTS `ruiec_spider_logs`;
CREATE TABLE `ruiec_spider_logs` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '蜘蛛名称',
  `surl` varchar(255) DEFAULT NULL COMMENT '来源URL',
  `furl` varchar(255) DEFAULT NULL COMMENT '爬行地址',
  `time` varchar(255) DEFAULT NULL COMMENT '爬行时间',
  `ip` varchar(255) DEFAULT NULL COMMENT '蜘蛛IP',
  `userAgent` varchar(500) DEFAULT NULL COMMENT '代理信息',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='蜘蛛爬行日志';

#
# Data for table "ruiec_spider_logs"
#


#
# Source for table "ruiec_tags"
#

DROP TABLE IF EXISTS `ruiec_tags`;
CREATE TABLE `ruiec_tags` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL DEFAULT '' COMMENT '关键字',
  `content` text COMMENT '内容',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='自定义标签表';

#
# Data for table "ruiec_tags"
#


#
# Source for table "ruiec_upload_logs"
#

DROP TABLE IF EXISTS `ruiec_upload_logs`;
CREATE TABLE `ruiec_upload_logs` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL DEFAULT '' COMMENT '上传用户',
  `fileurl` varchar(500) NOT NULL DEFAULT '' COMMENT '文件路径',
  `filetype` varchar(255) DEFAULT NULL COMMENT '文件类型',
  `filesize` varchar(255) DEFAULT NULL COMMENT '文件大小',
  `time` varchar(255) DEFAULT NULL COMMENT '操作时间',
  `ip` varchar(255) DEFAULT NULL COMMENT '上传IP地址',
  `userAgent` varchar(500) DEFAULT NULL COMMENT '操作用户代理信息',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文件上传记录表';

#
# Data for table "ruiec_upload_logs"
#


/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

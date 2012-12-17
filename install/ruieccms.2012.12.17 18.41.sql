# Host: localhost  (Version: 5.5.24-log)
# Date: 2012-12-17 18:41:50
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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COMMENT='404记录日志表';

#
# Data for table "ruiec_404"
#

INSERT INTO `ruiec_404` VALUES (3,'http://www.baidu.com/','http://192.168.1.3/demo/artDialog/_doc/new.html','Guest','1354926823','192.168.1.3','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML,Google) Chrome/23.0.1271.95 Safari/537.11'),(11,'http://bbs.csdn.net/topics/360015963','http://localhost/fenzhi/index.php?sk=1251931143xg','Guest','1355541157','127.0.0.1','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11'),(12,'','http://192.168.1.3/news.php','Guest','1355725067','192.168.1.88','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11'),(13,'http://192.168.1.3/news/list.php?catid=7','http://192.168.1.3/scripts/jquery/jquery-1.3.2.min.js','Guest','1355726118','192.168.1.88','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11'),(14,'http://192.168.1.3/news/list.php?catid=7','http://192.168.1.3/templates/green/js/base.js','Guest','1355726118','192.168.1.88','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11'),(15,'http://192.168.1.3/news/list.php?catid=7','http://192.168.1.3/skin/images/body_bg.gif','Guest','1355726118','192.168.1.88','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11'),(16,'http://192.168.1.3/news/list.php?catid=7','http://192.168.1.3/skin/images/logo.png','Guest','1355726118','192.168.1.88','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11'),(17,'http://192.168.1.3/news/list.php?catid=7','http://192.168.1.3/file/JavaScript/templates/green/js/base.js','Guest','1355726598','192.168.1.88','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11'),(18,'http://192.168.1.3/news/list.php?catid=7','http://192.168.1.3/skin/images/gotop.gif','Guest','1355726614','192.168.1.88','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11'),(19,'http://192.168.1.3/news/','http://192.168.1.3/skin/dt/images/gotop.gif','Guest','1355726842','192.168.1.88','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11'),(20,'http://192.168.1.3/news/','http://192.168.1.3/skin/dt/images/logo.png','Guest','1355726901','192.168.1.88','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11'),(21,'http://192.168.1.3/news/','http://192.168.1.3/skin/dt/layout.css','Guest','1355728195','192.168.1.88','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11'),(22,'http://192.168.1.3/news/','http://192.168.1.3/skin/dt/base.css','Guest','1355728195','192.168.1.88','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11'),(23,'http://192.168.1.3/admin.php?file=comment&mid=18','http://192.168.1.3/skin/dt/image/messagebg.gif','Guest','1355729294','192.168.1.3','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11'),(24,'http://192.168.1.3/admin.php?file=comment&mid=18','http://192.168.1.3/skin/dt/image/message.gif','Guest','1355729294','192.168.1.3','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11'),(25,'http://192.168.1.3/news/','http://192.168.1.3/skin/images/icon_arrow_blue.gif','Guest','1355729427','192.168.1.88','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11'),(26,'http://192.168.1.3/news/','http://192.168.1.3/skin/images/sprite.gif','Guest','1355729427','192.168.1.88','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11'),(27,'http://192.168.1.3/news/','http://192.168.1.3/upload/201210/22/201210221025591061.jpg','Guest','1355729427','192.168.1.88','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11'),(28,'http://192.168.1.3/news/','http://192.168.1.3/skin/dt/images/sprite.gif','Guest','1355730083','192.168.1.88','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11'),(29,'http://192.168.1.3/news/','http://192.168.1.3/news/show-75.aspx','Guest','1355730843','192.168.1.3','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11');

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
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='新闻中心';

#
# Data for table "ruiec_article_18"
#

/*!40000 ALTER TABLE `ruiec_article_18` DISABLE KEYS */;
INSERT INTO `ruiec_article_18` VALUES (8,7,0,'公司主页快照','aaaaaaaaaaa','','公司主页快照,php 函数大全','','','',3,'http://www.taociwto.com/file/upload/201011/13/11-29-41-97-181.jpg',1354877686,1354878176,'192.168.1.3','',3,0,'show.php?itemid=8','',''),(9,11,1,'习近平视察深圳 现场无欢迎横幅及列队迎送','国家领导人车队昨日到深圳视察，据香港媒体报道，这是习近平任总书记后首次离京视察，深圳前海附近道路畅通如常，现场没有任何欢迎横幅，也没有列队迎送的环节。凤凰卫视昨日《华文大直播》节目播出“习近平视察深圳无列队欢送环节”。据报道，国家领导人车队','','习近平视察深圳 现场无欢迎横幅及列队迎送,My-News','','','',4,'',1354938333,1354938333,'192.168.1.3','',3,0,'show.php?itemid=9','','');
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
INSERT INTO `ruiec_article_data_18` VALUES (8,'<p>00000000bbbbbbbbbbbbbbb<br /></p>'),(9,'<p style=\"font-size:14px;line-height:23px;text-indent:2em;color:#2b2b2b;font-family:宋体, serif;text-align:justify;background-color:#ffffff;\">国家领导人车队昨日到深圳视察，据香港媒体报道，这是习近平任总书记后首次离京视察，深圳前海附近道路畅通如常，现场没有任何欢迎横幅，也没有列队迎送的环节。</p><p style=\"font-size:14px;line-height:23px;text-indent:2em;color:#2b2b2b;font-family:宋体, serif;text-align:justify;background-color:#ffffff;\">凤凰卫视昨日《华文大直播》节目播出“习近平视察深圳无列队欢送环节”。据报道，国家领导人车队昨日到深圳视察，记者在蛇口港看到标志性牌子，写着“空谈误国”、“实干兴邦”，习近平在11月底视察时提出空谈误国和实干兴邦的概念。</p><p style=\"font-size:14px;line-height:23px;text-indent:2em;color:#2b2b2b;font-family:宋体, serif;text-align:justify;background-color:#ffffff;\">昨日下午，记者看到深圳前海附近的道路畅通如常，下午三点半时看到由8辆车组成的一个车队进入深圳前海深港合作区，但现场没有看到任何的欢迎横幅，也没有列队迎送的这样一个环节。</p><p style=\"font-size:14px;line-height:23px;text-indent:2em;color:#2b2b2b;font-family:宋体, serif;text-align:justify;background-color:#ffffff;\">此前，中共中央政治局会议出台规定，要求领导干部调研要轻车简从，减少交通管制，一般是不封路。现场有建设工人说，看来中央的高层是说到做到。有工作人员称，希望中央高层这次到前海能够带来更多的优惠政策。记者在事后采访前海管理局局长郑宏杰，他表示，详细情况稍后会向大家公布。据了解，中央高层一行在周末还将前往莲花山公园，并到渔民村看望民众。</p><p style=\"font-size:14px;line-height:23px;text-indent:2em;color:#2b2b2b;font-family:宋体, serif;text-align:justify;background-color:#ffffff;\">据报道，今年是邓小平“92南巡”20周年，有舆论认为中央高层重走南巡路也是意在展现坚持改革开放的决心。</p><p><br /></p>');
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='分类表';

#
# Data for table "ruiec_category"
#

INSERT INTO `ruiec_category` VALUES (7,18,'php 函数大全','function','list.php?catid=7',0,0,'','','','bbbbb','ccccccccccccccccccccccc'),(11,18,'My-News','news-my','list.php?catid=11',0,0,'','','','MYNEWS','bbbbbbbbb'),(13,18,'Test News','testNews','list.php?catid=13',11,0,'','','TTTTTT','TTTTTTTTTTTTT','TTTTTTTTTTTTTTTTTTTTT'),(14,18,'function','14','list.php?catid=14',7,0,'','','','fffffff','ffcccccccccc'),(15,18,'数码产品','shuma','list.php?catid=15',0,0,'','','','',''),(16,18,'平板电脑','pingban','list.php?catid=16',15,0,'','','','',''),(17,18,'苹果','apple','list.php?catid=17',16,0,'','','','','');

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
  `other` varchar(500) DEFAULT NULL COMMENT '其它',
  PRIMARY KEY (`itemid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='评论信息表';

#
# Data for table "ruiec_comment"
#

INSERT INTO `ruiec_comment` VALUES (2,1,18,9,'ZongLiang2','192.168.1.3','1354878176','aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11',1,NULL),(5,1,18,9,'ZongLiang2','192.168.1.3','1354878176','aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11',1,NULL),(7,1,18,9,'ZongLiang2','192.168.1.3','1354878176','aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11',1,NULL);

#
# Source for table "ruiec_groups"
#

DROP TABLE IF EXISTS `ruiec_groups`;
CREATE TABLE `ruiec_groups` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '分组名称',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='用户分组表';

#
# Data for table "ruiec_groups"
#

INSERT INTO `ruiec_groups` VALUES (1,'超级管理员'),(2,'管理员'),(3,'VIP会员'),(4,'会员'),(5,'游客');

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
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='用户表';

#
# Data for table "ruiec_member"
#

INSERT INTO `ruiec_member` VALUES (1,'admin','cade3ae501d034295e1d52cf5f8219b4','348666262@qq.com',1,'ZongLiang',1,'深圳源中瑞科技有限公司','13418371347','348666262',0,'','163.125.209.2','','163.125.209.2','');

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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='系统模型表';

#
# Data for table "ruiec_module"
#

INSERT INTO `ruiec_module` VALUES (1,'ruiec','核心模块','ruiec','http://www.ruiec.com/','http://192.168.1.3/',0,0,0,0,0,'1353501086'),(2,'member','会员系统','member','http://www.ruiec.com/','http://www.ruiec.com/',1,0,0,0,0,'1353501086'),(18,'article','新闻中心','news','','http://192.168.1.3/news/',18,0,1,0,0,'1353922275');

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

INSERT INTO `ruiec_setting` VALUES (0,'backtime','1354064056'),(1,'sitename','源中瑞网络传媒CMS'),(1,'weblogo','http://192.168.1.3/file/upload/2012/11/21/20121121114913_89942.gif'),(1,'webcrod','110'),(1,'webcopyright','Copyright © 2010 - 2015. ruiec.com. All Rights Reserved.<br />电话：00000000000 QQ:000000000 Email:ruiec@ruiec.com'),(1,'webcompany','深圳源中瑞科技有限公司'),(1,'webtel',''),(1,'webmail','649236041@qq.com'),(1,'editor','ueditor'),(1,'webstatus','1'),(1,'webcloseinfo','网站维护中，请稍候访问...'),(1,'seo_delimiter','_'),(1,'seo_title','源中瑞网络传媒_CMS系统'),(1,'seo_keywords','CMS'),(1,'seo_description','Ruiec CMS System.'),(1,'rewrite','0'),(1,'log_404','1'),(1,'smtp_host','smtp.qq.com'),(1,'smtp_port','25'),(1,'smtp_user','348666262@qq.com'),(1,'smtp_pass','ledoem'),(1,'mail_name','RuiecCMS'),(1,'mail_sign','-- by ruiec CMS.'),(1,'mail_log','1'),(18,'template_index',''),(18,'template_list',''),(18,'template_show',''),(18,'template_search',''),(18,'thumb_width','120'),(18,'thumb_height','90'),(18,'introduce_length','120'),(18,'order','addtime desc'),(18,'save_remotepic','1'),(18,'clear_link','1'),(18,'level','推荐文章|幻灯图片|推荐图文|头条相关|头条推荐'),(18,'page_islide','5'),(18,'page_icat','10'),(18,'show_icat','1'),(18,'page_irecimg','10'),(18,'page_ihits','10'),(18,'pagesize','20'),(18,'page_child','10'),(18,'show_lcat','1'),(18,'page_lrecimg','10'),(18,'page_lrec','10'),(18,'page_lhits','10'),(18,'page_srelate','10'),(18,'page_srecimg','10'),(18,'page_srec','10'),(18,'page_shits','10'),(18,'max_width','750'),(18,'comment','1'),(18,'show_np','1'),(18,'index_html','1'),(18,'list_html','0'),(18,'htm_list_prefix',''),(18,'htm_list_urlid','0'),(18,'php_list_urlid','3'),(18,'show_html','0'),(18,'htm_item_prefix',''),(18,'htm_item_urlid','1'),(18,'php_item_urlid','3'),(18,'seo_title_index','{模块名称}{分隔符}{页码}{网站名称}'),(18,'seo_keywords_index',''),(18,'seo_description_index',''),(18,'seo_title_list','{分类SEO标题}{页码}{模块名称}{分隔符}{网站名称}'),(18,'seo_keywords_list',''),(18,'seo_description_list',''),(18,'seo_title_show','{内容标题}{分隔符}{分类名称}{模块名称}{分隔符}{网站名称}'),(18,'seo_keywords_show',''),(18,'seo_description_show',''),(18,'seo_title_search','{关键词}{分类名称}{模块名称}搜索{分隔符}{页码}{网站名称}'),(18,'seo_keywords_search',''),(18,'seo_description_search','');

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

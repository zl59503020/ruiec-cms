# Host: localhost  (Version: 5.5.24-log)
# Date: 2012-11-22 18:52:02
# Generator: MySQL-Front 5.3  (Build 1.18)

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
# Source for table "ruiec_404_logs"
#

DROP TABLE IF EXISTS `ruiec_404_logs`;
CREATE TABLE `ruiec_404_logs` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `surl` varchar(255) DEFAULT NULL COMMENT '来源路径',
  `furl` varchar(255) NOT NULL DEFAULT '' COMMENT '访问路径',
  `time` varchar(255) DEFAULT NULL COMMENT '操作时间',
  `ip` varchar(255) DEFAULT NULL COMMENT '操作IP地址',
  `userAgent` varchar(500) DEFAULT NULL COMMENT '用户代理信息',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='404记录日志表';

#
# Data for table "ruiec_404_logs"
#


#
# Source for table "ruiec_ads"
#

DROP TABLE IF EXISTS `ruiec_ads`;
CREATE TABLE `ruiec_ads` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL COMMENT '广告标题',
  `type` int(11) DEFAULT '0' COMMENT '广告类型 0:文字 1:图片 2:flash 3:自定义',
  `url` varchar(255) DEFAULT NULL COMMENT '广告链接',
  `content` text COMMENT '内容',
  `starttime` varchar(255) DEFAULT NULL COMMENT '开始时间',
  `overtime` varchar(255) DEFAULT NULL COMMENT '结束时间',
  `width` int(11) DEFAULT '0' COMMENT '宽',
  `height` int(11) DEFAULT '0' COMMENT '高',
  `time` varchar(255) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='广告表';

#
# Data for table "ruiec_ads"
#


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
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL DEFAULT '' COMMENT '用户名',
  `content` text NOT NULL COMMENT '内容说明',
  `time` varchar(255) DEFAULT '' COMMENT '操作时间',
  `ip` varchar(255) DEFAULT NULL COMMENT '操作IP',
  `userAgent` varchar(500) DEFAULT NULL COMMENT '用户代理信息',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='记录日志表';

#
# Data for table "ruiec_logs"
#


#
# Source for table "ruiec_member_groups"
#

DROP TABLE IF EXISTS `ruiec_member_groups`;
CREATE TABLE `ruiec_member_groups` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '分组名称',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='用户分组表';

#
# Data for table "ruiec_member_groups"
#

INSERT INTO `ruiec_member_groups` VALUES (1,'超级管理员'),(2,'管理员'),(3,'VIP会员'),(4,'会员');

#
# Source for table "ruiec_members"
#

DROP TABLE IF EXISTS `ruiec_members`;
CREATE TABLE `ruiec_members` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL COMMENT '用户名',
  `password` varchar(255) DEFAULT NULL COMMENT '密码',
  `email` varchar(255) DEFAULT NULL COMMENT '邮箱',
  `groupid` int(11) DEFAULT '1' COMMENT '组',
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
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='用户表';

#
# Data for table "ruiec_members"
#

INSERT INTO `ruiec_members` VALUES (1,'admin','cade3ae501d034295e1d52cf5f8219b4','348666262@qq.com',1,'ZongLiang',1,'深圳源中瑞科技有限公司','13418371347','348666262',0,NULL,NULL,NULL,NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='系统模型表';

#
# Data for table "ruiec_module"
#

INSERT INTO `ruiec_module` VALUES (1,'ruiec','核心模块','ruiec','http://www.ruiec.com/','http://192.168.1.3/',0,0,0,0,0,'1353501086'),(2,'member','会员系统','member','http://www.ruiec.com/','http://www.ruiec.com/',1,0,0,0,0,'1353501086'),(5,'down','资源共享','down','','http://192.168.1.3/down/',5,0,1,1,1,'1353509254'),(6,'article','新闻中心','news','','http://192.168.1.3/news/',4,0,1,1,0,'1353501086');

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

INSERT INTO `ruiec_setting` VALUES (1,'sitename','源中瑞网络传媒CMS'),(1,'weblogo','http://192.168.1.3/file/upload/2012/11/21/20121121114913_89942.gif'),(1,'webcrod','110'),(1,'webcopyright','Copyright © 2010 - 2015. ruiec.com. All Rights Reserved.'),(1,'webcompany','深圳源中瑞科技有限公司'),(1,'webtel',''),(1,'webmail','649236041@qq.com'),(1,'webstatus','1'),(1,'webcloseinfo','网站维护中，请稍候访问...'),(1,'seo_delimiter','_'),(1,'seo_title','源中瑞网络传媒_CMS系统'),(1,'seo_keywords','CMS'),(1,'seo_description','Ruiec CMS System.'),(1,'rewrite','0'),(1,'log_404','1'),(1,'smtp_host','smtp.qq.com'),(1,'smtp_port','25'),(1,'smtp_user','348666262@qq.com'),(1,'smtp_pass','ledoem'),(1,'mail_name','RuiecCMS'),(1,'mail_sign','-- by ruiec CMS.'),(1,'mail_log','1'),(0,'backtime','1353581159');

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

# Host: localhost  (Version: 5.5.24-log)
# Date: 2012-12-05 18:56:55
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `surl` varchar(255) DEFAULT NULL COMMENT '来源路径',
  `furl` varchar(255) NOT NULL DEFAULT '' COMMENT '访问路径',
  `time` varchar(255) DEFAULT NULL COMMENT '操作时间',
  `ip` varchar(255) DEFAULT NULL COMMENT '操作IP地址',
  `userAgent` varchar(500) DEFAULT NULL COMMENT '用户代理信息',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='404记录日志表';

#
# Data for table "ruiec_404"
#


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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='新闻中心';

#
# Data for table "ruiec_article_18"
#

/*!40000 ALTER TABLE `ruiec_article_18` DISABLE KEYS */;
INSERT INTO `ruiec_article_18` VALUES (1,1,1,'什么是伪静态？伪静态有何作用?','公共建筑节能的措施应根据现实情况加以强化和细化，从而令政策效力得以发挥。除了继续推动已经开展的墙体保...','建筑节能','缓解公共建筑节能困境需强力政策措施,建筑节能,低碳经济,国内','admin','','',100,'http://192.168.1.3/file/upload/2012/11/21/20121121114913_89942.gif',1335684791,1335684918,'192.168.1.3','0',3,0,'show.php?itemid=1','','');
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
INSERT INTO `ruiec_article_data_18` VALUES (1,'<p><span style=\"background-color:#FFFFFF;color:#444444;font-family:&#39;microsoft yahei&#39;, tahoma, verdana, simsun;font-size:14px;line-height:42px;-webkit-text-size-adjust:none;\"> &nbsp; &nbsp;伪静态是相对真实静态来讲的，真实静态会生成一个html或htm后缀的文件，访客能够访问到真实存在的静态页面，而伪静态则没有生成实体静态页面文件，而仅仅是以.html一类的静态页面形式,但其实是用PHP程序动态脚本来处理的，这就是伪静态。</span><br /></p><div style=\"color:#444444;font-family:&#39;microsoft yahei&#39;, tahoma, verdana, simsun;font-size:14px;line-height:42px;-webkit-text-size-adjust:none;background-color:#ffffff;\"> </div><div style=\"color:#444444;font-family:&#39;microsoft yahei&#39;, tahoma, verdana, simsun;font-size:14px;line-height:42px;-webkit-text-size-adjust:none;background-color:#ffffff;\"><strong>静态页面的优缺点：</strong></div><div style=\"color:#444444;font-family:&#39;microsoft yahei&#39;, tahoma, verdana, simsun;font-size:14px;line-height:42px;-webkit-text-size-adjust:none;background-color:#ffffff;\"> &nbsp; &nbsp;真实静态通常是为了更好的缓解服务器压力，和增强搜索引擎的友好面，所以都将网页内容生成静态页面。但最大缺陷是每次在网站后台修改网页内容都需要重新生成静态页面，无法实时显示更新的内容，而久之网站内容多了，占用的空间大小以及每次生成静态页面所耗费的服务器资源也不容小觑（有出现内容过多且一次性生成静态页面而导致服务器奔溃的案例）。</div><div style=\"color:#444444;font-family:&#39;microsoft yahei&#39;, tahoma, verdana, simsun;font-size:14px;line-height:42px;-webkit-text-size-adjust:none;background-color:#ffffff;\"> </div><div style=\"color:#444444;font-family:&#39;microsoft yahei&#39;, tahoma, verdana, simsun;font-size:14px;line-height:42px;-webkit-text-size-adjust:none;background-color:#ffffff;\"><strong>伪静态有什么作用？</strong></div><div style=\"color:#444444;font-family:&#39;microsoft yahei&#39;, tahoma, verdana, simsun;font-size:14px;line-height:42px;-webkit-text-size-adjust:none;background-color:#ffffff;\"> &nbsp; &nbsp;有的朋友为了实时的显示一些信息，或者还想运用动态脚本解决一些问题，不能用静态的方式来展示网站内容，但是这就损失了对搜索引擎的友好面，怎么样在两者之间找个中间方法呢？这就产生了伪静态技术。</div><div style=\"color:#444444;font-family:&#39;microsoft yahei&#39;, tahoma, verdana, simsun;font-size:14px;line-height:42px;-webkit-text-size-adjust:none;background-color:#ffffff;\"> </div><div style=\"color:#444444;font-family:&#39;microsoft yahei&#39;, tahoma, verdana, simsun;font-size:14px;line-height:42px;-webkit-text-size-adjust:none;background-color:#ffffff;\"><strong>伪静态有什么不足？</strong></div><div style=\"color:#444444;font-family:&#39;microsoft yahei&#39;, tahoma, verdana, simsun;font-size:14px;line-height:42px;-webkit-text-size-adjust:none;background-color:#ffffff;\"> &nbsp; &nbsp;由于伪静态是用正则判断需要跳转到的页面而不是真实页面地址，分辨到底显示哪个页面的责任也由直接指定转由服务器CPU来判断了，所以CPU占有量的上升，确实是伪静态最大的弊病。</div><div style=\"color:#444444;font-family:&#39;microsoft yahei&#39;, tahoma, verdana, simsun;font-size:14px;line-height:42px;-webkit-text-size-adjust:none;background-color:#ffffff;\"> </div><div style=\"color:#444444;font-family:&#39;microsoft yahei&#39;, tahoma, verdana, simsun;font-size:14px;line-height:42px;-webkit-text-size-adjust:none;background-color:#ffffff;\"><span style=\"font-size:12px;\">Ruiec建议：</span></div><ol style=\"padding:0px 0px 0px 25px;margin:0px;color:#444444;font-family:&#39;microsoft yahei&#39;, tahoma, verdana, simsun;font-size:14px;line-height:42px;-webkit-text-size-adjust:none;background-color:#ffffff;\"><li style=\"margin:0px;padding:0px;\"><p>企业网站一般都可以开启伪静态，因为企业站点访问量一般不大，伪静态对CPU的影响也较小，如果访问量大也可以升级服务器来解决。</p></li><li style=\"margin:0px;padding:0px;\"><p>根据空间访问速度来选择，如国外空间建议开真实静态，而国内空间访问应该较快，基本都可以选择开启伪静态。</p></li><li style=\"margin:0px;padding:0px;\"><p>伪静态与真实静态只可选择一个，因为URL格式不一样，频繁更换会让搜索引擎摸不着北，站点上线后选择其中一种就应该坚持下去。</p></li></ol><p><br /></p>');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='分类表';

#
# Data for table "ruiec_category"
#

INSERT INTO `ruiec_category` VALUES (1,18,'测试新闻分类','xinwen','list.php?catid=1',0,0,NULL,NULL,NULL,NULL,NULL),(2,18,'国内新闻','guoneixinwen','list.php?catid=2',1,0,NULL,NULL,NULL,NULL,NULL),(3,18,'湖南新闻','hunanxinwen','list.php?catid=3',2,0,NULL,NULL,NULL,NULL,NULL),(4,18,'科技新闻分类','kejixinwen','list.php?catid=4',0,0,NULL,NULL,NULL,NULL,NULL),(5,18,'国外新闻','guowaixinwen','list.php?catid=5',1,0,NULL,NULL,NULL,NULL,NULL),(6,18,'php编程开发','phpcode',NULL,0,0,'','','Title...','key.','desc.'),(7,18,'php 函数大全','function',NULL,6,0,'','show-test','aaaaaaaaaaaaaaaa','bbbbb','ccccccccccccccccccccccc'),(8,18,'php 匿名函数','nofunction','list.php?catid=8',6,0,'','','0000000','111111111111','22222222222');

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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL DEFAULT '' COMMENT '用户名',
  `content` text NOT NULL COMMENT '内容说明',
  `time` varchar(255) DEFAULT '' COMMENT '操作时间',
  `ip` varchar(255) DEFAULT NULL COMMENT '操作IP',
  `userAgent` varchar(500) DEFAULT NULL COMMENT '用户代理信息',
  PRIMARY KEY (`id`)
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

INSERT INTO `ruiec_setting` VALUES (18,'fee_view','0'),(18,'fee_add','0'),(18,'fee_currency','money'),(18,'fee_mode','0'),(18,'question_add','2'),(18,'captcha_add','2'),(18,'check_add','2'),(18,'group_color','7'),(18,'group_search','3,5,6,7'),(18,'group_show','3,5,6,7'),(18,'group_list','3,5,6,7'),(18,'seo_description_search',''),(18,'group_index','3,5,6,7'),(18,'seo_keywords_search',''),(18,'seo_title_search','{关键词}{地区}{分类名称}{模块名称}搜索{分隔符}{页码}{网站名称}'),(18,'seo_description_show',''),(18,'seo_keywords_show',''),(18,'seo_title_show','{内容标题}{分隔符}{分类名称}{模块名称}{分隔符}{网站名称}'),(18,'seo_keywords_list',''),(18,'seo_description_list',''),(18,'seo_title_list','{分类SEO标题}{页码}{模块名称}{分隔符}{网站名称}'),(18,'seo_description_index',''),(18,'seo_keywords_index',''),(18,'seo_title_index','{模块名称}{分隔符}{页码}{网站名称}'),(18,'php_item_urlid','0'),(18,'htm_item_urlid','1'),(18,'htm_item_prefix',''),(18,'show_html','0'),(18,'php_list_urlid','0'),(18,'htm_list_urlid','0'),(18,'htm_list_prefix',''),(18,'list_html','0'),(18,'index_html','0'),(18,'show_np','1'),(18,'max_width','550'),(18,'page_shits','10'),(18,'page_srec','10'),(18,'page_srecimg','4'),(18,'page_srelate','10'),(18,'page_lhits','10'),(18,'page_lrecimg','4'),(18,'page_lrec','10'),(18,'show_lcat','1'),(18,'page_child','6'),(18,'pagesize','20'),(18,'page_ihits','10'),(18,'page_irecimg','6'),(18,'show_icat','1'),(18,'page_icat','6'),(18,'page_islide','3'),(18,'swfu','2'),(18,'fulltext','1'),(18,'level','推荐文章|幻灯图片|推荐图文|头条相关|头条推荐'),(18,'clear_link','0'),(18,'keylink','1'),(18,'split','0'),(18,'cat_property','0'),(18,'save_remotepic','0'),(18,'order','addtime desc'),(18,'fields','itemid,title,thumb,linkurl,style,catid,introduce,addtime,edittime,username,islink'),(18,'editor','ruiec'),(18,'introduce_length','120'),(18,'thumb_height','90'),(18,'thumb_width','120'),(18,'template_search',''),(18,'template_show',''),(18,'template_list',''),(18,'template_index',''),(18,'fee_period','0'),(18,'pre_view','500'),(18,'credit_add','2'),(18,'credit_del','5'),(18,'credit_color','100'),(18,'title_index','{$seo_modulename}{$seo_delimiter}{$seo_page}{$seo_sitename}'),(18,'title_list','{$seo_catname}{$seo_cattitle}{$seo_page}{$seo_modulename}{$seo_delimiter}{$seo_sitename}'),(18,'title_show','{$seo_showtitle}{$seo_delimiter}{$seo_catname}{$seo_modulename}{$seo_delimiter}{$seo_sitename}'),(18,'title_search','{$seo_kw}{$seo_areaname}{$seo_catname}{$seo_modulename}搜索{$seo_delimiter}{$seo_page}{$seo_sitename}'),(18,'keywords_index',''),(18,'keywords_list',''),(18,'keywords_show',''),(18,'keywords_search',''),(18,'description_index',''),(18,'description_list',''),(18,'description_show',''),(18,'description_search',''),(18,'moduleid','21'),(18,'name','资讯'),(18,'moduledir','news'),(18,'module','article'),(18,'ismenu','1'),(18,'domain',''),(18,'linkurl','http://www.ruiec.com/news/'),(0,'backtime','1354064056'),(1,'sitename','源中瑞网络传媒CMS'),(1,'weblogo','http://192.168.1.3/file/upload/2012/11/21/20121121114913_89942.gif'),(1,'webcrod','110'),(1,'webcopyright','Copyright © 2010 - 2015. ruiec.com. All Rights Reserved.'),(1,'webcompany','深圳源中瑞科技有限公司'),(1,'webtel',''),(1,'webmail','649236041@qq.com'),(1,'editor','ueditor'),(1,'webstatus','1'),(1,'webcloseinfo','网站维护中，请稍候访问...'),(1,'seo_delimiter','_'),(1,'seo_title','源中瑞网络传媒_CMS系统'),(1,'seo_keywords','CMS'),(1,'seo_description','Ruiec CMS System.'),(1,'rewrite','0'),(1,'log_404','1'),(1,'smtp_host','smtp.qq.com'),(1,'smtp_port','25'),(1,'smtp_user','348666262@qq.com'),(1,'smtp_pass','ledoem'),(1,'mail_name','RuiecCMS'),(1,'mail_sign','-- by ruiec CMS.'),(1,'mail_log','1');

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

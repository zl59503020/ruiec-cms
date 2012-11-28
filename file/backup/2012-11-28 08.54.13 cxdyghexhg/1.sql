# RuiecCMS V1.0 R2012-11-10 http://www.ruiec.com
# 2012-11-28 08:54:13
# --------------------------------------------------------


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


DROP TABLE IF EXISTS `ruiec_article_18`;
CREATE TABLE `ruiec_article_18` (
  `itemid` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `catid` int(10) unsigned NOT NULL DEFAULT '0',
  `areaid` int(10) unsigned NOT NULL DEFAULT '0',
  `level` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL DEFAULT '',
  `style` varchar(50) NOT NULL DEFAULT '',
  `fee` float NOT NULL DEFAULT '0',
  `subtitle` text NOT NULL,
  `introduce` varchar(255) NOT NULL DEFAULT '',
  `tag` varchar(100) NOT NULL DEFAULT '',
  `keyword` varchar(255) NOT NULL DEFAULT '',
  `pptword` varchar(255) NOT NULL DEFAULT '',
  `author` varchar(50) NOT NULL DEFAULT '',
  `copyfrom` varchar(30) NOT NULL DEFAULT '',
  `fromurl` varchar(255) NOT NULL DEFAULT '',
  `voteid` varchar(100) NOT NULL DEFAULT '',
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `thumb` varchar(255) NOT NULL DEFAULT '',
  `username` varchar(30) NOT NULL DEFAULT '',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `editor` varchar(30) NOT NULL DEFAULT '',
  `edittime` int(10) unsigned NOT NULL DEFAULT '0',
  `ip` varchar(50) NOT NULL DEFAULT '',
  `template` varchar(30) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `islink` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `linkurl` varchar(255) NOT NULL DEFAULT '',
  `filepath` varchar(255) NOT NULL DEFAULT '',
  `note` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`itemid`),
  KEY `addtime` (`addtime`),
  KEY `catid` (`catid`),
  KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='新闻中心';


DROP TABLE IF EXISTS `ruiec_article_data_18`;
CREATE TABLE `ruiec_article_data_18` (
  `itemid` bigint(20) unsigned NOT NULL DEFAULT '0',
  `content` longtext NOT NULL,
  PRIMARY KEY (`itemid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='新闻中心内容';


DROP TABLE IF EXISTS `ruiec_groups`;
CREATE TABLE `ruiec_groups` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '分组名称',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='用户分组表';

INSERT INTO `ruiec_groups` VALUES('1','超级管理员');
INSERT INTO `ruiec_groups` VALUES('2','管理员');
INSERT INTO `ruiec_groups` VALUES('3','VIP会员');
INSERT INTO `ruiec_groups` VALUES('4','会员');
INSERT INTO `ruiec_groups` VALUES('5','游客');

DROP TABLE IF EXISTS `ruiec_key_link`;
CREATE TABLE `ruiec_key_link` (
  `Id` int(11) NOT NULL DEFAULT '0' COMMENT 'id',
  `key` varchar(255) DEFAULT NULL COMMENT '关键词',
  `url` varchar(255) DEFAULT NULL COMMENT '链接地址',
  `maxcount` int(11) DEFAULT NULL COMMENT '最多出现次数',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='内链表';


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

INSERT INTO `ruiec_member` VALUES('1','admin','cade3ae501d034295e1d52cf5f8219b4','348666262@qq.com','1','ZongLiang','1','深圳源中瑞科技有限公司','13418371347','348666262','0','','163.125.209.2','','163.125.209.2','');

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

INSERT INTO `ruiec_module` VALUES('1','ruiec','核心模块','ruiec','http://www.ruiec.com/','http://192.168.1.3/','0','0','0','0','0','1353501086');
INSERT INTO `ruiec_module` VALUES('2','member','会员系统','member','http://www.ruiec.com/','http://www.ruiec.com/','1','0','0','0','0','1353501086');
INSERT INTO `ruiec_module` VALUES('18','article','新闻中心','news','','http://192.168.1.3/news/','18','0','1','0','0','1353922275');

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


DROP TABLE IF EXISTS `ruiec_question_verify`;
CREATE TABLE `ruiec_question_verify` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) DEFAULT NULL COMMENT '问题',
  `answer` varchar(255) DEFAULT NULL COMMENT '答案',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='问题验证表';


DROP TABLE IF EXISTS `ruiec_search_keys`;
CREATE TABLE `ruiec_search_keys` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) DEFAULT NULL COMMENT '关键字',
  `count` int(11) DEFAULT '0' COMMENT '次数',
  `ishot` int(1) DEFAULT '0' COMMENT '是否热门',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='搜索关键字表';


DROP TABLE IF EXISTS `ruiec_seo_infos`;
CREATE TABLE `ruiec_seo_infos` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL DEFAULT '' COMMENT 'key',
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `keywords` varchar(255) DEFAULT NULL COMMENT '关键词',
  `description` text COMMENT '描述',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='SEO信息表';


DROP TABLE IF EXISTS `ruiec_setting`;
CREATE TABLE `ruiec_setting` (
  `item` int(11) DEFAULT NULL COMMENT '类型',
  `item_key` varchar(255) DEFAULT NULL COMMENT '键',
  `item_value` text COMMENT '值'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='设置信息表';

INSERT INTO `ruiec_setting` VALUES('0','backtime','1353579251');
INSERT INTO `ruiec_setting` VALUES('1','sitename','源中瑞网络传媒CMS');
INSERT INTO `ruiec_setting` VALUES('1','weblogo','http://192.168.1.3/file/upload/2012/11/21/20121121114913_89942.gif');
INSERT INTO `ruiec_setting` VALUES('1','webcrod','110');
INSERT INTO `ruiec_setting` VALUES('1','webcopyright','Copyright © 2010 - 2015. ruiec.com. All Rights Reserved.');
INSERT INTO `ruiec_setting` VALUES('1','webcompany','深圳源中瑞科技有限公司');
INSERT INTO `ruiec_setting` VALUES('1','webtel','');
INSERT INTO `ruiec_setting` VALUES('1','webmail','649236041@qq.com');
INSERT INTO `ruiec_setting` VALUES('1','webstatus','1');
INSERT INTO `ruiec_setting` VALUES('1','webcloseinfo','网站维护中，请稍候访问...');
INSERT INTO `ruiec_setting` VALUES('1','seo_delimiter','_');
INSERT INTO `ruiec_setting` VALUES('1','seo_title','源中瑞网络传媒_CMS系统');
INSERT INTO `ruiec_setting` VALUES('1','seo_keywords','CMS');
INSERT INTO `ruiec_setting` VALUES('1','seo_description','Ruiec CMS System.');
INSERT INTO `ruiec_setting` VALUES('1','rewrite','0');
INSERT INTO `ruiec_setting` VALUES('1','log_404','1');
INSERT INTO `ruiec_setting` VALUES('1','smtp_host','smtp.qq.com');
INSERT INTO `ruiec_setting` VALUES('1','smtp_port','25');
INSERT INTO `ruiec_setting` VALUES('1','smtp_user','348666262@qq.com');
INSERT INTO `ruiec_setting` VALUES('1','smtp_pass','ledoem');
INSERT INTO `ruiec_setting` VALUES('1','mail_name','RuiecCMS');
INSERT INTO `ruiec_setting` VALUES('1','mail_sign','-- by ruiec CMS.');
INSERT INTO `ruiec_setting` VALUES('1','mail_log','1');
INSERT INTO `ruiec_setting` VALUES('18','fee_view','0');
INSERT INTO `ruiec_setting` VALUES('18','fee_add','0');
INSERT INTO `ruiec_setting` VALUES('18','fee_currency','money');
INSERT INTO `ruiec_setting` VALUES('18','fee_mode','0');
INSERT INTO `ruiec_setting` VALUES('18','question_add','2');
INSERT INTO `ruiec_setting` VALUES('18','captcha_add','2');
INSERT INTO `ruiec_setting` VALUES('18','check_add','2');
INSERT INTO `ruiec_setting` VALUES('18','group_color','7');
INSERT INTO `ruiec_setting` VALUES('18','group_search','3,5,6,7');
INSERT INTO `ruiec_setting` VALUES('18','group_show','3,5,6,7');
INSERT INTO `ruiec_setting` VALUES('18','group_list','3,5,6,7');
INSERT INTO `ruiec_setting` VALUES('18','seo_description_search','');
INSERT INTO `ruiec_setting` VALUES('18','group_index','3,5,6,7');
INSERT INTO `ruiec_setting` VALUES('18','seo_keywords_search','');
INSERT INTO `ruiec_setting` VALUES('18','seo_title_search','{关键词}{地区}{分类名称}{模块名称}搜索{分隔符}{页码}{网站名称}');
INSERT INTO `ruiec_setting` VALUES('18','seo_description_show','');
INSERT INTO `ruiec_setting` VALUES('18','seo_keywords_show','');
INSERT INTO `ruiec_setting` VALUES('18','seo_title_show','{内容标题}{分隔符}{分类名称}{模块名称}{分隔符}{网站名称}');
INSERT INTO `ruiec_setting` VALUES('18','seo_keywords_list','');
INSERT INTO `ruiec_setting` VALUES('18','seo_description_list','');
INSERT INTO `ruiec_setting` VALUES('18','seo_title_list','{分类SEO标题}{页码}{模块名称}{分隔符}{网站名称}');
INSERT INTO `ruiec_setting` VALUES('18','seo_description_index','');
INSERT INTO `ruiec_setting` VALUES('18','seo_keywords_index','');
INSERT INTO `ruiec_setting` VALUES('18','seo_title_index','{模块名称}{分隔符}{页码}{网站名称}');
INSERT INTO `ruiec_setting` VALUES('18','php_item_urlid','0');
INSERT INTO `ruiec_setting` VALUES('18','htm_item_urlid','1');
INSERT INTO `ruiec_setting` VALUES('18','htm_item_prefix','');
INSERT INTO `ruiec_setting` VALUES('18','show_html','0');
INSERT INTO `ruiec_setting` VALUES('18','php_list_urlid','0');
INSERT INTO `ruiec_setting` VALUES('18','htm_list_urlid','0');
INSERT INTO `ruiec_setting` VALUES('18','htm_list_prefix','');
INSERT INTO `ruiec_setting` VALUES('18','list_html','0');
INSERT INTO `ruiec_setting` VALUES('18','index_html','0');
INSERT INTO `ruiec_setting` VALUES('18','show_np','1');
INSERT INTO `ruiec_setting` VALUES('18','max_width','550');
INSERT INTO `ruiec_setting` VALUES('18','page_shits','10');
INSERT INTO `ruiec_setting` VALUES('18','page_srec','10');
INSERT INTO `ruiec_setting` VALUES('18','page_srecimg','4');
INSERT INTO `ruiec_setting` VALUES('18','page_srelate','10');
INSERT INTO `ruiec_setting` VALUES('18','page_lhits','10');
INSERT INTO `ruiec_setting` VALUES('18','page_lrecimg','4');
INSERT INTO `ruiec_setting` VALUES('18','page_lrec','10');
INSERT INTO `ruiec_setting` VALUES('18','show_lcat','1');
INSERT INTO `ruiec_setting` VALUES('18','page_child','6');
INSERT INTO `ruiec_setting` VALUES('18','pagesize','20');
INSERT INTO `ruiec_setting` VALUES('18','page_ihits','10');
INSERT INTO `ruiec_setting` VALUES('18','page_irecimg','6');
INSERT INTO `ruiec_setting` VALUES('18','show_icat','1');
INSERT INTO `ruiec_setting` VALUES('18','page_icat','6');
INSERT INTO `ruiec_setting` VALUES('18','page_islide','3');
INSERT INTO `ruiec_setting` VALUES('18','swfu','2');
INSERT INTO `ruiec_setting` VALUES('18','fulltext','1');
INSERT INTO `ruiec_setting` VALUES('18','level','推荐文章|幻灯图片|推荐图文|头条相关|头条推荐');
INSERT INTO `ruiec_setting` VALUES('18','clear_link','0');
INSERT INTO `ruiec_setting` VALUES('18','keylink','1');
INSERT INTO `ruiec_setting` VALUES('18','split','0');
INSERT INTO `ruiec_setting` VALUES('18','cat_property','0');
INSERT INTO `ruiec_setting` VALUES('18','save_remotepic','0');
INSERT INTO `ruiec_setting` VALUES('18','order','addtime desc');
INSERT INTO `ruiec_setting` VALUES('18','fields','itemid,title,thumb,linkurl,style,catid,introduce,addtime,edittime,username,islink');
INSERT INTO `ruiec_setting` VALUES('18','editor','ruiec');
INSERT INTO `ruiec_setting` VALUES('18','introduce_length','120');
INSERT INTO `ruiec_setting` VALUES('18','thumb_height','90');
INSERT INTO `ruiec_setting` VALUES('18','thumb_width','120');
INSERT INTO `ruiec_setting` VALUES('18','template_search','');
INSERT INTO `ruiec_setting` VALUES('18','template_show','');
INSERT INTO `ruiec_setting` VALUES('18','template_list','');
INSERT INTO `ruiec_setting` VALUES('18','template_index','');
INSERT INTO `ruiec_setting` VALUES('18','fee_period','0');
INSERT INTO `ruiec_setting` VALUES('18','pre_view','500');
INSERT INTO `ruiec_setting` VALUES('18','credit_add','2');
INSERT INTO `ruiec_setting` VALUES('18','credit_del','5');
INSERT INTO `ruiec_setting` VALUES('18','credit_color','100');
INSERT INTO `ruiec_setting` VALUES('18','title_index','{$seo_modulename}{$seo_delimiter}{$seo_page}{$seo_sitename}');
INSERT INTO `ruiec_setting` VALUES('18','title_list','{$seo_catname}{$seo_cattitle}{$seo_page}{$seo_modulename}{$seo_delimiter}{$seo_sitename}');
INSERT INTO `ruiec_setting` VALUES('18','title_show','{$seo_showtitle}{$seo_delimiter}{$seo_catname}{$seo_modulename}{$seo_delimiter}{$seo_sitename}');
INSERT INTO `ruiec_setting` VALUES('18','title_search','{$seo_kw}{$seo_areaname}{$seo_catname}{$seo_modulename}搜索{$seo_delimiter}{$seo_page}{$seo_sitename}');
INSERT INTO `ruiec_setting` VALUES('18','keywords_index','');
INSERT INTO `ruiec_setting` VALUES('18','keywords_list','');
INSERT INTO `ruiec_setting` VALUES('18','keywords_show','');
INSERT INTO `ruiec_setting` VALUES('18','keywords_search','');
INSERT INTO `ruiec_setting` VALUES('18','description_index','');
INSERT INTO `ruiec_setting` VALUES('18','description_list','');
INSERT INTO `ruiec_setting` VALUES('18','description_show','');
INSERT INTO `ruiec_setting` VALUES('18','description_search','');
INSERT INTO `ruiec_setting` VALUES('18','moduleid','21');
INSERT INTO `ruiec_setting` VALUES('18','name','资讯');
INSERT INTO `ruiec_setting` VALUES('18','moduledir','news');
INSERT INTO `ruiec_setting` VALUES('18','module','article');
INSERT INTO `ruiec_setting` VALUES('18','ismenu','1');
INSERT INTO `ruiec_setting` VALUES('18','domain','');
INSERT INTO `ruiec_setting` VALUES('18','linkurl','http://www.ruiec.com/news/');

DROP TABLE IF EXISTS `ruiec_shield_keys`;
CREATE TABLE `ruiec_shield_keys` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) DEFAULT NULL COMMENT '关键字',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='屏蔽关键字';


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


DROP TABLE IF EXISTS `ruiec_tags`;
CREATE TABLE `ruiec_tags` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL DEFAULT '' COMMENT '关键字',
  `content` text COMMENT '内容',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='自定义标签表';


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



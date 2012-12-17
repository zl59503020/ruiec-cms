DROP TABLE IF EXISTS `ruiec_article_6`;
CREATE TABLE `ruiec_article_6` (
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
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='资讯';

DROP TABLE IF EXISTS `ruiec_article_data_6`;
CREATE TABLE `ruiec_article_data_6` (
  `itemid` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '新闻ID',
  `content` longtext NOT NULL COMMENT '内容',
  PRIMARY KEY (`itemid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='资讯内容';
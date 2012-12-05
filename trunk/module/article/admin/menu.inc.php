<?php
defined('IN_RUIEC') or exit('Access Denied');
$menu = array(
	array('text' => '添加'.$name, 'url' => '?moduleid='.$moduleid.'&action=add'),
	array('text' => $name.'列表', 'url' => '?moduleid='.$moduleid),
	array('text' => '审核'.$name, 'url' => '?moduleid='.$moduleid.'&action=check'),
	array('text' => '分类管理', 'url' => '?file=category&mid='.$moduleid),
	array('text' => '更新数据', 'url' => '?moduleid='.$moduleid.'&action=html'),
	array('text' => '模块设置', 'url' => '?file=setting&moduleid='.$moduleid)
);
?>
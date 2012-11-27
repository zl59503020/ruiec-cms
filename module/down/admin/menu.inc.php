<?php
defined('IN_RUIEC') or exit('Access Denied');
$menu = array(
	array('text' => '添加'.$MCFG['name'], 'url' => '?module='.$MCFG['module'].'&action=con'),
	array('text' => $MCFG['name'].'列表', 'url' => '?module='.$MCFG['module'].'&action=list'),
	array('text' => '审核'.$MCFG['name'], 'url' => '?module='.$MCFG['module'].'&action=check'),
	array('text' => '分类管理', 'url' => '?module='.$MCFG['module'].'&file=setting'),
	array('text' => '更新数据', 'url' => '?module='.$MCFG['module'].'&action=html'),
	array('text' => '模块设置', 'url' => '?module='.$MCFG['module'].'&file=setting'),
);
?>
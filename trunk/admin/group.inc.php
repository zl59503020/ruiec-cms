<?php
defined('IN_RUIEC') or exit('Access Denied');

if(in_array($action,array('add','edit'))){
	$modules = array();
	$result = $db->query("SELECT * FROM {$RE_PRE}module ORDER BY listorder ASC");
	while($r = $db->fetch_array($result)) {
		if($r['moduleid'] == 1) continue;
		$modules[] = $r;
	}
}

switch($action) {
	case 'add':
		if(isset($v_ruiec_sm) && $v_ruiec_sm == 'ruiec'){
			if($post['name'] == '') die('组名不能为空!');
			$rename = $db->get_one("SELECT name FROM {$RE_PRE}groups WHERE name='".$post['name']."'");
			if($rename != null) die('该组名已经存在!');
			$post['type'] = '自定义分组';
			$post['competence'] = serialize($post['competence']);
			$post['other'] = $_username;
			foreach($post as $k=>$v) {
				$sqlk .= ','.$k; $sqlv .= ",'$v'";
			}
			$sqlk = substr($sqlk, 1);
			$sqlv = substr($sqlv, 1);
			$db->query("INSERT INTO {$RE_PRE}groups ($sqlk) VALUES ($sqlv)");
			echo '0';
		}else{
			include tpl('group_add');
		}
		exit;
	break;
	case 'edit':
		isset($itemid) or die('Access Denied');
		if(isset($v_ruiec_sm) && $v_ruiec_sm == 'ruiec'){
			if($post['name'] == '') die('组名不能为空!');
			$rename = $db->get_one("SELECT name FROM {$RE_PRE}groups WHERE name='".$post['name']."' AND itemid NOT IN($itemid)");
			if($rename != null) die('该组名已经存在!');
			$post['competence'] = serialize($post['competence']);
			$db->query("UPDATE {$RE_PRE}groups SET name='{$post['name']}', competence='{$post['competence']}' WHERE itemid=$itemid");
			echo '0';
		}else{
			$groupinfo = $db->get_one("SELECT * FROM {$RE_PRE}groups WHERE itemid = $itemid");
			$groupinfo['competence'] = unserialize($groupinfo['competence']);
			extract($groupinfo, EXTR_SKIP);
			include tpl('group_edit');
		}
		exit;
	break;
	case 'delete':
		isset($itemid) or die('Access Denied');
		$db->query("DELETE FROM {$RE_PRE}groups WHERE itemid=$itemid");
		$db->query("UPDATE {$RE_PRE}member SET groupid=0,status=0 WHERE groupid=$itemid");
		die('0');
	break;
	default:
		$lists = array();
		$result = $db->query("SELECT * FROM {$RE_PRE}groups");
		while($r = $db->fetch_array($result)) {
			$r['uscount'] = $db->get_one("SELECT COUNT(*) AS ct FROM {$RE_PRE}member WHERE groupid={$r['itemid']}");
			$r['uscount'] = $r['uscount']['ct'];
			$lists[] = $r;
		}
		include tpl('group');
	break;
}
?>
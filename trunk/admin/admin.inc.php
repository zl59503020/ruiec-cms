<?php
defined('IN_RUIEC') or exit('Access Denied');
include RE_ROOT.'/admin/admin.class.php';
$do = new admin();
switch($action) {
	case 'add':
		if(isset($v_ruiec_sm) && $v_ruiec_sm == 'ruiec'){
			/* if($post['name'] == '') die('组名不能为空!');
			$rename = $db->get_one("SELECT name FROM {$RE_PRE}groups WHERE name='".$post['name']."' AND itemid NOT IN($itemid)");
			if($rename != null) die('该组名已经存在!');
			$post['competence'] = serialize($post['competence']);
			$db->query("UPDATE {$RE_PRE}groups SET name='{$post['name']}', competence='{$post['competence']}' WHERE itemid=$itemid"); */
			echo '0';
		}else{
			$groups = array();
			$result = $db->query("SELECT * FROM {$RE_PRE}groups");
			while($r = $db->fetch_array($result)) {
				$groups[] = $r;
			}
			include tpl('admin_add');
		}
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
	break;
	case 'delete':
		isset($userid) or die('Access Denied');
		$db->delete($userid);
		die('0');
	break;
	default:
		$lists = $do->get_list();
		include tpl('admin');
	break;
}
?>
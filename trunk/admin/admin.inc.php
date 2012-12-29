<?php
defined('IN_RUIEC') or exit('Access Denied');
include RE_ROOT.'/admin/admin.class.php';
$do = new admin();
switch($action) {
	case 'add':
		if(isset($v_ruiec_sm) && $v_ruiec_sm == 'ruiec'){
			if($post['username'] == '') die('用户名不能为空!');
			if($do->get_one($post['username'], true) == null){
				if($do->pass($post)){
					$do->add($post);
					die('0');
				}
			}else{
				die('该用户名已经存在!');
			}
		}else{
			$groups = array();
			$result = $db->query("SELECT * FROM {$RE_PRE}groups");
			while($r = $db->fetch_array($result)) {
				if($r['itemid'] != '1') $groups[] = $r;
			}
			include tpl('admin_add');
		}
	break;
	case 'edit':
		isset($userid) or die('Access Denied');
		$admin_info = $do->get_one($userid);
		if(isset($v_ruiec_sm) && $v_ruiec_sm == 'ruiec'){
			if(!$admin_info) die('该管理员不存在!');
			if($post['password'] != ''){
				if($post['passwords'] == '') die('请输入原密码!');
				if(md5($post['passwords']) != $admin_info['password']) die('原密码错误!');
			}
			$do->edit($post,$userid);
			die('0');
		}else{
			if(!$admin_info) message('管理员不存在!');
			$result = $db->get_one("SELECT name FROM {$RE_PRE}groups WHERE itemid = ".$admin_info['groupid']);
			$admin_info['groupname'] = $result['name'];
			$admin_info['other'] = unserialize($admin_info['other']);
			extract($admin_info, EXTR_SKIP);
			include tpl('admin_edit');
		}
	break;
	case 'delete':
		isset($userid) or die('Access Denied');
		$do->delete($userid);
		die('0');
	break;
	default:
		$lists = $do->get_list();
		include tpl('admin');
	break;
}
?>
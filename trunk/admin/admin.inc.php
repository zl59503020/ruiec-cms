<?php
defined('IN_RUIEC') or exit('Access Denied');
include RE_ROOT.'/admin/admin.class.php';
$do = new admin();
switch($action) {
	case 'add':
		//isset($username) or $username = '';
		//include tpl('admin_add');
		exit;
	break;
	case 'edit':
		/*
		if(!$userid) msg();
		$user = $do->get_one($userid, 0);
		include tpl('admin_edit');
		*/
		exit;
	break;
	case 'delete':
		/*
		if($do->delete_admin($username)) dmsg('撤销成功', $this_forward);
		msg($do->errmsg);
		*/
		die('0');
	break;
	default:
		$condition = 'groupid=1';
		$lists = $do->get_list($condition);
		include tpl('admin');
	break;
}
?>
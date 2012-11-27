<?php
defined('IN_RUIEC') or exit('Access Denied');
switch($action) {
	case 'phpinfo':
		phpinfo();
		exit;
	break;
	case 'html':
		msg('首页更新成功');
	break;
	case 'password':
		include tpl('password');
	break;
	default:
		include tpl('index');
	break;
}
?>
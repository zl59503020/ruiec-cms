<?php
defined('IN_RUIEC') or exit('Access Denied');

switch($action) {
	case 'add':
		
		break;
	case 'delete':
		die('0');
		break;
	default:
		include tpl('diy');
	break;
}

?>
<?php
defined('IN_RUIEC') or exit('Access Denied');

switch($action) {
	case 'add':
		die('add');
	break;
	case 'delete':
		die('delete');
	break;
	case 'edit':
		die('edit');
	break;
	default:
		$ads = array();
		include tpl('ad');
	break;
}

?>
﻿<?php
defined('IN_RUIEC') or exit('Access Denied');

switch($action) {
	case 'add':
		
	break;
	case 'delete':
		if(!$id) die('ID为空!');
		$db->query("DELETE FROM {$RE_PRE}404 WHERE id='$id'");
		die('0');
	break;
	case 'clear':
		$db->query("DELETE FROM {$RE_PRE}404");
		die('0');
	break;
	default:
		$condition = '1';
		$lists = array();
		$result = $db->query("SELECT * FROM {$RE_PRE}404 WHERE $condition ORDER BY id DESC");
		while($r = $db->fetch_array($result)) {
			$r['time'] = timetodate($r['time'], 5);
			$lists[] = $r;
		}
		include tpl('404');
	break;
}

?>
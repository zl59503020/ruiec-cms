<?php
defined('IN_RUIEC') or exit('Access Denied');

switch($action) {
	case 'delete':
		if(!$itemid) die('ID为空!');
		$db->query("DELETE FROM {$RE_PRE}logs WHERE itemid='$itemid'");
		die('0');
	break;
	case 'clear':
		$db->query("DELETE FROM {$RE_PRE}logs");
		die('0');
	break;
	default:
		$condition = '1';
		$lists = array();
		$result = $db->query("SELECT * FROM {$RE_PRE}logs WHERE $condition ORDER BY addtime DESC");
		while($r = $db->fetch_array($result)) {
			$r['addtime'] = timetodate($r['addtime'], 5);
			$lists[] = $r;
		}
		include tpl('log');
	break;
}

?>
<?php
defined('IN_RUIEC') or exit('Access Denied');

switch($action) {
	case 'delete':
		if(!$itemid) die('ID为空!');
		$db->query("DELETE FROM {$RE_PRE}404 WHERE itemid='$itemid'");
		die('0');
	break;
	case 'clear':
		$db->query("DELETE FROM {$RE_PRE}404");
		die('0');
	break;
	default:
		$condition = '1';
		$lists = array();
		$result = $db->query("SELECT * FROM {$RE_PRE}404 WHERE $condition ORDER BY addtime DESC");
		while($r = $db->fetch_array($result)) {
			$r['robot'] = get_spider($r['userAgent']);
			$r['addtime'] = timetodate($r['addtime'], 5);
			$lists[] = $r;
		}
		include tpl('404');
	break;
}

?>
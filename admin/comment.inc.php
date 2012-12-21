<?php
defined('IN_RUIEC') or exit('Access Denied');

switch($action) {
	case 'edit':
		isset($itemid) or die('Access Denied');
		
		$comment = $db->get_one("SELECT * FROM {$db->pre}comment WHERE itemid = $itemid");
		
		$comment['addtime'] = timetodate($comment['addtime']);
		$comment['other'] = unserialize($comment['other']);
		
		extract($comment, EXTR_SKIP);
		
		include tpl('comment_edit');
		
	break;
	case 'save':
		isset($itemid) or die('Access Denied');
		if(isset($v_ruiec_sm) && $v_ruiec_sm == 'ruiec' && isset($comment)){
			$db->query("UPDATE {$db->pre}comment SET status = {$comment['status']}, content = '{$comment['content']}' WHERE itemid = $itemid");
			die('0');
		}
	break;
	case 'delete':
		isset($itemid) or exit('Access Denied');
		if(is_array($itemid)){
			$db->query("DELETE FROM {$db->pre}comment WHERE itemid IN (".implode(",", $itemid).")");
		}else{
			$db->query("DELETE FROM {$db->pre}comment WHERE itemid = $itemid");
		}
		die('0');
	break;
	case 'status':
		isset($itemid) or exit('Access Denied');
		isset($status) or exit('Access Denied');
		
		if(is_array($itemid)){
			$db->query("UPDATE {$db->pre}comment SET status = $status WHERE itemid IN (".implode(",", $itemid).")");
		}else{
			$db->query("UPDATE {$db->pre}comment SET status = $status WHERE itemid = $itemid");
		}
		die('0');
		//
	break;
	default:
	
		isset($mid) or die('Access Denied');
		isset($infoid) or $infoid = 0;
		isset($pageid) or $pageid = 1;
		
		$__MOD = cache_read('module-'.$mid.'.php');
		
		if(isset($__MOD) && isset($__MOD['comment']) && $__MOD['comment'] == 0){
			die('系统当前模块未开启评论功能!');
		}
		
		$comments = get_comments($mid, $infoid, $pageid);
		
		include tpl('comment');
		
	break;
}

?>
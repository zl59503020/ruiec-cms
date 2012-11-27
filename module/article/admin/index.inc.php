<?php
defined('IN_RUIEC') or exit('Access Denied');
require MD_ROOT.'/article.class.php';

$do = new article($moduleid);

switch($action) {
	case 'add':
		include tpl('edit', $module);
	break;
	case 'edit':
		$itemid or msg();
		$do->itemid = $itemid;
		if($submit) {
			if($do->pass($post)) {
				if($FD) fields_check($post_fields);
				if($CP) property_check($post_ppt);
				$do->edit($post);
				if($FD) fields_update($post_fields, $table, $do->itemid);
				if($CP) property_update($post_ppt, $moduleid, $post['catid'], $do->itemid);
				dmsg('修改成功', $forward);
			} else {
				msg($do->errmsg);
			}
		} else {
			$item = $do->get_one();
			extract($item);
			$pagebreak = strpos($item['content'], '[pagebreak]') === false ? 0 : 1;
			$addtime = timetodate($addtime);
			$menuon = array('4', '3', '2', '1');
			$menuid = $menuon[$status];
			$tname = '修改'.$MOD['name'];
			include tpl($action, $module);
		}
	break;
	case 'move':
		if($submit) {
			$fromids or msg('请填写来源ID');
			if($tocatid) {
				$db->query("UPDATE {$table} SET catid=$tocatid WHERE `{$fromtype}` IN ($fromids)");
				dmsg('移动成功', $forward);
			} else {
				msg('请选择目标分类');
			}
		} else {
			$itemid = $itemid ? implode(',', $itemid) : '';
			$menuid = 5;
			include tpl($action, $module);
		}
	break;
	case 'update':
		is_array($itemid) or msg('请选择'.$MOD['name']);
		foreach($itemid as $v) {
			$do->update($v);
		}
		dmsg('更新成功', $forward);
	break;
	case 'tohtml':
		is_array($itemid) or msg('请选择'.$MOD['name']);
		$html_itemids = $itemid;
		foreach($html_itemids as $itemid) {
			tohtml('show', $module);
		}
		dmsg('更新成功', $forward);
	break;
	case 'delete':
		$itemid or msg('请选择'.$MOD['name']);
		isset($recycle) ? $do->recycle($itemid) : $do->delete($itemid);
		dmsg('删除成功', $forward);
	break;
	case 'restore':
		$itemid or msg('请选择'.$MOD['name']);
		$do->restore($itemid);
		dmsg('还原成功', $forward);
	break;
	case 'clear':
		$do->clear();
		dmsg('清空成功', $forward);
	break;
	case 'level':
		$itemid or msg('请选择'.$MOD['name']);
		$level = intval($level);
		$do->level($itemid, $level);
		dmsg('级别设置成功', $forward);
	break;
	case 'recycle':
		$lists = $do->get_list('status=0'.$condition, $dorder[$order]);
		$menuid = 4;
		include tpl('index', $module);
	break;
	case 'reject':
		if($itemid && !$psize) {
			$do->reject($itemid);
			dmsg('拒绝成功', $forward);
		} else {
			$lists = $do->get_list('status=1'.$condition, $dorder[$order]);
			$menuid = 3;
			include tpl('index', $module);
		}
	break;
	case 'check':
		include tpl('index', $module);
	break;
	case 'author':
		$condition = "status=3";
		if($keyword) $condition .= " AND `author` LIKE '%$keyword%'";
		$lists = array();
		$result = $db->query("SELECT COUNT(`author`) AS num,author FROM {$table} WHERE $condition GROUP BY `author` ORDER BY num DESC LIMIT 0,50");
		$lists[]['author'] = '本站原创';
		$lists[]['author'] = '佚名';
		while($r = $db->fetch_array($result)) {
			if(!$r['author']) continue;
			$lists[] = $r;
		}
		include tpl('author', $module);
	break;
	case 'from':
		$condition = "status=3";
		if($keyword) $condition .= " AND (`copyfrom` LIKE '%$keyword%' OR `fromurl` LIKE '%$keyword%')";
		$lists = array();
		$result = $db->query("SELECT COUNT(`copyfrom`) AS num,copyfrom,fromurl FROM {$table} WHERE $condition GROUP BY `copyfrom` ORDER BY num DESC LIMIT 0,50");
		while($r = $db->fetch_array($result)) {
			if(!$r['copyfrom']) continue;
			$lists[] = $r;
		}
		include tpl('from', $module);
	break;
	default:
		$lists = $do->get_list('status=3');
		$menuid = 1;
		include tpl('index', $module);
	break;
}
?>
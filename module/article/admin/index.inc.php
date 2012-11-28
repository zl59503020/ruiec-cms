<?php
defined('IN_RUIEC') or exit('Access Denied');
require MD_ROOT.'/article.class.php';

$do = new article($moduleid);

switch($action) {
	case 'add':
		include tpl('edit', $module);
	break;
	case 'edit':
		$itemid or die('ID不能为空!');
		$do->itemid = $itemid;
		$item = $do->get_one();
		extract($item);
		$addtime = timetodate($addtime);
		include tpl('edit', $module);
	break;
	case 'delete':
		$itemid or die('请选择'.$MOD['name']);
		isset($recycle) ? $do->recycle($itemid) : $do->delete($itemid);
		//die('删除成功');
		die('0');
	break;
	default:
		$lists = $do->get_list('status=3');
		$menuid = 1;
		include tpl('index', $module);
	break;
}
?>
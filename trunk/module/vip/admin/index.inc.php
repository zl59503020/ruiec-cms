<?php
defined('IN_RUIEC') or exit('Access Denied');
require MD_ROOT.'/product.class.php';

$do = new product($moduleid);

if(in_array($action, array('add', 'edit'))) {
	$FD = cache_read('fields-'.substr($table, strlen($RE_PRE)).'.php');
	if($FD) require RE_ROOT.'/include/fields.func.php';
	isset($post_fields) or $post_fields = array();
}

switch($action) {
	case 'add':
		if(isset($v_ruiec_sm) && $v_ruiec_sm == 'ruiec' ){
			if($do->pass($post)) {
				//if($FD) fields_check($post_fields);
				$do->add($post);
				if($FD) fields_update($post_fields, $table, $do->itemid);
				die('0');
			} else {
				die($do->errmsg);
			}
		}else{
			include tpl('add', $module);
		}
	break;
	case 'edit':
		$itemid or die('ID不能为空!');
		$do->itemid = $itemid;
		if(isset($v_ruiec_sm) && $v_ruiec_sm == 'ruiec' ){
			if($do->pass($post)) {
				//if($FD) fields_check($post_fields);
				$do->edit($post);
				if($FD) fields_update($post_fields, $table, $do->itemid);
				die('0');
			} else {
				die($do->errmsg);
			}
		}else{
			$item = $do->get_one();
			extract($item);
			$addtime = timetodate($addtime);
			include tpl('edit', $module);
		}
	break;
	case 'delete':
		$itemid or die('请选择! ['.$MOD['name'].']');
		isset($recycle) ? $do->recycle($itemid) : $do->delete($itemid);
		die('0');
	break;
	case 'recycle':
		$lists = $do->get_list('status=0');
		include tpl('recycle', $module);
	break;
	case 'audit':
		$lists = $do->get_list('status=2');
		include tpl('audit', $module);
	break;
	case 'restore':
		$itemid or die('请选择! ['.$MOD['name'].']');
		$do->restore($itemid);
		die('0');
	break;
	case 'status':
		$itemid or die('请选择! ['.$MOD['name'].']');
		$status or die('请设置状态!');
		$do->status($itemid,$status);
		die('0');
	break;
	case 'level':
		$itemid or die('请选择! ['.$MOD['name'].']');
		//$level or die('请设置级别!');
		$level or $level = 0;
		$do->level($itemid,$level);
		die('0');
	break;
	default:
		$lists = $do->get_list('status=3');
		include tpl('index', $module);
	break;
}
?>
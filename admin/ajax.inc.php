<?php
defined('IN_RUIEC') or exit('Access Denied');
switch($action) {
	case 'module':
		$modules = $_menu = array();
		$result = $db->query("SELECT * FROM {$RE_PRE}module ORDER BY listorder ASC");
		while($r = $db->fetch_array($result)) {
			if($r['moduleid'] == 1) continue;
			if(!$r['disabled']) $modules[] = $r;
		}
		foreach($modules as $v) {
			if(!is_array($v)) continue;
			$tmenu = array();
			$confinc = RE_ROOT.'/module/'.$v['module'].'/admin/config.inc.php';
			if(is_file($confinc)) {
				@include $confinc;
				if(isset($MCFG['install']) && $MCFG['install']){
					extract($v);
					$menuinc = RE_ROOT.'/module/'.$v['module'].'/admin/menu.inc.php';
					if(is_file($menuinc)) {
						@include $menuinc;
						$tmenu = array(
							'text' => $v['name'].'管理',
							'isexpand' => 'false',
							'children' => $menu
						);
						array_push($_menu, $tmenu);
					}
				}
			}
		}
		//$_menu = array_iconv('gb2312','utf-8',$_menu);
		echo json_encode($_menu);
		exit;
	break;
	case 'diy':
		$_menu = array();
		$_menu[] = array('id' => 'home', 'name' => '管理中心', 'url' => '');
		$_menu[] = array('id' => 'sys_diy', 'name' => '定义面板', 'url' => '?file=diy');
		$_menu[] = array('id' => 'sys_config', 'name' => '系统设置', 'url' => '?file=setting');
		$_menu[] = array('id' => 'sys_database', 'name' => '数据维护', 'url' => '?file=database');
		$_menu[] = array('id' => 'sys_template', 'name' => '模板风格', 'url' => '?file=template');
		$_menu[] = array('id' => 'manager_log', 'name' => '系统日志', 'url' => '?file=log');
		$_menu[] = array('id' => 'sys_manager', 'name' => '管理员管理', 'url' => '?file=admin');
		echo json_encode($_menu);
		exit;
	break;
	case 'plug':
		$_menu = array();
		$_menu[] = array('id' => 'sys_Spider', 'name' => '蜘蛛管理', 'url' => '?file=spider');
		echo json_encode($_menu);
		exit;
	break;
	case 'controlpanel':
		$_menu = array();
		$_menu[] = array('id' => 'sys_config', 'name' => '系统设置', 'url' => '?file=setting');
		$_menu[] = array('id' => 'sys_model', 'name' => '模块管理', 'url' => '?file=module');
		$_menu[] = array('id' => 'sys_database', 'name' => '数据维护', 'url' => '?file=database');
		$_menu[] = array('id' => 'sys_template', 'name' => '模板风格', 'url' => '?file=template');
		$_menu[] = array('id' => 'manager_log', 'name' => '系统日志', 'url' => '?file=log');
		$_menu[] = array('id' => 'sys_manager', 'name' => '管理员管理', 'url' => '?file=admin');
		$_menu[] = array('id' => 'sys_ads', 'name' => '广告管理', 'url' => '?file=ad');
		echo json_encode($_menu);
		exit;
	break;
	case 'ip':
		if(isset($ip)){
			echo ip2area($ip);
		}else{
			echo 'Access Denied';
		}
		exit;
	break;
	default:
		die('1');
	break;
}
?>
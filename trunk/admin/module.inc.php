<?php
defined('IN_RUIEC') or exit('Access Denied');

//获取系统模型,module目录下所有可用模型
function get_modules(){
	$_modules = glob(RE_ROOT.'/module/*');
	$modules = array();
	if(is_array($_modules)){
		foreach($_modules as $v) {
			if(is_file($v)) continue;
			$v = basename($v);
			$confinc = RE_ROOT.'/module/'.$v.'/admin/config.inc.php';
			if(is_file($confinc)) {
				include $confinc;
				$modules[$v] = $MCFG;
			}
		}
	}
	return $modules;
}

require RE_ROOT.'/include/sql.func.php';

switch($action) {
	case 'add':
		if(isset($v_ruiec_sm) && $v_ruiec_sm == 'ruiec'){
			if(!$post['name']) die('请填写模块名称');
			if($post['islink']) {
				if(!$post['linkurl']) die('请填写链接地址');
			} else {
				$dir = $post['moduledir'];
				$module = $post['module'];
				if(!$module) die('请选择所属模型');
				$module_cfg = RE_ROOT.'/module/'.$module.'/admin/config.inc.php';
				if(!is_file($module_cfg)) die('此模型无法安装，请检查');
				include $module_cfg;
				if($MCFG['uninstall'] == false) die('此模型无法安装，请检查');
				if($MCFG['copy'] == false) {
					$r = $db->get_one("SELECT moduleid FROM {$RE_PRE}module WHERE module='$module' AND islink=0");
					if($r) die('此模型已经安装过，请检查');
				}
				if(!$dir) die('请填写安装目录');
				if(!preg_match("/^[0-9a-z_-]+$/i", $dir)) die('目录名不合法,请更换一个再试');
				$r = $db->get_one("SELECT moduleid FROM {$RE_PRE}module WHERE moduledir='$dir' AND islink=0");
				if($r) die('此目录名已经被其他模块使用,请更换一个再试');
				$sysdirs = array('admin', 'api', 'file', 'include', 'install', 'module', 'skin', 'template', 'wap');
				if(in_array($dir, $sysdirs)) die('安装目录与系统目录冲突，请更换安装目录');
				if(!dir_create(RE_ROOT.'/'.$dir.'/')) die('无法创建'.$dir.'目录，请检查PHP是否有创建权限或手动创建');
				if(!is_write(RE_ROOT.'/'.$dir.'/')) die('目录'.$dir.'无法写入，请设置此目录可写权限');
				if(!file_put(RE_ROOT.'/'.$dir.'/config.inc.php', "RUIEC")) die('目录'.$dir.'无法写入，请设置此目录可写权限');
			}
			$post['linkurl'] = $post['islink'] ? $post['linkurl'] : ($post['domain'] ? $post['domain'] : linkurl($post['moduledir']."/"));
			if($post['islink']) $post['module'] = 'ruiec';
			$post['installtime'] = $RE_TIME;
			if($MCFG['moduleid']) {
				$db->query("DELETE FROM {$RE_PRE}module WHERE moduleid=".$MCFG['moduleid']);
				$post['moduleid'] = $MCFG['moduleid'];
			}
			$sql1 = $sql2 = $s = "";
			foreach($post as $key=>$value) {
				$sql1 .= $s.$key;
				$sql2 .= $s."'".$value."'";
				$s = ",";
			}
			$db->query("INSERT INTO {$RE_PRE}module ($sql1) VALUES ($sql2)");
			$moduleid = $db->insert_id();
			$db->query("UPDATE {$RE_PRE}module SET listorder=$moduleid WHERE moduleid=$moduleid");
			if($post['islink']) {
				
			} else {
				// 安装...
				$module = $post['module'];
				$dir = $post['moduledir'];
				$modulename = $post['name'];
				file_put(RE_ROOT.'/'.$dir.'/config.inc.php', "<?php\n\$moduleid = ".$moduleid.";\n?>");
				@include RE_ROOT.'/module/'.$module.'/admin/install.inc.php';
			}
			cache_module();
			//echo '模块安装成功';
			echo '0';
		}else{
			$imodules = array();
			$result = $db->query("SELECT module FROM {$RE_PRE}module");
			while($r = $db->fetch_array($result)) {
				$imodules[$r['module']] = $r['module'];
			}
			$modules = get_modules();
			$module_select = '<select name="post[module]"  id="module" class="select required"><option value="">请选择</option>';
			foreach($modules as $k=>$v) {
				if($v['copy'] == false) {
					if(in_array($v['module'], $imodules)) continue;
				}
				$module_select .= '<option value="'.$v['module'].'">'.$v['name'].'</option>';
			}
			$module_select .= '</select>';
			include tpl('module_add');
		}
		break;
	case 'ckdir':
		if(isset($v_ruiec_ckdir) && $v_ruiec_ckdir == 'ruiec'){
			if(!preg_match("/^[0-9a-z_-]+$/i", $ck_dir)){
				echo '<div style="margin:10px;color:red;">该目录名非法,请更换一个再试</div>';
			}else{
				$r = $db->get_one("SELECT moduleid FROM {$RE_PRE}module WHERE moduledir='$ck_dir'");
				if($r || is_dir(RE_ROOT.'/'.$ck_dir.'/')){
					echo '<div style="margin:10px;color:red;">该目录名已经被使用,请更换一个再试</div>';
				}else{
					echo '<div style="margin:10px;color:#53BD4A;">该目录合法,可以使用!</div>';
				}
			}
			exit;
		}
		break;
	case 'disable':
		if(!$modid) die('模块ID不能为空');
		if($modid < 5) die('系统模型不可禁用');
		$value = $value ? 1 : 0;
		$db->query("UPDATE {$RE_PRE}module SET disabled='$value' WHERE moduleid=$modid");
		//cache_module();
		echo '0';
		exit;
		break;
	case 'delete':
		if(!$modid) die('模块ID不能为空');	
		if($modid < 5) die('系统模型不可删除');
		//if($modid < 23) dheader('?file='.$file.'&action=disable&value=1&modid='.$modid);
		$r = $db->get_one("SELECT * FROM {$RE_PRE}module WHERE moduleid='$modid'");
		if(!$r) die('此模块不存在');
		if(!$r['islink']) {
			$moduleid = $r['moduleid'];
			$module = $r['module'];
			$dir = $r['moduledir'];
			$module_cfg = RE_ROOT.'/module/'.$module.'/admin/config.inc.php';
			if(!is_file($module_cfg)) die('此模型不可卸载，请检查');
			include $module_cfg;
			if($MCFG['uninstall'] == false) die('此模型不可卸载，请检查');
			@include RE_ROOT.'/module/'.$module.'/admin/uninstall.inc.php';			//uninstall 删除
			$result = $db->query("SHOW TABLES FROM `".$CFG['db_name']."`");
			/*
			while($r = $db->fetch_row($result)) {
				$tb = $r[0];
				$pt = str_replace($RE_PRE.$moduleid.'_', '', $tb);
				if(is_numeric($pt)) $db->query("DROP TABLE IF EXISTS `".$tb."`");
			}
			*/
			$db->query("DELETE FROM `".$RE_PRE."setting` WHERE item=$moduleid");
			/*
			$tb = str_replace($RE_PRE, '', get_table($moduleid));
			$db->query("DELETE FROM `".$RE_PRE."fields` WHERE tb='$tb'");
			*/
			dir_delete(RE_ROOT.'/'.$dir);
		}
		$db->query("DELETE FROM {$RE_PRE}module WHERE moduleid='$modid'");
		//cache_module();
		//echo '模块删除成功';
		die('0');
		break;
	case 'order':
		foreach($listorder as $k=>$v) {
			$k = intval($k);
			$v = intval($v);
			$db->query("UPDATE {$RE_PRE}module SET listorder='$v' WHERE moduleid=$k");
		}
		//cache_module();
		//echo '更新成功';
		die('0');
		break;
	case 'edit':
		if(!$modid) die('模块ID不能为空');
		$r = $db->get_one("SELECT * FROM {$RE_PRE}module WHERE moduleid='$modid'");
		if(!$r) die('模块不存在');
		extract($r);
		if(isset($v_ruiec_sm) && $v_ruiec_sm == 'ruiec'){
			if(!$post['name']) die('请填写模块名称');
			if($islink) {
				if(!$post['linkurl']) die('请填写链接地址');
			} else {
				if(!$post['moduledir']) die('请填写安装目录');
				if(!preg_match("/^[0-9a-z_-]+$/i", $post['moduledir'])) die('目录名不合法,请更换一个再试');
				$sysdirs = array('admin', 'api', 'cache', 'editor', 'file', 'include', 'install', 'module', 'skin', 'template', 'wap');
				if(in_array($post['moduledir'], $sysdirs)) die('安装目录与系统目录冲突，请更换安装目录');
				$r = $db->get_one("SELECT moduleid FROM {$RE_PRE}module WHERE moduledir='$post[moduledir]' AND moduleid!=$modid");
				if($r) die('此目录名已经被其他模块使用,请更换一个再试');
				$post['linkurl'] = $post['domain'] ? $post['domain'] : linkurl($post['moduledir']."/");
			}			
			$sql = $s = "";
			foreach($post as $key=>$value) {
				$sql .= $s.$key."='".$value."'";
				$s = ",";
			}
			$db->query("UPDATE {$RE_PRE}module SET $sql WHERE moduleid=$modid");
			if(!$islink && $moduledir != $post['moduledir']) {
				rename(RE_ROOT.'/'.$moduledir, RE_ROOT.'/'.$post['moduledir']) or die('无法重命名目录'.$moduledir.'为'.$post['moduledir'].',请手动修改');
			}
			//cache_module();
			//echo '模块修改成功';
			die('0');
		}else{
			@include RE_ROOT.'/module/'.$module.'/admin/config.inc.php';
			$modulename = isset($MCFG['name']) ? $MCFG['name'] : '';
			include tpl('module_edit');
		}
		break;
	default:
		$sys_modules = get_modules();
		$modules = $_modules = array();
		$result = $db->query("SELECT * FROM {$RE_PRE}module ORDER BY listorder ASC");
		while($r = $db->fetch_array($result)) {
			if($r['moduleid'] == 1) continue;
			$r['installdate'] = timetodate($r['installtime'], 3);
			$r['modulename'] = (isset($sys_modules[$r['module']])) ? $sys_modules[$r['module']]['name'] : '外链'.$r['module'];
			if($r['disabled']) {
				$_modules[] = $r;
			} else {
				$modules[] = $r;
			}
		}
		include tpl('module');
	break;
}

?>
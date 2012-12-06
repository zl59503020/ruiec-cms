<?php
defined('IN_RUIEC') or exit('Access Denied');

function msg($msg = errmsg, $acturl = 'goback', $time = '1') {
	global $CFG;
	if(!$msg && $acturl && $acturl != 'goback') rheader($acturl);
	include RE_ROOT.'/admin/template/msg.tpl.php';
    exit;
}

function dialog($dcontent) {
	global $CFG;
	include RE_ROOT.'/admin/template/dialog.tpl.php';
    exit;
}

function tpl($file = 'index', $mod = 'ruiec') {
	global $CFG, $RE;
	return $mod == 'ruiec' ? RE_ROOT.'/admin/template/'.$file.'.tpl.php' : RE_ROOT.'/module/'.$mod.'/admin/template/'.$file.'.tpl.php';
}

//进度
function progress($sid, $fid, $tid, $rv='') {
	if($tid > $sid && $fid < $tid) {
		$p = dround(($fid-$sid)*100/($tid-$sid), 0, true);
		if($p > 100) $p = 100;
		$p = $p.'%';
	} else {
		$p = '100%';
	}
	if($rv != '') return $p;
	else return '<table cellpadding="0" cellspacing="0" width="100%" style="margin:0"><tr><td><div class="progress" style="width:96%;"><div style="width:'.$p.';">&nbsp;</div></div></td><td style="color:#666666;font-size:10px;width:40px;text-align:center;">'.$p.'</td></tr></table>';
}


// 更新模块设置
function update_setting($item, $setting) {
	global $db;
	$db->query("DELETE FROM {$db->pre}setting WHERE item='$item'");
	foreach($setting as $k=>$v) {
		if(is_array($v)) $v = implode(',', $v);
		$db->query("INSERT INTO {$db->pre}setting (item,item_key,item_value) VALUES ('$item','$k','$v')");
	}
	return true;
}

// 获取模块设置
function get_setting($item) {
	global $db;
	$setting = array();
	$query = $db->query("SELECT * FROM {$db->pre}setting WHERE item='$item'");
	while($r = $db->fetch_array($query)) {
		$setting[$r['item_key']] = $r['item_value'];
	}
	return $setting;
}

// 更新分类
function update_category($CAT) {
	global $db, $RE;
	$linkurl = listurl($CAT);
	//if($RE['index']) $linkurl = str_replace($RE['index'].'.'.$RE['file_ext'], '', $linkurl);
	$db->query("UPDATE {$db->pre}category SET linkurl='$linkurl' WHERE catid=".$CAT['catid']);
}

// 提示信息
function tips($tips) {
	echo ' <img src="'.RE_PATH.'admin/skin/images/help.png" title="'.$tips.'" alt="tips" class="stips" onclick="MsgBox(this.title);" />';
}

//写入文件
function array_save($array, $arrayname, $file) {
	$data = var_export($array,true);
	$data = "<?php\n".$arrayname." = ".$data.";\n?>";
	return file_put($file,$data);
}

function admin_log($force = 0) {
	global $RE, $db, $file, $action, $_username, $RE_QST, $RE_IP, $RE_TIME;
	if($force) $RE['admin_log'] = 2;
	$qstring = $RE_QST;
	if(!$RE['admin_log'] || !$_username || !$qstring || $file == 'index') return false;
	if($RE['admin_log'] == 2 || ($RE['admin_log'] == 1 && ($file == 'setting' || in_array($action, array('delete', 'edit', 'move', 'clear', 'add'))))) {
		if(strpos($qstring, 'file=log') !== false) return false;
		$fpos = strpos($qstring, '&forward');
		if($fpos) $qstring = substr($qstring, 0, $fpos);
		$logstring = get_cookie('logstring');
		if($qstring == $logstring)  return false;
		$qstring = preg_replace("/rand=([0-9]{1,})\&/", "", $qstring);
		$db->query("INSERT INTO {$db->pre}admin_log(qstring, username, ip, logtime) VALUES('$qstring','$_username','$RE_IP','$RE_TIME')");
		set_cookie('logstring', $qstring);
	}
}

function admin_check() {
	global $CFG, $db, $_admin, $_userid, $moduleid, $file, $action, $catid, $_catids, $_childs;
	if(in_array($file, array('logout', 'destoon', 'mymenu'))) return true;//All user
	if($moduleid == 1 && $file == 'index') return true;
	if($CFG['founderid'] && $CFG['founderid'] == $_userid) return true;//Founder
	if($_admin == 2) {
		$R = cache_read('right-'.$_userid.'.php');
		if(!$R) return false;
		if(!isset($R[$moduleid])) return false;
		if(!$R[$moduleid]) return true;//Module admin
		if(!isset($R[$moduleid][$file])) return false;
		if(!$R[$moduleid][$file]) return true;
		if($action && $R[$moduleid][$file]['action'] && !in_array($action, $R[$moduleid][$file]['action'])) return false;
		if(!$R[$moduleid][$file]['catid']) return true;
		$_catids = implode(',', $R[$moduleid][$file]['catid']);
		if($catid) {
			if(in_array($catid, $R[$moduleid][$file]['catid'])) return true;
			//Childs
			$result = $db->query("SELECT catid,child,arrchildid FROM {$db->pre}category WHERE moduleid=$moduleid AND catid IN ($_catids)");
			while($r = $db->fetch_array($result)) {
				$_childs .= ','.($r['child'] ? $r['arrchildid'] : $r['catid']);
			}
			if(strpos($_childs.',', ','.$catid.',') !== false) return true;
			return false;
		}
	} else if($_admin == 1) {
		if(in_array($file, array('admin', 'setting', 'module', 'area', 'database', 'template', 'skin', 'log', 'update', 'group', 'fields', 'loginlog'))) return false;//Founder || Common Admin Only
	}
	return true;
}

function split_content($moduleid, $part) {
	global $db, $CFG, $MODULE;
	$table = $db->pre.$moduleid.'_'.$part;
	$fd = $moduleid == 4 ? 'userid' : 'itemid';
	if($db->version() > '4.1' && $CFG['db_charset']) {
		$type = " ENGINE=MyISAM DEFAULT CHARSET=".$CFG['db_charset'];
	} else {
		$type = " TYPE=MyISAM";
	}	
	$db->query("CREATE TABLE IF NOT EXISTS `{$table}` (`{$fd}` bigint(20) unsigned NOT NULL default '0',`content` longtext NOT NULL,PRIMARY KEY  (`{$fd}`))".$type." COMMENT='".$MODULE[$moduleid]['name']."内容_".$part."'");
}

//安装模块时,创建文件.
function install_file($file, $dir, $extend = 0) {
	$content = "<?php\n";
	if($extend == 1) $content .= "define('RE_REWRITE', true);\n";
	$content .= "require 'config.inc.php';\n";
	$content .= "require '../common.inc.php';\n";
	$content .= "require RE_ROOT.'/module/'.\$module.'/".$file.".inc.php';\n";
	$content .= '?>';
	return file_put(RE_ROOT.'/'.$dir.'/'.$file.'.php', $content);
}

function list_dir($dir) {
	$dirs = array();
	$files = glob(RE_ROOT.'/'.$dir.'/*');
	if(is_array($files)) {
		include RE_ROOT.'/'.$dir.'/these.name.php';	
		foreach($files as $v) {
			if(is_file($v)) continue;
			$v = basename($v);
			$n = isset($names[$v]) ? $names[$v] : $v;
			$dirs[] = array('dir'=>$v, 'name'=>$n);
		}
	}
	return $dirs;
}

function pass_encode($str) {
	$len = strlen($str);
	if($len < 1) return '';
	$new = '';
	for($i = 0; $i < $len; $i++) {
		$new .= ($i == 0 || $i == $len - 1) ? $str{$i} : '*';
	}
	return $new;
}

function pass_decode($new, $old) {
	return $new == pass_encode($old) ? $old : $new;
}
?>
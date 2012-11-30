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

function update_category($CAT) {
	global $db, $RE;
	$linkurl = listurl($CAT);
	if($RE['index']) $linkurl = str_replace($RE['index'].'.'.$RE['file_ext'], '', $linkurl);
	$db->query("UPDATE {$db->pre}category SET linkurl='$linkurl' WHERE catid=".$CAT['catid']);
}

function tips($tips) {
	echo ' <img src="'.RE_PATH.'admin/skin/images/help.png" title="'.$tips.'" alt="tips" class="stips" onclick="MsgBox(this.title);" />';
}

function array_save($array, $arrayname, $file) {
	$data = var_export($array,true);
	$data = "<?php\n".$arrayname." = ".$data.";\n?>";
	return file_put($file,$data);
}

function fetch_url($url) {
	global $db;
	$fetch = array();
	$tmp = parse_url($url);
	$domain = $tmp['host'];
	$r = $db->get_one("SELECT * FROM {$db->pre}fetch WHERE domain='$domain' ORDER BY edittime DESC");
	if($r) {
		$content = file_get($url);
		if($content) {
			$content = convert($content, $r['encode'], RE_CHARSET);
			preg_match("/<title>(.*)<\/title>/isU", $content, $m);
			if(isset($m[1])) $fetch['title'] = trim($r['title'] ? str_replace($r['title'], '', $m[1]) : $m[1]);
			preg_match("/<meta[\s]+name=['\"]description['\"] content=['\"](.*)['\"]/isU", $content, $m);
			if(isset($m[1])) $fetch['introduce'] = $m[1];
			list($f, $t) = explode('[content]', $r['content']);
			if($f && $t) {
				$s = strpos($content, $f);
				if($s !== false) {
					$e = strpos($content, $t, $s);
					if($e !== false && $e > $s) {
						$fetch['content'] = substr($content, $s + strlen($f), $e - $s - strlen($f));
					}
				}
			}
		}
	}
	return $fetch;
}

function edition($k = -1) {
	$E = array();
	$E[0] = RE_DOMAIN;
	$E[1] = '&#20010;&#20154;&#29256;';
	return $k >= 0 ? $E[$k] : $E;
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

function admin_online() {
	global $RE, $db, $moduleid, $_username, $RE_QST, $RE_IP, $RE_TIME;
	if(!$RE['admin_online'] || !$_username) return false;
	$qstring = $RE_QST;
	$fpos = strpos($qstring, '&forward');
	if($fpos) $$qstring = substr($qstring, 0, $fpos);
	$qstring = preg_replace("/rand=([0-9]{1,})\&/", "", $qstring);
	$db->query("REPLACE INTO {$db->pre}admin_online (sid,username,ip,moduleid,qstring,lasttime) VALUES ('".session_id()."','$_username','$RE_IP','$moduleid','$qstring','$RE_TIME')");	
	$lastime = $RE_TIME - $RE['online'];
	$db->query("DELETE FROM {$db->pre}admin_online WHERE lasttime<$lastime");
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

function item_check($itemid) {
	global $db, $table, $_child, $moduleid;
	if($moduleid == 3) return true;
	$fd = 'itemid';
	if($moduleid == 2 || $moduleid == 4) $fd = 'userid';
	$r = $db->get_one("SELECT catid FROM {$table} WHERE `$fd`=$itemid");
	if($r && $_child && in_array($r['catid'], $_child)) return true;
	return false;
}

function city_check($itemid) {
	global $db, $table, $_areaid, $moduleid;
	if($moduleid == 3) return true;
	$fd = 'itemid';
	if($moduleid == 2 || $moduleid == 4) $fd = 'userid';
	$r = $db->get_one("SELECT areaid FROM {$table} WHERE `$fd`=$itemid");
	if($r && $_areaid && in_array($r['areaid'], $_areaid)) return true;
	return false;
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

function split_sell($part) {
	global $db, $CFG, $MODULE;
	$sql = file_get(RE_ROOT.'/file/setting/split_sell.sql');
	$sql or dalert('请检查文件file/setting/split_sell.sql是否存在');
	$sql = str_replace('destoon_sell_1', $db->pre.'sell_'.$part, $sql);
	if($db->version() > '4.1' && $CFG['db_charset']) {
		$sql .= " ENGINE=MyISAM DEFAULT CHARSET=".$CFG['db_charset'];
	} else {
		$sql .= " TYPE=MyISAM";
	}
	$sql .= " COMMENT='".$MODULE[5]['name']."分表_".$part."';";
	$db->query($sql);
}

function seo_title($title, $show = '') {
	$SEO = array(
		'modulename'		=>	'模块名称',
		'page'				=>	'页码',
		'sitename'			=>	'网站名称',
		'sitetitle'			=>	'网站SEO标题',
		'sitekeywords'		=>	'网站SEO关键词',
		'sitedescription'	=>	'网站SEO描述',
		'catname'			=>	'分类名称',
		'cattitle'			=>	'分类SEO标题',
		'catkeywords'		=>	'分类SEO关键词',
		'catdescription'	=>	'分类SEO描述',
		'showtitle'			=>	'内容标题',
		'showintroduce'		=>	'内容简介',
		'kw'				=>	'关键词',
		'areaname'			=>	'地区',
		'delimiter'			=>	'分隔符',
	);
	if(is_array($show)) {
		foreach($show as $v) {
			if(isset($SEO[$v])) echo '<a href="javascript:_into(\''.$title.'\', \'{'.$SEO[$v].'}\');" title="{'.$SEO[$v].'}">{'.$SEO[$v].'}</a>&nbsp;&nbsp;';
		}
	} else {
		foreach($SEO as $k=>$v) {
			$title = str_replace($v, '$seo_'.$k, $title);
		}
		return $title;
	}
}

function seo_check($str) {
	foreach(array('<', '>', '(', ')', ';', '?', '\\', '"', "'") as $v) {
		if(strpos($str, $v) !== false) return false;
	}
	return true;
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
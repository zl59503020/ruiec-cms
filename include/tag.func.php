<?php
defined('IN_RUIEC') or exit('Access Denied');
function tag($parameter, $expires = 0) {
	global $RE, $CFG, $MODULE, $RE_TIME, $db;
	if($expires > 0) {
		$tag_expires = $expires;
	} else if($expires == -2) {
		$tag_expires = $CFG['db_expires'];
	} else if($expires == -1) {
		$tag_expires = 0;
	} else {
		$tag_expires = $CFG['tag_expires'];
	}
	$tag_cache = false;
	$db_cache = ($expires == -2 || defined('TOHTML')) ? 'CACHE' : '';
	if($tag_expires && $db_cache != 'CACHE' && strpos($parameter, '&page=') === false) {
		$tag_cache = true;
		$TCF = RE_CACHE.'/tag/'.md5($parameter).'.htm';
		if(is_file($TCF) && ($RE_TIME - filemtime($TCF) < $tag_expires)) {
			echo substr(file_get($TCF), 17);
			return;
		}
	}
	$parameter = str_replace(array('&amp;', '%'), array('', '##'), $parameter);
	parse_str($parameter, $par);
	if(!is_array($par)) return '';
	$par = _stripslashes($par);
	extract($par);
	isset($prefix) or $prefix = $db->pre;
	isset($moduleid) or $moduleid = 1;
	if(!isset($MODULE[$moduleid])) return '';
	isset($fields) or $fields = '*';
	isset($catid) or $catid = 0;
	isset($child) or $child = 1;
	isset($dir) or $dir = 'tag';
	isset($template) or $template = 'list';
	isset($condition) or $condition = '1';
	isset($group) or $group = '';
	isset($page) or $page = 1;
	isset($offset) or $offset = 0;
	isset($pagesize) or $pagesize = 10;
	isset($order) or $order = '';
	isset($showpage) or $showpage = 0;
	isset($showcat) or $showcat = 0;
	isset($datetype) or $datetype = 0;
	isset($target) or $target = '';
	isset($class) or $class = '';
	isset($length) or $length = 0;
	isset($introduce) or $introduce = 0;
	isset($debug) or $debug = 0;
	(isset($cols) && $cols) or $cols = 1;
	if($catid && $moduleid > 4) {
		if(is_numeric($catid)) {
			$CAT = $db->get_one("SELECT child,arrchildid,moduleid FROM {$db->pre}category WHERE catid=$catid");
			$condition .= ($child && $CAT['child'] && $CAT['moduleid'] == $moduleid) ? " AND catid IN (".$CAT['arrchildid'].")" : " AND catid=$catid";
		} else {
			if($child) {
				$catids = '';
				$result = $db->query("SELECT arrchildid FROM {$db->pre}category WHERE catid IN ($catid)");
				while($r = $db->fetch_array($result)) {
					$catids .= ','.$r['arrchildid'];
				}
				if($catids) $catid = substr($catids, 1);
			}
			$condition .= " AND catid IN ($catid)";
		}
	}
	$table = isset($table) ? $prefix.$table : get_table($moduleid);
	$offset or $offset = ($page-1)*$pagesize;
	$percent = _round(100/$cols).'%';
	$num = 0;
	$order = $order ? ' ORDER BY '.$order : '';
	$condition = stripslashes($condition);
	$condition = str_replace('##', '%', $condition);
	if($showpage) {
		$num = $db->count($table, $condition, $tag_expires ? $tag_expires : $CFG['db_expires']);
		$pages = pages($num, $page, $pagesize);
	} else {
		if($group) $condition .= ' GROUP BY '.$group;
	}
	if($page < 2 && strpos($parameter, '&page=') !== false) {
		$db_cache = 'CACHE';
		$tag_expires = $CFG['tag_expires'];
	}
	if($template == 'null') $db_cache = 'CACHE';
	$query = "SELECT ".$fields." FROM ".$table." WHERE ".$condition.$order." LIMIT ".$offset.",".$pagesize;
	if($debug) echo $parameter.'<br/>'.$query.'<br/>';
	$tags = $catids = $CATS = array();
	$result = $db->query($query, $db_cache, $tag_expires);
	while($r = $db->fetch_array($result)) {
		if(isset($r['title'])) {
			$r['title'] = str_replace('"', '&quot;', trim($r['title']));
			$r['alt'] = $r['title'];
			if($length) $r['title'] = _substr($r['title'], $length);
			if(isset($r['style']) && $r['style']) $r['title'] = set_style($r['title'], $r['style']);
		}
		if(isset($r['introduce']) && $introduce) $r['introduce'] = _substr($r['introduce'], $introduce);
		if(isset($r['linkurl']) && $r['linkurl'] && $moduleid > 4 && strpos($r['linkurl'], '://') === false) $r['linkurl'] = $MODULE[$moduleid]['linkurl'].$r['linkurl'];
		if($showcat && $moduleid > 4 && isset($r['catid'])) $catids[$r['catid']] = $r['catid'];
		$tags[] = $r;
	}
	$db->free_result($result);
	if($showcat && $moduleid > 4 && $catids) {
		$result = $db->query("SELECT catid,catname,linkurl FROM {$db->pre}category WHERE catid IN (".implode(',', $catids).")");
		while($r = $db->fetch_array($result)) {
			$CATS[$r['catid']] = $r;
		}
		if($CATS) {
			foreach($tags as $k=>$v) {
				$tags[$k]['catname'] = $v['catid'] ? $CATS[$v['catid']]['catname'] : '';
				$tags[$k]['caturl'] = $v['catid'] ? $MODULE[$moduleid]['linkurl'].$CATS[$v['catid']]['linkurl'] : '';
			}
		}
	}
	if($template == 'null') return $tags;
	if($tag_cache) {
		ob_start();
		include template($template, $dir);
		$contents = ob_get_contents();
		ob_clean();
		file_put($TCF, '<!--'.($RE_TIME + $tag_expires).'-->'.$contents);
		echo $contents;
	} else {
		include template($template, $dir);
	}
}
?>
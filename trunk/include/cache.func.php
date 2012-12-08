<?php
defined('IN_RUIEC') or exit('Access Denied');
function cache_all() {
	cache_module();		//模型
	cache_category();	//分类
	cache_spider();		//蜘蛛
	/*
	cache_fields();
	cache_group();
	cache_pay();
	cache_oauth();
	cache_type();
	cache_keylink();
	*/
	return true;
}

function cache_module($moduleid = 0) {
	global $db;
	if($moduleid) {
		$r = $db->get_one("SELECT * FROM {$db->pre}module WHERE disabled=0 AND moduleid='$moduleid'");
		$setting = array();
		$setting = get_setting($moduleid);
		/*	seo	*/
		if(isset($setting['seo_title_index'])) $setting['title_index'] = seo_title($setting['seo_title_index']);
		if(isset($setting['seo_title_list'])) $setting['title_list'] = seo_title($setting['seo_title_list']);
		if(isset($setting['seo_title_show'])) $setting['title_show'] = seo_title($setting['seo_title_show']);
		if(isset($setting['seo_title_search'])) $setting['title_search'] = seo_title($setting['seo_title_search']);
		if(isset($setting['seo_keywords_index'])) $setting['keywords_index'] = seo_title($setting['seo_keywords_index']);
		if(isset($setting['seo_keywords_list'])) $setting['keywords_list'] = seo_title($setting['seo_keywords_list']);
		if(isset($setting['seo_keywords_show'])) $setting['keywords_show'] = seo_title($setting['seo_keywords_show']);
		if(isset($setting['seo_keywords_search'])) $setting['keywords_search'] = seo_title($setting['seo_keywords_search']);
		if(isset($setting['seo_description_index'])) $setting['description_index'] = seo_title($setting['seo_description_index']);
		if(isset($setting['seo_description_list'])) $setting['description_list'] = seo_title($setting['seo_description_list']);
		if(isset($setting['seo_description_show'])) $setting['description_show'] = seo_title($setting['seo_description_show']);
		if(isset($setting['seo_description_search'])) $setting['description_search'] = seo_title($setting['seo_description_search']);
		
		cache_write('setting/module-'.$moduleid.'.php', $setting);
		$setting['moduleid'] = $moduleid;
		$setting['name'] = $r['name'];
		$setting['moduledir'] = $r['moduledir'];
		$setting['module'] = $r['module'];
		$setting['ismenu'] = $r['ismenu'];
		$setting['domain'] = $r['domain'];
		$setting['linkurl'] = $r['linkurl'];
		if($moduleid == 3) {
			foreach($setting as $k=>$v) {
				if(strpos($k, '_domain') !== false) {
					$e = str_replace('_domain', '', $k);
					$key = $e.'_url';
					$setting[$key] = $v ? $v : RE_PATH.$e.'/';
				}
			}
		}
		cache_write('module-'.$moduleid.'.php', $setting);
		if(isset($setting['split'])) {			
			if($setting['split']) {
				cache_write($moduleid.'.part', $moduleid);
			} else {
				cache_delete($moduleid.'.part');
			}
		}
		return true;
	} else {
		$result = $db->query("SELECT moduleid,module,name,moduledir,domain,linkurl,listorder,islink,ismenu,isblank FROM {$db->pre}module WHERE disabled=0 ORDER by listorder asc,moduleid desc");
		$CACHE = array();
		$modules = array();
		while($r = $db->fetch_array($result)) {
			if(!$r['islink']) {
				$linkurl = $r['domain'] ? $r['domain'] : linkurl($r['moduledir'].'/', 1);
				if($r['moduleid'] == 1) $linkurl = RE_PATH;
				if($linkurl != $r['linkurl']) {
					$r['linkurl'] = $linkurl;
					$db->query("UPDATE {$db->pre}module SET linkurl='$linkurl' WHERE moduleid='$r[moduleid]' ");
				}
				cache_module($r['moduleid']);
			}
			$modules[$r['moduleid']] = $r;
        }
		$CACHE['module'] = $modules;
		$CACHE['re'] = cache_read('module-1.php');
		cache_write('module.php', $CACHE);
	}
}

function cache_category($moduleid = 0, $data = array()) {
	global $db, $RE, $MODULE;
	if($moduleid) {
		if(!$data) {
			$result = $db->query("SELECT * FROM {$db->pre}category WHERE moduleid='$moduleid' ORDER BY listorder,catid");
			while($r = $db->fetch_array($result)) {
				$data[$r['catid']] = $r;
			}
		}
		$mod = cache_read('module-'.$moduleid.'.php');
		$a = array();
		$d = array('listorder', 'moduleid', 'item', 'template', 'show_template', 'seo_title', 'seo_keywords', 'seo_description', 'group_list', 'group_show', 'group_add');
		foreach($data as $r) {
			$e = $r['catid'];
			foreach($d as $_d) {
				unset($r[$_d]);
			}
			$a[$e] = $r;
		};
		cache_write('category-'.$moduleid.'.php', $a);
		if(count($data) < 100) {
			$categorys = array();
			foreach($data as $id=>$cat) {
				$categorys[$id] = array('id'=>$id, 'parentid'=>$cat['parentid'], 'name'=>$cat['catname']);
			}
			require_once RE_ROOT.'/include/tree.class.php';
			$tree = new tree;
			$tree->tree($categorys);
			$content = $tree->get_tree(0, "<option value=\\\"\$id\\\">\$spacer\$name</option>").'</select>';
			cache_write('catetree-'.$moduleid.'.php', $content);
		} else {
			cache_delete('catetree-'.$moduleid.'.php');
		}
	} else {
		foreach($MODULE as $moduleid=>$module) {
			cache_category($moduleid);
		}
	}
}

function cache_spider(){
	global $db;
	$spider = array();
	$result = $db->query("SELECT * FROM {$db->pre}spider_info");
	while($c = $db->fetch_array($result)) {
		$spider[$c['key']] = $c['value'];
	}
	cache_write('spider-cache.php', $spider);
}

//支付
function cache_pay() {
	global $db;
	$setting = $order = $pay = array();
	$result = $db->query("SELECT * FROM {$db->pre}setting WHERE item LIKE '%pay-%'");
	while($r = $db->fetch_array($result)) {
		if(substr($r['item'], 0, 4) == 'pay-') {
			$setting[substr($r['item'], 4)][$r['item_key']] = $r['item_value'];
			if($r['item_key'] == 'order') $order[substr($r['item'], 4)] = $r['item_value'];
		}
	}
	asort($order);
	foreach($order as $k=>$v) {
		$pay[$k] = $setting[$k];
	}
	cache_write('pay.php', $pay);
}

//第三方登录验证
function cache_oauth() {
	global $db;
	$setting = $order = $oauth = array();
	$result = $db->query("SELECT * FROM {$db->pre}setting WHERE item LIKE '%oauth-%'");
	while($r = $db->fetch_array($result)) {
		if(substr($r['item'], 0, 6) == 'oauth-') {
			$setting[substr($r['item'], 6)][$r['item_key']] = $r['item_value'];
			if($r['item_key'] == 'order') $order[substr($r['item'], 6)] = $r['item_value'];
		}
	}
	asort($order);
	foreach($order as $k=>$v) {
		$oauth[$k] = $setting[$k];
	}
	cache_write('oauth.php', $oauth);
}

// 自定义字段
function cache_fields($tb = '') {
	global $db, $RE;
	if($tb) {
		$data = array();
		$result = $db->query("SELECT * FROM {$db->pre}fields WHERE tb='$tb' ORDER BY listorder,itemid");
		while($r = $db->fetch_array($result)) {
			$data[$r['itemid']] = $r;
		}
		cache_write('fields-'.$tb.'.php', $data);
	} else {
		$tbs = array();
		$result = $db->query("SELECT * FROM {$db->pre}fields");
		while($r = $db->fetch_array($result)) {
			if(isset($tbs[$r['tb']])) continue;
			cache_fields($r['tb']);
			$tbs[$r['tb']] = $r['tb'];
		}
	}
}

//用户组
function cache_group() {
	global $db;
	$data = $group = array();
	$result = $db->query("SELECT * FROM {$db->pre}member_group ORDER BY listorder ASC,groupid ASC");
	while($r = $db->fetch_array($result)) {
		$groupid = $r['groupid'];
		$tmp = array();
		$tmp = get_setting('group-'.$groupid);
		$r['reg'] = $tmp['reg'];
		$data[$groupid] = $r;
		if($tmp) {
			foreach($tmp as $k=>$v) {
				isset($r[$k]) or $r[$k] = $v;
			}
		}
		$r['groupid'] = $groupid;
		cache_write('group-'.$groupid.'.php', $r);
	}
	cache_write('group.php', $data);
}

//清除
function cache_clear_ad($all = false) {
	global $RE_TIME;
	$globs = glob(RE_CACHE.'/htm/*.htm');
	if($globs) {
		foreach($globs as $v) {
			if(strpos(basename($v), 'ad_') === false) continue;
			if($all) {
				file_del($v);
			} else {
				$exptime = intval(substr(file_get($v), 4, 14));
				if($exptime && $RE_TIME > $exptime) file_del($v);
			}
		}
	}
}

//清除Tag
function cache_clear_tag($all = false) {
	global $RE_TIME;
	$globs = glob(RE_CACHE.'/tag/*.htm');
	if($globs) {
		foreach($globs as $v) {
			if($all) {
				file_del($v);
			} else {
				$exptime = intval(substr(file_get($v), 4, 14));
				if($exptime && $RE_TIME > $exptime) file_del($v);
			}
		}
	}
}

//清除SQL
function cache_clear_sql($dir, $all = false) {
	global $RE_TIME;
	if($dir) {
		$globs = glob(RE_CACHE.'/sql/'.$dir.'/*.php');
		if($globs) {
			foreach($globs as $v) {
				if($all) {
					file_del($v);
				} else {
					$exptime = intval(substr(file_get($v), 8, 18));
					if($exptime && $RE_TIME > $exptime) file_del($v);
				}
			}
		}
	} else {
		cache_clear('php', 'dir', 'sql');
	}
}
?>

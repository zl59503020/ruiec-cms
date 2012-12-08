<?php
defined('IN_RUIEC') or exit('Access Denied');

//$r = $db->get_one("SELECT MAX(itemid) AS maxid FROM {$table}");
//$maxid = $r['maxid'];

if(isset($v_ruiec_sm) && $v_ruiec_sm == 'ruiec') {
	/* if($setting['split']) {
		$setting['fulltext'] = 0;
		cache_write($moduleid.'.part', $moduleid);
	} else {
		cache_delete($moduleid.'.part');
	} */
	foreach($setting as $k=>$v) {
		if(strpos($k, 'seo_') === false) continue;
		seo_check($v) or die('SEO信息包含非法字符');
	}
	update_setting($moduleid, $setting);
	cache_module($moduleid);
	if($setting['php_list_urlid'] != $MOD['php_list_urlid'] || $setting['htm_list_urlid'] != $MOD['htm_list_urlid'] || $setting['htm_list_prefix'] != $MOD['htm_list_prefix'] || $setting['list_html'] != $MOD['list_html']) {
		$CATEGORY = cache_read('category-'.$moduleid.'.php');
		$MOD = $setting;
		foreach($CATEGORY as $c) {
			update_category($c);
		}
		cache_category($moduleid);
	}
	/* if($setting['php_item_urlid'] != $MOD['php_item_urlid'] || $setting['htm_item_urlid'] != $MOD['htm_item_urlid'] || $setting['htm_item_prefix'] != $MOD['htm_item_prefix'] || $setting['show_html'] != $MOD['show_html']) {
		msg('设置保存成功，开始更新地址', '?moduleid='.$moduleid.'&file=html&action=show&update=1&num=1000');
	} */
	//msg('更新成功', '?moduleid='.$moduleid.'&file='.$file.'&tab='.$tab);
	die('0');
} else {
	extract(_htmlspecialchars($MOD));
	include tpl('setting', $module);
}
?>
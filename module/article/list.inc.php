<?php 
defined('IN_RUIEC') or exit('Access Denied');
require RE_ROOT.'/module/'.$module.'/common.inc.php';
if(!$CAT || $CAT['moduleid'] != $moduleid) {
	$head_title = '分类不存在';
	@header("HTTP/1.1 404 Not Found");
	exit(include template('notfound', 'message'));
}
if($MOD['list_html']) {
	$html_file = listurl($CAT, $page);
	if(is_file(RE_ROOT.'/'.$MOD['moduledir'].'/'.$html_file)) {
		@header("HTTP/1.1 301 Moved Permanently");
		_header($MOD['linkurl'].$html_file);
		exit;
	}
}

//unset($CAT['moduleid']);

extract($CAT);

$tags = array();
$maincat = get_maincat(0, $moduleid);
$childcat = get_maincat($catid, $moduleid);
$catchilds = implode(',', get_catchilds($catid, $moduleid));

$condition = "status=3 AND catid IN ($catchilds)";
$pagesize = $MOD['pagesize'];
$start = ($page-1)*$pagesize;

$items = $db->count($table, $condition, $CFG['db_expires']);

$pages = listpages($CAT, $items, $page, $pagesize);

$result = $db->query("SELECT * FROM {$table} WHERE {$condition} ORDER BY ".$MOD['order']." LIMIT {$start},{$pagesize}");
while($r = $db->fetch_array($result)) {
	$r['adddate'] = timetodate($r['addtime'], 5);
	$r['editdate'] = timetodate($r['edittime'], 5);
	$r['alt'] = $r['title'];
	if(strpos($r['linkurl'], '://') === false) $r['linkurl'] = $MOD['linkurl'].$r['linkurl'];
	$tags[] = $r;
}
$db->free_result($result);

$seo_file = 'list';
include RE_ROOT.'/include/seo.inc.php';

$template = $CAT['template'] ? $CAT['template'] : ($MOD['template_list'] ? $MOD['template_list'] : 'list');

include template($template, $module);


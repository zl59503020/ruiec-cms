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
		dheader($MOD['linkurl'].$html_file);
	}
}

/* $CP = $MOD['cat_property'] && $CAT['property'];
if($MOD['cat_property'] && $CAT['property']) {
	require RE_ROOT.'/include/property.func.php';
	$PPT = property_condition($catid);
} */
unset($CAT['moduleid']);
extract($CAT);
//$maincat = get_maincat($parentid, $moduleid);
$maincat = get_maincat(0, $moduleid, 1);
$childcat = get_maincat($catid, $moduleid, 1);

$condition = 'status=3';
$condition .= " AND catid=$catid";
$pagesize = $MOD['pagesize'];
$tags = array();

$showpage = 1;
$datetype = 5;
$cols = 5;

$seo_file = 'list';

include RE_ROOT.'/include/seo.inc.php';

$template = $CAT['template'] ? $CAT['template'] : ($MOD['template_list'] ? $MOD['template_list'] : 'list');
include template($template, $module);
?>
<?php 
defined('IN_RUIEC') or exit('Access Denied');
require RE_ROOT.'/module/'.$module.'/common.inc.php';
/* if($MOD['index_html']) {
	$html_file = RE_ROOT.'/'.$MOD['moduledir'].'/'.$RE['index'].'.'.$RE['file_ext'];
	if(!is_file($html_file)) tohtml('index', $module);
	include($html_file);
	exit;
} */

$maincat = get_maincat(0, $moduleid, 1);

$seo_file = 'index';

include RE_ROOT.'/include/seo.inc.php';

$template = $MOD['template_index'] ? $MOD['template_index'] : 'index';
//$destoon_task = "moduleid=$moduleid&html=index";
include template($template, $module);
?>
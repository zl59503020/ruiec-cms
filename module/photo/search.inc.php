<?php 
defined('IN_RUIEC') or exit('Access Denied');
require RE_ROOT.'/module/'.$module.'/common.inc.php';
isset($kw) or $kw = 'z';
$seo_file = 'search';
include RE_ROOT.'/include/seo.inc.php';
$template = $MOD['template_search'] ? $MOD['template_search'] : 'search';
include template($template, $module);
?>
<?php 
defined('IN_RUIEC') or exit('Access Denied');
define('MD_ROOT', RE_ROOT.'/module/'.$module);
require RE_ROOT.'/include/module.func.php';
require MD_ROOT.'/global.func.php';
$table = $RE_PRE.$module.'_'.$moduleid;
$table_data = $RE_PRE.$module.'_data_'.$moduleid;
?>
<?php
defined('IN_RUIEC') or exit('Access Denied');
$setting = include(RE_ROOT.'/file/setting/module-10.php');
update_setting($moduleid, $setting);
$sql = file_get(RE_ROOT.'/file/setting/'.$module.'.sql');
$sql = str_replace('_10', '_'.$moduleid, $sql);
$sql = str_replace('信息', $modulename, $sql);
sql_execute($sql);
include RE_ROOT.'/module/'.$module.'/admin/remkdir.inc.php';
?>
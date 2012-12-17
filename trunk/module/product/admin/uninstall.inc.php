<?php
defined('IN_RUIEC') or exit('Access Denied');
$db->query("DROP TABLE IF EXISTS `".$RE_PRE.$module."_".$moduleid."`");
$db->query("DROP TABLE IF EXISTS `".$RE_PRE.$module."_data_".$moduleid."`");
?>
<?php
@set_time_limit(0);
define('RE_ADMIN', true);
require 'common.inc.php';

include_once RE_ROOT.'/admin/global.func.php';
require_once RE_ROOT.'/include/cache.func.php';

require_once RE_ROOT.'/admin/admin_check.inc.php';



isset($file) or $file = 'index';
isset($action) or $action = '';

if($module == 'ruiec') {
	(include RE_ROOT.'/admin/'.$file.'.inc.php') or msg();
} else {
	include RE_ROOT.'/module/'.$module.'/common.inc.php';
	(include MD_ROOT.'/admin/'.$file.'.inc.php') or msg();
}

?>
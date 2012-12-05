<?php
define('RE_DEBUG', true);
if(RE_DEBUG) {
	error_reporting(E_ALL);
	$mtime = explode(' ', microtime());
	$debug_starttime = $mtime[1] + $mtime[0];
} else {
	error_reporting(0);
}
if(isset($_REQUEST['GLOBALS']) || isset($_FILES['GLOBALS'])) exit('Request Denied');
@set_magic_quotes_runtime(0);
$MQG = get_magic_quotes_gpc();
foreach(array('_POST', '_GET', '_COOKIE') as $__R) {
	if($$__R) { foreach($$__R as $__k => $__v) { if(isset($$__k) && $$__k == $__v) unset($$__k); } }
}
define('IN_RUIEC', true);
define('IN_ADMIN', defined('RE_ADMIN') ? true : false);
define('RE_ROOT', str_replace("\\", '/', dirname(__FILE__)));
$CFG = array();
require RE_ROOT.'/config.inc.php';
define('RE_PATH', $CFG['url']);
define('RE_DOMAIN', $CFG['cookie_domain'] ? substr($CFG['cookie_domain'], 1) : '');
define('RE_WIN', strpos(strtoupper(PHP_OS), 'WIN') !== false ? true: false);
define('RE_CHMOD', ($CFG['file_mod'] && !RE_WIN) ? $CFG['file_mod'] : 0);
define('RE_KEY', $CFG['authkey']);
define('RE_CHARSET', $CFG['charset']);
define('RE_CACHE', $CFG['cache_dir'] ? $CFG['cache_dir'] : RE_ROOT.'/file/cache');
define('RE_SKIN', RE_PATH.'skin/'.$CFG['skin'].'/');
$L = array();
require RE_ROOT.'/version.inc.php';
require RE_ROOT.'/include/global.func.php';
require RE_ROOT.'/include/tag.func.php';
if(!$MQG && $_POST) $_POST = _addslashes($_POST);
if(!$MQG && $_GET) $_GET = _addslashes($_GET);
if(function_exists('date_default_timezone_set')) date_default_timezone_set($CFG['timezone']);
$RE_PRE = $CFG['tb_pre'];
$RE_QST = $_SERVER['QUERY_STRING'];
$RE_TIME = time() + $CFG['timediff'];
$RE_IP = get_env('ip');
$RE_URL = get_env('url');
$RE_REF = get_env('referer');
$RE_BS = get_env('bs');
$RE_OS = get_env('os');
header("Content-Type:text/html;charset=".RE_CHARSET);
require RE_ROOT.'/include/db_'.$CFG['database'].'.class.php';
require RE_ROOT.'/include/session.class.php';
require RE_ROOT.'/include/file.func.php';
if(!IN_ADMIN) {
	if(!empty($_SERVER['REQUEST_URI'])) {
		$uri = urldecode($_SERVER['REQUEST_URI']);
		if(strpos($uri, '<') !== false || strpos($uri, '0x') !== false || strpos($uri, "'") !== false || strpos($uri, '"') !== false) dalert(errmsg, 'goback');
	}
	if($_POST) $_POST = strip_sql($_POST);
	if($_GET) $_GET = strip_sql($_GET);
}
if($_POST) extract($_POST, EXTR_SKIP);
if($_GET) extract($_GET, EXTR_SKIP);
$db_class = 'db_'.$CFG['database'];
$db = new $db_class;
$db->halt = (RE_DEBUG || IN_ADMIN) ? 1 : 0;
$db->pre = $CFG['tb_pre'];
$db->connect($CFG['db_host'], $CFG['db_user'], $CFG['db_pass'], $CFG['db_name'], $CFG['db_expires'], $CFG['db_charset'], $CFG['pconnect']);
$RE = $MOD = $EXT = $CSS = $DTMP = $CAT = $ARE = $AREA = array();
$CACHE = cache_read('module.php');
if(!$CACHE) {
	require_once RE_ROOT.'/admin/global.func.php';
	require_once RE_ROOT.'/include/cache.func.php';
    cache_all();
	$CACHE = cache_read('module.php');
}
$RE = $CACHE['re'];
$MODULE = $CACHE['module'];
if(!IN_ADMIN) {
	if($RE['webstatus'] == '0') message($RE['webcloseinfo']);
}
unset($CACHE, $CFG['timezone'], $CFG['db_host'], $CFG['db_user'], $CFG['db_pass'], $db_class, $db_file);
if(!isset($moduleid)) {
	$moduleid = 1;
	$module = 'ruiec';
} else if($moduleid == 1) {
	$module = 'ruiec';
} else {
	$moduleid = intval($moduleid);
	isset($MODULE[$moduleid]) or rheader(RE_PATH);
	$module = $MODULE[$moduleid]['module'];
	$MOD = $moduleid == 3 ? $EXT : cache_read('module-'.$moduleid.'.php');
}
$action = (isset($action)) ? trim($action) : '';
$_username = $_company = $_passport = 'Guest';
$_groupid = 3;
?>
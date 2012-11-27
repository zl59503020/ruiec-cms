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
if(!$MQG && $_POST) $_POST = daddslashes($_POST);
if(!$MQG && $_GET) $_GET = daddslashes($_GET);
if(function_exists('date_default_timezone_set')) date_default_timezone_set($CFG['timezone']);
$RE_PRE = $CFG['tb_pre'];
$RE_QST = $_SERVER['QUERY_STRING'];
$RE_TIME = time() + $CFG['timediff'];
$RE_IP = get_env('ip');
$RE_URL = get_env('url');
$RE_REF = get_env('referer');
$RE_BS = get_env('bs');
$RE_OS = get_env('os');
//$RE_BOT = is_robot();	//֩��
header("Content-Type:text/html;charset=".RE_CHARSET);
require RE_ROOT.'/include/db_'.$CFG['database'].'.class.php';
//require RE_ROOT.'/include/cache_'.$CFG['cache'].'.class.php';	//$dc
require RE_ROOT.'/include/session.class.php';
require RE_ROOT.'/include/file.func.php';

if(!IN_ADMIN) {		//admin
	if(!empty($_SERVER['REQUEST_URI'])) {
		$uri = urldecode($_SERVER['REQUEST_URI']);
		if(strpos($uri, '<') !== false || strpos($uri, '0x') !== false || strpos($uri, "'") !== false || strpos($uri, '"') !== false) dalert(errmsg, 'goback');
	}
	if($_POST) $_POST = strip_sql($_POST);
	if($_GET) $_GET = strip_sql($_GET);
	$BANIP = cache_read('banip.php');
	if($BANIP) banip($BANIP);
	$destoon_task = '';
}
if($_POST) extract($_POST, EXTR_SKIP);
if($_GET) extract($_GET, EXTR_SKIP);
$db_class = 'db_'.$CFG['database'];
$db = new $db_class;
$db->halt = (RE_DEBUG || IN_ADMIN) ? 1 : 0;
$db->pre = $CFG['tb_pre'];
$db->connect($CFG['db_host'], $CFG['db_user'], $CFG['db_pass'], $CFG['db_name'], $CFG['db_expires'], $CFG['db_charset'], $CFG['pconnect']);
/*
$dc = new dcache();
$dc->pre = $CFG['cache_pre'];
*/

$RE = $MOD = $EXT = $CSS = $DTMP = $CAT = $ARE = $AREA = array();
$CACHE = cache_read('module.php');
if(!$CACHE) {
	require_once RE_ROOT.'/admin/global.func.php';
	//require_once RE_ROOT.'/include/post.func.php';
	require_once RE_ROOT.'/include/cache.func.php';
    cache_all();
	$CACHE = cache_read('module.php');
}
$RE = $CACHE['re'];
$MODULE = $CACHE['module'];
//$EXT = cache_read('module-3.php');
if(!IN_ADMIN) {
	if($RE['webstatus'] == '0') message($RE['webcloseinfo']);
	//if($RE['defend_cc'] || $RE['defend_reload'] || $RE['defend_proxy']) include RE_ROOT.'/include/defend.inc.php';
}
unset($CACHE, $CFG['timezone'], $CFG['db_host'], $CFG['db_user'], $CFG['db_pass'], $db_class, $db_file);

if(!isset($moduleid)) {
	$moduleid = 1;
	//$module = isset($module) ? $module : 'ruiec';
	$module = 'ruiec';
} else if($moduleid == 1) {
	$module = 'ruiec';
} else {
	$moduleid = intval($moduleid);
	isset($MODULE[$moduleid]) or rheader(RE_PATH);
	$module = $MODULE[$moduleid]['module'];
	$MOD = $moduleid == 3 ? $EXT : cache_read('module-'.$moduleid.'.php');
	//include DT_ROOT.'/lang/'.DT_LANG.'/'.$module.'.inc.php';
}
//$module = (isset($module)) ? $module : 'ruiec';
$action = (isset($action)) ? trim($action) : '';

/*
if(!isset($moduleid)) {
	$moduleid = 1;
	$module = 'ruiec';
} else if($moduleid == 1) {
	$module = 'ruiec';
} else {
	$moduleid = intval($moduleid);
	isset($MODULE[$moduleid]) or dheader(DT_PATH);
	$module = $MODULE[$moduleid]['module'];
	$MOD = $moduleid == 3 ? $EXT : cache_read('module-'.$moduleid.'.php');
}
*/
/*
$cityid = 0;
$city_name = $L['allcity'];
$city_domain = $city_template = $city_sitename = '';
if($RE['city']) include RE_ROOT.'/include/city.inc.php';
($RE['gzip_enable'] && !$_POST && !defined('DT_WAP')) ? ob_start('ob_gzhandler') : ob_start();
$forward = isset($forward) ? urldecode($forward) : $DT_REF;
$action = isset($action) ? trim($action) : '';
$submit = isset($_POST['submit']) ? 1 : 0;
if($submit) {
	isset($captcha) or $captcha = '';
	isset($answer) or $answer = '';
}
$page = isset($page) ? max(intval($page), 1) : 1;
$catid = isset($catid) ? intval($catid) : 0;
$areaid = isset($areaid) ? intval($areaid) : 0;
$itemid = isset($itemid) ? (is_array($itemid) ? $itemid : intval($itemid)) : 0;
$pagesize = $RE['pagesize'] ? $RE['pagesize'] : 30;
$offset = ($page-1)*$pagesize;
$kw = isset($kw) ? htmlspecialchars(str_replace(array("\'"), array(''), trim(urldecode($kw)))) : '';	
$keyword = $kw ? str_replace(array(' ', '*'), array('%', '%'), $kw) : '';
$today_endtime = strtotime(date('Y-m-d', $DT_TIME).' 23:59:59');
$seo_file = $seo_title = $head_title = $head_keywords = $head_description = $head_canonical = '';
if($catid) $CAT = get_cat($catid);
if($areaid) $ARE = get_area($areaid);
$_userid = $_admin = $_aid = $_message = $_chat = $_sound = $_online = $_money = $_credit = $_sms = 0;
*/
$_username = $_company = $_passport = 'Guest';
$_groupid = 3;
/*
$ruiec_auth = get_cookie('auth');
if($ruiec_auth) {	
	$_dauth = explode("\t", decrypt($ruiec_auth, md5(DT_KEY.$_SERVER['HTTP_USER_AGENT'])));
	$_userid = isset($_dauth[0]) ? intval($_dauth[0]) : 0;
	$_username = isset($_dauth[1]) ? trim($_dauth[1]) : '';
	$_groupid = isset($_dauth[2]) ? intval($_dauth[2]) : 3;
	$_admin = isset($_dauth[4]) ? intval($_dauth[4]) : 0;
	if($_userid && !defined('DT_NONUSER')) {
		$_password = isset($_dauth[3]) ? trim($_dauth[3]) : '';
		$user = $db->get_one("SELECT username,passport,company,truename,password,groupid,email,message,chat,sound,online,sms,credit,money,loginip,admin,aid,edittime,trade FROM {$DT_PRE}member WHERE userid=$_userid");
		if($user && $user['password'] == $_password) {
			if($user['groupid'] == 2) dalert(lang('message->common_forbidden'));
			extract($user, EXTR_PREFIX_ALL, '');
			if($user['loginip'] != $DT_IP && ($RE['ip_login'] == 2 || ($RE['ip_login'] == 1 && IN_ADMIN))) {
				$_userid = 0; set_cookie('auth', '');
				dalert(lang('message->common_login', array($user['loginip'])), DT_PATH);
			}
		} else {
			$_userid = 0;
			if($db->linked && !isset($swfupload) && strpos($_SERVER['HTTP_USER_AGENT'], 'Flash') === false) set_cookie('auth', '');
		}
		unset($ruiec_auth, $user, $_dauth, $_password);
	}
}
if($_userid == 0) { $_groupid = 3; $_username = ''; }
if(!IN_ADMIN) {
	if($_groupid == 1) include RE_ROOT.'/module/member/admin.inc.php';
	if($_userid && !defined('DT_NONUSER')) {
		$db->query("REPLACE INTO {$RE_PRE}online (userid,username,ip,moduleid,online,lasttime) VALUES ('$_userid','$_username','$RE_IP','$moduleid','$_online','$RE_TIME')");
	} else {
		if(timetodate($RE_TIME, 'i') == 10) {
			$lastime = $RE_TIME - $RE['online'];
			$db->query("DELETE FROM {$RE_PRE}online WHERE lasttime<$lastime");
		}
	}
}
$MG = cache_read('group-'.$_groupid.'.php');
*/
?>
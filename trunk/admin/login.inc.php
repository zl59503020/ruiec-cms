<?php
defined('IN_RUIEC') or exit('Access Denied');
RE_LICENSE == strtoupper(md5(file_get(RE_ROOT.'/license.txt'))) or msg('license.txt不可修改或删除，请检查');
if(!$forward) $forward = '?';
if($_destoon_admin && $_userid && $_destoon_admin == $_userid) dheader($forward);
if($RE['admin_ip']) {
	$IP = explode("|", trim($DT['admin_ip']));
	$pass = false;
	foreach($IP as $v) {
		if($v == $DT_IP) { $pass = true; break; }
		if(preg_match("/^".str_replace('*', '[0-9]{1,3}', $v)."$/", $DT_IP)) { $pass = true; break; }
	}
	if(!$pass) dalert('未被允许的IP段', DT_PATH);
}
if($DT['close']) $DT['captcha_admin'] = 0;
if($submit) {
	captcha($captcha, $DT['captcha_admin']);
	if(!$username) msg('请输入用户名');
	if(!$password) msg('请输入密码');
	include load('member.lang');
	$MOD = cache_read('module-2.php');
	require DT_ROOT.'/include/module.func.php';
	require DT_ROOT.'/module/member/member.class.php';
	$do = new member;
	$user = $do->login($username, $password);
	if($user) {
		if($user['groupid'] != 1 || $user['admin'] < 1) msg('您无权限访问后台', DT_PATH);
		if($user['userid'] != $CFG['founderid']) {
			if(($DT['admin_week'] && !check_period($DT['admin_week'])) || ($DT['admin_hour'] && !check_period($DT['admin_hour']))) {
				set_cookie('auth', '');
				dalert('未被允许的管理时间', DT_PATH);
			}
		}
		if($DT['authadmin'] == 'session') {
			$_SESSION[$secretkey] = $user['userid'];
		} else {
			set_cookie($secretkey, $user['userid']);
		}
		require DT_ROOT.'/admin/admin.class.php';
		$admin = new admin;
		$admin->cache_right($user['userid']);
		$admin->cache_menu($user['userid']);
		if($DT['login_log']) $do->login_log($username, $password, 1);
		dheader($forward);
	} else {
		if($DT['login_log']) $do->login_log($username, $password, 1, $do->errmsg);
		msg($do->errmsg);
	}
} else {
	if(strpos($DT_URL, DT_PATH) === false) dheader(DT_PATH.substr(get_env('self'), 1));
	$username = isset($username) ? $username : $_username;
	include tpl('login');
}
?>
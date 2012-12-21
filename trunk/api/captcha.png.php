<?php
define('RE_NONUSER', true);
require '../common.inc.php';
// check_referer() or exit;
$session = new _session();
require RE_ROOT.'/include/captcha.class.php';
$do = new captcha;
$do->charset = strtolower(RE_CHARSET);
$do->ip = $RE_IP;
$do->image();
?>
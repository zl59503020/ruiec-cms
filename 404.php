<?php
require 'common.inc.php';

$surl = addslashes($RE_REF);
$url = addslashes($RE_URL);
$time = $RE_TIME - 86400;
$r = $db->get_one("SELECT itemid FROM {$RE_PRE}404 WHERE addtime>$time AND furl='$url'");
if(!$r) $db->query("INSERT INTO {$RE_PRE}404 (surl,furl,username,addtime,ip,userAgent) VALUES ('$surl','$url','$_username','$RE_TIME','$RE_IP','".addslashes($_SERVER["HTTP_USER_AGENT"])."')");

$head_title = '404 Not Found';
@header("HTTP/1.1 404 Not Found");
include template('404', 'message');

?>
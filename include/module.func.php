<?php
defined('IN_RUIEC') or exit('Access Denied');
function get_fee($item_fee, $mod_fee) {
	if($item_fee < 0) {
		$fee = 0;
	} else if($item_fee == 0) {
		$fee = $mod_fee;
	} else {
		$fee = $item_fee;
	}
	return $fee;
}

function keyword($kw, $items, $moduleid) {
	global $db, $RE_TIME, $RE;
	if(!$RE['search_kw'] || $items < 2 || strlen($kw) < 3 || strlen($kw) > 30 || strpos($kw, ' ') !== false) return;
	$kw = addslashes($kw);
	$r = $db->get_one("SELECT * FROM {$db->pre}keyword WHERE moduleid=$moduleid AND word='$kw'");
	if($r) {
		$items = $items > $r['items'] ? $items : $r['items'];
		$month_search = date('Y-m', $r['updatetime']) == date('Y-m', $RE_TIME) ? 'month_search+1' : '1';
		$week_search = date('W', $r['updatetime']) == date('W', $RE_TIME) ? 'week_search+1' : '1';
		$today_search = date('Y-m-d', $r['updatetime']) == date('Y-m-d', $RE_TIME) ? 'today_search+1' : '1';
		$db->query("UPDATE {$db->pre}keyword SET items='$items',updatetime='$RE_TIME',total_search=total_search+1,month_search=$month_search,week_search=$week_search,today_search=$today_search WHERE itemid=$r[itemid]");
	} else {
		$letter = gb2py($kw);
		$status = $RE['search_check_kw'] ? 2 : 3;
		$db->query("INSERT INTO {$db->pre}keyword (moduleid,word,keyword,letter,items,updatetime,total_search,month_search,week_search,today_search,status) VALUES ('$moduleid','$kw','$kw','$letter','$items','$RE_TIME','1','1','1','1','$status')");
	}
}

function money_add($username, $amount) {
	global $db;
	if($username && $amount) $db->query("UPDATE {$db->pre}member SET money=money+{$amount} WHERE username='$username'");
}

function money_lock($username, $amount) {
	global $db;
	if($username && $amount) $db->query("UPDATE {$db->pre}member SET locking=locking+{$amount} WHERE username='$username'");
}

function money_record($username, $amount, $bank, $editor, $reason, $note = '') {
	global $db, $RE_TIME;
	if($username && $amount) {
		$r = $db->get_one("SELECT money FROM {$db->pre}member WHERE username='$username'");
		$balance = $r['money'];
		$db->query("INSERT INTO {$db->pre}finance_record (username,bank,amount,balance,adREime,reason,note,editor) VALUES ('$username','$bank','$amount','$balance','$RE_TIME','$reason','$note','$editor')");
	}
}

function credit_add($username, $amount) {
	global $db;
	if($username && $amount) $db->query("UPDATE {$db->pre}member SET credit=credit+{$amount} WHERE username='$username'");
}

function credit_record($username, $amount, $editor, $reason, $note = '') {
	global $db, $RE_TIME, $RE;
	if($RE['log_credit'] && $username && $amount) {
		$r = $db->get_one("SELECT credit FROM {$db->pre}member WHERE username='$username'");
		$balance = $r['credit'];
		$db->query("INSERT INTO {$db->pre}finance_credit (username,amount,balance,adREime,reason,note,editor) VALUES ('$username','$amount','$balance','$RE_TIME','$reason','$note','$editor')");
	}
}

function sms_add($username, $amount) {
	global $db;
	if($username && $amount) $db->query("UPDATE {$db->pre}member SET sms=sms+{$amount} WHERE username='$username'");
}

function sms_record($username, $amount, $editor, $reason, $note = '') {
	global $db, $RE_TIME;
	if($username && $amount) {
		$r = $db->get_one("SELECT sms FROM {$db->pre}member WHERE username='$username'");
		$balance = $r['sms'];
		$db->query("INSERT INTO {$db->pre}finance_sms (username,amount,balance,adREime,reason,note,editor) VALUES ('$username','$amount','$balance','$RE_TIME','$reason','$note','$editor')");
	}
}

function secondstodate($seconds) {
	include load('include.lang');
	$date = '';
	if($seconds > 0) {
		$t = floor($seconds/86400);
		if($t) {
			$date .= $t.$L['mod_day'];
			$seconds = $seconds%86400;
		}
		$t = floor($seconds/3600);
		if($t) {
			$date .= $t.$L['mod_hour'];
			$seconds = $seconds%3600;
		}
		$t = floor($seconds/60);
		if($t) {
			$date .= $t.$L['mod_minute'];
			$seconds = $seconds%60;
		}
		if($seconds) {
			$date .= $seconds.$L['mod_second'];
		}
	}
	return $date;
}

function get_intro($content, $length = 0) {
	if($length) {
		$intro = trim(strip_tags($content));
		$intro = preg_replace("/&([a-z]{1,});/", '', $intro);
		return _showtext($intro, $length);
	} else {
		return '';
	}
	return $length ? _substr(preg_replace("/&([a-z]{1,});/", '', trim(strip_tags($content))), $length) : '';
}

function get_description($content, $length) {
	if($length) {
		$content = str_replace(array(' ', '[pagebreak]'), array('', ''), $content);
		return nl2br(_substr(trim(strip_tags($content)), $length, '...'));
	} else {
		return '';
	}
}

function get_module_setting($moduleid, $key = '') {
	$M = cache_read('module-'.$moduleid.'.php');
	return $key ? $M[$key] : $M;
}

function anti_spam($string) {
	global $MODULE, $RE;
	if($RE['anti_spam'] && preg_match("/^[a-z0-9_@\-\s\/\.\,\(\)\+]+$/i", $string)) {
		do {
			$tmp = encrypt($string);
			if(strpos($tmp, '0x') === false) break;
		} while(1);
		return '<img src="'.$MODULE[3]['linkurl'].'image.php?auth='.rawurlencode($tmp).'" align="absmddle"/>';
	} else {
		return $string;
	}
}

function hide_ip($ip, $sep = '*') {
	if(!preg_match("/[\d\.]{7,15}/", $ip)) return $ip;
	$tmp = explode('.', $ip);
	return $tmp[0].'.'.$tmp[1].'.'.$sep.'.'.$sep;
}

function hide_name($name, $sep = '*') {
	$len = strlen($name);
	$str = '';
	for($i = 0; $i < $len; $i++) {
		$str .= ($i == 0 || $i == $len - 1) ? $name{$i} : $sep;
	}
	return $str;
}

function check_pay($moduleid, $itemid) {
	global $db, $_username, $RE_TIME, $MOD;
	$condition = "moduleid=$moduleid AND itemid=$itemid AND username='$_username'";
	if($MOD['fee_period']) $condition .= " AND paytime>".($RE_TIME - $MOD['fee_period']*60);
	return $db->get_one("SELECT itemid FROM {$db->pre}finance_pay WHERE $condition");
}

function check_sign($string, $sign) {
	return $sign == crypt_sign($string);
}

function crypt_sign($string) {
	global $RE_IP;
	return strtoupper(md5(md5($RE_IP.$string.RE_KEY)));
}

function cache_hits($moduleid, $itemid) {
	if(@$fp = fopen(RE_CACHE.'/hits-'.$moduleid.'.php', 'a')) {
		flock($fp, LOCK_EX);
		fwrite($fp, $itemid.' ');
		flock($fp, LOCK_UN);
		fclose($fp);
	}
}

function update_hits($moduleid, $table) {
	global $db, $RE_TIME;
	$hits = trim(file_get(RE_CACHE.'/hits-'.$moduleid.'.php'));
	file_put(RE_CACHE.'/hits-'.$moduleid.'.php', ' ');
	file_put(RE_CACHE.'/hits-'.$moduleid.'.dat', $RE_TIME);
	if($hits) {
		$tmp = array_count_values(explode(' ', $hits));
		$arr = array();
		foreach($tmp as $k=>$v) {
			$arr[$v] .= $k ? ','.$k : '';
		}
		$id = $moduleid == 4 ? 'userid' : 'itemid';
		foreach($arr as $k=>$v) {
			$db->query("UPDATE LOW_PRIORITY {$table} SET `hits`=`hits`+".$k." WHERE `$id` IN (0".$v.")", 'UNBUFFERED');
		}
	}
}

function keylink($content, $item) {
	global $KEYLINK;
	$KEYLINK or $KEYLINK = cache_read('keylink-'.$item.'.php');
	if(!$KEYLINK) return $content;
	$data = $content;
	foreach($KEYLINK as $k=>$v) {
		$quote = str_replace(array("'", '-'), array("\'", '\-'), preg_quote($v['title']));
		$data = preg_replace('\'(?!((<.*?)|(<a.*?)|(<strong.*?)))('.$quote.')(?!(([^<>]*?)>)|([^>]*?</a>)|([^>]*?</strong>))\'si', '<a href="'.$v['url'].'" target="_blank"><strong class="keylink">'.$v['title'].'</strong></a>', $data, 1);
		if($data == '') $data = $content;
	}
	return $data;
}

function gender($gender, $type = 0) {
	global $L;
	if($type) return $gender == 1 ? $L['man'] : $L['woman'];
	return $gender == 1 ? $L['sir'] : $L['lady'];
}

function online($userid) {
	global $db;
	$r = $db->get_one("SELECT online FROM {$db->pre}online WHERE userid=$userid");
	if($r) return $r['online'] ? 1 : -1;
	return 0;
}

function fix_link($url) {
	if(strlen($url) < 10) return '';
	return strpos($url, '://') === false  ? 'http://'.$url : $url;
}

function vip_year($fromtime) {
	global $RE_TIME;
	return $fromtime ? intval(($RE_TIME - $fromtime)/86400/365) + 1 : 1;
}

function get_albums($item, $type = 0) {
	$imgs = array();
	if($type == 0) {
		$nopic = RE_SKIN.'image/nopic60.gif';
		$imgs[] = $item['thumb'] ? $item['thumb'] : $nopic;
		$imgs[] = $item['thumb1'] ? $item['thumb1'] : $nopic;
		$imgs[] = $item['thumb2'] ? $item['thumb2'] : $nopic;
	} else if($type == 1) {
		$nopic = RE_SKIN.'image/nopic240.gif';
		$imgs[] = $item['thumb'] ? str_replace('.thumb.', '.middle.', $item['thumb']) : $nopic;
		$imgs[] = $item['thumb1'] ? str_replace('.thumb.', '.middle.', $item['thumb1']) : $nopic;
		$imgs[] = $item['thumb2'] ? str_replace('.thumb.', '.middle.', $item['thumb2']) : $nopic;
	}
	return $imgs;
}

function xml_linkurl($linkurl, $modurl = '') {
	if(strpos($linkurl, '://') === false) $linkurl = linkurl($modurl).$linkurl;
	return str_replace('&', '&amp;', $linkurl);
}

function highlight($str) {
	return '<span class="highlight">'.$str.'</span>';
}
?>
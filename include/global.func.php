<?php
defined('IN_RUIEC') or exit('Access Denied');

/*	Exception Error 	*/
set_error_handler("phpError" , E_ALL|E_STRICT );
function phpError($errno , $errstr,$errfile=false ,$errline=false,$errcontext=false   )
{
	$re = "";
	$re .= "\n\n\n<pre>------\n";
	$re .= "errID:{$errno}\n";
	$re .= "errStr:{$errstr}\n";
	$re .= "errFile:{$errfile}\n";
	$re .= "errLine:{$errline}\n";
	$re .= "errTime:".date("y-m-d H:i:s")."\n";
	if(is_array($errcontext))
	{
		$re .= "##出错时变量的值：##\n";
		$re .= print_r($errcontext,true)."\n";
	}
	$re .= "-------</pre>\n";
	if(RE_DEBUG){
		echo $re;
		exit;
	}else{
		//log
	}
}
set_exception_handler("phpException");
function phpException($e)
{
	echo 'Exception Info: <span style="color:red;">'.$e->getMessage().'</span>';
}

//------------------------------------------------------------------------

function start_editor($textareaid = 'content', $width = 500, $height = 400) {
	global $RE, $MODULE, $_userid, $moduleid;
	$width = is_numeric($width) ? $width.'px' : $width;
	$height = is_numeric($height) ? $height.'px' : $width;
	$editor = "";
	$editor .= "<link rel='stylesheet' type='text/css' href='".RE_PATH."file/JavaScript/ueditor/themes/default/ueditor.css'/>\n";
	$editor .= "<script type='text/javascript' src='".RE_PATH."file/JavaScript/ueditor/editor_config.js'></script>\n";
	$editor .= "<script type='text/javascript' src='".RE_PATH."file/JavaScript/ueditor/editor_all_min.js'></script>\n";
	$editor .= "<script type='text/javascript'>\n";
	$editor .= "var ue = new UE.ui.Editor({\n";
	$editor .= "imageUrl:'".RE_PATH."upload.php?moduleid=".$moduleid."&su=ueditor&upftype=image',\n";
	$editor .= "scrawlUrl:'".RE_PATH."upload.php?moduleid=".$moduleid."&su=ueditor&upftype=scrawl',\n";
	$editor .= "fileUrl:'".RE_PATH."upload.php?moduleid=".$moduleid."&su=ueditor&upftype=file',\n";
	$editor .= "});";
    $editor .= "ue.render('".$textareaid."');";
	$editor .= "</script>";
	echo $editor;
}

function rehtmlspecialchars($string) {
    return is_array($string) ? array_map('rehtmlspecialchars', $string) : str_replace('&amp;', '&', htmlspecialchars($string, ENT_QUOTES));
}

function daddslashes($string) {
	if(!is_array($string)) return addslashes($string);
	foreach($string as $key => $val) $string[$key] = daddslashes($val);
	return $string;
}

function dstripslashes($string) {
	if(!is_array($string)) return stripslashes($string);
	foreach($string as $key => $val) $string[$key] = dstripslashes($val);
	return $string;
}

function dsafe($string) {
	if(is_array($string)) {
		return array_map('dsafe', $string);
	} else {
		if(strlen($string) < 20) return $string;
		$match = array("/&#([a-z0-9]+)([;]*)/i", "/(j[\s\r\n\t]*a[\s\r\n\t]*v[\s\r\n\t]*a[\s\r\n\t]*s[\s\r\n\t]*c[\s\r\n\t]*r[\s\r\n\t]*i[\s\r\n\t]*p[\s\r\n\t]*t|jscript|js|vbscript|vbs|about|expression|script|frame|link|import)/i", "/on(mouse|exit|error|click|dblclick|key|load|unload|change|move|submit|reset|cut|copy|select|start|stop)/i");
		$replace = array("", "<d>\\1</d>", "on\n\\1");
		return preg_replace($match, $replace, $string);
	}
}

function RErim($string, $js = false) {
	$string = str_replace(array(chr(10), chr(13)), array('', ''), $string);
	return $js ? str_replace("'", "\'", $string) : $string;
}

function rheader($url) {
	global $RE;	
	if(!defined('RE_ADMIN') && $RE['defend_reload']) sleep($RE['defend_reload']);
	exit(header('location:'.$url));
}

function dmsg($dmsg = '', $dforward = '') {
	if(!$dmsg && !$dforward) {
		$dmsg = get_cookie('dmsg');
		if($dmsg) {
			echo '<script type="text/javascript">showmsg(\''.$dmsg.'\');</script>';
			set_cookie('dmsg', '');
		}
	} else {
		set_cookie('dmsg', $dmsg);
		$dforward = preg_replace("/(.*)([&?]rand=[0-9]*)(.*)/i", "\\1\\3", $dforward);
		$dforward = str_replace('.php&', '.php?', $dforward);
		$dforward = strpos($dforward, '?') === false ? $dforward.'?rand='.mt_rand(10, 99) : str_replace('?', '?rand='.mt_rand(10, 99).'&', $dforward);
		dheader($dforward);
	}
}

function dalert($dmessage = errmsg, $dforward = '', $extend = '') {
	global $CFG, $RE;
	exit(include template('alert', 'message'));
}


/*	HTML 补充闭合[修改版]		*/
function _closetags($html,$clear=false){
	//echo $html;
	//preg_match_all('#<([a-z]+)(?: .*)?(?<![/|/ ])>#iU', $html, $result);
	//preg_match_all('/<([\w]+)[^>|^\/>]*>/', $html, $result, PREG_OFFSET_CAPTURE);
	preg_match_all('#<([\w]+)[^>]*>#', $html, $result, PREG_OFFSET_CAPTURE);
	$openeREags = $result[1];
	preg_match_all('#</([\w]+)>#', $html, $result, PREG_OFFSET_CAPTURE);
	$closeREags = $result[1];
	$openeREags = array_reverse($openeREags);
	$errarray = array('br','p','img','input','hr');		//一些特殊标签,没有结束的
	$tmp_ct = 0;
	foreach($closeREags as $k=>$cd){
		$_i = 1;
		foreach($openeREags as $i=>$val){
			if($cd[0] == $val[0] && $cd[1] > $val[1] ){
				$openeREags[$i][0] = '';
				$_i = 0;
				//unset($openeREags[$i]);
				break;
			}
		}
		if($clear && $_i && !in_array($cd[0],$errarray)){
			//echo $tmp_ct;
			//print_r($cd);
			//echo substr($html,$cd[1]-2);
			//print_r(array(''));
			$html = substr_replace($html,'',$cd[1]-2-$tmp_ct,strlen('</'.$cd[0].'>'));
			$tmp_ct = $tmp_ct+strlen('</'.$cd[0].'>');
		}
	}
	foreach($openeREags as $k=>$val){
		if ($val[0] != '' && !in_array($val[0],$errarray)){
			$html .= '</'.$val[0].'>';
		}
	}
	return $html;
}

/*	字符串处理[截取][简洁版]	*/
function _showtext($str,$len,$more='',$st=0){
	if(strlen($str)>$len){
		$restr = $str;
		if(function_exists('mb_substr')){
			$restr = mb_substr($str, $st, $len, 'utf-8');
		}else if(function_exists('iconv_substr')){
			$restr = iconv_substr($str, $st, $len, 'utf-8');
		}else{
			$restr = substr($str, $st, $len);
		}
		return (strlen($restr)<strlen($str))?$restr.$more:$restr;
	}else{
		return $str;
	}
}

/*	字符串处理[截取][过滤HTML标签]	*/
function _sub_str($str,$len,$more='',$st=0){
	if(strlen($str)>$len){
		$restr = $temstr = '';
		$errarray = array('br','p','img','input','hr');		//一些特殊标签,没有结束的
		$arr = preg_split('/(<\!--.*-->|<[^>]*>)/s', $str, -1, PREG_SPLIT_OFFSET_CAPTURE);
		foreach($arr as $k => $v){
			if(isset($arr[$k+1])){
				$temp = $arr[$k][1] + strlen($arr[$k][0]);
				$arr[$k][2] = substr($str, $temp, $arr[$k+1][1] - $temp);
				$temps = explode(" ",$arr[$k][2]);
				$arr[$k][3] = str_ireplace("<", "", str_ireplace("/", "", str_ireplace(">", "", $temps[0])));
				if(stristr($arr[$k][2], '/>')){
					$arr[$k][4] = (isset($arr[$k-1][4]))?$arr[$k-1][4]:0;
					$arr[$k][5]	= '0';
				}else if(stristr($arr[$k][2], '</')){
					$arr[$k][4] = (isset($arr[$k-1][4]))?$arr[$k-1][4]-1:0;
					$arr[$k][5]	= '1';
				}else{
					$arr[$k][4] = @($arr[$k-1][4])+1;
					$arr[$k][5]	= '2';
				}
				$arr[$k][6] = strlen($arr[$k][0]);
			}
		}
		$tmobj = $tmobj1 = -1;
		$objary = array();
		//print_r($arr);
		foreach($arr as $k => $v){
			if($tmobj >= 0 || $tmobj1 == 0){
				if(count($objary) == 0) 
					break;
				if(@$v[3] == @$objary[$tmobj] && @$v[5] == '1'){
					$restr .= @$v[2];
					$tmobj = $tmobj-1;
				}
				continue;
			} else {
				$temstr .= str_ireplace("&nbsp;"," ",@$v[0]);
				if(strlen($temstr) > ($len*2)){
					if($tmobj1 == -1){
						$tmobj1 = 0;
						$restr .= $this->_showtext($v[0],($len-(strlen($temstr)-strlen($v[0]))),$more,$st);
					}
					if (isset($v[5]) and $v[5] == '1'){$restr .= @$v[2]; array_pop($objary);}	//出
					if (isset($v[5]) and $v[5] == '2' && !in_array(@$v[3],$errarray)) array_push($objary, @$v[3]);	//入
					$tmobj = (isset($v[4])) ? ((@$v[4]-1 < 0) ? 0 : @$v[4]-1) : 0;
				}else{
					$restr .= @$v[0];
					if (strlen($temstr) < $len){
						$restr .= @$v[2];
						if (isset($v[5]) and @$v[5] == '1') array_pop($objary);	//出
						if (isset($v[5]) and @$v[5] == '2' && !in_array(@$v[3],$errarray)) array_push($objary, @$v[3]);	//入
					} else {
						if (isset($v[5]) and @$v[5] != '2') $restr .= @$v[2];
						if (isset($v[5]) and @$v[5] == '1') array_pop($objary);	//出
						$tmobj = (isset($v[4])) ? ((@$v[4]-1 < 0) ? 0 : @$v[4]-1) : 0;
					}
				}
			}
		}
		return $restr;
	}else{
		return $str;
	}
}

//字符串处理
function rsubstr($string, $length, $suffix = '', $start = 0) {
	return @_sub_str($string,$length,$suffix,$start);
}

function dsubstr($string, $length, $suffix = '', $start = 0) {
	if($start) {
		$tmp = dsubstr($string, $start);
		$string = substr($string, strlen($tmp));
	}
	$strlen = strlen($string);
	if($strlen <= $length) return $string;
	$string = str_replace(array('&quot;', '&lt;', '&gt;'), array('"', '<', '>'), $string);
	$length = $length - strlen($suffix);
	$str = '';
	if(strtolower(RE_CHARSET) == 'utf-8') {
		$n = $tn = $noc = 0;
		while($n < $strlen)	{
			$t = ord($string{$n});
			if($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
				$tn = 1; $n++; $noc++;
			} elseif(194 <= $t && $t <= 223) {
				$tn = 2; $n += 2; $noc += 2;
			} elseif(224 <= $t && $t <= 239) {
				$tn = 3; $n += 3; $noc += 2;
			} elseif(240 <= $t && $t <= 247) {
				$tn = 4; $n += 4; $noc += 2;
			} elseif(248 <= $t && $t <= 251) {
				$tn = 5; $n += 5; $noc += 2;
			} elseif($t == 252 || $t == 253) {
				$tn = 6; $n += 6; $noc += 2;
			} else {
				$n++;
			}
			if($noc >= $length) break;
		}
		if($noc > $length) $n -= $tn;
		$str = substr($string, 0, $n);
	} else {
		for($i = 0; $i < $length; $i++) {
			$str .= ord($string{$i}) > 127 ? $string{$i}.$string{++$i} : $string{$i};
		}
	}
	$str = str_replace(array('"', '<', '>'), array('&quot;', '&lt;', '&gt;'), $str);
	return $str == $string ? $str : $str.$suffix;
}

function encrypt($txt, $key = '') {
	$rnd = md5(microtime());
	$len = strlen($txt);
	$ren = strlen($rnd);
	$ctr = 0;
	$str = '';
	for($i = 0; $i < $len; $i++) {
		$ctr = $ctr == $ren ? 0 : $ctr;
		$str .= $rnd[$ctr].($txt[$i] ^ $rnd[$ctr++]);
	}
	return str_replace('=', '', base64_encode(kecrypt($str, $key)));
}

function decrypt($txt, $key = '') {
	$txt = kecrypt(base64_decode($txt), $key);
	$len = strlen($txt);
	$str = '';
	for($i = 0; $i < $len; $i++) {
		$tmp = $txt[$i];
		$str .= $txt[++$i] ^ $tmp;
	}
	return $str;
}

function kecrypt($txt, $key) {
	$key = md5($key);
	$len = strlen($txt);
	$ken = strlen($key);
	$ctr = 0;
	$str = '';
	for($i = 0; $i < $len; $i++) {
		$ctr = $ctr == $ken ? 0 : $ctr;
		$str .= $txt[$i] ^ $key[$ctr++];
	}
	return $str;
}

function strtohex($str) {
	$hex = '';
	for($i = 0; $i < strlen($str); $i++) {
		$hex .= dechex(ord($str[$i]));
	}
	return $hex;
}

function hextostr($hex) {
	$str = '';
	for($i = 0; $i < strlen($hex) - 1; $i += 2) {
		$str .= chr(hexdec($hex[$i].$hex[$i+1]));
	}
	return $str;
}

function dround($var, $precision = 2, $sprinft = false) {
	$var = round(floatval($var), $precision);
	if($sprinft) $var = sprintf('%.'.$precision.'f', $var);
	return $var;
}

function dalloc($i, $n = 5000) {
	return ceil($i/$n);
}

function strip_sql($string) {
	$search = array("/union[\s|\t]/i","/select[\s|\t]/i","/update[\s|\t]/i","/outfile[\s|\t]/i","/ascii/i","/[\s|\t]or[\s|\t]/i","/\/\*/i");
	$replace = array('union&nbsp;','select&nbsp;','update&nbsp;','outfile&nbsp;','ascii&nbsp;','&nbsp;or&nbsp;', '');
	return is_array($string) ? array_map('strip_sql', $string) : preg_replace($search, $replace, $string);
}

function strip_nr($string, $js = false) {
	$string =  str_replace(array(chr(13), chr(10), "\n", "\r", "\t", '  '),array('', '', '', '', '', ''), $string);
	if($js) $string = str_replace("'", "\'", $string);
	return $string;
}

function template($template = 'index', $dir = '') {
	global $CFG;
	$to = $dir ? RE_CACHE.'/tpl/'.$dir.'-'.$template.'.php' : RE_CACHE.'/tpl/'.$template.'.php';
	$isfileto = is_file($to);
	if($CFG['template_refresh'] || !$isfileto) {
		if($dir) $dir = $dir.'/';
        $from = RE_ROOT.'/template/'.$CFG['template'].'/'.$dir.$template.'.htm';
		if($CFG['template'] != 'default' && !is_file($from)) {
			$from = RE_ROOT.'/template/default/'.$dir.$template.'.htm';
		}
		if(!is_file($from)){
			die('Tenplate File <span style="color:red;">'.$template.'.htm</span> Not Found! Please check.');
		}
        if(!$isfileto || filemtime($from) > filemtime($to) || (filesize($to) == 0 && filesize($from) > 0)) {
			require_once RE_ROOT.'/include/template.func.php';
			template_compile($from, $to);
		}
	}
	return $to;
}

function ob_template($template, $dir = '') {
	extract($GLOBALS, EXTR_SKIP);
	ob_start();
	include template($template, $dir);
	$contents = ob_get_contents();
	ob_clean();
	return $contents;
}

function message($rmessage = errmsg, $rforward = 'goback', $retime = 1) {
	global $CFG, $RE;
	if(!$rmessage && $rforward && $rforward != 'goback') rheader($rforward);
	exit(include template('message', 'message'));
}

function login() {
	global $_userid, $MODULE, $RE_URL, $RE;
	$_userid or rheader($MODULE[2]['linkurl'].$RE['file_login'].'?forward='.rawurlencode($RE_URL));
}

function random($length, $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz') {
	$hash = '';
	$max = strlen($chars) - 1;
	for($i = 0; $i < $length; $i++)	{
		$hash .= $chars[mt_rand(0, $max)];
	}
	return $hash;
}

function set_cookie($var, $value = '', $time = 0) {
	global $CFG, $RE_TIME;
	$time = $time > 0 ? $time : (empty($value) ? $RE_TIME - 3600 : 0);
	$port = $_SERVER['SERVER_PORT'] == '443' ? 1 : 0;
	$var = $CFG['cookie_pre'].$var;
	return setcookie($var, $value, $time, $CFG['cookie_path'], $CFG['cookie_domain'], $port);
}

function get_cookie($var) {
	global $CFG;
	$var = $CFG['cookie_pre'].$var;
	return isset($_COOKIE[$var]) ? $_COOKIE[$var] : '';
}

function get_table($moduleid, $data = 0) {
	global $RE_PRE, $MODULE;
	$module = $MODULE[$moduleid]['module'];
	if($data) {
		return in_array($module, array('article', 'info')) ? $RE_PRE.$module.'_data_'.$moduleid : $RE_PRE.$module.'_data';
	} else {
		return in_array($module, array('article', 'info')) ? $RE_PRE.$module.'_'.$moduleid : $RE_PRE.$module;
	}
}

function get_process($fromtime, $totime) {
	global $RE_TIME;
	if($fromtime && $RE_TIME < $fromtime) return 1;
	if($totime && $RE_TIME > $totime) return 3;
	return 2;
}

function send_message($touser, $title, $content, $typeid = 4, $fromuser = '') {
	global $db, $RE_TIME, $RE_IP;
	if($touser == $fromuser) return false;
	if(check_name($touser) && $title && $content) {
		$title = addslashes($title);
		$content = addslashes($content);
		$r = $db->get_one("SELECT black FROM {$db->pre}member WHERE username='$touser'");
		if($r) {
			if($r['black'] && $typeid != 4) {
				$blacks = explode(' ', $r['black']);
				$_from = $fromuser ? $fromuser : 'Guest';
				if(in_array($_from, $blacks)) return false;
			}
			$db->query("INSERT INTO {$db->pre}message (title,typeid,touser,fromuser,content,addtime,ip,status) VALUES ('$title', $typeid, '$touser','$fromuser','$content','$RE_TIME','$RE_IP',3)");			
			$db->query("UPDATE {$db->pre}member SET message=message+1 WHERE username='$touser'");
			if($fromuser) {
				$db->query("INSERT INTO {$db->pre}message (title,typeid,content,fromuser,touser,addtime,ip,status) VALUES ('$title','$typeid','$content','$fromuser','$touser','$RE_TIME','$RE_IP','2')");
			}
			return true;
		}
	}
	return false;
}

function send_mail($mail_to, $mail_subject, $mail_body, $mail_from = '', $mail_sign = true) {
	global $RE;
	require_once RE_ROOT.'/include/mail.func.php';
	$result = dmail(trim($mail_to), $mail_subject, $mail_body, $mail_from, $mail_sign);
	$success = $result == 'SUCCESS' ? 1 : 0;
	if($RE['mail_log']) {
		global $RE_TIME, $db;
		$status = $success ? 3 : 2;
		$note = $success ? '' : addslashes($result);
		$mail_subject = stripslashes($mail_subject);
		$mail_body = stripslashes($mail_body);
		$mail_subject = addslashes($mail_subject);
		$mail_body = addslashes($mail_body);
		$db->query("INSERT INTO {$db->pre}mail_log (email,title,content,addtime,status,note) VALUES ('$mail_to','$mail_subject','$mail_body','$RE_TIME','$status','$note')");
	}
	return $success;
}

function strip_sms($message) {
	global $RE;
	$message = strip_tags($message);
	$message = preg_replace("/&([a-z]{1,});/", '', $message);
	$message = str_replace(' ', '', $message);
	if($RE['sms_sign']) $message .= $RE['sms_sign'];
	return $message;
}

function send_sms($mobile, $message, $word = 0, $time = 0) {
	global $db, $RE, $RE_TIME, $RE_IP, $_username;
	if(!$RE['sms'] || !$RE['sms_uid'] || !$RE['sms_key']) return false;
	$word or $word = word_count($message);
	$sms_message = rawurlencode(convert($message, RE_CHARSET, 'UTF-8'));
	$data = 'sms_uid='.$RE['sms_uid'].'&sms_key='.$RE['sms_key'].'&sms_charset='.RE_CHARSET.'&sms_mobile='.$mobile.'&sms_message='.$sms_message.'&sms_time='.$time;
	$header = "POST /send.php HTTP/1.0\r\n";
	$header .= "Accept: */*\r\n";
	$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
	$header .= "Content-Length: ".strlen($data)."\r\n\r\n";
	$RE['sms_host'] or $RE['sms_host'] = 'sms';
	$fp = fsockopen($RE['sms_host'].'.destoon.com', 8820);
	$code = '';
	if($fp) {
		fputs($fp, $header.$data);
		while(!feof($fp)) {
			$code .= fgets($fp, 1024);
		}
		fclose($fp);
		if($code && strpos($code, 'destoon_sms_code=') !== false) {
			$code = explode('destoon_sms_code=', $code);
			$code = $code[1];
		} else {
			$code = 'Can Not Connect SMS Server';
		}
	} else {
		$code = 'Can Not Connect SMS Server';
	}
	$db->query("INSERT INTO {$db->pre}sms (mobile,message,word,editor,senREime,code) VALUES ('$mobile','$message','$word','$_username','$RE_TIME','$code')");
	return $code;
}

function word_count($string) {
	$string = convert($string, RE_CHARSET, 'gbk');
	$length = strlen($string);
	$count = 0;
	for($i = 0; $i < $length; $i++) {
		$t = ord($string[$i]);
		if($t > 127) $i++;
		$count++;
	}
	return $count;
}

function cache_read($file, $dir = '', $mode = '') {
	$file = $dir ? RE_CACHE.'/'.$dir.'/'.$file : RE_CACHE.'/'.$file;
	if(!is_file($file)) return array();
	return $mode ? file_get($file) : include $file;
}

function cache_write($file, $string, $dir = '') {
	if(is_array($string)) $string = "<?php defined('IN_RUIEC') or exit('Access Denied'); return ".strip_nr(var_export($string, true))."; ?>";
	$file = $dir ? RE_CACHE.'/'.$dir.'/'.$file : RE_CACHE.'/'.$file;
	$strlen = file_put($file, $string);
	return $strlen;
}

function cache_delete($file, $dir = '') {
	$file = $dir ? RE_CACHE.'/'.$dir.'/'.$file : RE_CACHE.'/'.$file;
	return file_del($file);
}

function cache_clear($str, $type = '', $dir = '') {
	$dir = $dir ? RE_CACHE.'/'.$dir.'/' : RE_CACHE.'/';
	$files = glob($dir.'*');
	if(is_array($files)) {
		if($type == 'dir') {
			foreach($files as $file) {
				if(is_dir($file)) {dir_delete($file);} else {if(file_ext($file) == $str) file_del($file);}
			}
		} else {
			foreach($files as $file) {
				if(!is_dir($file) && strpos(basename($file), $str) !== false) file_del($file);
			}
		}
	}
}

function content_table($moduleid, $itemid, $split, $table_data = '') {
	if($split) {
		return split_table($moduleid, $itemid);
	} else {
		$table_data or $table_data = get_table($moduleid, 1);
		return $table_data;
	}
}

function split_table($moduleid, $itemid) {
	global $RE_PRE;
	$part = split_id($itemid);
	return $RE_PRE.$moduleid.'_'.$part;
}

function split_id($id) {
	return $id > 0 ? ceil($id/500000) : 1;
}

function ip2area($ip) {
	$area = '';
	if(is_ip($ip)) {
		$tmp = explode('.', $ip);
		if($tmp[0] == 10 || $tmp[0] == 127 || ($tmp[0] == 192 && $tmp[1] == 168) || ($tmp[0] == 172 && ($tmp[1] >= 16 && $tmp[1] <= 31))) {
			$area = 'LAN';
		} elseif($tmp[0] > 255 || $tmp[1] > 255 || $tmp[2] > 255 || $tmp[3] > 255) {
			$area = 'Unkonw';
		} else {
			require_once RE_ROOT.'/include/ip.func.php';
			$area = convertip($ip);
		}
	}
	$area = convert($area, 'gbk', RE_CHARSET);
	return $area;
}

function banip($IP) {
	global $RE_IP, $RE_TIME;
	$ban = false;
	foreach($IP as $v) {
		if($v['totime'] && $v['totime'] < $RE_TIME) continue;
		if($v['ip'] == $RE_IP) { $ban = true; break; }
		if(preg_match("/^".str_replace('*', '[0-9]{1,3}', $v['ip'])."$/", $RE_IP)) { $ban = true; break; }
	}
	if($ban) message(lang('include->msg_ip_ban', array($RE_IP)));
}

function banword($WORD, $string, $extend = true) {
	$string = stripslashes($string);
	foreach($WORD as $v) {
		$v[0] = preg_quote($v[0]);
		$v[0] = str_replace('/', '\/', $v[0]);
		$v[0] = str_replace("\*", ".*", $v[0]);
		if($v[2] && $extend) {
			if(preg_match("/".$v[0]."/i", $string)) dalert(lang('include->msg_word_ban'));
		} else {
			if($string == '') break;
			if(preg_match("/".$v[0]."/i", $string)) $string = preg_replace("/".$v[0]."/i", $v[1], $string);
		}
	}
	return addslashes($string);
}

function get_env($type) {
	switch($type) {
		case 'ip':
			isset($_SERVER['HTTP_X_FORWARDED_FOR']) or $_SERVER['HTTP_X_FORWARDED_FOR'] = '';
			isset($_SERVER['REMOTE_ADDR']) or $_SERVER['REMOTE_ADDR'] = '';
			isset($_SERVER['HTTP_CLIENT_IP']) or $_SERVER['HTTP_CLIENT_IP'] = '';
			if($_SERVER['HTTP_X_FORWARDED_FOR'] && $_SERVER['REMOTE_ADDR']) {
				$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
				if(strpos($ip, ',') !== false) {
					$tmp = explode(',', $ip);
					$ip = trim(end($tmp));
				}
				if(is_ip($ip)) return $ip;
			}
			if(is_ip($_SERVER['HTTP_CLIENT_IP'])) return $_SERVER['HTTP_CLIENT_IP'];
			if(is_ip($_SERVER['REMOTE_ADDR'])) return $_SERVER['REMOTE_ADDR'];
			return 'unknown';
		break;
		case 'self':
			return isset($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : (isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : $_SERVER['ORIG_PATH_INFO']);
		break;
		case 'referer':
			return isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
		break;
		case 'domain':
			return $_SERVER['SERVER_NAME'];
		break;
		case 'scheme':
			return $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
		break;
		case 'port':
			return $_SERVER['SERVER_PORT'] == '80' ? '' : ':'.$_SERVER['SERVER_PORT'];
		break;
		case 'url':
			if(isset($_SERVER['REQUEST_URI'])) {
				$uri = $_SERVER['REQUEST_URI'];
			} else {
				$uri = $_SERVER['PHP_SELF'];
				if(isset($_SERVER['argv'])) {
					if(isset($_SERVER['argv'][0])) $uri .= '?'.$_SERVER['argv'][0];
				} else {
					$uri .= '?'.$_SERVER['QUERY_STRING'];
				}
			}
			$uri = rehtmlspecialchars($uri);
			return get_env('scheme').$_SERVER['HTTP_HOST'].(strpos($_SERVER['HTTP_HOST'], ':') === false ? get_env('port') : '').$uri;
		break;
		case 'bs':
			$Agent = strtolower($_SERVER["HTTP_USER_AGENT"]);
			$br_Name = '';
			$br_Version = array();
			if (preg_match('/msie\s([0-9.0-9]+)/', $Agent, $br_Version)) {
				$br_Name = "Internet Explorer";
			} else if(preg_match( '/opera\/([0-9.0-9]+)/', $Agent, $br_Version)) {
				$br_Name = "Opera";
			} else if(preg_match( '/firefox\/([0-9.0-9]+)/', $Agent, $br_Version)) {
				$br_Name = "Firefox";
			} else if(preg_match( '/chrome\/([0-9.0-9]+)/', $Agent, $br_Version)) {
				$br_Name = "Chrome";
			} else if(preg_match( '/safari\/([0-9.0-9]+)/', $Agent, $br_Version)) {
				$br_Name = "Safari";
			} else {
				$br_Name = "Unknown";
			}
			return $br_Name." ".$br_Version[1];
		break;
		case 'os':
			$Agent = strtolower($_SERVER["HTTP_USER_AGENT"]);
			$os_Name = '';
			if(preg_match( '/win/', $Agent) && strpos($Agent, '95')) {
				$os_Name = "Windows 95";
			} else if(preg_match( '/win 9x/', $Agent) && strpos($Agent, '4.90')) {
				$os_Name = "Windows ME";
			} else if(preg_match( '/win/', $Agent) && preg_match( '/98/', $Agent)) {
				$os_Name = "Windows 98";
			} else if(preg_match( '/win/', $Agent) && preg_match( '/nt 5.0/', $Agent)) {
				$os_Name = "Windows 2000";
			} else if(preg_match( '/win/', $Agent) && preg_match( '/nt 5.1/', $Agent)) {
				$os_Name = "Windows XP";
			} else if(preg_match( '/win/', $Agent) && preg_match( '/nt 6.0/', $Agent)) {
				$os_Name = "Windows Vista";
			} else if(preg_match( '/win/', $Agent) && preg_match( '/nt 6.1/', $Agent)) {
				$os_Name = "Windows 7";
			} else if(preg_match( '/win/', $Agent) && preg_match( '/32/', $Agent)) {
				$os_Name = "Windows 32";
			} else if(preg_match( '/win/', $Agent) && preg_match( '/nt/', $Agent)) {
				$os_Name = "Windows NT";
			} else if(preg_match( '/mac os/', $Agent)) {
				$os_Name = "Mac OS";
			} else if(preg_match( '/linux/', $Agent)) {
				$os_Name = "Linux";
			} else if(preg_match( '/unix/', $Agent)) {
				$os_Name = "Unix";
			} else if(preg_match( '/sun/', $Agent) && preg_match( '/os/', $Agent)) {
				$os_Name = "SunOS";
			} else if(preg_match( '/ibm/', $Agent) && preg_match( '/os/', $Agent)) {
				$os_Name = "IBM OS/2";
			} else if(preg_match( '/mac/', $Agent) && preg_match( '/pc/', $Agent)) {
				$os_Name = "Macintosh";
			} else if(preg_match( '/powerpc/', $Agent)) {
				$os_Name = "PowerPC";
			} elseif (preg_match( '/aix/', $Agent)) {
				$os_Name = "AIX";
			} else if(preg_match( '/hpux/', $Agent)) {
				$os_Name = "HPUX";
			} else if(preg_match( '/netbsd/', $Agent)) {
				$os_Name = "NetBSD";
			} else if(preg_match( '/bsd/', $Agent)) {
				$os_Name = "BSD";
			} else if(preg_match( '/osfl/', $Agent)) {
				$os_Name = "OSF1";
			} else if(preg_match( '/irix/', $Agent)) {
				$os_Name = "IRIX";
			} else if(preg_match( '/freebsd/', $Agent)) {
				$os_Name = "FreeBSD";
			} else {
				$os_Name = "Unknown"; 
			}
			return $os_Name;
		break;
	}
}

function convert($str, $from = 'utf-8', $to = 'gb2312') {
	if(!$str) return '';
	$from = strtolower($from);
	$to = strtolower($to);
	if($from == $to) return $str;
	$from = str_replace('gbk', 'gb2312', $from);
	$to = str_replace('gbk', 'gb2312', $to);
	$from = str_replace('utf8', 'utf-8', $from);
	$to = str_replace('utf8', 'utf-8', $to);
	if($from == $to) return $str;
	$tmp = array();
	if(function_exists('iconv')) {
		if(is_array($str)) {
			foreach($str as $key => $val) {
				$tmp[$key] = iconv($from, $to."//IGNORE", $val);
			}
			return $tmp;
		} else {
			return iconv($from, $to."//IGNORE", $str);
		}
	} else if(function_exists('mb_convert_encoding')) {
		if(is_array($str)) {
			foreach($str as $key => $val) {
				$tmp[$key] = mb_convert_encoding($val, $to, $from);
			}
			return $tmp;
		} else {
			return mb_convert_encoding($str, $to, $from);
		}	
	} else {
		require_once RE_ROOT.'/include/convert.func.php';
		return dconvert($str, $to, $from);
	}
}

function get_type($item, $cache = 0) {
	$types = array();
	if($cache) {
		$types = cache_read('type-'.$item.'.php');
	} else {
		global $db;
		$result = $db->query("SELECT * FROM {$db->pre}type WHERE item='$item' ORDER BY listorder ASC,typeid DESC ");
		while($r = $db->fetch_array($result)) {
			$types[$r['typeid']] = $r;
		}
	}
	return $types;
}

function get_cat($catid) {
	global $db;
	$catid = intval($catid);
	return $catid ? $db->get_one("SELECT * FROM {$db->pre}category WHERE catid=$catid") : array();
}

function cat_pos($CAT, $str = ' &raquo; ', $target = '') {
	global $MODULE, $db;
	if(!$CAT) return '';
	$arrparentids = $CAT['arrparentid'].','.$CAT['catid'];
	$arrparentid = explode(',', $arrparentids);
	$pos = '';
	$target = $target ? ' target="_blank"' : '';	
	$CATEGORY = array();
	$result = $db->query("SELECT catid,moduleid,catname,linkurl FROM {$db->pre}category WHERE catid IN ($arrparentids)");
	while($r = $db->fetch_array($result)) {
		$CATEGORY[$r['catid']] = $r;
	}
	foreach($arrparentid as $catid) {
		if(!$catid || !isset($CATEGORY[$catid])) continue;
		$pos .= '<a href="'.$MODULE[$CATEGORY[$catid]['moduleid']]['linkurl'].$CATEGORY[$catid]['linkurl'].'"'.$target.'>'.$CATEGORY[$catid]['catname'].'</a>'.$str;
	}
	$_len = strlen($str);
	if($str && substr($pos, -$_len, $_len) === $str) $pos = substr($pos, 0, strlen($pos)-$_len);
	return $pos;
}

function cat_url($catid) {
	global $MODULE, $db;
	$r = $db->get_one("SELECT moduleid,linkurl FROM {$db->pre}category WHERE catid=$catid");
	return $r ? $MODULE[$r['moduleid']]['linkurl'].$r['linkurl'] : '';
}

function get_area($areaid) {
	global $db;
	$areaid = intval($areaid);
	return $db->get_one("SELECT * FROM {$db->pre}area WHERE areaid=$areaid");
}

function area_pos($areaid, $str = ' &raquo; ', $deep = 0) {
	if($areaid) {
		global $AREA;
	} else {
		global $L;
		return $L['allcity'];
	}
	$AREA or $AREA = cache_read('area.php');
	$arrparentid = $AREA[$areaid]['arrparentid'] ? explode(',', $AREA[$areaid]['arrparentid']) : array();
	$arrparentid[] = $areaid;
	$pos = '';
	if($deep) $i = 1;
	foreach($arrparentid as $areaid) {
		if(!$areaid || !isset($AREA[$areaid])) continue;
		if($deep) {
			if($i > $deep) continue;
			$i++;
		}
		$pos .= $AREA[$areaid]['areaname'].$str;
	}
	$_len = strlen($str);
	if($str && substr($pos, -$_len, $_len) === $str) $pos = substr($pos, 0, strlen($pos)-$_len);
	return $pos;
}

function get_maincat($catid, $moduleid, $level = -1) {
	global $db;
	$condition = $catid ? "parentid=$catid" : "moduleid=$moduleid AND parentid=0";
	if($level >= 0) $condition .= " AND level=$level";
	$cat = array();
	$result = $db->query("SELECT catid,catname,child,style,linkurl,item FROM {$db->pre}category WHERE $condition ORDER BY listorder,catid ASC", 'CACHE');
	while($r = $db->fetch_array($result)) {
		$cat[] = $r;
	}
	return $cat;
}

function get_mainarea($areaid) {
	global $db;
	$areaid = intval($areaid);
	$are = array();
	$result = $db->query("SELECT areaid,areaname FROM {$db->pre}area WHERE parentid=$areaid ORDER BY listorder,areaid ASC", 'CACHE');
	while($r = $db->fetch_array($result)) {
		$are[] = $r;
	}
	return $are;
}

function get_user($value, $key = 'username', $from = 'userid') {
	global $db;
	$r = $db->get_one("SELECT `$from` FROM {$db->pre}member WHERE `$key`='$value'");
	return $r[$from];
}

function check_group($groupid, $groupids) {
	if(!$groupids || $groupid == 1) return true;
	if($groupid == 4) $groupid = 3;
	return in_array($groupid, explode(',', $groupids));
}

function tohtml($htmlfile, $module = '', $parameter = '') {
	defined('TOHTML') or define('TOHTML', true);
    extract($GLOBALS, EXTR_SKIP);
	if($parameter) parse_str($parameter);
    include $module ? RE_ROOT.'/module/'.$module.'/'.$htmlfile.'.htm.php' : RE_ROOT.'/include/'.$htmlfile.'.htm.php';
}

function set_style($string, $style = '', $tag = 'span') {
	if(preg_match("/^#[0-9a-zA-Z]{6}$/", $style)) $style = 'color:'.$style;
	return $style ? '<'.$tag.' style="'.$style.'">'.$string.'</'.$tag.'>' : $string;
}

function crypt_action($action) {
	global $RE_IP;
	return md5(md5($action.RE_KEY.$RE_IP));
}

function captcha($captcha, $enable = 1, $return = false) {
	global $RE_IP, $RE, $session;
	if($enable) {
		if($RE['captcha_cn']) {
			if(strlen($captcha) < 4) {
				$msg = lang('include->captcha_missed');
				return $return ? $msg : message($msg);
			}
		} else {
			if(!preg_match("/^[0-9a-z]{4,}$/i", $captcha)) {
				$msg = lang('include->captcha_missed');
				return $return ? $msg : message($msg);
			}
		}
		if(!is_object($session)) $session = new dsession();
		if(!isset($_SESSION['captchastr'])) {
			$msg = lang('include->captcha_expired');
			return $return ? $msg : message($msg);
		}
		if($_SESSION['captchastr'] != md5(md5(strtoupper($captcha).RE_KEY.$RE_IP))) {
			$msg = lang('include->captcha_error');
			return $return ? $msg : message($msg);
		}
		unset($_SESSION['captchastr']);
	} else {
		return '';
	}
}

function question($answer, $enable = 1, $return = false) {
	global $RE_IP, $session;
	if($enable) {
		if(!$answer) {
			$msg = lang('include->answer_missed');
			return $return ? $msg : message($msg);
		}
		$answer = stripslashes($answer);
		if(!is_object($session)) $session = new dsession();
		if(!isset($_SESSION['answerstr'])) {
			$msg = lang('include->question_expired');
			return $return ? $msg : message($msg);
		}
		if($_SESSION['answerstr'] != md5(md5($answer.RE_KEY.$RE_IP))) {
			$msg = lang('include->answer_error');
			return $return ? $msg : message($msg);
		}
		unset($_SESSION['answerstr']);
	} else {
		return '';
	}
}

function pages($total, $page = 1, $perpage = 20, $demo = '', $step = 2) {
	global $RE_URL, $RE, $L;
	if($total <= $perpage) return '';
	$items = $total;
	$total = ceil($total/$perpage);
	if($page < 1 || $page > $total) $page = 1;
	if($demo) {
		$demo_url = $demo;
		$home_url = str_replace('{destoon_page}', '1', $demo_url);
	} else {
		if(defined('RE_REWRITE') && $RE['rewrite'] && $_SERVER["SCRIPT_NAME"]) {
			$demo_url = $_SERVER["SCRIPT_NAME"];
			$demo_url = str_replace('//', '/', $demo_url);//Fix Nginx
			$mark = false;
			if(substr($demo_url, -4) == '.php') {
				if(strpos($_SERVER['QUERY_STRING'], '.html') === false) {
					$qstr = '';
					if($_SERVER['QUERY_STRING']) {					
						if(substr($_SERVER['QUERY_STRING'], -5) == '.html') {
							$qstr = '-'.substr($_SERVER['QUERY_STRING'], 0, -5);
						} else {
							parse_str($_SERVER['QUERY_STRING'], $qs);
							foreach($qs as $k=>$v) {
								$qstr .= '-'.$k.'-'.rawurlencode($v);
							}
						}
					}
					$demo_url = substr($demo_url, 0, -4).'-htm-page-{destoon_page}'.$qstr.'.html';
				} else {
					$demo_url = substr($demo_url, 0, -4).'-htm-'.$_SERVER['QUERY_STRING'];
					$mark = true;
				}
			} else {
				$mark = true;
			}
			if($mark) {
				if(strpos($demo_url, '%') === false) $demo_url =  rawurlencode($demo_url);
				$demo_url = str_replace(array('%2F', '%3A'), array('/', ':'), $demo_url);
				if(strpos($demo_url, '-page-') !== false) {
					$demo_url = preg_replace("/page-([0-9]+)/", 'page-{destoon_page}', $demo_url);
				} else {
					$demo_url = str_replace('.html', '-page-{destoon_page}.html', $demo_url);
				}
			}
			$home_url = str_replace('-page-{destoon_page}', '-page-1', $demo_url);
		} else {
			$RE_URL = str_replace('&amp;', '&', $RE_URL);
			$demo_url = $home_url = preg_replace("/(.*)([&?]page=[0-9]*)(.*)/i", "\\1\\3", $RE_URL);
			$s = strpos($demo_url, '?') === false ? '?' : '&';
			$demo_url = $demo_url.$s.'page={des'.'toon_page}';
		}
	}
	$pages = '';
	include RE_ROOT.'/api/pages.'.($RE['pages_mode'] ? 'sample' : 'default').'.php';
	return $pages;
}

function listpages($CAT, $total, $page = 1, $perpage = 20, $step = 2) {
	global $RE, $MOD, $L;
	if($total <= $perpage) return '';
	$items = $total;
	$total = ceil($total/$perpage);
	if($page < 1 || $page > $total) $page = 1;
	$home_url = $MOD['linkurl'].$CAT['linkurl'];
	$demo_url = $MOD['linkurl'].listurl($CAT, '{destoon_page}');
	$pages = '';
	include RE_ROOT.'/api/pages.'.($RE['pages_mode'] ? 'sample' : 'default').'.php';
	return $pages;
}

function showpages($item, $total, $page = 1) {
	global $MOD, $L;
	$pages = '';
	$home_url = $MOD['linkurl'].itemurl($item);
	$demo_url = $MOD['linkurl'].itemurl($item, '{destoon_page}');
	$_page = $page <= 1 ? $total : ($page - 1);
	$url = $_page == 1 ? $home_url : str_replace('{destoon_page}', $_page, $demo_url);
	$pages .= '<input type="hidden" id="des'.'toon_previous" value="'.$url.'"/><a href="'.$url.'" title="'.$L['prev_page'].'">&nbsp;&#171;&nbsp;</a> ';
	for($_page = 1; $_page <= $total; $_page++) {
		$url = $_page == 1 ? $home_url : str_replace('{destoon_page}', $_page, $demo_url);
		$pages .= $page == $_page ? '<strong>&nbsp;'.$_page.'&nbsp;</strong> ' : ' <a href="'.$url.'">&nbsp;'.$_page.'&nbsp;</a>  ';
	}
	$_page = $page >= $total ? 1 : $page + 1;
	$url = $_page == 1 ? $home_url : str_replace('{destoon_page}', $_page, $demo_url);
	$pages .= '<a href="'.$url.'" title="'.$L['next_page'].'">&nbsp;&#187;&nbsp;</a> <input type="hidden" id="des'.'toon_next" value="'.$url.'"/>';
	return $pages;
}

function linkurl($linkurl, $absurl = 1) {
	global $CFG;
	if($absurl) {
		if(strpos($linkurl, '://') !== false) return $linkurl;
		return strpos($linkurl, $CFG['path']) === 0 ? $CFG['url'].substr($linkurl, strlen($CFG['path'])) : $CFG['url'].$linkurl;
	} else {
		if(strpos($linkurl, '://') !== false) return strpos($linkurl, $CFG['url']) === 0 ? $CFG['path'].substr($linkurl, strlen($CFG['url'])) : $linkurl;
		return strpos($linkurl, $CFG['path']) === 0 ? $linkurl : $CFG['path'].$linkurl;
	}
}

function imgurl($imgurl = '', $absurl = 1) {
	return $imgurl ? $imgurl : RE_SKIN.'image/nopic.gif';
}

function userurl($username, $qstring = '', $domain = '') {
	global $CFG, $RE, $MODULE;
	$URL = '';
	$subdomain = 0;
	if($CFG['com_domain']) $subdomain = substr($CFG['com_domain'], 0, 1) == '.' ? 1 : 2;
	if($username) {
		if($subdomain || $domain) {
			$URL = $domain ? 'http://'.$domain.'/' : ($subdomain == 1 ? 'http://'.($RE['com_www'] ? 'www.' : '').$username.$CFG['com_domain'].'/' : 'http://'.$CFG['com_domain'].'/'.$username.'/');
			if($qstring) {
				parse_str($qstring, $q);
				if(isset($q['file'])) {
					$URL .= $CFG['com_dir'] ? $q['file'].'/' : 'company/'.$q['file'].'/';
					unset($q['file']);
				}
				if($q) {
					if($RE['rewrite']) {
						foreach($q as $k=>$v) {
							$v = rawurlencode($v);
							$URL .= $k.'-'.$v.'-';
						}
						$URL = substr($URL, 0, -1).'.shtml';
					} else {
						$URL .= 'index.php?';
						$i = 0;
						foreach($q as $k=>$v) {
							$v = rawurlencode($v);
							$URL .= ($i++ == 0 ? '' : '&').$k.'='.$v;
						}
					}
				}
			}
		} else if($RE['rewrite']) {
			$URL = RE_PATH.'com/'.$username.'/';
			if($qstring) {
				parse_str($qstring, $q);
				if(isset($q['file'])) {
					$URL .= $CFG['com_dir'] ? $q['file'].'/' : 'company/'.$q['file'].'/';
					unset($q['file']);
				}
				if($q) {
					foreach($q as $k=>$v) {
						$v = rawurlencode($v);
						$URL .= $k.'-'.$v.'-';
					}
					$URL = substr($URL, 0, -1).'.html';
				}
			}
		} else {
			$URL = RE_PATH.'index.php?homepage='.$username;
			if($qstring) $URL = $URL.'&'.$qstring;
		}
	} else {
		$URL = linkurl($MODULE[4]['linkurl'], 1).'guest.php';
	}
	return $URL;
}

function userinfo($username, $cache = '', $fields = '*') {
	global $db;
	return $db->get_one("SELECT $fields FROM {$db->pre}member m, {$db->pre}company c WHERE m.userid=c.userid AND m.username='$username'", $cache);
}

function memberinfo($username, $cache = '', $fields = '*') {
	global $db;
	return $db->get_one("SELECT $fields FROM {$db->pre}member WHERE username='$username'", $cache);
}

function listurl($CAT, $page = 0) {
	global $RE, $MOD, $L;
	include RE_ROOT.'/api/url.inc.php';
	$catid = $CAT['catid'];
	$file_ext = $RE['file_ext'];
	$index = $RE['index'];
	$catdir = $CAT['catdir'];
	$catname = file_vname($CAT['catname']);
	$prefix = $MOD['htm_list_prefix'];
	$urlid = $MOD['list_html'] ? $MOD['htm_list_urlid'] : $MOD['php_list_urlid'];
	$ext = $MOD['list_html'] ? 'htm' : 'php';
	isset($urls[$ext]['list'][$urlid]) or $urlid = 0;
	$url = $urls[$ext]['list'][$urlid];
	$url = $page ? $url['page'] : $url['index'];
    eval("\$listurl = \"$url\";");
	if(substr($listurl, 0, 1) == '/') $listurl = substr($listurl, 1);
	return $listurl;
}

function itemurl($item, $page = 0) {
	global $RE, $MOD, $L;
	if($MOD['show_html'] && $item['filename']) {
		if($page === 0) return $item['filename'];
		$ext = file_ext($item['filename']);
		return str_replace('.'.$ext, '_'.$page.'.'.$ext, $item['filename']);
	}
	include RE_ROOT.'/api/url.inc.php';
	$file_ext = $RE['file_ext'];
	$index = $RE['index'];
	$itemid = $item['itemid'];
	$title = file_vname($item['title']);
	$addtime = $item['addtime'];
	$catid = $item['catid'];
	$year = date('Y', $addtime);
	$month = date('m', $addtime);
	$day = date('d', $addtime);
	$prefix = $MOD['htm_item_prefix'];
	$urlid = $MOD['show_html'] ? $MOD['htm_item_urlid'] : $MOD['php_item_urlid'];
	$ext = $MOD['show_html'] ? 'htm' : 'php';
	$alloc = dalloc($itemid);
	$url = $urls[$ext]['item'][$urlid];
	$url = $page ? $url['page'] : $url['index'];
	if(strpos($url, 'cat') !== false && $catid) {
		$cate = get_cat($catid);
		$catdir = $cate['catdir'];
		$catname = $cate['catname'];
	}
    eval("\$itemurl = \"$url\";");
	if(substr($itemurl, 0, 1) == '/') $itemurl = substr($itemurl, 1);
	return $itemurl;
}

function rewrite($url, $encode = 0) {
	global $RE, $CFG;
	if(!$RE['rewrite']) return $url;
	if(strpos($url, '.php?') === false || strpos($url, '=') === false) return $url;
	$url = str_replace(array('+', '-'), array('%20', '%20'), $url);
	$url = str_replace(array('.php?', '&', '='), array('-htm-', '-', '-'), $url).'.html';
	return $url;
}

function timetodate($time = 0, $type = 6) {
	if(!$time) {global $RE_TIME; $time = $RE_TIME;}
	$types = array('Y-m-d', 'Y', 'm-d', 'Y-m-d', 'm-d H:i', 'Y-m-d H:i', 'Y-m-d H:i:s');
	if(isset($types[$type])) $type = $types[$type];
	return date($type, $time);
}

function log_write($message, $type = 'php') {
	global $RE_IP, $RE_TIME, $_username;
	if(!RE_DEBUG) return;
	$RE_IP or $RE_IP = get_env('ip');
	$RE_TIME or $RE_TIME = time();
	$user = $_username ? $_username : 'guest';
	$log = "<$type>\n";
	$log .= "\t<time>".date('Y-m-d H:i:s', $RE_TIME)."</time>\n";
	$log .= "\t<ip>".$RE_IP."</ip>\n";
	$log .= "\t<user>".$user."</user>\n";
	$log .= "\t<file>".$_SERVER['SCRIPT_NAME']."</file>\n";
	$log .= "\t<querystring>".str_replace('&', '&amp;', $_SERVER['QUERY_STRING'])."</querystring>\n";
	$log .= "\t<message>".$message."\t</message>\n";
	$log .= "</$type>";
	file_put(RE_ROOT.'/file/log/'.date('Ym', $RE_TIME).'/'.$type.'-'.date('Y.m.d H.i.s', $RE_TIME).'-'.strtolower(random(10)).'.xml', $log);
}

function load($file) {
	$ext = file_ext($file);
	if($ext == 'css') {
		echo '<link rel="stylesheet" type="text/css" href="'.RE_SKIN.$file.'" />';
	} else if($ext == 'js') {
		echo '<script type="text/javascript" src="'.RE_PATH.'file/script/'.$file.'"></script>';
	} else if($ext == 'htm') {
		$file = str_replace('ad_m', 'ad_t6_m', $file);
		if(is_file(RE_CACHE.'/htm/'.$file)) {
			$content = file_get(RE_CACHE.'/htm/'.$file);
			if(substr($content, 0, 4) == '<!--') $content = substr($content, 17);
			echo $content;
		} else {
			echo '';
		}
	} else if($ext == 'lang') {
		$file = str_replace('.lang', '.inc.php', $file);
		return RE_ROOT.'/lang/'.RE_LANG.'/'.$file;
	}
}

function ad($id, $cid = 0, $kw = '', $tid = 0) {
	global $cityid;
	if($tid) {
		if($kw) {
			$file = 'ad_t'.$tid.'_m'.$id.'_k'.urlencode($kw);
		} else if($cid) {
			$file = 'ad_t'.$tid.'_m'.$id.'_c'.$cid;
		} else {
			$file = 'ad_t'.$tid.'_m'.$id;
		}
		$a3 = 'ad_'.$id.'_d'.$tid.'.htm';
	} else {
		$file = 'ad_'.$id;
		$a3 = 'ad_'.$id.'_d0.htm';
	}
	$a1 = $file.'_'.$cityid.'.htm';
	if(is_file(RE_CACHE.'/htm/'.$a1)) return load($a1);
	$a2 = $file.'_0.htm';
	if(is_file(RE_CACHE.'/htm/'.$a2)) return load($a2);
	if(is_file(RE_CACHE.'/htm/'.$a3)) return load($a3);
}

function lang($str, $arr = array()) {
	if(strpos($str, '->') !== false) {
		$t = explode('->', $str);
		include load($t[0].'.lang');
		$str = $L[$t[1]];
	}
	if($arr) {
		foreach($arr as $k=>$v) {
			$str = str_replace('{V'.$k.'}', $v, $str);
		}
	}
	return $str;
}

function check_name($username) {
	if(strpos($username, '__') !== false || strpos($username, '--') !== false) return false; 
	return preg_match("/^[a-z0-9]{1}[a-z0-9_\-]{0,}[a-z0-9]{1}$/", $username);
}

function check_post() {
	if(strtoupper($_SERVER['REQUEST_METHOD']) != 'POST') return false;
	return check_referer();
}

function check_referer() {
	global $RE_REF, $CFG, $RE;
	if($RE['check_referer']) {
		if(!$RE_REF) return false;
		$R = parse_url($RE_REF);
		if($CFG['cookie_domain'] && strpos($R['host'], $CFG['cookie_domain']) !== false) return true;
		if($CFG['com_domain'] && strpos($R['host'], $CFG['com_domain']) !== false) return true;
		if($RE['safe_domain']) {
			$tmp = explode('|', $RE['safe_domain']);
			foreach($tmp as $v) {
				if(strpos($R['host'], $v) !== false) return true;
			}
		}		
		$U = parse_url(RE_PATH);
		if(strpos($R['host'], str_replace('www.', '.', $U['host'])) !== false) return true;
		return false;
	} else {
		return true;
	}
}

function is_ip($ip) {
	return preg_match("/^([0-9]{1,3}\.){3}[0-9]{1,3}$/", $ip);
}

function is_md5($password) {
	return preg_match("/^[a-z0-9]{32}$/", $password);
}

function debug() {
	global $db, $debug_starttime;
	$mtime = explode(' ', microtime());
	$s = number_format(($mtime[1] + $mtime[0] - $debug_starttime), 3);
	echo 'Processed in '.$s.' second(s), '.$db->querynum.' queries';
    if(function_exists('memory_get_usage')) echo ', Memory '.round(memory_get_usage()/1024/1024, 2).' M';
}

//替换
function _myreplace($str,$ary){
	if(is_array($ary)){
		foreach($ary as $key=>$val){
			$str = preg_replace($key,$val,$str);
		}
	}else{
		$str = preg_replace($ary,"",$str);
	}
	return $str;
}

// 文本转码
function ziconv($str,$fc='utf-8',$tc='gb2312'){
	return iconv($tc,$fc,$str);
}

//数组转码
function array_iconv($in_charset,$out_charset,$arr){
	return @eval('return '.iconv($in_charset,$out_charset,var_export($arr,true).';'));
}


?>
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
// 编辑器
function start_editor($textareaid = 'content', $css = '') {
	global $RE,$moduleid;
	$editor = "";
	if($RE['editor'] == 'ueditor'){
		$editor .= "<link rel='stylesheet' type='text/css' href='".RE_PATH."file/JavaScript/ueditor/themes/default/ueditor.css'/>\n";
		$editor .= "<script type='text/javascript' src='".RE_PATH."file/JavaScript/ueditor/editor_config.js'></script>\n";
		$editor .= "<script type='text/javascript' src='".RE_PATH."file/JavaScript/ueditor/editor_all_min.js'></script>\n";
		$editor .= "<script type='text/javascript'>\n";
		$editor .= "var editor = new UE.ui.Editor({\n";
		$editor .= "imageUrl:'".RE_PATH."upload.php?moduleid=".$moduleid."&su=ueditor&upftype=image',\n";
		$editor .= "scrawlUrl:'".RE_PATH."upload.php?moduleid=".$moduleid."&su=ueditor&upftype=scrawl',\n";
		$editor .= "fileUrl:'".RE_PATH."upload.php?moduleid=".$moduleid."&su=ueditor&upftype=file',\n";
		$editor .= "catcherUrl:'".RE_PATH."upload.php?moduleid=".$moduleid."&su=ueditor&upftype=remoteimage',\n";
		$editor .= "imageManagerUrl:'".RE_PATH."upload.php?moduleid=".$moduleid."&su=ueditor&upftype=imagemanager',\n";
		$editor .= "snapscreenServerUrl:'".RE_PATH."upload.php?moduleid=".$moduleid."&su=ueditor&upftype=image',\n";
		$editor .= "wordImageUrl:'".RE_PATH."upload.php?moduleid=".$moduleid."&su=ueditor&upftype=image',\n";
		$editor .= "getMovieUrl:'".RE_PATH."upload.php?moduleid=".$moduleid."&su=ueditor&upftype=movie',\n";
		$editor .= "iframeCssUrl:'".$css."'\n";
		$editor .= "});";
		$editor .= "editor.render('".$textareaid."');";
		$editor .= "function ___initData(){editor.sync();}\n";
		$editor .= "</script>";
	}else if($RE['editor'] == 'kindeditor'){
		$editor .= "<script charset='utf-8' src='".RE_PATH."file/JavaScript/kindeditor/kindeditor-all-min.js'></script>\n";
		$editor .= "<script charset='utf-8' src='".RE_PATH."file/JavaScript/kindeditor/lang/zh_CN.js'></script>\n";
		$editor .= "<script type='text/javascript'>\n";
		$editor .= "var editor;\n";
		$editor .= "KindEditor.ready(function(K) {\n";
		$editor .= "editor = K.create('#".$textareaid."',{\n";
		$editor .= "uploadJson:'".RE_PATH."upload.php?moduleid=".$moduleid."&su=kindeditor',\n";
		$editor .= "fileManagerJson:'".RE_PATH."upload.php?moduleid=".$moduleid."&su=kindeditor',\n";
		$editor .= "cssPath:'".$css."'\n";
		//$editor .= "filterMode:false\n";
		$editor .= "});\n";
		$editor .= "});\n";
		$editor .= "function ___initData(){editor.sync();}\n";
		$editor .= "</script>";
	}
	echo $editor;
}

function _htmlspecialchars($string) {
    return is_array($string) ? array_map('_htmlspecialchars', $string) : str_replace('&amp;', '&', htmlspecialchars($string, ENT_QUOTES));
}

function _addslashes($string) {
	if(!is_array($string)) return addslashes($string);
	foreach($string as $key => $val) $string[$key] = _addslashes($val);
	return $string;
}

function _stripslashes($string) {
	if(!is_array($string)) return stripslashes($string);
	foreach($string as $key => $val) $string[$key] = _stripslashes($val);
	return $string;
}

function _header($url) {
	//global $RE;	
	//if(!defined('RE_ADMIN') && $RE['defend_reload']) sleep($RE['defend_reload']);
	exit(header('location:'.$url));
}

function _round($var, $precision = 2, $sprinft = false) {
	$var = round(floatval($var), $precision);
	if($sprinft) $var = sprintf('%.'.$precision.'f', $var);
	return $var;
}

function _msg($msg = '', $dforward = '') {
	if(!$msg && !$dforward) {
		$msg = get_cookie('msg');
		if($msg) {
			echo '<script type="text/javascript">showmsg(\''.$msg.'\');</script>';
			set_cookie('msg', '');
		}
	} else {
		set_cookie('msg', $msg);
		$dforward = preg_replace("/(.*)([&?]rand=[0-9]*)(.*)/i", "\\1\\3", $dforward);
		$dforward = str_replace('.php&', '.php?', $dforward);
		$dforward = strpos($dforward, '?') === false ? $dforward.'?rand='.mt_rand(10, 99) : str_replace('?', '?rand='.mt_rand(10, 99).'&', $dforward);
		_header($dforward);
	}
}

function timetodate($time = 0, $type = 6) {
	if(!$time) {global $RE_TIME; $time = $RE_TIME;}
	$types = array('Y-m-d', 'Y', 'm-d', 'Y-m-d', 'm-d H:i', 'Y-m-d H:i', 'Y-m-d H:i:s');
	if(isset($types[$type])) $type = $types[$type];
	return date($type, $time);
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
function _substr($string, $length, $suffix = '', $start = 0) {
	return @_sub_str($string,$length,$suffix,$start);
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

function message($message = errmsg, $forward = 'goback', $time = 1) {
	global $CFG, $RE;
	if(!$message && $forward && $forward != 'goback') _header($forward);
	exit(include template('message', 'message'));
}

// 转换编码
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
		return $str;
	}
}

//获取表名[数据]
function content_table($moduleid, $itemid, $split, $table_data = '') {
	if($split) {
		return split_table($moduleid, $itemid);
	} else {
		$table_data or $table_data = get_table($moduleid, 1);
		return $table_data;
	}
}

function strip_nr($string, $js = false) {
	$string =  str_replace(array(chr(13), chr(10), "\n", "\r", "\t", '  '),array('', '', '', '', '', ''), $string);
	if($js) $string = str_replace("'", "\'", $string);
	return $string;
}

function strip_sql($string) {
	$search = array("/union[\s|\t]/i","/select[\s|\t]/i","/update[\s|\t]/i","/outfile[\s|\t]/i","/ascii/i","/[\s|\t]or[\s|\t]/i","/\/\*/i");
	$replace = array('union&nbsp;','select&nbsp;','update&nbsp;','outfile&nbsp;','ascii&nbsp;','&nbsp;or&nbsp;', '');
	return is_array($string) ? array_map('strip_sql', $string) : preg_replace($search, $replace, $string);
}

// 随机
function random($length, $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz') {
	$hash = '';
	$max = strlen($chars) - 1;
	for($i = 0; $i < $length; $i++)	{
		$hash .= $chars[mt_rand(0, $max)];
	}
	return $hash;
}

function listurl($CAT, $page = 0) {
	//global $RE, $MOD, $L;
	//include RE_ROOT.'/api/url.inc.php';
	//$catid = $CAT['catid'];
	//$file_ext = 'php';//$RE['file_ext'];	
	//$index = 'index';//$RE['index'];
	//$catdir = $CAT['catdir'];
	//$catname = file_vname($CAT['catname']);
	//$prefix = $MOD['htm_list_prefix'];
	//$urlid = $MOD['list_html'] ? $MOD['htm_list_urlid'] : $MOD['php_list_urlid'];
	//$ext = $MOD['list_html'] ? 'htm' : 'php';
	//isset($urls[$ext]['list'][$urlid]) or $urlid = 0;
	//
    $listurl = 'list.php?catid='.$CAT['catid'];
	//if(substr($listurl, 0, 1) == '/') $listurl = substr($listurl, 1);
	return $listurl;
}

function itemurl($item, $page = 0) {
	//global $RE, $MOD;
	/*
	if($MOD['show_html'] && $item['filepath']) {
		if($page === 0) return $item['filepath'];
		$ext = file_ext($item['filepath']);
		return str_replace('.'.$ext, '_'.$page.'.'.$ext, $item['filepath']);
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
	*/
	$itemurl = 'show.php?itemid='.$item['itemid'];
	return $itemurl;
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

// 缓存读取
function cache_read($file, $dir = '', $mode = '') {
	$file = $dir ? RE_CACHE.'/'.$dir.'/'.$file : RE_CACHE.'/'.$file;
	if(!is_file($file)) return array();
	return $mode ? file_get($file) : include $file;
}

// 写入缓存 
function cache_write($file, $string, $dir = '') {
	if(is_array($string)) $string = "<?php defined('IN_RUIEC') or exit('Access Denied'); return ".strip_nr(var_export($string, true))."; ?>";
	$file = $dir ? RE_CACHE.'/'.$dir.'/'.$file : RE_CACHE.'/'.$file;
	$strlen = file_put($file, $string);
	return $strlen;
}

// 删除缓存
function cache_delete($file, $dir = '') {
	$file = $dir ? RE_CACHE.'/'.$dir.'/'.$file : RE_CACHE.'/'.$file;
	return file_del($file);
}

// 清空缓存
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

// 写入日志
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

// IP地址
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

// 获取数据.
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
			$uri = _htmlspecialchars($uri);
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

// 分类
function get_cat($catid) {
	global $db;
	$catid = intval($catid);
	return $catid ? $db->get_one("SELECT * FROM {$db->pre}category WHERE catid=$catid") : array();
}

// 导航 map
function cat_pos($CAT, $str = ' &raquo; ', $target = '', $isl = false) {
	global $MODULE, $db;
	if(!$CAT) return '';
	$CAT = $db->get_one("SELECT * FROM {$db->pre}category WHERE catid=".$CAT['catid']);
	//$arrparentids = $CAT['arrparentid'].','.$CAT['catid'];
	//$arrparentid = explode(',', $arrparentids);
	if($CAT['parentid'] == '0') return $CAT['catname'];
	$target = $target ? ' target="_blank"' : '';	
	$arrparentids = get_catparentids($CAT['catid'],$CAT['moduleid']);
	$showcatInfo = ($isl) ? '<a href="'.$MODULE[$CAT['moduleid']]['linkurl'].$CAT['linkurl'].'"'.$target.'>' : $CAT['catname'];
	if($arrparentids == ''){
		//return '<a href="'.$MODULE[$CAT['moduleid']]['linkurl'].$CAT['linkurl'].'"'.$target.'>'.$CAT['catname'].'</a> &raquo; '.$showcatInfo;
		return $showcatInfo;
	}else{
		$arrparentids = substr($arrparentids,1);
		$arrparentid = explode(',', $arrparentids);
		$pos = '';
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
		return $pos.' &raquo; '.$showcatInfo;
	}
}

function cat_url($catid) {
	global $MODULE, $db;
	$r = $db->get_one("SELECT moduleid,linkurl FROM {$db->pre}category WHERE catid=$catid");
	return $r ? $MODULE[$r['moduleid']]['linkurl'].$r['linkurl'] : '';
}

// 清除链接
function clear_link($content) {
	$content = preg_replace("/<a[^>]*>/i", "", $content);
	return preg_replace("/<\/a>/i", "", $content); 
}

// 下载远程图片
function save_remote($content, $ext = 'jpg|jpeg|gif|png|bmp', $self = 0) {
	global $RE_TIME, $MODULE, $moduleid, $_userid;
	if(!$_userid || !$content) return $content;
	if(!preg_match_all("/src=([\"|']?)([^ \"'>]+\.($ext))\\1/i", $content, $matches)) return $content;
	$urls = $oldpath = $newpath = array();
	foreach($matches[2] as $k=>$url) {
		if(in_array($url, $urls)) continue;
		$urls[$url] = $url;		
		if(strpos($url, '://') === false) continue;
		if(!$self) {
			if(RE_DOMAIN) {
				if(strpos($url, '.'.RE_DOMAIN.'/') !== false) continue;
			} else {
				if(strpos($url, RE_PATH) !== false) continue;
			}
		}
		$filedir = 'file/upload/'.timetodate($RE_TIME, 'Y/m/d').'/';
		$filepath = RE_PATH.$filedir;
		$fileroot = RE_ROOT.'/'.$filedir;
		$file_ext = file_ext($url);
		$filename = timetodate($RE_TIME, 'H-i-s').'-'.rand(10, 99).'-'.$_userid.'.'.$file_ext;
		$newfile = $fileroot.$filename;
		if(file_copy($url, $newfile)) {
			if(is_image($newfile)) {
				if(!@getimagesize($newfile)) {
					file_del($newfile);
					continue;
				}
			}
			$oldpath[] = $url;
			$newurl = linkurl($filepath.$filename, 1);
			$newpath[] = $newurl;
		}
	}
	unset($matches);
	return str_replace($oldpath, $newpath, $content);
}

function is_image($file) {
	return preg_match("/^(jpg|jpeg|gif|png|bmp)$/i", file_ext($file));
}

// 保存标题图片
function save_thumb($content, $no, $width = 120, $height = 90) {
	global $RE_TIME, $_userid;
	if(!$_userid || !$content) return '';
	$ext = 'jpg|jpeg|gif|png|bmp';
	if(!preg_match_all("/src=([\"|']?)([^ \"'>]+\.($ext))\\1/i", $content, $matches)) return '';
	$urls = $oldpath = $newpath = array();
	foreach($matches[2] as $k=>$url) {
		if($k == $no - 1) {
			$filedir = 'file/upload/'.timetodate($RE_TIME, 'Y/m/d').'/';
			$filepath = RE_PATH.$filedir;
			$fileroot = RE_ROOT.'/'.$filedir;
			$file_ext = file_ext($url);
			$filename = timetodate($RE_TIME, 'H-i-s').'-'.rand(10, 99).'-'.$_userid.'.'.$file_ext;
			$newfile = $fileroot.$filename;
			if(file_copy($url, $newfile)) {
				if(is_image($newfile)) {					
					if(!@getimagesize($newfile)) {
						file_del($newfile);
						return '';
					}
					$image = new image($newfile);
					$image->thumb($width, $height);
				}
				$newurl = linkurl($filepath.$filename, 1);
				return $newurl;
			}
		}
	}
	unset($matches);
	return '';
}

// safe check
function _safe($string) {
	if(is_array($string)) {
		return array_map('_safe', $string);
	} else {
		if(strlen($string) < 20) return $string;
		$match = array("/&#([a-z0-9]+)([;]*)/i", "/(j[\s\r\n\t]*a[\s\r\n\t]*v[\s\r\n\t]*a[\s\r\n\t]*s[\s\r\n\t]*c[\s\r\n\t]*r[\s\r\n\t]*i[\s\r\n\t]*p[\s\r\n\t]*t|jscript|js|vbscript|vbs|about|expression|script|frame|link|import)/i", "/on(mouse|exit|error|click|dblclick|key|load|unload|change|move|submit|reset|cut|copy|select|start|stop)/i");
		$replace = array("", "<d>\\1</d>", "on\n\\1");
		return preg_replace($match, $replace, $string);
	}
}

// 获取分类
function get_maincat($catid, $moduleid) {
	global $db;
	$condition = $catid ? "parentid=$catid" : "moduleid=$moduleid AND parentid=0";
	$cat = array();
	$result = $db->query("SELECT * FROM {$db->pre}category WHERE $condition ORDER BY listorder,catid ASC", 'CACHE');
	while($r = $db->fetch_array($result)) {
		$cat[] = $r;
	}
	return $cat;
}

// 级别选择
function level_select($name, $title = '', $level = 0, $extend = '') {
	global $MOD;
	$names = isset($MOD['level']) && $MOD['level'] ? $MOD['level'] : '';
	$names = $names ? explode('|', trim($names)) : array();
	$select = '<select name="'.$name.'" '.$extend.'>';
	if($title) $select .= '<option value="0">'.$title.'</option>';
	for($i = 1; $i < 10; $i++) {
		$n = isset($names[$i-1]) ? ' '.$names[$i-1] : '';
		$select .= '<option value="'.$i.'"'.($i == $level ? ' selected' : '').'>'.$i.' 级'.$n.'</option>';
	}
	$select .= '</select>';
	return $select;
}

//分类选择框
function category_select($name = 'catid', $title = '', $catid = 0, $moduleid = 1, $extend = '') {
	$option = cache_read('catetree-'.$moduleid.'.php', '', true);
	if($option) {
		if($catid) $option = str_replace('value="'.$catid.'"', 'value="'.$catid.'" selected', $option);
		$select = '<select name="'.$name.'" '.$extend.' id="catid_1">';
		if($title) $select .= '<option value="0">'.$title.'</option>';
		$select .= $option ? $option : '</select>';
		return $select;
	} else {
		return ajax_category_select($name, $title, $catid, $moduleid, $extend);
	}
}

//获取所有子类id
function get_catchilds($catid, $moduleid = 1, $retype = '0'){
	global $db;
	$parents = array();
	$_parents = '';
	$result = $db->query("SELECT catid FROM {$db->pre}category WHERE moduleid=$moduleid AND parentid=$catid");
	while($c = $db->fetch_array($result)) {
		$parents[$c['catid']] = get_catchilds($c['catid'], $moduleid, $retype);
		$_parents .= ','.$c['catid'];//.get_catchilds($c['catid'], $moduleid,$retype);
		//array_push($parents, get_catchilds($c['catid'], $moduleid));
		//$parents = array_merge($parents, get_catchilds($c['catid'], $moduleid));
	}
	return ($retype == '0') ? $parents : $_parents;
}

//获取所有父类id
function get_catparentids($catid, $moduleid = 1){
	global $db;
	$parents = '';
	$result = $db->get_one("SELECT parentid FROM {$db->pre}category WHERE moduleid=$moduleid AND catid=$catid");
	if($result['parentid'] != '0'){
		$parents .= ','.$result['parentid'];
		$parents .= get_catparentids($result['parentid'], $moduleid);
	}
	return $parents;
}

//获取下拉选项
function _get_option($parents,$catid=0,$exstr=''){
	$select = '';
	foreach($parents as $k=>$v) {
		$_catinfo = get_cat($k);
		if($_catinfo){
			$selected = $_catinfo['catid'] == $catid ? ' selected' : '';
			$select .= '<option value="'.$_catinfo['catid'].'"'.$selected.'>'.$exstr.$_catinfo['catname'].'</option>';
			if(is_array($v) && $v){
				$select .= _get_option($v,$catid,$exstr.' |--');
			}
		}
	}
	return $select;
}

function get_category_select($name = '', $title = '', $catid = 0, $moduleid = 1, $extend = '', $deep = 0, $cat_id = 1) {
	global $db, $_child;
	$_child or $_child = array();
	//$parents = get_catchilds($catid,$moduleid);
	$parents = get_catchilds('0',$moduleid);
	$select = '<select name="'.$name.'" '.$extend.'>';
	if($title) $select .= '<option value="0">'.$title.'</option>';
	$select .= _get_option($parents,$catid);
	$select .= '</select> ';
	return $select;
}

function ajax_category_select($name = 'catid', $title = '', $catid = 0, $moduleid = 1, $extend = '', $deep = 0) {
	global $cat_id;
	if($cat_id) {
		$cat_id++;
	} else {
		$cat_id = 1;
	}
	$catid = intval($catid);
	$deep = intval($deep);
	$select = get_category_select($name, $title, $catid, $moduleid, $extend, $deep, $cat_id);
	//if($cat_id == 1) $select .= '<script type="text/javascript" src="'.RE_PATH.'file/script/category.js"></script>';
	return $select;
}

// 选择模板
function tpl_select($file = 'index', $module = '', $name = 'template', $title = '', $template = '', $extend = '') {
	//include load('include.lang');
	global $CFG, $ruiec_tpl_id;
	if(!$ruiec_tpl_id) {
		$ruiec_tpl_id = 1;
	} else {
		$ruiec_tpl_id++;
	}
    $tpldir = $module ? RE_ROOT."/template/".$CFG['template']."/".$module : RE_ROOT."/template/".$CFG['template'];
	@include $tpldir."/these.name.php";
	$select = '<span id="ruiec_template_'.$ruiec_tpl_id.'"><select name="'.$name.'" '.$extend.'><option value="">'.$title.'</option>';
	$files = glob($tpldir."/*.htm");
	foreach($files as $tplfile)	{
		$tplfile = basename($tplfile);
		$tpl = str_replace('.htm', '', $tplfile);
		if(preg_match("/^".$file."-(.*)/i", $tpl) || !$file) {//$file == $tpl || 
			$selected = ($template && $tpl == $template) ? 'selected' : '';
            $templatename = (isset($names[$tpl]) && $names[$tpl]) ? $names[$tpl] : $tpl;
			$select .= '<option value="'.$tpl.'" '.$selected.'>'.$templatename.'</option>';
		}
	}
	$select .= '</select></span>';
	if(defined('RE_ADMIN')) $select .= '&nbsp;&nbsp;<a href="javascript:tpl_edit(\''.$file.'\', \''.$module.'\', '.$ruiec_tpl_id.');" class="t">修改</a> &nbsp;<a href="javascript:tpl_add(\''.$file.'\', \''.$module.'\');" class="t">新建</a>';
	return $select;
}

// 用户
function get_user($value, $key = 'username', $from = 'userid') {
	global $db;
	$r = $db->get_one("SELECT `$from` FROM {$db->pre}member WHERE `$key`='$value'");
	return $r[$from];
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

function memberinfo($username, $cache = '', $fields = '*') {
	global $db;
	return $db->get_one("SELECT $fields FROM {$db->pre}member WHERE username='$username'", $cache);
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
	}
}

// 广告
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

//	is IP
function is_ip($ip) {
	return preg_match("/^([0-9]{1,3}\.){3}[0-9]{1,3}$/", $ip);
}

function is_md5($password) {
	return preg_match("/^[a-z0-9]{32}$/", $password);
}

//Debug
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

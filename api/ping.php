<?php
defined('IN_RUIEC') or exit('Access Denied');

/*
	$ping_server_url	Ping 目标地址
	$blogname			博客名称
	$siteurl			博客地址
	$newblogurl			文章地址
	$rssurl				博客RSS地址
	$categoryname		类型分类
	
	@return Ping 结果 True or False
*/
function ping($ping_server_url, $blogname, $siteurl, $newblogurl, $rssurl, $categoryname=''){
	//$pingdata_array = array('http://ping.baidu.com/ping/RPC2', 'http://blogsearch.google.com/ping/RPC2');
	
	$extendedPing_string = "<?xml version='1.0'?>\r\n";
	$extendedPing_string .= "<methodCall>\r\n";
	$extendedPing_string .= "<methodName>weblogUpdates.extendedPing</methodName>\r\n";
	$extendedPing_string .= "<params>\r\n";
	$extendedPing_string .= "<param>\r\n";
	$extendedPing_string .= "<value>{$blogname}</value>\r\n";
	$extendedPing_string .= "</param>\r\n";
	$extendedPing_string .= "<param>\r\n";
	$extendedPing_string .= "<value>{$siteurl}</value>\r\n";
	$extendedPing_string .= "</param>\r\n";
	$extendedPing_string .= "<param>\r\n";
	$extendedPing_string .= "<value>{$newblogurl}</value>\r\n";
	$extendedPing_string .= "</param>\r\n";
	$extendedPing_string .= "<param>\r\n";
	$extendedPing_string .= "<value>{$rssurl}</value>\r\n";
	$extendedPing_string .= "</param>\r\n";
	$extendedPing_string .= "<param>\r\n";
	$extendedPing_string .= "<value>{$categoryname}</value>\r\n";
	$extendedPing_string .= "</param>\r\n";
	$extendedPing_string .= "</params>\r\n";
	$extendedPing_string .= "</methodCall>";
	
	$ping_string = "<?xml version='1.0'?>\r\n";
	$ping_string .= "<methodCall>\r\n";
	$ping_string .= "<methodName>weblogUpdates.ping</methodName>\r\n";
	$ping_string .= "<params>\r\n";
	$ping_string .= "<param>\r\n";
	$ping_string .= "<value>{$blogname}</value>\r\n";
	$ping_string .= "</param>\r\n";
	$ping_string .= "<param>\r\n";
	$ping_string .= "<value>{$rssurl}</value>\r\n";
	$ping_string .= "</param>\r\n";
	$ping_string .= "</params>\r\n";
	$ping_string .= "</methodCall>";
	
	$state = false;
	/* foreach($pingdata_array as $k=>$url){
		$ping_server_url = $url;
		$state = XML_RPC_Request($ping_server_url, $extendedPing_string);
		if($state == false){
			$state=XML_RPC_Request($ping_server_url, $ping_string);
		}
	} */
	$state = XML_RPC_Request($ping_server_url, $extendedPing_string);
	if($state == false){
		$state = XML_RPC_Request($ping_server_url, $ping_string);
	}
	return $state;
}

/*
	Send XML RPC POST
	发送ping请求
	$ping_server_url	请求地址
	$RPC_XML_string		请求内容
*/
function XML_RPC_Request($ping_server_url, $RPC_XML_string){
	$ping_url_array = parse_url($ping_server_url);
	if(!isset($ping_url_array['port']) || $ping_url_array['port'] == '') $ping_url_array['port'] = 80;
	$send_string = "POST ".$ping_url_array['path'].((isset($ping_url_array['query'])) ? '?'.$ping_url_array['query'] : '')." HTTP/1.0\r\n";
	$send_string .= "User-Agent: Bo-Blog Ping Servce Client\r\n";
	$send_string .= "Host: {$ping_url_array['host']}\r\n"; 
	$send_string .= "Content-Type: text/xml; charset=utf-8\r\n"; 
	$send_string .= "Content-Length: ".strlen($RPC_XML_string)."\r\n\r\n";
	$send_string .= $RPC_XML_string;
	
	if(function_exists('fsockopen')){
		$fs = fsockopen($ping_url_array['host'], $ping_url_array['port'], $errno, $errstr, 5);
	}else if(function_exists('pfsockopen')){
		$fs = pfsockopen($ping_url_array['host'], $ping_url_array['port'], $errno, $errstr, 5);
	}else if(function_exists('stream_socket_client')){
		$fs = stream_socket_client($ping_url_array['host'].':'.$ping_url_array['port'], $errno, $errstr, 5);
	}else{
		$fs = _fsockopen($ping_url_array['host'], $ping_url_array['port'], $errno, $errstr, 5);
	}
	if(!$fs) return false;
	fwrite($fs, $send_string);
	$response = '';
	while(!feof($fs)){
		$response .= fgets($fs, 128);
	}
	@fclose($fs);
	if($response != '' && (strpos($response, '<boolean>0</boolean>') || strpos($response, '<int>0</int>')) ){
		return true;
	}else{
		return false;
	}
}

if(!function_exists('fsockopen')){
	function _fsockopen($host, $port, &$errno, &$errstr, $timeout){
		$ip = @gethostbyname($host);
		$s = @socket_create(AF_INET, SOCK_STREAM, 0);
		if(socket_set_nonblock($s)){
			$r = @socket_connect($s, $ip, $port);
			if ($r || socket_last_error() == EINPROGRESS) {
				$errno = EINPROGRESS;
				return $s;
			}
		}
		$errno = socket_last_error($s);
		$errstr = socket_strerror($errno);
		socket_close($s);
		return false;
	}
}
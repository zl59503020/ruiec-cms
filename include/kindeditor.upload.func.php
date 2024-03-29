﻿<?php
defined('IN_RUIEC') or exit('Access Denied');

//require RE_ROOT.'/include/uploader.class.php';
$dir = isset($dir) ? $dir : 'image';

switch($dir) {
	case 'image':	//Images
		$config = array('savePath' => $uploaddir , 'maxSize' => 1000 , 'allowFiles' => array('.gif', '.png', '.jpg', '.jpeg', '.bmp'));
		$up = new Uploader('imgFile', $config);
		$info = $up->getFileInfo();
		if($info['state'] == 'SUCCESS'){
			$reary = array('error' => 0, 'url' => RE_PATH.$info['url']);
		}else{
			$reary = array('error' => 1, 'message' => $info['state']);
		}
		echo json_encode($reary);
	break;
	case 'flash':	//Flash
		$config = array('savePath' => $uploaddir , 'maxSize' => 10000 , 'allowFiles' => array('.swf', '.flv'));
		$up = new Uploader('imgFile', $config);
		$info = $up->getFileInfo();
		if($info['state'] == 'SUCCESS'){
			$reary = array('error' => 0, 'url' => RE_PATH.$info['url']);
		}else{
			$reary = array('error' => 1, 'message' => $info['state']);
		}
		echo json_encode($reary);
	break;
	case 'media':
		$config = array('savePath' => $uploaddir , 'maxSize' => 10000 , 'allowFiles' => array('.swf', '.flv', '.mp3', '.wav', '.wma', '.wmv', '.mid', '.avi', '.mpg', '.asf', '.rm', '.rmvb'));
		$up = new Uploader('imgFile', $config);
		$info = $up->getFileInfo();
		if($info['state'] == 'SUCCESS'){
			$reary = array('error' => 0, 'url' => RE_PATH.$info['url']);
		}else{
			$reary = array('error' => 1, 'message' => $info['state']);
		}
		echo json_encode($reary);
	break;
	case 'file':
		case 'file':	//File
		$config = array('savePath' => $uploaddir , 'maxSize' => 10000 , 'allowFiles' => array('.rar', '.doc', '.docx', '.zip', '.pdf', '.txt', '.swf', '.wmv'));
		$up = new Uploader('imgFile', $config);
		$info = $up->getFileInfo();
		if($info['state'] == 'SUCCESS'){
			$reary = array('error' => 0, 'url' => RE_PATH.$info['url']);
		}else{
			$reary = array('error' => 1, 'message' => $info['state']);
		}
		echo json_encode($reary);
	break;
	default :
		die('Access Denied');
	break;	
}
?>
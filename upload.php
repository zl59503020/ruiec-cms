<?php
@set_time_limit(0);
require 'common.inc.php';

$uploaddir = 'file/upload/'.date('Y/m/d').'/';
is_dir(RE_ROOT.'/'.$uploaddir) or dir_create(RE_ROOT.'/'.$uploaddir);

require RE_ROOT.'/include/uploader.class.php';

isset($su) or $su = '';

switch($su)  {
	case 'ueditor':
		require RE_ROOT.'/include/ueditor.upload.func.php';
	break;
	case 'kindeditor':
		require RE_ROOT.'/include/kindeditor.upload.func.php';
	break;
	case 'upImage':
		$config = array('savePath' => $uploaddir , 'maxSize' => 1000 , 'allowFiles' => array('.gif', '.png', '.jpg', '.jpeg', '.bmp'));
		$up = new Uploader('upfile', $config);
		$info = $up->getFileInfo();
		if($info['state'] == 'SUCCESS'){
			if(isset($upimgsize) && is_array($upimgsize) && ($upimgsize['w'] != '' || $upimgsize['h'] != '')){
				$fspath = RE_ROOT.'/'.$info['url'];
				$w = (isset($upimgsize['w']) && $upimgsize['w'] != '') ? $upimgsize['w'] : 0;
				$h = (isset($upimgsize['h']) && $upimgsize['h'] != '') ? $upimgsize['h'] : 0;
				if($up->reSizeImage($fspath, $w, $h, '', isset($upimgsize['s']))){
					die(RE_PATH.$info['url'].'.min'.$info['type']);
				}
			}
			die(RE_PATH.$info['url']);
		}else{
			die('error: '.$info['state']);
		}
	break;
	default:
		exit('Access Denied');
	break;
}



?>
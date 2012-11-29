<?php
@set_time_limit(0);
require 'common.inc.php';

$uploaddir = 'file/upload/'.date('Y/m/d').'/';
is_dir(RE_ROOT.'/'.$uploaddir) or dir_create(RE_ROOT.'/'.$uploaddir);

if(isset($su) && $su == 'ueditor'){
	require RE_ROOT.'/include/uploader.class.php';
	$upftype = isset($upftype) ? $upftype : 'image';
	switch($upftype) {
		case 'image':	//ͼƬ
			$config = array('savePath' => $uploaddir , 'maxSize' => 1000 , 'allowFiles' => array('.gif', '.png', '.jpg', '.jpeg', '.bmp'));
			$title = htmlspecialchars($_POST['pictitle'],ENT_QUOTES);
			$up = new Uploader('upfile', $config);
			$info = $up->getFileInfo();
			echo "{'url':'".RE_PATH.$info['url']."','title':'".$title."','original':'".$info['originalName']."','state':'".$info['state']."'}";
		break;
		case 'scrawl':	//Ϳѻ
			$config = array('savePath' => $uploaddir , 'maxSize' => 1000 , 'allowFiles' => array('.gif', '.png', '.jpg', '.jpeg', '.bmp'));
			$tmpPath = RE_ROOT."/file/temp/";
			$action = htmlspecialchars( $_GET["action"]);
			if($action == "tmpImg") {
				$config[ "savePath" ] = $tmpPath;
				$up = new Uploader( "upfile" , $config );
				$info = $up->getFileInfo();
				echo "<script>parent.ue_callback('" . $info[ "url" ] . "','" . $info[ "state" ] . "')</script>";
			} else {
				$up = new Uploader( "content" , $config , true );
				if(file_exists($tmpPath)){
					dir_delete($tmpPath);
				}
				$info = $up->getFileInfo();
				echo "{'url':'" . $info[ "url" ] . "',state:'" . $info[ "state" ] . "'}";
			}
		break;
		case 'file':
			$config = array('savePath' => $uploaddir , 'maxSize' => 10000 , 'allowFiles' => array('.rar', '.doc', '.docx', '.zip', '.pdf', '.txt', '.swf', '.wmv'));
			$up = new Uploader('upfile', $config);
			$info = $up->getFileInfo();
			echo '{"url":"' .$info[ "url" ] . '","fileType":"' . $info[ "type" ] . '","original":"' . $info[ "originalName" ] . '","state":"' . $info["state"] . '"}';
		break;
		default:
			die('Access Denied');
		break;
	}
}

?>
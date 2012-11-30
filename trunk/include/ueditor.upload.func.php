<?php
defined('IN_RUIEC') or exit('Access Denied');

//require RE_ROOT.'/include/uploader.class.php';
$upftype = isset($upftype) ? $upftype : 'image';

function getfiles( $path , &$files = array() )
{
	if ( !is_dir( $path ) ) return null;
	$handle = opendir( $path );
	while ( false !== ( $file = readdir( $handle ) ) ) {
		if ( $file != '.' && $file != '..' ) {
			$path2 = $path . '/' . $file;
			if ( is_dir( $path2 ) ) {
				getfiles( $path2 , $files );
			} else {
				if ( preg_match( "/\.(gif|jpeg|jpg|png|bmp)$/i" , $file ) ) {
					$files[] = $path2;
				}
			}
		}
	}
	return $files;
}

switch($upftype) {
	case 'image':	//Images
		$config = array('savePath' => $uploaddir , 'maxSize' => 1000 , 'allowFiles' => array('.gif', '.png', '.jpg', '.jpeg', '.bmp'));
		$title = htmlspecialchars($_POST['pictitle'],ENT_QUOTES);
		$up = new Uploader('upfile', $config);
		$info = $up->getFileInfo();
		echo "{'url':'".RE_PATH.$info['url']."','title':'".$title."','original':'".$info['originalName']."','state':'".$info['state']."'}";
	break;
	case 'scrawl':	//Scrawl
		$config = array('savePath' => $uploaddir , 'maxSize' => 1000 , 'allowFiles' => array('.gif', '.png', '.jpg', '.jpeg', '.bmp'));
		$tmpPath = RE_ROOT."/file/temp/";
		$action = htmlspecialchars( $_GET["action"]);
		if($action == "tmpImg") {
			$config[ "savePath" ] = $tmpPath;
			$up = new Uploader( "upfile" , $config );
			$info = $up->getFileInfo();
			echo "<script>parent.ue_callback('".RE_PATH.$info['url']."','".$info['state']."')</script>";
		} else {
			$up = new Uploader( "content" , $config , true );
			if(file_exists($tmpPath)){
				dir_delete($tmpPath);
			}
			$info = $up->getFileInfo();
			echo "{'url':'".RE_PATH.$info[ "url" ]."',state:'".$info[ "state" ]."'}";
		}
	break;
	case 'file':	//File
		$config = array('savePath' => $uploaddir , 'maxSize' => 10000 , 'allowFiles' => array('.rar', '.doc', '.docx', '.zip', '.pdf', '.txt', '.swf', '.wmv'));
		$up = new Uploader('upfile', $config);
		$info = $up->getFileInfo();
		echo '{"url":"'.RE_PATH.$info['url'].'","fileType":"'.$info['type'].'","original":"'.$info['originalName'].'","state":"'.$info["state"].'"}';
	break;
	case 'remoteimage':	//Remote Image
		$config = array("savePath" => $uploaddir,"allowFiles" => array('.gif', '.png', '.jpg', '.jpeg', '.bmp'), "maxSize" => 3000);
		$uri = htmlspecialchars($_POST['upfile']);
		$uri = str_replace("&amp;","&",$uri);
		$imgUrls = explode("ue_separate_ue",$uri );
		$tmpNames = array();
		foreach ( $imgUrls as $imgUrl ){
			if(strpos($imgUrl,'http')!==0 || strpos($imgUrl,'https')==0){
				array_push( $tmpNames , "error" );
				continue;
			}
			$heads = @get_headers($imgUrl, 1);
			if (!(stristr($heads['0'],'200') && stristr($heads['0'],'OK'))){
				array_push($tmpNames,'error');
				continue;
			}
			$fileType = strtolower( strrchr( $imgUrl , '.' ) );
			if (!in_array($fileType,$config['allowFiles']) || !stristr($heads['Content-Type'],'image')){
				array_push($tmpNames,'error');
				continue;
			}
			ob_start();
			$context = stream_context_create(array ('http' => array('follow_location' => false)));
			@readfile($imgUrl,false,$context);
			$img = ob_get_contents();
			ob_end_clean();
			$uriSize = strlen( $img );
			$allowSize = 1024 * $config[ 'maxSize' ];
			if ( $uriSize > $allowSize ) {
				array_push( $tmpNames , "error" );
				continue;
			}
			$savePath = $config[ 'savePath' ];
			if ( !file_exists( $savePath ) ) {
				mkdir( "$savePath" , 0777 );
			}
			$tmpName = $savePath . rand( 1 , 10000 ) . time() . strrchr( $imgUrl , '.' );
			try {
				$fp2 = @fopen( $tmpName , "a" );
				fwrite( $fp2 , $img );
				fclose( $fp2 );
				array_push( $tmpNames ,  $tmpName );
			} catch ( Exception $e ) {
				array_push( $tmpNames , "error" );
			}
		}
		echo "{'url':'".RE_PATH.implode("ue_separate_ue",$tmpNames)."','tip':'远程图片抓取成功！','srcUrl':'".$uri."'}";
	break;
	case 'imagemanager':	//Image Manager
		$action = htmlspecialchars($_POST['action']);
		if ($action == 'get') {
			$files = getfiles('/file/upload/');
			if (!$files) return;
			rsort($files,SORT_STRING);
			$str = '';
			foreach ($files as $file){
				$str .= $file.'ue_separate_ue';
			}
			echo $str;
		}
	break;
	case 'movie':
		$key =htmlspecialchars($_POST["searchKey"]);
		$type = htmlspecialchars($_POST["videoType"]);
		$html = file_get_contents('http://api.tudou.com/v3/gw?method=item.search&appKey=myKey&format=json&kw='.$key.'&pageNo=1&pageSize=20&channelId='.$type.'&inDays=7&media=v&sort=s');
		echo $html;
	break;
	default:
		die('Access Denied');
	break;
}
?>
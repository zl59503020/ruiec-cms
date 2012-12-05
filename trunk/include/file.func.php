<?php
defined('IN_RUIEC') or exit('Access Denied');
if(!function_exists('file_put_contents')) {
	define('FILE_APPEND', 8);
	function file_put_contents($file, $string, $append = '') {
		$mode = $append == '' ? 'wb' : 'ab';
		$fp = @fopen($file, $mode) or exit("Can not open $file");
		flock($fp, LOCK_EX);
		$stringlen = @fwrite($fp, $string);
		flock($fp, LOCK_UN);
		@fclose($fp);
		return $stringlen;
	}
}

//扩展名
function file_ext($filename) {
	return strtolower(trim(substr(strrchr($filename, '.'), 1)));
}

//文件名
function file_vname($name) {
	return str_replace(array(' ', '\\', '/', ':', '*', '?', '"', '<', '>', '|', "'", '$', '&', '%', '#', '@'), array('-', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''), $name);
}

//下载
function file_down($file, $filename = '', $data = '') {
	if(!$data && !is_file($file)) exit;
	$filename = $filename ? $filename : basename($file);
	$filetype = file_ext($filename);
	$filesize = $data ? strlen($data) : filesize($file);
    ob_end_clean();
	@set_time_limit(0);
	if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false) {
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
	} else {
		header('Pragma: no-cache');
	}
	header('Expires: '.gmdate('D, d M Y H:i:s').' GMT');
	header('Content-Encoding: none');
	header('Content-Length: '.$filesize);
	header('Content-Disposition: attachment; filename='.$filename);
	header('Content-Type: '.$filetype);
	if($data) { echo $data; } else { readfile($file); }
	exit;
}

//文件列表
function file_list($dir, $fs = array()) {
	$files = glob($dir.'/*');
	if(!is_array($files)) return $fs;
	foreach($files as $file) {
		if(is_dir($file)) {
			$fs = file_list($file, $fs);
		} else {
			$fs[] = $file;
		}
	}
	return $fs;
}

//复制
function file_copy($from, $to) {
	dir_create(dirname($to));
	if(is_file($to) && RE_CHMOD) @chmod($to, RE_CHMOD);	
	if(strpos($from, RE_PATH) !== false) $from = str_replace(RE_PATH, RE_ROOT.'/', $from);
	if(@copy($from, $to)) {
		if(RE_CHMOD) @chmod($to, RE_CHMOD);
		return true;
	} else {
		return false;
	}
}

//写入
function file_put($filename, $data) {
	dir_create(dirname($filename));	
	if(@$fp = fopen($filename, 'wb')) {
		flock($fp, LOCK_EX);
		$len = fwrite($fp, $data);
		flock($fp, LOCK_UN);
		fclose($fp);
		if(RE_CHMOD) @chmod($filename, RE_CHMOD);
		return $len;
	} else {
		return false;
	}
}

// 读取
function file_get($filename) {
	return @file_get_contents($filename);
}

//删除
function file_del($filename) {
	if(RE_CHMOD) @chmod($filename, RE_CHMOD);
	return is_file($filename) ? @unlink($filename) : false;
}

function dir_path($dirpath) {
	$dirpath = str_replace('\\', '/', $dirpath);
	if(substr($dirpath, -1) != '/') $dirpath = $dirpath.'/';
	return $dirpath;
}

// zip files
function dir_zip($path,$to){
	if(!is_dir($path)) return false;
	dir_create(dirname($to));	
	include RE_ROOT.'/include/zip.class.php';
	$archive = new PclZip($to);
	$v_list = $archive->create($path,PCLZIP_OPT_REMOVE_PATH,$path);
	if ($v_list == 0) { return false;}//("Error : ".$archive->errorInfo(true));}
	return true;
}

// 创建目录
function dir_create($path) {
	if(is_dir($path)) return true;
	//$dir = str_replace(RE_CACHE.'/', '', $path);	//Safe
	$dir = $path;
	$dir = dir_path($dir);
	$temp = explode('/', $dir);
	$cur_dir = '';//RE_CACHE.'/';
	$max = count($temp) - 1;
	for($i = 0; $i < $max; $i++) {
		$cur_dir .= $temp[$i].'/';
		if(is_dir($cur_dir)) continue;
		@mkdir($cur_dir);
		if(RE_CHMOD) @chmod($cur_dir, RE_CHMOD);
		if(!is_file($cur_dir.'/index.html')) file_copy(RE_ROOT.'/file/index.html', $cur_dir.'/index.html');
	}
	return is_dir($path);
}

// 目录权限
function dir_chmod($dir, $mode = '', $require = 0) {
	if(!$require) $require = substr($dir, -1) == '*' ? 2 : 0;
	if($require) {
		if($require == 2) $dir = substr($dir, 0, -1);
	    $dir = dir_path($dir);
		$list = glob($dir.'*');
		foreach($list as $v) {
			if(is_dir($v)) {
				dir_chmod($v, $mode, 1);
			} else {
				@chmod(basename($v), $mode);
			}
		}
	}
	if(is_dir($dir)) {
		@chmod($dir, $mode);
	} else {
		@chmod(basename($dir), $mode);
	}
}

//目录Copy
function dir_copy($fromdir, $todir) {
	$fromdir = dir_path($fromdir);
	$todir = dir_path($todir);
	if(!is_dir($fromdir)) return false;
	if(!is_dir($todir)) dir_create($todir);
	$list = glob($fromdir.'*');
	foreach($list as $v) {
		$path = $todir.basename($v);
		if(is_file($path) && !is_writable($path)) {
			if(RE_CHMOD) @chmod($path, RE_CHMOD);
		}
		if(is_dir($v)) {
		    dir_copy($v, $path);
		} else {
			@copy($v, $path);
			if(RE_CHMOD) @chmod($path, RE_CHMOD);
		}
	}
    return true;
}

//目录 删除
function dir_delete($dir) {
	$dir = dir_path($dir);
	if(!is_dir($dir)) return false;
	$dirs = array(RE_ROOT.'/admin/', RE_ROOT.'/api/', RE_CACHE.'/', RE_ROOT.'/file/', RE_ROOT.'/include/', RE_ROOT.'/lang/', RE_ROOT.'/member/', RE_ROOT.'/module/', RE_ROOT.'/extend/', RE_ROOT.'/skin/', RE_ROOT.'/template/', RE_ROOT.'/wap/');
	if(substr($dir, 0, 1) == '.' || in_array($dir, $dirs)) die("Cannot Remove System DIR $dir ");
	$list = glob($dir.'*');
	if($list) {
		foreach($list as $v) {
			is_dir($v) ? dir_delete($v) : @unlink($v);
		}
	}
    return @rmdir($dir);
}

// 获取所有文件
function get_file($dir, $ext = '', $fs = array()) {
	$files = glob($dir.'/*');
	if(!is_array($files)) return $fs;
	foreach($files as $file) {
		if(is_dir($file)) {
			if(is_file($file.'/index.php') && is_file($file.'/config.inc.php')) continue;
			$fs = get_file($file, $ext, $fs);
		} else {
			if($ext) {
				if(preg_match("/\.($ext)$/i", $file)) $fs[] = $file;
			} else {
				$fs[] = $file;
			}
		}
	}
	return $fs;
}

//是否可写
function is_write($file) {
	if(RE_WIN) {
		if(substr($file, -1) == '/') {
			if(is_dir($file)) {
				$file = $file.'writeable-test.tmp';
				if(@$fp = fopen($file, 'a')) {
					flock($fp, LOCK_EX);
					fwrite($fp, 'OK');
					flock($fp, LOCK_UN);
					fclose($fp);
					$tmp = file_get_contents($file);
					unlink($file);
					if($tmp == 'OK') return true;
				}
				return false;
			} else {
				dir_create($file);
				if(is_dir($file)) return is_write($file);
				return false;
			}
		} else {
			if(@$fp = fopen($file, 'a')) {
				fclose($fp);
				return true;
			}
			return false;
		}
	} else {
		return is_writeable($file);
	}
}
?>
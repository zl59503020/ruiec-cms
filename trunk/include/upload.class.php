<?php
defined('IN_RUIEC') or exit('Access Denied');
class upload {
	
	//Save Upload File
    static function save($fname, $save_path = '', $save_url = '', $ext_arr = '') {
		if (empty($_FILES) === false) 
		{
			$save_path = ($save_path == '') ? RE_ROOT.'/file/upload/'.date("Y/m/d/") : $save_path;
			$save_url = ($save_url == '') ? RE_ROOT.'/file/upload/'.date("Y/m/d/") : $save_url;
			$ext_arr = ($ext_arr == '') ? array('gif', 'jpg', 'jpeg', 'png', 'bmp','html','text','txt','rar') : $ext_arr;
			$max_size = 1000000;
			
			//header('Content-type: text/html; charset=UTF-8');
			
			$file_name = $_FILES[$fname]['name'];
			$tmp_name = $_FILES[$fname]['tmp_name'];
			$file_size = $_FILES[$fname]['size'];
		
			if (!$file_name) { return '请选择文件'; }
			if (is_dir($save_path) == false) { dir_create($save_path); } //@mkdir($save_path); } 
			if (@is_writable($save_path) == false) { return '上传目录没有写权限'; }
			if (@is_uploaded_file($tmp_name) == false) { return '临时文件可能不是上传文件'; }
			if ($file_size > $max_size) { return '上传文件大小超过限制'; }
			$temp_arr = explode(".", $file_name);
			$file_ext = array_pop($temp_arr);
			$file_ext = trim($file_ext);
			$file_ext = strtolower($file_ext);
			if (in_array($file_ext, $ext_arr) == false) { return '不允许的文件类型'; }
			else
			{
				$new_file_name = date("YmdHis") . '_' . rand(10000, 99999) . '.' . $file_ext;
				$file_path = $save_path . $new_file_name;
				if (move_uploaded_file($tmp_name, $file_path) == false) 
				{ 
					return '上传失败';
				}
				else
				{
					return array('上传成功',str_replace(RE_ROOT.'/',RE_PATH,$save_url).$new_file_name);
				}
			}
		}
    }
}

?>
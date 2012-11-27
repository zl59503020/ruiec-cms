<?php
defined('IN_RUIEC') or exit('Access Denied');

$this_forward = '?file='.$file;
$skin_root = RE_ROOT.'/skin/'.$CFG['skin'].'/';
is_dir($skin_root) or dir_create($skin_root);
$skin_path = './skin/'.$CFG['skin'].'/';
isset($fileid) or $fileid = '';
isset($bakid) or $bakid = '';
if($fileid && !preg_match("/^[0-9a-z_\-]+$/", $fileid))  die('文件格式错误');

switch($action) {
	case 'add':
		if(isset($v_ruiec_sm) && $v_ruiec_sm == 'ruiec') {
			if(!preg_match("/^[a-z0-9_\-]+$/", $fileid)) die('文件名只能为小写字母、数字、中划线、下划线');
			$template = $skin_root.'/'.$fileid.'.css';
			if(isset($nowrite) && is_file($template)) die('文件已经存在');
			if(!$content) die('风格内容不能为空');
			file_put($template, stripslashes($content));
			die('0');
		} else {
			$content = '';
			if(isset($type)) $content = htmlspecialchars(file_get($template_root.'/'.$type.'.css'));
			include tpl('skin_add');
		}
	break;
	case 'edit':
		if(!$fileid) die('文件不存在!');
		if(isset($v_ruiec_sm) && $v_ruiec_sm == 'ruiec') {
			if(!$refileid) die('文件名称不能为空!');
			if(!$content) die('内容不能为空');
			$dfile = $skin_root.$fileid.'.css';
			$nfile = $skin_root.$refileid.'.css';
			if(isset($backup)) {
				$i = 0;
				while(++$i) {
					$bakfile = $skin_root.$refileid.'.'.$i.'.bak';
					if(!is_file($bakfile)) {
						file_copy($dfile, $bakfile);
						break;
					}
				}
			}
			file_put($nfile, stripslashes($content));
			if($refileid != $fileid) file_del($dfile);
			die('0');
		} else {
			if(!is_write($skin_root.$fileid.'.css')) die($fileid.'.css不可写，请将其属性设置为可写');
			$content = file_get($skin_root.$fileid.'.css');
			include tpl('skin_edit');
		}
	break;
	case 'import':
		if(!$fileid) die('文件名不能为空');
		if(!$bakid) die('文件版本错误.');
		if(file_copy($skin_root.$fileid.'.'.$bakid.'.bak', $skin_root.$fileid.'.css')) die('0');//('备份文件恢复成功', $this_forward);
		die('备份文件恢复失败');
	break;
	case 'delete':
		if(!$fileid) die('文件不存在!');
		$file_ext = $bakid ? '.'.$bakid.'.bak' : '.css';
		file_del($skin_root.$fileid.$file_ext);
		die('0');
	break;
	default:
		$dirs = $files = $skins = $baks = array();
		$files = glob($skin_root.'*.*');
		if(!$files) die('风格文件不存在，请先创建');//, "?file=$file&action=add");
		foreach($files as $k=>$v) {
			$filename = str_replace($skin_root, '', $v);
			if(preg_match("/^[0-9a-z_-]+\.css$/", $filename)) {
				$fileid = str_replace('.css', '', $filename);
				$skins[$fileid]['fileid'] = $fileid;
				$skins[$fileid]['filename'] = $filename;
				$skins[$fileid]['filesize'] = round(filesize($v)/1024, 2);
				$skins[$fileid]['mtime'] = date('Y-m-d H:i', filemtime($v));
				$skins[$fileid]['mod'] = substr(base_convert(fileperms($v), 10, 8), -4);
			} else if(preg_match("/^([0-9a-z_-]+)\.([0-9]+)\.bak$/", $filename, $m)) {
				$fileid = str_replace('.bak', '', $filename);
				$baks[$fileid]['fileid'] = $fileid;
				$baks[$fileid]['filename'] = $filename;
				$baks[$fileid]['filesize'] = round(filesize($v)/1024, 2);
				$baks[$fileid]['number'] = $m[2];
				$baks[$fileid]['type'] = $m[1];
				$baks[$fileid]['mtime'] = date('Y-m-d H:i', filemtime($v));
				$baks[$fileid]['mod'] = substr(base_convert(fileperms($v), 10, 8), -4);
			}
		}
		if($skins) ksort($skins);
		if($baks) ksort($baks);
		include tpl('skin');
	break;
}

?>
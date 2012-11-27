<?php
defined('IN_RUIEC') or exit('Access Denied');

isset($dir) or $dir = '';

isset($bakid) or $bakid = '';
isset($fileid) or $fileid = '';
$this_forward = '?file='.$file.'&dir='.$dir;
$template_root = RE_ROOT.'/template/'.$CFG['template'].'/'.$dir;
$template_path = 'template/'.$CFG['template'].'/'.$dir;
@include $template_root.'/these.name.php';

function template_name($fileid = '', $name = '') {
	global $template_root, $names;
	isset($names) or $names = array();
	if($fileid && $name) $names[$fileid] = $name;
	foreach($names as $k => $v) {
		if(!is_file($template_root.'/'.$k.'.htm') && !is_dir($template_root.'/'.$k)) unset($names[$k]);
	}
	if($names) ksort($names);
	file_put($template_root.'/these.name.php', "<?php\n\$names = ".var_export($names, true).";\n?>");
}

switch($action) {
	case 'template_name':
		$fileid or die('文件或目录不能为空');
		$name or die('新名称不能为空');
		$name = convert($name, 'UTF-8', RE_CHARSET);
		template_name($fileid, $name);
		die('0');
	break;
	case 'delete':
		$fileid or die('文件不能为空');
		$file_ext = $bakid ? '.'.$bakid.'.bak' : '.htm';
		file_del($template_root.'/'.$fileid.$file_ext);
		if(!$bakid) template_name();
		//echo '删除成功';
		die('0');
	break;
	case 'add':
		if(isset($v_ruiec_sm) && $v_ruiec_sm == 'ruiec') {
			if(!preg_match("/^[a-z0-9_\-]+$/", $fileid)) die('文件名只能为小写字母、数字、中划线、下划线');
			if(!$content) die('内容不能为空!');
			if(!$name) $name = $fileid;
			$template = $template_root.'/'.$fileid.'.htm';
			if(isset($nowrite) && is_file($template)) die('文件已经存在');
			file_put($template, stripslashes($content));
			if($name != $fileid) template_name($fileid, $name);
			//echo '创建成功';
			die('0');
		} else {
			$content = '';
			if(isset($type)) $content = htmlspecialchars(file_get($template_root.'/'.$type.'.htm'));
			include tpl('template_add');
		}
	break;
	case 'edit':
		$fileid or die('文件名为空!');
		if(isset($v_ruiec_sm) && $v_ruiec_sm == 'ruiec') {
			$srfileid or die('文件未找到!');
			if(!preg_match("/^[a-z0-9_\-]+$/", $fileid)) die('文件名只能为小写字母、数字、中划线、下划线');
			if(!$content) die('内容不能为空!');
			if(!$name) $name = $fileid;
			$sfile = $template_root.'/'.$srfileid.'.htm';
			$nfile = $template_root.'/'.$fileid.'.htm';
			if(isset($backup)) {
				$i = 0;
				while(++$i) {
					$bakfile = $template_root.'/'.$srfileid.'.'.$i.'.bak';
					if(!is_file($bakfile)) {
						file_copy($sfile, $bakfile);
						break;
					}
				}
			}
			file_put($nfile, stripslashes($content));
			if($srfileid != $fileid) file_del($sfile);
			if($name != $fileid) template_name($fileid, $name);
			//echo '修改成功';
			die('0');
		} else {
			if(!is_write($template_root.'/'.$fileid.'.htm')) die($fileid.'.htm不可写，请将其属性设置为可写');
			if($dir) $template_path = $template_path.'/';
			$name = (isset($names[$fileid]) && $names[$fileid]) ? $names[$fileid] : $fileid;
			$content = htmlspecialchars(file_get($template_root.'/'.$fileid.'.htm'));
			include tpl('template_edit');
		}
	break;
	case 'preview':
		$db->halt = 0;
		require_once RE_ROOT.'/include/template.func.php';
		$tpl_content = stripslashes($content);
		unset($content);
		$tpl_content = template_parse($tpl_content);
		cache_write('_preview.tpl.php', $tpl_content, 'tpl');
		$module = $dir ? $dir : 'destoon';
		$head_title = '模板预览';
		include RE_CACHE.'/tpl/_preview.tpl.php';
		exit();
		//die('preview...');
	break;
	case 'import':
		if(!$fileid) die('文件名不能为空');
		if(!$bakid) die('文件版本错误.');
		if(file_copy($template_path.$fileid.'.'.$bakid.'.bak', $template_path.$fileid.'.htm')) die('0');//('备份文件恢复成功', $this_forward);
		die('备份文件恢复失败');
	break;
	default:
		$dirs = $files = $templates = $baks = array();
		if(substr($template_root, -1) != '/') $template_root .= '/';
		$files = glob($template_root.'*');
		if(!$files) die('模板文件不存在，请先创建');//, "?file=$file&action=add&dir=$dir");
		foreach($files as $k=>$v) {
			if(is_dir($v)) {
				$dirid = basename($v);
				$dirs[$dirid]['dirname'] = $dirid;
				$dirs[$dirid]['name'] = (isset($names[$dirid]) && $names[$dirid]) ? $names[$dirid] : $dirid;
				$dirs[$dirid]['mtime'] = timetodate(filemtime($v), 5);
				$dirs[$dirid]['mod'] = substr(base_convert(fileperms($v), 10, 8), -4);
			} else {
				$filename = str_replace($template_root, '', $v);
				if(preg_match("/^[0-9a-z_-]+\.htm$/", $filename)) {
					$fileid = str_replace('.htm', '', $filename);
					$templates[$fileid]['fileid'] = $fileid;
					$templates[$fileid]['filename'] = $filename;
					$templates[$fileid]['filesize'] = round(filesize($v)/1024, 2);
					$templates[$fileid]['name'] = (isset($names[$fileid]) && $names[$fileid]) ? $names[$fileid] : $fileid;
					$tmp = strpos($filename, '-');
					$templates[$fileid]['type'] = $tmp ? substr($filename, 0, $tmp) : $fileid;
					$templates[$fileid]['mtime'] = timetodate(filemtime($v), 5);
					$templates[$fileid]['mod'] = substr(base_convert(fileperms($v), 10, 8), -4);
				} else if(preg_match("/^([0-9a-z_-]+)\.([0-9]+)\.bak$/", $filename, $m)) {
					$fileid = str_replace('.bak', '', $filename);
					$baks[$fileid]['fileid'] = $fileid;
					$baks[$fileid]['filename'] = $filename;
					$baks[$fileid]['filesize'] = round(filesize($v)/1024, 2);
					$baks[$fileid]['number'] = $m[2];
					$baks[$fileid]['type'] = $m[1];
					$baks[$fileid]['mtime'] = timetodate(filemtime($v), 5);
					$baks[$fileid]['mod'] = substr(base_convert(fileperms($v), 10, 8), -4);
				}
			}
		}
		if($dirs) ksort($dirs);
		if($templates) ksort($templates);
		if($baks) ksort($baks);
		include tpl('template');
	break;
}

?>
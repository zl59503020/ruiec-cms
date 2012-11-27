<?php
defined('IN_RUIEC') or exit('Access Denied');

require RE_ROOT.'/include/sql.func.php';
$D = RE_ROOT.'/file/backup/';
isset($dir) or $dir = '';
switch($action) {
	case 'repair':
		if(!$tables) die('表不能为空!');
		if(is_array($tables)) {
			foreach($tables as $table) {
				$db->query("REPAIR TABLE `$table`");
			}
		} else {
			$db->query("REPAIR TABLE `$tables`");
		}
		//echo '修复成功';
		die('0');
	break;
	case 'optimize':
		if(!$tables) die('表不能为空!');
		if(is_array($tables)) {
			foreach($tables as $table) {
				$db->query("OPTIMIZE TABLE `$table`");
			}
		} else {
			$db->query("OPTIMIZE TABLE `$tables`");
		}
		//echo '优化成功';
		die('0');
	break;
	case 'export':
		if(!$table) die('表不能为空!');
		//$memory_limit = trim(@ini_get('memory_limit'));
		$sizelimit = 1024*1024;//Max 1G
		file_down('', $table.'.sql', sql_dumptable($table));
		// 下载
	break;
	case 'drop':
		if(!$tables) die('请选择要删除的表!');
		if(is_array($tables)) {
			foreach($tables as $table) {
				if(strpos($table, $RE_PRE) === false) $db->query("DROP TABLE `$table`");
			}
		}
		//echo '删除成功';
		die('0');
	break;
	case 'comment':
		$table or die('Table为空');
		$note = trim($note);
		$db->query("ALTER TABLE `{$table}` COMMENT='{$note}'");
		//echo '修改注释成功';
		die('0');
	break;
	case 'dict':
		(isset($table) && $table) or die('Table为空');
		if(strpos($table, $RE_PRE) === false) {
			$rtable = $table;
		} else {
			$rtable = substr($table, strlen($RE_PRE));
			$rtable = preg_replace("/_[0-9]{1,}/", '', $rtable);
		}
		if(isset($v_ruiec_sm_dict) && $v_ruiec_sm_dict == 'ruiec') {
			$csv = $csql = '';
			foreach($name as $k=>$v) {
				$v = str_replace(',', '，', $v);
				$n = str_replace(',', '，', $note[$k]);
				$csv .= $k.','.$v.','.$n."\n";
				//$db->query("ALTER TABLE `{$table}` modify column `{$k}` {$type[$k]} comment '{$v}'");
			}
			file_put(RE_ROOT.'/file/setting/'.$rtable.'.csv', trim($csv));
			//echo '更新成功';
			die('0');
		} else {
			$fields = $csv = array();
			if(is_file(RE_ROOT.'/file/setting/'.$rtable.'.csv')) {
				$tmp = file_get(RE_ROOT.'/file/setting/'.$rtable.'.csv');
				$arr = explode("\n", $tmp);
				foreach($arr as $v) {
					$t = explode(',', $v);
					$csv[$t[0]]['name'] = $t[1];
					$csv[$t[0]]['note'] = $t[2];
				}
			}
			$result = $db->query("SHOW FULL COLUMNS FROM `$table`");
			while($r = $db->fetch_array($result)) {
				$r['Type'] = str_replace(' unsigned', '', $r['Type']);
				if(isset($csv[$r['Field']])) {
					$r['cn_name'] = $csv[$r['Field']]['name'];
					$r['cn_note'] = $csv[$r['Field']]['note'];
				} else {
					$r['cn_name'] = $r['cn_note'] = '';
					//if(isset($names[$r['Field']])) $r['cn_name'] = $names[$r['Field']];
				}
				$fields[] = $r;
			}
			include tpl('database_dict');
			exit;
		}
	break;
	case 'backup':
		if(isset($v_ruiec_sm) && $v_ruiec_sm == 'ruiec'){
			$fileid = isset($fileid) ? intval($fileid) : 1;
			$sizelimit = 2048;
			if($fileid == 1 && $tables) {
				if(!isset($tables) || !is_array($tables)) die('请选择需要备份的表');
				$random = timetodate($RE_TIME, 'Y-m-d H.i.s').' '.strtolower(random(10));
				$tsize = 0;
				foreach($tables as $k=>$v) {
					$tsize += $sizes[$v];
				}
				$tid = ceil($tsize*1024/$sizelimit);
				cache_write($_username.'_backup.php', $tables);
			} else {
				if(!$tables = cache_read($_username.'_backup.php')) die('请选择需要备份的表');
			}
			$sqldump = '';
			$tableid = isset($tableid) ? $tableid - 1 : 0;
			$startfrom = isset($startfrom) ? intval($startfrom) : 0;
			$tablenumber = count($tables);
			for($i = $tableid; $i < $tablenumber && strlen($sqldump) < $sizelimit * 1000; $i++) {
				$sqldump .= sql_dumptable($tables[$i], $startfrom, strlen($sqldump));
				$startfrom = 0;
			}
			if(trim($sqldump)) {
				$sqldump = "# RuiecCMS V".RE_VERSION." R".RE_RELEASE." http://www.ruiec.com\n# ".timetodate($RE_TIME, 6)."\n# --------------------------------------------------------\n\n\n".$sqldump;
				$tableid = $i;
				$filename = $random.'/'.$fileid.'.sql';
				file_put($D.$filename, $sqldump);
				$fid = $fileid;

				
				$reData = array();
				
				$reData['content'] = '分卷 <strong>#'.$fileid++.'</strong> 备份成功.. 程序将自动继续...';
				
				$reData['url'] = '?file='.$file.'&action='.$action.'&tableid='.$tableid.'&fileid='.$fileid.'&tid='.$tid.'&startfrom='.$startrow.'&random='.$random.'&v_ruiec_sm=ruiec';
				
				$reData['title'] = '正在备份 - '.progress(0, $fid, $tid,'1');
				
				echo json_encode($reData);
				
				exit;
			} else {
			   cache_delete($_username.'_backup.php');
			   $db->query("DELETE FROM {$RE_PRE}setting WHERE item='ruiec' AND item_key='backtime'");
			   $db->query("INSERT INTO {$RE_PRE}setting (item,item_key,item_value) VALUES('ruiec','backtime','$RE_TIME')");
			   die('0');
			}
		}
	break;
	case 'down':
		if(isset($dir) && $dir && is_dir($D.$dir)) {
			$to = RE_ROOT.'/file/zip/sql.backup.zip';
			if(dir_zip($D.$dir,$to)){
				file_down($to);
			}else{
				die('打包文件时出错.');
			}
		}else{
			die('Access Denied');
		}
	break;
	case 'import':
		if(isset($v_ruiec_sm_import) && $v_ruiec_sm_import == 'ruiec') {
			if(isset($filename) && $filename && file_ext($filename) == 'sql') {
				$dfile = $D.$filename;
				if(!is_file($dfile)) die('文件不存在，请检查');
				$sql = file_get($dfile);
				sql_execute($sql);
				//echo $filename.' 导入成功';
				die('0');
			} else {
				$fileid = isset($fileid) ? $fileid : 1;
				$tid = isset($tid) ? intval($tid) : 0;
				$filename = is_dir($D.$filepre) ? $filepre.'/'.$fileid : $filepre.$fileid;
				$filename = $D.$filename.'.sql';
				if(is_file($filename)) {
					$sql = file_get($filename);
					if(substr($sql, 0, 11) == '# RuiecCMS V') {
						$v = substr($sql, 11, 3);
						if(RE_VERSION != $v) die('由于数据结构存在差异，备份数据不可以跨版本导入<br/>备份版本：V'.$v.'<br/>当前系统：V'.RE_VERSION);
					}
					sql_execute($sql);
					$prog = $tid ? progress(1, $fileid, $tid) : '';
					
					$reData = array();
					$reData['title'] = '正在导入 - '.progress(1, $fileid, $tid,'1');
					$reData['content'] = '分卷 <strong>#'.$fileid++.'</strong> 导入成功 程序将自动继续...';

					$reData['url'] = '?file='.$file.'&action='.$action.'&filepre='.$filepre.'&fileid='.$fileid.'&tid='.$tid.'&import=1&v_ruiec_sm_import=ruiec';

					echo json_encode($reData);

					exit;
					
				} else {
					//echo '数据库恢复成功';
					die('0');
				}
			}
		} else {
			$dbak = $dbaks = $dsql = $dsqls = $sql = $sqls = array();
			$sqlfiles = glob($D.'*');
			if(is_array($sqlfiles)) {
				$class = 1;
				foreach($sqlfiles as $id=>$sqlfile)	{
					$tmp = basename($sqlfile);
					if(is_dir($sqlfile)) {
						$dbak['filename'] = $tmp;
						$size = $number = 0;
						$ss = glob($D.$tmp.'/*.sql');
						foreach($ss as $s) {
							$size += filesize($s);
							$number++;
						}
						$dbak['filesize'] = round($size/(1024*1024), 2);
						$dbak['pre'] = $tmp;
						$dbak['number'] = $number;
						$dbak['mtime'] = str_replace('.', ':', substr($tmp,	0, 19));
						$dbak['btime'] = substr($dbak['mtime'], 0, -3);
						$dbaks[] = $dbak;
					} else {
						if(preg_match("/([a-z0-9_]+_[0-9]{8}_[0-9a-z]{8}_)([0-9]+)\.sql/i", $tmp, $num)) {
							$dsql['filename'] = $tmp;
							$dsql['filesize'] = round(filesize($sqlfile)/(1024*1024), 2);
							$dsql['pre'] = $num[1];
							$dsql['number'] = $num[2];
							$dsql['mtime'] = timetodate(filemtime($sqlfile), 5);	if(preg_match("/[a-z0-9_]+_([0-9]{4})([0-9]{2})([0-9]{2})_([0-9]{2})([0-9]{2})([0-9a-z]{4})_/i", $num[1], $tm)) {
								$dsql['btime'] = $tm[1].'-'.$tm[2].'-'.$tm[3].' '.$tm[4].':'.$tm[5];
							} else {
								$dsql['btime'] = $dsql['mtime'];
							}
							if($dsql['number'] == 1) $class = $class  ? 0 : 1;
							$dsql['class'] = $class;
							$dsqls[] = $dsql;
						} else {
							if(file_ext($tmp) != 'sql') continue;
							$sql['filename'] = $tmp;
							$sql['filesize'] = round(filesize($sqlfile)/(1024*1024),2);
							$sql['mtime'] = timetodate(filemtime($sqlfile), 5);
							$sqls[] = $sql;
						}
					}
				}
			}
		}
		if($dbaks) $dbaks = array_reverse($dbaks);
		include tpl('database_import');
	break;
	case 'delete':
		if(!is_array($filenames)) {
			$tmp = $filenames;
			$filenames = array();
			$filenames[0] = $tmp;
		}
		foreach($filenames as $filename) {
			if(file_ext($filename) == 'sql') {
				file_del($dir ? $D.$dir.'/'.$filename : $D.$filename);
			} else if(is_dir($D.$filename)) {
				dir_delete($D.$filename);
			}
		}
		//echo '删除成功';
		die('0');
	break;
	case 'open':
		if(!$dir) die('请选择备份系列');
		if(!is_dir($D.$dir)) die('备份系列不存在');
		$sql = $sqls = array();
		$sqlfiles = glob($D.$dir.'/*.sql');
		//if(!$sqlfiles) die('备份系列文件不存在');
		$tid = count($sqlfiles);
		foreach($sqlfiles as $id=>$sqlfile)	{
			$tmp = basename($sqlfile);
			$sql['filename'] = $tmp;
			$sql['filesize'] = round(filesize($sqlfile)/(1024*1024), 2);
			$sql['pre'] = $dir;
			$sql['number'] = str_replace('.sql', '', $tmp);
			$sql['mtime'] = timetodate(filemtime($sqlfile), 5);
			$sql['btime'] = substr(str_replace('.', ':', $dir), 0, -3);
			$sqls[$sql['number']] = $sql;
		}
		include tpl('database_open');
	break;
	default:
		$dtables = $tables = $C = array();
		$i = $j = $dtotalsize = $totalsize = 0;
		$result = $db->query("SHOW TABLES FROM `".$CFG['db_name']."`");
		while($rr = $db->fetch_row($result)) {
			if(!$rr[0]) continue;
			$r = $db->get_one("SHOW TABLE STATUS FROM `".$CFG['db_name']."` LIKE '".$rr[0]."'");
			if(preg_match('/^'.$RE_PRE.'/', $rr[0])) {
				$dtables[$i]['name'] = $r['Name'];
				$dtables[$i]['rows'] = $r['Rows'];
				$dtables[$i]['size'] = round($r['Data_length']/1024/1024, 2);
				$dtables[$i]['index'] = round($r['Index_length']/1024/1024, 2);
				$dtables[$i]['tsize'] = $dtables[$i]['size']+$dtables[$i]['index'];
				$dtables[$i]['auto'] = $r['Auto_increment'];
				$dtables[$i]['updatetime'] = $r['Update_time'];
				$dtables[$i]['note'] = $r['Comment'];
				$dtables[$i]['chip'] = $r['Data_free'];
				$dtotalsize += $r['Data_length']+$r['Index_length'];
				$C[str_replace($RE_PRE, '', $r['Name'])] = $r['Comment'];
				$i++;
			} else {
				$tables[$j]['name'] = $r['Name'];
				$tables[$j]['rows'] = $r['Rows'];
				$tables[$j]['size'] = round($r['Data_length']/1024/1024, 2);
				$tables[$j]['index'] = round($r['Index_length']/1024/1024, 2);
				$tables[$j]['tsize'] = $tables[$j]['size']+$tables[$j]['index'];
				$tables[$j]['auto'] = $r['Auto_increment'];
				$tables[$j]['updatetime'] = $r['Update_time'];
				$tables[$j]['note'] = $r['Comment'];
				$tables[$j]['chip'] = $r['Data_free'];
				$totalsize += $r['Data_length']+$r['Index_length'];
				$j++;
			}
		}
		//cache_write('table-comment.php', $C);
		$dtotalsize = round($dtotalsize/1024/1024, 2);
		$totalsize = round($totalsize/1024/1024, 2);

		include tpl('database',$module);

	break;
}

?>
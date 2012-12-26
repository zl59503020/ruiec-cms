<?php
defined('IN_RUIEC') or exit('Access Denied');
// 更新数据.
function fields_update($post_fields, $table, $itemid, $keyname = 'itemid', $fd = array()) {
	global $FD, $db;
	if(!$table || !$itemid) return '';
	if($fd) $FD = $fd;
	$sql = '';
	foreach($FD as $k=>$v) {
		if(isset($post_fields[$v['name']]) || $v['html'] == 'checkbox') {
			$mk = $v['name'];
			$mv = $post_fields[$v['name']];
			if($v['html'] == 'checkbox') $mv = implode(',', $post_fields[$v['name']]);
			$sql .= ",$mk='$mv'";
		}
	}
	$sql = substr($sql, 1);
	if($sql) $db->query("UPDATE {$table} SET $sql WHERE `$keyname`=$itemid");
}

// 检测.
function fields_check($post_fields, $fd = array()) {
	global $FD, $session;
	if($fd) $FD = $fd;
	if(!is_object($session)) $session = new _session();
	foreach($FD as $k=>$v) {
		$value = isset($post_fields[$v['name']]) ? $post_fields[$v['name']] : '';
		if(!defined('RE_ADMIN')) continue;
		if($v['input_limit'] == 'is_date') {
			if(!is_date($value)) die('error');
		} else if($v['input_limit'] == 'is_email') {
			if(!is_email($value)) die('email');
		} else if(is_numeric($v['input_limit'])) {
			$length = word_count($value);
			if($length < $v['input_limit']) die('fields_less');
		} else {
			if(preg_match("/^([0-9]{1,})\-([0-9]{1,})$/", $v['input_limit'], $m)) {			
				$length = word_count($value);
				if($m[1] && $length < $m[1]) die('fields_less');
				if($m[2] && $length > $m[2]) die('fields_more');
			} else {
				if(!preg_match("/^".$v['input_limit']."$/", $value)) die('fields_match');
			}
		}
	}
}

function fields_html($left = 'th', $right = 'td', $values = array(), $fd = array()) {
	extract($GLOBALS, EXTR_SKIP);
	if($fd) $FD = $fd;
	$html = '';
	foreach($FD as $k=>$v) {
		if(!defined('RE_ADMIN')) continue;
		$html .= fields_show($k, $left, $right, $values, $fd);
	}
	return $html;
}

function fields_show($itemid, $left = 'th', $right = 'td', $values = array(), $fd = array()) {
	extract($GLOBALS, EXTR_SKIP);
	if($fd) $FD = $fd;
	$html = '';
	$v = $FD[$itemid];
	$value = $v['default_value'];
	if(isset($values[$v['name']])) {
		$value = $values[$v['name']];
	}
	if($v['html'] == 'hidden') {
		$html .= '<input type="hidden" name="post_fields['.$v['name'].']" id="'.$v['name'].'" value="'.$value.'" />';
	} else {
		$html .= '<tr><'.$left.'>';
		$html .= $v['title'];
		$html .= '</'.$left.'>';
		$html .= '<'.$right.'>';
		switch($v['html']) {
			case 'text':
				$html .= '<input type="text" name="post_fields['.$v['name'].']" id="'.$v['name'].'" value="'.$value.'" />';
			break;
			case 'textarea':
				$html .= '<textarea name="post_fields['.$v['name'].']" id="'.$v['name'].'" >'.$value.'</textarea>';
			break;
			case 'select':
				if($v['option_value']) {
					$html .= '<select name="post_fields['.$v['name'].']" id="'.$v['name'].'" ><option value="">请选择</option>';
					$rows = explode("*", $v['option_value']);
					foreach($rows as $row) {
						if($row) {
							$cols = explode("|", trim($row));
							$html .= '<option value="'.$cols[0].'"'.($cols[0] == $value ? ' selected' : '').'>'.$cols[1].'</option>';
						}
					}
					$html .= '</select>';
				}
			break;
			case 'radio':
				if($v['option_value']) {
					$rows = explode("*", $v['option_value']);
					foreach($rows as $rw => $row) {
						if($row) {
							$cols = explode("|", trim($row));
							$html .= '<input type="radio" name="post_fields['.$v['name'].']" value="'.$cols[0].'" id="'.$v['name'].'_'.$rw.'"'.($cols[0] == $value ? ' checked' : '').'> '.$cols[1].'&nbsp;&nbsp;&nbsp;';
						}
					}
				}
			break;
			case 'checkbox':
				if($v['option_value']) {
					$value = explode(',', $value);
					$rows = explode("*", $v['option_value']);
					foreach($rows as $rw => $row) {
						if($row) {
							$cols = explode("|", trim($row));
							$html .= '<input type="checkbox" name="post_fields['.$v['name'].'][]" value="'.$cols[0].'" id="'.$v['name'].'_'.$rw.'"'.(in_array($cols[0], $value) ? ' checked' : '').'> '.$cols[1].'&nbsp;&nbsp;&nbsp;';
						}
					}
				}
			break;
		}
		$html .= $v['note'];
		$html .= '</'.$right.'></tr>';
	}
	return $html;
}
?>
<?php
defined('IN_RUIEC') or exit('Access Denied');
isset($tbname) or die('Access Denied');
$len = strlen($RE_PRE);
if(substr($tbname, 0, $len) == $RE_PRE) $tbname = substr($tbname, $len);
$do = new fields();
$do->tbname = $tbname;

switch($action) {
	case 'add':
		if(isset($v_ruiec_sm) && $v_ruiec_sm == 'ruiec'){
			if($do->pass($post)) {
				if($do->check_field($post['name'])){
					$do->add($post);
					cache_fields($tbname);			//cache
					die('0');
				}else{
					die('该字段已存在...');
				}
			} else {
				die($do->errmsg);
			}
		} else {
			include tpl('fields_add');
		}
	break;
	case 'edit':
		$itemid or die('Access Denied');
		$do->itemid = $itemid;
		if(isset($v_ruiec_sm) && $v_ruiec_sm == 'ruiec'){
			if($do->pass($post)) {
				$do->edit($post);
				cache_fields($tbname);				//cache
				die('0');
			} else {
				die($do->errmsg);
			}
		} else {
			extract($do->get_one());
			include tpl('fields_edit');
		}
	break;
	case 'delete':
		$itemid or die('Access Denied');
		$do->delete($itemid);
		die('0');
	break;
	default:
		$fields = $do->get_list("tbname='$tbname'");
		cache_fields($tbname);
		include tpl('fields');
	break;
}

class fields {
	var $itemid;
	var $db;
	var $tbname;
	var $pre;
	var $table;
	var $errmsg = '';

    function fields() {
		global $db, $RE_PRE;
		$this->pre = $RE_PRE;
		$this->table = $RE_PRE.'fields';
		$this->db = &$db;
    }

	// 检测必填
	function pass($post) {
		global $RE_TIME;
		if(!is_array($post)) return false;
		if(!$post['name']) return $this->_('请填写字段');
		if(!preg_match("/^[a-z0-9]+$/", $post['name'])) return $this->_('字段名只能为小写字母和数字的组合');
		if(!$post['title']) return $this->_('请填写字段名称');
		if(in_array($post['html'], array('select', 'radio', 'checkbox'))) {
			if(!$post['option_value']) return $this->_('请填写选项值');
			if(strpos($post['option_value'], '|') === false) return $this->_('请填写正确的选项值');
		}
		return true;
	}

	// 设置默认..
	function set($post) {
		if(!in_array($post['html'], array('select', 'radio', 'checkbox'))) {
			$post['option_value'] = '';
		}
		$post['length'] = intval($post['length']);
		if($post['html'] == 'textarea') {
			if($post['type'] != 'varchar' && $post['type'] != 'text') $post['type'] = 'text';
		} else if($post['html'] == 'checkbox' || $post['html'] == 'thumb' || $post['html'] == 'file') {
			$post['type'] = 'varchar';
			$post['length'] = 255;
		} else if($post['html'] == 'editor') {
			$post['type'] = 'text';
		} else if($post['html'] == 'area') {
			$post['type'] = 'int';
			$post['length'] = 10;
		}
		return $post;
	}

	function get_one() {
        return $this->db->get_one("SELECT * FROM {$this->table} WHERE itemid='$this->itemid'");
	}

	function get_list($condition = '', $order = 'itemid ASC') {
		$lists = array();
		$result = $this->db->query("SELECT * FROM {$this->table} WHERE $condition ORDER BY $order");
		while($r = $this->db->fetch_array($result)) {
			$lists[] = $r;
		}
		return $lists;
	}
	
	// 检测字段是否存在.
	function check_field($fieldname){
		$result = $this->db->query("SHOW FULL COLUMNS FROM `{$this->pre}{$this->tbname}`");
		while($r = $this->db->fetch_array($result)) {
			if($r['Field'] === $fieldname) return false;
		}
		return true;
	}

	// 添加
	function add($post) {
		$post = $this->set($post);
		$length = 0;
		if($post['type'] == 'varchar') {
			$length = min($post['length'], 255);
		} else if($post['type'] == 'int') {
			$length = min($post['length'], 10);
		}
		$type = strtoupper($post['type']);
		if($length) $type .= "($length)";
		$name = '`'.$post['name'].'`';
        $this->db->query("ALTER TABLE {$this->pre}{$this->tbname} ADD $name $type NOT NULL COMMENT '".$post['title']."'");
		$sqlk = $sqlv = '';
		foreach($post as $k=>$v) {
			$sqlk .= ','.$k; $sqlv .= ",'$v'";
		}
        $sqlk = substr($sqlk, 1);
        $sqlv = substr($sqlv, 1);
		$this->db->query("INSERT INTO {$this->table} ($sqlk) VALUES ($sqlv)");
		return $this->itemid;
	}

	function edit($post) {
		$post = $this->set($post);
		$length = 0;
		if($post['type'] == 'varchar') {
			$length = min($post['length'], 255);
		} else if($post['type'] == 'int') {
			$length = min($post['length'], 10);
		}
		$type = strtoupper($post['type']);
		if($length) $type .= "($length)";
		$cname = '`'.$post['cname'].'`';
		unset($post['cname']);
		$name = '`'.$post['name'].'`';
        $this->db->query("ALTER TABLE {$this->pre}{$this->tbname} CHANGE $cname $name $type NOT NULL");
		$sql = '';
		foreach($post as $k=>$v) {
			$sql .= ",$k='$v'";
		}
        $sql = substr($sql, 1);
	    $this->db->query("UPDATE {$this->table} SET $sql WHERE itemid=$this->itemid");
		return true;
	}
	
	// 删除
	function delete($itemid) {
		$this->itemid = $itemid;
		$r = $this->get_one();
		$name = '`'.$r['name'].'`';
		$this->db->query("DELETE FROM {$this->table} WHERE itemid=$itemid");
	    $this->db->query("ALTER TABLE {$this->pre}{$this->tbname} DROP $name");
	}

	function _($e) {
		$this->errmsg = $e;
		return false;
	}
}
?>
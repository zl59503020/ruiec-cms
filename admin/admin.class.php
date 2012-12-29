<?php
defined('IN_RUIEC') or exit('Access Denied');
class admin {
	var $userid;
	var $username;
	var $founderid;
	var $db;
	var $pre;
	var $table;
	var $fields;
	var $errmsg = '';

	function admin() {
		global $db, $admin, $CFG;
		$this->founderid = $CFG['founderid'];
		$this->db = &$db;
		$this->pre = $db->pre;
		$this->table = $db->pre.'member';
		$this->fields = array('username','password','email','groupid','status','truename','sex','company','phone','qq','logincount','lastlogintime','lastloginip','time','ip','userAgent','other');
	}

	// 获取
	function get_one($user, $type = 0) {
		$fields = $type ? 'username' : 'userid';
        return $this->db->get_one("SELECT * FROM {$this->table} WHERE `$fields`='$user'");
	}
	
	// 删除
	function delete($userid) {
		$r = $this->get_one($userid);
		if($r){
			if($r['userid'] == $this->founderid) die('创始人不可删除!');
			$this->db->query("DELETE FROM {$this->table} WHERE userid=$userid");
			return true;
		} else {
			die('管理员不存在');
		}
	}

	// 获取列表
	function get_list($condition='') {
		$admins = array();
		if($condition != '') $condition = ' WHERE '.$condition;
		$result = $this->db->query("SELECT * FROM {$this->table} $condition ORDER BY userid ASC");
		while($r = $this->db->fetch_array($result)) {
			$r['lastlogintime'] = $r['lastlogintime'] == '' ? '-' : timetodate($r['lastlogintime'], 5);
			$gpinfo = $this->db->get_one("SELECT name FROM {$this->pre}groups WHERE itemid = {$r['groupid']}");
			$r['groupname'] = $gpinfo == null ? '未分组' : $gpinfo['name'];
			$r['truename'] = $r['truename'] == '' ? '匿名' : $r['truename'];
			$admins[] = $r;
		}
		return $admins;
	}
	
	// 检测.必填
	function pass($post) {
		if(!is_array($post)) return false;
		if(!$post['groupid']) return $this->_('选择分组!');
		if(strlen($post['username']) < 3) return $this->_('用户名非法!');
		return true;
	}
	
	// 检测.默认
	function set($post,$ia=true) {
		global $RE_TIME, $RE_IP;
		if($ia){
			$post['ip'] = $RE_IP;
			$post['time'] = $RE_TIME;
			$post['userAgent'] = $_SERVER['HTTP_USER_AGENT'];
		}else{
			if(isset($post['groupid'])) unset($post['groupid']);
			if(isset($post['username'])) unset($post['username']);
			if($post['password'] == '') unset($post['password']);
		}
		if(isset($post['password'])) $post['password'] = md5($post['password']);
		if(isset($post['other'])) $post['other'] = serialize($post['other']);
		return $post;
	}

	// 添加
	function add($post) {
		$post = $this->set($post);
		$sqlk = $sqlv = '';
		foreach($post as $k=>$v) {
			if(in_array($k, $this->fields)) { $sqlk .= ','.$k; $sqlv .= ",'$v'"; }
		}
        $sqlk = substr($sqlk, 1);
        $sqlv = substr($sqlv, 1);
		$this->db->query("INSERT INTO {$this->table} ($sqlk) VALUES ($sqlv)");
		return $this->db->insert_id();
	}

	// 编辑
	function edit($post,$userid) {
		$post = $this->set($post,false);
		$sql = '';
		foreach($post as $k=>$v) {
			if(in_array($k, $this->fields)) $sql .= ",$k='$v'";
		}
        $sql = substr($sql, 1);
	    $this->db->query("UPDATE {$this->table} SET $sql WHERE userid=$userid");
		return true;
	}

	// error
	function _($e) {
		$this->errmsg = $e;
		return false;
	}
}
?>
<?php
defined('IN_RUIEC') or exit('Access Denied');
class admin {
	var $userid;
	var $username;
	var $founderid;
	var $db;
	var $pre;
	var $errmsg = '';

	function admin() {
		global $db, $admin, $CFG;
		$this->founderid = $CFG['founderid'];
		$this->db = &$db;
		$this->pre = $db->pre;
	}

	// 获取
	function get_one($user, $type = 0) {
		$fields = $type ? 'username' : 'userid';
        return $this->db->get_one("SELECT * FROM {$this->pre}member WHERE `$fields`='$user'");
	}
	
	// 删除
	function delete($userid) {
		$r = $this->get_one($userid);
		if($r){
			if($r['userid'] == $this->founderid) die('创始人不可删除!');
			$this->db->query("DELETE FROM {$this->pre}member WHERE userid=$userid");
			return true;
		} else {
			die('管理员不存在');
		}
	}

	// 获取列表
	function get_list($condition='') {
		$admins = array();
		if($condition != '') $condition = ' WHERE '.$condition;
		$result = $this->db->query("SELECT * FROM {$this->pre}member $condition ORDER BY userid ASC");
		while($r = $this->db->fetch_array($result)) {
			$r['lastlogintime'] = timetodate($r['lastlogintime'], 5);
			$gpinfo = $this->db->get_one("SELECT name FROM {$this->pre}groups WHERE itemid = {$r['groupid']}");
			$r['groupname'] = $gpinfo == null ? '未分组' : $gpinfo['name'];
			$admins[] = $r;
		}
		return $admins;
	}

	// 添加
	function add($userid, $right, $admin) {
		
	}

	// 编辑
	function edit($right, $type = 0) {
		
	}

	// error
	function _($e) {
		$this->errmsg = $e;
		return false;
	}
}
?>
<?php
defined('IN_RUIEC') or exit('Access Denied');

class COMMENT {
	var $db;
	var $table;
	var $fields;
	var $errmsg = '';

    function COMMENT(){
		global $db;
		$this->table = $db->pre.'comment';
		$this->db = &$db;
		$this->fields = array('itemid','comment_id','moduleid','infoid','username','userip','addtime','content','useragent','status','other');
	}
	
	// 获取评论
	function get_comments($moduleid, $infoid=0, $pid=1, $pct=10){
		$comments = array();
		$sqlwhere = " moduleid = $moduleid ".(($infoid == 0) ? '' : ' AND infoid = '.$infoid);
		$query = $this->db->query("SELECT * FROM {$this->table} WHERE $sqlwhere AND status = 1 ORDER BY addtime DESC LIMIT ".(($pid-1)*$pct).", ".$pct);
		while($r = $this->db->fetch_array($query)) {
			$_tempi = get_comment_info($moduleid,$r['infoid']);
			if($_tempi == null){
				$r['title'] = '信息未找到!';
				$r['linkurl'] = 'javascript:;';
			}else{
				$r['title'] = $_tempi['title'];
				$r['linkurl'] = $_tempi['linkurl'];
			}
			if($r['other'] != ''){
				$r['other'] = unserialize($r['other']);
				if(isset($r['other']['email'])){
					$r['thumb'] = 'http://www.gravatar.com/avatar/'.md5($r['other']['email']);
				}
			}
			if(!isset($r['thumb'])) $r['thumb'] = 'http://www.gravatar.com/avatar/'.md5('test@test.cn');
			$comments[] = $r;
		}
		return $comments;
	}
	
	// 获取评论总数
	function get_comments_count($moduleid, $infoid=0){
		$sqlwhere = " moduleid = $moduleid ".(($infoid == 0) ? '' : ' AND infoid = '.$infoid);
		$r = $this->db->get_one("SELECT COUNT(*) AS ct FROM {$this->table} WHERE $sqlwhere AND status = 1 ");
		return $r['ct'];
	}

	// 获取详细
	function get_comment_info($moduleid,$infoid){
		return $this->db->get_one("SELECT * FROM ".get_table($moduleid)." WHERE itemid = $infoid");
	}
	
	// check 检测
	function check($post) {
		if(!is_array($post)) return false;
		if(!isset($post['moduleid']) || $post['moduleid'] == '') return '模块错误!';
		if(!isset($post['infoid']) || $post['infoid'] == '') return '目标信息错误!';
		if(!isset($post['content']) || $post['content'] == '') return '评论内容不能为空';
		return true;
	}
	
	//check
	function set($post){
		if(!isset($post['username']) || $post['username'] == ''){$post['username'] = '匿名用户';}
		$post['userip'] = get_env('ip');
		$post['addtime'] = time();
		$post['useragent'] = $_SERVER["HTTP_USER_AGENT"];
		$post['status'] = '0';
		if(isset($post['other'])){
			$post['other'] = serialize($post['other']);
		}
		
		return $post;
	}
	
	// 添加评论
	function add_newcomment($comment){
				
		$comment = $this->set($comment);
		
		$sqlk = $sqlv = '';
		foreach($comment as $k=>$v) {
			if(in_array($k, $this->fields)) { $sqlk .= ','.$k; $sqlv .= ",'$v'"; }
		}
        $sqlk = substr($sqlk, 1);
        $sqlv = substr($sqlv, 1);
		$this->db->query("INSERT INTO {$this->table} ($sqlk) VALUES ($sqlv)");
		return $this->db->insert_id();
	}
	
}
?>
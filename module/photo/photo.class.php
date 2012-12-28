<?php
defined('IN_RUIEC') or exit('Access Denied');
class photo {
	var $moduleid;
	var $itemid;
	var $db;
	var $table;
	var $table_data;
	var $fields;
	var $errmsg = '';

    function photo($moduleid) {
		global $db, $table, $table_data;
		$this->moduleid = $moduleid;
		$this->table = $table;
		$this->table_data = $table_data;
		$this->db = &$db;
		$this->fields = array('catid','level','title','introduce','thumb','images','content','tag','author','copyfrom','fromurl','status','hits','addtime','edittime','ip','template','islink','linkurl','filename');
    }
	
	// 检测.必填
	function pass($post) {
		if(!is_array($post)) return false;
		if(!$post['catid']) return $this->_('选择分类!');
		if(strlen($post['title']) < 3) return $this->_('标题太短!');
		if(isset($post['islink'])) {
			if(!$post['linkurl']) return $this->_('外链不能为空!');
		} else {
			if(!$post['content']) return $this->_('内容不能为空!');
		}
		return true;
	}
	
	// 保存前检测...[设置默认.]
	function set($post) {
		global $MOD, $RE_TIME, $RE_IP, $_username, $_userid;
		$post['islink'] = isset($post['islink']) ? 1 : 0;
		$post['addtime'] = (isset($post['addtime']) && $post['addtime']) ? strtotime($post['addtime']) : $RE_TIME;
		$post['edittime'] = $RE_TIME;
		$post['title'] = trim($post['title']);
		$post['content'] = stripslashes($post['content']);
		// 清除链接
		if($post['content'] && isset($post['clear_link']) && $post['clear_link']) $post['content'] = clear_link($post['content']);
		// 保存远程图片
		if($post['content'] && isset($post['save_remotepic']) && $post['save_remotepic']) $post['content'] = save_remote($post['content']);
		//if($post['content'] && $post['thumb_no'] && !$post['thumb']) $post['thumb'] = save_thumb($post['content'], $post['thumb_no'], $MOD['thumb_width'], $MOD['thumb_height']);
		//if(strpos($post['content'], 'pagebreak') !== false) $post['content'] = str_replace(array('[pagebreak]</p>', '<p>[pagebreak]', '[pagebreak]</div>', '<div>[pagebreak]'), array('</p>[pagebreak]', '[pagebreak]<p>', '</div>[pagebreak]', '[pagebreak]<div>'), $post['content']);
		// 简介
		if($post['content'] && !$post['introduce'] && $post['introduce_length'] && $post['introduce_length'] != '') $post['introduce'] = addslashes(get_intro($post['content'], $post['introduce_length']));
		if($this->itemid) {
			$post['editor'] = $_username;
			$new = $post['content'];
			if($post['thumb']) $new .= '<img src="'.$post['thumb'].'">';
			$r = $this->get_one();
			$old = $r['content'];
			if($r['thumb']) $old .= '<img src="'.$r['thumb'].'">';
			//delete_diff($new, $old);
		} else {
			$post['username'] = $post['editor'] = $_username;
			$post['ip'] = $RE_IP;
		}
		if(!defined('RE_ADMIN')) {
			$content = $post['content'];
			unset($post['content']);
			$post = dhtmlspecialchars($post);
			$post['content'] = _safe($content);
		}
		$post['images'] = serialize($post['images']);			//images
		//$post['content'] = stripslashes($post['content']);
		//$post['content'] = addslashes($post['content']);
		return $post;
	}

	// 获取唯一
	function get_one() {
		$content_table = content_table($this->moduleid, $this->itemid, $this->table_data);
        return $this->db->get_one("SELECT * FROM {$this->table} a,{$content_table} c WHERE a.itemid=c.itemid and a.itemid=$this->itemid");
	}

	// 获取列表
	function get_list($condition = 'status=3', $order = 'addtime DESC', $cache = '') {
		global $MOD, $pages, $page, $pagesize, $offset, $items;
		/*
		$r = $this->db->get_one("SELECT COUNT(*) AS num FROM {$this->table} WHERE $condition", $cache);
		$items = $r['num'];
		$pages = defined('CATID') ? listpages(1, CATID, $items, $page, $pagesize, 10, $MOD['linkurl']) : pages($items, $page, $pagesize);
		*/
		$lists = $catids = $CATS = array();
		$result = $this->db->query("SELECT * FROM {$this->table} WHERE $condition ORDER BY $order", $cache);
		while($r = $this->db->fetch_array($result)) {
			$r['adddate'] = timetodate($r['addtime'], 5);
			$r['editdate'] = timetodate($r['edittime'], 5);
			$r['alt'] = $r['title'];
			$r['title'] = $r['title'];
			$r['images'] = unserialize($r['images']);
			if(!$r['islink']) $r['linkurl'] = $MOD['linkurl'].$r['linkurl'];
			$catids[$r['catid']] = $r['catid'];
			$lists[] = $r;
		}
		//分类
		if($catids) {
			$result = $this->db->query("SELECT catid,catname,linkurl FROM {$this->db->pre}category WHERE catid IN (".implode(',', $catids).")");
			while($r = $this->db->fetch_array($result)) {
				$CATS[$r['catid']] = $r;
			}
			if($CATS) {
				foreach($lists as $k=>$v) {
					$lists[$k]['catname'] = ($v['catid'] && isset($CATS[$v['catid']])) ? $CATS[$v['catid']]['catname'] : '<span style="color:red;">该分类不存在!</span>';
					$lists[$k]['caturl'] = ($v['catid'] && isset($CATS[$v['catid']])) ? $MOD['linkurl'].$CATS[$v['catid']]['linkurl'] : '';
				}
			}
		}
		return $lists;
	}

	// 添加
	function add($post) {
		global $MOD;
		$post = $this->set($post);
		$sqlk = $sqlv = '';
		foreach($post as $k=>$v) {
			if(in_array($k, $this->fields)) { $sqlk .= ','.$k; $sqlv .= ",'$v'"; }
		}
        $sqlk = substr($sqlk, 1);
        $sqlv = substr($sqlv, 1);
		$this->db->query("INSERT INTO {$this->table} ($sqlk) VALUES ($sqlv)");
		$this->itemid = $this->db->insert_id();
		$content_table = content_table($this->moduleid, $this->itemid, $this->table_data);
		$this->db->query("INSERT INTO {$content_table} (itemid,content) VALUES ('$this->itemid', '$post[content]')");
		$this->update($this->itemid, $post, $post['content']);
		if($post['status'] == 3) $this->tohtml($this->itemid, $post['catid']);
		/*
		if($post['status'] == 3 && $post['username'] && $MOD['credit_add']) {
			credit_add($post['username'], $MOD['credit_add']);
			credit_record($post['username'], $MOD['credit_add'], 'system', lang('my->credit_record_add', array($MOD['name'])), 'ID:'.$this->itemid);
		}
		*/
		//clear_upload($post['content'].$post['thumb'], $this->itemid);
		return $this->itemid;
	}

	//编辑
	function edit($post) {
		//$this->delete($this->itemid, false);
		$post = $this->set($post);
		$sql = '';
		foreach($post as $k=>$v) {
			if(in_array($k, $this->fields)) $sql .= ",$k='$v'";
		}
        $sql = substr($sql, 1);
	    $this->db->query("UPDATE {$this->table} SET $sql WHERE itemid=$this->itemid");
		$content_table = content_table($this->moduleid, $this->itemid, $this->table_data);
	    $this->db->query("UPDATE {$content_table} SET content='$post[content]' WHERE itemid=$this->itemid");
		$this->update($this->itemid, $post, $post['content']);
		//clear_upload($post['content'].$post['thumb'], $this->itemid);
		//if($post['status'] == 3) $this->tohtml($this->itemid, $post['catid']);
		return true;
	}

	function tohtml($itemid = 0, $catid = 0) {
		global $module, $MOD;
		if($MOD['show_html'] && $itemid) tohtml('show', $module, "itemid=$itemid");
	}
	
	// 更新
	function update($itemid, $item = array(), $content = '') {
		$item or $item = $this->db->get_one("SELECT * FROM {$this->table} WHERE itemid=$itemid");
		$keyword = $item['title'].','.($item['tag'] ? str_replace(' ', ',', trim($item['tag'])).',' : '').strip_tags(cat_pos(get_cat($item['catid']), ','));
		$keyword = str_replace("//", '', addslashes($keyword));
		$item['itemid'] = $itemid;
		$linkurl = $item['islink'] ? $item['linkurl'] : itemurl($item);
		$sql = "keyword='$keyword',linkurl='$linkurl'";
		$this->db->query("UPDATE {$this->table} SET $sql WHERE itemid=$itemid");
	}

	// 回收站
	function recycle($itemid) {
		if(is_array($itemid)) {
			foreach($itemid as $v) { $this->recycle($v); }
		} else {
			$this->db->query("UPDATE {$this->table} SET status=0 WHERE itemid=$itemid");
			$this->delete($itemid, false);	//删除已生成的文件.
			return true;
		}		
	}

	// 审核通过
	function restore($itemid) {
		global $module, $MOD;
		if(is_array($itemid)) {
			foreach($itemid as $v) { $this->restore($v); }
		} else {
			$this->db->query("UPDATE {$this->table} SET status=3 WHERE itemid=$itemid");
			if($MOD['show_html']) tohtml('show', $module, "itemid=$itemid");
			return true;
		}
	}

	// 删除
	function delete($itemid, $all = true) {
		global $MOD;
		if(is_array($itemid)) {
			foreach($itemid as $v) { 
				$this->delete($v, $all);
			}
		} else {
			$this->itemid = $itemid;
			$r = $this->get_one();
			if($MOD['show_html'] && !$r['islink']) {	//生成HTML
				$_file = RE_ROOT.'/'.$MOD['moduledir'].'/'.$r['linkurl'];
				if(is_file($_file)) unlink($_file);
				$i = 1;
				while($i) {
					$_file = RE_ROOT.'/'.$MOD['moduledir'].'/'.itemurl($r, $i);
					if(is_file($_file)) {
						unlink($_file);
						$i++;
					} else {
						break;
					}
				}
			}
			if($all) {
				/* $userid = get_user($r['username']);
				if($r['thumb']) delete_upload($r['thumb'], $userid);
				if($r['content']) delete_local($r['content'], $userid); */
				$this->db->query("DELETE FROM {$this->table} WHERE itemid=$itemid");
				$content_table = content_table($this->moduleid, $this->itemid, $this->table_data);
				$this->db->query("DELETE FROM {$content_table} WHERE itemid=$itemid");
				/* if($r['username'] && $MOD['credit_del']) {
					credit_add($r['username'], -$MOD['credit_del']);
					credit_record($r['username'], -$MOD['credit_del'], 'system', lang('my->credit_record_del', array($MOD['name'])), 'ID:'.$this->itemid);
				} */
			}
		}
	}

	// 更新级别
	function level($itemid, $level) {
		$itemids = is_array($itemid) ? implode(',', $itemid) : $itemid;
		$this->db->query("UPDATE {$this->table} SET level=$level WHERE itemid IN ($itemids)");
	}
	
	// 更新状态
	function status($itemid, $status) {
		$itemids = is_array($itemid) ? implode(',', $itemid) : $itemid;
		$this->db->query("UPDATE {$this->table} SET status=$status WHERE itemid IN ($itemids)");
	}
	
	// 出错.
	function _($e) {
		$this->errmsg = $e;
		return false;
	}
}
?>
<?php
defined('IN_RUIEC') or exit('Access Denied');
class tree {
	var $arr;
	var $ret;

	function tree($arr = array()) {
		$this->arr = $arr;
		$this->ret = '';
		return is_array($arr);
	}

	function get_parent($myid) {
		$newarr = array();
		if(!isset($this->arr[$myid])) return false;
		$pid = $this->arr[$myid]['parentid'];
		$pid = $this->arr[$pid]['parentid'];
		if(is_array($this->arr)) {
			foreach($this->arr as $id => $a) {
				if($a['parentid'] == $pid) $newarr[$id] = $a;
			}
		}
		return $newarr;
	}

	function get_child($myid) {
		$a = $newarr = array();
		if(is_array($this->arr)) {
			foreach($this->arr as $id => $a) {
				if($a['parentid'] == $myid) $newarr[$id] = $a;
			}
		}
		return $newarr ? $newarr : false;
	}

	function get_pos($myid, &$newarr) {
		$a = array();
		if(!isset($this->arr[$myid])) return false;
        $newarr[] = $this->arr[$myid];
		$pid = $this->arr[$myid]['parentid'];
		if(isset($this->arr[$pid])) $this->get_pos($pid,$newarr);
		if(is_array($newarr)) {
			krsort($newarr);
			foreach($newarr as $v) {
				$a[$v['id']] = $v;
			}
		}
		return $a;
	}

	function get_tree($myid, $str, $sid = 0, $adds = '') {
		$number=1;
		$child = $this->get_child($myid);
		if(is_array($child)) {
		    $total = count($child);
			foreach($child as $id=>$a) {
				$j = $k = '';
				if($number == $total) {
					$j .= '└';
				}else{
					$j .= '├';
					$k = $adds ? '│' : '';
				}
				$spacer = $adds ? $adds.$j : '';
				$selected = $id == $sid ? 'selected' : '';
				@extract($a);
				eval("\$nstr = \"$str\";");
				$this->ret .= $nstr;
				$this->get_tree($id, $str, $sid, $adds.$k.'&nbsp;&nbsp;');
				$number++;
			}
		}
		return $this->ret;
	}
}
?>
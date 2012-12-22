<?php
defined('IN_RUIEC') or exit('Access Denied');
$mid = isset($mid) ? intval($mid) : 1;
$CATEGORY = cache_read('category-'.$mid.'.php');
$MOD = cache_read('module-'.$mid.'.php');
$catid = isset($catid) ? intval($catid) : 0;
$do = new category($mid, $catid);
$parentid = isset($parentid) ? intval($parentid) : 0;
$table = $RE_PRE.'category';

switch($action) {
	case 'add':
		if(isset($v_ruiec_sm) && $v_ruiec_sm == 'ruiec'){
			if(!$category['catname']) die('分类名不能为空');
			$category['catname'] = trim($category['catname']);
			$category['catdir'] = $do->get_catdir($category['catdir']);
			$do->add($category);
			$do->cache();
			die('0');
			exit;
		}else{
			include tpl('category_add');
		}
	break;
	case 'ckdir':
		if(isset($v_ruiec_ckdir) && $v_ruiec_ckdir == 'ruiec'){
			if(!preg_match("/^[0-9a-z_-]+$/i", $catdir)){
				echo '<div style="margin:10px;color:red;">该目录名非法,请更换一个再试</div>';
			}else{
				if($do->check_catdir($catdir,$parentid)) {
					echo '<div style="margin:10px;color:#53BD4A;">该目录合法,可以使用!</div>';
				} else {
					echo '<div style="margin:10px;color:red;">该目录名已经被使用,请更换一个再试</div>';
				}
			}
			exit;
		}
		break;
	break;
	case 'edit':
		$catid or die('参数为空!');
		if(isset($v_ruiec_sm) && $v_ruiec_sm == 'ruiec'){
			if(!$category['catname']) die('分类名不能为空');
			if($category['parentid'] == $catid) die('上级分类不能与当前分类相同');
			$do->edit($category);
			$category['catid'] = $catid;
			update_category($category);
			$do->cache();
			die('0');
		}else{
			extract($db->get_one("SELECT * FROM {$table} WHERE catid=$catid"));
			include tpl('category_edit');
		}
	break;
	case 'delete':
		if($catid) $catids = $catid;
		$catids or die('参数错误');
		$do->delete($catids);
		$do->cache();
		die('0');
	break;
	case 'update':
		$u_category = array();
		foreach($_POST['catid'] as $_catid){
			$_tempary = array();
			$_tempary['catname'] = $catname[$_catid];
			$_tempary['listorder'] = $listorder[$_catid];
			$_tempary['catdir'] = $catdir[$_catid];
			$u_category[$_catid] = $_tempary;
		}
		$do->update($u_category);
		die('0');
	break;
	case 'cache':
		$do->repair();
		die('0');
	break;
	default:
		$RECAT = array();
		$result = $db->query("SELECT * FROM {$table} WHERE moduleid=$mid AND parentid=$parentid ORDER BY listorder,catid");
		while($r = $db->fetch_array($result)) {
			$RECAT[$r['catid']] = $r;
		}
		if(!$RECAT && !$parentid) include tpl('category_add');
		else include tpl('category');
	break;
}

//
class category {
	var $moduleid;
	var $catid;
	var $category = array();
	var $db;
	var $table;

	function category($moduleid = 1, $catid = 0) {
		global $db, $RE_PRE, $CATEGORY;
		$this->moduleid = $moduleid;
		$this->catid = $catid;
		if(!isset($CATEGORY)) $CATEGORY = cache_read('category-'.$this->moduleid.'.php');
		$this->category = $CATEGORY;
		$this->table = $RE_PRE.'category';
		$this->db = &$db;
	}
	
	function get_catchild($catid) {
		global $db;
		$cat = array();
		$result = $db->query("SELECT * FROM {$db->pre}category WHERE parentid=$catid ORDER BY listorder,catid ASC", 'CACHE');
		while($r = $db->fetch_array($result)) {
			$cat[] = $r;
		}
		return $cat;
	}
	
	function add($category)	{
		$category['moduleid'] = $this->moduleid;
		$sqlk = $sqlv = '';
		foreach($category as $k=>$v) {
			$sqlk .= ','.$k; $sqlv .= ",'$v'"; 
		}
        $sqlk = substr($sqlk, 1);
        $sqlv = substr($sqlv, 1);
		$this->db->query("INSERT INTO {$this->table} ($sqlk) VALUES ($sqlv)");
		$this->catid = $this->db->insert_id();
		$_setkv = "linkurl='list.php?catid=".$this->catid."'";
		if($category['catdir'] == '') $_setkv .= ", catdir='".$this->catid."'";
		$this->db->query("UPDATE {$this->table} SET $_setkv WHERE catid=$this->catid");
		return true;
	}

	function edit($category) {
		$category['linkurl'] = '';
		$sql = '';
		foreach($category as $k=>$v) {
			$sql .= ",$k='$v'";
		}
		$sql = substr($sql, 1);
		$this->db->query("UPDATE {$this->table} SET $sql WHERE catid=$this->catid");
		return true;
	}

	function delete($catids) {
		if(is_array($catids)) {
			foreach($catids as $catid) {
				if(isset($this->category[$catid])) $this->delete($catid);
			}
		} else {
			$catid = $catids;
			if(isset($this->category[$catid])) {
				$this->db->query("DELETE FROM {$this->table} WHERE catid=$catid");
				$arrchildid = implode(',', get_catchilds($catid,$this->moduleid));
				if($arrchildid != ''){
					$this->db->query("DELETE FROM {$this->table} WHERE catid IN (".substr($arrchildid,1).")");
				}
				$arrchildid = $catid.$arrchildid;
				if($this->moduleid > 4) $this->db->query("UPDATE ".get_table($this->moduleid)." SET status=0 WHERE catid IN (".$arrchildid.")");
			}
		}
		return true;
	}

	function update($category) {
	    if(!is_array($category)) return false;
		foreach($category as $k=>$v) {
			if(!$v['catname']) continue;
			$v['listorder'] = intval($v['listorder']);
			$v['catdir'] = $this->get_catdir($v['catdir'], $k);
			if(!$v['catdir']) $v['catdir'] = $k;
			$this->db->query("UPDATE {$this->table} SET catname='$v[catname]',listorder='$v[listorder]',catdir='$v[catdir]' WHERE catid=$k ");
		}
		return true;
	}

	function repair() {
		$query = $this->db->query("SELECT * FROM {$this->table} WHERE moduleid='$this->moduleid' ORDER BY listorder,catid");
		$CATEGORY = array();
		while($r = $this->db->fetch_array($query)) {
			$CATEGORY[$r['catid']] = $r;
		}
		$childs = array();
		foreach($CATEGORY as $catid => $category) {
			//$CATEGORY[$catid]['arrparentid'] = $arrparentid = $this->get_arrparentid($catid, $CATEGORY);
			$CATEGORY[$catid]['catdir'] = $catdir = preg_match("/^[0-9a-z_\-\/]+$/i", $category['catdir']) ? $category['catdir'] : $catid;
			$sql = "catdir='$catdir',arrparentid='$arrparentid'";
			if(!$category['linkurl']) {
				$CATEGORY[$catid]['linkurl'] = listurl($category);
				$sql .= ",linkurl='$category[linkurl]'";
			}
			$this->db->query("UPDATE {$this->table} SET $sql WHERE catid=$catid");
			if($arrparentid) {
				$arr = explode(',', $arrparentid);
				foreach($arr as $a) {
					if($a == 0) continue;
					isset($childs[$a]) or $childs[$a] = '';
					$childs[$a] .= ','.$catid;
				}
			}
		}
		foreach($CATEGORY as $catid => $category) {
			if(isset($childs[$catid])) {
				$CATEGORY[$catid]['arrchildid'] = $arrchildid = $catid.$childs[$catid];
				$CATEGORY[$catid]['child'] = 1;
				$this->db->query("UPDATE {$this->table} SET arrchildid='$arrchildid',child=1 WHERE catid='$catid'");
			} else {
				$CATEGORY[$catid]['arrchildid'] = $catid;
				$CATEGORY[$catid]['child'] = 0;
				$this->db->query("UPDATE {$this->table} SET arrchildid='$catid',child=0 WHERE catid='$catid'");
			}
		}
		$this->cache($CATEGORY);
        return true;
	}

	function get_arrparentid($catid, $CATEGORY) {
		if($CATEGORY[$catid]['parentid'] && $CATEGORY[$catid]['parentid'] != $catid) {
			$parents = array();
			$cid = $catid;
			while($catid) {
				if($CATEGORY[$cid]['parentid']) {
					$parents[] = $cid = $CATEGORY[$cid]['parentid'];
				} else {
					break;
				}
			}
			$parents[] = 0;
			return implode(',', array_reverse($parents));
		} else {
			return '0';
		}
	}

	function get_arrchildid($catid, $CATEGORY) {
		$arrchildid = '';
		foreach($CATEGORY as $category) {
			if(strpos(','.$category['arrparentid'].',', ','.$catid.',') !== false) $arrchildid .= ','.$category['catid'];
		}
		return $arrchildid ? $catid.$arrchildid : $catid;
	}

	// 检测分类目录是否存在
	function check_catdir($catdir,$parentid = 0){
		if(preg_match("/^[0-9a-z_\-\/]+$/i", $catdir)) {
			$condition = "catdir='$catdir' AND moduleid='$this->moduleid'";
			if($parentid) $condition .= " AND parentid = $parentid";
			$r = $this->db->get_one("SELECT catid FROM {$this->table} WHERE $condition");
			if($r) {
				return false;
			} else {
				return true;
			}
		} else {
			return false;
		}
	}
	
	function get_catdir($catdir, $catid = 0) {
		if(preg_match("/^[0-9a-z_\-\/]+$/i", $catdir)) {
			$condition = "catdir='$catdir' AND moduleid='$this->moduleid'";
			if($catid) $condition .= " AND catid!=$catid";
			$r = $this->db->get_one("SELECT catid FROM {$this->table} WHERE $condition");
			if($r) {
				return '';
			} else {
				return $catdir;
			}
		} else {
			return '';
		}
	}

	function cache($data = array()) {
		cache_category($this->moduleid, $data);
	}
}
?>
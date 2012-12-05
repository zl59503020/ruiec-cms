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
				if($do->get_catdir($catdir) != '') {
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
		extract($db->get_one("SELECT * FROM {$table} WHERE catid=$catid"));
		include tpl('category_edit');
	break;
	case 'cache':
		$do->repair();
		dmsg('更新成功', "?mid=$mid&file=$file");
	break;
	case 'delete':
		if($catid) $catids = $catid;
		$catids or msg();
		$do->delete($catids);
		$do->cache();
		dmsg('删除成功', $forward);
	break;
	default:
		$RECAT = array();
		$result = $db->query("SELECT * FROM {$table} WHERE moduleid=$mid AND parentid=$parentid ORDER BY listorder,catid");
		while($r = $db->fetch_array($result)) {
			$RECAT[$r['catid']] = $r;
		}
		if(!$RECAT && !$parentid) die('暂无分类,请先添加');
		include tpl('category');
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
		$this->db->query("UPDATE {$this->table} SET linkurl='list.php?catid=$this->catid' WHERE catid=$this->catid");
		return true;
	}

	function edit($category) {
		$category['letter'] = preg_match("/^[a-z]{1}+$/i", $category['letter']) ? strtolower($category['letter']) : '';
		if($category['parentid']) {
			$category['catid'] = $this->catid;
			$this->category[$this->catid] = $category;
			$category['arrparentid'] = $this->get_arrparentid($this->catid, $this->category);
		} else {
			$category['arrparentid'] = 0;
		}
		foreach(array('group_list',  'group_show',  'group_add') as $v) {
			$category[$v] = isset($category[$v]) ? implode(',', $category[$v]) : '';
		}
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
				$arrchildid = $this->category[$catid]['arrchildid'] ? $this->category[$catid]['arrchildid'] : $catid;
				$this->db->query("DELETE FROM {$this->table} WHERE catid IN ($arrchildid)");			
				if($this->moduleid > 4) $this->db->query("UPDATE ".get_table($this->moduleid)." SET status=0 WHERE catid IN (".$arrchildid.")");
			}
		}
		return true;
	}

	function update($category) {
	    if(!is_array($category)) return false;
		foreach($category as $k=>$v) {
			if(!$v['catname']) continue;
			$v['parentid'] = intval($v['parentid']);
			if($k == $v['parentid']) continue;
			if($v['parentid'] > 0 && !isset($this->category[$v['parentid']])) continue;
			$v['listorder'] = intval($v['listorder']);
			$v['level'] = intval($v['level']);
			$v['letter'] = preg_match("/^[a-z0-9]{1}+$/i", $v['letter']) ? strtolower($v['letter']) : '';
			$v['catdir'] = $this->get_catdir($v['catdir'], $k);
			if(!$v['catdir']) $v['catdir'] = $k;
			$this->db->query("UPDATE {$this->table} SET catname='$v[catname]',parentid='$v[parentid]',listorder='$v[listorder]',style='$v[style]',level='$v[level]',letter='$v[letter]',catdir='$v[catdir]' WHERE catid=$k ");
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
			$CATEGORY[$catid]['arrparentid'] = $arrparentid = $this->get_arrparentid($catid, $CATEGORY);
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

	function get_letter($catname, $letter = true) {
		return $letter ? strtolower(substr(gb2py($catname), 0, 1)) : str_replace(' ', '', gb2py($catname));
	}

	function cache($data = array()) {
		cache_category($this->moduleid, $data);
	}
}
?>
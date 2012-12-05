<?php
defined('IN_RUIEC') or exit('Access Denied');
class _session {
    function _session() {
		global $CFG;
		if($CFG['cookie_domain']) @ini_set('session.cookie_domain', $CFG['cookie_domain']);
		@ini_set('session.gc_maxlifetime', 1800);
    	$dir = RE_ROOT.'/file/session/'.substr($CFG['authkey'], 2, 6).'/';
		if(!is_dir($dir)) {
			dir_create($dir);
		}
		session_save_path($dir);
		session_cache_limiter('private, must-revalidate');
		@session_start();
		header("cache-control: private");
    }
	
}
?>
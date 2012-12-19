<?php 
defined('IN_RUIEC') or exit('Access Denied');
require RE_ROOT.'/module/'.$module.'/common.inc.php';
$itemid or _header($MOD['linkurl']);
$cmt = new COMMENT;
// 评论
if(isset($v_sm) && $v_sm == 'ruiec' && isset($comment) && is_array($comment)){
	if(isset($MOD['comment']) && $MOD['comment'] == 1){
		$comment['moduleid'] = $moduleid;
		$comment['infoid'] = $itemid;
		if($cmt->add_newcomment($comment) > 0){
			die('0');
		}else{
			die('1');
		}
	}else{
		die('系统当前模块未开启评论功能!');
	}
}
// 评论分页
if(isset($v_ajax) && $v_ajax == 'ruiec'){
	if(isset($c_page)){
		$_comments = $cmt->get_comments($moduleid,$itemid,$c_page);
		echo json_encode($_comments);
	}
	exit;
}

$item = $db->get_one("SELECT * FROM {$table} WHERE itemid=$itemid");
if($item && $item['status'] > 2) {
	if($item['islink']) dheader($item['linkurl']);
	if($MOD['show_html'] && is_file(RE_ROOT.'/'.$MOD['moduledir'].'/'.$item['linkurl'])) {
		@header("HTTP/1.1 301 Moved Permanently");
		dheader($MOD['linkurl'].$item['linkurl']);
	}
	extract($item);
} else {
	$head_title = ('抱歉，您要访问的信息不存在或被删除');
	@header("HTTP/1.1 404 Not Found");
	exit(include template('notfound', 'message'));
}
if(!isset($_COOKIE['read_news_'.$item['itemid']])) {
	$db->query("UPDATE {$table} SET hits=hits+1 WHERE itemid=$itemid");
	setcookie('read_news_'.$item['itemid'],time());
}
$CAT = get_cat($catid);
$content_table = content_table($moduleid, $itemid, $table_data);
$t = $db->get_one("SELECT content FROM {$content_table} WHERE itemid=$itemid");
$content = $t['content'];

if(isset($MOD['comment']) && $MOD['comment'] == 1){
	$comments = $cmt->get_comments($moduleid,$itemid);
	$comments_count = $cmt->get_comments_count($moduleid,$itemid);
}

$adddate = timetodate($addtime, 3);
$editdate = timetodate($edittime, 3);
$maincat = $childcat = get_maincat(0, $moduleid, 1);
//if($voteid) $voteid = explode(' ', $voteid);
if($fromurl) $fromurl = fix_link($fromurl);
$linkurl = linkurl($MOD['linkurl'].$linkurl, 1);
$titles = array();

$keytags = $tag ? explode(' ', $tag) : array();
$update = '';

$pages = '';
$subtitles = count($titles);
if(strpos($content, '[pagebreak]') !== false) {
	$content = explode('[pagebreak]', $content);
	$total = count($content);
	$pages = showpages($item, $total, $page);
	$content = _closetags($content[$page-1],true);

	if($total < $subtitles) $subtitles = $total;
}
//if($MOD['keylink']) $content = keylink($content, $moduleid);
//include RE_ROOT.'/include/update.inc.php';
$seo_file = 'show';

include RE_ROOT.'/include/seo.inc.php';

//if($subtitle) $seo_title = $subtitle.$seo_delimiter.$seo_title;
$template = 'show';
if($MOD['template_show']) $template = $MOD['template_show'];
if($MOD['template_show']) $template = $MOD['template_show'];
if($CAT['show_template']) $template = $CAT['show_template'];
if($item['template']) $template = $item['template'];

include template($template, $module);

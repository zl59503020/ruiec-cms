<?php 
defined('IN_DESTOON') or exit('Access Denied');
require DT_ROOT.'/module/'.$module.'/common.inc.php';
$itemid or dheader($MOD['linkurl']);
$item = $db->get_one("SELECT * FROM {$table} WHERE itemid=$itemid");
if($item && $item['status'] > 2) {
	if($item['islink']) dheader($item['linkurl']);
	if($MOD['show_html'] && is_file(DT_ROOT.'/'.$MOD['moduledir'].'/'.$item['linkurl'])) {
		@header("HTTP/1.1 301 Moved Permanently");
		dheader($MOD['linkurl'].$item['linkurl']);
	}
	extract($item);
} else {
	$head_title = lang('message->item_not_exists');
	@header("HTTP/1.1 404 Not Found");
	exit(include template('show-notfound', 'message'));
}
$CAT = get_cat($catid);
if(!check_group($_groupid, $MOD['group_show']) || !check_group($_groupid, $CAT['group_show'])) {
	$head_title = lang('message->without_permission');
	exit(include template('noright', 'message'));
}
$content_table = content_table($moduleid, $itemid, $MOD['split'], $table_data);
$t = $db->get_one("SELECT content FROM {$content_table} WHERE itemid=$itemid");
$content = $t['content'];

$CP = $MOD['cat_property'] && $CAT['property'];
if($CP) {
	require DT_ROOT.'/include/property.func.php';
	$options = property_option($catid);
	$values = property_value($moduleid, $itemid);
}

$adddate = timetodate($addtime, 3);
$editdate = timetodate($edittime, 3);
if($voteid) $voteid = explode(' ', $voteid);
if($fromurl) $fromurl = fix_link($fromurl);
$linkurl = linkurl($MOD['linkurl'].$linkurl, 1);
$titles = array();
if($subtitle) {
	$titles = explode("\n", $subtitle);
	$titles = array_map('trim', $titles);
}
$subtitle = isset($titles[$page-1]) ? $titles[$page-1] : '';
$keytags = $tag ? explode(' ', $tag) : array();
$update = '';
$fee = get_fee($item['fee'], $MOD['fee_view']);
if($fee) {
	$user_status = 4;
	$destoon_task = "moduleid=$moduleid&html=show&itemid=$itemid&page=$page";
	$description = get_description($content, $MOD['pre_view']);
} else {
	$user_status = 3;
}
$pages = '';
$subtitles = count($titles);
if(strpos($content, '[pagebreak]') !== false) {
	$content = explode('[pagebreak]', $content);
	$total = count($content);
	$pages = showpages($item, $total, $page);
	$content = _closetags($content[$page-1],true);
	//echo _closetags('</font></span><span style="font-family: \'宋体\'; font-size: 12pt; mso-spacerun: \'yes\'"><o:p></o:p></span></p><p style="line-height: 150%; margin-top: 0pt; text-indent: 24pt; margin-bottom: 0pt" class="p0"><span style="font-family: \'宋体\'; font-size: 12pt; font-weight: bold; mso-spacerun: \'yes\'">三、</span><span style="font-family: \'Times New Roman\'; font-size: 12pt; font-weight: bold; mso-spacerun: \'yes\'">节能技术方案的选择与设备制造型企业营销讲座</span><span style="font-family: \'宋体\'; font-size: 12pt; font-weight: bold; mso-spacerun: \'yes\'"><o:p></o:p></span></p><p style="line-height: 150%; margin-top: 0pt; text-indent: 24pt; margin-bottom: 0pt" class="p0"><span style="font-family: \'Times New Roman\'; font-size: 12pt; mso-spacerun: \'yes\'">分析各类节能技术产品的能效特征与商业机会；解读各类节能技术产品营销的现状、缺陷与误区；解读针对新建项目市场营销的九大成功步骤；解读针对合同能源管理市场营销的九大成功步骤；深度解读从销售到回款的各个产业链环节与方案工具。</span><span style="font-family: \'宋体\'; font-size: 12pt; mso-spacerun: \'yes\'"><o:p></o:p></span></p><DIV><a:ab><!--sss--><a href="">afs</a><a href="http://sell.ledoem.cn/list-4.html" target="_blank" >室内照明<br /><p/></a><li id="sitemap4ie6"><span><em></em>网站导航</span><dl class="d_hide gary_shadow"><dd><b>商机</b><div><a href="http://sell.ledoem.cn/list-4.html" target="_blank" title="室内照明">室内照明</a><a href="http://sell.ledoem.cn/list-5.html" target="_blank" title="发光模组">发光模组</a><a href="http://sell.ledoem.cn/list-476.html" target="_blank" title="光电设备">光电设备</a><a href="http://sell.ledoem.cn/list-477.html" target="_blank" title="其他LED相关设备">其他LED相关设备</a></div></dd><dd><b>社区</b><div><a href="http://bbs.ledoem.cn/">LED社区</a></div></dd><!--EndFragment-->',true);
	//exit;
	if($total < $subtitles) $subtitles = $total;
}
if($MOD['keylink']) $content = keylink($content, $moduleid);
include DT_ROOT.'/include/update.inc.php';
$seo_file = 'show';
include DT_ROOT.'/include/seo.inc.php';
if($subtitle) $seo_title = $subtitle.$seo_delimiter.$seo_title;
$template = 'show';
if($MOD['template_show']) $template = $MOD['template_show'];
if($CAT['show_template']) $template = $CAT['show_template'];
if($item['template']) $template = $item['template'];
include template($template, $module);
?>
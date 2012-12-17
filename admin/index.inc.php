<?php
defined('IN_RUIEC') or exit('Access Denied');
switch($action) {
	case 'phpinfo':
		phpinfo();
		exit;
	break;
	case 'html':
		msg('首页更新成功');
	break;
	case 'password':
		include tpl('password');
	break;
	case 'ruiec_message':
		$server_news = '';
		$xmlfile = 'http://www.ruiec.com/plug/rss/8.xml';
		$doc = new DOMDocument();
		$doc->load($xmlfile);
		$items = $doc->getElementsByTagName("item");
		foreach($items as $item){
			$link = $item->getElementsByTagName('link')->item(0)->textContent;
			$title = $item->getElementsByTagName('title')->item(0)->textContent;
			$datetime = $item->getElementsByTagName('pubDate')->item(0)->textContent;
			$server_news .= '<li>';
			$server_news .= '<span class="f_r">'.$datetime.'</span>';
			$server_news .= '<a href="'.$link.'" target="_blank" title="'.$title.'">'.$title.'</a>';
			$server_news .= '</li>';
		}
		if($server_news != ''){
			die($server_news);
		}else{
			die('<li>暂无相关内容!</li>');
		}
	break;
	default:
		include tpl('index');
	break;
}
?>
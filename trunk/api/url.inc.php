<?php
defined('IN_RUIEC') or exit('Access Denied');

$url_htm = '静态';
$url_php = '动态';
$url_rewrite = '伪静态';

$urls = array();

$urls['htm']['list'][0] = array('example'=>'('.$url_htm.') disk/25.html','index'=>'{$catdir}/{$index}.{$file_ext}', 'page'=>'{$catdir}/{$prefix}{$page}.{$file_ext}');
$urls['htm']['list'][1] = array('example'=>'('.$url_htm.') 10/25.html','index'=>'{$catid}/{$index}.{$file_ext}', 'page'=>'{$catid}/{$prefix}{$page}.{$file_ext}');
$urls['htm']['list'][2] = array('example'=>'('.$url_htm.') 10_25.html','index'=>'{$prefix}{$catid}.{$file_ext}', 'page'=>'{$prefix}{$catid}_{$page}.{$file_ext}');
$urls['htm']['list'][3] = array('example'=>'('.$url_htm.') 分类/1.html','index'=>'{$catname}/{$index}.{$file_ext}', 'page'=>'{$catname}/{$page}.{$file_ext}');

$urls['htm']['item'][0] = array('example'=>'('.$url_htm.') 1/125.html','index'=>'{$alloc}/{$prefix}{$itemid}.{$file_ext}', 'page'=>'{$alloc}/{$prefix}{$itemid}_{$page}.{$file_ext}');
$urls['htm']['item'][1] = array('example'=>'('.$url_htm.') 200810/25/125.html','index'=>'{$year}{$month}/{$day}/{$prefix}{$itemid}.{$file_ext}', 'page'=>'{$year}{$month}/{$day}/{$prefix}{$itemid}_{$page}.{$file_ext}');
$urls['htm']['item'][2] = array('example'=>'('.$url_htm.') disk/1/125.html','index'=>'{$catdir}/{$alloc}/{$prefix}{$itemid}.{$file_ext}', 'page'=>'{$catdir}/{$alloc}/{$prefix}{$itemid}_{$page}.{$file_ext}');
$urls['htm']['item'][3] = array('example'=>'('.$url_htm.') 200810/标题_125.html','index'=>'{$year}{$month}/{$title}_{$itemid}.{$file_ext}', 'page'=>'{$year}{$month}/{$title}_{$itemid}_{$page}.{$file_ext}');
$urls['htm']['item'][4] = array('example'=>'('.$url_htm.') disk/125.html','index'=>'{$catdir}/{$prefix}{$itemid}.{$file_ext}', 'page'=>'{$catdir}/{$prefix}{$itemid}_{$page}.{$file_ext}');

$urls['php']['list'][0] = array('example'=>'('.$url_php.') list.php?catid=1&page=2','index'=>'list.php?catid={$catid}', 'page'=>'list.php?catid={$catid}&page={$page}');
$urls['php']['list'][1] = array('example'=>'('.$url_php.') list.php/catid-1-page-2/','index'=>'list.php/catid-{$catid}/', 'page'=>'list.php/catid-{$catid}-page-{$page}/');
$urls['php']['list'][2] = array('example'=>'('.$url_rewrite.') list-htm-catid-1-page-2.html','index'=>'list-htm-catid-{$catid}.html', 'page'=>'list-htm-catid-{$catid}-page-{$page}.html');
$urls['php']['list'][3] = array('example'=>'('.$url_rewrite.') list-1-2.html','index'=>'list-{$catid}.html', 'page'=>'list-{$catid}-{$page}.html');
$urls['php']['list'][4] = array('example'=>'('.$url_rewrite.') list/1/','index'=>'list/{$catid}/', 'page'=>'list/{$catid}/{$page}/');
$urls['php']['list'][5] = array('example'=>'('.$url_rewrite.') mulu-c1-2.html','index'=>'{$catdir}-c{$catid}-1.html', 'page'=>'{$catdir}-c{$catid}-{$page}.html');

$urls['php']['item'][0] = array('example'=>'('.$url_php.') show.php?itemid=1&page=2','index'=>'show.php?itemid={$itemid}', 'page'=>'show.php?itemid={$itemid}&page={$page}');
$urls['php']['item'][1] = array('example'=>'('.$url_php.') show.php/itemid-1-page-2/','index'=>'show.php/itemid-{$itemid}/', 'page'=>'show.php/itemid-{$itemid}-page-{$page}/');
$urls['php']['item'][2] = array('example'=>'('.$url_rewrite.') show-htm-itmeid-1.html','index'=>'show-htm-itemid-{$itemid}.html', 'page'=>'show-htm-itemid-{$itemid}-page-{$page}.html');
$urls['php']['item'][3] = array('example'=>'('.$url_rewrite.') show-1-2.html','index'=>'show-{$itemid}.html', 'page'=>'show-{$itemid}-{$page}.html');
$urls['php']['item'][4] = array('example'=>'('.$url_rewrite.') show/1/','index'=>'show/{$itemid}/', 'page'=>'show/{$itemid}/{$page}/');
?>
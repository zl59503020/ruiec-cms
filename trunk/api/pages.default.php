<?php
defined('IN_RUIEC') or exit('Access Denied');
/* $pages .= "<a href='$home_url' title='首页'>首页</a>";
$pages .= "<a href='$home_url' title='上一页'>上一页</a>";
$pages .= "<a href='$home_url' title='下一页'>下一页</a>";
$pages .= "<a href='$demo_url' title='尾页'>尾页</a>"; */

$pages .= "<div class='page'>共计<strong style='color:red'>{$items}</strong>条&nbsp;每页显示 <strong style='color:red'>{$pagesize}</strong> 条&nbsp;&nbsp;";
//================================首页 上一页===============================
if($page == 1){
	$pages .= "<a href='javascript:;' class='mPage' style='cursor:not-allowed;text-decoration:none;color:#CCC;' title='木有了'>首页</a>";
	$pages .= "<a href='javascript:;' class='mPage' style='cursor:not-allowed;text-decoration:none;color:#CCC;' title='木有了'>上一页</a>";
}else{
	$pages .= "<a href='{$home_url}' class='mPage'>首页</a><a href='".$home_url."&page=".($page-1)."' class='mPage'>上一页</a>";
}
//===================================中间部分====================================
$IPageMax = ceil($items/$pagesize);
$showListCount = 5;
$it = ($page-2);
if($page <= 2) $it = 1;
if($IPageMax < $showListCount){
	$showListCount = $IPageMax;
}else{
	if(($page+2) >= $IPageMax) $it = ($page-($showListCount-($IPageMax-$page)));
	$showListCount = ($it+$showListCount);
}
for($i=$it; $i <= $showListCount; $i++){
	if($i > 0 && $i <= $IPageMax){
		if(($i-$page) == 0){
			$pages .= "<a class='mPage' style='background-color:#FFBA00;color:#000;'>{$i}</a>";
		}else{
			$pages .= "<a href='{$home_url}&page={$i}' class='mPage'>{$i}</a>";
		}
	}
}
//======================================下一页 尾页=================================
if(($IPageMax-$page) < 1){
	$pages .= "<a href='javascript:;' class='mPage' style='cursor: not-allowed; text-decoration: none; color: #CCC;' title='木有了'>下一页</a>";
	$pages .= "<a href='javascript:;' class='mPage' style='cursor: not-allowed; text-decoration: none; color: #CCC;' title='木有了'>尾页</a>";
}else{
	$pages .= "<a href='".$home_url."&page=".($page+1)."' class='mPage'>下一页</a><a href='{$demo_url}' class='mPage'>尾页</a>";
}
$pages .= "&nbsp;&nbsp;&nbsp;(<strong style='color:red'>{$page}</strong>/<strong style='color:#999'>{$IPageMax}</strong>)</div>";

?>
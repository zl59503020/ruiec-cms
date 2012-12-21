<?php
defined('IN_RUIEC') or exit('Access Denied');

if($reData['count'] == '0'){
	$reData['page'] .= "<div class='page'>当前暂无评论,来抢个沙发吧!</div>";
}else{
	$reData['page'] .= "<div class='page'>当前评论共计<strong style='color:red'>{$reData['count']}</strong>条&nbsp;每页显示 <strong style='color:red'>{$pagesize}</strong> 条&nbsp;&nbsp;";
	//================================首页 上一页===============================
	if($c_page == 1){
		$reData['page'] .= "<a href='javascript:;' class='mPage' style='cursor:not-allowed;text-decoration:none;color:#CCC;' title='木有了'>首页</a>";
		$reData['page'] .= "<a href='javascript:;' class='mPage' style='cursor:not-allowed;text-decoration:none;color:#CCC;' title='木有了'>上一页</a>";
	}else{
		$reData['page'] .= "<a href='javascript:;' onclick='getComments(_MODULEID,_ITEMID,1);' class='mPage'>首页</a>";
		$reData['page'] .= "<a href='javascript:;' onclick='getComments(_MODULEID,_ITEMID,".($c_page-1).");' class='mPage'>上一页</a>";
	}
	//===================================中间部分====================================
	$IPageMax = ceil($reData['count']/$pagesize);
	$showListCount = 5;
	$it = ($c_page-2);
	if($c_page <= 2) $it = 1;
	if($IPageMax < $showListCount){
		$showListCount = $IPageMax;
	}else{
		if(($c_page+2) >= $IPageMax) $it = ($c_page-($showListCount-($IPageMax-$c_page)));
		$showListCount = ($it+$showListCount);
	}
	for($i=$it; $i <= $showListCount; $i++){
		if($i > 0 && $i <= $IPageMax){
			if(($i-$c_page) == 0){
				$reData['page'] .= "<a class='mPage' style='background-color:#FFBA00;color:#000;'>{$i}</a>";
			}else{
				$reData['page'] .= "<a href='javascript:;' onclick='getComments(_MODULEID,_ITEMID,{$i});' class='mPage'>{$i}</a>";
			}
		}
	}
	//======================================下一页 尾页=================================
	if(($IPageMax-$c_page) < 1){
		$reData['page'] .= "<a href='javascript:;' class='mPage' style='cursor:not-allowed;text-decoration:none;color:#CCC;' title='木有了'>下一页</a>";
		$reData['page'] .= "<a href='javascript:;' class='mPage' style='cursor:not-allowed;text-decoration:none;color:#CCC;' title='木有了'>尾页</a>";
	}else{
		$reData['page'] .= "<a href='javascript:;' onclick='getComments(_MODULEID,_ITEMID,".($c_page+1).");' class='mPage'>下一页</a>";
		$reData['page'] .= "<a href='javascript:;' onclick='getComments(_MODULEID,_ITEMID,{$IPageMax});' class='mPage'>尾页</a>";
	}
	$reData['page'] .= "&nbsp;&nbsp;&nbsp;(<strong style='color:red'>{$c_page}</strong>/<strong style='color:#999'>{$IPageMax}</strong>)</div>";
}
?>
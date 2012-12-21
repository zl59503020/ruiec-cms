<?php
/*	
 *	评论接口api
 *	返回评论相关信息
 *	
 */
include '../common.inc.php';

if($moduleid < 3 || $itemid == 0) exit('Access Denied');

require RE_ROOT.'/include/comment.class.php';

$cmt = new COMMENT;

switch($action){
	case 'list':
		if(isset($v_ajax) && $v_ajax == 'ruiec'){
			isset($c_page) or $c_page = 1;
			$_comments = $cmt->get_comments($moduleid,$itemid,$c_page,$pagesize);
			$reData = array();
			$reData['count'] = $cmt->get_comments_count($moduleid,$itemid);
			foreach($_comments as $k=>$val){
				$_tempary = array();
				$_tempary['thumb'] = $val['thumb'];
				$_tempary['username'] = $val['username'];
				$_tempary['addtime'] = timetodate($val['addtime']);
				$_tempary['content'] = $val['content'];
				$reData['items'][] = $_tempary;
			}
			$reData['page'] = '';
			include 'pages.comment.php';
			echo json_encode($reData);
			exit;
		}
	break;
	case 'add':
		if(isset($v_sm) && $v_sm == 'ruiec' && isset($comment) && is_array($comment)){
			if(isset($MOD['comment']) && $MOD['comment'] == 1){
				if(isset($captcha)){
					if(!checkcaptcha($captcha)){
						die('验证码错误!');
					}
				}
				$comment['moduleid'] = $moduleid;
				$comment['infoid'] = $itemid;
				$_ck = $cmt->check($comment);
				if($_ck === true){
					if($cmt->add_newcomment($comment) > 0){
						die('0');
					}else{
						die('1');
					}
				}else{
					die($_ck);
				}
			}else{
				die('系统当前模块未开启评论功能!');
			}
		}
	break;
	default:
		
	break;
}


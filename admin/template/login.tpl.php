<?php 
defined('IN_RUIEC') or exit('Access Denied');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理员登录 - Powered By Ruiec CMS </title>
<meta name="generator" content="Ruiec CMS,www.ruiec.com"/>
<link href="admin/skin/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<noscript><br/><br/><br/><center><h1>您的浏览器不支持JavaScript,请更换支持JavaScript的浏览器</h1></center></noscript>
<noframes><br/><br/><br/><center><h1>您的浏览器不支持框架,请更换支持框架的浏览器</h1></center></noframes>
<div class="login_div">
	<div class="login_box">
    	<div class="login_logo" title="管理员登录 IP:<?php echo $RE_IP;?>">管理员登录 IP:<?php echo $RE_IP;?></div>
		<form method="post" action="?"  onsubmit="return btnSubmit_Click();">
        <div class="login_content">
          <dl>
			<dt>登录账号：</dt>
            <dd><input type="text" class="login_input required" style="width:130px;" />
            </dd>
          </dl>
          <dl>
			<dt>登录密码：</dt>
            <dd><input type="password" class="login_input required" style="width:130px;" />
            </dd>
          </dl>
          <dl>
			<dt>验证码：</dt>
            <dd>
                <input type="text" class="login_input required" style="width:55px; text-transform:uppercase" />
                <img src="api/captcha.png.php?action=image" width="70" height="22" alt="点击切换验证码" title="点击切换验证码" style="margin-top:2px; vertical-align:top;cursor:pointer;" onclick="this.src = 'api/captcha.png.php?action=image&refresh='+Math.random();" />
            </dd>
          </dl>
        </div>
        <div class="login_foot">
			<div class="right">
				<input type="submit" name="submit" value="登 录" class="login_btn" tabindex="4"/>&nbsp;&nbsp;<input type="button" value="退 出" class="login_btn" onclick="top.window.location='<?php echo RE_PATH;?>';"/>
            </div>
		</div>
        <div class="login_tip"></div>
    </div>
	<?php if(strpos(get_env('self'), '/admin.php') !== false) { ?>
	<div style="margin:10px 40px 0 40px;border:#FF8D21 1px solid;background:#FFFFDD;padding:8px;"><img src="admin/skin/images/notice.gif" align="absmiddle"/> 提示：为了系统安全，请修改后台入口文件名admin.php</div>
	<?php } ?>
	<div class="login_copyright">Copyright © 2010 - 2015 ruiec.com Inc. All Rights Reserved.<br /><a href="http://www.ruiec.com">源中瑞网络传媒</a> 版权所有</div>
</div>
</body>
</html>

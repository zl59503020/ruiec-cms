<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理中心</title>
<link href="<?php echo RE_PATH; ?>admin/skin/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo RE_PATH; ?>admin/skin/js/jquery/jquery-1.7.2.min.js"></script>
<script src="http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js" type="text/javascript"></script>
</head>
<body style="padding:10px;">
	<div class="navigation nav_icon">你好，<i><?php echo 'Admin(网站创始人)'; ?></i>，欢迎您</div>
	<div class="line10"></div>
	<div class="nlist1">
		<ul>
			<li>本次登录IP：<?php echo get_env('ip'); ?></li>
			<li>上次登录IP：<?php echo '127.0.0.1'; ?></li>
			<li>上次登录时间：<?php echo '2012-01-01'; ?></li>
			<li>操作系统：<?php echo get_env('os'); ?></li>
			<li>浏览器：<?php echo get_env('bs'); ?></li>
			<li>其它信息：<script>document.write("["+remote_ip_info.start+" - "+remote_ip_info.end+"] &nbsp;"+remote_ip_info.country+" "+remote_ip_info.province+" "+remote_ip_info.city+" "+remote_ip_info.district+" "+remote_ip_info.isp+" "+remote_ip_info.type+" "+remote_ip_info.desc+" ");</script></li>
		</ul>
	</div>
	<div class="line10"></div>
	<div class="nlist2 clearfix">
		<h2>站点信息</h2>
		<ul>
			<li>站点名称：<?php echo $RE['sitename']; ?></li>
			<li>公司名称：<?php echo $RE['webcompany']; ?></li>
			<li>网站域名：<?php echo RE_PATH; ?></li>
			<li>安装目录：<?php echo RE_ROOT; ?></li>
			<li>附件上传目录：<?php echo '/file/'; ?></li>
			<li>服务器名称： <?php echo '源中瑞CMS'; ?></li>
			<li>系统版本：<?php echo RE_VERSION; ?></li>
			<li>服务器环境：<?php echo PHP_OS.'/'.$_SERVER["SERVER_SOFTWARE"].'/'.'PHP v'.PHP_VERSION; ?></li>
			<li>PHP版本：<?php echo PHP_VERSION; ?> <a href="javascript:;" onclick="parent.f_addTab('php_info','phpinfo()','?action=phpinfo')">详细</a></li>
			<li>数据库信息：<?php echo $db->version(); ?></li>
			<li>服务器端口：<?php echo $_SERVER['SERVER_PORT']; ?></li>
			<li>其它: <?php echo iconv('GB2312','UTF-8',file_get('http://int.dpool.sina.com.cn/iplookup/iplookup.php')); ?></li>
			<li>版权所有：深圳源中瑞科技有限公司（Ruiec Inc.）</li>
		</ul>
		<div class="line10"></div>
	</div>
	<div class="clear" style="height:20px;"></div>
	<div class="sub_nav_list">
		<h3>建站快捷导航</h3>
		<ul>
			<li><a href="javascript:;" onclick="parent.f_addTab('sys_config','系统设置','?file=setting')"><img src="<?php echo RE_PATH; ?>admin/skin/images/icon_setting.png" /><br />参数设置</a></li>
			<li><a href="javascript:;" onclick="parent.f_addTab('sys_channel','模块设置','?file=module')"><img src="<?php echo RE_PATH; ?>admin/skin/images/icon_channel.png" /><br />模块设置</a></li>
			<li><a href="javascript:;" onclick="parent.f_addTab('sys_template','模板管理','?file=template')"><img src="<?php echo RE_PATH; ?>admin/skin/images/icon_templet.png" /><br />模板风格</a></li>
			<li><a href="javascript:;" onclick="parent.f_addTab('templet_list','静态文件','?action=html')""><img src="<?php echo RE_PATH; ?>admin/skin/images/icon_mark.png" /><br />生成静态</a></li>
			<li><a href="javascript:;" onclick="parent.f_addTab('plugin_list','系统插件管理','?file=plug')"><img src="<?php echo RE_PATH; ?>admin/skin/images/icon_plugin.png" /><br />插件管理</a></li>
			<li><a href="javascript:;" onclick="parent.f_addTab('plugin_list','会员管理','?file=member')"><img src="<?php echo RE_PATH; ?>admin/skin/images/icon_user.png" /><br />会员管理</a></li>
			<li><a href="javascript:;" onclick="parent.f_addTab('manager_list','管理员管理','?file=admin')"><img src="<?php echo RE_PATH; ?>admin/skin/images/icon_manaer.png" /><br />管理员</a></li>
			<li><a href="javascript:;" onclick="parent.f_addTab('manager_log','系统日志','?file=log')"><img src="<?php echo RE_PATH; ?>admin/skin/images/icon_log.png" /><br />系统日志</a></li>
		</ul>
	</div>
	<div class="note_list">
		<h3 class="site">建站三步曲</h3>
		<ul>
			<li>1、进入后台管理中心，点击“系统设置”修改网站配置信息；</li>
			<li>2、点击“频道管理”建立系统的频道、分类、扩展属性等信息；</li>
			<li>3、制作好网站模板，上传到站点templates目录下，点击“模板管理”生成模板；</li>
		</ul>
		<h3 class="msg">官方消息</h3>
		<ul id="ruiec_message">
			<li>正在获取官方最新消息...</li>
		</ul>
	</div>
	<script>
		$.ajax({
			url:'?action=ruiec_message',
			success:function(data){
				$('#ruiec_message').html(data);
			}
		});
	</script>
</body>
</html>

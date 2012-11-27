<?php defined('IN_RUIEC') or exit('Access Denied'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>RuiecCMS 后台管理</title>
<link href="<?php echo RE_PATH; ?>admin/skin/js/ui/skins/Aqua/css/ligerui-all.css" rel="stylesheet" type="text/css" />
<link href="<?php echo RE_PATH; ?>admin/skin/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo RE_PATH; ?>admin/skin/js/jquery/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="<?php echo RE_PATH; ?>admin/skin/js/ui/js/ligerBuild.min.js"></script>
<script type="text/javascript" src="<?php echo RE_PATH; ?>file/JavaScript/ruiec.js"></script>
<script type="text/javascript" src="<?php echo RE_PATH; ?>admin/skin/js/ex.js"></script>
<script type="text/javascript" src="<?php echo RE_PATH; ?>admin/skin/js/index.js"></script>
</head>
<body>
	<div class="pageloading_bg" id="pageloading_bg"></div>
    <div id="pageloading">数据加载中，请稍等...</div>
    <div id="global_layout" class="layout" style="width:100%">
		<div position="top" class="header">
            <div class="header_box">
                <div class="header_right"><span><b><?php echo $_username; ?></b> 您好，欢迎</span><br /><a href="javascript:;" onclick="f_addTab('home','管理中心','welcome.php')">管理中心</a> | <a target="_blank" href="<?php echo RE_PATH; ?>">预览网站</a> | <a href="<?php echo RE_PATH; ?>admin/re_logout.php">安全退出</a></div>
                <a class="logo">RuiecCMS Logo</a>
            </div>
        </div>
        <div position="left"  title="管理菜单" id="global_left_nav"> 
			<div title="控制面板" iconcss="menu-icon-setting">
                <ul id="global_controlpanel" class="nlist">
                </ul>
            </div>
			<div title="我的面板" iconcss="menu-icon-member">
                <ul id="global_my_diy" class="nlist">
                </ul>
            </div>
            <div title="频道管理" iconcss="menu-icon-model" class="l-scroll">
                 <ul id="global_channel_tree" class="nlist">
				 </ul>
            </div>
            <div title="插件管理" iconcss="menu-icon-plugins">
                <ul id="global_plugins" class="nlist">
                </ul>
            </div>
        </div>
        <div position="center" id="framecenter" toolsid="tab-tools-nav"> 
            <div tabid="home" title="管理中心" iconcss="tab-icon-home" style="height:300px" >
                <iframe frameborder="0" name="sysMain" src="?file=welcome"></iframe>
            </div> 
        </div> 
        <div position="bottom" class="footer">
            <div class="copyright">Copyright &copy; 2012 www.ruiec.com All Rights Reserved.</div>
        </div>
    </div>
</body>
</html>
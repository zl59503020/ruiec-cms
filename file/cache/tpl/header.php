<?php defined('IN_RUIEC') or exit('Access Denied');?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php if(isset($seo_title)) { ?><?php echo $seo_title;?><?php } else { ?><?php if(isset($head_title)) { ?><?php echo $head_title;?><?php echo $RE['seo_delimiter'];?><?php } ?><?php echo $RE['sitename'];?><?php } ?></title>
<?php if(isset($head_keywords)) { ?>
<meta name="keywords" content="<?php echo $head_keywords;?>"/>
<?php } ?>
<?php if(isset($head_description)) { ?>
<meta name="description" content="<?php echo $head_description;?>"/>
<?php } ?>
<link rel="stylesheet" type="text/css" href="<?php echo RE_SKIN;?>style.css"/>
<?php if($moduleid>4) { ?>
<link rel="stylesheet" type="text/css" href="<?php echo RE_SKIN;?><?php echo $module;?>.css"/>
<?php } ?>
<?php if(isset($CSS) && is_array($CSS)) { ?>
<?php if(is_array($CSS)) { foreach($CSS as $css) { ?>
<link rel="stylesheet" type="text/css" href="<?php echo RE_SKIN;?><?php echo $css;?>.css"/>
<?php } } ?>
<?php } ?>
<?php if(!RE_DEBUG) { ?>
<script type="text/javascript">window.onerror=function(){return true;}</script>
<?php } ?>
<script type="text/javascript" src="<?php echo RE_PATH;?>file/JavaScript/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo RE_PATH;?>file/JavaScript/common.js"></script>
<script type="text/javascript" src="<?php echo RE_PATH;?>file/JavaScript/ruiec.js"></script>
<?php if(isset($JS) && is_array($JS)) { ?>
<?php if(is_array($JS)) { foreach($JS as $js) { ?>
<script type="text/javascript" src="<?php echo RE_PATH;?>file/JavaScript/<?php echo $js;?>.js"></script>
<?php } } ?>
<?php } ?>
</head>
<body>
<!--Header-->
<div class="header">
  <div class="header_inner">
    <h1 class="logo">
      <a title="Ruiec内容管理系统" href="http://demo.dtcms.net">Ruiec内容管理系统</a>
    </h1>
    <ul class="nav">
  <li<?php if($moduleid<4) { ?> class="navdown"<?php } ?>><a href="<?php echo $MODULE['1']['linkurl'];?>"><span>首页</span></a></li>
  <?php if(is_array($MODULE)) { foreach($MODULE as $m) { ?>
<?php if($m['ismenu']) { ?>
<li<?php if($m['moduleid']==$moduleid) { ?> class="navdown"<?php } ?>>
<a href="<?php echo $m['linkurl'];?>"<?php if($m['isblank']) { ?> target="_blank"<?php } ?>><span><?php echo $m['name'];?></span></a>
</li>
<?php } ?>
<?php } } ?>
    </ul>
    <div class="search">
      <input id="keywords" name="keywords" class="input" type="text" x-webkit-speech="" autofocus="" placeholder="输入回车搜索" onkeydown="if(event.keyCode==13){SiteSearch('/search.aspx', '#keywords');return false};" />
      <input class="submit" type="submit" value="搜索" onclick="SiteSearch('/search.aspx', '#keywords');" />
    </div>
  </div>
</div>
<!--/Header-->

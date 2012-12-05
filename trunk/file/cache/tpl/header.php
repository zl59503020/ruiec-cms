<?php defined('IN_RUIEC') or exit('Access Denied');?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=<?php echo RE_CHARSET;?>"/>
<title><?php echo $RE['sitename'];?></title>
<meta name="keywords" content="head_keywords"/>
<meta name="description" content="head_description"/>
<meta name="generator" content="Ruiec CMS,www.ruiec.com"/>
<link rel="shortcut icon" type="image/x-icon" href="<?php echo RE_PATH;?>favicon.ico"/>
<link rel="bookmark" type="image/x-icon" href="<?php echo RE_PATH;?>favicon.ico"/>
<link rel="canonical" href="head_canonical"/>
<link rel="stylesheet" type="text/css" href="<?php echo RE_SKIN;?>style.css"/>
<?php if($moduleid>4) { ?><link rel="stylesheet" type="text/css" href="<?php echo RE_SKIN;?><?php echo $module;?>.css"/><?php } ?>
<?php if(isset($CSS) && is_array($CSS)) { ?>
<?php if(is_array($CSS)) { foreach($CSS as $css) { ?>
<link rel="stylesheet" type="text/css" href="<?php echo RE_SKIN;?><?php echo $css;?>.css"/>
<?php } } ?>
<?php } ?>
<?php if(!RE_DEBUG) { ?><script type="text/javascript">window.onerror=function(){return true;}</script><?php } ?>
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
<div class="header">
    <div class="m">
<div class="logo">
<a href="<?php echo RE_PATH;?>" title="<?php echo $RE['sitename'];?>" id="web_logo">
<img src="<?php echo $RE['weblogo'];?>" alt="<?php echo $RE['sitename'];?>" title="<?php echo $RE['sitename'];?>" />
</a>
</div>
<div class="rt_nav">
<div class="top">
<div class="top-nav">
<a href="" style="cursor:pointer;" title="设为首页">设为首页</a><span>-</span>
<a href="" style="cursor:pointer;" title="收藏本站">收藏本站</a><span>-</span>
<a href="" class="fontswitch" id="StranLink">繁体中文</a><span>-</span>
<a href="" title="WAP">WAP</a><span>-</span>
<a href="" title="English">English</a>
</div>
<div class="nav">
<ul class="list-none">
<li<?php if($moduleid<4) { ?> class="navdown"<?php } ?>><a href="<?php echo $MODULE['1']['linkurl'];?>" class="nav<?php if($moduleid>=4) { ?> hover-none<?php } ?>"><span>首页</span></a></li>
<?php if(is_array($MODULE)) { foreach($MODULE as $m) { ?>
<?php if($m['ismenu']) { ?>
<li class="line"></li>
<li<?php if($m['moduleid']==$moduleid) { ?> class="navdown"<?php } ?>>
<a href="<?php echo $m['linkurl'];?>"<?php if($m['isblank']) { ?> target="_blank"<?php } ?> class="nav<?php if($m['moduleid']!=$moduleid) { ?> hover-none<?php } ?>"><span><?php echo $m['name'];?></span></a>
</li>
<?php } ?>
<?php } } ?>
</ul>
</div>
</div>
</div>
</div>
</div>
<div class="clr"></div>
<div class="m b10">&nbsp;</div>
<div class="m"><img src='' alt='Image Show Ad' width='100%' height='100px' /></div>
<div class="m b10">&nbsp;</div>
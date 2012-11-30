<?php defined('IN_RUIEC') or exit('Access Denied');?><div class="pos">当前位置: <a href="<?php echo $MODULE['1']['linkurl'];?>">首页</a> &raquo; <a href="<?php echo $MOD['linkurl'];?>"><?php echo $MOD['name'];?></a> &raquo;
<h1 class="title"><?php echo $title;?></h1>
<div class="info"><span class="f_r"><img src="image/zoomin.gif" width="16" height="16" alt="放大字体" class="c_p" onclick="fontZoom('+', 'article');"/>&nbsp;&nbsp;<img src="<?php echo RE_SKIN;?>image/zoomout.gif" width="16" height="16"  alt="缩小字体" class="c_p" onclick="fontZoom('-', 'article');"/></span>
发布日期：<?php echo $adddate;?>
<?php if($copyfrom) { ?>&nbsp;&nbsp;来源：<?php if($fromurl) { ?><a href="<?php echo $fromurl;?>" target="_blank"><?php } ?><?php echo $copyfrom;?><?php if($fromurl) { ?></a><?php } ?><?php } ?>
<?php if($author) { ?>&nbsp;&nbsp;作者：<?php echo $author;?><?php } ?>
&nbsp;&nbsp;浏览次数：<span id="hits"><?php echo $hits;?></span>
</div>
<?php if($introduce) { ?><div class="introduce">核心提示：<?php echo $introduce;?></div><?php } ?>
<div id="content"><?php echo $content;?></div>

<?php if($keytags) { ?>
<div class="keytags">
<strong>关键词：</strong>
<?php if(is_array($keytags)) { foreach($keytags as $t) { ?>
<a href="<?php echo $MOD['linkurl'];?><?php echo rewrite('search.php?kw='.urlencode($t));?>" target="_blank"><?php echo $t;?></a>
<?php } } ?>
</div>
<?php } ?>
<?php if($MOD['show_np']) { ?>
<div class="np">
</div>
<div class="b10">&nbsp;</div>
<?php } ?>
<center>
<br/>
</div>
</div>
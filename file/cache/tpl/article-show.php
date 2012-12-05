<?php defined('IN_RUIEC') or exit('Access Denied');?><?php include template('header');?>
<div class="m">
<div class="lf_nav">
<a href="<?php echo $MOD['linkurl'];?>"><h3 class="title"><?php echo $MOD['name'];?></h3></a>
<div class="active" id="sidebar">
<?php if(is_array($maincat)) { foreach($maincat as $k => $v) { ?>
<dl class="list-none navnow">
<dt id="part2_80" class="">
<a href="<?php echo $MOD['linkurl'];?><?php echo $v['linkurl'];?>" title="<?php echo $v['catname'];?>" class="zm"><span><?php echo $v['catname'];?></span></a>
</dt>
</dl>
<?php } } ?>
<div class="clear"></div>
</div>
    </div>

<div class="ri_main">
<h3 class="title">
<div class="position" id="ny_navx">当前位置：<a href="<?php echo $MODULE['1']['linkurl'];?>">首页</a> &raquo; <a href="<?php echo $MOD['linkurl'];?>"><?php echo $MOD['name'];?></a> &raquo; <?php echo $title;?></div>
<span><?php echo $CAT['catname'];?></span>
</h3>
<div class="clr"></div>
<div class="active" id="shownews">
            <h1 class="title"><?php echo $title;?></h1>
<div class="met_hits">
发布日期：<?php echo $adddate;?>&nbsp;&nbsp;
<?php if($copyfrom) { ?>&nbsp;&nbsp;来源：<?php if($fromurl) { ?><a href="<?php echo $fromurl;?>" target="_blank"><?php } ?><?php echo $copyfrom;?><?php if($fromurl) { ?></a><?php } ?><?php } ?>
<?php if($author) { ?>&nbsp;&nbsp;作者：<?php echo $author;?><?php } ?>
&nbsp;&nbsp;浏览次数：<span id="hits"><?php echo $hits;?></span>
【<a href="javascript:window.print()">打印此页</a>】&nbsp;&nbsp;【<a href="javascript:self.close()">关闭</a>】
</div>
<?php if($introduce) { ?><div class="introduce">核心提示：<?php echo $introduce;?></div><?php } ?>
<div class="editor">
<?php echo $content;?>
<div class="clear"></div>
<?php if($keytags) { ?>
<div class="keytags">
<strong>关键词：</strong>
<?php if(is_array($keytags)) { foreach($keytags as $t) { ?>
&nbsp;&nbsp;<span><?php echo $t;?></span>&nbsp;&nbsp;
<?php } } ?>
</div>
<?php } ?>
</div>
</div>
<div class="clear"></div>

</div>
<div class="clear"></div>
</div>
<div class="clear"></div>
<div class="b10"></div>
<?php include template('footer');?>
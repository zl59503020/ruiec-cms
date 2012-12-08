<?php defined('IN_RUIEC') or exit('Access Denied');?><?php include template('header');?>
<div class="m">
<div class="lf_nav">
<a href=""><h3 class="title">搜索结果</h3></a>
<div class="active" id="sidebar">
<dl class="list-none navnow">
<dt id="part2_80" class="on">
<a href="" title="" class="zm"><span>搜索结果</span></a>
</dt>
</dl>
<div class="clear"></div>
</div>
    </div>

<div class="ri_main">
<h3 class="title">
<div class="position" id="ny_navx">当前位置：<a href="<?php echo $MODULE['1']['linkurl'];?>">首页</a> &raquo; <a href="<?php echo $MOD['linkurl'];?>"><?php echo $MOD['name'];?></a> &raquo; <?php echo cat_pos($CAT, ' &raquo; ');?></div>
<span>搜索结果</span>
</h3>
<div class="clr"></div>
<div class="active newslist" id="newslist">
<ul class="list-none metlist">
<?php $lists = tag("moduleid=$moduleid&condition=status=3&catid=".$catid."&pagesize=10&order=".$MOD['order']."&template=null");?>
<?php if(is_array($lists)) { foreach($lists as $v) { ?>
<li class="list top">
<span>[<?php echo timetodate($v['addtime'],3);?>]</span>
<a href="<?php echo $v['linkurl'];?>" title="<?php echo $v['alt'];?>" target="_blank"><?php echo $v['title'];?></a>
</li>
<?php } } ?>
</ul>
</div>
</div>
<div class="clear"></div>
</div>
<div class="clear"></div>
<div class="b10"></div>
<?php include template('footer');?>
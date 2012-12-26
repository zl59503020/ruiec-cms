<?php defined('IN_RUIEC') or exit('Access Denied');?><?php include template('header');?>
<div class="boxwrap">
  <div class="left710">
   <!--Content-->
    <div class="main_box">
      
      <dl class="head green">
        <dt><?php echo $catname;?></dt>
        <dd>
          <span>当前位置：<a href="/index.aspx">首页 </a> &gt; <a href="<?php echo $MOD['linkurl'];?>"><?php echo $MOD['name'];?></a> &gt; <?php echo cat_pos($CAT, ' &gt; ');?></span>
        </dd>
      </dl>
      <div class="clear"></div>
      <h1 class="base_tit">分类“<?php echo $catname;?>”的内容</h1>
  <!--    _substr('string','长度'，‘截取后加的字符串’，‘开始截取的位置’)-->
      <ul class="news_list">
<?php if(is_array($tags)) { foreach($tags as $v) { ?>
        <li>

          <h2><a href="<?php echo $v['linkurl'];?>" title="<?php echo $v['alt'];?>"><?php echo $v['title'];?></a></h2>
          <div class="info">
            <span class="time"><?php echo timetodate($v['addtime'],3);?></span>
            <span class="comm">暂时无</span>
            <span class="view"><?php echo $v['hits'];?></span>
          </div>
          <div class="note"><?php echo _substr($v['introduce'],100,'...');?></div>

        </li>
        <?php } } ?>
        
        
      </ul>
      <div class="line20"></div>
  <?php echo $pages;?>
  <!--放置页码列表-->
    </div>
    <!--/Content-->
  </div>
  
  <div class="left264">
    <!--Sidebar-->
    <div class="sidebar">
      <h3>资讯类别</h3>
      <ul class="navbar">
        <?php if(is_array($maincat)) { foreach($maincat as $k => $v) { ?><!--调用顶级分类-->
        <li><a title="<?php echo $v['catname'];?>" href="<?php echo $MOD['linkurl'];?><?php echo $v['linkurl'];?>"><em class="arrow">&gt;</em><?php echo $v['catname'];?></a></li>
<?php } } ?>
      </ul>
      <div class="clear"></div>
      <h3>推荐资讯</h3>
      <div class="focus_list">
        <ul>
          <?php $commend = tag("moduleid=$moduleid&condition=status=3 AND level=1 &catid=".$catid."&pagesize=6&order=".$MOD['order']."&template=null");?>
          <?php if(is_array($commend)) { foreach($commend as $v) { ?>
  <li>
            <a title="<?php echo $v['title'];?>" href="<?php echo $v['linkurl'];?>">
              <img src="<?php echo $v['thumb'];?>" width="100" height="100" alt="<?php echo $v['title'];?>" />
              <span><?php echo $v['title'];?></span>
            </a>
          </li>
  <?php } } ?>
          
        </ul>
        <div class="clear"></div>
      </div>
      <h3>人气排行</h3>
      <ul class="rank_list">
        <?php $hits = tag("moduleid=$moduleid&condition=status=3 &catid=".$catid."&pagesize=10&order=hits DESC&template=null");?>
<?php if(is_array($hits)) { foreach($hits as $key => $v) { ?>
<?php $key++;?>
        <li class="active">
        
          <span><?php echo timetodate($v['addtime'],2);?></span>
          <i class="num"><?php echo $key;?></i><a href="<?php echo $v['linkurl'];?>" title="<?php echo $v['title'];?>"><?php echo $v['title'];?></a>
        </li>
        <?php } } ?>
      </ul>
    </div>
    <!--/Sidebar-->
  </div>
</div>
<div class="clear"></div>
<?php include template('footer');?>

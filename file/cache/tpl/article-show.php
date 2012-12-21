<?php defined('IN_RUIEC') or exit('Access Denied');?><?php $JS = array('comment','jquery.form');?>
<?php include template('header');?>
<div class="boxwrap">
  <div class="left710">
   <!--Content-->
    <div class="main_box">
      <div class="meta">
        <h1 class="meta-tit"><?php echo $title;?></h1>
        <div class="share">
            
        </div>
        <p class="meta-info">
            <span class="time"><?php echo $adddate;?></span>
            <?php if(isset($MOD['comment']) && $MOD['comment'] == 1) { ?><span class="comm"><comment class="sp_comment_count">0</comment>人评论</span><?php } ?>
<span class="view"><?php echo $hits;?>次浏览</span>
            分类：IT业界
        </p>
      </div>
      <div class="entry">
        <?php echo $content;?>
      </div>
      
      <div class="line10"></div>
      <!--分享-->
<?php include template('_baidushare');?>
      
      <div class="line10"></div>
      
  <?php if(isset($MOD['show_np']) && $MOD['show_np'] == '1') { ?>
  <div class="related">
        <h3 class="base_tit">继续阅读...</h3>
        <ul class="txt_list">
         <li><strong>下一篇：</strong><?php echo tag("moduleid=$moduleid&condition=status=3 and addtime>$addtime&pagesize=1&order=addtime asc&template=list-np", -1);?></li>
<li><strong>上一篇：</strong><?php echo tag("moduleid=$moduleid&condition=status=3 and addtime<$addtime&pagesize=1&order=addtime desc&template=list-np", -1);?></li>
        </ul>
      </div>
  <?php } ?>
  <div class="line10"></div>
  
      <!--同类推荐-->
      <div class="related">
        <h3 class="base_tit">相关资讯</h3>
        <ul class="txt_list">
          <?php $info_sim = get_info_similar($moduleid,$keytags);?>
  <?php if(count($info_sim) == 0) { ?>
          <li>暂无相关的数据...</li>
  <?php } else { ?>
  <?php if(is_array($info_sim)) { foreach($info_sim as $k => $v) { ?>
  <li><a href="<?php echo $v['linkurl'];?>" title="<?php echo $v['title'];?>"><?php echo $v['title'];?></a></li>
  <?php } } ?>
  <?php } ?>
        </ul>
      </div>
  <?php echo $pages;?>
      <!--/同类推荐-->
  <?php include template('comment/comment');?>
    </div>
  </div>
  
  <div class="left264">
    <!--Sidebar-->
    <div class="sidebar">
      <h3>资讯类别</h3>
      <ul class="navbar">
         <?php if(is_array($maincat)) { foreach($maincat as $k => $v) { ?>
        <li>
          <h4><a href="<?php echo $MOD['linkurl'];?><?php echo $v['linkurl'];?>"<?php if($v['catid']==$catid) { ?> class="current"<?php } ?> ><?php echo $v['catname'];?></a></h4>
  <?php $nav2=get_maincat($v['catid']);?>
  <?php if($nav2!=null) { ?>
          <div class="list">
  <?php if(is_array($nav2)) { foreach($nav2 as $key => $va) { ?>
            <a  href="<?php echo $MOD['linkurl'];?><?php echo $va['linkurl'];?>" <?php if($va['catid']==$catid) { ?> class="current"<?php } ?> ><?php echo $va['catname'];?></a>
          <?php } } ?>
          </div>
  <?php } ?>
        </li>
        
        <?php } } ?>
        
      </ul>
      <div class="clear"></div>
      <h3>推荐资讯</h3>
      <div class="focus_list">
        <ul>
          
          <?php $commend = tag("moduleid=$moduleid&condition=status=3 AND level=6 &pagesize=6&order=".$MOD['order']."&template=null");?>
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
        <?php $hits = tag("moduleid=$moduleid&condition=status=3&pagesize=10&order=hits DESC&template=null");?>
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
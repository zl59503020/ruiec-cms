<?php defined('IN_RUIEC') or exit('Access Denied');?><?php include template('header');?>
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
            <span class="comm">0人评论</span>
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
      
      <!--同类推荐-->
      <div class="related">
        <h3 class="base_tit">相关资讯</h3>
        <ul class="txt_list">
          
          <div>同类下暂无推荐的资讯...</div>
          
        </ul>
      </div>
      <!--/同类推荐-->
      <?php if(isset($comments)) { ?>
      <!--评论-->
      <div class="comment_box">
  <h3 class="base_tit"><span><a href="#Add">发表评论</a></span>共有6访客发表了评论</h3>
<ol id="comment_list" class="comment_list">
<?php if(is_array($comments)) { foreach($comments as $key => $v) { ?>
<li><div class="floor">#<?php echo $key+1; ?></div>
<div class="avatar"><img src="<?php echo $v['thumb'];?>" width="36" height="36"></div>
<div class="inner">
<p><?php echo $v['content'];?></p>
<div class="meta"><span class="blue"><?php echo $v['username'];?></span><span class="time"><?php echo timetodate($v['addtime'],3);?></span></div>
</div>
</li>
<?php } } ?>
</ol>
  </div>
      <!--/评论-->
      <div class="line20"></div>
  <!--放置页码-->
  <?php echo $pages;?>
  <!--放置页码-->
  <!--提交评论-->
  <div class="comment_add">
        <h3 class="base_tit">我来说几句吧<a name="Add"></a></h3>
        <form action="" method="post" id="comment_form" name="comment_form" >
         <input type="hidden" name="v_sm" value="ruiec"/>
 <div class="comment_editor">
          昵称：<input type="text" name="comment[username]" class="input" />
  邮箱：<input type="text" name="comment[other][email]" class="input" />
  QQ：<input type="text" name="comment[other][qq]" class="input" />
        </div>
<div class="comment_editor">
          <textarea id="txtContent" name="comment[content]" class="input" style="width:658px;height:70px;"></textarea>
        </div>
        <div class="subcon">
          <input id="btnSubmit" name="submit" class="btn right" type="submit" value="提交评论（Ctrl+Enter）">
          
        </div>
        </form>
      </div>
  <?php } ?>
    </div>
<!--提交评论-->
    <!--/Content-->
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
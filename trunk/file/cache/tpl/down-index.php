<?php defined('IN_RUIEC') or exit('Access Denied');?><?php include template('header');?>
<div class="boxwrap">
  <div class="left710">
    <!--Content-->
    <div class="main_box">
      <dl class="head green">
        <dt>jquery插件</dt>
        <dd> <span><a href="<?php echo cat_url(23);?>" title="查看更多" class="arrow">&gt;</a></span> </dd>
      </dl>
      <div class="clear"></div>
      <ul class="down_list">
        <?php $lists = tag("moduleid=$moduleid&condition=status=3&catid=23&pagesize=3&order=".$MOD['order']."&template=null");?>
        <!-- <?php print_r($lists);?>-->
        <?php if(is_array($lists)) { foreach($lists as $v) { ?>
        <?php if($v['thumb'] == '') $v['thumb'] = '/file/images/view.jpg';?>
        <li> <a title="<?php echo $v['title'];?>" href="<?php echo $v['linkurl'];?>" class="pic"><img width="140" height="98" src="<?php echo $v['thumb'];?>" alt="<?php echo $v['title'];?>"></a>
          <h2><a href="<?php echo $v['linkurl'];?>" title="note"><?php echo $v['title'];?></a></h2>
          <div class="info"> <span class="time"><?php echo timetodate($v['addtime']);?></span> <span class="view"><?php echo $v['hits'];?>次浏览</span> </div>
          <div class="note"><?php echo $v['keyword'];?></div>
        </li>
        <?php } } ?>
      </ul>
      <dl class="head blue">
        <dt>图标素材</dt>
        <dd> <span><a href="<?php echo cat_url(24);?>" title="查看更多" class="arrow">&gt;</a></span> </dd>
      </dl>
      <div class="clear"></div>
      <ul class="down_list">
        <?php $lists = tag("moduleid=$moduleid&condition=status=3&catid=24&pagesize=3&order=".$MOD['order']."&template=null");?>
        <?php if(is_array($lists)) { foreach($lists as $v) { ?>
        <?php if($v['thumb'] == '') $v['thumb'] = '/file/images/view.jpg';?>
        <li> <a title="<?php echo $v['title'];?>" href="<?php echo $v['linkurl'];?>" class="pic"><img width="140" height="98" src="<?php echo $v['thumb'];?>" alt="<?php echo $v['title'];?>"></a>
          <h2><a href="<?php echo $v['linkurl'];?>" title="note"><?php echo $v['title'];?></a></h2>
          <div class="info"> <span class="time"><?php echo timetodate($v['addtime']);?></span> <span class="view"><?php echo $v['hits'];?>次浏览</span> </div>
          <div class="note"><?php echo $v['keyword'];?></div>
        </li>
        <?php } } ?>
      </ul>
    </div>
    <!--/Content-->
  </div>
  <div class="left264">
    <!--Sidebar-->
    <div class="sidebar">
      <h3>资源类别</h3>
      <ul>
  <?php if(is_array($maincat)) { foreach($maincat as $k => $v) { ?><!--调用顶级分类-->
        <li><a title="<?php echo $v['catname'];?>" href="<?php echo $MOD['linkurl'];?><?php echo $v['linkurl'];?>"><em class="arrow">&gt;</em><?php echo $v['catname'];?></a></li>
<?php } } ?>
      </ul>
      <h3>推荐资源</h3>
      <div class="focus_list">
        <ul>
          <?php $commend = tag("moduleid=$moduleid&condition=status=3 AND level=1 &catid=".$catid."&pagesize=6&order=".$MOD['order']."&template=null");?>
          <?php if(is_array($commend)) { foreach($commend as $v) { ?>
  <?php if($v['thumb'] == '') $v['thumb'] = '/file/images/view.jpg';?>
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
      <h3>下载排行</h3>
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
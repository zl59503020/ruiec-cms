<?php defined('IN_RUIEC') or exit('Access Denied');?><?php include template('header');?>
<div class="boxwrap">
  <div class="left710">
   <!--Content-->
    <div class="main_box">
      <div class="left300" style="height:300px;"></div>
  <div class="right350" style="height:300px;">
        <div class="newsToppic">
          <dl>
 <?php $lists = tag("moduleid=$moduleid&condition=status=3  AND level=5 &catid=$catid&pagesize=1&order=".$MOD['order']."&template=null");?>
 <?php if(is_array($lists)) { foreach($lists as $key => $v) { ?>
            <dt>
              <strong><a title="<?php echo $v['title'];?>" href="<?php echo $v['linkurl'];?>"><?php echo $v['title'];?></a></strong>
              <p><?php echo _substr($v['introduce'],90,'...');?><a href="<?php echo $v['linkurl'];?>">[详细]</a></p>
            </dt>
<?php } } ?>
 <?php $lists = tag("moduleid=$moduleid&condition=status=3 &catid=$catid&pagesize=7&order=".$MOD['order']."&template=null");?>
 <?php if(is_array($lists)) { foreach($lists as $key => $v) { ?>     
            <dd><span><?php echo timetodate($v['addtime'],2);?></span><a title="<?php echo $v['title'];?>" href="<?php echo $v['linkurl'];?>"><?php echo $v['title'];?></a></dd>
<?php } } ?>
          </dl>
        </div>
  </div>
      <!--分类资讯-->
      <div class="line20"></div> 
      <dl class="head green">
      
        <dt>数码产品</dt>
        <dd>
          <span><a href="<?php echo cat_url(15);?>" title="查看更多" class="arrow">&gt;</a></span>
        </dd>
      </dl>
      <div class="line10"></div>
      <div class="newsToplist">
        <div class="list">
          <div class="left325">
            <dl>
 <?php $lists = tag("moduleid=$moduleid&condition=status=3 AND thumb<>'' &catid=15&pagesize=3&order=".$MOD['order']."&template=null");?>
<!-- <?php print_r($lists);?>-->
 <?php if(is_array($lists)) { foreach($lists as $v) { ?>
              <dt>
                <a title="<?php echo $v['title'];?>" href="<?php echo $v['linkurl'];?>"><img width="110" height="110" src="<?php echo $v['thumb'];?>" alt="<?php echo $v['title'];?>"></a>
                <strong><a href="<?php echo $v['linkurl'];?>"><?php echo $v['title'];?></a></strong>
                <p><?php echo _substr($v['introduce'],58,'...');?></p>
              </dt>
<?php } } ?>
              
            </dl>
          </div>
          <div class="right325">
            <dl>
 <?php $lists = tag("moduleid=$moduleid&condition=status=3 &catid=$catid&pagesize=10&order=".$MOD['order']."&template=null");?>
 <?php if(is_array($lists)) { foreach($lists as $key => $v) { ?>    
              <dd><span><?php echo timetodate($v['addtime'],2);?></span><a title="<?php echo $v['title'];?>" href="<?php echo $v['linkurl'];?>"><?php echo $v['title'];?></a></dd>
<?php } } ?>           
              
            </dl>
          </div>
   
        </div>
      </div>
      
      <div class="line20"></div>
      
      <dl class="head blue">
      
        <dt>IT资讯</dt>
        <dd>
          <span><a href="<?php echo cat_url(7);?>" title="查看更多" class="arrow">&gt;</a></span>
        </dd>
      </dl>
      <div class="line10"></div>
      <div class="newsToplist">
        <div class="list">
          <div class="left325">
            <dl>
 <?php $lists = tag("moduleid=$moduleid&condition=status=3 AND thumb<>'' &catid=7&pagesize=3&order=".$MOD['order']."&template=null");?>
 <?php if(is_array($lists)) { foreach($lists as $v) { ?>
              <dt>
                <a title="<?php echo $v['title'];?>" href="<?php echo $v['linkurl'];?>"><img width="110" height="110" src="<?php echo $v['thumb'];?>" alt="<?php echo $v['title'];?>"></a>
                <strong><a href="<?php echo $v['linkurl'];?>"><?php echo $v['title'];?></a></strong>
                <p><?php echo _substr($v['introduce'],55,'...');?></p>
              </dt>
<?php } } ?>
              
            </dl>
          </div>
          <div class="right325">
            <dl>
 <?php $lists = tag("moduleid=$moduleid&condition=status=3 &catid=$catid&pagesize=10&order=".$MOD['order']."&template=null");?>
 <?php if(is_array($lists)) { foreach($lists as $key => $v) { ?>    
              <dd><span><?php echo timetodate($v['addtime'],2);?></span><a title="<?php echo $v['title'];?>" href="<?php echo $v['linkurl'];?>"><?php echo $v['title'];?></a></dd>
<?php } } ?>  
              
            </dl>
          </div>
   
        </div>
      </div>
      
      <!--/分类资讯-->
      
    </div>
    <!--/Content-->
  </div>
  <div class="left264">
    <!--Sidebar-->
    <div class="sidebar">
      <h3>推荐资讯</h3>
      <ul class="newsRedlist">
<?php $commend = tag("moduleid=$moduleid&condition=status=3 AND level=1 &catid=".$catid."&pagesize=6&order=".$MOD['order']."&template=null");?>
          <?php if(is_array($commend)) { foreach($commend as $v) { ?>
  <li>
            <a title="<?php echo $v['title'];?>" href="<?php echo $v['linkurl'];?>">
              <?php echo $v['title'];?>
            </a>
          </li>
  <?php } } ?>
      </ul>
      <h3>图片资讯</h3>
      <div class="focus_list">
        <ul>
<?php $commend = tag("moduleid=$moduleid&condition=status=3 AND level=6 &catid=".$catid."&pagesize=6&order=".$MOD['order']."&template=null");?>
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

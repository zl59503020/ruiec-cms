<?php defined('IN_RUIEC') or exit('Access Denied');?><?php include template('header');?>
<div class="boxwrap">
  <div class="left710">
   <!--Content-->
    <div class="main_box">
      
      <dl class="head green">
        <dt>新闻资讯</dt>
        <dd>
          <span>当前位置：<a href="/index.aspx">首页 </a>&gt;<?php echo $MOD['name'];?></span>
        </dd>
      </dl>
      <div class="clear"></div>
      <h1 class="base_tit">分类“<?php echo $MOD['name'];?>”的内容</h1>
  <!--    _substr('string','长度'，‘截取后加的字符串’，‘开始截取的位置’)-->
      <ul class="news_list">
        <?php $lists = tag("moduleid=$moduleid&condition=status=3&pagesize=10&order=".$MOD['order']."&template=null");?>
<!-- <?php print_r($lists);?> -->
<?php if(is_array($lists)) { foreach($lists as $v) { ?>
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
      <div class="flickr">
  <span class="disabled">«上一页</span><span class="current">1</span><a href="/news/6/2.aspx">2</a><a href="/news/6/2.aspx">下一页»</a>
  </div> 
  <!--放置页码列表-->
    </div>
    <!--/Content-->
  </div>
  
  <div class="left264">
    <!--Sidebar-->
    <div class="sidebar">
      <h3>资讯类别</h3>
      <ul class="navbar">
        
        <li>
          <h4><a href="/news/6.aspx">数码产品</a></h4>
          <div class="list">
            
            <a href="/news/8.aspx">平板电脑</a>
            
            <a href="/news/9.aspx">智能手机</a>
            
            <a href="/news/7.aspx">笔记本电脑</a>
            
            <a href="/news/10.aspx">超极本</a>
            
          </div>
        </li>
        
        <li>
          <h4><a href="/news/1.aspx">IT资讯</a></h4>
          <div class="list">
            
            <a href="/news/3.aspx">IT业界</a>
            
            <a href="/news/4.aspx">软媒动态</a>
            
            <a href="/news/5.aspx">科技要闻</a>
            
          </div>
        </li>
        
      </ul>
      <div class="clear"></div>
      <h3>推荐资讯</h3>
      <div class="focus_list">
        <ul>
          
          <li>
            <a title="需求疲软 4GB DDR3内存纷纷跌破百元大关" href="/news/show-62.aspx">
              <img src="/upload/201210/22/201210221025591061.jpg" width="100" height="100" alt="需求疲软 4GB DDR3内存纷纷跌破百元大关" />
              <span>需求疲软 4GB DDR3内存纷纷跌破百元大关</span>
            </a>
          </li>
          
        </ul>
        <div class="clear"></div>
      </div>
      <h3>人气排行</h3>
      <ul class="rank_list">
        
        <li class="active">
        
          <span>10-20</span>
          <i class="num">1</i><a href="/news/show-11.aspx">全球仅此一台！雷蛇星战版Blade游戏本</a>
        </li>
        
      </ul>
    </div>
    <!--/Sidebar-->
  </div>
</div>
<div class="clear"></div>
<?php include template('footer');?>

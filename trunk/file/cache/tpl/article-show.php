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
        <!-- JiaThis Button BEGIN --> 
  <div id="ckepop">
      <span class="jiathis_txt">分享到：</span>
      <a class="jiathis_button_tqq" title="分享到腾讯微博"><span class="jiathis_txt jiathis_separator jtico jtico_tqq">腾讯微博</span></a>
      <a class="jiathis_button_tsina" title="分享到新浪微博"><span class="jiathis_txt jiathis_separator jtico jtico_tsina">新浪微博</span></a>
      <a class="jiathis_button_renren" title="分享到人人网"><span class="jiathis_txt jiathis_separator jtico jtico_renren">人人网</span></a>
      <a class="jiathis_button_email" title="分享到邮件"><span class="jiathis_txt jiathis_separator jtico jtico_email">邮件</span></a>
      <a class="jiathis_button_fav" title="加入收藏夹"><span class="jiathis_txt jiathis_separator jtico jtico_fav">收藏夹</span></a>
      <a class="jiathis_button_copy" title="复制网址"><span class="jiathis_txt jiathis_separator jtico jtico_copy">复制网址</span></a> 
      <a href="http://www.jiathis.com/share/?uid=90225" class="jiathis jiathis_txt jiathis_separator jtico jtico_jiathis" target="_blank">更多</a> 
      <a class="jiathis_counter_style"><span class="jiathis_button_expanded jiathis_counter jiathis_bubble_style" id="jiathis_counter_19" title="累计分享2次">2</span></a> 
  </div> 
  <!-- JiaThis Button END -->
  <script type="text/javascript">var jiathis_config={data_track_clickback:true};</script> 
  <script type="text/javascript" src="http://v2.jiathis.com/code/jia.js?uid=1336353133859589" charset="utf-8"></script><script type="text/javascript" src="http://v2.jiathis.com/code/plugin.client.js" charset="utf-8"></script><div style="position:absolute;width:0px;height:0px;"><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="0" height="0" id="JIATHISSWF" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab"><param name="allowScriptAccess" value="always"><param name="swLiveConnect" value="true"><param name="movie" value="http://www.jiathis.com/code/swf/m.swf"><param name="FlashVars" value="z=a"><embed name="JIATHISSWF" src="http://www.jiathis.com/code/swf/m.swf" flashvars="z=a" width="0" height="0" allowscriptaccess="always" swliveconnect="true" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"></object></div>
      <!--/分享-->
      
      <div class="line10"></div>
      
      <!--同类推荐-->
      <div class="related">
        <h3 class="base_tit">相关资讯</h3>
        <ul class="txt_list">
          
          <div>同类下暂无推荐的资讯...</div>
          
        </ul>
      </div>
      <!--/同类推荐-->
      
      <!--评论-->
      
      <!--/评论-->
      
    </div>
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
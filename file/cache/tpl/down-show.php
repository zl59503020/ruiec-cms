<?php defined('IN_RUIEC') or exit('Access Denied');?><?php include template('header');?>
<div class="m">
<div class="m_l f_l">
<div class="left_box">
<div class="pos">当前位置: <a href="<?php echo $MODULE['1']['linkurl'];?>">首页</a> &raquo; <a href="<?php echo $MOD['linkurl'];?>"><?php echo $MOD['name'];?></a> &raquo; <?php echo cat_pos($CAT, ' &raquo; ');?> &raquo; </div>
<h1 class="title"><?php echo $title;?></h1>
<div class="downinfo">
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
<td width="90"><img src="<?php echo DT_PATH;?>file/ext/icon_<?php echo $fileext;?>.gif" alt="<?php echo $FILETYPE[$fileext];?>"/></td>
<td width="180">
<ul>
<li>文件类型：<?php echo $FILETYPE[$fileext];?></li>
<li>文件大小：<?php echo $filesize;?><?php echo $unit;?></li>
</ul>
</td>
<td>
<ul>
<li>更新日期：<?php echo $adddate;?></li>
<li>浏览次数：<span id="hits"><?php echo $hits;?></span>&nbsp;&nbsp;&nbsp;下载次数：<span id="download"><?php echo $download;?></a></li>
</ul>
</td>
<td width="110"><a href="#downurl"><img src="<?php echo DT_SKIN;?>image/btn_download.gif" alt="进入下载"/></a></td>
</tr>
</table>
</div>
<?php if($content) { ?>
<div class="left_head">详细介绍</div>
<?php if($CP) { ?><?php include template('property', 'chip');?><?php } ?>
<div class="content" id="content"><?php echo $content;?></div>
<div class="b10">&nbsp;</div>
<div class="b10">&nbsp;</div>
<form method="post" action="<?php echo $MODULE['2']['linkurl'];?>sendmail.php" name="sendmail" id="sendmail" target="_blank">
<input type="hidden" name="itemid" value="<?php echo $itemid;?>"/> 
<input type="hidden" name="title" value="<?php echo $title;?>"/>
<input type="hidden" name="linkurl" value="<?php echo $linkurl;?>"/>
</form>
<center>
[ <a href="<?php echo $MOD['linkurl'];?>search.php"><?php echo $MOD['name'];?>搜索</a> ]&nbsp;
[ <script type="text/javascript">addFav('加入收藏');</script> ]&nbsp;
[ <a href="javascript:Dd('sendmail').submit();void(0);">告诉好友</a> ]&nbsp;
[ <a href="javascript:Print();">打印本文</a> ]&nbsp;
[ <a href="javascript:window.close()">关闭窗口</a> ]
</center>
<br/>
<?php } ?>
<div class="left_head">下载地址<a name="downurl"></a></div>
<div id="down"><?php include template('content', 'chip');?></div>
<?php include template('comment', 'chip');?>
</div>
</div>
<div class="m_n f_l">&nbsp;</div>
<div class="m_r f_l">
<?php if($tag) { ?>
<div class="box_head_1"><div><span class="f_r"><a href="<?php echo $MOD['linkurl'];?><?php echo rewrite('search.php?kw='.urlencode($tag));?>">更多..</a></span><strong>相关<?php echo $MOD['name'];?></strong></div></div>
<div class="box_body">
<?php echo tag("moduleid=$moduleid&condition=status=3 and tag='$tag' and addtime>$addtime&areaid=$cityid&pagesize=5&order=addtime desc&template=list-down", -2);?>
<?php echo tag("moduleid=$moduleid&condition=status=3 and tag='$tag' and addtime<$addtime&areaid=$cityid&pagesize=5&order=addtime desc&template=list-down", -2);?>
</div>
<div class="b10"></div>
<?php } ?>
<div class="box_head_1"><div><strong>推荐<?php echo $MOD['name'];?></strong></div></div>
<div class="box_body">
<?php echo tag("moduleid=$moduleid&condition=status=3 and level>0&areaid=$cityid&pagesize=10&order=addtime desc&template=list-down", -2);?>
</div>
<div class="b10 c_b"> </div>
<div class="box_head_1"><div><strong>本类下载排行</strong></div></div>
<div class="box_body">
<div class="rank_list"><?php echo tag("moduleid=$moduleid&condition=status=3&catid=$catid&areaid=$cityid&order=download desc&pagesize=10", -2);?></div>
</div>
<div class="b10 c_b"> </div>
<div class="box_head_1"><div><strong>总下载排行</strong></div></div>
<div class="box_body">
<div class="rank_list"><?php echo tag("moduleid=$moduleid&condition=status=3&areaid=$cityid&order=download desc&pagesize=10", -2);?></div>
</div>
</div>
</div>
<?php include template('zoom', 'chip');?>
<?php include template('footer');?>
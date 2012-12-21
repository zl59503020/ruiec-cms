<?php defined('IN_RUIEC') or exit('Access Denied');?><?php if(isset($MOD['comment']) && $MOD['comment'] == 1) { ?>
      <!--评论-->
      <div class="comment_box">
  <h3 class="base_tit"><span><a href="#Add">发表评论</a></span>共有<comment class="sp_comment_count">0</comment>位访客发表了评论</h3>
<ol id="comment_list" class="comment_list">
<li>评论加载中...</li>
</ol>
<div id="comment_page"></div>
  </div>
      <!--/评论-->
      <div class="line20"></div>
  <!--提交评论-->
  <div class="comment_add">
        <h3 class="base_tit">我来说几句吧<a name="Add"></a></h3>
        <form action="/api/comment.php?moduleid=<?php echo $moduleid;?>&itemid=<?php echo $itemid;?>&action=add&v_sm=ruiec" method="post" id="comment_form" name="comment_form" >
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
          验证码：
  <img src="/api/captcha.png.php" alt="captcha" title="点击刷新" onclick="re_captcha(this);" class="input" style="cursor:pointer;" />&nbsp;
  <input type="text" name="captcha" class="input" />&nbsp;
  <input id="btnSubmit" name="submit" class="btn right" type="submit" value="提交评论（Ctrl+Enter）" />&nbsp;&nbsp;&nbsp;
  <span id="sp_cm_wait"></span>
        </div>
        </form>
      </div>
<?php } ?>
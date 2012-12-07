<?php defined('IN_RUIEC') or exit('Access Denied');?><div class="clr"></div>
<div class="footer">
<div class="m">
<div class="foot-nav">
<a href="<?php echo $MODULE['1']['linkurl'];?>">网站首页</a> | 
<a href="<?php echo $MODULE['1']['linkurl'];?>sitemap/">网站地图</a>
</div>
<div class="foot-text">
<?php echo $RE['webcopyright'];?>
</div>
        <div class="clear"></div>
</div>
<?php if(RE_DEBUG) { ?><div class="m debug"><?php echo debug();?></div><?php } ?>
</div>
</body>
</html>
<?php defined('IN_RUIEC') or exit('Access Denied');?><?php include template('header');?>
<script type="text/javascript">var i=30;</script>
<div class="m">
<div class="warn">
<div>
<h1><?php echo $head_title;?></h1><br/>
&nbsp;&nbsp;<span id="second" class="f_red f_b"><script type="text/javascript">document.write(i);</script></span> 秒后将自动跳转到<a href="<?php echo $MOD['linkurl'];?>"><?php echo $MOD['name'];?>首页</a>
<br/><br/>
&nbsp;&nbsp;1、请检查输入的网址是否正确。 <br/>
&nbsp;&nbsp;2、如果不能确认输入的网址，请浏览<a href="<?php echo $MOD['linkurl'];?>"><?php echo $MOD['name'];?>首页</a>来查看所要访问的网址。 <br/>
&nbsp;&nbsp;3、直接输入要访问的内容进行搜索： <br/>
<form action="<?php echo $MOD['linkurl'];?>search.php">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="25" name="kw"/> 
<input type="submit" value="搜索" class="btn"/>
<input type="button" value="高级" class="btn" onclick="window.location='<?php echo $MOD['linkurl'];?>search.php';"/>
</form>
</div>
</div>
</div>
<script type="text/javascript">
var interval=window.setInterval(
function() {
if(i==0) {
Go('<?php echo $MOD['linkurl'];?>');
clearInterval(interval);
} else {
Dd('second').innerHTML=i;
i--;
}
}, 
1000);
</script>
<?php include template('footer');?>
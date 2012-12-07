<?php defined('IN_RUIEC') or exit('Access Denied');?><?php include template('header');?>
<style type="text/css">
*{margin:0px;padding:0px;}
a{font-size:13px;font-color:#ccc;text-decoration:none;}
li{display:list-item;text-align: -webkit-match-parent;font-size:13px;height:25px;line-height:25px;}
</style>
<script>window["_GOOG_TRANS_EXT_VER"] = "1";</script>
<meta http-equiv="refresh" content="10; url=<?php echo RE_PATH;?>">
<div style="margin:50px auto;width:600px;">
<div style="width:100%;font-size:14px;color:#ccc;text-align:left;">404 Error message</div>
<div style="width:100%;min-height:100px;border:1px solid #DCDDDD;text-align:left;padding:10px;padding-top:30px;">
<strong>您正在浏览的网页没有找到,可能已被删除或者转移.[<?php echo $head_title;?>]</strong>
<div style="margin-top:20px;font-size:13px;">请尝试以下操作:</div>
<ol style="margin-left:50px;">
<li>检查网址是否正确</li>
<li>确保浏览器的地址栏中显示的网站地址的拼写和格式正确无误.</li>
<li>如果通过单击链接而到达了该网页，请与网站管理员联系，警告他们该链接的格式不正确.</li>
<li>单击<a href="javascript:history.back(1)">后退</a>按钮尝试另一个链接.</li>
<li>直接访问<a href="<?php echo RE_PATH;?>" style="color:#1e50a2">首页</a></li>
<li>系统在 <span id="sp_time" style="color:red;">10</span> 秒后自动返回首页</li>
</ol>
</div>
<div style="width:100%;font-size:13px;color:#ccc;text-align:right;margin-top:20px;">
<a href="http://www.ruiec.com/" target="_blank" style="color:#ccc;font-size:13px;text-decoration:none;">源中瑞网络传媒</a>
</div>
</div>
<script>
var tm = 10;
function djs(){
tm = tm-1;
document.getElementById('sp_time').innerHTML = tm;
if(tm > 0) setTimeout('djs()',1000);
else window.location = '<?php echo RE_PATH;?>';
}
djs();
</script>
<?php include template('footer');?>
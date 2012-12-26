<?php 
defined('IN_RUIEC') or exit('Access Denied');
include tpl('header');
?>
<center>
<div id="div_msg" style="margin:50px;">
	<?php echo $msg; ?>
	<br/>
	<div style="f_r">
		<?php if($acturl == "goback") { ?>
		<a href="javascript:window.history.back();">[ 点这里返回上一页 ]</a><br/>
		<?php  } elseif ($acturl) {?>
		<a href="<?php echo $acturl;?>">如果您的浏览器没有自动跳转，请点击这里</a><br/>
		<meta http-equiv="refresh" content="<?php echo $time;?>;URL=<?php echo $acturl;?>">
		<?php } ?>
	</div>
</div>
</center>
<script type="text/javascript">
	$(function () {
		art.dialog({
			title: '提示信息',
			lock: true,
			background: '#fff',
			opacity: 0.5,
			content: document.body.innerHTML,
			ok: function(){
			<?php if($acturl == "goback") { ?>
				window.history.back();
			<?php  } elseif ($acturl) {?>
				window.location = '<?php echo $acturl; ?>';
			<?php } ?>
			}
		});
    });
</script>
<?php include tpl('footer'); ?>
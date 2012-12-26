<?php
defined('IN_RUIEC') or exit('Access Denied');
include tpl('header');
?>

	<div class="navigation">首页 &gt; 控制面板 &gt; <a href="?file=<?php echo $file; ?>">系统模型管理</a> &gt; 编辑模块 </div>
	
	<div id="contentTab">

		<form action="" method="post" id="myform" name="myform" >

			<div>
				<table class="form_table">
					<col width="180px"></col>
					<tbody>
						<tr>
							<th>模块类型</th>
							<td>
								<?php echo $islink ? '外部链接' : '内置模型('.$modulename.$module.')'?>
							</td>
						</tr>
						<tr>
							<th>模块名称</th>
							<td>
								<input name="post[name]" type="text" id="name" size="10" value="<?php echo $name;?>" class="txtInput normal required" />
							</td>
						</tr>
						<tr>
							<th>导航菜单</th>
							<td>
								<input type="radio" name="post[ismenu]" value="1" <?php if($ismenu) echo 'checked';?> /> 是&nbsp;&nbsp;&nbsp;&nbsp; 
								<input type="radio" name="post[ismenu]" value="0" <?php if(!$ismenu) echo 'checked';?> /> 否
							</td>
						</tr>
						<tr>
							<th>新窗口打开</th>
							<td>
								<input type="radio" name="post[isblank]" value="1" <?php if($isblank) echo 'checked';?>/> 是&nbsp;&nbsp;&nbsp;&nbsp; 
								<input type="radio" name="post[isblank]" value="0" <?php if(!$isblank) echo 'checked';?>> 否
							</td>
						</tr>
<?php
				if($islink) { 
?>
						<tr>
							<th>链接地址</th>
							<td>
								<input name="post[linkurl]" type="text" id="linkurl" size="40" value="<?php echo $linkurl;?>" class="txtInput normal url required" />
							</td>
						</tr>
<?php
				} else {
?>
						<tr>
							<th>安装目录</th>
							<td>
								<input name="post[moduledir]" type="text" id="moduledir" size="30" value="<?php echo $moduledir;?>" class="txtInput normal required" />
								<input type="button" class="btnSearch" value="目录检测" onclick="ckDir();">
								<?php echo tips('限英文、数字、中划线、下划线'); ?><br />
								提示:如果不是十分必要，建议不要频繁更改安装目录
							</td>
						</tr>
						<tr>
							<th>绑定域名</th>
							<td>
								<input name="post[domain]" type="text" size="30" value="<?php echo $domain;?>" class="txtInput normal url" />
								<?php echo tips('例如http://news.ruiec.com/ <br />以 / 结尾.如果不绑定请勿填写'); ?>
							</td>
						</tr>
<?php
				}
?>
					</tbody>
				</table>
			</div>

			<div class="foot_btn_box">
				<input type="hidden" name="file" value="<?php echo $file; ?>" />
				<input type="hidden" name="action" value="edit" />
				<input type="hidden" name="v_ruiec_sm" value="ruiec" />
				<input name="提交" type="submit" value="提交保存" class="btnSubmit" />&nbsp;
				<input name="重置" type="reset" class="btnSubmit" value="重 置" />
			</div>

		</form>
		
	</div>
<script type="text/javascript">
    //表单验证
    $(function () {
       form_check_init('','',{title:'修改'});
    });
	function ckDir(){
		if($('#moduledir').val() == ''){
			alert('请填写安装目录!');
			$('#moduledir').focus();
		}else{
			var tckdircon = '<form method="POST" id="fm_check_dir" action="?file=<?php echo $file; ?>&action=ckdir&v_ruiec_ckdir=ruiec&ck_dir='+$('#moduledir').val()+'" ></form>';

			art.dialog({
				id: 'art_check_dir',
				title: '检测目录',
				lock: true,
				background: '#fff',
				opacity: 0.5,
				ok: true
			});
		
			art.dialog({id:'send_ckdir_temp',content:tckdircon,show:false});
		
			$('#fm_check_dir').ajaxForm({
				success: function(responseText, statusText, xhr, $form){
					art.dialog.list['art_check_dir'].content(responseText);
					art.dialog.list['send_ckdir_temp'].close();
				}
			}); 
			$('#fm_check_dir').submit();
		}
	}
</script>
<?php include tpl('footer'); ?>
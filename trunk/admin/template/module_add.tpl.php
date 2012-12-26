<?php
defined('IN_RUIEC') or exit('Access Denied');
include tpl('header');
?>
	<div class="navigation">首页 &gt; 控制面板 &gt; <a href="?file=<?php echo $file; ?>">系统模型管理</a> &gt; 添加模块 </div>
	
	<div id="contentTab">

		<form action="" method="post" id="myform" name="myform" >

			<div>
				<table class="form_table">
					<col width="180px"></col>
					<tbody>
						<tr>
							<th>模块类型</th>
							<td>
								<input type="radio" name="post[islink]" value="0" onclick="$('#link0').show();$('#link1').hide();" checked=""> 内置模型 <input type="radio" name="post[islink]" value="1" onclick="$('#link0').hide();$('#link1').show();"> 外部链接
							</td>
						</tr>
						<tr>
							<th>模块名称</th>
							<td>
								<input name="post[name]" type="text" id="name" size="10" class="txtInput normal required" />
							</td>
						</tr>
						<tr>
							<th>导航菜单</th>
							<td>
								<input type="radio" name="post[ismenu]" value="1" checked=""> 是&nbsp;&nbsp;&nbsp;&nbsp; 
								<input type="radio" name="post[ismenu]" value="0"> 否
							</td>
						</tr>
						<tr>
							<th>新窗口打开</th>
							<td>
								<input type="radio" name="post[isblank]" value="1"> 是&nbsp;&nbsp;&nbsp;&nbsp; 
								<input type="radio" name="post[isblank]" value="0" checked=""> 否
							</td>
						</tr>
					</tbody>
					<tbody id="link1" style="display: none;">
						<tr>
							<th>链接地址</th>
							<td>
								<input name="post[linkurl]" type="text" id="linkurl" size="40" class="txtInput normal url required" />
							</td>
						</tr>
					</tbody>
					<tbody id="link0">
						<tr>
							<th>所属模型</th>
							<td>
								<?php echo $module_select; ?>
							</td>
						</tr>
						<tr>
							<th>安装目录</th>
							<td>
								<input name="post[moduledir]" type="text" id="moduledir" size="30" class="txtInput normal required" />
								<input type="button" class="btnSearch" value="目录检测" onclick="ckDir();">
								<?php echo tips('限英文、数字、中划线、下划线'); ?>
							</td>
						</tr>
						<tr>
							<th>绑定域名</th>
							<td>
								<input name="post[domain]" type="text" size="30" class="txtInput normal url" />
								<?php echo tips('例如http://news.ruiec.com/ <br />以 / 结尾.如果不绑定请勿填写'); ?>
							</td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="foot_btn_box">
				<input type="hidden" name="file" value="<?php echo $file; ?>" />
				<input type="hidden" name="action" value="add" />
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

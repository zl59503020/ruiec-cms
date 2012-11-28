﻿<?php
defined('IN_RUIEC') or exit('Access Denied');
include tpl('header');
?>
	<div class="navigation">首页 &gt; <?php echo $MOD['name']; ?>管理 &gt; <?php echo (isset($itemid) ? '编辑' : '添加').$MOD['name']; ?></div>

	<div id="contentTab">

		<form action="" method="post" id="myform" name="myform" enctype="multipart/form-data">

			<div>
				<table class="form_table">
					<col width="180px"></col>
					<tbody>
						<tr>
							<th>所属分类：</th>
							<td><input type="text" name="config[url]" value="" class="txtInput normal required" /></td>
						</tr>
						<tr>
							<th>标题：</th>
							<td>
								<input type="text" name="config[url]" value="" class="txtInput normal required" />
							</td>
						</tr>
						<tr>
							<th>标题图片：</th>
							<td>
								<input type="text" id="weblogo" name="setting[weblogo]" value="" class="txtInput normal f_l" />
								<span><a href="javascript:upfile('weblogo',100,100,true);" class="files"></a></span>
								<span style="margin:0px 5px;"><a href="javascript:showImg($('#weblogo').val());">预览</a></span>
							</td>
						</tr>
						<tr>
							<th>内容:</th>
							<td>
								<textarea name="post[content]" id="content" style="width:90%;height:400px;"><?php echo $content;?></textarea>
								<?php start_editor('content');?>
							</td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="foot_btn_box">
				<input type="hidden" name="file" value="<?php echo $file; ?>" />
				<input type="hidden" name="action" value="<?php echo $action; ?>" />
				<input type="hidden" name="action" value="save" />
				<input type="hidden" name="v_ruiec_sm" value="ruiec" />
				<input name="提交" type="submit" value="提交保存" class="btnSubmit" />&nbsp;
				<input name="重置" type="reset" class="btnSubmit" value="重 置" />
			</div>

		</form>
		
	</div>

<?php include tpl('footer');?>
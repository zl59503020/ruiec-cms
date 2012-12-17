<?php include tpl('header'); ?>

	<div class="navigation">首页 &gt; 控制面板 &gt; 查看评论详细</div>

	<div id="contentTab">

		<ul class="tab_nav">
			<li class="selected">评论详细信息</li>
		</ul>
		
		<form action="" method="post" id="myform" name="myform" enctype="multipart/form-data">
		
			<!--	网站基本设置	-->
			<div class="tab_con" style="display:block;">
				<table class="form_table">
					<col width="180px"></col>
					<tbody>
						<tr>
							<th>站点名称：</th>
							<td><input type="text" id="sitename" name="setting[sitename]" value="" class="txtInput normal required" /></td>
						</tr>
						<tr>
							<th>网站地址：</th>
							<td>
								<input type="text" name="config[url]" value="" class="txtInput normal required url" />
							</td>
						</tr>
						<tr>
							<th>网站Logo：</th>
							<td>
								<input type="text" id="weblogo" name="setting[weblogo]" value="" class="txtInput normal f_l" />
							</td>
						</tr>
						<tr>
							<th>ICP备案序号:</th>
							<td><input type="text" id="webcrod" name="setting[webcrod]" value="" class="txtInput normal" /></td>
						</tr>
						<tr>
							<th>底部版权信息：</th>
							<td>
								<textarea id="webcopyright" name="setting[webcopyright]" class="small" cols="20" rows="2" ></textarea>
								<?php echo tips('支持HTML格式'); ?>
							</td>
						</tr>
						<tr>
							<th>公司名称：</th>
							<td><input type="text" id="webcompany" name="setting[webcompany]" value="" class="txtInput normal" /></td>
						</tr>
						<tr>
							<th>默认编辑器：</th>
							<td>
								<input type="radio" name="setting[editor]" value="ueditor" checked > ueditor &nbsp;&nbsp;
								<input type="radio" name="setting[editor]" value="kindeditor" > kindeditor
							</td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="foot_btn_box">
				<input type="hidden" name="file" value="<?php echo $file; ?>" />
				<input type="hidden" name="action" value="save" />
				<input type="hidden" name="v_ruiec_sm" value="ruiec" />
				<input name="提交" type="submit" value="提交保存" class="btnSubmit" />&nbsp;
				<input name="重置" type="reset" class="btnSubmit" value="重 置" />
			</div>

		</form>
		
	</div>
	
<?php include tpl('footer'); ?>

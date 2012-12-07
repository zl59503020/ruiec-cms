<?php
defined('IN_RUIEC') or exit('Access Denied');
include tpl('header');
?>
	<div class="navigation">首页 &gt; <?php echo $MOD['name']; ?>管理 &gt; 模块设置</div>
	
	<div id="contentTab">

		<ul class="tab_nav">
			<li class="selected"><a onclick="tabs('#contentTab',0);" href="javascript:;">基本设置</a></li>
			<li><a onclick="tabs('#contentTab',1);" href="javascript:void(0);">SEO优化</a></li>
			<li><a onclick="tabs('#contentTab',2);" href="javascript:void(0);">权限收费</a></li>
			<li><a onclick="tabs('#contentTab',3);" href="javascript:void(0);">定义字段</a></li>
			<li><a onclick="tabs('#contentTab',4);" href="javascript:void(0);">模板管理</a></li>
		</ul>
		
		<form action="" method="post" id="myform" name="myform" enctype="multipart/form-data">
			<!--	网站基本设置	-->
			<div class="tab_con" style="display:block;">
				<table class="form_table">
					<col width="180px"></col>
					<tbody>
						<tr>
							<th>站点名称1：</th>
							<td><input type="text" id="sitename" name="setting[sitename]" value="" class="txtInput normal required" /></td>
						</tr>
					</tbody>
				</table>
			</div>
			
			<!--	SEO优化	-->
			<div class="tab_con" style="display:none;">
				<table class="form_table">
					<col width="180px"></col>
					<tbody>
						<tr>
							<th>站点名称2：</th>
							<td><input type="text" id="sitename" name="setting[sitename]" value="" class="txtInput normal required" /></td>
						</tr>
					</tbody>
				</table>
			</div>
			
			<!--	权限收费	-->
			<div class="tab_con" style="display:none;">
				<table class="form_table">
					<col width="180px"></col>
					<tbody>
						<tr>
							<th>站点名称3：</th>
							<td><input type="text" id="sitename" name="setting[sitename]" value="" class="txtInput normal required" /></td>
						</tr>
					</tbody>
				</table>
			</div>
			
			<!--	定义字段	-->
			<div class="tab_con" style="display:none;">
				<table class="form_table">
					<col width="180px"></col>
					<tbody>
						<tr>
							<th>站点名称4：</th>
							<td><input type="text" id="sitename" name="setting[sitename]" value="" class="txtInput normal required" /></td>
						</tr>
					</tbody>
				</table>
			</div>
			
			<!--	模板管理	-->
			<div class="tab_con" style="display:none;">
				<table class="form_table">
					<col width="180px"></col>
					<tbody>
						<tr>
							<th>站点名称5：</th>
							<td><input type="text" id="sitename" name="setting[sitename]" value="" class="txtInput normal required" /></td>
						</tr>
					</tbody>
				</table>
			</div>
		
		</form>

<?php include tpl('footer');?>
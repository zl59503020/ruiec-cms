<?php
defined('IN_RUIEC') or exit('Access Denied');
include tpl('header');

?>

	<div class="navigation">首页 &gt; 控制面板 &gt; <a href="javascript:;" onclick="_url('?file=<?php echo $file; ?>',{n:'sys_manager',t:'管理员管理'});">管理员管理</a> &gt; 添加管理员 </div>
	<div id="contentTab">

		<form action="" method="post" id="myform" name="myform" >

			<div>
				<table class="form_table">
					<col width="180px"></col>
					<tbody>
						<tr>
							<th>管理员分组</th>
							<td>
								<select name="post[groupid]" class="txtInput normal required">
									<option value="">请选择分组...</option>
						<?php	foreach($groups as $v){ ?>
									<option value="<?php echo $v['itemid']; ?>"><?php echo $v['name']; ?></option>
						<?php 	} ?>
								</select>
							</td>
						</tr>
						<tr>
							<th>用户名</th>
							<td>
								<input type="text" name="post[username]" class="txtInput normal required" />
							</td>
						</tr>
						<tr>
							<th>密码</th>
							<td>
								<input type="password" id="v_pwd" name="post[password]" class="txtInput normal required" />
							</td>
						</tr>
						<tr>
							<th>确认密码</th>
							<td>
								<input type="password" class="txtInput normal required" />
							</td>
						</tr>
						<tr>
							<th>邮箱</th>
							<td>
								<input type="text" name="post[email]" class="txtInput normal email required" />
							</td>
						</tr>
						<tr>
							<th>冻结</th>
							<td>
								<input type="radio" name="post[status]" value="1" checked /> 是&nbsp;&nbsp;&nbsp;&nbsp; 
								<input type="radio" name="post[status]" value="0" /> 否
							</td>
						</tr>
						<tr>
							<th>真实姓名</th>
							<td>
								<input type="text" name="post[truename]" class="txtInput normal" />
							</td>
						</tr>
						<tr>
							<th>性别</th>
							<td>
								<input type="radio" name="post[sex]" value="1" checked /> 男&nbsp;&nbsp;&nbsp;&nbsp; 
								<input type="radio" name="post[sex]" value="0" /> 女
							</td>
						</tr>
						<tr>
							<th>公司</th>
							<td>
								<input type="text" name="post[truename]" class="txtInput normal" />
							</td>
						</tr>
						<tr>
							<th>电话</th>
							<td>
								<input type="text" name="post[phone]" class="txtInput normal" />
							</td>
						</tr>
						<tr>
							<th>QQ号码</th>
							<td>
								<input type="text" name="post[qq]" class="txtInput normal" />
							</td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="foot_btn_box">
				<input type="hidden" name="file" value="<?php echo $file; ?>" />
				<input type="hidden" name="action" value="<?php echo $action; ?>" />
				<input type="hidden" name="v_ruiec_sm" value="ruiec" />
				<input name="提交" type="submit" value="提交保存" class="btnSubmit" />&nbsp;
				<input name="重置" type="reset" class="btnSubmit" value="重 置" />
			</div>

		</form>
		
	</div>
<script type="text/javascript">
   //表单验证
    $(function () {
       form_check_init('','',{title:'添加'});
    });

</script>

<?php include tpl('footer'); ?>

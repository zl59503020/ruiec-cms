<?php
defined('IN_RUIEC') or exit('Access Denied');
include tpl('header');

?>

	<div class="navigation">首页 &gt; 控制面板 &gt; <a href="javascript:;" onclick="_url('?file=<?php echo $file; ?>',{n:'sys_manager',t:'管理员管理'});">管理员管理</a> &gt; 编辑管理员 </div>
	<div id="contentTab">

		<form action="" method="post" id="myform" name="myform" >

			<div>
				<table class="form_table">
					<col width="180px"></col>
					<tbody>
						<tr>
							<th>管理员分组</th>
							<td>
								<?php echo $groupname; ?>
							</td>
						</tr>
						<tr>
							<th>用户名</th>
							<td>
								<?php echo $username; ?>
							</td>
						</tr>
						<tr>
							<th>新密码</th>
							<td>
								<input type="password" name="post[password]" value="" class="txtInput normal" />
								<?php echo tips('如果不修改密码请勿修改!'); ?>
							</td>
						</tr>
						<tr>
							<th>原密码</th>
							<td>
								<input type="password" name="post[passwords]" value="" class="txtInput normal" />
							</td>
						</tr>
						<tr>
							<th>邮箱</th>
							<td>
								<input type="text" name="post[email]" value="<?php echo $email; ?>" class="txtInput normal email required" />
							</td>
						</tr>
						<tr>
							<th>冻结</th>
							<td>
								<input type="radio" name="post[status]" value="0" <?php echo $status == '0' ? 'checked' : ''; ?> /> 是&nbsp;&nbsp;&nbsp;&nbsp; 
								<input type="radio" name="post[status]" value="1" <?php echo $status == '1' ? 'checked' : ''; ?> /> 否
							</td>
						</tr>
						<tr>
							<th>真实姓名</th>
							<td>
								<input type="text" name="post[truename]" value="<?php echo $truename; ?>" class="txtInput normal" />
							</td>
						</tr>
						<tr>
							<th>性别</th>
							<td>
								<input type="radio" name="post[sex]" value="1" <?php echo $sex=='1'?'checked':''; ?> /> 男&nbsp;&nbsp;&nbsp;&nbsp; 
								<input type="radio" name="post[sex]" value="0" <?php echo $sex == '0' ? 'checked' : ''; ?> /> 女
							</td>
						</tr>
						<tr>
							<th>公司</th>
							<td>
								<input type="text" name="post[company]" value="<?php echo $company; ?>" class="txtInput normal" />
							</td>
						</tr>
						<tr>
							<th>电话</th>
							<td>
								<input type="text" name="post[phone]" value="<?php echo $phone; ?>" class="txtInput normal" />
							</td>
						</tr>
						<tr>
							<th>QQ号码</th>
							<td>
								<input type="text" name="post[qq]" value="<?php echo $qq; ?>" class="txtInput normal" />
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
       form_check_init('','',{title:'修改'});
    });

</script>

<?php include tpl('footer'); ?>

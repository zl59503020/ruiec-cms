<?php
defined('IN_RUIEC') or exit('Access Denied');
include tpl('header');
?>
	<div class="navigation">首页 &gt; 自定义字段管理 &gt; 编辑字段 </div>
	
	<div class="tools_box">
		<div class="tools_bar">
			<a href="javascript:;" onclick="_url('?file=<?php echo $file;?>&tbname=<?php echo $tbname; ?>',{n:'sys_fields_m_<?php echo $RE_PRE.$tbname; ?>',t:'自定义字段管理'});" class="tools_btn"><span><b class="add">自定义字段管理</b></span></a>
		</div>
	</div>

	<div id="contentTab">

		<form action="" method="post" id="myform" name="myform" >

			<div>
				<table class="form_table">
					<col width="180px"></col>
					<tbody>
						<tr>
							<th>字段</th>
							<td>
								<input name="post[name]" type="text" id="name" size="20" value="<?php echo $name; ?>" class="txtInput normal required"/>
								小写字母(a-z),数字(0-9) 推荐使用字母,不能以数字开头
							</td>
						</tr>
						<tr>
							<th>字段名称</th>
							<td>
								<input name="post[title]" type="text" id="title" size="20" value="<?php echo $title; ?>" class="txtInput normal required" />
								<?php tips('建议使用中文');?> 
							</td>
						</tr>
						<tr>
							<th>提示信息</th>
							<td>
								<input name="post[note]" type="text" id="note" value="<?php echo $note; ?>" size="50" class="txtInput" />
							</td>
						</tr>
						<tr>
							<th>字段属性</th>
							<td>
								<select name="post[type]" class="select" onchange="_cktype(this.value);">
									<option value="varchar" <?php if($type == 'varchar') echo 'selected'; ?>>字符(Varchar)</option>
									<option value="int" <?php if($type == 'int') echo 'selected'; ?>>整数(Int)</option>
									<option value="float" <?php if($type == 'float') echo 'selected'; ?>>小数(Float)</option>
									<option value="text" <?php if($type == 'text') echo 'selected'; ?>>文本(Text)</option>
								</select>
							</td>
						</tr>
						<tr id="tr_length">
							<th>字段长度</th>
							<td>
								<input name="post[length]" type="text" id="length" class="txtInput" value="<?php echo $length; ?>"size="20" value="255" />
							</td>
						</tr>
						<tr>
							<th>表单类型</th>
							<td>
								<select name="post[html]" class="select" onchange="_ckhtml(this.value)">
									<option value="text" <?php if($html == 'text') echo 'selected'; ?>>单行文本(text)</option>
									<option value="textarea" <?php if($html == 'textarea') echo 'selected'; ?>>多行文本(textarea)</option>
									<option value="select" <?php if($html == 'select') echo 'selected'; ?>>下拉框(select)</option>
									<option value="radio" <?php if($html == 'radio') echo 'selected'; ?>>单选框(radio)</option>
									<option value="checkbox" <?php if($html == 'checkbox') echo 'selected'; ?>>多选框(checkbox)</option>
									<option value="hidden" <?php if($html == 'hidden') echo 'selected'; ?>>隐藏域(hidden)</option>
								</select>
							</td>
						</tr>
						<tr>
							<th>默认值</th>
							<td><textarea name="post[default_value]" style="width:500px;height:100px;overflow:visible;"><?php echo $default_value; ?></textarea></td>
						</tr>
						<tr id="tr_option" <?php if(in_array($html,array('text','textarea','hidden'))){ ?>style="display:none;"<?php } ?>>
							<th>选项值</th>
							<td>
								<textarea name="post[option_value]" style="width:500px;height:100px;overflow:visible;"><?php echo $option_value; ?></textarea>
								<br/>一行一个 选项值|选项名称* 注意*为结尾标志符
							</td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="foot_btn_box">
				<input type="hidden" name="file" value="<?php echo $file; ?>" />
				<input type="hidden" name="tbname" value="<?php echo $tbname; ?>" />
				<input type="hidden" name="post[tbname]" value="<?php echo $tbname;?>"/>
				<input type="hidden" name="post[cname]" value="<?php echo $name;?>"/>
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
	
	function _cktype(id){
		if(id == 'varchar') {
			$('#tr_length').show();
			$('#length').value = '255';
		} else if(id == 'int') {
			$('#tr_length').show();
			$('#length').value = '10';
		} else if(id == 'float') {
			$('#tr_length').hide();
			$('#length').value = '';
		} else if(id == 'text') {
			$('#tr_length').hide(); 	
			$('#length').value = '';
		}
	}
	
	function _ckhtml(id){
		if(id == 'select' || id == 'radio' || id == 'checkbox') {
			$('#tr_option').show();
		}else {
			$('#tr_option').hide();
		}
	}
	
</script>

<?php include tpl('footer');?>
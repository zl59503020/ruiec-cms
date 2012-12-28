<?php
defined('IN_RUIEC') or exit('Access Denied');
include tpl('header');

$_glob_cps = array(
				'config' => '查看系统配置',
				'a' => '查看系统配置',
				'b' => '查看系统配置',
				'c' => '查看系统配置',
				'd' => '查看系统配置',
				'e' => '查看系统配置',
				'f' => '查看系统配置',
				'g' => '查看系统配置',
				'h' => '查看系统配置');

?>
<style type="text/css">
.cpul{}
.cpul li{float:left;width:150px;margin:10px;}
#contentTab{margin-top:20px;}
</style>
	<div class="navigation">首页 &gt; 控制面板 &gt; <a href="javascript:;" onclick="_url('?file=<?php echo $file; ?>',{n:'sys_group',t:'分组管理'});">分组管理</a> &gt; 添加分组 </div>
	<div id="contentTab">

		<form action="" method="post" id="myform" name="myform" >

			<div>
				<table class="form_table">
					<col width="180px"></col>
					<tbody>
						<tr>
							<th>分组名称</th>
							<td>
								<input type="text" name="post[name]" value="<?php echo $name; ?>" size="10" class="txtInput normal required" />
							</td>
						</tr>
						<tr>
							<th>权限管理</th>
							<td>
								<strong>系统权限</strong><input type="checkbox" _val="2" />所有
								<ul class="cpul">
<?php
								foreach($_glob_cps as $k=>$v){ 
									$checked = isset($competence[$k]) ? 'checked' : '';
?>
									<li>
										<input type="checkbox" name="post[competence][<?php echo $k; ?>]" value="1" <?php echo $checked; ?> /><?php echo $v; ?>
									</li>
						<?php	} ?>
								</ul>
								<div class="clr"></div>
								<strong>模块权限</strong>
								<table border='1' width="90%">
									<tr>
										<td>模块名称</td>
										<td><input type="checkbox" _val="0" _o="insert" />添加</td>
										<td><input type="checkbox" _val="0" _o="delete" />删除</td>
										<td><input type="checkbox" _val="0" _o="update" />编辑</td>
										<td><input type="checkbox" _val="0" _o="select" />查看</td>
										<td><input type="checkbox" _val="0" _o="setting" />模块设置</td>
									</tr>
<?php
								foreach($modules as $v){
									$mdck = 'post[competence][module]['.$v['moduleid'].']';
									$_temp = isset($competence['module'][$v['moduleid']]) ? $competence['module'][$v['moduleid']] : array();
?>
									<tr>
										<td><input type="checkbox" _val="1" /><?php echo $v['name']; ?></td>
										<td>
											<input type="checkbox" name="<?php echo $mdck; ?>[insert]" value="1" _o="insert" <?php echo isset($_temp['insert']) ? 'checked' : ''; ?> />(INSERT)
										</td>
										<td>
											<input type="checkbox" name="<?php echo $mdck; ?>[delete]" value="1" _o="delete" <?php echo isset($_temp['delete']) ? 'checked' : ''; ?> />(DELETE)
										</td>
										<td>
											<input type="checkbox" name="<?php echo $mdck; ?>[update]" value="1" _o="update" <?php echo isset($_temp['update']) ? 'checked' : ''; ?> />(UPDATE)
										</td>
										<td>
											<input type="checkbox" name="<?php echo $mdck; ?>[select]" value="1" _o="select" <?php echo isset($_temp['select']) ? 'checked' : ''; ?> />(SELECT)
										</td>
										<td>
											<input type="checkbox" name="<?php echo $mdck; ?>[setting]" value="1" _o="setting" <?php echo isset($_temp['setting']) ? 'checked' : ''; ?> />(SETTING)
										</td>
									</tr>
<?php
								}
?>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="foot_btn_box">
				<input type="hidden" name="file" value="<?php echo $file; ?>" />
				<input type="hidden" name="action" value="<?php echo $action; ?>" />
				<input type="hidden" name="v_ruiec_sm" value="ruiec" />
				<a href="javascript:void(0);" onclick="_checkAll(true);" >全选</a>&nbsp;&nbsp;&nbsp;
				<a href="javascript:void(0);" onclick="_checkAll('!');" >反选</a>&nbsp;&nbsp;&nbsp;
				<a href="javascript:void(0);" onclick="_checkAll(false);" >全不选</a>&nbsp;&nbsp;&nbsp;
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
	
	// 点击
	function _c(elem){
		if(z.att(elem,'_val') == '0'){
			var ipts = z.$('<input> [_o='+z.att(elem,'_o')+']');
			check_ck(ipts,elem);
		}
		if(z.att(elem,'_val') == '1'){
			var tricks = z.$('<input> [type=checkbox]',elem.parentElement.parentElement);
			check_ck(tricks,elem);
		}
		if(z.att(elem,'_val') == '2'){
			var lis = z.$('.cpul <input> [type=checkbox]');
			check_ck(lis,elem);
		}
	}
	
	function _checkAll(v){
		var cks = z.$('<input> [type=checkbox] [value=1]');
		for(var i in cks){
			if(v == '!')cks[i].checked = !cks[i].checked;
			else cks[i].checked = v;
		}
	}
	
	function check_ck(list,elem){
		for(var i in list){
			if(list[i] != elem){
				list[i].checked = elem.checked;
			}
		}
	}
	
	var _allck = z.$('<input> [type=checkbox]');
	for(var i in _allck){
		if(z.att(_allck[i],'value') != '1'){
			z.att(_allck[i],'onclick',function(){_c(this);});
		}
	}
	
</script>

<?php include tpl('footer'); ?>

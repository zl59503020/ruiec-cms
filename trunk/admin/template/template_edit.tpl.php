<?php
defined('IN_RUIEC') or exit('Access Denied');
include tpl('header');
?>

	<div class="navigation">首页 &gt; 控制面板 &gt; <a href="?file=<?php echo $file; ?>模板管理</a> &gt; 编辑模板</div>
	
	<div class="tools_box">
		<div class="tools_bar">
			<a href="?file=template" class="tools_btn"><span><b class="add">模板管理</b></span></a>
			<a href="?file=skin" class="tools_btn"><span><b class="add">皮肤管理</b></span></a>
		</div>
	</div>

	<div class="tab_nav tab_nav_ex">编辑模板</div>
	
	<form action="" method="post" id="myform" name="myform" enctype="multipart/form-data">
		
		<table class="form_table">
			<col width="180px"></col>
			<tbody>
				<tr>
					<th>模板路径: </th>
					<td><?php echo $template_path.$fileid;?>.htm</td>
				</tr>
				<tr>
					<th>模板名称: </th>
					<td>
						<input type="text" size="20" name="name" value="<?php echo $name;?>" class="txtInput normal required" />
						<?php echo tips("可以为中文"); ?>
					</td>
				</tr>
				<tr>
					<th>文件名: </th>
					<td>
						<input type="text" size="20" name="fileid" value="<?php echo $fileid;?>" class="txtInput normal required" />.htm 
						<?php echo tips('只能为小写字母、数字、中划线、下划线'); ?>
					</td>
				</tr>
			</tbody>
		</table>

		<div class="foot_btn_box" style="text-align:left;">
			<textarea name="content" id="content" class="required" style="width:98%;height:300px;overflow:visible;border:1px solid #ccc;"><?php echo $content;?></textarea>
			<div class="f_r">
				<a href="javascript:;" onclick="if(editor != null){editor.undo();}" >撤 销</a>&nbsp;&nbsp;
				<a href="javascript:;" onclick="if(editor != null){editor.redo();}" >恢 复</a>&nbsp;&nbsp;
			</div>
		</div>
		
		<?php include tpl('code_color'); ?>
		
		<div class="foot_btn_box" style="text-align:left;">
			<input type="hidden" name="file" value="<?php echo $file; ?>" />
			<input type="hidden" name="action" value="<?php echo $action;?>" />
			<input type="hidden" name="dir" value="<?php echo $dir;?>"/>
			<input type="hidden" name="srfileid" value="<?php echo $fileid;?>" />
			<input type="hidden" name="v_ruiec_sm" value="ruiec" />
			<input type="checkbox" name="backup" value="1" /> 保存时，创建一个备份文件&nbsp;&nbsp;
			<input type="submit" value="保 存 模 板" onclick="if(editor != null) $('#content').val(editor.getValue());" class="btnSubmit" />&nbsp;
			<input type="button" value="预 览" class="btnSearch" onclick="tp_Preview();"/>&nbsp;&nbsp;
			<input type="reset" class="btnSearch" value="重 置" onclick="load_code_color();" />
		</div>
	</form>
	<form method="post" action="?file=<?php echo $file;?>&action=preview" target="_blank" id="pr">
		<input type="hidden" name="file" value="<?php echo $file;?>"/>
		<input type="hidden" name="action" value="preview"/>
		<input type="hidden" name="dir" value="<?php echo $dir;?>"/>
		<input type="hidden" id="pcontent" name="content" value=""/>
	</form>
	
<script type="text/javascript">
	
	//表单初始化验证
    $(function () {
        form_check_init();
		load_code_color();
    });

	//预览
	function tp_Preview(){
		if(editor != null) $('#content').val(editor.getValue());
		if($('#content').val() == '') {
			art.dialog({
				title: '模板内容为空!',
				lock: true,
				background: '#fff',
				opacity: 0.5,
				content: '模板内容为空<br>请编辑后再预览',
				ok: true
			});
		} else {
			$('#pcontent').val($('#content').val());
			$('#pr').submit();
		}
	}
	
	var editor = null;
	function load_code_color(){
		if(editor == null){
			editor = CodeMirror.fromTextArea(document.getElementById("content"), {
				matchBrackets: true,
				indentUnit: 4,
				indentWithTabs: true,
				enterMode: "keep",
				tabMode: "shift",
				mode : "text/html",
				lineNumbers : true,
				lineWrapping : true
			});
		}else{
			editor.setValue($('#content').val());
		}
	}

</script>
	
	
<?php include tpl('footer');?>
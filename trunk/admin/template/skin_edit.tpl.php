<?php
defined('IN_RUIEC') or exit('Access Denied');
include tpl('header');
?>

	<div class="navigation">首页 &gt; 控制面板 &gt; 皮肤管理</div>
	
	<div class="tools_box">
		<div class="tools_bar">
			<a href="?file=template" class="tools_btn"><span><b class="add">模板管理</b></span></a>
			<a href="?file=skin" class="tools_btn"><span><b class="add">皮肤管理</b></span></a>
			<a href="?file=skin&action=add" class="tools_btn"><span><b class="add">新建CSS</b></span></a>
		</div>
	</div>

	<div class="tab_nav tab_nav_ex">编辑CSS文件</div>
	
	<form action="" method="post" id="myform" name="myform" enctype="multipart/form-data">
		
		<table class="form_table">
			<col width="180px"></col>
			<tbody>
				<tr>
					<th>CSS路径: </th>
					<td><?php echo $skin_path.$fileid;?>.css</td>
				</tr>
				<tr>
					<th>文件名: </th>
					<td>
						<input type="text" size="20" name="refileid" value="<?php echo $fileid;?>" class="txtInput normal required" />.css 
						<?php echo tips('只能为小写字母、数字、中划线、下划线 不支持中文'); ?>
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
			<input type="hidden" name="v_ruiec_sm" value="ruiec" />
			<input type="checkbox" name="backup" value="1" /> 保存时，创建一个备份文件&nbsp;&nbsp;
			<input type="submit" value="保 存 模 板" onclick="if(editor != null) $('#content').val(editor.getValue());" class="btnSubmit" />&nbsp;
			<input type="reset" class="btnSearch" value="重 置" onclick="load_code_color();" />
		</div>
	</form>

<script type="text/javascript">
	
	//表单初始化验证
    $(function () {
        form_check_init();
		load_code_color();
    });

	var editor = null;
	function load_code_color(){
		if(editor == null){
			editor = CodeMirror.fromTextArea(document.getElementById("content"), {
				matchBrackets: true,
				indentUnit: 4,
				indentWithTabs: true,
				enterMode: "keep",
				tabMode: "shift",
				mode : "text/css",
				lineNumbers : true,
				lineWrapping : true
			});
		}else{
			editor.setValue($('#content').val());
		}
	}

</script>
	
	
<?php include tpl('footer');?>
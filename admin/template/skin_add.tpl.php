<?php
defined('IN_RUIEC') or exit('Access Denied');
include tpl('header');
?>

	<div class="navigation">首页 &gt; 控制面板 &gt; <a href="?file=<?php echo $file; ?>">皮肤管理</a> &gt; 新建CSS</div>
	
	<div class="tools_box">
		<div class="tools_bar">
			<a href="?file=template" class="tools_btn"><span><b class="add">模板管理</b></span></a>
			<a href="?file=skin" class="tools_btn"><span><b class="add">皮肤管理</b></span></a>
		</div>
	</div>

	<div class="tab_nav tab_nav_ex">新建CSS文件</div>
	
	<form action="" method="post" id="myform" name="myform" enctype="multipart/form-data">
		
		<table class="form_table">
			<col width="180px"></col>
			<tbody>
				<tr>
					<th>CSS目录: </th>
					<td><?php echo $skin_path;?></td>
				</tr>
				<tr>
					<th>文件名: </th>
					<td>
						<input type="text" size="20" name="fileid" class="txtInput normal required" />.css 
						<?php echo tips('只能为小写字母、数字、中划线、下划线 不支持中文'); ?>
					</td>
				</tr>
			</tbody>
		</table>

		<div class="foot_btn_box" style="text-align:left;">
			<textarea name="content" id="content" class="required" style="width:98%;height:300px;overflow:visible;border:1px solid #ccc;"></textarea>
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
			<input type="checkbox" name="nowrite" value="1" checked /> 如果文件已经存在,请不要覆盖&nbsp;&nbsp;
			<input type="submit" value="创 建 模 板" onclick="if(editor != null) $('#content').val(editor.getValue());" class="btnSubmit" />&nbsp;
			<input type="reset" class="btnSearch" value="重 置" onclick="load_code_color();" />
		</div>
	</form>

<script type="text/javascript">
	
	$(function () {
        $("#myform").validate({
            invalidHandler: function (e, validator) {
                parent.jsprint("有 " + validator.numberOfInvalids() + " 项填写有误，请检查！", "", "Warning");
            },
            errorPlacement: function (lable, element) {
                //可见元素显示错误提示
                if (element.parents(".tab_con").css('display') != 'none') {
                    element.ligerTip({ content: lable.html(), appendIdTo: lable });
                }
            },
            success: function (lable) {
                lable.ligerHideTip();
            }
        });
		$('#myform').ajaxForm({
			beforeSend : function() {art.dialog({id:'lock',title:false,lock:true,background:'#fff',opacity:0.3});},
			success : function(responseText, statusText, xhr, $form){
				art.dialog.list['lock'].close();
				if(statusText == 'success'){
					if(responseText == '0'){
						parent.jsprint("保存成功!", "", "Success");
						window.location = '?file=<?php echo $file; ?>';
					}else{
						parent.jsprint("保存失败!", "", "Error");
						art.dialog({
							title: '保存失败',
							lock: true,
							background: '#fff',
							opacity: 0.5,
							content: responseText,
							ok: true
						});
					}
				}else{
					return true;
				}
			}
		});
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
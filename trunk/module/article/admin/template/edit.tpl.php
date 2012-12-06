<?php
defined('IN_RUIEC') or exit('Access Denied');
include tpl('header');
?>

<script type="text/javascript">
    //表单验证
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
			beforeSend : function() { art.dialog({id:'lock',title:false,lock:true,background:'#fff',opacity:0.3}); },
			success : function(responseText, statusText, xhr, $form){
				art.dialog.list['lock'].close();
				if(statusText == 'success'){
					if(responseText == '0'){
						parent.jsprint("保存成功!", "", "Success");
						window.location = '?file=<?php echo $file; ?>&moduleid=<?php echo $moduleid; ?>';
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
    });
	
</script>


	<div class="navigation">首页 &gt; <?php echo $MOD['name']; ?>管理 &gt; <?php echo (isset($itemid) ? '编辑' : '添加').$MOD['name']; ?></div>

	<div id="contentTab">

		<form action="" method="post" id="myform" name="myform" enctype="multipart/form-data">

			<div>
				<table class="form_table">
					<col width="180px"></col>
					<tbody>
						<tr>
							<th>所属分类：</th>
							<td>
								<?php echo category_select('category[parentid]', '请选择', $catid, $moduleid, 'id="sel_parentid"');?>
								<input type="checkbox" name="post[islink]" value="1" id="islink" <?php if($islink) echo 'checked';?>/> 外部链接
							</td>
						</tr>
						<tr>
							<th>标题：</th>
							<td>
								<input type="text" name="post[title]" value="<?php echo _htmlspecialchars($title); ?>" class="txtInput normal required" />
							</td>
						</tr>
						<tr>
							<th>标题图片：</th>
							<td>
								<input type="text" id="weblogo" name="post[weblogo]" value="<?php echo $thumb; ?>" class="txtInput normal f_l" />
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
	<?php
		foreach($item as $v=>$k){
			if($v != 'title' && $v != 'thumb' && $v != 'content' && $v != 'itemid'){
				echo '<input type="hidden" name="post['.$v.']" value="'.$k.'" />';
			}
		}
	?>
				<input type="hidden" name="file" value="<?php echo $file; ?>" />
				<input type="hidden" name="action" value="<?php echo $action; ?>" />
				<input type="hidden" name="itemid" value="<?php echo $itemid; ?>" />
				<input type="hidden" name="v_ruiec_sm" value="ruiec" />
				<input name="提交" type="submit" value="提交保存" class="btnSubmit" onclick="___initData();" />&nbsp;
				<input name="重置" type="reset" class="btnSubmit" value="重 置" />
			</div>

		</form>
		
	</div>

<?php include tpl('footer');?>
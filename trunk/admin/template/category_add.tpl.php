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
			beforeSend : function() {art.dialog({id:'lock',title:false,lock:true,background:'#fff',opacity:0.3});},
			success : function(responseText, statusText, xhr, $form){
				art.dialog.list['lock'].close();
				if(statusText == 'success'){
					if(responseText == '0'){
						parent.jsprint("添加成功!", "", "Success");
						window.location = '?file=<?php echo $file; ?>&mid=<?php echo $mid; ?>';
					}else{
						parent.jsprint("添加失败!", "", "Error");
						art.dialog({
							title: '添加失败',
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
	
	function ckDir(){
		if($('#catdir').val() == ''){
			alert('请填写安装目录!');
			$('#catdir').focus();
		}else{
			art.dialog({
				id: 'art_ckdir',
				title: '目录检测',
				lock: true,
				background: '#fff',
				opacity: 0.5,
				ok: true
			});
			var url = '?file=<?php echo $file;?>&mid=<?php echo $mid; ?>&action=ckdir&catdir='+$('#catdir').val()+'&parentid='+$('#sel_parentid').val()+'&v_ruiec_ckdir=ruiec';
			$.ajax({
				url:url,
				success:function(responseText){
					artDialog.list['art_ckdir'].content(responseText);
				}
			});
			
		}
	}
	
	
</script>

	<div class="navigation">首页 &gt; 分类管理 &gt; 添加分类 </div>
	
	<div class="tools_box">
		<div class="tools_bar">
			<a href="?file=<?php echo $file;?>&mid=<?php echo $mid; ?>" class="tools_btn"><span><b class="add">分类管理</b></span></a>
		</div>
	</div>

	<div id="contentTab">

		<form action="" method="post" id="myform" name="myform" >

			<div>
				<table class="form_table">
					<col width="180px"></col>
					<tbody>
						<tr>
							<th>上级分类</th>
							<td>
								<?php echo category_select('category[parentid]', '请选择', isset($catid) ? $catid : $parentid, $mid, 'id="sel_parentid"');?><?php tips('如果不选择，则为顶级分类');?>
							</td>
						</tr>
						<tr>
							<th>分类名称</th>
							<td>
								<input name="category[catname]" type="text" class="txtInput normal required" />
							</td>
						</tr>
						<tr>
							<th>分类目录[英文]</th>
							<td>
								<input name="category[catdir]" type="text" id="catdir" class="txtInput normal required" />
								<input type="button" class="btnSearch" value="目录检测" onclick="ckDir();">
								<?php echo tips('限英文、数字、中划线、下划线'); ?>
							</td>
						</tr>
						<tr>
							<th>排序</th>
							<td>
								<input name="category[listorder]" type="text" size="5" class="txtInput normal" />
							</td>
						</tr>
						<tr>
							<th>分类模板</th>
							<td>
								<?php echo tpl_select('list', $MODULE[$mid]['module'], 'category[template]', '默认模板');?>
							</td>
						</tr>
						<tr>
							<th>内容模板</th>
							<td>
								<?php echo tpl_select('show', $MODULE[$mid]['module'], 'category[show_template]', '默认模板');?>
							</td>
						</tr>
						<tr>
							<th>Title</th>
							<td><input name="category[seo_title]" type="text" size="60" class="txtInput normal" /></td>
						</tr>
						<tr>
							<th>Meta Keywords</th>
							<td><textarea name="category[seo_keywords]" cols="60" rows="3" class="small valid" id="seo_keywords"></textarea></td>
						</tr>
						<tr>
							<th>Meta Description</th>
							<td><textarea name="category[seo_description]" cols="60" rows="3" class="small valid" id="seo_description"></textarea></td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="foot_btn_box">
				<input type="hidden" name="file" value="<?php echo $file; ?>" />
				<input type="hidden" name="mid" value="<?php echo $mid; ?>" />
				<input type="hidden" name="action" value="add" />
				<input type="hidden" name="v_ruiec_sm" value="ruiec" />
				<input name="提交" type="submit" value="提交保存" class="btnSubmit" />&nbsp;
				<input name="重置" type="reset" class="btnSubmit" value="重 置" />
			</div>

		</form>
		
	</div>


<?php include tpl('footer');?>
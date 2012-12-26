<?php
defined('IN_RUIEC') or exit('Access Denied');
include tpl('header');
?>

	<div class="navigation">首页 &gt; 分类管理 &gt; 编辑分类 </div>
	
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
								<?php echo category_select('category[parentid]', '请选择', $parentid, $mid, 'id="sel_parentid"');?><?php tips('如果不选择，则为顶级分类');?>
							</td>
						</tr>
						<tr>
							<th>分类名称</th>
							<td>
								<input name="category[catname]" type="text" value="<?php echo $catname; ?>" class="txtInput normal required" />
							</td>
						</tr>
						<tr>
							<th>分类目录[英文]</th>
							<td>
								<input name="category[catdir]" type="text" id="catdir" value="<?php echo $catdir; ?>" class="txtInput normal required" />
								<input type="button" class="btnSearch" value="目录检测" onclick="ckDir();">
								<?php echo tips('限英文、数字、中划线、下划线'); ?>
							</td>
						</tr>
						<tr>
							<th>排序</th>
							<td>
								<input name="category[listorder]" type="text" size="5" value="<?php echo $listorder; ?>" class="txtInput normal" />
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
							<td><input name="category[seo_title]" type="text" size="60" value="<?php echo $seo_title; ?>" class="txtInput normal" /></td>
						</tr>
						<tr>
							<th>Meta Keywords</th>
							<td><textarea name="category[seo_keywords]" cols="60" rows="3" class="small valid" id="seo_keywords"><?php echo $seo_keywords; ?></textarea></td>
						</tr>
						<tr>
							<th>Meta Description</th>
							<td><textarea name="category[seo_description]" cols="60" rows="3" class="small valid" id="seo_description"><?php echo $seo_description; ?></textarea></td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="foot_btn_box">
				<input type="hidden" name="file" value="<?php echo $file; ?>" />
				<input type="hidden" name="mid" value="<?php echo $mid; ?>" />
				<input type="hidden" name="action" value="edit" />
				<input type="hidden" name="v_ruiec_sm" value="ruiec" />
				<input name="提交" type="submit" value="提交保存" class="btnSubmit" />&nbsp;
				<input name="重置" type="reset" class="btnSubmit" value="重 置" />
			</div>

		</form>
		
	</div>

<script type="text/javascript">

	//表单初始化验证
    $(function () {
        form_check_init();
    });
	
	function ckDir(){
		if($('#catdir').val() == ''){
			alert('请填写分类目录!');
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
	
	function tpl_edit(f,d,i){
		var v = document.getElementById('ruiec_template_'+i).firstChild.value;
		var n = v ? v : f;
		window.parent.f_addTab('sys_template', '模板风格', '?file=template&action=edit&fileid='+n+'&dir='+d);
	}
	
	function tpl_add(f,d){
		window.parent.f_addTab('sys_template', '模板风格', '?file=template&action=add&type='+f+'&dir='+d);
	}
	
</script>

<?php include tpl('footer');?>
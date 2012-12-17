<?php
defined('IN_RUIEC') or exit('Access Denied');
include tpl('header');
?>

<script type="text/javascript">

	//表单验证
    $(function () {
        $("#myform_cat").validate({
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
		$('#myform_cat').ajaxForm({
			beforeSend : function() {art.dialog({id:'lock',title:false,lock:true,background:'#fff',opacity:0.3});},
			success : function(responseText, statusText, xhr, $form){
				art.dialog.list['lock'].close();
				if(statusText == 'success'){
					if(responseText == '0'){
						parent.jsprint("更新成功!", "", "Success");
						window.location = '?file=<?php echo $file; ?>&mid=<?php echo $mid; ?>';
					}else{
						parent.jsprint("更新失败!", "", "Error");
						art.dialog({
							title: '更新失败',
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
	
	function _showc(id){
		var trs = $('tr[_id='+id+']');
		(trs[0].style.display == '') ? trs.hide() : trs.show();
	}
	
	function _delete(id){
		art.dialog.confirm('确定要删除该分类吗?<br /><span style="font-size:14px;color:red;">此操作不可恢复!!!<br /><strong>该分类所有子分类也将被删除!</strong></span>', function(){
			$.ajax({
				url:'?file=<?php echo $file; ?>&mid=<?php echo $mid; ?>&action=delete&catid='+encodeURIComponent(id),
				success:function(data){
					if(data == '0'){
						parent.jsprint("删除成功!", "", "Success");
						window.location.reload();
					}else{
						parent.jsprint("删除失败!", "", "Error");
						art.dialog({
							title: '删除失败',
							lock: true,
							background: '#fff',
							opacity: 0.5,
							content: data,
							ok: true
						});
					}
				}
			});
		});
	}
	
	function _update_sel(){
		var sels = z.$('#catid[]');
		var ib = false;
		for(var i in sels){
			if(sels[i].checked) ib = true;
		}
		if(ib || _increate_new != ''){
			art.dialog.confirm('确定要更新所选的分类吗?', function(){
				$('#action').val('update');
				$('#myform').submit();
			});
		}else{
			alert('请选择要更新的分类!');
		}		
	}
	
	function _delete_sel(){
		var sels = z.$('#catid[]');
		var ib = false;
		for(var i in sels){
			if(sels[i].checked) ib = true;
		}
		if(ib){
			art.dialog.confirm('确定要删除所选的分类吗?<br><span style="color:red;">此操作不可恢复!</span>', function(){
				$('#action').val('delete');
				$('#myform').submit();
			});
		}else{
			alert('请选择要删除的分类!');
		}
	}
	
	var _increate_new = '';
	
	function _add(elem,url,p){
	
		elem = elem.parentElement.parentElement;
		
		var parentid = z.$('<input>',elem)[0].value;
		
		_increate_new = z.create({tagName:'tr',align:'center',content:'<td></td><td><input type="text" name="newCat[][listorder]" value="0" size="5" class="valid number" /></td><td></td><td align="left"><input type="text" name="newCat[][catname]" value="" class="txtInput normal required" style="width:150px;" /></td><td align="left"><input type="text" name="newCat[][catdir]" value="" class="txtInput required" /></td><td class="my_option_m"><a href="javascript:;" onclick="_Revocation(this);" title="撤销">撤销</a><input type="hidden" name="newCat[][parentid]" value="'+parentid+'" /></td>',adom:elem});
		
		
		
		//_url(url,p);
	}
	
	function _Revocation(elem){
		elem = elem.parentElement.parentElement;
		z.remove(elem);
	}
	
</script>

<div class="navigation">首页 &gt; 分类管理 &gt; <?php echo $MOD['name']; ?>分类</div>
	
	<div class="tools_box">
		<div class="tools_bar">
			<a href="?file=<?php echo $file;?>&mid=<?php echo $mid; ?>&action=add" class="tools_btn"><span><b class="add">添加分类</b></span></a>
		</div>
	</div>

	<div class="tab_nav tab_nav_ex">分类管理</div>

	<form action="" method="post" id="myform" name="myform" >
	
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="msgtable">
			<tr>
				<th width="5%">选择</th>
				<th width="10%">排序</th>
				<th width="10%">ID</th>
				<th width="30%">分类名称</th>
				<th width="15%">分类目录</th>
				<th>操作</th>
			</tr>
<?php
	function show_catinfo($childs,$_i=0){
		global $MODULE,$do,$file,$mid;
		foreach($childs as $k=>$v) {
			$_childs = $do->get_catchild($v['catid']);
?>
			<tr align="center">
				<td>
					<input type="checkbox" name="catid[]" value="<?php echo $v['catid'];?>" />
				</td>
				<td>
					<input type="text" name="listorder[<?php echo $v['catid'];?>]" value="<?php echo $v['listorder'];?>" size="5" class="valid number" />
				</td>
				<td class="my_option_m"><a href="<?php echo $MODULE[$mid]['linkurl'].$v['linkurl']; ?>" target="_blank"><?php echo $v['catid']; ?></a></td>
				<td align="left">
<?php
			switch($_i){
				case 0 : break;
				case 1 : echo '┣';break;
				default : echo '&nbsp;&nbsp;&nbsp;&nbsp;┣';break;
			}
?>
					<input type="text" name="catname[<?php echo $v['catid'];?>]" value="<?php echo $v['catname'];?>" class="txtInput normal required" style="width:150px;" />
				</td>
				<td align="left">
					<input type="text" name="catdir[<?php echo $v['catid'];?>]" value="<?php echo $v['catdir'];?>" class="txtInput required" />
				</td>
				<td class="my_option_m">
					<a href="javascript:;" onclick="_add(this,'?file=<?php echo $file;?>&mid=<?php echo $mid; ?>&action=add&catid=<?php echo $v['catid'];?>',{n:'sys_category_add',t:'添加分类'});" class="icon_import" title="添加子分类"></a>
					<a href="javascript:;" onclick="_url('?file=<?php echo $file;?>&mid=<?php echo $mid; ?>&action=edit&catid=<?php echo $v['catid'];?>',{n:'sys_category_edit',t:'编辑分类'});" class="icon_edit" title="编辑"></a>
					<a href="javascript:;" onclick="_delete('<?php echo $v['catid']; ?>')" class="icon_delete" title="删除"></a>
				</td>
			</tr>
<?php
			if(count($_childs) > 0) show_catinfo($_childs,($_i+1));
		}
	}
	show_catinfo($RECAT);
?>
		</table>
		
		<div class="foot_btn_box" style="text-align:left;">
			<input type="hidden" name="file" value="<?php echo $file; ?>" />
			<input type="hidden" name="mid" value="<?php echo $mid; ?>" />
			<input type="hidden" id="action" name="action" value="" />
			<input type="hidden" name="v_ruiec_sm" value="ruiec" />
			<a href="javascript:void(0);" onclick="checkAll('catid[]',true);" >全选</a>&nbsp;&nbsp;&nbsp;
			<a href="javascript:void(0);" onclick="checkAll('catid[]','!');" >反选</a>&nbsp;&nbsp;&nbsp;
			<a href="javascript:void(0);" onclick="checkAll('catid[]',false);" >全不选</a>&nbsp;&nbsp;&nbsp;
			<input type="button" value="更新分类数据" onclick="_update_sel();" class="btnSubmit" />&nbsp;&nbsp;&nbsp;
			<input type="button" value="删除选中分类" onclick="_delete_sel();" class="btnSearch" />
		</div>
	
	</form>
		
	<div class="line10"></div>


<?php include tpl('footer');?>
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
	
</script>

<div class="navigation">首页 &gt; 分类管理 &gt; <?php echo $MOD['name']; ?>分类</div>
	
	<div class="tools_box">
		<div class="tools_bar">
			<a href="?file=<?php echo $file;?>&mid=<?php echo $mid; ?>&action=add" class="tools_btn"><span><b class="add">添加分类</b></span></a>
		</div>
	</div>

	<div class="tab_nav tab_nav_ex">分类管理</div>

	<form action="" method="post" id="myform_cat" name="myform_cat" >
	
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
	function show_catinfo($childs,$dsplay='',$_i=0){
		global $MODULE,$do,$file,$mid;
		foreach($childs as $k=>$v) {
			$_childs = $do->get_catchild($v['catid']);
?>
			<tr align="center" style="display:<?php echo $dsplay; ?>" _id="<?php echo $v['parentid']; ?>">
				<td>
					<input type="checkbox" name="catid[]" value="<?php echo $v['catid'];?>" />
				</td>
				<td>
					<input type="text" name="listorder[<?php echo $v['catid'];?>]" value="<?php echo $v['listorder'];?>" size="5" class="txtInput valid number" />
				</td>
				<td class="my_option_m"><a href="<?php echo $MODULE[$mid]['linkurl'].$v['linkurl']; ?>" target="_blank"><?php echo $v['catid']; ?></a></td>
				<td align="left">
<?php
			switch($_i){
				case 0 : break;
				case 1 : echo '|----';break;
				default : echo '|----|----';break;
			}
?>
					<!--<div style="float:left;visibility:<?php echo (count($_childs) > 0) ? '' : 'hidden';?>;">+</div>-->
					<?php echo (count($_childs) > 0) ? '<a href="javascript:;" onclick="_showc('.$v['catid'].')">+</a>' : ' ';?>
					<input type="text" name="catname[<?php echo $v['catid'];?>]" value="<?php echo $v['catname'];?>" class="txtInput valid number" />
				</td>
				<td align="left">
					<input type="text" name="catdir[<?php echo $v['catid'];?>]" value="<?php echo $v['catdir'];?>" class="txtInput valid number" />
				</td>
				<td class="my_option_m">
					<a href="javascript:;" onclick="_url('?file=<?php echo $file;?>&mid=<?php echo $mid; ?>&action=add&catid=<?php echo $v['catid'];?>');" class="icon_import" title="添加子分类"></a>
					<a href="javascript:;" onclick="_url('?file=<?php echo $file;?>&mid=<?php echo $mid; ?>&action=edit&catid=<?php echo $v['catid'];?>');" class="icon_edit" title="编辑"></a>
					<a href="javascript:;" onclick="_delete('<?php echo $v['catid']; ?>')" class="icon_delete" title="删除"></a>
				</td>
			</tr>
<?php
			//if(count($_childs) > 0) show_catinfo($_childs,'none',($_i+1));
			if(count($_childs) > 0) show_catinfo($_childs,'none',($_i+1));
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
			<input type="button" value="更新分类数据" onclick="$('action').val('update');" class="btnSubmit" />&nbsp;&nbsp;&nbsp;
			<input type="button" value="删除选中分类" onclick="$('action').val('delete');" class="btnSearch" />
		</div>
	
	</form>
		
	<div class="line10"></div>


<?php include tpl('footer');?>
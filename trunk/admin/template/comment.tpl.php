<?php include tpl('header'); ?>

<script type="text/javascript">

	$(function(){
		$('#myform').ajaxForm({
			beforeSend : function() {art.dialog({id:'lock',title:false,lock:true,background:'#fff',opacity:0.3});},
			success : function(responseText, statusText, xhr, $form){
				art.dialog.list['lock'].close();
				if(statusText == 'success'){
					$_text = ($('#action').val() == 'delete') ? '删除' : '改变';
					if(responseText == '0'){
						parent.jsprint($_text+"成功!", "", "Success");
						window.location.reload();
					}else{
						parent.jsprint($_text+"失败!", "", "Error");
						art.dialog({
							title: $_text+'失败',
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
	
	// 删除
	function _delete(id){
		art.dialog.confirm('确定要删除吗?<br /><span style="font-size:14px;color:red;">此操作不可恢复!!!</span>', function(){
			$.ajax({
				url:'?file=<?php echo $file; ?>&action=delete&itemid='+encodeURIComponent(id),
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
	
	// 改变状态
	function _chanstatus(){
		if($('#status').val() != ''){
			var sels = z.$('#itemid[]');
			var ib = false;
			for(var i in sels){
				if(sels[i].checked) ib = true;
			}
			if(ib){
				art.dialog.confirm('确定要改变所选的评论状态吗?', function(){
					$('#action').val('status');
					$('#myform').submit();
				});
			}else{
				$('#status').val('');
				alert('请选择要改变状态的评论!');
			}
		}
	}
	
	// 删除所选
	function _del_select(){
		var sels = z.$('#itemid[]');
		var ib = false;
		for(var i in sels){
			if(sels[i].checked) ib = true;
		}
		if(ib){
			art.dialog.confirm('确定要删除所选的评论吗?<br /><span style="font-size:14px;color:red;">提示:此操作不可恢复!!!</span>', function(){
				$('#action').val('delete');
				$('#myform').submit();
			});
		}else{
			alert('请选择要删除的评论!');
		}
	}
	
</script>

	<div class="navigation">首页 &gt; 控制面板 &gt; 评论信息管理</div>

	<div class="tools_box">
		<div class="tools_bar">
			
		</div>
	</div>

	<div class="tab_nav tab_nav_ex">评论信息管理</div>
	
	<form action="" method="post" id="myform" name="myform" >
	
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="msgtable">
			<tr>
				<th width="5%">选择</th>
				<th width="6%">评论状态</th>
				<th width="30%">评论目标</th>
				<th width="15%">评论用户</th>
				<th width="15%">评论时间</th>
				<th width="10%">评论ip</th>
				<th>操作</th>
			</tr>
<?php
	foreach($comments as $k=>$v) {
?>
			<tr align="center">
				<td><input type="checkbox" name="itemid[]" value="<?php echo $v['itemid']; ?>" /></td>
				<td align="left"><?php echo ($v['status'] == 1) ? '<span style="color:#ccc;">已通过</span>' : '<span style="color:red;">未通过</span>'; ?></td>
				<td>
					[<a href="<?php echo $MODULE[$v['moduleid']]['linkurl'] ?>" target="_blank" ><?php echo $MODULE[$v['moduleid']]['name'] ?></a>]
					 <a href="<?php echo $v['linkurl']; ?>" title="<?php echo $v['title']; ?>" target="_blank"><?php echo $v['title']; ?></a>
				</td>
				<td><?php echo $v['username']; ?></td>
				<td><?php echo timetodate($v['addtime']); ?></td>
				<td><a href="javascript:;" onclick="_ip('<?php echo $v['userip']; ?>')" ><?php echo $v['userip']; ?></a></td>
				<td class="my_option_m">
					<a href="javascript:;" onclick="_url('?file=<?php echo $file;?>&action=edit&itemid=<?php echo $v['itemid'];?>',{n:'sys_comment_edit',t:'查看评论详细'});" class="icon_edit" title="修改"></a>&nbsp;&nbsp;
					<a href="javascript:;" onclick="_delete('<?php echo $v['itemid'];?>');" class="icon_delete" title="删除"></a>&nbsp;&nbsp;
				</td>
			</tr>
<?php
	}
?>
		</table>
		<div class="line10"></div>
		
		<div class="foot_btn_box" style="text-align:left;">
			<input type="hidden" name="file" value="<?php echo $file; ?>" />
			<input type="hidden" id="action" name="action" value="" />
			<input type="hidden" name="v_ruiec_sm" value="ruiec" />
			<a href="javascript:void(0);" onclick="checkAll('itemid[]',true);" >全选</a>&nbsp;&nbsp;&nbsp;
			<a href="javascript:void(0);" onclick="checkAll('itemid[]','!');" >反选</a>&nbsp;&nbsp;&nbsp;
			<a href="javascript:void(0);" onclick="checkAll('itemid[]',false);" >全不选</a>&nbsp;&nbsp;&nbsp;
			选中状态<select id="status" name="status" class="select" onchange="_chanstatus()"><option value=''>请选择状态</option><option value='1'>通过审核</option><option value='0'>拒绝审核</option></select>
			<input type="button" value="删除选中" onclick="_del_select();" class="btnSearch" />
		</div>
	
	</form>
	
<?php include tpl('footer'); ?>

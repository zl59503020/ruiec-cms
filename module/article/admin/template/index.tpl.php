<?php
defined('IN_RUIEC') or exit('Access Denied');
include tpl('header');
?>

<script type="text/javascript">

	function _delete(id){
		art.dialog.confirm('确定要删除吗?<br /><span style="font-size:14px;color:red;">此操作可恢复,可在回收站内找回!!!</span>', function(){
			var url = '?file=<?php echo $file;?>&action=delete&moduleid=<?php echo $moduleid; ?>&$recycle=yes&itemid='+id;
			$.ajax({
				url:url,
				success:function(responseText){
					if(responseText == '0'){
						parent.jsprint("删除成功!", "", "Success");
						window.location.reload();
					}else{
						parent.jsprint("删除失败!", "", "Error");
						art.dialog({
							title: '删除失败',
							lock: true,
							background: '#fff',
							opacity: 0.5,
							content: responseText,
							ok: true
						});
					}
				}
			});
		});
	}

</script>

	<div class="navigation">首页 &gt; <?php echo $MOD['name']; ?>管理 &gt; <?php echo $MOD['name']; ?>列表</div>
	
	<div class="tools_box">
		<div class="tools_bar">
			<div class="search_box">
				<input type="text" id="txtKeywords" class="txtInput" />
				<input type="button" value="搜 索" class="btnSearch" onclick="btnSearch_Click" />
			</div>
			<a href="?file=<?php echo $file; ?>&action=import" class="tools_btn"><span><b class="add">添加<?php echo $MOD['name']; ?></b></span></a>
			<!--
			<a href="javascript:void(0);" onclick="checkAll('tables[]',true);" class="tools_btn"><span><b class="all">全选</b></span></a>
			<a href="javascript:void(0);" onclick="checkAll('tables[]',false);" class="tools_btn"><span><b class="all">全不选</b></span></a>
			-->
			<!--<a href="javascript:void(0);" onclick="checkAll('tables[]',0);" class="tools_btn"><span><b class="all">反选</b></span></a>-->
			<!--
			<a href="?action=del" onclick="return false;" class="tools_btn"><span><b class="delete">批量删除</b></span></a>
			-->
		</div>
	</div>

	<div class="tab_nav tab_nav_ex"><?php echo $MOD['name']; ?>列表</div>
	
	<form action="" method="post" id="myform_db" name="myform_db" >
	
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="msgtable">
			<tr>
				<th width="5%">选择</th>
				<th width="10%">分类</th>
				<th width="5%">级别</th>
				<th>标题</th>
				<th width="15%">添加时间</th>
				<th width="10%">点击</th>
				<th width="15%">操作</th>
			</tr>
<?php
	foreach($lists as $k=>$v) {
?>
			<tr align="center">
				<td>
					<input type="checkbox" name="itemid[]" value="<?php echo $v['itemid'];?>" />
				</td>
				<td align="left"><a href="<?php echo $v['caturl']; ?>" ><?php echo $v['catname']; ?></a></td>
				<td><?php echo $v['level']; ?></td>
				<td class="my_option_m">
					<a href="<?php echo $v['linkurl']; ?>" title="<?php echo $v['alt'];?>"><?php echo $v['title'];?></a>
					<a href="javascript:;" onclick="showImg('<?php echo $v['thumb']; ?>');" class="icon_img" style="margin-top:3px;" title="有标题图片,点击预览"></a>
				</td>
				<td><?php echo $v['adddate'];?></td>
				<td><?php echo $v['hits'];?></td>
				<td class="my_option_m">
					<a href="javascript:;" onclick="_url('?file=<?php echo $file; ?>&action=edit&moduleid=<?php echo $moduleid; ?>&itemid=<?php echo $v['itemid']; ?>')" class="icon_edit" title="编辑"></a>
					<a href="javascript:;" onclick="_delete('<?php echo $v['itemid']; ?>')" class="icon_delete" title="删除"></a>
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
			<a href="javascript:void(0);" onclick="checkAll('itemid[]',false);" >全不选</a>&nbsp;&nbsp;&nbsp;
			<input type="button" value="备份选中表" onclick="dbopt('0');" class="btnSubmit" />&nbsp;&nbsp;&nbsp;
			<input type="button" value="删除选中表" onclick="dbopt('1');" class="btnSearch" />
		</div>
	
	</form>
	
<?php include tpl('footer');?>
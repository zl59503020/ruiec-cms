<?php include tpl('header'); ?>

<script type="text/javascript">
	
</script>

	<div class="navigation">首页 &gt; 控制面板 &gt; 广告管理</div>
	
	<div class="tools_box">
		<div class="tools_bar">
			<a href="?file=<?php echo $file; ?>&action=add" class="tools_btn"><span><b class="add">添加广告</b></span></a>
		</div>
	</div>

	<div class="tab_nav tab_nav_ex">广告管理</div>
	
	<form action="" method="post" id="myform" name="myform" >
	
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="msgtable">
		<tr>
			<th width="10%">广告ID</th>
			<th width="20%">广告类型</th>
			<th width="15%">广告名称</th>
			<th width="10%">点击</th>
			<th width="10%">开始时间</th>
			<th width="10%">结束时间</th>
			<th width="10%">剩余时间</th>
			<th width="10%">状态</th>
			<th>管理</th>
		</tr>
<?php
	foreach($ads as $v) {
?>
		<tr align="center">
			<td><?php echo $v['adid']; ?></td>
			<td><?php echo $v['moduleid']; ?></td>
			<td><a href="<?php echo $v['linkurl'];?>" target="_blank"><?php echo $v['name'];?></a></td>
			<td><a href="<?php echo $v['linkurl'];?>" target="_blank"><?php echo $v['moduledir'] ? $v['moduledir'] : '--';?></a></td>
			<td><?php echo $v['islink'] ? '<span class="f_red">外链</span>' : '内置';?></td>
			<td><?php echo $v['ismenu'] ? '是' : '<span class="f_red">否</span>';?></td>
			<td title="<?php echo $v['module'];?>"><?php echo $v['modulename'];?></td>
			<td><?php echo $v['installdate']; ?></td>
			<td class="my_option_m">
				<a href="?file=<?php echo $file;?>&action=edit&modid=<?php echo $v['moduleid'];?>" class="icon_edit" title="修改"></a>&nbsp;&nbsp;
				<a href="javascript:;" onclick="md_delete(<?php echo $v['moduleid'];?>,'<?php echo $v['name'];?>');" class="icon_delete" title="删除" onclick="return _delete();"></a>&nbsp;&nbsp;
				<a href="?file=setting&moduleid=<?php echo $v['moduleid'];?>" class="icon_set" title="设置"></a>&nbsp;&nbsp;
				<?php if($v['disabled']) {?><a href="javascript:;" onclick="ck_disable(0,<?php echo $v['moduleid'];?>,'<?php echo $v['name'];?>');" class="icon_start" title="已禁用,点击启用"></a><?php } else {?><a href="javascript:;" onclick="ck_disable(1,<?php echo $v['moduleid'];?>,'<?php echo $v['name'];?>');" class="icon_stop" title="正常运行,点击禁用" ></a><?php } ?>
			</td>
		</tr>
<?php
	}
?>
	</table>
	</form>
	<div class="line10"></div>

	
<?php include tpl('footer'); ?>

<?php
defined('IN_RUIEC') or exit('Access Denied');
include tpl('header');
?>
<div class="navigation">首页 &gt; 自定义字段 &gt; 字段列表</div>
	
	<div class="tools_box">
		<div class="tools_bar">
			<a href="javascript:;" onclick="_url('?file=<?php echo $file;?>&tbname=<?php echo $tbname; ?>&action=add',{n:'sys_fields_add',t:'添加新字段'});" class="tools_btn"><span><b class="add">添加字段</b></span></a>
		</div>
	</div>

	<div class="tab_nav tab_nav_ex">管理字段[<?php echo $tbname; ?>]</div>

	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="msgtable">
		<tr>
			<th width="5%">ID</th>
			<th width="15%">字段</th>
			<th width="30%">字段名称</th>
			<th width="15%">字段属性</th>
			<th width="15%">表单类型</th>
			<th>操作</th>
		</tr>
<?php
	foreach($fields as $k=>$v) {
?>
		<tr align="center">
			<td><?php echo $v['itemid']; ?></td>
			<td align="left"><?php echo $v['name']; ?></td>
			<td align="left"><?php echo $v['title']; ?></td>
			<td align="left"><?php echo $v['type']; ?></td>
			<td align="left"><?php echo $v['html']; ?></td>
			<td class="my_option_m">
				<a href="javascript:;" onclick="_url('?file=<?php echo $file;?>&tbname=<?php echo $tbname; ?>&action=edit&itemid=<?php echo $v['itemid'];?>',{n:'sys_fields_edit',t:'编辑自定义字段'});" class="icon_edit" title="编辑"></a>
				<a href="javascript:;" onclick="_delete('<?php echo $v['itemid']; ?>')" class="icon_delete" title="删除"></a>
			</td>
		</tr>
<?php
	}
?>
	</table>
		
	<div class="line10"></div>

<script type="text/javascript">
	function _delete(id){
		var info = '确定要删除该自定义字段吗?<br /><span style="font-size:14px;color:red;">此操作不可恢复!!!</span>';
		var url = '?file=<?php echo $file; ?>&tbname=<?php echo $tbname; ?>&action=delete&itemid='+encodeURIComponent(id);
		_cf({info:info,url:url,title:'删除'});
	}
</script>

<?php include tpl('footer');?>
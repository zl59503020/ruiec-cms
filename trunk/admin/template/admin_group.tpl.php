<?php
defined('IN_RUIEC') or exit('Access Denied');
include tpl('header');
?>

	<div class="navigation">首页 &gt; 控制面板 &gt; 分组管理</div>
	
	<div class="tools_box">
		<div class="tools_bar">
			<a href="_url('?file=<?php echo $file; ?>&action=add',{n:'sys_admin_group_add',t:'添加分组'});" class="tools_btn"><span><b class="add">添加分组</b></span></a>
		</div>
	</div>
	
	<div class="tab_nav tab_nav_ex">分组管理</div>
	
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="msgtable">
		<tr>
			<th width="10%">ID</th>
			<th width="30%">分组名称</th>
			<th width="15%">组成员数</th>
			<th width="20%">分组类型</th>
			<th>管理</th>
		</tr>
<?php
	foreach($lists as $v) {
?>
		<tr align="center">
			<td><?php echo $v['itemid'];?></td>
			<td><?php echo $v['name'];?></td>
			<td><?php echo $v['uscount'];?></td>
			<td><?php echo $v['type'];?></td>
			<td>
<?php
		if($v['itemid'] != '1'){
?>
				<a href="javascript:;" onclick="_url('?file=<?php echo $file; ?>&action=edit&itemid=<?php echo $v['itemid'];?>',{n:'sys_group_edit',t:'编辑分组_<?php echo $v['name']; ?>'});" title="修改分组">编辑</a> | 
				<a href="javascript:;" onclick="_delete('<?php echo $v['itemid'];?>');" title="删除">删除</a>
<?php
		}else{
?>
				系统内置分组不能操作
<?php
		}
?>
			</td>
		</tr>
<?php
	}
?>
	</table>
	
<script type="text/javascript">
	
	function _delete(itemid){
		var info = '确定要删除该分组吗?<br /><span style="font-size:14px;color:red;">该分组下的所有用户将会被冻结!!!</span>';
		var url = '?file=<?php echo $file;?>&action=delete&itemid='+encodeURIComponent(itemid);
		_cf({info:info,url:url,title:'删除'});
	}

</script>
	
<?php include tpl('footer'); ?>
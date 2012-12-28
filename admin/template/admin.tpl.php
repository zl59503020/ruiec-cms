<?php
defined('IN_RUIEC') or exit('Access Denied');
include tpl('header');
?>

	<div class="navigation">首页 &gt; 控制面板 &gt; 管理员管理</div>
	
	<div class="tools_box">
		<div class="tools_bar">
			<a href="javascript:;" onclick="_url('?file=<?php echo $file; ?>&action=add',{n:'sys_admin_add',t:'添加管理员'});" class="tools_btn"><span><b class="add">添加管理员</b></span></a>
			<a href="javascript:;" onclick="_url('?file=group',{n:'sys_group',t:'分组管理'});" class="tools_btn"><span><b class="add">分组管理</b></span></a>
		</div>
	</div>
	
	<div class="tab_nav tab_nav_ex">管理员管理</div>
	
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="msgtable">
		<tr>
			<th width="10%">姓名</th>
			<th width="10%">用户名</th>
			<th width="10%">管理组</th>
			<th width="10%">上次登录时间</th>
			<th width="10%">登录IP</th>
			<th width="10%">登录地区</th>
			<th width="10%">登录次数</th>
			<th>管理</th>
		</tr>
<?php
	foreach($lists as $v) {
?>
		<tr align="center">
			<td><?php echo $v['truename'];?></td>
			<td><a href="javascript:_user('<?php echo $v['username'];?>');"><?php echo $v['username'];?></a></td>
			<td><?php echo $v['groupname'];?></td>
			<td class="px11"><?php echo $v['lastlogintime'];?></td>
			<td class="px11"><a href="javascript:_ip('<?php echo $v['lastloginip'];?>');"><?php echo $v['lastloginip'];?></a></td>
			<td><?php echo ip2area($v['lastloginip']);?></td>
			<td><?php echo $v['logincount'];?></td>
			<td class="my_option_m">
				<a href="javascript:;" onclick="_url('?file=<?php echo $file;?>&action=edit&userid=<?php echo $v['userid'];?>',{n:'sys_admin_edit_<?php echo $v['userid'];?>',t:'编辑管理员_<?php echo $v['username'];?>'});" title="编辑" class="icon_edit"></a>&nbsp;&nbsp;
<?php
		if($CFG['founderid'] != $v['userid']){
?>
				<a href="javascript:;" onclick="_delete(<?php echo $v['userid'];?>,'<?php echo $v['username'];?>');" class="icon_delete" title="删除"></a>
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
	
	function _delete(id,name){
		var info = '确定要删除管理员 '+name+' 吗?';
		var url = '?file=<?php echo $file;?>&action=delete&userid='+encodeURIComponent(id);
		_cf({info:info,url:url,title:'删除'});
	}

</script>
	
<?php include tpl('footer'); ?>
<?php
defined('IN_RUIEC') or exit('Access Denied');
include tpl('header');
?>

	<div class="navigation">首页 &gt; 控制面板 &gt; 系统日志</div>
	
	<div class="tools_box">
		<div class="tools_bar">
			<a href="javascript:;" onclick="_url('?file=log',{n:'sys_log',t:'系统日志管理'});" class="tools_btn"><span><b class="add">系统日志</b></span></a>
			<a href="javascript:;" onclick="log_clear()" class="tools_btn"><span><b class="remove">清空记录</b></span></a>
		</div>
	</div>
	
	<div class="tab_nav tab_nav_ex">404日志管理</div>
	
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="msgtable">
		<tr>
			<th width="10%">访问</th>
			<th width="15%">来源URL</th>
			<th width="30%">访问URL</th>
			<th width="8%">用户</th>
			<th width="10%">操作IP</th>
			<th width="10%">操作时间</th>
			<th width="8%">用户代理</th>
			<th>管理</th>
		</tr>
<?php
	foreach($lists as $v) {
?>
		<tr align="center">
			<td align="left"><?php echo $v['robot']; ?></td>
			<td align="left"><?php echo ($v['surl']) ? $v['surl'] : '未知'; ?></td>
			<td align="left"><?php echo $v['furl']; ?></td>
			<td><?php echo $v['username']; ?></td>
			<td><a href="javascript:_ip('<?php echo $v['ip'];?>');"><?php echo $v['ip'];?></a></td>
			<td><?php echo $v['addtime']; ?></td>
			<td><?php echo tips($v['userAgent']); ?></td>
			<td class="_my_option_m">
				<a href="javascript:;" onclick="log_delete(<?php echo $v['itemid'];?>);" class="icon_delete" title="删除" onclick="return _delete();"></a>&nbsp;&nbsp;
			</td>
		</tr>
<?php
	}
?>
	</table>

<script type="text/javascript">
	
	function log_delete(id){
		var info = '确定要删除该记录吗?<br /><span style="font-size:14px;color:red;">此操作不可恢复!!!</span>';
		var url = '?file=<?php echo $file;?>&action=delete&itemid='+encodeURIComponent(id);
		_cf({info:info,url:url,title:'删除'});
	}
	
	function log_clear(){
		var info = '确定要清空所有记录吗?<br /><span style="font-size:14px;color:red;">此操作不可恢复!!!</span>';
		var url = '?file=<?php echo $file;?>&action=clear';
		_cf({info:info,url:url,title:'清空'});
	}

</script>

<?php include tpl('footer'); ?>
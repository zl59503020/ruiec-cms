<?php
defined('IN_RUIEC') or exit('Access Denied');
include tpl('header');
?>

<script type="text/javascript">
	
	function log_delete(id){
		art.dialog.confirm('确定要删除该记录吗?<br /><span style="font-size:14px;color:red;">此操作不可恢复!!!</span>', function(){
			var url = '?file=<?php echo $file;?>&action=delete&id='+id;
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
	
	function log_clear(){
		art.dialog.confirm('确定要清空所有记录吗?<br /><span style="font-size:14px;color:red;">此操作不可恢复!!!</span>', function(){
			var url = '?file=<?php echo $file;?>&action=clear';
			$.ajax({
				url:url,
				success:function(responseText){
					if(responseText == '0'){
						parent.jsprint("清空成功!", "", "Success");
						window.location.reload();
					}else{
						parent.jsprint("清空失败!", "", "Error");
						art.dialog({
							title: '清空失败',
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
	<div class="navigation">首页 &gt; 控制面板 &gt; 系统日志</div>
	
	<div class="tools_box">
		<div class="tools_bar">
			<a href="?file=404" class="tools_btn"><span><b class="add">404记录</b></span></a>
			<a href="javascript:;" onclick="log_clear()" class="tools_btn"><span><b class="remove">清空记录</b></span></a>
		</div>
	</div>
	
	<div class="tab_nav tab_nav_ex">系统日志管理</div>
	
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="msgtable">
		<tr>
			<th width="10%">用户</th>
			<th width="40%">操作内容</th>
			<th width="10%">操作IP</th>
			<th width="10%">操作时间</th>
			<th width="10%">用户代理</th>
			<th>管理</th>
		</tr>
<?php
	foreach($lists as $v) {
?>
		<tr align="center">
			<td><?php echo $v['username']; ?></td>
			<td><?php echo tips($v['content']); ?></td>
			<td><a href="javascript:_ip('<?php echo $v['ip'];?>');"><?php echo $v['ip'];?></a></td>
			<td><?php echo $v['time']; ?></td>
			<td><?php echo tips($v['userAgent']); ?></td>
			<td class="_my_option_m">
				<a href="javascript:;" onclick="log_delete(<?php echo $v['id'];?>);" class="icon_delete" title="删除" onclick="return _delete();"></a>&nbsp;&nbsp;
			</td>
		</tr>
<?php
	}
?>
	</table>

<?php include tpl('footer'); ?>
<?php
defined('IN_RUIEC') or exit('Access Denied');
include tpl('header');
?>

<script type="text/javascript">

	// 删除
	function skin_delete(fileid,ext,bakid){
		art.dialog.confirm('确定要删除文件['+ext+']吗?<br /><span style="font-size:14px;color:red;">此操作不可恢复!!!</span>', function(){
			var url = '?file=<?php echo $file; ?>&action=delete&fileid='+encodeURIComponent(fileid);
			$.ajax({
				url:url + ((typeof bakid != 'undefined') ? ('&bakid='+encodeURIComponent(bakid)) : ''),
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
	
	function sk_import(fileid,bakid){
		art.dialog.confirm('确定要恢复备份文件['+fileid+']吗?<br /><span style="font-size:14px;color:red;">当前文件将被覆盖!!!</span>', function(){
			$.ajax({
				url:'?file=<?php echo $file; ?>&action=import&fileid='+encodeURIComponent(fileid)+'&bakid='+encodeURIComponent(bakid),
				success:function(data){
					if(data == '0'){
						parent.jsprint("恢复成功!", "", "Success");
						window.location.reload();
					}else{
						parent.jsprint("恢复失败!", "", "Error");
						art.dialog({
							title: '恢复失败',
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
	
	function ac_url(action,op){
		window.location = '?file=<?php echo $file; ?>&action='+action+'&'+op;
	}

</script>

	<div class="navigation">首页 &gt; 控制面板 &gt; 皮肤管理</div>
	
	<div class="tools_box">
		<div class="tools_bar">
			<a href="?file=template" class="tools_btn"><span><b class="add">模板管理</b></span></a>
			<a href="?file=skin" class="tools_btn"><span><b class="add">皮肤管理</b></span></a>
			<a href="?file=skin&action=add" class="tools_btn"><span><b class="add">新建CSS</b></span></a>
		</div>
	</div>

	<div class="tab_nav tab_nav_ex">皮肤管理</div>
	
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="msgtable">
		<tr>
			<th width="30%">文件名</th>
			<th width="10%">文件大小</th>
			<th width="15%">修改时间</th>
			<th width="10%">属性</th>
			<th>操作</th>
		</tr>
<?php
	foreach($skins as $k=>$v) {
?>
		<tr align="center">
			<td align="left">
				<div class="icon_css" style="float:left;margin-right:10px;"></div>
				<a href="?file=<?php echo $file;?>&action=edit&fileid=<?php echo $v['fileid'];?>" title="修改"><?php echo $v['filename'];?></a>
			</td>
			<td><?php echo $v['filesize'];?></td>
			<td><?php echo $v['mtime'];?></td>
			<td><?php echo $v['mod'];?></td>
			<td class="my_option_m">
				<a href="javascript:;" onclick="ac_url('edit','fileid=<?php echo $v['fileid'];?>');" title="编辑" class="icon_edit"></a>&nbsp;&nbsp;
				<a href="javascript:;" onclick="skin_delete('<?php echo $v['fileid'];?>','<?php echo $v['filename'];?>')" title="删除" class="icon_delete"></a>
			</td>
		</tr>
<?php
	}
?>
	</table>
<?php
	if($baks) { 
?>
	<div class="tab_nav tab_nav_ex">皮肤备份管理</div>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="msgtable">
		<tr>
			<th width="20%">文件名</th>
			<th width="10%">文件大小</th>
			<th width="15%">备份时间</th>
			<th width="10%">属性</th>
			<th>操作</th>
		</tr>
<?php
		foreach($baks as $k=>$v) {
?>
		<tr align="center">
			<td align="left">
				<div class="icon_unknow" style="float:left;"></div>
				<a href="javascript:;" onclick="zopen('<?php echo $skin_path.$v['filename'];?>')" title="查看"><?php echo $v['filename'];?></a>
			</td>
			<td><?php echo $v['filesize'];?></td>
			<td><?php echo $v['mtime'];?></td>
			<td><?php echo $v['mod'];?></td>
			<td class="my_option_m">
				<a href="javascript:;" onclick="sk_import('<?php echo $v['type'];?>','<?php echo $v['number'];?>');" class="icon_import" title="恢复备份"></a>&nbsp;
				<a href="javascript:;" onclick="zopen('<?php echo $skin_path.$v['filename'];?>',{width:'100%',height:'100%'});" class="icon_view" title="查看备份"></a>&nbsp;
				<a href="javascript:;" onclick="skin_delete('<?php echo $v['type'];?>','<?php echo $v['filename'];?>','<?php echo $v['number'];?>')" class="icon_delete" title="删除备份"></a>
			</td>
		</tr>
<?php
		}
?>
	</table>
<?php
	}
	include tpl('footer');
?>
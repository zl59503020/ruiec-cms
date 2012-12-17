<?php include tpl('header'); ?>


<script type="text/javascript">

	// 修改表注释
	function chk_rename(fileid,elem){
		art.dialog.prompt('请输入新的备注名.', function (val) {
			var url = '?file=<?php echo $file;?>&dir=<?php echo $dir;?>&action=template_name&fileid='+fileid+'&name='+encodeURIComponent(val);
			$.ajax({
				url:url,
				success:function(responseText){
					if(responseText == '0'){
						parent.jsprint("更改成功!", "", "Success");
						window.location.reload();
					}else{
						parent.jsprint("更改失败!", "", "Error");
						art.dialog({
							title: '更改失败',
							lock: true,
							background: '#fff',
							opacity: 0.5,
							content: responseText,
							ok: true
						});
					}
				}
			});
		}, elem.innerText);
	}
	
	// 删除
	function tpl_delete(fileid,ext){
		art.dialog.confirm('确定要删除文件['+ext+']吗?<br /><span style="font-size:14px;color:red;">此操作不可恢复!!!</span>', function(){
			$.ajax({
				url:'?file=<?php echo $file; ?>&action=delete&dir=<?php echo $dir; ?>&fileid='+encodeURIComponent(fileid),
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
	
	// 删除
	function tpl_bak_delete(fileid,ext,bakid){
		art.dialog.confirm('确定要删除文件['+ext+']吗?<br /><span style="font-size:14px;color:red;">此操作不可恢复!!!</span>', function(){
			$.ajax({
				url:'?file=<?php echo $file; ?>&action=delete&dir=<?php echo $dir; ?>&fileid='+encodeURIComponent(fileid)+'&bakid='+encodeURIComponent(bakid),
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
	
	function tp_import(fileid,bakid){
		art.dialog.confirm('确定要恢复备份文件['+fileid+'.'+bakid+'.bak]吗?<br /><span style="font-size:14px;color:red;">当前文件['+fileid+'.htm]将被覆盖!!!</span>', function(){
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

</script>


	<div class="navigation">首页 &gt; 控制面板 &gt; 模板管理</div>
	
	<div class="tools_box">
		<div class="tools_bar">
			<a href="javascript:;" onclick="_url('?file=skin',{n:'sys_skin',t:'皮肤管理'});" class="tools_btn"><span><b class="add">皮肤管理</b></span></a>
			<a href="javascript:;" onclick="_url('?file=<?php echo $file;?>&action=add&dir=<?php echo $dir;?>',{n:'sys_template_new',t:'新建模板'});" class="tools_btn"><span><b class="add">新建模板</b></span></a>
		</div>
	</div>

	<div class="tab_nav tab_nav_ex">模板管理</div>

	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="msgtable">
		<tr>
			<th width="20%">文件名</th>
			<th width="10%">模板名称</th>
			<th width="10%">模板系列</th>
			<th width="10%">文件大小</th>
			<th width="15%">修改时间</th>
			<th width="10%">属性</th>
			<th>操作</th>
		</tr>
<?php
	foreach($dirs as $k=>$v){
?>
		<tr align="center">
			<td align="left">
				<div class="icon_folder" style="float:left;margin-right:10px;"></div>
				<a href="?file=<?php echo $file;?>&dir=<?php echo $v['dirname'];?>" title="管理"><?php echo $v['dirname'];?></a>
			</td>
			<td>
				<a href="javascript:;" onclick="chk_rename('<?php echo $v['dirname'];?>',this);" title="点击修改备注名称"><?php echo $v['name'] ? $v['name'] : '--';?></a>
			</td>
			<td>&lt;目录&gt;</td>
			<td>&lt;目录&gt;</td>
			<td><?php echo $v['mtime'];?></td>
			<td><?php echo $v['mod'];?></td>
			<td class="my_option_m">
				<a href="javascript:;" onclick="_url('?file=<?php echo $file; ?>&dir=<?php echo $v['dirname'];?>');" title="管理" class="icon_import"></a>&nbsp;&nbsp;
				<a href="javascript:;" onclick="_url('?file=<?php echo $file; ?>&dir=<?php echo $v['dirname'];?>',{n:'sys_template_new',t:'新建模板'});" title="新建" class="icon_new"></a>&nbsp;&nbsp;
			</td>
		</tr>
<?php 
	}
	foreach($templates as $k=>$v) {
?>
		<tr align="center">
			<td align="left">
				<div class="icon_htm" style="float:left;"></div>
				<a href="?file=<?php echo $file;?>&action=edit&fileid=<?php echo $v['fileid'];?>&dir=<?php echo $dir;?>" title="编辑"><?php echo $v['filename'];?></a>
			</td>
			<td>
				<a href="javascript:;" onclick="chk_rename('<?php echo $v['fileid'];?>',this);" title="点击修改备注名称"><?php echo $v['name'] ? $v['name'] : '--';?></a>
			</td>
			<td>
				<a href="javascript:;" onclick="_url('?file=<?php echo $file;?>&action=add&type=<?php echo $v['type'];?>&dir=<?php echo $dir;?>',{n:'sys_template_new',t:'新建模板'});" title="新建"><?php echo $v['type'];?></a>
			</td>
			<td><?php echo $v['filesize'];?> Kb</td>
			<td><?php echo $v['mtime'];?></td>
			<td><?php echo $v['mod'];?></td>
			<td class="my_option_m">
				<a href="javascript:;" onclick="_url('fileid=<?php echo $v['fileid'];?>&dir=<?php echo $dir;?>',{n:'sys_template_edit',t:'编辑模板'});" title="编辑" class="icon_edit"></a>&nbsp;&nbsp;
				<a href="javascript:;" onclick="_url('type=<?php echo $v['type'];?>&dir=<?php echo $dir;?>',{n:'sys_template_new',t:'新建模板'});" title="新建" class="icon_new"></a>&nbsp;&nbsp;
				<a href="javascript:;" onclick="tpl_delete('<?php echo $v['fileid'];?>','<?php echo $v['filename'];?>')" title="删除" class="icon_delete"></a>
			</td>
		</tr>
<?php 
	}
?>
	</table>
		
	<div class="line10"></div>
	
<?php
	if($baks) { 
?>
	<div class="tab_nav tab_nav_ex"><? echo $dirS[$dir]['name']?>模板备份管理</div>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="msgtable">
		<tr>
			<th width="20%">文件名</th>
			<th width="10%">所属模板</th>
			<th width="8%">备份编号</th>
			<th width="10%">文件大小</th>
			<th width="15%">备份时间</th>
			<th width="8%">属性</th>
			<th>操作</th>
		</tr>
<?php
		foreach($baks as $k=>$v) {
?>
		<tr align="center">
			<td align="left">
				<div class="icon_unknow" style="float:left;"></div>
				<a href="javascript:;" onclick="zopen('<?php echo $template_path.$v['filename'];?>')" title="查看" target="_blank"><?php echo $v['filename'];?></a>
			</td>
			<td>&nbsp;<?php echo $v['type'];?>.htm</td>
			<td>&nbsp;<?php echo $v['number'];?></td>
			<td><?php echo $v['filesize'];?> Kb</td>
			<td><?php echo $v['mtime'];?></td>
			<td><?php echo $v['mod'];?></td>
			<td class="my_option_m">
				<a href="javascript:;" onclick="tp_import('<?php echo $v['type'];?>','<?php echo $v['number'];?>');" class="icon_import" title="恢复备份"></a>&nbsp;
				<a href="javascript:;" onclick="zopen('<?php echo $template_path.$v['filename'];?>')" title="查看" class="icon_view"></a>&nbsp;
				<a href="javascript:;" onclick="tpl_bak_delete('<?php echo $v['type'];?>','<?php echo $v['filename'];?>','<?php echo $v['number'];?>')" title="删除" class="icon_delete"></a>
			</td>
		</tr>
<?php
		}
?>
	</table>
<?php
	}
?>
	
<?php include tpl('footer'); ?>

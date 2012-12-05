<?php
defined('IN_RUIEC') or exit('Access Denied');
include tpl('header');
?>

<script type="text/javascript">
    //表单验证
    $(function () {
		$('#myform').ajaxForm({
			beforeSend : function() {art.dialog({id:'lock',title:false,lock:true,background:'#fff',opacity:0.3});},
			success : function(responseText, statusText, xhr, $form){
				art.dialog.list['lock'].close();
				if(statusText == 'success'){
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
				}else{
					return true;
				}
			}
		});
	});
	
	// 批量删除
	function bak_delete(){
		var sels = z.$('#filenames[]');
		var ib = false;
		for(var i in sels){
			if(sels[i].checked) ib = true;
		}
		if(ib){
			art.dialog.confirm('确定要删除所选备份吗?<br /><span style="font-size:14px;color:red;">此操作不可恢复!!!</span>', function(){
				$('#myform').submit();
			});
		}else{
			alert('请选择要删除的备份系列!');
		}
	}
	
	//导入
	function db_import(pre,number){
		//确定要导入此系列文件吗？现有数据将被覆盖，此操作将不可恢复
		//?file=< ? php echo $file; ? >&action=< ? php echo $action; ? >
		//&filepre=< ? php echo $v['pre']; ? >&tid=< ? php echo $v['number']; ? >&import=1
		art.dialog.confirm('确定要导入备份系列['+pre+']吗?<br /><span style="font-size:14px;color:red;">该操作会导致现有数据被覆盖<br />此操作不可恢复!!!!</span>', function(){
			$.ajax({
				url:'?file=<?php echo $file; ?>&action=import&v_ruiec_sm_import=ruiec&filepre='+encodeURIComponent(pre),
				success:function(data){
					if(data == '0'){
						parent.jsprint("导入成功!", "", "Success");
						window.location = '?file=<?php echo $file; ?>';
					}else{
						obj_import(data);
					}
				}
			});
			art.dialog({
				id: 'art_show_import',
				title: '正在导入',
				lock: true,
				background: '#fff',
				opacity: 0.5,
				ok: true
			});
		});		
	}
	
	// 删除
	function db_bak_delete(dir){
		art.dialog.confirm('确定要删除备份['+dir+']吗?<br /><span style="font-size:14px;color:red;">此操作不可恢复!!!</span>', function(){
			$.ajax({
				url:'?file=<?php echo $file; ?>&action=delete&filenames='+encodeURIComponent(dir),
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
	
	function checkAll(name,v){
		var cks = z.$('#'+name);
		for(var i in cks){
			//cks[i].checked = v;
			if(v == '!')cks[i].checked = !cks[i].checked;
			else cks[i].checked = v;
		}
	}
	
	//	还原.AJAX
	function obj_import(data){
		if(data == '0'){
			parent.jsprint("导入成功!", "", "Success");
			window.location = '?file=<?php echo $file; ?>';
		}
		var jsData = z.json(data);
		if(jsData != null){
			art.dialog.list['art_show_import'].title(jsData.title);
			art.dialog.list['art_show_import'].content(jsData.content);
			setTimeout(function(){$.ajax({url:jsData.url,success:obj_import});},3000);
		}else{
			art.dialog.list['art_show_import'].content(data);
		}
	}

</script>


	<div class="navigation">首页 &gt; 控制面板 &gt; 数据维护管理 &gt; 数据库恢复</div>
	
	<div class="tools_box">
		<div class="tools_bar">
			<a href="?file=<?php echo $file; ?>" class="tools_btn"><span><b class="add">备份数据</b></span></a>
			<a href="?file=<?php echo $file; ?>&action=import" class="tools_btn"><span><b class="add">还原数据</b></span></a>
		</div>
	</div>

	<div class="tab_nav tab_nav_ex">已备份数据</div>
	
	<form action="" method="post" id="myform" name="myform" >
		<input type="hidden" name="file" value="<?php echo $file;?>"/>
		<input type="hidden" name="action" value="delete"/>
		
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="msgtable">
			<tr>
				<th width="10%">选择</th>
				<th width="30%">备份系列</th>
				<th width="10%">文件大小</th>
				<th width="20%">备份时间</th>
				<th width="10%">分卷</th>
				<th>操作</th>
			</tr>
<?php
		foreach($dbaks as $k=>$v) {
?>
			<tr align="center">
				<td><input type="checkbox" name="filenames[]" value="<?php echo $v['filename'];?>" /></td>
				<td align="left">
					<div class="icon_folder" style="float:left;margin-right:10px;"></div>
					<a href="?file=<?php echo $file;?>&action=open&dir=<?php echo $v['filename'];?>"><?php echo $v['filename'];?></a>
				</td>
				<td><?php echo $v['filesize'];?></td>
				<td title="修改时间:<?php echo $v['mtime'];?>"><?php echo $v['btime'];?></td>
				<td><?php echo $v['number'];?></td>
				<td class="my_option_m">
					<a href="javascript:;" onclick="db_import('<?php echo $v['pre'];?>','<?php echo $v['number'];?>');" title="导入本系列备份" class="icon_import"></a>&nbsp;&nbsp;
					<a href="?file=<?php echo $file; ?>&action=down&dir=<?php echo $v['filename'];?>" title="下载本系列备份" class="icon_save" ></a>&nbsp;&nbsp;
					<a href="javascript:;" onclick="db_bak_delete('<?php echo $v['filename'];?>');" title="删除本系列备份" class="icon_delete"></a>
				</td>
			</tr>
<?php
		}
		if(count($dbaks) == 0){
?>
			<tr>
				<td colspan="6" align="center">暂无相关备份文件.&nbsp;&nbsp;<a href="?file=<?php echo $file; ?>">去备份</a></td>
			</tr>
<?php
		}else{
?>
			<tr>
				<td colspan="6" align="left">
					<span class="f_r">
						<a href="javascript:;" onclick="checkAll('filenames[]',true);">全选</a>&nbsp;&nbsp;
						<a href="javascript:;" onclick="checkAll('filenames[]',false);">全不选</a>&nbsp;&nbsp;
						<a href="javascript:;" onclick="checkAll('filenames[]','!');">反选</a>&nbsp;&nbsp;
					</span>
					<input type="hidden" name="v_ruiec_sm_import" value="ruiec" />
					<input type="button" value="删除文件" onclick="bak_delete()" class="btnSearch" />
				</td>
			</tr>
<?php
		}
?>
		</table>

	</form>
<?php 
		if(count($dbaks) > 10) {
?>
	<script type="text/javascript">art.dialog({title: '提示',lock: true,background: '#fff',opacity: 0.5,ok: true,content:'备份系列超 10 个，建议清理或转移过期备份'});</script>
<?php
		}
	
		include tpl('footer');
?>
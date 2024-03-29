<?php
defined('IN_RUIEC') or exit('Access Denied');
include tpl('header');
?>
	<div class="navigation">首页 &gt; 控制面板 &gt; 数据维护管理 &gt; 查看备份数据</div>
	
	<div class="tools_box">
		<div class="tools_bar">
			<a href="javascript:;" onclick="_url('?file=<?php echo $file; ?>',{n:'sys_database_bak',t:'数据库备份'});" class="tools_btn"><span><b class="add">备份数据</b></span></a>
			<a href="javascript:;" onclick="_url('?file=<?php echo $file; ?>&action=import',{n:'sys_database_imp',t:'还原数据'});" class="tools_btn"><span><b class="add">还原数据</b></span></a>
		</div>
	</div>

	<div class="tab_nav tab_nav_ex">备份系列 <?php echo $dir;?> 共<?php echo $tid;?>个分卷</div>
	
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="msgtable">
		<tr>
			<th width="30%">文件名称</th>
			<th width="10%">文件大小(MB)</th>
			<th width="20%">修改时间</th>
			<th width="10%">分卷</th>
			<th>操作</th>
		</tr>
<?php
	for($i = 1; $i <= $tid; $i++) {
		$v = $sqls[$i];
?>
		<tr align="center">
			<td align="left">
				<div class="icon_sql" style="float:left;margin-right:10px;"></div>
				<a href="<?php RE_PATH;?>file/backup/<?php echo $dir;?>/<?php echo $v['filename'];?>" title="点鼠标右键另存为保存此文件" target="_blank"><?php echo $v['filename'];?></a>
			</td>
			<td><?php echo $v['filesize'];?></td>
			<td title="备份时间:<?php echo $v['btime'];?>"><?php echo $v['mtime'];?></td>
			<td><?php echo $v['number'];?></td>
			<td class="my_option_m">
				<a href="javascript:;" onclick="db_import('<?php echo $dir.'/'.$v['filename'];?>');" title="导入备份文件" class="icon_import"></a>&nbsp;&nbsp;
				<a href="<?php RE_PATH;?>file/backup/<?php echo $dir;?>/<?php echo $v['filename'];?>" title="下载备份文件" target="_blank" class="icon_save" ></a>&nbsp;&nbsp;
				<a href="javascript:;" onclick="db_bak_delete('<?php echo $v['filename'];?>');" title="删除备份文件" class="icon_delete"></a>
			</td>
		</tr>
<?php
	}
?>
	</table>

<script type="text/javascript">

	//导入
	function db_import(filename){
		var info = '确定要导入备份文件['+filename+']吗?<br /><span style="font-size:14px;color:red;">该操作会导致现有数据被覆盖<br />此操作不可恢复!!!!</span>';
		var url = '?file=<?php echo $file; ?>&action=import&v_ruiec_sm_import=ruiec&filename='+encodeURIComponent(filename);
		_cf({info:info,url:url,title:'导入'});
		art.dialog({id:'lock',title:false,lock:true,background:'#fff',opacity:0.3});
	}
	
	// 删除
	function db_bak_delete(filename){
		var info = '确定要删除备份文件['+filename+']吗?<br /><span style="font-size:14px;color:red;">此操作不可恢复!!!</span>';
		var url = '?file=<?php echo $file; ?>&action=delete&dir='+encodeURIComponent('<?php echo $dir; ?>')+'&filenames='+encodeURIComponent(filename);
		_cf({info:info,url:url,title:'删除'});
	}
</script>

<?php include tpl('footer');?>
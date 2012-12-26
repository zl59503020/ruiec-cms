<?php
defined('IN_RUIEC') or exit('Access Denied');
include tpl('header');
?>
	<div class="navigation">首页 &gt; 控制面板 &gt; 数据维护管理</div>
	
	<div class="tools_box">
		<div class="tools_bar">
			<a href="javascript:;" onclick="_url('?file=<?php echo $file; ?>&action=import',{n:'sys_database_imp',t:'还原数据'});" class="tools_btn"><span><b class="add">还原数据</b></span></a>
		</div>
	</div>

	<div class="tab_nav tab_nav_ex">数据库管理维护</div>
	
	<form action="" method="post" id="myform_db" name="myform_db" >
	
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="msgtable">
			<tr>
				<th width="8%">选择</th>
				<th width="20%">表名</th>
				<th width="15%">表注释</th>
				<th width="10%">记录数</th>
				<th width="20%">大小</th>
				<th width="10%">碎片</th>
				<th>操作</th>
			</tr>
<?php
	foreach($dtables as $k=>$v) {
?>
			<tr align="center">
				<td>
					<input type="checkbox" name="tables[]" value="<?php echo $v['name'];?>" checked />
					<input type="hidden" name="sizes[<?php echo $v['name'];?>]" value="<?php echo $v['tsize'];?>"/>
				</td>
				<td align="left"><?php echo $v['name'];?></td>
				<td>
					<a href="javascript:;" onclick="chk_tabnote(this,'<?php echo $v['name'];?>','<?php echo $v['note'];?>');" title="点击修改表注释"><?php echo $v['note'] ? $v['note'] : '--';?></a>
				</td>
				<td><?php echo $v['rows'];?></td>
				<td>
					<?php $_p = ($dtotalsize == 0) ? 0 : round(100*$v['tsize']/$dtotalsize); ?>
					<div class="perc" style="width:100px" title="<?php echo $_p; ?>%"><div style="width:<?php echo $_p; ?>%;">&nbsp;</div></div>
					<span title="数据:<?php echo $v['size'];?> 索引:<?php echo $v['index'];?>">(<?php echo $v['tsize'];?> MB)</span>
				</td>
				<td><?php echo $v['chip'];?></td>
				<td class="my_option_m">
					<a href="javascript:;" onclick="optimize_tab('<?php echo $v['name'];?>');">优化</a>
					<a href="javascript:;" onclick="repair_tab('<?php echo $v['name'];?>');">修复</a>
					<a href="javascript:;" onclick="down_tab('<?php echo $v['name'];?>');">下载</a>
					<a href="javascript:;" onclick="dict_tab('<?php echo $v['name'];?>','<?php echo urlencode($v['note']);?>');">字典</a>
				</td>
			</tr>
<?php
	}
	if(count($tables) > 0){
?>
			<tr>
				<td colspan="7" align="center" style="background:#F1E7CB;color:red;height:20px;font-weight:bold;">
					其他系统表[共<?php echo $totalsize;?>M,<?php echo count($tables);?>个表]
				</td>
			</tr>
<?php
		foreach($tables as $k=>$v) {
?>
			<tr align="center">
				<td>
					<input type="checkbox" name="tables[]" value="<?php echo $v['name'];?>" checked />
					<input type="hidden" name="sizes[<?php echo $v['name'];?>]" value="<?php echo $v['tsize'];?>"/>
				</td>
				<td align="left"><?php echo $v['name'];?></td>
				<td>
					<a href="javascript:;" onclick="chk_tabnote(this,'<?php echo $v['name'];?>','<?php echo $v['note'];?>');" title="点击修改表注释"><?php echo $v['note'] ? $v['note'] : '--';?></a>
				</td>
				<td><?php echo $v['rows'];?></td>
				<td>
					<?php $_p = ($dtotalsize == 0) ? 0 : round(100*$v['tsize']/$dtotalsize); ?>
					<div class="perc" style="width:100px" title="<?php echo $_p; ?>%"><div style="width:<?php echo $_p; ?>%;">&nbsp;</div></div>
					<span title="数据:<?php echo $v['size'];?> 索引:<?php echo $v['index'];?>">(<?php echo $v['tsize'];?> MB)</span>
				</td>
				<td><?php echo $v['chip'];?></td>
				<td class="my_option_m">
					<a href="javascript:;" onclick="optimize_tab('<?php echo $v['name'];?>');">优化</a>
					<a href="javascript:;" onclick="repair_tab('<?php echo $v['name'];?>');">修复</a>
					<a href="javascript:;" onclick="down_tab('<?php echo $v['name'];?>');">下载</a>
					<a href="javascript:;" onclick="dict_tab('<?php echo $v['name'];?>','<?php echo urlencode($v['note']);?>');">字典</a>
				</td>
			</tr>
<?php
		}
	}
?>
		</table>
		<div class="line10"></div>
		
		<div class="foot_btn_box" style="text-align:left;">
			<input type="hidden" name="file" value="<?php echo $file; ?>" />
			<input type="hidden" id="action" name="action" value="backup" />
			<input type="hidden" name="v_ruiec_sm" value="ruiec" />
			<a href="javascript:void(0);" onclick="checkAll('tables[]',true);" >全选</a>&nbsp;&nbsp;&nbsp;
			<a href="javascript:void(0);" onclick="checkAll('tables[]',false);" >全不选</a>&nbsp;&nbsp;&nbsp;
			<input type="button" value="备份选中表" onclick="dbopt('0');" class="btnSubmit" />&nbsp;&nbsp;&nbsp;
			<input type="button" value="删除选中表" onclick="dbopt('1');" class="btnSearch" title="为了安全起见,仅允许删除非RuiecCMS系统表." <?php echo (count($tables) > 0) ? '' : 'disabled'; ?>  />
		</div>
	
	</form>

<script type="text/javascript">

	$(function(){
		form_check_init();
	});

	// 修改表注释
	function chk_tabnote(elem,tbName,note){
		art.dialog.prompt('请输入新的表注释.', function (val) {
			var url = '?file=<?php echo $file;?>&action=comment&table='+tbName+'&note='+encodeURIComponent(val);
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
		}, note);
	}
	
	//	优化表
	function optimize_tab(table){
		var url = '?file=<?php echo $file;?>&action=optimize&tables='+table;
		$.ajax({
			url:url,
			success:function(responseText){
				if(responseText == '0'){
					parent.jsprint("优化成功!", "", "Success");
					window.location.reload();
				}else{
					parent.jsprint("优化失败!", "", "Error");
					art.dialog({
						title: '优化失败',
						lock: true,
						background: '#fff',
						opacity: 0.5,
						content: responseText,
						ok: true
					});
				}
			}
		});
	}
	
	//	修复表
	function repair_tab(table){
		var url = '?file=<?php echo $file;?>&action=repair&tables='+table;
		$.ajax({
			url:url,
			success:function(responseText){
				if(responseText == '0'){
					parent.jsprint("修复成功!", "", "Success");
					window.location.reload();
				}else{
					parent.jsprint("修复失败!", "", "Error");
					art.dialog({
						title: '修复失败',
						lock: true,
						background: '#fff',
						opacity: 0.5,
						content: responseText,
						ok: true
					});
				}
			}
		});
	}
	
	//	下载表
	function down_tab(table){
		var url = '?file=<?php echo $file;?>&action=export&table='+table;
		window.open(url);
	}
	
	//	字典
	function dict_tab(t,n){
		var url = '?file=<?php echo $file;?>&action=dict&table='+t+'&note='+n;
		$.ajax({
			url:url,
			success:function(responseText){
				art.dialog({
					id: 'show_dict',
					title: '查看表字典',
					lock: true,
					background: '#fff',
					opacity: 0.5,
					content: responseText,
					ok: true
				});
				$('#myform_dict').ajaxForm({
					beforeSend : function() {art.dialog({id:'lock',title:false,lock:true,background:'#fff',opacity:0.3});},
					success : function(responseText, statusText, xhr, $form){
						art.dialog.list['lock'].close();
						if(statusText == 'success'){
							if(responseText == '0'){
								parent.jsprint("更新成功!", "", "Success");
								art.dialog.list['show_dict'].close();
							}else{
								parent.jsprint("更新失败!", "", "Error");
								art.dialog({
									title: '更新失败',
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
			}
		});
	}
	
	//备份或删除
	function dbopt(type){
		if(ck_sel('tables[]')){
			art.dialog.confirm('确定要'+((type=='0')?'备份':'删除')+'所选的表吗?<br /><span style="font-size:14px;color:red;">'+((type=='0')?'':'提示:如未备份,此操作不可恢复!!!<br/>[只能删除非本系统数据表.]')+'</span>', function(){
				if(type == '0'){
					$('#action').val('backup');
				}else {
					$('#action').val('drop');
				}
				$('#myform_db').submit();
			});
		}else{
			alert('请选择要'+((type=='0')?'备份':'删除')+'的表!');
		}
	}
		
	//	备份.AJAX
	function obj_bak(data){
		if(data == '0'){
			parent.jsprint("备份成功!", "", "Success");
			window.location = '?file=<?php echo $file; ?>&action=import';
		}
		var jsData = z.json(data);
		if(jsData != null){
			art.dialog.list['art_show_bak'].title(jsData.title);
			art.dialog.list['art_show_bak'].content(jsData.content);
			setTimeout(function(){$.ajax({url:jsData.url,success:obj_bak});},3000);
		}else{
			art.dialog.list['art_show_bak'].content(data);
		}
	}


</script>
<?php include tpl('footer'); ?>

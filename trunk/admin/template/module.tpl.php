<?php
defined('IN_RUIEC') or exit('Access Denied');
include tpl('header');
?>
	<div class="navigation">首页 &gt; 控制面板 &gt; 系统模型管理</div>
	
	<div class="tools_box">
		<div class="tools_bar">
			<!--
			<div class="search_box">
				<input type="text" id="txtKeywords" class="txtInput" />
				<input type="button" value="搜 索" class="btnSearch" onclick="btnSearch_Click" />
			</div>
			-->
			<a href="javascript:;" onclick="_url('?file=<?php echo $file; ?>&action=add',{n:'sys_module_add',t:'添加模板'});" class="tools_btn"><span><b class="add">添加模块</b></span></a>
			<!--
			<a href="javascript:void(0);" onclick="checkAll(this);" class="tools_btn"><span><b class="all">全选</b></span></a>
			<a href="?action=del" onclick="return false;" class="tools_btn"><span><b class="delete">批量删除</b></span></a>
			-->
		</div>
	</div>

	<div class="tab_nav tab_nav_ex">模块管理</div>
	
	<form action="" method="post" id="myform" name="myform" >
	
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="msgtable">
		<tr>
			<th width="10%">排序</th>
			<th width="10%">模块ID</th>
			<th width="15%">模块名称</th>
			<th width="10%">目录</th>
			<th width="10%">类型</th>
			<th width="10%">导航</th>
			<th width="10%">模型</th>
			<th width="10%">安装日期</th>
			<th>管理</th>
		</tr>
<?php
	if($modules){
		foreach($modules as $v) {
?>
		<tr align="center">
			<td><input type="text" name="listorder[<?php echo $v['moduleid'];?>]" value="<?php echo $v['listorder']; ?>" size="5" class="txtInput valid number" /></td>
			<td><?php echo $v['moduleid']; ?></td>
			<td><a href="<?php echo $v['linkurl'];?>" target="_blank"><?php echo $v['name'];?></a></td>
			<td><a href="<?php echo $v['linkurl'];?>" target="_blank"><?php echo $v['moduledir'] ? $v['moduledir'] : '--';?></a></td>
			<td><?php echo $v['islink'] ? '<span class="f_red">外链</span>' : '内置';?></td>
			<td><?php echo $v['ismenu'] ? '是' : '<span class="f_red">否</span>';?></td>
			<td title="<?php echo $v['module'];?>"><?php echo $v['modulename'];?></td>
			<td><?php echo $v['installdate']; ?></td>
			<td class="my_option_m">
				<a href="?file=<?php echo $file;?>&action=edit&modid=<?php echo $v['moduleid'];?>" class="icon_edit" title="修改"></a>&nbsp;&nbsp;
				<a href="javascript:;" onclick="md_delete(<?php echo $v['moduleid'];?>,'<?php echo $v['name'];?>');" class="icon_delete" title="删除" onclick="return _delete();"></a>&nbsp;&nbsp;
				<a href="javascript:;" onclick="_url('?file=setting&moduleid=<?php echo $v['moduleid'];?>',{n:'sys_module_add',t:'模块设置'});" class="icon_set" title="设置"></a>&nbsp;&nbsp;
				<?php if($v['disabled']) {?><a href="javascript:;" onclick="ck_disable(0,<?php echo $v['moduleid'];?>,'<?php echo $v['name'];?>');" class="icon_start" title="已禁用,点击启用"></a><?php } else {?><a href="javascript:;" onclick="ck_disable(1,<?php echo $v['moduleid'];?>,'<?php echo $v['name'];?>');" class="icon_stop" title="正常运行,点击禁用" ></a><?php } ?>
			</td>
		</tr>
<?php
		}
	}else{
?>
		<tr>
			<td align="center" colspan="9">暂无相关模块.</td>
		</tr>
<?php
	}
	if($_modules){
?>
		<tr>
			<td align="center" colspan="9" style="background:#F1E7CB;color:red;height:20px;font-weight:bold;">禁用模块</td>
		</tr>
<?php
		foreach($_modules as $v){
?>
		<tr align="center" style="background:#ECEEE5;">
			<td><input type="text" name="listorder[<?php echo $v['moduleid'];?>]" value="<?php echo $v['listorder']; ?>" size="5" class="txtInput valid number" /></td>
			<td><?php echo $v['moduleid']; ?></td>
			<td><a href="<?php echo $v['linkurl'];?>" target="_blank"><?php echo $v['name'];?></a></td>
			<td><a href="<?php echo $v['linkurl'];?>" target="_blank"><?php echo $v['moduledir'] ? $v['moduledir'] : '--';?></a></td>
			<td><?php echo $v['islink'] ? '<span class="f_red">外链</span>' : '内置';?></td>
			<td><?php echo $v['ismenu'] ? '是' : '<span class="f_red">否</span>';?></td>
			<td title="<?php echo $v['module'];?>"><?php echo $v['modulename'];?></td>
			<td><?php echo $v['installdate']; ?></td>
			<td class="my_option_m">
				<a href="?file=<?php echo $file;?>&action=edit&modid=<?php echo $v['moduleid'];?>" class="icon_edit" title="修改"></a>&nbsp;&nbsp;
				<a href="javascript:;" onclick="md_delete(<?php echo $v['moduleid'];?>,'<?php echo $v['name'];?>');" class="icon_delete" title="删除" onclick="return _delete();"></a>&nbsp;&nbsp;
				<a href="?file=setting&moduleid=<?php echo $v['moduleid'];?>" class="icon_set" title="设置"></a>&nbsp;&nbsp;
				<?php if($v['disabled']) {?><a href="javascript:;" onclick="ck_disable(0,<?php echo $v['moduleid'];?>,'<?php echo $v['name'];?>');" class="icon_start" title="已禁用,点击启用"></a><?php } else {?><a href="javascript:;" onclick="ck_disable(1,<?php echo $v['moduleid'];?>,'<?php echo $v['name'];?>');" class="icon_stop" title="正常运行,点击禁用" ></a><?php } ?>
			</td>
		</tr>
<?php
		}
	}
?>
		<tr style="background:none;">
			<td colspan="9">
				<input type="hidden" name="file" value="<?php echo $file; ?>" />
				<input type="hidden" name="action" value="order" />
				<input type="hidden" name="v_ruiec_sm" value="ruiec" />
				<input name="更新排序" type="submit" class="btnSearch" value="更新排序" style="margin-left:20px;" />
			</td>
		</tr>
	</table>
	</form>
	<div class="line10"></div>
	<div class="line10"></div>
	<div class="tab_nav tab_nav_ex">系统模型</div>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="msgtable">
		<tr>
			<th align="left">模型</th>
			<th width="15%" align="left">目录</th>
			<th width="10%" align="left">可复制</th>
			<th width="10%" align="left">可卸载</th>
			<th width="15%" align="left">作者</th>
			<th width="15%" align="left">官方网站</th>
		</tr>
<?php
	if(is_array($sys_modules)){
		foreach($sys_modules as $k=>$v) {
?>
		<tr style="height:50px;font-size:13px;">
			<td><?php echo $v['name'].'('.$v['module'].')'; ?></td>
			<td title="<?php echo RE_ROOT.'/module/'.$k.'/'; ?>"><?php echo $k; ?></td>
			<td><?php echo ($v['copy']) ? '<span style="color:red;">是</span>' : '否'; ?></td>
			<td><?php echo ($v['uninstall']) ? '<span style="color:red;">是</span>' : '否'; ?></td>
			<td><?php echo $v['author']; ?></td>
			<td><?php echo '<a href="http://'.$v['homepage'].'" target="_blank">'.$v['homepage'].'</a>'; ?></td>
		</tr>
<?php
		}
	}else{
?>
		<tr>
			<td align="center" colspan="9">暂无可用模型.</td>
		</tr>
<?php
	}
?>
	</table>

	
<script type="text/javascript">

	//表单初始化验证
    $(function () {
        form_check_init();
    });
	
	function ck_disable(v,id,name){
		var info = '确定要'+((v == 1) ? '禁' : '启')+'用 ['+name+'] 模块吗?';
		var url = '?file=<?php echo $file;?>&action=disable&value='+v+'&modid='+encodeURIComponent(id);
		_cf({info:info,url:url,title:'操作',callback:function(){window.parent.reModuleMenu();}});
		//window.parent.reModuleMenu();		//刷新频道管理
	}
	
	function md_delete(id,name){
		var info = '确定要删除 ['+name+'] 模块吗?<br /><span style="font-size:14px;color:red;">此操作不可恢复!!!</span>';
		var url = '?file=<?php echo $file;?>&action=delete&modid='+encodeURIComponent(id);
		_cf({info:info,url:url,title:'删除',callback:function(){window.parent.reModuleMenu();}});
		//window.parent.reModuleMenu();		//刷新频道管理
	}

</script>

	
<?php include tpl('footer'); ?>

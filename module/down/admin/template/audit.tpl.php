<?php
defined('IN_RUIEC') or exit('Access Denied');
include tpl('header');
?>
	<div class="navigation">首页 &gt; <?php echo $MOD['name']; ?>管理 &gt; 审核内容</div>
	
	<div class="tools_box">
		<div class="tools_bar">
			<div class="search_box">
				<input type="text" id="txtKeywords" class="txtInput" />
				<input type="button" value="搜 索" class="btnSearch" onclick="btnSearch_Click()" />
			</div>
			<a href="javascript:;" onclick="_url('?moduleid=<?php echo $moduleid; ?>');" class="tools_btn"><span><b class="add"><?php echo $MOD['name']; ?>列表</b></span></a>
		</div>
	</div>

	<div class="tab_nav tab_nav_ex">审核<?php echo $MOD['name']; ?></div>
	
	<form action="" method="post" id="myform" name="myform" >
	
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="msgtable">
			<tr>
				<th width="5%">选择</th>
				<th width="10%">分类</th>
				<th width="5%">级别</th>
				<th>标题</th>
				<th width="15%">添加时间</th>
				<th width="10%">点击</th>
				<th width="15%">操作</th>
			</tr>
<?php
	foreach($lists as $k=>$v) {
?>
			<tr align="center">
				<td>
					<input type="checkbox" name="itemid[]" value="<?php echo $v['itemid'];?>" />
				</td>
				<td align="left"><?php if(isset($v['caturl'])) { ?><a href="<?php echo $v['caturl']; ?>" ><?php echo $v['catname']; ?></a><?php } else { echo '<span style="color:red;">所属分类不存在!</span>'; } ?></td>
				<td><?php echo $v['level']; ?></td>
				<td class="my_option_m">
					<a href="<?php echo $v['linkurl']; ?>" title="<?php echo $v['alt'];?>" target="_blank"><?php echo $v['title'];?></a>
					<?php if($v['thumb'] != ''){ ?>
					<a href="javascript:;" onclick="showImg('<?php echo $v['thumb']; ?>');" class="icon_img" style="margin-top:3px;" title="有标题图片,点击预览"></a>
					<?php } ?>
				</td>
				<td><?php echo $v['adddate'];?></td>
				<td><?php echo $v['hits'];?></td>
				<td class="my_option_m">
					<a href="javascript:;" onclick="_url('?file=<?php echo $file; ?>&action=edit&moduleid=<?php echo $moduleid; ?>&itemid=<?php echo $v['itemid']; ?>',{n:'sys_editinfo',t:'编辑<?php echo $MOD['name']; ?>'});" class="icon_edit" title="编辑"></a>
					<a href="javascript:;" onclick="_audit_yes('<?php echo $v['itemid']; ?>')" class="icon_start" title="通过审核"></a>
					<a href="javascript:;" onclick="_audit_no('<?php echo $v['itemid']; ?>')" class="icon_stop" title="拒绝审核"></a>
					<a href="javascript:;" onclick="_delete('<?php echo $v['itemid']; ?>')" class="icon_delete" title="删除"></a>
				</td>
			</tr>
<?php
	}
?>
		</table>
		<div class="line10"></div>
		
		<div class="foot_btn_box" style="text-align:left;">
			<input type="hidden" name="file" value="<?php echo $file; ?>" />
			<input type="hidden" id="action" name="action" value="" />
			<input type="hidden" name="level" value="3" />
			<input type="hidden" name="v_ruiec_sm" value="ruiec" />
			<a href="javascript:void(0);" onclick="checkAll('itemid[]',true);" >全选</a>&nbsp;&nbsp;&nbsp;
			<a href="javascript:void(0);" onclick="checkAll('itemid[]','!');" >反选</a>&nbsp;&nbsp;&nbsp;
			<a href="javascript:void(0);" onclick="checkAll('itemid[]',false);" >全不选</a>&nbsp;&nbsp;&nbsp;
			<input type="button" value="还原选中内容" onclick="_reSel();" class="btnSubmit" />
			<input type="button" value="彻底删除选中内容" onclick="_deleteSel();" class="btnSearch" />
		</div>
	
	</form>
	
<script type="text/javascript">

	//表单初始化验证
    $(function () {
        form_check_init('','',{title:'操作'});
    });
	
	function _delete(id){
		var info = '确定要删除吗?<br /><span style="font-size:14px;color:red;">此操作不可恢复!!!</span>';
		var url = '?file=<?php echo $file; ?>&action=delete&moduleid=<?php echo $moduleid; ?>&itemid='+encodeURIComponent(id);
		_cf({info:info,url:url,title:'删除'});
	}
	
	function _deleteSel(){
		art.dialog.confirm('确定要删除选中内容吗?<br /><span style="font-size:14px;color:red;">此操作不可恢复!!!</span>', function(){
			$('#action').val('delete');
			$('#myform').submit();
		});
	}
	
	function _reduction(id){
		var info = '确定要把选中内容还原吗?';
		var url = '?moduleid=<?php echo $moduleid; ?>&action=restore&itemid='+encodeURIComponent(id);
		_cf({info:info,url:url,title:'还原'});
	}
	
	function _reSel(){
		art.dialog.confirm('确定要把选中内容还原吗?', function(){
			$('#action').val('restore');
			$('#myform').submit();
		});
	}
	
	function _audit_yes(id){
		var info = '确定要审核通过该内容吗?';
		var url = '?moduleid=<?php echo $moduleid; ?>&action=status&status=3&itemid='+encodeURIComponent(id);
		_cf({info:info,url:url,title:'审核'});
	}
	
	function _audit_no(id){
		var info = '确定要拒绝审核该内容吗?';
		var url = '?moduleid=<?php echo $moduleid; ?>&action=status&status=1&itemid='+encodeURIComponent(id);
		_cf({info:info,url:url,title:'拒绝'});
	}

</script>
	
<?php include tpl('footer');?>
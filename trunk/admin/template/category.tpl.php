<?php
defined('IN_RUIEC') or exit('Access Denied');
include tpl('header');
?>

<script type="text/javascript">
	
	function _showc(id){
		var trs = $('tr[_id='+id+']');
		(trs[0].style.display == '') ? trs.hide() : trs.show();
	}
	
</script>

<div class="navigation">首页 &gt; 分类管理 &gt; <?php echo $MOD['name']; ?>分类</div>
	
	<div class="tools_box">
		<div class="tools_bar">
			<a href="?file=<?php echo $file;?>&mid=<?php echo $mid; ?>&action=add" class="tools_btn"><span><b class="add">添加分类</b></span></a>
		</div>
	</div>

	<div class="tab_nav tab_nav_ex">分类管理</div>

	<form action="" method="post" id="myform_cat" name="myform_cat" >
	
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="msgtable">
			<tr>
				<th width="5%">选择</th>
				<th width="10%">排序</th>
				<th width="10%">ID</th>
				<th width="30%">分类名称</th>
				<th width="15%">分类目录</th>
				<th>操作</th>
			</tr>
<?php
	function show_catinfo($childs,$dsplay='',$_i=0){
		global $do;
		foreach($childs as $k=>$v) {
			$_childs = $do->get_catchild($v['catid']);
?>
			<tr align="center" style="display:<?php echo $dsplay; ?>" _id="<?php echo $v['parentid']; ?>">
				<td>
					<input type="checkbox" name="catid[]" value="<?php echo $v['catid'];?>" />
				</td>
				<td>
					<input type="text" name="listorder[<?php echo $v['catid'];?>]" value="<?php echo $v['listorder'];?>" size="5" class="txtInput valid number" />
				</td>
				<td class="my_option_m"><span><?php echo $v['catid']; ?></span></td>
				<td align="left">
<?php
			switch($_i){
				case 0 : break;
				case 1 : echo '|----';break;
				default : echo '|----|----';break;
			}
?>
					<!--<div style="float:left;visibility:<?php echo (count($_childs) > 0) ? '' : 'hidden';?>;">+</div>-->
					<?php echo (count($_childs) > 0) ? '<a href="javascript:;" onclick="_showc('.$v['catid'].')">+</a>' : ' ';?>
					<input type="text" name="catname[<?php echo $v['catid'];?>]" value="<?php echo $v['catname'];?>" class="txtInput valid number" />
				</td>
				<td align="left">
					<input type="text" name="catdir[<?php echo $v['catid'];?>]" value="<?php echo $v['catdir'];?>" class="txtInput valid number" />
				</td>
				<td class="my_option_m">
					<a href="javascript:;" onclick="" class="icon_import" title="添加子分类"></a>
					<a href="javascript:;" onclick="" class="icon_edit" title="编辑"></a>
					<a href="javascript:;" onclick="_delete('<?php echo $v['catid']; ?>')" class="icon_delete" title="删除"></a>
				</td>
			</tr>
<?php
			//if(count($_childs) > 0) show_catinfo($_childs,'none',($_i+1));
			if(count($_childs) > 0) show_catinfo($_childs,'none',($_i+1));
		}
	}
	show_catinfo($RECAT);
?>
		</table>
		
		<div class="foot_btn_box" style="text-align:left;">
			<input type="hidden" name="file" value="<?php echo $file; ?>" />
			<input type="hidden" name="mid" value="<?php echo $mid; ?>" />
			<input type="hidden" id="action" name="action" value="" />
			<input type="hidden" name="v_ruiec_sm" value="ruiec" />
			<a href="javascript:void(0);" onclick="checkAll('catid[]',true);" >全选</a>&nbsp;&nbsp;&nbsp;
			<a href="javascript:void(0);" onclick="checkAll('catid[]','!');" >反选</a>&nbsp;&nbsp;&nbsp;
			<a href="javascript:void(0);" onclick="checkAll('catid[]',false);" >全不选</a>&nbsp;&nbsp;&nbsp;
			<input type="button" value="更新分类数据" onclick="" class="btnSubmit" />&nbsp;&nbsp;&nbsp;
			<input type="button" value="删除选中分类" onclick="" class="btnSearch" />
		</div>
	
	</form>
		
	<div class="line10"></div>


<?php include tpl('footer');?>
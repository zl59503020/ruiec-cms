<?php
defined('IN_RUIEC') or exit('Access Denied');
include tpl('header');
?>

<script type="text/javascript">

	 /* //表单验证
    $(function () {
        $("#myform").validate({
            invalidHandler: function (e, validator) {
                parent.jsprint("有 " + validator.numberOfInvalids() + " 项填写有误，请检查！", "", "Warning");
            },
            errorPlacement: function (lable, element) {
                if (element.parents(".tab_con").css('display') != 'none') {
                    element.ligerTip({ content: lable.html(), appendIdTo: lable });
                }
            },
            success: function (lable) {
                lable.ligerHideTip();
            }
        });
		$('#myform').ajaxForm({
			beforeSend : function() { art.dialog({id:'lock',title:false,lock:true,background:'#fff',opacity:0.3}); },
			success : function(responseText, statusText, xhr, $form){
				art.dialog.list['lock'].close();
				if(statusText == 'success'){
					var opt = ($('#action').val() == 'level') ? '改变' : '删除';
					if(responseText == '0'){
						parent.jsprint(opt+"成功!", "", "Success");
						//window.location = '?file=<?php echo $file; ?>&moduleid=<?php echo $moduleid; ?>';
						window.location.reload();
					}else{
						parent.jsprint(opt+"失败!", "", "Error");
						art.dialog({
							title: opt+'失败',
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
    }); */

	//表单初始化验证
    $(function () {
        form_check_init('','',{title:''});
    });
	
	function _delete(id){
		var info = '确定要删除吗?<br /><span style="font-size:14px;color:red;">此操作可恢复,可在回收站内找回!!!</span>';
		var url = '?file=<?php echo $file;?>&action=delete&moduleid=<?php echo $moduleid; ?>&recycle=true&itemid='+encodeURIComponent(id);
		_cf({info:info,url:url,title:'删除'});
	}
	
	function _deleteSel(){
		art.dialog.confirm('确定要删除选中内容吗?<br /><span style="font-size:14px;color:red;">此操作可恢复,可在回收站内找回!!!</span>', function(){
			$('#action').val('delete');
			$('#myform').submit();
		});
	}
	
	function _chanlevel(){
		art.dialog.confirm('确定要改变选中的级别吗?', function(){
			$('#action').val('level');
			$('#myform').submit();
		});
	}
	
	function search_news(){
		if($('#txtKeywords').val() == ''){
			alert('请输入搜索关键词!');
			$('#txtKeywords').focus();
		}else{
			$('#ls_content').append('<tr><td>Hello</td><td>Hello</td><td>Hello</td><td>Hello</td><td>Hello</td><td>Hello</td><td>Hello</td></tr>');
		}
	}

</script>

	<div class="navigation">首页 &gt; <?php echo $MOD['name']; ?>管理 &gt; <?php echo $MOD['name']; ?>列表</div>
	
	<div class="tools_box">
		<div class="tools_bar">
			<div class="search_box">
				<input type="text" id="txtKeywords" class="txtInput" />
				<input type="button" value="搜 索" class="btnSearch" onclick="search_news()" />
			</div>
			<a href="javascript:;" onclick="_url('?moduleid=<?php echo $moduleid; ?>&action=add',{n:'sys_addinfo',t:'添加<?php echo $MOD['name']; ?>'});" class="tools_btn"><span><b class="add">添加<?php echo $MOD['name']; ?></b></span></a>
			<a href="javascript:;" onclick="_url('?moduleid=<?php echo $moduleid; ?>&action=recycle');" class="tools_btn"><span><b class="remove">回收站</b></span></a>
		</div>
	</div>

	<div class="tab_nav tab_nav_ex"><?php echo $MOD['name']; ?>列表</div>
	
	<form action="" method="post" id="myform" name="myform" >
	
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="msgtable">
		  <tbody>
			<tr>
				<th width="5%">选择</th>
				<th width="10%">分类</th>
				<th width="5%">级别</th>
				<th>标题</th>
				<th width="15%">添加时间</th>
				<th width="10%">下载/点击</th>
				<th width="15%">操作</th>
			</tr>
		  </tbody>
		  <tbody id="ls_content">
<?php
	foreach($lists as $k=>$v) {
?>
			<tr align="center">
				<td>
					<input type="checkbox" name="itemid[]" value="<?php echo $v['itemid'];?>" />
				</td>
				<td align="left"><a href="<?php echo $v['caturl']; ?>" target="_blank"><?php echo $v['catname']; ?></a></td>
				<td><?php echo $v['level']; ?></td>
				<td class="my_option_m">
					<a href="<?php echo $v['linkurl']; ?>" title="<?php echo $v['alt'];?>" target="_blank"><?php echo $v['title'];?></a>
					<?php if($v['thumb'] != ''){ ?>
					<a href="javascript:;" onclick="showImg('<?php echo $v['thumb']; ?>');" class="icon_img" style="margin-top:3px;" title="有标题图片,点击预览"></a>
					<?php } ?>
				</td>
				<td><?php echo $v['adddate'];?></td>
				<td><?php echo $v['downcount'];?>/<?php echo $v['hits'];?></td>
				<td class="my_option_m">
					<a href="javascript:;" onclick="_url('?moduleid=<?php echo $moduleid; ?>&action=edit&itemid=<?php echo $v['itemid']; ?>',{n:'edit_article_<?php echo $v['itemid']; ?>',t:'编辑<?php echo $MOD['name'].' _ '.$v['title']; ?>'});" class="icon_edit" title="编辑"></a>
					<a href="javascript:;" onclick="_delete('<?php echo $v['itemid']; ?>')" class="icon_delete" title="删除"></a>
				</td>
			</tr>
<?php
	}
?>
		  </tbody>
		</table>
		<div class="line10"></div>
		
		<div class="foot_btn_box" style="text-align:left;">
			<input type="hidden" name="file" value="<?php echo $file; ?>" />
			<input type="hidden" id="action" name="action" value="" />
			<input type="hidden" name="recycle" value="true" />
			<input type="hidden" name="v_ruiec_sm" value="ruiec" />
			<a href="javascript:void(0);" onclick="checkAll('itemid[]',true);" >全选</a>&nbsp;&nbsp;&nbsp;
			<a href="javascript:void(0);" onclick="checkAll('itemid[]','!');" >反选</a>&nbsp;&nbsp;&nbsp;
			<a href="javascript:void(0);" onclick="checkAll('itemid[]',false);" >全不选</a>&nbsp;&nbsp;&nbsp;
			选中级别<?php echo level_select('level', '选择级别', 0, 'id="level" class="select" onchange="_chanlevel();"');?>
			<input type="button" value="删除选中新闻" onclick="_deleteSel();" class="btnSearch" />
		</div>
	
	</form>
	
<?php include tpl('footer');?>
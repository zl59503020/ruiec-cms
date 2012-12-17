﻿<?php
defined('IN_RUIEC') or exit('Access Denied');
include tpl('header');
?>

<script type="text/javascript">
    //表单验证
    $(function () {
        $("#myform").validate({
            invalidHandler: function (e, validator) {
                parent.jsprint("有 " + validator.numberOfInvalids() + " 项填写有误，请检查！", "", "Warning");
            },
            errorPlacement: function (lable, element) {
                //可见元素显示错误提示
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
					if(responseText == '0'){
						parent.jsprint("添加成功!", "", "Success");
						//window.location = '?file=<?php echo $file; ?>&moduleid=<?php echo $moduleid; ?>';
						window.location.reload();
					}else{
						parent.jsprint("添加失败!", "", "Error");
						art.dialog({
							title: '添加失败',
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
	
	// 远程或本地
	function ckwebloc(elem){
		if(elem.checked){
			$('#locttbd').hide();
			$('#wurltbd').show();
		}else{
			$('#wurltbd').hide();
			$('#locttbd').show();
		}
	}
	
</script>


	<div class="navigation">首页 &gt; <?php echo $MOD['name']; ?>管理 &gt; <?php echo '添加'.$MOD['name']; ?></div>

	<div id="contentTab">

		<form action="" method="post" id="myform" name="myform" enctype="multipart/form-data">

			<div>
				<table class="form_table">
					<col width="180px"></col>
					<tbody>
						<tr>
							<th>所属分类：</th>
							<td>
								<?php echo category_select('post[catid]', '请选择', 0, $moduleid, 'id="sel_catid" class="select required"');?>
								<input type="checkbox" name="post[islink]" value="1" onclick="ckwebloc(this);" /> 外部链接
							</td>
						</tr>
						<tr>
							<th>标题：</th>
							<td>
								<input type="text" name="post[title]" class="txtInput normal required" />&nbsp;&nbsp;&nbsp;
								<?php echo level_select('post[level]', '级别', 0, 'id="level" class="select"');?>
							</td>
						</tr>
						<tr>
							<th>标题图片：</th>
							<td>
								<input type="text" id="thumb" name="post[thumb]" class="txtInput normal f_l" />
								<span><a href="javascript:upfile('thumb',100,100,true);" class="files"></a></span>
								<span style="margin:0px 5px;"><a href="javascript:showImg($('#thumb').val());">预览</a></span>
							</td>
						</tr>
					</tbody>
					<tbody id="locttbd">
						<tr>
							<th>内容:</th>
							<td>
								<textarea name="post[content]" id="content" class="normal required" style="width:90%;height:400px;"></textarea>
								<?php start_editor('content');?>
							</td>
						</tr>
						<tr>
							<th>内容选项:</th>
							<td>
								<input type="checkbox" name="post[save_remotepic]" value="1"<?php if($MOD['save_remotepic']) echo 'checked';?>/>下载远程图片&nbsp;&nbsp;
								<input type="checkbox" name="post[clear_link]" value="1"<?php if($MOD['clear_link']) echo 'checked';?>/>清除链接&nbsp;&nbsp;
								截取内容 <input name="post[introduce_length]" type="text" size="2" value="<?php echo $MOD['introduce_length']?>"/> 个字符为简介
							</td>
						</tr>
					</tbody>
					<tbody id="wurltbd" style="display:none;">
						<tr>
							<th>链接地址:</th>
							<td>
								<input name="post[linkurl]" type="text" size="60" class="txtInput required" />
							</td>
						</tr>
					</tbody>
					<tbody>
						<tr>
							<th>简介:</th>
							<td>
								<textarea name="post[introduce]" style="width:90%;height:45px;"></textarea>
							</td>
						</tr>
						<tr>
							<th>相关信息:</th>
							<td>
								作者:<input type="text" size="10" name="post[author]" id="author" class="txtInput"/>&nbsp;&nbsp;
								来源:<input type="text" size="12" name="post[copyfrom]" id="copyfrom" class="txtInput"/>&nbsp;&nbsp;
								来源链接 <input type="text" size="25" name="post[fromurl]" id="fromurl" class="txtInput"/> 
							</td>
						</tr>
						<tr>
							<th>关键词:</th>
							<td>
								<input name="post[tag]" type="text" size="60" class="txtInput" /><?php tips('多个关键词请用空格隔开');?>
							</td>
						</tr>
						<tr>
							<th>状态:</th>
							<td>
								<input type="radio" name="post[status]" value="3" id="status_3" checked /><label for="status_3"> 通过</label>
								<input type="radio" name="post[status]" value="2" id="status_2"/><label for="status_2">  待审</label>
								<input type="radio" name="post[status]" value="1" id="status_1"/><label for="status_1">  拒绝</label>
								<input type="radio" name="post[status]" value="0" id="status_0"/><label for="status_0">  删除</label>
							</td>
						</tr>
						<tr>
							<th>添加时间:</th>
							<td><input type="text" size="22" name="post[addtime]" class="txtInput" /></td>
						</tr>
						<tr>
							<th>浏览次数:</th>
							<td><input name="post[hits]" type="text" size="10" value="0" class="txtInput" /></td>
						</tr>
						<tr>
							<th>内容模板:</th>
							<td><?php echo tpl_select('show', $module, 'post[template]', '默认模板', '', 'id="template" class="select"');?><?php tips('如果没有特殊需要，一般不需要选择<br/>系统会自动继承分类或模块设置');?></td>
						</tr>
						<tr>
							<th>自定义文件名:</th>
							<td><input type="text" size="50" name="post[filename]" class="txtInput" /></td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="foot_btn_box">
				<input type="hidden" name="file" value="<?php echo $file; ?>" />
				<input type="hidden" name="action" value="<?php echo $action; ?>" />
				<input type="hidden" name="itemid" value="<?php echo $itemid; ?>" />
				<input type="hidden" name="v_ruiec_sm" value="ruiec" />
				<input name="提交" type="submit" value="提交保存" class="btnSubmit" onclick="___initData();" />&nbsp;
				<input name="重置" type="reset" class="btnSubmit" value="重 置" />
			</div>

		</form>
		
	</div>

<?php include tpl('footer');?>
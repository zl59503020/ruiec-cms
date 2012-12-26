<?php
defined('IN_RUIEC') or exit('Access Denied');
include tpl('header');
?>
	<div class="navigation">首页 &gt; <?php echo $MOD['name']; ?>管理 &gt; <?php echo '编辑'.$MOD['name']; ?></div>

	<div id="contentTab">

		<form action="" method="post" id="myform" name="myform" enctype="multipart/form-data">

			<div>
				<table class="form_table">
					<col width="180px"></col>
					<tbody>
						<tr>
							<th>所属分类：</th>
							<td>
								<?php echo category_select('post[catid]', '请选择', $catid, $moduleid, 'id="sel_catid" class="select required"');?>
								<input type="checkbox" name="post[islink]" value="1" onclick="ckwebloc(this);" <?php if($islink) echo 'checked';?> /> 外部链接
							</td>
						</tr>
						<tr>
							<th>标题：</th>
							<td>
								<input type="text" name="post[title]" value="<?php echo _htmlspecialchars($title); ?>" class="txtInput normal required" />&nbsp;&nbsp;&nbsp;
								<?php echo level_select('post[level]', '级别', 0, 'id="level" class="select"');?>
							</td>
						</tr>
						<tr>
							<th>标题图片：</th>
							<td>
								<input type="text" id="thumb" name="post[thumb]" value="<?php echo $thumb; ?>" class="txtInput normal f_l" />
								<span><a href="javascript:upfile('thumb',100,100,true);" class="files"></a></span>
								<span style="margin:0px 5px;"><a href="javascript:showImg($('#thumb').val());">预览</a></span>
							</td>
						</tr>
					</tbody>
					<tbody id="locttbd" <?php if($islink) echo 'style="display:none;"'; ?>>
						<tr>
							<th>资源链接[下载地址]：</th>
							<td>
								<input type="text" id="downurl" name="post[downurl]" value="<?php echo $downurl; ?>" class="txtInput normal f_l" />
								<span><a href="javascript:_upfile('downurl');" class="files"></a></span>
							</td>
						</tr>
						<tr>
							<th>内容:</th>
							<td>
								<textarea name="post[content]" id="content" class="normal required" style="width:90%;height:400px;"><?php echo $content;?></textarea>
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
					<tbody id="wurltbd" <?php if(!$islink) echo 'style="display:none;"'; ?>>
						<tr>
							<th>链接地址:</th>
							<td>
								<input name="post[linkurl]" type="text" size="60" value="<?php echo $linkurl; ?>" class="txtInput required" />
							</td>
						</tr>
					</tbody>
					<tbody>
						<tr>
							<th>简介:</th>
							<td>
								<textarea name="post[introduce]" style="width:90%;height:45px;"><?php echo $introduce; ?></textarea>
							</td>
						</tr>
						<tr>
							<th>相关信息:</th>
							<td>
								作者:<input type="text" size="10" name="post[author]" id="author" value="<?php echo $author; ?>" class="txtInput"/>&nbsp;&nbsp;
								来源:<input type="text" size="12" name="post[copyfrom]" id="copyfrom" value="<?php echo $copyfrom; ?>" class="txtInput"/>&nbsp;&nbsp;
								来源链接 <input type="text" size="25" name="post[fromurl]" id="fromurl" value="<?php echo $fromurl; ?>" class="txtInput"/> 
							</td>
						</tr>
						<tr>
							<th>关键词:</th>
							<td>
								<input name="post[tag]" type="text" size="60" value="<?php echo $tag; ?>" class="txtInput" /><?php tips('多个关键词请用空格隔开');?>
							</td>
						</tr>
						<tr>
							<th>状态:</th>
							<td>
								<input type="radio" name="post[status]" value="3" id="status_3" <?php if($status == 3) echo 'checked'; ?> /><label for="status_3"> 通过</label>
								<input type="radio" name="post[status]" value="2" id="status_2" <?php if($status == 2) echo 'checked'; ?>/><label for="status_2">  待审</label>
								<input type="radio" name="post[status]" value="1" id="status_1" <?php if($status == 1) echo 'checked'; ?>/><label for="status_1">  拒绝</label>
								<input type="radio" name="post[status]" value="0" id="status_0" <?php if($status == 0) echo 'checked'; ?>/><label for="status_0">  删除</label>
							</td>
						</tr>
						<tr>
							<th>添加时间:</th>
							<td><input type="text" size="22" name="post[addtime]" value="<?php echo $addtime; ?>" class="txtInput" /></td>
						</tr>
						<tr>
							<th>浏览次数:</th>
							<td>
								<input name="post[hits]" type="text" size="10" value="<?php echo $hits; ?>" class="txtInput" />
								下载次数:
								<input name="post[downcount]" type="text" size="10" value="<?php echo $downcount; ?>" class="txtInput" />
							</td>
						</tr>
						<tr>
							<th>内容模板:</th>
							<td><?php echo tpl_select('show', $module, 'post[template]', '默认模板', $template, 'id="template" class="select"');?><?php tips('如果没有特殊需要，一般不需要选择<br/>系统会自动继承分类或模块设置');?></td>
						</tr>
						<tr>
							<th>自定义文件名:</th>
							<td><input type="text" size="50" name="post[filename]" value="<?php echo $filename; ?>" class="txtInput" /></td>
						</tr>
						<?php echo $FD ? fields_html('th', 'td', $item) : '';?>
					</tbody>
				</table>
			</div>

			<div class="foot_btn_box">
				<input type="hidden" name="file" value="<?php echo $file; ?>" />
				<input type="hidden" name="action" value="<?php echo $action; ?>" />
				<input type="hidden" name="itemid" value="<?php echo $itemid; ?>" />
				<input type="hidden" name="v_ruiec_sm" value="ruiec" />
				<input name="提交" type="submit" value="提交更新" class="btnSubmit" onclick="___initData();" />&nbsp;
				<input name="重置" type="reset" class="btnSubmit" value="重 置" />
			</div>

		</form>
		
	</div>

<script type="text/javascript">
    
	//表单初始化验证
    $(function () {
        form_check_init('','',{title:'更新'});
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
<?php include tpl('footer');?>
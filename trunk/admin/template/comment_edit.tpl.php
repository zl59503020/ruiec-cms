<?php include tpl('header'); ?>

	<div class="navigation">首页 &gt; 控制面板 &gt; 查看评论详细</div>

	<div id="contentTab">

		<ul class="tab_nav">
			<li class="selected">评论详细信息</li>
		</ul>
		
		<form action="" method="post" id="myform" name="myform" enctype="multipart/form-data">
		
			<!--	网站基本设置	-->
			<div class="tab_con" style="display:block;">
				<table class="form_table">
					<col width="180px"></col>
					<tbody>
						<tr>
							<th>评论目标：</th>
							<td>...</td>
						</tr>
						<tr>
							<th>评论用户：</th>
							<td>
								<?php echo $username; ?>
							</td>
						</tr>
						<tr>
							<th>评论IP：</th>
							<td>
								<a href="javascript:;" onclick="_ip('<?php echo $userip; ?>');"><?php echo $userip; ?></a>
							</td>
						</tr>
						<tr>
							<th>评论时间：</th>
							<td><?php echo $addtime; ?></td>
						</tr>
						<tr>
							<th>评论内容：</th>
							<td>
								<textarea name="comment[content]" class="small" cols="20" rows="2" ><?php echo $content; ?></textarea>
							</td>
						</tr>
						<tr>
							<th>用户代理信息：</th>
							<td><?php echo $useragent; ?></td>
						</tr>
						<tr>
							<th>评论状态：</th>
							<td>
								<input type="radio" name="comment[status]" value="0" <?php echo $status == 0 ? 'checked' : ''; ?>> 未通过 &nbsp;&nbsp;
								<input type="radio" name="comment[status]" value="1" <?php echo $status == 1 ? 'checked' : ''; ?>> 已通过
							</td>
						</tr>
<?php 
			if(isset($other)){
				if(is_array($other)){
					foreach($other as $k=>$v){
?>
						<tr>
							<th><?php echo $k; ?>：</th>
							<td><?php echo $v; ?></td>
						</tr>
<?php
					}
				}else{
?>
						<tr>
							<th>其它：</th>
							<td><?php echo $other; ?></td>
						</tr>
<?php
				}
			}
?>
					</tbody>
				</table>
			</div>

			<div class="foot_btn_box">
				<input type="hidden" name="file" value="<?php echo $file; ?>" />
				<input type="hidden" name="action" value="save" />
				<input type="hidden" name="v_ruiec_sm" value="ruiec" />
				<input name="提交" type="submit" value="提交保存" class="btnSubmit" />&nbsp;
				<input name="重置" type="reset" class="btnSubmit" value="重 置" />
			</div>

		</form>
		
	</div>
	
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
			beforeSend : function() {art.dialog({id:'lock',title:false,lock:true,background:'#fff',opacity:0.3});},
			success : function(responseText, statusText, xhr, $form){
				art.dialog.list['lock'].close();
				if(statusText == 'success'){
					if(responseText == '0'){
						parent.jsprint("更新成功!", "", "Success");
						window.location.reload();
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
    });
	
</script>
	
<?php include tpl('footer'); ?>

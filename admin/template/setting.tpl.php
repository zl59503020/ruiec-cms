<?php include tpl('header'); ?>

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
						parent.jsprint("保存成功!", "", "Success");
					}else{
						parent.jsprint("保存失败!", "", "Error");
						art.dialog({
							title: '保存失败',
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
	function TestMail() {
		if($('#testemail').val() == '') {
			alert('请先输入一个接收测试邮件的邮件地址');
			$('#testemail').focus();
			return false;
		}
		if($('#testemail').val() == $('#smtp_user').val()) {
			alert('测试收件人请不要与发件人相同');
			$('#testemail').focus();
			return false;
		}
		var tsmailcon = '<form method="POST" id="fm_test_semail" action=""><input type="hidden" name="file" value="setting" /><input type="hidden" name="action" value="sendmail" /><input type="hidden" name="v_ruiec_sendmail" value="ruiec" /><input type="hidden" name="tomail" value="'+$('#testemail').val()+'" />'+$('#div_email').html()+'</form>';

		art.dialog({
			id: 'art_testsendmail',
			title: '测试邮件发送',
			lock: true,
			background: '#fff',
			opacity: 0.5,
			ok: true
		});
		
		art.dialog({id:'send_mail_temp',content:tsmailcon,show:false});
		
		$('#fm_test_semail').ajaxForm({
			success: function(responseText, statusText, xhr, $form){
				art.dialog.list['art_testsendmail'].content(responseText);
				art.dialog.list['send_mail_temp'].close();
			}
		}); 
		$('#fm_test_semail').submit();
	}
</script>

	<div class="navigation">首页 &gt; 控制面板 &gt; 系统设置</div>
	
	<div id="contentTab">

		<ul class="tab_nav">
			<li class="selected"><a onclick="tabs('#contentTab',0);" href="javascript:;">网站基本信息</a></li>
			<li><a onclick="tabs('#contentTab',1);" href="javascript:void(0);">SEO优化设置</a></li>
			<li><a onclick="tabs('#contentTab',2);" href="javascript:void(0);">邮件发送设置</a></li>
		</ul>
		
		<form action="" method="post" id="myform" name="myform" enctype="multipart/form-data">
		
			<!--	网站基本设置	-->
			<div class="tab_con" style="display:block;">
				<table class="form_table">
					<col width="180px"></col>
					<tbody>
						<tr>
							<th>站点名称：</th>
							<td><input type="text" id="sitename" name="setting[sitename]" value="<?php echo $sitename;?>" class="txtInput normal required" /></td>
						</tr>
						<tr>
							<th>网站地址：</th>
							<td>
								<input type="text" name="config[url]" value="<?php echo $CFG['url']; ?>" class="txtInput normal required url" />
								<?php echo tips("请添写完整URL地址,&#13;例如http://www.ruiec.com/ &#13;<br/>注意以'/'结尾&#13;<br/>系统检测到的地址 <span style='color:red;'>http://".$_SERVER['HTTP_HOST']."/</span>"); ?>
							</td>
						</tr>
						<tr>
							<th>网站Logo：</th>
							<td>
								<input type="text" id="weblogo" name="setting[weblogo]" value="<?php echo $weblogo;?>" class="txtInput normal f_l" />
								<span><a href="javascript:upfile('weblogo',100,100,true);" class="files"></a></span>
								<span style="margin:0px 5px;"><a href="javascript:showImg($('#weblogo').val());">预览</a></span>
							</td>
						</tr>
						<tr>
							<th>ICP备案序号:</th>
							<td><input type="text" id="webcrod" name="setting[webcrod]" value="<?php echo $webcrod; ?>" class="txtInput normal" /></td>
						</tr>
						<tr>
							<th>底部版权信息：</th>
							<td>
								<textarea id="webcopyright" name="setting[webcopyright]" class="small" cols="20" rows="2" ><?php echo $webcopyright; ?></textarea>
								<?php echo tips('支持HTML格式'); ?>
							</td>
						</tr>
						<tr>
							<th>公司名称：</th>
							<td><input type="text" id="webcompany" name="setting[webcompany]" value="<?php echo $webcompany; ?>" class="txtInput normal" /></td>
						</tr>
						<tr>
							<th>联系电话：</th>
							<td><input type="text" id="webtel" name="setting[webtel]" value="<?php echo $webtel; ?>" class="txtInput normal" /></td>
						</tr>
						<tr>
							<th>管理员邮箱：</th>
							<td><input type="text" id="webmail" name="setting[webmail]" value="<?php echo $webmail; ?>" class="txtInput normal email" /></td>
						</tr>
						<tr>
							<th>网站状态:</th>
							<td>
								<input type="radio" name="setting[webstatus]" value="1" <?php if($webstatus){ ?>checked <?php } ?>onclick="$('#rclose').hide();"> 开启&nbsp;&nbsp;
								<input type="radio" name="setting[webstatus]" value="0" <?php if(!$webstatus){ ?>checked <?php } ?>onclick="$('#rclose').show()"> 关闭
							</td>
						</tr>
						<tr id="rclose" style="display: <?php if($webstatus) echo 'none';?>;">
							<th>关闭原因:</th>
							<td>
								<textarea name="setting[webcloseinfo]" id="close_reason" style="width:500px;height:50px;overflow:visible;"><?php echo ($webcloseinfo=='') ? '网站维护中，请稍候访问...' : $webcloseinfo; ?></textarea>
								<?php echo tips('支持HTML语法，网站关闭不影响后台管理'); ?>
							</td> 
						</tr>
						<tr>
							<th>网站样式:</th>
							<td>
								<?php
									$select = '';
									$dirs = list_dir('skin');
									foreach($dirs as $v) {
										$selected = ($CFG['skin'] && $v['dir'] == $CFG['skin']) ? 'selected' : '';
										$select .= "<option value='".$v['dir']."' ".$selected.">".$v['name']."</option>";
									}
									$select = '<select name="config[skin]" class="select">'.$select.'</select>';
									echo $select;
									tips('位于./skin/目录,一个目录即为一套风格');
								?>
							</td>
						</tr>
						<tr>
							<th>网站模板:</th>
							<td>
								<?php
									$select = '';
									$dirs = list_dir('template');
									foreach($dirs as $v) {
										$selected = ($CFG['template'] && $v['dir'] == $CFG['template']) ? 'selected' : '';
										$select .= "<option value='".$v['dir']."' ".$selected.">".$v['name']."</option>";
									}
									$select = '<select name="config[template]" class="select">'.$select.'</select>';
									echo $select;
									tips('位于./template/目录,一个目录即为一套模板');
								?>
							</td>
						</tr>
					</tbody>
				</table>
			</div>

			<!--	SEO相关设置		-->
			<div class="tab_con">
				<table class="form_table">
					<col width="180px"></col>
					<tbody>
						<tr>
							<th>标题分隔符</th>
							<td><input name="setting[seo_delimiter]" type="text" value="<?php echo $seo_delimiter; ?>" size="10" class="txtInput" /></td>
						</tr>
						<tr>
							<th>Title(网站标题)：</th>
							<td>
								<input name="setting[seo_title]" type="text" value="<?php echo $seo_title; ?>" size="61" class="txtInput" />
								<?php echo tips('针对搜索引擎设置的网页标题,自定义'); ?>
							</td>
						</tr>
						<tr>
							<th>Keywords(网页关键词)：</th>
							<td>
								<textarea name="setting[seo_keywords]" cols="60" rows="3"><?php echo $seo_keywords; ?></textarea>
								<?php echo tips('针对搜索引擎设置的关键词'); ?>
							</td>
						</tr>
						<tr>
							<th>Description(网页描述)：</th>
							<td>
								<textarea name="setting[seo_description]" cols="60" rows="3"><?php echo $seo_description; ?></textarea>
								<?php echo tips('针对搜索引擎设置的网页描述'); ?>
							</td>
						</tr>
						<tr>
							<th>URL Rewrite(伪静态): </th>
							<td>
								<input type="radio" name="setting[rewrite]" value="1" <?php if($rewrite){ ?>checked <?php } ?>/> 开启&nbsp;&nbsp;
								<input type="radio" name="setting[rewrite]" value="0" <?php if(!$rewrite){ ?>checked <?php } ?>/> 关闭 
								<?php tips('请确认服务器已做过规则配置，否则请勿开启<br/>ReWrite规则见帮助文档<br/>请点击下面的地址，如果可以正常显示，说明规则配置成功<br/><a href=index-htm-url-rule.html target=_blank>index-htm-url-rule.html</a>');?>
							</td>
						</tr>
						<tr>
							<th>404日志</th>
							<td>
								<input type="radio" name="setting[log_404]" value="1" <?php if($log_404){ ?>checked <?php } ?>/> 开启&nbsp;&nbsp;
								<input type="radio" name="setting[log_404]" value="0" <?php if(!$log_404){ ?>checked <?php } ?>/> 关闭 
								<?php tips('开启404日志有利于分析站内死链接和用户或搜索引擎蜘蛛的错误记录<br/>同时需要设置站点的404页面至网站根目录404.php');?>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			
			<!--	邮件发送配置	-->
			<div class="tab_con" id="div_email">
				<table class="form_table">
					<col width="180px"></col>
					<tbody>
						<tr>
							<th>STMP服务器：</th>
							<td>
								<input type="text" name="setting[smtp_host]" value="<?php echo $smtp_host; ?>" maxlength="100" class="txtInput normal valid" />
								<?php echo tips('SMTP服务器,例如smtp.xxx.com<br/>提示:目前大部分新申请的免费邮箱并不支持smtp发信'); ?>
							</td>
						</tr>
						<tr>
							<th>SMTP端口：</th>
							<td><input name="setting[smtp_port]" type="text" size="5" value="<?php echo $smtp_port; ?>" class="txtInput small digits valid" /></td>
						</tr>
						<tr>
							<th>邮箱帐号: </th>
							<td><input name="setting[smtp_user]" id="smtp_user" type="text" size="40" value="<?php echo $smtp_user; ?>" class="txtInput"/></td>
						</tr>
						<tr>
							<th>邮箱密码：</th>
							<td><input name="setting[smtp_pass]" type="password" id="smtp_pass" size="40" value="<?php echo $smtp_pass; ?>" class="txtInput" /></td>
						</tr>
						<tr>
							<th>发件人名称: </th>
							<td><input name="setting[mail_name]" id="mail_name" type="text" size="40" value="<?php echo $mail_name; ?>" class="txtInput"><?php echo tips('系统发送的信件将显示此名称，不填则显示网站名'); ?></td>
						</tr>
						<tr>
							<th>邮件签名: </th>
							<td><textarea name="setting[mail_sign]" id="mail_sign" cols="60" rows="4"><?php echo $mail_sign; ?></textarea><?php echo tips('支持HTML语法'); ?></td>
						</tr>						
						<tr>
							<th>测试收件人: </td>
							<td>
								<input type="text" id="testemail" value="" size="30" class="txtInput"> 
								<input type="button" class="btnSearch" value="测试发送" onclick="TestMail();">
								<?php echo tips('请在左侧输入一个接收测试邮件的邮件地址'); ?>
							</td>
						</tr>
						<tr>
							<th>邮件发送记录: </th>
							<td>
								<input type="radio" name="setting[mail_log]" value="1" <?php if($log_404){ ?>checked <?php } ?>/> 开启&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="radio" name="setting[mail_log]" value="0" <?php if(!$log_404){ ?>checked <?php } ?>/> 关闭
							</td>
						</tr>
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
	
<?php include tpl('footer'); ?>

﻿<?php
defined('IN_RUIEC') or exit('Access Denied');

switch($action) {
	case 'save':
		if(isset($v_ruiec_sm) && $v_ruiec_sm == 'ruiec'){
			//echo 'Saveing...';
			if(!is_writable(RE_ROOT.'/config.inc.php')) die('根目录config.inc.php无法写入，请设置可写权限');
			$tmp = file_get(RE_ROOT.'/config.inc.php');
			foreach($config as $k=>$v){ $tmp = preg_replace("/[$]CFG\['$k'\]\s*\=\s*[\"'].*?[\"']/is", "\$CFG['$k'] = '$v'", $tmp); }
			file_put(RE_ROOT.'/config.inc.php', $tmp);
			update_setting($moduleid, $setting);
			//cache_module(1);
			cache_module();
			die('0');
		}
	break;
	case 'sendmail':
		if(isset($v_ruiec_sendmail) && $v_ruiec_sendmail == 'ruiec'){
			include RE_ROOT.'/include/mail.func.php';
			if(sendMail($setting['smtp_user'],$setting['mail_name'],$tomail,'测试发送邮件!','这是测试发送的邮件内容.<br />This is a test message.<br />'.$setting['mail_sign'],$setting['smtp_user'],$setting['smtp_pass'],$setting['smtp_host'],$setting['smtp_user'])){
				die('<span style="height:25px;line-height:25px;color:#71FF5E;"> 发送成功! </span></div>');
			}else{
				die('<span style="height:25px;line-height:25px;color:red;"> 发送失败! </span></div>');
			}
		}
	break;
	default:
		$setting = get_setting($moduleid);
		if($setting) extract($setting, EXTR_SKIP);
		include tpl('setting',$module);
	break;
}

?>
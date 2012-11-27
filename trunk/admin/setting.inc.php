<?php
defined('IN_RUIEC') or exit('Access Denied');

switch($action) {
	case 'uplogo':
		if(empty($_FILES) == false){
			include RE_ROOT.'/include/upload.class.php';
			include RE_ROOT.'/include/image.class.php';
			$re = upload::save('upfile');
			if(is_array($re)){
				if(isset($upimgsize) && is_array($upimgsize) && ($upimgsize['w'] != '' || $upimgsize['h'] != '')){
					$fspath = str_replace(RE_PATH,RE_ROOT.'/',$re[1]);
					$ft = strrchr(basename($fspath),'.');
					if($ft == '.jpg'){
						$im = imagecreatefromjpeg($fspath);
					}else if($ft == '.png'){
						$im = imagecreatefrompng($fspath);
					}else if($ft == '.gif'){
						$im = imagecreatefromgif($fspath);
					}
					if($im){
						$w = ($upimgsize['w'] == '' || $upimgsize['w'] == '0') ? imagesx($im) : $upimgsize['w'];
						$h = ($upimgsize['h'] == '' || $upimgsize['h'] == '0') ? imagesy($im) : $upimgsize['h'];
						if(file_exists($fspath.'.min'.$ft)){
							unlink($fspath.'.min'.$ft);
						}
						image::ResizeImage($im,$w,$h,$fspath.'.min'.$ft,isset($upimgsize['s']));
						ImageDestroy($im);
						$re[1] = str_replace(RE_ROOT.'/',RE_PATH,$fspath.'.min'.$ft);
					}
					echo $re[1];
				}else{
					echo $re[1];
				}
			}else{
				echo '0';
			}
			exit;
		}
		break;
	case 'save':
		if(isset($v_ruiec_sm) && $v_ruiec_sm == 'ruiec'){
			
			//echo 'Saveing...';
			
			if(!is_writable(RE_ROOT.'/config.inc.php')) msg('根目录config.inc.php无法写入，请设置可写权限');
			
			$tmp = file_get(RE_ROOT.'/config.inc.php');
			foreach($config as $k=>$v){
				$tmp = preg_replace("/[$]CFG\['$k'\]\s*\=\s*[\"'].*?[\"']/is", "\$CFG['$k'] = '$v'", $tmp);
			}
			
			file_put(RE_ROOT.'/config.inc.php', $tmp);
			
			update_setting($moduleid, $setting);
			
			//cache_module(1);
			
			cache_module();
			
			echo '0';

			exit;
		}
		break;
	case 'sendmail':
		if(isset($v_ruiec_sendmail) && $v_ruiec_sendmail == 'ruiec'){
			include RE_ROOT.'/include/mail.func.php';
			
			if(sendMail($setting['smtp_user'],$setting['mail_name'],$tomail,'测试发送邮件!','这是测试发送的邮件内容.<br />This is a test message.<br />'.$setting['mail_sign'],$setting['smtp_user'],$setting['smtp_pass'],$setting['smtp_host'],$setting['smtp_user'])){
				echo '<span style="height:25px;line-height:25px;color:#71FF5E;"> 发送成功! </span></div>';
			}else{
				echo '<span style="height:25px;line-height:25px;color:red;"> 发送失败! </span></div>';
			}
			exit;
		}
	break;
	default:
		$setting = get_setting('1');
		if($setting) extract($setting, EXTR_SKIP);
		include tpl('setting',$module);
	break;
}

?>
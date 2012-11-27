<?php

//include('mail/class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded
if ( ! function_exists('sendMail')){
	function sendMail($from,$fromname,$to,$title,$body,$usename,$usepassword,$smtp,$repto,$repname=''){
		include_once(RE_ROOT.'/include/mail/class.phpmailer.php');
		include_once(RE_ROOT.'/include/mail/class.smtp.php');

		$mail = new PHPMailer();				//得到一个PHPMailer实例
		$mail->CharSet = "utf8";				//设置采用utf8中文编码
		$mail->Encoding = "base64";				//
		$mail->IsSMTP();						//设置采用SMTP方式发送邮件
		$mail->Host = $smtp;					//"smtp.qq.com";			//设置邮件服务器的地址,
		$mail->Port = 25;						//设置邮件服务器的端口，默认为25
		$mail->From = $from;					//"348666262@qq.com";			//设置发件人的邮箱地址
		$mail->FromName = $fromname;			//"ruiec";				//设置发件人的姓名
		$mail->SMTPAuth = true;					//设置SMTP是否需要密码验证，true表示需要
		$mail->Username = $usename;				// "348666262@qq.com";	//你的用户名
		$mail->Password = $usepassword;			//'ledoem';				//密码
		$mail->IsHTML(true);
		$mail->Subject = (isset($title)) ? $title : '';	//$title;				//设置邮件的标题
		$mail->Body = $body;					//$contet;					//内容,先可用英文测试，中文有时会有乱码问题 ,导至发送不成功
		$mail->AddReplyTo($repto,"");		//"348666262@qq.com", "");	//设置回复的收件人的地址
		if(is_array($to)){
			foreach($to as $tm){
				$mail->AddAddress($tm, "");			//设置收件的地址
			}
		}else{
			$mail->AddAddress($to, "");			//设置收件的地址
		}
		//发送邮件
		if(!$mail->Send()){
			return false;//return 'Error: '.$mail->ErrorInfo;
		} else {
			return true;
		}
	}
}

if ( ! function_exists('jmailsend_')){
	function jmailsend_($from,$fromname,$to,$title,$body,$usename,$usepassword,$smtp,$repto,$repname)
	{
		include('mail/class.phpmailer.php');

		$mail             = new PHPMailer();
		//$mail->SMTPDebug  = 3;
		
		$mail->CharSet    = "UTF-8"; // charset
		$mail->Encoding   = "base64";

		$mail->IsSMTP(); // telling the class to use SMTP

		//system
		$mail->SMTPAuth   = true;
		$mail->Host       = $smtp; // SMTP server
		$mail->Username   = $usename; // SMTP account username
		$mail->Password   = $usepassword;        // SMTP account password

		$mail->From       = $from;//send email
		$mail->FromName   = $fromname; //name of send

		//repet
		if($repto!=""){
			$name = isset($repname)?$repname:$repto;
			$mail->AddReplyTo($repto, $name);
		}
		$mail->WordWrap   = 50; // line 
		
		//title
		$mail->Subject		= (isset($title)) ? $title : '';//title

		
		//$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; //

		//body
		$body             = eregi_replace("[\]",'',$body);
		$mail->MsgHTML($body);
        
		
		//to
		if($to)
		{
			$address = explode("|",$to);
			foreach($address AS $key => $val)
			{
				$mail->AddAddress($val, "");
			}
		}
		//send attech
		//if(isset($data['attach']))
		//{
			//$attach = explode("|",$data['attach']);
			//foreach($attach AS $key => $val)
			//{
				//$mail->AddAttachment($val,"");             // attech
			//}			
		//}
		if(!$mail->Send()) {
		  //echo "Mailer Error: " . $mail->ErrorInfo;
		  return false;
		} else {
		  //echo "Message sent!";
		  return true;
		}
	}
}
?>

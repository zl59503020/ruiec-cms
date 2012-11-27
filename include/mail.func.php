<?php

//include('mail/class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded
if ( ! function_exists('sendMail')){
	function sendMail($from,$fromname,$to,$title,$body,$usename,$usepassword,$smtp,$repto,$repname=''){
		include_once(RE_ROOT.'/include/mail/class.phpmailer.php');
		include_once(RE_ROOT.'/include/mail/class.smtp.php');

		$mail = new PHPMailer();				//�õ�һ��PHPMailerʵ��
		$mail->CharSet = "utf8";				//���ò���utf8���ı���
		$mail->Encoding = "base64";				//
		$mail->IsSMTP();						//���ò���SMTP��ʽ�����ʼ�
		$mail->Host = $smtp;					//"smtp.qq.com";			//�����ʼ��������ĵ�ַ,
		$mail->Port = 25;						//�����ʼ��������Ķ˿ڣ�Ĭ��Ϊ25
		$mail->From = $from;					//"348666262@qq.com";			//���÷����˵������ַ
		$mail->FromName = $fromname;			//"ruiec";				//���÷����˵�����
		$mail->SMTPAuth = true;					//����SMTP�Ƿ���Ҫ������֤��true��ʾ��Ҫ
		$mail->Username = $usename;				// "348666262@qq.com";	//����û���
		$mail->Password = $usepassword;			//'ledoem';				//����
		$mail->IsHTML(true);
		$mail->Subject = (isset($title)) ? $title : '';	//$title;				//�����ʼ��ı���
		$mail->Body = $body;					//$contet;					//����,�ȿ���Ӣ�Ĳ��ԣ�������ʱ������������ ,�������Ͳ��ɹ�
		$mail->AddReplyTo($repto,"");		//"348666262@qq.com", "");	//���ûظ����ռ��˵ĵ�ַ
		if(is_array($to)){
			foreach($to as $tm){
				$mail->AddAddress($tm, "");			//�����ռ��ĵ�ַ
			}
		}else{
			$mail->AddAddress($to, "");			//�����ռ��ĵ�ַ
		}
		//�����ʼ�
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

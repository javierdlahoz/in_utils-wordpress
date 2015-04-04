<?php

namespace INUtils\Helper;

class EmailHelper
{
	const EMAIL_FROM = "info@marshalmoya.com";
	const SUBJECT = "I want to contact you";
	const TO = "trevor@innuevodigital.com";
	
	public static function sendEmail($to, $subject, $url, $message = null, $from)
	{	
		if($message == "none"){
			$message = "Check this Url out: ".$url;
		}
		
		if($from == null){
			$from = self::EMAIL_FROM;
		}
		
		$headers = 'From: ' .$from. "\r\n" .
		    'X-Mailer: PHP/' . phpversion();

		mail($to, $subject, $message, $headers);
	}

	public static function getEmailModal($modalId, $subject, $modalTitle = null, $emailAddress = null){
		$suffix = uniqid();
		include __DIR__."/views/email-sender-modal.php";
	}

	/**
	 *
	 * @param  string $to    
	 * @param  string $from    
	 * @param  string $content 
	 * @param  string $name   
	 */
	public static function sendContactEmail($to, $from, $content, $name){
		$headers = 'From: ' .$from. "\r\n" .
		    'X-Mailer: PHP/' . phpversion();

		$subject = "My name is ".$name." and ".self::SUBJECT;
		mail($to, $subject, $content, $headers);
	}

}
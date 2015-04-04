<?php

include __DIR__."/../config/module_loader.php";
use INUtils\Helper\EmailHelper;

if(isset($_POST['send_email'])){
    
	if($_POST['from'] == 'none'){
		$from = null;
	}
	else{
		$from = $_POST['from'];
	}

	if(isset($_POST['to'])){
		$to = $_POST['to'];
	}
	else{
		$to = "trevor@innuevodigital.com";
	}

	if(isset($_POST['subject'])){
		$subject = $_POST['subject'];
	}
	else{
		$subject = "I want to contact you";
	}
	
	if(isset($_POST['url'])){
		EmailHelper::sendEmail($to, $subject, $_POST['url'], $_POST['content'], $from);
	}
	else{
		EmailHelper::sendContactEmail($to, $from, $_POST['content'], $_POST['name']);
	}
	echo json_encode(array("status" => "message sent"));
	die();
}
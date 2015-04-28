<?php

namespace INUtils\Helper;

class ModalHelper{

	public static function getLargeModal($data){
		include __DIR__ . "/views/large-modal.php";
	}
	
	public static function getFormModal($id){
		include __DIR__ . "/views/form-modal.php";
	}
	
}
<?php

namespace INUtils\Entity;

use INUtils\Entity\WPEntityInterface;

abstract class WPAbstractEntity implements WPEntityInterface{
	
	const ERROR_INVALID_FIELD_MESSAGE = "The passed argument mismatches the field type";
	
	function __construct(array $entityArray = null){
		//Implement this method in your local entity
	}

	/**
	 * 
	 * @var number
	 */
	private $id;
	
	/**
	 * 
	 * @var string
	 */
	private $tableName;
	
	
	public function setId($id){
		if($id != null){
			$this->id = $id;
		}
	}
	
	public function getId(){
		return $this->id;
	}
	
	public function toArray(){
		$entityArray = get_object_vars($this);
		unset($entityArray['tableName']);
		
		if($entityArray['id'] == null){
			unset($entityArray['id']);
		}
		return $entityArray;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getTableName() {
		return $this->tableName;
	}
	
	/**
	 *
	 * @param
	 *        	$tableName
	 */
	public function setTableName($tableName) {
		$this->tableName = $tableName;
		return $this;
	}
	
}
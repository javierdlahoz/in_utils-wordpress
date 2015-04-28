<?php

namespace INUtils\Entity;

interface WPEntityInterface{
	
	/**
	 * 
	 * @param number $id
	 */
	public function setId($id);
	
	/**
	 * @return number
	 */
	public function getId();
	
	/**
	 * @return multiple
	 */
	public function toArray();
	
	/**
	 * @return string
	 */
	public function getTableName();
	
	/**
	 * 
	 * @param string $tableName
	 */
	public function setTableName($tableName);
	
}
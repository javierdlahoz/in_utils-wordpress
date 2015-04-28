<?php

namespace INUtils\Service;

use INUtils\Singleton\AbstractSingleton;
use INUtils\Entity\WPEntityInterface;

class WPAbstractService extends AbstractSingleton{
	
	/**
	 * 
	 * @param WPEntityInterface $entity
	 */
	public function insert(WPEntityInterface $entity){
		
		global $wpdb;
		
		$entityArray = $entity->toArray();
		$query = "INSERT INTO ".$entity->getTableName()." ";
		$fields = "(";
		$values = ") VALUES (";
		$isFirst = true;
		foreach($entityArray as $key => $value){
			
			if($isFirst){
				$fields .= $key;
				$values .= "'".$value."'";
				$isFirst = false;
			}
			else{
				$fields .= ", ". $key;
				$values .= ", '".$value."'";
			}
		}
		
		$query .= $fields.$values.")";
		
		$wpdb->query($query);
	}
	
	/**
	 * 
	 * @param WPEntityInterface $entity
	 */
	public function delete(WPEntityInterface $entity){
		
		global $wpdb;
		
		$query = "DELETE FROM ".$entity->getTableName()." WHERE id='".$entity->getId()."'";
		$wpdb->query($query);
	}
	
	/**
	 * 
	 * @param WPEntityInterface $entity
	 * @param array $queryArray
	 * @return multitype:WPEntityInterface
	 */
	public function findBy(WPEntityInterface $entity, array $queryArray = null, array $orderBy = null, $limit = null){
		
		global $wpdb;
		
		$query = "SELECT * FROM ".$entity->getTableName();
		if($queryArray == null){
			$where = null;
		}
		else{
			$where = " WHERE ";
			$isFirst = true;
			foreach ($queryArray as $key => $value){
				if($isFirst){
					$where .= $key ." = '".$value."'";
					$isFirst = false;
				}
				else{
					$where .= " AND ".$key." = '".$value."'";
				}
			}
		}
		$query .= $where;
		
		if($orderBy == null){
			$order = null;
		}
		else{
			$order = " ORDER BY ";
			$isFirst = true;
			foreach ($orderBy as $key => $value){
				if($isFirst){
					$order .= $key ." ".$value."";
					$isFirst = false;
				}
				else{
					$order .= " AND ".$key." ".$value."";
				}
			}
		}
		$query .= $order;

		if($limit != null){
			$query .= " LIMIT ".$limit;
		}
		
		$results = $wpdb->get_results($query);
		$entityClass = get_class($entity);
		$entities = array();
		
		foreach ($results as $result){
			$entities[] = new $entityClass(get_object_vars($result));
		}
		return $entities;
	}
	
	/**
	 * 
	 * @param WPEntityInterface $entity
	 */
	public function update(WPEntityInterface $entity){
		
		global $wpdb;
		
		$query = "UPDATE ".$entity->getTableName()." SET ";
		$values = "";
		$isFirst = true;
		$entityArray = $entity->toArray();
		
		foreach($entityArray as $key => $value){
				
			if($isFirst){
				$values .= $key." = '".$value."'";
				$isFirst = false;
			}
			else{
				$values .= "," .$key." = '".$value."'";
			}
		}
		$query .= $values." WHERE id = '".$entity->getId()."'";
		
		$wpdb->query($query);
	}
	
}
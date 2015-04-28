<?php

namespace INUtils\Singleton;

abstract class AbstractSingleton{
	
	/**
	 * 
	 * @var self
	 */
	public static $service;
	
	/**
	 *
	 * @param array $config
	 * @return self
	 */
	public static function getSingleton() {
		$class = get_called_class();
		if (!self::$service instanceof $class) {
			self::$service = new $class();
		}
		return self::$service;
	}
	
}
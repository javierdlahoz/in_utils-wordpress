<?php
namespace INUtils\Helper;

use INUtils\Singleton\AbstractSingleton;
use INUtils\Entity\WPPostInterface;

class PluginHelper extends AbstractSingleton
{
    const PLUGIN_HELPER = "plugin helper";
    /**
     * 
     * @var array
     */
    private $registry = array();
    
    /**
     * 
     * @param string $key
     * @param unknown $value
     * @throws \Exception
     */
    public static function set($key, $value){
        if (isset(self::getSingleton()->registry[$key])) {
             throw new \Exception("There is already an entry for key " . $key);
        }
         
        self::getSingleton()->registry[$key] = $value;
    }
    
    /**
     * 
     * @param string $key
     * @throws Exception
     */
    public static function get($key) {
        if (!isset(self::getSingleton()->registry[$key])) {
            throw new \Exception("There is no entry for key " . $key);
        }
    
        return self::getSingleton()->registry[$key];
    }
    
    /**
     * 
     * @param string $key
     * @return WPPostInterface
     */
    public static function getEntity($key, $namespace = null){
        $key = ucfirst($key);
        if($namespace === null){
            $namespace = $key;
        }
        $class = "\\".$namespace."\\Entity\\".$key."Entity";
        $postEntity = new $class(get_the_ID());
        return $postEntity;
    }
    
    /**
     *
     * @param string $key
     * @return
     */
    public static function getController($key, $namespace = null){
        $key = ucfirst($key);
        if($namespace === null){
            $namespace = $key;
        }
        $class = "\\".$namespace."\\Controller\\".$key."Controller";
        $controller = $class::getSingleton();
        return $controller;
    }
    
    /**
     *
     * @param string $key
     * @return 
     */
    public static function getService($key, $namespace = null){
        $key = ucfirst($key);
        if($namespace === null){
            $namespace = $key;
        }
        $class = "\\".$namespace."\\Service\\".$key."Service";
        $service = $class::getSingleton();
        return $service;
    }
    
    /**
     *
     * @param string $key
     * @return
     */
    public static function getHelper($key, $namespace = null){
        $key = ucfirst($key);
        if($namespace === null){
            $namespace = $key;
        }
        $class = "\\".$namespace."\\Helper\\".$key."Helper";
        $helper = new $class();
        return $helper;
    }
}
<?php

$namespace = "INUtils";

$dirSingleton = __DIR__."/../Singleton/";
$dirEntity = __DIR__."/../Entity/";
$dirService =  __DIR__."/../Service/";
$dirHelper = __DIR__."/../Helper/";
$dirHandler = __DIR__."/../Handler/";
$dirController = __DIR__."/../Controller/";

if(!function_exists("isAlreadyRequired")){
	/**
	 *
	 * @param string $class
	 * @return boolean
	 */
	function isAlreadyRequired($class){
		$requiredClasses = get_declared_classes();
		foreach ($requiredClasses as $requiredClass){
			if($requiredClass == $class){
				return true;
			}
		}

		return false;
	}
	
	function isAlreadyRequiredInterface($class){
		$requiredClasses = get_declared_interfaces();
		foreach ($requiredClasses as $requiredClass){
			if($requiredClass == $class){
				return true;
			}
		}
	
		return false;
	}
}


/**it loads all files in folders **/
if(!isAlreadyRequired($namespace."\Entity\WPPostInterface")){
    require $dirEntity."WPPostInterface.php";
}

if(!isAlreadyRequired($namespace."\Singleton\AbstractSingleton")){
	require $dirSingleton."AbstractSingleton.php";
}

if(!isAlreadyRequiredInterface($namespace."\Entity\WPEntityInterface")){
	require $dirEntity."WPEntityInterface.php";
}

if(!isAlreadyRequired($namespace."\Entity\WPAbstractEntity")){
	require $dirEntity."WPAbstractEntity.php";
}

if(!isAlreadyRequired($namespace."\Entity\WPPostEntity")){
    require $dirEntity."WPPostEntity.php";
}

if(!isAlreadyRequired($namespace."\Entity\PostEntity")){
    require $dirEntity."PostEntity.php";
}

if(!isAlreadyRequired($namespace."\Entity\WPTermEntity")){
    require $dirEntity."WPTermEntity.php";
}

if(!isAlreadyRequired($namespace."\Service\WPAbstractService")){
	require $dirService."WPAbstractService.php";
}

if(!isAlreadyRequired($namespace."\Service\WPPostService")){
    require $dirService."WPPostService.php";
}

if(!isAlreadyRequired($namespace."\Service\WPTermService")){
    require $dirService."WPTermService.php";
}

if(!isAlreadyRequired($namespace."\Service\PostService")){
    require $dirService."PostService.php";
}

if(!isAlreadyRequired($namespace."\Helper\PostHelper")){
	require $dirHelper."PostHelper.php";
}

if(!isAlreadyRequired($namespace."\Helper\EmailHelper")){
	require $dirHelper."EmailHelper.php";
}

if(!isAlreadyRequired($namespace."\Helper\PictureHelper")){
    require $dirHelper."PictureHelper.php";
}

if(!isAlreadyRequired($namespace."\Helper\ModalHelper")){
	require $dirHelper."ModalHelper.php";
}

if(!isAlreadyRequired($namespace."\Helper\TextHelper")){
	require $dirHelper."TextHelper.php";
}

if(!isAlreadyRequired($namespace."\Helper\FileHelper")){
    require $dirHelper."FileHelper.php";
}

if(!isAlreadyRequired($namespace."\Helper\TaxonomyHelper")){
    require $dirHelper."TaxonomyHelper.php";
}

if(!isAlreadyRequired($namespace."\Helper\DateHelper")){
	require $dirHelper."DateHelper.php";
}

if(!isAlreadyRequired($namespace."\Handler\RestHandler")){
	require $dirHandler."RestHandler.php";
}

if(!isAlreadyRequired($namespace."\Controller\AbstractController")){
    require $dirController."AbstractController.php";
}

if(!isAlreadyRequired($namespace."\Controller\PostController")){
    require $dirController."PostController.php";
}
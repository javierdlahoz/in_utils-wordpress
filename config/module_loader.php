<?php

spl_autoload_register('autoloaderAbstract');

function autoloaderAbstract($class){
    $initPath = __DIR__."/../";

    if(strpos($class, '\\') !== false){
        $classExploded = explode("\\", $class);

        $classFileToAdd = $initPath;
        $isFirst = true;
        foreach($classExploded as $pathPart){
            if($pathPart != "INUtils"){
                if($isFirst){
                    $classFileToAdd .= $pathPart;
                }
                else{
                    $classFileToAdd .= "/".$pathPart;
                }
                $isFirst = false;
            }
        }
        $classFileToAdd .= ".php";
        if(file_exists($classFileToAdd)){
            require $classFileToAdd;
        }
        else{
            throw new \Exception("The class ".$class." couldn't be found");
        }
    }
}
<?php
namespace INUtils\Controller;

use INUtils\Singleton\AbstractSingleton;

abstract class AbstractController extends AbstractSingleton{
    
    public function getPost($param){
        return $_POST[$param];
    }
}
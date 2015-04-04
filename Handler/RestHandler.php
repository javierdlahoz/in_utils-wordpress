<?php

namespace INUtils\Handler;

use INUtils\Singleton\AbstractSingleton;

class RestHandler extends AbstractSingleton{

    public function returnJSON($jsonArray){
        header('Content-Type: application/json');
        header($_SERVER['SERVER_PROTOCOL'] . ' 200 Success', true, 200);
        echo json_encode($jsonArray);
        exit();
    }

    public function returnError(){
        header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
        echo json_encode(array('status' => 'failed'));
        exit();
    }

    public function resolveTo(){
        $functionName = $_POST['action_type'];
        if(method_exists($this, $functionName)){
            $JSONArray = $this->{$functionName}();
            $this->returnJSON($JSONArray);
        }
        else{
            $this->returnError();
        }
    }
}
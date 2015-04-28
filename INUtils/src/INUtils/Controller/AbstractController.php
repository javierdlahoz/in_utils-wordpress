<?php
namespace INUtils\Controller;

use INUtils\Singleton\AbstractSingleton;

abstract class AbstractController extends AbstractSingleton{

    /**
     *
     * @param string $param
     * @return string
     */
    public function getPost($param){
        if(isset($_POST[$param])){
            return $_POST[$param];
        }
        else{
            return null;
        }
    }

    /**
     *
     * @param array $results
     * @return \stdClass
     */
    protected function sendResults(array $results){
        $formattedResults = new \stdClass();
        foreach($results as $key => $value){
            $formattedResults->{$key} = $value;
        }

        return $formattedResults;
    }
}
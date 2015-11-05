<?php
namespace INUtils\Helper;

use INUtils\Controller\EmailController;
class InterceptorHelper
{
    /**
     *
     * @var \stdClass
     */
    private $results;

    function __construct(){
        $this->results = $this->postInterceptorToControllers();
    }

    /**
     * @return \stdClass
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     *
     * @param string $message
     */
    private function sendErrorMessage($message){
        header('Content-Type: application/json');
        header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
        echo json_encode(array("error" => $message));
        exit;
    }
    
    /**
     * 
     * @param string $url
     * @return string
     */
    private function removeParams($url){
        $urls = explode("?", $url);
        $method = $url[0];
        return $method;
    }

    /**
     *
     * @throws \Exception
     * @return \stdClass
     */
    private function postInterceptorToControllers()
    {
        $urls = $this->getUrlParts();
        if($urls[1] == "api"){

            error_reporting(0);
            require('wp-load.php');
            require_once(ABSPATH . 'wp-includes/pluggable.php');

            try{
                if($urls[2] == 'post' || $urls[2] == 'posts'){
                    $controller = $this->getPostController();
                }
                elseif($urls[2] == 'email'){
                    $controller = EmailController::getSingleton();
                }
                else{
                    $controller = $this->getControllerClassFromUrlPart($urls[2]);
                }
            }
            catch (\Exception $ex){ }

            $method = $this->removeParams($urls[3]);
            if(!method_exists($controller, $method."Action")){
                $this->sendErrorMessage("The method ".$method."Action doesn't exist in ".get_class($controller)." class");
            }

            $results = $controller->{$method."Action"}();

            if(is_array($results)){

                header('Content-Type: application/json');
                echo json_encode($results, JSON_UNESCAPED_UNICODE);
                exit;
            }
            else{
                $this->sendErrorMessage("Output is not an array");
            }
        }
        elseif(isset($_POST["action-type"])){
            $controller = $this->getControllerClassFromUrlPart($urls[1]);
            return $controller->{$_POST["action-type"]."Action"}();
        }
        else{
            return new \stdClass();
        }
    }

    /**
     *
     * @param string $namespace
     * @return string
     */
    private function getRidOfLastS($namespace){
        $lastLetter = substr($namespace, strlen($namespace)-1, 1);
        if($lastLetter == "s"){
            $namespace = substr($namespace, 0, strlen($namespace)-1);
        }
        return $namespace;
    }

    /**
     *
     * @return multitype:string
     */
    private function getUrlParts()
    {
        $urls = explode("/", $_SERVER['REQUEST_URI']);
        return $urls;
    }

    /**
     *
     * @param string $urlPart
     * @return string
     */
    private function getNamespaceNameFromUrlPart($urlPart)
    {
        $namespace = ucfirst($urlPart);
        return $this->getRidOfLastS($namespace);
    }

    /**
     *
     * @param string $urlPart
     */
    private function getControllerClassFromUrlPart($urlPart){
        $namespace = $this->getNamespaceNameFromUrlPart($urlPart);
        $className = "\\".$namespace."\\Controller\\".$namespace."Controller";
        
        try{
            return $className::getSingleton();
        }
        catch(\Exception $ex){
            $className = "\\INUtils\\Controller\\".$namespace."Controller";
            return $className::getSingleton();
        }
    }

    /**
     *
     * @return string
     */
    private function getPostController(){
        $className = "\\INUtils\\Controller\\PostController";
        return $className::getSingleton();
    }
}

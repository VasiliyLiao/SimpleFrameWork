<?php
namespace App\Request;
use App\Response\Response;
class Request{
    public $all = [];
    private $badReqRes = null;
//    public function get($key)
//    {
//        return $_GET[$key];
//    }
//    public function post($key)
//    {
//        return $_POST[$key];
//    }
//    public function __construct()
//    {
//        foreach ($_GET as $key => $value) {
//            $this->setParams($key,$value);
//        }
//        foreach ($_POST as $key => $value) {
//            $this->setParams($key,$value);
//        }
//    }

    public function setBadReqRes(Response $response)
    {
        $this->badReqRes = $response;
    }

    public function setNullPostParams($params)
    {
        $this->setNullParams('POST',$params);
    }

    public function setNullGetParams($params)
    {
        $this->setNullParams('GET',$params);
    }

    public function filterGetParams()
    {
        $params = func_get_args();
        $this->checkParams('GET', $params);
    }

    public function filterPostParams()
    {
        $params = func_get_args();
        $this->checkParams('POST', $params);
    }

    public function setParams($key,$value)
    {
        $this->{$key}=$value;
        $this->all[$key]=$value;
    }

    private function setNullParams($method, $params)
    {
        if ($method == 'GET') {
            foreach ($params as $key => $value) {
                if(!isset($_GET[$key])){
                    $_GET[$key] = $value;
                }
            }
            return true;
        }

        foreach ($params as $key => $value) {
            if(!isset($_POST[$key])){
                $_POST[$key] = $value;
            }
        }
        return true;

    }
//
//    private function checkParams($method,$checkParams)
//    {
//        if ($method == 'GET') {
//            foreach ($checkParams as $value) {
//                if (!isset($_GET[$value])) {
//                    return $this->badStatus();
//                }
//            }
//        }
//        if ($method == 'POST') {
//            foreach ($checkParams as $value) {
//                if (!isset($_POST[$value])) {
//                    return $this->badStatus();
//                }
//            }
//        }
//
//        return true;
//    }
    private function checkParams($method,$checkParams)
    {
        if ($method == 'GET') {
            foreach ($checkParams as $value) {
                if (!isset($_GET[$value])) {
                    return $this->badStatus();
                }
                $this->setParams($value,$_GET[$value]);
            }
        }
        if ($method == 'POST') {
            foreach ($checkParams as $value) {
                if (!isset($_POST[$value])) {
                    return $this->badStatus();
                }
                $this->setParams($value,$_POST[$value]);
            }
        }

        return true;
    }

    private function badStatus()
    {
        $this->exitBadResponse();
        return false;
    }
    private function exitBadResponse()
    {
        echo $this->badReqRes->badRequest();
        exit(1);
    }
}

?>
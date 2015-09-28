<?php
namespace App\Kernel;

class Route
{
    public static $routeName = [];
    private static $requestParams = [];
    private static $patternParams = [];
    public static $isRun = false;
    private static $func = null;
    private static $middleware = null;

    public static function pattern($key, $value)
    {
        self::$patternParams[":$key"] = $value;
    }

    public static function any($uri, $action, $where = [])
    {
        self::addRoute($_SERVER['REQUEST_METHOD'], $uri, $action, $where);
    }

    public static function get($uri, $action, $where = [])
    {
        self::addRoute('GET', $uri, $action, $where);
    }

    public static function post($uri, $action, $where = [])
    {
        self::addRoute('POST', $uri, $action, $where);
    }

    public static function resource($uri,$routeName,$controller)
    {
        self::pattern('_resource_id', '[0-9]+');
        self::get($uri,                            ['as'=>$routeName.'.index',  $controller.'@index']);    //index
        self::get($uri .'/{_resource_id}',          ['as'=>$routeName.'.show' ,  $controller.'@show']);     //show
        self::get($uri .'/create',                 ['as'=>$routeName.'.create', $controller.'@create']);   //create
        self::post($uri.'/store',                  ['as'=>$routeName.'.store',  $controller.'@store']);    //store
        self::get($uri .'/edit/{_resource_id}',     ['as'=>$routeName.'.edit' ,  $controller.'@edit']);     //edit
        self::post($uri.'/update/{_resource_id}',   ['as'=>$routeName.'.update', $controller.'@update']);   //update
        self::post($uri.'/delte/{_resource_id}',    ['as'=>$routeName.'.delete', $controller.'@delete']);   //delete
    }

    public static function run()
    {

        if (self::$isRun) {
            echo self::runAction();
            self::$isRun = false;
            self::$func = null;
            return true;
        }

        //header("HTTP/1.0 404 Not Found");
        echo json_encode(['header_status' => 404, 'message' => 'page not found']);
        return false;
    }

/**
 * @param $method
 * @param $currentUri
 * @param $action
 * @param $where
 * @return bool
 */
    private static function addRoute($method,$currentUri, $action, $where=[]){

        if (!isset($_SERVER['REDIRECT_URL'])) {
            $_SERVER['REDIRECT_URL'] = Server_Document.'/';
        }
        $callBack = $action;
        if (is_array($action)) {
            if (isset($action['as'])) {
                self::$routeName[$action['as']] = $currentUri;
            }
            $callBack = $action[0];
        }

        $nowUri = $_SERVER['REDIRECT_URL'];
        $currentUri = '/^' . str_replace('/', '\/',  Server_Document.$currentUri) . '$/';

        if (self::$isRun or $_SERVER['REQUEST_METHOD'] != $method) {
            return false;
        }
        if (strpos($currentUri, ':') !== false ) {
            if (empty($where)) {
                foreach (self::$patternParams as $key => $value) { 
                    $currentUri = str_replace($key,'('.$value.')',$currentUri);
                }
            } else {
                foreach ($where as $key => $value) {
                    $currentUri = str_replace(':'.$key,'('.$value.')',$currentUri);
                }
            }
        }
        if (preg_match($currentUri, $nowUri,$params)) {
            array_shift($params);
            self::$requestParams = $params;
            self::$isRun = true;
            self::$func = $callBack;
            if (!is_object($action)) {
                self::$middleware = isset($action['middleware']) ? $action['middleware'] : null;
            }
            return true;
        }
        self::$requestParams = [];
        return false;
    }

    private static function runAction()
    {
        $action = self::$func;
        if(is_string($action)){
            $tmp = explode('@', $action);
            $tmp[0] = "\\App\\Controller\\".$tmp[0];
            $middleware = null;
            if (self::$middleware) {
                $middleClass = "\\App\\Controller\\".self::$middleware;
                $middleware = Container::resolve($middleClass, 'handle', self::$requestParams);
                if ($middleware == 'next' or is_object($middleware) or is_array($middleware)) {
                    return Container::resolve($tmp[0], $tmp[1], self::$requestParams,$middleware);
                }
                return $middleware;
            }
            return Container::resolve($tmp[0], $tmp[1], self::$requestParams);
        }
        return call_user_func_array($action, self::$requestParams);
    }

}



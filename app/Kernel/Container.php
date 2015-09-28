<?php
namespace App\Kernel;
use \ReflectionClass;

class Container
{
    protected static $map = [];

    public static function get($name)
    {
        list($class, $args) = isset(static::$map[$name]) ?
                              static::$map[$name]:
                              [$name, null];
        if (class_exists($class, true)) {
            $reflectionClass = new ReflectionClass($class);
            return !empty($args) ?
                   $reflectionClass->newInstanceArgs($args):
                   new $class();
        }
        return null;
    }

    public static function resolve($name, $method = 'index', $requestParams = [], $middleware = null)
    {

        $reflectionClass = new ReflectionClass($name);
        $reflectionConstructor = $reflectionClass->getConstructor();
        $reflectionMethod = $reflectionClass->getMethod($method);
        $args = [];
        if ($reflectionConstructor) {

            foreach ($reflectionConstructor->getParameters() as $param) {
                $class = $param->getClass()->getName();
                $args[] = static::get($class);
            }

        }
        $name = ($reflectionClass->newInstanceArgs($args));
        if ($middleware) {
            $name->middleResponse = $middleware;
        }
//        $args = [];
//        foreach ($reflectionMethod->getParameters() as $param) {
//            $class = $param->getClass();
//            if ($class) {
//                $class = $class->getName();
//                $args[] = static::get($class);
//            }
//        }
//
//        foreach ($requestParams as $value) {
//            $args[] = $value;
//        }
        $args = $requestParams;
        return call_user_func_array([$name, $method], $args);
    }

}
?>
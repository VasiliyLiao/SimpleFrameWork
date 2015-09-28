<?php
//require __DIR__ . '/request/MultiCurl.php';
//require __DIR__ . '/request/AsyncRequest.php';
require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../config/db.php';
require_once __DIR__.'/../config/app.php';

class TestKernel extends \PHPUnit_Framework_TestCase
{
    protected $result = null;

    public function __consturct()
    {
        parent::__construct();
        $_SERVER['REMOTE_ADDR'] = '127.0.0.1';
        require_once __DIR__.'/../bootstrap/bootstrap.php';
    }

    public function fakeRequest($uri, $method ='GET', $requestData = [])
    {
        $_SERVER['REDIRECT_URL'] = Server_Document."/$uri";
        $_SERVER['REQUEST_METHOD'] = $method;
        if (in_array($method,['GET','get'])) {
            $_GET = $requestData;
        } else {
            $_POST = $requestData;
        }
        $this->result = $this->getRoutes();
    }

    private function getRoutes()
    {
        ob_start();
        include (__DIR__.'/../App/routes.php' );
        $result = ob_get_contents();
        ob_end_clean();
        return $result;
    }

}
?>
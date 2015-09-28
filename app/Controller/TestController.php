<?php
namespace App\Controller;

use App\Kernel\Controller;
use App\Request\Request;

class TestController extends Controller
{

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index()
    {
        return 'Hello World';
    }

    public function show($id)
    {
        return "Your ID: $id";
    }

    public function showMiddleware()
    {
        return "Hello {$this->middleResponse['account']}";
    }

}
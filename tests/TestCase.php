<?php
require __DIR__ . '/TestKernel.php';

class TestCase extends TestKernel
{

    public function testTestIndex()
    {
        $uri = 'test';
        $this->fakeRequest($uri);
        $this->assertEquals('Hello World', $this->result);
    }

    public function testTestShow()
    {
        $id = 1;
        $uri = "test/$id";
        $this->fakeRequest($uri);
        $this->assertEquals("Your ID: $id", $this->result);
    }

    public function testAuthLogin()
    {
        $uri = 'auth';
        $method = 'POST';
        $account = 'test01';
        $password = 'test01';
        $requestData = ['account' => $account, 'password' => $password];
        $this->fakeRequest($uri, $method, $requestData);
        $this->assertEquals("Hello $account", $this->result);
    }
    public function testAuthStore()
    {
        $uri = 'auth/store';
        $method = 'POST';
        $account = 'test03';
        $password = 'test03';
        $requestData = ['account' => $account, 'password' => $password];
        $this->fakeRequest($uri, $method, $requestData);
        $result = json_decode($this->result,true);
        $this->assertEquals($result['header_status'],200);
        $this->assertEquals($result['header_message'],'ok');
        $this->assertEquals($result['error_code'],0);

    }
}

?>
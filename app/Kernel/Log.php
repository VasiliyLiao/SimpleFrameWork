<?php
namespace App\Kernel;

class Log
{
	public $ip = null;
	public $today = null;
	public $time = null;
	public $method = null;
	public $uri = null;
	public $userAgent = null;
	public $requestParams = null;

	public function setParams($key, $value)
	{
		$this->{$key} = $value;
	}

	public function __construct()
	{
		$this->ip = $_SERVER['REMOTE_ADDR'];
		$this->today = date("Y-m-d");
		$this->time = date("Y-m-d H:i:s");
		$this->method = $_SERVER['REQUEST_METHOD'];
		$this->uri = $_SERVER['REQUEST_URI'];
		$this->userAgent = $_SERVER['HTTP_USER_AGENT'];
		$this->setRequestParams($_POST);
	}
	public function setRequestParams($params)
	{
		$this->requestParams = json_encode($params);
	}
	public function write()
	{
		$path = ProjectRealPath.'storage/logs/'."access-($this->today).log";
		$data = "[$this->ip] - [$this->time] - [$this->method - $this->uri] - [$this->requestParams] - [$this->userAgent]\r\n";
		$file = fopen($path,'a');
		if ($file) {
			fwrite($file,$data);
			fclose($file);
		}

	}

}



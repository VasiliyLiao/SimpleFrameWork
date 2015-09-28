<?php
namespace database;

class CallDatabaseClass {
	public $config =
			[
				'seeds'		=>
					[
						'dir'	=>	['seeds'],
						'method'=>	['run','truncate'],

					],
				'tables'	=>
					[
						//'dir'	=>	['tables','views','others','events'],
						'dir'	=>	['tables'],
						'method'=>	['up','down'],
					],
			];
	public $method='';
	public $switch='';

	public function setRunWhich($route='seeds'){
		$this->switch=$route;
	}
	public function run($method)
	{
		$this->method = $method;

		foreach ($this->config[$this->switch]['dir'] as $key => $value) {
			$this->callDirClass(scandir(__DIR__.'\\'.$this->switch.'\\'.$value),$value);
		}

	}
	public function runOne($name,$method){
		$this->method = $method;
		$this->call($name);
	}

	private function callDirClass($files,$name){
		foreach ($files as $key => $value) {
			$value=explode('.', $value)[0];
			if(!empty($value)){
				$this->call($name.'\\'.$value);
			}

		}
	}

	private function call($obj){
		$tmp='';
		$obj = "\\database\\".$this->switch."\\".$obj;
		$tmp=$obj;
		echo "\033[0;36m ----------------make $tmp---------------------\033[0m\n";

		$obj = new $obj();
		$method = $this->config[$this->switch]['method'];
		if($this->method == $method[0]){
			$obj->{$method[0]}();
		}else{
			$obj->{$method[1]}();
		}

	}

}

<?php
use Illuminate\Database\Capsule\Manager as Capsule;

$db['eloquent']=
		[
		    'driver'    => 'SQL',
			'host'      => 'HostIP',
			'database'  => 'Database',
			'username'  => 'User',
			'password'  => 'Password',
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix'    => ''
		];


$capsule = new Capsule;
$capsule->setAsGlobal();
$capsule->addConnection($db['eloquent']);
$capsule->bootEloquent();

?>

<?php
namespace database\seeds\seeds;
use App\Model\Entites\User;

class Users{

	public function run(){
		$data = [];
		for ($i = 0;$i < 5;$i++)
		{
			$faker = \Faker\Factory::create();
			$tmp = [];
			$tmp['account'] = $faker->userName;
			$tmp['password'] = $faker->password;
			$data[] = $tmp;
		}

		User::insert($data);
	}

}
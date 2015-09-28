<?php
namespace database\seeds\seeds;
use App\Model\Entites\UserInfo;

class UserInfos{

    public function run(){
        $data = [];
        for ($i = 0;$i < 5;$i++)
        {
            $faker = \Faker\Factory::create();
            $tmp = [];
            $tmp['user_id'] = $i + 1;
            $tmp['name'] = $faker->userName;
            $tmp['gender'] = $faker->boolean();
            $tmp['phone'] = $faker->phoneNumber;
            $tmp['birthday'] = '1994-01-01';
            $data[] = $tmp;
        }

        UserInfo::insert($data);
    }

}
<?php
namespace App\Model\Entites;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
	protected $fillable = ['account', 'password', 'remember_token'];
	public function info()
	{
		return $this->hasMany('\App\Model\Entites\UserInfo');
	}
}


?>
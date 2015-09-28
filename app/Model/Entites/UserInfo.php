<?php
namespace App\Model\Entites;
use Illuminate\Database\Eloquent\Model;


class UserInfo extends Model
{
    protected  $fillable = ['name', 'gender', 'phone', 'birthday', 'image'];
}


?>
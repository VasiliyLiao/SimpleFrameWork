<?php
use App\Kernel\Route;
//Route::pattern('name', '.*?');
//Route::pattern('id', '[0-9]+');
Route::get('/test', 'TestController@index');
Route::get('/test/:id','TestController@show',['id'=>'[0-9]+']);
Route::post('/auth', ['middleware' => 'AuthController', 'TestController@showMiddleware']);
Route::post('/auth/:id/update', 'AuthController@update',['id'=>'[0-9]+']);
Route::post('/auth/store', 'AuthController@store');
Route::run();


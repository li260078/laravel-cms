<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//用户
Route::get('/','Home\IndexController@index')->name('home.index');
Route::get('register','UserController@register')->name('register');
Route::get('login','UserController@login')->name('login');
Route::post('register','UserController@store')->name('register');
Route::post('login','UserController@loginForm')->name('login');
Route::get('logout','UserController@logout')->name('logout');
Route::get('passwordreser','UserController@passwordReset')->name('passwordreser');
Route::post('passwordreser','UserController@passwordResetFrom')->name('passwordreser');
//工具
Route::any('/code/send','Util\CodeController@send')->name('code.send');

//后台管理
//Route::get('admin/index','Admin\IndexController@index')->name('admin.index');
Route::group(['middleware'=>['admin.auth'],'prefix'=>'admin','namespace'=>'Admin','as'=>'admin.'],function (){
    Route::get('index','IndexController@index')->name('index');
});
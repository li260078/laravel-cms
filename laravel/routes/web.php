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

//Route::get('/', function () {
//    return view('welcome');
//});

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
Route::group(['prefix'=>'util','namespace'=>'Util','as'=>'util.'],function(){
    //邮箱
    Route::any('/code/send','CodeController@send')->name('code.send');
    //上传
    Route::any('/upload','UploadController@uoloader')->name('upload');
    Route::any('/filesLists','UploadController@filesLists')->name('filesLists');
});
//会员中心
Route::group(['prefix'=>'member','namespace'=>'Member','as'=>'member.'],function (){
    Route::resource('user','UserController');
    Route::get('attention/{user}','UserController@attention')->name('attention');
    Route::get('interestList/{user}','UserController@interestList')->name('interestList');
    Route::get('fanList/{user}','UserController@fanList')->name('fanList');

});
//后台管理
//Route::get('admin/index','Admin\IndexController@index')->name('admin.index');
Route::group(['middleware'=>['admin.auth'],'prefix'=>'admin','namespace'=>'Admin','as'=>'admin.'],function (){
    Route::get('index','IndexController@index')->name('index');
    Route::resource('category','CategoryController');
});

//文章管理
Route::group(['prefix'=>'home','namespace'=>'Home','as'=>'home.'],function (){
    Route::get('/','IndexController@index')->name('index');
    Route::resource('article','ArticleController');
});
<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// 主页面的路由组
Route::get('/', 'IndexController@index');
Route::get('index/index.html', 'IndexController@index');

// 算法报名名单
Route::get('algorithm/index.html','AlgorithmController@index');
Route::get('algorithm','AlgorithmController@index');
Route::get('algorithm/delete.html','AlgorithmController@delete');

// 人员管理模块
	// 入会申请
Route::get('pm/memApp.html','PmController@memApp');
Route::get('pm/memApp/delete.html','PmController@delete');

// 登录模块
Route::get('login','LoginController@login');
Route::get('login/index.html','LoginController@login');
Route::post('login/loginHandle.html','LoginController@loginHandle');
	// 退出
	Route::get('login/signOut.html','LoginController@signOut');

// 测试模块
Route::get('test/test.html','TestController@test');


// 验证码
Route::get('validate.html','ValidateController@validate');
Route::get('getValidateCount.html',"ValidateController@getValidateCount");
Route::post('validateCheck.html','ValidateController@validateCheck');
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});

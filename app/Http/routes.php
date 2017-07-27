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

// 主页面
Route::get('/', 'IndexController@index');
Route::get('index.html', 'IndexController@index');

// 协会招新页面
Route::get('crn.html', 'CrnController@index');
Route::post('crn/handle.html', 'CrnController@handle');

// 其他测试页面
Route::get('test', 'TestController@test');
Route::get('fun', 'TestController@curlTest');

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

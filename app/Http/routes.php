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
Route::get('index', 'IndexController@index');
Route::get('index/index.html', 'IndexController@index');
// Route::get('test', 'IndexController@test');

// 协会招新页面
// Route::get('crn', 'CrnController@index');
// Route::get('crn/index.html', 'CrnController@index');
// Route::post('crn/handle.html', 'CrnController@handle');
	// 个人信息修改
	Route::get('crn/changeInfo.html', 'CrnController@changeInfo');
	Route::post('crn/changeInfoHandle.html', 'CrnController@changeInfoHandle');


	Route::get('crn/confirm.html', 'CrnController@confirmPage');
	Route::post('crn/confirmGetInfo.html', 'CrnController@confirmGetInfo');
	Route::post('crn/confirmChange.html', 'CrnController@confirmChange');
	// 协会招新邮件发送
	Route::get('crn/sendMail.html', 'CrnController@sendMail');

// 协会动态页面组
	// 算法入门报名页面
	// Route::get('act/algorithm.html', 'ActController@algorithm');
	// Route::post('act/algorithmHandle.html', 'ActController@algorithmHandle');
	Route::get('act/success.html', 'ActController@success');
	Route::get('act/code.html', 'ActController@codeOnline');
	// 新生班级查询
	Route::get('act/findClass.html', 'ActController@findClass');
	Route::get('act/getVerify.html', 'ActController@getVerify');
	Route::post('act/login.html', 'ActController@login');
	Route::get('act/getInfo.html', 'ActController@getInfo');
	// 四六级查询
	Route::get('act/findGrade.html', 'ActController@findGrade');
	Route::post('act/findGradeResult.html', 'ActController@findGradeResult');
	Route::post('act/getVerifyGrade.html', 'ActController@getVerifyGrade');
	Route::get('act/getGradeNum.html', 'ActController@getGradeNum');
	Route::post('act/getGradeNumHandle.html', 'ActController@getGradeNumHandle');

	// 图书借阅信息
	Route::get('act/findBookMsg.html', 'ActController@findBookMsg');
	Route::get('act/getBookVerify.html', 'ActController@getBookVerify');
	Route::post('act/findBookMsgLogin.html', 'ActController@findBookMsgLogin');
	Route::get('act/findBookMsgResult.html', 'ActController@findBookMsgResult');
	Route::post('act/continueGetBook.html', 'ActController@continueGetBook');
	Route::get('act/findBookMsgExit.html', 'ActController@findBookMsgExit');

	// 成绩查询(期末成绩)
	Route::get('act/grade.html', 'ActController@grade');
	Route::get('act/getVerifyGradeQM.html', 'ActController@getVerifyGradeQM');
	Route::post('act/jwxtLogin.html', 'ActController@jwxtLogin');
	Route::get('act/jwxtGrade.html', 'ActController@jwxtGrade');
	Route::get('act/gradeExit.html', 'ActController@gradeExit');
	Route::get('act/jwxtJD.html', 'ActController@jwxtJD');
	// 获取新生所有信息
	// Route::get('act/getData.html', 'ActController@getNewStudentData');

// 项目展示页面
Route::get('project', 'ProjectController@index');
Route::get('project/index.html', 'ProjectController@index');

// 其他测试页面
// Route::get('test/test', 'TestController@test');
// Route::get('test/fun', 'TestController@curlTest');
// Route::get('test/sql.html', 'TestController@sqlTest');
// Route::get('test/email.html', 'TestController@emailTest');
// Route::get('test/testFrame.html', 'TestController@testFrame');

// 关于我们页面模块
Route::get('about', 'AboutController@index');
Route::get('about/index.html', 'AboutController@index');

// 会员登录界面
Route::get('login/index.html', 'LoginController@index');
Route::get('login', 'LoginController@index');
Route::post('login/loginHandle.html', 'LoginController@loginHandle');
	// 修改密码
	Route::get('login/changePassword.html', 'LoginController@changePassword');
	Route::post('login/changePasswordHandle.html', 'LoginController@changePasswordHandle');
	// 退出登录
	Route::get('login/loginExit.html', 'LoginController@loginExit');

// 验证码
Route::get('validate.html', 'ValidateController@validate');
Route::get('getValidateCount.html', "ValidateController@getValidateCount");
Route::post('validateCheck.html', 'ValidateController@validateCheck');
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

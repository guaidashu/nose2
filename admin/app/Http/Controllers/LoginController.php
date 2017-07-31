<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
	public function __construct()
	{
		session_start();
		if(empty($_SESSION['ca_admin_username'])){
			$_SESSION['ca_admin_username']=null;
		}
		// 给验证码的值赋为空若是第一次登进页面
		if(empty($_SESSION['validate_count'])){
			$_SESSION['validate_count']=0;
		}
	}

	public function login()
	{
		if(!empty($_SESSION['ca_admin_username'])){
			return redirect('index/index.html');
		}
		return view('login/index');
	}

	public function loginHandle()
	{
		// 判断是否提交次数已到
		if($_SESSION['validate_count']>=3){
			echo js_arr("validate");
			exit;
		}
		$username=htmlspecialchars($_POST['username']);
		$password=htmlspecialchars($_POST['password']);
		if(!$username || !$password){
			$_SESSION['validate_count']+=1;
			echo js_arr("failed");
			exit;
		}
		$password=md5($password);
		$data=DB::table('user')->get();
		foreach ($data as $key => $value) {
			if($value->phone==$username || $value->email==$username){
				if($value->password==$password){
					$_SESSION['ca_admin_username']=$value->name;
					$_SESSION['ca_admin_type']=$value->type;
					echo js_arr("ok");
					exit;
				}else{
					$_SESSION['validate_count']+=1;
					echo js_arr("error_password");
					exit;
				}
			}
		}
		$_SESSION['validate_count']+=1;
		echo js_arr("error_user");
	}
}
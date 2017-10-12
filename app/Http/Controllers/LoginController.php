<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class LoginCOntroller extends Controller
{
	public function __construct()
	{
		session_start();
		// 给验证码的值赋为空若是第一次登进页面
		if(empty($_SESSION['validate_count'])){
			$_SESSION['validate_count']=0;
		}
		// 判断是否有用户登录 ，否则会直接赋为空
		if(empty($_SESSION['ca_username'])){
			$_SESSION['ca_username']=null;
		}
	}

	public function index()
	{
		if(!empty($_SESSION['ca_username'])){
			return redirect('index/index.html');
		}
		return view('login/index');
	}

	public function loginHandle()
	{
		if(!empty($_SESSION['ca_username'])){
			echo js_arr("login");
			exit;
		}
		if($_SESSION['validate_count']>=3){
			echo js_arr("validate");
			exit;
		}
		if(!$_POST['username'] || !$_POST['password']){
			echo js_arr("failed");
			$_SESSION['validate_count'] += 1;
			exit;
		}

		$username = htmlspecialchars($_POST['username']);
		$password = htmlspecialchars($_POST['password']);

		$data = DB::table('crn')->where('phone', $username)->get();
		if(!empty($data[0])){
			if($data[0]->password == md5($password)){
				$_SESSION['ca_username'] = $data[0]->name;
				$_SESSION['ca_phone'] = $data[0]->phone;
				$_SESSION['ca_xh'] = $data[0]->xh;
				$_SESSION['ca_access'] = $data[0]->allow;
				echo js_arr("ok");
			}else{
				echo js_arr("error_password");
				$_SESSION['validate_count'] += 1;
			}
		}else{
			echo js_arr("error_user");
			$_SESSION['validate_count'] += 1;
		}
	}

	public function changePassword()
	{
		return view('login/changePassword', ['name'=>$_SESSION['ca_username']]);
	}

	public function changePasswordHandle()
	{
		if($_SESSION['validate_count']>=3){
			echo js_arr("validate");
			exit;
		}
		if(empty($_POST['phone'])||empty($_POST['password'])||empty($_POST['newPwd'])){
			echo js_arr("failed");
			$_SESSION['validate_count'] += 1;
			exit;
		}

		$phone = htmlspecialchars($_POST['phone']);
		$password = htmlspecialchars($_POST['password']);
		$newPwd = htmlspecialchars($_POST['newPwd']);
		if(!$phone || !$password || !$newPwd){
			echo js_arr("failed");
			$_SESSION['validate_count'] += 1;
			exit;
		}
		if(!numCheck($phone)){
			echo js_arr("error_user");
			$_SESSION['validate_count'] += 1;
			exit;
		}

		$data = DB::table('crn')->where('phone', $phone)->get();
		if(!empty($data[0])){
			if($data[0]->password == md5($password)){
				$data = DB::table('crn')->where("phone", $phone)->update(['password'=>md5($newPwd)]);
				if($data){
					echo js_arr("ok");
				}
			}else{
				echo js_arr("error_password");
				$_SESSION['validate_count'] += 1;
			}
		}else{
			echo js_arr("error_user");
			$_SESSION['validate_count'] += 1;
		}
	}

	public function loginExit()
	{
		$_SESSION['ca_username'] = null;
		$_SESSION['ca_phone'] = null;
		$_SESSION['ca_xh'] = null;
		$_SESSION['ca_access'] = null;
		echo js_arr("ok");
	}
}
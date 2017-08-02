<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Mail;

class ActController extends Controller
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
	// 算法页面控制函数
	public function algorithm()
	{
		return view('act/algorithm',['name'=>$_SESSION['ca_username']]);
	}

	// 算法入门报名信息提交函数
	public function algorithmHandle()
	{
		// 判断是否提交次数已到
		if($_SESSION['validate_count']>=3){
			echo js_arr("validate");
			exit;
		}
		// 首先接收传递post的内容
		$name=htmlspecialchars($_POST['name']);
		$email=$_POST['email'];
		$subject=htmlspecialchars($_POST['subject']);
		$phone=htmlspecialchars($_POST['phone']);
		if((strlen($name)/3)<2 || !$phone || !$email || (strlen($subject)/3)>4){
			echo js_arr("failed");
			exit;
		}
		// 判断是否为正确的邮箱
		if(!emailCheck($email)){
			echo js_arr("email");
			exit;
		}
		// 判断手机号是否为正确的
		if(!phoneCheck($phone)){
			echo js_arr("phone");
			exit;
		}

		//我们需要判断邮箱和手机号码是否已被注册
		$data=DB::select('select phone,email from algorithm');
		foreach ($data as $key => $value) {
			if($value->email==$email){
				echo js_arr("re_email");
				exit;
			}
			if($value->phone==$phone){
				echo js_arr("re_phone");
				exit;
			}
		}
		// 二维码地址
		$img="http://nose.wyysdsa.cn/images/weixin.png";
		$data=Mail::send('email/algorithm',['name'=>$name,'img'=>$img],function($message) use ($email){
			$message->subject("算法报名通知");
			$message->to($email);
		});
		if(!$data){
			echo js_arr("error_email");
			exit;
		}
		$arr=array(
			"name"=>$name,
			"email"=>$email,
			"subject"=>$subject,
			"phone"=>$phone,
			'date'=>date('Y-m-d H:i:s',time())
			);
		// 插入数据库 并且获取操作返回值
		$data=DB::table('algorithm')->insert($arr);
		//成功返回ok ，否则返回failed
		if($data){
			echo js_arr("ok");
			$_SESSION['validate_count']+=1;
		}else{
			echo js_arr("failed");
			$_SESSION['validate_count']+=1;
		}
	}

	public function success()
	{
		return view('act/success',['name'=>$_SESSION['ca_username']]);
	}

	public function codeOnline()
	{
		return view('act/code',['name'=>$_SESSION['ca_username']]);
	}
}
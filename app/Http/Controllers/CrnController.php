<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Mail;

class CrnController extends Controller
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
		return view('crn/index',['name'=>$_SESSION['ca_username']]);
		//这里有问题?
	}

	public function handle()
	{
		echo js_arr("failed");
		exit;
		// 判断是否提交次数已到
		if($_SESSION['validate_count']>=3){
			echo js_arr("validate");
			exit;
		}
		// 首先接收传递post的内容
		$name=htmlspecialchars($_POST['name']);
		$email=htmlspecialchars($_POST['email']);
		$year=htmlspecialchars($_POST['year']);
		$phone=htmlspecialchars($_POST['phone']);
		$content=htmlspecialchars($_POST['content']);
		$major = htmlspecialchars($_POST['major']);
		$xh = htmlspecialchars($_POST['xh']);
		$zybj = htmlspecialchars($_POST['zybj']);
		$sex = htmlspecialchars($_POST['sex']);

		$majorArr = array('Office基础', 'C语言二级考试', '网页前端', '网站后端', 'Java程序设计', 'Android开发', '游戏开发', '网络安全', '算法设计', 'C++', '其它');
		$sexArr = array('男', '女');
		if(strlen($name)<2 || !$phone || !$email || !$year || !$major || !$sex || !$zybj || !$xh){
			echo js_arr("填写的内容不符合规范噢");
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
		// 判断入学年份是否正常
		if(!yearCheck($year)){
			echo js_arr("year");
			exit;
		}
		if(!in_array($major, $majorArr)){
			echo js_arr("major");
			exit;
		}
		if(!in_array($sex, $sexArr)){
			echo js_arr("sex");
			exit;
		}
		//我们需要判断邮箱和手机号码是否已被注册
		// $data=DB::select('select phone,email from crn');
		// foreach ($data as $key => $value) {
		// 	if($value->email==$email){
		// 		echo js_arr("re_email");
		// 		exit;
		// 	}
		// 	if($value->phone==$phone){
		// 		echo js_arr("re_phone");
		// 		exit;
		// 	}
		// }

		$arr=array(
			"name"=>$name,
			"email"=>$email,
			"year"=>$year,
			"phone"=>$phone,
			'date'=>date('Y-m-d H:i:s',time()),
			"content"=>$content,
			"major"=>$major,
			'sex' => $sex,
			'xh' => $xh,
			'zybj' => $zybj
			);
		// 插入数据库 并且获取操作返回值
		$data=DB::table('crn')->where('phone', $phone)->update($arr);
		//成功返回ok ，否则返回failed
		if($data){
			echo js_arr("ok");
		}else{
			echo js_arr("failed");
		}
		$_SESSION['validate_count']+=1;
	}

	public function sendMail()
	{
		// 二维码地址
		$data = DB::table('crn')->where("status", 0)->get();
		if(empty($data[0])){
			// echo js_arr("empty");
			exit;
		}else{
			$email = $data[0]->email;
			$name = $data[0]->name;
		}
		$img = "http://nose.wyysdsa.cn/images/weixin.png";
		$result = Mail::send('email/crn',['name'=>$name,'img'=>$img],function($message) use ($email){
			$message->subject("计算机技术协会入会申请通知");
			$message->to($email);
		});
		if(!$result){
			echo js_arr("error_email")."\n";
			exit;
		}
		$result = DB::table('crn')->where("phone",$data[0]->phone)->update(['status'=>1]);
		if($result){
			echo "成功给".$data[0]->name."发送邮件(".$data[0]->email.")\n";
		}
	}

	public function changeInfo()
	{
		if(empty($_SESSION['ca_username'])){
			return redirect('login/index.html');
		}
		$data = DB::table('crn')->where('phone', $_SESSION['ca_phone'])->get();
		$major = null;
		if(empty($data[0])){
			return redirect('login/index.html');
		}else{
			$major = $data[0]->major;
		}
		return view('crn/changeInfo', ['name'=>$_SESSION['ca_username'], 'major'=>$major, 'data'=>$data[0]]);
	}

	public function changeInfoHandle()
	{
		if(empty($_SESSION['ca_username'])){
			echo js_arr("小biqi");
			exit;
		}
		if($_SESSION['validate_count'] >= 3){
			echo js_arr("validate");
			exit;
		}
		// $username = "15101020615";
		// $major = "Office基础";
		// $password = "wyysdsa!";
		$major = htmlspecialchars($_POST['major']);
		$majorArr = array('Office基础', 'C语言二级考试', '网页前端', '网站后端', 'Java程序设计', 'Android开发', '游戏开发', '网络安全', '算法设计', 'C++', '其它');
		if(!in_array($major, $majorArr)){
			echo js_arr("请填写学习方向");
			exit;
		}
		$data = DB::table('crn')->where('phone', $_SESSION['ca_phone'])->update(['major'=>$major]);
		if($data){
			echo js_arr("ok");
		}else{
			echo js_arr("failed");
		}
		$_SESSION['validate_count'] += 1;
	}

	// 确认入会页面
	public function confirmPage()
	{
		return view('crn/confirmPage', ['name'=>$_SESSION['ca_username']]);
	}

	// 个人信息查询处理
	public function confirmGetInfo()
	{
		$name = htmlspecialchars($_POST['name']);
		$data = DB::table('crn')->where('xh', $name)->get();
		if(empty($data)){
			echo js_arr("没有此人数据", 0);
			exit;
		}
		echo js_arr($data[0], 1);
	}

	// 确认入会处理
	public function confirmChange()
	{
		$qq = htmlspecialchars($_POST['qq']);
		if(!numCheck($qq)){
			echo js_arr("这不是一个正确的QQ号噢");
			exit;
		}
		$id = htmlspecialchars($_POST['id']);
		if(!numCheck($id)){
			echo js_arr("有问题");
			exit;
		}
		$data = DB::table('crn')->where('id', $id)->update(['qq'=>$qq]);
		if($data){
			echo js_arr("ok");
		}else{
			echo js_arr("failed");
		}
	}
}
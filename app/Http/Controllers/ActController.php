<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use App\ActModel;
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

	public function findClass()
	{
		return view('act/findClass',['name'=>$_SESSION['ca_username']]);
	}

	// 获取cookie 同时保存验证码图片
	public function getVerify()
	{
		if(!empty($_SESSION['cookieFile'])){
			unlink($_SESSION['cookieFile']);
			$_SESSION['cookieFile']=null;
		}
		// 验证码URL
		$verifyUrl = "http://61.139.105.105:8088/Account/GetValidateCode";
		// $verifyUrl = "http://61.139.105.105:8088/Account/LogOn?ReturnUrl=%2f";

		// 进行cookie的获取
		$cookieFile = public_path()."/cookie/".md5(date("Y-m-d H:i:s",time())).".cookie";

		// 本地调试 需要把上一句注释掉，把下一句解开注释，因为windows和Linux不同
		// $cookieFile = public_path()."\\cookie\\".md5(date("Y-m-d H:i:s",time())).".cookie";
		
		$_SESSION['cookieFile'] = $cookieFile;
		if(getCookie($verifyUrl, $cookieFile)){
			echo js_arr("cookieFailed");
			exit;
		}

		// 保存验证码图片
		if(getVerify($verifyUrl, $cookieFile)){
			echo js_arr("saveImgFailed");
			exit;
		}else{
			echo js_arr("ok");
		}
	}

	// 模拟登录
	public function login()
	{
		// 登录处理页面的URL 
		$username = $_POST['username'];
		$password = $_POST['password'];
		$validate = $_POST['validate'];
		$loginUrl = "http://61.139.105.105:8088/Account/LogOn?ReturnUrl=%2f";
		$info = array(
			"user" => $username,
			"password" => $password,
			"validate" => $validate
			);
		$result = curlLogin($loginUrl, $info, $_SESSION['cookieFile']);

		$pattern = "/Object moved/";
		if(preg_match($pattern, $result)){
			// 成功了就返回这个
			$_SESSION['findClassCookie'] = 1;
			echo js_arr("ok");
		}else{
			echo js_arr("failed");
			exit;
		}
	}

	// 获取新生信息
	public function getInfo()
	{
		if(empty($_SESSION['findClassCookie'])){
			return redirect("act/findClass.html");
		}
		$url = "http://61.139.105.105:8088/Student/Detail";
		$result = getInfo($url, $_SESSION['cookieFile']);
		// 删除临时的cookie文件夹
		unlink($_SESSION['cookieFile']);
		// 获取班级
		$pattern = '/<td>(.*?)<\/td>/is';
		preg_match_all($pattern, $result, $match);
		// 班级
		$class = $match[1][7];
		// 入学年份
		$year = $match[1][3];
		// 学号
		$classNumber = $match[1][4];
		// 专业
		$major = $match[1][6];
		// 院系 
		$further = $match[1][5];
		// 姓名
		$name = $match[1][0];

		// debug($class);
		// debug($match[1]);
		$arr = array(
			"name" => $name,
			"year" => $year,
			"further" => $further,
			"classNumber" => $classNumber,
			"major" => $major,
			"class" => $class
			);
		$_SESSION['findClassCookie'] = null;
		$_SESSION['cookieFile'] = null;
		return view('act/getInfo',['name'=>$_SESSION['ca_username'],'info'=>$arr]);
	}

	public function findDorm()
	{
		return view('act/findDorm',['name'=>$_SESSION['ca_username']]);//恩那
	}

	public function searchDorm()
	{
		// $arr = null;
		// return view('act/searchDorm',['name'=>$_SESSION['ca_username'],'info'=>$arr]);
		// exit;
		// 开始就来判断来访的域名（防盗链），防止对方curl爬取
		// // 判断Ip ，若是敌对IP则直接结束掉不让其获取信息
		// // $ip = getIP();
		// $ip = getIP();
		// // // debug($ip);
		// // if($ip ==  "28-C2-DD-15-61-9"){
		// //     echo "404 NOT FOUND";
		// //     exit;
		// // }
		// // 若是其他IP ，则最多让其取20次
		// $db = new ActModel();
		// $data = $db->where('ip',$ip)->get();
		// if(!empty($data[0])){
		//     $row = $data[0];
		//     if($row->lookNum>20){
		//         echo "404 NOT FOUND";
		//         exit;
		//     }else{
		//     	$db->where('ip',$ip)->update(['lookNum'=>($row->lookNum+1)]);
		//         // $db->dbresult("update ip set lookNum=".($row['lookNum']+1)." where ip='".$ip."'");
		//     }
		// }else{
		// 	$insert = new ActModel();
		// 	$insert->ip = $ip;
		// 	$insert->lookNum = 1;
		// 	$data = $insert->save();
		// }

		// // 判断无误后，则直接进行爬取信息
		$num = htmlspecialchars($_POST['num']);
		if(!numCheck($num)){
			exit;
		}
		// $url = "http://119.29.201.115/info_disp.php";

		// $post = "ksh=".$num."&submit=ok";
		// $ch = curl_init();
		// curl_setopt($ch, CURLOPT_URL, $url);
		// curl_setopt ($ch, CURLOPT_POST, true);//请求方式为post
		// curl_setopt($ch, CURLOPT_HEADER, 0);
		// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// curl_setopt($ch, CURLOPT_REFERER, 'http://119.29.201.115/'); 
		// // curl_setopt($ch, CURLOPT_REFERER, 'http://nose.wyysdsa.cn/'); 
		// curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		// $result = curl_exec($ch);
		// curl_close($ch);
		// // debug($result, true);
		// // echo $result;
		// $pattern = "/<script>(.*?)<\/script>/";
		// if(preg_match($pattern, $result)){
		// 	$arr = null;
		// }else{
		// 	$pattern = '/<table(.*?)>(.*?)<\/table>/is';
		// 	preg_match_all($pattern, $result, $match);
		// 	$arr = get_td_array_self($match[2][0]);
		// }
		// 
		$arr = DB::table('student')->where('ksh',$num)->get();
		$data = DB::table('ip')->where('ip',"127.0.0.1")->get();
		$lookNum = $data[0]->lookNum+1;
		$data = DB::update("update ip set lookNum=? where ip=?",[$lookNum,'127.0.0.1']);
		$arr = $arr[0];
		// debug($arr->ksh);
		if(empty($arr->ksh)){
			$arr = null;
		}
		$qs = DB::table('student')->where('qs',$arr->qs)->get();
		// debug($qs[0], true);
		return view('act/searchDorm',['name'=>$_SESSION['ca_username'],'info'=>$arr,'qs'=>$qs]);
	}

	public function getNewStudentData()
	{
		// $url = "http://www.suse.edu.cn/p/10/?StId=st_app_news_i_x636387607152888654";//计算机学院
		// $url = "http://www.suse.edu.cn/p/10/?StId=st_app_news_i_x636387607269451011"; // 法学院
		 //$url = "http://www.suse.edu.cn/p/10/?StId=st_app_news_i_x636387607152888654";//计算机学院
                //$url = "http://www.suse.edu.cn/p/10/?StId=st_app_news_i_x636387607302420548"; // 法学院
                //$url = "http://www.suse.edu.cn/p/10/?StId=st_app_news_i_x636387607269451011"; //高端技能人才
//$url = "http://www.suse.edu.cn/p/10/?StId=st_app_news_i_x636387607242888431";                  // 管理学院
//$url = "http://www.suse.edu.cn/p/10/?StId=st_app_news_i_x636387607219450899";
//$url = "http://www.suse.edu.cn/p/10/?StId=st_app_news_i_x636387607194920470";
//$url = "http://www.suse.edu.cn/p/10/?StId=st_app_news_i_x636387607173513751"; // 机械学院
//$url = "http://www.suse.edu.cn/p/10/?StId=st_app_news_i_x636387607131794945"; // 教育心理学院
//$url = "http://www.suse.edu.cn/p/10/?StId=st_app_news_i_x636387607111169848";//经济学院
// $url = "http://www.suse.edu.cn/p/10/?StId=st_app_news_i_x636387606891481510";外语学院
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);
		$pattern = "/<div class='div_content'>(.*?)<\/div>/";
		preg_match_all($pattern, $result, $match);
		$result = $match;
		$pattern = '/<table(.*?)>(.*?)<\/table>/';
		$arr = get_td_array($match[1][0]);
		// debug("ok", true);
		foreach ($arr as $key => $value) {
			// debug($value, true);
			if($key == 0){
				continue;
			}
			// debug($value, true);
			$data = DB::insert('insert into student(xq,ksh,xm,xb,xy,zy,xh,bj,qs)values(?,?,?,?,?,?,?,?,?)',$value);
			// debug($data, true);
		}
	}
}
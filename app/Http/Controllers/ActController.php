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
	// public function algorithm()
	// {
	// 	return view('act/algorithm',['name'=>$_SESSION['ca_username']]);
	// }

	// 算法入门报名信息提交函数
	// public function algorithmHandle()
	// {
	// 	// 判断是否提交次数已到
	// 	if($_SESSION['validate_count']>=3){
	// 		echo js_arr("validate");
	// 		exit;
	// 	}
	// 	// 首先接收传递post的内容
	// 	$name=htmlspecialchars($_POST['name']);
	// 	$email=$_POST['email'];
	// 	$subject=htmlspecialchars($_POST['subject']);
	// 	$phone=htmlspecialchars($_POST['phone']);
	// 	if((strlen($name)/3)<2 || !$phone || !$email || (strlen($subject)/3)>4){
	// 		echo js_arr("failed");
	// 		exit;
	// 	}
	// 	// 判断是否为正确的邮箱
	// 	if(!emailCheck($email)){
	// 		echo js_arr("email");
	// 		exit;
	// 	}
	// 	// 判断手机号是否为正确的
	// 	if(!phoneCheck($phone)){
	// 		echo js_arr("phone");
	// 		exit;
	// 	}

	// 	//我们需要判断邮箱和手机号码是否已被注册
	// 	$data=DB::select('select phone,email from algorithm');
	// 	foreach ($data as $key => $value) {
	// 		if($value->email==$email){
	// 			echo js_arr("re_email");
	// 			exit;
	// 		}
	// 		if($value->phone==$phone){
	// 			echo js_arr("re_phone");
	// 			exit;
	// 		}
	// 	}
	// 	// 二维码地址
	// 	$img="http://nose.wyysdsa.cn/images/weixin.png";
	// 	$data=Mail::send('email/algorithm',['name'=>$name,'img'=>$img],function($message) use ($email){
	// 		$message->subject("算法报名通知");
	// 		$message->to($email);
	// 	});
	// 	if(!$data){
	// 		echo js_arr("error_email");
	// 		exit;
	// 	}
	// 	$arr=array(
	// 		"name"=>$name,
	// 		"email"=>$email,
	// 		"subject"=>$subject,
	// 		"phone"=>$phone,
	// 		'date'=>date('Y-m-d H:i:s',time())
	// 		);
	// 	// 插入数据库 并且获取操作返回值
	// 	$data=DB::table('algorithm')->insert($arr);
	// 	//成功返回ok ，否则返回failed
	// 	if($data){
	// 		echo js_arr("ok");
	// 		$_SESSION['validate_count']+=1;
	// 	}else{
	// 		echo js_arr("failed");
	// 		$_SESSION['validate_count']+=1;
	// 	}
	// }

	// 报名成功信息提示页面
	// public function success()
	// {
	// 	return view('act/success',['name'=>$_SESSION['ca_username']]);
	// }

	// 在线代码编译页面
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
		$imgName = "images/verify.jpg";
		$_SESSION['cookieFile'] = $cookieFile;
		if(getCookie($verifyUrl, $cookieFile)){
			echo js_arr("cookieFailed");
			exit;
		}

		// 保存验证码图片
		if(getVerify($verifyUrl, $cookieFile, $imgName)){
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

	// 新生查询寝室页面
	public function findDorm()
	{
		return view('act/findDorm',['name'=>$_SESSION['ca_username']]);//恩那
	}

	//新生寝室查询处理(结果)页面
	public function searchDorm()
	{

		// // 判断无误后，则直接进行爬取信息
		$num = htmlspecialchars($_POST['num']);
		if(!numCheck($num)){
			exit;
		}
		// $arr = DB::table('student')->where('ksh',$num)->get();
		$arr = DB::select("select * from student where ksh=? group by ksh",[$num]);
		$data = DB::table('ip')->where('ip',"127.0.0.1")->get();
		$lookNum = $data[0]->lookNum+1;
		$data = DB::update("update ip set lookNum=? where ip=?",[$lookNum,'127.0.0.1']);
		if(empty($arr[0])){
			$arr = null;
			$person = null;
			$qs = null;
		}else{
			$arr = $arr[0];
			$qs = DB::select("select * from student where qs=? group by ksh",[$arr->qs]);
		}
		// $qs = DB::table('student')->where('qs',$arr->qs)->get();
		if(!empty($arr)){
			// 这里是进行每个班男女人数统计的
			$count = DB::table('count_person')->where('bj',$arr->bj)->get();
			if(empty($count[0])){
				$person = DB::select("select * from student where bj=? && xb='男' group by ksh",[$arr->bj]);
				$male = count($person);
				$person = DB::select("select * from student where bj=? && xb='女' group by ksh",[$arr->bj]);
				$female = count($person);
				$all = $male+$female;
				$person = array(
					"male" => $male,
					"female" => $female,
					"bj" => $arr->bj,
					"all" => $all
					);
				$data = DB::table('count_person')->insert($person);
			}else{
				$count = $count[0];
				$person = array();
				$person['male'] = $count->male;
				$person['female'] = $count->female;
				$person['all'] = $count->all;
			}
		}
		return view('act/searchDorm',['name'=>$_SESSION['ca_username'],'info'=>$arr,'qs'=>$qs,'person'=>$person]);
	}


	// 这个函数是用来爬取学校页面的所有新生信息并且存到数据库的函数
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

	// 四六级查询页面
	public function findGrade()
	{
		return view('act/findGrade', ['name'=>$_SESSION['ca_username']]);
	}

    // 四六级查询验证码获取
    public function getVerifyGrade()
    {
    	if(!empty($_SESSION['cookieFileGrade'])){
    		unlink($_SESSION['cookieFileGrade']);
    		$_SESSION['cookieFileGrade'] = null;
    	}
    	$zkzh = $_GET['zkzh'];
    	// $cookieUrl = "http://cet.neea.edu.cn/cet/";
    	$url = "http://cache.neea.edu.cn/Imgs.do?ik=".$zkzh."&t=".rand(1,10);
		$imgName = "images/verifyGrade.jpg";
		// 进行cookie的获取
		$cookieFile = public_path()."/cookie/".md5(date("Y-m-d H:i:s",time())).".cookie";
		// 本地调试 需要把上一句注释掉，把下一句解开注释，因为windows和Linux不同
		// $cookieFile = public_path()."\\cookie\\".md5(date("Y-m-d H:i:s",time())).".cookie";
		$_SESSION['cookieFileGrade'] = $cookieFile;
		if(getCookie($url, $cookieFile)){
			echo js_arr("cookieFailed");
			exit;
		}

		$result = getInfoRefer($url, "http://cet.neea.edu.cn/cet/", $cookieFile);
		preg_match_all('/result.imgs\(\"(.*?)\"\)\;/is', $result, $match);
		$url = $match[1][0];
		if(getVerify($url, $cookieFile, $imgName)){
			echo js_arr("failed");
		}else{
			echo js_arr("ok");
		}
    }
	//四六级查询结果处理页面
	public function findGradeResult()
	{
		$zkz = $_POST['zkz'];
		$name = $_POST['name'];
		$validate = $_POST['validate'];
		if(!$zkz || !$name){
			exit;
		}
		$pattern = "/^[0-9]{15}$/";
		if(!preg_match($pattern, $zkz)){
			$result = null;
			return view('act/findGradeResult', ['name'=>$_SESSION['ca_username'], "result"=>$result]);
		}
		$cookieFile = $_SESSION['cookieFileGrade'];
		$post = "data=CET4_171_DANGCI%2C".$zkz."%2C".$name."&v=".$validate;
		$url = "http://cache.neea.edu.cn/cet/query";
		$header = array('Accept: image/jpeg, application/x-ms-application, image/gif, application/xaml+xml, image/pjpeg, application/x-ms-xbap');
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt ($ch, CURLOPT_POST, true);//请求方式为post
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_REFERER, 'http://cet.neea.edu.cn/cet/');
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
		$result = curl_exec($ch);
		curl_close($ch);
		$pattern = "/{(.*?)}/";
		preg_match_all($pattern, $result, $match);
		if(!empty($match[1][0])){
			$result = $match[1][0];
			$pattern = "/error/";
			if(preg_match($pattern, $result)){
				$result = null;
				return view('act/findGradeResult', ['name'=>$_SESSION['ca_username'], "result"=>$result]);
			}
			$result = explode(",", $result);
			foreach ($result as $key => $value) {
				$value = preg_replace("/(.*?):/", "", $value);
				$result[$key] = preg_replace("/'/", "", $value);
			}
		}else{
			$result = null;
		}
		unlink($_SESSION['cookieFileGrade']);
		$_SESSION['cookieFileGrade'] = null;
		return view('act/findGradeResult', ['name'=>$_SESSION['ca_username'], "result"=>$result]);
	}

	// 查询准考证号
	public function getGradeNum()
	{
		return view('act/findNum', ['name'=>$_SESSION['ca_username']]);
	}

	// 查询准考证号 处理函数\
	public function getGradeNumHandle()
	{
		$arr_1 = array("218","218","66","66","218","218","60","60","202","204","66","66","66","59","61","60","222","221","66","59","60","60","66","218","218","62","63","64","66","66","122","211");
		$randarr= mt_rand(0,count($arr_1));
		$ip1id = $arr_1[$randarr];
		$ip2id=  round(rand(600000,  2550000)  /  10000);
		$ip3id=  round(rand(600000,  2550000)  /  10000);
		$ip4id=  round(rand(600000,  2550000)  /  10000);
		$ip = $ip1id . "." . $ip2id . "." . $ip3id . "." . $ip4id;

		$name = $_POST['name'];
		$sfz = $_POST['id'];
		$level = $_POST['level'];
		$url = "http://119.29.186.155:7299/get?id=".$sfz."&name=".$name."&level=".$level;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('CLIENT-IP:'.$ip, 'X-FORWARDED-FOR:'.$ip)); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_REFERER, "http://119.29.186.155:7299/");
		// debug(curl_getinfo($ch), true);
		$result = curl_exec($ch);
		echo js_arr($result);
	}
}
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
	// 	$data=Mail::send('email/crn',['name'=>$name,'img'=>$img],function($message) use ($email){
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
	public function success()
	{
		return view('act/success',['name'=>$_SESSION['ca_username']]);
	}

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
		// 验证码URL
		$verifyUrl = "http://61.139.105.105:8088/Account/GetValidateCode";
		// $verifyUrl = "http://61.139.105.105:8088/Account/LogOn?ReturnUrl=%2f";

		// 进行cookie的获取
		// $cookie = public_path()."/cookie/".md5(date("Y-m-d H:i:s",time())).".cookie";

		// 本地调试 需要把上一句注释掉，把下一句解开注释，因为windows和Linux不同
		// $cookie = public_path()."\\cookie\\".md5(date("Y-m-d H:i:s",time())).".cookie";
		$imgName = "images/verify.jpg";
		$cookie = getCookie($verifyUrl);
		if($cookie == "failed"){
			echo js_arr("getCookieFailed");
			exit;
		}else{
			$_SESSION['cookie'] = $cookie;
		}
		// 保存验证码图片
		if(getVerify($verifyUrl, $cookie, $imgName)){
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
		$info = 'UserName='.$username.'&Password='.$password.'&ValidateCode='.$validate;
		$result = curlLogin($loginUrl, $info, $_SESSION['cookie']);

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
		$result = getInfo($url, $_SESSION['cookie']);
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
		$_SESSION['cookie'] = null;
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
		if(!empty($_SESSION['cookieGrade'])){
    		if(file_exists($_SESSION['cookieGrade'])){
    			unlink($_SESSION['cookieGrade']);
    		}
    		$_SESSION['cookieGrade'] = null;
    	}
		return view('act/findGrade', ['name'=>$_SESSION['ca_username']]);
	}

    // 四六级查询验证码获取
    public function getVerifyGrade()
    {
    	$zkzh = $_POST['zkzh'];
    	// $cookieUrl = "http://cet.neea.edu.cn/cet/";
    	$url = "http://cache.neea.edu.cn/Imgs.do?ik=".$zkzh."&t=0.".abs(mt_rand()<<3);
		$imgName = "images/verifyGrade.jpg";
		// 进行cookie的获取
		// $cookie = public_path()."/cookie/".md5(date("Y-m-d H:i:s",time())).".cookie";
		// 本地调试 需要把上一句注释掉，把下一句解开注释，因为windows和Linux不同
		// $cookie = public_path()."\\cookie\\".md5(date("Y-m-d H:i:s",time())).".cookie";
		
		$cookie = getCookie($url);
		if($cookie == "failed"){
			echo js_arr("getCookieFailed");
			exit;
		}else{
			$_SESSION['cookieGrade'] = $cookie;
		}
		$result = getInfoRefer($url, "http://cet.neea.edu.cn/cet/", $cookie);
		preg_match_all('/result.imgs\(\"(.*?)\"\)\;/is', $result, $match);
		$url = $match[1][0];
		if(getVerify($url, $cookie, $imgName)){
			echo js_arr("failed");
		}else{
			echo js_arr("ok");
		}
    }
	//四六级查询结果处理页面
	public function findGradeResult()
	{
		$ip = virtualIp();
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
		$cookie = $_SESSION['cookieGrade'];
		$_SESSION['cookieGrade'] = null;
		$num = substr($zkz, 9, 1);
		if($num == 1){
			// 四级启用这句话进行post
			$post = "data=CET4_171_DANGCI%2C".$zkz."%2C".$name."&v=".$validate;
		}else{
			// 六级启用这句话进行post
			$post = "data=CET6_171_DANGCI%2C".$zkz."%2C".$name."&v=".$validate;
		}
		$url = "http://cache.neea.edu.cn/cet/query";
		// $header = array('Accept: image/jpeg, application/x-ms-application, image/gif, application/xaml+xml, image/pjpeg, application/x-ms-xbap');
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt ($ch, CURLOPT_POST, true);//请求方式为post
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_REFERER, 'http://cet.neea.edu.cn/cet/');
		// curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('CLIENT-IP:'.$ip, 'X-FORWARDED-FOR:'.$ip)); 
		curl_setopt($ch, CURLOPT_COOKIE, $cookie);
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
		// 获取伪造ip
		$ip = virtualIp();
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

	// 图书借阅信息查询
	public function findBookMsg()
	{
		if(!empty($_SESSION['findBookMsgLogin'])){
			return redirect("act/findBookMsgResult.html");
		}
		return view('act/findBookMsg', ['name'=>$_SESSION['ca_username']]);
	}

	// 图书馆借阅登陆函数
	public function findBookMsgLogin()
	{
	    $userName = $_POST['username'];
	    $password = $_POST['password'];
	    $validate = $_POST['validate'];
		// $userName = "15111020225";
		// $password = "NC01jyo";
		// $validate = "sf5e";
		$post = "txtUserName=".$userName."&txtPassword=".$password."&txtCode=".$validate."&chkRemember=checked&logintype=0";
		$cookie = $_SESSION['cookieBook'];
		$url = "http://lib.suse.edu.cn/tools/submit_ajax.ashx?action=user_login&site=main";
		$result = curlLogin($url, $post, $cookie);
		$result = json_decode($result);
		if($result->status != 1){
			echo js_arr($result->msg);
		}else{
			echo js_arr("ok");
			$_SESSION['findBookMsgLogin'] = "login";
		}
	}

	// 图书馆借阅信息结果
	public function findBookMsgResult()
	{
		if(empty($_SESSION['cookieBook'])){
			return redirect("act/findBookMsg.html");
		}
		$url = "http://lib.suse.edu.cn/user/center/borrow.html";
		$cookie = $_SESSION['cookieBook'];
		$result = getInfo($url, $cookie);
		// 获取姓名
		preg_match_all('/<p class="reader_name">([\w\W]*?)<\/p>/', $result, $match);
		if(!empty($match[1][0])){
			$name = str_replace(array(" ","　","\t","\n","\r","&nbsp;"),array("","","","","",""), $match[1][0]);
		}else{
			$name = null;
		}
		// 获取姓名结束
		$pattern = '/<table class="table table01 table03" width="100%" cellpadding="0" cellspacing="0" border="0">([\w\W]*?)<\/table>/';
		preg_match_all($pattern, $result, $match);
		if(!empty($match[1][0])){
			$result = $match[1][0];
			$result = str_replace(array("</tr>","</td>"),array("{tr}","{td}"),$result);
			$result = preg_replace(array('/<tr([\w\W]*?)>/', '/<td([\w\W]*?)>/'), array('', ''), $result);
			preg_match_all("/RenewBook\('([0-9]*)', '([0-9]*)'\)/", $result, $match);
			// 读者ID
			if(!empty($match[2][0])){
				$readId = $match[2][0];
				// 书籍的ID 用于续借
				$bookId = $match[1];
				$result = preg_replace(array('/<div([\w\W].*?)>/', '/<\/div>/', '/<a([\w\W]*?)>/', '/<\/a>{td}/'), array('', '', '{td}', ''), $result);
				$result = str_replace(array(" ","　","\t","\n","\r","&nbsp;"),array("","","","","",""),$result);
				$result = explode("{tr}", $result);
				$num = count($result);
				$arr = array();
				foreach ($result as $key => $value) {
					if($key == 0 || $key == $num-1){
						continue;
					}
					$arr[$key-1] = explode("{td}", $value);
				}
			}else{
				$readId = null;
				$bookId = null;
				$arr = null;
			}
			
		}else{
			$readId = null;
			$bookId = null;
			$arr = null;
		}
		return view('act/findBookMsgResult', ['name'=>$_SESSION['ca_username'],'info'=>$arr,'readId'=>$readId,'bookId'=>$bookId, 'username'=>$name]);
	}

	// 图书续借处理函数
	public function continueGetBook()
	{
		$bookId = $_POST['bookId'];
		$readId = $_POST['readId'];
		if(!$bookId || !$readId){
			echo js_arr("failed");
			exit;
		}
		$url = "http://lib.suse.edu.cn/tools/submit_ajax.ashx?action=prenew_book";
		$cookie = $_SESSION['cookieBook'];
		$post = "bookbarcode=".$bookId."&readerbarcode=".$readId;
		$result = curlLogin($url, $post, $cookie);
		$result = json_decode($result);
		if($result->status != 1){
			echo js_arr($result->msg);
		}else{
			echo js_arr("ok");
		}
	}

	// 图书借阅退出函数
	public function findBookMsgExit()
	{
		if(!empty($_SESSION['findBookMsgLogin'])){
			$_SESSION['findBookMsgLogin'] = null;
			echo js_arr("ok");
		}else{
			echo js_arr("failed");
		}
	}
	// 图书馆借阅信息模拟登录验证码获取
	public function getBookVerify()
	{
		if(!empty($_SESSION['cookieBook'])){
			if(file_exists($_SESSION['cookieBook'])){
				unlink($_SESSION['cookieBook']);
			}
			$_SESSION['cookieBook'] = null;
		}
		// $cookie = public_path()."/cookie/".md5(date("Y-m-d H:i:s",time())).".cookie";
		$url = "http://lib.suse.edu.cn/tools/verify_code.ashx?time=0.96".abs(rand(600000,  2550000)<<3);
		
		$cookie = getCookie($url);
		if($cookie == "failed"){
			echo js_arr("getCookieFailed");
			exit;
		}else{
			$_SESSION['cookieBook'] = $cookie;
		}
		if(getVerify($url, $cookie, "images/verifyBook.jpg")){
			echo js_arr("getVerifyBookFailed");
		}else{
			echo js_arr("ok");
		}
	}

	// 成绩查询页面(期末考试)
	public function grade()
	{
		if(!empty($_SESSION['userGrade'])){
			return redirect("act/jwxtGrade.html");
		}
		return view('act/grade', ['name'=>$_SESSION['ca_username']]);
	}

	// 教务系统验证码获取
	public function getVerifyGradeQM()
	{
		if(!empty($_SESSION['cookieGrade'])){
			if(file_exists($_SESSION['cookieGrade'])){
				unlink($_SESSION['cookieGrade']);
			}
		}
		$cookie = public_path()."/cookie/".md5(date("Y-m-d H:i:s",time())).".cookie";
		
		$url = "http://61.139.105.138/CheckCode.aspx";
		$img = "images/verifyGradeQM.jpg";
		$referer = "http://61.139.105.138/default2.aspx";
		$cookie = getCookie($url);
		if($cookie == "failed"){
			echo js_arr("getCookieFailed");
			exit;
		}else{
			$_SESSION['cookieGrade'] = $cookie;
		}
		$_SESSION['cookieGrade'] = $cookie;
		if(getVerify($url, $cookie, $img, $referer)){
			echo js_arr("failed");
			exit;
		}else{
			echo js_arr("ok");
		}
	}

	// 教务系统模拟登录函数
	public function jwxtLogin()
	{
		$username = $_POST['username'];
		$_SESSION['jwxtUsername'] = $username;
		$password = $_POST['password'];
		$validate = $_POST['validate'];
		$year = $_POST['year'];
		$_SESSION['jwxtYear'] = $year;
		$item = $_POST['item'];
		$_SESSION['jwxtItem'] = $item;
		$referer = "http://61.139.105.138/default2.aspx";
		// 首先是模拟登录
		$url = "http://61.139.105.138/default2.aspx";
		if($validate == 1){
			$urlValidate = "http://validate.tan90.club:8080/test.jsp";
			$result = getInfo($urlValidate);
			$result = str_replace(array(" ","　","\t","\n","\r","&nbsp;"),array("","","","","",""),$result);
			$result = json_decode($result);
			$_SESSION['cookieGrade'] = $result->cookie;
			$validate = $result->validate;
		}
		$cookie = $_SESSION['cookieGrade'];
		// 获取隐藏字段 
		$hidden = $this->getHiddenView($url, $cookie);
		// 设置post数组并且转化为httpdata格式
		$post['__VIEWSTATE'] = $hidden;
		$post['txtUserName'] = $username;
		$post['TextBox2'] = $password;
		$post['txtSecretCode'] = $validate;
		$post['lbLanguage'] = '';
		$post['hidPdrs'] = '';
		$post['hidsc'] = '';
		$post['RadioButtonList1'] = iconv('utf-8', 'gb2312', '学生');
		$post['Button1'] = iconv('utf-8', 'gb2312', '登录');
		$post = http_build_query($post);

		$result = curlLogin($url, $post, $cookie);
		$pattern = "/Object moved to/";
		if(!preg_match($pattern, $result)){
			echo js_arr("logError");
			exit;
		}else{
			$_SESSION['userGrade'] = "login";
			echo js_arr("ok");
		}
	}

	// 获取隐藏字段函数
	public function getHiddenView($url, $cookie){
		$result = getInfoRefer($url, $url, $cookie);
		$pattern = '/<input type="hidden" name="__VIEWSTATE" value="(.*?)" \/>/is';
		preg_match($pattern, $result, $matches);
		if (empty($matches[1])) {
			return null;
		}else{
			return $matches[1];
		}
	}

	// 成绩获取
	public function jwxtGrade()
	{
		if(empty($_SESSION['userGrade'])){
			return redirect("act/grade.html");
		}
		$username = $_SESSION['jwxtUsername'];
		$year = $_SESSION['jwxtYear'];
		$item = $_SESSION['jwxtItem'];
		$cookie = $_SESSION['cookieGrade'];
		$url = 'http://61.139.105.138/xscjcx_dq.aspx?xh='.$username;
		$postcj['__EVENTTARGET'] = '';
		$postcj['__EVENTARGUMENT'] = '';
		$postcj['__VIEWSTATE'] = $this->getHiddenView($url, $cookie);
		$postcj['ddlxn']=  $year;
		$postcj['ddlxq']=  $item;
		$postcj['btnCx']=  ' 查  询 ';
		$postcj = http_build_query($postcj);
		$url = "http://61.139.105.138/xscjcx_dq.aspx?xh=".$username;
		// 获取隐藏字段
		$result = curlLogin($url, $postcj, $cookie, $url);
		// $result = str_ireplace(chr(60), "&lt;", $result);
		// $result = str_ireplace(chr(62), "&gt;", $result);
		$result = mb_convert_encoding($result, "utf-8", "gb2312");
		preg_match_all("/<td>姓名：([\w\W]*?)<\/td>/", $result, $match);
		if(!empty($match[1][0])){
			$name = $match[1][0];
		}else{
			$name = null;
		}
		$pattern = '/<table([\w\W]*?)id="Data[g|G]rid1"([\w\W]*?)>([\w\W]*?)<\/table>/';
		preg_match_all($pattern, $result, $match);
		// 以tr为间隔
		if(!empty($match[3][0])){
			$result = str_replace(array("</tr>","</td>"),array("{tr}","{td}"),$match[3][0]);
			$result = preg_replace(array('/<tr([\w\W]*?)>/', '/<td([\w\W]*?)>/'), array('', ''), $result);
			$result = str_replace(array(" ","　","\t","\n","\r","&nbsp;"),array("","","","","",""),$result);
			$result = explode("{tr}", $result);
			$num = count($result)-1;
			$arr = array();
			foreach ($result as $key => $value) {
				if($key == 0 || $key == $num){
					continue;
				}
				$arr[$key-1] = explode("{td}", $value);
			}
		}else{
			$arr = null;
		}
		return view('act/jwxtGrade', ['name'=>$_SESSION['ca_username'], 'username'=>$name, 'info'=>$arr]);
	}

	// 获取绩点
	public function jwxtJD()
	{
		if(empty($_SESSION['userGrade'])){
			return redirect('act/grade.html');
		}
		$username = $_SESSION['jwxtUsername'];
		$cookie = $_SESSION['cookieGrade'];
		$year = $_SESSION['jwxtYear'];
		$item = $_SESSION['jwxtItem'];
		$url = "http://61.139.105.138/xscjcx.aspx?xh=".$username;
		$post['__VIEWSTATE'] = $this->getHiddenView($url, $cookie);
		$post['__EVENTTARGET'] = '';
		$post['__EVENTARGUMENT'] = '';
		$post['hidLanguage'] = '';
		$post['ddlXN']=  $year;
		$post['ddlXQ']=  $item;
		$post['ddl_kcxz'] = '';
		$post['Button1']=  '成绩统计';
		$post = http_build_query($post);
		$result = curlLogin($url, $post, $cookie, $url);
		// $result = str_ireplace(chr(60), "&lt;", $result);
		// $result = str_ireplace(chr(62), "&gt;", $result);
		$result = mb_convert_encoding($result, "utf-8", "gb2312");
		// debug($result, true);
		preg_match_all('/<span id="lbl_xm">姓名：([\w\W]*?)<\/span>/', $result, $match);
		if(!empty($match[1][0])){
			$name = $match[1][0];
		}else{
			$name = null;
		}
		// 获取平均学分绩点
		$pattern = '/<span id="pjxfjd"><b>([\w\W]*?)<\/b><\/span>/';
		preg_match_all($pattern, $result, $match);
		if(!empty($match[1][0])){
			$xfjd = $match[1][0];
		}else{
			$xfjd = null;
		}
		// 获取学分绩点总和
		$pattern = '/<span id="xfjdzh"><b>([\w\W]*?)<\/b><\/span>/';
		preg_match_all($pattern, $result, $match);
		if(!empty($match[1][0])){
			$xfjdzh = $match[1][0];
		}else{
			$xfjdzh = null;
		}
		if(empty($xfjd) || empty($xfjdzh)){
			$flag = "failed";
		}else{
			$flag = "ok";
		}
		$arr = array(
			"text" => $flag,
			"xfjd" => $xfjd,
			"xfjdzh" => $xfjdzh
			);
		echo json_encode($arr);
	}
	// 成绩查询退出处理函数
	public function gradeExit()
	{
		if(!empty($_SESSION['userGrade'])){
			if(!empty($_SESSION['cookieGrade'])){
				if(file_exists($_SESSION['cookieGrade'])){
					unlink($_SESSION['cookieGrade']);
				}
			}
			$_SESSION['userGrade'] = null;
			echo js_arr("ok");
		}else{
			echo js_arr("failed");
		}
	}

	// 辅导员查询(未启用)
	public function getFudaoyuan()
	{
		return view("act/getFudaoyuan", ['name'=>$_SESSION['ca_username']]);
	}

	public function getFudaoyuanResult()
	{
		$ip = virtualIp();
		$zkzh = $_POST['zkzh'];
		// $zkzh = "17511108160181";
		$post['ksh'] = $zkzh;
		$post['submit'] = "ok";
		$post = http_build_query($post);
		$url = "http://119.29.201.115/info_disp.php";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('CLIENT-IP:'.$ip, 'X-FORWARDED-FOR:'.$ip)); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		curl_setopt($ch, CURLOPT_REFERER, "http://119.29.201.115/");
		$result = curl_exec($ch);
		// $result = str_ireplace(chr(60), "&lt;", $result);
		// $result = str_ireplace(chr(62), "&gt;", $result);
		$pattern = '/<table class="am-table  am-table-hover ">([\w\W]*?)<\/table>/';
		preg_match_all($pattern, $result, $match);
		if(empty($match[1][0])){
			echo js_arr("没有此用户的辅导员信息噢，请检查你的准考证号正确不噢。",6);
			exit;
		}
		$result = $match[1][0];
		preg_match_all('/<tbody>([\w\W]*?)<\/tbody>/', $result, $match);
		$result = $match[1][0];
		$result = str_replace(array("</tr>","</td>"),array("{tr}",""),$result);
		$result = str_replace(array("<tr>","<td>"),array("",""),$result);
		$result = preg_replace('/<th>([\w\W]*?)<\/th>/', "", $result);
		$result = str_replace(array(" ","　","\t","\n","\r","&nbsp;"),array("","","","","",""),$result);
		$result = explode("{tr}", $result);
		$name = $result[7];
		$phone = $result[8];
		$str = "辅导员名字：".$name."\n辅导员电话：".$phone;
		echo js_arr($str, 6);
	}


	public function saveExamRegistration()
	{
		if(empty($_POST)){
			return view("act/saveExamRegistration", ['name'=>$_SESSION['ca_username']]);
		}
		if(empty($_POST['ID']) || empty($_POST['registration']) || empty($_POST['name'])){
			echo js_arr("failed");
			exit;
		}
		$ID = htmlspecialchars($_POST['ID']);
		$registration = htmlspecialchars($_POST['registration']);
		$name = htmlspecialchars($_POST['name']);
		$data = DB::table("registration")->where("id_card", $ID)->get();
		if(!empty($data[0])){
			echo js_arr("exists");
			exit;
		}

		$arr = array(
			"id_card" => $ID,
			"registration" => $registration,
			"name" => $name
		);
		$data = DB::table("registration")->insert($arr);
		if($data){
			echo js_arr("ok");
		}else{
			echo js_arr("failed");
		}
	}
}
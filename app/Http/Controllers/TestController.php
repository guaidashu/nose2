<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use App\TestModel;
use Mail;
use App\User;

class TestController extends Controller
{
	public function test()
	{
		$model=new TestModel();
		$arr=array(
		"content"=>"ok",
		"date"=>date('Y-m-d H:i:s')
		);
		// $data=$model->dataInsert($arr);
		$data=$model->getData();
		debug($data);
	}

	public function sqlTest()
	{
		$data=DB::select('select phone,email from crn');
		foreach ($data as $key => $value) {
			debug($key);
			debug($value->phone);
		}
	}

	public function emailTest()
	{
		// $data=Mail::raw('恭喜你成为了咱们协会成员的一份子！',function($message){
		// 	$message->subject('恭喜你');
		// 	$message->to('1023767856@qq.com');
		// });
		$name="宋节";
		$email='1023767856@qq.com';
		$img='/images/curousel/bing-1.jpg';
		$data=Mail::send('test',['name'=>$name,'email'=>$email,'img'=>$img],function($message) use ($email){
			$message->subject('测试');
			echo $email;
			$message->to($email);
		});
		debug($data);
	}

	public function fun($url)
	{
		$ch=curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		$result = curl_exec($ch);
		curl_close($ch);
		return  $result;
	}

	public function curlTest()
	{
		$url="http://61.139.105.138/default2.aspx";
		$result = $this->fun($url);
		$pattern = '/<input name="([a-zA-Z0-9\_\.]*)" type="text" id="txtUserName" tabindex="1" class="text_nor" \/>/';
		preg_match_all($pattern, $result, $arr);
		$result = str_ireplace(chr(60), "&lt;", $result);
	    $result = str_ireplace(chr(62), "&gt;", $result);
		debug($arr[1][0]);
		debug($result);
		// echo $result;
	}
}
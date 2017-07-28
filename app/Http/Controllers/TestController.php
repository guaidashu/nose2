<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use App\TestModel;
use Mail;

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
		Mail::raw('我试试这个能不能发送',function($message){
			$message->subject('能发送吗');
			$message->to('1023767856@qq.com');
		});
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
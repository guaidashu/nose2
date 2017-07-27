<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class CrnController extends Controller
{
	public function index()
	{
		return view('crn',["name"=>"宋节"]);
	}

	public function handle(){
		// 首先接收传递post的内容
		$name=$_POST['name'];
		$email=$_POST['email'];
		$year=$_POST['year'];
		$phone=$_POST['phone'];
		$data=DB::table('test')->get();
		debug($data);
		// echo "姓名：".$name."<br/>".
		//      "邮件：".$email."<br/>".
		//      "入学年份：".$year."<br/>".
		//      "电话：".$phone;
		
	}
}
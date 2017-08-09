<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

class ProjectController extends Controller
{
	public function __construct()
	{
		session_start();
		// 判断是否有用户登录 ，否则会直接赋为空
		if(empty($_SESSION['ca_username'])){
			$_SESSION['ca_username']=null;
		}
	}
	public function index()
	{
		return view('project/index',['name'=>$_SESSION['ca_username']]);
	}
}
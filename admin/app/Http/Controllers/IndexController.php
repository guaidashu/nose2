<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
	public function __construct()
	{
		session_start();
		if(empty($_SESSION['ca_admin_username'])){
			$_SESSION['ca_admin_username']=null;
		}
	}
	public function index()
	{
		if(empty($_SESSION['ca_admin_username'])){
			return redirect('login/index.html');
		}
		return view('index/index',['name'=>$_SESSION['ca_admin_username']]);
	}
}
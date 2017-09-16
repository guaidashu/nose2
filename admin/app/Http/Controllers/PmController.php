<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class PmController extends Controller
{
	public function __construct()
	{
		session_start();
		if(empty($_SESSION['ca_admin_username'])){
			$_SESSION['ca_admin_username']=null;
		}
	}

	// 入会申请 英文 为 Membership Application 所以函数简写为memApp
	public function memApp()
	{
		if(empty($_SESSION['ca_admin_username'])){
			return redirect('login/index.html');
		}
		$data=DB::table('crn')->get();
		return view('pm/memApp',['name'=>$_SESSION['ca_admin_username'],'data'=>$data]);
	}

	public function delete()
	{
		if(empty($_SESSION['ca_admin_username'])){
			echo js_arr("failed");
			exit;
		}
		//接受参数并过滤
		$id=htmlspecialchars($_GET['id']);
		// 为了更安全，只能传数字,numCheck纯数字检查函数在公共函数文件/app/function.php里自行查看
		if(!numCheck($id)){
			echo js_arr("failed");
			exit;
		}
		$data=DB::table('crn')->where('id',$id)->delete();
		if($data){
			echo js_arr("ok");
		}else{
			echo js_arr("failed");
		}
	}

	// 确认入会页面
	public function confirmPage()
	{
		return view('pm/confirmPage', ['name'=>$_SESSION['ca_admin_username']]);
	}

	// 个人信息查询处理
	public function confirmGetInfo()
	{
		$name = htmlspecialchars($_POST['name']);
		$data = DB::table('crn')->where('name', $name)->get();
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
		$data = DB::table('crn')->where('id', $id)->update(['qq'=>$qq, 'allow'=>1]);
		if($data){
			echo js_arr("ok");
		}else{
			echo js_arr("failed");
		}
	}
}
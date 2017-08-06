<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class AlgorithmController extends Controller
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
		// 这里是算法报名的名单，所以，我们是需要那个什么喃
		// 嗯，就是算法报名的表的数据
		$data=DB::table('algorithm')->get();
		$id=$data[0]->id;
		return view('algorithm/index',['name'=>$_SESSION['ca_admin_username'],'data'=>$data,'id'=>$id]);
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
		$data=DB::table('algorithm')->where('id',$id)->delete();
		if($data){
			echo js_arr("ok");
		}else{
			echo js_arr("failed");
		}
	}
}
<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\TestModel;

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
}
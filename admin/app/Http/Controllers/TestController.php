<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
	public function test()
	{
		echo "ok";
	}
}
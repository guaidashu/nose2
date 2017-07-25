<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

class IndexController extends Controller
{
	public function index()
	{
		return view('index');
	}
}
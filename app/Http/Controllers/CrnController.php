<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

class CrnController extends Controller
{
	public function index()
	{
		return view('crn',["name"=>"宋节"]);
	}
}
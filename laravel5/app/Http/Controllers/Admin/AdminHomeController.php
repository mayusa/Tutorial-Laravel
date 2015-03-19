<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Page;

class AdminHomeController extends Controller {

	public function index()
	{
		//
		return view('AdminHome')->withPages(Page::all());
	}


}

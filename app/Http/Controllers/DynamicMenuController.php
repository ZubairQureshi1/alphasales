<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DynamicMenuController extends Controller
{
    public function index()
    {
    	return view('dynamicMenu.index');
    }
}

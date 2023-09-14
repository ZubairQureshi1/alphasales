<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TestTable;
use Artisan;
use DB;

class TestsController extends Controller
{
	public function index()
	{
		$config = config()->all();
		$config['database']['connections']['mysql']['database'] = 'cfe_test';
		DB::purge('mysql');
		// dd($config);
		Artisan::call('config:clear');
		config($config);
		// dd(config($config));

		dd(TestTable::get()->first());
	}
}

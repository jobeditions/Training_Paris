<?php

namespace App\Http\Controllers\AdminOffice;

use App\Http\Controllers\Controller;
use App\Modules\AdminModule;
use Auth;
use Illuminate\Http\Request;


class SchoolsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
    @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('admin.schools');
    }
}

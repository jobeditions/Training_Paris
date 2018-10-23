<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
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
      $schools = DB::table('schools')->count();
      $students = DB::table('students')->count();
      $exams = DB::table('exams')->count();
      $nombreMatieres = DB::table('matieres')->count();

      return view('admin.dashboard', compact('schools', 'students','exams','nombreMatieres'));
    }
}

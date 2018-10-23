<?php
/**
 * Copyright (c) Liigem 2017.
 */

namespace App\Http\Controllers\TeacherOffice;

use App\Http\Controllers\Controller;
use App\Http\Requests;

class StaticController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:user');
    }

    public function version()
    {
        $versions = \App\Version::orderBy('version_number' , 'DESC')->get();
        return view('teachers.version', ['versions' => $versions]);
    }

    public function notifications()
    {
        return view('teachers.notifications');
    }
}

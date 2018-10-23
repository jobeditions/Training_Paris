<?php
/**
 * Copyright (c) Liigem 2017.
 */

namespace App\Http\Controllers\TeacherOffice;

use App\Http\Controllers\Controller;
use App\Modules\TeacherModule;
use Auth;
use Illuminate\Http\Request;

class ActualityController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function addActuality(Request $request)
    {
        $teacher = \App\Teacher::where('user_id', Auth::id())->first();
        //Création du module
        $tModule = new TeacherModule($teacher);

        $tModule->addActuality($request);

        return redirect('teacher/')->with('actu_ok', true);
    }
}

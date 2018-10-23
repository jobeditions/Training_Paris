<?php
/**
 * Copyright (c) Liigem 2017.
 */

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Modules\StudentModule;
use Auth;

class SettingsController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Récupération de l'étudiant en question
        $student = \App\Student::where('user_id', Auth::id())->first();
        //Module étudiant
        $sModule = new StudentModule($student);
        //Vue
        return view("students.settings.settings");
    }
}

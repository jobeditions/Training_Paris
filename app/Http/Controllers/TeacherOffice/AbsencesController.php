<?php
/**
 * Copyright (c) Liigem 2017.
 */

namespace App\Http\Controllers\TeacherOffice;

use App\Http\Controllers\Controller;
use App\Modules\TeacherModule;
use Auth;
use Illuminate\Http\Request;

class AbsencesController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Récupération des données du professeur
            $teacher = \App\Teacher::where('user_id', Auth::id())->first();
        //Création du module
            $tModule = new TeacherModule($teacher);
        // Vue : Paramètre, liste des classes du prof
            return view('teachers.absences', ["classes" => $teacher->classes()]);
    }


    public function record($id)
    {
        //Récupération des données du professeur
            $teacher = \App\Teacher::where('user_id', Auth::id())->first();
        //Création du module
            $tModule = new TeacherModule($teacher);
        // Vue : Paramètre, liste des classes du prof
        return view('teachers.absences_record', ["classe" => $tModule->classe($id), "id" => $id]);
    }

    public function history()
    {
        //Récupération des données du professeur
        $teacher = \App\Teacher::where('user_id', Auth::id())->first();
        //Création du module
        $tModule = new TeacherModule($teacher);
        // Vue : Paramètre, liste des classes du prof
        return view('teachers.absences_history', ["history" => $tModule->callHistory()]);
    }

    public function addAppel($id, Request $request)
    {
        $teacher = \App\Teacher::where('user_id', Auth::id())->first();
        //Création du module
        $tModule = new TeacherModule($teacher);

        $tModule->recordAbsences($request, $id);

        return redirect('teacher/absences')->with('call_ok', true);
    }
}

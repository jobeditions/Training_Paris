<?php
/**
 * Copyright (c) Liigem 2017.
 */

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Modules\StudentModule;
use Auth;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Récupération de l'étudiant en question
        $student = \App\Student::where('user_id', Auth::id())->first();
        //Module étudiant
        $sModule = new StudentModule($student);
        //Vue
        return view("students.notes",
            [
                "notes" => $sModule->notes(),
                "matieres" => $sModule->matieres(),
                "moyennes" => $sModule->avgMatieres(),
                "periods" => $sModule->periods()
            ]
        );
    }
}

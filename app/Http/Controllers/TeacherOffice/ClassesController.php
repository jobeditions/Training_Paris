<?php
/**
 * Copyright (c) Liigem 2016.
 */

namespace App\Http\Controllers\TeacherOffice;

use App\Modules\TeacherModule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;

class ClassesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:user');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Récupération des données du professeur
            $teacher = \App\Teacher::where('user_id', Auth::id())->first();
        //Création du module
            $tModule = new TeacherModule($teacher);
        //Vue
            return view('teachers.classes_create', ['teacher' => $teacher, "subjects" => $tModule->subjects(), "students" => $tModule->students()]);
    }


    public function store(Request $request)
    {

        $teacher = \App\Teacher::where('user_id', Auth::id())->first();

        $tModule = new TeacherModule();
        $tModule->addClass($request, $teacher);

        return $this->index($request);
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
        //Vue
            return view('teachers.classes', ['teacher' => $teacher, "classes" => $teacher->classes()]);
    }

    public function update(Request $request, $id)
    {
        //
        $teacher = \App\Teacher::where('user_id', Auth::id())->first();

        $tModule = new TeacherModule();
        $tModule->updateClass($request, $teacher, $id);
        return view("teachers.classes_details", ["id" => $id, 'teacher' => $teacher, "classe" => \App\Classe::find($id)]);
    }

    public function destroy(Request $request, $id)
    {
        $teacher = \App\Teacher::where('user_id', Auth::id())->first();

        $tModule = new TeacherModule();
        $tModule->removeClass($request, $teacher, $id);

        return view('teachers.classes', ['teacher' => $teacher]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
        public function show($id)
        {
            //Récupération des données du professeur
                $teacher = \App\Teacher::where('user_id', Auth::id())->first();
            //Création du module
                $tModule = new TeacherModule($teacher);
            //Vue
                return view("teachers.classes_details", ["id" => $id, 'teacher' => $teacher, "classe" => \App\Classe::find($id)]);
        }
}

<?php

namespace App\Http\Controllers\TeacherOffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Modules\TeacherModule;
use DB;

class SchoolsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Récupération des données du professeur
            $teacher = \App\Teacher::where('user_id', Auth::id())->first();
        //Création du module
            $tModule = new TeacherModule($teacher);
        //Vue
            return view('teachers.schools', ["schools" => $tModule->list_schools(), "t_school" => $tModule->teacher_schools(), "info" => $tModule->createSchoolInfos()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Récupération des données du professeur
            $teacher = \App\Teacher::where('user_id', Auth::id())->first();
        //Création du module
            $tModule = new TeacherModule($teacher);
        //Vue
            $data = $tModule->createSchool($request) ;
            return $data["response"] == "success" ? view('teachers.schools_details', $data) : view('teachers.schools', $data);
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
            return view('teachers.schools_details', ["school" => $tModule->school($id, true)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Modules\StudentModule;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Récupération de l'étudiant en question
            $student = \App\Student::where('user_id', Auth::id())->first();
        //Module étudiant
            $sModule = new StudentModule($student);
        //Vue
            return view("students.exams.exams", ["exams" => $sModule->exams()]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Récupération de l'étudiant en question
            $student = \App\Student::where('user_id', Auth::id())->first();
        //Module étudiant
            $sModule = new StudentModule($student);
        //Vue
            return view("students.assignments.details", ["assignment" => $sModule->exam($id), "exam" => true]);
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

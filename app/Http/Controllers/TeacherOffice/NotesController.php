<?php
/**
 * Copyright (c) Liigem 2016.
 */

namespace App\Http\Controllers\TeacherOffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Modules\TeacherModule;

class NotesController extends Controller
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
    public function index()
    {
        //Récupération des données du professeur
            $teacher = \App\Teacher::where('user_id', Auth::id())->first();
        //Création du module
            $tModule = new TeacherModule($teacher);
        // Vue : Paramètre, liste des classes du prof
            return view('teachers.notes', ["classes" => $teacher->classes()]);
    }

    /**
     * Show the application dashboard.
     * @return \Illuminate\Http\Response
     */
    public function details(Request $request)
    {
        //Récupération des données du professeur
            $teacher = \App\Teacher::where('user_id', Auth::id())->first();
        //Création du module
            $tModule = new TeacherModule($teacher);
        //Vue : Paramètres, détails de la classe, liste des élèves, liste des notes
            return view('teachers.notes_details',
              [
                "classe" => $tModule->classe( $request->input('classe_selector') ),
                "notes" => $tModule->notes_classe( $request->input('classe_selector') ),
                "periods" => $tModule->getPeriodsClasse( $request->input('classe_selector') ),
                "students_avg" => $tModule->avgStudents_classe( $request->input('classe_selector') )
              ]
            );
    }

    /**
     * Show the application dashboard.
     * @return \Illuminate\Http\Response
     */
    public function create($id, Request $request)
    {
        //Récupération des données du professeur
            $teacher = \App\Teacher::where('user_id', Auth::id())->first();
        //Création du module
            $tModule = new TeacherModule($teacher);
        //Vue : Paramètres, détails de la classe, liste des élèves, liste des notes
            return view('teachers.notes_create', [
              "classe" => $tModule->classe($id),
              "periods" => $tModule->getPeriodsClasse($id),
            ]);
    }

    /**
     * Save new note to database
     * @return \Illuminate\Http\Response
     */
    public function create_save(Request $request)
    {
        $teacher = \App\Teacher::where('user_id', Auth::id())->first();
        //Création du module
        $tModule = new TeacherModule($teacher);

        $tModule->addNote($request);

        return redirect('teacher/notes')->with('call_ok', true);
    }


    /**
     * Show the edition module for notes
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Récupération des données du professeur
        $teacher = \App\Teacher::where('user_id', Auth::id())->first();
        //Création du module
        $tModule = new TeacherModule($teacher);
        //Vue : Paramètres, détails de la classe, liste des élèves, liste des notes
        return view('teachers.notes_edit', ["note" => $tModule->getNoteInfos($id)]);
    }

    /**
     * Save modifications to note
     * @return \Illuminate\Http\Response
     */
    public function edit_save(Request $request, $id)
    {

    }

    /**
     * Delete a note
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $teacher = \App\Teacher::where('user_id', Auth::id())->first();

        $tModule = new TeacherModule($teacher);

        $tModule->deleteNote($id);

        return redirect('teacher/notes')->with('delete_ok', true);
    }


    /**
     * Show graphics and stats for a note
     * @return \Illuminate\Http\Response
     */
    public function graphics(Request $request)
    {
        //Récupération des données du professeur
            $teacher = \App\Teacher::where('user_id', Auth::id())->first();
        //Création du module
            $tModule = new TeacherModule($teacher);
        //Vue : Paramètres, détails de la classe, liste des élèves, liste des notes
            return view('teachers.notes_graphes');
    }
}

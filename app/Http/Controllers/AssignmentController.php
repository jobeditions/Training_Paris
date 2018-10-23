<?php

namespace App\Http\Controllers;

use App\Modules\StudentModule;
use Auth;
use Illuminate\Eloquent\Database\Builder;
use Illuminate\Eloquent\Database\Model;
use Illuminate\Http\Request;

class AssignmentController extends Controller
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

		//Vue
		return view("students.assignments.assignments", ["assignments" => $student->assignments()]);
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
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//Récupération de l'étudiant en question
		$student = \App\Student::where('user_id', Auth::id())->first();
		//Module étudiant
		$sModule = new StudentModule($student);
		//Vue
		return view("students.assignments.details", ["student" => $student, "assignment" => \App\Assignment::find($id)]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		//Récupération de l'étudiant en question
		$student = \App\Student::where('user_id', Auth::id())->first();
		//Module étudiant
		$sModule = new StudentModule($student);
		//Action
		switch ($request->input("action"))
		{
			//Envoi de fichier
			case "upload":
				return view("students.assignments.details", ["action" => $sModule->addFile($id, $request), "student" => $student, "assignment" => \App\Assignment::find($id)]);
			//Suppression de fichier
			case "delete":
				return view("students.assignments.details", ["action" => $sModule->removeFile($id, $request), "student" => $student, "assignment" => \App\Assignment::find($id)]);
			//Mise à jour de l'état
			case "marker_update":
				return view("students.assignments.details", ["action" => $sModule->updateMarker($id, $request), "student" => $student, "assignment" => \App\Assignment::find($id)]);
		}
		//Par défaut
		return view("students.assignments.details", ["student" => $student, "assignment" => \App\Assignment::find($id)]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
		return view("students.assignments.details.view", ["id" => $id]);
	}
}

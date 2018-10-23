<?php
/**
 * Copyright (c) Liigem 2017.
 */

namespace App\Http\Controllers\TeacherOffice;

use App\Http\Controllers\Controller;
use App\Modules\TeacherModule;
use Auth;
use DB;
use Illuminate\Http\Request;

class AssignmentsController extends Controller
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

	public function store(Request $request)
	{
		//Récupération des données du professeur
		$teacher = \App\Teacher::where('user_id', Auth::id())->first();
		//Création du module
		$tModule = new TeacherModule($teacher);

		if ($request->has("type"))
		{
			if ($request->input("type") == "assignment")
			{
				$this->validate($request, [
					'name' => 'required|max:255',
					'content' => 'required',
					'due_date' => 'required|date',
					'classe_id' => 'required|exists:classe_teacher',
					'max_files' => 'integer|min:-1|max:20',
					'allow_delaying' => 'integer|min:-1|max:100'
				]);


				$tModule->addAssignment($request);
			} else if ($request->input("type") == "exam")
			{
				$this->validate($request, [
					'name' => 'required|max:255',
					'content' => 'required',
					'due_date' => 'required|date',
					'classe_id' => 'required|exists:classe_teacher'
				]);

				$tModule->addExam($request);
			}
		}


		return $this->index($request);
	}

	/**
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		//Récupération des données du professeur
		$teacher = \App\Teacher::where('user_id', Auth::id())->first();
		//Création du module
		$tModule = new TeacherModule($teacher);
		//Vue
		return view('teachers.assignments', ['teacher' => $teacher, "assignments" => $tModule->assignments(), "exams" => $tModule->exams()]);
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
		return view('teachers.assignments_create', ['teacher' => $teacher, "classes" => $teacher->classes()]);
	}

	public function update(Request $request)
	{
		//TODO implement update function body
	}

	public function destroy(Request $request)
	{
		//TODO implement delete function body
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//Récupération des données du professeur
		$teacher = \App\Teacher::where('user_id', Auth::id())->first();
		//Création du module
		$tModule = new TeacherModule($teacher);
		//Vue
		return view("teachers.assignments_details", ["id" => $id, 'assignment' => $tModule->assignment($id)]);
	}

	public function download($id)
	{
		//Récupération des données du professeur
		$teacher = \App\Teacher::where('user_id', Auth::id())->first();
		//Création du module
		$tModule = new TeacherModule($teacher);
		//Vue
		$archive = $tModule->downloadFiles($id);

		return ($archive) ? response()->download($archive) : redirect("teacher/assignments/" . $id);

	}

	public function view($id, $studentId)
	{

		if (DB::table("assignments_documents")->where(['assignment_id' => $id, "student_id" => $studentId])->count() < 1 || DB::table("assignments")->where(['id' => $id, "teacher_id" => \App\Teacher::where('user_id', Auth::id())->first()->id])->count() < 1)
		{
			return redirect("404");
		}

		$document = DB::table("assignments_documents")->where(['assignment_id' => $id, "student_id" => $studentId])->get();
		$paths = array();
		foreach ($document as $file)
		{
			array_push($paths, url('storage/students/' . $file->path));
		}
		return view("teachers.assignment_view", ['paths' => $paths, 'meyenii' => json_decode(\App\AssignmentDocument::where(['assignment_id' => $id, "student_id" => $studentId])->first()->meyenii)]);
	}

	public function gradeDocument(Request $request, $id)
	{
		$errors = [];

		$validator = Validator::make($request->all(), [
			'comment' => 'required',
		]);

		if ($validator->fails())
		{
			array_push($errors, $validator->errors()->all());
		} else
		{
			return redirect()->back()->with('errors', $errors);
		}
	}
}

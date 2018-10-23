<?php

namespace App\Http\Controllers;

use App\Modules\StudentModule;
use Auth;
use Illuminate\Http\Request;

class DocumentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
		$document = $sModule->document($id);
		if ($document == null)
			return redirect('404');
		else if ($document == false)
			return redirect('403');
		return view("students.documents.document", ["document" => $document]);
    }

	public function download($id)
	{
        //Récupération de l'étudiant en question
            $student = \App\Student::where('user_id', Auth::id())->first();
        //Module étudiant
            $sModule = new StudentModule($student);
        //Vue
		$document = $sModule->document($id);
		if ($document == null)
			return redirect('404');
		else if ($document == false)
			return redirect('403');
		return response()->download(storage_path() . "/app/uploads/teachers/" . $document->path, $document->name);
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

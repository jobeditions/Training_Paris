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

class DocumentsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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
        return view('teachers.documents', ["teacher" => $teacher, "documents" => $teacher->documents(), "classes" => $teacher->classes()]);
    }

    public function store(Request $request)
    {
        $teacher = \App\Teacher::where('user_id', Auth::id())->first();
        //Création du module
        $tModule = new TeacherModule($teacher);

        //Vérification qu'un fichier ai bien été envoyé
        if ($request->hasFile("fileUpload"))
        {
            //Vérification que le fichier est valide
            if ($request->file("fileUpload")->isValid())
            {
                //Enregistrement du type et du chemin
                $type = $request->file("fileUpload")->getMimeType();
                $path = time() . "_" . rand(1000, 9999) . "_" . $request->file("fileUpload")->getClientOriginalName();

                //Envoi du fichier dans le storage
				$request->file("fileUpload")->move(storage_path() . "/app/uploads/teachers", iconv("UTF-8", "ISO-8859-1//TRANSLIT", $path));
                $result = "success";
                //Renregistrement
                $data = [
                    "teacher_id" => $teacher->id,
                    "class_id" => $request->input("forClass"),
                    "type" => $type,
                    "path" => $path
                ];
                if ($request->has("forAssignment") && (intval($request->input("forAssignment")) > 0))
                {
                    $data["assignment_id"] = $request->input("forAssignment");
                }
                DB::table("documents")->insert($data);

            } else
            {
                return "err_upload";
            }
        } else
        {
            return "no_file";
        }

        return view('teachers.documents', ["result" => $result, "teacher" => $teacher, "documents" => $teacher->documents(), "classes" => $teacher->classes()]);
    }

	function destroy(Request $request, $id)
	{
		$teacher = \App\Teacher::where('user_id', Auth::id())->first();

		$tModule = new TeacherModule($teacher);
		$tModule->deleteDocument($id);

		return redirect('teacher/documents');
	}

}

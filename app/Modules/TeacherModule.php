<?php
/**
 * Copyright (c) Liigem 2017.
 */

/**
 * Created by PhpStorm.
 * User: Nathanael
 * Date: 10/09/2016
 * Time: 11:22
 */

namespace App\Modules;

use App\Absences;
use App\Actuality;
use App\Assignment;
use App\Classe;
use App\Document;
use App\Exam;
use App\MissingStudent;
use App\Notes;
use App\NotesStudent;
use App\Review;
use App\School;
use App\TeacherPage;
use App\User;
use DateTime;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Mail;
use Validator;
use ZipArchive;

class TeacherModule implements TeacherModuleInterface
{

    function __construct($teacher = null)
    {
        $this->teacher = $teacher;
    }

    /**
     *  Adds an assignment
     * @param Request $request
     * @return \Illuminate\Validation\Validator
     */
    function addAssignment(Request $request)
    {

        // Create an assignment
        $assignment = new Assignment();

        // Add form data
        $assignment->name = $request->input('name');
        $assignment->content = $request->input('content');
        $assignment->due_date = $request->input('due_date');
        $assignment->optional = $request->input('optional') ? true : false;
		if ($request->has('max_files'))
		{
			$assignment->max_files = $request->input('max_files');
		}
        if ($request->has('allow_delaying'))
        {
            $assignment->allow_delaying = $request->input('allow_delaying');
        }
        $assignment->teacher_id = $this->teacher->id;
        $assignment->classe_id = $request->input('classe_id');

        // Save assignment
        $assignment->save();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Validation\Validator
     */
    function updateAssignment(Request $request)
    {
        // Form Validation
        $validator = Validator::make($request->all(), [
            'id' => 'required|exist:assignments,id,id,teacher_id,' . $request->user()->id,
            'name' => 'required|max:255',
            'content' => 'required',
            'due_date' => 'required|date',
            'optional' => 'required|boolean',
            'class_id' => 'required|exist:teachers_classes,class_id,class_id,teacher_id,' . $request->user()->id,
        ]);
        if ($validator->fails())
        {
            return $validator;
        }

        // Retrieving data
        $assignment = Assignment::find($request['id']);

        // Add update form data
        $assignment->name = $request['name'];
        $assignment->content = $request['content'];
        $assignment->due_date = $request['due_date'];
        $assignment->optional = $request['optional'];
        $assignment->teacher_id = $request->user()->id;
        $assignment->class_id = 6;

        // Save updated assignment
        $assignment->save();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Validation\Validator
     */
    function deleteAssignment(Request $request)
    {
        // Checking rights
        $validator = Validator::make($request->all(), [
            'id' => 'required|exist:assignments,id,id,teacher_id,' . $request->user()->id,
        ]);
        if ($validator->fails())
        {
            return $validator;
        }

        // Retrieving assignment
        $assignment = Assignment::find($request['id']);

        // Deleting it
        $assignment->delete();
    }

    /**
     * Changes the design of a teacherPage
     * @param Request $request
     * @return \Illuminate\Validation\Validator
     */
    function updateDesign(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails())
        {
            return $validator;
        }

        $teacherPage = TeacherPage::whereTeacherId($request->user()->id);
        $teacherPage->design = $request['design'];
        $teacherPage->save();
    }

    function courseSharing(Request $request)
    {
        // TODO: Implement courseSharing() method.
    }

    function setVisibility(Request $request)
    {
        // TODO: Implement setVisibility() method.
    }

    /**
     * @param Request $request
     * @return false|string
     */
    function addDocument(Request $request)
    {
        //Storing document
        $path = $request->file('document')->store('documents');

        // Adding its reference to the database
        $document = new Document();
        $document->path = $path;
        $document->teacher_id = $request->user()->id;
        $document->save();

        return $path;
    }

    /**
     * @param Request $request
     * @return bool|\Illuminate\Validation\Validator
     */
    function removeDocument(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'path' => 'required|max:255'
        ]);
        if ($validator->fails())
        {
            return $validator;
        }

        $document = Document::where('path', $request['path']);
        // Checking if the user has the right to modify the document
        if ($document->teacher_id == $request->user()->id)
        {
            Storage::delete($document->path);
            $document->delete();
        } else
            return false;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Validation\Validator
     */
    function addClass(Request $request, $teacher)
    {
        //Validation des données
        $validator = Validator::make($request->all(), [
            'class-name' => 'required|max:50'
        ]);
        if ($validator->fails())
        {
            return $validator;
        }

        //Création de la classe
        $class = new Classe();
        $class->name = $request['class-name'];
        $class->save();
        $class_id = $class->id;

        //Lien entre la classe et le professeur
        DB::table("classe_teacher")->insert([
            'teacher_id' => $teacher->id,
            'classe_id' => $class_id,
            'subject' => $request->input('class-subject')
        ]);

        //Création des comptes par addresses mails
        $this->addMails($request, $teacher, $class_id);
        //$class->teachers()->save(Teacher::where('user_id', $request->user()->id)->first());

    }

    private function addMails($request, $teacher, $class_id)
    {
        //Vérification qu'il existe des données à créer
        if (!$request->has("selected_students"))
        {
            return;
        }
        //Création des comptes
        foreach ($request->input("selected_students") as $key => $value)
        {
            //S'il s'agit d'un email, étudiant à créer
            if ((!User::where("email", $value)->exists())&&(filter_var($value, FILTER_VALIDATE_EMAIL)))
            {
                //Personne non inscrite
                $user = new User();
                $user->name = "";
                $user->email = $value;
                $user->password = "NO PASSWORD YET";
                $user->rank = "tmp";
                $user->save();
                //Référencement par école
                DB::table("students")->insert(["user_id" => $user->id]);
                //DB::table("student_school")->insert(["student_id" => $user->id, "schoo]);
            }

            $value = \App\Student::where("user_id", User::where("email", $value)->first()->id)->first();

            if (!DB::table('classe_student')->where([["student_id", $value->id,], ["classe_id", $class_id]])->exists()) {
                //Ajout des élève (déjà inscrit)
                DB::table('classe_student')->insert([
                    "student_id" => $value->id,
                    "classe_id" => $class_id
                ]);
            }

        }
    }

    /**
     * @param Request $request
     */
    function updateClass(Request $request, $teacher, $class_id)
    {
        //Validation des données
        $validator = Validator::make($request->all(), [
            //TODO
        ]);
        if ($validator->fails())
        {
            return $validator;
        }

        //Suppression des élèves à supprimer.
        if ($request->has("unselected_students")) {
            foreach ($request->input("unselected_students") as $key => $value)
            {
                //Déréférencement des élèves (déjà inscrit)
                DB::table('classe_student')->where([
                    "student_id" => $value,
                    "classe_id" => $class_id
                ])->delete();
            }
        }

        //Ajout des nouveaux élèves ajoutés par mail
        $this->addMails($request, $teacher, $class_id);
    }

    /**
     * @param Request $request
     */
    function removeClass(Request $request, $teacher, $class_id)
    {
        //Vérification que la classe appartienne bien au professeur
        if (DB::table('classe_teacher')->where([['classe_id', $class_id], ['teacher_id', $teacher->id]])->count())
        {
            DB::table('classes')->where('id', $class_id)->delete();
        }


        //DB::table('classe_student')->where('class_id', $request->classe)->delete();
        //DB::table('classe_teacher')->where('class_id', $request->classe)->delete();
    }

    /**
     * @param Request $request
     * @return array
     */
    function newInvite(Request $request)
    {
        $teacher = \App\Teacher::where('user_id', $request->user()->id)->first();
        // Checking user has more invites to send
        if ($teacher->remaining_invites < 1)
            return ['Il ne vous reste aucune invitation à envoyer !'];

        // Checking that the user doesn't exist...
        if (count(\App\User::where('email', $request['email'])->get()) > 0)
            return ['Mais, mais, mais ! Cet utilisateur existe déjà :)'];

        // Checking that the user hasn't already invited this person.
        if (count(\App\Invite::where(['email' => $request['email'], 'from_id' => $request->user()->id])->get()) > 0)
            return ['Vous avez déjà invité cet utilisateur'];

        // From now on, everything should be fine, we can create the invite and send an email
        $invite = new \App\Invite();
        $invite->email = $request['email'];
        $invite->from_id = $request->user()->id;
		$randomCode = str_random(25);
		$invite->code = $randomCode;
        $invite->save();

        // Decreasing remaining invites
        $teacher->remaining_invites = $teacher->remaining_invites - 1;
        $teacher->save();

		Mail::to($request['email'])->send(new \App\Mail\Invitation($invite, $randomCode));
		return [];
    }

    /**
     * @param Request $request
     * @return array
     */
    function removeInvite(Request $request)
    {
        $teacher = \App\Teacher::where('user_id', $request->user()->id)->first();

        // Checking invite actually exists and that the authenticated user sent it
        if (count(\App\Invite::where(['email' => $request['email'], 'from_id' => $request->user()->id])->get()) > 0)
        {
            //If yes, deleting
            DB::table('invites')->where(['email' => $request['email'], 'from_id' => $request->user()->id])->delete();

            // Increasing remaining invites
            $teacher->remaining_invites = $teacher->remaining_invites + 1;
            $teacher->save();
        } else return ['Invitation inexistante.'];
    }


    function exams()
    {
        $exams = DB::table("exams")->where("teacher_id", $this->teacher->id)->get();
        foreach ($exams as $i => $exam)
        {
            $exams[$i] = $this->exam($exam);
        }
        //Retour
        return $exams;
    }

    function exam($exam)
    {
        //Récupération des données
        $exam = is_numeric($exam) ? DB::table("exams")->where("id", $exam)->first() : $exam;
        if (is_null($exam))
        {
            return null;
        }
        if ($exam->teacher_id != $this->teacher->id)
        {
            return null;
        }

        //
        $exam->classe_name = DB::table("classes")->where("id", $exam->classe_id)->first()->name;
        //Dates
        $date = new DateTime($exam->due_date);
        $exam->over = new DateTime() > $date;

        return $exam;
    }


    function assignments()
    {
        //Ajout des données supplémentaires aux devoirs
        foreach ($this->teacher->assignments as $i => $assignment)
        {
            $this->teacher->assignments[$i] = $this->assignment($assignment);
        }
        //Retour
        return $this->teacher->assignments;
    }

    function assignment($assignment)
    {
        //Récupération des données
        $assignment = is_numeric($assignment) ? \App\Assignment::find($assignment) : $assignment;
        if (is_null($assignment))
        {
            return null;
        }
        if ($assignment->teacher_id != $this->teacher->id)
        {
            return null;
        }

        return $assignment;
    }

    function subjects()
    {
        //Liste des sujets
        return DB::table("classe_teacher")->where("teacher_id", $this->teacher->id)->select("subject")->distinct()->get();
    }

    function calendar()
    {
        //Envoi du calendrier
        $assignments = DB::table("assignments")->where("teacher_id", $this->teacher->id)->select("name", "id", "due_date", "created_at", "classe_id", DB::raw("'assignments' AS type"));
        $exams = DB::table("exams")->where("teacher_id", $this->teacher->id)->select("name", "id", "due_date", "created_at", "classe_id", DB::raw("'exams' AS type"));
        $calendar = $assignments->union($exams)->latest()->get();
        //Ajout des données supplémentaires aux étudiants
        foreach ($calendar as $i => $event)
        {
            //Email et noms
            $event->classe_name = DB::table("classes")->where("id", $event->classe_id)->first()->name;
            //Enregistrement
            $calendar[$i] = $event;
        }
        return $calendar;
    }

    function createSchool($request)
    {
        //Création de l'école
        if ($this->createSchoolInfos()["created"])
        {
            return ["schools" => $this->list_schools(), "t_school" => $this->teacher_schools(), "info" => $this->createSchoolInfos(), "response" => "limit_reached"];
        } else
        {
            //Vérification
            $validator = Validator::make($request->all(), [
                'school_name' => 'required|max:255',
                'school_city' => 'required|max:255'
            ]);
            //Echec
            if ($validator->fails())
            {
                return ["schools" => $this->list_schools(), "t_school" => $this->teacher_schools(), "info" => $this->createSchoolInfos(), "response" => "error"];
            }
            //Création d'une nouvelle école
            $school = new School();
            $school->name = $request->input("school_name");
            $school->city_name = $request->input("school_city");
            $school->headmaster_id = $this->teacher->user_id;
            $school->headmaster_pays = $request->input("headmaster_pays") ? true : false;
            $school->save();
            //Ajout du prof à cette école
            DB::table("school_teacher")->insert(["school_id" => $school->id, "teacher_id" => $this->teacher->id]);
            return ["school" => $this->school($school->id), "response" => "success"];
        }
    }

    function createSchoolInfos()
    {
        return ["citys" => DB::table("schools")->select("city_name")->distinct()->get(), "created" => DB::table("schools")->where("headmaster_id", $this->teacher->user_id)->count()];
    }

    function list_schools()
    {
        //Envoi du calendrier
        $schools = DB::table("schools")->get();
        //Ajout des données supplémentaires
        foreach ($schools as $i => $school)
        {
            $schools[$i] = $this->school($school);
        }
        return $schools;
    }

    function school($school, $fullData = false)
    {
        //Récupération des données
        $school = is_numeric($school) ? DB::table("schools")->where("id", $school)->first() : $school;
        if (is_null($school))
        {
            return null;
        }
        //Ajout des données supplémentaires
        $headmaster = DB::table("users")->where("id", $school->headmaster_id)->first();
        $school->headmaster_name = $headmaster->name[0] . ". " . $headmaster->last_name;
        //Liste des professeurs par écoles
        $school->belongs = $this->teacher->schools->contains($school->id);

        if (($fullData) && ($school->belongs))
        {
            $school->teachers = DB::table("teachers")->join("users", "users.id", "=", "teachers.user_id")->join("school_teacher", "teachers.id", "=", "school_teacher.teacher_id")->where("school_id", $school->id)->get();

            $school->students = DB::table("students")->join("users", "users.id", "=", "students.user_id")->where("school_id", $school->id)->get();
            $school->students_ext = DB::table("students")->join("users", "users.id", "=", "students.user_id")->join("school_student", "students.id", "=", "school_student.student_id")->where("school_student.school_id", $school->id)->get();
        }


        return $school;
    }

    function teacher_schools()
    {
        //Récupération des ids des écoles auxqules l'enseignant appartiant
        $schools_id = $this->teacher->schools();
        $schools = [];
        //Récupération des données des écoles
        foreach ($this->teacher->schools as $school)
        {
            $schools[] = $this->school($school->id, true);
        }
        return $schools;
    }

    function addExam(Request $request)
    {

        // Create an assignment
        $exam = new Exam();

        // Add form data
        $exam->name = $request->input('name');
        $exam->content = $request->input('content');
        $exam->due_date = $request->input('due_date');
        $exam->surprise = $request->input('surprise') ? true : false;
        $exam->teacher_id = $this->teacher->id;
        $exam->classe_id = $request->input('classe_id');

        // Save assignment
        $exam->save();
    }

    function downloadFiles($assignment_id)
    {
		if ($this->assignment($assignment_id) == null)
			return false;
        //Aucun fichier à télécharger
        if (!$documents = DB::table("assignments_documents")->where("assignment_id", $assignment_id)->count())
        {
            return false;
        }

        //Création de l'archive
        $zip = new ZipArchive();
		$name = storage_path("app/uploads/teachers/archives/" . DB::table("assignments")->where("id", $assignment_id)->first()->name . ".zip");

		if (!file_exists(storage_path("app/uploads/teachers/archives/")))
		{
			mkdir(storage_path("app/uploads/teachers/archives/"), 0755, true);
		}
        //Vérification
        if ($zip->open($name, ZIPARCHIVE::CREATE | ZIPARCHIVE::OVERWRITE) === TRUE)
        {
            //Récupération des fichiers envoyés par les élèves
            $documents = DB::table("assignments_documents")->where("assignment_id", $assignment_id)->get();
            foreach ($documents as $document)
            {
                //Création d'un dossier à l'effigie de l'élève
                $student = DB::table("students")->join("users", "users.id", "=", "students.user_id")->where("students.id", $document->student_id)->first();
                $folder = $student->last_name . "_" . $student->name;
                $zip->addEmptyDir($folder);
                //Ajout du fichier
				$zip->addFile(storage_path("app/uploads/students/" . $document->path), $folder . "/" . preg_replace("/[0-9]*_[0-9]*_/i", "", $document->path, 1));
            }
            //Enregistrement
            $zip->close();
        } else
        {
            return false;
        }

        return $name;
    }

    function dashboard_info()
    {
        return [
            "assignments" => DB::table("assignments")->where("teacher_id", $this->teacher->id)->count(),
            "students" => $this->students()->count(),
            "exams" => DB::table("exams")->where("teacher_id", $this->teacher->id)->count(),
            "remaining_invites" => DB::table("teachers")->where("id", $this->teacher->id)->first()->remaining_invites
        ];
    }

    function students()
    {
        //Liste des étudiants
        $school_ids = array_map(function ($v)
        {
            return strval($v->id);
        }, $this->teacher_schools());
        $students = DB::table("students")->whereIn("school_id", $school_ids)->get();
        //Ajout des données supplémentaires aux étudiants
        foreach ($students as $i => $student)
        {
            //Email et noms
            $student->email = DB::table("users")->where("id", $student->user_id)->first()->email;
            $student->last_name = DB::table("users")->where("id", $student->user_id)->first()->last_name;
            $student->name = DB::table("users")->where("id", $student->user_id)->first()->name;
            //Enregistrement
            $students[$i] = $student;
        }
        return $students;
    }

	function getNoteInfos($note)
	{
		$note = DB::table("notes")->where('id', $note)->first();

		return $note;
	}

	function avgStudents_classe($classe)
	{
		$students_classe = DB::table('classe_student')->join("students", "students.id", "=", "classe_student.student_id")->join("users", "users.id", "=", "students.user_id")->orderBy("users.last_name", "asc")->where('classe_id', $classe)->get();
		$avgStudents = array();

		foreach ($students_classe as $key => $student)
		{
			$avgStudents[$student->student_id] = $this->avgStudent($student->student_id);
		}

		return $avgStudents;
	}

    function avgStudent($student)
    {
      $average_student = DB::table('notes_students')->where('student_id', $student)->get();

      $sum = 0;
      $count = 0;

      foreach ($average_student as $key => $value) {
        $devoir = DB::table('notes')->where('id', $value->note_ref)->first();
        $sum += ($value->note)*(20/$devoir->bareme)*$devoir->coefficient;
        $count += $devoir->coefficient;
      }

      if($count > 0){
        return round($sum/$count, 2);
      }

      return null;
    }

    function notes_classe($classe)
    {
        //Récupération des notes pour la classe
        $notes = DB::table("notes")->where("class_id", $classe)->get();
        if (is_null($notes))
        {
            return null;
        }

        $sum_classe = 0;
        $count_classe = 0;

        foreach($notes as $i=>$note){
          $sNotes = DB::table("notes_students")->where("note_ref", $note->id)->get();

          foreach($sNotes as $sNote){
            $note->students_notes[$sNote->student_id] = $sNote->note;
          }

          $note->avgClasse = $this->avgDevoir_classe($note->id);
          $sum_classe += ($note->avgClasse)*$note->coefficient;
          $count_classe += $note->coefficient;

          $notes[$i] = $note;
        }

        if($count_classe > 0){
          $notes->avgGet_classe = round($sum_classe/$count_classe,2);
        }


        return $notes;

    }

	function avgDevoir_classe($devoir)
	{
		$average_notes = DB::table('notes_students')->where('note_ref', $devoir)->avg('note');

		return round($average_notes, 2);
	}

	/**
	 * @return \Illuminate\Support\Collection
	 */
	function getNewsFeed()
    {
		$newsfeed = DB::table("newsfeed")->where("visible", 1)->orderBy('id', 'desc')->take(3)->get();

        foreach ($newsfeed as $i=>$news)
        {
			$news->author = DB::table("users")->where("id", $news->author)->first()->name;
            $newsfeed[$i] = $news;
        }
        return $newsfeed;
    }

    /**
     *  Record a call in class
     * @param Request $request
     * @return \Illuminate\Validation\Validator
     */
    function recordAbsences(Request $request, $classe_id)
    {

        // Create a call
        $call = new Absences();

        // Add form data
        $call->class_id = $classe_id;
        $call->user = $request->user()->id;
        $call->date_validation = new DateTime();

        // Save call
        $call->save();

        // Foreach student, check if he's marked "missing"
        $students = $this->classe($classe_id);

        foreach ($students->students as $student) {

          if( $request->input('chk'.$student->student_id) ){

              $missing_student = new MissingStudent();
              $missing_student->call_ref = $call->id;
              $missing_student->student_id = $student->student_id;
              $missing_student->absence_start = date("Y-m-d H:00:00");
              $missing_student->last_edit = date("Y-m-d H:i:s");
              $missing_student->absence_end = date("Y-m-d H:00:00", strtotime('+1 hour'));

              $missing_student->save();

          }

        }

        return true;

	}

	function classe($classe)
	{
		//Récupération des données
		$classe = is_numeric($classe) ? DB::table("classes")->where("id", $classe)->first() : $classe;
		if (is_null($classe))
		{
			return null;
		}

		//Récupération des données supplémentaires
		//Sujet de la classe

     
		$classe_subject = DB::table("classe_teacher")->where([["teacher_id", "=", $this->teacher->id], ["classe_id", "=", $classe->id]])->first();
		$classe->subject = $classe_subject->subject;
		//Liste des étudiants
		$classe->students = DB::table("classe_student")->join("students", 'students.id', "=", 'classe_student.student_id')->join("users", "users.id", "=", "students.user_id")->where("classe_id", $classe->id)->orderBy("users.last_name", "asc")->get();
		$classe->students_nb = $classe->students->count();
		//Ajout des données supplémentaires aux étudiants

        $newStudents = array();

		foreach ($classe->students as $i=>$student)
		{
			//Email et noms
			$student->email = DB::table("users")->where("id", $student->user_id)->first()->email;
			$student->last_name = DB::table("users")->where("id", $student->user_id)->first()->last_name;
			$student->name = DB::table("users")->where("id", $student->user_id)->first()->name;
			$student->avatar = DB::table("users")->where("id", $student->user_id)->first()->avatar;
            $student->rank = DB::table("users")->where("id", $student->user_id)->first()->rank;
			//Enregistrement
            $newStudents[$student->id] = $student;
		}

		$classe->students = $newStudents;

		return $classe;
    }

    /**
     *  Get call history
     * @param Request $request
     * @return \Illuminate\Validation\Validator
     */
    function callHistory()
    {
        $callHistory = DB::table('appel_en_classe')->where('user', $this->teacher->user_id)->get();

        foreach ($callHistory as $i=>$call){
            $call->classe = DB::table('classes')->where('id', $call->class_id)->first()->name;
            $call->retards = DB::table('absence_student')->where('type_absence', 'late')->where('call_ref', $call->id)->count();
            $call->absences = DB::table('absence_student')->where('type_absence', 'unknown')->where('call_ref', $call->id)->count();
            $callHistory[$i] = $call;
        }

        return $callHistory;
    }

    /**
     * Add a new note
     * @param Request $request
     * @return \Illuminate\Validation\Validator
     */
    function addNote(Request $request)
    {
        // Create a note
        $note = new Notes();

        // Add form data
        $note->title = $request->input('title');
        $note->coefficient = $request->input('coeff');
        $note->bareme = $request->input('bareme');
        $note->type = $request->input('type');
        $note->class_id = $request->input('classe_id');
        $note->matiere = 4;
        $note->add_date = date("Y-m-d H:i:s");
        $note->publish_date = $request->input('show_date');
        $note->period = 1;

        // Save call
        $note->save();

        // Foreach student, check if he's marked "missing"
        $students = $this->classe($request->input('classe_id'));

        foreach ($students->students as $student) {

            if( $request->input('note'.$student->student_id) ){

                $note_student = new NotesStudent();
                $note_student->note = $request->input('note'.$student->student_id);
                $note_student->note_ref = $note->id;
                $note_student->student_id = $student->student_id;

                $note_student->save();

            }

        }

        return true;
    }

    function updateNote(Request $request){

        return true;
    }

    /**
     * Add a new actuality in newsfeed
     * @param Request $request
     * @return \Illuminate\Validation\Validator
     */
    function addActuality(Request $request)
    {
        // Create an actuality
        $actuality = new Actuality();

        // Add form data
        $actuality->title = $request->input('title');
        $actuality->content = $request->input('content');
		    $actuality->author = $this->teacher->user_id;

        // Save call
        $actuality->save();

        return true;
    }

    /**
     * Delete a note
     * @param Request $request
     * @return \Illuminate\Validation\Validator
     */
    function deleteNote($note)
    {
        DB::table('notes')->where('id', $note)->delete();
        DB::table('notes_students')->where('note_ref', $note)->delete();

        return true;
    }

	/**
	 * Deletes document
	 * @param $id
	 * @return bool
	 */
	function deleteDocument($id)
	{
		// Check that the document is actually owned by this teacher
		$document = \App\Document::find($id);
		if ($document->teacher_id != $this->teacher->id)
			return false;

		Storage::delete("uploads/teachers/" . iconv("UTF-8", "ISO-8859-1//TRANSLIT", $document->path));
		$document->delete();
		return true;
	}

  function getPeriodsClasse($classe)
  {
    $periods = DB::table("classe_periods")->where("class_id", $classe)->orderBy('start_date', 'asc')->get();

    return $periods;
  }

  /**
   * Add a new review
   * @param Request $request
   * @return \Illuminate\Validation\Validator
   */
 

  function addReview(Request $request)
  {

    $classe = $this->classe($request->input('classe'));

    foreach ($classe->students as $student) {

      if( $request->input('review'.$student->student_id) ){

        $review = new Review();

        // Add form data
        $review->student_id = $student->student_id;
        $review->teacher_id = $request->input('teacher');
        $review->class_id = $request->input('classe');
        $review->matiere_id = $request->input('matiere');
        $review->review = $request->input('review'.$student->student_id);
        $review->add_date = date("Y-m-d H:i:s");
        // Save review

        $review->save();
        // Foreach student, check if review is writed.

      }

    }

    return true;
  }

  function updateReview(Request $request)
  {
    $review = Review::find($request->input('id'));

    $student = $request->input('student');
    $review->review = $request->input('review'.$student);

    // Save updated review
    $assignment->save();
  }
}

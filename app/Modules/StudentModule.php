<?php
/**
 * Copyright (c) Liigem 2017.
 */
namespace App\Modules;

use DateTime;
use DB;
use Illuminate\Support\Facades\Storage;

class StudentModule implements StudentModuleInterface
{

    public function __construct($student)
    {
        $this->student = $student;
    }

    function calendar()
    {
        //Récupération des ids des classes auxquels l'étudiant appartient
        $classes_id = $this->student->classes_id;
        //Envoi du calendrier
        $assignments = DB::table("assignments")->whereIn("classe_id", $classes_id)->select("name", "id", "due_date", "created_at", DB::raw("'assignments' AS type"));
        $exams = DB::table("exams")->whereIn("classe_id", $classes_id)->select("name", "id", "due_date", "created_at", DB::raw("'exams' AS type"));
        $calendar = $assignments->union($exams)->latest()->get();
        return $calendar;
    }

    function teacher($teacher)
    {
        //Récupération des ids des classes auxquels l'étudiant appartient
        $classes_id = $this->student->classes_id;

        //Récupération des données
        $teacher = is_numeric($teacher) ? DB::table("users")->join("teachers", "users.id", "=", "teachers.user_id")->join("classe_teacher", "teachers.id", "=", "classe_teacher.teacher_id")->where("teachers.id", $teacher)->first() : $teacher;
        if (is_null($teacher))
        {
            return null;
        }

        //Nom formatté
        $teacher->fname = $teacher->name[0] . ". " . $teacher->last_name;
        //Matières
        $matters = DB::table("classe_student")->join("classe_teacher", "classe_student.classe_id", "=", "classe_teacher.classe_id")->select("subject")->where([["student_id", $this->student->id], ["teacher_id", $teacher->id]])->get();
        $matter = [];
        foreach ($matters as $m)
        {
            array_push($matter, $m->subject);
        }
        $teacher->matter = join(' et ', array_filter(array_merge(array(join(', ', array_slice($matter, 0, -1))), array_slice($matter, -1)), 'strlen'));
        return $teacher;
    }

    function news($id)
    {
        //Récupération des actualités
        $assignments = DB::table("assignments")->where("teacher_id", $id)->select("id", "created_at", DB::raw("'assignments' AS type"));
        $documents = DB::table("documents")->where("teacher_id", $id)->select("id", "created_at", DB::raw("'documents' AS type"));
        $messages = DB::table("teachers_messages")->where("teacher_id", $id)->select("id", "created_at", DB::raw("'teachers_messages' AS type"));
        //10 premiers messages utiles
        $news = $assignments->union($documents)->union($messages)->take(10)->latest()->get();

        foreach ($news as $i => $nnew)
        {
            //Récupération desd onnées de la news
            $nnew->data = DB::table($nnew->type)->where("id", $nnew->id)->first();
            //
            if ($nnew->type == "assignments")
            {
                //$news[$i]->data = $this->assignment($nnew->data);
            }

        }

        return $news;
    }


    function document($document)
    {
        //Récupération des données
        $document = is_numeric($document) ? DB::table("documents")->where("id", $document)->first() : $document;
        if (is_null($document))
        {
            return null;
        }
		if (!$this->student->classes->contains($document->class_id))
			return false;
        //Nom
        $document->name = preg_replace("/[0-9]*_[0-9]*_/i", "", $document->path, 1);
        $author = DB::table("users")->join("teachers", "users.id", "=", "teachers.user_id")->where("teachers.id", $document->teacher_id)->first();
        $document->author = $author->name[0] . ". " . $author->last_name;
        $document->assignment = DB::table("assignments")->where("id", $document->assignment_id)->first();
        return $document;
    }


    function exams()
    {
        //Récupération des ids des classes auxquels l'étudiant appartient
        $classes_id = $this->student->classes_id;
        //Récupération des exams
        $exams = DB::table("exams")->whereIn("classe_id", $classes_id)->latest("due_date")->get();
        foreach ($exams as $i => $exam)
        {
            $exams[$i] = $this->exam($exam);
        }
        return $exams;
    }

    function exam($exam)
    {
        //Récupération des ids des classes auxquels l'étudiant appartient
        $classes_id = $this->student->classes_id;
        //Récupération des données
        $exam = is_numeric($exam) ? DB::table("exams")->where("id", $exam)->first() : $exam;
        if (is_null($exam))
        {
            return null;
        }
        //Auteur du devoir
        $author = DB::table("users")->join("teachers", "users.id", "=", "teachers.user_id")->where("teachers.id", $exam->teacher_id)->first();
        $exam->author = $author->name[0] . ". " . $author->last_name;
        //A faire par l'étudiant en question
        $exam->todo = in_array($exam->classe_id, $classes_id);
        $exam->over = new DateTime() > new DateTime($exam->due_date);
        return $exam;
    }

    //Ajout de fichier à un devoir

    function addFile($assignment, $request)
    {
        //Vérification que le nombre max de fichiers n'ait pas été atteint et que le devoir est valide
		$assignment = \App\Assignment::find($assignment);
		$this->student->current_assignment = $assignment;
        if (is_null($assignment))
        {
            return "no_assignment";
        }

            if (!$assignment->over)
            {
				if ($this->student->uploaded + 1 <= $assignment->max_files)
                {
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
							$request->file("fileUpload")->move(storage_path() . "/app/uploads/students", iconv("UTF-8", "ISO-8859-1//TRANSLIT", $path));
                            $result = "success";
                            //Renregistrement
                            DB::table("assignments_documents")->insert([
                                "student_id" => $this->student->id,
                                "assignment_id" => $assignment->id,
                                "type" => $type,
                                "path" => $path
                            ]);
                            return "up_success";
                        } else
                        {
                            return "up_upload";
                        }
                    } else
                    {
                        return "up_no_file";
                    }
                } else
                {
                    return "up_max_files";
                }
            } else
            {
                return "archived";
            }

	}

    //Suppression de fichier à un devoir

    function removeFile($assignment, $request)
    {
        //Récupération des données
        if (is_null($assignment))
        {
            return "no_assignment";
        }
        if ($request->has("delete"))
        {
            //Récupéation du fichier
            $file = DB::table("assignments_documents")->where([
                ["id", $request->input("delete")],
                ["student_id", $this->student->id],
				["assignment_id", $assignment]
            ]);
            //Suppression du fichier
            if ($file->count())
            {
                //Suppression
				Storage::delete("uploads/students/" . $file->first()->path);
                $file->delete();
                return "rm_success";
            } else
            {
                return "rm_err_no_file";
            }
        } else
        {
            return "rm_no_data";
        }
    }

    function updateMarker($assignment, $request)
    {
        //Récupération des données
		$assignment = \App\Assignment::find($assignment);
        if (is_null($assignment))
        {
            return "no_assignment";
        }
        //Mise à jour du marqueur
        if ($request->has("marker"))
        {
            if ($request->input("marker") == "done")
            {
                DB::table("assignments_status")->insert(["student_id" => $this->student->id, "assignment_id" => $assignment->id]);
                return "mk_success";
            }
            if ($request->input("marker") == "progress")
            {
                DB::table("assignments_status")->where([["student_id", "=", $this->student->id], ["assignment_id", $assignment->id]])->delete();
                return "mk_success";
            }
        }
        return "mk_fail";
    }

    //Fonction de taille ( ͡° ͜ʖ ͡°)

    function avgMatieres()
    {

        $student_matieres = $this->matieres();
        $avgMatieres = array();

        $periods = $this->periods();

        foreach ($periods as $period)
        {

            foreach ($student_matieres as $matiere)
            {
                $avgMatieres[$period->id][$matiere->matiere_id] = round($this->avgMatiere($matiere->matiere_id, $period->id), 2);
            }

        }

        return $avgMatieres;

    }

    function matieres()
    {
        //Récupération des matières de l'élève
        $student_classe = DB::table("classe_student")->where("student_id", $this->student->id)->first();
        $matieres = DB::table("classes_matieres")->where("classe_id", $student_classe->classe_id)->get();

        if (is_null($matieres))
        {
            return null;
        }

        foreach ($matieres as $i => $matiere)
        {
            $matieres[$i]->details = $this->matiere($matiere->matiere_id);
        }
        //Retour
        return $matieres;
    }

    function matiere($matiere)
    {
        //Récupération des données
        $matiere = is_numeric($matiere) ? DB::table("matieres")->where("id", $matiere)->first() : $matiere;
        if (is_null($matiere))
        {
            return null;
        }


        return $matiere;
    }

    function periods()
    {
        // Récupération des périodes pour l'élève
        $periods = DB::table("classe_periods")->where("class_id", $this->classe())->get();

        return $periods;
    }

    function classe()
    {
        $student_classe = DB::table("classe_student")->where("student_id", $this->student->id)->first();

        return $student_classe->classe_id;
    }

    function avgMatiere($matiere, $period)
    {

        $notes_classe = DB::table('notes')->where('class_id', $this->classe())->where('matiere', $matiere)->where('period', $period)->get();

        $total = 0;
        $count = 0;

        foreach ($notes_classe as $note_c)
        {
            $note = DB::table('notes_students')->where('student_id', $this->student->id)->where('note_ref', $note_c->id)->first();
            // var_dump($note);exit;
            $total += ($note->note * (20 / $note_c->bareme)) * $note_c->coefficient;
            $count += $note_c->coefficient;
        }

        if ($count > 0)
            return (float)$total / $count;
        else
            return false;

    }

    function notes()
    {
        //Récupération des notes de l'élève
        $notes = DB::table("notes_students")->where("student_id", $this->student->id)->get();

        if (is_null($notes))
        {
            return null;
        }

        foreach ($notes as $i => $note)
        {
            $notes[$i]->devoir = $this->note_devoir($note->note_ref);
            $notes[$i]->devoir->avgClasse = $this->avgDevoir_classe($notes[$i]->devoir->id);
        }
        //Retour
        return $notes;
    }

    function note_devoir($note)
    {
        //Récupération des données
        $note = is_numeric($note) ? DB::table("notes")->where("id", $note)->first() : $note;
        if (is_null($note))
        {
            return null;
        }


        return $note;
	}

	function avgDevoir_classe($devoir)
	{
		$average_notes = DB::table('notes_students')->where('note_ref', $devoir)->avg('note');

		return round($average_notes, 2);
    }

    function getAbsencesRetards()
    {
        // Recupération des données
        $absences = DB::table("absence_student")->where("student_id", $this->student->id)->get();

        $absences->nbUnjustified = count($absences);
        return $absences;
    }

}

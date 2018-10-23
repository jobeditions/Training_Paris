<?php
/**
 * Copyright (c) Liigem 2017
 */
namespace App\Modules;

use App\Version;
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

class AdminModule implements AdminModuleInterface
{

  function __construct($admin = null)
  {
      $this->admin = $admin;
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
      $school->belongs = $this->admin->schools->contains($school->id);

      if (($fullData) && ($school->belongs))
      {
          $school->teachers = DB::table("teachers")->join("users", "users.id", "=", "teachers.user_id")->join("school_teacher", "teachers.id", "=", "school_teacher.teacher_id")->where("school_id", $school->id)->get();

          $school->students = DB::table("students")->join("users", "users.id", "=", "students.user_id")->where("school_id", $school->id)->get();
          $school->students_ext = DB::table("students")->join("users", "users.id", "=", "students.user_id")->join("school_student", "students.id", "=", "school_student.student_id")->where("school_student.school_id", $school->id)->get();
      }


      return $school;
  }


  function list_schools()
  {
      //Envoi du calendrier
      $schools = DB::table("schools")->get();
      //Ajout des données supplémentaires
      // foreach ($schools as $i => $school)
      // {
      //     $schools[$i] = $this->school($school);
      // }
      return $schools;
  }

  function admin_schools()
  {
      //Récupération des ids des écoles auxqules l'enseignant appartiant
      $schools_id = $this->admin->schools();
      $schools = [];
      //Récupération des données des écoles
      foreach ($this->admin->schools as $school)
      {
          $schools[] = $this->school($school->id, true);
      }
      return $schools;
  }

  function createSchoolInfos()
  {
      return ["citys" => DB::table("schools")->select("city_name")->distinct()->get(), "created" => DB::table("schools")->where("headmaster_id", $this->admin->user_id)->count()];
  }


    /********************************
    *           VERSIONS
     *******************************/

    /**
     * @param $id
     * @param $content
     */
    // function addVersion($id,$content)
    // {
    //     $version = new Version();
    //
    //     $version->version_number = $id;
    //     $version->update = $content;
    //
    //     $version->save();
    // }

    /**
     * @param $id
     */
    // function removeVersion($id)
    // {
    //     Version::where(['version_number' => $id])->delete();
    // }

    /**
     * @param $id
     * @param $content
     */
    // function updateVersion($id,$content)
    // {
    //     Version::where(['version_number' => $id])->update(['update' => $content]);
    // }
}

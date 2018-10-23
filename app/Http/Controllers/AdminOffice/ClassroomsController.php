<?php

namespace App\Http\Controllers\AdminOffice;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\AdminModule;

class ClassroomsController extends Controller
{
  /**
   * Show the application dashboard.
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      //Récupération des données du professeur
          $admin = \App\Admin::where('user_id', Auth::id())->first();
      //Création du module
          $aModule = new AdminModule($admin);
      //Vue
    return view('admin.classrooms.index', ["schools" => $aModule->list_schools()/*, "t_school" => $aModule->admin_schools(), "info" => $aModule->createSchoolInfos()*/]);
  }
}

<?php
/**
 * Copyright (c) Liigem 2017.
 */

namespace App\Http\Controllers\TeacherOffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Modules\TeacherModule;
use App\Student;
use Session;
use App\Review;

class ReviewsController extends Controller
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
            return view('teachers.reviews', ["classes" => $teacher->classes()]);
    }

    /**
     * Show the application dashboard.
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //Récupération des données du professeur
            $teacher = \App\Teacher::where('user_id', Auth::id())->first();
        //Création du module
            $tModule = new TeacherModule($teacher);
        // Vue : Paramètre, liste des classes du prof
            return view('teachers.reviews_edit', ["classes" => $teacher->classes()]);
    }

    /**
     * Show the application dashboard.
     * @return \Illuminate\Http\Response
     */

    public function edit_post(Request $request)
    {
        //Récupération des données du professeur
            $teacher = \App\Teacher::where('user_id', Auth::id())->first();
        //Création du module
            $tModule = new TeacherModule($teacher);
            $classe = $tModule->classe($request->input('classe'));
            $periods = $tModule->getPeriodsClasse($request->input('classe_selector'));
            

        // Vue
        if($request->input('methode') == 1)

        {


          if(count($classe->students) == 0)
          
          {

            Session::flash('info','Vous devez ajouter des élèves pour faire une appréciation');
            return redirect()->back();
          }
           else{
              $value = reset($classe->students);
              $value1 = $value->student_id;

            
              return redirect()->route('single.posting', ["id" => $value1,"class" =>$classe->id]);
          }
        }
        else{
        
            $classe = $tModule->classe( $request->input('classe'));
            $periods = $tModule->getPeriodsClasse( $request->input('classe'));
          

          return view('teachers.reviews_edit_list',compact('classe','periods'));
            
            
        }
    }

    public function single_post($id,$class)
    {
         
        $studenting = \App\Student::where('id',$id)->first();
        $teacher = \App\Teacher::where('user_id', Auth::id())->first();
        //$classing = \App\Class::where('id',$id)->first();
        
        $tModule = new TeacherModule($teacher);
         
        $classe = $tModule->classe($class);
       
        return view('teachers.reviews_edit_card', compact('classe', 'studenting'));
     }

    public function createreview(Request $request)
     {
      
       $this -> validate($request, [
            'review'        => 'required|max:255',
            'student_id'    => 'required',
            'class_id'      => 'required',
            'matiere_id'    => 'required'
        ]);

        $item = new Review;
        $item->review = $request->review;
        $item->student_id = $request->student_id;
        $item->class_id = $request->class_id;
        $item->teacher_id = Auth::user()->id;
        $item->matiere_id = $request->matiere_id;
       
        $item->save();

       return response()->json(['first_body' => $item->review], 255);
     }

     public function modifyreview(Request $request)
    {
        
        $this->validate($request, [
            'review' => 'required|max:255'
        ]);
        $item = Review::find($request['postId']);
        $item->review = $request->review;

        $item->update();
        return response()->json(['new_body' => $item->review], 255);
       
     }




}

    




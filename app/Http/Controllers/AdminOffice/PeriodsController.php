<?php
/**
 * Copyright (c) Liigem 2016.
 */

namespace App\Http\Controllers\AdminOffice;

use App\Http\Controllers\Controller;
use App\Modules\TeacherModule;
use Auth;
use Illuminate\Http\Request;
use Validator;
use App\Period;
use Carbon\Carbon;
use Session;
use App\School;
use App\Students;
use App\Module\AdminModule;

class PeriodsController extends Controller
{
	 public function index()


    {   $admin = \App\Admin::where('user_id', Auth::id())->first();
        $admin_school = $admin->school->id;
        $periods=Period::where('school_id', $admin_school)->get();
        // 


        return view('admin.liste_periode',compact('periods'));

         
    }

    public function edit($id){

        $period=Period::find($id);
        return view('admin.period')->withPeriod($period);
    }

   
    public function create( )
    {
       
        
        return view('admin.period');
        
    }



    public function save($id, Request $request)

    	 {

            $this->validate($request,[
                'periode'=>'required | max:50',
                'startdate'=>'before:enddate',

                ]);
         
         $period=Period::findOrFail($id);

        $period->name = $request->input('periode');
        // dump($request);
        $period->start_date = $request->input('enddate');
        $period->end_date = $request->input('startdate');

        $period->save();

        
        return redirect('/admin/periodshow  ')->with('success','Votre periode a bien été modifiée');
    } 





     public function store(Request $request)

    {

        $this->validate($request,[
            'periode'=>'required | max:50',
            'startdate'=>'before:enddate',


            ]);




        $period = new Period();
        $admin = \App\Admin::where('user_id', Auth::id())->first();
        // dd($admin);
        $admin_school = $admin->school->id;
        // dd($admin_school);
        $period->name = $request->input('periode');
        // dump($request);
        $period->start_date = $request->input('enddate');
        $period->end_date = $request->input('startdate');
        $period->school_id = $admin_school;

        $period->save();

        
        return redirect('/admin/period')->with('success','Votre periode a bien été enregistrée');




    }

    Public function delete ($id)
    {
        $period=Period::find($id);
        $period->delete();


 return redirect('/admin/period')->with('success','Votre periode a bien été supprimée');

    }

    
    
}

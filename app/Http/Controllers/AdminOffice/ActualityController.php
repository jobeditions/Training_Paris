<?php

namespace App\Http\Controllers\AdminOffice;

use Auth;
use App\Actuality;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\AdminModule;

class ActualityController extends Controller
{
    public function index()
    {
      $admin = \App\Admin::where('user_id', Auth::id())->first();
      $actus_school = Actuality::where('school_id', '=', $admin->school_id)->get();

      return view('admin.actus.index', ["actus" => $actus_school]);
    }

    public function add()
    {
      return view('admin.actus.add');
    }

    public function store(Request $request)
    {
      $admin = \App\Admin::where('user_id', Auth::id())->first();

      $actu = new Actuality();

      $actu->title = $request->input('title');
      $actu->content = $request->input('content');
      $actu->start_date = $request->input('start_date');
      $actu->end_date = $request->input('end_date');
      $actu->author = Auth::id();
      $actu->visible = true;
      $actu->school_id = $admin->school_id;

      $actu->save();

      return redirect(route('admin-actus'))->with('status', 'L\'actualité a bien été ajoutée.');
    }


    function edit($id)
    {
      $actuality = Actuality::find($id);
      return view('admin.actus.edit', ['actu' => $actuality]);
    }


    public function save($id, Request $request)
    {
      $actuality = Actuality::find($id);

      $actualitytitle = $request->input('title');
      $actuality->content = $request->input('content');
      $actuality->start_date = $request->input('start_date');
      $actuality->end_date = $request->input('end_date');

      $actuality->save();

      return redirect(route('admin-actus'))->with('status', 'L\'actualité a bien été modifiée.');
    }


    public function destroy($id)
    {
      $room = Actuality::find($id);
      $room->delete();

      return redirect(route('admin-actus'))->with('status', 'L\'actualité a bien été suprimée.');
    }


    public function toggle($id)
    {
      $actuality = Actuality::find($id);

      if($actuality->visible == 1)
      {
        $actuality->visible = false;
        $actuality->save();
        return redirect(route('admin-actus'))->with('status', 'L\'actualité a bien été désactivée.');
      }
      else
      {
        $actuality->visible = true;
        $actuality->save();
        return redirect(route('admin-actus'))->with('status', 'L\'actualité a bien été activée.');
      }

    }
}

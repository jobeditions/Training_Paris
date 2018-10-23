<?php

namespace App\Http\Controllers\AdminOffice;

use App\Http\Controllers\Controller;
use App\Modules\TeacherModule;
use Illuminate\Http\Request;
use Validator;
use App\Room;

class RoomsController extends Controller
{
    public function index()
    {
      $rooms = Room::paginate(15);
      return view('admin.rooms.index', compact('rooms'));
    }

    public function create()
    {
      return view('admin.rooms.create');
    }

    public function store(Request $request)
    {
      $room = new Room();
      $room->name = $request->input('name');
      $room->numero = $request->input('numero');
      $room->school_id = 2;
      $room->save();

      return redirect('/admin/rooms')->with('status', 'La salle a bien été ajoutée.');
    }

    public function edit($id)
    {

    }

    public function destroy($id)
    {
      $room = Room::find($id);
      $room->delete();

      return redirect('/admin/rooms')->with('status', 'La salle a bien été suprimée.');
    }
}

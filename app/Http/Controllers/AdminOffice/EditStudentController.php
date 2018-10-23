<?php
/**
 * Created by PhpStorm.
 * User: oumarucho
 * Date: 05/07/2017
 * Time: 10:35
 */

namespace App\Http\Controllers\AdminOffice;


use App\Http\Controllers\Controller;
use App\User;
use App\Student;
use Illuminate\Http\Request;


class EditStudentController extends Controller
{
    public function index($id)
    {
        $student = User::findOrFail($id);

        return view('admin.editStudent', compact('student','id'));
    }


    public function createStudentIndex()
    {
        return view('admin.createStudent');
    }

    public function createStudent(Request $request)
    {
        $this->validate($request, [
          'last_name' => 'required|min:2',
          'name' => 'required|min:2',
          'email' => 'required|email',
          'password' => 'required|string|min:6|confirmed',
          'password_confirmation' => 'required|min:8'
         ]);

        $data = $request->all();

        User::create($data);
        return redirect(route('admin-classes'))->with('success',"L'élève a bien été crée");

    }

    public function updateStudent(Request $request, $id)

    {
         $this->validate($request, [
        'last_name' => 'required|min:2',
        'name' => 'required|min:2',
        'email' => 'required|email',
             'password' => 'string|min:8|confirmed',
            'password_confirmation' => 'min:8'
         ]);

         $data = $request->only(['last_name','name','email']);

         $student = User::find($id);
         $student_school = Student::where('user_id', $id)->get();

         $student->last_name = $data['last_name'];
         $student->name = $data['name'];
         $student->email = $data['email'];

         $student->save();

         return redirect(route('admin-classes'))->with('success', "L'élève a bien été mis à jour");

    }

}

<?php
/**
 * Copyright (c) Liigem 2016.
 */

namespace App\Http\Controllers\TeacherOffice;

use App\Http\Controllers\Controller;
use App\Modules\TeacherModule;
use Auth;
use Illuminate\Http\Request;
use Validator;

class SettingsController extends Controller
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
     * Updates user settings
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // Form Validation
        $validator = Validator::make($request->all(), [
            'password' => 'max:255',
            'name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email',
			'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        if ($validator->fails())
        {
            return $this->index($request,$validator->errors()->all());
        }

        $user = \App\User::find($request->user()->id);
        $user->email = $request['email'];
        $user->name = $request['name'];
        $user->last_name = $request['last_name'];

        if(isset($request['password']) && !empty($request['password']))
            $user->password = bcrypt($request['password']);

		if (isset($request['avatar']) && !empty($request['avatar']))
		{
			$imageName = time() . $this->getToken(80) . '.' . $request['avatar']->getClientOriginalExtension();
			$request->file('avatar')->storeAs('public/avatars', $imageName);
			$user->avatar = $imageName;
		}
		$user->save();
        $request->session()->flash('success', 'Les paramètres ont bien été enregistrés');

        return redirect('teacher/settings');
    }

	/**
	 * Shows the settings.
	 * @param Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request, $errors = [])
	{
		//Récupération des données du professeur
		$teacher = \App\Teacher::where('user_id', Auth::id())->first();
		//Création du module
		$tModule = new TeacherModule($teacher);
		//Vue
		return view('teachers.settings', ['errors' => $errors, "t_school" => $tModule->teacher_schools()]);
	}

	private function getToken($length)
	{
		$token = "";
		$codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
		$codeAlphabet .= "0123456789";
		$max = strlen($codeAlphabet); // edited

		for ($i = 0; $i < $length; $i++)
		{
			$token .= $codeAlphabet[$this->crypto_rand_secure(0, $max - 1)];
		}

		return $token;
	}

	private function crypto_rand_secure($min, $max)
	{
		$range = $max - $min;
		if ($range < 1) return $min; // not so random...
		$log = ceil(log($range, 2));
		$bytes = (int)($log / 8) + 1; // length in bytes
		$bits = (int)$log + 1; // length in bits
		$filter = (int)(1 << $bits) - 1; // set all lower bits to 1
		do
		{
			$rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
			$rnd = $rnd & $filter; // discard irrelevant bits
		} while ($rnd > $range);
		return $min + $rnd;
	}
}

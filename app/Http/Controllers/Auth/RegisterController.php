<?php
/**
 * Copyright (c) Liigem 2016.
 */

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Teacher;
use App\User;
use DB;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\HTTP\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class RegisterController extends Controller
{
	use RedirectsUsers;

	/*
	|--------------------------------------------------------------------------
	| Register Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users as well as their
	| validation and creation. By default this controller uses a trait to
	| provide this functionality without requiring any additional code.
	|
	*/

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */

	protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

	/**
	 * Show the application registration form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getRegister()
	{
		return view('auth.register');
	}

    public function showRegistrationForm()
    {
        return view('frontoffice.auth.register');
    }

	/**
	 * Handle a registration request for the application.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function register(Request $request)
	{
		$validator = $this->validator($request->all());
		if ($validator->fails())
		{
			$this->throwValidationException(
				$request, $validator
			);
		}
		Auth::login($this->create($request->all(), $request->ip()));
		return redirect($this->redirectPath());
	}

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'code' => 'required|exists:invites,code,status,pending',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'cgu' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
	protected function create(array $data, $ip)
    {
		$invite = \App\Invite::where('code', $data['code'])->first();

		// Creating user
		$user = new \App\User();
		$user->name = $data['first_name'];
		$user->last_name = $data['last_name'];
		$user->email = $data['email'];
		$user->password = bcrypt($data['password']);
		$user->ip_register = $ip;
		$user->ip_last = $ip;
		$user->save();


		// Changing invite status
		$invite->status = 'completed';
		$invite->save();

        // TODO create subscription with trial period
		// 		$user->newSubscription('main', 'monthly-10-1') ->trialUntil(Carbon::now()->addDays($invite->free_days))->create();

		// Creating Teacher
		$id = Teacher::create([
            'user_id' => $user->id,
            'remaining_invites' => 5,
		])->id;

		DB::table('school_teacher')->insert([
			'teacher_id' => $id,
			'school_id' => DB::table('school_teacher')->where('teacher_id', \App\User::find($invite->from_id)->id)->first()->school_id
		]);


        // Returning user
        return $user;
    }
}

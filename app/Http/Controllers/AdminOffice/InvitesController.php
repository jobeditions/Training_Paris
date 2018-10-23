<?php
/**
 * Copyright (c) Liigem 2017.
 */

namespace App\Http\Controllers\AdminOffice;

use App\Http\Controllers\Controller;
use App\Modules\TeacherModule;
use Illuminate\Http\Request;
use Validator;

class InvitesController extends Controller
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
	 * Adds invite
	 * @return \Illuminate\Http\Response
	 */
	public function add(Request $request)
	{
		$errors = [];
		$validator = Validator::make($request->all(), [
			'email' => 'required|email',
		]);
		if ($validator->fails())
		{
			array_push($errors, $validator->errors()->all());
		}

		$tModule = new TeacherModule();
		array_push($errors, $tModule->newInvite($request));

		return $this->index($request, $errors);
	}

	/**
	 * Shows the invites.
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request, $errors = [])
	{
		$invites = \App\Invite::where('from_id', $request->user()->id)->get();

		return view('admin.invites', ['invites' => $invites, 'errors' => $errors]);
	}

	/**
	 * Removes invite
	 * @return \Illuminate\Http\Response
	 */
	public function remove(Request $request)
	{
		$errors = [];
		$validator = Validator::make($request->all(), [
			'email' => 'required|email',
		]);
		if ($validator->fails())
		{
			array_push($errors, $validator->errors()->all());
		} else
		{
			$tModule = new TeacherModule();
			array_push($errors, $tModule->removeInvite($request));
		}

		return redirect()->back()->with('errors', $errors);
	}
}

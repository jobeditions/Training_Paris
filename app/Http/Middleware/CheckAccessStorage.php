<?php

namespace App\Http\Middleware;

use Closure;

class CheckAccessStorage
{
	/**
	 * Handle an incoming request.
	 * Welcome to one of the most horrible conditions I've had to write, ever.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$objective = $request->filename;
		// If the user trying to access to resource is a student, we'll check if he owns that file. If it's a teacher, we'll check if it belongs to an assignment he created.
		if (
			(
				\App\Student::where('user_id', $request->user()->id)->count() > 0
				&& \App\AssignmentDocument::where(['path' => $objective, 'student_id' => \App\Student::where('user_id', $request->user()->id)->first()->id])->count() > 0
			)

			|| (
				\App\Teacher::where('user_id', $request->user()->id)->count() > 0
				&& \App\AssignmentDocument::where('path', $objective)->count() > 0
				&& \App\Teacher::where('user_id', $request->user()->id)->first()->id == \App\Assignment::find(\App\AssignmentDocument::where('path', $objective)->first()->assignment_id)->teacher_id
			)

		)
		{
			return $next($request);
		}
		return redirect('/403');
	}
}

<?php
/**
 * Copyright (c) Liigem 2016.
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            switch (Auth::user()->rank)
            {
                case 'user':
                    return redirect('/teacher');
                    break;
                case 'student':
                    return redirect('/student');
                    break;
                case 'admin':
                    return redirect('/admin');
                    break;
                default:
                    return redirect('/404');
                    break;
            }
        }

        return $next($request);
    }
}

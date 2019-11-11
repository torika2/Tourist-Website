<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Redirect;
class AdminMiddleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function adminCheck($request)
    {
        if (Auth::user()->admin == 1) {

        	return Redirect::route("supportisation");

        }else{
            return Redirect::route('Login');
            exit();
        }
        return $next($request);
    }
}

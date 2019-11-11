<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class SessionCloseSolve
{

    protected function handle($request, Closure $next)
    {
        if (Session::has('users')) {
        	return \Redirect::route("supportisation");
        }else{
            return view('Login');
        }
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
        /* if(Auth::user() &&  Auth::guard('admin')) {
        }
        return abort(403); */
        if (\Auth::user() &&  \Auth::user()->role == 'Admin') {
            return $next($request);
       }

       return back()->with('error','Opps, You\'re not Admin');
    }
}

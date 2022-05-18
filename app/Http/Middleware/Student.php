<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Student
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!Auth::check()){
            return redirect()->route('login');
        }
        // role_id 0 = Student
        if (Auth::user()->role_id==0){
            return $next($request);
        }
        // role_id 1 = School
        if (Auth::user()->role_id==1){
            return redirect()->route('school');
        }
        // role_id 2 = Indsustry
        if (Auth::user()->role_id==2){
            return redirect()->route('industry');
        }
    }
}
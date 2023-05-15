<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Industry
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
        // role_id 0 = Admin
        if (Auth::user()->role_id == 0){
            return redirect()->route('admin');
        }
        // role_id 1 = Student
        if (Auth::user()->role_id == 1){
            return redirect()->route('student');
        }
        // role_id 2 = School Staff
        if (Auth::user()->role_id == 2){
            return redirect()->route('school');
        }
        // role_id 3 = Industry
        if (Auth::user()->role_id == 3){
            return $next($request);
        }
        // role_id 4 = ITF
        if (Auth::user()->role_id == 4){
            return redirect()->route('itf');
        }

    }
}

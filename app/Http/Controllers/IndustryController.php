<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserRegMail;

class IndustryController extends Controller
{
    public function create(){
        return view('industry.register');
    }
    public function store(Request $request)
    {
        $user = User::create($this->validateRequest()); 
        $user->last_name = Str::ucfirst($request->last_name);
        $user->first_name = Str::ucfirst($request->first_name);
        $user->middle_name = Str::ucfirst($request->middle_name);
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect('login');
    }
    private function validateRequest(){
        return request()->validate([
            'role_id'=> 'required|integer',
            'staff_id' => 'required|string|max:30|unique:users',
            'email' => 'required|email|max:50|unique:users',
            'last_name' => 'required|string|max:100',
            'first_name' => 'required|string|max:100',
            'middle_name' => 'string|max:100',
            'department' => 'required|string|max:200',
            'contact_no'=> 'required|integer',
            'gender'=> 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'matric_no' => 'string', 'faculty' => 'string','course_of_study' => 'string',
        ]);
    }
}

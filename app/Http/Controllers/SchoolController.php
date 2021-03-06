<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

// use App\Mail\UserRegMail;
// use Illuminate\Support\Facades\Mail;

class SchoolController extends Controller
{
    public function __construct()
    {
        $this->middleware('school')->except(['create', 'store']);
    }
    public function index(){
        return view('school.home');
    }
    // Show the registraton form for the student user
    public function create(){
        $faculty = DB::table('departments')->selectRaw('faculty')->groupBy('faculty')->get();
        return view('school.register', compact('faculty'));
    }
    // Store the inputed information of the student user
    public function store(Request $request)
    {
        $user = User::create($this->validateRequest()); 
        $user->last_name = Str::ucfirst($request->last_name);
        $user->first_name = Str::ucfirst($request->first_name);
        $user->middle_name = Str::ucfirst($request->middle_name);
        $user->password = Hash::make($request->password);
        if ($request->hasFile('profile_pic')){
            $user->profile_pic = $request->file('profile_pic')->store('profile_pics', 'public');
        }
        $user->save();
        return redirect('login');
    }
    // To validate the inputs
    private function validateRequest(){
        return request()->validate([
            'role_id'=> 'required|integer',
            'staff_id' => 'required|string|max:30|unique:users',
            'email' => 'required|email|max:50|unique:users',
            'last_name' => 'required|string|max:100',
            'first_name' => 'required|string|max:100',
            'middle_name' => 'string|max:100',
            'faculty' => 'required|string|max:200',
            'department' => 'required|string|max:200',
            'contact_no'=> 'required|digits_between:9,16',
            'gender'=> 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'profile_pic' => 'required',
            'matric_no' => 'string','course_of_study' => 'string',
        ]);
    }
}

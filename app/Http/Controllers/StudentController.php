<?php

namespace App\Http\Controllers;


use DB;
use App\User;

use App\Organization;
use App\Student;
use App\Mail\UserRegMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class StudentController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('student')->except(['create', 'store']);
    }
    public function create(){
        return view('student.register');
    }
    public function show(){
        $id = Auth::user()->id;
        $student = Student::where('user_id', $id)->first();
        return view('student.profile', compact('student'));
    }
    public function edit(){
        $id = Auth::user()->id;
        $student = Student::where('user_id', $id)->first();
        return view('student.editpro', compact('student'));
    }
    public function editorg(){
        return view('student.editorgpro');
    }
    public function addorg(Request $request)
    {
        $student = new Student();
        $student->org_id = $request->org_id;
        $student->user_id = Auth::user()->id;
        $student->save();

        return back();
    }
    public function add(){
        return view('student.addpro');
    }
    public function org(){
        $id = Auth::user()->id;
        $student = Student::where('user_id', $id)->first();
        return view('student.orgprofile', compact('student'));
    }
    public function orgedit(){
        $id = Auth::user()->id;
        $student = Student::where('user_id', $id)->first();
        $orgs = Organization::all();
        return view('student.editorg', compact('orgs', 'student'));
    }
    public function updateorg(Request $request)
    {
        dd($request);
        $id = $request->id;
        Student::where('id', $id)->update(['org_id'=> $request->org_id]);
        return redirect('student.editorg');
    }
    public function index(){
        $id = Auth::user()->id;
        $student = Student::where('user_id', $id)->first();
        $orgs = Organization::all();
        return view('student.home', compact('student', 'orgs'));
    }
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
    private function validateRequest(){
        return request()->validate([
            'role_id'=> 'required|integer',
            'matric_no' => 'required|string|max:12|min:12|unique:users',
            'email' => 'required|email|max:50|unique:users',
            'last_name' => 'required|string|max:100',
            'first_name' => 'required|string|max:100',
            'middle_name' => 'required|string|max:100',
            'faculty' => 'required|string|max:200',
            'department' => 'required|string|max:200',
            'course_of_study' => 'string|max:100',
            'contact_no'=> 'required|integer',
            'gender'=> 'required|string|max:100',
            'password' => 'required|string|min:8|confirmed',
            'staff_id' => 'string',
            'profile_pic' => 'required',
        ]);
    }
    // public function fetch(Request $request){
    //     $value = $request->get('value');
    //     $dept = DB::table('department')->where('faculty', $value)->groupBy('department')->get();
    //     $output = '<option value="" selected disabled hidden> Select Department </option>';
    //     foreach($dept as $d){
    //         $output .= '<option value="' .$d->department.'">' .$d->department.' </option>';
    //     }
    //     echo $output;
    // }
}

<?php

namespace App\Http\Controllers;


// use DB;

use App\User;
use App\Student;
use App\Organization;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

// use App\Mail\UserRegMail;
// use Illuminate\Support\Facades\Mail;

class StudentController extends Controller
{
        // Middleware for Student activites excepts Initial Registration
    public function __construct()
    {
        $this->middleware('student')->except(['create', 'store']);
    }

        // Show StudentUser registration form
    public function create(){
        return view('student.register');
    }
        // For storing the StudentUser registration form
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
        // Validation for StudentUser Form
    private function validateRequest()
    {
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
        // Show homepage of StudentUser
    public function index()
    {
        $id = Auth::user()->id;
        $student = Student::where('user_id', $id)->first();
        $orgs = Organization::all();
        return view('student.home', compact('student', 'orgs'));
    }
        // Show single StudentUser profile 
    public function show()
    {
        $id = Auth::user()->id;
        $student = Student::where('user_id', $id)->first();
        $orgs = Organization::all();
        return view('student.profile', compact('student', 'orgs'));
    }
        // Show StudentUser edit form
    public function edit()
    {
        $id = Auth::user()->id;
        $student = Student::where('user_id', $id)->first();
        return view('student.profile_edit', compact('student'));
    }
        // Update the information for StudentUser
    public function update(Request $request)
    {
        $user = User::where('id', $request->id)->first();
   
        $user->last_name = Str::ucfirst($request->last_name);
        $user->first_name = Str::ucfirst($request->first_name);
        $user->middle_name = Str::ucfirst($request->middle_name);
        $user->gender = ($request->gender);
        $user->faculty = ($request->faculty);
        $user->department = ($request->department);
        $user->course_of_study = $request->course_of_study;
        $user->contact_no = ($request->contact_no);
        if ($request->hasFile('profile_pic')){
            $user->profile_pic = $request->file('profile_pic')->store('profile_pics', 'public');
        }
        $user->update();
        return redirect("/student/profile");
    }
        // Show edit form for student other information.
    public function other_edit()
    {        
        $id = Auth::user()->id;
        $student = Student::where('user_id', $id)->first();
        $orgs = Organization::all();
        return view('student.profile_other_edit', compact('student', 'orgs'));
    }
        // update the other info of students
    public function other_update(Request $request)
    {
        // dd($request);
        $student = Student::where('id', $request->id)->first();
        $student->duration_of_training = $request->duration_of_training;
        $student->year_of_training = $request->year_of_training;
        if ($request->hasFile('signature')){
            $student->signature = $request->file('signature')->store('signatures', 'public');
        }
        $student->update();

        return redirect('/student/profile');
    }
        // Show StudentUser Organization profile
    public function org()
    {
        $id = Auth::user()->id;
        $student = Student::where('user_id', $id)->first();
        $orgs = Organization::all();
        return view('student.org', compact('student', 'orgs'));
    }
        // create Student and add organization to database
    public function org_add(Request $request)
    {
        $student = new Student();
        $student->user_id = Auth::user()->id;
        $student->org_id = $request->org_id;
        $student->year_of_training = $request->year_of_training;
        $student->duration_of_training = $request->duration_of_training;
        if ($request->hasFile('signature')){
            $student->signature = $request->file('signature')->store('signatures', 'public');
        }
        $student->save();

        return back();
    }
        // Show the edit form for Student org
    public function org_edit()
    {
        $id = Auth::user()->id;
        $student = Student::where('user_id', $id)->first();
        $orgs = Organization::all();
        return view('student.org_edit', compact('orgs', 'student'));
    }
        // update the organization of the student
    public function org_update(Request $request)
    {
        // dd($request);
        $student = Student::where('id', $request->id)->first();
        $student->org_id = $request->org_name;
        $student->update();

        return redirect('/student/org');
    }    
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
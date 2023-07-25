<?php

namespace App\Http\Controllers;

use App\User;
use App\Session;
use App\Student;

use App\Organization;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

// use App\Mail\UserRegMail;
// use Illuminate\Support\Facades\Mail;

class StudentController extends Controller
{
        // Middleware for Student activites excepts Initial Registration
    public function __construct()
    {
        $this->middleware('student')->except(['create', 'store', 'dept_fetch', 'course_fetch']);
    }
        // Show StudentUser registration form
    public function create()
    {
        $faculty = DB::table('departments')->selectRaw('faculty')->groupBy('faculty')->get();
        return view('student.register', compact('faculty'));
    }
    public function dept_fetch(Request $request){
        $value = $request->get('value');
        $dept = DB::table('departments')->select('department')->where('faculty', $value)->groupBy('department')->get();
        $output = '';
        $output = '<option value="" selected disabled hidden> Select Department </option>';
        foreach($dept as $d){
            $output .= '<option value="' .$d->department.'">' .$d->department.' </option>';
        }
        echo $output;
    }
    public function course_fetch(Request $request){
        $value = $request->get('value');
        $course = DB::table('departments')->select('course_study')->where('department', $value)->groupBy('course_study')->get();
        $output = '';
        $output = '<option value="" selected disabled hidden> Select Course </option>';
        foreach($course as $c){
            $output .= '<option value="' .$c->course_study.'">' .$c->course_study.' </option>';
        }
        echo $output;
    }
        // For storing the StudentUser registration form
    public function store(Request $request)
    {
        try {
            // DB::beginTransaction();
            DB::commit();
                // Adding New User 
                // $user = User::create($this->validateRequest());
                $user = new User();
                $user->role_id = 1;
                $user->email = $request->email;
                $user->last_name = Str::ucfirst($request->last_name);
                $user->first_name = Str::ucfirst($request->first_name);
                $user->middle_name = Str::ucfirst($request->middle_name);
                $user->contact_no = $request->contact_no;
                $user->gender = $request->gender;
                $user->password = Hash::make($request->password);
                if ($request->hasFile('profile_pic')){
                    $user->profile_pic = $request->file('profile_pic')->store('profile_pics', 'public');
                }

                $user->save();
                
                $curernt_session = Session::where('status', 1)->first();
                // Adding Student Details
                $student = new Student();
                $student->matric_no = $request->matric_no;
                $student->user_id = $user->id;
                // $student->org_id = 1;
                // $student->staff_id = ;
                $student->session_id = $curernt_session->id;
                $student->faculty = $request->faculty;
                $student->department = $request->department;
                $student->course_of_study = $request->course_of_study;
                if ($request->hasFile('signature')){
                    $student->signature = $request->file('signature')->store('signatures', 'public');
                }

                $student->save();

                if (Auth::user()) {
                   return redirect('/admin/students'); 
                } else {
                    return redirect('login');
                }             
            
        } catch(\Exception $e){
            DB::rollback();
            return $e;
        }
    }
        // Validation for StudentUser Form
    // private function validateRequest()
    // {
    //     return request()->validate([
    //         'role_id'=> 'required|integer',
    //         'email' => 'required|email|max:50|unique:users',
    //         'last_name' => 'required|string|max:100',
    //         'first_name' => 'required|string|max:100',
    //         'contact_no'=> 'required|digits_between:9,16',
    //         'gender'=> 'required|string|max:100',
    //         'password' => 'required|string|min:8|confirmed',
    //         'profile_pic' => 'required',
    //     ]);
    // }
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
        // dd($request->all());
        $id = Auth::user()->id;
        $student = Student::where('user_id', $id)->first();        
        $student->org_id = $request->org_id;
        $student->year_of_training = $request->year_of_training;
        $student->duration_of_training = $request->duration_of_training;
        if ($request->hasFile('signature')){
            $student->signature = $request->file('signature')->store('signatures', 'public');
        }
        $student->update();

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

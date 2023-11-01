<?php

namespace App\Http\Controllers;

use App\User;
use App\Siwes;
use App\Session;
use App\Student;
use App\Material;
use App\BankDetail;
use App\VerifyToken;
use App\Announcement;
use App\Organization;
use App\Mail\Registration;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use KingFlamez\Rave\Facades\Rave as Flutterwave;
use Illuminate\Support\Facades\Http;

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
        // dd($request->all());
        try {
            // DB::beginTransaction();
            DB::commit();
                // Adding New User 
                // $user = User::create($this->validateRequest());
                $user = User::create($request->all());
                $user->role_id = 1;
                $user->email = $request->email;
                $user->last_name = Str::ucfirst($request->last_name);
                $user->first_name = Str::ucfirst($request->first_name);
                $user->contact_no = $request->contact_no;
                $user->gender = $request->gender;
                $user->password = Hash::make($request->password);
                if ($request->hasFile('signature')){
                    $user->signature = $request->file('signature')->store('signatures', 'public');
                }
                if ($request->hasFile('profile_pic')){
                    $user->profile_pic = $request->file('profile_pic')->store('profile_pics', 'public');
                }
                $user->save();
                
                $curernt_session = Session::where('status', 1)->first();

                // Adding Student Details
                $student = new Student();
                $student->matric_no = Str::upper($request->matric_no);
                $student->user_id = $user->id;
                $student->session_id = $curernt_session->id;
                $student->faculty = $request->faculty;
                $student->department = $request->department;
                $student->course_of_study = $request->course_of_study;
                if ($request->hasFile('signature')){
                    $student->signature = $request->file('signature')->store('signatures', 'public');
                }
                $student->save();

                $token = 'ESP-'.(rand(100000, 999999));
                $verification = new VerifyToken();
                $verification->user_id = $user->id;
                $verification->token = $token;
                $verification->email = $user->email;
                $verification->save();

                Mail::to($user->email)->send(new Registration($user, $token));

                if (Auth::user()) {
                   return redirect('/admin/students')->with('success',"Successfully Registered! Verification token sent to <b>$request->email</b>"); 
                } else {
                    // return redirect('/verification')->with('success', "Successfully Registered! Verify your account to log in");
                    return redirect('/verification')->with('success', "Successfully Registered! Verification token sent to <b>$request->email</b>");
                    // return redirect('login')->with('success', 'Verify your email before login. Go check your inbox!');
                }             
            
        } catch(\Exception $e){
            DB::rollback();
            return $e;
        }
    }
        // Validation for StudentUser Form
    private function validateRequest()
    {
        return request()->validate([
            'role_id',
            'email' => 'required|email|max:50|unique:users',
            'last_name' => 'required|string|max:100',
            'first_name' => 'required|string|max:100',
            'middle_name' => 'nullable',
            'contact_no'=> 'required|digits_between:9,16',
            'gender'=> 'required|string|max:100',
            'password' => 'required|string|min:8|confirmed',
            'profile_pic' => 'required',
        ]);
    }
        // Show homepage of StudentUser
    public function index()
    {
        $id = Auth::user()->id;
        $student = Student::where('user_id', $id)->first();
        $orgs = Organization::all();
        $sessions = Session::all();

        $siwes200 = Siwes::where('siwes_type_id', 1)->where('user_id', $id)->first();
        $siwes300 = Siwes::where('siwes_type_id', 2)->where('user_id', $id)->first();
        $siwes400 = Siwes::where('siwes_type_id', 3)->where('user_id', $id)->first();
        $materials = Material::where('department', $student->department)->orWhere('siwes_type_id', 0)->get();
        $announcement = Announcement::whereIn('department', [$student->department, 'All'])->orderBy('id', 'DESC')->first();
        $announcements = Announcement::whereIn('department', [$student->department, 'All'])->orderBy('updated_at', 'DESC')->get();
        // dd($siwes300);
        
        return view('student.home', compact('student', 'orgs', 'sessions', 'siwes200', 'siwes300', 'siwes400', 'materials', 'announcement', 'announcements'));
    }
        // Show single StudentUser profile
    public function show()
    {
        $id = Auth::user()->id;
        $student = Student::where('user_id', $id)->first();
        $orgs = Organization::all();
        $bank = BankDetail::where('user_id', $id)->first();

        $banks = Flutterwave::banks()->nigeria();

        return view('student.profile', compact('student', 'orgs', 'bank', 'banks'));
    }
        // Show StudentUser edit form
    public function edit()
    {
        $id = Auth::user()->id;
        $student = Student::where('user_id', $id)->first();
        // $banks = {{baseurl}}v2/api/identity/ng/bank-account-number/bank-list;
        // dd($banks);
        return view('student.profile_edit', compact('student'));
    }
        // Update the information for StudentUser
    public function update(Request $request)
    {
        // dd($request->all());
        $user = User::where('id', $request->id)->first();
        $student = Student::where('user_id', $request->id)->first();

        $user->last_name = Str::ucfirst($request->last_name);
        $user->first_name = Str::ucfirst($request->first_name);
        $user->middle_name = Str::ucfirst($request->middle_name);
        $user->gender = ($request->gender);
        $user->contact_no = ($request->contact_no);
        if ($request->hasFile('profile_pic')){
            $user->profile_pic = $request->file('profile_pic')->store('profile_pics', 'public');
        }

        $student->faculty = ($request->faculty);
        $student->department = ($request->department);
        $student->course_of_study = $request->course_of_study;
        if ($request->hasFile('signature')){
            $student->signature = $request->file('signature')->store('signatures', 'public');
        }

        $user->update();
        $student->update();

        return redirect("/student/profile")->with('success', "$user->name() profile updated successfully!!");
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

        return redirect('/student/profile')->with('success', "Update Successful!!");
    }
        // Show StudentUser Organization profile
    public function org()
    {
        $id = Auth::user()->id;
        $student = Student::where('user_id', $id)->first();
        $s_siwes = Siwes::where('user_id', $id)->whereNotNull('org_id')->first();
        $siwes = Siwes::where('user_id', $id)->whereNotNull('org_id')->get();
        // dd(count($siwes));
        $orgs = Organization::all();
        return view('student.org', compact('student', 'orgs', 'siwes', 's_siwes'));
    }
        // create Student and add organization to database
    // public function org_add(Request $request)
    // {
    //     // dd($request->all());
    //     $id = Auth::user()->id;
    //     $student = Student::where('user_id', $id)->first();        
    //     $student->org_id = $request->org_id;
    //     $student->year_of_training = $request->year_of_training;
    //     $student->duration_of_training = $request->duration_of_training;
    //     if ($request->hasFile('signature')){
    //         $student->signature = $request->file('signature')->store('signatures', 'public');
    //     }
    //     $student->update();

    //     return back();
    // }
        // Show the edit form for Student org
    public function siwes_edit($siwes_id)
    {
        $id = Auth::user()->id;
        $siwes = Siwes::findOrFail($siwes_id);
        $student = Student::where('user_id', $id)->first();
        $orgs = Organization::all();
        $sessions = Session::all();

        return view('student.siwes_edit', compact('orgs', 'student', 'siwes', 'sessions'));
    }
        // update the organization of the student
    public function siwes_update(Request $request)
    {
        // dd($request->all());
        $siwes = Siwes::findOrFail($request->siwes_id);
        $siwes->org_id = $request->org_id;
        $siwes->resumption_date = $request->resumption_date;
        $siwes->ending_date = $request->ending_date;
        $siwes->duration_of_training = $request->duration_of_training;
        $siwes->year_of_training = $request->year_of_training;
        $siwes->session_id = $request->session_id;
        $siwes->update();

        return redirect('/student/org')->with('success', "SIWES updated Succesfully!!");
    }
    public function store_bank(Request $request)
    {
        dd($request->all());
        $bank = BankDetail::create($request->all());
        $bank->save();

        return back()->with('success', 'Bank Details Stored Successfully!!');
    }
}

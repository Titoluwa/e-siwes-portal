<?php

namespace App\Http\Controllers;

use App\User;
use App\Siwes;

use App\Staff;
use App\Session;
use App\Student;
use App\SiwesType;
use Carbon\Carbon;
use App\DailyRecord;
use App\Organization;
use App\WeeklyRecord;
use App\MonthlyRecord;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

// use App\Mail\UserRegMail;
// use Illuminate\Support\Facades\Mail;

class SchoolController extends Controller
{
    public function __construct()
    {
        $this->middleware('school')->except(['create', 'store']);
    }
    public function index(){

        $user_id = Auth::user()->id;
        $current_session = Session::where('status', 1)->first();
        $staff = Staff::where('user_id', $user_id)->first();
        $siwes = Siwes::where('session_id', $current_session->id)->where('assigned_staff_id', $staff->id)->get();
        $single_siwes = Siwes::where('session_id', $current_session->id)->where('assigned_staff_id', $staff->id)->first();
        // $swep200 = Siwes::where('siwes_type_id', 1)->where('session_id', $current_session->id)->where('assigned_staff_id', $staff->id)->get();
        // $siwes300 = Siwes::where('siwes_type_id', 2)->where('session_id', $current_session->id)->where('assigned_staff_id', $staff->id)->get();
        // $siwes400 = Siwes::where('siwes_type_id', 3)->where('session_id', $current_session->id)->where('assigned_staff_id', $staff->id)->get();
        $sessions = Session::all();
        $siwes_types = SiwesType::all();
        
        return view('school.home', compact('staff', 'single_siwes','siwes', 'sessions', 'siwes_types', 'current_session'));
    }
    // Show the registraton form for the student user
    public function create(){
        $faculty = DB::table('departments')->selectRaw('faculty')->groupBy('faculty')->get();
        return view('school.register', compact('faculty'));
    }
    // Store the inputed information of the student user
    public function store(Request $request)
    {
        
        try {
            // DB::beginTransaction();
            DB::commit();
                // Adding New STAFF User 
                // $user = User::create($this->validateRequest());
                $user = new User();
                $user->role_id = 2;
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
                
                // Adding Staff Details
                $staff = new Staff();
                $staff->user_id = $user->id;
                $staff->staff_id = $request->staff_id;
                $staff->faculty = $request->faculty;
                $staff->department = $request->department;
                if ($request->hasFile('signature')){
                    $staff->signature = $request->file('signature')->store('signatures', 'public');
                }

                $staff->save();

                if (Auth::user()) {
                   return redirect('/admin/staffs'); 
                } else {
                    return redirect('login');
                }             
            
        } catch(\Exception $e){
            DB::rollback();
            return $e;
        }
        // $user = User::create($this->validateRequest());
        // $user->last_name = Str::ucfirst($request->last_name);
        // $user->first_name = Str::ucfirst($request->first_name);
        // $user->middle_name = Str::ucfirst($request->middle_name);
        // $user->password = Hash::make($request->password);
        // if ($request->hasFile('profile_pic')){
        //     $user->profile_pic = $request->file('profile_pic')->store('profile_pics', 'public');
        // }
        // $user->save();
        // return redirect('login');
    }

    public function student_log($id)
    {
        $student = Student::where('user_id', $id)->first();
        // $siwes = Siwes::where('siwes_type_id', $siwes)->where('user_id', $id)->first();
        $currentdate = Carbon::now()->format('Y-m-d');
        $all_dailys = DailyRecord::where('user_id', $id)->orderBy('date', 'ASC')->first();
        $all_weeks = WeeklyRecord::where('user_id', $id)->first();
        $dailyrecords = DailyRecord::where('user_id', $id)->first();
        $weeklyrecords = WeeklyRecord::where('user_id', $id)->first();
        $monthlyrecords = MonthlyRecord::where('user_id', $id)->first();

        if (!empty($all_dailys)){
            $all_dailys = DailyRecord::where('user_id', $id)->orderBy('date', 'ASC')->get();
        }else{
            $all_dailys = null;
        }

        if (!empty($dailyrecords)){
            $dailyrecords = DailyRecord::where('user_id', $id)->orderBy('date', 'ASC')->get();
        }else{
            $dailyrecords = null;
        }
        
        if (!empty($weeklyrecords)){
            $weeklyrecords = WeeklyRecord::where('user_id', $id)->orderBy('created_at', 'ASC')->get();
        }else{
            $weeklyrecords = null;
        }
        
        if (!empty($all_weeks)){
            $all_weeks = WeeklyRecord::where('user_id', $id)->get();
        }else{
            $all_weeks = null;
        }

        if (!empty($monthlyrecords)){
            $monthlyrecords = MonthlyRecord::where('user_id', $id)->get();
        }else{
            $monthlyrecords = null;
        }
        return view('school.student_log', compact('student', 'currentdate', 'dailyrecords', 'weeklyrecords', 'all_dailys', 'monthlyrecords', 'all_weeks'));
    }
    public function siwes400($id)
    {
        $student = Student::where('user_id', $id)->first();
        $siwes = Siwes::where('siwes_type_id', 3)->where('user_id', $id)->first();
        $currentdate = Carbon::now()->format('Y-m-d');
        
        $all_dailys = DailyRecord::where('siwes_id', $siwes->id)->where('user_id', $id)->orderBy('date', 'ASC')->first();
        $all_weeks = WeeklyRecord::where('siwes_id', $siwes->id)->where('user_id', $id)->first();
        $dailyrecords = DailyRecord::where('siwes_id', $siwes->id)->where('user_id', $id)->first();
        $weeklyrecords = WeeklyRecord::where('siwes_id', $siwes->id)->where('user_id', $id)->first();
        $monthlyrecords = MonthlyRecord::where('siwes_id', $siwes->id)->where('user_id', $id)->first();

        if (!empty($all_dailys)){
            $all_dailys = DailyRecord::where('siwes_id', $siwes->id)->where('user_id', $id)->orderBy('date', 'ASC')->get();
        }else{
            $all_dailys = null;
        }

        if (!empty($dailyrecords)){
            $dailyrecords = DailyRecord::where('siwes_id', $siwes->id)->where('user_id', $id)->orderBy('date', 'ASC')->get();
        }else{
            $dailyrecords = null;
        }
        
        if (!empty($weeklyrecords)){
            $weeklyrecords = WeeklyRecord::where('siwes_id', $siwes->id)->where('user_id', $id)->orderBy('created_at', 'ASC')->get();
        }else{
            $weeklyrecords = null;
        }
        
        if (!empty($all_weeks)){
            $all_weeks = WeeklyRecord::where('siwes_id', $siwes->id)->where('user_id', $id)->get();
        }else{
            $all_weeks = null;
        }

        if (!empty($monthlyrecords)){
            $monthlyrecords = MonthlyRecord::where('siwes_id', $siwes->id)->where('user_id', $id)->get();
        }else{
            $monthlyrecords = null;
        }
        return view('school.student_log', compact('student', 'currentdate', 'dailyrecords', 'weeklyrecords', 'all_dailys', 'monthlyrecords', 'all_weeks', 'siwes'));
    }
    public function siwes300($id)
    {
        $student = Student::where('user_id', $id)->first();
        $siwes = Siwes::where('siwes_type_id', 2)->where('user_id', $id)->first();
        $currentdate = Carbon::now()->format('Y-m-d');
        $all_dailys = DailyRecord::where('siwes_id', $siwes->id)->where('user_id', $id)->orderBy('date', 'ASC')->first();
        $all_weeks = WeeklyRecord::where('siwes_id', $siwes->id)->where('user_id', $id)->first();
        $dailyrecords = DailyRecord::where('siwes_id', $siwes->id)->where('user_id', $id)->first();
        $weeklyrecords = WeeklyRecord::where('siwes_id', $siwes->id)->where('user_id', $id)->first();
        $monthlyrecords = MonthlyRecord::where('siwes_id', $siwes->id)->where('user_id', $id)->first();

        if (!empty($all_dailys)){
            $all_dailys = DailyRecord::where('siwes_id', $siwes->id)->where('user_id', $id)->orderBy('date', 'ASC')->get();
        }else{
            $all_dailys = null;
        }

        if (!empty($dailyrecords)){
            $dailyrecords = DailyRecord::where('siwes_id', $siwes->id)->where('user_id', $id)->orderBy('date', 'ASC')->get();
        }else{
            $dailyrecords = null;
        }
        
        if (!empty($weeklyrecords)){
            $weeklyrecords = WeeklyRecord::where('siwes_id', $siwes->id)->where('user_id', $id)->orderBy('created_at', 'ASC')->get();
        }else{
            $weeklyrecords = null;
        }
        
        if (!empty($all_weeks)){
            $all_weeks = WeeklyRecord::where('siwes_id', $siwes->id)->where('user_id', $id)->get();
        }else{
            $all_weeks = null;
        }

        if (!empty($monthlyrecords)){
            $monthlyrecords = MonthlyRecord::where('siwes_id', $siwes->id)->where('user_id', $id)->get();
        }else{
            $monthlyrecords = null;
        }
        return view('school.student_log', compact('student', 'currentdate', 'dailyrecords', 'weeklyrecords', 'all_dailys', 'monthlyrecords', 'all_weeks', 'siwes'));
    }

    public function swep200($id)
    {
        $student = Student::where('user_id', $id)->first();
        $siwes = Siwes::where('siwes_type_id', 1)->where('user_id', $id)->first();
        $currentdate = Carbon::now()->format('Y-m-d');
        $all_dailys = DailyRecord::where('siwes_id', $siwes->id)->where('user_id', $id)->orderBy('date', 'ASC')->first();
        $all_weeks = WeeklyRecord::where('siwes_id', $siwes->id)->where('user_id', $id)->first();
        $dailyrecords = DailyRecord::where('siwes_id', $siwes->id)->where('user_id', $id)->first();
        $weeklyrecords = WeeklyRecord::where('siwes_id', $siwes->id)->where('user_id', $id)->first();
        $monthlyrecords = MonthlyRecord::where('siwes_id', $siwes->id)->where('user_id', $id)->first();

        if (!empty($all_dailys)){
            $all_dailys = DailyRecord::where('siwes_id', $siwes->id)->where('user_id', $id)->orderBy('date', 'ASC')->get();
        }else{
            $all_dailys = null;
        }

        if (!empty($dailyrecords)){
            $dailyrecords = DailyRecord::where('siwes_id', $siwes->id)->where('user_id', $id)->orderBy('date', 'ASC')->get();
        }else{
            $dailyrecords = null;
        }
        
        if (!empty($weeklyrecords)){
            $weeklyrecords = WeeklyRecord::where('siwes_id', $siwes->id)->where('user_id', $id)->orderBy('created_at', 'ASC')->get();
        }else{
            $weeklyrecords = null;
        }
        
        if (!empty($all_weeks)){
            $all_weeks = WeeklyRecord::where('siwes_id', $siwes->id)->where('user_id', $id)->get();
        }else{
            $all_weeks = null;
        }

        if (!empty($monthlyrecords)){
            $monthlyrecords = MonthlyRecord::where('siwes_id', $siwes->id)->where('user_id', $id)->get();
        }else{
            $monthlyrecords = null;
        }
        return view('school.student_log', compact('student', 'currentdate', 'dailyrecords', 'weeklyrecords', 'all_dailys', 'monthlyrecords', 'all_weeks', 'siwes'));
    }


    public function student($id)
    {
        $student = Student::where('user_id', $id)->first();
        // $org = Organization::where('user_id', $id)->first();
        return view('school.student', compact('student'));
    }

    public function students($session_id, $siwes_type_id)
    {
        $staff = Staff::where('user_id', Auth::user()->id)->first();
        // $students = Student::where('department', $staff->department)->get();
        
        $session = Session::where('id', $session_id)->first();
        $siwes_type = SiwesType::where('id', $siwes_type_id)->first();
        $siwes = Siwes::where('session_id', $session_id)->where('siwes_type_id', $siwes_type_id)->with('user', 'student', 'org')->get();
        $filtered = $siwes->reject(function ($value, $key) {
            $staff = Staff::where('user_id', Auth::user()->id)->first();
            return $value->student->department != $staff->department;
        });
        // dd($filtered);
        return view('school.all_students', compact('staff', 'session', 'siwes_type', 'filtered'));
    }
    // To validate the inputs
    // private function validateRequest(){
    //     return request()->validate([
    //         'role_id'=> 'required|integer',
    //         'email' => 'required|email|max:50|unique:users',
    //         'last_name' => 'required|string|max:100',
    //         'first_name' => 'required|string|max:100',
    //         'contact_no'=> 'required|digits_between:9,16',
    //         'gender'=> 'required|string|max:20',
    //         'password' => 'required|string|min:8|confirmed',
    //         'profile_pic' => 'required',
    //     ]);
    // }
    // $data = [
    //     'session' => $session,
    //     'siwes_type' => $siwes_type,
    //     // 'students' => $students,
    //     'siwes' => $filtered
    // ];
    // return Response::json($data, 200);
}

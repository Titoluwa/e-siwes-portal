<?php

namespace App\Http\Controllers;

use App\Itf;
use App\Staff;
use App\Session;
use App\Student;
use Carbon\Carbon;
use App\DailyRecord;
use App\Organization;
use App\WeeklyRecord;
use App\MonthlyRecord;
use App\OrgSupervisor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class AdminController extends Controller
{
    // Middleware for ITCU ADMIN activites
    public function __construct()
    {
        $this->middleware('admin')->except(['org_details']);
    }

    public function index()
    {
        $current_session = Session::where('status', 1)->first();

        return view('admin.index', compact('current_session'));
    }
    public function setup()
    {
        $id = Auth::user()->id;
        // $current_year = Carbon::now()->year;
        // $previous_year = (int)$current_year-1; 
        $sessions = Session::orderBy('id', 'DESC')->get();
        $current_session = Session::where('status', 1)->first();

        return view('admin.setup', compact('sessions', 'current_session'));
    }
    public function students()
    {
        $current_session = Session::where('status', 1)->first();
        // $students = Student::where('session_id', $current_session->id)->get();
        // $studs = Student::where('session_id', $current_session->id)->first();
        $studs = Student::first();
        $students = Student::all();
        $faculty = DB::table('departments')->selectRaw('faculty')->groupBy('faculty')->get();

        return view('admin.students', compact('students', 'studs', 'faculty', 'current_session'));
    }
    public function staffs()
    {
        $staff = Staff::first();
        $staffs = Staff::all();
        $current_session = Session::where('status', 1)->first();
        $faculty = DB::table('departments')->selectRaw('faculty')->groupBy('faculty')->get(); 

        return view('admin.staffs', compact('staff', 'staffs', 'current_session', 'faculty'));
    }
    public function organizations()
    {
        $orgs = Organization::first();
        $organizations = Organization::where('status', 1)->get();
        $current_session = Session::where('status', 1)->first();
        // dd($orgs);

        return view('admin.orgs', compact('orgs', 'organizations', 'current_session'));
    }
    public function org_details($id)
    {
        $org = Organization::where('id', $id)->first();
        $staff = OrgSupervisor::where('org_id', $id)->get();
        $students = Student::where('org_id', $id)->get();
        
        $data = [
            'org' => $org,
            'staff' => $staff,
            'students' => $students
        ];
        return Response::json($data, 200);
    }

    public function itf_agents()
    {
        $itf = Itf::first();
        $itfs = Itf::all();
        $current_session = Session::where('status', 1)->first();

        return view('admin.itf', compact('itf', 'itfs', 'current_session'));
    }

    //Students
    public function view_student($id)
    {
        $current_session = Session::where('status', 1)->first();
        $student = Student::where('user_id', $id)->where('session_id', $current_session->id)->first();
        // $student = Student::where('user_id', $id)->first();
        $faculty = DB::table('departments')->selectRaw('faculty')->groupBy('faculty')->get();
        // dd($current_session);

        return view('admin.view_student', compact('student', 'current_session', 'faculty'));
    }

    public function student_log($id)
    {
        $current_session = Session::where('status', 1)->first();
        $student = Student::where('user_id', $id)->first();
        $orgs = Organization::all();
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

        return view('admin.student_log', compact('current_session', 'student', 'orgs', 'currentdate', 'dailyrecords', 'weeklyrecords', 'all_dailys', 'monthlyrecords', 'all_weeks'));
    }
    
    public function get_staff($id)
    {
        $staff  = Staff::where('id', $id)->first();
        $students = Student::where('staff_id', $id)->get();
        $data = [
            'staff' => $staff,
            'students' => $students
        ];
        return Response::json($data, 200);
    }

    public function get_students()
    {
        // $staff  = Staff::where('id', $id)->first();
        $students = Student::whereNull('staff_id')->whereNotNull('org_id')->get();
        $data = [
            // 'staff' => $staff,
            'students' => $students
        ];
        return Response::json($data, 200);
    }

    public function assign_student_to_staff(Request $request)
    {
        foreach ($request->student_id as $student => $id) {
            $student = Student::where('id', $id)->first();
            $student->staff_id = $request->staff_id;
            $student->update();
        }
        return response()->json(['status'=>"Student(s) Assigned!"]);

    }
    
}

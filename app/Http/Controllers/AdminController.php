<?php

namespace App\Http\Controllers;

use App\User;
use App\Siwes;
use App\Staff;
use App\Session;
use App\Student;
use App\Material;
use App\SiwesType;
use Carbon\Carbon;
use App\Department;
use App\DailyRecord;
use App\Announcement;
use App\Organization;
use App\WeeklyRecord;
use App\MonthlyRecord;
use App\OrgSupervisor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class AdminController extends Controller
{
    // Middleware for ITCU ADMIN activites
    public function __construct()
    {
        $this->middleware('admin')->except(['org_details', 'material_download', 'post_announcement']);
    }

    public function index()
    {
        $current_session = Session::where('status', 1)->first();
        $sessions = Session::orderBy('id', 'DESC')->get();

        return view('admin.index', compact('current_session', 'sessions'));
    }
    public function setup()
    {
        $id = Auth::user()->id; 
        $sessions = Session::orderBy('id', 'DESC')->get();
        $current_session = Session::where('status', 1)->first();

        return view('admin.setup', compact('sessions', 'current_session'));
    }
    public function siwes400Students()
    {
        $current_session = Session::where('status', 1)->first();
        $sessions = Session::orderBy('id', 'DESC')->get();
        $s_siwes = Siwes::where('session_id', $current_session->id)->where('siwes_type_id',3)->first();
        if (!empty($s_siwes)) {
            $siwes = Siwes::where('session_id', $current_session->id)->where('siwes_type_id',3)->get();
        }
        else{
            $siwes = null;
        }
        $staffs = Staff::all();
        
        return view('admin.assign_student', compact('staffs', 's_siwes', 'siwes', 'current_session', 'sessions'));
    }
    public function students()
    {
        $current_session = Session::where('status', 1)->first();
        $sessions = Session::orderBy('id', 'DESC')->get();
        $studs = Student::first();
        // $students = User::where('role_id', 2)->get();
        $students = Student::all();

        $faculty = DB::table('departments')->selectRaw('faculty')->groupBy('faculty')->get();

        return view('admin.students', compact('students', 'studs', 'faculty', 'current_session', 'sessions'));
    }
    
    public function staffs()
    {
        $sessions = Session::orderBy('id', 'DESC')->get();
        $staff = Staff::first();
        $staffs = Staff::all();
        $current_session = Session::where('status', 1)->first();
        $faculty = DB::table('departments')->selectRaw('faculty')->groupBy('faculty')->get(); 

        return view('admin.staffs', compact('staff', 'staffs', 'current_session', 'faculty','sessions'));
    }
    public function organizations()
    {
        $sessions = Session::orderBy('id', 'DESC')->get();
        $supervisors = OrgSupervisor::all();
        $orgs = Organization::first();
        $organizations = Organization::where('status', 1)->get();
        $current_session = Session::where('status', 1)->first();

        return view('admin.orgs', compact('orgs', 'organizations', 'current_session', 'sessions', 'supervisors'));
    }
    public function org_details($id)
    {
        $current_session = Session::where('status', 1)->first();
        $org = Organization::where('id', $id)->first();
        $staff = OrgSupervisor::where('org_id', $id)->get();
        $siwes = Siwes::where('session_id', $current_session->id)->where('org_id', $id)->with('user', 'student', 'siwes_type')->get();
        
        $data = [
            'org' => $org,
            'staff' => $staff,
            'students' => $siwes
        ];
        return Response::json($data, 200);
    }

    // public function itf_agents()
    // {
    //     $sessions = Session::orderBy('id', 'DESC')->get();
    //     $itf = Itf::first();
    //     $itfs = Itf::all();
    //     $current_session = Session::where('status', 1)->first();
    //     return view('admin.itf', compact('itf', 'itfs', 'current_session', 'sessions'));
    // }

    //Students
    public function view_student($id)
    {
        $sessions = Session::orderBy('id', 'DESC')->get();
        $current_session = Session::where('status', 1)->first();
        // $student = Student::where('user_id', $id)->where('session_id', $current_session->id)->first();
        $student = Student::where('user_id', $id)->first();
        $faculty = DB::table('departments')->selectRaw('faculty')->groupBy('faculty')->get();
        $s_siwes = Siwes::where('user_id', $id)->whereNotNull('org_id')->first();
        $siwes = Siwes::where('user_id', $id)->whereNotNull('org_id')->get();

        // dd($current_session);

        return view('admin.view_student', compact('student', 'current_session', 'faculty', 's_siwes', 'siwes', 'sessions'));
    }
    
    public function placement300perSession($session_id)
    {
        // $current_session = Session::where('id', $session_id)->first();
        // $siwes = Siwes::where('session_id', $current_session->id)->where('siwes_type_id', 2)->whereNotNull('org_id')->with('user','student', 'org')->get();
        // $data = [
        //     'session' => $current_session,
        //     'siwes' => $siwes
        // ];
        // return Response::json($data, 200);
        $sessions = Session::orderBy('id', 'DESC')->get();
        $current_session = Session::where('id', $session_id)->first();
        $s_siwes = Siwes::where('session_id', $session_id)->where('siwes_type_id', 2)->whereNotNull('org_id')->first();
        $siwes = Siwes::where('session_id', $session_id)->where('siwes_type_id', 2)->whereNotNull('org_id')->get();

        return view('admin.placement', compact('current_session', 'sessions', 's_siwes', 'siwes'));
    }
    public function placement400perSession($session_id)
    {
        $sessions = Session::orderBy('id', 'DESC')->get();
        $current_session = Session::where('id', $session_id)->first();
        $s_siwes = Siwes::where('session_id', $session_id)->where('siwes_type_id', 3)->whereNotNull('org_id')->first();
        $siwes = Siwes::where('session_id', $session_id)->where('siwes_type_id', 3)->whereNotNull('org_id')->get();

        return view('admin.placement', compact('current_session', 'sessions', 's_siwes', 'siwes'));
    }
    public function swep200perSession($session_id)
    {
        $sessions = Session::orderBy('id', 'DESC')->get();
        $current_session = Session::where('id', $session_id)->first();
        $s_siwes = Siwes::where('session_id', $session_id)->where('siwes_type_id', 1)->first();
        $siwes = Siwes::where('session_id', $session_id)->where('siwes_type_id', 1)->get();

        return view('admin.placement', compact('current_session', 'sessions', 's_siwes', 'siwes'));
    }

    public function student_log($id)
    {
        $sessions = Session::orderBy('id', 'DESC')->get();
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

        return view('admin.student_log', compact('current_session', 'student', 'orgs', 'currentdate', 'dailyrecords', 'weeklyrecords', 'all_dailys', 'monthlyrecords', 'all_weeks', 'sessions'));
    }
    public function siwes400($id)
    {
        $sessions = Session::orderBy('id', 'DESC')->get();
        $student = Student::where('user_id', $id)->first();
        $siwes_type = SiwesType::where('id', 3)->first();
        $siwes = Siwes::where('siwes_type_id', 3)->where('user_id', $id)->first();
        $currentdate = Carbon::now()->format('Y-m-d');
        
        if (!empty($siwes)){
            $all_dailys = DailyRecord::where('siwes_id', $siwes->id)->where('user_id', $id)->orderBy('date', 'ASC')->first();
            $all_weeks = WeeklyRecord::where('siwes_id', $siwes->id)->where('user_id', $id)->first();
            $dailyrecords = DailyRecord::where('siwes_id', $siwes->id)->where('user_id', $id)->first();
            $weeklyrecords = WeeklyRecord::where('siwes_id', $siwes->id)->where('user_id', $id)->first();
            $monthlyrecords = MonthlyRecord::where('siwes_id', $siwes->id)->where('user_id', $id)->first();
        }else{
            $all_dailys = null;
            $all_weeks = null;
            $dailyrecords = null;
            $weeklyrecords = null;
            $monthlyrecords = null;
        }

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
        return view('admin.student_log', compact('student', 'currentdate', 'dailyrecords', 'weeklyrecords', 'all_dailys', 'monthlyrecords', 'all_weeks', 'siwes', 'siwes_type', 'sessions'));
    }
    public function siwes300($id)
    {
        $sessions = Session::orderBy('id', 'DESC')->get();
        $student = Student::where('user_id', $id)->first();
        $siwes_type = SiwesType::where('id', 2)->first();
        $siwes = Siwes::where('siwes_type_id', 2)->where('user_id', $id)->first();
        if (!empty($siwes)){
            $all_dailys = DailyRecord::where('siwes_id', $siwes->id)->where('user_id', $id)->orderBy('date', 'ASC')->first();
            $all_weeks = WeeklyRecord::where('siwes_id', $siwes->id)->where('user_id', $id)->first();
            $dailyrecords = DailyRecord::where('siwes_id', $siwes->id)->where('user_id', $id)->first();
            $weeklyrecords = WeeklyRecord::where('siwes_id', $siwes->id)->where('user_id', $id)->first();
            $monthlyrecords = MonthlyRecord::where('siwes_id', $siwes->id)->where('user_id', $id)->first();
        }else{
            $all_dailys = null;
            $all_weeks = null;
            $dailyrecords = null;
            $weeklyrecords = null;
            $monthlyrecords = null;
        }
        $currentdate = Carbon::now()->format('Y-m-d');

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
        return view('admin.student_log', compact('student', 'currentdate', 'dailyrecords', 'weeklyrecords', 'all_dailys', 'monthlyrecords', 'all_weeks', 'siwes', 'siwes_type', 'sessions'));
    }
    public function swep200($id)
    {
        $sessions = Session::orderBy('id', 'DESC')->get();
        $student = Student::where('user_id', $id)->first();
        $siwes_type = SiwesType::where('id', 1)->first();
        $siwes = Siwes::where('siwes_type_id', 1)->where('user_id', $id)->first();
        $currentdate = Carbon::now()->format('Y-m-d');
        if (!empty($siwes)){
            $all_dailys = DailyRecord::where('siwes_id', $siwes->id)->where('user_id', $id)->orderBy('date', 'ASC')->first();
            $all_weeks = WeeklyRecord::where('siwes_id', $siwes->id)->where('user_id', $id)->first();
            $dailyrecords = DailyRecord::where('siwes_id', $siwes->id)->where('user_id', $id)->first();
            $weeklyrecords = WeeklyRecord::where('siwes_id', $siwes->id)->where('user_id', $id)->first();
            $monthlyrecords = MonthlyRecord::where('siwes_id', $siwes->id)->where('user_id', $id)->first();
        }else{
            $all_dailys = null;
            $all_weeks = null;
            $dailyrecords = null;
            $weeklyrecords = null;
            $monthlyrecords = null;
        }

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
        return view('admin.student_log', compact('sessions', 'student', 'currentdate', 'dailyrecords', 'weeklyrecords', 'all_dailys', 'monthlyrecords', 'all_weeks', 'siwes', 'siwes_type'));
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

    public function assign_student_to_staff(Request $request)
    {
        foreach ($request->siwes_id as $siwes => $id) 
        {
            $siwes = Siwes::where('id', $id)->first();
            $siwes->assigned_staff_id = $request->staff_id;
            $siwes->update();
        }
        return response()->json(['status'=>"Student(s) Assigned!"]);
    }
    public function contacts()
    {
        $sessions = Session::orderBy('id', 'DESC')->get();
        $users = User::whereNotIn('role_id', [0,4])->get();

        return view('admin.contacts', compact('sessions', 'users'));
    }
    public function student200($id)
    {
        $data = Siwes::where('id', $id)->with('user')->first();
        
        return Response::json($data, 200);
    }
    public function edit_itcu_score(Request $request)
    {
        Siwes::where('id', $request->swep_id)->update(['itcu_score'=> $request->score]);

        return back()->with('success', "Score Updated Successfully!");
    }
    public function materials()
    {
        $sessions = Session::orderBy('id', 'DESC')->get();
        $siwes_types = SiwesType::all();
        $material = Material::orderBy('id', 'DESC')->first();
        $materials = Material::all();

        return view('admin.materials', compact('sessions', 'siwes_types', 'material', 'materials'));
    }
    public function announce()
    {
        $sessions = Session::orderBy('id', 'DESC')->get();
        $departments = DB::table('departments')->select('department')->groupBy('department')->get();
        $announcement = Announcement::where('uploaded_by', Auth::user()->id)->orderBy('id', 'DESC')->first();
        $announcements = Announcement::where('uploaded_by', Auth::user()->id)->orderBy('updated_at', 'DESC')->get();

        return view('admin.announce', compact('sessions', 'departments', 'announcement', 'announcements'));
    }
    public function post_announcement(Request $request)
    {
        $announce = Announcement::create($request->all());
        $announce->save();

        return back()->with('success', "<b>$announce->title</b> Posted Successfully!!");
    }
    public function store_material(Request $request)
    {
        $material = Material::create($request->all());
        $material->file = $request->file('file')->store('materials', 'public');
        $material->name = $request->file('file')->getClientOriginalName();
        $material->save();

        return back()->with('success', "<b>$material->name</b>  Uploaded Successfully!!");
    }

    public function material_download($file)
    {
        $material = Material::where('id', $file)->first();
        if ($material == null)
        {
            $exists = false;
        }else
        {
            $exists = Storage::disk('public')->exists($material->file);
        }
        if ($exists) {
            // $path = Storage::disk('public')->path($material->file);
           return Storage::disk('public')->download($material->file, $material->name);
        //    return back()->with('success', 'Download Successfully!!');
        } else {
            // return redirect('/404');
            return back()->with('deleted', 'Document Not Found');
        } 
    }
    public function dept_create()
    {
        $dept = Department::all();
        $sessions = Session::orderBy('id', 'DESC')->get();
        return view('admin.department', compact('dept', 'sessions'));
    }
    public function dept_store(Request $request)
    {
        $dept = new Department();
        $dept->course_study = $request->course_study;
        $dept->faculty = $request->faculty;
        $dept->department = $request->department;
        $dept->save();

        return back()->with('success',"<b>$request->course_study</b> has been added!");
    }
}
// $exists = Storage::disk('public')->dow($material->file);
// return Storage::download($material->file);
// dd('filename');
// $path = public_path($material->file);
// dd($exists);
// return response()->download($path);
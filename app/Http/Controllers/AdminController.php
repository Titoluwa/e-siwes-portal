<?php

namespace App\Http\Controllers;

use App\User;
use App\Form8;
use App\Siwes;
use App\Staff;
use Exception;
use App\Session;
use App\Student;
use App\Swep200;
use App\Material;
use App\SiwesType;
use Carbon\Carbon;
use App\Department;
use App\DailyRecord;
use App\Announcement;
use App\Organization;
use App\WeeklyRecord;
use App\MonthlyRecord;
use App\OrgAssessment;
use App\OrgSupervisor;
use App\SiwesAssessment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Imports\Swep200Import;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
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
        $depts = DB::table('departments')->selectRaw('department')->groupBy('department')->get(); 

        return view('admin.staffs', compact('staff', 'staffs', 'current_session', 'faculty','sessions', 'depts'));
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
        $depts = DB::table('departments')->selectRaw('department')->groupBy('department')->get();
        $courses = DB::table('departments')->selectRaw('course_study')->get();

        // dd($current_session);

        return view('admin.view_student', compact('student', 'current_session', 'faculty', 's_siwes', 'siwes', 'sessions', 'depts', 'courses'));
    }
    
    public function updateStaff(Request $request)
    {
            // dd($request->all());
            $user = User::where('id', $request->id)->first();
            $staff = Staff::where('user_id', $request->id)->first();
    
            $user->last_name = Str::ucfirst($request->last_name);
            $user->first_name = Str::ucfirst($request->first_name);
            $user->middle_name = Str::ucfirst($request->middle_name);
            $user->gender = ($request->gender);
            // $user->contact_no = ($request->contact_no);
            if ($request->hasFile('profile_pic')){
                $user->profile_pic = $request->file('profile_pic')->store('profile_pics', 'public');
            }
    
            $staff->faculty = ($request->faculty);
            $staff->department = ($request->department);
            if ($request->hasFile('signature')){
                $staff->signature = $request->file('signature')->store('signatures', 'public');
            }
    
            $user->update();
            $staff->update();
    
            return back()->with('success', "<b>$user->last_name</b> Profile Updated Successfully");
    }
    public function studentProfileUpdate(Request $request)
    {
        // dd($request->all());
        $user = User::where('id', $request->id)->first();
        $student = Student::where('user_id', $request->id)->first();

        $user->last_name = Str::ucfirst($request->last_name);
        $user->first_name = Str::ucfirst($request->first_name);
        $user->middle_name = Str::ucfirst($request->middle_name);
        $user->gender = ($request->gender);
        // $user->contact_no = ($request->contact_no);
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

        return back()->with('success', "<b>$user->last_name</b> Profile Updated Successfully");
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

    // public function student_log($id)
    // {
    //     $sessions = Session::orderBy('id', 'DESC')->get();
    //     $current_session = Session::where('status', 1)->first();
    //     $student = Student::where('user_id', $id)->first();
    //     $orgs = Organization::all();
    //     $currentdate = Carbon::now()->format('Y-m-d');
    //     $all_dailys = DailyRecord::where('user_id', $id)->orderBy('date', 'ASC')->first();
    //     $all_weeks = WeeklyRecord::where('user_id', $id)->first();
    //     $dailyrecords = DailyRecord::where('user_id', $id)->first();
    //     $weeklyrecords = WeeklyRecord::where('user_id', $id)->first();
    //     $monthlyrecords = MonthlyRecord::where('user_id', $id)->first();

    //     if (!empty($all_dailys)){
    //         $all_dailys = DailyRecord::where('user_id', $id)->orderBy('date', 'ASC')->get();
    //     }else{
    //         $all_dailys = null;
    //     }

    //     if (!empty($dailyrecords)){
    //         $dailyrecords = DailyRecord::where('user_id', $id)->orderBy('date', 'ASC')->get();
    //     }else{
    //         $dailyrecords = null;
    //     }
        
    //     if (!empty($weeklyrecords)){
    //         $weeklyrecords = WeeklyRecord::where('user_id', $id)->orderBy('created_at', 'ASC')->get();
    //     }else{
    //         $weeklyrecords = null;
    //     }
        
    //     if (!empty($all_weeks)){
    //         $all_weeks = WeeklyRecord::where('user_id', $id)->get();
    //     }else{
    //         $all_weeks = null;
    //     }

    //     if (!empty($monthlyrecords)){
    //         $monthlyrecords = MonthlyRecord::where('user_id', $id)->get();
    //     }else{
    //         $monthlyrecords = null;
    //     }

    //     return view('admin.student_log', compact('current_session', 'student', 'orgs', 'currentdate', 'dailyrecords', 'weeklyrecords', 'all_dailys', 'monthlyrecords', 'all_weeks', 'sessions'));
    // }
    public function siwes400($id)
    {
        $sessions = Session::orderBy('id', 'DESC')->get();
        $student = Student::where('user_id', $id)->first();
        $siwes_type = SiwesType::where('id', 3)->first();
        $siwes = Siwes::where('siwes_type_id', 3)->where('user_id', $id)->first();
        $currentdate = Carbon::now()->format('Y-m-d');
        if (!empty($siwes) AND $siwes->org_id == 1) {
            return abort(404);
        }else{

            if (!empty($siwes)){
                $all_dailys = DailyRecord::where('siwes_id', $siwes->id)->where('user_id', $id)->orderBy('date', 'ASC')->first();
                $all_weeks = WeeklyRecord::where('siwes_id', $siwes->id)->where('user_id', $id)->first();
                $dailyrecords = DailyRecord::where('siwes_id', $siwes->id)->where('user_id', $id)->first();
                $weeklyrecords = WeeklyRecord::where('siwes_id', $siwes->id)->where('user_id', $id)->first();
                $monthlyrecords = MonthlyRecord::where('siwes_id', $siwes->id)->where('user_id', $id)->first();
                $form8 = Form8::where('siwes_id', $siwes->id)->first();
                $dept_coord = Staff::where('department', $siwes->department())->first();
                $industry_supervisor = OrgSupervisor::where('org_id', $siwes->org_id)->first();
                $assessment = SiwesAssessment::where('siwes_id', $siwes->id)->first();
                $orgassessment = OrgAssessment::where('siwes_id', $siwes->id)->first();
            }else{
                $all_dailys = null;
                $all_weeks = null;
                $dailyrecords = null;
                $weeklyrecords = null;
                $monthlyrecords = null;
                $form8 = null;
                $dept_coord = null;
                $industry_supervisor = null;
                $assessment = null;
                $orgassessment = null;
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
            return view('admin.student_log', compact('orgassessment', 'assessment', 'form8', 'industry_supervisor', 'student', 'currentdate', 'dailyrecords', 'weeklyrecords', 'all_dailys', 'monthlyrecords', 'all_weeks', 'siwes', 'siwes_type', 'sessions', 'dept_coord'));
        }
    }
    public function siwes300($id)
    {
        $sessions = Session::orderBy('id', 'DESC')->get();
        $student = Student::where('user_id', $id)->first();
        $siwes_type = SiwesType::where('id', 2)->first();
        $siwes = Siwes::where('siwes_type_id', 2)->where('user_id', $id)->first();
        if (!empty($siwes) AND $siwes->org_id == 1) {
            return abort(404);
        }else{
        
            if (!empty($siwes)){
                $all_dailys = DailyRecord::where('siwes_id', $siwes->id)->where('user_id', $id)->orderBy('date', 'ASC')->first();
                $all_weeks = WeeklyRecord::where('siwes_id', $siwes->id)->where('user_id', $id)->first();
                $dailyrecords = DailyRecord::where('siwes_id', $siwes->id)->where('user_id', $id)->first();
                $weeklyrecords = WeeklyRecord::where('siwes_id', $siwes->id)->where('user_id', $id)->first();
                $monthlyrecords = MonthlyRecord::where('siwes_id', $siwes->id)->where('user_id', $id)->first();
                $dept_coord = Staff::where('department', $siwes->department())->first();
                $industry_supervisor = OrgSupervisor::where('org_id', $siwes->org_id)->first();
                $assessment = SiwesAssessment::where('siwes_id', $siwes->id)->first();
                $orgassessment = OrgAssessment::where('siwes_id', $siwes->id)->first();
            }else{
                $all_dailys = null;
                $all_weeks = null;
                $dailyrecords = null;
                $weeklyrecords = null;
                $monthlyrecords = null;
                $dept_coord = null;
                $industry_supervisor = null;
                $assessment = null;
                $orgassessment = null;
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
            return view('admin.student_log', compact('orgassessment', 'assessment','industry_supervisor', 'dept_coord', 'student', 'currentdate', 'dailyrecords', 'weeklyrecords', 'all_dailys', 'monthlyrecords', 'all_weeks', 'siwes', 'siwes_type', 'sessions'));
        }
    }
    public function swep200($id)
    {
        $sessions = Session::orderBy('id', 'DESC')->get();
        $student = Student::where('user_id', $id)->first();
        $siwes_type = SiwesType::where('id', 1)->first();
        $siwes = Siwes::where('siwes_type_id', 1)->where('user_id', $id)->first();
        $currentdate = Carbon::now()->format('Y-m-d');
        $dept_coord = Staff::where('department', $student->department)->first();

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
        return view('admin.student_log', compact('dept_coord', 'sessions', 'student', 'currentdate', 'dailyrecords', 'weeklyrecords', 'all_dailys', 'monthlyrecords', 'all_weeks', 'siwes', 'siwes_type'));
    }
    public function get_staff($id)
    {
        $current_session = Session::where('status', 1)->first();
        $staff  = Staff::where('id', $id)->first();
        $students = Siwes:: where('session_id', $current_session->id)->where('assigned_staff_id', $id)->with('student', 'user', 'org')->get();
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
    public function uploadResult(Request $request)
    {
        try{
            $file = $request->file('file');
            $fileContents = file($file->getPathname());

            foreach ($fileContents as $line) {
                $data = str_getcsv($line);
                Siwes::where('siwes_type_id', 1)
                    ->join('students', 'siwes.student_id','=','students.id')
                    ->where('matric_no', $data[0])
                    ->update(['itcu_score' => $data[1]]);
            }
            return redirect()->back()->with('success', 'Result file uploaded successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error encountered while uploading Result File');
        }
        // try {
        //     \DB::beginTransaction();
        //     if ($request->hasFile('file')) {
        //         $file = $request->file('file');
        //         $collection = (new Swep200Import)->collection($file);
        //         dd($collection);
        //         // dd('here');
        //         // Excel::import(new Swep200Import, $request->file('file'));
        //         $file = $request->file('file');
        //         $path = $request->file('file')->getRealPath();
        //         $import = Swep200::all();

        //         $data = Excel::import(new Swep200Import, $path);

        //         dd($data);
        //         // $import = new Swep200Import; // Replace YourImportClass with your actual import class
        //         // $data = Excel::toCollection($file)->get(); // Get collection of data from Excel file

        //         // Loop through the data to update the database
        //         foreach ($data as $row) {
        //             // Assuming the first column contains IDs and the second column contains new values
        //             $id = $row[0]; // Get the ID from the Excel file
        //             $newValue = $row[1]; // Get the new value from the Excel file

        //             // Retrieve the corresponding record from the database
        //             $record = Swep200::where('matric_number', $id)->first(); // Replace YourModel with your actual model name

        //             if ($record) {
        //                 // Update the specific field in the database
        //                 $record->update(['itcu_score' => $newValue]);
        //             }
        //         }
        //     }
        //     \DB::commit();
        //     return redirect()->back()->with('success', 'Result file uploaded successfully.');
        // } catch (Exception $e) {
        //     \DB::rollback();
        //     return redirect()->back()->with('error', 'Error Encountered While uploading Result File');
        // }
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
    public function get_notice($id)
    {
        $notice = Announcement::where('id', $id)->first();

        return response()->json($notice);
    }
    public function edit_notice(Request $request)
    {
        $notice = Announcement::where('id', $request->id)->first();
        $notice->title = $request->title;
        $notice->department = $request->department;
        $notice->content = $request->content;
        $notice->update();

        return back()->with('success', "<b>$notice->title</b> Updated Successfully!!");
    }
    public function delete_notice($id)
    {
        $notice = Announcement::findorFail($id);
        $notice->delete();
        
        return response()->json(['status'=>"Notice Deleted Successfully!"]);
    }
    public function store_material(Request $request)
    {
        $material = Material::create($request->all());
        $material->file = $request->file('file')->store('materials', 'public');
        $material->name = $request->file('file')->getClientOriginalName();
        $material->save();

        return back()->with('success', "<b>$material->name</b>  Uploaded Successfully!!");
    }

    public function delete_material($id)
    {
        $notice = Material::findorFail($id);
        $notice->delete();
        
        return response()->json(['status'=>"Material Deleted Successfully!"]);
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
            return back()->with('error', 'Document Not Found');
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
    public function deactivateUser($id)
    {
        User::where('id', $id)->update(['status'=> 0]);

        return response()->json(['status'=>"User DEACTIVATED Successfully!"]);
    }
    public function activateUser($id)
    {
        User::where('id', $id)->update(['status'=> 1]);

        return response()->json(['status'=>"User ACTIVATED Successfully!"]);
    }
    public function logoutUser($id)
    {
        User::where('id', $id)->update(['logged'=> 0, 'last_login'=> Carbon::now()]);

        return response()->json(['status'=>"User LOGGED OUT Successfully!"]);
    }
}
// $exists = Storage::disk('public')->dow($material->file);
// return Storage::download($material->file);
// dd('filename');
// $path = public_path($material->file);
// dd($exists);
// return response()->download($path);
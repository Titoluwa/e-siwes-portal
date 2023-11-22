<?php

namespace App\Http\Controllers;

use App\User;
use App\Form8;
use App\Siwes;
use App\Session;
use App\Student;
use App\SiwesType;
use Carbon\Carbon;
use App\DailyRecord;
use App\VerifyToken;
use App\Organization;
use App\WeeklyRecord;
use App\MonthlyRecord;
use App\OrgAssessment;
use App\OrgSupervisor;
use App\SiwesAssessment;
use App\Mail\Registration;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
// use Symfony\Component\HttpKernel\Event\ViewEvent;

class IndustryController extends Controller
{
        // Middleware for Industry Supervisor activites excepts initial registration
    public function __construct()
    {
        $this->middleware('industry')->except(['create', 'store']);
    }
        // Show the registraton form for the industry supervisor user
    public function create()
    {
        return view('industry.register');
    }
        // Store the inputed information of the industry supervisor user
    public function store(Request $request)
    {
        try {
            DB::commit();
                // Adding New User 
                // $user = User::create($this->validateRequest());
                $user = new User();
                $user->role_id = 3;
                $user->email = $request->email;
                $user->last_name = Str::ucfirst($request->last_name);
                $user->first_name = Str::ucfirst($request->first_name);
                $user->middle_name = Str::ucfirst($request->middle_name);
                $user->contact_no = $request->contact_no;
                $user->gender = $request->gender;
                if ($request->hasFile('signature')){
                    $user->signature = $request->file('signature')->store('signatures', 'public');
                }
                $user->password = Hash::make($request->password);
                if ($request->hasFile('profile_pic')){
                    $user->profile_pic = $request->file('profile_pic')->store('profile_pics', 'public');
                }
                $user->save();

                // Adding Institution Supervisor Details
                $supervisor = new OrgSupervisor();
                // $supervisor = OrgSupervisor::create($this->nextvalidateRequest());
                $supervisor->user_id = $user->id;
                $supervisor->staff_id = $request->staff_id;
                $supervisor->department = $request->department;
                if ($request->hasFile('signature')){
                    $supervisor->signature = $request->file('signature')->store('signatures', 'public');
                }
                $supervisor->save();
                
                $token = 'ESP-'.(rand(100000, 999999));
                $verification = new VerifyToken();
                $verification->user_id = $user->id;
                $verification->token = $token;
                $verification->email = $user->email;
                $verification->save();

                Mail::to($user->email)->send(new Registration($user, $token));

                if (Auth::user()) {
                    return redirect('/admin/industry')->with('success', "Successfully Registered! Verification token sent to <b>$request->email</b>"); 
                } else {
                    // return redirect('/verification')->with('success', 'Successfully Registered! Verify your account to log in');
                    return redirect('/verification')->with('success', "Successfully Registered! Verification token sent to <b>$request->email</b>");
                    // return redirect('login')->with('success', 'Verify your email before login. Go check your inbox!');
                } 

                // return redirect('login');
           
            
        } catch(\Exception $e){
            DB::rollback();
            return $e;
        }
    }
        // To validate the inputs
    // private function validateRequest()
    // {
    //     return request()->validate([
    //         'role_id',
    //         'email' => 'required|email|max:50|unique:users',
    //         'last_name' => 'required|string|max:100',
    //         'first_name' => 'required|string|max:100',
    //         'middle_name',
    //         'contact_no'=> 'required|digits_between:9,16',
    //         'gender'=> 'required|string|max:100',
    //         'password' => 'required|string|min:8|confirmed',
    //         'profile_pic' => 'required',
    //     ]);
    // }
    // private function nextvalidateRequest()
    // {
    //     return request()->validate([
    //         'staff_id' => 'required',
    //         'org_id',
    //         'department',
    //         'position',
    //         'signature',
    //     ]);
    // }
        // Show IndustryUser dashboard - homepage
    public function index()
    {
        $id = Auth::user()->id;
        $current_session = Session::where('status', 1)->first();
        $org = Organization::where('user_id', $id)->first();
        if (!empty($org)){
            $s_siwes = Siwes::where('session_id', $current_session->id)->where('org_id',$org->id)->first();
            $siwes = Siwes::where('session_id', $current_session->id)->where('org_id',$org->id)->get();
        }else{
            $s_siwes = $siwes = null;
            // $students = Student::where('org_id', $org->id)->first();
        }
        $orgsup = OrgSupervisor::where('user_id', $id)->first();
        return view('industry.home', compact('orgsup', 'org', 'siwes', 's_siwes'));
    }
        // Shows the create form for organization.
    public function org()
    {
        return view('industry.org');
    }
        // Adds the all details to database
    public function org_store(Request $request)
    {
        $org = Organization::create($request->all());
        $org->name = Str::ucfirst($request->name);
        if ($request->hasFile('logo')){
            $org->logo = $request->file('logo')->store('logos', 'public');
        }
        $org->save();
        
        $org_supervisor = OrgSupervisor::where('id', Auth::user()->id)->first();
        $org_supervisor->org_id = $org->id;
        $org_supervisor->update();

        return redirect('industry')->with('success', "Ypur Organizationhas been registered Successfully!");
    }
        // Shows the edit form for organization.
    public function org_edit()
    {
        $id = Auth::user()->id;
        $org = Organization::where('user_id', $id)->first();
        return view('industry.org_edit', compact('org'));
    }
        // update the organization table
    public function org_update(Request $request)
    {
        $org = Organization::where('id', $request->id)->first();
        $org->name = $request->name;
        $org->full_address = $request->full_address;
        $org->postal_address = $request->postal_address;
        $org->year_of_est = $request->year_of_est;
        $org->nature = $request->nature;
        $org->specialization = $request->specialization;
        $org->plant_capacity = $request->plant_capacity;
        $org->other_info = $request->other_info;
        if ($request->hasFile('logo')){
            $org->logo = $request->file('logo')->store('logos', 'public');
        }
        $org->update();

        return redirect('industry')->with('success', "<b>$request->name</b> profile updated succesfully");
    }
        // Show the edit form for Industry Supervisor user
    public function profile()
    {
        $id = Auth::user()->id;
        $orgsup = OrgSupervisor::where('user_id', $id)->first();

        return view('industry.profile', compact('orgsup'));
    }
        // updates the industryuser's profile
    public function profile_update(Request $request)
    {
        // $user = User::where('id', $request->id)->first();
        // $user->last_name = Str::ucfirst($request->last_name);
        // $user->first_name = Str::ucfirst($request->first_name);
        // $user->middle_name = Str::ucfirst($request->middle_name);
        // $user->staff_id = ($request->staff_id);
        // $user->department = ($request->department);
        // $user->contact_no = ($request->contact_no);
        // if ($request->hasFile('profile_pic')){
        //     $user->profile_pic = $request->file('profile_pic')->store('profile_pics', 'public');
        // }
        // $user->update();

        // return redirect("/industry");

        $user = User::where('id', $request->id)->first();
        $supervisor = OrgSupervisor::where('user_id', $request->id)->first();
        try {
            // DB::beginTransaction();
            DB::commit();
                // Updating Industry User 
            $user->last_name = Str::ucfirst($request->last_name);
            $user->first_name = Str::ucfirst($request->first_name);
            $user->middle_name = Str::ucfirst($request->middle_name);
            $user->contact_no = $request->contact_no;
            $user->gender = $request->gender;
            $user->password = Hash::make($request->password);
            if ($request->hasFile('profile_pic')){
                $user->profile_pic = $request->file('profile_pic')->store('profile_pics', 'public');
            }
            $user->update();

            $supervisor->staff_id = $request->staff_id;
            $supervisor->department = $request->department;
            $supervisor->update();

            return redirect("/industry");
            // ->with('success', "<b>$request->name</b> profile updated succesfully");

        } catch(\Exception $e){
            DB::rollback();
            return $e;
        }
    }
    public function student($id)
    {
        $student = Student::where('user_id', $id)->first();
        
        return view('industry.student', compact('student'));
    }
    public function siwes_student($id)
    {
        $student = Siwes::where('id', $id)->with('user', 'student')->first();

        return response()->json($student);
    }
    public function siwes_log($siwes_id)
    {
        $siwes = Siwes::where('id', $siwes_id)->first();
        $org_assessment = OrgAssessment::where('siwes_id', $siwes_id)->first();
        $form8 = Form8::where('siwes_id', $siwes->id)->first();

        if (!empty($siwes)){
            $all_dailys = DailyRecord::where('siwes_id', $siwes_id)->where('user_id', $siwes->user_id)->orderBy('date', 'ASC')->first();
            $all_weeks = WeeklyRecord::where('siwes_id', $siwes_id)->where('user_id', $siwes->user_id)->first();
            $dailyrecords = DailyRecord::where('siwes_id', $siwes_id)->where('user_id', $siwes->user_id)->first();
            $weeklyrecords = WeeklyRecord::where('siwes_id', $siwes_id)->where('user_id', $siwes->user_id)->first();
            $monthlyrecords = MonthlyRecord::where('siwes_id', $siwes_id)->where('user_id', $siwes->user_id)->first();
        }else{
            $all_dailys = null;
            $all_weeks = null;
            $dailyrecords = null;
            $weeklyrecords = null;
            $monthlyrecords = null;
        }
        $student = Student::where('user_id', $siwes->user_id)->first();
        $orgs = Organization::all();
        $currentdate = Carbon::now()->format('Y-m-d');
        $all_dailys = DailyRecord::where('user_id', $siwes->user_id)->orderBy('date', 'ASC')->first();
        $all_weeks = WeeklyRecord::where('user_id', $siwes->user_id)->first();
        $dailyrecords = DailyRecord::where('user_id', $siwes->user_id)->first();
        $weeklyrecords = WeeklyRecord::where('user_id', $siwes->user_id)->first();
        $monthlyrecords = MonthlyRecord::where('user_id', $siwes->user_id)->first();

        if (!empty($all_dailys)){
            $all_dailys = DailyRecord::where('user_id', $siwes->user_id)->orderBy('date', 'ASC')->get();
        }else{
            $all_dailys = null;
        }

        if (!empty($dailyrecords)){
            $dailyrecords = DailyRecord::where('user_id', $siwes->user_id)->orderBy('date', 'ASC')->get();
        }else{
            $dailyrecords = null;
        }
        
        if (!empty($weeklyrecords)){
            $weeklyrecords = WeeklyRecord::where('user_id', $siwes->user_id)->orderBy('created_at', 'ASC')->get();
        }else{
            $weeklyrecords = null;
        }
        
        if (!empty($all_weeks)){
            $all_weeks = WeeklyRecord::where('user_id', $siwes->user_id)->get();
        }else{
            $all_weeks = null;
        }

        if (!empty($monthlyrecords)){
            $monthlyrecords = MonthlyRecord::where('user_id', $siwes->user_id)->get();
        }else{
            $monthlyrecords = null;
        }

        return view('industry.student_log', compact('siwes', 'orgs', 'currentdate', 'dailyrecords', 'weeklyrecords', 'all_dailys', 'monthlyrecords', 'all_weeks', 'org_assessment', 'form8'));
    }

    public function approve_week($id)
    {
        $sup_id = Auth::user()->id;

        $weeklyrecord = WeeklyRecord::where('id', $id)->first();
        $weeklyrecord->org_sup_approval = 1;
        $weeklyrecord->org_sup_id = $sup_id;
        $weeklyrecord->update();

        return response()->json(['status'=>"Marked As Seen!!"]);
    }

    public function comment_monthly(Request $request)
    {

        $sup_id = Auth::user()->id;

        $monthlyrecord = MonthlyRecord::where('id', $request->id)->first();
        $monthlyrecord->org_sup_comment = $request->org_sup_comment;
        $monthlyrecord->org_sup_id = $sup_id;
        $monthlyrecord->update();

        return back()->with('success', "Assessment added succesfully");;
    }

    public function store_assessment(Request $request)
    {
        // dd($request->all());
        $assessment = OrgAssessment::create($request->all());
        $assessment->save();

        return back()->with('success', 'Assessment Report Submitted');
    }
    public function update_assessment(Request $request, $id)
    {
        $assessment = OrgAssessment::where('id', $id)->first();
        $assessment->qualitative = $request->qualitative;
        $assessment->qualitative_score = $request->qualitative_score;
        $assessment->update();

        return back()->with('success', 'Assessment Report Submitted');
    }
    public function store_form8(Request $request)
    {
        $form8 = Form8::where('siwes_id', $request->siwes_id)->first();
        $form8->update($request->all());

        return response()->json(['status'=>"Form Submitted Successfully!"]);
    }
}

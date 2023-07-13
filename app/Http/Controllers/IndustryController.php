<?php

namespace App\Http\Controllers;

use App\User;
use App\Student;
use App\Organization;
use App\OrgSupervisor;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
            // DB::beginTransaction();
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
                $user->password = Hash::make($request->password);
                if ($request->hasFile('profile_pic')){
                    $user->profile_pic = $request->file('profile_pic')->store('profile_pics', 'public');
                }

                $user->save();

                // Adding Student Details
                $supervisor = new OrgSupervisor();
                $supervisor->staff_id = $request->staff_id;
                $supervisor->user_id = $user->id;
                $supervisor->org_id = 1; //default organization
                $supervisor->department = $request->department;
                
                $supervisor->position = " "; //should be nullable
                $supervisor->signature = " "; //should be nullable

                $supervisor->save();

                // if (Auth::user()->role_id == 0) {
                //    return redirect('/admin/students'); 
                // } else {
                    return redirect('login');
                // }             
            
        } catch(\Exception $e){
            DB::rollback();
            return $e;
        }
    }
        // To validate the inputs
    // private function validateRequest()
    // {
    //     return request()->validate([
    //         'role_id'=> 'required|integer',
    //         'staff_id' => 'required|string|max:30|unique:users',
    //         'email' => 'required|email|max:50|unique:users',
    //         'last_name' => 'required|string|max:100',
    //         'first_name' => 'required|string|max:100',
    //         // 'middle_name' => 'string|max:100',
    //         'department' => 'required|string|max:200',
    //         'contact_no'=> 'required|digits_between:9,16',
    //         'gender'=> 'required|string|max:20',
    //         'password' => 'required|string|min:8|confirmed',
    //         'profile_pic' => 'required',
    //     ]);
    // }
        // Show IndustryUser dashboard - homepage
    public function index()
    {
        $id = Auth::user()->id;
        $org = Organization::where('user_id', $id)->first();
        if (!empty($org)){
            $studs = Student::where('org_id', $org->id)->first();
            $students = Student::where('org_id', $org->id)->get();
        }else{
            $students = $studs = null;
            // $students = Student::where('org_id', $org->id)->first();
        }
        $orgsup = OrgSupervisor::where('user_id', $id)->first();
        return view('industry.home', compact('orgsup', 'org', 'students', 'studs'));
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
        return redirect('industry');
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

        return redirect('industry');
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
        $user = User::where('id', $request->id)->first();
        $user->last_name = Str::ucfirst($request->last_name);
        $user->first_name = Str::ucfirst($request->first_name);
        $user->middle_name = Str::ucfirst($request->middle_name);
        $user->staff_id = ($request->staff_id);
        $user->department = ($request->department);
        $user->contact_no = ($request->contact_no);
        if ($request->hasFile('profile_pic')){
            $user->profile_pic = $request->file('profile_pic')->store('profile_pics', 'public');
        }
        $user->update();
        return redirect("/industry");
    }
    public function student($id)
    {
        $student = Student::where('user_id', $id)->first();
        // $org = Organization::where('user_id', $id)->first();
        return view('industry.student', compact('student'));
    }
    public function student_log($id)
    {
        $student = Student::where('user_id', $id)->first();
        return view('industry.student_log', compact('student'));
    }
}

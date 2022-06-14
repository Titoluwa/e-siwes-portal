<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use App\Organization;
use App\Student;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
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
    // To validate the inputs
    private function validateRequest()
    {
        return request()->validate([
            'role_id'=> 'required|integer',
            'staff_id' => 'required|string|max:30|unique:users',
            'email' => 'required|email|max:50|unique:users',
            'last_name' => 'required|string|max:100',
            'first_name' => 'required|string|max:100',
            'middle_name' => 'string|max:100',
            'department' => 'required|string|max:200',
            'contact_no'=> 'required|integer',
            'gender'=> 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'profile_pic' => 'required',
            'matric_no' => 'string', 'faculty' => 'string','course_of_study' => 'string',
        ]);
    }
        // Show IndustryUser dashboard - homepage
    public function index()
    {
        $id = Auth::user()->id;
        $org = Organization::where('staff_id', $id)->first();
        if(!empty($org)){
            $students = Student::where('org_id', $org->id)->get();
        }else
        {
            $students = null;  
        }
        // dd($students);
        return view('industry.home', compact('org', 'students'));
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
        $org = Organization::where('staff_id', $id)->first();
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

    public function student()
    {
        $id = Auth::user()->id;
        $org = Organization::where('staff_id', $id)->first();
        return view('industry.student', compact('org'));
    }
    
}
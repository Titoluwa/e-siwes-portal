<?php

namespace App\Http\Controllers;

use App\Organization;
use Illuminate\Http\Request;
use App\User;

use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
// use Symfony\Component\HttpKernel\Event\ViewEvent;

class IndustryController extends Controller
{
        // Middleware for Industry Supervisor activites excepts initial registration
    public function __construct()
    {
        $this->middleware('industry')->except(['create', 'store']);
    }
        // Show IndustryUser dashboard - homepage
    public function index(){
        $id = Auth::user()->id;
        $org = Organization::where('staff_id', $id)->first();
        return view('industry.home', compact('org'));
    }
    public function org(){
        return view('industry.org');
    }
    public function edit()
    {
        $id = Auth::user()->id;
        $org = Organization::where('staff_id', $id)->first();
        return view('industry.orgedit', compact('org'));
    }
    public function orgstore(Request $request){
        $org = Organization::create($request->all());
        $org->name = Str::ucfirst($request->name);
        if ($request->hasFile('logo')){
            $org->logo = $request->file('logo')->store('logos', 'public');
        }
        $org->save();
        // dd($org); 
        return redirect('industry');
    }
    public function student(){
        $id = Auth::user()->id;
        $org = Organization::where('staff_id', $id)->first();
        return view('industry.student', compact('org'));
    }
    // Show the registraton form for the industry supervisor user
    public function create(){
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
    private function validateRequest(){
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
    private function orgvalidateRequest(){
        return request()->validate([
            'name' => 'string|required', 
            'full_addresss' => 'string|required',
            'postal_address' => 'email|required',
            'year_of_est' => 'required', 
            'nature' => 'required|string',
            'specialization' => 'required|string',
            'plant_capacity' => 'string',
            'other_info' => 'string',
            'staff_id' =>'required',
            'logo'=>'required',
        ]);
    }
}
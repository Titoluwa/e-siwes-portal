<?php

namespace App\Http\Controllers;

use App\Itf;
use App\Session;
use App\Student;
use Carbon\Carbon;
use App\Organization;
use App\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Middleware for ITCU ADMIN activites
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        return view('admin.index');
    }
    public function setup()
    {
        $id = Auth::user()->id;
        $current_session = Carbon::now()->year;
        $previous_session = (int)$current_session-1;
        $sessions = Session::orderBy('id', 'DESC')->get();
        // dd($sessions);
        return view('admin.setup', compact('sessions', 'previous_session','current_session'));
    }
    public function students()
    {
        $studs = Student::first();
        $students = Student::all();
        return view('admin.students', compact('students', 'studs'));
    }
    public function staffs()
    {
        $staff = Staff::first();
        $staffs = Staff::all();
        return view('admin.staffs', compact('staff', 'staffs'));
    }
    public function organizations()
    {
        $orgs = Organization::first();
        $organizations = Organization::all();
        return view('admin.orgs', compact('orgs', 'organizations'));
    }
    public function itf_agents()
    {
        $itf = Itf::first();
        $itfs = Itf::all();
        return view('admin.itf', compact('itf', 'itfs'));
    }

}

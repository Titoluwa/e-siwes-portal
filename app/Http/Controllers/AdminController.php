<?php

namespace App\Http\Controllers;

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
        $id = Auth::user()->id;
        // $student = Student::where('user_id', $id)->first();
        // $orgs = Organization::all();
        return view('admin.index');
    }
}

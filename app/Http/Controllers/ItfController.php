<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItfController extends Controller
{
    // Middleware for ITF AGENT activites
    public function __construct()
    {
        $this->middleware('itf');
    }

    public function index()
    {
        $id = Auth::user()->id;
        // $student = Student::where('user_id', $id)->first();
        // $orgs = Organization::all();
        return view('itf.index');
    }
}

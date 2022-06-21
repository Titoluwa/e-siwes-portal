<?php

namespace App\Http\Controllers;

use App\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogbookController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;
        $student = Student::where('user_id', $id)->first();
        $currentdate = Carbon::now()->format('Y-m-d');
        return view('student.log', compact('student', 'currentdate'));
    }
}

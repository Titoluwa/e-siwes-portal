<?php

namespace App\Http\Controllers;

use App\DailyRecord;
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
        $records = DailyRecord::where('user_id', $id)->where('weeked', 0)->first();
        if (!empty($records)){
            $records = DailyRecord::where('user_id', $id)->where('weeked', 0)->orderBy('date', 'ASC')->get();
        }else{
            $records = null;
        }
        return view('student.log', compact('student', 'currentdate', 'records'));
    }
    public function store(Request $request)
    {
        // $id = Auth::user()->id;
        $record = DailyRecord::create($request->all());
        $record->save();
        return back();
    }
}
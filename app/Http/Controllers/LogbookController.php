<?php

namespace App\Http\Controllers;

use App\DailyRecord;
use App\Student;
use App\WeeklyRecord;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class LogbookController extends Controller
{
        // Show initial view of logbook module
    public function index()
    {
        $id = Auth::user()->id;
        $student = Student::where('user_id', $id)->first();
        $currentdate = Carbon::now()->format('Y-m-d');
        $dailyrecords = DailyRecord::where('user_id', $id)->where('weeked', 0)->first();
        $weeklyrecords = WeeklyRecord::where('user_id', $id)->where('monthed', 0)->first();
        if (!empty($dailyrecords)){
            $dailyrecords = DailyRecord::where('user_id', $id)->where('weeked', 0)->orderBy('date', 'ASC')->get();
        }else{
            $dailyrecords = null;
        }
        if (!empty($weeklyrecords)){
            $weeklyrecords = WeeklyRecord::where('user_id', $id)->where('monthed', 0)->orderBy('name', 'ASC')->get();
        }else{
            $weeklyrecords = null;
        }
        return view('student.log', compact('student', 'currentdate', 'dailyrecords', 'weeklyrecords'));
    }
        // stores the daily activity of each student
    public function store_daily(Request $request)
    {
        $record = DailyRecord::create($request->all());
        $record->save();
        return back();
    }
        // gets a single reord for edit
    public function show_daily($id)
    {
        $record = DailyRecord::where('id', $id)->first();
        return Response::json($record, 200);
    }
        // Updates a record for aparticular user
    public function update_daily(Request $request)
    {
        // dd($request->all());
        $record = DailyRecord::where('id', $request->id)->first();
        $record->day = $request->day;
        $record->date = $request->date;
        $record->description_of_work = $request->description_of_work;
        $record->update();
        return back();
    }
        // Deletes a daily_record
    public function destroy_daily($id)
    {
        $record = DailyRecord::findOrFail($id);
        $record->delete();
        return response()->json(['status'=>"Daily Record Deleted Successfully!"]);
    }
        // store the weekly record
    public function store_weekly(Request $request)
    {
        $record = WeeklyRecord::create($request->all());
        $record->daily_records = $request->input('daily_records');
        foreach ($record->daily_records as $day){
            DailyRecord::where('id', $day)->update(['weeked'=> 1]);
        }
        $record->save();
        return back();
    }
        // show a weekly record
    public function show_week($id)
    {
        $record = WeeklyRecord::where('id', $id)->first();
        return Response::json($record, 200);
    }
}
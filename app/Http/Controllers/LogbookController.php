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
    public function __construct()
    {
        $this->middleware('student');
    }
        // Show initial view of logbook module : shows ALL Records 
    public function index()
    {
        $id = Auth::user()->id;
        $student = Student::where('user_id', $id)->first();
        $currentdate = Carbon::now()->format('Y-m-d');
        $all_dailys = DailyRecord::where('user_id', $id)->orderBy('date', 'ASC')->first();
        $dailyrecords = DailyRecord::where('user_id', $id)->where('weeked', 0)->first();
        $weeklyrecords = WeeklyRecord::where('user_id', $id)->where('monthed', 0)->first();

        if (!empty($all_dailys)){
            $all_dailys = DailyRecord::where('user_id', $id)->orderBy('date', 'ASC')->get();
        }else{
            $all_dailys = null;
        }
       
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
        return view('student.log', compact('student', 'currentdate', 'dailyrecords', 'weeklyrecords', 'all_dailys'));
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
        $record = WeeklyRecord::where('id', $id)->with('daily')->first();
        $days = array();
        foreach($record->daily_records as $day)
        {
            $daily = DailyRecord::where('id', $day)->first();
            array_push($days, $daily);
        }
        $data = [
            'record' => $record,
            'days' => $days
        ];
        return Response::json($data, 200);
    }
        // Updates a WEEKLY record for a particular user
    public function update_weekly(Request $request)
    {
        $record = WeeklyRecord::where('id', $request->id)->first();
        foreach ($record->daily_records as $day)
        {
            DailyRecord::where('id', $day)->update(['weeked'=> 0]);
        };
        $record->daily_records = [];
        $record->name = $request->name;
        $record->department = $request->department;
        $record->description_of_week = $request->description_of_week;
        $record->daily_records = $request->input('daily_records');
        foreach ($request->daily_records as $day)
        {
            DailyRecord::where('id', $day)->update(['weeked'=> 1]);
        };
        $record->update();
        return back();
    }
        // Deletes a weekly_record
    public function destroy_weekly($id)
    {
        $record = WeeklyRecord::findOrFail($id);
        foreach ($record->daily_records as $day)
        {
            DailyRecord::where('id', $day)->update(['weeked'=> 0]);
        };
        $record->delete();
        return response()->json(['status'=>"Week Record Deleted Successfully!"]);
    }
}
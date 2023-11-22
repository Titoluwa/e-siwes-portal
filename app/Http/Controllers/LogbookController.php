<?php

namespace App\Http\Controllers;

use App\Form8;
use App\PrintDoc;
use App\Student;
use Carbon\Carbon;
use App\DailyRecord;
use App\Organization;
use App\WeeklyRecord;
use App\MonthlyRecord;
use App\Session;
use App\Siwes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class LogbookController extends Controller
{
    public function __construct()
    {
        $this->middleware('student')->except('show_week', 'show_month');
    }
        // Show initial view of logbook module : shows ALL Records 
    public function index400()
    {
        $id = Auth::user()->id;
        $student = Student::where('user_id', $id)->first();
        $siwes400 = Siwes::where('siwes_type_id', 3)->where('user_id', $id)->first();
        $orgs = Organization::all();
        $sessions = Session::all();
        $currentdate = Carbon::now()->format('Y-m-d');
        $form8 = Form8::where('siwes_id', $siwes400->id)->first();

        if (!empty($siwes400)){
            $all_dailys = DailyRecord::where('siwes_id', $siwes400->id)->where('user_id', $id)->orderBy('date', 'ASC')->first();
            $all_weeks = WeeklyRecord::where('siwes_id', $siwes400->id)->where('user_id', $id)->first();
            $dailyrecords = DailyRecord::where('siwes_id', $siwes400->id)->where('user_id', $id)->where('weeked', 0)->first();
            $weeklyrecords = WeeklyRecord::where('siwes_id', $siwes400->id)->where('user_id', $id)->where('monthed', 0)->first();
            $monthlyrecords = MonthlyRecord::where('siwes_id', $siwes400->id)->where('user_id', $id)->first();
        }else{
            $all_dailys = null;
            $all_weeks = null;
            $dailyrecords = null;
            $weeklyrecords = null;
            $monthlyrecords = null;
        }        

        if (!empty($all_dailys)){
            $all_dailys = DailyRecord::where('siwes_id', $siwes400->id)->where('user_id', $id)->orderBy('date', 'ASC')->get();
        }else{
            $all_dailys = null;
        }

        if (!empty($dailyrecords)){
            $dailyrecords = DailyRecord::where('siwes_id', $siwes400->id)->where('user_id', $id)->where('weeked', 0)->orderBy('date', 'ASC')->get();
        }else{
            $dailyrecords = null;
        }
        
        if (!empty($weeklyrecords)){
            $weeklyrecords = WeeklyRecord::where('siwes_id', $siwes400->id)->where('user_id', $id)->where('monthed', 0)->orderBy('created_at', 'ASC')->get();
        }else{
            $weeklyrecords = null;
        }
        
        if (!empty($all_weeks)){
            $all_weeks = WeeklyRecord::where('siwes_id', $siwes400->id)->where('user_id', $id)->get();
        }else{
            $all_weeks = null;
        }

        if (!empty($monthlyrecords)){
            $monthlyrecords = MonthlyRecord::where('siwes_id', $siwes400->id)->where('user_id', $id)->get();
        }else{
            $monthlyrecords = null;
        }

        return view('student.log', compact('student', 'siwes400', 'orgs', 'currentdate', 'dailyrecords', 'weeklyrecords', 'all_dailys', 'monthlyrecords', 'all_weeks', 'sessions', 'form8'));
    }
    public function index200()
    {
        $id = Auth::user()->id;
        $siwes200 = Siwes::where('siwes_type_id', 1)->where('user_id', $id)->first();
        $sessions = Session::all();
        $student = Student::where('user_id', $id)->first();
        $currentdate = Carbon::now()->format('Y-m-d');
        
        if (!empty($siwes200)){
            $all_dailys = DailyRecord::where('siwes_id', $siwes200->id)->where('user_id', $id)->orderBy('date', 'ASC')->first();
            $all_weeks = WeeklyRecord::where('siwes_id', $siwes200->id)->where('user_id', $id)->first();
            $dailyrecords = DailyRecord::where('siwes_id', $siwes200->id)->where('user_id', $id)->where('weeked', 0)->first();
            $weeklyrecords = WeeklyRecord::where('siwes_id', $siwes200->id)->where('user_id', $id)->where('monthed', 0)->first();
            $monthlyrecords = MonthlyRecord::where('siwes_id', $siwes200->id)->where('user_id', $id)->first();
        }else{
            $all_dailys = null;
            $all_weeks = null;
            $dailyrecords = null;
            $weeklyrecords = null;
            $monthlyrecords = null;
        }

        if (!empty($all_dailys)){
            $all_dailys = DailyRecord::where('siwes_id', $siwes200->id)->where('user_id', $id)->orderBy('date', 'ASC')->get();
        }else{
            $all_dailys = null;
        }

        if (!empty($dailyrecords)){
            $dailyrecords = DailyRecord::where('siwes_id', $siwes200->id)->where('user_id', $id)->where('weeked', 0)->orderBy('date', 'ASC')->get();
        }else{
            $dailyrecords = null;
        }
        
        if (!empty($weeklyrecords)){
            $weeklyrecords = WeeklyRecord::where('siwes_id', $siwes200->id)->where('user_id', $id)->where('monthed', 0)->orderBy('created_at', 'ASC')->get();
        }else{
            $weeklyrecords = null;
        }
        
        if (!empty($all_weeks)){
            $all_weeks = WeeklyRecord::where('siwes_id', $siwes200->id)->where('user_id', $id)->get();
        }else{
            $all_weeks = null;
        }

        if (!empty($monthlyrecords)){
            $monthlyrecords = MonthlyRecord::where('siwes_id', $siwes200->id)->where('user_id', $id)->get();
        }else{
            $monthlyrecords = null;
        }
        return view('student.log200', compact('student', 'siwes200', 'sessions', 'currentdate', 'dailyrecords', 'weeklyrecords', 'all_dailys', 'monthlyrecords', 'all_weeks'));
    }
    public function index300()
    {
        $id = Auth::user()->id;
        $student = Student::where('user_id', $id)->first();
        $siwes300 = Siwes::where('siwes_type_id', 2)->where('user_id', $id)->first();
        $sessions = Session::all();
        $orgs = Organization::all();
        $currentdate = Carbon::now()->format('Y-m-d');

        if (!empty($siwes300)){
            $all_dailys = DailyRecord::where('siwes_id', $siwes300->id)->where('user_id', $id)->orderBy('date', 'ASC')->first();
            $all_weeks = WeeklyRecord::where('siwes_id', $siwes300->id)->where('user_id', $id)->first();
            $dailyrecords = DailyRecord::where('siwes_id', $siwes300->id)->where('user_id', $id)->where('weeked', 0)->first();
            $weeklyrecords = WeeklyRecord::where('siwes_id', $siwes300->id)->where('user_id', $id)->where('monthed', 0)->first();
            $monthlyrecords = MonthlyRecord::where('siwes_id', $siwes300->id)->where('user_id', $id)->first();
        }else{
            $all_dailys = null;
            $all_weeks = null;
            $dailyrecords = null;
            $weeklyrecords = null;
            $monthlyrecords = null;
        }
       
        if (!empty($all_dailys)){
            $all_dailys = DailyRecord::where('siwes_id', $siwes300->id)->orderBy('date', 'ASC')->get();
        }else{
            $all_dailys = null;
        }

        if (!empty($dailyrecords)){
            $dailyrecords = DailyRecord::where('siwes_id', $siwes300->id)->where('weeked', 0)->orderBy('date', 'ASC')->get();
        }else{
            $dailyrecords = null;
        }
        
        if (!empty($weeklyrecords)){
            $weeklyrecords = WeeklyRecord::where('siwes_id', $siwes300->id)->where('monthed', 0)->orderBy('created_at', 'ASC')->get();
        }else{
            $weeklyrecords = null;
        }
        
        if (!empty($all_weeks)){
            $all_weeks = WeeklyRecord::where('siwes_id', $siwes300->id)->get();
        }else{
            $all_weeks = null;
        }

        if (!empty($monthlyrecords)){
            $monthlyrecords = MonthlyRecord::where('siwes_id', $siwes300->id)->get();
        }else{
            $monthlyrecords = null;
        }
        return view('student.log300', compact('student', 'siwes300', 'orgs', 'currentdate', 'dailyrecords', 'weeklyrecords', 'all_dailys', 'monthlyrecords', 'all_weeks', 'sessions'));
    }  
    
    public function initiate_logbook(Request $request)
    {
        $user_id = Auth::user()->id;
        $siwes = Siwes::create($request->all());
        if ($request->siwes_type_id == 1){
            $siwes->swep_attendance = [];
        }
        $siwes->user_id = $user_id;
        $siwes->save();
        $print = new PrintDoc();
        $print->siwes_id = $siwes->id;
        $print->save();

        if($siwes){
            return back()->with('success', "Your SIWES has been registered. Check your Logbook");
        }else{
            return back()->with('deleted', "<b>ERROR!</b> loading Logbook");
        }
    }
    
    // stores the daily activity of each student
    public function store_daily(Request $request)
    {
        $record = DailyRecord::create($request->all());
        $record->save();
        return back()->with('success', "<b>$record->date</b> Record Added Successfully");
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
        return back()->with('success', "<b>$record->date</b> Record Updated Successfully");
    }
        // Deletes a daily_record
    public function destroy_daily($id)
    {
        $record = DailyRecord::findOrFail($id);
        $record->delete();
        return response()->json(['status'=>"Day Record Deleted Successfully!"]);
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
        return back()->with('success', "<b>$record->name</b> Record Added Successfully");;
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
        return back()->with('success', "<b>$record->name</b> Record Updated Successfully");
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
        return response()->json(['status'=>"Record Deleted Successfully!"]);
    }
    public function store_monthly(Request $request)
    {
        $record = MonthlyRecord::create($request->all());
        if ($request->hasFile('sketch')){
            $record->sketch = $request->file('sketch')->store('sketches', 'public');
        }
        $record->weekly_records = $request->input('weekly_records');
        foreach ($record->weekly_records as $week){
            WeeklyRecord::where('id', $week)->update(['monthed'=> 1]);
        }
        $record->save();
        return back()->with('success', "<b>$record->name</b>'s Record Added Successfully");;
    }
    public function show_month($id)
    {
        $record = MonthlyRecord::where('id', $id)->first();
        $weeks = array();
        foreach($record->weekly_records as $week)
        {
            $weekly = WeeklyRecord::where('id', $week)->first();
            array_push($weeks, $weekly);
        }
        $data = [
            'record' => $record,
            'weeks' => $weeks
        ];
        return Response::json($data, 200);
    }
        // Updates a MONTH record for a particular user
    public function update_monthly(Request $request)
    {
        $record = MonthlyRecord::where('id', $request->id)->first();
        foreach ($record->weekly_records as $week)
        {
            WeeklyRecord::where('id', $week)->update(['monthed'=> 0]);
        };
        $record->weekly_records = [];
        $record->name = $request->name;
        $record->department = $request->department;
        $record->description_of_month = $request->description_of_month;
        $record->weekly_records = $request->input('weekly_records');
        foreach ($request->weekly_records as $week)
        {
            WeeklyRecord::where('id', $week)->update(['monthed'=> 1]);
        };
        $record->update();
        return back()->with('success', "<b>$record->name</b>'s Record Updated Successfully");;
    }
        // Deletes a monthly_record
    public function destroy_monthly($id)
    {
        $record = MonthlyRecord::findOrFail($id);
        foreach ($record->weekly_records as $week)
        {
            WeeklyRecord::where('id', $week)->update(['monthed'=> 0]);
        };
        $record->delete();
        return response()->json(['status'=>"Record Deleted Successfully!"]);
    }
    public function store_form8(Request $request)
    {
        $form8 = new Form8($request->all());
        $form8->save();
        return response()->json(['status'=>"Form Submitted Successfully!"]);
    }
}
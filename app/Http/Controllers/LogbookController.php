<?php

namespace App\Http\Controllers;

use App\DailyRecord;
use App\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use LDAP\Result;

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
    public function store_daily(Request $request)
    {
        $record = DailyRecord::create($request->all());
        $record->save();
        return back();
    }
    public function show_daily($id)
    {
        $record = DailyRecord::where('id', $id)->first();
        return Response::json($record, 200);
    }
    public function update_daily(Request $request)
    {
        // dd($request->all());
        $record = DailyRecord::where('id', $request->edit_id)->first();
        $record->day = $request->edit_day;
        $record->date = $request->edit_date;
        $record->description_of_work = $request->edit_description_of_work;
        $record->update();
        return back();
    }
    public function destroy_daily($id)
    {
        $record = DailyRecord::findOrFail($id);
        $record->delete();
        return response()->json(['status'=>"Daily Record Deleted Successfully!"]);
    }
}
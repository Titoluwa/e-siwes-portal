<?php

namespace App\Http\Controllers;

use App\Session;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function index()
    {   
        $current_year = Carbon::now()->year;
        $previous_year = (int)$current_year-1;
        $election_year = Session::orderBy('id', 'DESC')->get();
        return view('admin.setup.index', compact('election_year', 'previous_year','current_year'));
    }
    public function store(Request $request)
    {
        Session::where('status', 1)->update(['status'=> 0]);
        $setup = new Session();
        $setup->year = ($request->year);
        $setup->start_date = ($request->start_date);
        $setup->end_date = ($request->end_date);
        $setup->save();
        return redirect('admin/setup')->with('message',"$request->year has been added and set!");
    }
    public function edit(Session  $setup)
    {
        return view("admin.setup.edit", compact('setup'));
    }
    public function update(Request $request, Session  $setup)
    {
        $setup->year = ($request->year);
        $setup->start_date = ($request->start_date);
        $setup->end_date = ($request->end_date);
        $setup->update();
        return redirect("admin/setup/". $setup->id ."/edit")->with('message',"$request->year election date has been Updated!");; 
    }
    
}
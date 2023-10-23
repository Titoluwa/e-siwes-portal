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
    public function store(Request $request)
    {
        Session::where('status', 1)->update(['status'=> 0]);
        $setup = new Session();
        $setup->year = ($request->year);
        $setup->start_date = ($request->start_date);
        $setup->end_date = ($request->end_date);
        $setup->save();
        return redirect('admin/setup')->with('success',"<b>$request->year</b> has been added and set!");
    }
    public function edit($id)
    {
        $setup = Session::findorFail($id);
        // $current_session = Session::where('status', 1)->first();
        // $sessions = Session::orderBy('id', 'DESC')->get();

        return response()->json($setup, 200);
        // return view("admin.setup_edit", compact('setup', 'current_session', 'sessions'));
    }
    public function update(Request $request, Session  $setup)
    {
        $session = $setup->where('status', 1)->first();
        $session->year = ($request->year);
        $session->start_date = ($request->start_date);
        $session->end_date = ($request->end_date);
        $session->update();
        return redirect("admin/setup")->with('success',"<b>$request->year</b> session date has been Updated!");; 
    }
    
}
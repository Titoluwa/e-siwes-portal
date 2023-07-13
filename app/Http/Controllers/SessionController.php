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
        return redirect('admin/setup')->with('message',"$request->year has been added and set!");
    }
    public function edit($id)
    {
        $setup = Session::findorFail($id);
        return view("admin.setup_edit", compact('setup'));
    }
    public function update(Request $request, Session  $setup)
    {
        $setup->year = ($request->year);
        $setup->start_date = ($request->start_date);
        $setup->end_date = ($request->end_date);
        $setup->update();
        return redirect("admin/setup")->with('message',"$request->year session date has been Updated!");; 
    }
    
}
<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function create()
    {
        $dept = Department::all();
        return view('admin.department', compact('dept'));
    }
    public function store(Request $request)
    {
        $dept = new Department();
        $dept->faculty = $request->faculty;
        $dept->department = $request->department;
        $dept->save();

        return back()->with('message',"$request->department has been added!");
    }
}
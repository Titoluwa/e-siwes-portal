<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Staff extends Model
{
    protected $guarded = ['id'];
    protected $timestamp = true;
    protected $with = ['user'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function assignedStudentCount()
    {
        $current_session = Session::where('status', 1)->first();
        $staff  = Staff::where('id', $this->id)->first();
        $students = Siwes:: where('session_id', $current_session->id)->where('assigned_staff_id', $staff->id)->get();
        
        return $students->count();
    }
}

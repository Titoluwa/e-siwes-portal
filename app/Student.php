<?php

namespace App;

use App\User;
use App\Organization;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $guarded = ['id'];
    protected $timestamp = true;

    public function org()
    {
        return $this->belongsTo(Organization::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
//     public function name()
//     {
//         $id = Auth::user()->id;
//         $stu =  User::where('user_id', $id)->first();
//         $name = $stu->last_name . $stu->first_name;
//         return $name;
//     }
}

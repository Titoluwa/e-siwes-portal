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
    protected $with = ['user', 'org'];

    public function org()
    {
        return $this->belongsTo(Organization::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

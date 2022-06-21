<?php

namespace App;

use App\User;
use App\Organization;
use Illuminate\Database\Eloquent\Model;

class DailyRecord extends Model
{
    protected $guarded = ['id'];
    protected $timestamp = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function org()
    {
        return $this->belongsTo(Organization::class);
    }
}

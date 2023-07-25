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
}

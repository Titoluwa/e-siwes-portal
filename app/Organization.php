<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $guarded = ['id', 'status_id'];
    protected $timestamp = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}

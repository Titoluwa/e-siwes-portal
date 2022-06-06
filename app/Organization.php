<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{

    public function staff()
    {
        return $this->hasMany(User::class);
    }
    
    protected $guarded = ['id', 'status_id'];
    protected $timestamp = true;
}

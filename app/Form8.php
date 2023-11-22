<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form8 extends Model
{
    protected $guarded = ['id'];
    protected $timestamp = true;
    
    public function siwes()
    {
        return $this->belongsTo(Siwes::class);
    }
}

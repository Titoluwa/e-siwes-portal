<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Swep200 extends Model
{
    protected $guarded = ['id'];
    protected $timestamp = true;
    protected $with = ['siwes'];

    public function siwes()
    {
        return $this->belongsTo(Siwes::class);
    }
}

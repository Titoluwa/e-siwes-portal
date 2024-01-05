<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrintDoc extends Model
{
    protected $guarded = ['id'];
    protected $timestamp = true;
    public function siwes()
    {
        return $this->belongsTo(Siwes::class);
    }
}

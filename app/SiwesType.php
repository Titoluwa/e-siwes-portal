<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiwesType extends Model
{
    protected $table = 'siwes_type';
    
    protected $guarded = ['id'];
    protected $timestamp = true;
}

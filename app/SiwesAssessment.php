<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiwesAssessment extends Model
{
    protected $table = 'siwes_assessment';
    protected $guarded = ['id'];
    protected $timestamp = true;
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function siwes()
    {
        return $this->belongsTo(Siwes::class);
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrgAssessment extends Model
{
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
    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }
}

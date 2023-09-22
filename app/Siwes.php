<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siwes extends Model
{
    protected $table = 'siwes';
    protected $casts = [
        'swep_attendance' => 'array'
    ];
    protected $guarded = ['id'];
    protected $timestamp = true;
    
    public function org()
    {
        return $this->belongsTo(Organization::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function siwes_type()
    {
        return $this->belongsTo(SiwesType::class);
    }
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function department()
    {
        return $this->student->department;
    }
    public function assigned_staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function total_score()
    {
        return $this->swep_score + $this->itcu_score;
    }
}

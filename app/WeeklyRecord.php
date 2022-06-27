<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WeeklyRecord extends Model
{
    protected $casts = [
        'daily_records' => 'array'
    ];
    protected $guarded = ['id'];
    protected $timestamp = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function daily()
    {
        return $this->belongsTo(DailyRecord::class);
    }
    public function org()
    {
        return $this->belongsTo(Organization::class);
    }
}

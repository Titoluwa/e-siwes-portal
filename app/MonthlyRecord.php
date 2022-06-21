<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonthlyRecord extends Model
{
    protected $casts = [
        'weekly_records' => 'array'
    ];
    protected $guarded = ['id'];
    protected $timestamp = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function org()
    {
        return $this->belongsTo(Organization::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model

{
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];
    protected $timestamp = true;
    public function siwes_type()
    {
        return $this->belongsTo(SiwesType::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
